<?php
// Error reporting disabled for clean display
error_reporting(0);
ini_set('display_errors', 0);

// Start session if needed
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check authentication and role
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'school-bursar') {
    header('Location: login.php');
    exit();
}

// Mock data for demonstration
$bursar_info = [
    'username' => $_SESSION['user']['username'],
    'name' => $_SESSION['user']['name'],
    'role' => $_SESSION['user']['role'],
    'login_time' => $_SESSION['user']['login_time']
];

// Mock financial statistics
$financial_stats = [
    'total_students' => 245,
    'fees_today' => 8500000,
    'fees_this_month' => 45000000,
    'outstanding_balances' => 12000000,
    'students_cleared' => 180,
    'students_not_cleared' => 65,
    'revenue_this_year' => 380000000,
    'expenses_this_month' => 12000000,
    'pending_reimbursements' => 8,
    'total_salaries' => 25000000,
    'transactions_today' => 15,
    'mobile_money_today' => 12,
    'pending_expenses' => 5,
    'budget_utilization' => 75.5,
    'inventory_value' => 45000000
];

// Mock recent transactions
$recent_transactions = [
    ['receipt_number' => 'REC2024012301', 'student_id' => '2024/001', 'first_name' => 'John', 'last_name' => 'Doe', 'amount' => 500000, 'method_name' => 'MTN Mobile Money', 'payment_date' => '2024-01-23'],
    ['receipt_number' => 'REC2024012302', 'student_id' => '2024/002', 'first_name' => 'Jane', 'last_name' => 'Smith', 'amount' => 2500000, 'method_name' => 'Bank Transfer', 'payment_date' => '2024-01-23'],
    ['receipt_number' => 'REC2024012303', 'student_id' => '2023/015', 'first_name' => 'Peter', 'last_name' => 'Jones', 'amount' => 300000, 'method_name' => 'Cash', 'payment_date' => '2024-01-23']
];

