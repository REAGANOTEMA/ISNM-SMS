<?php
/**
 * ISNM Finance Module — billing, payments, budgets, ledger, payroll
 */
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/bursar_finance.php';

if (!function_exists('finConn')) {
    function finConn(): mysqli {
        return getStaffConnection();
    }
}

if (!function_exists('finLog')) {
    function finLog(string $action, string $module, string $details = ''): void {
        $c = finConn();
        $sid = (int) ($_SESSION['user_id'] ?? 0);
        $sname = $_SESSION['full_name'] ?? 'Staff';
        $ip = $_SERVER['REMOTE_ADDR'] ?? '';
        $stmt = $c->prepare("INSERT INTO fin_activity_log (staff_id, staff_name, action, module, details, ip_address) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param('isssss', $sid, $sname, $action, $module, $details, $ip);
            $stmt->execute();
            $stmt->close();
        }
    }
}

if (!function_exists('finEnsureSchema')) {
    function finEnsureSchema(): bool {
        $sqlFile = __DIR__ . '/../database/finance_module.sql';
        if (!file_exists($sqlFile)) {
            return false;
        }
        $c = finConn();
        $sql = file_get_contents($sqlFile);
        foreach (array_filter(array_map('trim', explode(';', $sql))) as $q) {
            if ($q !== '') {
                @$c->query($q);
            }
        }
        return true;
    }
}

if (!function_exists('finFormatUgx')) {
    function finFormatUgx($n): string {
        return 'UGX ' . number_format((float) $n, 0, '.', ',');
    }
}

if (!function_exists('finTableExists')) {
    function finTableExists(string $table): bool {
        $c = finConn();
        $t = $c->real_escape_string($table);
        $r = $c->query("SHOW TABLES LIKE '{$t}'");
        return $r && $r->num_rows > 0;
    }
}

if (!function_exists('finDashboardStats')) {
    function finDashboardStats(): array {
        finEnsureSchema();
        $c = finConn();
        $today = date('Y-m-d');
        $stats = [
            'today_collections' => 0,
            'week_collections' => 0,
            'month_collections' => 0,
            'outstanding_fees' => 0,
            'total_students' => 0,
            'cleared_students' => 0,
            'not_cleared_students' => 0,
            'pending_payments' => 0,
            'pending_approvals' => 0,
            'overdue_count' => 0,
        ];
        if (!finTableExists('fin_payments')) {
            return $stats;
        }
        $r = $c->query("SELECT COALESCE(SUM(amount),0) t FROM fin_payments WHERE status='verified' AND payment_date='{$today}'");
        if ($r) $stats['today_collections'] = (float) $r->fetch_assoc()['t'];
        $r = $c->query("SELECT COALESCE(SUM(amount),0) t FROM fin_payments WHERE status='verified' AND payment_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)");
        if ($r) $stats['week_collections'] = (float) $r->fetch_assoc()['t'];
        $r = $c->query("SELECT COALESCE(SUM(amount),0) t FROM fin_payments WHERE status='verified' AND MONTH(payment_date)=MONTH(CURDATE()) AND YEAR(payment_date)=YEAR(CURDATE())");
        if ($r) $stats['month_collections'] = (float) $r->fetch_assoc()['t'];
        $r = $c->query("SELECT COUNT(*) c FROM fin_payments WHERE status='pending'");
        if ($r) $stats['pending_payments'] = (int) $r->fetch_assoc()['c'];
        if (finTableExists('fin_student_accounts')) {
            $r = $c->query("SELECT COUNT(*) t, SUM(balance) b FROM fin_student_accounts");
            if ($r) {
                $row = $r->fetch_assoc();
                $stats['total_students'] = (int) $row['t'];
                $stats['outstanding_fees'] = (float) $row['b'];
            }
            $r = $c->query("SELECT COUNT(*) c FROM fin_student_accounts WHERE balance <= 0 AND amount_paid > 0");
            if ($r) $stats['cleared_students'] = (int) $r->fetch_assoc()['c'];
            $stats['not_cleared_students'] = max(0, $stats['total_students'] - $stats['cleared_students']);
            $r = $c->query("SELECT COUNT(*) c FROM fin_student_accounts WHERE status='overdue' OR (due_date < CURDATE() AND balance > 0)");
            if ($r) $stats['overdue_count'] = (int) $r->fetch_assoc()['c'];
        }
        if (finTableExists('fin_expenses')) {
            $r = $c->query("SELECT COUNT(*) c FROM fin_expenses WHERE status='pending'");
            if ($r) $stats['pending_approvals'] += (int) $r->fetch_assoc()['c'];
        }
        if (finTableExists('fin_adjustments')) {
            $r = $c->query("SELECT COUNT(*) c FROM fin_adjustments WHERE status='pending'");
            if ($r) $stats['pending_approvals'] += (int) $r->fetch_assoc()['c'];
        }
        return $stats;
    }
}

