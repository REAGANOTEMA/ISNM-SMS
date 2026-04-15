<?php
// Error reporting for development
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Set headers
header('Content-Type: text/html; charset=UTF-8');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');

// Start session if needed
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check authentication and role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'staff' || $_SESSION['department'] !== 'security') {
    header('Location: login.php');
    exit();
}

include 'config.php';

// Get Security department information
$security_info = [];
try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ? AND role = 'staff' AND department = 'security'");
    $stmt->execute([$_SESSION['user_id']]);
    $security_info = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching Security info: " . $e->getMessage());
}

// Get Security department statistics
$security_stats = [];
try {
    // Total security staff
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM users WHERE role = 'staff' AND department = 'security'");
    $security_stats['total_security_staff'] = $stmt->fetchColumn();
    
    // Today's patrols
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM security_patrols WHERE DATE(patrol_date) = CURDATE()");
    $security_stats['today_patrols'] = $stmt->fetchColumn();
    
    // Completed patrols today
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM security_patrols WHERE DATE(patrol_date) = CURDATE() AND status = 'completed'");
    $security_stats['completed_patrols_today'] = $stmt->fetchColumn();
    
    // Security incidents this week
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM security_incidents WHERE DATE(created_at) >= DATE_SUB(NOW(), INTERVAL 7 DAY)");
    $security_stats['incidents_week'] = $stmt->fetchColumn();
    
    // Active security alerts
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM security_alerts WHERE status = 'active'");
    $security_stats['active_alerts'] = $stmt->fetchColumn();
    
    // Total monitored areas
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM security_areas");
    $security_stats['total_areas'] = $stmt->fetchColumn();
    
    // Pending security requests
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM security_requests WHERE status = 'pending'");
    $security_stats['pending_requests'] = $stmt->fetchColumn();
} catch (PDOException $e) {
    error_log("Error fetching Security department statistics: " . $e->getMessage());
}

