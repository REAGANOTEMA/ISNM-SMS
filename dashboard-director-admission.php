<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin' || $_SESSION['department'] !== 'director-admission') {
    header('Location: login.php');
    exit();
}

include 'config.php';

// Get director information
$director_info = [];
try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ? AND role = 'admin' AND department = 'director-admission'");
    $stmt->execute([$_SESSION['user_id']]);
    $director_info = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching director info: " . $e->getMessage());
}

// Get admission statistics
$admission_stats = [];
try {
    // Total applications this year
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM applications WHERE YEAR(application_date) = YEAR(CURRENT_DATE)");
    $admission_stats['total_applications'] = $stmt->fetchColumn();
    
    // Approved applications
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM applications WHERE YEAR(application_date) = YEAR(CURRENT_DATE) AND status = 'approved'");
    $admission_stats['approved_applications'] = $stmt->fetchColumn();
    
    // Pending applications
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM applications WHERE YEAR(application_date) = YEAR(CURRENT_DATE) AND status = 'pending'");
    $admission_stats['pending_applications'] = $stmt->fetchColumn();
    
    // Rejected applications
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM applications WHERE YEAR(application_date) = YEAR(CURRENT_DATE) AND status = 'rejected'");
    $admission_stats['rejected_applications'] = $stmt->fetchColumn();
    
    // Total enrolled students
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM users WHERE role = 'student' AND YEAR(created_at) = YEAR(CURRENT_DATE)");
    $admission_stats['enrolled_students'] = $stmt->fetchColumn();
} catch (PDOException $e) {
    error_log("Error fetching admission statistics: " . $e->getMessage());
}

