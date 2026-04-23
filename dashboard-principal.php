<?php
// Error reporting disabled for clean display
error_reporting(0);
ini_set('display_errors', 0);

// Start session if needed
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check authentication and role
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'principal') {
    header('Location: login.php');
    exit();
}

// Mock data for demonstration
$principal_info = [
    'username' => $_SESSION['user']['username'],
    'name' => $_SESSION['user']['name'],
    'role' => $_SESSION['user']['role'],
    'login_time' => $_SESSION['user']['login_time']
];

// Mock school statistics
$school_stats = [
    'total_students' => 245,
    'total_staff' => 45,
    'academic_programs' => 3,
    'completion_rate' => 94,
    'avg_gpa' => 3.6,
    'discipline_cases' => 8,
    'staff_attendance' => 96,
    'student_attendance' => 92,
    'library_usage' => 78,
    'hostel_occupancy' => 85,
    'lab_utilization' => 88,
    'sports_participation' => 65
];

// Mock recent activities
$recent_activities = [
    ['time' => '2 hours ago', 'activity' => 'Staff meeting conducted', 'type' => 'info', 'user' => 'Principal Office'],
    ['time' => '4 hours ago', 'activity' => 'Student disciplinary case resolved', 'type' => 'warning', 'user' => 'Discipline Committee'],
    ['time' => '6 hours ago', 'activity' => 'Academic calendar approved', 'type' => 'success', 'user' => 'Academic Board'],
    ['time' => '1 day ago', 'activity' => 'New staff orientation completed', 'type' => 'success', 'user' => 'HR Department'],
    ['time' => '2 days ago', 'activity' => 'Facility inspection conducted', 'type' => 'info', 'user' => 'Maintenance Team']
];

// Mock departments
$departments = [
    ['name' => 'Nursing Department', 'head' => 'Dr. Sarah Johnson', 'students' => 145, 'staff' => 12, 'performance' => 95],
    ['name' => 'Midwifery Department', 'head' => 'Dr. Michael Brown', 'students' => 100, 'staff' => 8, 'performance' => 93],
    ['name' => 'Administrative', 'head' => 'Mr. James Wilson', 'students' => 0, 'staff' => 15, 'performance' => 98],
    ['name' => 'Support Services', 'head' => 'Mrs. Patricia Davis', 'students' => 0, 'staff' => 10, 'performance' => 90]
];

