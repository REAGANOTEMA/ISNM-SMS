<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin' || $_SESSION['department'] !== 'director-academic') {
    header('Location: login.php');
    exit();
}

include 'config.php';

// Get director information
$director_info = [];
try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ? AND role = 'admin' AND department = 'director-academic'");
    $stmt->execute([$_SESSION['user_id']]);
    $director_info = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching director info: " . $e->getMessage());
}

// Get academic statistics
$academic_stats = [];
try {
    // Total students by program
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM users WHERE role = 'student' AND program = 'nursing'");
    $academic_stats['nursing_students'] = $stmt->fetchColumn();
    
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM users WHERE role = 'student' AND program = 'midwifery'");
    $academic_stats['midwifery_students'] = $stmt->fetchColumn();
    
    // Total teaching staff
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM users WHERE role IN ('lecturer', 'tutor')");
    $academic_stats['teaching_staff'] = $stmt->fetchColumn();
    
    // Active courses
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM courses WHERE status = 'active'");
    $academic_stats['active_courses'] = $stmt->fetchColumn();
    
    // Recent exams
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM exams WHERE exam_date >= DATE_SUB(NOW(), INTERVAL 30 DAY)");
    $academic_stats['recent_exams'] = $stmt->fetchColumn();
} catch (PDOException $e) {
    error_log("Error fetching academic statistics: " . . $e->getMessage());
}

