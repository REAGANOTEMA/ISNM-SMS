<?php
/**
 * ISNM Bursar Finance Hub — full financial management dashboard
 */
require_once __DIR__ . '/../includes/staff_dashboard_access.php';
require_once __DIR__ . '/../includes/finance_module.php';
require_once __DIR__ . '/../includes/bursar_finance.php';

$ctx = bootstrapStaffDashboard(['bursar', 'finance', 'accountant', 'school bursar', 'director finance']);
finEnsureSchema();

$user = $ctx['user'];
$user_name = $user['full_name'] ?? $_SESSION['full_name'] ?? 'Bursar';
$canApprove = finCanApprove();

$stats = finDashboardStats();
$feeStructures = finGetFeeStructures();
$accounts = finGetStudentAccounts($_GET['q'] ?? null, $_GET['status'] ?? null);
$recentPayments = finGetRecentPayments(12);
$pendingPayments = finConn()->query("SELECT p.*, a.student_name FROM fin_payments p LEFT JOIN fin_student_accounts a ON p.student_id=a.student_id WHERE p.status='pending' ORDER BY p.created_at DESC LIMIT 20")->fetch_all(MYSQLI_ASSOC) ?: [];
$debtors = array_filter($accounts, fn($a) => (float)($a['balance'] ?? 0) > 0);
$budgets = finGetBudgets();
$expenses = finGetExpenses();
$pendingExpenses = finGetExpenses('pending');
$ledgerAccounts = finGetLedgerAccounts();
$trialBalance = finGetTrialBalance();
$payrollRuns = finGetPayrollRuns();
$assets = finGetAssets();
$revenueByCat = finGetRevenueByCategory();
$collectionMonth = finGetCollectionReport('month');
$stmt_search = trim($_GET['stmt_search'] ?? '');
$statement_accounts = bursarGetStatementAccounts($stmt_search !== '' ? $stmt_search : null, $_GET['stmt_search_by'] ?? 'all');
$statements_section_hidden = false;

$adjustments = finConn()->query("SELECT * FROM fin_adjustments WHERE status='pending' ORDER BY created_at DESC LIMIT 20")->fetch_all(MYSQLI_ASSOC) ?: [];
$scholarships = finConn()->query("SELECT * FROM fin_scholarships WHERE is_active=1")->fetch_all(MYSQLI_ASSOC) ?: [];

