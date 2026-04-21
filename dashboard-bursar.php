<?php
// Start session
session_start();

// Check if user is logged in and is bursar
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'bursar') {
    header('Location: login-portal.php');
    exit();
}

// Mock Bursar data - in production, this would come from database
$bursar = [
    'id' => 'BUR001',
    'name' => 'Mr. Michael Brown',
    'position' => 'School Bursar / Chief Accountant',
    'email' => 'bursar@isnm.ac.ug',
    'phone' => '+256 772 514 889',
    'department' => 'Finance & Administration',
    'join_date' => '2018-03-15'
];

// Mock financial statistics for comprehensive dashboard
$financial_stats = [
    'total_collections_today' => 45000000,
    'outstanding_fees' => 125000000,
    'students_cleared' => 856,
    'students_not_cleared' => 394,
    'total_revenue_month' => 280000000,
    'total_expenses_month' => 180000000,
    'pending_approvals' => 23,
    'overdue_accounts' => 67
];

// Mock fee structures
$fee_structures = [
    ['program' => 'Nursing', 'year' => 'Year 1', 'tuition' => 2500000, 'accommodation' => 800000, 'clinical' => 500000, 'other' => 200000, 'total' => 4000000],
    ['program' => 'Nursing', 'year' => 'Year 2', 'tuition' => 2500000, 'accommodation' => 800000, 'clinical' => 500000, 'other' => 200000, 'total' => 4000000],
    ['program' => 'Nursing', 'year' => 'Year 3', 'tuition' => 2600000, 'accommodation' => 800000, 'clinical' => 600000, 'other' => 200000, 'total' => 4200000],
    ['program' => 'Midwifery', 'year' => 'Year 1', 'tuition' => 2400000, 'accommodation' => 800000, 'clinical' => 450000, 'other' => 200000, 'total' => 3850000],
    ['program' => 'Midwifery', 'year' => 'Year 2', 'tuition' => 2400000, 'accommodation' => 800000, 'clinical' => 450000, 'other' => 200000, 'total' => 3850000],
    ['program' => 'Short Courses', 'year' => 'Certificate', 'tuition' => 1500000, 'accommodation' => 400000, 'clinical' => 300000, 'other' => 100000, 'total' => 2300000]
];

// Mock recent transactions
$recent_transactions = [
    ['student_id' => 'STU001', 'student_name' => 'Aisha Nankya', 'amount' => 2000000, 'payment_method' => 'Mobile Money', 'transaction_id' => 'MTN123456', 'date' => '2024-01-20 10:30 AM', 'status' => 'verified'],
    ['student_id' => 'STU002', 'student_name' => 'David Kato', 'amount' => 1500000, 'payment_method' => 'Bank Deposit', 'transaction_id' => 'BK789012', 'date' => '2024-01-20 9:45 AM', 'status' => 'pending'],
    ['student_id' => 'STU003', 'student_name' => 'Grace Lutaaya', 'amount' => 1000000, 'payment_method' => 'Cash', 'transaction_id' => 'CS345678', 'date' => '2024-01-20 9:15 AM', 'status' => 'verified'],
    ['student_id' => 'STU004', 'student_name' => 'Joseph Mwanga', 'amount' => 500000, 'payment_method' => 'Mobile Money', 'transaction_id' => 'AIR901234', 'date' => '2024-01-20 8:30 AM', 'status' => 'verified'],
    ['student_id' => 'STU005', 'student_name' => 'Sarah Nalwoga', 'amount' => 3000000, 'payment_method' => 'Cheque', 'transaction_id' => 'CHQ567890', 'date' => '2024-01-20 8:00 AM', 'status' => 'pending']
];

// Mock outstanding balances
$outstanding_balances = [
    ['student_id' => 'STU006', 'student_name' => 'Peter Mukasa', 'program' => 'Nursing Year 3', 'total_fees' => 4200000, 'paid' => 2000000, 'balance' => 2200000, 'overdue_days' => 45, 'last_payment' => '2023-12-05'],
    ['student_id' => 'STU007', 'student_name' => 'Maria Nakato', 'program' => 'Midwifery Year 2', 'total_fees' => 3850000, 'paid' => 1500000, 'balance' => 2350000, 'overdue_days' => 30, 'last_payment' => '2023-12-20'],
    ['student_id' => 'STU008', 'student_name' => 'John Ssenyonjo', 'program' => 'Nursing Year 1', 'total_fees' => 4000000, 'paid' => 1000000, 'balance' => 3000000, 'overdue_days' => 60, 'last_payment' => '2023-11-20'],
    ['student_id' => 'STU009', 'student_name' => 'Grace Babirye', 'program' => 'Short Course', 'total_fees' => 2300000, 'paid' => 500000, 'balance' => 1800000, 'overdue_days' => 15, 'last_payment' => '2024-01-05'],
    ['student_id' => 'STU010', 'student_name' => 'Samuel Kiyimba', 'program' => 'Midwifery Year 2', 'total_fees' => 3850000, 'paid' => 3000000, 'balance' => 850000, 'overdue_days' => 10, 'last_payment' => '2024-01-10']
];

