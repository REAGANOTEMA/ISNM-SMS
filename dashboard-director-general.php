<?php
// Start session
session_start();

// Check if user is logged in and is director-general
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'director-general') {
    header('Location: login-portal.php');
    exit();
}

// Mock Director General data - in production, this would come from database
$director_general = [
    'id' => 'DIR001',
    'name' => 'Dr. John Smith',
    'position' => 'Director General',
    'email' => 'director-general@isnm.ac.ug',
    'phone' => '+256 772 514 889',
    'department' => 'Executive Management',
    'join_date' => '2020-01-15',
    'office' => 'Director General Office',
    'reporting_to' => 'Board of Governors'
];

// Mock statistics for dashboard
$stats = [
    'total_students' => 1250,
    'total_staff' => 85,
    'academic_programs' => 6,
    'annual_budget' => 'UGX 2.5B',
    'approval_rate' => 94.5,
    'institution_ranking' => '#3 in Uganda'
];

// Mock recent activities
$recent_activities = [
    ['title' => 'Board Meeting Scheduled', 'time' => '2 hours ago', 'type' => 'meeting'],
    ['title' => 'Budget Review Completed', 'time' => '5 hours ago', 'type' => 'finance'],
    ['title' => 'New Partnership Signed', 'time' => '1 day ago', 'type' => 'partnership'],
    ['title' => 'Accreditation Report Submitted', 'time' => '2 days ago', 'type' => 'academic'],
    ['title' => 'Staff Promotion Approved', 'time' => '3 days ago', 'type' => 'hr']
];

