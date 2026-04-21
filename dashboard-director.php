<?php
// Start session
session_start();

// Check if user is logged in and is a director
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'director') {
    header('Location: login-portal.php');
    exit();
}

// Mock director data - in production, this would come from database
$director = [
    'id' => 'DIR001',
    'name' => 'Dr. John Smith',
    'position' => 'Director General',
    'email' => 'director@isnm.ac.ug',
    'phone' => '+256 772 514 889',
    'department' => 'Executive Management',
    'join_date' => '2020-01-15'
];

// Mock executive data for comprehensive dashboard
$institution_stats = [
    'total_students' => 1250,
    'total_staff' => 156,
    'academic_programs' => 8,
    'annual_budget' => 2500000000, // UGX 2.5B
    'accreditation_status' => 'Fully Accredited',
    'pass_rate' => 92.5,
    'research_projects' => 24,
    'partnerships' => 18
];

$directors_team = [
    ['name' => 'Dr. John Smith', 'position' => 'Director General', 'department' => 'Executive', 'status' => 'Active'],
    ['name' => 'Prof. Sarah Johnson', 'position' => 'Director Academics', 'department' => 'Academic Affairs', 'status' => 'Active'],
    ['name' => 'Mr. Michael Brown', 'position' => 'Director Finance', 'department' => 'Finance', 'status' => 'Active'],
    ['name' => 'Dr. Emily Davis', 'position' => 'Director ICT', 'department' => 'Technology', 'status' => 'Active']
];

$recent_activities = [
    ['type' => 'meeting', 'title' => 'Board of Governors Meeting', 'date' => '2024-01-20', 'status' => 'completed'],
    ['type' => 'policy', 'title' => 'New Academic Policy Approval', 'date' => '2024-01-18', 'status' => 'completed'],
    ['type' => 'budget', 'title' => 'Q1 Budget Review', 'date' => '2024-01-15', 'status' => 'in_progress'],
    ['type' => 'accreditation', 'title' => 'NCHE Accreditation Renewal', 'date' => '2024-01-12', 'status' => 'pending']
];

$pending_approvals = [
    ['type' => 'budget', 'title' => 'Equipment Purchase Request', 'amount' => 'UGX 45,000,000', 'department' => 'Clinical Skills Lab', 'urgency' => 'high'],
    ['type' => 'policy', 'title' => 'Student Handbook Revision', 'department' => 'Academic Affairs', 'urgency' => 'medium'],
    ['type' => 'hiring', 'title' => 'New Lecturer Positions', 'department' => 'HR', 'urgency' => 'high'],
    ['type' => 'partnership', 'title' => 'International Collaboration Agreement', 'department' => 'International Office', 'urgency' => 'medium']
];

$financial_overview = [
    'total_revenue' => 2800000000,
    'total_expenses' => 2300000000,
    'net_profit' => 500000000,
    'tuition_income' => 2100000000,
    'government_funding' => 400000000,
    'other_income' => 300000000,
    'staff_salaries' => 1200000000,
    'operational_costs' => 600000000,
    'development_projects' => 500000000
];

