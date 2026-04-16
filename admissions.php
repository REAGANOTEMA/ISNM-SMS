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
            
            /* Additional colors for form */
            --primary-blue: #2563eb;
            --text-primary: #1a202c;
            --text-secondary: #4a5568;
            --border-color: #e2e8f0;
            --cream-white: #fefefe;
            --clean-white: #ffffff;
            --light-green: #10b981;
            
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

        .fee-table-container {
            overflow-x: auto;
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

        /* Application Form Styles */
        .application-form-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            margin-bottom: 3rem;
        }

        .application-form-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }

        .form-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .form-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }

        .form-description {
            font-size: 1.2rem;
            color: var(--text-secondary);
            max-width: 800px;
            margin: 0 auto;
        }

        .application-form {
            max-width: 800px;
            margin: 0 auto;
        }

        .form-row {
            display: flex;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .form-group {
            flex: 1;
        }

        .form-group.full-width {
            width: 100%;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 1rem;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
            background: var(--white);
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .file-upload {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .file-upload input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .file-upload-label {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            border: 2px dashed var(--border-color);
            border-radius: 10px;
            background: var(--gray-light);
            cursor: pointer;
            transition: all 0.3s ease;
            min-height: 60px;
        }

        .file-upload-label:hover {
            border-color: var(--primary-blue);
            background: rgba(37, 99, 235, 0.05);
        }

        .file-upload-label i {
            margin-right: 0.5rem;
            color: var(--text-secondary);
        }

        .file-name {
            margin-left: 0.5rem;
            color: var(--primary-blue);
            font-weight: 500;
        }

        .submit-btn {
            display: block;
            width: 100%;
            padding: 1.2rem;
            background: var(--gradient-primary);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 1.2rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Copperplate Gothic Bold', 'Rockwell Extra Bold', serif;
            margin-top: 2rem;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .required {
            color: #dc2626;
        }

        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 1rem;
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
                                    No age restriction, at the time of admission
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
                            3 semesters (1.5 years) extension program with comprehensive theoretical and practical training
                        </p>
                    </div>
                    <div class="detail-card">
                        <div class="detail-icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <h3 class="detail-title">Award</h3>
                        <p class="detail-description">
                            Diploma in Midwifery recognized by Uganda Nursing and Midwifery Council
                        </p>
                    </div>
                    <div class="detail-card">
                        <div class="detail-icon">
                            <i class="fas fa-hospital"></i>
                        </div>
                        <h3 class="detail-title">Clinical Practice</h3>
                        <p class="detail-description">
                            Extensive clinical rotations in partner hospitals and healthcare facilities with specialized midwifery focus
                        </p>
                    </div>
                </div>

                <div class="fee-structure">
                    <h3 class="fee-title">Diploma Midwifery Extension Program Fee Structure</h3>
                    <div class="fee-table-container">
                        <table class="fee-table">
                        <thead>
                            <tr>
                                <th>Particular Item</th>
                                <th>1st Semester (UGX)</th>
                                <th>2nd Semester (UGX)</th>
                                <th>3rd Semester (UGX)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tuition</td>
                                <td class="fee-amount">670,000</td>
                                <td class="fee-amount">750,000</td>
                                <td class="fee-amount">750,000</td>
                            </tr>
                            <tr>
                                <td>Accommodation</td>
                                <td class="fee-amount">450,000</td>
                                <td class="fee-amount">450,000</td>
                                <td class="fee-amount">490,000</td>
                            </tr>
                            <tr>
                                <td>Students welfare/Feeding</td>
                                <td class="fee-amount">455,000</td>
                                <td class="fee-amount">455,000</td>
                                <td class="fee-amount">465,000</td>
                            </tr>
                            <tr>
                                <td>External Examination</td>
                                <td class="fee-amount">230,000</td>
                                <td class="fee-amount">230,000</td>
                                <td class="fee-amount">230,000</td>
                            </tr>
                            <tr>
                                <td>Practicum/field experience</td>
                                <td class="fee-amount">350,000</td>
                                <td class="fee-amount">450,000</td>
                                <td class="fee-amount">-</td>
                            </tr>
                            <tr>
                                <td>Domiciliary Practice</td>
                                <td class="fee-amount">50,000</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                            </tr>
                            <tr>
                                <td>Medical Care</td>
                                <td class="fee-amount">20,000</td>
                                <td class="fee-amount">20,000</td>
                                <td class="fee-amount">20,000</td>
                            </tr>
                            <tr>
                                <td>Research Fees</td>
                                <td class="fee-amount">150,000</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                            </tr>
                            <tr>
                                <td>Professional Uniform while in Hospital</td>
                                <td class="fee-amount">150,000</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                            </tr>
                            <tr>
                                <td>Uniform while at School</td>
                                <td class="fee-amount">95,000</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                            </tr>
                            <tr>
                                <td>Identity Card</td>
                                <td class="fee-amount">20,000</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                            </tr>
                            <tr>
                                <td colspan="4" style="font-weight: bold; text-align: center; background: #f8f9fa;">STUDENTS' ASSOCIATIONS</td>
                            </tr>
                            <tr>
                                <td>Guild fees</td>
                                <td class="fee-amount">10,000</td>
                                <td class="fee-amount">10,000</td>
                                <td class="fee-amount">-</td>
                            </tr>
                            <tr>
                                <td>UNSA</td>
                                <td class="fee-amount">2,000</td>
                                <td class="fee-amount">2,000</td>
                                <td class="fee-amount">-</td>
                            </tr>
                            <tr>
                                <td>NCHE</td>
                                <td class="fee-amount">20,000</td>
                                <td class="fee-amount">20,000</td>
                                <td class="fee-amount">-</td>
                            </tr>
                            <tr>
                                <td>UNASNM</td>
                                <td class="fee-amount">25,000</td>
                                <td class="fee-amount">20,000</td>
                                <td class="fee-amount">20,000</td>
                            </tr>
                            <tr>
                                <td colspan="4" style="font-weight: bold; text-align: center; background: #f8f9fa;">PROFESSIONAL REQUIREMENTS</td>
                            </tr>
                            <tr>
                                <td>Midwifery Logbook</td>
                                <td class="fee-amount">30,000</td>
                                <td class="fee-amount">15,000</td>
                                <td class="fee-amount">-</td>
                            </tr>
                            <tr>
                                <td>Research guideline</td>
                                <td class="fee-amount">20,000</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                            </tr>
                            <tr>
                                <td>HTIN Number (TVET)</td>
                                <td class="fee-amount">20,000</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                            </tr>
                            <tr>
                                <td>Marking of Logbooks</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                            </tr>
                            <tr style="font-weight: bold; background: #e9ecef;">
                                <td>GRAND TOTAL</td>
                                <td class="fee-amount">2,612,000</td>
                                <td class="fee-amount">2,475,000</td>
                                <td class="fee-amount">2,477,000</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                    <p style="text-align: center; font-style: italic; margin-top: 1rem; color: #6c757d;">
                        N.B THE FEES STRUCTURE IS SUBJECT TO CHANGES
                    </p>
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
                                    Minimum age of 18 years at the time of admission
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
                            2.5 years (5 semesters) full-time program with comprehensive theoretical and practical training
                        </p>
                    </div>
                    <div class="detail-card">
                        <div class="detail-icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <h3 class="detail-title">Award</h3>
                        <p class="detail-description">
                            Certificate in Nursing recognized by Uganda Nursing and Midwifery Council
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
                    <h3 class="fee-title">Certificate in Nursing Fee Structure</h3>
                    <div class="fee-table-container">
                        <table class="fee-table">
                        <thead>
                            <tr>
                                <th>Particular Item</th>
                                <th>1st Semester (UGX)</th>
                                <th>2nd Semester (UGX)</th>
                                <th>3rd Semester (UGX)</th>
                                <th>4th Semester (UGX)</th>
                                <th>5th Semester (UGX)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tuition</td>
                                <td class="fee-amount">600,000</td>
                                <td class="fee-amount">650,000</td>
                                <td class="fee-amount">650,000</td>
                                <td class="fee-amount">650,000</td>
                                <td class="fee-amount">650,000</td>
                            </tr>
                            <tr>
                                <td>Accommodation/Boarding</td>
                                <td class="fee-amount">420,000</td>
                                <td class="fee-amount">420,000</td>
                                <td class="fee-amount">420,000</td>
                                <td class="fee-amount">420,000</td>
                                <td class="fee-amount">420,000</td>
                            </tr>
                            <tr>
                                <td>Feeding Meals</td>
                                <td class="fee-amount">450,000</td>
                                <td class="fee-amount">475,000</td>
                                <td class="fee-amount">475,000</td>
                                <td class="fee-amount">475,000</td>
                                <td class="fee-amount">475,000</td>
                            </tr>
                            <tr>
                                <td>Practicum/Field Experience</td>
                                <td class="fee-amount">180,000</td>
                                <td class="fee-amount">255,000</td>
                                <td class="fee-amount">255,000</td>
                                <td class="fee-amount">255,000</td>
                                <td class="fee-amount">185,000</td>
                            </tr>
                            <tr>
                                <td>External Examination</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                            </tr>
                            <tr>
                                <td>ICT/Computer</td>
                                <td class="fee-amount">80,000</td>
                                <td class="fee-amount">80,000</td>
                                <td class="fee-amount">80,000</td>
                                <td class="fee-amount">80,000</td>
                                <td class="fee-amount">80,000</td>
                            </tr>
                            <tr>
                                <td>Medical Health Care</td>
                                <td class="fee-amount">20,000</td>
                                <td class="fee-amount">20,000</td>
                                <td class="fee-amount">20,000</td>
                                <td class="fee-amount">20,000</td>
                                <td class="fee-amount">20,000</td>
                            </tr>
                            <tr>
                                <td>Guild Fee</td>
                                <td class="fee-amount">10,000</td>
                                <td class="fee-amount">10,000</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">10,000</td>
                                <td class="fee-amount">-</td>
                            </tr>
                            <tr>
                                <td colspan="6" style="font-weight: bold; text-align: center; background: #f8f9fa;">OTHER REQUIREMENTS</td>
                            </tr>
                            <tr>
                                <td>Identity Card/Name Tag</td>
                                <td class="fee-amount">20,000</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                            </tr>
                            <tr>
                                <td>Uniforms (2) while in Hospital</td>
                                <td class="fee-amount">130,000</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                            </tr>
                            <tr>
                                <td>Uniforms while at School</td>
                                <td class="fee-amount">20,000</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                            </tr>
                            <tr>
                                <td>Nurses Logbook</td>
                                <td class="fee-amount">20,000</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                            </tr>
                            <tr>
                                <td>UNSA</td>
                                <td class="fee-amount">2,000</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                            </tr>
                            <tr>
                                <td>HTIN Number (TVET)</td>
                                <td class="fee-amount">2,000</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                            </tr>
                            <tr>
                                <td>UNASNM</td>
                                <td class="fee-amount">25,000</td>
                                <td class="fee-amount">20,000</td>
                                <td class="fee-amount">20,000</td>
                                <td class="fee-amount">20,000</td>
                                <td class="fee-amount">20,000</td>
                            </tr>
                            <tr>
                                <td>WORKSHOPS (IMCI & IYCF)</td>
                                <td class="fee-amount">50,000</td>
                                <td class="fee-amount">35,000</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                            </tr>
                            <tr>
                                <td>Marking of students Logbooks</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                                <td class="fee-amount">-</td>
                            </tr>
                        </tbody>
                    </table>
                    <div style="margin-top: 1rem; padding: 1rem; background: #f8f9fa; border-radius: 10px;">
                        <h4 style="margin-bottom: 0.5rem; color: #1a202c;">GRAND TOTAL PER SEMESTER</h4>
                        <div style="display: flex; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
                            <div><strong>1st Semester:</strong> 2,277,000 UGX</div>
                            <div><strong>2nd Semester:</strong> 2,120,000 UGX</div>
                            <div><strong>3rd Semester:</strong> 2,130,000 UGX</div>
                            <div><strong>4th Semester:</strong> 2,120,000 UGX</div>
                            <div><strong>5th Semester:</strong> 2,245,000 UGX</div>
                        </div>
                    </div>
                    </div>
                    <p style="text-align: center; font-style: italic; margin-top: 1rem; color: #6c757d;">
                        NB: THE FEES STRUCTURE IS SUBJECT TO CHANGE
                    </p>
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
                    <a href="contact.php" class="cta-btn cta-btn-secondary">
                        <i class="fas fa-phone"></i> Contact Admissions Office
                    </a>
                </div>
            </div>
        </section>

        <!-- Online Application Form -->
        <section class="application-form-section">
            <div class="form-header">
                <h2 class="form-title">Online Application Form</h2>
                <p class="form-description">
                    Apply online for admission to Iganga School of Nursing and Midwifery. Fill in all required information carefully.
                </p>
            </div>
            <form class="application-form" action="submit-application.php" method="POST" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name" class="form-label">First Name <span class="required">*</span></label>
                        <input type="text" id="first_name" name="first_name" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="surname" class="form-label">Surname <span class="required">*</span></label>
                        <input type="text" id="surname" name="surname" class="form-input" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="date_of_birth" class="form-label">Date of Birth <span class="required">*</span></label>
                        <input type="date" id="date_of_birth" name="date_of_birth" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="contacts" class="form-label">Contact Number <span class="required">*</span></label>
                        <input type="tel" id="contacts" name="contacts" class="form-input" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="level" class="form-label">Level Applying For <span class="required">*</span></label>
                        <select id="level" name="level" class="form-select" required>
                            <option value="">Select Level</option>
                            <option value="Certificate">Certificate</option>
                            <option value="Diploma">Diploma</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="course" class="form-label">Course <span class="required">*</span></label>
                        <select id="course" name="course" class="form-select" required>
                            <option value="">Select Course</option>
                            <option value="Diploma in Nursing"> Nursing</option>
                            <option value="Diploma in Midwifery">Midwifery</option>
                        </select>
                    </div>
                </div>
                <div class="form-group full-width">
                    <label for="address" class="form-label">Location Address <span class="required">*</span></label>
                    <textarea id="address" name="address" class="form-textarea" placeholder="Enter your full address" required></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Upload Academic Document (PDF, JPEG, PNG, DOC) <span class="required">*</span></label>
                        <div class="file-upload">
                            <input type="file" id="document" name="document" accept=".pdf,.jpeg,.jpg,.png,.doc,.docx" required>
                            <label for="document" class="file-upload-label">
                                <i class="fas fa-upload"></i>
                                <span>Choose file...</span>
                                <span id="document-name" class="file-name"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Upload Your Photo <span class="required">*</span></label>
                        <div class="file-upload">
                            <input type="file" id="image" name="image" accept=".jpeg,.jpg,.png" required>
                            <label for="image" class="file-upload-label">
                                <i class="fas fa-camera"></i>
                                <span>Choose image...</span>
                                <span id="image-name" class="file-name"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="submit-btn">
                    <i class="fas fa-paper-plane"></i> Submit Application
                </button>
            </form>
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

        // File upload display
        document.getElementById('document').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : '';
            document.getElementById('document-name').textContent = fileName;
        });

        document.getElementById('image').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : '';
            document.getElementById('image-name').textContent = fileName;
        });
    </script>
</body>
</html>


