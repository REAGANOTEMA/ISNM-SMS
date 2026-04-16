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
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin' || $_SESSION['department'] !== 'school-bursar') {
    header('Location: login.php');
    exit();
}

include 'config.php';

// Get School Bursar information
$bursar_info = [];
try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ? AND role = 'admin' AND department = 'school-bursar'");
    $stmt->execute([$_SESSION['user_id']]);
    $bursar_info = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching School Bursar info: " . $e->getMessage());
}

// Get Financial statistics
$financial_stats = [];
try {
    // Total students
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM users WHERE role = 'student'");
    $financial_stats['total_students'] = $stmt->fetchColumn();
    
    // Total fees collected this month
    $stmt = $pdo->query("SELECT SUM(amount) as total FROM fee_payments WHERE MONTH(payment_date) = MONTH(CURRENT_DATE()) AND YEAR(payment_date) = YEAR(CURRENT_DATE())");
    $financial_stats['fees_this_month'] = $stmt->fetchColumn() ?? 0;
    
    // Outstanding balances
    $stmt = $pdo->query("SELECT SUM(outstanding_balance) as total FROM student_accounts WHERE outstanding_balance > 0");
    $financial_stats['outstanding_balances'] = $stmt->fetchColumn() ?? 0;
    
    // Total revenue this year
    $stmt = $pdo->query("SELECT SUM(amount) as total FROM fee_payments WHERE YEAR(payment_date) = YEAR(CURRENT_DATE())");
    $financial_stats['revenue_this_year'] = $stmt->fetchColumn() ?? 0;
    
    // Total expenses this month
    $stmt = $pdo->query("SELECT SUM(amount) as total FROM expenses WHERE MONTH(expense_date) = MONTH(CURRENT_DATE()) AND YEAR(expense_date) = YEAR(CURRENT_DATE())");
    $financial_stats['expenses_this_month'] = $stmt->fetchColumn() ?? 0;
    
    // Pending reimbursements
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM reimbursement_requests WHERE status = 'pending'");
    $financial_stats['pending_reimbursements'] = $stmt->fetchColumn();
    
    // Total staff salaries
    $stmt = $pdo->query("SELECT SUM(salary) as total FROM staff_salaries WHERE status = 'active'");
    $financial_stats['total_salaries'] = $stmt->fetchColumn() ?? 0;
} catch (PDOException $e) {
    error_log("Error fetching Financial statistics: " . $e->getMessage());
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

// Get pending reimbursements
$pending_reimbursements = [];
try {
    $stmt = $pdo->query("
        SELECT rr.*, u.username as requester_name, d.department_name
        FROM reimbursement_requests rr
        LEFT JOIN users u ON rr.requester_id = u.id
        LEFT JOIN departments d ON u.department = d.id
        WHERE rr.status = 'pending'
        ORDER BY rr.created_at DESC
        LIMIT 5
    ");
    $pending_reimbursements = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching pending reimbursements: " . $e->getMessage());
}

// Get recent transactions
$recent_transactions = [];
try {
    $stmt = $pdo->query("
        SELECT ft.*, u.username as student_name
        FROM fee_transactions ft
        LEFT JOIN users u ON ft.student_id = u.id
        ORDER BY ft.transaction_date DESC
        LIMIT 5
    ");
    $recent_transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching recent transactions: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Bursar Dashboard - ISNM</title>
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

        .transaction-list {
            max-height: 400px;
            overflow-y: auto;
        }

        .transaction-item {
            display: flex;
            align-items: start;
            gap: 1rem;
            padding: 1rem;
            border-bottom: 1px solid var(--soft-gray);
            transition: all 0.3s ease;
        }

        .transaction-item:hover {
            background: var(--light-gray);
        }

        .transaction-icon {
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

        .transaction-content {
            flex: 1;
        }

        .transaction-text {
            font-size: 0.9rem;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }

        .transaction-time {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .transaction-amount {
            font-weight: 700;
            color: var(--success-green);
        }

        .reimbursement-list {
            max-height: 300px;
            overflow-y: auto;
        }

        .reimbursement-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            border-bottom: 1px solid var(--soft-gray);
            transition: all 0.3s ease;
        }

        .reimbursement-item:hover {
            background: var(--light-gray);
        }

        .reimbursement-status {
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-pending {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning-orange);
        }

        .status-approved {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success-green);
        }

        .status-rejected {
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
                <a href="dashboard-school-bursar.php" class="nav-link">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-users"></i> Student Fee Records
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-coins"></i> Payments Dashboard
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-file-invoice"></i> Receipts & Invoices
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-exclamation-triangle"></i> Outstanding Balances
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-money-bill"></i> Expense Management
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-chart-line"></i> Financial Reports
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="user-menu">
                    <i class="fas fa-user"></i>
                    <span><?php echo htmlspecialchars($bursar_info['username'] ?? 'School Bursar'); ?></span>
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
                <h1 class="header-title">SCHOOL BURSAR</h1>
                <p class="header-subtitle">Financial Management & Accounting Excellence</p>
            </div>
        </header>

        <div class="stats-grid fade-in">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-value"><?php echo number_format($financial_stats['total_students'] ?? 0); ?></div>
                <div class="stat-label">Total Students</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-coins"></i>
                </div>
                <div class="stat-value"><?php echo number_format($financial_stats['fees_this_month'] ?? 0); ?></div>
                <div class="stat-label">Fees This Month</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-value"><?php echo number_format($financial_stats['outstanding_balances'] ?? 0); ?></div>
                <div class="stat-label">Outstanding Balances</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-value"><?php echo number_format($financial_stats['revenue_this_year'] ?? 0); ?></div>
                <div class="stat-label">Revenue This Year</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-money-bill"></i>
                </div>
                <div class="stat-value"><?php echo number_format($financial_stats['expenses_this_month'] ?? 0); ?></div>
                <div class="stat-label">Expenses This Month</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <div class="stat-value"><?php echo number_format($financial_stats['pending_reimbursements'] ?? 0); ?></div>
                <div class="stat-label">Pending Reimbursements</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="stat-value"><?php echo number_format($financial_stats['total_salaries'] ?? 0); ?></div>
                <div class="stat-label">Total Staff Salaries</div>
            </div>
        </div>

        <div class="content-grid fade-in">
            <div class="panel">
                <div class="panel-header">
                    <h2 class="panel-title">
                        <i class="fas fa-coins"></i> Recent Transactions
                    </h2>
                    <a href="#" class="nav-link">View All</a>
                </div>
                <div class="transaction-list">
                    <?php foreach ($recent_transactions as $transaction): ?>
                        <div class="transaction-item">
                            <div class="transaction-icon">
                                <i class="fas fa-coins"></i>
                            </div>
                            <div class="transaction-content">
                                <div class="transaction-text">
                                    <strong><?php echo htmlspecialchars($transaction['student_name'] ?? 'Unknown'); ?></strong>
                                    paid <span class="transaction-amount"><?php echo number_format($transaction['amount'] ?? 0); ?></span>
                                    for <?php echo htmlspecialchars($transaction['payment_type'] ?? 'Fees'); ?>
                                </div>
                                <div class="transaction-time">
                                    <?php echo date('M d, Y H:i', strtotime($transaction['transaction_date'])); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="panel">
                <div class="panel-header">
                    <h2 class="panel-title">
                        <i class="fas fa-hand-holding-usd"></i> Pending Reimbursements
                    </h2>
                    <a href="#" class="nav-link">View All</a>
                </div>
                <div class="reimbursement-list">
                    <?php foreach ($pending_reimbursements as $reimbursement): ?>
                        <div class="reimbursement-item">
                            <div class="transaction-icon">
                                <i class="fas fa-hand-holding-usd"></i>
                            </div>
                            <div class="transaction-content">
                                <div class="transaction-text">
                                    <strong><?php echo htmlspecialchars($reimbursement['requester_name'] ?? 'Unknown'); ?></strong>
                                    from <?php echo htmlspecialchars($reimbursement['department_name'] ?? 'Unknown'); ?>
                                    requests <span class="transaction-amount"><?php echo number_format($reimbursement['amount'] ?? 0); ?></span>
                                    for <?php echo htmlspecialchars($reimbursement['purpose'] ?? 'Reimbursement'); ?>
                                </div>
                                <div class="transaction-time">
                                    <?php echo date('M d, Y H:i', strtotime($reimbursement['created_at'])); ?>
                                </div>
                            </div>
                            <div class="reimbursement-status status-pending">
                                <?php echo htmlspecialchars(ucfirst($reimbursement['status'] ?? 'Pending')); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="panel fade-in">
            <div class="panel-header">
                <h2 class="panel-title">
                    <i class="fas fa-tasks"></i> School Bursar Quick Actions
                </h2>
            </div>
            <div class="quick-actions">
                <a href="#" class="action-btn">
                    <i class="fas fa-users"></i>
                    Student Fee Records
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-coins"></i>
                    Payments Dashboard
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-file-invoice"></i>
                    Receipts & Invoices
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-exclamation-triangle"></i>
                    Outstanding Balances
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-money-bill"></i>
                    Expense Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-chart-line"></i>
                    Financial Reports
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-wallet"></i>
                    Salary Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-hand-holding-usd"></i>
                    Reimbursement Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-boxes"></i>
                    Inventory Portal
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
        const cards = document.querySelectorAll('.stat-card, .transaction-item, .reimbursement-item');
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


