<?php
// Error reporting disabled for clean display
error_reporting(0);
ini_set('display_errors', 0);

// Start session if needed
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check authentication
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Get user role from session
$user_role = $_SESSION['user']['role'];
$user_name = $_SESSION['user']['name'];
$login_time = $_SESSION['user']['login_time'];

// Role-based dashboard configuration
$dashboard_configs = [
    'director-general' => [
        'title' => 'Director General Dashboard',
        'subtitle' => 'Executive Management System',
        'icon' => 'fas fa-user-tie',
        'color' => '#1e40af',
        'modules' => ['overview', 'management', 'reports', 'settings']
    ],
    'director-academics' => [
        'title' => 'Director of Academics Dashboard',
        'subtitle' => 'Academic Management System',
        'icon' => 'fas fa-graduation-cap',
        'color' => '#1e40af',
        'modules' => ['academics', 'faculty', 'curriculum', 'reports']
    ],
    'director-ict' => [
        'title' => 'Director of ICT Dashboard',
        'subtitle' => 'ICT Management System',
        'icon' => 'fas fa-laptop-code',
        'color' => '#1e40af',
        'modules' => ['systems', 'network', 'support', 'security']
    ],
    'director-finance' => [
        'title' => 'Director of Finance Dashboard',
        'subtitle' => 'Financial Management System',
        'icon' => 'fas fa-chart-line',
        'color' => '#1e40af',
        'modules' => ['finance', 'budget', 'reports', 'audit']
    ],
    'principal' => [
        'title' => 'School Principal Dashboard',
        'subtitle' => 'School Management System',
        'icon' => 'fas fa-user-shield',
        'color' => '#dc2626',
        'modules' => ['overview', 'academics', 'staff', 'students']
    ],
    'deputy-principal' => [
        'title' => 'Deputy Principal Dashboard',
        'subtitle' => 'School Management System',
        'icon' => 'fas fa-user-tie',
        'color' => '#dc2626',
        'modules' => ['academics', 'discipline', 'operations']
    ],
    'school-bursar' => [
        'title' => 'School Bursar Dashboard',
        'subtitle' => 'Financial Management System',
        'icon' => 'fas fa-coins',
        'color' => '#059669',
        'modules' => ['fees', 'payments', 'budget', 'reports']
    ],
    'academic-registrar' => [
        'title' => 'Academic Registrar Dashboard',
        'subtitle' => 'Academic Records Management',
        'icon' => 'fas fa-file-alt',
        'color' => '#7c3aed',
        'modules' => ['records', 'registration', 'exams', 'certificates']
    ],
    'hr-manager' => [
        'title' => 'HR Manager Dashboard',
        'subtitle' => 'Human Resources Management',
        'icon' => 'fas fa-users',
        'color' => '#7c3aed',
        'modules' => ['staff', 'payroll', 'recruitment', 'performance']
    ],
    'head-nursing' => [
        'title' => 'Head of Nursing Dashboard',
        'subtitle' => 'Nursing Department Management',
        'icon' => 'fas fa-user-nurse',
        'color' => '#0891b2',
        'modules' => ['students', 'faculty', 'clinical', 'curriculum']
    ],
    'head-midwifery' => [
        'title' => 'Head of Midwifery Dashboard',
        'subtitle' => 'Midwifery Department Management',
        'icon' => 'fas fa-baby',
        'color' => '#0891b2',
        'modules' => ['students', 'faculty', 'clinical', 'curriculum']
    ],
    'lecturer' => [
        'title' => 'Lecturer Dashboard',
        'subtitle' => 'Academic Staff Portal',
        'icon' => 'fas fa-chalkboard-teacher',
        'color' => '#0891b2',
        'modules' => ['courses', 'students', 'grades', 'schedule']
    ],
    'student' => [
        'title' => 'Student Dashboard',
        'subtitle' => 'Student Portal',
        'icon' => 'fas fa-user-graduate',
        'color' => '#ea580c',
        'modules' => ['courses', 'grades', 'fees', 'schedule']
    ]
];

// Get current role configuration
$config = isset($dashboard_configs[$user_role]) ? $dashboard_configs[$user_role] : $dashboard_configs['student'];

