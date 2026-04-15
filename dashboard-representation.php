<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
    header('Location: login-portal.php');
    exit();
}
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Representation Dashboard - ISNM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary: #dc2626; --secondary: #ef4444; --accent: #f87171;
            --success: #10b981; --warning: #f59e0b; --danger: #ef4444;
            --white: #ffffff; --gray-50: #f9fafb; --gray-100: #f3f4f6;
            --gray-200: #e5e7eb; --gray-300: #d1d5db; --gray-600: #4b5563;
            --gray-700: #374151; --gray-800: #1f2937; --gray-900: #111827;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1);
        }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background: var(--gray-50); color: var(--gray-900); }
        .dashboard { display: flex; min-height: 100vh; }
        .sidebar { width: 280px; background: var(--white); box-shadow: var(--shadow-lg); }
        .sidebar-header { padding: 2rem; border-bottom: 1px solid var(--gray-200); }
        .user-info { display: flex; align-items: center; gap: 1rem; }
        .user-avatar { width: 48px; height: 48px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem; }
        .user-details h3 { font-size: 1.1rem; font-weight: 600; margin-bottom: 0.25rem; }
        .user-details p { font-size: 0.875rem; color: var(--gray-600); }
        .nav-menu { list-style: none; padding: 1rem 0; }
        .nav-item { margin-bottom: 0.25rem; }
        .nav-link { display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 2rem; color: var(--gray-700); text-decoration: none; transition: all 0.2s; border-left: 3px solid transparent; }
        .nav-link:hover, .nav-link.active { background: var(--gray-50); color: var(--primary); border-left-color: var(--primary); }
        .main-content { flex: 1; padding: 2rem; }
        .header { background: var(--white); border-radius: 12px; padding: 2rem; box-shadow: var(--shadow-md); margin-bottom: 2rem; }
        .header h1 { font-size: 2rem; font-weight: 700; margin-bottom: 0.5rem; }
        .header p { color: var(--gray-600); }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
        .stat-card { background: var(--white); border-radius: 12px; padding: 1.5rem; box-shadow: var(--shadow-md); transition: transform 0.2s; }
        .stat-card:hover { transform: translateY(-2px); }
        .stat-icon { width: 48px; height: 48px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; margin-bottom: 1rem; }
        .stat-icon.red { background: rgba(220, 38, 38, 0.1); color: var(--danger); }
        .stat-icon.green { background: rgba(16, 185, 129, 0.1); color: var(--success); }
        .stat-icon.blue { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
        .stat-icon.yellow { background: rgba(245, 158, 11, 0.1); color: var(--warning); }
        .stat-value { font-size: 2rem; font-weight: 700; margin-bottom: 0.25rem; }
        .stat-label { color: var(--gray-600); font-size: 0.875rem; }
        .content-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 2rem; margin-bottom: 2rem; }
        .card { background: var(--white); border-radius: 12px; padding: 1.5rem; box-shadow: var(--shadow-md); }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        .card-title { font-size: 1.25rem; font-weight: 600; }
        .btn { padding: 0.5rem 1rem; border-radius: 8px; font-weight: 500; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s; border: none; cursor: pointer; }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--secondary); }
        .btn-secondary { background: var(--gray-200); color: var(--gray-700); }
        .btn-secondary:hover { background: var(--gray-300); }
        .council-list { list-style: none; max-height: 400px; overflow-y: auto; }
        .council-item { background: var(--gray-50); border-radius: 8px; padding: 1rem; margin-bottom: 1rem; border-left: 4px solid var(--primary); }
        .council-member { font-weight: 600; color: var(--primary); margin-bottom: 0.25rem; }
        .council-position { font-weight: 500; margin-bottom: 0.25rem; }
        .council-meta { font-size: 0.875rem; color: var(--gray-600); }
        .activity-list { list-style: none; max-height: 400px; overflow-y: auto; }
        .activity-item { display: flex; align-items: center; gap: 1rem; padding: 1rem 0; border-bottom: 1px solid var(--gray-100); }
        .activity-item:last-child { border-bottom: none; }
        .activity-icon { width: 40px; height: 40px; border-radius: 50%; background: var(--gray-200); display: flex; align-items: center; justify-content: center; color: var(--gray-600); }
        .activity-info { flex: 1; }
        .activity-title { font-weight: 500; margin-bottom: 0.25rem; }
        .activity-time { font-size: 0.875rem; color: var(--gray-600); }
        .activity-status { padding: 0.25rem 0.75rem; border-radius: 12px; font-size: 0.75rem; font-weight: 500; }
        .status-active { background: rgba(16, 185, 129, 0.1); color: var(--success); }
        .status-pending { background: rgba(245, 158, 11, 0.1); color: var(--warning); }
        .status-completed { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
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
                <div class="user-info">
                    <div class="user-avatar"><i class="fas fa-crown"></i></div>
                    <div class="user-details">
                        <h3><?php echo htmlspecialchars($user['username']); ?></h3>
                        <p>Student Leader</p>
                    </div>
                </div>
            </div>
            <nav>
                <ul class="nav-menu">
                    <li class="nav-item"><a href="#" class="nav-link active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-users"></i> Guild Council</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-comments"></i> Student Forum</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-calendar"></i> Events</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-bullhorn"></i> Announcements</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-chart-line"></i> Reports</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-cog"></i> Settings</a></li>
                    <li class="nav-item"><a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <div class="header">
                <h1>Student Representation Dashboard</h1>
                <p>Welcome back, <?php echo htmlspecialchars($user['username']); ?>. Lead and represent the student body effectively.</p>
            </div>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon red"><i class="fas fa-users"></i></div>
                    <div class="stat-value">856</div>
                    <div class="stat-label">Total Students</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon green"><i class="fas fa-crown"></i></div>
                    <div class="stat-value">12</div>
                    <div class="stat-label">Guild Council Members</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon blue"><i class="fas fa-calendar"></i></div>
                    <div class="stat-value">8</div>
                    <div class="stat-label">Events This Month</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon yellow"><i class="fas fa-comments"></i></div>
                    <div class="stat-value">24</div>
                    <div class="stat-label">Active Discussions</div>
                </div>
            </div>
            <div class="content-grid">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Guild Council Members</h2>
                        <a href="#" class="btn btn-secondary">View All</a>
                    </div>
                    <ul class="council-list">
                        <li class="council-item">
                            <div class="council-member">Guild President</div>
                            <div class="council-position">John Mugisha</div>
                            <div class="council-meta">Leading student government initiatives</div>
                        </li>
                        <li class="council-item">
                            <div class="council-member">Vice President</div>
                            <div class="council-position">Sarah Namuli</div>
                            <div class="council-meta">Supporting presidential activities</div>
                        </li>
                        <li class="council-item">
                            <div class="council-member">Minister of Academics</div>
                            <div class="council-position">Michael Kato</div>
                            <div class="council-meta">Representing academic interests</div>
                        </li>
                        <li class="council-item">
                            <div class="council-member">Minister of Welfare</div>
                            <div class="council-position">Grace Nakato</div>
                            <div class="council-meta">Managing student welfare programs</div>
                        </li>
                        <li class="council-item">
                            <div class="council-member">Minister of Sports</div>
                            <div class="council-position">David Ssebadduka</div>
                            <div class="council-meta">Organizing sports activities</div>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Recent Activities</h2>
                        <a href="#" class="btn btn-secondary">View All</a>
                    </div>
                    <ul class="activity-list">
                        <li class="activity-item">
                            <div class="activity-icon"><i class="fas fa-users"></i></div>
                            <div class="activity-info">
                                <div class="activity-title">General Assembly Meeting</div>
                                <div class="activity-time">Tomorrow - 3:00 PM - Main Hall</div>
                            </div>
                            <div class="activity-status status-active">Scheduled</div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-icon"><i class="fas fa-comments"></i></div>
                            <div class="activity-info">
                                <div class="activity-title">Student Forum Discussion</div>
                                <div class="activity-time">Friday - 5:00 PM - Online</div>
                            </div>
                            <div class="activity-status status-pending">Pending</div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-icon"><i class="fas fa-calendar"></i></div>
                            <div class="activity-info">
                                <div class="activity-title">Cultural Week Event</div>
                                <div class="activity-time">Last Week - Completed</div>
                            </div>
                            <div class="activity-status status-completed">Completed</div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-icon"><i class="fas fa-bullhorn"></i></div>
                            <div class="activity-info">
                                <div class="activity-title">Student Rights Campaign</div>
                                <div class="activity-time">2 days ago - Ongoing</div>
                            </div>
                            <div class="activity-status status-active">Active</div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Student Leadership Operations</h2>
                </div>
                <div style="display: flex; flex-wrap: wrap; gap: 1rem;">
                    <a href="#" class="btn btn-primary"><i class="fas fa-plus"></i> Schedule Meeting</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-bullhorn"></i> Send Announcement</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-calendar-plus"></i> Organize Event</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-chart-bar"></i> Generate Report</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-comments"></i> Start Discussion</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-envelope"></i> Contact Students</a>
                </div>
            </div>
        </main>
    </div>
    <</body>
</html>