// Mock upcoming events
$upcoming_events = [
    ['date' => '2024-01-25', 'event' => 'Academic Board Meeting', 'type' => 'meeting'],
    ['date' => '2024-01-28', 'event' => 'Graduation Ceremony', 'type' => 'ceremony'],
    ['date' => '2024-02-01', 'event' => 'Staff Development Workshop', 'type' => 'workshop'],
    ['date' => '2024-02-05', 'event' => 'Parents-Teachers Meeting', 'type' => 'meeting'],
    ['date' => '2024-02-10', 'event' => 'Sports Day', 'type' => 'event']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal Dashboard - ISNM</title>
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
            background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
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
            background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
            color: white;
        }

        .section-content {
            display: none;
        }

        .section-content.active {
            display: block;
        }

        .activity-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 0.9rem;
        }

        .activity-content {
            flex: 1;
        }

        .activity-time {
            color: #6b7280;
            font-size: 0.9rem;
        }

        .activity-success { background: #d1fae5; color: #065f46; }
        .activity-info { background: #dbeafe; color: #1e40af; }
        .activity-warning { background: #fef3c7; color: #92400e; }

        .event-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .event-date {
            background: #f3f4f6;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            margin-right: 1rem;
            font-weight: 600;
            color: #374151;
        }

        .performance-bar {
            width: 100%;
            height: 8px;
            background: #e5e7eb;
            border-radius: 4px;
            overflow: hidden;
            margin-top: 0.5rem;
        }

        .performance-fill {
            height: 100%;
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
            transition: width 0.3s ease;
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .alert-warning {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fbbf24;
        }

        .alert-info {
            background: #dbeafe;
            color: #1e40af;
            border: 1px solid #60a5fa;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <div class="user-info">
                <div class="user-avatar">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div>
                    <div style="font-weight: 600;"><?php echo htmlspecialchars($principal_info['name']); ?></div>
                    <div style="color: #6b7280; font-size: 0.9rem;">School Principal</div>
                </div>
            </div>
            
            <nav style="margin-top: 2rem;">
                <a href="#" class="nav-link active" data-section="dashboard">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="#" class="nav-link" data-section="academics">
                    <i class="fas fa-graduation-cap"></i> Academics
                </a>
                <a href="#" class="nav-link" data-section="staff">
                    <i class="fas fa-chalkboard-teacher"></i> Staff Management
                </a>
                <a href="#" class="nav-link" data-section="students">
                    <i class="fas fa-user-graduate"></i> Student Affairs
                </a>
                <a href="#" class="nav-link" data-section="discipline">
                    <i class="fas fa-gavel"></i> Discipline
                </a>
                <a href="#" class="nav-link" data-section="facilities">
                    <i class="fas fa-building"></i> Facilities
                </a>
                <a href="#" class="nav-link" data-section="reports">
                    <i class="fas fa-chart-line"></i> Reports
                </a>
                <a href="#" class="nav-link" data-section="calendar">
                    <i class="fas fa-calendar"></i> Calendar
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
                    <div class="welcome-text">Welcome to Principal Dashboard</div>
                    <div class="subtitle">School Management & Leadership System</div>
                    <div style="color: #6b7280; font-size: 0.9rem; margin-top: 0.5rem;">
                        Last login: <?php echo date('d M Y, h:i A', strtotime($principal_info['login_time'])); ?>
                    </div>
                </div>

                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <div>
                        <strong>Attention:</strong> 2 disciplinary cases pending review. Please check Discipline section.
                    </div>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-value"><?php echo number_format($school_stats['total_students']); ?></div>
                        <div class="stat-label">Total Students</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #2563eb 0%, #667eea 100%);">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div class="stat-value"><?php echo number_format($school_stats['total_staff']); ?></div>
                        <div class="stat-label">Total Staff</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                            <i class="fas fa-percentage"></i>
                        </div>
                        <div class="stat-value"><?php echo $school_stats['completion_rate']; ?>%</div>
                        <div class="stat-label">Completion Rate</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="stat-value"><?php echo $school_stats['avg_gpa']; ?></div>
                        <div class="stat-label">Average GPA</div>
                    </div>
                </div>

                <div class="content-card">
                    <h3 style="margin-bottom: 1rem;">Recent Activities</h3>
                    <?php foreach ($recent_activities as $activity): ?>
                    <div class="activity-item">
                        <div class="activity-icon activity-<?php echo $activity['type']; ?>">
                            <i class="fas fa-<?php echo getActivityIcon($activity['type']); ?>"></i>
                        </div>
                        <div class="activity-content">
                            <div style="font-weight: 600;"><?php echo htmlspecialchars($activity['activity']); ?></div>
                            <div style="color: #6b7280; font-size: 0.9rem;"><?php echo htmlspecialchars($activity['user']); ?> • <?php echo htmlspecialchars($activity['time']); ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="content-card">
                    <h3 style="margin-bottom: 1rem;">Department Performance</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Department</th>
                                <th>Head</th>
                                <th>Students</th>
                                <th>Staff</th>
                                <th>Performance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($departments as $dept): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($dept['name']); ?></td>
                                <td><?php echo htmlspecialchars($dept['head']); ?></td>
                                <td><?php echo number_format($dept['students']); ?></td>
                                <td><?php echo number_format($dept['staff']); ?></td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                                        <div class="performance-bar" style="flex: 1;">
                                            <div class="performance-fill" style="width: <?php echo $dept['performance']; ?>%;"></div>
                                        </div>
                                        <span style="font-weight: 600;"><?php echo $dept['performance']; ?>%</span>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Academics Section -->
            <div id="academics" class="section-content">
                <div class="header">
                    <div class="welcome-text">Academic Management</div>
                    <div class="subtitle">Oversee academic programs and curriculum</div>
                </div>

                <div class="content-card">
                    <h3>Academic Programs Overview</h3>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="stat-value"><?php echo $school_stats['academic_programs']; ?></div>
                            <div class="stat-label">Active Programs</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #2563eb 0%, #667eea 100%);">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="stat-value"><?php echo $school_stats['completion_rate']; ?>%</div>
                            <div class="stat-label">Completion Rate</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <div class="stat-value"><?php echo $school_stats['avg_gpa']; ?></div>
                            <div class="stat-label">Average GPA</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stat-value">96%</div>
                            <div class="stat-label">Class Attendance</div>
                        </div>
                    </div>
                </div>

                <div class="content-card">
                    <h3>Academic Actions</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                        <button class="btn btn-primary">
                            <i class="fas fa-plus"></i> Approve Curriculum
                        </button>
                        <button class="btn btn-success">
                            <i class="fas fa-calendar"></i> Academic Calendar
                        </button>
                        <button class="btn btn-warning">
                            <i class="fas fa-award"></i> Graduation List
                        </button>
                        <button class="btn" style="background: #6b7280; color: white;">
                            <i class="fas fa-chart-bar"></i> Performance Reports
                        </button>
                    </div>
                </div>
            </div>

            <!-- Staff Management Section -->
            <div id="staff" class="section-content">
                <div class="header">
                    <div class="welcome-text">Staff Management</div>
                    <div class="subtitle">Manage teaching and administrative staff</div>
                </div>

                <div class="content-card">
                    <h3>Staff Overview</h3>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <div class="stat-value"><?php echo number_format($school_stats['total_staff']); ?></div>
                            <div class="stat-label">Total Staff</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #2563eb 0%, #667eea 100%);">
                                <i class="fas fa-user-check"></i>
                            </div>
                            <div class="stat-value"><?php echo $school_stats['staff_attendance']; ?>%</div>
                            <div class="stat-label">Attendance Rate</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);">
                                <i class="fas fa-certificate"></i>
                            </div>
                            <div class="stat-value">12</div>
                            <div class="stat-label">Certifications</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="stat-value">8</div>
                            <div class="stat-label">Advanced Degrees</div>
                        </div>
                    </div>
                </div>

                <div class="content-card">
                    <h3>Staff Actions</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                        <button class="btn btn-primary">
                            <i class="fas fa-user-plus"></i> Hire Staff
                        </button>
                        <button class="btn btn-success">
                            <i class="fas fa-award"></i> Performance Review
                        </button>
                        <button class="btn btn-warning">
                            <i class="fas fa-graduation-cap"></i> Training Programs
                        </button>
                        <button class="btn" style="background: #6b7280; color: white;">
                            <i class="fas fa-calendar"></i> Schedule Management
                        </button>
                    </div>
                </div>
            </div>

            <!-- Student Affairs Section -->
            <div id="students" class="section-content">
                <div class="header">
                    <div class="welcome-text">Student Affairs</div>
                    <div class="subtitle">Manage student welfare and activities</div>
                </div>

                <div class="content-card">
                    <h3>Student Statistics</h3>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-value"><?php echo number_format($school_stats['total_students']); ?></div>
                            <div class="stat-label">Total Students</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #2563eb 0%, #667eea 100%);">
                                <i class="fas fa-home"></i>
                            </div>
                            <div class="stat-value"><?php echo $school_stats['hostel_occupancy']; ?>%</div>
                            <div class="stat-label">Hostel Occupancy</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);">
                                <i class="fas fa-running"></i>
                            </div>
                            <div class="stat-value"><?php echo $school_stats['sports_participation']; ?>%</div>
                            <div class="stat-label">Sports Participation</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="stat-value"><?php echo $school_stats['library_usage']; ?>%</div>
                            <div class="stat-label">Library Usage</div>
                        </div>
                    </div>
                </div>

                <div class="content-card">
                    <h3>Student Services</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                        <button class="btn btn-primary">
                            <i class="fas fa-user-plus"></i> Admissions
                        </button>
                        <button class="btn btn-success">
                            <i class="fas fa-home"></i> Hostel Management
                        </button>
                        <button class="btn btn-warning">
                            <i class="fas fa-utensils"></i> Meal Services
                        </button>
                        <button class="btn" style="background: #6b7280; color: white;">
                            <i class="fas fa-heartbeat"></i> Health Services
                        </button>
                    </div>
                </div>
            </div>

            <!-- Discipline Section -->
            <div id="discipline" class="section-content">
                <div class="header">
                    <div class="welcome-text">Discipline Management</div>
                    <div class="subtitle">Handle student disciplinary matters</div>
                </div>

                <div class="content-card">
                    <h3>Discipline Overview</h3>
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        <div>
                            <strong>Pending Cases:</strong> <?php echo $school_stats['discipline_cases']; ?> disciplinary cases require attention
                        </div>
                    </div>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Case ID</th>
                                <th>Student</th>
                                <th>Issue</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>DIS001</td>
                                <td>John Doe</td>
                                <td>Attendance Issues</td>
                                <td>2024-01-20</td>
                                <td><span style="color: #f59e0b;">Pending</span></td>
                                <td>
                                    <button class="btn btn-primary" style="padding: 0.5rem; font-size: 0.9rem;">Review</button>
                                </td>
                            </tr>
                            <tr>
                                <td>DIS002</td>
                                <td>Jane Smith</td>
                                <td>Conduct Violation</td>
                                <td>2024-01-18</td>
                                <td><span style="color: #059669;">Resolved</span></td>
                                <td>
                                    <button class="btn btn-success" style="padding: 0.5rem; font-size: 0.9rem;">View</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Facilities Section -->
            <div id="facilities" class="section-content">
                <div class="header">
                    <div class="welcome-text">Facilities Management</div>
                    <div class="subtitle">Oversee school infrastructure and maintenance</div>
                </div>

                <div class="content-card">
                    <h3>Facility Utilization</h3>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
                                <i class="fas fa-flask"></i>
                            </div>
                            <div class="stat-value"><?php echo $school_stats['lab_utilization']; ?>%</div>
                            <div class="stat-label">Lab Utilization</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #2563eb 0%, #667eea 100%);">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="stat-value"><?php echo $school_stats['library_usage']; ?>%</div>
                            <div class="stat-label">Library Usage</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);">
                                <i class="fas fa-laptop"></i>
                            </div>
                            <div class="stat-value">95%</div>
                            <div class="stat-label">ICT Labs</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);">
                                <i class="fas fa-bed"></i>
                            </div>
                            <div class="stat-value"><?php echo $school_stats['hostel_occupancy']; ?>%</div>
                            <div class="stat-label">Hostel Occupancy</div>
                        </div>
                    </div>
                </div>

                <div class="content-card">
                    <h3>Facility Management</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                        <button class="btn btn-primary">
                            <i class="fas fa-tools"></i> Maintenance
                        </button>
                        <button class="btn btn-success">
                            <i class="fas fa-wrench"></i> Repairs
                        </button>
                        <button class="btn btn-warning">
                            <i class="fas fa-shield-alt"></i> Safety Inspection
                        </button>
                        <button class="btn" style="background: #6b7280; color: white;">
                            <i class="fas fa-clipboard-check"></i> Inventory
                        </button>
                    </div>
                </div>
            </div>

            <!-- Reports Section -->
            <div id="reports" class="section-content">
                <div class="header">
                    <div class="welcome-text">School Reports</div>
                    <div class="subtitle">Generate comprehensive school reports</div>
                </div>

                <div class="content-card">
                    <h3>Available Reports</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
                        <button class="btn btn-primary">
                            <i class="fas fa-chart-line"></i> Academic Performance
                        </button>
                        <button class="btn btn-success">
                            <i class="fas fa-users"></i> Staff Report
                        </button>
                        <button class="btn btn-warning">
                            <i class="fas fa-graduation-cap"></i> Student Report
                        </button>
                        <button class="btn" style="background: #6b7280; color: white;">
                            <i class="fas fa-building"></i> Facility Report
                        </button>
                        <button class="btn" style="background: #10b981; color: white;">
                            <i class="fas fa-dollar-sign"></i> Financial Report
                        </button>
                        <button class="btn" style="background: #8b5cf6; color: white;">
                            <i class="fas fa-calendar"></i> Annual Report
                        </button>
                    </div>
                </div>
            </div>

            <!-- Calendar Section -->
            <div id="calendar" class="section-content">
                <div class="header">
                    <div class="welcome-text">School Calendar</div>
                    <div class="subtitle">Manage school events and schedules</div>
                </div>

                <div class="content-card">
                    <h3>Upcoming Events</h3>
                    <?php foreach ($upcoming_events as $event): ?>
                    <div class="event-item">
                        <div class="event-date"><?php echo date('M d', strtotime($event['date'])); ?></div>
                        <div class="activity-content">
                            <div style="font-weight: 600;"><?php echo htmlspecialchars($event['event']); ?></div>
                            <div style="color: #6b7280; font-size: 0.9rem;"><?php echo ucfirst($event['type']); ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="content-card">
                    <h3>Calendar Management</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                        <button class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Event
                        </button>
                        <button class="btn btn-success">
                            <i class="fas fa-calendar"></i> Academic Calendar
                        </button>
                        <button class="btn btn-warning">
                            <i class="fas fa-bell"></i> Reminders
                        </button>
                        <button class="btn" style="background: #6b7280; color: white;">
                            <i class="fas fa-download"></i> Export Calendar
                        </button>
                    </div>
                </div>
            </div>

            <!-- Settings Section -->
            <div id="settings" class="section-content">
                <div class="header">
                    <div class="welcome-text">System Settings</div>
                    <div class="subtitle">Configure school management preferences</div>
                </div>

                <div class="content-card">
                    <h3>Principal Settings</h3>
                    <form>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
                            <div>
                                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Email Notifications</label>
                                <select style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px;">
                                    <option>Enabled</option>
                                    <option>Disabled</option>
                                </select>
                            </div>
                            <div>
                                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Report Frequency</label>
                                <select style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px;">
                                    <option>Daily</option>
                                    <option>Weekly</option>
                                    <option>Monthly</option>
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

<?php
// Helper functions
function getActivityIcon($type) {
    $icons = [
        'success' => 'check',
        'info' => 'info',
        'warning' => 'exclamation-triangle'
    ];
    return isset($icons[$type]) ? $icons[$type] : 'circle';
}
?>