// Mock budget allocations
$budget_allocations = [
    ['department' => 'Academic Affairs', 'annual_budget' => 120000000, 'spent' => 85000000, 'remaining' => 35000000, 'utilization' => 70.8],
    ['department' => 'Administrative', 'annual_budget' => 80000000, 'spent' => 62000000, 'remaining' => 18000000, 'utilization' => 77.5],
    ['department' => 'Hostel Management', 'annual_budget' => 60000000, 'spent' => 45000000, 'remaining' => 15000000, 'utilization' => 75.0],
    ['department' => 'Library Services', 'annual_budget' => 30000000, 'spent' => 22000000, 'remaining' => 8000000, 'utilization' => 73.3],
    ['department' => 'ICT Services', 'annual_budget' => 40000000, 'spent' => 28000000, 'remaining' => 12000000, 'utilization' => 70.0]
];

// Mock pending approvals
$pending_approvals = [
    ['type' => 'Refund Request', 'student' => 'Aisha Nankya', 'amount' => 500000, 'reason' => 'Overpayment', 'requested_by' => 'Accounts Assistant', 'date' => '2024-01-20', 'urgency' => 'medium'],
    ['type' => 'Fee Adjustment', 'student' => 'David Kato', 'amount' => 300000, 'reason' => 'Scholarship Discount', 'requested_by' => 'Academic Registrar', 'date' => '2024-01-19', 'urgency' => 'high'],
    ['type' => 'Expense Claim', 'staff' => 'Procurement Officer', 'amount' => 2500000, 'reason' => 'Office Supplies Purchase', 'requested_by' => 'Admin Office', 'date' => '2024-01-18', 'urgency' => 'medium'],
    ['type' => 'Budget Transfer', 'department' => 'ICT to Library', 'amount' => 1000000, 'reason' => 'Equipment Purchase', 'requested_by' => 'ICT Head', 'date' => '2024-01-17', 'urgency' => 'low'],
    ['type' => 'Sponsorship Approval', 'student' => 'Grace Lutaaya', 'amount' => 2000000, 'reason' => 'Government Sponsorship', 'requested_by' => 'Admissions Office', 'date' => '2024-01-16', 'urgency' => 'high']
];

// Mock payroll data
$payroll_data = [
    ['staff_name' => 'Dr. Sarah Johnson', 'position' => 'Senior Lecturer', 'basic_salary' => 3500000, 'allowances' => 800000, 'deductions' => 450000, 'net_salary' => 3850000, 'status' => 'processed'],
    ['staff_name' => 'Mr. Michael Brown', 'position' => 'School Bursar', 'basic_salary' => 2800000, 'allowances' => 600000, 'deductions' => 380000, 'net_salary' => 3020000, 'status' => 'processed'],
    ['staff_name' => 'Ms. Amina Nakato', 'position' => 'Head Matron', 'basic_salary' => 1200000, 'allowances' => 300000, 'deductions' => 180000, 'net_salary' => 1320000, 'status' => 'pending'],
    ['staff_name' => 'Mr. David Kato', 'position' => 'Security Guard', 'basic_salary' => 800000, 'allowances' => 200000, 'deductions' => 120000, 'net_salary' => 880000, 'status' => 'processed'],
    ['staff_name' => 'Ms. Grace Lutaaya', 'position' => 'Lecturer', 'basic_salary' => 2500000, 'allowances' => 600000, 'deductions' => 400000, 'net_salary' => 2700000, 'status' => 'pending']
];

// Mock inventory financial tracking
$inventory_tracking = [
    ['item' => 'Hospital Beds', 'category' => 'Medical Equipment', 'quantity' => 50, 'unit_cost' => 800000, 'total_cost' => 40000000, 'purchase_date' => '2024-01-15', 'depreciation' => 10, 'current_value' => 36000000],
    ['item' => 'Lab Equipment', 'category' => 'Laboratory', 'quantity' => 30, 'unit_cost' => 500000, 'total_cost' => 15000000, 'purchase_date' => '2024-01-10', 'depreciation' => 15, 'current_value' => 12750000],
    ['item' => 'Text Books', 'category' => 'Library', 'quantity' => 500, 'unit_cost' => 50000, 'total_cost' => 25000000, 'purchase_date' => '2024-01-05', 'depreciation' => 20, 'current_value' => 20000000],
    ['item' => 'Computers', 'category' => 'ICT', 'quantity' => 25, 'unit_cost' => 1200000, 'total_cost' => 30000000, 'purchase_date' => '2023-12-20', 'depreciation' => 25, 'current_value' => 22500000],
    ['item' => 'Office Furniture', 'category' => 'Administration', 'quantity' => 40, 'unit_cost' => 150000, 'total_cost' => 6000000, 'purchase_date' => '2023-12-15', 'depreciation' => 12, 'current_value' => 5280000]
];

