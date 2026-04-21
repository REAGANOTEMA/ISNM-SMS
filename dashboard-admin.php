<?php
// Start session
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: login-portal.php');
    exit();
}

// Mock admin data - in production, this would come from database
$admin = [
    'id' => 'ADMIN001',
    'name' => 'Mr. Michael Brown',
    'position' => 'Academic Registrar',
    'email' => 'admin@isnm.ac.ug',
    'phone' => '+256 772 514 889',
    'department' => 'Academic Affairs',
    'join_date' => '2018-03-15'
];

// Mock administrative data for comprehensive dashboard
$admin_stats = [
    'total_students' => 1250,
    'total_applications' => 342,
    'pending_registrations' => 58,
    'active_programs' => 8,
    'staff_on_leave' => 12,
    'pending_requests' => 23,
    'documents_processed' => 156,
    'meetings_scheduled' => 8
];

// Mock student applications
$student_applications = [
    ['name' => 'Aisha Nankya', 'program' => 'Nursing', 'application_date' => '2024-01-20', 'status' => 'pending_review', 'urgency' => 'high'],
    ['name' => 'David Kato', 'program' => 'Midwifery', 'application_date' => '2024-01-19', 'status' => 'under_review', 'urgency' => 'medium'],
    ['name' => 'Grace Lutaaya', 'program' => 'Nursing', 'application_date' => '2024-01-18', 'status' => 'approved', 'urgency' => 'low'],
    ['name' => 'Joseph Mwanga', 'program' => 'Short Course', 'application_date' => '2024-01-17', 'status' => 'pending_review', 'urgency' => 'high'],
    ['name' => 'Sarah Nalwoga', 'program' => 'Midwifery', 'application_date' => '2024-01-16', 'status' => 'rejected', 'urgency' => 'medium']
];

// Mock staff management data
$staff_management = [
    ['name' => 'Dr. Sarah Johnson', 'position' => 'Senior Lecturer', 'department' => 'Nursing', 'status' => 'active', 'leave_balance' => 15],
    ['name' => 'Prof. James Mugisha', 'position' => 'Head of Department', 'department' => 'Clinical Skills', 'status' => 'on_leave', 'leave_balance' => 0],
    ['name' => 'Ms. Grace Nankya', 'position' => 'Lecturer', 'department' => 'Midwifery', 'status' => 'active', 'leave_balance' => 20],
    ['name' => 'Mr. David Kato', 'position' => 'Administrative Assistant', 'department' => 'Admin', 'status' => 'active', 'leave_balance' => 18],
    ['name' => 'Ms. Amina Nakato', 'position' => 'Librarian', 'department' => 'Library', 'status' => 'active', 'leave_balance' => 22]
];

// Mock pending requests
$pending_requests = [
    ['type' => 'leave', 'title' => 'Annual Leave Request', 'staff_name' => 'Prof. James Mugisha', 'department' => 'Clinical Skills', 'duration' => '21 days', 'urgency' => 'medium'],
    ['type' => 'budget', 'title' => 'Office Supplies Budget', 'staff_name' => 'Mr. David Kato', 'department' => 'Admin', 'amount' => 'UGX 2,500,000', 'urgency' => 'high'],
    ['type' => 'equipment', 'title' => 'New Computer Request', 'staff_name' => 'Ms. Grace Nankya', 'department' => 'Midwifery', 'quantity' => 2, 'urgency' => 'medium'],
    ['type' => 'training', 'title' => 'Professional Development', 'staff_name' => 'Dr. Sarah Johnson', 'department' => 'Nursing', 'cost' => 'UGX 1,200,000', 'urgency' => 'low'],
    ['type' => 'maintenance', 'title' => 'Office Repair Request', 'staff_name' => 'Ms. Amina Nakato', 'department' => 'Library', 'urgency' => 'high']
];

