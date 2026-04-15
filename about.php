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
    <title>About Us - Iganga School of Nursing and Midwifery</title>
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
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="modern-about-pattern" width="30" height="30" patternUnits="userSpaceOnUse"><circle cx="15" cy="15" r="3" fill="rgba(139,92,246,0.3)"/><path d="M5 15 Q15 5, 25 15 T45 15" stroke="rgba(59,130,246,0.4)" stroke-width="2" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23modern-about-pattern)"/></svg>'),
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><defs><pattern id="vibrant-about-pattern" width="50" height="50" patternUnits="userSpaceOnUse"><rect x="10" y="10" width="30" height="30" fill="none" stroke="rgba(236,72,153,0.3)" stroke-width="2"/><circle cx="25" cy="25" r="6" fill="rgba(249,115,22,0.4)"/></pattern></defs><rect width="200" height="200" fill="url(%23vibrant-about-pattern)"/></svg>');
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
        .section:nth-child(4) { animation-delay: 0.4s; }
        .section:nth-child(5) { animation-delay: 0.5s; }

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

        /* Introduction Section */
        .intro-card {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .intro-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: var(--gradient-primary);
        }

        .intro-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--text-primary);
        }

        .registration-badges {
            display: flex;
            gap: 2rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, var(--light-green), var(--accent-blue));
            color: white;
            border-radius: 50px;
            font-weight: 600;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
        }

        .badge:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* Vision Mission Section */
        .vm-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .vm-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .vm-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.05), rgba(55, 48, 163, 0.05));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .vm-card:hover::before {
            opacity: 1;
        }

        .vm-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-xl);
        }

        .vm-icon {
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
        }

        .vm-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }

        .vm-content {
            color: var(--text-primary);
            font-size: 1.1rem;
            line-height: 1.6;
            font-style: italic;
            position: relative;
            z-index: 1;
        }

        /* Strategic Objectives */
        .objectives-list {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
        }

        .objective-item {
            display: flex;
            align-items: flex-start;
            gap: 1.5rem;
            padding: 1.5rem 0;
            border-bottom: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .objective-item:last-child {
            border-bottom: none;
        }

        .objective-item:hover {
            background: rgba(30, 58, 138, 0.05);
            margin: 0 -1rem;
            padding: 1.5rem;
            border-radius: 10px;
        }

        .objective-icon {
            width: 50px;
            height: 50px;
            background: var(--gradient-luxury);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .objective-text {
            font-size: 1.1rem;
            line-height: 1.6;
            color: var(--text-primary);
        }

        /* Core Values */
        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 3rem;
        }

        .value-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .value-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
            border-color: var(--accent-blue);
        }

        .value-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--accent-blue), var(--neon-cyan));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin: 0 auto 1rem;
        }

        .value-title {
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        /* Motto Section */
        .motto-section {
            background: var(--gradient-primary);
            color: white;
            border-radius: 20px;
            padding: 3rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .motto-section::before {
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

        .motto-text {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 900;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .motto-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            position: relative;
            z-index: 1;
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
            
            .motto-text {
                font-size: 1.8rem;
            }
            
            .registration-badges {
                flex-direction: column;
            }
            
            .vm-grid {
                grid-template-columns: 1fr;
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
            <div class="page-title">About Our School</div>
            <div class="breadcrumb">
                <p>Home / About Us</p>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Introduction Section -->
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">1.0 Introduction</h2>
                <p class="section-subtitle">Learn about our prestigious institution and commitment to excellence</p>
            </div>
            
            <div class="intro-card">
                <div class="intro-content">
                    <p>Iganga School of Nursing and Midwifery is a private Nursing School registered by the Registrar of Companies as a Limited Liability Company. The school is also registered with the Ministry of Education & Sports (MOES) and Uganda Nurses and Midwives Council (UNMC).</p>
                </div>
                
                <div class="registration-badges">
                    <div class="badge">
                        <i class="fas fa-building"></i>
                        <span>Limited Liability Company</span>
                    </div>
                    <div class="badge">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Ministry of Education & Sports</span>
                    </div>
                    <div class="badge">
                        <i class="fas fa-user-nurse"></i>
                        <span>Uganda Nurses & Midwives Council</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Vision, Mission, Strategic Objectives -->
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">2.0 Vision, Mission & Core Values</h2>
                <p class="section-subtitle">Our guiding principles and strategic direction</p>
            </div>
            
            <div class="vm-grid">
                <div class="vm-card">
                    <div class="vm-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3 class="vm-title">2.1 Vision</h3>
                    <p class="vm-content">"To have a healthy and disease free community"</p>
                </div>
                
                <div class="vm-card">
                    <div class="vm-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3 class="vm-title">2.2 Mission</h3>
                    <p class="vm-content">"To produce world class and competitive health workers through the use of modern teaching methods, technology and research"</p>
                </div>
                
                <div class="vm-card">
                    <div class="vm-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h3 class="vm-title">2.3 Strategic Objectives</h3>
                    <p class="vm-content">Build institutional capacity, enhance resource mobilization, develop strategic partnerships, and promote stakeholder participation</p>
                </div>
            </div>
        </section>

        <!-- Strategic Objectives Details -->
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">2.3 Strategic Objectives</h2>
                <p class="section-subtitle">Our key strategic goals for sustainable development</p>
            </div>
            
            <div class="objectives-list">
                <div class="objective-item">
                    <div class="objective-icon">
                        <i class="fas fa-school"></i>
                    </div>
                    <div class="objective-text">
                        <strong>Build the Institutional capacity</strong> of the school to train quality nurses and midwives
                    </div>
                </div>
                
                <div class="objective-item">
                    <div class="objective-icon">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <div class="objective-text">
                        <strong>Enhance resource mobilization, utilization and management</strong> for sustainable development of the school
                    </div>
                </div>
                
                <div class="objective-item">
                    <div class="objective-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <div class="objective-text">
                        <strong>Develop strategic partnerships and networks</strong> at local, national and international levels to enhance the learning/teaching environment
                    </div>
                </div>
                
                <div class="objective-item">
                    <div class="objective-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="objective-text">
                        <strong>Promote the participation of all stakeholders</strong> in the affairs of the school
                    </div>
                </div>
            </div>
        </section>

        <!-- Core Values -->
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">2.5 Core Values</h2>
                <p class="section-subtitle">The guiding principles that define our institution</p>
            </div>
            
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-balance-scale"></i>
                    </div>
                    <h4 class="value-title">Good Governance</h4>
                    <p>Transparent and accountable management practices</p>
                </div>
                
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h4 class="value-title">Transparency & Accountability</h4>
                    <p>Open and responsible operations</p>
                </div>
                
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <h4 class="value-title">Professionalism</h4>
                    <p>High standards in all our activities</p>
                </div>
                
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-people-arrows"></i>
                    </div>
                    <h4 class="value-title">Teamwork</h4>
                    <p>Collaborative approach to success</p>
                </div>
                
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-handshake-alt"></i>
                    </div>
                    <h4 class="value-title">Partnerships</h4>
                    <p>Building strong relationships</p>
                </div>
                
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h4 class="value-title">Non-Partisan</h4>
                    <p>Inclusive and non-discriminatory approach</p>
                </div>
            </div>
        </section>

        <!-- Motto Section -->
        <section class="section">
            <div class="motto-section">
                <h2 class="motto-text">"Chosen to Serve"</h2>
                <p class="motto-subtitle">Based on a disciplined mind for a health action</p>
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
