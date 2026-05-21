<?php
/**
 * Bursar finance helpers — student statements, accounts, exports
 */
require_once __DIR__ . '/../config/database.php';

if (!function_exists('bursarTableExists')) {
    function bursarTableExists(mysqli $conn, string $table): bool {
        $safe = $conn->real_escape_string($table);
        $r = $conn->query("SHOW TABLES LIKE '{$safe}'");
        return $r && $r->num_rows > 0;
    }
}

if (!function_exists('bursarFetchAll')) {
    function bursarFetchAll(mysqli $conn, string $sql, string $types = '', array $params = []): array {
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            return [];
        }
        if ($types !== '' && $params) {
            $stmt->bind_param($types, ...$params);
        }
        if (!$stmt->execute()) {
            $stmt->close();
            return [];
        }
        $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $rows;
    }
}

if (!function_exists('bursarGetStatementAccounts')) {
    /**
     * List students/accounts for statement generation
     */
    function bursarGetStatementAccounts(?string $search = null, ?string $searchBy = 'all'): array {
        $finance = getStaffConnection();
        $students = getStudentsConnection();
        $accounts = [];

        if (bursarTableExists($finance, 'student_fee_accounts') && bursarTableExists($finance, 'students')) {
            $sql = "SELECT sfa.student_id, s.first_name, s.surname, s.other_name, s.phone, s.email, s.program,
                           sfa.academic_year, sfa.total_fees, sfa.amount_paid, sfa.balance, sfa.status, sfa.last_payment_date
                    FROM student_fee_accounts sfa
                    INNER JOIN students s ON s.student_id = sfa.student_id
                    WHERE 1=1";
            $params = [];
            $types = '';
            if ($search !== null && $search !== '') {
                $term = '%' . $search . '%';
                if ($searchBy === 'name') {
                    $sql .= " AND (CONCAT(s.first_name,' ',s.surname) LIKE ? OR s.surname LIKE ?)";
                    $types = 'ss';
                    $params = [$term, $term];
                } elseif ($searchBy === 'admission') {
                    $sql .= " AND sfa.student_id LIKE ?";
                    $types = 's';
                    $params = [$term];
                } elseif ($searchBy === 'phone') {
                    $sql .= " AND s.phone LIKE ?";
                    $types = 's';
                    $params = [$term];
                } else {
                    $sql .= " AND (sfa.student_id LIKE ? OR CONCAT(s.first_name,' ',s.surname) LIKE ? OR s.phone LIKE ?)";
                    $types = 'sss';
                    $params = [$term, $term, $term];
                }
            }
            $sql .= " ORDER BY s.surname ASC, s.first_name ASC LIMIT 500";
            $accounts = bursarFetchAll($finance, $sql, $types, $params);
        } elseif (bursarTableExists($finance, 'fee_accounts')) {
            $sql = "SELECT student_id, '' AS first_name, '' AS surname, '' AS other_name, '' AS phone, '' AS email,
                           program, '' AS academic_year, total_fees, paid_amount AS amount_paid, balance,
                           fee_status AS status, NULL AS last_payment_date
                    FROM fee_accounts WHERE 1=1";
            if ($search !== null && $search !== '') {
                $term = '%' . $search . '%';
                $sql .= " AND student_id LIKE '" . $finance->real_escape_string($term) . "'";
            }
            $sql .= " ORDER BY student_id ASC LIMIT 500";
            $r = $finance->query($sql);
            if ($r) {
                $accounts = $r->fetch_all(MYSQLI_ASSOC);
            }
        }

        if (empty($accounts) && bursarTableExists($students, 'users')) {
            $sql = "SELECT index_number AS student_id, full_name, phone, '' AS email, '' AS program,
                           '' AS academic_year, 2400000 AS total_fees, 0 AS amount_paid, 2400000 AS balance,
                           'unpaid' AS status, NULL AS last_payment_date
                    FROM users WHERE role = 'student' AND is_active = 1";
            $params = [];
            $types = '';
            if ($search !== null && $search !== '') {
                $term = '%' . $search . '%';
                if ($searchBy === 'name') {
                    $sql .= " AND full_name LIKE ?";
                    $types = 's';
                    $params = [$term];
                } elseif ($searchBy === 'admission') {
                    $sql .= " AND index_number LIKE ?";
                    $types = 's';
                    $params = [$term];
                } elseif ($searchBy === 'phone') {
                    $sql .= " AND phone LIKE ?";
                    $types = 's';
                    $params = [$term];
                } else {
                    $sql .= " AND (full_name LIKE ? OR index_number LIKE ? OR phone LIKE ?)";
                    $types = 'sss';
                    $params = [$term, $term, $term];
                }
            }
            $sql .= " ORDER BY full_name ASC LIMIT 500";
            $rows = bursarFetchAll($students, $sql, $types, $params);
            foreach ($rows as $row) {
                $parts = explode(' ', trim($row['full_name'] ?? ''), 2);
                $accounts[] = [
                    'student_id' => $row['student_id'],
                    'first_name' => $parts[0] ?? '',
                    'surname' => $parts[1] ?? ($parts[0] ?? ''),
                    'other_name' => '',
                    'phone' => $row['phone'] ?? '',
                    'email' => $row['email'] ?? '',
                    'program' => $row['program'] ?? 'Nursing / Midwifery',
                    'academic_year' => date('Y') . '/' . (date('Y') + 1),
                    'total_fees' => (float) ($row['total_fees'] ?? 0),
                    'amount_paid' => (float) ($row['amount_paid'] ?? 0),
                    'balance' => (float) ($row['balance'] ?? 0),
                    'status' => $row['status'] ?? 'unpaid',
                    'last_payment_date' => $row['last_payment_date'],
                ];
            }
        }

        return $accounts;
    }
}