// Get recent applications
$recent_applications = [];
try {
    $stmt = $pdo->query("
        SELECT a.*, u.username as processed_by
        FROM applications a
        LEFT JOIN users u ON a.processed_by = u.id
        ORDER BY a.application_date DESC
        LIMIT 10
    ");
    $recent_applications = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching recent applications: " . $e->getMessage());
}

// Get admission requirements
$admission_requirements = [];
try {
    $stmt = $pdo->query("
        SELECT requirement_name, requirement_type, is_mandatory, description
        FROM admission_requirements
        WHERE is_active = 1
        ORDER BY requirement_type, requirement_name
    ");
    $admission_requirements = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching admission requirements: " . $e->getMessage());
}

// Get program statistics
$program_stats = [];
try {
    $stmt = $pdo->query("
        SELECT program, COUNT(*) as applications,
               SUM(CASE WHEN status = 'approved' THEN 1 ELSE 0 END) as approved,
               SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending
        FROM applications 
        WHERE YEAR(application_date) = YEAR(CURRENT_DATE)
        GROUP BY program
        ORDER BY applications DESC
    ");
    $program_stats = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching program statistics: " . $e->getMessage());
}

// Get admission staff
$admission_staff = [];
try {
    $stmt = $pdo->query("
        SELECT username, role, department, email, phone
        FROM users 
        WHERE department LIKE '%admission%' OR department LIKE '%registry%'
        ORDER BY role DESC, username
    ");
    $admission_staff = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching admission staff: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Director Dashboard - Requirements & Admission | ISNM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        .application-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .application-table th,
        .application-table td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid var(--soft-gray);
        }

        .application-table th {
            background: var(--gradient-primary);
            color: white;
            font-weight: 600;
        }

        .application-table tr:hover {
            background: var(--light-gray);
        }

        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-pending {
            background: var(--warning-orange);
            color: white;
        }

        .status-approved {
            background: var(--success-green);
            color: white;
        }

        .status-rejected {
            background: var(--danger-red);
            color: white;
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

        .requirements-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
        }

        .requirement-card {
            background: var(--white);
            border: 1px solid var(--soft-gray);
            border-radius: 12px;
            padding: 1rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .requirement-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-blue);
        }

        .requirement-name {
            font-weight: 600;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
        }

        .requirement-type {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
        }

        .requirement-description {
            font-size: 0.9rem;
            color: var(--text-light);
            margin-bottom: 0.5rem;
        }

        .requirement-mandatory {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .mandatory-yes {
            background: var(--danger-red);
            color: white;
        }

        .mandatory-no {
            background: var(--success-green);
            color: white;
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
                <a href="dashboard-director-admission.php" class="nav-link">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-user-plus"></i> Applications
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-clipboard-list"></i> Requirements
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-chart-line"></i> Reports
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="user-menu">
                    <i class="fas fa-user"></i>
                    <span><?php echo htmlspecialchars($director_info['username'] ?? 'Admission Director'); ?></span>
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
                <h1 class="header-title">DIRECTOR - REQUIREMENTS & ADMISSION</h1>
                <p class="header-subtitle">Student Recruitment & Admission Excellence</p>
            </div>
        </header>

        <div class="stats-grid fade-in">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="stat-value"><?php echo number_format($admission_stats['total_applications'] ?? 0); ?></div>
                <div class="stat-label">Total Applications</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-value"><?php echo number_format($admission_stats['approved_applications'] ?? 0); ?></div>
                <div class="stat-label">Approved Applications</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-value"><?php echo number_format($admission_stats['pending_applications'] ?? 0); ?></div>
                <div class="stat-label">Pending Applications</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="stat-value"><?php echo number_format($admission_stats['enrolled_students'] ?? 0); ?></div>
                <div class="stat-label">Enrolled Students</div>
            </div>
        </div>

        <div class="content-grid fade-in">
            <div class="panel">
                <div class="panel-header">
                    <h2 class="panel-title">
                        <i class="fas fa-file-alt"></i> Recent Applications
                    </h2>
                    <a href="#" class="nav-link">View All</a>
                </div>
                <div class="application-table-container">
                    <table class="application-table">
                        <thead>
                            <tr>
                                <th>Applicant</th>
                                <th>Program</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Processed By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recent_applications as $application): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($application['applicant_name']); ?></td>
                                    <td>
                                        <span class="program-badge program-<?php echo $application['program']; ?>">
                                            <?php echo ucfirst($application['program']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo date('M d, Y', strtotime($application['application_date'])); ?></td>
                                    <td>
                                        <span class="status-badge status-<?php echo $application['status']; ?>">
                                            <?php echo ucfirst($application['status']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo htmlspecialchars($application['processed_by'] ?? 'Not processed'); ?></td>
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
                        <i class="fas fa-users"></i> Admission Staff
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
                            <?php foreach ($admission_staff as $staff): ?>
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
        </div>

        <div class="panel fade-in">
            <div class="panel-header">
                <h2 class="panel-title">
                    <i class="fas fa-clipboard-list"></i> Admission Requirements
                </h2>
                <a href="#" class="nav-link">Manage Requirements</a>
            </div>
            <div class="requirements-grid">
                <?php foreach ($admission_requirements as $requirement): ?>
                    <div class="requirement-card" onclick="window.location.href='#'">
                        <div class="requirement-name"><?php echo htmlspecialchars($requirement['requirement_name']); ?></div>
                        <div class="requirement-type"><?php echo htmlspecialchars($requirement['requirement_type']); ?></div>
                        <div class="requirement-description"><?php echo htmlspecialchars($requirement['description']); ?></div>
                        <div class="requirement-mandatory mandatory-<?php echo $requirement['is_mandatory'] ? 'yes' : 'no'; ?>">
                            <?php echo $requirement['is_mandatory'] ? 'Mandatory' : 'Optional'; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="panel fade-in">
            <div class="panel-header">
                <h2 class="panel-title">
                    <i class="fas fa-chart-bar"></i> Program Statistics
                </h2>
                <a href="#" class="nav-link">View Details</a>
            </div>
            <div class="program-stats-container">
                <?php foreach ($program_stats as $program): ?>
                    <div style="margin-bottom: 1rem; padding: 1rem; background: var(--white); border-radius: 12px; border: 1px solid var(--soft-gray);">
                        <h4 style="color: var(--primary-blue); margin-bottom: 0.5rem;"><?php echo ucfirst($program['program']); ?></h4>
                        <div style="display: flex; gap: 2rem; font-size: 0.9rem;">
                            <span><strong>Total:</strong> <?php echo $program['applications']; ?></span>
                            <span style="color: var(--success-green);"><strong>Approved:</strong> <?php echo $program['approved']; ?></span>
                            <span style="color: var(--warning-orange);"><strong>Pending:</strong> <?php echo $program['pending']; ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="panel fade-in">
            <div class="panel-header">
                <h2 class="panel-title">
                    <i class="fas fa-bolt"></i> Admission Quick Actions
                </h2>
            </div>
            <div class="quick-actions">
                <a href="#" class="action-btn">
                    <i class="fas fa-user-plus"></i>
                    New Application
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-clipboard-check"></i>
                    Review Applications
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-file-export"></i>
                    Generate Reports
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-bullhorn"></i>
                    Send Notifications
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-calendar-alt"></i>
                    Admission Calendar
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
        const cards = document.querySelectorAll('.stat-card, .requirement-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Auto-refresh application data every 30 seconds
        setInterval(() => {
            // Refresh recent applications
            fetch('api/recent-applications.php')
                .then(response => response.json())
                .then(data => {
                    // Update application table
                    console.log('Applications refreshed');
                })
                .catch(error => console.error('Error refreshing applications:', error));
        }, 30000);
    </script>
</body>
</html>