$academic_performance = [
    'student_satisfaction' => 88.5,
    'employer_satisfaction' => 91.2,
    'research_output' => 156,
    'publications' => 89,
    'conferences_attended' => 45,
    'awards_won' => 12
];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Director Dashboard - ISNM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        :root {
            /* Executive Color Palette */
            --primary-dark: #0a1628;
            --accent-gold: #FFD700;
            --accent-blue: #2563eb;
            --luxury-gold: #D4AF37;
            --platinum: #E5E4E2;
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
            
            /* Executive Gradients */
            --gradient-executive: linear-gradient(135deg, var(--primary-dark) 0%, var(--executive-gray) 50%, var(--accent-gold) 100%);
            --gradient-luxury: linear-gradient(135deg, var(--luxury-gold) 0%, var(--platinum) 100%);
            --gradient-primary: linear-gradient(135deg, var(--primary-dark) 0%, var(--accent-blue) 100%);
            --gradient-success: linear-gradient(135deg, var(--success-green) 0%, #16a34a 100%);
            --gradient-warning: linear-gradient(135deg, var(--warning-amber) 0%, #d97706 100%);
            --gradient-danger: linear-gradient(135deg, var(--danger-red) 0%, #dc2626 100%);
            
            /* Executive Shadows */
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.07);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px rgba(0, 0, 0, 0.1);
            --shadow-2xl: 0 25px 50px rgba(0, 0, 0, 0.25);
            --shadow-luxury: 0 8px 16px rgba(212, 175, 55, 0.3);
            
            /* Transitions */
            --transition-fast: 150ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-normal: 300ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-slow: 500ms cubic-bezier(0.4, 0, 0.2, 1);
            
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
            --space-20: 5rem;
            
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
                    <i class="fas fa-user-md"></i>
                </div>
                <div class="user-info">
                    <div class="user-name"><?php echo htmlspecialchars($director['name']); ?></div>
                    <div class="user-position"><?php echo htmlspecialchars($director['position']); ?></div>
                    <div class="user-email"><?php echo htmlspecialchars($director['email']); ?></div>
                </div>
            </div>
            
            <nav>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Executive Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-users"></i>
                            <span>Directors Team</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-chart-line"></i>
                            <span>Financial Overview</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-graduation-cap"></i>
                            <span>Academic Performance</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-clipboard-check"></i>
                            <span>Pending Approvals</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-calendar"></i>
                            <span>Board Meetings</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-file-contract"></i>
                            <span>Policies & Procedures</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-handshake"></i>
                            <span>Partnerships</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-trophy"></i>
                            <span>Achievements</span>
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
                        <h1 class="header-title">Executive Dashboard</h1>
                        <p class="header-subtitle">Institutional Management & Strategic Oversight</p>
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
                    <div class="stat-value"><?php echo number_format($institution_stats['total_students']); ?></div>
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
                    <div class="stat-value"><?php echo number_format($institution_stats['total_staff']); ?></div>
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
                    <div class="stat-value"><?php echo $institution_stats['pass_rate']; ?>%</div>
                    <div class="stat-label">Pass Rate</div>
                </div>
                
                <div class="stat-card warning">
                    <div class="stat-header">
                        <div class="stat-icon warning">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i>
                            15%
                        </div>
                    </div>
                    <div class="stat-value">UGX <?php echo number_format($institution_stats['annual_budget'] / 1000000, 1); ?>B</div>
                    <div class="stat-label">Annual Budget</div>
                </div>
            </div>
            
            <!-- Content Grid -->
            <div class="content-grid">
                <!-- Directors Team Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-users"></i>
                            Executive Team
                        </h2>
                        <button class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Add Director
                        </button>
                    </div>
                    
                    <ul class="list">
                        <?php foreach ($directors_team as $member): ?>
                            <li class="list-item">
                                <div class="list-item-header">
                                    <div class="list-item-title"><?php echo htmlspecialchars($member['name']); ?></div>
                                    <div class="list-item-status completed">
                                        <?php echo htmlspecialchars($member['status']); ?>
                                    </div>
                                </div>
                                <div class="list-item-description">
                                    <?php echo htmlspecialchars($member['position']); ?> - <?php echo htmlspecialchars($member['department']); ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
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
                                    <?php echo htmlspecialchars($approval['department']); ?>
                                    <?php if (isset($approval['amount'])): ?>
                                        - <?php echo htmlspecialchars($approval['amount']); ?>
                                    <?php endif; ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                
                <!-- Financial Overview Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-chart-line"></i>
                            Financial Overview
                        </h2>
                        <button class="btn btn-luxury">
                            <i class="fas fa-file-invoice-dollar"></i>
                            Detailed Report
                        </button>
                    </div>
                    
                    <ul class="list">
                        <li class="list-item">
                            <div class="list-item-header">
                                <div class="list-item-title">Total Revenue</div>
                                <div class="stat-change positive">
                                    <i class="fas fa-arrow-up"></i>
                                    18%
                                </div>
                            </div>
                            <div class="list-item-description">
                                UGX <?php echo number_format($financial_overview['total_revenue'] / 1000000, 1); ?>B
                            </div>
                        </li>
                        <li class="list-item">
                            <div class="list-item-header">
                                <div class="list-item-title">Total Expenses</div>
                                <div class="stat-change positive">
                                    <i class="fas fa-arrow-down"></i>
                                    5%
                                </div>
                            </div>
                            <div class="list-item-description">
                                UGX <?php echo number_format($financial_overview['total_expenses'] / 1000000, 1); ?>B
                            </div>
                        </li>
                        <li class="list-item">
                            <div class="list-item-header">
                                <div class="list-item-title">Net Profit</div>
                                <div class="stat-change positive">
                                    <i class="fas fa-arrow-up"></i>
                                    45%
                                </div>
                            </div>
                            <div class="list-item-description">
                                UGX <?php echo number_format($financial_overview['net_profit'] / 1000000, 1); ?>B
                            </div>
                        </li>
                    </ul>
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
        .activity-icon { width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.875rem; flex-shrink: 0; }
        .activity-content { flex: 1; }
        .activity-title { font-weight: 500; margin-bottom: 0.25rem; }
        .activity-time { font-size: 0.75rem; color: var(--gray-600); }
        .footer { background: var(--gray-900); color: white; padding: 3rem 2rem 2rem; text-align: center; margin-top: 4rem; }
        .footer-title { font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem; }
        .footer-subtitle { margin-bottom: 2rem; opacity: 0.9; }
        .contact-buttons { display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap; }
        .whatsapp-btn { padding: 1rem 2rem; background: #25d366; color: white; text-decoration: none; border-radius: 8px; font-weight: 500; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s; }
        .whatsapp-btn:hover { background: #128c7e; transform: translateY(-1px); }
        @media (max-width: 768px) { .dashboard { flex-direction: column; } .sidebar { width: 100%; } .content-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <div class="dashboard">
        <aside class="sidebar">
            <div class="sidebar-header">
                <img src="assets/school-logo.png" alt="ISNM Logo" class="school-logo">
                <div class="user-info">
                    <div class="user-avatar"><i class="fas fa-user-tie"></i></div>
                    <div class="user-details">
                        <h3><?php echo htmlspecialchars($user['username']); ?></h3>
                        <p>Director</p>
                    </div>
                </div>
            </div>
            <nav>
                <ul class="nav-menu">
                    <li class="nav-item"><a href="#" class="nav-link active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-users"></i> Staff Management</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-graduation-cap"></i> Academic Oversight</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-chart-line"></i> Reports</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-cog"></i> Settings</a></li>
                    <li class="nav-item"><a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <div class="header">
                <h1>Director Dashboard</h1>
                <p>Welcome back, <?php echo htmlspecialchars($user['username']); ?>. Here's your institutional overview.</p>
            </div>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon blue"><i class="fas fa-users"></i></div>
                    <div class="stat-value">1,247</div>
                    <div class="stat-label">Total Staff & Students</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon green"><i class="fas fa-user-graduate"></i></div>
                    <div class="stat-value">856</div>
                    <div class="stat-label">Enrolled Students</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon yellow"><i class="fas fa-chalkboard-teacher"></i></div>
                    <div class="stat-value">67</div>
                    <div class="stat-label">Academic Staff</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon red"><i class="fas fa-building"></i></div>
                    <div class="stat-value">12</div>
                    <div class="stat-label">Departments</div>
                </div>
            </div>
            <div class="content-grid">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Recent Activities</h2>
                        <a href="#" class="btn btn-secondary">View All</a>
                    </div>
                    <ul class="activity-list">
                        <li class="activity-item">
                            <div class="activity-icon" style="background: rgba(59, 130, 246, 0.1); color: var(--secondary);"><i class="fas fa-file-alt"></i></div>
                            <div class="activity-content">
                                <div class="activity-title">New academic policy approved</div>
                                <div class="activity-time">2 hours ago</div>
                            </div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-icon" style="background: rgba(16, 185, 129, 0.1); color: var(--success);"><i class="fas fa-user-plus"></i></div>
                            <div class="activity-content">
                                <div class="activity-title">15 new student admissions</div>
                                <div class="activity-time">5 hours ago</div>
                            </div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-icon" style="background: rgba(245, 158, 11, 0.1); color: var(--warning);"><i class="fas fa-calendar"></i></div>
                            <div class="activity-content">
                                <div class="activity-title">Board meeting scheduled</div>
                                <div class="activity-time">1 day ago</div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Quick Actions</h2>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        <a href="#" class="btn btn-primary"><i class="fas fa-file-signature"></i> Approve Documents</a>
                        <a href="#" class="btn btn-primary"><i class="fas fa-calendar-plus"></i> Schedule Meeting</a>
                        <a href="#" class="btn btn-primary"><i class="fas fa-chart-bar"></i> Generate Report</a>
                        <a href="#" class="btn btn-primary"><i class="fas fa-bullhorn"></i> Send Announcement</a>
                    </div>
                </div>
            </div>
        </main>
    </div>
    </body>
</html>


