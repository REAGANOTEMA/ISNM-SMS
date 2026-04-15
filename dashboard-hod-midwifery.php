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
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'staff' || $_SESSION['department'] !== 'hod-midwifery') {
    header('Location: login.php');
    exit();
}

include 'config.php';

// Get HOD information
$hod_info = [];
try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ? AND role = 'staff' AND department = 'hod-midwifery'");
    $stmt->execute([$_SESSION['user_id']]);
    $hod_info = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching HOD info: " . $e->getMessage());
}

// Get Midwifery Department statistics
$midwifery_stats = [];
try {
    // Total midwifery students
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM users WHERE role = 'student' AND department = 'midwifery'");
    $midwifery_stats['total_students'] = $stmt->fetchColumn();
    
    // Midwifery courses
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM courses WHERE department = 'midwifery'");
    $midwifery_stats['total_courses'] = $stmt->fetchColumn();
    
    // Midwifery staff
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM users WHERE role = 'staff' AND department = 'midwifery'");
    $midwifery_stats['total_staff'] = $stmt->fetchColumn();
    
    // Active clinical instructors
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM users WHERE role = 'clinical-instructor' AND department = 'midwifery'");
    $midwifery_stats['clinical_instructors'] = $stmt->fetchColumn();
    
    // Pending assessments
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM student_assessments WHERE department = 'midwifery' AND status = 'pending'");
    $midwifery_stats['pending_assessments'] = $stmt->fetchColumn();
    
    // Clinical placements this month
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM clinical_placements WHERE department = 'midwifery' AND MONTH(start_date) = MONTH(CURRENT_DATE())");
    $midwifery_stats['clinical_placements_month'] = $stmt->fetchColumn();
    
    // Department budget utilization
    $stmt = $pdo->query("SELECT SUM(amount) as total FROM department_expenses WHERE department = 'midwifery' AND MONTH(expense_date) = MONTH(CURRENT_DATE())");
    $midwifery_stats['budget_utilization'] = $stmt->fetchColumn() ?? 0;
} catch (PDOException $e) {
    error_log("Error fetching Midwifery Department statistics: " . $e->getMessage());
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

// Get pending assessments
$pending_assessments = [];
try {
    $stmt = $pdo->query("
        SELECT sa.*, u.username as student_name, c.course_name
        FROM student_assessments sa
        LEFT JOIN users u ON sa.student_id = u.id
        LEFT JOIN courses c ON sa.course_id = c.id
        WHERE sa.department = 'midwifery' AND sa.status = 'pending'
        ORDER BY sa.created_at DESC
        LIMIT 5
    ");
    $pending_assessments = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching pending assessments: " . $e->getMessage());
}

// Get upcoming clinical placements
$upcoming_placements = [];
try {
    $stmt = $pdo->query("
        SELECT cp.*, u.username as student_name, f.facility_name
        FROM clinical_placements cp
        LEFT JOIN users u ON cp.student_id = u.id
        LEFT JOIN clinical_facilities f ON cp.facility_id = f.id
        WHERE cp.department = 'midwifery' AND cp.start_date >= CURDATE()
        ORDER BY cp.start_date ASC
        LIMIT 5
    ");
    $upcoming_placements = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching upcoming clinical placements: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Head of Department (Midwifery) Dashboard - ISNM</title>
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

        .assessment-list {
            max-height: 400px;
            overflow-y: auto;
        }

        .assessment-item {
            display: flex;
            align-items: start;
            gap: 1rem;
            padding: 1rem;
            border-bottom: 1px solid var(--soft-gray);
            transition: all 0.3s ease;
        }

        .assessment-item:hover {
            background: var(--light-gray);
        }

        .assessment-icon {
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

        .assessment-content {
            flex: 1;
        }

        .assessment-text {
            font-size: 0.9rem;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }

        .assessment-time {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .assessment-status {
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-pending {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning-orange);
        }

        .status-completed {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success-green);
        }

        .status-in-progress {
            background: rgba(59, 130, 246, 0.1);
            color: var(--ocean-blue);
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
                <a href="dashboard-hod-midwifery.php" class="nav-link">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-graduation-cap"></i> Academic Management
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-users"></i> Staff Management
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-user-graduate"></i> Student Management
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-book"></i> Course Management
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-baby"></i> Clinical Placements
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-chart-line"></i> Reports
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="user-menu">
                    <i class="fas fa-user"></i>
                    <span><?php echo htmlspecialchars($hod_info['username'] ?? 'HOD Midwifery'); ?></span>
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
                <h1 class="header-title">HEAD OF DEPARTMENT (MIDWIFERY)</h1>
                <p class="header-subtitle">Midwifery Department Leadership & Academic Excellence</p>
            </div>
        </header>

        <div class="stats-grid fade-in">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="stat-value"><?php echo number_format($midwifery_stats['total_students'] ?? 0); ?></div>
                <div class="stat-label">Total Midwifery Students</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-book"></i>
                </div>
                <div class="stat-value"><?php echo number_format($midwifery_stats['total_courses'] ?? 0); ?></div>
                <div class="stat-label">Midwifery Courses</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-value"><?php echo number_format($midwifery_stats['total_staff'] ?? 0); ?></div>
                <div class="stat-label">Midwifery Staff</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-stethoscope"></i>
                </div>
                <div class="stat-value"><?php echo number_format($midwifery_stats['clinical_instructors'] ?? 0); ?></div>
                <div class="stat-label">Clinical Instructors</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <div class="stat-value"><?php echo number_format($midwifery_stats['pending_assessments'] ?? 0); ?></div>
                <div class="stat-label">Pending Assessments</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-hospital"></i>
                </div>
                <div class="stat-value"><?php echo number_format($midwifery_stats['clinical_placements_month'] ?? 0); ?></div>
                <div class="stat-label">Clinical Placements This Month</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stat-value"><?php echo number_format($midwifery_stats['budget_utilization'] ?? 0); ?></div>
                <div class="stat-label">Budget Utilization (UGX)</div>
            </div>
        </div>

        <div class="content-grid fade-in">
            <div class="panel">
                <div class="panel-header">
                    <h2 class="panel-title">
                        <i class="fas fa-clipboard-check"></i> Pending Assessments
                    </h2>
                    <a href="#" class="nav-link">View All</a>
                </div>
                <div class="assessment-list">
                    <?php foreach ($pending_assessments as $assessment): ?>
                        <div class="assessment-item">
                            <div class="assessment-icon">
                                <i class="fas fa-clipboard-check"></i>
                            </div>
                            <div class="assessment-content">
                                <div class="assessment-text">
                                    <strong><?php echo htmlspecialchars($assessment['student_name'] ?? 'Unknown'); ?></strong>
                                    - <?php echo htmlspecialchars($assessment['course_name'] ?? 'Unknown Course'); ?>
                                </div>
                                <div class="assessment-time">
                                    Assessment Type: <?php echo htmlspecialchars($assessment['assessment_type'] ?? 'Not specified'); ?>
                                </div>
                                <div class="assessment-time">
                                    Due: <?php echo date('M d, Y', strtotime($assessment['due_date'])); ?>
                                </div>
                            </div>
                            <div class="assessment-status status-<?php echo htmlspecialchars($assessment['status'] ?? 'pending'); ?>">
                                <?php echo htmlspecialchars(ucfirst($assessment['status'] ?? 'Pending')); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="panel">
                <div class="panel-header">
                    <h2 class="panel-title">
                        <i class="fas fa-baby"></i> Upcoming Clinical Placements
                    </h2>
                    <a href="#" class="nav-link">View All</a>
                </div>
                <div class="assessment-list">
                    <?php foreach ($upcoming_placements as $placement): ?>
                        <div class="assessment-item">
                            <div class="assessment-icon">
                                <i class="fas fa-baby"></i>
                            </div>
                            <div class="assessment-content">
                                <div class="assessment-text">
                                    <strong><?php echo htmlspecialchars($placement['student_name'] ?? 'Unknown'); ?></strong>
                                    - <?php echo htmlspecialchars($placement['facility_name'] ?? 'Unknown Facility'); ?>
                                </div>
                                <div class="assessment-time">
                                    <?php echo date('M d, Y', strtotime($placement['start_date'])); ?> - 
                                    <?php echo date('M d, Y', strtotime($placement['end_date'])); ?>
                                </div>
                                <div class="assessment-time">
                                    Department: <?php echo htmlspecialchars($placement['department'] ?? 'Midwifery'); ?>
                                </div>
                            </div>
                            <div class="assessment-status status-pending">
                                Upcoming
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="panel fade-in">
            <div class="panel-header">
                <h2 class="panel-title">
                    <i class="fas fa-tasks"></i> HOD Quick Actions
                </h2>
            </div>
            <div class="quick-actions">
                <a href="#" class="action-btn">
                    <i class="fas fa-graduation-cap"></i>
                    Academic Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-users"></i>
                    Staff Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-user-graduate"></i>
                    Student Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-book"></i>
                    Course Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-baby"></i>
                    Clinical Placement Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-clipboard-check"></i>
                    Assessment Management
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-chart-line"></i>
                    Department Reports
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-boxes"></i>
                    Department Inventory Portal
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
        const cards = document.querySelectorAll('.stat-card, .assessment-item');
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
