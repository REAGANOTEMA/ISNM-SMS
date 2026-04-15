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
    <title>Achievements & Future Plans - Iganga School of Nursing and Midwifery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Inter:wght@300;400;500;600;700&family=Copperplate+Gothic+Bold&family=Rockwell+Extra+Bold&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-blue: #1e3a8a;
            --secondary-blue: #3730a3;
            --accent-blue: #3b82f6;
            --light-green: #22c55e;
            --creamy-yellow: #fef3c7;
            --golden-yellow: #fbbf24;
            --neon-cyan: #06b6d4;
            --clean-white: #ffffff;
            --cream-white: #fafafa;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --shadow-sm: 0 4px 8px rgba(0, 0, 0, 0.15);
            --shadow-md: 0 8px 16px rgba(0, 0, 0, 0.2);
            --shadow-xl: 0 32px 64px rgba(0, 0, 0, 0.3);
            --border-color: #e2e8f0;
            --gradient-primary: linear-gradient(135deg, #1e3a8a 0%, #3730a3 25%, #3b82f6 50%, #06b6d4 75%, #22c55e 100%);
            --gradient-hero: linear-gradient(135deg, #1e3a8a 0%, #3730a3 33%, #3b82f6 66%, #06b6d4 100%);
            --gradient-luxury: linear-gradient(135deg, #fbbf24 0%, #f59e0b 50%, #d97706 100%);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--cream-white), var(--clean-white));
            color: var(--text-primary);
            line-height: 1.6;
            overflow-x: hidden;
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

        /* Achievements Section */
        .achievements-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            margin-bottom: 3rem;
        }

        .achievements-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .achievement-card {
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.05), rgba(55, 48, 163, 0.05));
            border-radius: 15px;
            padding: 2rem;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .achievement-card::before {
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

        .achievement-card:hover::before {
            opacity: 1;
        }

        .achievement-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-xl);
        }

        .achievement-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: var(--gradient-luxury);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            box-shadow: 0 0 20px rgba(251, 191, 36, 0.3);
            position: relative;
            z-index: 1;
        }

        .achievement-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .achievement-description {
            color: var(--text-primary);
            font-size: 1.1rem;
            line-height: 1.6;
            position: relative;
            z-index: 1;
        }

        /* Statistics Section */
        .stats-section {
            background: var(--gradient-primary);
            color: white;
            border-radius: 20px;
            padding: 3rem;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        .stats-section::before {
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

        .stats-content {
            position: relative;
            z-index: 1;
        }

        .stats-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
        }

        .stat-item {
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 2rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
        }

        .stat-number {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
            display: block;
        }

        .stat-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* Challenges Section */
        .challenges-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            margin-bottom: 3rem;
        }

        .challenges-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .challenge-card {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.05), rgba(220, 38, 38, 0.05));
            border-radius: 15px;
            padding: 2rem;
            border: 1px solid rgba(239, 68, 68, 0.2);
            transition: all 0.3s ease;
        }

        .challenge-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .challenge-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin: 0 auto 1.5rem;
        }

        .challenge-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: #dc2626;
            margin-bottom: 1rem;
            text-align: center;
        }

        .challenge-description {
            color: var(--text-primary);
            font-size: 1.1rem;
            line-height: 1.6;
            text-align: center;
        }

        /* Future Plans Section */
        .future-plans-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
        }

        .plans-tabs {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 3rem;
            flex-wrap: wrap;
        }

        .plan-tab {
            padding: 1rem 2rem;
            background: var(--gradient-primary);
            color: white;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }

        .plan-tab:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .plan-tab.active {
            background: var(--gradient-luxury);
        }

        .plans-content {
            display: none;
        }

        .plans-content.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .plans-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .plan-card {
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.05), rgba(55, 48, 163, 0.05));
            border-radius: 15px;
            padding: 2rem;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .plan-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .plan-icon {
            width: 60px;
            height: 60px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin: 0 auto 1.5rem;
        }

        .plan-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
            text-align: center;
        }

        .plan-description {
            color: var(--text-primary);
            font-size: 1.1rem;
            line-height: 1.6;
            text-align: center;
        }

        /* Conclusion Section */
        .conclusion-section {
            background: var(--gradient-primary);
            color: white;
            border-radius: 20px;
            padding: 3rem;
            margin-top: 3rem;
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .conclusion-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 25s linear infinite;
        }

        .conclusion-content {
            position: relative;
            z-index: 1;
        }

        .conclusion-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
        }

        .conclusion-text {
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
            
            .achievements-grid {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .challenges-list {
                grid-template-columns: 1fr;
            }
            
            .plans-grid {
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
                    <li><a href="programs.php"><i class="fas fa-graduation-cap"></i> Programs</a></li>
                    <li><a href="achievements.php"><i class="fas fa-trophy"></i> Achievements</a></li>
                    <li><a href="admissions.php"><i class="fas fa-user-plus"></i> Admissions</a></li>
                    <li><a href="contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
                    <li><a href="login-portal.php"><i class="fas fa-sign-in-alt"></i> Portal</a></li>
                </ul>
            </nav>
            <div class="page-title">Achievements & Future Plans</div>
            <div class="breadcrumb">
                <p>Home / About / Achievements & Plans</p>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Achievements Section -->
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">10.0 Achievements, Challenges & Future Plans</h2>
                <p class="section-subtitle">Our journey of excellence and vision for the future</p>
            </div>
            
            <div class="achievements-section">
                <div class="section-header">
                    <h3 class="section-title">10.1 Achievements</h3>
                    <p class="section-subtitle">Milestones and accomplishments in our educational journey</p>
                </div>
                
                <div class="achievements-grid">
                    <div class="achievement-card">
                        <div class="achievement-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <h4 class="achievement-title">Infrastructure Development</h4>
                        <p class="achievement-description">
                            Completion of a multi-purpose hall and first phase of a new storeyed girls' hostel
                        </p>
                    </div>
                    
                    <div class="achievement-card">
                        <div class="achievement-icon">
                            <i class="fas fa-bus"></i>
                        </div>
                        <h4 class="achievement-title">Transport Enhancement</h4>
                        <p class="achievement-description">
                            Acquisition of another coaster bus to help in transportation of students and staff
                        </p>
                    </div>
                    
                    <div class="achievement-card">
                        <div class="achievement-icon">
                            <i class="fas fa-flask"></i>
                        </div>
                        <h4 class="achievement-title">Skills Laboratories</h4>
                        <p class="achievement-description">
                            Separated and equipped the skills laboratories for Midwifery and Nursing sections
                        </p>
                    </div>
                    
                    <div class="achievement-card">
                        <div class="achievement-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h4 class="achievement-title">Academic Excellence</h4>
                        <p class="achievement-description">
                            Performed very well in past state final examinations with 100% pass rate in midwifery and over 85% in nursing
                        </p>
                    </div>
                    
                    <div class="achievement-card">
                        <div class="achievement-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4 class="achievement-title">Student Growth</h4>
                        <p class="achievement-description">
                            Increased student population from 13 in 2009 to current 315 (231 females, 84 males, 117 midwives)
                        </p>
                    </div>
                    
                    <div class="achievement-card">
                        <div class="achievement-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h4 class="achievement-title">Staff Development</h4>
                        <p class="achievement-description">
                            Sponsoring four staff members at Health Tutors' College - Mulage for Medical Education
                        </p>
                    </div>
                    
                    <div class="achievement-card">
                        <div class="achievement-icon">
                            <i class="fas fa-drafting-compass"></i>
                        </div>
                        <h4 class="achievement-title">Structural Planning</h4>
                        <p class="achievement-description">
                            The school has drawn a structural plan to guide future developments
                        </p>
                    </div>
                    
                    <div class="achievement-card">
                        <div class="achievement-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h4 class="achievement-title">Power Solutions</h4>
                        <p class="achievement-description">
                            Acquired generators and solar panels to address load shedding problems
                        </p>
                    </div>
                    
                    <div class="achievement-card">
                        <div class="achievement-icon">
                            <i class="fas fa-map"></i>
                        </div>
                        <h4 class="achievement-title">Land Acquisition</h4>
                        <p class="achievement-description">
                            Acquired over 12 acres of registered/leased land (freehold) for future development
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Statistics Section -->
        <section class="section">
            <div class="stats-section">
                <div class="stats-content">
                    <h2 class="stats-title">Our Impact in Numbers</h2>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-number">315</span>
                            <span class="stat-label">Total Students</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">100%</span>
                            <span class="stat-label">Midwifery Pass Rate</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">85%</span>
                            <span class="stat-label">Nursing Pass Rate</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">12+</span>
                            <span class="stat-label">Acres of Land</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">4</span>
                            <span class="stat-label">Programs Offered</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">7</span>
                            <span class="stat-label">Practicum Sites</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Challenges Section -->
        <section class="section">
            <div class="challenges-section">
                <div class="section-header">
                    <h3 class="section-title">10.2 Challenges</h3>
                    <p class="section-subtitle">Current challenges we are working to overcome</p>
                </div>
                
                <div class="challenges-list">
                    <div class="challenge-card">
                        <div class="challenge-icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <h4 class="challenge-title">Inadequate Funding</h4>
                        <p class="challenge-description">
                            The school currently depends on tuition fees collected from students
                        </p>
                    </div>
                    
                    <div class="challenge-card">
                        <div class="challenge-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <h4 class="challenge-title">Administration Block</h4>
                        <p class="challenge-description">
                            Need for construction of a proper administration block
                        </p>
                    </div>
                    
                    <div class="challenge-card">
                        <div class="challenge-icon">
                            <i class="fas fa-hospital"></i>
                        </div>
                        <h4 class="challenge-title">Hospital Site</h4>
                        <p class="challenge-description">
                            Construction of a basic hospital site for community and student practicum
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Future Plans Section -->
        <section class="section">
            <div class="future-plans-section">
                <div class="section-header">
                    <h3 class="section-title">10.3 Future Plans</h3>
                    <p class="section-subtitle">Our vision for growth and development</p>
                </div>
                
                <div class="plans-tabs">
                    <button class="plan-tab active" onclick="showPlan('short-term')">Short Term</button>
                    <button class="plan-tab" onclick="showPlan('long-term')">Long Term</button>
                </div>
                
                <div id="short-term" class="plans-content active">
                    <div class="plans-grid">
                        <div class="plan-card">
                            <div class="plan-icon">
                                <i class="fas fa-hand-holding-usd"></i>
                            </div>
                            <h4 class="plan-title">Resource Mobilization</h4>
                            <p class="plan-description">
                                Mobilize more resources from within and without
                            </p>
                        </div>
                        
                        <div class="plan-card">
                            <div class="plan-icon">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <h4 class="plan-title">Staff Welfare</h4>
                            <p class="plan-description">
                                Improve the working conditions of our teaching and non-teaching staff
                            </p>
                        </div>
                        
                        <div class="plan-card">
                            <div class="plan-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <h4 class="plan-title">Infrastructure Development</h4>
                            <p class="plan-description">
                                Construct an administration block, classroom block, boys' hostel
                            </p>
                        </div>
                        
                        <div class="plan-card">
                            <div class="plan-icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <h4 class="plan-title">Library Enhancement</h4>
                            <p class="plan-description">
                                Procure more reference books for the library
                            </p>
                        </div>
                        
                        <div class="plan-card">
                            <div class="plan-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <h4 class="plan-title">Staff Training</h4>
                            <p class="plan-description">
                                Continue supporting our clinical instructors to enroll for the Tutors' Training
                            </p>
                        </div>
                    </div>
                </div>
                
                <div id="long-term" class="plans-content">
                    <div class="plans-grid">
                        <div class="plan-card">
                            <div class="plan-icon">
                                <i class="fas fa-desktop"></i>
                            </div>
                            <h4 class="plan-title">Computer Laboratory</h4>
                            <p class="plan-description">
                                Put up a fully registered Computer Laboratory within the school for student certifications
                            </p>
                        </div>
                        
                        <div class="plan-card">
                            <div class="plan-icon">
                                <i class="fas fa-sitemap"></i>
                            </div>
                            <h4 class="plan-title">Institutional Capacity</h4>
                            <p class="plan-description">
                                Improve institutional capacity through setting up of departments like Human Resource, Planning, Administration, Accounts and Finance
                            </p>
                        </div>
                        
                        <div class="plan-card">
                            <div class="plan-icon">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <h4 class="plan-title">Twinning Programs</h4>
                            <p class="plan-description">
                                Twinning with other schools for enhanced collaboration and learning
                            </p>
                        </div>
                        
                        <div class="plan-card">
                            <div class="plan-icon">
                                <i class="fas fa-hospital"></i>
                            </div>
                            <h4 class="plan-title">Community Hospital</h4>
                            <p class="plan-description">
                                Construct a hospital for the community and student's practicum
                            </p>
                        </div>
                        
                        <div class="plan-card">
                            <div class="plan-icon">
                                <i class="fas fa-landmark"></i>
                            </div>
                            <h4 class="plan-title">Government Support</h4>
                            <p class="plan-description">
                                Appeal to the government to support the school through delegated funds
                            </p>
                        </div>
                        
                        <div class="plan-card">
                            <div class="plan-icon">
                                <i class="fas fa-hands-helping"></i>
                            </div>
                            <h4 class="plan-title">Donor Support</h4>
                            <p class="plan-description">
                                Appeal to Ministry of Education and Sports (MOES) and Ministry of Health (MOH) to identify donors to support the school
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Conclusion Section -->
        <section class="section">
            <div class="conclusion-section">
                <div class="conclusion-content">
                    <h2 class="conclusion-title">Conclusion</h2>
                    <p class="conclusion-text">
                        Iganga School of Nursing and Midwifery is committed to fulfilling its objectives as evidenced by its achievements within the years of its existence. This has been attained as a result of the support and guidance from several stakeholders for whom we are grateful. We intend to build on these achievements to take the school to the next level. We call upon the government and all the key stakeholders to continue supporting and guiding the school in this endeavour.
                    </p>
                </div>
            </div>
        </section>
    </main>

    <script>
        // Plan tabs functionality
        function showPlan(planType) {
            // Remove active class from all tabs and contents
            document.querySelectorAll('.plan-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            document.querySelectorAll('.plans-content').forEach(content => {
                content.classList.remove('active');
            });
            
            // Add active class to selected tab and content
            event.target.classList.add('active');
            document.getElementById(planType).classList.add('active');
        }

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
