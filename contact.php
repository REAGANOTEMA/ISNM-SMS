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
    <title>Contact Us - Iganga School of Nursing and Midwifery</title>
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
            color: #000000;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.95);
            border: 2px solid #000000;
            font-family: 'Inter', sans-serif;
            transform-style: preserve-3d;
            transform: translateZ(0);
            letter-spacing: 0.5px;
            text-transform: uppercase;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #000000 0%, var(--primary-dark) 100%);
            border-radius: 8px;
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
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), transparent);
            border-radius: 8px;
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: -1;
        }

        .nav-link:hover {
            color: #FFFFFF;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
            border-color: #000000;
            background: #000000;
        }

        .nav-link:hover::before {
            opacity: 1;
        }

        .nav-link:hover::after {
            opacity: 0.3;
        }

        .nav-link:active {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
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

        /* Mobile Menu Toggle */
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
            transition: all 0.4s ease;
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
        }

        .mobile-menu-toggle:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(10, 22, 40, 0.3);
        }

        .mobile-menu-toggle.active::before {
            transform: translate(-50%, -50%) rotate(45deg);
        }

        .mobile-menu-toggle.active::after {
            transform: translate(-50%, -50%) rotate(-45deg);
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

        /* Main Content */
        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 3rem 2rem;
        }

        /* Contact Section */
        .contact-section {
            margin-bottom: 3rem;
        }

        .contact-intro {
            text-align: center;
            margin-bottom: 3rem;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .contact-image-card {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            transition: all 0.3s ease;
        }

        .contact-image-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .image-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
            color: white;
            padding: 2rem;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }

        .contact-image-card:hover .image-overlay {
            transform: translateY(0);
        }

        .contact-info-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
        }

        .contact-form {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 2rem;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 1.5rem;
            padding: 1.5rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .contact-item:last-child {
            border-bottom: none;
        }

        .contact-icon {
            width: 50px;
            height: 50px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .contact-details h3 {
            font-weight: 600;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
        }

        .contact-details p {
            color: var(--text-secondary);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 1rem;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .submit-btn {
            background: var(--gradient-primary);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* Map Section */
        .map-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            margin-bottom: 3rem;
        }

        .map-container {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .map-container iframe {
            width: 100%;
            height: 450px;
            border: none;
            border-radius: 15px;
        }

        .map-info {
            text-align: center;
            padding: 2rem;
            background: linear-gradient(135deg, #f8fafc, #ffffff);
            border-radius: 15px;
            border: 1px solid var(--border-color);
        }

        .map-info h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 1rem;
        }

        .map-info p {
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .directions-btn {
            display: flex;
            justify-content: center;
        }

        .btn-directions {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--gradient-primary);
            color: white;
            padding: 1rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .btn-directions:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            background: var(--accent-gold);
        }

        /* Quick Links */
        .quick-links {
            background: var(--gradient-primary);
            color: white;
            border-radius: 20px;
            padding: 3rem;
            position: relative;
            overflow: hidden;
        }

        .quick-links::before {
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

        .quick-links-content {
            position: relative;
            z-index: 1;
        }

        .quick-links-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .quick-link-item {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .quick-link-item:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
        }

        .quick-link-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .quick-link-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .quick-link-description {
            opacity: 0.9;
            margin-bottom: 1rem;
        }

        .quick-link-btn {
            background: var(--golden-yellow);
            color: var(--primary-blue);
            padding: 0.5rem 1rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .quick-link-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
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
            
            .contact-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            
            .contact-image-card img {
                height: 200px;
            }
            
            .map-container iframe {
                height: 300px;
            }
            
            .quick-links-grid {
                grid-template-columns: 1fr;
            }
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

        /* Premium Contact Gallery Section Styles */
        .contact-gallery-section {
            padding: 6rem 2rem;
            background: linear-gradient(135deg, var(--gray-light) 0%, var(--white) 50%, var(--gray-light) 100%);
            position: relative;
            overflow: hidden;
        }

        .contact-gallery-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 40% 40%, rgba(37, 99, 235, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 60% 60%, rgba(6, 182, 212, 0.03) 0%, transparent 50%),
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="contact-bg-pattern" width="55" height="55" patternUnits="userSpaceOnUse"><circle cx="27.5" cy="27.5" r="3.5" fill="rgba(37, 99, 235, 0.06)"/><path d="M17 27.5 Q27.5 17, 38 27.5 T59 27.5" stroke="rgba(6, 182, 212, 0.04)" stroke-width="1" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23contact-bg-pattern)"/></svg>');
            background-size: cover, cover, 110px 110px;
            background-position: center, center, 0 0;
            animation: contactFloat 60s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes contactFloat {
            0%, 100% { transform: translateX(0) translateY(0) rotate(0deg); }
            25% { transform: translateX(22px) translateY(-14px) rotate(0.6deg); }
            50% { transform: translateX(44px) translateY(0) rotate(0deg); }
            75% { transform: translateX(22px) translateY(14px) rotate(-0.6deg); }
        }

        .contact-gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(360px, 1fr));
            grid-auto-rows: 340px;
            gap: 2.8rem;
            position: relative;
            z-index: 2;
        }

        .contact-item {
            position: relative;
            overflow: hidden;
            border-radius: 32px;
            box-shadow: var(--shadow-xl);
            transition: all 1s cubic-bezier(0.4, 0, 0.2, 1);
            transform-style: preserve-3d;
            transform: translateZ(0);
            background: var(--white);
        }

        .contact-item-large {
            grid-column: span 2;
            grid-row: span 2;
        }

        .contact-item-wide {
            grid-column: span 2;
        }

        .contact-image-wrapper {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
            border-radius: 32px;
        }

        .contact-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 1.2s cubic-bezier(0.4, 0, 0.2, 1);
            transform: scale(1);
            filter: brightness(1) contrast(1) saturate(1);
        }

        .contact-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(
                to bottom,
                transparent 0%,
                transparent 38%,
                rgba(10, 22, 40, 0.85) 78%,
                rgba(10, 22, 40, 0.98) 100%
            );
            display: flex;
            align-items: flex-end;
            padding: 4rem;
            opacity: 0;
            transition: all 1s cubic-bezier(0.4, 0, 0.2, 1);
            transform: translateY(40px);
        }

        .contact-content {
            color: var(--white);
            transform: translateZ(30px);
        }

        .contact-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 1.4rem;
            text-shadow: 4px 4px 12px rgba(0, 0, 0, 0.9);
        }

        .contact-description {
            font-size: 1.2rem;
            line-height: 1.9;
            margin-bottom: 2rem;
            opacity: 0.95;
        }

        .contact-badges {
            display: flex;
            gap: 1.2rem;
            flex-wrap: wrap;
        }

        .contact-badge {
            background: linear-gradient(135deg, var(--accent-blue) 0%, var(--accent-cyan) 100%);
            color: var(--white);
            padding: 0.8rem 1.6rem;
            border-radius: 40px;
            font-size: 0.95rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            box-shadow: 0 12px 30px rgba(37, 99, 235, 0.7);
        }

        /* Contact Gallery Hover Effects */
        .contact-item:hover {
            transform: translateY(-35px) translateZ(70px) rotateX(7deg) rotateY(-6deg);
            box-shadow: 
                var(--shadow-2xl),
                0 0 120px rgba(37, 99, 235, 0.7),
                0 0 250px rgba(6, 182, 212, 0.6);
        }

        .contact-item:hover .contact-image {
            transform: scale(1.22) rotateX(6deg) rotateY(-6deg);
            filter: brightness(1.3) contrast(1.2) saturate(1.3);
        }

        .contact-item:hover .contact-overlay {
            opacity: 1;
            transform: translateY(0);
            background: linear-gradient(
                to bottom,
                transparent 0%,
                transparent 28%,
                rgba(10, 22, 40, 0.75) 68%,
                rgba(10, 22, 40, 0.9) 100%
            );
        }

        /* Contact Item Animations */
        .contact-item:nth-child(1) { animation: contactSlideIn 1.2s ease-out 0.1s both; }
        .contact-item:nth-child(2) { animation: contactSlideIn 1.2s ease-out 0.2s both; }
        .contact-item:nth-child(3) { animation: contactSlideIn 1.2s ease-out 0.3s both; }
        .contact-item:nth-child(4) { animation: contactSlideIn 1.2s ease-out 0.4s both; }
        .contact-item:nth-child(5) { animation: contactSlideIn 1.2s ease-out 0.5s both; }
        .contact-item:nth-child(6) { animation: contactSlideIn 1.2s ease-out 0.6s both; }
        .contact-item:nth-child(7) { animation: contactSlideIn 1.2s ease-out 0.7s both; }
        .contact-item:nth-child(8) { animation: contactSlideIn 1.2s ease-out 0.8s both; }

        @keyframes contactSlideIn {
            from {
                opacity: 0;
                transform: translateY(70px) scale(0.7);
                filter: blur(25px);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
                filter: blur(0);
            }
        }

        /* Responsive Contact Gallery */
        @media (max-width: 1024px) {
            .contact-gallery-grid {
                grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
                grid-auto-rows: 300px;
                gap: 2.2rem;
            }

            .contact-item-large {
                grid-column: span 1;
                grid-row: span 1;
            }

            .contact-item-wide {
                grid-column: span 1;
            }

            .contact-title {
                font-size: 1.7rem;
            }

            .contact-description {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 768px) {
            .contact-gallery-section {
                padding: 4rem 1rem;
            }

            .contact-gallery-grid {
                grid-template-columns: 1fr;
                grid-auto-rows: 340px;
                gap: 2rem;
            }

            .contact-item-large,
            .contact-item-wide {
                grid-column: span 1;
                grid-row: span 1;
            }

            .contact-overlay {
                padding: 3.5rem;
            }

            .contact-title {
                font-size: 1.8rem;
            }

            .contact-description {
                font-size: 1.15rem;
            }

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

        @media (max-width: 480px) {
            .contact-title {
                font-size: 1.6rem;
            }

            .contact-description {
                font-size: 1.05rem;
            }

            .contact-badge {
                font-size: 0.85rem;
                padding: 0.7rem 1.4rem;
            }
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
                    <a href="index.php" class="nav-link">Home</a>
                    
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
            <h1 class="page-title">Contact Us</h1>
            <div class="breadcrumb">
                <p>Home / Contact</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Contact Section -->
        <div class="contact-section">
            <div class="contact-intro">
                <h2 class="section-title">Get in Touch</h2>
                <p class="section-subtitle">We're here to help you start your healthcare career journey</p>
            </div>
            
            <div class="contact-grid">
                <div class="contact-image-card">
                    <img src="assets/images/facilities/administration-block.jpg" alt="ISNM Administration Block" style="width: 100%; height: 250px; object-fit: cover; border-radius: 15px;">
                    <div class="image-overlay">
                        <h4>Visit Our Campus</h4>
                        <p>Experience our modern facilities and meet our dedicated staff</p>
                    </div>
                </div>
                
                <div class="contact-info-card">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Location</h3>
                            <p>Iganga Town, Iganga District<br>Eastern Region, Uganda</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Phone Numbers</h3>
                            <p>+256 782633253</p>
                            <p>+256 703999796</p>
                            <p>+256 753393340</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Email Addresses</h3>
                            <p>General: info@isnm.ug.edu</p>
                            <p>Application: application@isnm.ug.edu</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Office Hours</h3>
                            <p>Monday - Friday: 8:00 AM - 5:00 PM</p>
                            <p>Saturday: 8:00 AM - 1:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="contact-form">
                <h2 class="section-title">Send us a Message</h2>
                
                <form action="#" method="POST">
                    <div class="form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone">
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Subject *</label>
                        <input type="text" id="subject" name="subject" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message *</label>
                        <textarea id="message" name="message" required></textarea>
                    </div>
                    
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-paper-plane"></i>
                        Send Message
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Map Section -->
        <div class="map-section">
            <h2 class="section-title">Find Us</h2>
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.7654321098765!2d33.4516861!3d0.5918431!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x177ef324132c5553:0x86feaa6ce21fc3a1!2sIganga+School+of+Nursing+%26+Midwifery!5e0!3m2!1sen!2sug!4v1234567890"
                    width="100%" 
                    height="450" 
                    style="border:0; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Iganga School of Nursing and Midwifery Location">
                </iframe>
            </div>
            <div class="map-info">
                <h3>Visit Iganga School of Nursing and Midwifery</h3>
                <p>Located in the heart of Iganga Town, Eastern Uganda, our campus provides easy access to quality healthcare education. Use the map above to find directions to our institution.</p>
                <div class="directions-btn">
                    <a href="https://www.google.com/maps/place/Iganga+School+of+Nursing+%26+Midwifery/@0.5918431,33.4516861,17z/data=!3m1!4b1!4m6!3m5!1s0x177ef324132c5553:0x86feaa6ce21fc3a1!8m2!3d0.5918377!4d33.454261!16s%2Fg%2F11b5ys19t0?hl=en-GB&entry=ttu&g_ep=EgoyMDI2MDQxNS4wIKXMDSoASAFQAw%3D%3D" target="_blank" class="btn-directions">
                        <i class="fas fa-directions"></i>
                        Get Directions
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Quick Links -->
        <div class="quick-links">
            <div class="quick-links-content">
                <h2 class="section-title" style="color: white; text-align: center;">Quick Links</h2>
                <div class="quick-links-grid">
                    <div class="quick-link-item">
                        <div class="quick-link-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3 class="quick-link-title">Application</h3>
                        <p class="quick-link-description">Apply now and join our healthcare programs</p>
                        <a href="application.php" class="quick-link-btn">Apply Now</a>
                    </div>
                    
                    <div class="quick-link-item">
                        <div class="quick-link-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <h3 class="quick-link-title">Programs</h3>
                        <p class="quick-link-description">Explore our nursing and midwifery programs</p>
                        <a href="programs.php" class="quick-link-btn">View Programs</a>
                    </div>
                    
                    <div class="quick-link-item">
                        <div class="quick-link-icon">
                            <i class="fas fa-sign-in-alt"></i>
                        </div>
                        <h3 class="quick-link-title">Student Portal</h3>
                        <p class="quick-link-description">Access your student account and resources</p>
                        <a href="login-portal.php" class="quick-link-btn">Login</a>
                    </div>
                </div>
            </div>
        </div>
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
        window.addEventListener('resize', () => {
            const isMobile = window.innerWidth <= 768;
            // Reset mobile menu on resize
            if (!isMobile && navLinks) {
                navLinks.classList.remove('active');
                mobileMenuToggle.classList.remove('active');
                navDropdowns.forEach(dropdown => {
                    dropdown.classList.remove('active');
                });
            }
        });

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

        // Form submission handler
        const contactForm = document.querySelector('form');
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Create success message instead of alert
                const successMessage = document.createElement('div');
                successMessage.style.cssText = `
                    position: fixed;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    background: linear-gradient(135deg, #2563eb, #06b6d4);
                    color: white;
                    padding: 2rem 3rem;
                    border-radius: 15px;
                    box-shadow: 0 20px 40px rgba(0,0,0,0.3);
                    z-index: 10000;
                    font-family: 'Inter', sans-serif;
                    font-size: 1.1rem;
                    text-align: center;
                    animation: slideIn 0.3s ease;
                `;
                successMessage.innerHTML = `
                    <div style="margin-bottom: 1rem;">
                        <i class="fas fa-check-circle" style="font-size: 2rem; color: #10b981;"></i>
                    </div>
                    <div>Thank you for your message!</div>
                    <div style="font-size: 0.9rem; margin-top: 0.5rem; opacity: 0.9;">We will get back to you soon.</div>
                `;
                
                document.body.appendChild(successMessage);
                
                // Remove message after 3 seconds
                setTimeout(() => {
                    successMessage.style.animation = 'slideOut 0.3s ease';
                    setTimeout(() => {
                        if (successMessage.parentNode) {
                            successMessage.parentNode.removeChild(successMessage);
                        }
                    }, 300);
                }, 3000);
                
                // Reset form
                this.reset();
            });
        }

        // Add CSS animations for success message
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from {
                    opacity: 0;
                    transform: translate(-50%, -50%) scale(0.8);
                }
                to {
                    opacity: 1;
                    transform: translate(-50%, -50%) scale(1);
                }
            }
            @keyframes slideOut {
                from {
                    opacity: 1;
                    transform: translate(-50%, -50%) scale(1);
                }
                to {
                    opacity: 0;
                    transform: translate(-50%, -50%) scale(0.8);
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>


