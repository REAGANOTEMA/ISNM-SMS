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
    <link rel="stylesheet" href="assets/modern-theme.css">
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
            --success-3d: #10B981;
            --warning-3d: #F59E0B;
            --danger-3d: #EF4444;
            --info-3d: #06B6D4;
            --dark-3d: #0F172A;
            --light-3d: #F1F5F9;
            
            /* Mind-Blowing 3D Gradients */
            --gradient-3d-hero: linear-gradient(135deg, #0F4C75 0%, #1E6BA8 25%, #2E8BC0 50%, #16A5A5 75%, #0EA5E9 100%);
            --gradient-3d-primary: linear-gradient(135deg, #0F4C75 0%, #1E6BA8 50%, #2E8BC0 100%);
            --gradient-3d-luxury: linear-gradient(135deg, #3B82F6 0%, #06B6D4 50%, #10B981 100%);
            --gradient-3d-clean: linear-gradient(135deg, #F8FAFC 0%, #F1F5F9 50%, #FFFFFF 100%);
            --gradient-3d-success: linear-gradient(135deg, #10B981 0%, #34D399 100%);
            --gradient-3d-warning: linear-gradient(135deg, #F59E0B 0%, #FCD34D 100%);
            
            /* Professional 3D Shadows */
            --shadow-3d-sm: 0 2px 4px rgba(15, 76, 117, 0.1), 0 1px 2px rgba(15, 76, 117, 0.06);
            --shadow-3d-md: 0 4px 8px rgba(15, 76, 117, 0.15), 0 2px 4px rgba(15, 76, 117, 0.08);
            --shadow-3d-lg: 0 8px 16px rgba(15, 76, 117, 0.2), 0 4px 8px rgba(15, 76, 117, 0.1);
            --shadow-3d-xl: 0 20px 40px rgba(15, 76, 117, 0.25), 0 10px 20px rgba(15, 76, 117, 0.15);
            --shadow-3d-neon: 0 0 20px rgba(15, 76, 117, 0.3), 0 0 40px rgba(30, 107, 168, 0.2);
            
            /* 3D Border Colors */
            --border-3d-light: #E2E8F0;
            --border-3d-medium: #CBD5E1;
            --border-3d-dark: #94A3B8;
            
            /* Legacy Variables for Compatibility */
            --gradient-primary: var(--gradient-3d-primary);
            --gradient-luxury: var(--gradient-3d-luxury);
            --primary-blue: var(--medical-primary);
            --golden-yellow: var(--medical-accent);
            --neon-cyan: var(--medical-cyan);
            --shadow-sm: var(--shadow-3d-sm);
            --shadow-md: var(--shadow-3d-md);
            --shadow-lg: var(--shadow-3d-lg);
            --shadow-xl: var(--shadow-3d-xl);
            --border-color: var(--border-3d-light);
            --text-primary: var(--medical-dark);
            --text-secondary: var(--medical-secondary);
            --accent-blue: var(--medical-accent);
            --light-green: var(--medical-green);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--gradient-3d-clean);
            color: var(--medical-dark);
            line-height: 1.6;
            overflow-x: hidden;
            position: relative;
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 50%, rgba(15, 76, 117, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(30, 107, 168, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 50% 20%, rgba(46, 139, 192, 0.06) 0%, transparent 50%),
                radial-gradient(circle at 50% 80%, rgba(22, 165, 165, 0.06) 0%, transparent 50%),
                radial-gradient(circle at 30% 70%, rgba(14, 165, 233, 0.04) 0%, transparent 50%);
            animation: medicalAurora 20s ease-in-out infinite;
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
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="medical-3d-pattern" width="40" height="40" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="3" fill="rgba(15,76,117,0.08)"/><path d="M10 20 Q20 10, 30 20 T50 20" stroke="rgba(30,107,168,0.1)" stroke-width="2" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23medical-3d-pattern)"/></svg>'),
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><defs><pattern id="medical-3d-grid" width="60" height="60" patternUnits="userSpaceOnUse"><rect x="15" y="15" width="30" height="30" fill="none" stroke="rgba(46,139,192,0.08)" stroke-width="2"/><circle cx="30" cy="30" r="8" fill="rgba(22,165,165,0.1)"/></pattern></defs><rect width="200" height="200" fill="url(%23medical-3d-grid)"/></svg>');
            background-size: 40px 40px, 120px 120px;
            animation: medical3DFloat 30s linear infinite;
            pointer-events: none;
            z-index: -1;
        }

        /* Hospital-Quality 3D Header */
        .luxury-header {
            background: var(--gradient-3d-primary);
            color: var(--medical-white);
            padding: 2rem 0;
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        .luxury-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="medical-grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.08)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23medical-grid)"/></svg>');
            animation: medical3DFloat 20s ease-in-out infinite;
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
            border: 3px solid var(--medical-accent);
            box-shadow: var(--shadow-3d-md);
            transform-style: preserve-3d;
            transition: all 0.3s ease;
        }

        .logo:hover {
            transform: translateY(-2px) rotateY(5deg);
            box-shadow: var(--shadow-3d-lg);
            border-color: var(--medical-cyan);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
            transform-style: preserve-3d;
        }

        .nav-links a {
            color: var(--medical-white);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transform-style: preserve-3d;
            transform: translateZ(0);
            position: relative;
        }

        .nav-links a::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--gradient-3d-luxury);
            border-radius: 8px;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }

        .nav-links a:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-3px) translateZ(10px) rotateX(2deg);
            box-shadow: var(--shadow-3d-sm);
        }

        .nav-links a:hover::before {
            opacity: 0.2;
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
            color: var(--medical-primary);
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
            transform-style: preserve-3d;
            transform: translateZ(10px);
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--gradient-3d-primary);
            border-radius: 2px;
        }

        .section-subtitle {
            color: var(--medical-secondary);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Introduction Section - Hospital-Quality 3D */
        .intro-card {
            background: var(--medical-white);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-3d-md);
            border: 1px solid var(--border-3d-light);
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
        }

        .intro-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: var(--gradient-3d-primary);
        }

        .intro-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--medical-dark);
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
            background: var(--gradient-3d-luxury);
            color: var(--medical-white);
            border-radius: 50px;
            font-weight: 600;
            box-shadow: var(--shadow-3d-sm);
            transition: all 0.3s ease;
            transform-style: preserve-3d;
            transform: translateZ(0);
        }

        .badge:hover {
            transform: translateY(-3px) translateZ(10px) rotateX(2deg);
            box-shadow: var(--shadow-3d-md);
        }

        .intro-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: start;
        }

        .intro-image-card {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-3d-lg);
            transform-style: preserve-3d;
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .intro-image-card:hover {
            transform: translateY(-10px) rotateX(3deg) scale(1.02);
            box-shadow: var(--shadow-3d-xl);
        }

        .intro-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            transition: all 0.6s ease;
        }

        .intro-image-card:hover .intro-image {
            transform: scale(1.05);
        }

        .image-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.8));
            color: white;
            padding: 2rem 1.5rem 1.5rem;
            transform: translateY(20px);
            transition: transform 0.4s ease;
        }

        .intro-image-card:hover .image-overlay {
            transform: translateY(0);
        }

        .image-overlay h4 {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .image-overlay p {
            opacity: 0.9;
            font-size: 1rem;
        }

        /* Vision Mission Section */
        .vm-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .vm-card {
            background: var(--medical-white);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: var(--shadow-3d-sm);
            border: 1px solid var(--border-3d-light);
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            transform: translateZ(0);
        }

        .vm-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(15, 76, 117, 0.05), rgba(30, 107, 168, 0.05));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .vm-card:hover::before {
            opacity: 1;
        }

        .vm-card:hover {
            transform: translateY(-8px) translateZ(15px) rotateX(2deg);
            box-shadow: var(--shadow-3d-lg);
        }

        .vm-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: var(--gradient-3d-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: var(--medical-white);
            box-shadow: var(--shadow-3d-md);
            transform-style: preserve-3d;
            transform: translateZ(5px);
        }

        .vm-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--medical-primary);
            margin-bottom: 1rem;
            transform-style: preserve-3d;
            transform: translateZ(3px);
        }

        .vm-content {
            color: var(--medical-dark);
            font-size: 1.1rem;
            line-height: 1.6;
            font-style: italic;
            position: relative;
            z-index: 1;
        }

        /* Strategic Objectives */
        .objectives-list {
            background: var(--medical-white);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-3d-sm);
            border: 1px solid var(--border-3d-light);
            transform-style: preserve-3d;
        }

        .objective-item {
            display: flex;
            align-items: flex-start;
            gap: 1.5rem;
            padding: 1.5rem 0;
            border-bottom: 1px solid var(--border-3d-light);
            transition: all 0.3s ease;
        }

        .objective-item:last-child {
            border-bottom: none;
        }

        .objective-item:hover {
            background: rgba(15, 76, 117, 0.02);
            margin: 0 -1rem;
            padding: 1.5rem;
            border-radius: 10px;
            transform: translateX(5px);
        }

        .objective-icon {
            width: 50px;
            height: 50px;
            background: var(--gradient-3d-luxury);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--medical-white);
            font-size: 1.2rem;
            flex-shrink: 0;
            box-shadow: var(--shadow-3d-sm);
            transform-style: preserve-3d;
            transform: translateZ(5px);
        }

        .objective-text {
            font-size: 1.1rem;
            line-height: 1.6;
            color: var(--medical-dark);
        }

        /* Core Values */
        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 3rem;
        }

        .value-card {
            background: var(--medical-white);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            box-shadow: var(--shadow-3d-sm);
            border: 1px solid var(--border-3d-light);
            transition: all 0.3s ease;
            transform-style: preserve-3d;
            transform: translateZ(0);
        }

        .value-card:hover {
            transform: translateY(-8px) translateZ(15px) rotateX(2deg);
            box-shadow: var(--shadow-3d-md);
            border-color: var(--medical-accent);
        }

        .value-icon {
            width: 60px;
            height: 60px;
            background: var(--gradient-3d-luxury);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--medical-white);
            font-size: 1.5rem;
            margin: 0 auto 1rem;
            box-shadow: var(--shadow-3d-sm);
            transform-style: preserve-3d;
            transform: translateZ(5px);
        }

        .value-title {
            font-weight: 700;
            color: var(--medical-primary);
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
            transform-style: preserve-3d;
            transform: translateZ(3px);
        }

        /* Motto Section - Hospital-Quality 3D */
        .motto-section {
            background: var(--gradient-3d-primary);
            color: var(--medical-white);
            border-radius: 20px;
            padding: 3rem;
            text-align: center;
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
        }

        .motto-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 70%);
            animation: medical3DFloat 20s linear infinite;
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

        /* Medical 3D Animations */
        @keyframes medicalAurora {
            0%, 100% {
                transform: rotate(0deg) scale(1);
                opacity: 0.8;
            }
            25% {
                transform: rotate(90deg) scale(1.1);
                opacity: 0.6;
            }
            50% {
                transform: rotate(180deg) scale(1.2);
                opacity: 0.4;
            }
            75% {
                transform: rotate(270deg) scale(1.1);
                opacity: 0.6;
            }
        }

        @keyframes medical3DFloat {
            0% {
                transform: translateX(0) translateY(0) rotate(0deg);
            }
            25% {
                transform: translateX(10px) translateY(-5px) rotate(1deg);
            }
            50% {
                transform: translateX(20px) translateY(0) rotate(2deg);
            }
            75% {
                transform: translateX(10px) translateY(5px) rotate(1deg);
            }
            100% {
                transform: translateX(0) translateY(0) rotate(0deg);
            }
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

            .intro-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .intro-image {
                height: 250px;
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
            
            <div class="intro-grid">
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
                
                <div class="intro-image-card">
                    <img src="assets/general-overview.jpeg" alt="ISNM General Overview - Modern Campus Facilities" class="intro-image">
                    <div class="image-overlay">
                        <h4>Modern Campus Facilities</h4>
                        <p>State-of-the-art learning environment</p>
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


