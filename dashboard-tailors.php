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
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'staff' || $_SESSION['department'] !== 'tailors') {
    header('Location: login.php');
    exit();
}

include 'config.php';

// Get Tailors department information
$tailors_info = [];
try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ? AND role = 'staff' AND department = 'tailors'");
    $stmt->execute([$_SESSION['user_id']]);
    $tailors_info = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching Tailors info: " . $e->getMessage());
}

// Get Tailors department statistics
$tailors_stats = [];
try {
    // Total tailoring staff
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM users WHERE role = 'staff' AND department = 'tailors'");
    $tailors_stats['total_tailoring_staff'] = $stmt->fetchColumn();
    
    // Today's uniform orders
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM uniform_orders WHERE DATE(order_date) = CURDATE()");
    $tailors_stats['today_uniform_orders'] = $stmt->fetchColumn();
    
    // Completed orders today
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM uniform_orders WHERE DATE(order_date) = CURDATE() AND status = 'completed'");
    $tailors_stats['completed_orders_today'] = $stmt->fetchColumn();
    
    // Pending orders
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM uniform_orders WHERE status = 'pending'");
    $tailors_stats['pending_orders'] = $stmt->fetchColumn();
    
    // Total uniform types
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM uniform_types");
    $tailors_stats['total_uniform_types'] = $stmt->fetchColumn();
    
    // Fabric inventory items
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM fabric_inventory");
    $tailors_stats['fabric_inventory_items'] = $stmt->fetchColumn();
    
    // Low stock fabrics
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM fabric_inventory WHERE quantity <= reorder_level");
    $tailors_stats['low_stock_fabrics'] = $stmt->fetchColumn();
    
    // Total students
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM users WHERE role = 'student'");
    $tailors_stats['total_students'] = $stmt->fetchColumn();
} catch (PDOException $e) {
    error_log("Error fetching Tailors department statistics: " . $e->getMessage());
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

// Get today's uniform orders
$today_orders = [];
try {
    $stmt = $pdo->query("
        SELECT uo.*, ut.uniform_name, ut.uniform_type, u.username as student_name, u.student_id
        FROM uniform_orders uo
        LEFT JOIN uniform_types ut ON uo.uniform_type_id = ut.id
        LEFT JOIN users u ON uo.student_id = u.id
        WHERE DATE(uo.order_date) = CURDATE()
        ORDER BY uo.order_date DESC
        LIMIT 5
    ");
    $today_orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching today's uniform orders: " . $e->getMessage());
}

// Get low stock fabrics
$low_stock_fabrics = [];
try {
    $stmt = $pdo->query("
        SELECT fi.*, u.username as requester_name
        FROM fabric_inventory fi
        LEFT JOIN users u ON fi.last_updated_by = u.id
        WHERE fi.quantity <= fi.reorder_level
        ORDER BY fi.quantity ASC
        LIMIT 5
    ");
    $low_stock_fabrics = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching low stock fabrics: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailors Department Dashboard - ISNM</title>
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

        .order-list {
            max-height: 400px;
            overflow-y: auto;
        }

        .order-item {
            display: flex;
            align-items: start;
            gap: 1rem;
            padding: 1rem;
            border-bottom: 1px solid var(--soft-gray);
            transition: all 0.3s ease;
        }

        .order-item:hover {
            background: var(--light-gray);
        }

        .order-icon {
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

        .order-content {
            flex: 1;
        }

        .order-text {
            font-size: 0.9rem;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }

        .order-time {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .order-status {
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

        .status-low-stock {
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
                <img src="assets/school-logo.png" alt="ISNM">
                <span>IGANGA SCHOOL OF NURSING AND MIDWIFERY</span>
            </a>
            <div class="nav-links">
                <a href="dashboard-tailors.php" class="nav-link">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-tshirt"></i> Uniform Management
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-shopping-cart"></i> Order Management
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-users"></i> Tailor Management
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-boxes"></i> Fabric Inventory
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
                    <span><?php echo htmlspecialchars($tailors_info['username'] ?? 'Tailors Department'); ?></span>
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
                <h1 class="header-title">TAILORS DEPARTMENT</h1>
                <p class="header-subtitle">Uniform Production & Tailoring Services Excellence</p>
            </div>
        </header>

        <div class="stats-grid fade-in">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-value"><?php echo number_format($tailors_stats['total_tailoring_staff'] ?? 0); ?></div>
                <div class="stat-label">Total Tailoring Staff</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="stat-value"><?php echo number_format($tailors_stats['today_uniform_orders'] ?? 0); ?></div>
                <div class="stat-label">Today's Uniform Orders</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-value"><?php echo number_format($tailors_stats['completed_orders_today'] ?? 0); ?></div>
                <div class="stat-label">Completed Orders Today</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-value"><?php echo number_format($tailors_stats['pending_orders'] ?? 0); ?></div>
                <div class="stat-label">Pending Orders</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-tshirt"></i>
                </div>
                <div class="stat-value"><?php echo number_format($tailors_stats['total_uniform_types'] ?? 0); ?></div>
                <div class="stat-label">Total Uniform Types</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-boxes"></i>
                </div>
                <div class="stat-value"><?php echo number_format($tailors_stats['fabric_inventory_items'] ?? 0); ?></div>
                <div class="stat-label">Fabric Inventory Items</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-value"><?php echo number_format($tailors_stats['low_stock_fabrics'] ?? 0); ?></div>
                <div class="stat-label">Low Stock Fabrics</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="stat-value"><?php echo number_format($tailors_stats['total_students'] ?? 0); ?></div>
                <div class="stat-label">Total Students</div>
            </div>
        </div>

        <div class="content-grid fade-in">
            <div class="panel">
                <div class="panel-header">
                    <h2 class="panel-title">
                        <i class="fas fa-shopping-cart"></i> Today's Uniform Orders
                    </h2>
                    <a href="#" class="nav-link">View All</a>
                </div>
                <div class="order-list">
                    <?php foreach ($today_orders as $order): ?>
                        <div class="order-item">
                            <div class="order-icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div class="order-content">
                                <div class="order-text">
                                    <strong><?php echo htmlspecialchars($order['uniform_name'] ?? 'Unknown Uniform'); ?></strong>
                                    - <?php echo htmlspecialchars($order['uniform_type'] ?? 'Not specified'); ?>
                                </div>
                                <div class="order-text">
                                    Student: <?php echo htmlspecialchars($order['student_name'] ?? 'Unknown'); ?>
                                    (<?php echo htmlspecialchars($order['student_id'] ?? 'N/A'); ?>)
                                </div>
                                <div class="order-text">
                                    Quantity: <?php echo htmlspecialchars($order['quantity'] ?? '0'); ?>
                                </div>
                                <div class="order-time">
                                    Ordered: <?php echo date('M d, Y H:i', strtotime($order['order_date'])); ?>
                                </div>
                            </div>
                            <div class="order-status status-<?php echo htmlspecialchars($order['status'] ?? 'pending'); ?>">
                                <?php echo htmlspecialchars(ucfirst($order['status'] ?? 'Pending')); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="panel">
                <div class="panel-header">
                    <h2 class="panel-title">
                        <i class="fas fa-exclamation-triangle"></i> Low Stock Fabrics
                    </h2>
                    <a href="#" class="nav-link">View All</a>
                </div>
                <div class="order-list">
                    <?php foreach ($low_stock_fabrics as $fabric): ?>
                        <div class="order-item">
                            <div class="order-icon">
                                <i class="fas fa-boxes"></i>
                            </div>
                            <div class="order-content">
                                <div class="order-text">
                                    <strong><?php echo htmlspecialchars($fabric['fabric_name'] ?? 'Unknown Fabric'); ?></strong>
                                </div>
                                <div class="order-text">
                                    Category: <?php echo htmlspecialchars($fabric['category'] ?? 'Not specified'); ?>
                                </div>
                                <div class="order-text">
                                    Current Stock: <?php echo htmlspecialchars($fabric['quantity'] ?? '0'); ?> <?php echo htmlspecialchars($fabric['unit'] ?? 'units'); ?>
                                </div>
                                <div class="order-text">
                                    Reorder Level: <?php echo htmlspecialchars($fabric['reorder_level'] ?? '0'); ?> <?php echo htmlspecialchars($fabric['unit'] ?? 'units'); ?>
                                </div>
                            </div>
                            <div class="order-status status-low-stock">
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
                    <i class="fas fa-tasks"></i> Tailors Department Quick Actions
                </h2>
            </div>
            <div class="quick-actions">
                <a href="#" class="action-btn">
                    <i class="fas fa-tshirt"></i>
                    Uniform Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-shopping-cart"></i>
                    Order Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-users"></i>
                    Tailor Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-boxes"></i>
                    Fabric Inventory Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-chart-line"></i>
                    Production Reports
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-clipboard-check"></i>
                    Quality Control
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-ruler"></i>
                    Measurement Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-shopping-bag"></i>
                    Fabric Order Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-boxes"></i>
                    Tailoring Inventory Portal
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
        const cards = document.querySelectorAll('.stat-card, .order-item');
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


