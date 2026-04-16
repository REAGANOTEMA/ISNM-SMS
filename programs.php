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
    <title>Programs Offered - Iganga School of Nursing and Midwifery</title>
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

        /* Programs Overview */
        .programs-overview {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            margin-bottom: 3rem;
            text-align: center;
        }

        .overview-text {
            font-size: 1.2rem;
            line-height: 1.8;
            color: var(--text-primary);
            margin-bottom: 2rem;
        }

        .programs-count {
            display: flex;
            justify-content: center;
            gap: 3rem;
            flex-wrap: wrap;
            margin-top: 2rem;
        }

        .count-item {
            text-align: center;
        }

        .count-number {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 900;
            color: var(--primary-blue);
            display: block;
        }

        .count-label {
            color: var(--text-secondary);
            font-size: 1.1rem;
        }

        /* Programs Grid */
        .programs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .program-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            position: relative;
        }

        .program-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-xl);
        }

        .program-header {
            background: var(--gradient-primary);
            color: white;
            padding: 2rem;
            text-align: center;
            position: relative;
        }

        .program-header.certificate {
            background: linear-gradient(135deg, #22c55e, #16a34a);
        }

        .program-header.diploma {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
        }

        .program-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 1rem;
        }

        .program-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .program-type {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .program-image {
            position: relative;
            overflow: hidden;
            height: 200px;
        }

        .program-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .program-card:hover .program-img {
            transform: scale(1.1) rotate(1deg);
        }

        .program-content {
            padding: 2rem;
        }

        .program-description {
            color: var(--text-primary);
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .program-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-top: 1px solid var(--border-color);
        }

        .duration {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-secondary);
        }

        .duration i {
            color: var(--accent-blue);
        }

        .apply-btn {
            background: var(--gradient-luxury);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .apply-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* Program Features */
        .program-features {
            background: rgba(30, 58, 138, 0.05);
            border-radius: 15px;
            padding: 2rem;
            margin-top: 2rem;
        }

        .feature-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--text-primary);
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        /* Admission Requirements */
        .requirements-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            margin-top: 3rem;
        }

        .requirements-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .requirement-card {
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.05), rgba(55, 48, 163, 0.05));
            border-radius: 15px;
            padding: 2rem;
            border: 1px solid var(--border-color);
        }

        .requirement-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }

        .requirement-list {
            list-style: none;
        }

        .requirement-list li {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-primary);
        }

        .requirement-list li:last-child {
            border-bottom: none;
        }

        .requirement-list li i {
            color: var(--light-green);
            margin-top: 0.25rem;
            flex-shrink: 0;
        }

        /* Career Opportunities */
        .careers-section {
            background: var(--gradient-primary);
            color: white;
            border-radius: 20px;
            padding: 3rem;
            margin-top: 3rem;
            position: relative;
            overflow: hidden;
        }

        .careers-section::before {
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

        .careers-content {
            position: relative;
            z-index: 1;
        }

        .careers-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
        }

        .careers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .career-item {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .career-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .career-title {
            font-weight: 600;
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
            
            .programs-grid {
                grid-template-columns: 1fr;
            }
            
            .programs-count {
                gap: 2rem;
            }
            
            .requirements-grid {
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
                    <li><a href="admissions.php"><i class="fas fa-user-plus"></i> Admissions</a></li>
                    <li><a href="contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
                    <li><a href="login-portal.php"><i class="fas fa-sign-in-alt"></i> Portal</a></li>
                </ul>
            </nav>
            <div class="page-title">Programs Offered</div>
            <div class="breadcrumb">
                <p>Home / Academics / Programs</p>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Programs Overview -->
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">4.0 Programs Offered</h2>
                <p class="section-subtitle">Comprehensive healthcare education programs designed for excellence</p>
            </div>
            
            <div class="programs-overview">
                <p class="overview-text">
                    Currently the school offers four (4) programs designed to provide quality healthcare education 
                    and prepare students for successful careers in nursing and midwifery.
                </p>
                
                <div class="programs-count">
                    <div class="count-item">
                        <span class="count-number">4</span>
                        <span class="count-label">Total Programs</span>
                    </div>
                    <div class="count-item">
                        <span class="count-number">2</span>
                        <span class="count-label">Certificate Programs</span>
                    </div>
                    <div class="count-item">
                        <span class="count-number">2</span>
                        <span class="count-label">Diploma Programs</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Programs Grid -->
        <section class="section">
            <div class="programs-grid">
                <!-- Certificate in Nursing -->
                <div class="program-card">
                    <div class="program-header certificate">
                        <div class="program-icon">
                            <i class="fas fa-user-nurse"></i>
                        </div>
                        <h3 class="program-title">Certificate in Nursing</h3>
                        <p class="program-type">Certificate Program</p>
                    </div>
                    <div class="program-image">
                        <img src="assets/certificate-in-nursing-students-in-examamination-room.jpg" alt="Certificate in Nursing Students in Examination Room" class="program-img">
                    </div>
                    <div class="program-content">
                        <p class="program-description">
                            Comprehensive nursing education focusing on fundamental nursing skills, patient care, 
                            and clinical practice. This program prepares students for entry-level nursing positions 
                            in various healthcare settings.
                        </p>
                        <div class="program-features">
                            <h4>Key Features:</h4>
                            <div class="feature-list">
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="fas fa-book"></i>
                                    </div>
                                    <span>Theoretical Knowledge</span>
                                </div>
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="fas fa-hospital"></i>
                                    </div>
                                    <span>Clinical Practice</span>
                                </div>
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="fas fa-flask"></i>
                                    </div>
                                    <span>Skills Laboratory</span>
                                </div>
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="fas fa-certificate"></i>
                                    </div>
                                    <span>National Certification</span>
                                </div>
                            </div>
                        </div>
                        <div class="program-details">
                            <div class="duration">
                                <i class="fas fa-clock"></i>
                                <span>2½ Years</span>
                            </div>
                            <a href="admissions.php" class="apply-btn">
                                <i class="fas fa-paper-plane"></i>
                                Apply Now
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Certificate in Midwifery -->
                <div class="program-card">
                    <div class="program-header certificate">
                        <div class="program-icon">
                            <i class="fas fa-baby"></i>
                        </div>
                        <h3 class="program-title">Certificate in Midwifery</h3>
                        <p class="program-type">Certificate Program</p>
                    </div>
                    <div class="program-image">
                        <img src="assets/midwifery-students-checking-mothers-womb-during-skill-lab-practical-training.jpeg" alt="Midwifery Students in Practical Training" class="program-img">
                    </div>
                    <div class="program-content">
                        <p class="program-description">
                            Specialized midwifery training covering maternal health, childbirth, postnatal care, 
                            and newborn care. Students gain expertise in supporting women throughout pregnancy 
                            and childbirth.
                        </p>
                        <div class="program-features">
                            <h4>Key Features:</h4>
                            <div class="feature-list">
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="fas fa-female"></i>
                                    </div>
                                    <span>Maternal Health</span>
                                </div>
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="fas fa-baby-carriage"></i>
                                    </div>
                                    <span>Newborn Care</span>
                                </div>
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="fas fa-stethoscope"></i>
                                    </div>
                                    <span>Clinical Skills</span>
                                </div>
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="fas fa-award"></i>
                                    </div>
                                    <span>Professional Recognition</span>
                                </div>
                            </div>
                        </div>
                        <div class="program-details">
                            <div class="duration">
                                <i class="fas fa-clock"></i>
                                <span>2½ Years</span>
                            </div>
                            <a href="admissions.php" class="apply-btn">
                                <i class="fas fa-paper-plane"></i>
                                Apply Now
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Diploma in Nursing -->
                <div class="program-card">
                    <div class="program-header diploma">
                        <div class="program-icon">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <h3 class="program-title">Diploma in Nursing</h3>
                        <p class="program-type">Extension Program</p>
                    </div>
                    <div class="program-image">
                        <img src="assets/diploma-in-nursing-and-midwifery-extension-images-for-students.jpg" alt="Diploma in Nursing Extension Program Students" class="program-img">
                    </div>
                    <div class="program-content">
                        <p class="program-description">
                            Advanced nursing education for certificate holders seeking to upgrade their qualifications. 
                            This program builds on existing nursing knowledge and skills for career advancement.
                        </p>
                        <div class="program-features">
                            <h4>Key Features:</h4>
                            <div class="feature-list">
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <span>Advanced Theory</span>
                                </div>
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="fas fa-brain"></i>
                                    </div>
                                    <span>Leadership Skills</span>
                                </div>
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                    <span>Research Methods</span>
                                </div>
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="fas fa-medal"></i>
                                    </div>
                                    <span>Diploma Certification</span>
                                </div>
                            </div>
                        </div>
                        <div class="program-details">
                            <div class="duration">
                                <i class="fas fa-clock"></i>
                                <span>1½ Years</span>
                            </div>
                            <a href="admissions.php" class="apply-btn">
                                <i class="fas fa-paper-plane"></i>
                                Apply Now
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Diploma in Midwifery -->
                <div class="program-card">
                    <div class="program-header diploma">
                        <div class="program-icon">
                            <i class="fas fa-baby"></i>
                        </div>
                        <h3 class="program-title">Diploma in Midwifery</h3>
                        <p class="program-type">Extension Program</p>
                    </div>
                    <div class="program-image">
                        <img src="assets/groups-of-students-in-skills-lab.jpeg" alt="Students in Skills Lab Training" class="program-img">
                    </div>
                    <div class="program-content">
                        <p class="program-description">
                            Advanced midwifery education for certificate holders wanting to enhance their expertise 
                            and career prospects. Focuses on advanced maternal and neonatal care practices.
                        </p>
                        <div class="program-features">
                            <h4>Key Features:</h4>
                            <div class="feature-list">
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="fas fa-heartbeat"></i>
                                    </div>
                                    <span>Advanced Maternal Care</span>
                                </div>
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="fas fa-user-nurse"></i>
                                    </div>
                                    <span>Clinical Leadership</span>
                                </div>
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="fas fa-microscope"></i>
                                    </div>
                                    <span>Research Skills</span>
                                </div>
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="fas fa-trophy"></i>
                                    </div>
                                    <span>Professional Advancement</span>
                                </div>
                            </div>
                        </div>
                        <div class="program-details">
                            <div class="duration">
                                <i class="fas fa-clock"></i>
                                <span>1½ Years</span>
                            </div>
                            <a href="admissions.php" class="apply-btn">
                                <i class="fas fa-paper-plane"></i>
                                Apply Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Admission Requirements -->
        <section class="section">
            <div class="requirements-section">
                <div class="section-header">
                    <h2 class="section-title">Admission Requirements</h2>
                    <p class="section-subtitle">Requirements for certificate and diploma programs</p>
                </div>
                
                <div class="requirements-grid">
                    <!-- Certificate Requirements -->
                    <div class="requirement-card">
                        <h3 class="requirement-title">Certificate Programs</h3>
                        <ul class="requirement-list">
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Uganda Certificate of Education (UCE) with at least 5 passes</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Credits in Biology, Chemistry, and Physics/Mathematics</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Minimum age of 17 years</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Medical fitness certificate</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Two passport photographs</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Letter of recommendation (optional)</span>
                            </li>
                        </ul>
                    </div>
                    
                    <!-- Diploma Requirements -->
                    <div class="requirement-card">
                        <h3 class="requirement-title">Diploma Extension Programs</h3>
                        <ul class="requirement-list">
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Certificate in Nursing or Midwifery from recognized institution</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Valid practicing license from Uganda Nurses and Midwives Council</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Minimum of 2 years working experience</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Reference letter from current employer</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Academic transcripts from certificate program</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Proof of continuing professional development</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Career Opportunities -->
        <section class="section">
            <div class="careers-section">
                <div class="careers-content">
                    <h2 class="careers-title">Career Opportunities</h2>
                    <div class="careers-grid">
                        <div class="career-item">
                            <div class="career-icon">
                                <i class="fas fa-hospital"></i>
                            </div>
                            <h4 class="career-title">Hospitals</h4>
                            <p>National and regional referral hospitals</p>
                        </div>
                        <div class="career-item">
                            <div class="career-icon">
                                <i class="fas fa-clinic-medical"></i>
                            </div>
                            <h4 class="career-title">Health Centers</h4>
                            <p>Government and private health facilities</p>
                        </div>
                        <div class="career-item">
                            <div class="career-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <h4 class="career-title">Education</h4>
                            <p>Nursing and midwifery training institutions</p>
                        </div>
                        <div class="career-item">
                            <div class="career-icon">
                                <i class="fas fa-globe"></i>
                            </div>
                            <h4 class="career-title">International</h4>
                            <p>Global healthcare opportunities</p>
                        </div>
                        <div class="career-item">
                            <div class="career-icon">
                                <i class="fas fa-user-md"></i>
                            </div>
                            <h4 class="career-title">Private Practice</h4>
                            <p>Independent healthcare providers</p>
                        </div>
                        <div class="career-item">
                            <div class="career-icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <h4 class="career-title">Leadership</h4>
                            <p>Healthcare management positions</p>
                        </div>
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


