<?php
/**
 * Finance Module Setup — http://localhost/ISNM-SMS/setup_finance_module.php?confirm=1
 */
if (php_sapi_name() !== 'cli' && !isset($_GET['confirm'])) {
    echo '<!DOCTYPE html><html><head><title>Finance Module Setup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head>
    <body class="p-5"><div class="container col-md-8">
    <h1>ISNM Finance Module Setup</h1>
    <p>Creates tables for billing, payments, budgets, ledger, payroll, inventory, and notifications.</p>
    <ul><li>Fee structures &amp; student accounts</li><li>Invoices &amp; payments</li><li>Budgets &amp; expenses</li><li>Ledger &amp; chart of accounts</li><li>Payroll, assets, scholarships</li></ul>
    <a href="?confirm=1" class="btn btn-primary btn-lg">Proceed with Setup</a>
    </div></body></html>';
    exit;
}
require_once __DIR__ . '/includes/finance_module.php';
finEnsureSchema();
$synced = finSyncStudentsFromRegistry();
echo '<!DOCTYPE html><html><body class="p-5"><div class="container">
<h1 class="text-success">Finance module ready</h1>
<p>Student accounts synced: <strong>' . (int)$synced . '</strong></p>
<p><a class="btn btn-primary" href="dashboards/bursar-finance-hub.php">Open Bursar Finance Hub</a></p>
<p><a class="btn btn-outline-secondary" href="student_panel/my-finances.php">Student Finance Portal (login required)</a></p>
</div></body></html>';