// Get recent activities
$recent_activities = [];
try {
    $stmt = $pdo->query("
        SELECT al.*, u.username 
        FROM activity_log al 
        LEFT JOIN users u ON al.user_id = u.id 
        ORDER BY al.created_at DESC 
        LIMIT 10
    ");
    $recent_activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching recent activities: " . $e->getMessage());
}

// Get today's patrols
$today_patrols = [];
try {
    $stmt = $pdo->query("
        SELECT sp.*, sa.area_name, u.username as guard_name
        FROM security_patrols sp
        LEFT JOIN security_areas sa ON sp.area_id = sa.id
        LEFT JOIN users u ON sp.guard_id = u.id
        WHERE DATE(sp.patrol_date) = CURDATE()
        ORDER BY sp.start_time ASC
        LIMIT 5
    ");
    $today_patrols = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching today's patrols: " . $e->getMessage());
}

// Get active security alerts
$active_alerts = [];
try {
    $stmt = $pdo->query("
        SELECT sa.*, u.username as reporter_name
        FROM security_alerts sa
        LEFT JOIN users u ON sa.reporter_id = u.id
        WHERE sa.status = 'active'
        ORDER BY sa.created_at DESC
        LIMIT 5
    ");
    $active_alerts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching active security alerts: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Department Dashboard - ISNM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&family=Rockwell:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #1e3a8a;
            --secondary-blue: #3730a3;
            --ocean-blue: #0ea5e9;
            --golden-yellow: #fbbf24;
            --warm-yellow: #f59e0b;
            --creamy-yellow: #fef3c7;
            --light-green: #86efac;
            --success-green: #22c55e;
            --danger-red: #ef4444;
            --warning-orange: #f97316;
            --white: #ffffff;
            --cream-white: #fefaf3;
            --light-gray: #f3f4f6;
            --soft-gray: #e5e7eb;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --text-muted: #9ca3af;
            --shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 15px rgba(0,0,0,0.1);
            --shadow-xl: 0 20px 25px rgba(0,0,0,0.1);
            --shadow-3d: 0 25px 50px -12px rgba(0,0,0,0.25);
            --gradient-primary: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            --gradient-hero: linear-gradient(135deg, var(--primary-blue), var(--ocean-blue));
            --gradient-gold: linear-gradient(135deg, var(--golden-yellow), var(--warm-yellow));
            --gradient-success: linear-gradient(135deg, var(--success-green), var(--light-green));
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, var(--cream-white), var(--white));
            color: var(--text-dark);
            line-height: 1.6;
            min-height: 100vh;
        }
        .navbar {
            background: var(--gradient-primary);
            color: white;
            padding: 1rem 2rem;
            box-shadow: var(--shadow-lg);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-family: 'Rockwell Extra Bold', 'Rockwell', serif;
            font-weight: 900;
            font-size: 1.2rem;
            color: var(--primary-blue);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .nav-logo img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid var(--golden-yellow);
            box-shadow: var(--shadow-sm);
        }

        .nav-links {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .nav-link {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .nav-link:hover {
            background: rgba(255,255,255,0.2);
            transform: translateY(-2px);
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.5rem 1rem;
            background: rgba(255,255,255,0.1);
            border-radius: 25px;
            backdrop-filter: blur(10px);
        }

        .main-container {
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .dashboard-header {
            background: var(--gradient-primary);
            color: white;
            padding: 2rem;
            border-radius: 20px;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-xl);
            position: relative;
            overflow: hidden;
        }

        .dashboard-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .header-content {
            position: relative;
            z-index: 1;
        }

        .header-title {
            font-family: 'Copperplate Gothic Bold', 'Rockwell Extra Bold', serif;
            font-size: 2.5rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .header-subtitle {
            font-family: 'Bernard MT Condensed', 'Arial Narrow', sans-serif;
            font-size: 1.2rem;
            font-weight: 700;
            opacity: 0.9;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: linear-gradient(145deg, var(--white), var(--cream-white));
            border: 2px solid var(--primary-blue);
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-xl);
            border-color: var(--golden-yellow);
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

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            background: var(--gradient-primary);
            color: white;
            box-shadow: var(--shadow-md);
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 0.9rem;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .panel {
            background: linear-gradient(145deg, var(--white), var(--cream-white));
            border: 2px solid var(--soft-gray);
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: var(--shadow-md);
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--soft-gray);
        }

        .panel-title {
            font-family: 'Rockwell Extra Bold', 'Rockwell', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-blue);
        }

        .patrol-list {
            max-height: 400px;
            overflow-y: auto;
        }

        .patrol-item {
            display: flex;
            align-items: start;
            gap: 1rem;
            padding: 1rem;
            border-bottom: 1px solid var(--soft-gray);
            transition: all 0.3s ease;
        }

        .patrol-item:hover {
            background: var(--light-gray);
        }

        .patrol-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--gradient-primary);
            color: white;
            flex-shrink: 0;
        }

        .patrol-content {
            flex: 1;
        }

        .patrol-text {
            font-size: 0.9rem;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }

        .patrol-time {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .patrol-status {
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-completed {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success-green);
        }

        .status-in-progress {
            background: rgba(59, 130, 246, 0.1);
            color: var(--ocean-blue);
        }

        .status-pending {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning-orange);
        }

        .status-active {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-red);
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .action-btn {
            background: var(--gradient-primary);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 1rem;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .action-btn:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
        }

        .action-btn i {
            font-size: 1.2rem;
        }

        @media (max-width: 768px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .nav-container {
                flex-direction: column;
                gap: 1rem;
            }
            
            .header-title {
                font-size: 1.8rem;
            }
        }

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

        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }
        .stat-card:hover { transform: translateY(-2px); }
        .stat-icon { width: 48px; height: 48px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; margin-bottom: 1rem; }
        .stat-icon.orange { background: rgba(234, 88, 12, 0.1); color: var(--primary); }
        .stat-icon.green { background: rgba(16, 185, 129, 0.1); color: var(--success); }
        .stat-icon.blue { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
        .stat-icon.red { background: rgba(239, 68, 68, 0.1); color: var(--danger); }
        .stat-value { font-size: 2rem; font-weight: 700; margin-bottom: 0.25rem; }
        .stat-label { color: var(--gray-600); font-size: 0.875rem; }
        .content-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; margin-bottom: 2rem; }
        .card { background: var(--white); border-radius: 12px; padding: 1.5rem; box-shadow: var(--shadow-md); }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        .card-title { font-size: 1.25rem; font-weight: 600; }
        .btn { padding: 0.5rem 1rem; border-radius: 8px; font-weight: 500; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s; border: none; cursor: pointer; }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--secondary); }
        .btn-secondary { background: var(--gray-200); color: var(--gray-700); }
        .btn-secondary:hover { background: var(--gray-300); }
        .incident-list { list-style: none; }
        .incident-item { background: var(--gray-50); border-radius: 8px; padding: 1rem; margin-bottom: 1rem; border-left: 4px solid var(--primary); }
        .incident-id { font-weight: 600; color: var(--primary); margin-bottom: 0.25rem; }
        .incident-title { font-weight: 500; margin-bottom: 0.25rem; }
        .incident-meta { font-size: 0.875rem; color: var(--gray-600); }
        .patrol-list { list-style: none; }
        .patrol-item { display: flex; align-items: center; gap: 1rem; padding: 1rem 0; border-bottom: 1px solid var(--gray-100); }
        .patrol-item:last-child { border-bottom: none; }
        .patrol-icon { width: 40px; height: 40px; border-radius: 50%; background: var(--gray-200); display: flex; align-items: center; justify-content: center; color: var(--gray-600); }
        .patrol-info { flex: 1; }
        .patrol-name { font-weight: 500; margin-bottom: 0.25rem; }
        .patrol-time { font-size: 0.875rem; color: var(--gray-600); }
        .patrol-status { padding: 0.25rem 0.75rem; border-radius: 12px; font-size: 0.75rem; font-weight: 500; }
        .status-active { background: rgba(16, 185, 129, 0.1); color: var(--success); }
        .status-scheduled { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
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
    <nav class="navbar">
        <div class="nav-container">
            <a href="login-portal.php" class="nav-logo">
                <img src="public/isnm-logo.jpeg" alt="ISNM">
                <span>IGANGA SCHOOL OF NURSING AND MIDWIFERY</span>
            </a>
            <div class="nav-links">
                <a href="dashboard-security.php" class="nav-link">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-shield-alt"></i> Security Management
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-route"></i> Patrol Management
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-video"></i> CCTV Monitoring
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-exclamation-triangle"></i> Incident Management
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-users"></i> Guard Management
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-chart-line"></i> Reports
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="user-menu">
                    <i class="fas fa-user"></i>
                    <span><?php echo htmlspecialchars($security_info['username'] ?? 'Security Department'); ?></span>
                    <a href="logout.php" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="main-container">
        <header class="dashboard-header fade-in">
            <div class="header-content">
                <h1 class="header-title">SECURITY DEPARTMENT</h1>
                <p class="header-subtitle">Campus Security & Safety Management Excellence</p>
            </div>
        </header>

        <div class="stats-grid fade-in">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-value"><?php echo number_format($security_stats['total_security_staff'] ?? 0); ?></div>
                <div class="stat-label">Total Security Staff</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-route"></i>
                </div>
                <div class="stat-value"><?php echo number_format($security_stats['today_patrols'] ?? 0); ?></div>
                <div class="stat-label">Today's Patrols</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-value"><?php echo number_format($security_stats['completed_patrols_today'] ?? 0); ?></div>
                <div class="stat-label">Completed Patrols Today</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-value"><?php echo number_format($security_stats['incidents_week'] ?? 0); ?></div>
                <div class="stat-label">Security Incidents This Week</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-bell"></i>
                </div>
                <div class="stat-value"><?php echo number_format($security_stats['active_alerts'] ?? 0); ?></div>
                <div class="stat-label">Active Security Alerts</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <div class="stat-value"><?php echo number_format($security_stats['total_areas'] ?? 0); ?></div>
                <div class="stat-label">Total Monitored Areas</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-value"><?php echo number_format($security_stats['pending_requests'] ?? 0); ?></div>
                <div class="stat-label">Pending Security Requests</div>
            </div>
        </div>

        <div class="content-grid fade-in">
            <div class="panel">
                <div class="panel-header">
                    <h2 class="panel-title">
                        <i class="fas fa-route"></i> Today's Patrols
                    </h2>
                    <a href="#" class="nav-link">View All</a>
                </div>
                <div class="patrol-list">
                    <?php foreach ($today_patrols as $patrol): ?>
                        <div class="patrol-item">
                            <div class="patrol-icon">
                                <i class="fas fa-route"></i>
                            </div>
                            <div class="patrol-content">
                                <div class="patrol-text">
                                    <strong><?php echo htmlspecialchars($patrol['area_name'] ?? 'Unknown Area'); ?></strong>
                                    - <?php echo htmlspecialchars($patrol['patrol_type'] ?? 'Regular Patrol'); ?>
                                </div>
                                <div class="patrol-text">
                                    Guard: <?php echo htmlspecialchars($patrol['guard_name'] ?? 'Not assigned'); ?>
                                </div>
                                <div class="patrol-time">
                                    <?php echo date('H:i', strtotime($patrol['start_time'])); ?> - 
                                    <?php echo date('H:i', strtotime($patrol['end_time'])); ?>
                                </div>
                            </div>
                            <div class="patrol-status status-<?php echo htmlspecialchars($patrol['status'] ?? 'pending'); ?>">
                                <?php echo htmlspecialchars(ucfirst($patrol['status'] ?? 'Pending')); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="panel">
                <div class="panel-header">
                    <h2 class="panel-title">
                        <i class="fas fa-bell"></i> Active Security Alerts
                    </h2>
                    <a href="#" class="nav-link">View All</a>
                </div>
                <div class="patrol-list">
                    <?php foreach ($active_alerts as $alert): ?>
                        <div class="patrol-item">
                            <div class="patrol-icon">
                                <i class="fas fa-bell"></i>
                            </div>
                            <div class="patrol-content">
                                <div class="patrol-text">
                                    <strong><?php echo htmlspecialchars($alert['alert_type'] ?? 'Unknown Alert'); ?></strong>
                                    - <?php echo htmlspecialchars($alert['location'] ?? 'Unknown Location'); ?>
                                </div>
                                <div class="patrol-text">
                                    Reported by: <?php echo htmlspecialchars($alert['reporter_name'] ?? 'Unknown'); ?>
                                </div>
                                <div class="patrol-time">
                                    <?php echo date('M d, Y H:i', strtotime($alert['created_at'])); ?>
                                </div>
                            </div>
                            <div class="patrol-status status-active">
                                Active
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="panel fade-in">
            <div class="panel-header">
                <h2 class="panel-title">
                    <i class="fas fa-tasks"></i> Security Department Quick Actions
                </h2>
            </div>
            <div class="quick-actions">
                <a href="#" class="action-btn">
                    <i class="fas fa-shield-alt"></i>
                    Security Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-route"></i>
                    Patrol Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-video"></i>
                    CCTV Monitoring
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-exclamation-triangle"></i>
                    Incident Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-users"></i>
                    Guard Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-chart-line"></i>
                    Security Reports
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-map-marked-alt"></i>
                    Area Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-boxes"></i>
                    Security Equipment Portal
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-file-alt"></i>
                    Security Documentation
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-cog"></i>
                    Settings
                </a>
            </div>
        </div>
    </main>

    <script>
        // Add entrance animations
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.fade-in');
            elements.forEach((el, index) => {
                setTimeout(() => {
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });

        // Add interactive hover effects
        const cards = document.querySelectorAll('.stat-card, .patrol-item');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Auto-refresh activities every 30 seconds
        setInterval(() => {
            // Refresh recent activities
            fetch('api/recent-activities.php')
                .then(response => response.json())
                .then(data => {
                    // Update activity list
                    console.log('Activities refreshed');
                })
                .catch(error => console.error('Error refreshing activities:', error));
        }, 30000);
    </script>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-clipboard-list"></i> Reports</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-cog"></i> Settings</a></li>
                    <li class="nav-item"><a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <div class="header">
                <h1>Security Department Dashboard</h1>
                <p>Welcome back, <?php echo htmlspecialchars($user['username']); ?>. Monitor campus security and safety.</p>
            </div>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon orange"><i class="fas fa-user-graduate"></i></div>
                    <div class="stat-value">1,247</div>
                    <div class="stat-label">Students Registered</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon green"><i class="fas fa-chalkboard-teacher"></i></div>
                    <div class="stat-value">89</div>
                    <div class="stat-label">Teachers Registered</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon yellow"><i class="fas fa-users"></i></div>
                    <div class="stat-value">156</div>
                    <div class="stat-label">Support Staff Registered</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon red"><i class="fas fa-video"></i></div>
                    <div class="stat-value">24</div>
                    <div class="stat-label">Active Cameras</div>
                </div>
            </div>
            <div class="content-grid">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Student Registration</h2>
                        <a href="#" class="btn btn-primary" onclick="showStudentForm()"><i class="fas fa-plus"></i> Register Student</a>
                    </div>
                    <form id="studentForm" style="display: none;">
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Full Name *</label>
                                <input type="text" class="form-input" name="student_name" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Sex *</label>
                                <select class="form-select" name="sex" required>
                                    <option value="">Select Sex</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Date of Birth *</label>
                                <input type="date" class="form-input" name="date_of_birth" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Mobile Number *</label>
                                <input type="tel" class="form-input" name="mobile_number" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">ID Number (Leave blank if new)</label>
                                <input type="text" class="form-input" name="id_number" placeholder="Optional for new students">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Registration Type *</label>
                                <select class="form-select" name="registration_type" required>
                                    <option value="">Select Type</option>
                                    <option value="coming">Coming</option>
                                    <option value="leaving">Leaving</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Address</label>
                            <textarea class="form-textarea" name="address" placeholder="Student Address"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Register Student</button>
                    </form>
                    <ul class="register-list">
                        <li class="register-item">
                            <div class="register-icon"><i class="fas fa-user-graduate"></i></div>
                            <div class="register-info">
                                <div class="register-name">Jane Nakato</div>
                                <div class="register-details">Set A-12 | Female | 0775123456</div>
                                <div class="register-time">Coming - <?php echo date('Y-m-d H:i:s'); ?></div>
                            </div>
                        </li>
                        <li class="register-item">
                            <div class="register-icon"><i class="fas fa-user-graduate"></i></div>
                            <div class="register-info">
                                <div class="register-name">John Mukasa</div>
                                <div class="register-details">Set B-08 | Male | 0756987452</div>
                                <div class="register-time">Leaving - <?php echo date('Y-m-d H:i:s'); ?></div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Patrol Schedule</h2>
                        <a href="#" class="btn btn-secondary">All Patrols</a>
                    </div>
                    <form id="teacherForm" style="display: none;">
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Full Name *</label>
                                <input type="text" class="form-input" name="teacher_name" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Mobile Number *</label>
                                <input type="tel" class="form-input" name="mobile_number" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Email *</label>
                                <input type="email" class="form-input" name="email" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Department *</label>
                                <select class="form-select" name="department" required>
                                    <option value="">Select Department</option>
                                    <option value="academic">Academic</option>
                                    <option value="nursing">Nursing</option>
                                    <option value="midwifery">Midwifery</option>
                                    <option value="administration">Administration</option>
                                    <option value="support">Support</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Status *</label>
                                <select class="form-select" name="status" required>
                                    <option value="">Select Status</option>
                                    <option value="reporting">Reporting</option>
                                    <option value="exiting">Exiting</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Date & Time *</label>
                                <input type="datetime-local" class="form-input" name="datetime" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Register Teacher</button>
                    </form>
                    <ul class="register-list">
                        <li class="register-item">
                            <div class="register-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                            <div class="register-info">
                                <div class="register-name">Dr. Sarah Nalwoga</div>
                                <div class="register-details">Nursing Dept | 0775123456 | sarah@isnm.ac.ug</div>
                                <div class="register-time">Reporting - <?php echo date('Y-m-d H:i:s'); ?></div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Support Staff Registration</h2>
                        <a href="#" class="btn btn-primary" onclick="showSupportForm()"><i class="fas fa-plus"></i> Register Staff</a>
                    </div>
                    <form id="supportForm" style="display: none;">
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Full Name *</label>
                                <input type="text" class="form-input" name="staff_name" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email *</label>
                                <input type="email" class="form-input" name="email" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Mobile Number *</label>
                                <input type="tel" class="form-input" name="mobile_number" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Date & Time *</label>
                                <input type="datetime-local" class="form-input" name="datetime" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Register Support Staff</button>
                    </form>
                    <ul class="register-list">
                        <li class="register-item">
                            <div class="register-icon"><i class="fas fa-users"></i></div>
                            <div class="register-info">
                                <div class="register-name">Michael Ssewanyana</div>
                                <div class="register-details">0756987452 | michael@isnm.ac.ug</div>
                                <div class="register-time"><?php echo date('Y-m-d H:i:s'); ?></div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Camera Monitoring System</h2>
                        <a href="#" class="btn btn-secondary"><i class="fas fa-sync"></i> Refresh</a>
                    </div>
                    <div class="camera-grid">
                        <div class="camera-item">
                            <div class="camera-name">Main Gate Camera</div>
                            <div class="camera-status online"><i class="fas fa-circle"></i> Online</div>
                        </div>
                        <div class="camera-item">
                            <div class="camera-name">Library Camera</div>
                            <div class="camera-status online"><i class="fas fa-circle"></i> Online</div>
                        </div>
                        <div class="camera-item">
                            <div class="camera-name">Hostel Area Camera</div>
                            <div class="camera-status offline"><i class="fas fa-circle"></i> Offline</div>
                        </div>
                        <div class="camera-item">
                            <div class="camera-name">Laboratory Camera</div>
                            <div class="camera-status online"><i class="fas fa-circle"></i> Online</div>
                        </div>
                        <div class="camera-item">
                            <div class="camera-name">Dining Hall Camera</div>
                            <div class="camera-status online"><i class="fas fa-circle"></i> Online</div>
                        </div>
                        <div class="camera-item">
                            <div class="camera-name">Parking Area Camera</div>
                            <div class="camera-status offline"><i class="fas fa-circle"></i> Offline</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Requisition Portal</h2>
                    <a href="#" class="btn btn-primary" onclick="showRequisitionForm()"><i class="fas fa-plus"></i> New Requisition</a>
                </div>
                <form id="requisitionForm" style="display: none;">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Item Required *</label>
                            <input type="text" class="form-input" name="item_name" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Quantity *</label>
                            <input type="number" class="form-input" name="quantity" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Priority *</label>
                            <select class="form-select" name="priority" required>
                                <option value="">Select Priority</option>
                                <option value="urgent">Urgent</option>
                                <option value="high">High</option>
                                <option value="medium">Medium</option>
                                <option value="low">Low</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Purpose *</label>
                            <input type="text" class="form-input" name="purpose" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Justification</label>
                        <textarea class="form-textarea" name="justification" placeholder="Explain why this item is needed"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Submit Requisition</button>
                </form>
                <ul class="requisition-list">
                    <li class="requisition-item">
                        <div class="requisition-title">Security Uniforms</div>
                        <div class="requisition-details">Quantity: 5 | Priority: High | Purpose: Staff Uniforms</div>
                        <div class="requisition-status sent">Sent to HR</div>
                    </li>
                    <li class="requisition-item">
                        <div class="requisition-title">Flashlights</div>
                        <div class="requisition-details">Quantity: 10 | Priority: Medium | Purpose: Night Patrol</div>
                        <div class="requisition-status pending">Pending Approval</div>
                    </li>
                    <li class="requisition-item">
                        <div class="requisition-title">Radio Communication Set</div>
                        <div class="requisition-details">Quantity: 2 | Priority: Urgent | Purpose: Emergency Communication</div>
                        <div class="requisition-status approved">Approved</div>
                    </li>
                </ul>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">HR Communication</h2>
                    <a href="#" class="btn btn-primary" onclick="showHRForm()"><i class="fas fa-envelope"></i> Send to HR</a>
                </div>
                <form id="hrForm" style="display: none;">
                    <div class="form-group">
                        <label class="form-label">Subject *</label>
                        <input type="text" class="form-input" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Message *</label>
                        <textarea class="form-textarea" name="message" required placeholder="Enter your message to HR department"></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Priority *</label>
                            <select class="form-select" name="priority" required>
                                <option value="">Select Priority</option>
                                <option value="urgent">Urgent</option>
                                <option value="high">High</option>
                                <option value="normal">Normal</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Category *</label>
                            <select class="form-select" name="category" required>
                                <option value="">Select Category</option>
                                <option value="staffing">Staffing Issues</option>
                                <option value="equipment">Equipment Request</option>
                                <option value="training">Training Needs</option>
                                <option value="policy">Policy Clarification</option>
                                <option value="emergency">Emergency</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Send to HR</button>
                </form>
                <div style="display: flex; flex-wrap: wrap; gap: 1rem;">
                    <a href="#" class="btn btn-secondary"><i class="fas fa-file-pdf"></i> Generate Report</a>
                    <a href="#" class="btn btn-secondary"><i class="fas fa-chart-bar"></i> View Analytics</a>
                    <a href="#" class="btn btn-secondary"><i class="fas fa-bell"></i> Emergency Alert</a>
                    <a href="#" class="btn btn-secondary"><i class="fas fa-phone"></i> Contact HR Direct</a>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Security Operations</h2>
                </div>
                <div style="display: flex; flex-wrap: wrap; gap: 1rem;">
                    <a href="#" class="btn btn-primary"><i class="fas fa-plus"></i> Report Incident</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-route"></i> Schedule Patrol</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-camera"></i> View Cameras</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-id-card"></i> Manage Access</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-file-alt"></i> Generate Report</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-phone"></i> Emergency Contact</a>
                </div>
            </div>
        </main>
    </div>
    <</body>
</html>
