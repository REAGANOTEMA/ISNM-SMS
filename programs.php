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
            
            /* Additional missing variables */
            --pure-white: #FFFFFF;
            --accent-blue: #3b82f6;
            --golden-yellow: #fbbf24;
            
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

        /* Cinema-Quality 3D Navigation - No Space Above */
        .navbar {
            position: fixed;
            top: 40px;
            left: 0;
            right: 0;
            background: rgba(255,255,255,0.96);
            border-bottom: 1px solid rgba(220,220,220,0.9);
            z-index: 1001;
            padding: 0.5rem 0;
            box-shadow: 0 14px 34px rgba(0,0,0,0.08);
            backdrop-filter: blur(16px);
            transition: all 0.35s ease;
            height: auto;
        }

        .navbar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--gradient-primary);
            opacity: 0.8;
        }

        .navbar::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="nav-pattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(15,76,117,0.1)"/><path d="M5 10 Q10 5, 15 10 T25 10" stroke="rgba(30,107,168,0.15)" stroke-width="1" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23nav-pattern)"/></svg>');
            opacity: 0.05;
            pointer-events: none;
            animation: navPatternFloat 30s linear infinite;
        }

        .brand-banner {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--accent-gold) 100%);
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
            background: rgba(255, 255, 255, 1);
            backdrop-filter: blur(16px);
            box-shadow: 0 18px 50px rgba(0,0,0,0.1);
            border-bottom-color: rgba(210,210,210,0.95);
            transform: translateY(0);
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

        .nav-logo::before {
            content: '';
            position: absolute;
            top: -5px;
            left: -5px;
            right: -5px;
            bottom: -5px;
            background: var(--gradient-3d-primary);
            border-radius: 50%;
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: -1;
        }

        .nav-logo:hover::before {
            opacity: 0.2;
        }

        .nav-logo img {
            width: 64px;
            height: 64px;
            object-fit: cover;
            border: 2px solid rgba(17, 82, 147, 0.2);
            border-radius: 50%;
            transition: all 0.35s ease;
            box-shadow: 0 12px 28px rgba(0,0,0,0.12);
            transform-style: preserve-3d;
            background: white;
            position: relative;
            z-index: 3;
        }

        .nav-logo img::after {
            content: '';
            position: absolute;
            top: -3px;
            left: -3px;
            right: -3px;
            bottom: -3px;
            background: linear-gradient(135deg, var(--medical-accent), var(--medical-cyan));
            border-radius: 50%;
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: -1;
        }

        .nav-logo:hover {
            transform: translateY(-2px);
        }

        .nav-logo:hover img {
            transform: scale(1.03);
            box-shadow: 0 14px 32px rgba(0,0,0,0.16);
            border-color: rgba(255, 215, 0, 0.8);
        }

        .nav-logo:hover img::after {
            opacity: 0;
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

        .nav-link::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), transparent);
            border-radius: 12px;
            opacity: 0;
            transition: opacity 0.4s ease;
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

        .nav-link:hover::after {
            opacity: 0.15;
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

        @keyframes navPatternFloat {
            0% { transform: translateX(0) translateY(0); }
            25% { transform: translateX(10px) translateY(-5px); }
            50% { transform: translateX(20px) translateY(0); }
            75% { transform: translateX(10px) translateY(5px); }
            100% { transform: translateX(0) translateY(0); }
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

        /* Mobile Menu Button */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .mobile-menu-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }

            .nav-links {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: var(--gradient-primary);
                flex-direction: column;
                padding: 1rem;
                gap: 0.5rem;
                border-radius: 0 0 12px 12px;
                box-shadow: var(--shadow-lg);
                z-index: 1000;
            }

            .nav-links.active {
                display: flex;
            }

            .nav-links li {
                width: 100%;
            }

            .nav-links a {
                display: block;
                padding: 0.75rem 1rem;
                border-radius: 8px;
                text-align: center;
            }
            
            .header-nav {
                flex-wrap: wrap;
                position: relative;
            }
            
            .logo-section {
                flex: 1;
            }
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
    }
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
                    <img src="assets/school-logo.png" alt="ISNM Logo" style="width: 75px; height: 75px;">
                    <div class="nav-logo-text">
                         </div>
                </a>
                <div class="nav-links">
                    <a href="index.php" class="nav-link">Home</a>
                    <a href="about.php" class="nav-link">About</a>
                    <a href="governance.php" class="nav-link">Governance</a>
                    <a href="programs.php" class="nav-link">Programs</a>
                    <a href="application.php" class="nav-link">Application</a>
                    <a href="activities.php" class="nav-link">Activities</a>
                    <a href="infrastructure.php" class="nav-link">Infrastructure</a>
                    <a href="achievements.php" class="nav-link">Achievements</a>
                    <a href="history.php" class="nav-link">History</a>
                    <a href="contact.php" class="nav-link">Contact</a>
                    <a href="login-portal.php" class="nav-link">Portal</a>
                </div>
            </div>
        </nav>
    </div>

    <!-- Page Title Section -->
    <div class="page-header-section">
        <div class="page-header-content">
            <h1 class="page-title">Programs Offered</h1>
            <div class="breadcrumb">
                <p>Home / Programs</p>
            </div>
        </div>
    </div>

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
                            <a href="application.php" class="apply-btn">
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
                            <a href="application.php" class="apply-btn">
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
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h3 class="program-title">Diploma in Nursing</h3>
                        <p class="program-type">Diploma Program</p>
                    </div>
                    <div class="program-image">
                        <img src="assets/diploma-in-nursing-and-midwifery-extension-images-for-students.jpg" alt="Diploma in Nursing Students" class="program-img">
                    </div>
                    <div class="program-content">
                        <p class="program-description">
                            Advanced nursing program building on certificate foundation with specialized 
                            clinical skills, leadership training, and comprehensive patient care management.
                        </p>
                        <div class="program-features">
                            <div class="feature">
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
                            <a href="application.php" class="apply-btn">
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
                            <a href="application.php" class="apply-btn">
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
    </script>
</body>
</html>


