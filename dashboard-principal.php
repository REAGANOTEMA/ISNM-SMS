<?php
// Start session
session_start();

// Check if user is logged in and is principal
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'principal') {
    header('Location: login-portal.php');
    exit();
}

// Mock principal data - in production, this would come from database
$principal = [
    'id' => 'PRINC001',
    'name' => 'Dr. Sarah Johnson',
    'position' => 'Principal',
    'email' => 'principal@isnm.ac.ug',
    'phone' => '+256 772 514 889',
    'department' => 'Principal Office',
    'join_date' => '2019-06-01'
];

// Mock school statistics for comprehensive dashboard
$school_stats = [
    'total_students' => 1250,
    'total_staff' => 156,
    'active_courses' => 24,
    'recent_activities' => 89,
    'pass_rate' => 92.5,
    'attendance_rate' => 94.2,
    'graduation_rate' => 96.8,
    'employment_rate' => 91.5
];

// Mock department summaries
$department_summaries = [
    ['department' => 'Academic Affairs', 'staff_count' => 45, 'admin_count' => 8, 'lecturer_count' => 35, 'support_count' => 2],
    ['department' => 'Clinical Skills', 'staff_count' => 28, 'admin_count' => 3, 'lecturer_count' => 20, 'support_count' => 5],
    ['department' => 'Student Affairs', 'staff_count' => 22, 'admin_count' => 5, 'lecturer_count' => 12, 'support_count' => 5],
    ['department' => 'Finance & Admin', 'staff_count' => 18, 'admin_count' => 10, 'lecturer_count' => 0, 'support_count' => 8],
    ['department' => 'Library Services', 'staff_count' => 12, 'admin_count' => 2, 'lecturer_count' => 5, 'support_count' => 5],
    ['department' => 'Hostel Management', 'staff_count' => 15, 'admin_count' => 3, 'lecturer_count' => 0, 'support_count' => 12],
    ['department' => 'ICT Services', 'staff_count' => 8, 'admin_count' => 2, 'lecturer_count' => 3, 'support_count' => 3],
    ['department' => 'Support Services', 'staff_count' => 8, 'admin_count' => 1, 'lecturer_count' => 0, 'support_count' => 7]
];

// Mock recent activities
$recent_activities = [
    ['type' => 'meeting', 'title' => 'Staff Meeting - Academic Planning', 'date' => '2024-01-20', 'department' => 'Academic Affairs', 'status' => 'completed'],
    ['type' => 'inspection', 'title' => 'Clinical Skills Lab Inspection', 'date' => '2024-01-19', 'department' => 'Clinical Skills', 'status' => 'completed'],
    ['type' => 'event', 'title' => 'Student Orientation Day', 'date' => '2024-01-18', 'department' => 'Student Affairs', 'status' => 'completed'],
    ['type' => 'audit', 'title' => 'Financial Audit Q1', 'date' => '2024-01-17', 'department' => 'Finance & Admin', 'status' => 'in_progress'],
    ['type' => 'training', 'title' => 'Staff Development Workshop', 'date' => '2024-01-16', 'department' => 'HR', 'status' => 'completed'],
    ['type' => 'inspection', 'title' => 'Hostel Facilities Inspection', 'date' => '2024-01-15', 'department' => 'Hostel Management', 'status' => 'pending']
];

// Mock pending approvals
$pending_approvals = [
    ['type' => 'leave', 'title' => 'Staff Leave Request', 'staff_name' => 'Ms. Amina Nakato', 'department' => 'Academic Affairs', 'urgency' => 'medium'],
    ['type' => 'budget', 'title' => 'Equipment Purchase Request', 'staff_name' => 'Dr. James Mugisha', 'department' => 'Clinical Skills', 'amount' => 'UGX 15,000,000', 'urgency' => 'high'],
    ['type' => 'policy', 'title' => 'New Academic Policy', 'staff_name' => 'Prof. Grace Nankya', 'department' => 'Academic Affairs', 'urgency' => 'medium'],
    ['type' => 'event', 'title' => 'Student Event Approval', 'staff_name' => 'Mr. David Kato', 'department' => 'Student Affairs', 'urgency' => 'low'],
    ['type' => 'hiring', 'title' => 'New Staff Recruitment', 'staff_name' => 'HR Department', 'department' => 'HR', 'positions' => 3, 'urgency' => 'high']
];

