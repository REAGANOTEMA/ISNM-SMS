<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'lecturer') {
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
    <title>Academic Staff Dashboard - ISNM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
                :root {
            /* Dark and Creamy Yellow Color Palette */
            --primary-dark: #1a1a1a;
            --creamy-yellow: #FFF8DC;
            --accent-gold: #FFD700;
            --secondary-dark: #2d2d2d;
            --light-cream: #FAF0E6;
            --dark-accent: #B8860B;
            --white: #FFFFFF;
            --gray-light: #F5F5F5;
            --gray-medium: #D3D3D3;
            --gray-dark: #696969;
            
            /* Gradients */
            --gradient-hero: linear-gradient(135deg, var(--primary-dark) 0%, var(--secondary-dark) 50%, var(--accent-gold) 100%);
            --gradient-primary: linear-gradient(135deg, var(--primary-dark) 0%, var(--accent-gold) 100%);
            --gradient-luxury: linear-gradient(135deg, var(--accent-gold) 0%, var(--creamy-yellow) 100%);
            --gradient-clean: linear-gradient(135deg, var(--light-cream) 0%, var(--white) 100%);
            
            /* Shadows */
            --shadow-sm: 0 2px 4px rgba(26, 26, 26, 0.1);
            --shadow-md: 0 4px 8px rgba(26, 26, 26, 0.15);
            --shadow-lg: 0 8px 16px rgba(26, 26, 26, 0.2);
            --shadow-xl: 0 20px 40px rgba(26, 26, 26, 0.25);
            --shadow-neon: 0 0 20px rgba(255, 215, 0, 0.3);
            
            /* Borders */
            --border-light: var(--gray-medium);
            --border-medium: var(--gray-dark);
            --border-dark: var(--primary-dark);
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
        .stat-icon.green { background: rgba(5, 150, 105, 0.1); color: var(--success); }
        .stat-icon.blue { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
        .stat-icon.yellow { background: rgba(245, 158, 11, 0.1); color: var(--warning); }
        .stat-icon.red { background: rgba(239, 68, 68, 0.1); color: var(--danger); }
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
        .staff-list { list-style: none; max-height: 400px; overflow-y: auto; }
        .staff-item { background: var(--gray-50); border-radius: 8px; padding: 1rem; margin-bottom: 1rem; border-left: 4px solid var(--primary); }
        .staff-name { font-weight: 600; color: var(--primary); margin-bottom: 0.25rem; }
        .staff-role { font-weight: 500; margin-bottom: 0.25rem; }
        .staff-meta { font-size: 0.875rem; color: var(--gray-600); }
        .schedule-list { list-style: none; max-height: 400px; overflow-y: auto; }
        .schedule-item { display: flex; align-items: center; gap: 1rem; padding: 1rem 0; border-bottom: 1px solid var(--gray-100); }
        .schedule-item:last-child { border-bottom: none; }
        .schedule-icon { width: 40px; height: 40px; border-radius: 50%; background: var(--gray-200); display: flex; align-items: center; justify-content: center; color: var(--gray-600); }
        .schedule-info { flex: 1; }
        .schedule-title { font-weight: 500; margin-bottom: 0.25rem; }
        .schedule-time { font-size: 0.875rem; color: var(--gray-600); }
        .schedule-status { padding: 0.25rem 0.75rem; border-radius: 12px; font-size: 0.75rem; font-weight: 500; }
        .status-teaching { background: rgba(16, 185, 129, 0.1); color: var(--success); }
        .status-preparation { background: rgba(245, 158, 11, 0.1); color: var(--warning); }
        .status-available { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
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
                    <div class="user-avatar"><i class="fas fa-user-nurse"></i></div>
                    <div class="user-details">
                        <h3><?php echo htmlspecialchars($user['username']); ?></h3>
                        <p>Academic Staff</p>
                    </div>
                </div>
            </div>
            <nav>
                <ul class="nav-menu">
                    <li class="nav-item"><a href="#" class="nav-link active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-book"></i> My Courses</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-users"></i> Students</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-calendar"></i> Teaching Schedule</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-clipboard-list"></i> Assignments</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-chart-line"></i> Performance</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-cog"></i> Settings</a></li>
                    <li class="nav-item"><a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <div class="header">
                <h1>Academic Staff Dashboard</h1>
                <p>Welcome back, <?php echo htmlspecialchars($user['username']); ?>. Manage your teaching activities and student interactions.</p>
            </div>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon green"><i class="fas fa-book"></i></div>
                    <div class="stat-value">6</div>
                    <div class="stat-label">Active Courses</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon blue"><i class="fas fa-users"></i></div>
                    <div class="stat-value">142</div>
                    <div class="stat-label">Total Students</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon yellow"><i class="fas fa-calendar"></i></div>
                    <div class="stat-value">24</div>
                    <div class="stat-label">Classes This Week</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon red"><i class="fas fa-clipboard-list"></i></div>
                    <div class="stat-value">18</div>
                    <div class="stat-label">Pending Assignments</div>
                </div>
            </div>
            <div class="content-grid">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Academic Staff Members</h2>
                        <a href="#" class="btn btn-secondary">View All</a>
                    </div>
                    <ul class="staff-list">
                        <li class="staff-item">
                            <div class="staff-name">Nursing Tutors</div>
                            <div class="staff-role">12 Faculty Members</div>
                            <div class="staff-meta">428 students enrolled across 18 courses</div>
                        </li>
                        <li class="staff-item">
                            <div class="staff-name">Midwifery Tutors</div>
                            <div class="staff-role">8 Faculty Members</div>
                            <div class="staff-meta">428 students enrolled across 12 courses</div>
                        </li>
                        <li class="staff-item">
                            <div class="staff-name">ICT Department Staff</div>
                            <div class="staff-role">4 Technical Staff</div>
                            <div class="staff-meta">Supporting all academic programs</div>
                        </li>
                        <li class="staff-item">
                            <div class="staff-name">Skills Lab Attendant</div>
                            <div class="staff-role">2 Lab Assistants</div>
                            <div class="staff-meta">Managing practical training sessions</div>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Today's Teaching Schedule</h2>
                        <a href="#" class="btn btn-secondary">View All</a>
                    </div>
                    <ul class="schedule-list">
                        <li class="schedule-item">
                            <div class="schedule-icon"><i class="fas fa-heartbeat"></i></div>
                            <div class="schedule-info">
                                <div class="schedule-title">Fundamental Nursing Skills</div>
                                <div class="schedule-time">8:00 AM - 10:00 AM - Lab Room A</div>
                            </div>
                            <div class="schedule-status status-teaching">Teaching</div>
                        </li>
                        <li class="schedule-item">
                            <div class="schedule-icon"><i class="fas fa-baby"></i></div>
                            <div class="schedule-info">
                                <div class="schedule-title">Antenatal Care Theory</div>
                                <div class="schedule-time">11:00 AM - 1:00 PM - Classroom 3</div>
                            </div>
                            <div class="schedule-status status-preparation">Preparation</div>
                        </li>
                        <li class="schedule-item">
                            <div class="schedule-icon"><i class="fas fa-stethoscope"></i></div>
                            <div class="schedule-info">
                                <div class="schedule-title">Clinical Assessment</div>
                                <div class="schedule-time">2:00 PM - 4:00 PM - Skills Lab</div>
                            </div>
                            <div class="schedule-status status-available">Available</div>
                        </li>
                        <li class="schedule-item">
                            <div class="schedule-icon"><i class="fas fa-pills"></i></div>
                            <div class="schedule-info">
                                <div class="schedule-title">Pharmacology Review</div>
                                <div class="schedule-time">4:30 PM - 6:00 PM - Tutorial Room</div>
                            </div>
                            <div class="schedule-status status-available">Available</div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Teaching Operations</h2>
                </div>
                <div style="display: flex; flex-wrap: wrap; gap: 1rem;">
                    <a href="#" class="btn btn-primary"><i class="fas fa-plus"></i> Create Assignment</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-clipboard-check"></i> Grade Submissions</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-calendar-plus"></i> Schedule Class</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-chart-bar"></i> View Reports</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-bell"></i> Send Announcement</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-download"></i> Export Grades</a>
                </div>
            </div>
        </main>
    </div>
    <</body>
</html>