// Get academic departments
$academic_departments = [];
try {
    $stmt = $pdo->query("
        SELECT department, COUNT(*) as staff_count,
               SUM(CASE WHEN role = 'lecturer' THEN 1 ELSE 0 END) as lecturer_count,
               SUM(CASE WHEN role = 'lecturer' AND department LIKE '%nursing%' THEN 1 ELSE 0 END) as nursing_lecturers,
               SUM(CASE WHEN role = 'lecturer' AND department LIKE '%midwifery%' THEN 1 ELSE 0 END) as midwifery_lecturers
        FROM users 
        WHERE role IN ('lecturer', 'tutor') AND department IS NOT NULL 
        GROUP BY department 
        ORDER BY staff_count DESC
    ");
    $academic_departments = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching academic departments: " . $e->getMessage());
}

// Get recent academic activities
$academic_activities = [];
try {
    $stmt = $pdo->query("
        SELECT al.*, u.username 
        FROM activity_log al 
        LEFT JOIN users u ON al.user_id = u.id 
        WHERE al.action LIKE '%exam%' OR al.action LIKE '%course%' OR al.action LIKE '%grade%' 
        ORDER BY al.created_at DESC 
        LIMIT 10
    ");
    $academic_activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching academic activities: " . $e->getMessage());
}

// Get course statistics
$course_stats = [];
try {
    $stmt = $pdo->query("
        SELECT c.course_name, c.program, COUNT(e.id) as enrolled_students,
               AVG(g.grade) as average_grade
        FROM courses c
        LEFT JOIN enrollments e ON c.id = e.course_id
        LEFT JOIN grades g ON e.id = g.enrollment_id
        WHERE c.status = 'active'
        GROUP BY c.id, c.course_name, c.program
        ORDER BY enrolled_students DESC
        LIMIT 10
    ");
    $course_stats = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching course statistics: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Director Dashboard - Academic Affairs | ISNM</title>
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

        .department-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
        }

        .department-card {
            background: var(--white);
            border: 1px solid var(--soft-gray);
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .department-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-blue);
        }

        .department-name {
            font-weight: 600;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
        }

        .department-count {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--golden-yellow);
        }

        .course-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .course-table th,
        .course-table td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid var(--soft-gray);
        }

        .course-table th {
            background: var(--gradient-primary);
            color: white;
            font-weight: 600;
        }

        .course-table tr:hover {
            background: var(--light-gray);
        }

        .program-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .program-nursing {
            background: var(--gradient-primary);
            color: white;
        }

        .program-midwifery {
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
                <a href="dashboard-director-academic.php" class="nav-link">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-graduation-cap"></i> Courses
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-clipboard-list"></i> Exams
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-chart-line"></i> Reports
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="user-menu">
                    <i class="fas fa-user"></i>
                    <span><?php echo htmlspecialchars($director_info['username'] ?? 'Academic Director'); ?></span>
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
                <h1 class="header-title">DIRECTOR - ACADEMIC AFFAIRS</h1>
                <p class="header-subtitle">Academic Excellence & Educational Innovation</p>
            </div>
        </header>

        <div class="stats-grid fade-in">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-user-nurse"></i>
                </div>
                <div class="stat-value"><?php echo number_format($academic_stats['nursing_students'] ?? 0); ?></div>
                <div class="stat-label">Nursing Students</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-baby"></i>
                </div>
                <div class="stat-value"><?php echo number_format($academic_stats['midwifery_students'] ?? 0); ?></div>
                <div class="stat-label">Midwifery Students</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <div class="stat-value"><?php echo number_format($academic_stats['teaching_staff'] ?? 0); ?></div>
                <div class="stat-label">Teaching Staff</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-book"></i>
                </div>
                <div class="stat-value"><?php echo number_format($academic_stats['active_courses'] ?? 0); ?></div>
                <div class="stat-label">Active Courses</div>
            </div>
        </div>

        <div class="content-grid fade-in">
            <div class="panel">
                <div class="panel-header">
                    <h2 class="panel-title">
                        <i class="fas fa-university"></i> Academic Departments
                    </h2>
                    <a href="#" class="nav-link">View All</a>
                </div>
                <div class="department-grid">
                    <?php foreach ($academic_departments as $dept): ?>
                        <div class="department-card" onclick="window.location.href='#'">
                            <div class="department-name"><?php echo htmlspecialchars(ucwords(str_replace('-', ' ', $dept['department']))); ?></div>
                            <div class="department-count"><?php echo $dept['staff_count']; ?></div>
                            <div style="font-size: 0.8rem; color: var(--text-muted);">
                                <?php echo $dept['lecturer_count']; ?> Lecturers
                                <?php if ($dept['nursing_lecturers'] > 0) echo ' | ' . $dept['nursing_lecturers'] . ' Nursing'; ?>
                                <?php if ($dept['midwifery_lecturers'] > 0) echo ' | ' . $dept['midwifery_lecturers'] . ' Midwifery'; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="panel">
                <div class="panel-header">
                    <h2 class="panel-title">
                        <i class="fas fa-history"></i> Academic Activities
                    </h2>
                    <a href="#" class="nav-link">View All</a>
                </div>
                <div class="activity-list">
                    <?php foreach ($academic_activities as $activity): ?>
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-text">
                                    <?php echo htmlspecialchars($activity['username'] ?? 'System'); ?> 
                                    <?php echo htmlspecialchars($activity['action'] ?? 'performed academic action'); ?>
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
                    <i class="fas fa-book-open"></i> Course Performance
                </h2>
                <a href="#" class="nav-link">View All Courses</a>
            </div>
            <div class="course-table-container">
                <table class="course-table">
                    <thead>
                        <tr>
                            <th>Course Name</th>
                            <th>Program</th>
                            <th>Enrolled</th>
                            <th>Avg Grade</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($course_stats as $course): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($course['course_name']); ?></td>
                                <td>
                                    <span class="program-badge program-<?php echo $course['program']; ?>">
                                        <?php echo ucfirst($course['program']); ?>
                                    </span>
                                </td>
                                <td><?php echo $course['enrolled_students']; ?></td>
                                <td><?php echo number_format($course['average_grade'], 1); ?>%</td>
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

        <div class="panel fade-in">
            <div class="panel-header">
                <h2 class="panel-title">
                    <i class="fas fa-bolt"></i> Academic Quick Actions
                </h2>
            </div>
            <div class="quick-actions">
                <a href="#" class="action-btn">
                    <i class="fas fa-plus-circle"></i>
                    Create New Course
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-clipboard-check"></i>
                    Schedule Exam
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-chart-bar"></i>
                    Generate Reports
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-user-graduate"></i>
                    Student Enrollment
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-award"></i>
                    Academic Awards
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-calendar-alt"></i>
                    Academic Calendar
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
        const cards = document.querySelectorAll('.stat-card, .department-card, .activity-item');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Auto-refresh academic data every 30 seconds
        setInterval(() => {
            // Refresh academic activities
            fetch('api/academic-activities.php')
                .then(response => response.json())
                .then(data => {
                    // Update activity list
                    console.log('Academic activities refreshed');
                })
                .catch(error => console.error('Error refreshing academic activities:', error));
        }, 30000);
    </script>
</body>
</html>