// Mock ledger accounts
$ledger_accounts = [
    ['account_code' => '1001', 'account_name' => 'Cash Account', 'account_type' => 'Asset', 'balance' => 45000000, 'last_transaction' => '2024-01-20'],
    ['account_code' => '1002', 'account_name' => 'Bank Account - Stanbic', 'account_type' => 'Asset', 'balance' => 280000000, 'last_transaction' => '2024-01-20'],
    ['account_code' => '2001', 'account_name' => 'Accounts Payable', 'account_type' => 'Liability', 'balance' => 35000000, 'last_transaction' => '2024-01-19'],
    ['account_code' => '2002', 'account_name' => 'Accrued Expenses', 'account_type' => 'Liability', 'balance' => 12000000, 'last_transaction' => '2024-01-18'],
    ['account_code' => '4001', 'account_name' => 'Tuition Income', 'account_type' => 'Revenue', 'balance' => 210000000, 'last_transaction' => '2024-01-20'],
    ['account_code' => '4002', 'account_name' => 'Hostel Income', 'account_type' => 'Revenue', 'balance' => 45000000, 'last_transaction' => '2024-01-19'],
    ['account_code' => '5001', 'account_name' => 'Salaries & Wages', 'account_type' => 'Expense', 'balance' => 120000000, 'last_transaction' => '2024-01-20'],
    ['account_code' => '5002', 'account_name' => 'Utilities', 'account_type' => 'Expense', 'balance' => 15000000, 'last_transaction' => '2024-01-19']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Accountant Dashboard - ISNM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        :root {
            /* Bursar Color Palette - Financial Professional Theme */
            --primary-dark: #1e293b;
            --accent-green: #059669;
            --accent-emerald: #10b981;
            --accent-teal: #14b8a6;
            --accent-blue: #3b82f6;
            --success-green: #22c55e;
            --warning-amber: #f59e0b;
            --danger-red: #ef4444;
            --white: #ffffff;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            
            /* Financial Gradients */
            --gradient-financial: linear-gradient(135deg, var(--primary-dark) 0%, var(--accent-green) 50%, var(--accent-emerald) 100%);
            --gradient-primary: linear-gradient(135deg, var(--primary-dark) 0%, var(--accent-blue) 100%);
            --gradient-success: linear-gradient(135deg, var(--success-green) 0%, #16a34a 100%);
            --gradient-emerald: linear-gradient(135deg, var(--accent-emerald) 0%, #047857 100%);
            --gradient-teal: linear-gradient(135deg, var(--accent-teal) 0%, #0d9488 100%);
            --gradient-warning: linear-gradient(135deg, var(--warning-amber) 0%, #d97706 100%);
            --gradient-danger: linear-gradient(135deg, var(--danger-red) 0%, #dc2626 100%);
            
            /* Shadows */
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.07);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px rgba(0, 0, 0, 0.1);
            --shadow-2xl: 0 25px 50px rgba(0, 0, 0, 0.25);
            --shadow-financial: 0 8px 16px rgba(5, 150, 105, 0.3);
            
            /* Transitions */
            --transition-fast: 150ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-normal: 300ms cubic-bezier(0.4, 0, 0.2, 1);
            
            /* Spacing */
            --space-1: 0.25rem;
            --space-2: 0.5rem;
            --space-3: 0.75rem;
            --space-4: 1rem;
            --space-5: 1.25rem;
            --space-6: 1.5rem;
            --space-8: 2rem;
            --space-10: 2.5rem;
            --space-12: 3rem;
            --space-16: 4rem;
            
            /* Typography */
            --text-xs: 0.75rem;
            --text-sm: 0.875rem;
            --text-base: 1rem;
            --text-lg: 1.125rem;
            --text-xl: 1.25rem;
            --text-2xl: 1.5rem;
            --text-3xl: 1.875rem;
            --text-4xl: 2.25rem;
            
            /* Border Radius */
            --radius-sm: 0.25rem;
            --radius-md: 0.375rem;
            --radius-lg: 0.5rem;
            --radius-xl: 0.75rem;
            --radius-2xl: 1rem;
            --radius-full: 9999px;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, var(--gray-50) 0%, var(--white) 100%);
            color: var(--gray-900);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        .dashboard {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar Navigation */
        .sidebar {
            width: 280px;
            background: var(--white);
            box-shadow: var(--shadow-xl);
            border-right: 1px solid var(--gray-200);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
        }
        
        .sidebar-header {
            padding: var(--space-6);
            background: var(--gradient-financial);
            color: var(--white);
            border-bottom: 2px solid var(--accent-emerald);
        }
        
        .school-logo {
            width: 60px;
            height: 60px;
            border-radius: var(--radius-full);
            margin: 0 auto var(--space-4);
            background: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--primary-dark);
            box-shadow: var(--shadow-lg);
            border: 2px solid var(--accent-emerald);
        }
        
        .user-info {
            text-align: center;
        }
        
        .user-name {
            font-size: var(--text-lg);
            font-weight: 700;
            margin-bottom: var(--space-1);
        }
        
        .user-position {
            font-size: var(--text-sm);
            opacity: 0.9;
            margin-bottom: var(--space-2);
        }
        
        .user-email {
            font-size: var(--text-xs);
            opacity: 0.8;
        }
        
        .nav-menu {
            list-style: none;
            padding: var(--space-4) 0;
        }
        
        .nav-item {
            margin-bottom: var(--space-1);
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            padding: var(--space-3) var(--space-6);
            color: var(--gray-700);
            text-decoration: none;
            transition: all var(--transition-normal);
            border-left: 3px solid transparent;
            font-weight: 500;
        }
        
        .nav-link:hover {
            background: var(--gray-50);
            color: var(--accent-green);
            border-left-color: var(--accent-green);
        }
        
        .nav-link.active {
            background: rgba(5, 150, 105, 0.1);
            color: var(--accent-green);
            border-left-color: var(--accent-green);
        }
        
        .nav-link i {
            width: 20px;
            text-align: center;
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: var(--space-8);
            min-height: 100vh;
        }
        
        /* Header */
        .header {
            background: var(--white);
            border-radius: var(--radius-2xl);
            padding: var(--space-8);
            box-shadow: var(--shadow-lg);
            margin-bottom: var(--space-8);
            border: 1px solid var(--gray-200);
        }
        
        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--space-4);
        }
        
        .header-title {
            font-size: var(--text-3xl);
            font-weight: 800;
            color: var(--primary-dark);
            margin-bottom: var(--space-2);
        }
        
        .header-subtitle {
            color: var(--gray-600);
            font-size: var(--text-lg);
        }
        
        .header-actions {
            display: flex;
            gap: var(--space-3);
        }
        
        .btn {
            padding: var(--space-3) var(--space-6);
            border-radius: var(--radius-lg);
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: var(--space-2);
            transition: all var(--transition-normal);
            border: none;
            cursor: pointer;
            font-size: var(--text-sm);
        }
        
        .btn-primary {
            background: var(--gradient-primary);
            color: var(--white);
            box-shadow: var(--shadow-md);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }
        
        .btn-secondary {
            background: var(--gray-100);
            color: var(--gray-700);
            border: 1px solid var(--gray-200);
        }
        
        .btn-secondary:hover {
            background: var(--gray-200);
        }
        
        .btn-success {
            background: var(--gradient-success);
            color: var(--white);
            box-shadow: var(--shadow-financial);
        }
        
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-xl);
        }
        
        .btn-emerald {
            background: var(--gradient-emerald);
            color: var(--white);
            box-shadow: var(--shadow-financial);
        }
        
        .btn-emerald:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-xl);
        }
        
        .btn-warning {
            background: var(--gradient-warning);
            color: var(--white);
        }
        
        .btn-danger {
            background: var(--gradient-danger);
            color: var(--white);
        }
        
        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: var(--space-6);
            margin-bottom: var(--space-8);
        }
        
        .stat-card {
            background: var(--white);
            border-radius: var(--radius-2xl);
            padding: var(--space-6);
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--gray-200);
            transition: all var(--transition-normal);
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }
        
        .stat-card.success::before {
            background: var(--gradient-success);
        }
        
        .stat-card.emerald::before {
            background: var(--gradient-emerald);
        }
        
        .stat-card.teal::before {
            background: var(--gradient-teal);
        }
        
        .stat-card.warning::before {
            background: var(--gradient-warning);
        }
        
        .stat-card.danger::before {
            background: var(--gradient-danger);
        }
        
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-xl);
        }
        
        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--space-4);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: var(--radius-xl);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--white);
            background: var(--gradient-primary);
            box-shadow: var(--shadow-md);
        }
        
        .stat-icon.success {
            background: var(--gradient-success);
        }
        
        .stat-icon.emerald {
            background: var(--gradient-emerald);
        }
        
        .stat-icon.teal {
            background: var(--gradient-teal);
        }
        
        .stat-icon.warning {
            background: var(--gradient-warning);
        }
        
        .stat-icon.danger {
            background: var(--gradient-danger);
        }
        
        .stat-value {
            font-size: var(--text-4xl);
            font-weight: 800;
            color: var(--primary-dark);
            margin-bottom: var(--space-2);
        }
        
        .stat-label {
            color: var(--gray-600);
            font-size: var(--text-sm);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        .stat-change {
            display: inline-flex;
            align-items: center;
            gap: var(--space-1);
            padding: var(--space-1) var(--space-2);
            border-radius: var(--radius-full);
            font-size: var(--text-xs);
            font-weight: 600;
        }
        
        .stat-change.positive {
            background: rgba(34, 197, 94, 0.1);
            color: var(--success-green);
        }
        
        .stat-change.negative {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-red);
        }
        
        /* Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: var(--space-8);
            margin-bottom: var(--space-8);
        }
        
        .card {
            background: var(--white);
            border-radius: var(--radius-2xl);
            padding: var(--space-6);
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--gray-200);
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--space-6);
            padding-bottom: var(--space-4);
            border-bottom: 1px solid var(--gray-200);
        }
        
        .card-title {
            font-size: var(--text-xl);
            font-weight: 700;
            color: var(--primary-dark);
            display: flex;
            align-items: center;
            gap: var(--space-3);
        }
        
        .card-title i {
            color: var(--accent-emerald);
        }
        
        /* Tables */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: var(--space-4);
        }
        
        .table th,
        .table td {
            padding: var(--space-3);
            text-align: left;
            border-bottom: 1px solid var(--gray-100);
        }
        
        .table th {
            font-weight: 600;
            color: var(--gray-700);
            background: var(--gray-50);
        }
        
        .table tbody tr:hover {
            background: var(--gray-50);
        }
        
        /* Lists */
        .list {
            list-style: none;
        }
        
        .list-item {
            padding: var(--space-4) 0;
            border-bottom: 1px solid var(--gray-100);
            transition: all var(--transition-fast);
        }
        
        .list-item:last-child {
            border-bottom: none;
        }
        
        .list-item:hover {
            background: var(--gray-50);
            margin: 0 calc(-1 * var(--space-6));
            padding: var(--space-4) var(--space-6);
            border-radius: var(--radius-lg);
        }
        
        .list-item-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--space-2);
        }
        
        .list-item-title {
            font-weight: 600;
            color: var(--primary-dark);
        }
        
        .list-item-meta {
            display: flex;
            gap: var(--space-3);
            align-items: center;
        }
        
        .list-item-date {
            font-size: var(--text-xs);
            color: var(--gray-500);
        }
        
        .list-item-status {
            padding: var(--space-1) var(--space-3);
            border-radius: var(--radius-full);
            font-size: var(--text-xs);
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .list-item-status.verified {
            background: rgba(34, 197, 94, 0.1);
            color: var(--success-green);
        }
        
        .list-item-status.pending {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning-amber);
        }
        
        .list-item-status.processed {
            background: rgba(34, 197, 94, 0.1);
            color: var(--success-green);
        }
        
        .urgency-badge {
            padding: var(--space-1) var(--space-2);
            border-radius: var(--radius-full);
            font-size: var(--text-xs);
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .urgency-badge.high {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-red);
        }
        
        .urgency-badge.medium {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning-amber);
        }
        
        .urgency-badge.low {
            background: rgba(34, 197, 94, 0.1);
            color: var(--success-green);
        }
        
        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: var(--space-2);
        }
        
        .action-btn {
            padding: var(--space-2) var(--space-3);
            border-radius: var(--radius-md);
            font-size: var(--text-xs);
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: var(--space-1);
            transition: all var(--transition-fast);
            border: none;
            cursor: pointer;
        }
        
        .action-btn.edit {
            background: rgba(59, 130, 246, 0.1);
            color: var(--accent-blue);
        }
        
        .action-btn.edit:hover {
            background: var(--accent-blue);
            color: var(--white);
        }
        
        .action-btn.delete {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-red);
        }
        
        .action-btn.delete:hover {
            background: var(--danger-red);
            color: var(--white);
        }
        
        .action-btn.print {
            background: rgba(5, 150, 105, 0.1);
            color: var(--accent-green);
        }
        
        .action-btn.print:hover {
            background: var(--accent-green);
            color: var(--white);
        }
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }
        
        .modal.active {
            display: flex;
        }
        
        .modal-content {
            background: var(--white);
            border-radius: var(--radius-2xl);
            padding: var(--space-8);
            max-width: 600px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: var(--shadow-2xl);
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--space-6);
            padding-bottom: var(--space-4);
            border-bottom: 1px solid var(--gray-200);
        }
        
        .modal-title {
            font-size: var(--text-2xl);
            font-weight: 700;
            color: var(--primary-dark);
        }
        
        .close-btn {
            background: none;
            border: none;
            font-size: var(--text-2xl);
            color: var(--gray-500);
            cursor: pointer;
            padding: var(--space-2);
        }
        
        .close-btn:hover {
            color: var(--danger-red);
        }
        
        /* Form Styles */
        .form-group {
            margin-bottom: var(--space-4);
        }
        
        .form-label {
            display: block;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: var(--space-2);
        }
        
        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: var(--space-3);
            border: 1px solid var(--gray-300);
            border-radius: var(--radius-lg);
            font-size: var(--text-base);
            transition: all var(--transition-fast);
        }
        
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: var(--accent-green);
            box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
        }
        
        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }
        
        /* Responsive Design */
        @media (max-width: 1200px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            
            .main-content {
                margin-left: 0;
                padding: var(--space-4);
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .header-top {
                flex-direction: column;
                gap: var(--space-4);
                align-items: flex-start;
            }
        }
        
        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .stat-card, .card {
            animation: fadeIn 0.6s ease-out;
        }
        
        .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.3s; }
        .stat-card:nth-child(4) { animation-delay: 0.4s; }
        .card:nth-child(1) { animation-delay: 0.5s; }
        .card:nth-child(2) { animation-delay: 0.6s; }
    </style>