// Mock document management
$document_management = [
    ['name' => 'Student Handbook 2024', 'type' => 'policy', 'uploaded_by' => 'Academic Office', 'date' => '2024-01-15', 'status' => 'published'],
    ['name' => 'Curriculum Revision', 'type' => 'academic', 'uploaded_by' => 'Dr. Sarah Johnson', 'date' => '2024-01-14', 'status' => 'under_review'],
    ['name' => 'Staff Manual Update', 'type' => 'policy', 'uploaded_by' => 'HR Department', 'date' => '2024-01-13', 'status' => 'draft'],
    ['name' => 'Exam Schedule Q1', 'type' => 'academic', 'uploaded_by' => 'Academic Registrar', 'date' => '2024-01-12', 'status' => 'published'],
    ['name' => 'Library Policy', 'type' => 'policy', 'uploaded_by' => 'Ms. Amina Nakato', 'date' => '2024-01-11', 'status' => 'approved']
];

// Mock meeting schedules
$meeting_schedules = [
    ['title' => 'Academic Board Meeting', 'date' => '2024-01-25', 'time' => '10:00 AM', 'location' => 'Board Room', 'attendees' => 12],
    ['title' => 'Staff Performance Review', 'date' => '2024-01-26', 'time' => '2:00 PM', 'location' => 'Conference Room', 'attendees' => 8],
    ['title' => 'Curriculum Committee', 'date' => '2024-01-28', 'time' => '9:00 AM', 'location' => 'Meeting Room A', 'attendees' => 6],
    ['title' => 'Budget Planning Session', 'date' => '2024-01-30', 'time' => '11:00 AM', 'location' => 'Finance Office', 'attendees' => 5],
    ['title' => 'Student Disciplinary Hearing', 'date' => '2024-02-01', 'time' => '3:00 PM', 'location' => 'Principal Office', 'attendees' => 4]
];

