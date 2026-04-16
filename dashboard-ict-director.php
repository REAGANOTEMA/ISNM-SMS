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
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin' || $_SESSION['department'] !== 'ict-director') {
    header('Location: login.php');
    exit();
}

include 'config.php';

// Get ICT Director information
$ict_info = [];
try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ? AND role = 'admin' AND department = 'ict-director'");
    $stmt->execute([$_SESSION['user_id']]);
    $ict_info = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching ICT Director info: " . $e->getMessage());
}

// Get ICT statistics
$ict_stats = [];
try {
    // Total computers
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM computer_inventory");
    $ict_stats['total_computers'] = $stmt->fetchColumn();
    
    // Active computers
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM computer_inventory WHERE status = 'active'");
    $ict_stats['active_computers'] = $stmt->fetchColumn();
    
    // Network devices
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM network_devices");
    $ict_stats['network_devices'] = $stmt->fetchColumn();
    
    // Pending support tickets
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM support_tickets WHERE status = 'pending'");
    $ict_stats['pending_tickets'] = $stmt->fetchColumn();
    
    // Software licenses
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM software_licenses WHERE status = 'active'");
    $ict_stats['active_licenses'] = $stmt->fetchColumn();
    
    // Internet bandwidth usage
    $stmt = $pdo->query("SELECT bandwidth_usage FROM network_stats WHERE DATE(created_at) = CURDATE()");
    $ict_stats['bandwidth_usage'] = $stmt->fetchColumn() ?? 0;
    
    // Server uptime
    $stmt = $pdo->query("SELECT uptime_percentage FROM server_stats WHERE DATE(created_at) = CURDATE()");
    $ict_stats['server_uptime'] = $stmt->fetchColumn() ?? 0;
} catch (PDOException $e) {
    error_log("Error fetching ICT statistics: " . $e->getMessage());
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

// Get pending support tickets
$pending_tickets = [];
try {
    $stmt = $pdo->query("
        SELECT st.*, u.username as requester_name, d.department_name
        FROM support_tickets st
        LEFT JOIN users u ON st.requester_id = u.id
        LEFT JOIN departments d ON u.department = d.id
        WHERE st.status = 'pending'
        ORDER BY st.created_at DESC
        LIMIT 5
    ");
    $pending_tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching pending support tickets: " . $e->getMessage());
}

// Get system alerts
$system_alerts = [];
try {
    $stmt = $pdo->query("
        SELECT * FROM system_alerts 
        WHERE status = 'active' 
        ORDER BY severity DESC, created_at DESC
        LIMIT 5
    ");
    $system_alerts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching system alerts: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ICT Director Dashboard - ISNM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&family=Rockwell:wght@400;700;900&display=swap" rel="stylesheet">`n    <link rel="stylesheet" href="assets/modern-theme.css">`n    <link rel="stylesheet" href="assets/modern-theme.css">
    <style>
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

        .ticket-list {
            max-height: 400px;
            overflow-y: auto;
        }

        .ticket-item {
            display: flex;
            align-items: start;
            gap: 1rem;
            padding: 1rem;
            border-bottom: 1px solid var(--soft-gray);
            transition: all 0.3s ease;
        }

        .ticket-item:hover {
            background: var(--light-gray);
        }

        .ticket-icon {
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

        .ticket-content {
            flex: 1;
        }

        .ticket-text {
            font-size: 0.9rem;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }

        .ticket-time {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .ticket-priority {
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .priority-high {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-red);
        }

        .priority-medium {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning-orange);
        }

        .priority-low {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success-green);
        }

        .alert-list {
            max-height: 400px;
            overflow-y: auto;
        }

        .alert-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            border-bottom: 1px solid var(--soft-gray);
            transition: all 0.3s ease;
        }

        .alert-item:hover {
            background: var(--light-gray);
        }

        .alert-severity {
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .severity-critical {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-red);
        }

        .severity-warning {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning-orange);
        }

        .severity-info {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success-green);
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
                <a href="dashboard-ict-director.php" class="nav-link">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-desktop"></i> Computer Management
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-network-wired"></i> Network Management
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-headset"></i> Support Tickets
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-shield-alt"></i> Security Management
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-server"></i> Server Management
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-wifi"></i> Internet & Bandwidth
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="user-menu">
                    <i class="fas fa-user"></i>
                    <span><?php echo htmlspecialchars($ict_info['username'] ?? 'ICT Director'); ?></span>
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
                <h1 class="header-title">ICT DIRECTOR</h1>
                <p class="header-subtitle">Technology Management & ICT Excellence</p>
            </div>
        </header>

        <div class="stats-grid fade-in">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-desktop"></i>
                </div>
                <div class="stat-value"><?php echo number_format($ict_stats['total_computers'] ?? 0); ?></div>
                <div class="stat-label">Total Computers</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-value"><?php echo number_format($ict_stats['active_computers'] ?? 0); ?></div>
                <div class="stat-label">Active Computers</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-network-wired"></i>
                </div>
                <div class="stat-value"><?php echo number_format($ict_stats['network_devices'] ?? 0); ?></div>
                <div class="stat-label">Network Devices</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <div class="stat-value"><?php echo number_format($ict_stats['pending_tickets'] ?? 0); ?></div>
                <div class="stat-label">Pending Tickets</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-certificate"></i>
                </div>
                <div class="stat-value"><?php echo number_format($ict_stats['active_licenses'] ?? 0); ?></div>
                <div class="stat-label">Active Licenses</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-wifi"></i>
                </div>
                <div class="stat-value"><?php echo number_format($ict_stats['bandwidth_usage'] ?? 0); ?>%</div>
                <div class="stat-label">Bandwidth Usage</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-server"></i>
                </div>
                <div class="stat-value"><?php echo number_format($ict_stats['server_uptime'] ?? 0); ?>%</div>
                <div class="stat-label">Server Uptime</div>
            </div>
        </div>

        <div class="content-grid fade-in">
            <div class="panel">
                <div class="panel-header">
                    <h2 class="panel-title">
                        <i class="fas fa-headset"></i> Pending Support Tickets
                    </h2>
                    <a href="#" class="nav-link">View All</a>
                </div>
                <div class="ticket-list">
                    <?php foreach ($pending_tickets as $ticket): ?>
                        <div class="ticket-item">
                            <div class="ticket-icon">
                                <i class="fas fa-headset"></i>
                            </div>
                            <div class="ticket-content">
                                <div class="ticket-text">
                                    <strong><?php echo htmlspecialchars($ticket['requester_name'] ?? 'Unknown'); ?></strong>
                                    from <?php echo htmlspecialchars($ticket['department_name'] ?? 'Unknown'); ?>
                                    - <?php echo htmlspecialchars($ticket['issue'] ?? 'Support Request'); ?>
                                </div>
                                <div class="ticket-time">
                                    <?php echo date('M d, Y H:i', strtotime($ticket['created_at'])); ?>
                                </div>
                            </div>
                            <div class="ticket-priority priority-<?php echo htmlspecialchars($ticket['priority'] ?? 'medium'); ?>">
                                <?php echo htmlspecialchars(ucfirst($ticket['priority'] ?? 'Medium')); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="panel">
                <div class="panel-header">
                    <h2 class="panel-title">
                        <i class="fas fa-exclamation-triangle"></i> System Alerts
                    </h2>
                    <a href="#" class="nav-link">View All</a>
                </div>
                <div class="alert-list">
                    <?php foreach ($system_alerts as $alert): ?>
                        <div class="alert-item">
                            <div class="ticket-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="ticket-content">
                                <div class="ticket-text">
                                    <strong><?php echo htmlspecialchars($alert['alert_title'] ?? 'System Alert'); ?></strong>
                                    - <?php echo htmlspecialchars($alert['description'] ?? 'Alert Description'); ?>
                                </div>
                                <div class="ticket-time">
                                    <?php echo date('M d, Y H:i', strtotime($alert['created_at'])); ?>
                                </div>
                            </div>
                            <div class="alert-severity severity-<?php echo htmlspecialchars($alert['severity'] ?? 'info'); ?>">
                                <?php echo htmlspecialchars(ucfirst($alert['severity'] ?? 'Info')); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="panel fade-in">
            <div class="panel-header">
                <h2 class="panel-title">
                    <i class="fas fa-tasks"></i> ICT Director Quick Actions
                </h2>
            </div>
            <div class="quick-actions">
                <a href="#" class="action-btn">
                    <i class="fas fa-desktop"></i>
                    Computer Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-network-wired"></i>
                    Network Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-headset"></i>
                    Support Ticket Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-shield-alt"></i>
                    Security Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-server"></i>
                    Server Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-wifi"></i>
                    Internet & Bandwidth Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-certificate"></i>
                    Software License Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-database"></i>
                    Database Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-backup"></i>
                    Backup & Recovery
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-boxes"></i>
                    IT Inventory Portal
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
        const cards = document.querySelectorAll('.stat-card, .ticket-item, .alert-item');
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
</body>
</html>