// Mock outstanding balances
$outstanding_balances = [
    ['student_id' => '2024/005', 'first_name' => 'Alice', 'last_name' => 'Johnson', 'program_name' => 'Nursing', 'total_fees' => 2500000, 'amount_paid' => 1500000, 'outstanding_balance' => 1000000, 'days_overdue' => 15],
    ['student_id' => '2023/012', 'first_name' => 'Bob', 'last_name' => 'Williams', 'program_name' => 'Midwifery', 'total_fees' => 2800000, 'amount_paid' => 800000, 'outstanding_balance' => 2000000, 'days_overdue' => 30],
    ['student_id' => '2024/008', 'first_name' => 'Carol', 'last_name' => 'Brown', 'program_name' => 'Nursing', 'total_fees' => 2500000, 'amount_paid' => 2000000, 'outstanding_balance' => 500000, 'days_overdue' => 5]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Bursar Dashboard - ISNM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 2rem;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .main-content {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 1rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #6b7280;
            font-size: 0.9rem;
        }

        .content-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .table th,
        .table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        .table th {
            background: #f9fafb;
            font-weight: 600;
            color: #1a1a1a;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #2563eb 0%, #667eea 100%);
            color: white;
        }

        .btn-success {
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .welcome-text {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
        }

        .subtitle {
            color: #6b7280;
            margin-bottom: 1rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2563eb 0%, #667eea 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .nav-link {
            display: block;
            padding: 0.75rem;
            color: #6b7280;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background: rgba(37, 99, 235, 0.1);
            color: #2563eb;
        }

        .nav-link.active {
            background: linear-gradient(135deg, #2563eb 0%, #667eea 100%);
            color: white;
        }

        .section-content {
            display: none;
        }

        .section-content.active {
            display: block;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #1a1a1a;
        }

        .form-input, .form-select {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: #2563eb;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .modal-content {
            background: white;
            margin: 5% auto;
            padding: 2rem;
            border-radius: 15px;
            max-width: 600px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
        }

        .modal-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #6b7280;
        }

        .print-btn {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .print-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        @media print {
            .sidebar, .nav-link, .btn, .modal, .no-print {
                display: none !important;
            }
            
            .main-content {
                padding: 0;
                background: white;
            }
            
            .content-card {
                box-shadow: none;
                border: 1px solid #e5e7eb;
                page-break-inside: avoid;
            }
            
            .header {
                background: white;
                border-bottom: 2px solid #1a1a1a;
                margin-bottom: 1rem;
            }
        }

        .receipt-preview {
            background: white;
            padding: 2rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            margin: 1rem 0;
        }

        .receipt-header {
            text-align: center;
            border-bottom: 2px solid #1a1a1a;
            padding-bottom: 1rem;
            margin-bottom: 1rem;
        }

        .receipt-body {
            margin: 1rem 0;
        }

        .receipt-footer {
            text-align: center;
            border-top: 2px solid #1a1a1a;
            padding-top: 1rem;
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <div class="user-info">
                <div class="user-avatar">
                    <?php echo strtoupper(substr($bursar_info['name'], 0, 2)); ?>
                </div>
                <div>
                    <div style="font-weight: 600;"><?php echo htmlspecialchars($bursar_info['name']); ?></div>
                    <div style="color: #6b7280; font-size: 0.9rem;">School Bursar</div>
                </div>
            </div>
            
            <nav style="margin-top: 2rem;">
                <a href="#" class="nav-link active" data-section="dashboard">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="#" class="nav-link" data-section="fees">
                    <i class="fas fa-graduation-cap"></i> Fee Management
                </a>
                <a href="#" class="nav-link" data-section="payments">
                    <i class="fas fa-money-bill-wave"></i> Payments
                </a>
                <a href="#" class="nav-link" data-section="students">
                    <i class="fas fa-users"></i> Students
                </a>
                <a href="#" class="nav-link" data-section="reports">
                    <i class="fas fa-chart-line"></i> Reports
                </a>
                <a href="#" class="nav-link" data-section="budget">
                    <i class="fas fa-wallet"></i> Budget
                </a>
                <a href="#" class="nav-link" data-section="payroll">
                    <i class="fas fa-user-tie"></i> Payroll
                </a>
                <a href="#" class="nav-link" data-section="accounts">
                    <i class="fas fa-balance-scale"></i> Accounts
                </a>
                <a href="#" class="nav-link" data-section="inventory">
                    <i class="fas fa-box"></i> Inventory
                </a>
                <a href="#" class="nav-link" data-section="settings">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <a href="login.php?logout=1" style="display: block; padding: 0.75rem; color: #dc2626; text-decoration: none; border-radius: 8px; margin-top: 2rem;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </nav>
        </div>

        <div class="main-content">
            <!-- Dashboard Section -->
            <div id="dashboard" class="section-content active">
                <div class="header">
                    <div class="welcome-text">Welcome to Bursar Dashboard</div>
                    <div class="subtitle">Manage school finances, fees, and payments</div>
                    <div style="color: #6b7280; font-size: 0.9rem; margin-top: 0.5rem;">
                        Last login: <?php echo date('d M Y, h:i A', strtotime($bursar_info['login_time'])); ?>
                    </div>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-value"><?php echo number_format($financial_stats['total_students']); ?></div>
                        <div class="stat-label">Total Students</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #2563eb 0%, #667eea 100%);">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="stat-value">UGX <?php echo number_format($financial_stats['fees_today']); ?></div>
                        <div class="stat-label">Fees Collected Today</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="stat-value">UGX <?php echo number_format($financial_stats['outstanding_balances']); ?></div>
                        <div class="stat-label">Outstanding Balances</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="stat-value">UGX <?php echo number_format($financial_stats['revenue_this_year']); ?></div>
                        <div class="stat-label">Revenue This Year</div>
                    </div>
                </div>

                <div class="content-card">
                    <h3 style="margin-bottom: 1rem;">Recent Transactions</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Receipt #</th>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recent_transactions as $transaction): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($transaction['receipt_number']); ?></td>
                                <td><?php echo htmlspecialchars($transaction['student_id']); ?></td>
                                <td><?php echo htmlspecialchars($transaction['first_name'] . ' ' . $transaction['last_name']); ?></td>
                                <td>UGX <?php echo number_format($transaction['amount']); ?></td>
                                <td><?php echo htmlspecialchars($transaction['method_name']); ?></td>
                                <td><?php echo date('d M Y', strtotime($transaction['payment_date'])); ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="print-btn" onclick="printReceipt('<?php echo htmlspecialchars($transaction['receipt_number']); ?>')">
                                            <i class="fas fa-print"></i> Print
                                        </button>
                                        <button class="btn btn-primary" style="padding: 0.5rem; font-size: 0.9rem;" onclick="generatePDF('<?php echo htmlspecialchars($transaction['receipt_number']); ?>')">
                                            <i class="fas fa-file-pdf"></i> PDF
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="content-card">
                    <h3 style="margin-bottom: 1rem;">Outstanding Balances</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Program</th>
                                <th>Total Fees</th>
                                <th>Paid</th>
                                <th>Balance</th>
                                <th>Days Overdue</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($outstanding_balances as $balance): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($balance['student_id']); ?></td>
                                <td><?php echo htmlspecialchars($balance['first_name'] . ' ' . $balance['last_name']); ?></td>
                                <td><?php echo htmlspecialchars($balance['program_name']); ?></td>
                                <td>UGX <?php echo number_format($balance['total_fees']); ?></td>
                                <td>UGX <?php echo number_format($balance['amount_paid']); ?></td>
                                <td style="color: #dc2626; font-weight: 600;">UGX <?php echo number_format($balance['outstanding_balance']); ?></td>
                                <td><?php echo $balance['days_overdue']; ?> days</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="print-btn" onclick="printStatement('<?php echo htmlspecialchars($balance['student_id']); ?>')">
                                            <i class="fas fa-file-invoice"></i> Statement
                                        </button>
                                        <button class="btn btn-primary" style="padding: 0.5rem; font-size: 0.9rem;" onclick="generateReminderLetter('<?php echo htmlspecialchars($balance['student_id']); ?>')">
                                            <i class="fas fa-envelope"></i> Reminder
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Fee Management Section -->
            <div id="fees" class="section-content">
                <div class="header">
                    <div class="welcome-text">Fee Management</div>
                    <div class="subtitle">Setup and manage student fee structures</div>
                </div>

                <div class="content-card">
                    <h3>Fee Structure Setup</h3>
                    <button class="btn btn-primary" onclick="openModal('feeStructureModal')">
                        <i class="fas fa-plus"></i> Add Fee Structure
                    </button>
                    
                    <table class="table" style="margin-top: 1rem;">
                        <thead>
                            <tr>
                                <th>Program</th>
                                <th>Academic Year</th>
                                <th>Tuition</th>
                                <th>Accommodation</th>
                                <th>Clinical</th>
                                <th>Other Fees</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Nursing</td>
                                <td>2024</td>
                                <td>UGX 1,500,000</td>
                                <td>UGX 800,000</td>
                                <td>UGX 200,000</td>
                                <td>UGX 0</td>
                                <td><strong>UGX 2,500,000</strong></td>
                                <td><span style="color: #059669;">Active</span></td>
                                <td>
                                    <button class="btn btn-primary" style="padding: 0.5rem; font-size: 0.9rem;">Edit</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Midwifery</td>
                                <td>2024</td>
                                <td>UGX 1,800,000</td>
                                <td>UGX 800,000</td>
                                <td>UGX 200,000</td>
                                <td>UGX 0</td>
                                <td><strong>UGX 2,800,000</strong></td>
                                <td><span style="color: #059669;">Active</span></td>
                                <td>
                                    <button class="btn btn-primary" style="padding: 0.5rem; font-size: 0.9rem;">Edit</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="content-card">
                    <h3>Automatic Fee Assignment</h3>
                    <p>Students are automatically assigned fees based on their program and academic year.</p>
                    <button class="btn btn-success">
                        <i class="fas fa-sync"></i> Run Fee Assignment
                    </button>
                </div>
            </div>

            <!-- Payments Section -->
            <div id="payments" class="section-content">
                <div class="header">
                    <div class="welcome-text">Payment Processing</div>
                    <div class="subtitle">Record and manage student payments</div>
                </div>

                <div class="content-card">
                    <h3>Record New Payment</h3>
                    <form>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Student ID</label>
                                <input type="text" class="form-input" placeholder="Enter Student ID">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Amount (UGX)</label>
                                <input type="number" class="form-input" placeholder="Enter Amount">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Payment Method</label>
                                <select class="form-select">
                                    <option>Cash</option>
                                    <option>Bank Transfer</option>
                                    <option>MTN Mobile Money</option>
                                    <option>Airtel Money</option>
                                    <option>Cheque</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Reference Number</label>
                                <input type="text" class="form-input" placeholder="Transaction Reference">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Payment Date</label>
                                <input type="date" class="form-input">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Record Payment
                        </button>
                    </form>
                </div>

                <div class="content-card">
                    <h3>Mobile Money Integration</h3>
                    <p>Process payments directly through MTN Mobile Money and Airtel Money APIs.</p>
                    <div class="form-row">
                        <button class="btn btn-success">
                            <i class="fas fa-mobile-alt"></i> MTN MoMo Payment
                        </button>
                        <button class="btn btn-success">
                            <i class="fas fa-mobile-alt"></i> Airtel Money Payment
                        </button>
                    </div>
                </div>
            </div>

            <!-- Students Section -->
            <div id="students" class="section-content">
                <div class="header">
                    <div class="welcome-text">Student Financial Management</div>
                    <div class="subtitle">View and manage student fee accounts</div>
                </div>

                <div class="content-card">
                    <h3>Student Fee Accounts</h3>
                    <div class="form-row" style="margin-bottom: 1rem;">
                        <input type="text" class="form-input" placeholder="Search by Student ID or Name">
                        <select class="form-select">
                            <option>All Programs</option>
                            <option>Nursing</option>
                            <option>Midwifery</option>
                        </select>
                        <button class="btn btn-primary">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </div>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Program</th>
                                <th>Total Fees</th>
                                <th>Paid</th>
                                <th>Balance</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2024/001</td>
                                <td>John Doe</td>
                                <td>Nursing</td>
                                <td>UGX 2,500,000</td>
                                <td>UGX 1,500,000</td>
                                <td style="color: #dc2626;">UGX 1,000,000</td>
                                <td><span style="color: #f59e0b;">Partial</span></td>
                                <td>
                                    <button class="btn btn-primary" style="padding: 0.5rem; font-size: 0.9rem;">View</button>
                                    <button class="btn btn-success" style="padding: 0.5rem; font-size: 0.9rem;">Payment</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Reports Section -->
            <div id="reports" class="section-content">
                <div class="header">
                    <div class="welcome-text">Financial Reports & Analytics</div>
                    <div class="subtitle">Generate comprehensive financial reports</div>
                </div>

                <div class="content-card">
                    <h3>Generate Reports</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Report Type</label>
                            <select class="form-select">
                                <option>Daily Collection Report</option>
                                <option>Weekly Collection Report</option>
                                <option>Monthly Collection Report</option>
                                <option>Outstanding Balances</option>
                                <option>Revenue Summary</option>
                                <option>Trial Balance</option>
                                <option>Income Statement</option>
                                <option>URA Tax Report</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Start Date</label>
                            <input type="date" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-input">
                        </div>
                    </div>
                    <div class="form-row">
                        <button class="btn btn-primary" onclick="generateReport('pdf')">
                            <i class="fas fa-file-pdf"></i> Generate PDF
                        </button>
                        <button class="btn btn-success" onclick="generateReport('excel')">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </button>
                        <button class="btn btn-primary" style="background: #6b7280;" onclick="generateReport('preview')">
                            <i class="fas fa-eye"></i> Preview
                        </button>
                        <button class="print-btn" onclick="printReport()">
                            <i class="fas fa-print"></i> Print Report
                        </button>
                    </div>
                </div>

                <div class="content-card">
                    <h3>Quick Analytics</h3>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="stat-value">92%</div>
                            <div class="stat-label">Collection Rate</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stat-value">15 days</div>
                            <div class="stat-label">Avg Payment Time</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Budget Section -->
            <div id="budget" class="section-content">
                <div class="header">
                    <div class="welcome-text">Budgeting & Expenditure Management</div>
                    <div class="subtitle">Create and manage departmental budgets</div>
                </div>

                <div class="content-card">
                    <h3>Budget Overview</h3>
                    <button class="btn btn-primary" onclick="openModal('budgetModal')">
                        <i class="fas fa-plus"></i> Create Budget
                    </button>
                    
                    <table class="table" style="margin-top: 1rem;">
                        <thead>
                            <tr>
                                <th>Department</th>
                                <th>Annual Budget</th>
                                <th>Spent</th>
                                <th>Remaining</th>
                                <th>Utilization</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Academic</td>
                                <td>UGX 50,000,000</td>
                                <td>UGX 37,500,000</td>
                                <td>UGX 12,500,000</td>
                                <td>75%</td>
                                <td><span style="color: #059669;">On Track</span></td>
                            </tr>
                            <tr>
                                <td>Administration</td>
                                <td>UGX 30,000,000</td>
                                <td>UGX 22,500,000</td>
                                <td>UGX 7,500,000</td>
                                <td>75%</td>
                                <td><span style="color: #059669;">On Track</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Payroll Section -->
            <div id="payroll" class="section-content">
                <div class="header">
                    <div class="welcome-text">Payroll Management</div>
                    <div class="subtitle">Manage staff salaries and allowances</div>
                </div>

                <div class="content-card">
                    <h3>Monthly Payroll</h3>
                    <button class="btn btn-success">
                        <i class="fas fa-calculator"></i> Process Payroll
                    </button>
                    
                    <table class="table" style="margin-top: 1rem;">
                        <thead>
                            <tr>
                                <th>Staff Name</th>
                                <th>Position</th>
                                <th>Basic Salary</th>
                                <th>Allowances</th>
                                <th>Deductions</th>
                                <th>Net Salary</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John Teacher</td>
                                <td>Lecturer</td>
                                <td>UGX 2,000,000</td>
                                <td>UGX 300,000</td>
                                <td>UGX 400,000</td>
                                <td><strong>UGX 1,900,000</strong></td>
                                <td><span style="color: #059669;">Processed</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Accounts Section -->
            <div id="accounts" class="section-content">
                <div class="header">
                    <div class="welcome-text">Accounts & Ledger Management</div>
                    <div class="subtitle">General ledger and financial accounts</div>
                </div>

                <div class="content-card">
                    <h3>Chart of Accounts</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Account Code</th>
                                <th>Account Name</th>
                                <th>Account Type</th>
                                <th>Balance</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1001</td>
                                <td>Cash Account</td>
                                <td>Asset</td>
                                <td>UGX 45,000,000</td>
                                <td><span style="color: #059669;">Active</span></td>
                            </tr>
                            <tr>
                                <td>4001</td>
                                <td>Tuition Fees</td>
                                <td>Income</td>
                                <td>UGX 380,000,000</td>
                                <td><span style="color: #059669;">Active</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Inventory Section -->
            <div id="inventory" class="section-content">
                <div class="header">
                    <div class="welcome-text">Inventory & Asset Tracking</div>
                    <div class="subtitle">Track school assets and purchases</div>
                </div>

                <div class="content-card">
                    <h3>Asset Registry</h3>
                    <button class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Asset
                    </button>
                    
                    <table class="table" style="margin-top: 1rem;">
                        <thead>
                            <tr>
                                <th>Item Code</th>
                                <th>Item Name</th>
                                <th>Category</th>
                                <th>Quantity</th>
                                <th>Unit Cost</th>
                                <th>Total Value</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>MED001</td>
                                <td>Stethoscope</td>
                                <td>Medical</td>
                                <td>25</td>
                                <td>UGX 300,000</td>
                                <td>UGX 7,500,000</td>
                                <td><span style="color: #059669;">Active</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Settings Section -->
            <div id="settings" class="section-content">
                <div class="header">
                    <div class="welcome-text">System Settings</div>
                    <div class="subtitle">Configure financial system parameters</div>
                </div>

                <div class="content-card">
                    <h3>Financial Settings</h3>
                    <form>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Late Payment Penalty (%)</label>
                                <input type="number" class="form-input" value="5">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Grace Period (Days)</label>
                                <input type="number" class="form-input" value="7">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Currency</label>
                                <select class="form-select">
                                    <option>UGX - Ugandan Shilling</option>
                                    <option>USD - US Dollar</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Settings
                        </button>
                    </form>
                </div>

                <div class="content-card">
                    <h3>User Access Control</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>User Role</th>
                                <th>Permissions</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>School Bursar</td>
                                <td>Full Access</td>
                                <td><span style="color: #059669;">Active</span></td>
                                <td><button class="btn btn-primary" style="padding: 0.5rem;">Edit</button></td>
                            </tr>
                            <tr>
                                <td>Accounts Assistant</td>
                                <td>Limited Access</td>
                                <td><span style="color: #059669;">Active</span></td>
                                <td><button class="btn btn-primary" style="padding: 0.5rem;">Edit</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <div id="feeStructureModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add Fee Structure</h3>
                <button class="close-modal" onclick="closeModal('feeStructureModal')">&times;</button>
            </div>
            <form>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Program</label>
                        <select class="form-select">
                            <option>Nursing</option>
                            <option>Midwifery</option>
                            <option>Public Health</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Academic Year</label>
                        <select class="form-select">
                            <option>2024</option>
                            <option>2023</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Tuition Fee</label>
                        <input type="number" class="form-input" placeholder="UGX">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Accommodation</label>
                        <input type="number" class="form-input" placeholder="UGX">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Clinical Fee</label>
                        <input type="number" class="form-input" placeholder="UGX">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Library Fee</label>
                        <input type="number" class="form-input" placeholder="UGX">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save Fee Structure</button>
            </form>
        </div>
    </div>

    <div id="budgetModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Create Budget</h3>
                <button class="close-modal" onclick="closeModal('budgetModal')">&times;</button>
            </div>
            <form>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Department</label>
                        <select class="form-select">
                            <option>Academic</option>
                            <option>Administration</option>
                            <option>Support Services</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Budget Type</label>
                        <select class="form-select">
                            <option>Annual</option>
                            <option>Semester</option>
                            <option>Term</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Budget Name</label>
                    <input type="text" class="form-input" placeholder="Enter budget name">
                </div>
                <div class="form-group">
                    <label class="form-label">Annual Budget (UGX)</label>
                    <input type="number" class="form-input" placeholder="Enter amount">
                </div>
                <button type="submit" class="btn btn-primary">Create Budget</button>
            </form>
        </div>
    </div>

    <!-- Receipt Printing Modal -->
    <div id="receiptModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Payment Receipt</h3>
                <button class="close-modal" onclick="closeModal('receiptModal')">&times;</button>
            </div>
            <div id="receiptContent" class="receipt-preview">
                <!-- Receipt content will be dynamically generated -->
            </div>
            <div class="form-row" style="margin-top: 1rem;">
                <button class="print-btn" onclick="window.print()">
                    <i class="fas fa-print"></i> Print Receipt
                </button>
                <button class="btn btn-primary" onclick="downloadReceiptPDF()">
                    <i class="fas fa-download"></i> Download PDF
                </button>
                <button class="btn btn-success" onclick="emailReceipt()">
                    <i class="fas fa-envelope"></i> Email Receipt
                </button>
            </div>
        </div>
    </div>

    <!-- Statement Modal -->
    <div id="statementModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Student Statement of Account</h3>
                <button class="close-modal" onclick="closeModal('statementModal')">&times;</button>
            </div>
            <div id="statementContent" class="receipt-preview">
                <!-- Statement content will be dynamically generated -->
            </div>
            <div class="form-row" style="margin-top: 1rem;">
                <button class="print-btn" onclick="window.print()">
                    <i class="fas fa-print"></i> Print Statement
                </button>
                <button class="btn btn-primary" onclick="downloadStatementPDF()">
                    <i class="fas fa-download"></i> Download PDF
                </button>
                <button class="btn btn-success" onclick="emailStatement()">
                    <i class="fas fa-envelope"></i> Email Statement
                </button>
            </div>
        </div>
    </div>

    <!-- Report Preview Modal -->
    <div id="reportModal" class="modal">
        <div class="modal-content" style="max-width: 900px;">
            <div class="modal-header">
                <h3>Financial Report Preview</h3>
                <button class="close-modal" onclick="closeModal('reportModal')">&times;</button>
            </div>
            <div id="reportContent" style="max-height: 60vh; overflow-y: auto;">
                <!-- Report content will be dynamically generated -->
            </div>
            <div class="form-row" style="margin-top: 1rem;">
                <button class="print-btn" onclick="window.print()">
                    <i class="fas fa-print"></i> Print Report
                </button>
                <button class="btn btn-primary" onclick="downloadReportPDF()">
                    <i class="fas fa-download"></i> Download PDF
                </button>
                <button class="btn btn-success" onclick="downloadReportExcel()">
                    <i class="fas fa-file-excel"></i> Export Excel
                </button>
            </div>
        </div>
    </div>

    <script>
        // Navigation functionality
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all links and sections
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                document.querySelectorAll('.section-content').forEach(s => s.classList.remove('active'));
                
                // Add active class to clicked link
                this.classList.add('active');
                
                // Show corresponding section
                const sectionId = this.getAttribute('data-section');
                document.getElementById(sectionId).classList.add('active');
            });
        });

        // Modal functionality
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
            }
        }

        // Receipt printing function
        function printReceipt(receiptNumber) {
            const receiptData = {
                receiptNumber: receiptNumber,
                date: new Date().toLocaleDateString(),
                studentName: 'John Doe',
                studentId: '2024/001',
                amount: 500000,
                method: 'MTN Mobile Money',
                program: 'Nursing',
                semester: 'Semester 1',
                academicYear: '2024'
            };

            const receiptHTML = `
                <div class="receipt-header">
                    <h2>IGANGA SCHOOL OF NURSING AND MIDWIFERY</h2>
                    <p>P.O. Box 1234, Iganga, Uganda</p>
                    <p>Tel: +256 123 456 789 | Email: bursar@isnm.ac.ug</p>
                </div>
                <div class="receipt-body">
                    <h3>OFFICIAL RECEIPT</h3>
                    <p><strong>Receipt Number:</strong> ${receiptData.receiptNumber}</p>
                    <p><strong>Date:</strong> ${receiptData.date}</p>
                    <p><strong>Student ID:</strong> ${receiptData.studentId}</p>
                    <p><strong>Student Name:</strong> ${receiptData.studentName}</p>
                    <p><strong>Program:</strong> ${receiptData.program}</p>
                    <p><strong>Semester:</strong> ${receiptData.semester}</p>
                    <p><strong>Academic Year:</strong> ${receiptData.academicYear}</p>
                    <hr>
                    <p><strong>Amount Paid:</strong> UGX ${receiptData.amount.toLocaleString()}</p>
                    <p><strong>Payment Method:</strong> ${receiptData.method}</p>
                </div>
                <div class="receipt-footer">
                    <p>This is a computer-generated receipt and does not require a signature.</p>
                    <p>Thank you for your payment!</p>
                    <p><strong>Authorized by:</strong> School Bursar</p>
                </div>
            `;

            document.getElementById('receiptContent').innerHTML = receiptHTML;
            openModal('receiptModal');
        }

        // Student statement function
        function printStatement(studentId) {
            const statementData = {
                studentId: studentId,
                studentName: 'John Doe',
                program: 'Nursing',
                academicYear: '2024',
                totalFees: 2500000,
                amountPaid: 1500000,
                outstandingBalance: 1000000,
                transactions: [
                    {date: '2024-01-15', description: 'Tuition Fee Payment', amount: 500000, method: 'MTN Mobile Money'},
                    {date: '2024-01-20', description: 'Accommodation Fee', amount: 1000000, method: 'Bank Transfer'}
                ]
            };

            let transactionsHTML = statementData.transactions.map(t => `
                <tr>
                    <td>${t.date}</td>
                    <td>${t.description}</td>
                    <td>UGX ${t.amount.toLocaleString()}</td>
                    <td>${t.method}</td>
                </tr>
            `).join('');

            const statementHTML = `
                <div class="receipt-header">
                    <h2>IGANGA SCHOOL OF NURSING AND MIDWIFERY</h2>
                    <p>STATEMENT OF ACCOUNT</p>
                </div>
                <div class="receipt-body">
                    <h3>Student Information</h3>
                    <p><strong>Student ID:</strong> ${statementData.studentId}</p>
                    <p><strong>Student Name:</strong> ${statementData.studentName}</p>
                    <p><strong>Program:</strong> ${statementData.program}</p>
                    <p><strong>Academic Year:</strong> ${statementData.academicYear}</p>
                    <hr>
                    <h3>Fee Summary</h3>
                    <p><strong>Total Fees:</strong> UGX ${statementData.totalFees.toLocaleString()}</p>
                    <p><strong>Amount Paid:</strong> UGX ${statementData.amountPaid.toLocaleString()}</p>
                    <p><strong>Outstanding Balance:</strong> UGX ${statementData.outstandingBalance.toLocaleString()}</p>
                    <hr>
                    <h3>Payment History</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Method</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${transactionsHTML}
                        </tbody>
                    </table>
                </div>
                <div class="receipt-footer">
                    <p>Generated on: ${new Date().toLocaleDateString()}</p>
                    <p><strong>Prepared by:</strong> School Bursar</p>
                </div>
            `;

            document.getElementById('statementContent').innerHTML = statementHTML;
            openModal('statementModal');
        }

        // Report generation function
        function generateReport(format) {
            const reportType = document.querySelector('#reports select.form-select').value;
            const startDate = document.querySelector('#reports input[type="date"]:nth-of-type(1)').value;
            const endDate = document.querySelector('#reports input[type="date"]:nth-of-type(2)').value;

            let reportHTML = '';

            switch(reportType) {
                case 'Daily Collection Report':
                    reportHTML = generateDailyCollectionReport(startDate || new Date().toISOString().split('T')[0]);
                    break;
                case 'Outstanding Balances':
                    reportHTML = generateOutstandingBalancesReport();
                    break;
                case 'Revenue Summary':
                    reportHTML = generateRevenueSummaryReport(startDate, endDate);
                    break;
                case 'Trial Balance':
                    reportHTML = generateTrialBalanceReport();
                    break;
                default:
                    reportHTML = '<p>Report generation in progress...</p>';
            }

            document.getElementById('reportContent').innerHTML = reportHTML;
            openModal('reportModal');
        }

        function generateDailyCollectionReport(date) {
            return `
                <div class="receipt-header">
                    <h2>DAILY COLLECTION REPORT</h2>
                    <p>Date: ${date}</p>
                </div>
                <div class="receipt-body">
                    <h3>Collection Summary</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Payment Method</th>
                                <th>Number of Transactions</th>
                                <th>Total Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Cash</td>
                                <td>5</td>
                                <td>UGX 2,500,000</td>
                            </tr>
                            <tr>
                                <td>MTN Mobile Money</td>
                                <td>8</td>
                                <td>UGX 4,000,000</td>
                            </tr>
                            <tr>
                                <td>Bank Transfer</td>
                                <td>3</td>
                                <td>UGX 2,000,000</td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <h3>Total Collections: UGX 8,500,000</h3>
                </div>
            `;
        }

        function generateOutstandingBalancesReport() {
            return `
                <div class="receipt-header">
                    <h2>OUTSTANDING BALANCES REPORT</h2>
                    <p>As of: ${new Date().toLocaleDateString()}</p>
                </div>
                <div class="receipt-body">
                    <h3>Debtors Summary</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Program</th>
                                <th>Balance</th>
                                <th>Days Overdue</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2024/005</td>
                                <td>Alice Johnson</td>
                                <td>Nursing</td>
                                <td>UGX 1,000,000</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td>2023/012</td>
                                <td>Bob Williams</td>
                                <td>Midwifery</td>
                                <td>UGX 2,000,000</td>
                                <td>30</td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <h3>Total Outstanding: UGX 12,000,000</h3>
                </div>
            `;
        }

        function generateRevenueSummaryReport(startDate, endDate) {
            return `
                <div class="receipt-header">
                    <h2>REVENUE SUMMARY REPORT</h2>
                    <p>Period: ${startDate} to ${endDate}</p>
                </div>
                <div class="receipt-body">
                    <h3>Revenue by Category</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Revenue Category</th>
                                <th>Amount</th>
                                <th>Percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tuition Fees</td>
                                <td>UGX 35,000,000</td>
                                <td>85%</td>
                            </tr>
                            <tr>
                                <td>Accommodation</td>
                                <td>UGX 4,000,000</td>
                                <td>10%</td>
                            </tr>
                            <tr>
                                <td>Other Fees</td>
                                <td>UGX 2,000,000</td>
                                <td>5%</td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <h3>Total Revenue: UGX 41,000,000</h3>
                </div>
            `;
        }

        function generateTrialBalanceReport() {
            return `
                <div class="receipt-header">
                    <h2>TRIAL BALANCE</h2>
                    <p>As of: ${new Date().toLocaleDateString()}</p>
                </div>
                <div class="receipt-body">
                    <h3>Trial Balance</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Account Code</th>
                                <th>Account Name</th>
                                <th>Debit</th>
                                <th>Credit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1111</td>
                                <td>Cash on Hand</td>
                                <td>UGX 5,000,000</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>1112</td>
                                <td>Bank Accounts</td>
                                <td>UGX 40,000,000</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>4100</td>
                                <td>Tuition Revenue</td>
                                <td>-</td>
                                <td>UGX 35,000,000</td>
                            </tr>
                            <tr>
                                <td>4200</td>
                                <td>Hostel Revenue</td>
                                <td>-</td>
                                <td>UGX 10,000,000</td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <h3>Total Debits: UGX 45,000,000</h3>
                    <h3>Total Credits: UGX 45,000,000</h3>
                </div>
            `;
        }

        function generatePDF(receiptNumber) {
            // Simulate PDF generation
            alert(`Generating PDF for receipt ${receiptNumber}...`);
            // In real implementation, this would call a PDF generation library
        }

        function generateReminderLetter(studentId) {
            const reminderHTML = `
                <div class="receipt-header">
                    <h2>FEE PAYMENT REMINDER</h2>
                    <p>Date: ${new Date().toLocaleDateString()}</p>
                </div>
                <div class="receipt-body">
                    <h3>To: Student ID ${studentId}</h3>
                    <p>Dear Student,</p>
                    <p>This is a reminder that you have an outstanding fee balance. Please make payment as soon as possible to avoid penalties.</p>
                    <p><strong>Outstanding Balance:</strong> UGX 1,000,000</p>
                    <p><strong>Days Overdue:</strong> 15 days</p>
                    <p>Please visit the bursar's office or make payment through our mobile money platforms.</p>
                    <p>Thank you for your cooperation.</p>
                </div>
                <div class="receipt-footer">
                    <p><strong>School Bursar</strong></p>
                    <p>IGANGA SCHOOL OF NURSING AND MIDWIFERY</p>
                </div>
            `;

            document.getElementById('statementContent').innerHTML = reminderHTML;
            openModal('statementModal');
        }

        function printReport() {
            window.print();
        }

        function downloadReceiptPDF() {
            // Simulate PDF download
            const link = document.createElement('a');
            link.href = '#';
            link.download = 'receipt.pdf';
            link.click();
            alert('Receipt PDF downloaded successfully!');
        }

        function downloadStatementPDF() {
            // Simulate PDF download
            const link = document.createElement('a');
            link.href = '#';
            link.download = 'statement.pdf';
            link.click();
            alert('Statement PDF downloaded successfully!');
        }

        function downloadReportPDF() {
            // Simulate PDF download
            const link = document.createElement('a');
            link.href = '#';
            link.download = 'financial_report.pdf';
            link.click();
            alert('Financial report PDF downloaded successfully!');
        }

        function downloadReportExcel() {
            // Simulate Excel download
            const link = document.createElement('a');
            link.href = '#';
            link.download = 'financial_report.xlsx';
            link.click();
            alert('Financial report Excel downloaded successfully!');
        }

        function emailReceipt() {
            alert('Receipt sent to student email successfully!');
        }

        function emailStatement() {
            alert('Statement sent to student email successfully!');
        }
    </script>
</body>
</html>
</body>
</html>
