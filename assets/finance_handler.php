<?php
/**
 * Finance module AJAX/form handler
 */
require_once __DIR__ . '/../includes/staff_dashboard_access.php';
require_once __DIR__ . '/../includes/finance_module.php';

bootstrapStaffDashboard(['bursar', 'finance', 'accountant', 'school bursar', 'director finance']);

finEnsureSchema();
$action = $_POST['action'] ?? $_GET['action'] ?? '';
$redirect = $_POST['redirect'] ?? '../dashboards/bursar-finance-hub.php';

function finRedirect(string $url, ?string $msg = null, string $type = 'success'): void {
    if ($msg) $_SESSION[$type] = $msg;
    header('Location: ' . $url);
    exit;
}

switch ($action) {
    case 'sync_students':
        $n = finSyncStudentsFromRegistry();
        finRedirect($redirect, "Synced {$n} student accounts.");
        break;

    case 'save_fee_structure':
        finSaveFeeStructure([
            'program' => $_POST['program'] ?? '',
            'academic_year' => $_POST['academic_year'] ?? date('Y') . '/' . (date('Y') + 1),
            'year_level' => (int)($_POST['year_level'] ?? 1),
            'semester' => (int)($_POST['semester'] ?? 1),
            'tuition_fee' => (float)($_POST['tuition_fee'] ?? 0),
            'accommodation_fee' => (float)($_POST['accommodation_fee'] ?? 0),
            'clinical_fee' => (float)($_POST['clinical_fee'] ?? 0),
            'library_fee' => (float)($_POST['library_fee'] ?? 0),
            'examination_fee' => (float)($_POST['examination_fee'] ?? 0),
            'registration_fee' => (float)($_POST['registration_fee'] ?? 0),
            'other_fees' => (float)($_POST['other_fees'] ?? 0),
        ]);
        finRedirect($redirect . '#billing', 'Fee structure saved.');
        break;

    case 'assign_fees':
        $n = finAssignFeesToProgram((int)($_POST['structure_id'] ?? 0));
        finRedirect($redirect . '#billing', "Fees assigned to {$n} students.");
        break;

    case 'generate_invoice':
        $inv = finGenerateInvoice((int)($_POST['account_id'] ?? 0), $_POST['term_label'] ?? 'Semester 1');
        finRedirect($redirect . '#billing', $inv ? "Invoice {$inv} generated." : 'Could not generate invoice.', $inv ? 'success' : 'error');
        break;

    case 'record_payment':
        $proofPath = null;
        if (!empty($_FILES['proof_file']['name']) && $_FILES['proof_file']['error'] === UPLOAD_ERR_OK) {
            $dir = __DIR__ . '/../uploads/payment_proofs/';
            if (!is_dir($dir)) mkdir($dir, 0755, true);
            $ext = pathinfo($_FILES['proof_file']['name'], PATHINFO_EXTENSION);
            $proofPath = 'uploads/payment_proofs/' . uniqid('proof_') . '.' . $ext;
            move_uploaded_file($_FILES['proof_file']['tmp_name'], __DIR__ . '/../' . $proofPath);
        }
        $res = finRecordPayment([
            'student_id' => $_POST['student_id'] ?? '',
            'account_id' => (int)($_POST['account_id'] ?? 0),
            'amount' => (float)($_POST['amount'] ?? 0),
            'payment_method' => $_POST['payment_method'] ?? 'cash',
            'provider' => $_POST['provider'] ?? null,
            'reference' => $_POST['reference'] ?? null,
            'bank_name' => $_POST['bank_name'] ?? null,
            'payment_date' => $_POST['payment_date'] ?? date('Y-m-d'),
            'notes' => $_POST['notes'] ?? null,
            'proof_file' => $proofPath,
            'auto_verify' => ($_POST['payment_method'] ?? '') === 'cash',
        ]);
        finRedirect($redirect . '#payments', $res['success'] ? 'Payment recorded. Receipt: ' . $res['receipt_no'] : ($res['message'] ?? 'Failed'), $res['success'] ? 'success' : 'error');
        break;

    case 'verify_payment':
        if (!finCanApprove()) finRedirect($redirect, 'No approval permission.', 'error');
        finVerifyPayment((int)($_POST['payment_id'] ?? 0), ($_POST['decision'] ?? '') === 'approve');
        finRedirect($redirect . '#payments', 'Payment updated.');
        break;

    case 'save_adjustment':
        finSaveAdjustment([
            'student_id' => $_POST['student_id'] ?? '',
            'adjustment_type' => $_POST['adjustment_type'] ?? 'discount',
            'amount' => (float)($_POST['amount'] ?? 0),
            'reason' => $_POST['reason'] ?? '',
        ]);
        finRedirect($redirect . '#billing', 'Adjustment submitted for approval.');
        break;

    case 'approve_adjustment':
        if (!finCanApprove()) finRedirect($redirect, 'No approval permission.', 'error');
        finApproveAdjustment((int)($_POST['adjustment_id'] ?? 0), ($_POST['decision'] ?? '') === 'approve');
        finRedirect($redirect . '#billing', 'Adjustment processed.');
        break;

    case 'save_budget':
        finSaveBudget([
            'fiscal_year' => $_POST['fiscal_year'] ?? date('Y'),
            'department' => $_POST['department'] ?? '',
            'category' => $_POST['category'] ?? '',
            'allocated_amount' => (float)($_POST['allocated_amount'] ?? 0),
            'term_label' => $_POST['term_label'] ?? '',
        ]);
        finRedirect($redirect . '#budget', 'Budget created.');
        break;

    case 'save_expense':
        finSaveExpense([
            'budget_id' => (int)($_POST['budget_id'] ?? 0) ?: null,
            'description' => $_POST['description'] ?? '',
            'category' => $_POST['category'] ?? '',
            'amount' => (float)($_POST['amount'] ?? 0),
            'expense_date' => $_POST['expense_date'] ?? date('Y-m-d'),
            'department' => $_POST['department'] ?? '',
        ]);
        finRedirect($redirect . '#expenses', 'Expense submitted for approval.');
        break;

    case 'approve_expense':
        if (!finCanApprove()) finRedirect($redirect, 'No approval permission.', 'error');
        finApproveExpense((int)($_POST['expense_id'] ?? 0), ($_POST['decision'] ?? '') === 'approve');
        finRedirect($redirect . '#expenses', 'Expense updated.');
        break;

    case 'send_reminder':
        $sid = $_POST['student_id'] ?? null;
        $ch = $_POST['channel'] ?? 'sms';
        finQueueNotification($sid, $ch, 'Fee Reminder — ISNM', $_POST['message'] ?? 'Please clear your outstanding fees.');
        finRedirect($redirect . '#communications', 'Reminder queued.');
        break;

    case 'broadcast':
        finQueueNotification(null, $_POST['channel'] ?? 'system', $_POST['subject'] ?? 'ISNM Finance', $_POST['message'] ?? '');
        finRedirect($redirect . '#communications', 'Broadcast queued.');
        break;

    default:
        if (isset($_GET['export']) && $_GET['export'] === 'collections') {
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename="collections_' . date('Y-m-d') . '.csv"');
            $out = fopen('php://output', 'w');
            fprintf($out, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($out, ['Date', 'Method', 'Total', 'Count']);
            foreach (finGetCollectionReport($_GET['period'] ?? 'month') as $row) {
                fputcsv($out, [$row['payment_date'], $row['payment_method'], $row['total'], $row['cnt']]);
            }
            fclose($out);
            exit;
        }
        finRedirect($redirect, 'Unknown action.', 'error');
}