if (!function_exists('bursarGetStudentStatement')) {
    function bursarGetStudentStatement(string $studentId): ?array {
        $finance = getStaffConnection();
        $studentId = trim($studentId);
        if ($studentId === '') {
            return null;
        }

        $accounts = bursarGetStatementAccounts($studentId, 'admission');
        if (empty($accounts)) {
            $accounts = bursarGetStatementAccounts($studentId, 'all');
        }
        $account = $accounts[0] ?? null;

        if (!$account) {
            $all = bursarGetStatementAccounts();
            foreach ($all as $a) {
                if (($a['student_id'] ?? '') === $studentId) {
                    $account = $a;
                    break;
                }
            }
        }

        if (!$account) {
            return null;
        }

        $name = trim(($account['first_name'] ?? '') . ' ' . ($account['surname'] ?? ''));
        if ($name === '' && !empty($account['full_name'])) {
            $name = $account['full_name'];
        }

        $payments = [];
        if (bursarTableExists($finance, 'fee_payments')) {
            $amountCol = 'amount_paid';
            $cols = $finance->query("SHOW COLUMNS FROM fee_payments LIKE 'amount_paid'");
            if (!$cols || $cols->num_rows === 0) {
                $amountCol = 'amount';
            }
            $paySql = "SELECT receipt_number, {$amountCol} AS amount_paid, payment_method, payment_reference, bank_name,
                              payment_date, status
                       FROM fee_payments
                       WHERE student_id = ?
                       ORDER BY payment_date DESC, id DESC";
            $payments = bursarFetchAll($finance, $paySql, 's', [$studentId]);
        }

        if (empty($payments)) {
            $paid = (float) ($account['amount_paid'] ?? 0);
            if ($paid > 0) {
                $payments[] = [
                    'receipt_number' => 'SUMMARY',
                    'amount_paid' => $paid,
                    'payment_method' => 'Various',
                    'payment_reference' => '—',
                    'bank_name' => '—',
                    'payment_date' => $account['last_payment_date'] ?? date('Y-m-d'),
                    'status' => 'verified',
                ];
            }
        }

        $total = (float) ($account['total_fees'] ?? 0);
        $paidTotal = (float) ($account['amount_paid'] ?? 0);
        $balance = (float) ($account['balance'] ?? max(0, $total - $paidTotal));

        return [
            'student_id' => $studentId,
            'student_name' => $name,
            'phone' => $account['phone'] ?? '',
            'email' => $account['email'] ?? '',
            'program' => $account['program'] ?? '—',
            'academic_year' => $account['academic_year'] ?? (date('Y') . '/' . (date('Y') + 1)),
            'status' => ucfirst(str_replace('_', ' ', $account['status'] ?? 'unpaid')),
            'total_fees' => $total,
            'amount_paid' => $paidTotal,
            'balance' => $balance,
            'payments' => $payments,
            'generated_at' => date('d F Y, h:i A'),
            'statement_ref' => 'STMT-' . date('Ymd') . '-' . preg_replace('/[^A-Z0-9]/i', '', $studentId),
        ];
    }
}

if (!function_exists('bursarFormatUgx')) {
    function bursarFormatUgx($amount): string {
        return 'UGX ' . number_format((float) $amount, 0, '.', ',');
    }
}

if (!function_exists('bursarCanAccessFinance')) {
    function bursarCanAccessFinance(): bool {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (($_SESSION['type'] ?? '') !== 'staff') {
            return false;
        }
        $role = strtolower($_SESSION['role'] ?? '');
        return strpos($role, 'bursar') !== false
            || strpos($role, 'finance') !== false
            || strpos($role, 'accountant') !== false
            || in_array($role, ['director finance', 'director general', 'ceo', 'chief executive officer'], true);
    }
}