$pageTitle = 'Bursar Finance Hub — ISNM';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="dashboard-style.css" rel="stylesheet">
    <style>
        :root { --fin-navy: #1a237e; --fin-gold: #c9a227; }
        body { background: #f0f2f8; }
        .fin-sidebar { width: 270px; min-height: 100vh; background: linear-gradient(180deg, var(--fin-navy), #283593); color: #fff; position: fixed; left: 0; top: 0; z-index: 100; overflow-y: auto; }
        .fin-main { margin-left: 270px; padding: 1.5rem; }
        .fin-sidebar .logo-box { text-align: center; padding: 1.5rem 1rem; border-bottom: 1px solid rgba(255,255,255,.15); }
        .fin-sidebar .logo-box img { width: 72px; height: 72px; border-radius: 50%; border: 3px solid var(--fin-gold); background: #fff; padding: 4px; object-fit: contain; }
        .fin-nav a { color: rgba(255,255,255,.85); text-decoration: none; padding: .6rem 1.2rem; display: block; font-size: .9rem; border-left: 3px solid transparent; }
        .fin-nav a:hover, .fin-nav a.active { background: rgba(255,255,255,.1); color: #fff; border-left-color: var(--fin-gold); }
        .fin-nav a i { width: 22px; }
        .stat-card-fin { background: #fff; border-radius: 12px; padding: 1.25rem; box-shadow: 0 2px 12px rgba(0,0,0,.06); border-left: 4px solid var(--fin-navy); height: 100%; }
        .stat-card-fin .val { font-size: 1.5rem; font-weight: 700; color: var(--fin-navy); }
        .alert-banner { border-radius: 10px; }
        .section-panel { background: #fff; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 2px 12px rgba(0,0,0,.06); display: none; }
        .section-panel.active { display: block; }
        .badge-pending { background: #fef3c7; color: #92400e; }
        @media (max-width: 992px) { .fin-sidebar { width: 100%; position: relative; min-height: auto; } .fin-main { margin-left: 0; } }
        @media print { .fin-sidebar, .no-print { display: none !important; } .fin-main { margin-left: 0; } }
    </style>
</head>
<body>
<aside class="fin-sidebar no-print">
    <div class="logo-box">
        <img src="../images/school-logo.png" alt="ISNM">
        <h5 class="mt-2 mb-0">Finance Hub</h5>
        <small><?php echo htmlspecialchars($user_name); ?></small>
    </div>
    <nav class="fin-nav py-2">
        <a href="#overview" class="active" data-section="overview"><i class="fas fa-chart-pie"></i> Overview</a>
        <a href="#billing" data-section="billing"><i class="fas fa-file-invoice-dollar"></i> Billing &amp; Fees</a>
        <a href="#payments" data-section="payments"><i class="fas fa-money-bill-wave"></i> Payments</a>
        <a href="#statements" data-section="statements"><i class="fas fa-file-alt"></i> Statements</a>
        <a href="#reports" data-section="reports"><i class="fas fa-chart-bar"></i> Reports</a>
        <a href="#budget" data-section="budget"><i class="fas fa-wallet"></i> Budgeting</a>
        <a href="#expenses" data-section="expenses"><i class="fas fa-receipt"></i> Expenditure</a>
        <a href="#payroll" data-section="payroll"><i class="fas fa-users-cog"></i> Payroll</a>
        <a href="#ledger" data-section="ledger"><i class="fas fa-book"></i> Ledger</a>
        <a href="#inventory" data-section="inventory"><i class="fas fa-boxes"></i> Assets</a>
        <a href="#communications" data-section="communications"><i class="fas fa-envelope"></i> Communications</a>
        <a href="#integrations" data-section="integrations"><i class="fas fa-plug"></i> Integrations</a>
        <hr class="border-secondary opacity-25 mx-3">
        <a href="../organogram.php"><i class="fas fa-sitemap"></i> Organogram</a>
        <a href="../logout.php" class="text-warning"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </nav>
</aside>

<main class="fin-main">
    <?php if (!empty($_SESSION['success'])): ?>
    <div class="alert alert-success alert-dismissible"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    <?php endif; ?>
    <?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-danger alert-dismissible"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    <?php endif; ?>

    <!-- 1. OVERVIEW -->
    <div id="overview" class="section-panel active">
        <h2 class="h4 mb-4"><i class="fas fa-chart-pie text-primary"></i> Financial Overview</h2>
        <?php if ($stats['pending_payments'] > 0 || $stats['overdue_count'] > 0): ?>
        <div class="alert alert-warning alert-banner mb-4">
            <strong><i class="fas fa-bell"></i> Alerts:</strong>
            <?php if ($stats['pending_payments']): ?> <?php echo $stats['pending_payments']; ?> payment(s) awaiting verification. <?php endif; ?>
            <?php if ($stats['overdue_count']): ?> <?php echo $stats['overdue_count']; ?> overdue account(s). <?php endif; ?>
            <?php if ($stats['pending_approvals']): ?> <?php echo $stats['pending_approvals']; ?> pending approval(s). <?php endif; ?>
        </div>
        <?php endif; ?>
        <div class="row g-3 mb-4">
            <div class="col-md-3 col-6"><div class="stat-card-fin"><div class="text-muted small">Today</div><div class="val"><?php echo finFormatUgx($stats['today_collections']); ?></div></div></div>
            <div class="col-md-3 col-6"><div class="stat-card-fin"><div class="text-muted small">This Week</div><div class="val"><?php echo finFormatUgx($stats['week_collections']); ?></div></div></div>
            <div class="col-md-3 col-6"><div class="stat-card-fin"><div class="text-muted small">This Month</div><div class="val"><?php echo finFormatUgx($stats['month_collections']); ?></div></div></div>
            <div class="col-md-3 col-6"><div class="stat-card-fin border-danger"><div class="text-muted small">Outstanding</div><div class="val text-danger"><?php echo finFormatUgx($stats['outstanding_fees']); ?></div></div></div>
        </div>
        <div class="row g-3">
            <div class="col-md-4"><div class="stat-card-fin"><div class="text-muted small">Total Students</div><div class="val"><?php echo number_format($stats['total_students']); ?></div></div></div>
            <div class="col-md-4"><div class="stat-card-fin"><div class="text-muted small">Cleared</div><div class="val text-success"><?php echo number_format($stats['cleared_students']); ?></div></div></div>
            <div class="col-md-4"><div class="stat-card-fin"><div class="text-muted small">Not Cleared</div><div class="val text-warning"><?php echo number_format($stats['not_cleared_students']); ?></div></div></div>
        </div>
        <div class="mt-4">
            <h5>Recent Transactions</h5>
            <div class="table-responsive">
                <table class="table table-sm table-hover">
                    <thead><tr><th>Receipt</th><th>Student</th><th>Amount</th><th>Method</th><th>Date</th><th>Status</th></tr></thead>
                    <tbody>
                    <?php foreach ($recentPayments as $p): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($p['receipt_no']); ?></td>
                        <td><?php echo htmlspecialchars($p['student_name'] ?? $p['student_id']); ?></td>
                        <td><?php echo finFormatUgx($p['amount']); ?></td>
                        <td><?php echo htmlspecialchars($p['payment_method']); ?></td>
                        <td><?php echo htmlspecialchars($p['payment_date']); ?></td>
                        <td><span class="badge bg-<?php echo $p['status']==='verified'?'success':($p['status']==='pending'?'warning':'danger'); ?>"><?php echo $p['status']; ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($recentPayments)): ?><tr><td colspan="6" class="text-muted">No payments yet. <a href="?#payments">Record payment</a></td></tr><?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- 2. BILLING -->
    <div id="billing" class="section-panel">
        <h2 class="h4 mb-3"><i class="fas fa-file-invoice-dollar"></i> Student Billing &amp; Fees</h2>
        <div class="d-flex flex-wrap gap-2 mb-4 no-print">
            <form method="post" action="../assets/finance_handler.php" class="d-inline"><input type="hidden" name="action" value="sync_students"><button class="btn btn-outline-primary btn-sm"><i class="fas fa-sync"></i> Sync Students from Registry</button></form>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#feeStructureModal"><i class="fas fa-plus"></i> Fee Structure</button>
            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#adjustmentModal"><i class="fas fa-percent"></i> Adjustment</button>
        </div>
        <div class="row">
            <div class="col-lg-5 mb-4">
                <h6>Fee Structures</h6>
                <table class="table table-sm">
                    <thead><tr><th>Program</th><th>Year</th><th>Total</th><th></th></tr></thead>
                    <tbody>
                    <?php foreach ($feeStructures as $fs): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($fs['program']); ?></td>
                        <td><?php echo htmlspecialchars($fs['academic_year']); ?></td>
                        <td><?php echo finFormatUgx($fs['total_fees']); ?></td>
                        <td>
                            <form method="post" action="../assets/finance_handler.php" class="d-inline">
                                <input type="hidden" name="action" value="assign_fees">
                                <input type="hidden" name="structure_id" value="<?php echo (int)$fs['id']; ?>">
                                <button class="btn btn-sm btn-outline-success">Assign</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-7">
                <h6>Student Accounts <span class="badge bg-secondary"><?php echo count($accounts); ?></span></h6>
                <div class="table-responsive" style="max-height:400px;overflow:auto">
                    <table class="table table-sm table-hover">
                        <thead><tr><th>ID</th><th>Name</th><th>Total</th><th>Paid</th><th>Balance</th><th>Status</th><th></th></tr></thead>
                        <tbody>
                        <?php foreach (array_slice($accounts, 0, 50) as $a): ?>
                        <tr>
                            <td><small><?php echo htmlspecialchars($a['student_id']); ?></small></td>
                            <td><?php echo htmlspecialchars($a['student_name']); ?></td>
                            <td><?php echo number_format($a['total_fees']); ?></td>
                            <td><?php echo number_format($a['amount_paid']); ?></td>
                            <td class="text-danger fw-bold"><?php echo number_format($a['balance']); ?></td>
                            <td><span class="badge badge-pending"><?php echo $a['status']; ?></span></td>
                            <td>
                                <form method="post" action="../assets/finance_handler.php" class="d-inline">
                                    <input type="hidden" name="action" value="generate_invoice">
                                    <input type="hidden" name="account_id" value="<?php echo (int)$a['id']; ?>">
                                    <input type="hidden" name="term_label" value="Semester <?php echo (int)$a['semester']; ?>">
                                    <button class="btn btn-sm btn-outline-primary" title="Invoice"><i class="fas fa-file-invoice"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php if ($adjustments): ?>
        <h6 class="mt-3">Pending Adjustments (discounts / waivers / refunds)</h6>
        <table class="table table-sm"><thead><tr><th>Student</th><th>Type</th><th>Amount</th><th>Reason</th><?php if ($canApprove): ?><th>Action</th><?php endif; ?></tr></thead>
        <tbody>
        <?php foreach ($adjustments as $adj): ?>
        <tr>
            <td><?php echo htmlspecialchars($adj['student_id']); ?></td>
            <td><?php echo $adj['adjustment_type']; ?></td>
            <td><?php echo finFormatUgx($adj['amount']); ?></td>
            <td><?php echo htmlspecialchars($adj['reason'] ?? ''); ?></td>
            <?php if ($canApprove): ?>
            <td>
                <form method="post" action="../assets/finance_handler.php" class="d-inline"><input type="hidden" name="action" value="approve_adjustment"><input type="hidden" name="adjustment_id" value="<?php echo (int)$adj['id']; ?>"><input type="hidden" name="decision" value="approve"><button class="btn btn-sm btn-success">✓</button></form>
                <form method="post" action="../assets/finance_handler.php" class="d-inline"><input type="hidden" name="action" value="approve_adjustment"><input type="hidden" name="adjustment_id" value="<?php echo (int)$adj['id']; ?>"><input type="hidden" name="decision" value="reject"><button class="btn btn-sm btn-danger">✗</button></form>
            </td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
        </tbody></table>
        <?php endif; ?>
    </div>

    <!-- 3. PAYMENTS -->
    <div id="payments" class="section-panel">
        <h2 class="h4 mb-3"><i class="fas fa-money-bill-wave"></i> Payment Processing</h2>
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#paymentModal"><i class="fas fa-plus"></i> Record Payment</button>
        <?php if ($pendingPayments): ?>
        <h6>Pending Verification</h6>
        <table class="table table-sm mb-4">
            <thead><tr><th>Receipt</th><th>Student</th><th>Amount</th><th>Method</th><th>Date</th><?php if ($canApprove): ?><th>Approve</th><?php endif; ?></tr></thead>
            <tbody>
            <?php foreach ($pendingPayments as $p): ?>
            <tr>
                <td><?php echo htmlspecialchars($p['receipt_no']); ?></td>
                <td><?php echo htmlspecialchars($p['student_name'] ?? $p['student_id']); ?></td>
                <td><?php echo finFormatUgx($p['amount']); ?></td>
                <td><?php echo htmlspecialchars($p['payment_method']); ?></td>
                <td><?php echo $p['payment_date']; ?></td>
                <?php if ($canApprove): ?>
                <td>
                    <form method="post" action="../assets/finance_handler.php" class="d-inline"><input type="hidden" name="action" value="verify_payment"><input type="hidden" name="payment_id" value="<?php echo (int)$p['id']; ?>"><input type="hidden" name="decision" value="approve"><button class="btn btn-sm btn-success">Verify</button></form>
                    <form method="post" action="../assets/finance_handler.php" class="d-inline"><input type="hidden" name="action" value="verify_payment"><input type="hidden" name="payment_id" value="<?php echo (int)$p['id']; ?>"><input type="hidden" name="decision" value="reject"><button class="btn btn-sm btn-outline-danger">Reject</button></form>
                </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
        <p class="text-muted small"><i class="fas fa-mobile-alt"></i> Mobile money (MTN/Airtel) &amp; bank integrations — configure under Integrations tab.</p>
    </div>

    <!-- 4. STATEMENTS -->
    <div id="statements" class="section-panel">
        <?php include __DIR__ . '/partials/bursar_statements_section.php'; ?>
    </div>

    <!-- 5. REPORTS -->
    <div id="reports" class="section-panel">
        <h2 class="h4 mb-3"><i class="fas fa-chart-bar"></i> Financial Reports</h2>
        <div class="d-flex gap-2 mb-3 no-print">
            <a href="../assets/finance_handler.php?action=export&export=collections&period=month" class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i> Collections (Excel)</a>
            <a href="bursar_statement_export.php?all=1" class="btn btn-outline-success btn-sm"><i class="fas fa-file-excel"></i> All Statements</a>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h6>Monthly Collections</h6>
                <table class="table table-sm"><thead><tr><th>Date</th><th>Method</th><th>Total</th><th>Count</th></tr></thead>
                <tbody>
                <?php foreach ($collectionMonth as $r): ?>
                <tr><td><?php echo $r['payment_date']; ?></td><td><?php echo $r['payment_method']; ?></td><td><?php echo finFormatUgx($r['total']); ?></td><td><?php echo $r['cnt']; ?></td></tr>
                <?php endforeach; ?>
                </tbody></table>
            </div>
            <div class="col-md-6">
                <h6>Revenue by Category</h6>
                <table class="table table-sm"><thead><tr><th>Category</th><th>Amount</th></tr></thead>
                <tbody>
                <?php foreach ($revenueByCat as $r): ?>
                <tr><td><?php echo htmlspecialchars($r['cat']); ?></td><td><?php echo finFormatUgx($r['amt']); ?></td></tr>
                <?php endforeach; ?>
                </tbody></table>
                <h6 class="mt-3">Debtors (<?php echo count($debtors); ?>)</h6>
                <div style="max-height:200px;overflow:auto">
                    <table class="table table-sm"><thead><tr><th>Student</th><th>Balance</th></tr></thead>
                    <tbody>
                    <?php foreach (array_slice($debtors, 0, 15) as $d): ?>
                    <tr><td><?php echo htmlspecialchars($d['student_name']); ?></td><td class="text-danger"><?php echo finFormatUgx($d['balance']); ?></td></tr>
                    <?php endforeach; ?>
                    </tbody></table>
                </div>
            </div>
        </div>
    </div>

    <!-- 6. BUDGET -->
    <div id="budget" class="section-panel">
        <h2 class="h4 mb-3"><i class="fas fa-wallet"></i> Budgeting</h2>
        <button class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#budgetModal"><i class="fas fa-plus"></i> Create Budget</button>
        <table class="table table-sm"><thead><tr><th>Year</th><th>Department</th><th>Category</th><th>Allocated</th><th>Spent</th><th>Remaining</th></tr></thead>
        <tbody>
        <?php foreach ($budgets as $b): ?>
        <tr>
            <td><?php echo htmlspecialchars($b['fiscal_year']); ?></td>
            <td><?php echo htmlspecialchars($b['department']); ?></td>
            <td><?php echo htmlspecialchars($b['category']); ?></td>
            <td><?php echo finFormatUgx($b['allocated_amount']); ?></td>
            <td><?php echo finFormatUgx($b['spent_amount']); ?></td>
            <td><?php echo finFormatUgx($b['remaining'] ?? ($b['allocated_amount'] - $b['spent_amount'])); ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody></table>
    </div>

    <!-- 7. EXPENSES -->
    <div id="expenses" class="section-panel">
        <h2 class="h4 mb-3"><i class="fas fa-receipt"></i> Expenditure</h2>
        <button class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#expenseModal"><i class="fas fa-plus"></i> New Expense</button>
        <table class="table table-sm"><thead><tr><th>Date</th><th>Description</th><th>Category</th><th>Amount</th><th>Status</th><?php if ($canApprove): ?><th></th><?php endif; ?></tr></thead>
        <tbody>
        <?php foreach ($expenses as $e): ?>
        <tr>
            <td><?php echo $e['expense_date']; ?></td>
            <td><?php echo htmlspecialchars($e['description']); ?></td>
            <td><?php echo htmlspecialchars($e['category']); ?></td>
            <td><?php echo finFormatUgx($e['amount']); ?></td>
            <td><?php echo $e['status']; ?></td>
            <?php if ($canApprove && $e['status']==='pending'): ?>
            <td>
                <form method="post" action="../assets/finance_handler.php" class="d-inline"><input type="hidden" name="action" value="approve_expense"><input type="hidden" name="expense_id" value="<?php echo (int)$e['id']; ?>"><input type="hidden" name="decision" value="approve"><button class="btn btn-sm btn-success">Approve</button></form>
            </td>
            <?php else: ?><td></td><?php endif; ?>
        </tr>
        <?php endforeach; ?>
        </tbody></table>
    </div>

    <!-- 8. PAYROLL -->
    <div id="payroll" class="section-panel">
        <h2 class="h4 mb-3"><i class="fas fa-users-cog"></i> Payroll</h2>
        <p class="text-muted">Staff salary runs, allowances, deductions, and payslip generation.</p>
        <a href="bursar-payroll.php" class="btn btn-outline-primary btn-sm"><i class="fas fa-external-link-alt"></i> Open Payroll Module</a>
        <table class="table table-sm mt-3"><thead><tr><th>Period</th><th>Gross</th><th>Net</th><th>Status</th></tr></thead>
        <tbody>
        <?php foreach ($payrollRuns as $pr): ?>
        <tr><td><?php echo htmlspecialchars($pr['period_label']); ?></td><td><?php echo finFormatUgx($pr['total_gross']); ?></td><td><?php echo finFormatUgx($pr['total_net']); ?></td><td><?php echo $pr['status']; ?></td></tr>
        <?php endforeach; ?>
        <?php if (empty($payrollRuns)): ?><tr><td colspan="4" class="text-muted">No payroll runs yet.</td></tr><?php endif; ?>
        </tbody></table>
    </div>

    <!-- 9. LEDGER -->
    <div id="ledger" class="section-panel">
        <h2 class="h4 mb-3"><i class="fas fa-book"></i> Accounts &amp; Ledger</h2>
        <div class="row">
            <div class="col-md-5"><h6>Chart of Accounts</h6>
                <table class="table table-sm"><thead><tr><th>Code</th><th>Name</th><th>Type</th></tr></thead>
                <tbody><?php foreach ($ledgerAccounts as $la): ?>
                <tr><td><?php echo $la['account_code']; ?></td><td><?php echo htmlspecialchars($la['account_name']); ?></td><td><?php echo $la['account_type']; ?></td></tr>
                <?php endforeach; ?></tbody></table>
            </div>
            <div class="col-md-7"><h6>Trial Balance</h6>
                <table class="table table-sm"><thead><tr><th>Account</th><th>Debit</th><th>Credit</th></tr></thead>
                <tbody><?php foreach ($trialBalance as $tb): ?>
                <tr><td><?php echo htmlspecialchars($tb['account_name']); ?></td><td><?php echo number_format($tb['total_debit']); ?></td><td><?php echo number_format($tb['total_credit']); ?></td></tr>
                <?php endforeach; ?></tbody></table>
            </div>
        </div>
    </div>

    <!-- 10. INVENTORY -->
    <div id="inventory" class="section-panel">
        <h2 class="h4 mb-3"><i class="fas fa-boxes"></i> Inventory &amp; Assets</h2>
        <table class="table table-sm"><thead><tr><th>Asset</th><th>Category</th><th>Purchase</th><th>Amount</th><th>Status</th></tr></thead>
        <tbody>
        <?php foreach ($assets as $as): ?>
        <tr><td><?php echo htmlspecialchars($as['asset_name']); ?></td><td><?php echo $as['category']; ?></td><td><?php echo $as['purchase_date']; ?></td><td><?php echo finFormatUgx($as['purchase_amount']); ?></td><td><?php echo $as['status']; ?></td></tr>
        <?php endforeach; ?>
        <?php if (empty($assets)): ?><tr><td colspan="5" class="text-muted">No assets tracked yet.</td></tr><?php endif; ?>
        </tbody></table>
    </div>

    <!-- 11. COMMUNICATIONS -->
    <div id="communications" class="section-panel">
        <h2 class="h4 mb-3"><i class="fas fa-envelope"></i> Fee Reminders &amp; Notifications</h2>
        <div class="row">
            <div class="col-md-6">
                <form method="post" action="../assets/finance_handler.php" class="card card-body">
                    <input type="hidden" name="action" value="send_reminder">
                    <h6>Send Reminder</h6>
                    <input type="text" name="student_id" class="form-control mb-2" placeholder="Student admission no. (blank = all overdue)">
                    <select name="channel" class="form-select mb-2"><option value="sms">SMS</option><option value="email">Email</option><option value="system">System</option></select>
                    <textarea name="message" class="form-control mb-2" rows="3" placeholder="Reminder message...">Dear student, please clear your outstanding fees at the bursar's office. ISNM</textarea>
                    <button class="btn btn-warning btn-sm">Queue Reminder</button>
                </form>
            </div>
            <div class="col-md-6">
                <form method="post" action="../assets/finance_handler.php" class="card card-body">
                    <input type="hidden" name="action" value="broadcast">
                    <h6>Broadcast Announcement</h6>
                    <input type="text" name="subject" class="form-control mb-2" placeholder="Subject">
                    <select name="channel" class="form-select mb-2"><option value="system">All Students (System)</option><option value="email">Email</option></select>
                    <textarea name="message" class="form-control mb-2" rows="3"></textarea>
                    <button class="btn btn-primary btn-sm">Broadcast</button>
                </form>
            </div>
        </div>
    </div>

    <!-- 12. INTEGRATIONS -->
    <div id="integrations" class="section-panel">
        <h2 class="h4 mb-3"><i class="fas fa-plug"></i> Integrations</h2>
        <div class="row g-3">
            <div class="col-md-4"><div class="card"><div class="card-body"><h6><i class="fas fa-mobile-alt"></i> MTN MoMo</h6><p class="small text-muted">Configure API keys in fin_settings. Payment webhook will auto-verify.</p><span class="badge bg-secondary">Configure API</span></div></div></div>
            <div class="col-md-4"><div class="card"><div class="card-body"><h6><i class="fas fa-mobile-alt"></i> Airtel Money</h6><p class="small text-muted">Configure merchant ID and API secret.</p><span class="badge bg-secondary">Configure API</span></div></div></div>
            <div class="col-md-4"><div class="card"><div class="card-body"><h6><i class="fas fa-landmark"></i> URA Reporting</h6><p class="small text-muted">URA-compatible export for tax reporting.</p><span class="badge bg-secondary">Coming soon</span></div></div></div>
            <div class="col-md-4"><div class="card"><div class="card-body"><h6><i class="fas fa-graduation-cap"></i> Academics</h6><p class="small">Block results if fees not cleared (enabled in settings).</p><span class="badge bg-success">Active</span></div></div></div>
            <div class="col-md-4"><div class="card"><div class="card-body"><h6><i class="fas fa-bed"></i> Hostel Billing</h6><p class="small">Accommodation fees in fee structure.</p><span class="badge bg-success">Linked</span></div></div></div>
            <div class="col-md-4"><div class="card"><div class="card-body"><h6><i class="fas fa-book"></i> Library Fines</h6><p class="small">Record as separate payment type.</p><span class="badge bg-info">Manual</span></div></div></div>
        </div>
    </div>
</main>

<!-- Modals -->
<div class="modal fade" id="feeStructureModal" tabindex="-1"><div class="modal-dialog modal-lg"><div class="modal-content">
<form method="post" action="../assets/finance_handler.php" enctype="multipart/form-data">
<input type="hidden" name="action" value="save_fee_structure">
<div class="modal-header bg-primary text-white"><h5 class="modal-title">Fee Structure</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
<div class="modal-body row g-2">
<div class="col-md-6"><label class="form-label">Program</label><input type="text" name="program" class="form-control" required placeholder="e.g. Certificate Nursing"></div>
<div class="col-md-3"><label class="form-label">Academic Year</label><input type="text" name="academic_year" class="form-control" value="<?php echo date('Y').'/'.(date('Y')+1); ?>"></div>
<div class="col-md-3"><label class="form-label">Semester</label><input type="number" name="semester" class="form-control" value="1" min="1" max="3"></div>
<div class="col-md-4"><label>Tuition (UGX)</label><input type="number" name="tuition_fee" class="form-control" value="1200000"></div>
<div class="col-md-4"><label>Accommodation</label><input type="number" name="accommodation_fee" class="form-control" value="800000"></div>
<div class="col-md-4"><label>Clinical</label><input type="number" name="clinical_fee" class="form-control" value="400000"></div>
<div class="col-md-3"><label>Library</label><input type="number" name="library_fee" class="form-control" value="0"></div>
<div class="col-md-3"><label>Examination</label><input type="number" name="examination_fee" class="form-control" value="0"></div>
<div class="col-md-3"><label>Registration</label><input type="number" name="registration_fee" class="form-control" value="0"></div>
<div class="col-md-3"><label>Other</label><input type="number" name="other_fees" class="form-control" value="0"></div>
</div>
<div class="modal-footer"><button type="submit" class="btn btn-primary">Save Structure</button></div>
</form></div></div></div>

<div class="modal fade" id="paymentModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
<form method="post" action="../assets/finance_handler.php" enctype="multipart/form-data">
<input type="hidden" name="action" value="record_payment">
<div class="modal-header bg-success text-white"><h5 class="modal-title">Record Payment</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
<div class="modal-body">
<label class="form-label">Student ID *</label><input type="text" name="student_id" class="form-control mb-2" required list="studentIds">
<datalist id="studentIds"><?php foreach ($accounts as $a): ?><option value="<?php echo htmlspecialchars($a['student_id']); ?>"><?php endforeach; ?></datalist>
<label>Amount (UGX) *</label><input type="number" name="amount" class="form-control mb-2" required>
<label>Method *</label><select name="payment_method" class="form-select mb-2"><option value="cash">Cash</option><option value="bank">Bank Deposit</option><option value="mobile_money">Mobile Money</option><option value="cheque">Cheque</option><option value="online">Online</option></select>
<label>Provider</label><select name="provider" class="form-select mb-2"><option value="">—</option><option value="MTN">MTN MoMo</option><option value="Airtel">Airtel Money</option></select>
<label>Reference</label><input type="text" name="reference" class="form-control mb-2">
<label>Bank</label><input type="text" name="bank_name" class="form-control mb-2">
<label>Payment Date</label><input type="date" name="payment_date" class="form-control mb-2" value="<?php echo date('Y-m-d'); ?>">
<label>Proof of Payment</label><input type="file" name="proof_file" class="form-control mb-2" accept="image/*,.pdf">
<label>Notes</label><textarea name="notes" class="form-control" rows="2"></textarea>
</div>
<div class="modal-footer"><button type="submit" class="btn btn-success">Record &amp; Generate Receipt</button></div>
</form></div></div></div>

<div class="modal fade" id="adjustmentModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
<form method="post" action="../assets/finance_handler.php">
<input type="hidden" name="action" value="save_adjustment">
<div class="modal-header"><h5 class="modal-title">Fee Adjustment</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
<div class="modal-body">
<input type="text" name="student_id" class="form-control mb-2" placeholder="Student ID" required>
<select name="adjustment_type" class="form-select mb-2"><option value="discount">Discount</option><option value="waiver">Waiver</option><option value="refund">Refund</option><option value="penalty">Penalty</option></select>
<input type="number" name="amount" class="form-control mb-2" placeholder="Amount" required>
<textarea name="reason" class="form-control" placeholder="Reason" required></textarea>
</div>
<div class="modal-footer"><button type="submit" class="btn btn-primary">Submit for Approval</button></div>
</form></div></div></div>

<div class="modal fade" id="budgetModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
<form method="post" action="../assets/finance_handler.php"><input type="hidden" name="action" value="save_budget">
<div class="modal-header"><h5>Create Budget</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
<div class="modal-body">
<input type="text" name="fiscal_year" class="form-control mb-2" value="<?php echo date('Y'); ?>" placeholder="Fiscal Year">
<input type="text" name="department" class="form-control mb-2" placeholder="Department" required>
<input type="text" name="category" class="form-control mb-2" placeholder="Category" required>
<input type="number" name="allocated_amount" class="form-control mb-2" placeholder="Allocated UGX" required>
</div>
<div class="modal-footer"><button type="submit" class="btn btn-primary">Save</button></div>
</form></div></div></div>

<div class="modal fade" id="expenseModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
<form method="post" action="../assets/finance_handler.php"><input type="hidden" name="action" value="save_expense">
<div class="modal-header"><h5>New Expense</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
<div class="modal-body">
<input type="text" name="description" class="form-control mb-2" placeholder="Description" required>
<input type="text" name="category" class="form-control mb-2" placeholder="Category" required>
<input type="number" name="amount" class="form-control mb-2" placeholder="Amount" required>
<input type="date" name="expense_date" class="form-control mb-2" value="<?php echo date('Y-m-d'); ?>">
<input type="text" name="department" class="form-control mb-2" placeholder="Department">
</div>
<div class="modal-footer"><button type="submit" class="btn btn-primary">Submit</button></div>
</form></div></div></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.querySelectorAll('.fin-nav a[data-section]').forEach(function(link) {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        var id = this.getAttribute('data-section');
        document.querySelectorAll('.fin-nav a').forEach(function(a) { a.classList.remove('active'); });
        this.classList.add('active');
        document.querySelectorAll('.section-panel').forEach(function(p) { p.classList.remove('active'); });
        var panel = document.getElementById(id);
        if (panel) panel.classList.add('active');
        history.replaceState(null, '', '#' + id);
    });
});
(function() {
    var hash = location.hash.replace('#', '');
    if (hash) {
        var l = document.querySelector('.fin-nav a[data-section="' + hash + '"]');
        if (l) l.click();
    }
})();
</script>
</body>
</html>
