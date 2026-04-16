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
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'staff' || $_SESSION['department'] !== 'cooks') {
    header('Location: login.php');
    exit();
}

include 'config.php';

// Get Cooks department information
$cooks_info = [];
try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ? AND role = 'staff' AND department = 'cooks'");
    $stmt->execute([$_SESSION['user_id']]);
    $cooks_info = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching Cooks info: " . $e->getMessage());
}

// Get Cooks department statistics
$cooks_stats = [];
try {
    // Total meals served today
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM meal_serving WHERE DATE(serving_date) = CURDATE()");
    $cooks_stats['meals_served_today'] = $stmt->fetchColumn();
    
    // Total students
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM users WHERE role = 'student'");
    $cooks_stats['total_students'] = $stmt->fetchColumn();
    
    // Kitchen staff
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM users WHERE role = 'staff' AND department = 'cooks'");
    $cooks_stats['kitchen_staff'] = $stmt->fetchColumn();
    
    // Food inventory items
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM food_inventory");
    $cooks_stats['food_inventory_items'] = $stmt->fetchColumn();
    
    // Low stock items
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM food_inventory WHERE quantity <= reorder_level");
    $cooks_stats['low_stock_items'] = $stmt->fetchColumn();
    
    // Today's menu items
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM daily_menu WHERE DATE(menu_date) = CURDATE()");
    $cooks_stats['today_menu_items'] = $stmt->fetchColumn();
    
    // Pending food orders
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM food_orders WHERE status = 'pending'");
    $cooks_stats['pending_food_orders'] = $stmt->fetchColumn();
} catch (PDOException $e) {
    error_log("Error fetching Cooks department statistics: " . $e->getMessage());
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

// Get today's menu
$today_menu = [];
try {
    $stmt = $pdo->query("
        SELECT dm.*, u.username as chef_name
        FROM daily_menu dm
        LEFT JOIN users u ON dm.chef_id = u.id
        WHERE DATE(dm.menu_date) = CURDATE()
        ORDER BY dm.meal_time ASC
        LIMIT 5
    ");
    $today_menu = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching today's menu: " . $e->getMessage());
}

// Get low stock items
$low_stock_items = [];
try {
    $stmt = $pdo->query("
        SELECT fi.*, u.username as requester_name
        FROM food_inventory fi
        LEFT JOIN users u ON fi.last_updated_by = u.id
        WHERE fi.quantity <= fi.reorder_level
        ORDER BY fi.quantity ASC
        LIMIT 5
    ");
    $low_stock_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching low stock items: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cooks Department Dashboard - ISNM</title>
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

        .menu-list {
            max-height: 400px;
            overflow-y: auto;
        }

        .menu-item {
            display: flex;
            align-items: start;
            gap: 1rem;
            padding: 1rem;
            border-bottom: 1px solid var(--soft-gray);
            transition: all 0.3s ease;
        }

        .menu-item:hover {
            background: var(--light-gray);
        }

        .menu-icon {
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

        .menu-content {
            flex: 1;
        }

        .menu-text {
            font-size: 0.9rem;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }

        .menu-time {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .menu-status {
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-available {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success-green);
        }

        .status-low-stock {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning-orange);
        }

        .status-out-of-stock {
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
                <a href="dashboard-cooks.php" class="nav-link">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-utensils"></i> Meal Management
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-shopping-cart"></i> Food Inventory
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-users"></i> Kitchen Staff
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-calendar-alt"></i> Menu Planning
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-chart-line"></i> Nutrition Reports
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-clipboard-check"></i> Quality Control
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="user-menu">
                    <i class="fas fa-user"></i>
                    <span><?php echo htmlspecialchars($cooks_info['username'] ?? 'Cooks Department'); ?></span>
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
                <h1 class="header-title">COOKS DEPARTMENT</h1>
                <p class="header-subtitle">Kitchen Management & Culinary Services Excellence</p>
            </div>
        </header>

        <div class="stats-grid fade-in">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-utensils"></i>
                </div>
                <div class="stat-value"><?php echo number_format($cooks_stats['meals_served_today'] ?? 0); ?></div>
                <div class="stat-label">Meals Served Today</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-value"><?php echo number_format($cooks_stats['total_students'] ?? 0); ?></div>
                <div class="stat-label">Total Students</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="stat-value"><?php echo number_format($cooks_stats['kitchen_staff'] ?? 0); ?></div>
                <div class="stat-label">Kitchen Staff</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="stat-value"><?php echo number_format($cooks_stats['food_inventory_items'] ?? 0); ?></div>
                <div class="stat-label">Food Inventory Items</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-value"><?php echo number_format($cooks_stats['low_stock_items'] ?? 0); ?></div>
                <div class="stat-label">Low Stock Items</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="stat-value"><?php echo number_format($cooks_stats['today_menu_items'] ?? 0); ?></div>
                <div class="stat-label">Today's Menu Items</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="stat-value"><?php echo number_format($cooks_stats['pending_food_orders'] ?? 0); ?></div>
                <div class="stat-label">Pending Food Orders</div>
            </div>
        </div>

        <div class="content-grid fade-in">
            <div class="panel">
                <div class="panel-header">
                    <h2 class="panel-title">
                        <i class="fas fa-calendar-alt"></i> Today's Menu
                    </h2>
                    <a href="#" class="nav-link">View All</a>
                </div>
                <div class="menu-list">
                    <?php foreach ($today_menu as $menu): ?>
                        <div class="menu-item">
                            <div class="menu-icon">
                                <i class="fas fa-utensils"></i>
                            </div>
                            <div class="menu-content">
                                <div class="menu-text">
                                    <strong><?php echo htmlspecialchars($menu['meal_name'] ?? 'Unknown Meal'); ?></strong>
                                    - <?php echo htmlspecialchars($menu['meal_type'] ?? 'Not specified'); ?>
                                </div>
                                <div class="menu-text">
                                    Ingredients: <?php echo htmlspecialchars($menu['ingredients'] ?? 'Not specified'); ?>
                                </div>
                                <div class="menu-time">
                                    Serving Time: <?php echo date('H:i', strtotime($menu['meal_time'])); ?>
                                </div>
                                <div class="menu-time">
                                    Chef: <?php echo htmlspecialchars($menu['chef_name'] ?? 'Unknown'); ?>
                                </div>
                            </div>
                            <div class="menu-status status-available">
                                Available
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="panel">
                <div class="panel-header">
                    <h2 class="panel-title">
                        <i class="fas fa-exclamation-triangle"></i> Low Stock Items
                    </h2>
                    <a href="#" class="nav-link">View All</a>
                </div>
                <div class="menu-list">
                    <?php foreach ($low_stock_items as $item): ?>
                        <div class="menu-item">
                            <div class="menu-icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div class="menu-content">
                                <div class="menu-text">
                                    <strong><?php echo htmlspecialchars($item['item_name'] ?? 'Unknown Item'); ?></strong>
                                </div>
                                <div class="menu-text">
                                    Category: <?php echo htmlspecialchars($item['category'] ?? 'Not specified'); ?>
                                </div>
                                <div class="menu-text">
                                    Current Stock: <?php echo htmlspecialchars($item['quantity'] ?? '0'); ?> <?php echo htmlspecialchars($item['unit'] ?? 'units'); ?>
                                </div>
                                <div class="menu-text">
                                    Reorder Level: <?php echo htmlspecialchars($item['reorder_level'] ?? '0'); ?> <?php echo htmlspecialchars($item['unit'] ?? 'units'); ?>
                                </div>
                            </div>
                            <div class="menu-status status-low-stock">
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
                    <i class="fas fa-tasks"></i> Cooks Department Quick Actions
                </h2>
            </div>
            <div class="quick-actions">
                <a href="#" class="action-btn">
                    <i class="fas fa-utensils"></i>
                    Meal Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-shopping-cart"></i>
                    Food Inventory Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-calendar-alt"></i>
                    Menu Planning
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-users"></i>
                    Kitchen Staff Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-chart-line"></i>
                    Nutrition Reports
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-clipboard-check"></i>
                    Quality Control
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-shopping-bag"></i>
                    Food Order Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-boxes"></i>
                    Kitchen Inventory Portal
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-money-bill-wave"></i>
                    Budget Management
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
        const cards = document.querySelectorAll('.stat-card, .menu-item');
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


