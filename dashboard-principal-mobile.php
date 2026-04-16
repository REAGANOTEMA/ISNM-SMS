<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin' || $_SESSION['user']['department'] !== 'management') {
    header('Location: login-portal-mobile.php');
    exit();
}
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal Dashboard - ISNM</title>
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
        .mobile-dashboard { min-height: 100vh; background: white; }
        .mobile-header { background: var(--gradient-primary); color: white; padding: 1.5rem; position: relative; overflow: hidden; }
        .mobile-header::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 70%); }
        .header-content { position: relative; z-index: 1; }
        .school-logo { width: 60px; height: 60px; border-radius: 50%; margin: 0 auto 1rem; display: block; box-shadow: var(--shadow-md); border: 2px solid white; }
        .user-info { text-align: center; margin-bottom: 1rem; }
        .user-avatar { width: 50px; height: 50px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 1.2rem; margin: 0 auto 0.5rem; }
        .user-name { font-size: 1.3rem; font-weight: 700; margin-bottom: 0.25rem; }
        .user-role { font-size: 0.9rem; opacity: 0.9; }
        .mobile-nav { display: flex; justify-content: space-around; background: white; border-top: 1px solid var(--gray-200); padding: 0.5rem 0; position: sticky; top: 0; z-index: 100; box-shadow: var(--shadow-sm); }
        .nav-item { flex: 1; text-align: center; padding: 0.75rem; color: var(--gray-600); text-decoration: none; font-size: 0.8rem; transition: all 0.3s ease; border-bottom: 3px solid transparent; }
        .nav-item.active { color: var(--primary); border-bottom-color: var(--primary); background: var(--gray-50); }
        .nav-item:hover { color: var(--primary); background: var(--gray-50); }
        .nav-icon { display: block; font-size: 1.2rem; margin-bottom: 0.25rem; }
        .content { padding: 1rem; }
        .stats-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-bottom: 1.5rem; }
        .stat-card { background: white; border-radius: 12px; padding: 1rem; box-shadow: var(--shadow-md); text-align: center; transition: transform 0.2s; border-left: 4px solid var(--primary); }
        .stat-card:hover { transform: translateY(-2px); }
        .stat-icon { width: 40px; height: 40px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; margin: 0 auto 0.5rem; }
        .stat-icon.blue { background: rgba(30, 58, 138, 0.1); color: var(--primary); }
        .stat-icon.green { background: rgba(16, 185, 129, 0.1); color: var(--success); }
        .stat-icon.yellow { background: rgba(245, 158, 11, 0.1); color: var(--warning); }
        .stat-icon.red { background: rgba(239, 68, 68, 0.1); color: var(--danger); }
        .stat-value { font-size: 1.5rem; font-weight: 700; margin-bottom: 0.25rem; }
        .stat-label { color: var(--gray-600); font-size: 0.75rem; }
        .card { background: white; border-radius: 12px; padding: 1rem; box-shadow: var(--shadow-md); margin-bottom: 1rem; }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 1px solid var(--gray-100); }
        .card-title { font-size: 1.1rem; font-weight: 600; }
        .btn { padding: 0.5rem 1rem; border-radius: 8px; font-weight: 500; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s; border: none; cursor: pointer; font-size: 0.85rem; }
        .btn-primary { background: var(--gradient-primary); color: white; }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: var(--shadow-md); }
        .btn-secondary { background: var(--gray-200); color: var(--gray-700); }
        .btn-secondary:hover { background: var(--gray-300); }
        .list-item { display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 0; border-bottom: 1px solid var(--gray-100); }
        .list-item:last-child { border-bottom: none; }
        .item-icon { width: 35px; height: 35px; border-radius: 50%; background: var(--gray-200); display: flex; align-items: center; justify-content: center; color: var(--gray-600); flex-shrink: 0; }
        .item-info { flex: 1; min-width: 0; }
        .item-title { font-weight: 500; margin-bottom: 0.25rem; font-size: 0.9rem; }
        .item-meta { font-size: 0.75rem; color: var(--gray-600); }
        .status-badge { padding: 0.25rem 0.5rem; border-radius: 12px; font-size: 0.7rem; font-weight: 500; white-space: nowrap; }
        .status-scheduled { background: rgba(16, 185, 129, 0.1); color: var(--success); }
        .status-pending { background: rgba(245, 158, 11, 0.1); color: var(--warning); }
        .status-completed { background: rgba(59, 130, 246, 0.1); color: var(--primary); }
        .action-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.75rem; }
        .footer { background: var(--gradient-primary); color: white; padding: 1.5rem; text-align: center; margin-top: auto; }
        .footer-title { font-size: 1rem; font-weight: 600; margin-bottom: 0.5rem; }
        .footer-subtitle { font-size: 0.8rem; margin-bottom: 1rem; opacity: 0.9; }
        .contact-buttons { display: flex; justify-content: center; gap: 0.5rem; flex-wrap: wrap; }
        .whatsapp-btn { padding: 0.5rem 1rem; background: linear-gradient(145deg, #25d366, #128c7e); color: white; text-decoration: none; border-radius: 8px; font-weight: 500; font-size: 0.75rem; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s; }
        .whatsapp-btn:hover { transform: translateY(-1px); }
        @media (max-width: 480px) { .stats-grid { grid-template-columns: 1fr; } .action-grid { grid-template-columns: 1fr; } }
        @media (min-width: 768px) { .stats-grid { grid-template-columns: repeat(4, 1fr); } .action-grid { grid-template-columns: repeat(4, 1fr); } }
    </style>
</head>
<body>
    <div class="mobile-dashboard">
        <header class="mobile-header">
            <div class="header-content">
                <img src="assets/school-logo.png" alt="ISNM Logo" class="school-logo">
                <div class="user-info">
                    <div class="user-avatar"><i class="fas fa-user-tie"></i></div>
                    <div class="user-name"><?php echo htmlspecialchars($user['username']); ?></div>
                    <div class="user-role">Principal</div>
                </div>
            </div>
        </header>

        <nav class="mobile-nav">
            <a href="#" class="nav-item active">
                <i class="fas fa-tachometer-alt nav-icon"></i>
                Dashboard
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-users nav-icon"></i>
                Staff
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-graduation-cap nav-icon"></i>
                Academic
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-chart-line nav-icon"></i>
                Reports
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-cog nav-icon"></i>
                Settings
            </a>
            <a href="logout.php" class="nav-item">
                <i class="fas fa-sign-out-alt nav-icon"></i>
                Logout
            </a>
        </nav>

        <main class="content">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon blue"><i class="fas fa-users"></i></div>
                    <div class="stat-value">856</div>
                    <div class="stat-label">Total Students</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon green"><i class="fas fa-chalkboard-teacher"></i></div>
                    <div class="stat-value">28</div>
                    <div class="stat-label">Academic Staff</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon yellow"><i class="fas fa-book"></i></div>
                    <div class="stat-value">42</div>
                    <div class="stat-label">Active Programs</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon red"><i class="fas fa-trophy"></i></div>
                    <div class="stat-value">96%</div>
                    <div class="stat-label">Pass Rate</div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Department Overview</h2>
                    <a href="#" class="btn btn-secondary">View All</a>
                </div>
                <div class="list-item">
                    <div class="item-icon"><i class="fas fa-graduation-cap"></i></div>
                    <div class="item-info">
                        <div class="item-title">Academic Department</div>
                        <div class="item-meta">18 faculty members, 428 students enrolled</div>
                    </div>
                </div>
                <div class="list-item">
                    <div class="item-icon"><i class="fas fa-building"></i></div>
                    <div class="item-info">
                        <div class="item-title">Administrative Department</div>
                        <div class="item-meta">10 staff members, managing operations</div>
                    </div>
                </div>
                <div class="list-item">
                    <div class="item-icon"><i class="fas fa-home"></i></div>
                    <div class="item-info">
                        <div class="item-title">Student Affairs Department</div>
                        <div class="item-meta">5 staff members, student welfare services</div>
                    </div>
                </div>
                <div class="list-item">
                    <div class="item-icon"><i class="fas fa-calculator"></i></div>
                    <div class="item-info">
                        <div class="item-title">Finance Department</div>
                        <div class="item-meta">4 staff members, financial management</div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Leadership Activities</h2>
                    <a href="#" class="btn btn-secondary">View All</a>
                </div>
                <div class="list-item">
                    <div class="item-icon"><i class="fas fa-users"></i></div>
                    <div class="item-info">
                        <div class="item-title">Board of Governors Meeting</div>
                        <div class="item-meta">Tomorrow - 10:00 AM - Board Room</div>
                    </div>
                    <div class="status-badge status-scheduled">Scheduled</div>
                </div>
                <div class="list-item">
                    <div class="item-icon"><i class="fas fa-graduation-cap"></i></div>
                    <div class="item-info">
                        <div class="item-title">Academic Council Meeting</div>
                        <div class="item-meta">Friday - 2:00 PM - Conference Hall</div>
                    </div>
                    <div class="status-badge status-pending">Pending</div>
                </div>
                <div class="list-item">
                    <div class="item-icon"><i class="fas fa-handshake"></i></div>
                    <div class="item-info">
                        <div class="item-title">Stakeholder Consultation</div>
                        <div class="item-meta">Next Monday - 9:00 AM - Main Hall</div>
                    </div>
                    <div class="status-badge status-scheduled">Scheduled</div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Principal Operations</h2>
                </div>
                <div class="action-grid">
                    <a href="#" class="btn btn-primary"><i class="fas fa-plus"></i> Approve Policies</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-users"></i> Staff Appointments</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-graduation-cap"></i> Academic Review</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-chart-bar"></i> Generate Reports</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-calendar"></i> Schedule Meetings</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-bullhorn"></i> Institute Policies</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-handshake"></i> Stakeholder Relations</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-trophy"></i> Award Recognition</a>
                </div>
            </div>
        </main>

        <footer class="footer">
            <h3 class="footer-title">Designed and Developed by Reagan Otema</h3>
            <p class="footer-subtitle">For system errors, contact via WhatsApp</p>
            <div class="contact-buttons">
                <a href="https://wa.me/256772514889" target="_blank" class="whatsapp-btn">
                    <i class="fab fa-whatsapp"></i> MTN: +256772514889
                </a>
                <a href="https://wa.me/256730314979" target="_blank" class="whatsapp-btn">
                    <i class="fab fa-whatsapp"></i> Airtel: +256730314979
                </a>
            </div>
        </footer>
    </div>
</body>
</html>