// Mock data for demonstration
$stats_data = [
    'overview' => [
        ['title' => 'Total Students', 'value' => 245, 'icon' => 'fas fa-users', 'color' => '#059669'],
        ['title' => 'Active Courses', 'value' => 12, 'icon' => 'fas fa-book', 'color' => '#2563eb'],
        ['title' => 'Staff Members', 'value' => 45, 'icon' => 'fas fa-chalkboard-teacher', 'color' => '#7c3aed'],
        ['title' => 'Completion Rate', 'value' => '92%', 'icon' => 'fas fa-chart-line', 'color' => '#10b981']
    ],
    'finance' => [
        ['title' => 'Total Revenue', 'value' => 'UGX 380M', 'icon' => 'fas fa-money-bill-wave', 'color' => '#059669'],
        ['title' => 'Expenses', 'value' => 'UGX 120M', 'icon' => 'fas fa-receipt', 'color' => '#dc2626'],
        ['title' => 'Outstanding', 'value' => 'UGX 45M', 'icon' => 'fas fa-exclamation-triangle', 'color' => '#f59e0b'],
        ['title' => 'Collection Rate', 'value' => '88%', 'icon' => 'fas fa-percentage', 'color' => '#10b981']
    ],
    'academics' => [
        ['title' => 'Enrolled Students', 'value' => 245, 'icon' => 'fas fa-user-graduate', 'color' => '#059669'],
        ['title' => 'Courses Offered', 'value' => 18, 'icon' => 'fas fa-book', 'color' => '#2563eb'],
        ['title' => 'Pass Rate', 'value' => '94%', 'icon' => 'fas fa-trophy', 'color' => '#10b981'],
        ['title' => 'Avg GPA', 'value' => '3.6', 'icon' => 'fas fa-chart-line', 'color' => '#7c3aed']
    ]
];

// Get appropriate stats based on role
$role_stats = [];
if (in_array('finance', $config['modules'])) {
    $role_stats = $stats_data['finance'];
} elseif (in_array('academics', $config['modules'])) {
    $role_stats = $stats_data['academics'];
} else {
    $role_stats = $stats_data['overview'];
}

