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
    <link rel="stylesheet" href="assets/modern-theme.css">
    <link rel="stylesheet" href="assets/css/image-animations.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            /* Dark Blue Professional Color Palette - Matching index.php */
            --primary-dark: #0a1628;
            --secondary-dark: #1e3a5f;
            --accent-blue: #2563eb;
            --accent-cyan: #06b6d4;
            --accent-light-blue: #3b82f6;
            --accent-dark-blue: #1e40af;
            --medical-blue: #0066cc;
            --medical-cyan: #00bcd4;
            --white: #FFFFFF;
            --gray-light: #f8fafc;
            --gray-medium: #e2e8f0;
            --gray-dark: #475569;
            --text-primary: #0f172a;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            
            /* Gradients */
            --gradient-hero: linear-gradient(135deg, var(--primary-dark) 0%, var(--secondary-dark) 50%, var(--accent-blue) 100%);
            --gradient-primary: linear-gradient(135deg, var(--primary-dark) 0%, var(--accent-blue) 100%);
            --gradient-secondary: linear-gradient(135deg, var(--accent-blue) 0%, var(--accent-cyan) 100%);
            --gradient-clean: linear-gradient(135deg, var(--gray-light) 0%, var(--white) 100%);
            
            /* Shadows */
            --shadow-sm: 0 2px 4px rgba(10, 22, 40, 0.1);
            --shadow-md: 0 4px 8px rgba(10, 22, 40, 0.15);
            --shadow-lg: 0 8px 16px rgba(10, 22, 40, 0.2);
            --shadow-xl: 0 20px 40px rgba(10, 22, 40, 0.25);
            --shadow-2xl: 0 40px 80px rgba(10, 22, 40, 0.3);
            --shadow-glow: 0 0 40px rgba(37, 99, 235, 0.4);
            --shadow-gold: 0 0 60px rgba(255, 215, 0, 0.3);
            
            /* Advanced Gradients */
            --gradient-luxury: linear-gradient(135deg, #1e3a5f 0%, #2563eb 50%, #06b6d4 100%);
            --gradient-gold: linear-gradient(135deg, #FFD700 0%, #FFA500 50%, #FF8C00 100%);
            --gradient-success: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
            --gradient-danger: linear-gradient(135deg, #ef4444 0%, #dc2626 50%, #b91c1c 100%);
            --gradient-purple: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 50%, #6d28d9 100%);
            --gradient-aurora: linear-gradient(45deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #fecfef 75%, #fecfef 100%);
            
            /* Image Effects */
            --image-filter-hover: brightness(1.1) contrast(1.05) saturate(1.2);
            --image-shadow-hover: 0 25px 50px rgba(0, 0, 0, 0.3);
            --image-border-glow: 0 0 30px rgba(37, 99, 235, 0.6);
            --image-transform-3d: perspective(1000px) rotateX(2deg) rotateY(-2deg) scale(1.05);
            
            /* Animation Durations */
            --animation-fast: 0.3s;
            --animation-normal: 0.6s;
            --animation-slow: 1.2s;
            --animation-ultra-slow: 2.4s;
            
            /* Borders */
            --border-light: var(--gray-medium);
            --border-medium: var(--gray-dark);
            --border-dark: var(--primary-dark);
            --border-color: var(--gray-medium);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--gray-light) 0%, var(--white) 45%, var(--gray-light) 100%);
            color: var(--text-primary);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Premium 3D Navigation - Matching index.php */
        .navbar {
            position: fixed;
            top: 40px;
            left: 0;
            right: 0;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,0.2);
            z-index: 1001;
            padding: 1rem 0;
            box-shadow: 
                0 8px 32px rgba(10, 22, 40, 0.1),
                0 2px 8px rgba(10, 22, 40, 0.05),
                inset 0 1px 0 rgba(255,255,255,0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        .navbar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--accent-dark-blue) 0%, var(--accent-blue) 50%, var(--accent-cyan) 100%);
            animation: navbarShine 4s ease-in-out infinite;
        }

        .navbar::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(37, 99, 235, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(6, 182, 212, 0.05) 0%, transparent 50%);
            opacity: 0.6;
            pointer-events: none;
        }

        @keyframes navbarShine {
            0%, 100% {
                transform: translateX(-100%);
            }
            50% {
                transform: translateX(100%);
            }
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 3rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 2;
            min-height: auto;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-weight: 900;
            font-size: 1.6rem;
            color: var(--primary-dark);
            text-decoration: none;
            font-family: 'Copperplate Gothic Bold', 'Rockwell Extra Bold', serif;
            transform-style: preserve-3d;
            transition: all 0.35s ease;
            position: relative;
            z-index: 5;
            padding: 0;
            margin: 0;
        }

        .nav-logo img {
            width: 64px;
            height: 64px;
            object-fit: cover;
            border: 2px solid rgba(17, 82, 147, 0.2);
            border-radius: 50%;
            transition: all 0.35s ease;
            box-shadow: 0 12px 28px rgba(0,0,0,0.12);
        }

        .nav-logo:hover img {
            transform: scale(1.03);
            box-shadow: 0 14px 32px rgba(0,0,0,0.16);
            border-color: rgba(255, 215, 0, 0.8);
        }

        .nav-links {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            transform-style: preserve-3d;
            position: relative;
            z-index: 2;
            flex-wrap: wrap;
        }

        .nav-link {
            color: var(--primary-dark);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            transition: all 0.3s ease;
            background: white;
            border: 1px solid rgba(220, 220, 220, 0.9);
            font-family: 'Inter', sans-serif;
            transform-style: preserve-3d;
            transform: translateZ(0);
            letter-spacing: 0.8px;
            text-transform: uppercase;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--gradient-primary);
            border-radius: 16px;
            opacity: 0;
            transition: opacity 0.35s ease;
            z-index: -1;
        }

        .nav-link:hover {
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
            border-color: transparent;
            background: var(--primary-dark);
        }

        .nav-link:hover::before {
            opacity: 1;
        }

        /* Navigation Dropdown */
        .nav-dropdown {
            position: relative;
        }

        .nav-dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            cursor: pointer;
        }

        .nav-dropdown-toggle::after {
            content: '▼';
            font-size: 0.7rem;
            transition: transform 0.3s ease;
            color: var(--text-secondary);
        }

        .nav-dropdown:hover .nav-dropdown-toggle::after {
            transform: rotate(180deg);
            color: var(--accent-blue);
        }

        .nav-dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            background: var(--white);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            box-shadow: var(--shadow-lg);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            min-width: 180px;
            z-index: 1000;
        }

        .nav-dropdown:hover .nav-dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .nav-dropdown-menu a {
            display: block;
            padding: 0.6rem 1rem;
            color: var(--text-primary);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border-bottom: 1px solid transparent;
        }

        .nav-dropdown-menu a:hover {
            background: var(--accent-light-blue);
            color: var(--white);
            transform: translateX(5px);
        }

        .nav-dropdown-menu a:first-child {
            border-radius: 8px 8px 0 0;
        }

        .nav-dropdown-menu a:last-child {
            border-radius: 0 0 8px 8px;
        }

        /* Brand Banner */
        .brand-banner {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--accent-dark-blue) 50%, var(--accent-blue) 100%);
            border-bottom: 1px solid rgba(220,220,220,0.9);
            z-index: 1002;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            box-shadow: 0 16px 40px rgba(0,0,0,0.08);
        }

        .brand-marquee {
            display: inline-flex;
            align-items: center;
            gap: 3rem;
            white-space: nowrap;
            animation: marquee 18s linear infinite;
            font-weight: 700;
            letter-spacing: 1px;
            color: var(--white);
            font-size: 0.95rem;
            transform: perspective(1000px) rotateX(0deg);
            line-height: 1;
            margin: 0;
            padding: 0;
        }

        @keyframes marquee {
            0% { transform: translateX(0) perspective(1000px) rotateX(2deg); }
            100% { transform: translateX(-100%) perspective(1000px) rotateX(2deg); }
        }

        /* Fixed Header Container */
        .fixed-header {
            position: relative;
            z-index: 1000;
            width: 100%;
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(25px);
            box-shadow: 
                0 20px 60px rgba(10, 22, 40, 0.15),
                0 8px 24px rgba(10, 22, 40, 0.1),
                inset 0 1px 0 rgba(255,255,255,0.2);
            border-bottom-color: rgba(255,255,255,0.3);
        }

        /* Page Header Section */
        .page-header-section {
            background: var(--gradient-primary);
            color: white;
            padding: 3rem 0;
            text-align: center;
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
        }

        .page-header-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="page-header-pattern" width="40" height="40" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="3" fill="rgba(255,255,255,0.1)"/><path d="M10 20 Q20 10, 30 20 T50 20" stroke="rgba(255,255,255,0.15)" stroke-width="2" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23page-header-pattern)"/></svg>');
            animation: pageHeaderFloat 25s linear infinite;
            pointer-events: none;
        }

        @keyframes pageHeaderFloat {
            0% { transform: translateX(0) translateY(0); }
            25% { transform: translateX(10px) translateY(-5px); }
            50% { transform: translateX(20px) translateY(0); }
            75% { transform: translateX(10px) translateY(5px); }
            100% { transform: translateX(0) translateY(0); }
        }

        .page-header-content {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 900;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            transform-style: preserve-3d;
            transform: translateZ(10px);
        }

        .breadcrumb {
            opacity: 0.9;
            font-size: 1.1rem;
            transform-style: preserve-3d;
            transform: translateZ(5px);
        }

        /* Main Content */
        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 3rem 2rem;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .mobile-menu-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .nav-links {
                display: none;
                position: fixed;
                top: 100px;
                left: 0;
                right: 0;
                background: var(--white);
                flex-direction: column;
                gap: 0;
                padding: 1rem;
                box-shadow: 0 20px 40px rgba(10, 22, 40, 0.2);
                border-top: 2px solid var(--accent-blue);
                z-index: 999;
                transform: translateY(-100%);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .nav-links.active {
                display: flex;
                transform: translateY(0);
            }

            .nav-link {
                width: 100%;
                padding: 1rem;
                border-radius: 0;
                border-bottom: 1px solid var(--border-light);
                text-align: center;
                font-size: 1rem;
            }

            .nav-link:last-child {
                border-bottom: none;
            }

            .nav-dropdown-menu {
                position: static;
                background: var(--gray-light);
                box-shadow: none;
                border: none;
                border-radius: 0;
                transform: none;
                opacity: 1;
                visibility: visible;
                display: none;
                margin-top: 0;
                min-width: auto;
            }

            .nav-dropdown.active .nav-dropdown-menu {
                display: block;
            }

            .nav-dropdown-toggle::after {
                display: none;
            }

            .nav-dropdown-menu a {
                padding: 0.8rem 1rem;
                font-size: 0.9rem;
                border-bottom: 1px solid var(--border-light);
                background: transparent;
                color: var(--text-primary);
            }

            .nav-dropdown-menu a:hover {
                background: var(--accent-light-blue);
                color: var(--white);
                transform: none;
            }

            .navbar {
                padding: 1rem;
            }

            .nav-container {
                flex-wrap: wrap;
                position: relative;
            }

            .nav-logo {
                font-size: 1.3rem;
                gap: 1rem;
            }

            .nav-logo img {
                width: 50px;
                height: 50px;
            }
            
            .page-title {
                font-size: 2rem;
            }
        }
            
        /* Premium Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            background: var(--accent-dark-blue);
            border: 2px solid var(--accent-blue);
            width: 50px;
            height: 50px;
            border-radius: 12px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            transform-style: preserve-3d;
            transform: translateZ(0);
        }

        .mobile-menu-toggle::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 24px;
            height: 2px;
            background: var(--white);
            transform: translate(-50%, -50%);
            transition: all 0.3s ease;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        .mobile-menu-toggle::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 24px;
            height: 2px;
            background: var(--white);
            transform: translate(-50%, -50%) rotate(90deg);
            transition: all 0.3s ease;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        .mobile-menu-toggle:hover {
            transform: translateY(-2px) translateZ(10px) rotateX(-2deg);
            box-shadow: 0 8px 20px rgba(10, 22, 40, 0.3);
        }

        .mobile-menu-toggle.active::before {
            transform: translate(-50%, -50%) rotate(45deg);
            background: var(--accent-gold);
        }

        .mobile-menu-toggle.active::after {
            transform: translate(-50%, -50%) rotate(-45deg);
            background: var(--accent-gold);
        }

        
        /* Page Header Section */
        .page-header-section {
            background: var(--gradient-primary);
            color: white;
            padding: 3rem 0;
            text-align: center;
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
        }

        .page-header-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="page-header-pattern" width="40" height="40" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="3" fill="rgba(255,255,255,0.1)"/><path d="M10 20 Q20 10, 30 20 T50 20" stroke="rgba(255,255,255,0.15)" stroke-width="2" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23page-header-pattern)"/></svg>');
            animation: pageHeaderFloat 25s linear infinite;
            pointer-events: none;
        }

        @keyframes pageHeaderFloat {
            0% { transform: translateX(0) translateY(0); }
            25% { transform: translateX(10px) translateY(-5px); }
            50% { transform: translateX(20px) translateY(0); }
            75% { transform: translateX(10px) translateY(5px); }
            100% { transform: translateX(0) translateY(0); }
        }

        .page-header-content {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 900;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            transform-style: preserve-3d;
            transform: translateZ(10px);
        }

        .breadcrumb {
            opacity: 0.9;
            font-size: 1.1rem;
            transform-style: preserve-3d;
            transform: translateZ(5px);
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

        /* Enhanced Achievement Gallery */
        .achievement-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
            gap: 2.5rem;
            margin: 3rem 0;
            perspective: 2000px;
            transform-style: preserve-3d;
        }

        .achievement-card {
            background: linear-gradient(145deg, var(--white), var(--gray-light));
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--shadow-xl);
            transition: all var(--animation-normal) cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            transform-style: preserve-3d;
            transform: translateZ(0) rotateX(0deg) rotateY(0deg);
            border: 3px solid transparent;
            background-clip: padding-box;
        }

        .achievement-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: var(--gradient-luxury);
            transform: scaleX(0);
            transition: transform var(--animation-normal) cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 24px 24px 0 0;
            z-index: 3;
        }

        .achievement-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(37, 99, 235, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(6, 182, 212, 0.1) 0%, transparent 50%),
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="achievement-pattern" width="30" height="30" patternUnits="userSpaceOnUse"><circle cx="15" cy="15" r="3" fill="rgba(37, 99, 235, 0.15)"/><path d="M5 15 Q15 5, 25 15 T45 15" stroke="rgba(6, 182, 212, 0.2)" stroke-width="2" fill="none"/><circle cx="30" cy="30" r="2" fill="rgba(255, 215, 0, 0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23achievement-pattern)"/></svg>');
            background-size: cover, cover, 60px 60px;
            background-position: center, center, 0 0;
            transform: translateX(-100%) rotate(1deg);
            transition: transform var(--animation-slow) cubic-bezier(0.4, 0, 0.2, 1);
            pointer-events: none;
            opacity: 0.7;
            z-index: 1;
        }

        .achievement-card:hover {
            transform: translateY(-20px) scale(1.03) rotateX(5deg) rotateY(-3deg) translateZ(30px);
            box-shadow: var(--shadow-2xl), var(--shadow-glow), var(--image-shadow-hover);
            border-color: var(--accent-blue);
            background: linear-gradient(145deg, var(--white), rgba(37, 99, 235, 0.02));
        }

        .achievement-card:hover::before {
            transform: scaleX(1);
            animation: shimmer 2s ease-in-out infinite;
        }

        .achievement-card:hover::after {
            transform: translateX(100%) rotate(-1deg);
            opacity: 0.9;
        }

        @keyframes shimmer {
            0%, 100% { opacity: 0.8; }
            50% { opacity: 1; }
        }

        .achievement-image {
            width: 100%;
            height: 280px;
            object-fit: cover;
            transition: all var(--animation-normal) cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            transform-style: preserve-3d;
            transform: translateZ(0);
            filter: brightness(1) contrast(1) saturate(1);
            border-radius: 20px 20px 0 0;
        }

        .achievement-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                linear-gradient(135deg, transparent 30%, rgba(255,255,255,0.4) 50%, transparent 70%),
                radial-gradient(circle at center, transparent 0%, rgba(0,0,0,0.1) 100%);
            transform: translateX(-120%) rotate(45deg);
            transition: transform var(--animation-slow) cubic-bezier(0.4, 0, 0.2, 1);
            pointer-events: none;
            z-index: 2;
        }

        .achievement-card:hover .achievement-image {
            transform: scale(1.08) rotateX(3deg) rotateY(-2deg) translateZ(15px);
            filter: var(--image-filter-hover);
            box-shadow: var(--image-border-glow);
        }

        .achievement-card:hover .achievement-image::before {
            transform: translateX(120%) rotate(45deg);
        }

        .achievement-card-content {
            padding: 2.5rem;
            position: relative;
            z-index: 4;
            background: linear-gradient(145deg, rgba(255,255,255,0.95), rgba(248,250,252,0.9));
            backdrop-filter: blur(10px);
        }

        .achievement-card-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 1rem;
            position: relative;
            transform: translateZ(5px);
            transition: all var(--animation-fast) ease;
        }

        .achievement-card:hover .achievement-card-title {
            color: var(--accent-blue);
            transform: translateZ(10px) translateY(-2px);
        }

        .achievement-card-description {
            color: var(--text-secondary);
            line-height: 1.7;
            margin-bottom: 1.5rem;
            font-size: 1.05rem;
            position: relative;
            transform: translateZ(3px);
            transition: all var(--animation-fast) ease;
        }

        .achievement-card:hover .achievement-card-description {
            color: var(--text-primary);
            transform: translateZ(8px);
        }

        .achievement-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
            position: relative;
            transform: translateZ(4px);
        }

        .achievement-badge {
            display: inline-block;
            background: var(--gradient-luxury);
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 25px;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all var(--animation-fast) ease;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
            position: relative;
            overflow: hidden;
        }

        .achievement-badge::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left var(--animation-normal) ease;
        }

        .achievement-badge:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.3);
        }

        .achievement-badge:hover::before {
            left: 100%;
        }

        /* Image Loading Animation */
        .achievement-image {
            animation: imageLoadIn var(--animation-slow) ease-out;
        }

        @keyframes imageLoadIn {
            0% {
                opacity: 0;
                transform: scale(0.9) translateY(20px);
                filter: blur(10px);
            }
            50% {
                opacity: 0.8;
                transform: scale(1.02) translateY(-5px);
                filter: blur(2px);
            }
            100% {
                opacity: 1;
                transform: scale(1) translateY(0);
                filter: blur(0);
            }
        }

        /* Parallax Container */
        .achievement-gallery-section {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, var(--gray-light) 0%, var(--white) 50%, var(--gray-light) 100%);
            border-radius: 30px;
            padding: 4rem 3rem;
            margin: 4rem 0;
        }

        .achievement-gallery-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 20%, rgba(37, 99, 235, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(6, 182, 212, 0.05) 0%, transparent 50%),
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="gallery-bg-pattern" width="50" height="50" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="2" fill="rgba(37, 99, 235, 0.1)"/><path d="M10 25 Q25 10, 40 25 T70 25" stroke="rgba(6, 182, 212, 0.08)" stroke-width="1" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23gallery-bg-pattern)"/></svg>');
            background-size: cover, cover, 100px 100px;
            background-position: center, center, 0 0;
            animation: galleryFloat 30s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes galleryFloat {
            0%, 100% { transform: translateX(0) translateY(0) rotate(0deg); }
            25% { transform: translateX(10px) translateY(-5px) rotate(0.5deg); }
            50% { transform: translateX(20px) translateY(0) rotate(0deg); }
            75% { transform: translateX(10px) translateY(5px) rotate(-0.5deg); }
        }

        .section-content {
            position: relative;
            z-index: 2;
        }

        .section-description {
            text-align: center;
            color: var(--text-secondary);
            font-size: 1.1rem;
            max-width: 700px;
            margin: 0 auto 3rem;
            line-height: 1.7;
        }

        /* Lightbox Effect */
        .achievement-image {
            cursor: pointer;
            position: relative;
        }

        .achievement-image::after {
            content: '🔍';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            font-size: 2rem;
            opacity: 0;
            transition: all var(--animation-fast) ease;
            z-index: 5;
            background: rgba(255,255,255,0.9);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-lg);
        }

        .achievement-card:hover .achievement-image::after {
            transform: translate(-50%, -50%) scale(1);
            opacity: 1;
        }

        /* Staggered Animation */
        .achievement-card:nth-child(1) { animation-delay: 0.1s; }
        .achievement-card:nth-child(2) { animation-delay: 0.2s; }
        .achievement-card:nth-child(3) { animation-delay: 0.3s; }
        .achievement-card:nth-child(4) { animation-delay: 0.4s; }
        .achievement-card:nth-child(5) { animation-delay: 0.5s; }
        .achievement-card:nth-child(6) { animation-delay: 0.6s; }
        .achievement-card:nth-child(7) { animation-delay: 0.7s; }
        .achievement-card:nth-child(8) { animation-delay: 0.8s; }
        .achievement-card:nth-child(9) { animation-delay: 0.9s; }
        .achievement-card:nth-child(10) { animation-delay: 1.0s; }
        .achievement-card:nth-child(11) { animation-delay: 1.1s; }
        .achievement-card:nth-child(12) { animation-delay: 1.2s; }
        .achievement-card:nth-child(13) { animation-delay: 1.3s; }
        .achievement-card:nth-child(14) { animation-delay: 1.4s; }
        .achievement-card:nth-child(15) { animation-delay: 1.5s; }
        .achievement-card:nth-child(16) { animation-delay: 1.6s; }
        .achievement-card:nth-child(17) { animation-delay: 1.7s; }
        .achievement-card:nth-child(18) { animation-delay: 1.8s; }
        .achievement-card:nth-child(19) { animation-delay: 1.9s; }
        .achievement-card:nth-child(20) { animation-delay: 2.0s; }

        /* Responsive Design for Gallery */
        @media (max-width: 768px) {
            .achievement-gallery {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .achievement-card {
                border-radius: 20px;
            }

            .achievement-image {
                height: 220px;
            }

            .achievement-card-content {
                padding: 2rem;
            }

            .achievement-card-title {
                font-size: 1.4rem;
            }

            .achievement-gallery-section {
                padding: 3rem 2rem;
                margin: 3rem 0;
            }
        }

        @media (max-width: 480px) {
            .achievement-card-title {
                font-size: 1.3rem;
            }

            .achievement-card-description {
                font-size: 1rem;
            }

            .achievement-badge {
                font-size: 0.75rem;
                padding: 0.5rem 1rem;
            }
        }

        @keyframes achievementFloat {
            0%, 100% { transform: translateY(0px) translateZ(0px); }
            50% { transform: translateY(-5px) translateZ(10px); }
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

        /* Footer Styling */
    .footer {
        background: var(--primary-dark);
        color: white;
        padding: 3rem 2rem 2rem;
        margin-top: 4rem;
    }

    .footer-content {
        max-width: 1200px;
        margin: 0 auto;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 3rem;
        margin-bottom: 3rem;
    }

    .footer-section h3 {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: var(--accent-gold);
    }

    .footer-links {
        list-style: none;
    }

    .footer-links li {
        margin-bottom: 0.8rem;
    }

    .footer-links a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .footer-links a:hover {
        color: var(--accent-gold);
        transform: translateX(5px);
    }

    .contact-info p {
        margin-bottom: 1rem;
        color: rgba(255, 255, 255, 0.8);
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }

    .contact-info i {
        color: var(--accent-gold);
        width: 20px;
    }

    .footer-bottom {
        text-align: center;
        padding-top: 2rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .footer-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .footer-subtitle {
        font-size: 1.1rem;
        margin-bottom: 2rem;
        opacity: 0.9;
    }

    .footer-buttons {
        display: flex;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
        margin-bottom: 2rem;
    }

    .whatsapp-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: #25d366;
        color: white;
        padding: 1rem 2rem;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .whatsapp-btn:hover {
        background: #128c7e;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(37, 211, 102, 0.3);
    }

    .copyright {
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        color: rgba(255, 255, 255, 0.6);
    }

    @media (max-width: 768px) {
        .footer {
            padding: 2rem 1rem;
        }

        .footer-grid {
            gap: 2rem;
        }

        .footer-buttons {
            flex-direction: column;
            align-items: center;
        }

        .whatsapp-btn {
            width: 100%;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="fixed-header">
        <div class="brand-banner">
            <div class="brand-marquee">
                <span>Iganga School of Nursing & Midwifery</span>
                <span>Practical Skills Lab | Modern Healthcare Training | Student Success</span>
                <span>Academic Excellence | Compassionate Care | Career Ready Nurses</span>
            </div>
        </div>
        <!-- Professional Navigation -->
        <nav class="navbar" id="navbar">
            <div class="nav-container">
                <a href="index.php" class="nav-logo">
                    <img src="assets/school-logo.png" alt="ISNM Logo">
                </a>
                
                <!-- Mobile Menu Toggle -->
                <button class="mobile-menu-toggle" id="mobileMenuToggle">
                    <span></span>
                    <span></span>
                </button>
                
                <div class="nav-links" id="navLinks">
                    <a href="#home" class="nav-link">Home</a>
                    
                    <!-- Academics Dropdown -->
                    <div class="nav-dropdown">
                        <div class="nav-dropdown-toggle">
                            <a href="#" class="nav-link">Academics</a>
                        </div>
                        <div class="nav-dropdown-menu">
                            <a href="programs.php">Programs</a>
                            <a href="activities.php#academic-activities">Academic Activities</a>
                            <a href="activities.php#sports-activities">Sports & Recreation</a>
                            <a href="activities.php#community-service">Community Service</a>
                            <a href="activities.php#cultural-activities">Cultural Activities</a>
                        </div>
                    </div>
                    
                    <!-- About Dropdown -->
                    <div class="nav-dropdown">
                        <div class="nav-dropdown-toggle">
                            <a href="#" class="nav-link">About</a>
                        </div>
                        <div class="nav-dropdown-menu">
                            <a href="about.php">Our School</a>
                            <a href="governance.php">Governance</a>
                            <a href="history.php">History</a>
                            <a href="achievements.php">Achievements</a>
                        </div>
                    </div>
                    
                    <!-- Admissions Dropdown -->
                    <div class="nav-dropdown">
                        <div class="nav-dropdown-toggle">
                            <a href="#" class="nav-link">Admissions</a>
                        </div>
                        <div class="nav-dropdown-menu">
                            <a href="application.php">Apply Now</a>
                            <a href="programs.php#requirements">Requirements</a>
                            <a href="programs.php#fees">Fee Structure</a>
                        </div>
                    </div>
                    
                    <!-- Campus Dropdown -->
                    <div class="nav-dropdown">
                        <div class="nav-dropdown-toggle">
                            <a href="#" class="nav-link">Campus</a>
                        </div>
                        <div class="nav-dropdown-menu">
                            <a href="infrastructure.php">Infrastructure</a>
                            <a href="activities.php">Student Life</a>
                        </div>
                    </div>
                    
                    <a href="contact.php" class="nav-link">Contact</a>
                    <a href="login-portal.php" class="nav-link">Portal</a>
                </div>
            </div>
        </nav>
    </div>

    <!-- Page Title Section -->
    <div class="page-header-section">
        <div class="page-header-content">
            <h1 class="page-title">Achievements & Future Plans</h1>
            <div class="breadcrumb">
                <p>Home / Achievements</p>
            </div>
        </div>
    </div>

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
                    
                    <div class="achievement-card" style="position: relative;">
                        <img src="assets/images/achievements/graduants-celebrating-their-graduation.jpg" alt="Graduates Celebrating" class="achievement-image">
                        <div class="achievement-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h4 class="achievement-title">Graduate Success</h4>
                        <p class="achievement-description">
                            Students celebrating their successful completion of studies with 
                            outstanding academic performance and achievements
                        </p>
                    </div>
                    
                    <div class="achievement-card" style="position: relative;">
                        <img src="assets/images/achievements/graduants-rejoicing.jpg" alt="Graduates Rejoicing" class="achievement-image">
                        <div class="achievement-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <h4 class="achievement-title">Joyful Achievements</h4>
                        <p class="achievement-description">
                            Graduates expressing joy and excitement as they receive their 
                            well-deserved certificates and diplomas
                        </p>
                    </div>
                    
                    <div class="achievement-card" style="position: relative;">
                        <img src="assets/images/achievements/graduation-parad-2023-students-holding-the-banner.jpg" alt="Graduation Banner" class="achievement-image">
                        <div class="achievement-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                            <i class="fas fa-flag"></i>
                        </div>
                        <h4 class="achievement-title">Class of 2023</h4>
                        <p class="achievement-description">
                            Class of 2023 proudly displaying their graduation banner and 
                            celebrating their collective success
                        </p>
                    </div>
                    
                    <div class="achievement-card" style="position: relative;">
                        <img src="assets/images/achievements/iganga-school-of-nursing-celebrating-3rd-graduation.jpg" alt="3rd Graduation Celebration" class="achievement-image">
                        <div class="achievement-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                            <i class="fas fa-medal"></i>
                        </div>
                        <h4 class="achievement-title">3rd Graduation</h4>
                        <p class="achievement-description">
                            Celebrating our third graduation ceremony with pride and excellence 
                            in healthcare education
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
        </section>

        <!-- Achievement Gallery Section -->
        <section class="section">
            <div class="achievement-gallery-section">
                <div class="section-content">
                    <h2 class="section-title">Achievement Gallery</h2>
                    <p class="section-description">
                        Visual showcase of our major achievements and milestones throughout the years
                    </p>
                    
                    <div class="achievement-gallery">
                        <!-- Administration Block -->
                        <div class="achievement-card">
                            <img src="assets/images/facilities/administration-block.jpg" alt="ISNM Administration Block - Main Administrative Building" title="ISNM Administration Block - Central Hub of School Management" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Administration Block</h3>
                                <p class="achievement-card-description">
                                    Our modern administration block serves as the central hub for school management and operations
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Infrastructure</span>
                                    <span class="achievement-badge">Management</span>
                                </div>
                            </div>
                        </div>

                        <!-- Certificate Students in Examination -->
                        <div class="achievement-card">
                            <img src="assets/images/academic/certificate-in-nursing-students-in-examamination-room.jpg" alt="ISNM Certificate Nursing Students in Examination Room" title="ISNM Certificate Nursing Students - Academic Assessment in Progress" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Academic Excellence</h3>
                                <p class="achievement-card-description">
                                    Certificate nursing students demonstrating their knowledge during rigorous examinations
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Academics</span>
                                    <span class="achievement-badge">Assessment</span>
                                </div>
                            </div>
                        </div>

                        <!-- Classroom Building -->
                        <div class="achievement-card">
                            <img src="assets/images/facilities/classroom-building.jpg" alt="ISNM Classroom Building - Modern Learning Facilities" title="ISNM Classroom Building - State-of-the-Art Learning Environment" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Modern Classrooms</h3>
                                <p class="achievement-card-description">
                                    Well-equipped classroom buildings providing conducive learning environments
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Infrastructure</span>
                                    <span class="achievement-badge">Learning</span>
                                </div>
                            </div>
                        </div>

                        <!-- Dining Hall -->
                        <div class="achievement-card">
                            <img src="assets/images/facilities/dinnin-hall-or-main-hall.jpg" alt="ISNM Dining Hall - Student Dining Facilities" title="ISNM Main Dining Hall - Student Nutrition and Social Space" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Dining Hall</h3>
                                <p class="achievement-card-description">
                                    Spacious dining hall providing nutritious meals and social interaction space
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Facilities</span>
                                    <span class="achievement-badge">Student Life</span>
                                </div>
                            </div>
                        </div>

                        <!-- Diploma Hostel -->
                        <div class="achievement-card">
                            <img src="assets/images/facilities/diploma-hostel.jpg" alt="ISNM Diploma Hostel - Student Accommodation" title="ISNM Diploma Hostel - Comfortable Student Living Facilities" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Diploma Hostel</h3>
                                <p class="achievement-card-description">
                                    Modern hostel facilities providing comfortable accommodation for diploma students
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Accommodation</span>
                                    <span class="achievement-badge">Student Welfare</span>
                                </div>
                            </div>
                        </div>

                        <!-- Diploma Extension Images -->
                        <div class="achievement-card">
                            <img src="assets/images/academic/diploma-in-nursing-and-midwifery-extension-images-for-students.jpg" alt="ISNM Diploma Extension Program - Student Activities" title="ISNM Diploma Extension Program - Enhanced Learning Opportunities" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Extension Programs</h3>
                                <p class="achievement-card-description">
                                    Diploma in nursing and midwifery extension programs enhancing student opportunities
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Programs</span>
                                    <span class="achievement-badge">Innovation</span>
                                </div>
                            </div>
                        </div>

                        <!-- Girls Hostel -->
                        <div class="achievement-card">
                            <img src="assets/images/facilities/girls-hostel.jpg" alt="ISNM Girls Hostel - Female Student Accommodation" title="ISNM Girls Hostel - Safe and Comfortable Living Environment" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Girls Hostel</h3>
                                <p class="achievement-card-description">
                                    Secure and comfortable hostel facilities specifically designed for female students
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Accommodation</span>
                                    <span class="achievement-badge">Safety</span>
                                </div>
                            </div>
                        </div>

                        <!-- Library Revision Session -->
                        <div class="achievement-card">
                            <img src="assets/images/academic/revision-session-at-the-school-library.jpg" alt="ISNM Library Revision Session - Student Study" title="ISNM Library Revision Session - Academic Excellence in Progress" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Library Studies</h3>
                                <p class="achievement-card-description">
                                    Students engaged in intensive revision sessions at the school library
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Academics</span>
                                    <span class="achievement-badge">Library</span>
                                </div>
                            </div>
                        </div>

                        <!-- School Kitchen -->
                        <div class="achievement-card">
                            <img src="assets/images/facilities/school-kitchen.jpg" alt="ISNM School Kitchen - Food Preparation Facilities" title="ISNM School Kitchen - Modern Food Preparation and Nutrition Center" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">School Kitchen</h3>
                                <p class="achievement-card-description">
                                    Modern kitchen facilities ensuring nutritious meal preparation for all students
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Facilities</span>
                                    <span class="achievement-badge">Nutrition</span>
                                </div>
                            </div>
                        </div>

                        <!-- Skills Laboratory -->
                        <div class="achievement-card">
                            <img src="assets/images/academic/students-in-skill-laboratory-in-practical-training.jpg" alt="ISNM Skills Laboratory - Practical Training Session" title="ISNM Skills Laboratory - Hands-on Practical Training for Students" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Skills Laboratory</h3>
                                <p class="achievement-card-description">
                                    Students engaged in practical training sessions in our modern skills laboratory
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Training</span>
                                    <span class="achievement-badge">Skills</span>
                                </div>
                            </div>
                        </div>

                        <!-- Graduation Ceremony -->
                        <div class="achievement-card">
                            <img src="assets/images/achievements/graduation-ceremony.jpg" alt="ISNM Graduation Ceremony - Students Celebrating Achievement" title="ISNM Graduation Ceremony - Academic Success and Achievement" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Graduation Ceremony</h3>
                                <p class="achievement-card-description">
                                    Celebrating the successful graduation of our nursing and midwifery students
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Achievement</span>
                                    <span class="achievement-badge">Success</span>
                                </div>
                            </div>
                        </div>

                        <!-- Graduation Parade -->
                        <div class="achievement-card">
                            <img src="assets/images/achievements/graduation-parad-2023-students-holding-the-banner.jpg" alt="ISNM Graduation Parade 2023 - Students with Banner" title="ISNM Graduation Parade 2023 - Student Pride and Achievement" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Graduation Parade</h3>
                                <p class="achievement-card-description">
                                    Students proudly displaying their achievements during the 2023 graduation parade
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Celebration</span>
                                    <span class="achievement-badge">Parade</span>
                                </div>
                            </div>
                        </div>

                        <!-- Graduants Rejoicing -->
                        <div class="achievement-card">
                            <img src="assets/images/achievements/graduants-rejoicing.jpg" alt="ISNM Graduates Rejoicing - Celebration Time" title="ISNM Graduates Rejoicing - Joy and Achievement Celebration" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Graduates Celebration</h3>
                                <p class="achievement-card-description">
                                    Joyful moments as our graduates celebrate their academic achievements
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Joy</span>
                                    <span class="achievement-badge">Celebration</span>
                                </div>
                            </div>
                        </div>

                        <!-- School Transportation -->
                        <div class="achievement-card">
                            <img src="assets/images/facilities/school-mini-buses-2-costers.jpg" alt="ISNM School Transportation - Mini Buses and Coasters" title="ISNM Transportation Fleet - Student and Staff Transport Services" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Transportation Fleet</h3>
                                <p class="achievement-card-description">
                                    Our fleet of mini buses and coasters providing reliable transportation for students and staff
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Transport</span>
                                    <span class="achievement-badge">Logistics</span>
                                </div>
                            </div>
                        </div>

                        <!-- School Borehole -->
                        <div class="achievement-card">
                            <img src="assets/images/facilities/school-borehole-a-student-is-fetching-water.jpg" alt="ISNM School Borehole - Water Supply System" title="ISNM Water Infrastructure - Student Accessing Clean Water" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Water Infrastructure</h3>
                                <p class="achievement-card-description">
                                    School borehole providing clean and reliable water supply for all students
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Infrastructure</span>
                                    <span class="achievement-badge">Water</span>
                                </div>
                            </div>
                        </div>

                        <!-- Student Practicum -->
                        <div class="achievement-card">
                            <img src="assets/images/academic/student-st-practicum-sites1.jpg" alt="ISNM Student Practicum - Clinical Training" title="ISNM Student Practicum - Hands-on Clinical Experience" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Clinical Practicum</h3>
                                <p class="achievement-card-description">
                                    Students gaining practical experience at clinical practicum sites
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Training</span>
                                    <span class="achievement-badge">Clinical</span>
                                </div>
                            </div>
                        </div>

                        <!-- Advanced Practicum Training -->
                        <div class="achievement-card">
                            <img src="assets/images/academic/student-at-practicum-site2.jpg" alt="ISNM Advanced Practicum Training - Healthcare Experience" title="ISNM Advanced Practicum - Professional Healthcare Training" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Advanced Training</h3>
                                <p class="achievement-card-description">
                                    Advanced clinical training at healthcare facilities for professional development
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Advanced</span>
                                    <span class="achievement-badge">Healthcare</span>
                                </div>
                            </div>
                        </div>

                        <!-- 3rd Graduation Celebration -->
                        <div class="achievement-card">
                            <img src="assets/images/achievements/iganga-school-of-nursing-celebrating-3rd-graduation.jpg" alt="ISNM 3rd Graduation Celebration - Milestone Achievement" title="ISNM 3rd Graduation - Institutional Milestone Celebration" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">3rd Graduation</h3>
                                <p class="achievement-card-description">
                                    Celebrating our third graduation ceremony - a significant institutional milestone
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Milestone</span>
                                    <span class="achievement-badge">History</span>
                                </div>
                            </div>
                        </div>

                        <!-- Graduation Day Parade -->
                        <div class="achievement-card">
                            <img src="assets/images/achievements/graduation-day-students-matching-while-playing-trumpets-and-drum.jpg" alt="ISNM Graduation Day Parade - Musical Celebration" title="ISNM Graduation Parade - Students with Musical Instruments" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Musical Parade</h3>
                                <p class="achievement-card-description">
                                    Students celebrating graduation day with trumpets and drums in a joyful parade
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Music</span>
                                    <span class="achievement-badge">Parade</span>
                                </div>
                            </div>
                        </div>

                        <!-- Girls Graduation -->
                        <div class="achievement-card">
                            <img src="assets/images/achievements/girls-in-graduation-ceremony.jpg" alt="ISNM Girls Graduation - Female Student Achievement" title="ISNM Girls Graduation - Empowering Female Healthcare Professionals" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Women in Healthcare</h3>
                                <p class="achievement-card-description">
                                    Celebrating our female graduates as they enter the healthcare profession
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Women</span>
                                    <span class="achievement-badge">Healthcare</span>
                                </div>
                            </div>
                        </div>

                        <!-- Boys Graduation -->
                        <div class="achievement-card">
                            <img src="assets/images/achievements/boys-in-graduation.jpg" alt="ISNM Boys Graduation - Male Student Achievement" title="ISNM Boys Graduation - Male Healthcare Professionals" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Male Graduates</h3>
                                <p class="achievement-card-description">
                                    Our male graduates ready to serve as professional healthcare providers
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Men</span>
                                    <span class="achievement-badge">Healthcare</span>
                                </div>
                            </div>
                        </div>

                        <!-- Mama Baby Graduation -->
                        <div class="achievement-card">
                            <img src="assets/images/achievements/mama-baby-in-her-graduation.jpg" alt="ISNM Mama Baby Graduation - Midwifery Achievement" title="ISNM Midwifery Graduation - Mother and Baby Healthcare" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Midwifery Excellence</h3>
                                <p class="achievement-card-description">
                                    Celebrating midwifery graduates ready to provide mother and baby healthcare
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Midwifery</span>
                                    <span class="achievement-badge">Maternal</span>
                                </div>
                            </div>
                        </div>

                        <!-- Nurses Marching -->
                        <div class="achievement-card">
                            <img src="assets/images/achievements/nurses-and-midwifes-students-matching-on-graduation-day.jpg" alt="ISNM Nurses and Midwives Marching - Graduation Day" title="ISNM Graduation March - Nurses and Midwives Procession" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Graduation March</h3>
                                <p class="achievement-card-description">
                                    Nurses and midwifery students marching in celebration of their graduation achievement
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Procession</span>
                                    <span class="achievement-badge">Unity</span>
                                </div>
                            </div>
                        </div>

                        <!-- Hero Students Classroom -->
                        <div class="achievement-card">
                            <img src="assets/images/hero/students-in-class.jpg" alt="ISNM Students in Classroom - Learning Environment" title="ISNM Classroom Learning - Students Engaged in Studies" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Classroom Learning</h3>
                                <p class="achievement-card-description">
                                    Students actively engaged in classroom learning and academic activities
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Learning</span>
                                    <span class="achievement-badge">Classroom</span>
                                </div>
                            </div>
                        </div>

                        <!-- Hero Graduation Image -->
                        <div class="achievement-card">
                            <img src="assets/images/hero/graduations-hero.jpg" alt="ISNM Graduation Hero - Academic Achievement" title="ISNM Graduation Success - Academic Excellence Celebration" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Academic Success</h3>
                                <p class="achievement-card-description">
                                    Showcasing academic excellence and success in nursing and midwifery education
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Excellence</span>
                                    <span class="achievement-badge">Success</span>
                                </div>
                            </div>
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

    <!-- Footer -->
    <footer class="footer" id="contact">
        <div class="footer-content">
            <div class="footer-grid">
                <div class="footer-section">
                    <h3 class="footer-title">Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="about.php">About ISNM</a></li>
                        <li><a href="governance.php">Governance</a></li>
                        <li><a href="programs.php">Academic Programs</a></li>
                        <li><a href="activities.php">School Activities</a></li>
                        <li><a href="infrastructure.php">Infrastructure</a></li>
                        <li><a href="achievements.php">Achievements</a></li>
                        <li><a href="history.php">School History</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3 class="footer-title">Application</h3>
                    <ul class="footer-links">
                        <li><a href="application.php">Apply Now</a></li>
                        <li><a href="programs.php">Program Requirements</a></li>
                        <li><a href="programs.php">Fee Structure</a></li>
                        <li><a href="login-portal.php">Student Portal</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3 class="footer-title">Contact Info</h3>
                    <div class="contact-info">
                        <p><i class="fas fa-map-marker-alt"></i> Iganga, Uganda</p>
                        <p><i class="fas fa-phone"></i> +256 782633253</p>
                        <p><i class="fas fa-phone"></i> +256 703999796</p>
                        <p><i class="fas fa-phone"></i> +256 753393340</p>
                        <p><i class="fas fa-envelope"></i> info@isnm.ug.edu</p>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <h3 class="footer-title">Designed and Developed by Reagan Otema</h3>
                <p class="footer-subtitle">For system errors, contact via WhatsApp</p>
                <div class="footer-buttons">
                    <a href="https://wa.me/256772514889" target="_blank" class="whatsapp-btn">
                        <i class="fab fa-whatsapp"></i>
                        MTN: +256772514889
                    </a>
                    <a href="https://wa.me/256730314979" target="_blank" class="whatsapp-btn">
                        <i class="fab fa-whatsapp"></i>
                        Airtel: +256730314979
                    </a>
                </div>
                <div class="copyright">
                    <p>&copy; 2026 Iganga School of Nursing and Midwifery. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile Menu Toggle
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const navLinks = document.getElementById('navLinks');
        
        if (mobileMenuToggle && navLinks) {
            mobileMenuToggle.addEventListener('click', function() {
                mobileMenuToggle.classList.toggle('active');
                navLinks.classList.toggle('active');
            });
            
            // Close menu when clicking outside
            document.addEventListener('click', function(e) {
                if (!mobileMenuToggle.contains(e.target) && !navLinks.contains(e.target)) {
                    mobileMenuToggle.classList.remove('active');
                    navLinks.classList.remove('active');
                }
            });
            
            // Close menu when clicking on a link
            navLinks.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenuToggle.classList.remove('active');
                    navLinks.classList.remove('active');
                });
            });
        }

        // Mobile Dropdown Toggle
        const navDropdowns = document.querySelectorAll('.nav-dropdown');
        
        navDropdowns.forEach(dropdown => {
            const toggle = dropdown.querySelector('.nav-dropdown-toggle');
            const menu = dropdown.querySelector('.nav-dropdown-menu');
            
            if (toggle && menu) {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Close other dropdowns
                    navDropdowns.forEach(otherDropdown => {
                        if (otherDropdown !== dropdown) {
                            otherDropdown.classList.remove('active');
                        }
                    });
                    
                    // Toggle current dropdown
                    dropdown.classList.toggle('active');
                });
            }
        });

        // Handle window resize
        let isMobile = window.innerWidth <= 768;
        
        window.addEventListener('resize', () => {
            const newIsMobile = window.innerWidth <= 768;
            if (isMobile !== newIsMobile) {
                isMobile = newIsMobile;
                // Reset mobile menu on resize
                if (!isMobile && navLinks) {
                    navLinks.classList.remove('active');
                    mobileMenuToggle.classList.remove('active');
                    navDropdowns.forEach(dropdown => {
                        dropdown.classList.remove('active');
                    });
                }
            }
        });

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

        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const navLinks = document.getElementById('navLinks');
        
        if (mobileMenuBtn && navLinks) {
            mobileMenuBtn.addEventListener('click', () => {
                navLinks.classList.toggle('active');
                const icon = mobileMenuBtn.querySelector('i');
                if (icon) {
                    icon.classList.toggle('fa-bars');
                    icon.classList.toggle('fa-times');
                }
            });
            
            // Close mobile menu when clicking on a link
            navLinks.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    navLinks.classList.remove('active');
                    const icon = mobileMenuBtn.querySelector('i');
                    if (icon) {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                });
            });
            
            // Close mobile menu when clicking outside
            document.addEventListener('click', (e) => {
                if (!mobileMenuBtn.contains(e.target) && !navLinks.contains(e.target)) {
                    navLinks.classList.remove('active');
                    const icon = mobileMenuBtn.querySelector('i');
                    if (icon) {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                }
            });
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

        // Add parallax effect to header (disabled on mobile for performance)
        let isMobile = window.innerWidth <= 768;
        
        window.addEventListener('resize', () => {
            isMobile = window.innerWidth <= 768;
        });
        
        if (!isMobile) {
            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const header = document.querySelector('.luxury-header');
                if (header) {
                    header.style.transform = `translateY(${scrolled * 0.5}px)`;
                }
            });
        }

        // Add error handling for images
        document.querySelectorAll('img').forEach(img => {
            img.addEventListener('error', function() {
                this.style.display = 'none';
                console.warn('Image failed to load:', this.src);
            });
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Advanced Image Interactions
        class ImageGallery {
            constructor() {
                this.images = document.querySelectorAll('.achievement-image');
                this.lightbox = this.createLightbox();
                this.init();
            }

            createLightbox() {
                const lightbox = document.createElement('div');
                lightbox.className = 'lightbox';
                lightbox.innerHTML = `
                    <div class="lightbox-overlay"></div>
                    <div class="lightbox-content">
                        <button class="lightbox-close">&times;</button>
                        <img class="lightbox-image" src="" alt="">
                        <div class="lightbox-caption"></div>
                        <div class="lightbox-nav">
                            <button class="lightbox-prev">&#8249;</button>
                            <button class="lightbox-next">&#8250;</button>
                        </div>
                    </div>
                `;
                document.body.appendChild(lightbox);
                return lightbox;
            }

            init() {
                this.images.forEach((img, index) => {
                    img.addEventListener('click', (e) => this.openLightbox(e, index));
                    img.addEventListener('mouseenter', (e) => this.addHoverEffect(e));
                    img.addEventListener('mouseleave', (e) => this.removeHoverEffect(e));
                });

                this.lightbox.addEventListener('click', (e) => {
                    if (e.target === this.lightbox || e.target.classList.contains('lightbox-overlay') || e.target.classList.contains('lightbox-close')) {
                        this.closeLightbox();
                    }
                });

                document.addEventListener('keydown', (e) => {
                    if (this.lightbox.classList.contains('active')) {
                        if (e.key === 'Escape') this.closeLightbox();
                        if (e.key === 'ArrowLeft') this.navigate(-1);
                        if (e.key === 'ArrowRight') this.navigate(1);
                    }
                });
            }

            openLightbox(e, index) {
                e.preventDefault();
                const img = e.currentTarget;
                const lightboxImg = this.lightbox.querySelector('.lightbox-image');
                const caption = this.lightbox.querySelector('.lightbox-caption');
                
                lightboxImg.src = img.src;
                lightboxImg.alt = img.alt;
                caption.textContent = img.alt || img.title;
                
                this.lightbox.classList.add('active');
                this.currentIndex = index;
                document.body.style.overflow = 'hidden';
                
                // Add entrance animation
                setTimeout(() => {
                    this.lightbox.querySelector('.lightbox-content').style.transform = 'scale(1)';
                }, 10);
            }

            closeLightbox() {
                this.lightbox.classList.remove('active');
                document.body.style.overflow = '';
                this.lightbox.querySelector('.lightbox-content').style.transform = 'scale(0.8)';
            }

            navigate(direction) {
                this.currentIndex += direction;
                if (this.currentIndex < 0) this.currentIndex = this.images.length - 1;
                if (this.currentIndex >= this.images.length) this.currentIndex = 0;
                
                const img = this.images[this.currentIndex];
                const lightboxImg = this.lightbox.querySelector('.lightbox-image');
                const caption = this.lightbox.querySelector('.lightbox-caption');
                
                lightboxImg.style.opacity = '0';
                setTimeout(() => {
                    lightboxImg.src = img.src;
                    lightboxImg.alt = img.alt;
                    caption.textContent = img.alt || img.title;
                    lightboxImg.style.opacity = '1';
                }, 200);
            }

            addHoverEffect(e) {
                const img = e.currentTarget;
                img.style.transform = 'scale(1.05) rotateX(2deg) rotateY(-2deg) translateZ(10px)';
                img.style.filter = 'brightness(1.1) contrast(1.05) saturate(1.2)';
            }

            removeHoverEffect(e) {
                const img = e.currentTarget;
                img.style.transform = '';
                img.style.filter = '';
            }
        }

        // Parallax Effect for Gallery Section
        class ParallaxEffect {
            constructor() {
                this.gallerySection = document.querySelector('.achievement-gallery-section');
                this.cards = document.querySelectorAll('.achievement-card');
                this.init();
            }

            init() {
                window.addEventListener('scroll', this.handleScroll.bind(this));
                window.addEventListener('mousemove', this.handleMouseMove.bind(this));
            }

            handleScroll() {
                if (!this.gallerySection) return;
                
                const rect = this.gallerySection.getBoundingClientRect();
                const scrolled = window.pageYOffset;
                
                if (rect.top < window.innerHeight && rect.bottom > 0) {
                    const speed = 0.5;
                    const yPos = -(scrolled * speed);
                    this.gallerySection.style.backgroundPosition = `center ${yPos}px`;
                }
            }

            handleMouseMove(e) {
                this.cards.forEach((card, index) => {
                    const rect = card.getBoundingClientRect();
                    const centerX = rect.left + rect.width / 2;
                    const centerY = rect.top + rect.height / 2;
                    
                    const angleX = (e.clientY - centerY) / 30;
                    const angleY = (centerX - e.clientX) / 30;
                    
                    card.style.transform = `perspective(1000px) rotateX(${angleX}deg) rotateY(${angleY}deg) translateZ(10px)`;
                });
            }
        }

        // Intersection Observer for Animations
        class ScrollAnimations {
            constructor() {
                this.observer = new IntersectionObserver(this.handleIntersection.bind(this), {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                });
                this.init();
            }

            init() {
                const elements = document.querySelectorAll('.achievement-card, .stat-item, .challenge-card, .plan-card');
                elements.forEach(el => this.observer.observe(el));
            }

            handleIntersection(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0) scale(1)';
                        entry.target.style.animation = 'fadeInUp 0.6s ease forwards';
                    }
                });
            }
        }

        // Image Loading Optimization
        class ImageLoader {
            constructor() {
                this.images = document.querySelectorAll('.achievement-image');
                this.init();
            }

            init() {
                this.images.forEach(img => {
                    if (img.complete) {
                        this.animateImage(img);
                    } else {
                        img.addEventListener('load', () => this.animateImage(img));
                        img.addEventListener('error', () => this.handleImageError(img));
                    }
                });
            }

            animateImage(img) {
                img.style.animation = 'imageLoadIn 1.2s ease-out';
                img.style.opacity = '1';
            }

            handleImageError(img) {
                img.style.display = 'none';
                console.warn('Image failed to load:', img.src);
                
                // Create placeholder
                const placeholder = document.createElement('div');
                placeholder.className = 'image-placeholder';
                placeholder.innerHTML = `<i class="fas fa-image"></i><span>Image Not Available</span>`;
                img.parentNode.insertBefore(placeholder, img);
            }
        }

        // Initialize all components
        document.addEventListener('DOMContentLoaded', () => {
            new ImageGallery();
            new ParallaxEffect();
            new ScrollAnimations();
            new ImageLoader();
        });

        // Add lightbox styles dynamically
        const lightboxStyles = `
            .lightbox {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.95);
                z-index: 10000;
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
            }

            .lightbox.active {
                opacity: 1;
                visibility: visible;
            }

            .lightbox-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: radial-gradient(circle, transparent 0%, rgba(0,0,0,0.4) 100%);
            }

            .lightbox-content {
                position: relative;
                max-width: 90%;
                max-height: 90%;
                transform: scale(0.8);
                transition: transform 0.3s ease;
                z-index: 1;
            }

            .lightbox-image {
                max-width: 100%;
                max-height: 80vh;\n                border-radius: 12px;
                box-shadow: 0 20px 60px rgba(0,0,0,0.5);
                transition: opacity 0.3s ease;
            }

            .lightbox-caption {
                text-align: center;
                color: white;
                margin-top: 1rem;
                font-size: 1.1rem;
                text-shadow: 0 2px 4px rgba(0,0,0,0.5);
            }

            .lightbox-close {
                position: absolute;
                top: -40px;
                right: 0;
                background: rgba(255,255,255,0.2);
                border: none;
                color: white;
                font-size: 2rem;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .lightbox-close:hover {
                background: rgba(255,255,255,0.3);
                transform: scale(1.1);
            }

            .lightbox-nav {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                width: 100%;
                display: flex;
                justify-content: space-between;
                padding: 0 20px;
                pointer-events: none;
            }

            .lightbox-prev, .lightbox-next {
                background: rgba(255,255,255,0.2);
                border: none;
                color: white;
                font-size: 2rem;
                width: 50px;
                height: 50px;
                border-radius: 50%;
                cursor: pointer;
                transition: all 0.3s ease;
                pointer-events: all;
            }

            .lightbox-prev:hover, .lightbox-next:hover {
                background: rgba(255,255,255,0.3);
                transform: scale(1.1);
            }

            .image-placeholder {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                height: 280px;
                background: linear-gradient(135deg, var(--gray-light), var(--gray-medium));
                border-radius: 20px 20px 0 0;
                color: var(--text-secondary);
                font-size: 1.1rem;
            }

            .image-placeholder i {
                font-size: 3rem;
                margin-bottom: 1rem;
                opacity: 0.5;
            }
        `;

        const styleSheet = document.createElement('style');
        styleSheet.textContent = lightboxStyles;
        document.head.appendChild(styleSheet);
    </script>
</body>
</html>
