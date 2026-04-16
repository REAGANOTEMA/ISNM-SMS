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
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'staff' || $_SESSION['department'] !== 'librarian') {
    header('Location: login.php');
    exit();
}

include 'config.php';

// Get Librarian information
$librarian_info = [];
try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ? AND role = 'staff' AND department = 'librarian'");
    $stmt->execute([$_SESSION['user_id']]);
    $librarian_info = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching Librarian info: " . $e->getMessage());
}

// Get Library statistics
$library_stats = [];
try {
    // Total books
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM book_inventory");
    $library_stats['total_books'] = $stmt->fetchColumn();
    
    // Available books
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM book_inventory WHERE status = 'available'");
    $library_stats['available_books'] = $stmt->fetchColumn();
    
    // Borrowed books
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM book_inventory WHERE status = 'borrowed'");
    $library_stats['borrowed_books'] = $stmt->fetchColumn();
    
    // Overdue books
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM book_loans WHERE due_date < CURDATE() AND status = 'active'");
    $library_stats['overdue_books'] = $stmt->fetchColumn();
    
    // Today's visitors
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM library_visits WHERE DATE(visit_date) = CURDATE()");
    $library_stats['today_visitors'] = $stmt->fetchColumn();
    
    // Active members
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM library_members WHERE status = 'active'");
    $library_stats['active_members'] = $stmt->fetchColumn();
    
    // Pending reservations
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM book_reservations WHERE status = 'pending'");
    $library_stats['pending_reservations'] = $stmt->fetchColumn();
} catch (PDOException $e) {
    error_log("Error fetching Library statistics: " . $e->getMessage());
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

// Get overdue books
$overdue_books = [];
try {
    $stmt = $pdo->query("
        SELECT bl.*, b.title, b.author, u.username as borrower_name, u.student_id
        FROM book_loans bl
        LEFT JOIN book_inventory b ON bl.book_id = b.id
        LEFT JOIN users u ON bl.borrower_id = u.id
        WHERE bl.due_date < CURDATE() AND bl.status = 'active'
        ORDER BY bl.due_date ASC
        LIMIT 5
    ");
    $overdue_books = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching overdue books: " . $e->getMessage());
}

// Get pending reservations
$pending_reservations = [];
try {
    $stmt = $pdo->query("
        SELECT br.*, b.title, b.author, u.username as requester_name, u.student_id
        FROM book_reservations br
        LEFT JOIN book_inventory b ON br.book_id = b.id
        LEFT JOIN users u ON br.requester_id = u.id
        WHERE br.status = 'pending'
        ORDER BY br.created_at DESC
        LIMIT 5
    ");
    $pending_reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching pending reservations: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librarian Dashboard - ISNM</title>
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

        .book-list {
            max-height: 400px;
            overflow-y: auto;
        }

        .book-item {
            display: flex;
            align-items: start;
            gap: 1rem;
            padding: 1rem;
            border-bottom: 1px solid var(--soft-gray);
            transition: all 0.3s ease;
        }

        .book-item:hover {
            background: var(--light-gray);
        }

        .book-icon {
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

        .book-content {
            flex: 1;
        }

        .book-text {
            font-size: 0.9rem;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }

        .book-time {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .book-status {
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-overdue {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-red);
        }

        .status-pending {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning-orange);
        }

        .status-active {
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
                <a href="dashboard-librarian.php" class="nav-link">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-book"></i> Book Management
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-hand-holding"></i> Circulation
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-users"></i> Member Management
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-bookmark"></i> Reservations
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-chart-line"></i> Reports
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-boxes"></i> Inventory
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="user-menu">
                    <i class="fas fa-user"></i>
                    <span><?php echo htmlspecialchars($librarian_info['username'] ?? 'Librarian'); ?></span>
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
                <h1 class="header-title">LIBRARIAN</h1>
                <p class="header-subtitle">Library Management & Information Services Excellence</p>
            </div>
        </header>

        <div class="stats-grid fade-in">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-book"></i>
                </div>
                <div class="stat-value"><?php echo number_format($library_stats['total_books'] ?? 0); ?></div>
                <div class="stat-label">Total Books</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-value"><?php echo number_format($library_stats['available_books'] ?? 0); ?></div>
                <div class="stat-label">Available Books</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-hand-holding"></i>
                </div>
                <div class="stat-value"><?php echo number_format($library_stats['borrowed_books'] ?? 0); ?></div>
                <div class="stat-label">Borrowed Books</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-value"><?php echo number_format($library_stats['overdue_books'] ?? 0); ?></div>
                <div class="stat-label">Overdue Books</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-value"><?php echo number_format($library_stats['today_visitors'] ?? 0); ?></div>
                <div class="stat-label">Today's Visitors</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-id-card"></i>
                </div>
                <div class="stat-value"><?php echo number_format($library_stats['active_members'] ?? 0); ?></div>
                <div class="stat-label">Active Members</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-bookmark"></i>
                </div>
                <div class="stat-value"><?php echo number_format($library_stats['pending_reservations'] ?? 0); ?></div>
                <div class="stat-label">Pending Reservations</div>
            </div>
        </div>

        <div class="content-grid fade-in">
            <div class="panel">
                <div class="panel-header">
                    <h2 class="panel-title">
                        <i class="fas fa-exclamation-triangle"></i> Overdue Books
                    </h2>
                    <a href="#" class="nav-link">View All</a>
                </div>
                <div class="book-list">
                    <?php foreach ($overdue_books as $book): ?>
                        <div class="book-item">
                            <div class="book-icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="book-content">
                                <div class="book-text">
                                    <strong><?php echo htmlspecialchars($book['title'] ?? 'Unknown Title'); ?></strong>
                                    by <?php echo htmlspecialchars($book['author'] ?? 'Unknown Author'); ?>
                                </div>
                                <div class="book-time">
                                    Borrowed by <?php echo htmlspecialchars($book['borrower_name'] ?? 'Unknown'); ?>
                                    (<?php echo htmlspecialchars($book['student_id'] ?? 'N/A'); ?>)
                                </div>
                                <div class="book-time">
                                    Due: <?php echo date('M d, Y', strtotime($book['due_date'])); ?>
                                </div>
                            </div>
                            <div class="book-status status-overdue">
                                Overdue
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="panel">
                <div class="panel-header">
                    <h2 class="panel-title">
                        <i class="fas fa-bookmark"></i> Pending Reservations
                    </h2>
                    <a href="#" class="nav-link">View All</a>
                </div>
                <div class="book-list">
                    <?php foreach ($pending_reservations as $reservation): ?>
                        <div class="book-item">
                            <div class="book-icon">
                                <i class="fas fa-bookmark"></i>
                            </div>
                            <div class="book-content">
                                <div class="book-text">
                                    <strong><?php echo htmlspecialchars($reservation['title'] ?? 'Unknown Title'); ?></strong>
                                    by <?php echo htmlspecialchars($reservation['author'] ?? 'Unknown Author'); ?>
                                </div>
                                <div class="book-time">
                                    Reserved by <?php echo htmlspecialchars($reservation['requester_name'] ?? 'Unknown'); ?>
                                    (<?php echo htmlspecialchars($reservation['student_id'] ?? 'N/A'); ?>)
                                </div>
                                <div class="book-time">
                                    Reserved: <?php echo date('M d, Y', strtotime($reservation['created_at'])); ?>
                                </div>
                            </div>
                            <div class="book-status status-pending">
                                Pending
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="panel fade-in">
            <div class="panel-header">
                <h2 class="panel-title">
                    <i class="fas fa-tasks"></i> Librarian Quick Actions
                </h2>
            </div>
            <div class="quick-actions">
                <a href="#" class="action-btn">
                    <i class="fas fa-plus"></i>
                    Add New Book
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-book"></i>
                    Book Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-hand-holding"></i>
                    Circulation Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-users"></i>
                    Member Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-bookmark"></i>
                    Reservation Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-chart-line"></i>
                    Library Reports
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-search"></i>
                    Catalog Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-boxes"></i>
                    Library Inventory Portal
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
        const cards = document.querySelectorAll('.stat-card, .book-item');
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