if (!function_exists('finSyncStudentsFromRegistry')) {
    /** Import active students from students_db into fin_student_accounts */
    function finSyncStudentsFromRegistry(): int {
        finEnsureSchema();
        $students = getStudentsConnection();
        $c = finConn();
        $count = 0;
        $year = date('Y') . '/' . (date('Y') + 1);
        $r = $students->query("SELECT id, index_number, full_name, phone, email FROM users WHERE role='student' AND is_active=1");
        if (!$r) return 0;
        $stmt = $c->prepare("INSERT INTO fin_student_accounts (student_id, student_name, phone, email, program, academic_year, semester, total_fees, balance, status, due_date)
            VALUES (?, ?, ?, ?, 'Nursing/Midwifery', ?, 1, 2400000, 2400000, 'unpaid', DATE_ADD(CURDATE(), INTERVAL 30 DAY))
            ON DUPLICATE KEY UPDATE student_name=VALUES(student_name), phone=VALUES(phone), email=VALUES(email)");
        while ($row = $r->fetch_assoc()) {
            $sid = $row['index_number'] ?: ('STU' . $row['id']);
            $phone = $row['phone'] ?? '';
            $email = $row['email'] ?? '';
            $name = $row['full_name'] ?? 'Student';
            $stmt->bind_param('sssss', $sid, $name, $phone, $email, $year);
            if ($stmt->execute() && $stmt->affected_rows >= 0) {
                $count++;
            }
        }
        $stmt->close();
        finLog('Sync Students', 'billing', "Synced {$count} student accounts");
        return $count;
    }
}

if (!function_exists('finGetFeeStructures')) {
    function finGetFeeStructures(): array {
        finEnsureSchema();
        $r = finConn()->query("SELECT * FROM fin_fee_structures WHERE is_active=1 ORDER BY program, academic_year, year_level");
        return $r ? $r->fetch_all(MYSQLI_ASSOC) : [];
    }
}

if (!function_exists('finSaveFeeStructure')) {
    function finSaveFeeStructure(array $d): bool {
        finEnsureSchema();
        $total = (float)$d['tuition_fee'] + (float)$d['accommodation_fee'] + (float)$d['clinical_fee']
            + (float)$d['library_fee'] + (float)$d['examination_fee'] + (float)$d['registration_fee'] + (float)$d['other_fees'];
        $stmt = finConn()->prepare("INSERT INTO fin_fee_structures (program, academic_year, year_level, semester, tuition_fee, accommodation_fee, clinical_fee, library_fee, examination_fee, registration_fee, other_fees, total_fees, created_by)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $uid = (int)($_SESSION['user_id'] ?? 0);
        $stmt->bind_param('ssiidddddddddi', $d['program'], $d['academic_year'], $d['year_level'], $d['semester'],
            $d['tuition_fee'], $d['accommodation_fee'], $d['clinical_fee'], $d['library_fee'], $d['examination_fee'], $d['registration_fee'], $d['other_fees'], $total, $uid);
        $ok = $stmt->execute();
        $stmt->close();
        if ($ok) finLog('Create Fee Structure', 'billing', $d['program']);
        return $ok;
    }
}

if (!function_exists('finAssignFeesToProgram')) {
    function finAssignFeesToProgram(int $structureId): int {
        finEnsureSchema();
        $c = finConn();
        $fs = $c->query("SELECT * FROM fin_fee_structures WHERE id={$structureId}")->fetch_assoc();
        if (!$fs) return 0;
        $n = 0;
        $stmt = $c->prepare("UPDATE fin_student_accounts SET fee_structure_id=?, program=?, tuition_fee=?, accommodation_fee=?, clinical_fee=?, other_fees=?, total_fees=?, balance=total_fees-amount_paid-waiver_amount-scholarship_amount+penalty_amount WHERE program=? AND academic_year=?");
        $other = (float)$fs['library_fee'] + (float)$fs['examination_fee'] + (float)$fs['registration_fee'] + (float)$fs['other_fees'];
        $stmt->bind_param('isddddss', $structureId, $fs['program'], $fs['tuition_fee'], $fs['accommodation_fee'], $fs['clinical_fee'], $other, $fs['total_fees'], $fs['program'], $fs['academic_year']);
        $stmt->execute();
        $n = $stmt->affected_rows;
        $stmt->close();
        finLog('Assign Fees', 'billing', "Program {$fs['program']}: {$n} accounts");
        return $n;
    }
}

if (!function_exists('finGetStudentAccounts')) {
    function finGetStudentAccounts(?string $search = null, ?string $status = null): array {
        finEnsureSchema();
        $sql = "SELECT * FROM fin_student_accounts WHERE 1=1";
        $params = [];
        $types = '';
        if ($search) {
            $sql .= " AND (student_id LIKE ? OR student_name LIKE ? OR phone LIKE ?)";
            $t = '%' . $search . '%';
            $types .= 'sss';
            $params = [$t, $t, $t];
        }
        if ($status && $status !== 'all') {
            $sql .= " AND status = ?";
            $types .= 's';
            $params[] = $status;
        }
        $sql .= " ORDER BY student_name ASC LIMIT 500";
        $stmt = finConn()->prepare($sql);
        if ($types) $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $rows;
    }
}

if (!function_exists('finGenerateInvoice')) {
    function finGenerateInvoice(int $accountId, string $termLabel): ?string {
        finEnsureSchema();
        $c = finConn();
        $acc = $c->query("SELECT * FROM fin_student_accounts WHERE id={$accountId}")->fetch_assoc();
        if (!$acc) return null;
        $invNo = 'INV' . date('Ymd') . str_pad((string)$accountId, 5, '0', STR_PAD_LEFT);
        $amt = (float) $acc['balance'];
        if ($amt <= 0) $amt = (float) $acc['total_fees'];
        $stmt = $c->prepare("INSERT INTO fin_invoices (invoice_no, student_account_id, student_id, term_label, amount, due_date, created_by) VALUES (?,?,?,?,?,DATE_ADD(CURDATE(), INTERVAL 30 DAY),?)");
        $uid = (int)($_SESSION['user_id'] ?? 0);
        $stmt->bind_param('sissdi', $invNo, $accountId, $acc['student_id'], $termLabel, $amt, $uid);
        $stmt->execute();
        $stmt->close();
        finLog('Generate Invoice', 'billing', $invNo);
        return $invNo;
    }
}

if (!function_exists('finRecordPayment')) {
    function finRecordPayment(array $d): array {
        finEnsureSchema();
        $c = finConn();
        $receipt = 'RCP' . date('YmdHis') . mt_rand(100, 999);
        $proof = $d['proof_file'] ?? null;
        $status = ($d['payment_method'] === 'cash') ? 'verified' : ($d['auto_verify'] ?? false ? 'verified' : 'pending');
        $stmt = $c->prepare("INSERT INTO fin_payments (receipt_no, student_id, student_account_id, amount, payment_method, payment_provider, payment_reference, bank_name, proof_file, notes, status, payment_date, created_by, verified_by, verified_at)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $uid = (int)($_SESSION['user_id'] ?? 0);
        $vby = $status === 'verified' ? $uid : null;
        $vat = $status === 'verified' ? date('Y-m-d H:i:s') : null;
        $acctId = (int) ($d['account_id'] ?? 0);
        $stmt->bind_param('ssidssssssssisi', $receipt, $d['student_id'], $acctId, $d['amount'], $d['payment_method'],
            $d['provider'] ?? '', $d['reference'] ?? '', $d['bank_name'] ?? '', $proof ?? '', $d['notes'] ?? '', $status, $d['payment_date'], $uid, $vby, $vat);
        if (!$stmt->execute()) {
            return ['success' => false, 'message' => $c->error];
        }
        $stmt->close();
        if ($status === 'verified') {
            finApplyPaymentToAccount($d['student_id'], (float)$d['amount']);
        }
        finLog('Record Payment', 'payments', "{$receipt} — {$d['amount']}");
        return ['success' => true, 'receipt_no' => $receipt, 'status' => $status];
    }
}

if (!function_exists('finApplyPaymentToAccount')) {
    function finApplyPaymentToAccount(string $studentId, float $amount): void {
        $c = finConn();
        $sid = $c->real_escape_string($studentId);
        $c->query("UPDATE fin_student_accounts SET
            amount_paid = amount_paid + {$amount},
            balance = GREATEST(0, total_fees - (amount_paid + {$amount}) - waiver_amount - scholarship_amount + penalty_amount),
            last_payment_date = CURDATE(),
            status = CASE WHEN (total_fees - (amount_paid + {$amount}) - waiver_amount - scholarship_amount + penalty_amount) <= 0 THEN 'cleared'
                     WHEN (amount_paid + {$amount}) > 0 THEN 'partial' ELSE status END
            WHERE student_id = '{$sid}'");
    }
}

if (!function_exists('finVerifyPayment')) {
    function finVerifyPayment(int $paymentId, bool $approve): bool {
        finEnsureSchema();
        $c = finConn();
        $p = $c->query("SELECT * FROM fin_payments WHERE id={$paymentId}")->fetch_assoc();
        if (!$p || $p['status'] !== 'pending') return false;
        $uid = (int)($_SESSION['user_id'] ?? 0);
        if ($approve) {
            $c->query("UPDATE fin_payments SET status='verified', verified_by={$uid}, verified_at=NOW() WHERE id={$paymentId}");
            finApplyPaymentToAccount($p['student_id'], (float)$p['amount']);
        } else {
            $c->query("UPDATE fin_payments SET status='rejected', verified_by={$uid}, verified_at=NOW() WHERE id={$paymentId}");
        }
        finLog($approve ? 'Verify Payment' : 'Reject Payment', 'payments', "Payment #{$paymentId}");
        return true;
    }
}

if (!function_exists('finGetRecentPayments')) {
    function finGetRecentPayments(int $limit = 15): array {
        finEnsureSchema();
        if (!finTableExists('fin_payments')) return [];
        $r = finConn()->query("SELECT p.*, a.student_name FROM fin_payments p LEFT JOIN fin_student_accounts a ON p.student_id=a.student_id ORDER BY p.created_at DESC LIMIT {$limit}");
        return $r ? $r->fetch_all(MYSQLI_ASSOC) : [];
    }
}

if (!function_exists('finGetDebtors')) {
    function finGetDebtors(): array {
        return finGetStudentAccounts(null, null);
    }
}

if (!function_exists('finGetCollectionReport')) {
    function finGetCollectionReport(string $period = 'month'): array {
        finEnsureSchema();
        $c = finConn();
        $where = match ($period) {
            'today' => "payment_date = CURDATE()",
            'week' => "payment_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)",
            default => "MONTH(payment_date)=MONTH(CURDATE()) AND YEAR(payment_date)=YEAR(CURDATE())",
        };
        $r = $c->query("SELECT payment_date, payment_method, SUM(amount) total, COUNT(*) cnt FROM fin_payments WHERE status='verified' AND {$where} GROUP BY payment_date, payment_method ORDER BY payment_date DESC");
        return $r ? $r->fetch_all(MYSQLI_ASSOC) : [];
    }
}

if (!function_exists('finGetRevenueByCategory')) {
    function finGetRevenueByCategory(): array {
        finEnsureSchema();
        $c = finConn();
        if (!finTableExists('fin_student_accounts')) return [];
        return $c->query("SELECT 'Tuition' cat, SUM(tuition_fee) amt FROM fin_student_accounts UNION ALL
            SELECT 'Accommodation', SUM(accommodation_fee) FROM fin_student_accounts UNION ALL
            SELECT 'Clinical', SUM(clinical_fee) FROM fin_student_accounts")->fetch_all(MYSQLI_ASSOC) ?: [];
    }
}

if (!function_exists('finSaveBudget')) {
    function finSaveBudget(array $d): bool {
        finEnsureSchema();
        $stmt = finConn()->prepare("INSERT INTO fin_budgets (fiscal_year, department, category, allocated_amount, term_label, created_by) VALUES (?,?,?,?,?,?)");
        $uid = (int)($_SESSION['user_id'] ?? 0);
        $stmt->bind_param('sssdsi', $d['fiscal_year'], $d['department'], $d['category'], $d['allocated_amount'], $d['term_label'] ?? '', $uid);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }
}

if (!function_exists('finGetBudgets')) {
    function finGetBudgets(): array {
        finEnsureSchema();
        $r = finConn()->query("SELECT *, (allocated_amount - spent_amount) remaining FROM fin_budgets ORDER BY fiscal_year DESC, department");
        return $r ? $r->fetch_all(MYSQLI_ASSOC) : [];
    }
}

if (!function_exists('finSaveExpense')) {
    function finSaveExpense(array $d): bool {
        finEnsureSchema();
        $stmt = finConn()->prepare("INSERT INTO fin_expenses (budget_id, description, category, amount, expense_date, department, requested_by) VALUES (?,?,?,?,?,?,?)");
        $uid = (int)($_SESSION['user_id'] ?? 0);
        $stmt->bind_param('issdssi', $d['budget_id'], $d['description'], $d['category'], $d['amount'], $d['expense_date'], $d['department'], $uid);
        $ok = $stmt->execute();
        $stmt->close();
        if ($ok) finLog('Request Expense', 'expenses', $d['description']);
        return $ok;
    }
}

if (!function_exists('finApproveExpense')) {
    function finApproveExpense(int $id, bool $approve): bool {
        finEnsureSchema();
        $uid = (int)($_SESSION['user_id'] ?? 0);
        $st = $approve ? 'approved' : 'rejected';
        finConn()->query("UPDATE fin_expenses SET status='{$st}', approved_by={$uid}, approved_at=NOW() WHERE id={$id}");
        if ($approve) {
            $e = finConn()->query("SELECT * FROM fin_expenses WHERE id={$id}")->fetch_assoc();
            if ($e && $e['budget_id']) {
                finConn()->query("UPDATE fin_budgets SET spent_amount = spent_amount + {$e['amount']} WHERE id={$e['budget_id']}");
            }
        }
        return true;
    }
}

if (!function_exists('finGetExpenses')) {
    function finGetExpenses(?string $status = null): array {
        finEnsureSchema();
        $sql = "SELECT * FROM fin_expenses";
        if ($status) $sql .= " WHERE status='" . finConn()->real_escape_string($status) . "'";
        $sql .= " ORDER BY expense_date DESC LIMIT 100";
        $r = finConn()->query($sql);
        return $r ? $r->fetch_all(MYSQLI_ASSOC) : [];
    }
}

if (!function_exists('finGetLedgerAccounts')) {
    function finGetLedgerAccounts(): array {
        finEnsureSchema();
        $r = finConn()->query("SELECT * FROM fin_chart_accounts WHERE is_active=1 ORDER BY account_code");
        return $r ? $r->fetch_all(MYSQLI_ASSOC) : [];
    }
}

if (!function_exists('finGetTrialBalance')) {
    function finGetTrialBalance(): array {
        finEnsureSchema();
        $r = finConn()->query("SELECT ca.account_code, ca.account_name, ca.account_type,
            COALESCE(SUM(le.debit),0) total_debit, COALESCE(SUM(le.credit),0) total_credit
            FROM fin_chart_accounts ca LEFT JOIN fin_ledger_entries le ON ca.id=le.account_id
            GROUP BY ca.id ORDER BY ca.account_code");
        return $r ? $r->fetch_all(MYSQLI_ASSOC) : [];
    }
}

if (!function_exists('finPostLedgerEntry')) {
    function finPostLedgerEntry(int $accountId, string $desc, float $debit, float $credit, ?string $refType = null, ?int $refId = null): bool {
        finEnsureSchema();
        $stmt = finConn()->prepare("INSERT INTO fin_ledger_entries (entry_date, account_id, description, debit, credit, reference_type, reference_id, created_by) VALUES (CURDATE(),?,?,?,?,?,?,?)");
        $uid = (int)($_SESSION['user_id'] ?? 0);
        $stmt->bind_param('isddssi', $accountId, $desc, $debit, $credit, $refType, $refId, $uid);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }
}

if (!function_exists('finGetPayrollRuns')) {
    function finGetPayrollRuns(): array {
        finEnsureSchema();
        $r = finConn()->query("SELECT * FROM fin_payroll_runs ORDER BY period_start DESC LIMIT 12");
        return $r ? $r->fetch_all(MYSQLI_ASSOC) : [];
    }
}

if (!function_exists('finGetAssets')) {
    function finGetAssets(): array {
        finEnsureSchema();
        $r = finConn()->query("SELECT * FROM fin_assets ORDER BY purchase_date DESC LIMIT 50");
        return $r ? $r->fetch_all(MYSQLI_ASSOC) : [];
    }
}

if (!function_exists('finQueueNotification')) {
    function finQueueNotification(?string $studentId, string $channel, string $subject, string $message): bool {
        finEnsureSchema();
        $stmt = finConn()->prepare("INSERT INTO fin_notifications (student_id, channel, subject, message, status, created_by) VALUES (?,?,?,?,'queued',?)");
        $uid = (int)($_SESSION['user_id'] ?? 0);
        $stmt->bind_param('ssssi', $studentId, $channel, $subject, $message, $uid);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }
}

if (!function_exists('finGetStudentFinancePortal')) {
    function finGetStudentFinancePortal(string $studentId): ?array {
        finEnsureSchema();
        $c = finConn();
        $acc = $c->query("SELECT * FROM fin_student_accounts WHERE student_id='" . $c->real_escape_string($studentId) . "' ORDER BY id DESC LIMIT 1")->fetch_assoc();
        if (!$acc) {
            finSyncStudentsFromRegistry();
            $acc = $c->query("SELECT * FROM fin_student_accounts WHERE student_id='" . $c->real_escape_string($studentId) . "' LIMIT 1")->fetch_assoc();
        }
        if (!$acc) return null;
        $payments = [];
        $r = $c->query("SELECT * FROM fin_payments WHERE student_id='" . $c->real_escape_string($studentId) . "' AND status='verified' ORDER BY payment_date DESC");
        if ($r) $payments = $r->fetch_all(MYSQLI_ASSOC);
        $structures = finGetFeeStructures();
        return ['account' => $acc, 'payments' => $payments, 'fee_structures' => $structures];
    }
}

if (!function_exists('finSaveAdjustment')) {
    function finSaveAdjustment(array $d): bool {
        finEnsureSchema();
        $stmt = finConn()->prepare("INSERT INTO fin_adjustments (student_id, adjustment_type, amount, reason, requested_by) VALUES (?,?,?,?,?)");
        $uid = (int)($_SESSION['user_id'] ?? 0);
        $stmt->bind_param('ssdsi', $d['student_id'], $d['adjustment_type'], $d['amount'], $d['reason'], $uid);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }
}

if (!function_exists('finApproveAdjustment')) {
    function finApproveAdjustment(int $id, bool $approve): bool {
        finEnsureSchema();
        $c = finConn();
        $adj = $c->query("SELECT * FROM fin_adjustments WHERE id={$id}")->fetch_assoc();
        if (!$adj || $adj['status'] !== 'pending') return false;
        $uid = (int)($_SESSION['user_id'] ?? 0);
        $st = $approve ? 'approved' : 'rejected';
        $c->query("UPDATE fin_adjustments SET status='{$st}', approved_by={$uid}, approved_at=NOW() WHERE id={$id}");
        if ($approve) {
            $col = match ($adj['adjustment_type']) {
                'waiver', 'discount' => "waiver_amount = waiver_amount + {$adj['amount']}",
                'refund' => "amount_paid = GREATEST(0, amount_paid - {$adj['amount']})",
                'penalty' => "penalty_amount = penalty_amount + {$adj['amount']}",
                default => "waiver_amount = waiver_amount + {$adj['amount']}",
            };
            $c->query("UPDATE fin_student_accounts SET {$col}, balance = GREATEST(0, total_fees - amount_paid - waiver_amount - scholarship_amount + penalty_amount) WHERE student_id='" . $c->real_escape_string($adj['student_id']) . "'");
        }
        return true;
    }
}

if (!function_exists('finCanApprove')) {
    function finCanApprove(): bool {
        $role = strtolower($_SESSION['role'] ?? '');
        return strpos($role, 'bursar') !== false || strpos($role, 'director finance') !== false || strpos($role, 'director general') !== false;
    }
}