// Mock pending approvals
$pending_approvals = [
    ['title' => 'Q4 Budget Allocation', 'department' => 'Finance', 'priority' => 'high'],
    ['title' => 'New Curriculum Proposal', 'department' => 'Academics', 'priority' => 'medium'],
    ['title' => 'Staff Recruitment Plan', 'department' => 'HR', 'priority' 'medium'],
    ['title' => 'Infrastructure Project', 'department' => 'Administration', 'priority' => 'low']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Director General Dashboard - ISNM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            /* Director General Luxury Theme */
            --primary-dark: #1a1a1a;
            --luxury-gold: #D4AF37;
            --champagne: #F7E7CE;
            --platinum: #E5E4E2;
            --royal-blue: #1A237E;
            --white: #FFFFFF;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            
            /* Gradients */
            --gradient-luxury: linear-gradient(135deg, var(--luxury-gold) 0%, var(--champagne) 50%, var(--platinum) 100%);
            --gradient-director: linear-gradient(135deg, var(--primary-dark) 0%, var(--royal-blue) 50%, var(--luxury-gold) 100%);
            --gradient-hero: linear-gradient(135deg, var(--luxury-gold) 0%, var(--primary-dark) 100%);
            
            /* Shadows */
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 8px rgba(0, 0, 0, 0.15);
            --shadow-lg: 0 8px 16px rgba(0, 0, 0, 0.2);
            --shadow-xl: 0 20px 40px rgba(0, 0, 0, 0.25);
            --shadow-luxury: 0 8px 16px rgba(212, 175, 55, 0.3);
            
            /* Spacing */
            --space-4: 1rem;
            --space-6: 1.5rem;
            --space-8: 2rem;
            --space-12: 3rem;
            
            /* Border Radius */
            --radius-lg: 0.5rem;
            --radius-xl: 0.75rem;
            --radius-2xl: 1rem;
            --radius-full: 9999px;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, var(--gray-50) 0%, var(--white) 50%, var(--champagne) 100%);
            min-height: 100vh;
            color: var(--gray-800);
        }

        /* Header */
        .header {
            background: var(--gradient-director);
            color: var(--white);
            padding: var(--space-6) 0;
            box-shadow: var(--shadow-luxury);
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="luxury-pattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23luxury-pattern)"/></svg>');
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
            border: 3px solid var(--luxury-gold);
            background: var(--gradient-luxury);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
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
            background: var(--gradient-luxury);
            color: var(--primary-dark);
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
            box-shadow: var(--shadow-luxury);
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
            background: var(--gradient-luxury);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto var(--space-4);
            font-size: 1.5rem;
            color: var(--primary-dark);
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
            color: var(--luxury-gold);
            transform: translateX(4px);
        }

        .nav-link.active {
            background: var(--gradient-luxury);
            color: var(--primary-dark);
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
            background: var(--gradient-luxury);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-xl);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: var(--radius-full);
            background: var(--gradient-luxury);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: var(--space-4);
            color: var(--primary-dark);
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
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: var(--space-6);
        }

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

        .activity-list {
            list-style: none;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: var(--space-4);
            padding: var(--space-4);
            border-radius: var(--radius-lg);
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }

        .activity-item:hover {
            background: var(--gray-50);
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-full);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }

        .activity-icon.meeting {
            background: linear-gradient(135deg, #3B82F6, #1E40AF);
            color: white;
        }

        .activity-icon.finance {
            background: linear-gradient(135deg, #10B981, #047857);
            color: white;
        }

        .activity-icon.partnership {
            background: linear-gradient(135deg, #F59E0B, #D97706);
            color: white;
        }

        .activity-icon.academic {
            background: linear-gradient(135deg, #8B5CF6, #6D28D9);
            color: white;
        }

        .activity-icon.hr {
            background: linear-gradient(135deg, #EF4444, #B91C1C);
            color: white;
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-weight: 600;
            color: var(--gray-800);
            margin-bottom: 0.25rem;
        }

        .activity-time {
            font-size: 0.8rem;
            color: var(--gray-600);
        }

        /* Approval List */
        .approval-list {
            list-style: none;
        }

        .approval-item {
            padding: var(--space-4);
            border-radius: var(--radius-lg);
            margin-bottom: 0.5rem;
            border: 1px solid var(--gray-200);
            transition: all 0.3s ease;
        }

        .approval-item:hover {
            border-color: var(--luxury-gold);
            box-shadow: var(--shadow-sm);
        }

        .approval-title {
            font-weight: 600;
            color: var(--gray-800);
            margin-bottom: 0.5rem;
        }

        .approval-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.8rem;
        }

        .approval-department {
            color: var(--gray-600);
        }

        .priority-badge {
            padding: 0.25rem 0.5rem;
            border-radius: var(--radius-full);
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .priority-high {
            background: #FEE2E2;
            color: #B91C1C;
        }

        .priority-medium {
            background: #FEF3C7;
            color: #D97706;
        }

        .priority-low {
            background: #F0FDF4;
            color: #047857;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .dashboard-layout {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: static;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
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
                        <?php echo strtoupper(substr($director_general['name'], 0, 2)); ?>
                    </div>
                    <div class="user-details">
                        <h1><?php echo htmlspecialchars($director_general['name']); ?></h1>
                        <p><?php echo htmlspecialchars($director_general['position']); ?></p>
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
                    <i class="fas fa-crown"></i>
                </div>
                <h3>Director General</h3>
                <p style="font-size: 0.8rem; color: var(--gray-600);">Executive Office</p>
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
                            <span>Board Management</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-chart-line"></i>
                            <span>Strategic Planning</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-coins"></i>
                            <span>Budget Oversight</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-handshake"></i>
                            <span>Partnerships</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-award"></i>
                            <span>Accreditation</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-file-alt"></i>
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
                    <div class="stat-value"><?php echo number_format($stats['total_students']); ?></div>
                    <div class="stat-label">Total Students</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-value"><?php echo number_format($stats['total_staff']); ?></div>
                    <div class="stat-label">Total Staff</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="stat-value"><?php echo $stats['academic_programs']; ?></div>
                    <div class="stat-label">Academic Programs</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-coins"></i>
                    </div>
                    <div class="stat-value"><?php echo $stats['annual_budget']; ?></div>
                    <div class="stat-label">Annual Budget</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-value"><?php echo $stats['approval_rate']; ?>%</div>
                    <div class="stat-label">Approval Rate</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div class="stat-value"><?php echo $stats['institution_ranking']; ?></div>
                    <div class="stat-label">National Ranking</div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="content-grid">
                <!-- Recent Activities -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Recent Activities</h2>
                        <a href="#" class="btn btn-primary">
                            <i class="fas fa-eye"></i>
                            View All
                        </a>
                    </div>
                    <ul class="activity-list">
                        <?php foreach ($recent_activities as $activity): ?>
                            <li class="activity-item">
                                <div class="activity-icon <?php echo $activity['type']; ?>">
                                    <?php
                                    $icons = [
                                        'meeting' => 'fas fa-users',
                                        'finance' => 'fas fa-coins',
                                        'partnership' => 'fas fa-handshake',
                                        'academic' => 'fas fa-graduation-cap',
                                        'hr' => 'fas fa-user-tie'
                                    ];
                                    echo '<i class="' . $icons[$activity['type']] . '"></i>';
                                    ?>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title"><?php echo htmlspecialchars($activity['title']); ?></div>
                                    <div class="activity-time"><?php echo htmlspecialchars($activity['time']); ?></div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Pending Approvals -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Pending Approvals</h2>
                        <span style="background: var(--gradient-luxury); color: var(--primary-dark); padding: 0.25rem 0.75rem; border-radius: var(--radius-full); font-size: 0.8rem; font-weight: 600;">
                            <?php echo count($pending_approvals); ?> Items
                        </span>
                    </div>
                    <ul class="approval-list">
                        <?php foreach ($pending_approvals as $approval): ?>
                            <li class="approval-item">
                                <div class="approval-title"><?php echo htmlspecialchars($approval['title']); ?></div>
                                <div class="approval-meta">
                                    <span class="approval-department"><?php echo htmlspecialchars($approval['department']); ?></span>
                                    <span class="priority-badge priority-<?php echo $approval['priority']; ?>">
                                        <?php echo $approval['priority']; ?>
                                    </span>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
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
