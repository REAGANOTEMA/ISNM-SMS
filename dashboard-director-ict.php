<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin' || $_SESSION['department'] !== 'director-ict') {
    header('Location: login.php');
    exit();
}

include 'config.php';

// Get director information
$director_info = [];
try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ? AND role = 'admin' AND department = 'director-ict'");
    $stmt->execute([$_SESSION['user_id']]);
    $director_info = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching director info: " . $e->getMessage());
}

// Get ICT statistics
$ict_stats = [];
try {
    // Total computers/labs
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM computer_labs");
    $ict_stats['computer_labs'] = $stmt->fetchColumn();
    
    // Total computers
    $stmt = $pdo->query("SELECT SUM(total_computers) as total FROM computer_labs");
    $ict_stats['total_computers'] = $stmt->fetchColumn();
    
    // ICT staff
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM users WHERE department LIKE '%ict%' OR department LIKE '%computer%'");
    $ict_stats['ict_staff'] = $stmt->fetchColumn();
    
    // Active network devices
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM network_devices WHERE status = 'active'");
    $ict_stats['network_devices'] = $stmt->fetchColumn();
    
    // Recent IT tickets
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM it_tickets WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)");
    $ict_stats['recent_tickets'] = $stmt->fetchColumn();
} catch (PDOException $e) {
    error_log("Error fetching ICT statistics: " . $e->getMessage());
}

