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
    <title>Institutional Activities - Iganga School of Nursing and Midwifery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Inter:wght@300;400;500;600;700&family=Copperplate+Gothic+Bold&family=Rockwell+Extra+Bold&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #334155 100%);
            color: var(--pure-white);
            line-height: 1.6;
            overflow-x: hidden;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 50%, rgba(139, 92, 246, 0.4) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(59, 130, 246, 0.4) 0%, transparent 50%),
                radial-gradient(circle at 50% 20%, rgba(236, 72, 153, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 50% 80%, rgba(249, 115, 22, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 30% 70%, rgba(16, 185, 129, 0.2) 0%, transparent 50%);
            animation: modernAurora 15s ease-in-out infinite;
            pointer-events: none;
            z-index: -1;
        }

        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="modern-activities-pattern" width="30" height="30" patternUnits="userSpaceOnUse"><circle cx="15" cy="15" r="3" fill="rgba(139,92,246,0.3)"/><path d="M5 15 Q15 5, 25 15 T45 15" stroke="rgba(59,130,246,0.4)" stroke-width="2" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23modern-activities-pattern)"/></svg>'),
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><defs><pattern id="vibrant-activities-pattern" width="50" height="50" patternUnits="userSpaceOnUse"><rect x="10" y="10" width="30" height="30" fill="none" stroke="rgba(236,72,153,0.3)" stroke-width="2"/><circle cx="25" cy="25" r="6" fill="rgba(249,115,22,0.4)"/></pattern></defs><rect width="200" height="200" fill="url(%23vibrant-activities-pattern)"/></svg>');
            background-size: 30px 30px, 100px 100px;
            animation: modernPatternFloat 25s linear infinite;
            pointer-events: none;
            z-index: -1;
        }

        /* Luxury Header */
        .luxury-header {
            background: var(--gradient-primary);
            color: white;
            padding: 2rem 0;
            position: relative;
            overflow: hidden;
        }

        .luxury-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            animation: floatPattern 20s ease-in-out infinite;
        }

        @keyframes floatPattern {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(10px, 10px); }
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            position: relative;
            z-index: 1;
        }

        .header-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 3px solid var(--golden-yellow);
            box-shadow: 0 0 20px rgba(251, 191, 36, 0.5);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 8px;
        }

        .nav-links a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 900;
            margin-bottom: 1rem;
            text-align: center;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .breadcrumb {
            text-align: center;
            opacity: 0.9;
        }

        /* Main Content */
        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 3rem 2rem;
        }

        /* Section Styles */
        .section {
            margin-bottom: 4rem;
            opacity: 0;
            animation: fadeInUp 0.8s ease forwards;
        }

        .section:nth-child(1) { animation-delay: 0.1s; }
        .section:nth-child(2) { animation-delay: 0.2s; }
        .section:nth-child(3) { animation-delay: 0.3s; }

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

        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--gradient-luxury);
            border-radius: 2px;
        }

        .section-subtitle {
            color: var(--text-secondary);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Academic Activities */
        .academic-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            margin-bottom: 3rem;
        }

        .activities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .activity-card {
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.05), rgba(55, 48, 163, 0.05));
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .activity-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.1), rgba(55, 48, 163, 0.1));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .activity-card:hover::before {
            opacity: 1;
        }

        .activity-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: var(--shadow-xl);
        }

        .activity-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 1rem;
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            transform-style: preserve-3d;
            box-shadow: var(--shadow-md);
        }

        .activity-image:hover {
            transform: scale(1.05) rotateX(2deg) translateZ(10px);
            box-shadow: var(--shadow-lg);
        }

        .activity-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 40%, rgba(255,255,255,0.3) 50%, transparent 60%);
            transform: translateX(-100%);
            transition: transform 0.8s ease;
            pointer-events: none;
            border-radius: 12px;
        }

        .activity-card:hover .activity-image::before {
            transform: translateX(100%);
        }

        .activity-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            box-shadow: 0 0 20px rgba(30, 58, 138, 0.3);
            position: relative;
            z-index: 1;
        }

        .activity-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .activity-description {
            color: var(--text-primary);
            font-size: 1.1rem;
            line-height: 1.6;
            position: relative;
            z-index: 1;
        }

        /* Practicum Sites */
        .practicum-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            margin-bottom: 3rem;
        }

        .practicum-intro {
            font-size: 1.2rem;
            line-height: 1.8;
            color: var(--text-primary);
            margin-bottom: 2rem;
            text-align: center;
        }

        .practicum-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2rem;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .practicum-table th {
            background: var(--gradient-primary);
            color: white;
            padding: 1rem;
            text-align: left;
            font-weight: 600;
        }

        .practicum-table td {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .practicum-table tr:hover {
            background: rgba(30, 58, 138, 0.05);
        }

        .practicum-table tr:last-child td {
            border-bottom: none;
        }

        .ownership-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .ownership-badge.government {
            background: rgba(34, 197, 94, 0.1);
            color: var(--light-green);
        }

        .distance-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-secondary);
        }

        .bed-capacity {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--accent-blue);
            font-weight: 600;
        }

        /* Co-curricular Activities */
        .co-curricular-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
        }

        .sports-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .sport-card {
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.05), rgba(55, 48, 163, 0.05));
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            animation: sportCardFloat 4s ease-in-out infinite;
        }

        .sport-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: var(--shadow-xl);
        }

        .sport-card img {
            transition: all 0.3s ease;
        }

        .sport-card:hover img {
            transform: scale(1.05);
        }

        @keyframes sportCardFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-3px); }
        }

        .sport-icon {
            width: 60px;
            height: 60px;
            background: var(--gradient-luxury);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin: 0 auto 1rem;
        }

        .sport-name {
            font-weight: 600;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
        }

        .indoor-activities {
            background: rgba(30, 58, 138, 0.05);
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem 0;
        }

        .indoor-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .indoor-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .indoor-item {
            background: white;
            border-radius: 10px;
            padding: 1rem;
            text-align: center;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .indoor-item:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-sm);
        }

        .indoor-icon {
            font-size: 1.5rem;
            color: var(--accent-blue);
            margin-bottom: 0.5rem;
        }

        .associations-section {
            background: var(--gradient-primary);
            color: white;
            border-radius: 20px;
            padding: 3rem;
            margin-top: 3rem;
            position: relative;
            overflow: hidden;
        }

        .associations-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .associations-content {
            position: relative;
            z-index: 1;
        }

        .associations-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
        }

        .associations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .association-item {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .association-item:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
        }

        .association-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .association-name {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .community-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            margin-top: 3rem;
            text-align: center;
        }

        .community-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 2rem;
        }

        .community-activities {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .community-item {
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.05), rgba(55, 48, 163, 0.05));
            border-radius: 15px;
            padding: 2rem;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .community-item:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .community-icon {
            width: 60px;
            height: 60px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin: 0 auto 1rem;
        }

        .community-name {
            font-weight: 600;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .page-title {
                font-size: 2rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .activities-grid {
                grid-template-columns: 1fr;
            }
            
            .practicum-table {
                font-size: 0.9rem;
            }
            
            .practicum-table th,
            .practicum-table td {
                padding: 0.75rem 0.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Luxury Header -->
    <header class="luxury-header">
        <div class="header-content">
            <nav class="header-nav">
                <div class="logo-section">
                    <img src="assets/school-logo.png" alt="ISNM Logo" class="logo">
                    <div>
                        <h1 style="font-family: 'Copperplate Gothic Bold', 'Rockwell Extra Bold', serif; font-size: 1.2rem; font-weight: 900;">ISNM</h1>
                        <p style="font-size: 0.8rem; opacity: 0.9;">Excellence in Healthcare Education</p>
                    </div>
                </div>
                <ul class="nav-links">
                    <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="about.php"><i class="fas fa-info-circle"></i> About</a></li>
                    <li><a href="governance.php"><i class="fas fa-users"></i> Governance</a></li>
                    <li><a href="programs.php"><i class="fas fa-graduation-cap"></i> Programs</a></li>
                    <li><a href="admissions.php"><i class="fas fa-user-plus"></i> Admissions</a></li>
                    <li><a href="activities.php"><i class="fas fa-running"></i> Activities</a></li>
                    <li><a href="infrastructure.php"><i class="fas fa-building"></i> Infrastructure</a></li>
                    <li><a href="achievements.php"><i class="fas fa-trophy"></i> Achievements</a></li>
                    <li><a href="history.php"><i class="fas fa-history"></i> History</a></li>
                    <li><a href="contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
                    <li><a href="login-portal.php"><i class="fas fa-sign-in-alt"></i> Portal</a></li>
                </ul>
            </nav>
            <div class="page-title">Institutional Activities</div>
            <div class="breadcrumb">
                <p>Home / School Life / Activities</p>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Academic Activities Section -->
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">5.0 Institutional Activities</h2>
                <p class="section-subtitle">Comprehensive academic and co-curricular activities for holistic development</p>
            </div>
            
            <div class="academic-section">
                <div class="section-header">
                    <h3 class="section-title">5.1 Academic Activities</h3>
                    <p class="section-subtitle">Core academic programs and learning experiences</p>
                </div>
                
                <div class="activities-grid">
                    <div class="activity-card">
                        <div class="activity-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h4 class="activity-title">Teaching & Learning</h4>
                        <p class="activity-description">
                            Comprehensive teaching and learning activities through lectures, 
                            interactive sessions, and modern educational methodologies.
                        </p>
                    </div>
                    
                    <div class="activity-card" style="position: relative;">
                        <img src="assets/students-in-skill-laboratory-in-practical-training.jpg" alt="Practical Training" class="activity-image">
                        <div class="activity-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                            <i class="fas fa-flask"></i>
                        </div>
                        <h4 class="activity-title">Practical Training</h4>
                        <p class="activity-description">
                            Hands-on practical training in skills laboratory in school and 
                            practicum in Hospitals/Health Centres.
                        </p>
                    </div>
                    
                    <div class="activity-card">
                        <div class="activity-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h4 class="activity-title">Counseling Services</h4>
                        <p class="activity-description">
                            Professional counseling services for students and staff to support 
                            mental health and personal development.
                        </p>
                    </div>
                    
                    <div class="activity-card">
                        <div class="activity-icon">
                            <i class="fas fa-book-medical"></i>
                        </div>
                        <h4 class="activity-title">Assessment & Evaluation</h4>
                        <p class="activity-description">
                            Regular assessment of practical tool books and midwifery case books 
                            to monitor progress and competency development.
                        </p>
                    </div>
                    
                    <div class="activity-card">
                        <img src="assets/certificate-in-nursing-students-in-examamination-room.jpg" alt="Students in Examination" class="activity-image">
                        <div class="activity-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <h4 class="activity-title">Testing & Examinations</h4>
                        <p class="activity-description">
                            Setting and marking tests, exams, and case studies to evaluate 
                            student learning and academic achievement.
                        </p>
                    </div>
                    
                    <div class="activity-card" style="position: relative;">
                        <img src="assets/revision-session-at-the-school-library.jpg" alt="Library Revision Session" style="width: 100%; height: 150px; object-fit: cover; border-radius: 10px;">
                        <div class="activity-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                            <i class="fas fa-book"></i>
                        </div>
                        <h4 class="activity-title">Library Revision Sessions</h4>
                        <p class="activity-description">
                            Students conducting revision sessions in the school library 
                            for enhanced learning and exam preparation.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Practicum Sites Section -->
        <section class="section">
            <div class="practicum-section">
                <div class="section-header">
                    <h3 class="section-title">5.1.1 Practicum Sites</h3>
                    <p class="section-subtitle">Partner hospitals for clinical training and practical experience</p>
                </div>
                
                <div class="practicum-intro">
                    <p>
                        Iganga School of Nursing and Midwifery entered into a Memorandum of Understanding (MOU) 
                        with Iganga, Bugiri, Busolwe, Tororo, Masafu and Mbale Regional Referral hospitals for 
                        the purpose of giving our students hands-on practical experience. Clinical mentors at the 
                        respective hospitals assist the students on a daily basis while our tutors conduct support 
                        supervision on a weekly basis. By the time of completion of the course, the students have 
                        had an opportunity to rotate in all the hospitals.
                    </p>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem; margin-top: 2rem;">
                        <img src="assets/student-st-practicum-sites1.jpg" alt="Practicum Site 1" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">
                        <img src="assets/student-at-practicum-site2.jpg" alt="Practicum Site 2" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">
                    </div>
                </div>
                
                <table class="practicum-table">
                    <thead>
                        <tr>
                            <th>Name of Hospital</th>
                            <th>Ownership</th>
                            <th>Distance from School</th>
                            <th>Bed Capacity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Iganga Hospital</strong></td>
                            <td><span class="ownership-badge government">Government</span></td>
                            <td><span class="distance-badge"><i class="fas fa-map-marker-alt"></i> 3km</span></td>
                            <td><span class="bed-capacity"><i class="fas fa-bed"></i> 200</span></td>
                        </tr>
                        <tr>
                            <td><strong>Bugiri Hospital</strong></td>
                            <td><span class="ownership-badge government">Government</span></td>
                            <td><span class="distance-badge"><i class="fas fa-map-marker-alt"></i> 30km</span></td>
                            <td><span class="bed-capacity"><i class="fas fa-bed"></i> 200</span></td>
                        </tr>
                        <tr>
                            <td><strong>Tororo Hospital</strong></td>
                            <td><span class="ownership-badge government">Government</span></td>
                            <td><span class="distance-badge"><i class="fas fa-map-marker-alt"></i> 50km</span></td>
                            <td><span class="bed-capacity"><i class="fas fa-bed"></i> 200</span></td>
                        </tr>
                        <tr>
                            <td><strong>Busolwe Hospital</strong></td>
                            <td><span class="ownership-badge government">Government</span></td>
                            <td><span class="distance-badge"><i class="fas fa-map-marker-alt"></i> 40km</span></td>
                            <td><span class="bed-capacity"><i class="fas fa-bed"></i> 200</span></td>
                        </tr>
                        <tr>
                            <td><strong>Masafu Hospital</strong></td>
                            <td><span class="ownership-badge government">Government</span></td>
                            <td><span class="distance-badge"><i class="fas fa-map-marker-alt"></i> 40km</span></td>
                            <td><span class="bed-capacity"><i class="fas fa-bed"></i> 200</span></td>
                        </tr>
                        <tr>
                            <td><strong>Mbale Regional Referral Hospital</strong></td>
                            <td><span class="ownership-badge government">Government</span></td>
                            <td><span class="distance-badge"><i class="fas fa-map-marker-alt"></i> 80km</span></td>
                            <td><span class="bed-capacity"><i class="fas fa-bed"></i> 300</span></td>
                        </tr>
                        <tr>
                            <td><strong>Kayunga Hospital</strong></td>
                            <td><span class="ownership-badge government">Government</span></td>
                            <td><span class="distance-badge"><i class="fas fa-map-marker-alt"></i> 80km</span></td>
                            <td><span class="bed-capacity"><i class="fas fa-bed"></i> 200</span></td>
                        </tr>
                    </tbody>
                </table>
                
                <p style="margin-top: 2rem; text-align: center; color: var(--text-secondary);">
                    During each semester at least 8 (Eight) weeks are spent at the practicum sites while the rest 
                    of the time is for block study, skills laboratory training, tests and examinations. At the end 
                    of each placement, the respective Principal Nursing Officers compile a report about the student's 
                    performance and discipline and corrective action is taken where necessary.
                </p>
            </div>
        </section>

        <!-- Co-curricular Activities Section -->
        <section class="section">
            <div class="co-curricular-section">
                <div class="section-header">
                    <h3 class="section-title">5.2 Co-curricular Activities</h3>
                    <p class="section-subtitle">Extra-curricular activities for holistic student development</p>
                </div>
                
                <div class="sports-grid">
                    <div class="sport-card" style="position: relative;">
                        <img src="assets/footbal-team-student-images1.jpg" alt="ISNM Football Team in Training" title="ISNM Football Team - Regular Training Session" style="width: 100%; height: 150px; object-fit: cover; border-radius: 10px;">
                        <div class="sport-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                            <i class="fas fa-futbol"></i>
                        </div>
                        <h4 class="sport-name">Football Team</h4>
                        <p>Regular football training and matches with Uganda Christian University</p>
                    </div>
                    
                    <div class="sport-card" style="position: relative;">
                        <img src="assets/footbal-team-student-images2.jpg" alt="ISNM Football Match Against UCU" title="ISNM Football Team - Competitive Match" style="width: 100%; height: 150px; object-fit: cover; border-radius: 10px;">
                        <div class="sport-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                            <i class="fas fa-futbol"></i>
                        </div>
                        <h4 class="sport-name">Football Match</h4>
                        <p>Friendly matches and competitive tournaments</p>
                    </div>
                    
                    <div class="sport-card" style="position: relative;">
                        <img src="assets/footbal-team-student-images3.jpg" alt="ISNM Football Professional Coaching" title="ISNM Football Team - Professional Coaching Session" style="width: 100%; height: 150px; object-fit: cover; border-radius: 10px;">
                        <div class="sport-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                            <i class="fas fa-futbol"></i>
                        </div>
                        <h4 class="sport-name">Football Training</h4>
                        <p>Professional coaching and skill development</p>
                    </div>
                </div>
                
                <div class="indoor-activities">
                    <h3 class="indoor-title">Indoor Games</h3>
                    <div class="indoor-grid">
                        <div class="indoor-item">
                            <div class="indoor-icon">
                                <i class="fas fa-chess"></i>
                            </div>
                            <h4>Chess</h4>
                        </div>
                        <div class="indoor-item">
                            <div class="indoor-icon">
                                <i class="fas fa-dice"></i>
                            </div>
                            <h4>Draft</h4>
                        </div>
                        <div class="indoor-item">
                            <div class="indoor-icon">
                                <i class="fas fa-puzzle-piece"></i>
                            </div>
                            <h4>Scrabble</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Cultural and Religious Associations -->
        <section class="section">
            <div class="associations-section">
                <div class="associations-content">
                    <h2 class="associations-title">Cultural & Religious Associations</h2>
                    <div class="associations-grid">
                        <div class="association-item">
                            <div class="association-icon">
                                <i class="fas fa-music"></i>
                            </div>
                            <h4 class="association-name">Music, Dance & Drama</h4>
                            <p>Cultural performances and arts</p>
                        </div>
                        
                        <div class="association-item">
                            <div class="association-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <h4 class="association-name">Basoga Nseete</h4>
                            <p>Local cultural association</p>
                        </div>
                        
                        <div class="association-item">
                            <div class="association-icon">
                                <i class="fas fa-globe"></i>
                            </div>
                            <h4 class="association-name">Westerners Association</h4>
                            <p>Regional cultural group</p>
                        </div>
                        
                        <div class="association-item">
                            <div class="association-icon">
                                <i class="fas fa-crown"></i>
                            </div>
                            <h4 class="association-name">Nkobazambogo</h4>
                            <p>Cultural heritage association</p>
                        </div>
                        
                        <div class="association-item">
                            <div class="association-icon">
                                <i class="fas fa-pray"></i>
                            </div>
                            <h4 class="association-name">Religious Associations</h4>
                            <p>Various faith-based groups</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Community Service -->
        <section class="section">
            <div class="community-section">
                <h2 class="community-title">Community Service Activities</h2>
                <div class="community-activities">
                    <div class="community-item">
                        <div class="community-icon">
                            <i class="fas fa-broom"></i>
                        </div>
                        <h3 class="community-name">Town Cleaning</h3>
                        <p>Participating in cleaning Iganga Town</p>
                    </div>
                    
                    <div class="community-item">
                        <div class="community-icon">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h3 class="community-name">Charitable Work</h3>
                        <p>Visiting the needy in prisons and hospitals</p>
                    </div>
                    
                    <div class="community-item">
                        <div class="community-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h3 class="community-name">Health Outreach</h3>
                        <p>Community health education and services</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        // Add smooth scroll behavior
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

        // Add parallax effect to header
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const header = document.querySelector('.luxury-header');
            if (header) {
                header.style.transform = `translateY(${scrolled * 0.5}px)`;
            }
        });
    </script>
</body>
</html>