</head>
<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="school-logo">
                    <i class="fas fa-coins"></i>
                </div>
                <div class="user-info">
                    <div class="user-name"><?php echo htmlspecialchars($bursar['name']); ?></div>
                    <div class="user-position"><?php echo htmlspecialchars($bursar['position']); ?></div>
                    <div class="user-email"><?php echo htmlspecialchars($bursar['email']); ?></div>
                </div>
            </div>
            
            <nav>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>School Accountant</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-graduation-cap"></i>
                            <span>Fee Structure</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-money-bill-wave"></i>
                            <span>Payment Processing</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-file-invoice"></i>
                            <span>Billing & Invoices</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-chart-line"></i>
                            <span>Financial Reports</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-piggy-bank"></i>
                            <span>Budget Management</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-users"></i>
                            <span>Payroll</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-book"></i>
                            <span>Ledger & Accounts</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-boxes"></i>
                            <span>Inventory Tracking</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-bell"></i>
                            <span>Notifications</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-cog"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="login-portal.php" class="nav-link" style="color: var(--danger-red);">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>
        
        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="header-top">
                    <div>
                        <h1 class="header-title">School Accountant Dashboard</h1>
                        <p class="header-subtitle">Chief Financial Officer - Complete School Accounting System</p>
                    </div>
                    <div class="header-actions">
                        <button class="btn btn-secondary" onclick="exportReport()">
                            <i class="fas fa-download"></i>
                            Export Report
                        </button>
                        <button class="btn btn-success" onclick="openModal('paymentModal')">
                            <i class="fas fa-plus"></i>
                            Record Payment
                        </button>
                    </div>
                </div>
            </header>
            
            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card success">
                    <div class="stat-header">
                        <div class="stat-icon success">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i>
                            12%
                        </div>
                    </div>
                    <div class="stat-value">UGX <?php echo number_format($financial_stats['total_collections_today'] / 1000000, 1); ?>M</div>
                    <div class="stat-label">Collections Today</div>
                </div>
                
                <div class="stat-card danger">
                    <div class="stat-header">
                        <div class="stat-icon danger">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="stat-change negative">
                            <i class="fas fa-arrow-up"></i>
                            5%
                        </div>
                    </div>
                    <div class="stat-value">UGX <?php echo number_format($financial_stats['outstanding_fees'] / 1000000, 1); ?>M</div>
                    <div class="stat-label">Outstanding Fees</div>
                </div>
                
                <div class="stat-card emerald">
                    <div class="stat-header">
                        <div class="stat-icon emerald">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i>
                            8%
                        </div>
                    </div>
                    <div class="stat-value"><?php echo $financial_stats['students_cleared']; ?></div>
                    <div class="stat-label">Students Cleared</div>
                </div>
                
                <div class="stat-card warning">
                    <div class="stat-header">
                        <div class="stat-icon warning">
                            <i class="fas fa-user-times"></i>
                        </div>
                        <div class="stat-change negative">
                            <i class="fas fa-arrow-down"></i>
                            3%
                        </div>
                    </div>
                    <div class="stat-value"><?php echo $financial_stats['students_not_cleared']; ?></div>
                    <div class="stat-label">Students Not Cleared</div>
                </div>
            </div>
            
            <!-- Content Grid -->
            <div class="content-grid">
                <!-- Recent Transactions Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-exchange-alt"></i>
                            Recent Transactions
                        </h2>
                        <button class="btn btn-emerald" onclick="openModal('paymentModal')">
                            <i class="fas fa-plus"></i>
                            Add Payment
                        </button>
                    </div>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recent_transactions as $transaction): ?>
                                <tr>
                                    <td>
                                        <div><?php echo htmlspecialchars($transaction['student_name']); ?></div>
                                        <small class="text-gray-500"><?php echo htmlspecialchars($transaction['student_id']); ?></small>
                                    </td>
                                    <td>UGX <?php echo number_format($transaction['amount']); ?></td>
                                    <td><?php echo htmlspecialchars($transaction['payment_method']); ?></td>
                                    <td>
                                        <span class="list-item-status <?php echo $transaction['status']; ?>">
                                            <?php echo htmlspecialchars(ucfirst($transaction['status'])); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-btn edit" onclick="editTransaction('<?php echo $transaction['transaction_id']; ?>')">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="action-btn print" onclick="printReceipt('<?php echo $transaction['transaction_id']; ?>')">
                                                <i class="fas fa-print"></i>
                                            </button>
                                            <button class="action-btn delete" onclick="deleteTransaction('<?php echo $transaction['transaction_id']; ?>')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Outstanding Balances Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-exclamation-triangle"></i>
                            Outstanding Balances
                        </h2>
                        <button class="btn btn-warning" onclick="sendReminders()">
                            <i class="fas fa-bell"></i>
                            Send Reminders
                        </button>
                    </div>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Program</th>
                                <th>Balance</th>
                                <th>Overdue Days</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($outstanding_balances as $balance): ?>
                                <tr>
                                    <td>
                                        <div><?php echo htmlspecialchars($balance['student_name']); ?></div>
                                        <small class="text-gray-500"><?php echo htmlspecialchars($balance['student_id']); ?></small>
                                    </td>
                                    <td><?php echo htmlspecialchars($balance['program']); ?></td>
                                    <td>UGX <?php echo number_format($balance['balance']); ?></td>
                                    <td>
                                        <span class="urgency-badge <?php echo $balance['overdue_days'] > 30 ? 'high' : ($balance['overdue_days'] > 15 ? 'medium' : 'low'); ?>">
                                            <?php echo $balance['overdue_days']; ?> days
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-btn edit" onclick="viewStudentAccount('<?php echo $balance['student_id']; ?>')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="action-btn print" onclick="printStatement('<?php echo $balance['student_id']; ?>')">
                                                <i class="fas fa-print"></i>
                                            </button>
                                            <button class="action-btn delete" onclick="sendReminder('<?php echo $balance['student_id']; ?>')">
                                                <i class="fas fa-bell"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Budget Allocation Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-piggy-bank"></i>
                            Budget Allocation
                        </h2>
                        <button class="btn btn-primary" onclick="openModal('budgetModal')">
                            <i class="fas fa-plus"></i>
                            Create Budget
                        </button>
                    </div>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Department</th>
                                <th>Annual Budget</th>
                                <th>Spent</th>
                                <th>Remaining</th>
                                <th>Utilization</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($budget_allocations as $budget): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($budget['department']); ?></td>
                                    <td>UGX <?php echo number_format($budget['annual_budget']); ?></td>
                                    <td>UGX <?php echo number_format($budget['spent']); ?></td>
                                    <td>UGX <?php echo number_format($budget['remaining']); ?></td>
                                    <td>
                                        <div class="flex items-center">
                                            <div class="w-full bg-gray-200 rounded-full h-2 mr-2">
                                                <div class="bg-<?php echo $budget['utilization'] > 80 ? 'red' : ($budget['utilization'] > 60 ? 'yellow' : 'green'); ?> h-2 rounded-full" style="width: <?php echo $budget['utilization']; ?>%"></div>
                                            </div>
                                            <span class="text-sm"><?php echo $budget['utilization']; ?>%</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-btn edit" onclick="editBudget('<?php echo $budget['department']; ?>')">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="action-btn print" onclick="printBudgetReport('<?php echo $budget['department']; ?>')">
                                                <i class="fas fa-print"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Pending Approvals Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-clipboard-check"></i>
                            Pending Approvals
                        </h2>
                        <button class="btn btn-success" onclick="viewAllApprovals()">
                            <i class="fas fa-list"></i>
                            View All
                        </button>
                    </div>
                    
                    <ul class="list">
                        <?php foreach ($pending_approvals as $approval): ?>
                            <li class="list-item">
                                <div class="list-item-header">
                                    <div class="list-item-title"><?php echo htmlspecialchars($approval['type']); ?></div>
                                    <div class="urgency-badge <?php echo htmlspecialchars($approval['urgency']); ?>">
                                        <?php echo htmlspecialchars(ucfirst($approval['urgency'])); ?>
                                    </div>
                                </div>
                                <div class="list-item-description">
                                    <?php echo htmlspecialchars($approval['reason']); ?> | UGX <?php echo number_format($approval['amount']); ?>
                                    <br>Requested by: <?php echo htmlspecialchars($approval['requested_by']); ?> | Date: <?php echo htmlspecialchars($approval['date']); ?>
                                </div>
                                <div class="action-buttons mt-2">
                                    <button class="btn btn-success" onclick="approveApproval('<?php echo $approval['type']; ?>')">
                                        <i class="fas fa-check"></i> Approve
                                    </button>
                                    <button class="btn btn-danger" onclick="rejectApproval('<?php echo $approval['type']; ?>')">
                                        <i class="fas fa-times"></i> Reject
                                    </button>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </main>
    </div>
    
    <!-- Payment Modal -->
    <div id="paymentModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Record Payment</h2>
                <button class="close-btn" onclick="closeModal('paymentModal')">&times;</button>
            </div>
            <form id="paymentForm">
                <div class="form-group">
                    <label class="form-label">Student ID</label>
                    <input type="text" class="form-input" name="student_id" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Student Name</label>
                    <input type="text" class="form-input" name="student_name" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Amount (UGX)</label>
                    <input type="number" class="form-input" name="amount" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Payment Method</label>
                    <select class="form-select" name="payment_method" required>
                        <option value="">Select Payment Method</option>
                        <option value="Cash">Cash</option>
                        <option value="Bank Deposit">Bank Deposit</option>
                        <option value="Mobile Money">Mobile Money</option>
                        <option value="Cheque">Cheque</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Transaction ID</label>
                    <input type="text" class="form-input" name="transaction_id">
                </div>
                <div class="form-group">
                    <label class="form-label">Notes</label>
                    <textarea class="form-textarea" name="notes"></textarea>
                </div>
                <div class="action-buttons">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Save Payment
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal('paymentModal')">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Budget Modal -->
    <div id="budgetModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Create Budget</h2>
                <button class="close-btn" onclick="closeModal('budgetModal')">&times;</button>
            </div>
            <form id="budgetForm">
                <div class="form-group">
                    <label class="form-label">Department</label>
                    <select class="form-select" name="department" required>
                        <option value="">Select Department</option>
                        <option value="Academic Affairs">Academic Affairs</option>
                        <option value="Administrative">Administrative</option>
                        <option value="Hostel Management">Hostel Management</option>
                        <option value="Library Services">Library Services</option>
                        <option value="ICT Services">ICT Services</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Budget Period</label>
                    <select class="form-select" name="period" required>
                        <option value="">Select Period</option>
                        <option value="Annual">Annual</option>
                        <option value="Semester 1">Semester 1</option>
                        <option value="Semester 2">Semester 2</option>
                        <option value="Monthly">Monthly</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Budget Amount (UGX)</label>
                    <input type="number" class="form-input" name="budget_amount" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea class="form-textarea" name="description"></textarea>
                </div>
                <div class="action-buttons">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Create Budget
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal('budgetModal')">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        // Modal functions
        function openModal(modalId) {
            document.getElementById(modalId).classList.add('active');
        }
        
        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }
        
        // Payment form submission
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Simulate payment processing
            alert('Payment recorded successfully!');
            closeModal('paymentModal');
            this.reset();
        });
        
        // Budget form submission
        document.getElementById('budgetForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Simulate budget creation
            alert('Budget created successfully!');
            closeModal('budgetModal');
            this.reset();
        });
        
        // Action functions
        function editTransaction(transactionId) {
            alert('Edit transaction: ' + transactionId);
        }
        
        function printReceipt(transactionId) {
            alert('Print receipt: ' + transactionId);
        }
        
        function deleteTransaction(transactionId) {
            if (confirm('Are you sure you want to delete this transaction?')) {
                alert('Transaction deleted: ' + transactionId);
            }
        }
        
        function viewStudentAccount(studentId) {
            alert('View student account: ' + studentId);
        }
        
        function printStatement(studentId) {
            alert('Print statement: ' + studentId);
        }
        
        function sendReminder(studentId) {
            alert('Send reminder: ' + studentId);
        }
        
        function sendReminders() {
            alert('Sending reminders to all students with outstanding balances...');
        }
        
        function editBudget(department) {
            alert('Edit budget for: ' + department);
        }
        
        function printBudgetReport(department) {
            alert('Print budget report: ' + department);
        }
        
        function approveApproval(type) {
            alert('Approved: ' + type);
        }
        
        function rejectApproval(type) {
            alert('Rejected: ' + type);
        }
        
        function viewAllApprovals() {
            alert('View all pending approvals...');
        }
        
        function exportReport() {
            alert('Exporting financial report...');
        }
        
        // Navigation handling
        document.addEventListener('DOMContentLoaded', function() {
            // Handle navigation clicks
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', function(e) {
                    if (this.getAttribute('href') === '#') {
                        e.preventDefault();
                    }
                    
                    // Remove active class from all links
                    document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                    
                    // Add active class to clicked link
                    this.classList.add('active');
                });
            });
            
            // Handle button clicks with visual feedback
            document.querySelectorAll('.btn, .action-btn').forEach(button => {
                button.addEventListener('click', function() {
                    // Add ripple effect
                    const ripple = document.createElement('span');
                    ripple.style.position = 'absolute';
                    ripple.style.borderRadius = '50%';
                    ripple.style.background = 'rgba(255,255,255,0.5)';
                    ripple.style.width = ripple.style.height = '40px';
                    ripple.style.marginLeft = '-20px';
                    ripple.style.marginTop = '-20px';
                    ripple.style.animation = 'ripple 0.6s';
                    ripple.style.pointerEvents = 'none';
                    
                    this.style.position = 'relative';
                    this.style.overflow = 'hidden';
                    this.appendChild(ripple);
                    
                    setTimeout(() => ripple.remove(), 600);
                });
            });
        });
        
        // Add ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
