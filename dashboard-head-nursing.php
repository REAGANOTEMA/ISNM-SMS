<?php
// Start session
session_start();

// Check if user is logged in and is head-nursing
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'head-nursing') {
    header('Location: login-portal.php');
    exit();
}

// Mock Head of Nursing data
$head_nursing = [
    'id' => 'HN001',
    'name' => 'Prof. Mary Nakato',
    'position' => 'Head of Nursing Department',
    'email' => 'head-nursing@isnm.ac.ug',
    'phone' => '+256 772 514 889',
    'department' => 'Nursing Department',
    'join_date' => '2019-08-20',
    'office' => 'Nursing Department Office'
];

// Nursing statistics
$nursing_stats = [
    'nursing_students' => 750,
    'nursing_staff' => 18,
    'nursing_courses' => 24,
    'clinical_sites' => 12,
    'pass_rate' => 91.2,
    'employment_rate' => 94.5
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Head of Nursing Dashboard - ISNM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            /* Head of Nursing Theme */
            --primary-dark: #1a1a1a;
            --nursing-blue: #0891B2;
            --nursing-teal: #06B6D4;
            --medical-green: #10B981;
            --white: #FFFFFF;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            
            /* Gradients */
            --gradient-nursing: linear-gradient(135deg, var(--nursing-blue) 0%, var(--nursing-teal) 50%, var(--medical-green) 100%);
            --gradient-head: linear-gradient(135deg, var(--primary-dark) 0%, var(--nursing-blue) 50%, var(--nursing-teal) 100%);
            
            /* Shadows */
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 8px rgba(0, 0, 0, 0.15);
            --shadow-lg: 0 8px 16px rgba(0, 0, 0, 0.2);
            --shadow-nursing: 0 8px 16px rgba(8, 145, 178, 0.3);
            
            /* Spacing */
            --space-4: 1rem;
            --space-6: 1.5rem;
            --space-8: 2rem;
            
            /* Border Radius */
            --radius-lg: 0.5rem;
            --radius-xl: 0.75rem;
            --radius-2xl: 1rem;
            --radius-full: 9999px;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, var(--gray-50) 0%, var(--white) 50%, #F0FDFA 100%);
            min-height: 100vh;
            color: var(--gray-800);
        }

        /* Header */
        .header {
            background: var(--gradient-nursing);
            color: var(--white);
            padding: var(--space-6) 0;
            box-shadow: var(--shadow-nursing);
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="nursing-pattern" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M10 5 L10 15 M5 10 L15 10" stroke="rgba(255,255,255,0.1)" stroke-width="2"/></pattern></defs><rect width="100" height="100" fill="url(%23nursing-pattern)"/></svg>');
            opacity: 0.3;
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 var(--space-6);
            position: relative;
            z-index: 1;
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--space-4);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: var(--space-4);
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: var(--radius-full);
            border: 3px solid var(--nursing-teal);
            background: var(--gradient-nursing);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
            color: var(--white);
        }

        .user-details h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .user-details p {
            opacity: 0.9;
            font-size: 0.9rem;
        }

        .header-actions {
            display: flex;
            gap: var(--space-4);
        }

        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: var(--radius-lg);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: var(--gradient-nursing);
            color: var(--white);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.2);
            color: var(--white);
            backdrop-filter: blur(10px);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        /* Layout */
        .dashboard-layout {
            max-width: 1200px;
            margin: 0 auto;
            padding: var(--space-8) var(--space-6);
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: var(--space-8);
        }

        /* Sidebar */
        .sidebar {
            background: var(--white);
            border-radius: var(--radius-2xl);
            padding: var(--space-6);
            box-shadow: var(--shadow-nursing);
            height: fit-content;
            position: sticky;
            top: var(--space-8);
        }

        .sidebar-header {
            text-align: center;
            margin-bottom: var(--space-6);
            padding-bottom: var(--space-6);
            border-bottom: 1px solid var(--gray-200);
        }

        .sidebar-logo {
            width: 60px;
            height: 60px;
            border-radius: var(--radius-full);
            background: var(--gradient-nursing);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto var(--space-4);
            font-size: 1.5rem;
            color: var(--white);
        }

        .nav-menu {
            list-style: none;
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            padding: 0.75rem 1rem;
            border-radius: var(--radius-lg);
            color: var(--gray-700);
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .nav-link:hover {
            background: var(--gray-100);
            color: var(--nursing-blue);
            transform: translateX(4px);
        }

        .nav-link.active {
            background: var(--gradient-nursing);
            color: var(--white);
            font-weight: 600;
        }

        /* Main Content */
        .main-content {
            display: flex;
            flex-direction: column;
            gap: var(--space-8);
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: var(--space-6);
        }

        .stat-card {
            background: var(--white);
            border-radius: var(--radius-2xl);
            padding: var(--space-6);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--gray-200);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-nursing);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: var(--radius-full);
            background: var(--gradient-nursing);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: var(--space-4);
            color: var(--white);
            font-size: 1.2rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--gray-600);
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Content Cards */
        .card {
            background: var(--white);
            border-radius: var(--radius-2xl);
            padding: var(--space-6);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--gray-200);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--space-6);
            padding-bottom: var(--space-4);
            border-bottom: 1px solid var(--gray-200);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary-dark);
        }

        /* Quick Actions */
        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: var(--space-6);
        }

        .action-card {
            background: var(--white);
            border-radius: var(--radius-2xl);
            padding: var(--space-6);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            transition: all 0.3s ease;
            cursor: pointer;
            text-align: center;
        }

        .action-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-nursing);
            border-color: var(--nursing-blue);
        }

        .action-icon {
            width: 60px;
            height: 60px;
            border-radius: var(--radius-full);
            background: var(--gradient-nursing);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto var(--space-4);
            font-size: 1.5rem;
            color: var(--white);
        }

        .action-title {
            font-weight: 600;
            color: var(--gray-800);
            margin-bottom: 0.5rem;
        }

        .action-description {
            color: var(--gray-600);
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .dashboard-layout {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: static;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .actions-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <div class="header-top">
                <div class="user-info">
                    <div class="user-avatar">
                        <?php echo strtoupper(substr($head_nursing['name'], 0, 2)); ?>
                    </div>
                    <div class="user-details">
                        <h1><?php echo htmlspecialchars($head_nursing['name']); ?></h1>
                        <p><?php echo htmlspecialchars($head_nursing['position']); ?></p>
                    </div>
                </div>
                <div class="header-actions">
                    <a href="#" class="btn btn-secondary">
                        <i class="fas fa-bell"></i>
                        Notifications
                    </a>
                    <a href="login-portal.php" class="btn btn-primary">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Dashboard Layout -->
    <div class="dashboard-layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <i class="fas fa-user-nurse"></i>
                </div>
                <h3>Head of Nursing</h3>
                <p style="font-size: 0.8rem; color: var(--gray-600);">Nursing Department</p>
            </div>
            <nav>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-users"></i>
                            <span>Student Management</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <span>Faculty & Staff</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-book"></i>
                            <span>Course Management</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-hospital"></i>
                            <span>Clinical Sites</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-clipboard-check"></i>
                            <span>Assessments</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-chart-line"></i>
                            <span>Reports</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-cog"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Statistics Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="stat-value"><?php echo number_format($nursing_stats['nursing_students']); ?></div>
                    <div class="stat-label">Nursing Students</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="stat-value"><?php echo $nursing_stats['nursing_staff']; ?></div>
                    <div class="stat-label">Nursing Staff</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="stat-value"><?php echo $nursing_stats['nursing_courses']; ?></div>
                    <div class="stat-label">Nursing Courses</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-hospital"></i>
                    </div>
                    <div class="stat-value"><?php echo $nursing_stats['clinical_sites']; ?></div>
                    <div class="stat-label">Clinical Sites</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-value"><?php echo $nursing_stats['pass_rate']; ?>%</div>
                    <div class="stat-label">Pass Rate</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="stat-value"><?php echo $nursing_stats['employment_rate']; ?>%</div>
                    <div class="stat-label">Employment Rate</div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Nursing Department Actions</h2>
                    <a href="#" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        New Action
                    </a>
                </div>
                <div class="actions-grid">
                    <div class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="action-title">Student Admission</div>
                        <div class="action-description">Manage new nursing student admissions</div>
                    </div>
                    <div class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="action-title">Clinical Rotations</div>
                        <div class="action-description">Schedule clinical practice rotations</div>
                    </div>
                    <div class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <div class="action-title">Nursing Exams</div>
                        <div class="action-description">Conduct nursing examinations</div>
                    </div>
                    <div class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <div class="action-title">Skills Assessment</div>
                        <div class="action-description">Evaluate practical nursing skills</div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Add interactive features
        document.addEventListener('DOMContentLoaded', function() {
            // Animate stat cards on scroll
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animation = 'fadeInUp 0.6s ease-out';
                    }
                });
            });

            document.querySelectorAll('.stat-card').forEach(card => {
                observer.observe(card);
            });

            // Handle navigation clicks
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // Handle action card clicks
            document.querySelectorAll('.action-card').forEach(card => {
                card.addEventListener('click', function() {
                    // Add click animation
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);
                });
            });
        });

        // Add fadeInUp animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
