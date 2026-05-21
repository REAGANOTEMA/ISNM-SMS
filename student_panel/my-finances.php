<?php
/**
 * Student Financial Self-Service Portal
 */
require_once __DIR__ . '/../auth-service.php';
require_once __DIR__ . '/../includes/finance_module.php';

if (session_status() === PHP_SESSION_NONE) session_start();
$auth = new AuthenticationService();
if (!$auth->isAuthenticated() || ($_SESSION['type'] ?? '') !== 'student') {
    header('Location: ../student-login.php');
    exit;
}

finEnsureSchema();
$indexNumber = $_SESSION['index_number'] ?? $_SESSION['user_id'] ?? '';
if (empty($indexNumber) && !empty($_SESSION['email'])) {
    $sc = getStudentsConnection();
    $st = $sc->prepare("SELECT index_number FROM users WHERE email = ? AND role='student' LIMIT 1");
    $st->bind_param('s', $_SESSION['email']);
    $st->execute();
    $row = $st->get_result()->fetch_assoc();
    $indexNumber = $row['index_number'] ?? '';
    $st->close();
}

$finance = finGetStudentFinancePortal((string) $indexNumber);
$acc = $finance['account'] ?? null;
$payments = $finance['payments'] ?? [];
$structures = $finance['fee_structures'] ?? [];
$studentName = $_SESSION['full_name'] ?? 'Student';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Finances — ISNM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #f5f7fa, #e8ecf4); min-height: 100vh; }
        .fin-header { background: linear-gradient(135deg, #1a237e, #3949ab); color: #fff; padding: 2rem 0; }
        .fin-header img { width: 64px; height: 64px; border-radius: 50%; border: 3px solid #c9a227; background: #fff; padding: 4px; }
        .balance-card { border-radius: 16px; border: none; box-shadow: 0 8px 24px rgba(26,35,126,.12); }
        .balance-card .big { font-size: 2rem; font-weight: 700; }
    </style>
</head>
<body>
<header class="fin-header text-center">
    <img src="../images/school-logo.png" alt="ISNM" class="mb-2">
    <h1 class="h4 mb-0">My Finances</h1>
    <p class="mb-0 opacity-75"><?php echo htmlspecialchars($studentName); ?></p>
</header>
<div class="container py-4">
    <div class="mb-3">
        <a href="index.php" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-left"></i> Back to Portal</a>
    </div>
    <?php if (!$acc): ?>
    <div class="alert alert-info">Your fee account is being set up. Please contact the bursar's office.</div>
    <?php else: ?>
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card balance-card p-4 text-center h-100">
                <div class="text-muted small">Total Fees</div>
                <div class="big text-primary"><?php echo finFormatUgx($acc['total_fees']); ?></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card balance-card p-4 text-center h-100">
                <div class="text-muted small">Amount Paid</div>
                <div class="big text-success"><?php echo finFormatUgx($acc['amount_paid']); ?></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card balance-card p-4 text-center h-100 border-danger">
                <div class="text-muted small">Balance Due</div>
                <div class="big text-danger"><?php echo finFormatUgx($acc['balance']); ?></div>
                <span class="badge bg-secondary mt-2"><?php echo htmlspecialchars($acc['status']); ?></span>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
            <strong><i class="fas fa-file-invoice-dollar"></i> Financial Statement</strong>
            <div class="btn-group btn-group-sm">
                <a href="../dashboards/bursar_statement.php?student_id=<?php echo urlencode($acc['student_id']); ?>" class="btn btn-outline-primary" target="_blank"><i class="fas fa-eye"></i> View</a>
                <a href="../dashboards/bursar_statement.php?student_id=<?php echo urlencode($acc['student_id']); ?>&amp;autoprint=1" class="btn btn-outline-dark" target="_blank"><i class="fas fa-print"></i> Print</a>
                <a href="../dashboards/bursar_statement_export.php?student_id=<?php echo urlencode($acc['student_id']); ?>" class="btn btn-outline-success"><i class="fas fa-file-excel"></i> Excel</a>
            </div>
        </div>
        <div class="card-body">
            <p class="mb-0"><strong>Admission No:</strong> <?php echo htmlspecialchars($acc['student_id']); ?> |
            <strong>Program:</strong> <?php echo htmlspecialchars($acc['program'] ?? '—'); ?></p>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header bg-white"><strong><i class="fas fa-receipt"></i> Payment History &amp; Receipts</strong></div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light"><tr><th>Date</th><th>Receipt</th><th>Amount</th><th>Method</th></tr></thead>
                <tbody>
                <?php if (empty($payments)): ?>
                <tr><td colspan="4" class="text-muted text-center py-4">No payments recorded yet.</td></tr>
                <?php else: foreach ($payments as $p): ?>
                <tr>
                    <td><?php echo date('d M Y', strtotime($p['payment_date'])); ?></td>
                    <td><?php echo htmlspecialchars($p['receipt_no'] ?? '—'); ?></td>
                    <td><?php echo finFormatUgx($p['amount'] ?? $p['amount_paid'] ?? 0); ?></td>
                    <td><?php echo htmlspecialchars(ucfirst($p['payment_method'] ?? '')); ?></td>
                </tr>
                <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header bg-white"><strong><i class="fas fa-list"></i> Fee Structure (Reference)</strong></div>
        <div class="card-body p-0">
            <table class="table table-sm mb-0">
                <thead><tr><th>Program</th><th>Year</th><th>Tuition</th><th>Hostel</th><th>Clinical</th><th>Total</th></tr></thead>
                <tbody>
                <?php foreach ($structures as $fs): ?>
                <tr>
                    <td><?php echo htmlspecialchars($fs['program']); ?></td>
                    <td><?php echo htmlspecialchars($fs['academic_year']); ?></td>
                    <td><?php echo number_format($fs['tuition_fee']); ?></td>
                    <td><?php echo number_format($fs['accommodation_fee']); ?></td>
                    <td><?php echo number_format($fs['clinical_fee']); ?></td>
                    <td><strong><?php echo finFormatUgx($fs['total_fees']); ?></strong></td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($structures)): ?><tr><td colspan="6" class="text-muted">Contact bursar for fee details.</td></tr><?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card border-primary">
        <div class="card-body">
            <h6><i class="fas fa-credit-card"></i> Pay Online</h6>
            <p class="small text-muted">Mobile money (MTN / Airtel) and bank payments will be available when the gateway is configured by the institution.</p>
            <a href="fee-payment.php" class="btn btn-primary btn-sm"><i class="fas fa-money-bill"></i> Fee Payment Page</a>
        </div>
    </div>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
