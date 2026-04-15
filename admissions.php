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
    <title>Admissions - Iganga School of Nursing and Midwifery</title>
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
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="modern-admissions-pattern" width="30" height="30" patternUnits="userSpaceOnUse"><circle cx="15" cy="15" r="3" fill="rgba(139,92,246,0.3)"/><path d="M5 15 Q15 5, 25 15 T45 15" stroke="rgba(59,130,246,0.4)" stroke-width="2" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23modern-admissions-pattern)"/></svg>'),
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><defs><pattern id="vibrant-admissions-pattern" width="50" height="50" patternUnits="userSpaceOnUse"><rect x="10" y="10" width="30" height="30" fill="none" stroke="rgba(236,72,153,0.3)" stroke-width="2"/><circle cx="25" cy="25" r="6" fill="rgba(249,115,22,0.4)"/></pattern></defs><rect width="200" height="200" fill="url(%23vibrant-admissions-pattern)"/></svg>');
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

        /* Admission Overview */
        .admission-overview {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        .admission-overview::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }

        .overview-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .overview-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }

        .overview-subtitle {
            font-size: 1.2rem;
            color: var(--text-secondary);
            max-width: 800px;
            margin: 0 auto;
        }

        /* Program Tabs */
        .program-tabs {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 3rem;
            flex-wrap: wrap;
        }

        .tab-btn {
            padding: 1rem 2rem;
            border: none;
            background: var(--cream-white);
            color: var(--text-primary);
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Copperplate Gothic Bold', 'Rockwell Extra Bold', serif;
            border: 2px solid var(--border-color);
        }

        .tab-btn.active {
            background: var(--gradient-primary);
            color: white;
            border-color: var(--primary-blue);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .tab-btn:hover:not(.active) {
            background: var(--light-green);
            color: white;
            border-color: var(--light-green);
        }

        /* Program Content */
        .program-content {
            display: none;
            animation: fadeInUp 0.5s ease;
        }

        .program-content.active {
            display: block;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Admission Requirements */
        .admission-requirements {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .requirements-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .requirements-list {
            list-style: none;
            display: grid;
            gap: 1rem;
        }

        .requirement-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 1rem;
            background: white;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .requirement-item:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
            border-color: var(--accent-blue);
        }

        .requirement-icon {
            width: 40px;
            height: 40px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            flex-shrink: 0;
        }

        .requirement-text {
            flex: 1;
        }

        .requirement-title {
            font-weight: 600;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
        }

        .requirement-description {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        /* Program Details */
        .program-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .detail-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .detail-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .detail-icon {
            width: 60px;
            height: 60px;
            background: var(--gradient-luxury);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .detail-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }

        .detail-description {
            color: var(--text-secondary);
            line-height: 1.6;
        }

        /* Fee Structure */
        .fee-structure {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            border: 1px solid var(--border-color);
            margin-bottom: 2rem;
        }

        .fee-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .fee-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.5rem;
        }

        .fee-table th,
        .fee-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .fee-table th {
            background: var(--gradient-primary);
            color: white;
            font-weight: 600;
        }

        .fee-table tr:hover {
            background: var(--cream-white);
        }

        .fee-amount {
            font-weight: 700;
            color: var(--primary-blue);
            font-size: 1.1rem;
        }

        /* Application Process */
        .application-process {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .process-steps {
            display: grid;
            gap: 1.5rem;
        }

        .process-step {
            display: flex;
            align-items: flex-start;
            gap: 1.5rem;
            padding: 1.5rem;
            background: white;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .process-step:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        .step-number {
            width: 50px;
            height: 50px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .step-content {
            flex: 1;
        }

        .step-title {
            font-weight: 600;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
        }

        .step-description {
            color: var(--text-secondary);
        }

        /* CTA Section */
        .cta-section {
            background: var(--gradient-primary);
            color: white;
            border-radius: 20px;
            padding: 3rem;
            text-align: center;
            margin-top: 3rem;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
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

        .cta-content {
            position: relative;
            z-index: 1;
        }

        .cta-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .cta-description {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .cta-btn {
            padding: 1.2rem 2.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            font-family: 'Copperplate Gothic Bold', 'Rockwell Extra Bold', serif;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .cta-btn-primary {
            background: white;
            color: var(--primary-blue);
            box-shadow: var(--shadow-md);
        }

        .cta-btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-xl);
        }

        .cta-btn-secondary {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .cta-btn-secondary:hover {
            background: white;
            color: var(--primary-blue);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .page-title {
                font-size: 2rem;
            }
            
            .program-tabs {
                flex-direction: column;
                align-items: center;
            }
            
            .tab-btn {
                width: 100%;
                max-width: 300px;
            }
            
            .program-details {
                grid-template-columns: 1fr;
            }
            
            .cta-buttons {
                flex-direction: column;
                align-items: center;
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
                    <li><a href="admissions.php" style="background: rgba(255, 255, 255, 0.2);"><i class="fas fa-user-plus"></i> Admissions</a></li>
                    <li><a href="activities.php"><i class="fas fa-running"></i> Activities</a></li>
                    <li><a href="infrastructure.php"><i class="fas fa-building"></i> Infrastructure</a></li>
                    <li><a href="achievements.php"><i class="fas fa-trophy"></i> Achievements</a></li>
                    <li><a href="history.php"><i class="fas fa-history"></i> History</a></li>
                    <li><a href="contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
                    <li><a href="login-portal.php"><i class="fas fa-sign-in-alt"></i> Portal</a></li>
                </ul>
            </nav>
            <div class="page-title">Admissions</div>
            <div class="breadcrumb">
                <p>Home / Admissions</p>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Admission Overview -->
        <section class="admission-overview">
            <div class="overview-header">
                <h2 class="overview-title">Join Our Healthcare Community</h2>
                <p class="overview-subtitle">
                    Take the first step towards a rewarding career in nursing and midwifery. 
                    Our comprehensive programs are designed to meet the highest standards of healthcare education.
                </p>
            </div>

            <!-- Program Tabs -->
            <div class="program-tabs">
                <button class="tab-btn active" onclick="showProgram('diploma')">
                    <i class="fas fa-graduation-cap"></i> Diploma Programs
                </button>
                <button class="tab-btn" onclick="showProgram('certificate')">
                    <i class="fas fa-certificate"></i> Certificate Programs
                </button>
            </div>

            <!-- Diploma Program Content -->
            <div id="diploma" class="program-content active">
                <div class="admission-requirements">
                    <h3 class="requirements-title">
                        <i class="fas fa-clipboard-check"></i>
                        Diploma Admission Requirements
                    </h3>
                    <ul class="requirements-list">
                        <li class="requirement-item">
                            <div class="requirement-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="requirement-text">
                                <div class="requirement-title">Academic Qualifications</div>
                                <div class="requirement-description">
                                    Uganda Advanced Certificate of Education (UACE) with at least 2 principal passes in any subjects
                                </div>
                            </div>
                        </li>
                        <li class="requirement-item">
                            <div class="requirement-icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="requirement-text">
                                <div class="requirement-title">O-Level Requirements</div>
                                <div class="requirement-description">
                                    Uganda Certificate of Education (UCE) with at least 5 passes, including English, Biology, Chemistry, and Physics
                                </div>
                            </div>
                        </li>
                        <li class="requirement-item">
                            <div class="requirement-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="requirement-text">
                                <div class="requirement-title">Age Requirement</div>
                                <div class="requirement-description">
                                    Minimum age of 17 years at the time of admission
                                </div>
                            </div>
                        </li>
                        <li class="requirement-item">
                            <div class="requirement-icon">
                                <i class="fas fa-heartbeat"></i>
                            </div>
                            <div class="requirement-text">
                                <div class="requirement-title">Medical Fitness</div>
                                <div class="requirement-description">
                                    Medical fitness certificate from a registered medical practitioner
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="program-details">
                    <div class="detail-card">
                        <div class="detail-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3 class="detail-title">Program Duration</h3>
                        <p class="detail-description">
                            3 years full-time program with comprehensive theoretical and practical training
                        </p>
                    </div>
                    <div class="detail-card">
                        <div class="detail-icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <h3 class="detail-title">Award</h3>
                        <p class="detail-description">
                            Diploma in Nursing or Diploma in Midwifery recognized by Uganda Nursing and Midwifery Council
                        </p>
                    </div>
                    <div class="detail-card">
                        <div class="detail-icon">
                            <i class="fas fa-hospital"></i>
                        </div>
                        <h3 class="detail-title">Clinical Practice</h3>
                        <p class="detail-description">
                            Extensive clinical rotations in partner hospitals and healthcare facilities
                        </p>
                    </div>
                </div>

                <div class="fee-structure">
                    <h3 class="fee-title">Diploma Program Fee Structure</h3>
                    <table class="fee-table">
                        <thead>
                            <tr>
                                <th>Fee Item</th>
                                <th>Amount (UGX)</th>
                                <th>Payment Schedule</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Admission Fee</td>
                                <td class="fee-amount">95,000</td>
                                <td>One-time payment</td>
                            </tr>
                            <tr>
                                <td>Tuition Fee (Per Semester)</td>
                                <td class="fee-amount">850,000</td>
                                <td>6 installments</td>
                            </tr>
                            <tr>
                                <td>Practical Fee (Per Semester)</td>
                                <td class="fee-amount">200,000</td>
                                <td>6 installments</td>
                            </tr>
                            <tr>
                                <td>Development Fee</td>
                                <td class="fee-amount">150,000</td>
                                <td>One-time payment</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Certificate Program Content -->
            <div id="certificate" class="program-content">
                <div class="admission-requirements">
                    <h3 class="requirements-title">
                        <i class="fas fa-clipboard-check"></i>
                        Certificate Admission Requirements
                    </h3>
                    <ul class="requirements-list">
                        <li class="requirement-item">
                            <div class="requirement-icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="requirement-text">
                                <div class="requirement-title">Academic Qualifications</div>
                                <div class="requirement-description">
                                    Uganda Certificate of Education (UCE) with at least 5 passes
                                </div>
                            </div>
                        </li>
                        <li class="requirement-item">
                            <div class="requirement-icon">
                                <i class="fas fa-flask"></i>
                            </div>
                            <div class="requirement-text">
                                <div class="requirement-title">Science Subjects</div>
                                <div class="requirement-description">
                                    Preference given to candidates with passes in Biology, Chemistry, and Physics
                                </div>
                            </div>
                        </li>
                        <li class="requirement-item">
                            <div class="requirement-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="requirement-text">
                                <div class="requirement-title">Age Requirement</div>
                                <div class="requirement-description">
                                    Minimum age of 16 years at the time of admission
                                </div>
                            </div>
                        </li>
                        <li class="requirement-item">
                            <div class="requirement-icon">
                                <i class="fas fa-heartbeat"></i>
                            </div>
                            <div class="requirement-text">
                                <div class="requirement-title">Medical Fitness</div>
                                <div class="requirement-description">
                                    Medical fitness certificate from a registered medical practitioner
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="program-details">
                    <div class="detail-card">
                        <div class="detail-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3 class="detail-title">Program Duration</h3>
                        <p class="detail-description">
                            2 years full-time program with focused theoretical and practical training
                        </p>
                    </div>
                    <div class="detail-card">
                        <div class="detail-icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <h3 class="detail-title">Award</h3>
                        <p class="detail-description">
                            Certificate in Nursing or Certificate in Midwifery recognized by Uganda Nursing and Midwifery Council
                        </p>
                    </div>
                    <div class="detail-card">
                        <div class="detail-icon">
                            <i class="fas fa-hospital"></i>
                        </div>
                        <h3 class="detail-title">Clinical Practice</h3>
                        <p class="detail-description">
                            Structured clinical placements in partner healthcare facilities
                        </p>
                    </div>
                </div>

                <div class="fee-structure">
                    <h3 class="fee-title">Certificate Program Fee Structure</h3>
                    <table class="fee-table">
                        <thead>
                            <tr>
                                <th>Fee Item</th>
                                <th>Amount (UGX)</th>
                                <th>Payment Schedule</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Admission Fee</td>
                                <td class="fee-amount">90,000</td>
                                <td>One-time payment</td>
                            </tr>
                            <tr>
                                <td>Tuition Fee (Per Semester)</td>
                                <td class="fee-amount">650,000</td>
                                <td>4 installments</td>
                            </tr>
                            <tr>
                                <td>Practical Fee (Per Semester)</td>
                                <td class="fee-amount">150,000</td>
                                <td>4 installments</td>
                            </tr>
                            <tr>
                                <td>Development Fee</td>
                                <td class="fee-amount">100,000</td>
                                <td>One-time payment</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Application Process -->
        <section class="application-process">
            <h3 class="requirements-title">
                <i class="fas fa-tasks"></i>
                Application Process
            </h3>
            <div class="process-steps">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h4 class="step-title">Obtain Application Form</h4>
                        <p class="step-description">
                            Collect application form from the school administration office or download from our website
                        </p>
                    </div>
                </div>
                <div class="process-step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h4 class="step-title">Complete Application</h4>
                        <p class="step-description">
                            Fill in all required information and attach necessary documents
                        </p>
                    </div>
                </div>
                <div class="process-step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h4 class="step-title">Submit Application</h4>
                        <p class="step-description">
                            Submit completed application form with required documents and pay admission fee
                        </p>
                    </div>
                </div>
                <div class="process-step">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h4 class="step-title">Interview & Assessment</h4>
                        <p class="step-description">
                            Attend scheduled interview and assessment session
                        </p>
                    </div>
                </div>
                <div class="process-step">
                    <div class="step-number">5</div>
                    <div class="step-content">
                        <h4 class="step-title">Admission Confirmation</h4>
                        <p class="step-description">
                            Receive admission letter and complete registration process
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section">
            <div class="cta-content">
                <h2 class="cta-title">Ready to Start Your Healthcare Journey?</h2>
                <p class="cta-description">
                    Join thousands of successful healthcare professionals who started their careers at ISNM
                </p>
                <div class="cta-buttons">
                    <a href="#" class="cta-btn cta-btn-primary">
                        <i class="fas fa-download"></i> Download Application Form
                    </a>
                    <a href="contact.php" class="cta-btn cta-btn-secondary">
                        <i class="fas fa-phone"></i> Contact Admissions Office
                    </a>
                </div>
            </div>
        </section>
    </main>

    <script>
        function showProgram(programType) {
            // Hide all program contents
            document.querySelectorAll('.program-content').forEach(content => {
                content.classList.remove('active');
            });
            
            // Remove active class from all tabs
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            
            // Show selected program content
            document.getElementById(programType).classList.add('active');
            
            // Add active class to clicked tab
            event.target.classList.add('active');
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
