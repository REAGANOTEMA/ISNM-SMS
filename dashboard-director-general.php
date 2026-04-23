<?php
// Error reporting disabled for clean display
error_reporting(0);
ini_set('display_errors', 0);

// Start session if needed
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check authentication and role
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'director-general') {
    header('Location: login.php');
    exit();
}

// Mock data for demonstration
$dg_info = [
    'username' => $_SESSION['user']['username'],
    'name' => $_SESSION['user']['name'],
    'role' => $_SESSION['user']['role'],
    'login_time' => $_SESSION['user']['login_time']
];

// Mock institutional statistics
$institution_stats = [
    'total_students' => 245,
    'total_staff' => 45,
    'academic_programs' => 3,
    'annual_budget' => 850000000,
    'revenue' => 920000000,
    'expenses' => 680000000,
    'accreditation_status' => 'Fully Accredited',
    'completion_rate' => 94,
    'employment_rate' => 87,
    'research_projects' => 12,
    'partnerships' => 8,
    'community_outreach' => 15
];

// Mock director reports
$director_reports = [
    ['name' => 'Director of Academics', 'report' => 'Academic performance improved by 12%', 'date' => '2024-01-20', 'status' => 'positive'],
    ['name' => 'Director of Finance', 'report' => 'Budget utilization at 78%', 'date' => '2024-01-19', 'status' => 'neutral'],
    ['name' => 'Director of ICT', 'report' => 'System upgrade completed', 'date' => '2024-01-18', 'status' => 'positive'],
    ['name' => 'School Principal', 'report' => 'Discipline cases reduced by 25%', 'date' => '2024-01-17', 'status' => 'positive']
];

// Mock strategic initiatives
$strategic_initiatives = [
    ['title' => 'Curriculum Enhancement', 'progress' => 75, 'deadline' => '2024-03-01', 'status' => 'on-track'],
    ['title' => 'Infrastructure Development', 'progress' => 60, 'deadline' => '2024-06-01', 'status' => 'on-track'],
    ['title' => 'Digital Transformation', 'progress' => 85, 'deadline' => '2024-02-15', 'status' => 'ahead'],
    ['title' => 'Quality Assurance', 'progress' => 90, 'deadline' => '2024-01-31', 'status' => 'ahead'],
    ['title' => 'Community Engagement', 'progress' => 45, 'deadline' => '2024-04-01', 'status' => 'delayed']
];