// Get computer labs information
$computer_labs = [];
try {
    $stmt = $pdo->query("
        SELECT lab_name, total_computers, available_computers, 
               (total_computers - available_computers) as in_use,
               lab_type, status
        FROM computer_labs 
        ORDER BY lab_name
    ");
    $computer_labs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching computer labs: " . $e->getMessage());
}

// Get recent IT activities
$it_activities = [];
try {
    $stmt = $pdo->query("
        SELECT al.*, u.username 
        FROM activity_log al 
        LEFT JOIN users u ON al.user_id = u.id 
        WHERE al.action LIKE '%computer%' OR al.action LIKE '%network%' OR al.action LIKE '%software%'
        ORDER BY al.created_at DESC 
        LIMIT 10
    ");
    $it_activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching IT activities: " . $e->getMessage());
}

// Get IT staff information
$it_staff = [];
try {
    $stmt = $pdo->query("
        SELECT username, role, department, email, phone
        FROM users 
        WHERE department LIKE '%ict%' OR department LIKE '%computer%' OR department LIKE '%lab%'
        ORDER BY role DESC, username
    ");
    $it_staff = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching IT staff: " . $e->getMessage());
}

// Get sports facilities information
$sports_facilities = [];
try {
    $stmt = $pdo->query("
        SELECT facility_name, facility_type, capacity, status, last_maintenance
        FROM sports_facilities 
        ORDER BY facility_name
    ");
    $sports_facilities = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching sports facilities: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Director Dashboard - ICT & Sports | ISNM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            grid-template-columns: 1fr 1fr;
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

        .lab-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
        }

        .lab-card {
            background: var(--white);
            border: 1px solid var(--soft-gray);
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .lab-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-blue);
        }

        .lab-name {
            font-weight: 600;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
        }

        .lab-stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .lab-usage {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .lab-usage.high {
            color: var(--danger-red);
        }

        .lab-usage.medium {
            color: var(--warning-orange);
        }

        .lab-usage.low {
            color: var(--success-green);
        }

        .staff-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .staff-table th,
        .staff-table td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid var(--soft-gray);
        }

        .staff-table th {
            background: var(--gradient-primary);
            color: white;
            font-weight: 600;
        }

        .staff-table tr:hover {
            background: var(--light-gray);
        }

        .role-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .role-admin {
            background: var(--gradient-primary);
            color: white;
        }

        .role-support {
            background: var(--gradient-success);
            color: white;
        }

        .activity-list {
            max-height: 400px;
            overflow-y: auto;
        }

        .activity-item {
            display: flex;
            align-items: start;
            gap: 1rem;
            padding: 1rem;
            border-bottom: 1px solid var(--soft-gray);
            transition: all 0.3s ease;
        }

        .activity-item:hover {
            background: var(--light-gray);
        }

        .activity-icon {
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

        .activity-content {
            flex: 1;
        }

        .activity-text {
            font-size: 0.9rem;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }

        .activity-time {
            font-size: 0.8rem;
            color: var(--text-muted);
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

        .sports-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
        }

        .sports-card {
            background: var(--white);
            border: 1px solid var(--soft-gray);
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .sports-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-blue);
        }

        .sports-name {
            font-weight: 600;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
        }

        .sports-type {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
        }

        .sports-capacity {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--golden-yellow);
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
                <a href="dashboard-director-ict.php" class="nav-link">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-desktop"></i> Computer Labs
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-running"></i> Sports Facilities
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-network-wired"></i> Network
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="user-menu">
                    <i class="fas fa-user"></i>
                    <span><?php echo htmlspecialchars($director_info['username'] ?? 'ICT Director'); ?></span>
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
                <h1 class="header-title">DIRECTOR - ICT & SPORTS</h1>
                <p class="header-subtitle">Technology Innovation & Sports Excellence</p>
            </div>
        </header>

        <div class="stats-grid fade-in">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-desktop"></i>
                </div>
                <div class="stat-value"><?php echo number_format($ict_stats['computer_labs'] ?? 0); ?></div>
                <div class="stat-label">Computer Labs</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-laptop"></i>
                </div>
                <div class="stat-value"><?php echo number_format($ict_stats['total_computers'] ?? 0); ?></div>
                <div class="stat-label">Total Computers</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-value"><?php echo number_format($ict_stats['ict_staff'] ?? 0); ?></div>
                <div class="stat-label">ICT Staff</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-ticket-alt"></i>
                </div>
                <div class="stat-value"><?php echo number_format($ict_stats['recent_tickets'] ?? 0); ?></div>
                <div class="stat-label">Weekly IT Tickets</div>
            </div>
        </div>

        <div class="content-grid fade-in">
            <div class="panel">
                <div class="panel-header">
                    <h2 class="panel-title">
                        <i class="fas fa-desktop"></i> Computer Labs
                    </h2>
                    <a href="#" class="nav-link">Manage Labs</a>
                </div>
                <div class="lab-grid">
                    <?php foreach ($computer_labs as $lab): ?>
                        <div class="lab-card" onclick="window.location.href='#'">
                            <div class="lab-name"><?php echo htmlspecialchars($lab['lab_name']); ?></div>
                            <div class="lab-stats">
                                <span>Total: <?php echo $lab['total_computers']; ?></span>
                                <span>Free: <?php echo $lab['available_computers']; ?></span>
                            </div>
                            <div class="lab-usage <?php 
                                $usage = ($lab['total_computers'] - $lab['available_computers']) / $lab['total_computers'] * 100;
                                if ($usage > 80) echo 'high';
                                elseif ($usage > 50) echo 'medium';
                                else echo 'low';
                            ?>">
                                Usage: <?php echo round($usage); ?>%
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="panel">
                <div class="panel-header">
                    <h2 class="panel-title">
                        <i class="fas fa-running"></i> Sports Facilities
                    </h2>
                    <a href="#" class="nav-link">Manage Facilities</a>
                </div>
                <div class="sports-grid">
                    <?php foreach ($sports_facilities as $facility): ?>
                        <div class="sports-card" onclick="window.location.href='#'">
                            <div class="sports-name"><?php echo htmlspecialchars($facility['facility_name']); ?></div>
                            <div class="sports-type"><?php echo htmlspecialchars($facility['facility_type']); ?></div>
                            <div class="sports-capacity"><?php echo $facility['capacity']; ?></div>
                            <div style="font-size: 0.8rem; color: var(--text-muted);">
                                Status: <?php echo ucfirst($facility['status']); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="content-grid fade-in">
            <div class="panel">
                <div class="panel-header">
                    <h2 class="panel-title">
                        <i class="fas fa-users"></i> ICT Staff
                    </h2>
                    <a href="#" class="nav-link">Manage Staff</a>
                </div>
                <div class="staff-table-container">
                    <table class="staff-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Department</th>
                                <th>Contact</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($it_staff as $staff): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($staff['username']); ?></td>
                                    <td>
                                        <span class="role-badge role-<?php echo $staff['role']; ?>">
                                            <?php echo ucfirst($staff['role']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo htmlspecialchars($staff['department']); ?></td>
                                    <td>
                                        <?php echo htmlspecialchars($staff['email']); ?><br>
                                        <?php echo htmlspecialchars($staff['phone'] ?? 'N/A'); ?>
                                    </td>
                                    <td>
                                        <a href="#" class="nav-link">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="panel">
                <div class="panel-header">
                    <h2 class="panel-title">
                        <i class="fas fa-history"></i> IT Activities
                    </h2>
                    <a href="#" class="nav-link">View All</a>
                </div>
                <div class="activity-list">
                    <?php foreach ($it_activities as $activity): ?>
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-desktop"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-text">
                                    <?php echo htmlspecialchars($activity['username'] ?? 'System'); ?> 
                                    <?php echo htmlspecialchars($activity['action'] ?? 'performed IT action'); ?>
                                </div>
                                <div class="activity-time">
                                    <?php echo date('M d, Y H:i', strtotime($activity['created_at'])); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="panel fade-in">
            <div class="panel-header">
                <h2 class="panel-title">
                    <i class="fas fa-bolt"></i> ICT & Sports Quick Actions
                </h2>
            </div>
            <div class="quick-actions">
                <a href="#" class="action-btn">
                    <i class="fas fa-plus-circle"></i>
                    Add New Lab
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-tools"></i>
                    Maintenance Request
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-ticket-alt"></i>
                    IT Support Ticket
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-network-wired"></i>
                    Network Status
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-calendar-alt"></i>
                    Sports Schedule
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-chart-bar"></i>
                    Usage Reports
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
        const cards = document.querySelectorAll('.stat-card, .lab-card, .sports-card, .activity-item');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Auto-refresh lab data every 30 seconds
        setInterval(() => {
            // Refresh computer lab status
            fetch('api/lab-status.php')
                .then(response => response.json())
                .then(data => {
                    // Update lab cards
                    console.log('Lab status refreshed');
                })
                .catch(error => console.error('Error refreshing lab status:', error));
        }, 30000);
    </script>
</body>
</html>


