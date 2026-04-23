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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organizational Structure - Iganga School of Nursing and Midwifery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            /* Professional Color Palette */
            --primary-dark: #0a1628;
            --secondary-dark: #1e3a5f;
            --accent-blue: #2563eb;
            --accent-cyan: #06b6d4;
            --accent-gold: #FFD700;
            --accent-gold-light: #fbbf24;
            --medical-blue: #0066cc;
            --medical-cyan: #00bcd4;
            --success-green: #22c55e;
            --error-red: #ef4444;
            
            /* Ultra-Premium Colors */
            --luxury-gold: #D4AF37;
            --platinum-silver: #E5E4E2;
            --royal-blue: #1A237E;
            --sapphire: #0F52BA;
            --diamond-white: #FAFAFA;
            --champagne: #F7E7CE;
            --pearl-white: #F8F6FF;
            --crystal-clear: rgba(255,255,255,0.95);
            
            /* Neutral Colors */
            --white: #ffffff;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            
            /* Premium Gradients */
            --gradient-primary: linear-gradient(135deg, var(--primary-dark) 0%, var(--accent-blue) 100%);
            --gradient-secondary: linear-gradient(135deg, var(--accent-blue) 0%, var(--accent-cyan) 100%);
            --gradient-gold: linear-gradient(135deg, var(--accent-gold) 0%, var(--accent-gold-light) 100%);
            --gradient-luxury: linear-gradient(135deg, var(--luxury-gold) 0%, var(--champagne) 50%, var(--platinum-silver) 100%);
            --gradient-royal: linear-gradient(135deg, var(--royal-blue) 0%, var(--sapphire) 50%, var(--accent-blue) 100%);
            --gradient-3d-primary: linear-gradient(135deg, var(--medical-blue), var(--medical-cyan));
            
            /* Shadows */
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.07), 0 2px 4px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1), 0 4px 6px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px rgba(0, 0, 0, 0.1), 0 10px 10px rgba(0, 0, 0, 0.04);
            --shadow-2xl: 0 25px 50px rgba(0, 0, 0, 0.25);
            --shadow-luxury-sm: 0 4px 8px rgba(212, 175, 55, 0.3);
            --shadow-luxury-md: 0 8px 16px rgba(212, 175, 55, 0.4);
            --shadow-luxury-lg: 0 12px 24px rgba(212, 175, 55, 0.5);
            --shadow-luxury-xl: 0 20px 40px rgba(212, 175, 55, 0.6);
            --shadow-royal-sm: 0 4px 8px rgba(26, 35, 126, 0.3);
            --shadow-royal-md: 0 8px 16px rgba(26, 35, 126, 0.4);
            --shadow-royal-lg: 0 12px 24px rgba(26, 35, 126, 0.5);
            --shadow-royal-xl: 0 20px 40px rgba(26, 35, 126, 0.6);
            
            /* Transitions */
            --transition-fast: 150ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-normal: 300ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-slow: 500ms cubic-bezier(0.4, 0, 0.2, 1);
            
            /* Spacing */
            --space-1: 0.25rem;
            --space-2: 0.5rem;
            --space-3: 0.75rem;
            --space-4: 1rem;
            --space-5: 1.25rem;
            --space-6: 1.5rem;
            --space-8: 2rem;
            --space-10: 2.5rem;
            --space-12: 3rem;
            --space-16: 4rem;
            --space-20: 5rem;
            
            /* Typography */
            --text-xs: 0.75rem;
            --text-sm: 0.875rem;
            --text-base: 1rem;
            --text-lg: 1.125rem;
            --text-xl: 1.25rem;
            --text-2xl: 1.5rem;
            --text-3xl: 1.875rem;
            --text-4xl: 2.25rem;
            
            /* Border Radius */
            --radius-sm: 0.25rem;
            --radius-md: 0.375rem;
            --radius-lg: 0.5rem;
            --radius-xl: 0.75rem;
            --radius-2xl: 1rem;
            --radius-full: 9999px;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            font-size: var(--text-base);
            line-height: 1.6;
            color: var(--text-primary);
            background: linear-gradient(135deg, var(--gray-50) 0%, var(--white) 50%, var(--gray-50) 100%);
            min-height: 100vh;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Navigation */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 2px solid var(--luxury-gold);
            z-index: 1000;
            padding: var(--space-4) 0;
            box-shadow: var(--shadow-lg);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 var(--space-6);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            font-weight: 700;
            font-size: var(--text-xl);
            color: var(--text-primary);
            text-decoration: none;
            font-family: 'Playfair Display', serif;
        }

        .nav-logo img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: var(--radius-full);
            border: 2px solid var(--luxury-gold);
        }

        .nav-links {
            display: flex;
            gap: var(--space-4);
            align-items: center;
        }

        .nav-link {
            color: var(--text-primary);
            text-decoration: none;
            font-weight: 600;
            font-size: var(--text-sm);
            padding: var(--space-2) var(--space-4);
            border-radius: var(--radius-lg);
            transition: all var(--transition-normal);
            border: 1px solid transparent;
        }

        .nav-link:hover {
            background: var(--gradient-primary);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .nav-link.active {
            background: var(--gradient-primary);
            color: var(--white);
        }

        /* Page Header */
        .page-header {
            margin-top: 80px;
            padding: var(--space-16) 0;
            background: var(--gradient-primary);
            color: var(--white);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="medical-pattern" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M10 5 L10 15 M5 10 L15 10" stroke="rgba(255,255,255,0.1)" stroke-width="2"/></pattern></defs><rect width="100" height="100" fill="url(%23medical-pattern)"/></svg>');
            opacity: 0.3;
        }

        .page-header-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
            padding: 0 var(--space-6);
        }

        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: var(--text-4xl);
            font-weight: 800;
            margin-bottom: var(--space-4);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .page-subtitle {
            font-size: var(--text-lg);
            opacity: 0.9;
            margin-bottom: var(--space-6);
        }

        .breadcrumb {
            font-size: var(--text-sm);
            opacity: 0.8;
        }

        /* Main Content */
        .main-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: var(--space-12) var(--space-6);
        }

        /* Organogram Container */
        .organogram-container {
            background: var(--white);
            border-radius: var(--radius-2xl);
            padding: var(--space-12);
            margin-bottom: var(--space-16);
            box-shadow: var(--shadow-xl);
            border: 1px solid var(--gray-200);
            position: relative;
        }

        .organogram-title {
            text-align: center;
            font-family: 'Playfair Display', serif;
            font-size: var(--text-3xl);
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: var(--space-8);
            position: relative;
        }

        .organogram-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: var(--gradient-gold);
            border-radius: var(--radius-full);
        }

        /* Organogram Levels */
        .org-level {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: var(--space-8);
            margin-bottom: var(--space-12);
            position: relative;
            flex-wrap: wrap;
        }

        .org-level::before {
            content: '';
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 30px;
            background: var(--gray-300);
        }

        .org-level.executive::before {
            display: none;
        }

        /* Position Cards */
        .position-card {
            background: var(--white);
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-xl);
            padding: var(--space-6);
            min-width: 220px;
            max-width: 280px;
            box-shadow: var(--shadow-lg);
            transition: all var(--transition-normal);
            cursor: pointer;
            position: relative;
            text-align: center;
            transform-style: preserve-3d;
            text-decoration: none;
            color: inherit;
        }

        .position-card:hover {
            transform: translateY(-8px) scale(1.05);
            box-shadow: var(--shadow-2xl);
        }

        .position-card.executive {
            border-color: var(--luxury-gold);
            background: linear-gradient(145deg, var(--white), var(--champagne));
            box-shadow: var(--shadow-luxury-lg);
        }

        .position-card.executive:hover {
            box-shadow: var(--shadow-luxury-xl);
            border-color: var(--luxury-gold);
        }

        .position-card.management {
            border-color: var(--royal-blue);
            background: linear-gradient(145deg, var(--white), var(--pearl-white));
            box-shadow: var(--shadow-royal-lg);
        }

        .position-card.management:hover {
            box-shadow: var(--shadow-royal-xl);
            border-color: var(--royal-blue);
        }

        .position-card.operational {
            border-color: var(--accent-blue);
            background: linear-gradient(145deg, var(--white), var(--gray-50));
            box-shadow: var(--shadow-lg);
        }

        .position-card.operational:hover {
            box-shadow: var(--shadow-xl);
            border-color: var(--accent-blue);
        }

        .position-card.student {
            border-color: var(--success-green);
            background: linear-gradient(145deg, var(--white), #f0fdf4);
            box-shadow: var(--shadow-lg);
        }

        .position-card.student:hover {
            box-shadow: var(--shadow-xl);
            border-color: var(--success-green);
        }

        /* Position Icon */
        .position-icon {
            width: 70px;
            height: 70px;
            border-radius: var(--radius-full);
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto var(--space-4);
            font-size: 1.8rem;
            color: var(--white);
            box-shadow: var(--shadow-md);
            transition: all var(--transition-normal);
            position: relative;
        }

        .position-card.executive .position-icon {
            background: var(--gradient-luxury);
            box-shadow: var(--shadow-luxury-md);
        }

        .position-card.management .position-icon {
            background: var(--gradient-royal);
            box-shadow: var(--shadow-royal-md);
        }

        .position-card.operational .position-icon {
            background: var(--gradient-3d-primary);
            box-shadow: var(--shadow-md);
        }

        .position-card.student .position-icon {
            background: linear-gradient(135deg, var(--success-green), #22c55e);
            box-shadow: var(--shadow-md);
        }

        .position-icon:hover {
            transform: scale(1.1) rotate(5deg);
        }

        /* Position Content */
        .position-title {
            font-family: 'Playfair Display', serif;
            font-size: var(--text-xl);
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: var(--space-2);
        }

        .position-subtitle {
            color: var(--text-secondary);
            font-size: var(--text-sm);
            margin-bottom: var(--space-4);
            font-weight: 500;
        }

        .position-roles {
            display: grid;
            grid-template-columns: 1fr;
            gap: var(--space-2);
            text-align: left;
        }

        .role-item {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            font-size: var(--text-xs);
            color: var(--text-secondary);
            padding: var(--space-2);
            background: var(--gray-50);
            border-radius: var(--radius-md);
            transition: all var(--transition-fast);
        }

        .position-card:hover .role-item {
            background: var(--gray-100);
        }

        .role-item i {
            color: var(--accent-blue);
            width: 16px;
            text-align: center;
            font-size: 0.8rem;
        }

        /* Login Badge */
        .login-badge {
            position: absolute;
            top: -10px;
            right: -10px;
            background: var(--gradient-gold);
            color: var(--white);
            padding: var(--space-1) var(--space-3);
            border-radius: var(--radius-full);
            font-size: var(--text-xs);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            box-shadow: var(--shadow-md);
            display: flex;
            align-items: center;
            gap: var(--space-1);
        }

        .position-card:hover .login-badge {
            transform: scale(1.1);
            box-shadow: var(--shadow-lg);
        }

        /* Connection Lines */
        .connection-lines {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            z-index: -1;
        }

        /* Footer */
        .footer {
            background: var(--primary-dark);
            color: var(--white);
            padding: var(--space-12) 0;
            text-align: center;
            margin-top: var(--space-20);
        }

        .footer-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 var(--space-6);
        }

        .footer-title {
            font-family: 'Playfair Display', serif;
            font-size: var(--text-2xl);
            font-weight: 700;
            margin-bottom: var(--space-4);
        }

        .footer-subtitle {
            font-size: var(--text-lg);
            opacity: 0.9;
            margin-bottom: var(--space-8);
        }

        .contact-buttons {
            display: flex;
            justify-content: center;
            gap: var(--space-4);
            flex-wrap: wrap;
        }

        .whatsapp-button {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            background: #25D366;
            color: var(--white);
            text-decoration: none;
            padding: var(--space-3) var(--space-6);
            border-radius: var(--radius-lg);
            font-weight: 600;
            transition: all var(--transition-normal);
            box-shadow: var(--shadow-lg);
        }

        .whatsapp-button:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-xl);
            background: #128C7E;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .mobile-menu-toggle {
                display: flex;
            }

            .page-header {
                margin-top: 60px;
                padding: var(--space-12) 0;
            }

            .page-title {
                font-size: var(--text-3xl);
            }

            .main-content {
                padding: var(--space-8) var(--space-4);
            }

            .org-level {
                flex-direction: column;
                align-items: center;
                gap: var(--space-6);
            }

            .position-card {
                min-width: 200px;
                max-width: 100%;
            }

            .contact-buttons {
                flex-direction: column;
            }
        }

        /* Animations */
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

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        .position-card {
            animation: fadeIn 0.8s ease-out;
        }

        .position-card:nth-child(1) { animation-delay: 0.1s; }
        .position-card:nth-child(2) { animation-delay: 0.2s; }
        .position-card:nth-child(3) { animation-delay: 0.3s; }
        .position-card:nth-child(4) { animation-delay: 0.4s; }
        .position-card:nth-child(5) { animation-delay: 0.5s; }
        .position-card:nth-child(6) { animation-delay: 0.6s; }

        .login-badge {
            animation: pulse 2s infinite;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="nav-logo">
                <img src="assets/school-logo.png" alt="ISNM Logo">
                <span>ISNM</span>
            </a>
            
            <div class="nav-links">
                <a href="index.php" class="nav-link">Home</a>
                <a href="about.php" class="nav-link">About</a>
                <a href="programs.php" class="nav-link">Programs</a>
                <a href="admissions.php" class="nav-link">Admissions</a>
                <a href="contact.php" class="nav-link">Contact</a>
                <a href="organogram.php" class="nav-link active">Organogram</a>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <header class="page-header">
        <div class="page-header-content">
            <h1 class="page-title">ISNM Organizational Structure</h1>
            <p class="page-subtitle">Click on your position to access your personalized dashboard</p>
            <div class="breadcrumb">Home / Organizational Structure</div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="organogram-container">
            <h2 class="organogram-title">Executive Leadership</h2>
            
            <!-- Executive Level -->
            <div class="org-level executive">
                <a href="login.php?role=director-general" class="position-card executive">
                    <div class="login-badge">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </div>
                    <div class="position-icon">
                        <i class="fas fa-crown"></i>
                    </div>
                    <h3 class="position-title">Director General</h3>
                    <p class="position-subtitle">Chief Executive Officer</p>
                    <div class="position-roles">
                        <div class="role-item">
                            <i class="fas fa-star"></i>
                            <span>Overall Institution Leadership</span>
                        </div>
                    </div>
                </a>

                <a href="login.php?role=director-academics" class="position-card executive">
                    <div class="login-badge">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </div>
                    <div class="position-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3 class="position-title">Director Academics</h3>
                    <p class="position-subtitle">Academic Affairs Director</p>
                    <div class="position-roles">
                        <div class="role-item">
                            <i class="fas fa-book"></i>
                            <span>Academic Programs Oversight</span>
                        </div>
                    </div>
                </a>

                <a href="login.php?role=director-ict" class="position-card executive">
                    <div class="login-badge">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </div>
                    <div class="position-icon">
                        <i class="fas fa-laptop"></i>
                    </div>
                    <h3 class="position-title">Director ICT</h3>
                    <p class="position-subtitle">Technology Director</p>
                    <div class="position-roles">
                        <div class="role-item">
                            <i class="fas fa-server"></i>
                            <span>IT Infrastructure & Systems</span>
                        </div>
                    </div>
                </a>

                <a href="login.php?role=director-finance" class="position-card executive">
                    <div class="login-badge">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </div>
                    <div class="position-icon">
                        <i class="fas fa-coins"></i>
                    </div>
                    <h3 class="position-title">Director Finance</h3>
                    <p class="position-subtitle">Financial Affairs Director</p>
                    <div class="position-roles">
                        <div class="role-item">
                            <i class="fas fa-chart-line"></i>
                            <span>Financial Management</span>
                        </div>
                    </div>
                </a>
            </div>

            <h2 class="organogram-title">School Management</h2>
            
            <!-- Management Level -->
            <div class="org-level">
                <a href="login.php?role=principal" class="position-card management">
                    <div class="login-badge">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </div>
                    <div class="position-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h3 class="position-title">School Principal</h3>
                    <p class="position-subtitle">Chief Academic Officer</p>
                    <div class="position-roles">
                        <div class="role-item">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <span>Academic Leadership</span>
                        </div>
                    </div>
                </a>

                <a href="login.php?role=deputy-principal" class="position-card management">
                    <div class="login-badge">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </div>
                    <div class="position-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h3 class="position-title">Deputy Principal</h3>
                    <p class="position-subtitle">Assistant Academic Officer</p>
                    <div class="position-roles">
                        <div class="role-item">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <span>Academic Support</span>
                        </div>
                    </div>
                </a>

                <a href="login.php?role=school-bursar" class="position-card management">
                    <div class="login-badge">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </div>
                    <div class="position-icon">
                        <i class="fas fa-coins"></i>
                    </div>
                    <h3 class="position-title">School Bursar</h3>
                    <p class="position-subtitle">Chief Financial Officer</p>
                    <div class="position-roles">
                        <div class="role-item">
                            <i class="fas fa-money-bill-wave"></i>
                            <span>Financial Operations</span>
                        </div>
                    </div>
                </a>
            </div>

            <h2 class="organogram-title">Administrative Staff</h2>
            
            <!-- Administrative Level -->
            <div class="org-level">
                <a href="login.php?role=academic-registrar" class="position-card management">
                    <div class="login-badge">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </div>
                    <div class="position-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h3 class="position-title">Academic Registrar</h3>
                    <p class="position-subtitle">Student Records</p>
                    <div class="position-roles">
                        <div class="role-item">
                            <i class="fas fa-user-graduate"></i>
                            <span>Student Registration</span>
                        </div>
                    </div>
                </a>

                <a href="login.php?role=hr-manager" class="position-card management">
                    <div class="login-badge">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </div>
                    <div class="position-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="position-title">HR Manager</h3>
                    <p class="position-subtitle">Human Resources</p>
                    <div class="position-roles">
                        <div class="role-item">
                            <i class="fas fa-user-tie"></i>
                            <span>Staff Management</span>
                        </div>
                    </div>
                </a>

                <a href="login.php?role=secretary" class="position-card management">
                    <div class="login-badge">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </div>
                    <div class="position-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h3 class="position-title">School Secretary</h3>
                    <p class="position-subtitle">Administrative Support</p>
                    <div class="position-roles">
                        <div class="role-item">
                            <i class="fas fa-envelope"></i>
                            <span>Office Administration</span>
                        </div>
                    </div>
                </a>

                <a href="login.php?role=librarian" class="position-card management">
                    <div class="login-badge">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </div>
                    <div class="position-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <h3 class="position-title">School Librarian</h3>
                    <p class="position-subtitle">Library Management</p>
                    <div class="position-roles">
                        <div class="role-item">
                            <i class="fas fa-book-open"></i>
                            <span>Library Resources</span>
                        </div>
                    </div>
                </a>
            </div>

            <h2 class="organogram-title">Academic Staff</h2>
            
            <!-- Academic Staff Level -->
            <div class="org-level">
                <a href="login.php?role=head-nursing" class="position-card operational">
                    <div class="login-badge">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </div>
                    <div class="position-icon">
                        <i class="fas fa-user-nurse"></i>
                    </div>
                    <h3 class="position-title">Head of Nursing</h3>
                    <p class="position-subtitle">Nursing Department</p>
                    <div class="position-roles">
                        <div class="role-item">
                            <i class="fas fa-stethoscope"></i>
                            <span>Nursing Program Leadership</span>
                        </div>
                    </div>
                </a>

                <a href="login.php?role=head-midwifery" class="position-card operational">
                    <div class="login-badge">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </div>
                    <div class="position-icon">
                        <i class="fas fa-baby"></i>
                    </div>
                    <h3 class="position-title">Head of Midwifery</h3>
                    <p class="position-subtitle">Midwifery Department</p>
                    <div class="position-roles">
                        <div class="role-item">
                            <i class="fas fa-baby-carriage"></i>
                            <span>Midwifery Program Leadership</span>
                        </div>
                    </div>
                </a>

                <a href="login.php?role=senior-lecturer" class="position-card operational">
                    <div class="login-badge">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </div>
                    <div class="position-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3 class="position-title">Senior Lecturers</h3>
                    <p class="position-subtitle">Teaching Staff</p>
                    <div class="position-roles">
                        <div class="role-item">
                            <i class="fas fa-chalkboard"></i>
                            <span>Advanced Teaching</span>
                        </div>
                    </div>
                </a>

                <a href="login.php?role=lecturer" class="position-card operational">
                    <div class="login-badge">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </div>
                    <div class="position-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3 class="position-title">Lecturers</h3>
                    <p class="position-subtitle">Teaching Staff</p>
                    <div class="position-roles">
                        <div class="role-item">
                            <i class="fas fa-book-reader"></i>
                            <span>Classroom Teaching</span>
                        </div>
                    </div>
                </a>
            </div>

            <h2 class="organogram-title">Support Staff</h2>
            
            <!-- Support Staff Level -->
            <div class="org-level">
                <a href="login.php?role=matron" class="position-card operational">
                    <div class="login-badge">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </div>
                    <div class="position-icon">
                        <i class="fas fa-user-nurse"></i>
                    </div>
                    <h3 class="position-title">Matrons</h3>
                    <p class="position-subtitle">Student Welfare</p>
                    <div class="position-roles">
                        <div class="role-item">
                            <i class="fas fa-home"></i>
                            <span>Student Care & Support</span>
                        </div>
                    </div>
                </a>

                <a href="login.php?role=lab-technician" class="position-card operational">
                    <div class="login-badge">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </div>
                    <div class="position-icon">
                        <i class="fas fa-flask"></i>
                    </div>
                    <h3 class="position-title">Lab Technicians</h3>
                    <p class="position-subtitle">Laboratory Services</p>
                    <div class="position-roles">
                        <div class="role-item">
                            <i class="fas fa-microscope"></i>
                            <span>Lab Management</span>
                        </div>
                    </div>
                </a>

                <a href="login.php?role=driver" class="position-card operational">
                    <div class="login-badge">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </div>
                    <div class="position-icon">
                        <i class="fas fa-bus"></i>
                    </div>
                    <h3 class="position-title">Drivers</h3>
                    <p class="position-subtitle">Transport Services</p>
                    <div class="position-roles">
                        <div class="role-item">
                            <i class="fas fa-route"></i>
                            <span>Transportation Management</span>
                        </div>
                    </div>
                </a>

                <a href="login.php?role=security" class="position-card operational">
                    <div class="login-badge">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </div>
                    <div class="position-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="position-title">Security</h3>
                    <p class="position-subtitle">Campus Security</p>
                    <div class="position-roles">
                        <div class="role-item">
                            <i class="fas fa-lock"></i>
                            <span>Safety & Security</span>
                        </div>
                    </div>
                </a>
            </div>

            <h2 class="organogram-title">Student Leadership</h2>
            
            <!-- Student Level -->
            <div class="org-level">
                <a href="login.php?role=student" class="position-card student">
                    <div class="login-badge">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </div>
                    <div class="position-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h3 class="position-title">Students</h3>
                    <p class="position-subtitle">Student Body</p>
                    <div class="position-roles">
                        <div class="role-item">
                            <i class="fas fa-graduation-cap"></i>
                            <span>All Student Access</span>
                        </div>
                    </div>
                </a>

                <a href="login.php?role=guild-president" class="position-card student">
                    <div class="login-badge">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </div>
                    <div class="position-icon">
                        <i class="fas fa-crown"></i>
                    </div>
                    <h3 class="position-title">Guild President</h3>
                    <p class="position-subtitle">Student Leadership</p>
                    <div class="position-roles">
                        <div class="role-item">
                            <i class="fas fa-users"></i>
                            <span>Student Government</span>
                        </div>
                    </div>
                </a>

                <a href="login.php?role=class-rep" class="position-card student">
                    <div class="login-badge">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </div>
                    <div class="position-icon">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <h3 class="position-title">Class Representatives</h3>
                    <p class="position-subtitle">Class Leadership</p>
                    <div class="position-roles">
                        <div class="role-item">
                            <i class="fas fa-chalkboard"></i>
                            <span>Class Representation</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <h3 class="footer-title">Designed and Developed by Reagan Otema</h3>
            <p class="footer-subtitle">For system errors, contact via WhatsApp</p>
            <div class="contact-buttons">
                <a href="https://wa.me/256772514889" target="_blank" class="whatsapp-button">
                    <i class="fab fa-whatsapp"></i> MTN WhatsApp: +256772514889
                </a>
                <a href="https://wa.me/256730314979" target="_blank" class="whatsapp-button">
                    <i class="fab fa-whatsapp"></i> Airtel WhatsApp: +256730314979
                </a>
            </div>
        </div>
    </footer>

    <script>
        // Enhanced click handlers with smooth transitions
        document.querySelectorAll('.position-card').forEach(card => {
            card.addEventListener('click', function(e) {
                // Add ripple effect
                const ripple = document.createElement('div');
                ripple.style.cssText = `
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.5);
                    transform: scale(0);
                    animation: ripple 0.6s linear;
                    pointer-events: none;
                `;
                
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
                ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

        // Smooth scroll for navigation
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add hover sound effect (visual feedback)
        document.querySelectorAll('.position-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.05)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    </script>
</body>
</html>
