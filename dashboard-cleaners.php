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
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'staff' || $_SESSION['department'] !== 'cleaners') {
    header('Location: login.php');
    exit();
}

include 'config.php';

// Get Cleaners department information
$cleaners_info = [];
try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ? AND role = 'staff' AND department = 'cleaners'");
    $stmt->execute([$_SESSION['user_id']]);
    $cleaners_info = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching Cleaners info: " . $e->getMessage());
}

// Get Cleaners department statistics
$cleaners_stats = [];
try {
    // Total cleaning staff
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM users WHERE role = 'staff' AND department = 'cleaners'");
    $cleaners_stats['total_cleaning_staff'] = $stmt->fetchColumn();
    
    // Today's cleaning tasks
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM cleaning_tasks WHERE DATE(task_date) = CURDATE()");
    $cleaners_stats['today_cleaning_tasks'] = $stmt->fetchColumn();
    
    // Completed tasks today
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM cleaning_tasks WHERE DATE(task_date) = CURDATE() AND status = 'completed'");
    $cleaners_stats['completed_tasks_today'] = $stmt->fetchColumn();
    
    // Pending tasks
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM cleaning_tasks WHERE status = 'pending'");
    $cleaners_stats['pending_tasks'] = $stmt->fetchColumn();
    
    // Total areas to clean
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM cleaning_areas");
    $cleaners_stats['total_cleaning_areas'] = $stmt->fetchColumn();
    
    // Cleaning supplies inventory
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM cleaning_supplies");
    $cleaners_stats['cleaning_supplies'] = $stmt->fetchColumn();
    
    // Low stock supplies
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM cleaning_supplies WHERE quantity <= reorder_level");
    $cleaners_stats['low_stock_supplies'] = $stmt->fetchColumn();
} catch (PDOException $e) {
    error_log("Error fetching Cleaners department statistics: " . $e->getMessage());
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

// Get today's cleaning tasks
$today_tasks = [];
try {
    $stmt = $pdo->query("
        SELECT ct.*, ca.area_name, u.username as cleaner_name
        FROM cleaning_tasks ct
        LEFT JOIN cleaning_areas ca ON ct.area_id = ca.id
        LEFT JOIN users u ON ct.assigned_to = u.id
        WHERE DATE(ct.task_date) = CURDATE()
        ORDER BY ct.scheduled_time ASC
        LIMIT 5
    ");
    $today_tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching today's cleaning tasks: " . $e->getMessage());
}

// Get low stock supplies
$low_stock_supplies = [];
try {
    $stmt = $pdo->query("
        SELECT cs.*, u.username as requester_name
        FROM cleaning_supplies cs
        LEFT JOIN users u ON cs.last_updated_by = u.id
        WHERE cs.quantity <= cs.reorder_level
        ORDER BY cs.quantity ASC
        LIMIT 5
    ");
    $low_stock_supplies = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching low stock supplies: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cleaners Department Dashboard - ISNM</title>
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

        .task-list {
            max-height: 400px;
            overflow-y: auto;
        }

        .task-item {
            display: flex;
            align-items: start;
            gap: 1rem;
            padding: 1rem;
            border-bottom: 1px solid var(--soft-gray);
            transition: all 0.3s ease;
        }

        .task-item:hover {
            background: var(--light-gray);
        }

        .task-icon {
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

        .task-content {
            flex: 1;
        }

        .task-text {
            font-size: 0.9rem;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }

        .task-time {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .task-status {
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
                <a href="dashboard-cleaners.php" class="nav-link">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-broom"></i> Cleaning Management
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-calendar-alt"></i> Schedule Management
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-users"></i> Staff Management
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-boxes"></i> Supplies Management
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-chart-line"></i> Reports
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-clipboard-check"></i> Quality Control
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="user-menu">
                    <i class="fas fa-user"></i>
                    <span><?php echo htmlspecialchars($cleaners_info['username'] ?? 'Cleaners Department'); ?></span>
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
                <h1 class="header-title">CLEANERS DEPARTMENT</h1>
                <p class="header-subtitle">Facility Management & Cleaning Services Excellence</p>
            </div>
        </header>

        <div class="stats-grid fade-in">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-value"><?php echo number_format($cleaners_stats['total_cleaning_staff'] ?? 0); ?></div>
                <div class="stat-label">Total Cleaning Staff</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-broom"></i>
                </div>
                <div class="stat-value"><?php echo number_format($cleaners_stats['today_cleaning_tasks'] ?? 0); ?></div>
                <div class="stat-label">Today's Cleaning Tasks</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-value"><?php echo number_format($cleaners_stats['completed_tasks_today'] ?? 0); ?></div>
                <div class="stat-label">Completed Tasks Today</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-value"><?php echo number_format($cleaners_stats['pending_tasks'] ?? 0); ?></div>
                <div class="stat-label">Pending Tasks</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <div class="stat-value"><?php echo number_format($cleaners_stats['total_cleaning_areas'] ?? 0); ?></div>
                <div class="stat-label">Total Cleaning Areas</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-boxes"></i>
                </div>
                <div class="stat-value"><?php echo number_format($cleaners_stats['cleaning_supplies'] ?? 0); ?></div>
                <div class="stat-label">Cleaning Supplies</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-value"><?php echo number_format($cleaners_stats['low_stock_supplies'] ?? 0); ?></div>
                <div class="stat-label">Low Stock Supplies</div>
            </div>
        </div>

        <div class="content-grid fade-in">
            <div class="panel">
                <div class="panel-header">
                    <h2 class="panel-title">
                        <i class="fas fa-broom"></i> Today's Cleaning Tasks
                    </h2>
                    <a href="#" class="nav-link">View All</a>
                </div>
                <div class="task-list">
                    <?php foreach ($today_tasks as $task): ?>
                        <div class="task-item">
                            <div class="task-icon">
                                <i class="fas fa-broom"></i>
                            </div>
                            <div class="task-content">
                                <div class="task-text">
                                    <strong><?php echo htmlspecialchars($task['area_name'] ?? 'Unknown Area'); ?></strong>
                                    - <?php echo htmlspecialchars($task['task_type'] ?? 'General Cleaning'); ?>
                                </div>
                                <div class="task-text">
                                    Assigned to: <?php echo htmlspecialchars($task['cleaner_name'] ?? 'Not assigned'); ?>
                                </div>
                                <div class="task-time">
                                    Scheduled: <?php echo date('H:i', strtotime($task['scheduled_time'])); ?>
                                </div>
                            </div>
                            <div class="task-status status-<?php echo htmlspecialchars($task['status'] ?? 'pending'); ?>">
                                <?php echo htmlspecialchars(ucfirst($task['status'] ?? 'Pending')); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="panel">
                <div class="panel-header">
                    <h2 class="panel-title">
                        <i class="fas fa-exclamation-triangle"></i> Low Stock Supplies
                    </h2>
                    <a href="#" class="nav-link">View All</a>
                </div>
                <div class="task-list">
                    <?php foreach ($low_stock_supplies as $supply): ?>
                        <div class="task-item">
                            <div class="task-icon">
                                <i class="fas fa-boxes"></i>
                            </div>
                            <div class="task-content">
                                <div class="task-text">
                                    <strong><?php echo htmlspecialchars($supply['supply_name'] ?? 'Unknown Supply'); ?></strong>
                                </div>
                                <div class="task-text">
                                    Category: <?php echo htmlspecialchars($supply['category'] ?? 'Not specified'); ?>
                                </div>
                                <div class="task-text">
                                    Current Stock: <?php echo htmlspecialchars($supply['quantity'] ?? '0'); ?> <?php echo htmlspecialchars($supply['unit'] ?? 'units'); ?>
                                </div>
                                <div class="task-text">
                                    Reorder Level: <?php echo htmlspecialchars($supply['reorder_level'] ?? '0'); ?> <?php echo htmlspecialchars($supply['unit'] ?? 'units'); ?>
                                </div>
                            </div>
                            <div class="task-status status-pending">
                                Low Stock
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="panel fade-in">
            <div class="panel-header">
                <h2 class="panel-title">
                    <i class="fas fa-tasks"></i> Cleaners Department Quick Actions
                </h2>
            </div>
            <div class="quick-actions">
                <a href="#" class="action-btn">
                    <i class="fas fa-broom"></i>
                    Cleaning Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-calendar-alt"></i>
                    Schedule Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-users"></i>
                    Staff Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-boxes"></i>
                    Supplies Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-chart-line"></i>
                    Cleaning Reports
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-clipboard-check"></i>
                    Quality Control
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-map-marked-alt"></i>
                    Area Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-shopping-cart"></i>
                    Supply Order Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-boxes"></i>
                    Cleaning Inventory Portal
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
        const cards = document.querySelectorAll('.stat-card, .task-item');
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