// Mock board meetings
$board_meetings = [
    ['date' => '2024-01-25', 'title' => 'Quarterly Review Meeting', 'type' => 'board'],
    ['date' => '2024-02-15', 'title' => 'Budget Approval', 'type' => 'finance'],
    ['date' => '2024-03-01', 'title' => 'Strategic Planning', 'type' => 'strategic'],
    ['date' => '2024-03-20', 'title' => 'Accreditation Review', 'type' => 'academic']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Director General Dashboard - ISNM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #1e3a5f 0%, #0a1628 100%);
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
            background: linear-gradient(135deg, #1e3a5f 0%, #0a1628 100%);
            color: white;
        }

        .btn-success {
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
            color: white;
        }

        .btn-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
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
            background: linear-gradient(135deg, #1e3a5f 0%, #0a1628 100%);
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
            background: rgba(30, 58, 95, 0.1);
            color: #1e3a5f;
        }

        .nav-link.active {
            background: linear-gradient(135deg, #1e3a5f 0%, #0a1628 100%);
            color: white;
        }

        .section-content {
            display: none;
        }

        .section-content.active {
            display: block;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: #e5e7eb;
            border-radius: 4px;
            overflow: hidden;
            margin-top: 0.5rem;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
            transition: width 0.3s ease;
        }

        .status-positive { color: #059669; }
        .status-neutral { color: #f59e0b; }
        .status-negative { color: #dc2626; }

        .kpi-card {
            background: linear-gradient(135deg, #f9fafb 0%, #ffffff 100%);
            border-left: 4px solid #1e3a5f;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .kpi-title {
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
        }

        .kpi-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e3a5f;
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .alert-info {
            background: #dbeafe;
            color: #1e40af;
            border: 1px solid #60a5fa;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #34d399;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <div class="user-info">
                <div class="user-avatar">
                    <i class="fas fa-crown"></i>
                </div>
                <div>
                    <div style="font-weight: 600;"><?php echo htmlspecialchars($dg_info['name']); ?></div>
                    <div style="color: #6b7280; font-size: 0.9rem;">Director General</div>
                </div>
            </div>
            
            <nav style="margin-top: 2rem;">
                <a href="#" class="nav-link active" data-section="dashboard">
                    <i class="fas fa-tachometer-alt"></i> Executive Dashboard
                </a>
                <a href="#" class="nav-link" data-section="strategic">
                    <i class="fas fa-chess"></i> Strategic Planning
                </a>
                <a href="#" class="nav-link" data-section="directors">
                    <i class="fas fa-users"></i> Director Reports
                </a>
                <a href="#" class="nav-link" data-section="financial">
                    <i class="fas fa-chart-line"></i> Financial Oversight
                </a>
                <a href="#" class="nav-link" data-section="compliance">
                    <i class="fas fa-shield-alt"></i> Compliance & Accreditation
                </a>
                <a href="#" class="nav-link" data-section="board">
                    <i class="fas fa-users-tie"></i> Board Management
                </a>
                <a href="#" class="nav-link" data-section="partnerships">
                    <i class="fas fa-handshake"></i> Partnerships
                </a>
                <a href="#" class="nav-link" data-section="reports">
                    <i class="fas fa-file-alt"></i> Executive Reports
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
                    <div class="welcome-text">Director General Executive Dashboard</div>
                    <div class="subtitle">Institutional Leadership & Strategic Management</div>
                    <div style="color: #6b7280; font-size: 0.9rem; margin-top: 0.5rem;">
                        Last login: <?php echo date('d M Y, h:i A', strtotime($dg_info['login_time'])); ?>
                    </div>
                </div>

                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <div>
                        <strong>Performance Excellence:</strong> Institution maintaining 94% completion rate and full accreditation status
                    </div>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #1e3a5f 0%, #0a1628 100%);">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-value"><?php echo number_format($institution_stats['total_students']); ?></div>
                        <div class="stat-label">Total Students</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="stat-value">UGX <?php echo number_format($institution_stats['annual_budget'] / 1000000, 1); ?>M</div>
                        <div class="stat-label">Annual Budget</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #2563eb 0%, #667eea 100%);">
                            <i class="fas fa-award"></i>
                        </div>
                        <div class="stat-value"><?php echo $institution_stats['accreditation_status']; ?></div>
                        <div class="stat-label">Accreditation Status</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);">
                            <i class="fas fa-percentage"></i>
                        </div>
                        <div class="stat-value"><?php echo $institution_stats['employment_rate']; ?>%</div>
                        <div class="stat-label">Employment Rate</div>
                    </div>
                </div>

                <div class="content-card">
                    <h3 style="margin-bottom: 1rem;">Key Performance Indicators</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
                        <div class="kpi-card">
                            <div class="kpi-title">Academic Excellence</div>
                            <div class="kpi-value"><?php echo $institution_stats['completion_rate']; ?>%</div>
                            <div style="color: #6b7280; font-size: 0.9rem;">Completion Rate</div>
                        </div>
                        <div class="kpi-card">
                            <div class="kpi-title">Financial Health</div>
                            <div class="kpi-value">UGX <?php echo number_format(($institution_stats['revenue'] - $institution_stats['expenses']) / 1000000, 1); ?>M</div>
                            <div style="color: #6b7280; font-size: 0.9rem;">Net Surplus</div>
                        </div>
                        <div class="kpi-card">
                            <div class="kpi-title">Research Output</div>
                            <div class="kpi-value"><?php echo $institution_stats['research_projects']; ?></div>
                            <div style="color: #6b7280; font-size: 0.9rem;">Active Projects</div>
                        </div>
                        <div class="kpi-card">
                            <div class="kpi-title">Strategic Partners</div>
                            <div class="kpi-value"><?php echo $institution_stats['partnerships']; ?></div>
                            <div style="color: #6b7280; font-size: 0.9rem;">Active Partnerships</div>
                        </div>
                    </div>
                </div>

                <div class="content-card">
                    <h3 style="margin-bottom: 1rem;">Director Reports Summary</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Director</th>
                                <th>Report Summary</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($director_reports as $report): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($report['name']); ?></td>
                                <td><?php echo htmlspecialchars($report['report']); ?></td>
                                <td><?php echo date('d M Y', strtotime($report['date'])); ?></td>
                                <td><span class="status-<?php echo $report['status']; ?>"><?php echo ucfirst($report['status']); ?></span></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Strategic Planning Section -->
            <div id="strategic" class="section-content">
                <div class="header">
                    <div class="welcome-text">Strategic Planning</div>
                    <div class="subtitle">Manage institutional strategic initiatives</div>
                </div>

                <div class="content-card">
                    <h3>Strategic Initiatives Progress</h3>
                    <?php foreach ($strategic_initiatives as $initiative): ?>
                    <div style="margin-bottom: 1.5rem;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                            <div style="font-weight: 600;"><?php echo htmlspecialchars($initiative['title']); ?></div>
                            <div style="color: #6b7280; font-size: 0.9rem;">
                                Deadline: <?php echo date('M d, Y', strtotime($initiative['deadline'])); ?>
                            </div>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: <?php echo $initiative['progress']; ?>%;"></div>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-top: 0.5rem;">
                            <span style="font-weight: 600;"><?php echo $initiative['progress']; ?>% Complete</span>
                            <span style="color: <?php echo $initiative['status'] === 'ahead' ? '#059669' : ($initiative['status'] === 'delayed' ? '#dc2626' : '#f59e0b'); ?>">
                                <?php echo ucfirst($initiative['status']); ?>
                            </span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="content-card">
                    <h3>Strategic Actions</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                        <button class="btn btn-primary">
                            <i class="fas fa-plus"></i> New Initiative
                        </button>
                        <button class="btn btn-success">
                            <i class="fas fa-chart-line"></i> Progress Review
                        </button>
                        <button class="btn btn-warning">
                            <i class="fas fa-calendar"></i> Planning Session
                        </button>
                        <button class="btn" style="background: #6b7280; color: white;">
                            <i class="fas fa-download"></i> Export Plan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Directors Section -->
            <div id="directors" class="section-content">
                <div class="header">
                    <div class="welcome-text">Director Reports</div>
                    <div class="subtitle">Review reports from all department directors</div>
                </div>

                <div class="content-card">
                    <h3>Director Performance Overview</h3>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div class="stat-value">4</div>
                            <div class="stat-label">Active Directors</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #2563eb 0%, #667eea 100%);">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="stat-value">12</div>
                            <div class="stat-label">Reports This Month</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="stat-value">95%</div>
                            <div class="stat-label">Report Compliance</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stat-value">2</div>
                            <div class="stat-label">Pending Reviews</div>
                        </div>
                    </div>
                </div>

                <div class="content-card">
                    <h3>Recent Director Reports</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Director</th>
                                <th>Report Type</th>
                                <th>Summary</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($director_reports as $report): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($report['name']); ?></td>
                                <td>Monthly Report</td>
                                <td><?php echo htmlspecialchars($report['report']); ?></td>
                                <td><?php echo date('d M Y', strtotime($report['date'])); ?></td>
                                <td>
                                    <button class="btn btn-primary" style="padding: 0.5rem; font-size: 0.9rem;">Review</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Financial Oversight Section -->
            <div id="financial" class="section-content">
                <div class="header">
                    <div class="welcome-text">Financial Oversight</div>
                    <div class="subtitle">Monitor institutional financial performance</div>
                </div>

                <div class="content-card">
                    <h3>Financial Overview</h3>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
                                <i class="fas fa-arrow-up"></i>
                            </div>
                            <div class="stat-value">UGX <?php echo number_format($institution_stats['revenue'] / 1000000, 1); ?>M</div>
                            <div class="stat-label">Total Revenue</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);">
                                <i class="fas fa-arrow-down"></i>
                            </div>
                            <div class="stat-value">UGX <?php echo number_format($institution_stats['expenses'] / 1000000, 1); ?>M</div>
                            <div class="stat-label">Total Expenses</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #2563eb 0%, #667eea 100%);">
                                <i class="fas fa-balance-scale"></i>
                            </div>
                            <div class="stat-value">UGX <?php echo number_format(($institution_stats['revenue'] - $institution_stats['expenses']) / 1000000, 1); ?>M</div>
                            <div class="stat-label">Net Surplus</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);">
                                <i class="fas fa-percentage"></i>
                            </div>
                            <div class="stat-value">78%</div>
                            <div class="stat-label">Budget Utilization</div>
                        </div>
                    </div>
                </div>

                <div class="content-card">
                    <h3>Financial Management</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                        <button class="btn btn-primary">
                            <i class="fas fa-chart-line"></i> Financial Reports
                        </button>
                        <button class="btn btn-success">
                            <i class="fas fa-dollar-sign"></i> Budget Analysis
                        </button>
                        <button class="btn btn-warning">
                            <i class="fas fa-calculator"></i> Cost Review
                        </button>
                        <button class="btn" style="background: #6b7280; color: white;">
                            <i class="fas fa-download"></i> Export Data
                        </button>
                    </div>
                </div>
            </div>

            <!-- Compliance Section -->
            <div id="compliance" class="section-content">
                <div class="header">
                    <div class="welcome-text">Compliance & Accreditation</div>
                    <div class="subtitle">Ensure regulatory compliance and accreditation</div>
                </div>

                <div class="content-card">
                    <h3>Compliance Status</h3>
                    <div class="alert alert-success">
                        <i class="fas fa-shield-alt"></i>
                        <div>
                            <strong>Full Accreditation Status:</strong> All regulatory requirements met. Next review: June 2024
                        </div>
                    </div>

                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="stat-value">100%</div>
                            <div class="stat-label">NCHE Compliance</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #2563eb 0%, #667eea 100%);">
                                <i class="fas fa-award"></i>
                            </div>
                            <div class="stat-value">A+</div>
                            <div class="stat-label">Quality Rating</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);">
                                <i class="fas fa-file-contract"></i>
                            </div>
                            <div class="stat-value">15</div>
                            <div class="stat-label">Active Licenses</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stat-value">180</div>
                            <div class="stat-label">Days to Next Review</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Board Management Section -->
            <div id="board" class="section-content">
                <div class="header">
                    <div class="welcome-text">Board Management</div>
                    <div class="subtitle">Manage board meetings and governance</div>
                </div>

                <div class="content-card">
                    <h3>Upcoming Board Meetings</h3>
                    <?php foreach ($board_meetings as $meeting): ?>
                    <div style="display: flex; align-items: center; padding: 1rem; border-bottom: 1px solid #e5e7eb;">
                        <div style="background: #f3f4f6; padding: 0.5rem 1rem; border-radius: 8px; margin-right: 1rem; font-weight: 600;">
                            <?php echo date('M d', strtotime($meeting['date'])); ?>
                        </div>
                        <div style="flex: 1;">
                            <div style="font-weight: 600;"><?php echo htmlspecialchars($meeting['title']); ?></div>
                            <div style="color: #6b7280; font-size: 0.9rem;"><?php echo ucfirst($meeting['type']); ?> Meeting</div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="content-card">
                    <h3>Board Actions</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                        <button class="btn btn-primary">
                            <i class="fas fa-plus"></i> Schedule Meeting
                        </button>
                        <button class="btn btn-success">
                            <i class="fas fa-file-alt"></i> Board Papers
                        </button>
                        <button class="btn btn-warning">
                            <i class="fas fa-users"></i> Member Directory
                        </button>
                        <button class="btn" style="background: #6b7280; color: white;">
                            <i class="fas fa-history"></i> Meeting History
                        </button>
                    </div>
                </div>
            </div>

            <!-- Partnerships Section -->
            <div id="partnerships" class="section-content">
                <div class="header">
                    <div class="welcome-text">Strategic Partnerships</div>
                    <div class="subtitle">Manage institutional partnerships</div>
                </div>

                <div class="content-card">
                    <h3>Partnership Overview</h3>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <div class="stat-value"><?php echo $institution_stats['partnerships']; ?></div>
                            <div class="stat-label">Active Partnerships</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #2563eb 0%, #667eea 100%);">
                                <i class="fas fa-hospital"></i>
                            </div>
                            <div class="stat-value">5</div>
                            <div class="stat-label">Healthcare Partners</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="stat-value">3</div>
                            <div class="stat-label">Academic Partners</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);">
                                <i class="fas fa-globe"></i>
                            </div>
                            <div class="stat-value"><?php echo $institution_stats['community_outreach']; ?></div>
                            <div class="stat-label">Community Programs</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Executive Reports Section -->
            <div id="reports" class="section-content">
                <div class="header">
                    <div class="welcome-text">Executive Reports</div>
                    <div class="subtitle">Generate comprehensive institutional reports</div>
                </div>

                <div class="content-card">
                    <h3>Available Reports</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
                        <button class="btn btn-primary">
                            <i class="fas fa-chart-line"></i> Annual Performance
                        </button>
                        <button class="btn btn-success">
                            <i class="fas fa-dollar-sign"></i> Financial Report
                        </button>
                        <button class="btn btn-warning">
                            <i class="fas fa-graduation-cap"></i> Academic Report
                        </button>
                        <button class="btn" style="background: #6b7280; color: white;">
                            <i class="fas fa-shield-alt"></i> Compliance Report
                        </button>
                        <button class="btn" style="background: #10b981; color: white;">
                            <i class="fas fa-users"></i> Stakeholder Report
                        </button>
                        <button class="btn" style="background: #8b5cf6; color: white;">
                            <i class="fas fa-chess"></i> Strategic Report
                        </button>
                    </div>
                </div>
            </div>

            <!-- Settings Section -->
            <div id="settings" class="section-content">
                <div class="header">
                    <div class="welcome-text">Executive Settings</div>
                    <div class="subtitle">Configure executive dashboard preferences</div>
                </div>

                <div class="content-card">
                    <h3>Director General Settings</h3>
                    <form>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
                            <div>
                                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Report Frequency</label>
                                <select style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px;">
                                    <option>Daily</option>
                                    <option>Weekly</option>
                                    <option>Monthly</option>
                                    <option>Quarterly</option>
                                </select>
                            </div>
                            <div>
                                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Alert Level</label>
                                <select style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px;">
                                    <option>Critical Only</option>
                                    <option>High Priority</option>
                                    <option>All Updates</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Settings
                        </button>
                    </form>
                </div>
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
                const section = document.getElementById(sectionId);
                if (section) {
                    section.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>
?>