// Recent activities data
$recent_activities = [
    ['time' => '2 hours ago', 'activity' => 'New student registration', 'user' => 'John Doe', 'type' => 'success'],
    ['time' => '4 hours ago', 'activity' => 'Payment received', 'user' => 'Jane Smith', 'type' => 'success'],
    ['time' => '6 hours ago', 'activity' => 'Course updated', 'user' => 'Prof. Johnson', 'type' => 'info'],
    ['time' => '1 day ago', 'activity' => 'Exam results published', 'user' => 'Academic Office', 'type' => 'warning']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($config['title']); ?> - ISNM</title>
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
            background: linear-gradient(135deg, <?php echo $config['color']; ?> 0%, <?php echo $config['color']; ?> 100%);
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
            background: linear-gradient(135deg, <?php echo $config['color']; ?> 0%, <?php echo $config['color']; ?> 100%);
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
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <div class="user-info">
                <div class="user-avatar">
                    <i class="<?php echo $config['icon']; ?>"></i>
                </div>
                <div>
                    <div style="font-weight: 600;"><?php echo htmlspecialchars($user_name); ?></div>
                    <div style="color: #6b7280; font-size: 0.9rem;"><?php echo htmlspecialchars($config['title']); ?></div>
                </div>
            </div>
            
            <nav style="margin-top: 2rem;">
                <a href="#" class="nav-link active" data-section="dashboard">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <?php foreach ($config['modules'] as $module): ?>
                <a href="#" class="nav-link" data-section="<?php echo htmlspecialchars($module); ?>">
                    <i class="fas fa-<?php echo getModuleIcon($module); ?>"></i> <?php echo ucfirst($module); ?>
                </a>
                <?php endforeach; ?>
                <a href="#" class="nav-link" data-section="reports">
                    <i class="fas fa-chart-line"></i> Reports
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
                    <div class="welcome-text"><?php echo htmlspecialchars($config['title']); ?></div>
                    <div class="subtitle"><?php echo htmlspecialchars($config['subtitle']); ?></div>
                    <div style="color: #6b7280; font-size: 0.9rem; margin-top: 0.5rem;">
                        Last login: <?php echo date('d M Y, h:i A', strtotime($login_time)); ?>
                    </div>
                </div>

                <div class="stats-grid">
                    <?php foreach ($role_stats as $stat): ?>
                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, <?php echo $stat['color']; ?> 0%, <?php echo $stat['color']; ?> 100%);">
                            <i class="<?php echo $stat['icon']; ?>"></i>
                        </div>
                        <div class="stat-value"><?php echo htmlspecialchars($stat['value']); ?></div>
                        <div class="stat-label"><?php echo htmlspecialchars($stat['title']); ?></div>
                    </div>
                    <?php endforeach; ?>
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
            </div>

            <!-- Dynamic Module Sections -->
            <?php foreach ($config['modules'] as $module): ?>
            <div id="<?php echo htmlspecialchars($module); ?>" class="section-content">
                <div class="header">
                    <div class="welcome-text"><?php echo ucfirst($module); ?> Management</div>
                    <div class="subtitle">Manage <?php echo htmlspecialchars($module); ?> operations</div>
                </div>

                <div class="content-card">
                    <h3><?php echo ucfirst($module); ?> Overview</h3>
                    <p style="margin-bottom: 1rem;">This section provides comprehensive management tools for <?php echo htmlspecialchars($module); ?> operations.</p>
                    <div class="form-row">
                        <button class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New
                        </button>
                        <button class="btn btn-success">
                            <i class="fas fa-eye"></i> View All
                        </button>
                        <button class="btn" style="background: #6b7280; color: white;">
                            <i class="fas fa-download"></i> Export
                        </button>
                    </div>
                </div>

                <div class="content-card">
                    <h3>Recent <?php echo ucfirst($module); ?> Activities</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#001</td>
                                <td>Sample <?php echo ucfirst($module); ?></td>
                                <td><span style="color: #059669;">Active</span></td>
                                <td><?php echo date('d M Y'); ?></td>
                                <td>
                                    <button class="btn btn-primary" style="padding: 0.5rem; font-size: 0.9rem;">View</button>
                                    <button class="btn btn-success" style="padding: 0.5rem; font-size: 0.9rem;">Edit</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endforeach; ?>

            <!-- Reports Section -->
            <div id="reports" class="section-content">
                <div class="header">
                    <div class="welcome-text">Reports & Analytics</div>
                    <div class="subtitle">Generate comprehensive reports</div>
                </div>

                <div class="content-card">
                    <h3>Available Reports</h3>
                    <div class="form-row">
                        <button class="btn btn-primary">
                            <i class="fas fa-file-pdf"></i> Monthly Report
                        </button>
                        <button class="btn btn-success">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </button>
                        <button class="btn" style="background: #6b7280; color: white;">
                            <i class="fas fa-print"></i> Print Report
                        </button>
                    </div>
                </div>
            </div>

            <!-- Settings Section -->
            <div id="settings" class="section-content">
                <div class="header">
                    <div class="welcome-text">System Settings</div>
                    <div class="subtitle">Configure system preferences</div>
                </div>

                <div class="content-card">
                    <h3>User Preferences</h3>
                    <form>
                        <div class="form-group">
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Email Notifications</label>
                            <select style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px;">
                                <option>Enabled</option>
                                <option>Disabled</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Theme</label>
                            <select style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px;">
                                <option>Light</option>
                                <option>Dark</option>
                            </select>
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
function getModuleIcon($module) {
    $icons = [
        'overview' => 'tachometer-alt',
        'academics' => 'graduation-cap',
        'finance' => 'coins',
        'fees' => 'money-bill-wave',
        'payments' => 'credit-card',
        'budget' => 'wallet',
        'students' => 'user-graduate',
        'faculty' => 'chalkboard-teacher',
        'courses' => 'book',
        'grades' => 'chart-line',
        'schedule' => 'calendar',
        'staff' => 'users',
        'payroll' => 'money-check',
        'recruitment' => 'user-plus',
        'performance' => 'trophy',
        'records' => 'file-alt',
        'registration' => 'user-plus',
        'exams' => 'clipboard-check',
        'certificates' => 'award',
        'systems' => 'server',
        'network' => 'network-wired',
        'support' => 'headset',
        'security' => 'shield-alt',
        'management' => 'briefcase',
        'reports' => 'chart-line',
        'audit' => 'search',
        'curriculum' => 'book-open',
        'clinical' => 'hospital',
        'operations' => 'cogs'
    ];
    return isset($icons[$module]) ? $icons[$module] : 'folder';
}

function getActivityIcon($type) {
    $icons = [
        'success' => 'check',
        'info' => 'info',
        'warning' => 'exclamation-triangle'
    ];
    return isset($icons[$type]) ? $icons[$type] : 'circle';
}
?>
