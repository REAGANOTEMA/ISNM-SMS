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
    <title>School History - Iganga School of Nursing and Midwifery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Inter:wght@300;400;500;600;700&family=Copperplate+Gothic+Bold&family=Rockwell+Extra+Bold&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            /* Modern Vibrant Color Palette */
            --vibrant-purple: #8B5CF6;
            --electric-blue: #3B82F6;
            --neon-cyan: #06B6D4;
            --bright-green: #10B981;
            --golden-yellow: #F59E0B;
            --hot-pink: #EC4899;
            --deep-indigo: #4F46E5;
            --sunset-orange: #F97316;
            --crimson-red: #DC2626;
            --pure-white: #FFFFFF;
            --dark-bg: #0F172A;
            --light-bg: #F8FAFC;
            
            /* Advanced Color Variations */
            --primary-vibrant: #8B5CF6;
            --secondary-vibrant: #3B82F6;
            --accent-vibrant: #06B6D4;
            --success-vibrant: #10B981;
            --warning-vibrant: #F59E0B;
            --danger-vibrant: #EF4444;
            --info-vibrant: #06B6D4;
            --dark-vibrant: #1E293B;
            --light-vibrant: #F1F5F9;
            
            /* Modern Gradients */
            --gradient-modern: linear-gradient(135deg, #8B5CF6 0%, #3B82F6 25%, #06B6D4 50%, #10B981 75%, #F59E0B 100%);
            --gradient-hero: linear-gradient(135deg, #4F46E5 0%, #8B5CF6 33%, #EC4899 66%, #F97316 100%);
            --gradient-luxury: linear-gradient(135deg, #F59E0B 0%, #FCD34D 50%, #FEF3C7 100%);
            --gradient-neon: linear-gradient(135deg, #06B6D4 0%, #10B981 50%, #8B5CF6 100%);
            --gradient-sunset: linear-gradient(135deg, #F97316 0%, #EF4444 50%, #EC4899 100%);
            --gradient-ocean: linear-gradient(135deg, #0EA5E9 0%, #06B6D4 50%, #10B981 100%);
            --gradient-galaxy: linear-gradient(135deg, #4F46E5 0%, #8B5CF6 50%, #EC4899 100%);
            
            /* Modern Shadows */
            --shadow-modern-sm: 0 4px 6px -1px rgba(139, 92, 246, 0.1), 0 2px 4px -1px rgba(139, 92, 246, 0.06);
            --shadow-modern-md: 0 10px 15px -3px rgba(139, 92, 246, 0.1), 0 4px 6px -2px rgba(139, 92, 246, 0.05);
            --shadow-modern-lg: 0 20px 25px -5px rgba(139, 92, 246, 0.1), 0 10px 10px -5px rgba(139, 92, 246, 0.04);
            --shadow-neon: 0 0 20px rgba(139, 92, 246, 0.6), 0 0 40px rgba(59, 130, 246, 0.4);
            --shadow-glow: 0 0 30px rgba(236, 72, 153, 0.5), 0 0 60px rgba(249, 115, 22, 0.3);
            
            /* Modern Border Colors */
            --border-modern: #E5E7EB;
            --border-vibrant: #8B5CF6;
            --border-neon: #06B6D4;
            --border-glow: #F59E0B;
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
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="modern-history-pattern" width="30" height="30" patternUnits="userSpaceOnUse"><circle cx="15" cy="15" r="3" fill="rgba(139,92,246,0.3)"/><path d="M5 15 Q15 5, 25 15 T45 15" stroke="rgba(59,130,246,0.4)" stroke-width="2" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23modern-history-pattern)"/></svg>'),
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><defs><pattern id="vibrant-history-pattern" width="50" height="50" patternUnits="userSpaceOnUse"><rect x="10" y="10" width="30" height="30" fill="none" stroke="rgba(236,72,153,0.3)" stroke-width="2"/><circle cx="25" cy="25" r="6" fill="rgba(249,115,22,0.4)"/></pattern></defs><rect width="200" height="200" fill="url(%23vibrant-history-pattern)"/></svg>');
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

        /* History Introduction */
        .history-intro {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            margin-bottom: 3rem;
            text-align: center;
        }

        .intro-text {
            font-size: 1.2rem;
            line-height: 1.8;
            color: var(--text-primary);
            margin-bottom: 2rem;
        }

        .founding-year {
            display: inline-block;
            background: var(--gradient-primary);
            color: white;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 1rem 0;
        }

        /* Timeline */
        .timeline-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            margin-bottom: 3rem;
        }

        .timeline {
            position: relative;
            padding: 2rem 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 4px;
            background: var(--gradient-primary);
            transform: translateX(-50%);
        }

        .timeline-item {
            position: relative;
            padding: 2rem 0;
            display: flex;
            align-items: center;
        }

        .timeline-item:nth-child(odd) {
            flex-direction: row-reverse;
        }

        .timeline-content {
            flex: 1;
            padding: 0 2rem;
        }

        .timeline-item:nth-child(odd) .timeline-content {
            text-align: right;
        }

        .timeline-date {
            background: var(--gradient-luxury);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 1rem;
            font-family: 'Playfair Display', serif;
        }

        .timeline-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }

        .timeline-description {
            color: var(--text-primary);
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .timeline-dot {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 20px;
            background: var(--golden-yellow);
            border: 4px solid var(--primary-blue);
            border-radius: 50%;
            z-index: 2;
        }

        /* Milestones */
        .milestones-section {
            background: var(--gradient-primary);
            color: white;
            border-radius: 20px;
            padding: 3rem;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        .milestones-section::before {
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

        .milestones-content {
            position: relative;
            z-index: 1;
        }

        .milestones-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
        }

        .milestones-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .milestone-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .milestone-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
        }

        .milestone-year {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--golden-yellow);
        }

        .milestone-title {
            font-weight: 600;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        .milestone-description {
            opacity: 0.9;
            line-height: 1.6;
        }

        /* Growth Section */
        .growth-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
        }

        .growth-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .growth-item {
            text-align: center;
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.05), rgba(55, 48, 163, 0.05));
            border-radius: 15px;
            padding: 2rem;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .growth-item:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .growth-number {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 900;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
            display: block;
        }

        .growth-label {
            color: var(--text-secondary);
            font-size: 1.1rem;
        }

        .growth-icon {
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

        /* Enhanced History Gallery */
        .history-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2.5rem;
            margin: 3rem 0;
        }

        .history-card {
            background: linear-gradient(145deg, var(--white), var(--cream-white));
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            transform-style: preserve-3d;
            transform: translateZ(0);
            border: 2px solid transparent;
        }

        .history-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-blue), var(--light-green), var(--golden-yellow));
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .history-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="history-pattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="2" fill="var(--golden-yellow)" opacity="0.2"/><path d="M5 10 Q10 5, 15 10 T25 10" stroke="var(--light-green)" stroke-width="1" fill="none" opacity="0.3"/></pattern></defs><rect width="100" height="100" fill="url(%23history-pattern)"/></svg>'),
                linear-gradient(135deg, transparent 40%, rgba(255,255,255,0.2) 50%, transparent 60%);
            background-size: 40px 40px, cover;
            background-position: 0 0, center;
            transform: translateX(-100%);
            transition: transform 0.8s ease;
            pointer-events: none;
        }

        .history-card:hover {
            transform: translateY(-15px) scale(1.02) rotateX(3deg) translateZ(25px);
            box-shadow: var(--shadow-xl), 0 0 40px rgba(37, 99, 235, 0.3);
            border-color: var(--primary-blue);
        }

        .history-card:hover::before {
            transform: scaleX(1);
        }

        .history-card:hover::after {
            transform: translateX(100%);
        }

        .history-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            transform-style: preserve-3d;
            transform: translateZ(0);
        }

        .history-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, transparent 40%, rgba(255,255,255,0.3) 50%, transparent 60%);
            transform: translateX(-100%);
            transition: transform 0.8s ease;
            pointer-events: none;
        }

        .history-card:hover .history-image {
            transform: scale(1.05) rotateX(2deg) translateZ(10px);
        }

        .history-card:hover .history-image::before {
            transform: translateX(100%);
        }

        .history-card-content {
            padding: 2rem;
        }

        .history-card-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }

        .history-card-description {
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .history-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .history-badge {
            display: inline-block;
            background: var(--gradient-primary);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        @keyframes historyFloat {
            0%, 100% { transform: translateY(0px) translateZ(0px); }
            50% { transform: translateY(-5px) translateZ(10px); }
        }

        /* Vision Section */
        .vision-section {
            background: var(--gradient-luxury);
            color: white;
            border-radius: 20px;
            padding: 3rem;
            margin-top: 3rem;
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .vision-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 25s linear infinite;
        }

        .vision-content {
            position: relative;
            z-index: 1;
        }

        .vision-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
        }

        .vision-text {
            font-size: 1.2rem;
            line-height: 1.8;
            max-width: 800px;
            margin: 0 auto;
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
            
            .timeline::before {
                left: 20px;
            }
            
            .timeline-item {
                flex-direction: column !important;
                padding-left: 60px;
            }
            
            .timeline-content {
                text-align: left !important;
                padding: 0;
            }
            
            .timeline-dot {
                left: 20px;
            }
            
            .milestones-grid {
                grid-template-columns: 1fr;
            }
            
            .growth-stats {
                grid-template-columns: repeat(2, 1fr);
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
                    <img src="public/isnm-logo.jpeg" alt="ISNM Logo" class="logo">
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
            <div class="page-title">School History</div>
            <div class="breadcrumb">
                <p>Home / About / Our History</p>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- History Introduction -->
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">Our Journey Through Time</h2>
                <p class="section-subtitle">The remarkable story of Iganga School of Nursing and Midwifery</p>
            </div>
            
            <div class="history-intro">
                <p class="intro-text">
                    Founded with a vision to transform healthcare education in Uganda, Iganga School of Nursing and Midwifery 
                    has grown from humble beginnings to become a leading institution in nursing and midwifery training.
                </p>
                <div class="founding-year">Founded in 2009</div>
                <p class="intro-text">
                    From our initial cohort of 13 students to over 300 students today, our journey has been marked by 
                    continuous growth, academic excellence, and unwavering commitment to producing world-class healthcare professionals.
                </p>
            </div>
        </section>

        <!-- Timeline Section -->
        <section class="section">
            <div class="timeline-section">
                <div class="section-header">
                    <h3 class="section-title">Historical Timeline</h3>
                    <p class="section-subtitle">Key milestones in our development</p>
                </div>
                
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-date">2009</div>
                            <h4 class="timeline-title">The Beginning</h4>
                            <p class="timeline-description">
                                ISNM was founded with 13 pioneering students. The school was established by three founding members 
                                who formed the Board of Directors with a vision to provide quality healthcare education.
                            </p>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-date">2010-2012</div>
                            <h4 class="timeline-title">Early Growth</h4>
                            <p class="timeline-description">
                                Rapid expansion of student enrollment and development of basic infrastructure. 
                                Established partnerships with local hospitals for clinical training.
                            </p>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-date">2013-2015</div>
                            <h4 class="timeline-title">Academic Excellence</h4>
                            <p class="timeline-description">
                                Achieved remarkable results in national examinations with 100% pass rate in midwifery 
                                and over 85% in nursing programs. Expanded curriculum and facilities.
                            </p>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-date">2016-2018</div>
                            <h4 class="timeline-title">Infrastructure Development</h4>
                            <p class="timeline-description">
                                Construction of multi-purpose hall and first phase of girls' hostel. 
                                Acquisition of additional transportation and enhanced laboratory facilities.
                            </p>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-date">2019-2021</div>
                            <h4 class="timeline-title">Modernization</h4>
                            <p class="timeline-description">
                                Installation of solar panels and generators for reliable power supply. 
                                Separated and equipped skills laboratories for Nursing and Midwifery.
                            </p>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-date">2022-Present</div>
                            <h4 class="timeline-title">Digital Transformation</h4>
                            <p class="timeline-description">
                                Enhanced computer laboratory with 60 functional computers and full internet access. 
                                Implementation of modern management systems and expanded practicum partnerships.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Key Milestones -->
        <section class="section">
            <div class="milestones-section">
                <div class="milestones-content">
                    <h2 class="milestones-title">Key Milestones</h2>
                    <div class="milestones-grid">
                        <div class="milestone-card">
                            <div class="milestone-year">2009</div>
                            <h3 class="milestone-title">School Foundation</h3>
                            <p class="milestone-description">
                                Established with 13 students and 3 founding directors
                            </p>
                        </div>
                        
                        <div class="milestone-card">
                            <div class="milestone-year">2012</div>
                            <h3 class="milestone-title">First Graduation</h3>
                            <p class="milestone-description">
                                Celebrated first cohort of graduating nurses and midwives
                            </p>
                        </div>
                        
                        <div class="milestone-card">
                            <div class="milestone-year">2015</div>
                            <h3 class="milestone-title">MOES Registration</h3>
                            <p class="milestone-description">
                                Officially registered with Ministry of Education & Sports
                            </p>
                        </div>
                        
                        <div class="milestone-card">
                            <div class="milestone-year">2017</div>
                            <h3 class="milestone-title">UNMC Accreditation</h3>
                            <p class="milestone-description">
                                Full accreditation by Uganda Nurses and Midwives Council
                            </p>
                        </div>
                        
                        <div class="milestone-card">
                            <div class="milestone-year">2019</div>
                            <h3 class="milestone-title">Infrastructure Expansion</h3>
                            <p class="milestone-description">
                                Completion of multi-purpose hall and hostel facilities
                            </p>
                        </div>
                        
                        <div class="milestone-card">
                            <div class="milestone-year">2021</div>
                            <h3 class="milestone-title">Land Acquisition</h3>
                            <p class="milestone-description">
                                Acquired 12+ acres for future expansion and development
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Growth Statistics -->
        <section class="section">
            <div class="growth-section">
                <div class="section-header">
                    <h3 class="section-title">Growth Over the Years</h3>
                    <p class="section-subtitle">Our journey of expansion and development</p>
                </div>
                
                <div class="growth-stats">
                    <div class="growth-item">
                        <div class="growth-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <span class="growth-number">13</span>
                        <span class="growth-label">Students (2009)</span>
                    </div>
                    
                    <div class="growth-item">
                        <div class="growth-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <span class="growth-number">315+</span>
                        <span class="growth-label">Students (Current)</span>
                    </div>
                    
                    <div class="growth-item">
                        <div class="growth-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <span class="growth-number">4</span>
                        <span class="growth-label">Programs</span>
                    </div>
                    
                    <div class="growth-item">
                        <div class="growth-icon">
                            <i class="fas fa-hospital"></i>
                        </div>
                        <span class="growth-number">7</span>
                        <span class="growth-label">Practicum Sites</span>
                    </div>
                    
                    <div class="growth-item">
                        <div class="growth-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <span class="growth-number">6</span>
                        <span class="growth-label">Classrooms</span>
                    </div>
                    
                    <div class="growth-item">
                        <div class="growth-icon">
                            <i class="fas fa-desktop"></i>
                        </div>
                        <span class="growth-number">60</span>
                        <span class="growth-label">Computers</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- History Gallery Section -->
        <section class="section">
            <div class="history-gallery-section">
                <div class="section-header">
                    <h2 class="section-title">Historical Gallery</h2>
                    <p class="section-subtitle">Visual memories of our journey through the years</p>
                </div>
                
                <div class="history-gallery">
                    <!-- Football Team Images -->
                    <div class="history-card">
                        <img src="assets/footbal-team-student-images1.jpg" alt="ISNM Football Team - Student Sports Activities" title="ISNM Football Team - Building Team Spirit and Physical Fitness" class="history-image">
                        <div class="history-card-content">
                            <h3 class="history-card-title">Football Team</h3>
                            <p class="history-card-description">
                                Our talented football team representing ISNM in various competitions
                            </p>
                            <div class="history-badges">
                                <span class="history-badge">Sports</span>
                                <span class="history-badge">Team Spirit</span>
                            </div>
                        </div>
                    </div>

                    <div class="history-card">
                        <img src="assets/footbal-team-student-images2.jpg" alt="ISNM Football Team in Action - Competitive Sports" title="ISNM Football Team - Competitive Sports and Team Building" class="history-image">
                        <div class="history-card-content">
                            <h3 class="history-card-title">Team Competition</h3>
                            <p class="history-card-description">
                                Students showcasing their skills in competitive football matches
                            </p>
                            <div class="history-badges">
                                <span class="history-badge">Competition</span>
                                <span class="history-badge">Excellence</span>
                            </div>
                        </div>
                    </div>

                    <div class="history-card">
                        <img src="assets/footbal-team-student-images3.jpg" alt="ISNM Football Team Training - Sports Development" title="ISNM Football Team - Training and Skills Development" class="history-image">
                        <div class="history-card-content">
                            <h3 class="history-card-title">Training Sessions</h3>
                            <p class="history-card-description">
                                Intensive training sessions to develop athletic skills and teamwork
                            </p>
                            <div class="history-badges">
                                <span class="history-badge">Training</span>
                                <span class="history-badge">Development</span>
                            </div>
                        </div>
                    </div>

                    <!-- Practicum Site Images -->
                    <div class="history-card">
                        <img src="assets/student-st-practicum-sites1.jpg" alt="ISNM Students at Practicum Site - Clinical Training" title="ISNM Students - Hands-on Clinical Training at Practicum Sites" class="history-image">
                        <div class="history-card-content">
                            <h3 class="history-card-title">Clinical Practicum</h3>
                            <p class="history-card-description">
                                Students gaining practical experience at partner healthcare facilities
                            </p>
                            <div class="history-badges">
                                <span class="history-badge">Clinical</span>
                                <span class="history-badge">Training</span>
                            </div>
                        </div>
                    </div>

                    <div class="history-card">
                        <img src="assets/student-at-practicum-site2.jpg" alt="ISNM Students at Practicum Site - Healthcare Experience" title="ISNM Students - Real-world Healthcare Experience" class="history-image">
                        <div class="history-card-content">
                            <h3 class="history-card-title">Healthcare Experience</h3>
                            <p class="history-card-description">
                                Students applying their knowledge in real healthcare settings
                            </p>
                            <div class="history-badges">
                                <span class="history-badge">Experience</span>
                                <span class="history-badge">Application</span>
                            </div>
                        </div>
                    </div>

                    <!-- School Infrastructure Images -->
                    <div class="history-card">
                        <img src="assets/school-borehole-a-student-is-fetching-water.jpg" alt="ISNM School Borehole - Water Supply System" title="ISNM Water Supply - Student Fetching Water from School Borehole" class="history-image">
                        <div class="history-card-content">
                            <h3 class="history-card-title">Water Supply</h3>
                            <p class="history-card-description">
                                School borehole providing clean water for students and staff
                            </p>
                            <div class="history-badges">
                                <span class="history-badge">Infrastructure</span>
                                <span class="history-badge">Sustainability</span>
                            </div>
                        </div>
                    </div>

                    <div class="history-card">
                        <img src="assets/school-mini-buses-2-costers.jpg" alt="ISNM School Transport - Two Coaster Buses" title="ISNM School Transport - Two Coaster Buses for Student Transportation" class="history-image">
                        <div class="history-card-content">
                            <h3 class="history-card-title">School Transport</h3>
                            <p class="history-card-description">
                                Two coaster buses providing transportation for students to practicum sites
                            </p>
                            <div class="history-badges">
                                <span class="history-badge">Transport</span>
                                <span class="history-badge">Logistics</span>
                            </div>
                        </div>
                    </div>

                    <!-- Leadership Images -->
                    <div class="history-card">
                        <img src="assets/sr-edith-mwebaza-principal-of-the-school.jpg" alt="Sr. Edith Mwebaza - ISNM School Principal" title="Sr. Edith Mwebaza - Principal of Iganga School of Nursing and Midwifery" class="history-image">
                        <div class="history-card-content">
                            <h3 class="history-card-title">School Leadership</h3>
                            <p class="history-card-description">
                                Sr. Edith Mwebaza, the dedicated principal leading our institution
                            </p>
                            <div class="history-badges">
                                <span class="history-badge">Leadership</span>
                                <span class="history-badge">Excellence</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Vision Section -->
        <section class="section">
            <div class="vision-section">
                <div class="vision-content">
                    <h2 class="vision-title">Looking Forward</h2>
                    <p class="vision-text">
                        As we continue our journey, we remain committed to our founding vision of producing world-class 
                        healthcare professionals. Our history has taught us the value of perseverance, quality education, 
                        and community service. We look forward to continuing our growth and making even greater contributions 
                        to healthcare in Uganda and beyond.
                    </p>
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

        // Animate timeline items on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.timeline-item').forEach(item => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(30px)';
            item.style.transition = 'all 0.6s ease';
            observer.observe(item);
        });
    </script>
</body>
</html>