// Mock academic performance
$academic_performance = [
    'nursing_program' => [
        'students' => 680,
        'pass_rate' => 94.2,
        'top_performer' => 'Sarah Nalwoga',
        'average_grade' => 'B+'
    ],
    'midwifery_program' => [
        'students' => 420,
        'pass_rate' => 91.8,
        'top_performer' => 'Grace Lutaaya',
        'average_grade' => 'B'
    ],
    'short_courses' => [
        'students' => 150,
        'pass_rate' => 96.5,
        'top_performer' => 'Joseph Mwanga',
        'average_grade' => 'A-'
    ]
];

// Mock upcoming events
$upcoming_events = [
    ['title' => 'Board of Governors Meeting', 'date' => '2024-01-25', 'type' => 'meeting', 'location' => 'Board Room'],
    ['title' => 'Graduation Ceremony', 'date' => '2024-02-10', 'type' => 'ceremony', 'location' => 'Main Hall'],
    ['title' => 'Staff Training Workshop', 'date' => '2024-01-28', 'type' => 'training', 'location' => 'Conference Room'],
    ['title' => 'Open Day', 'date' => '2024-02-15', 'type' => 'event', 'location' => 'Campus'],
    ['title' => 'NCHE Accreditation Visit', 'date' => '2024-02-20', 'type' => 'inspection', 'location' => 'Campus']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal Dashboard - ISNM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        :root {
            /* Principal Color Palette */
            --primary-dark: #1a365d;
            --accent-blue: #2563eb;
            --accent-gold: #FFD700;
            --executive-gray: #2c3e50;
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
            
            /* Principal Gradients */
            --gradient-executive: linear-gradient(135deg, var(--primary-dark) 0%, var(--executive-gray) 50%, var(--accent-gold) 100%);
            --gradient-primary: linear-gradient(135deg, var(--primary-dark) 0%, var(--accent-blue) 100%);
            --gradient-luxury: linear-gradient(135deg, var(--accent-gold) 0%, #fbbf24 100%);
            --gradient-success: linear-gradient(135deg, var(--success-green) 0%, #16a34a 100%);
            --gradient-warning: linear-gradient(135deg, var(--warning-amber) 0%, #d97706 100%);
            --gradient-danger: linear-gradient(135deg, var(--danger-red) 0%, #dc2626 100%);
            
            /* Shadows */
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.07);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px rgba(0, 0, 0, 0.1);
            --shadow-2xl: 0 25px 50px rgba(0, 0, 0, 0.25);
            --shadow-luxury: 0 8px 16px rgba(212, 175, 55, 0.3);
            
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
            background: var(--gradient-executive);
            color: var(--white);
            border-bottom: 2px solid var(--accent-gold);
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
            border: 2px solid var(--accent-gold);
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
        
        .btn-luxury {
            background: var(--gradient-luxury);
            color: var(--primary-dark);
            box-shadow: var(--shadow-luxury);
        }
        
        .btn-luxury:hover {
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
        
        .stat-card.luxury::before {
            background: var(--gradient-luxury);
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
        
        .stat-icon.luxury {
            background: var(--gradient-luxury);
            color: var(--primary-dark);
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
            color: var(--accent-gold);
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
        
        .list-item-status.completed {
            background: rgba(34, 197, 94, 0.1);
            color: var(--success-green);
        }
        
        .list-item-status.in_progress {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning-amber);
        }
        
        .list-item-status.pending {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-red);
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
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="user-info">
                    <div class="user-name"><?php echo htmlspecialchars($principal['name']); ?></div>
                    <div class="user-position"><?php echo htmlspecialchars($principal['position']); ?></div>
                    <div class="user-email"><?php echo htmlspecialchars($principal['email']); ?></div>
                </div>
            </div>
            
            <nav>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Principal Dashboard</span>
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
                            <i class="fas fa-graduation-cap"></i>
                            <span>Academic Affairs</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-chart-line"></i>
                            <span>Performance Reports</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-clipboard-check"></i>
                            <span>Approvals</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-calendar"></i>
                            <span>Events & Meetings</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-building"></i>
                            <span>Departments</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-bullhorn"></i>
                            <span>Announcements</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-file-alt"></i>
                            <span>Reports</span>
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
                        <h1 class="header-title">Principal Dashboard</h1>
                        <p class="header-subtitle">Institutional Administration & Academic Oversight</p>
                    </div>
                    <div class="header-actions">
                        <button class="btn btn-secondary">
                            <i class="fas fa-download"></i>
                            Export Report
                        </button>
                        <button class="btn btn-luxury">
                            <i class="fas fa-calendar-plus"></i>
                            Schedule Meeting
                        </button>
                    </div>
                </div>
            </header>
            
            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card luxury">
                    <div class="stat-header">
                        <div class="stat-icon luxury">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i>
                            12%
                        </div>
                    </div>
                    <div class="stat-value"><?php echo number_format($school_stats['total_students']); ?></div>
                    <div class="stat-label">Total Students</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i>
                            8%
                        </div>
                    </div>
                    <div class="stat-value"><?php echo number_format($school_stats['total_staff']); ?></div>
                    <div class="stat-label">Total Staff</div>
                </div>
                
                <div class="stat-card success">
                    <div class="stat-header">
                        <div class="stat-icon success">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i>
                            3%
                        </div>
                    </div>
                    <div class="stat-value"><?php echo $school_stats['pass_rate']; ?>%</div>
                    <div class="stat-label">Pass Rate</div>
                </div>
                
                <div class="stat-card warning">
                    <div class="stat-header">
                        <div class="stat-icon warning">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i>
                            5%
                        </div>
                    </div>
                    <div class="stat-value"><?php echo $school_stats['active_courses']; ?></div>
                    <div class="stat-label">Active Courses</div>
                </div>
            </div>
            
            <!-- Content Grid -->
            <div class="content-grid">
                <!-- Department Overview Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-building"></i>
                            Department Overview
                        </h2>
                        <button class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            View All
                        </button>
                    </div>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Department</th>
                                <th>Staff Count</th>
                                <th>Admin</th>
                                <th>Lecturers</th>
                                <th>Support</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($department_summaries as $dept): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($dept['department']); ?></td>
                                    <td><?php echo $dept['staff_count']; ?></td>
                                    <td><?php echo $dept['admin_count']; ?></td>
                                    <td><?php echo $dept['lecturer_count']; ?></td>
                                    <td><?php echo $dept['support_count']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Recent Activities Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-history"></i>
                            Recent Activities
                        </h2>
                        <button class="btn btn-secondary">
                            <i class="fas fa-eye"></i>
                            View All
                        </button>
                    </div>
                    
                    <ul class="list">
                        <?php foreach ($recent_activities as $activity): ?>
                            <li class="list-item">
                                <div class="list-item-header">
                                    <div class="list-item-title"><?php echo htmlspecialchars($activity['title']); ?></div>
                                    <div class="list-item-status <?php echo str_replace('_', '-', $activity['status']); ?>">
                                        <?php echo htmlspecialchars(ucwords(str_replace('_', ' ', $activity['status']))); ?>
                                    </div>
                                </div>
                                <div class="list-item-meta">
                                    <span class="list-item-date"><?php echo htmlspecialchars($activity['date']); ?></span>
                                    <span class="urgency-badge medium">
                                        <?php echo htmlspecialchars(ucfirst($activity['type'])); ?>
                                    </span>
                                </div>
                                <div class="list-item-description">
                                    Department: <?php echo htmlspecialchars($activity['department']); ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                
                <!-- Pending Approvals Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-clipboard-check"></i>
                            Pending Approvals
                        </h2>
                        <button class="btn btn-primary">
                            <i class="fas fa-rocket"></i>
                            Review All
                        </button>
                    </div>
                    
                    <ul class="list">
                        <?php foreach ($pending_approvals as $approval): ?>
                            <li class="list-item">
                                <div class="list-item-header">
                                    <div class="list-item-title"><?php echo htmlspecialchars($approval['title']); ?></div>
                                    <div class="urgency-badge <?php echo htmlspecialchars($approval['urgency']); ?>">
                                        <?php echo htmlspecialchars(ucfirst($approval['urgency'])); ?>
                                    </div>
                                </div>
                                <div class="list-item-description">
                                    By: <?php echo htmlspecialchars($approval['staff_name']); ?> - <?php echo htmlspecialchars($approval['department']); ?>
                                    <?php if (isset($approval['amount'])): ?>
                                        <br>Amount: <?php echo htmlspecialchars($approval['amount']); ?>
                                    <?php endif; ?>
                                    <?php if (isset($approval['positions'])): ?>
                                        <br>Positions: <?php echo $approval['positions']; ?>
                                    <?php endif; ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                
                <!-- Academic Performance Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-chart-line"></i>
                            Academic Performance
                        </h2>
                        <button class="btn btn-luxury">
                            <i class="fas fa-file-invoice"></i>
                            Full Report
                        </button>
                    </div>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Program</th>
                                <th>Students</th>
                                <th>Pass Rate</th>
                                <th>Top Performer</th>
                                <th>Avg Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($academic_performance as $program => $data): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars(ucwords(str_replace('_', ' ', $program))); ?></td>
                                    <td><?php echo $data['students']; ?></td>
                                    <td><?php echo $data['pass_rate']; ?>%</td>
                                    <td><?php echo htmlspecialchars($data['top_performer']); ?></td>
                                    <td><?php echo htmlspecialchars($data['average_grade']); ?></td>
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