// Mock financial overview
$financial_overview = [
    'month' => 'January 2024',
    'total_income' => 280000000,
    'tuition_income' => 210000000,
    'other_income' => 70000000,
    'total_expenses' => 180000000,
    'staff_salaries' => 120000000,
    'operational_costs' => 60000000,
    'net_profit' => 100000000,
    'budget_utilization' => 78.5
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - ISNM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        :root {
            /* Admin Color Palette */
            --primary-dark: #1e293b;
            --accent-blue: #2563eb;
            --accent-teal: #14b8a6;
            --accent-purple: #8b5cf6;
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
            
            /* Admin Gradients */
            --gradient-admin: linear-gradient(135deg, var(--primary-dark) 0%, var(--accent-blue) 50%, var(--accent-teal) 100%);
            --gradient-primary: linear-gradient(135deg, var(--primary-dark) 0%, var(--accent-blue) 100%);
            --gradient-teal: linear-gradient(135deg, var(--accent-teal) 0%, #0d9488 100%);
            --gradient-purple: linear-gradient(135deg, var(--accent-purple) 0%, #7c3aed 100%);
            --gradient-success: linear-gradient(135deg, var(--success-green) 0%, #16a34a 100%);
            --gradient-warning: linear-gradient(135deg, var(--warning-amber) 0%, #d97706 100%);
            --gradient-danger: linear-gradient(135deg, var(--danger-red) 0%, #dc2626 100%);
            
            /* Shadows */
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.07);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px rgba(0, 0, 0, 0.1);
            --shadow-2xl: 0 25px 50px rgba(0, 0, 0, 0.25);
            --shadow-admin: 0 8px 16px rgba(37, 99, 235, 0.3);
            
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
            background: var(--gradient-admin);
            color: var(--white);
            border-bottom: 2px solid var(--accent-teal);
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
            border: 2px solid var(--accent-teal);
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
            color: var(--accent-blue);
            border-left-color: var(--accent-blue);
        }
        
        .nav-link.active {
            background: rgba(37, 99, 235, 0.1);
            color: var(--accent-blue);
            border-left-color: var(--accent-blue);
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
        
        .btn-teal {
            background: var(--gradient-teal);
            color: var(--white);
            box-shadow: var(--shadow-admin);
        }
        
        .btn-teal:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-xl);
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
        
        .stat-card.teal::before {
            background: var(--gradient-teal);
        }
        
        .stat-card.purple::before {
            background: var(--gradient-purple);
        }
        
        .stat-card.success::before {
            background: var(--gradient-success);
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
        
        .stat-icon.teal {
            background: var(--gradient-teal);
        }
        
        .stat-icon.purple {
            background: var(--gradient-purple);
        }
        
        .stat-icon.success {
            background: var(--gradient-success);
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
            color: var(--accent-teal);
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
        
        .list-item-status.pending_review {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning-amber);
        }
        
        .list-item-status.under_review {
            background: rgba(37, 99, 235, 0.1);
            color: var(--accent-blue);
        }
        
        .list-item-status.approved {
            background: rgba(34, 197, 94, 0.1);
            color: var(--success-green);
        }
        
        .list-item-status.rejected {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-red);
        }
        
        .list-item-status.active {
            background: rgba(34, 197, 94, 0.1);
            color: var(--success-green);
        }
        
        .list-item-status.on_leave {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning-amber);
        }
        
        .list-item-description {
            color: var(--gray-600);
            font-size: var(--text-sm);
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
                    <i class="fas fa-users-cog"></i>
                </div>
                <div class="user-info">
                    <div class="user-name"><?php echo htmlspecialchars($admin['name']); ?></div>
                    <div class="user-position"><?php echo htmlspecialchars($admin['position']); ?></div>
                    <div class="user-email"><?php echo htmlspecialchars($admin['email']); ?></div>
                </div>
            </div>
            
            <nav>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Admin Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-user-plus"></i>
                            <span>Student Applications</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-users"></i>
                            <span>Staff Management</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-clipboard-check"></i>
                            <span>Pending Requests</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-file-alt"></i>
                            <span>Document Management</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-calendar"></i>
                            <span>Meeting Schedules</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-money-bill-wave"></i>
                            <span>Financial Overview</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-graduation-cap"></i>
                            <span>Academic Records</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-chart-bar"></i>
                            <span>Reports & Analytics</span>
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
                        <h1 class="header-title">Administrative Dashboard</h1>
                        <p class="header-subtitle">Institutional Management & Student Services</p>
                    </div>
                    <div class="header-actions">
                        <button class="btn btn-secondary">
                            <i class="fas fa-download"></i>
                            Export Report
                        </button>
                        <button class="btn btn-teal">
                            <i class="fas fa-calendar-plus"></i>
                            Schedule Meeting
                        </button>
                    </div>
                </div>
            </header>
            
            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card teal">
                    <div class="stat-header">
                        <div class="stat-icon teal">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i>
                            15%
                        </div>
                    </div>
                    <div class="stat-value"><?php echo number_format($admin_stats['total_applications']); ?></div>
                    <div class="stat-label">Total Applications</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-change negative">
                            <i class="fas fa-arrow-down"></i>
                            8%
                        </div>
                    </div>
                    <div class="stat-value"><?php echo $admin_stats['pending_registrations']; ?></div>
                    <div class="stat-label">Pending Registrations</div>
                </div>
                
                <div class="stat-card purple">
                    <div class="stat-header">
                        <div class="stat-icon purple">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i>
                            5%
                        </div>
                    </div>
                    <div class="stat-value"><?php echo $admin_stats['staff_on_leave']; ?></div>
                    <div class="stat-label">Staff on Leave</div>
                </div>
                
                <div class="stat-card success">
                    <div class="stat-header">
                        <div class="stat-icon success">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i>
                            12%
                        </div>
                    </div>
                    <div class="stat-value"><?php echo $admin_stats['documents_processed']; ?></div>
                    <div class="stat-label">Documents Processed</div>
                </div>
            </div>
            
            <!-- Content Grid -->
            <div class="content-grid">
                <!-- Student Applications Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-user-plus"></i>
                            Student Applications
                        </h2>
                        <button class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Review All
                        </button>
                    </div>
                    
                    <ul class="list">
                        <?php foreach ($student_applications as $application): ?>
                            <li class="list-item">
                                <div class="list-item-header">
                                    <div class="list-item-title"><?php echo htmlspecialchars($application['name']); ?></div>
                                    <div class="list-item-status <?php echo str_replace('_', '', $application['status']); ?>">
                                        <?php echo htmlspecialchars(ucwords(str_replace('_', ' ', $application['status']))); ?>
                                    </div>
                                </div>
                                <div class="list-item-meta">
                                    <span class="list-item-date"><?php echo htmlspecialchars($application['application_date']); ?></span>
                                    <span class="urgency-badge <?php echo htmlspecialchars($application['urgency']); ?>">
                                        <?php echo htmlspecialchars(ucfirst($application['urgency'])); ?>
                                    </span>
                                </div>
                                <div class="list-item-description">
                                    Program: <?php echo htmlspecialchars($application['program']); ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                
                <!-- Staff Management Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-users"></i>
                            Staff Management
                        </h2>
                        <button class="btn btn-teal">
                            <i class="fas fa-plus"></i>
                            Add Staff
                        </button>
                    </div>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th>Leave Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($staff_management as $staff): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($staff['name']); ?></td>
                                    <td><?php echo htmlspecialchars($staff['position']); ?></td>
                                    <td><?php echo htmlspecialchars($staff['department']); ?></td>
                                    <td>
                                        <span class="list-item-status <?php echo str_replace('_', '', $staff['status']); ?>">
                                            <?php echo htmlspecialchars(ucwords(str_replace('_', ' ', $staff['status']))); ?>
                                        </span>
                                    </td>
                                    <td><?php echo $staff['leave_balance']; ?> days</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Pending Requests Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-clipboard-check"></i>
                            Pending Requests
                        </h2>
                        <button class="btn btn-primary">
                            <i class="fas fa-rocket"></i>
                            Process All
                        </button>
                    </div>
                    
                    <ul class="list">
                        <?php foreach ($pending_requests as $request): ?>
                            <li class="list-item">
                                <div class="list-item-header">
                                    <div class="list-item-title"><?php echo htmlspecialchars($request['title']); ?></div>
                                    <div class="urgency-badge <?php echo htmlspecialchars($request['urgency']); ?>">
                                        <?php echo htmlspecialchars(ucfirst($request['urgency'])); ?>
                                    </div>
                                </div>
                                <div class="list-item-description">
                                    By: <?php echo htmlspecialchars($request['staff_name']); ?> - <?php echo htmlspecialchars($request['department']); ?>
                                    <?php if (isset($request['duration'])): ?>
                                        <br>Duration: <?php echo htmlspecialchars($request['duration']); ?>
                                    <?php endif; ?>
                                    <?php if (isset($request['amount'])): ?>
                                        <br>Amount: <?php echo htmlspecialchars($request['amount']); ?>
                                    <?php endif; ?>
                                    <?php if (isset($request['quantity'])): ?>
                                        <br>Quantity: <?php echo $request['quantity']; ?>
                                    <?php endif; ?>
                                    <?php if (isset($request['cost'])): ?>
                                        <br>Cost: <?php echo htmlspecialchars($request['cost']); ?>
                                    <?php endif; ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                
                <!-- Document Management Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-file-alt"></i>
                            Document Management
                        </h2>
                        <button class="btn btn-secondary">
                            <i class="fas fa-upload"></i>
                            Upload Document
                        </button>
                    </div>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Document Name</th>
                                <th>Type</th>
                                <th>Uploaded By</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($document_management as $doc): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($doc['name']); ?></td>
                                    <td><?php echo htmlspecialchars(ucfirst($doc['type'])); ?></td>
                                    <td><?php echo htmlspecialchars($doc['uploaded_by']); ?></td>
                                    <td><?php echo htmlspecialchars($doc['date']); ?></td>
                                    <td>
                                        <span class="list-item-status <?php echo str_replace('_', '', $doc['status']); ?>">
                                            <?php echo htmlspecialchars(ucwords(str_replace('_', ' ', $doc['status']))); ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    
    <script>
        // Add interactive functionality
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
            document.querySelectorAll('.btn').forEach(button => {
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
