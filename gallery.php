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
    <title>Gallery - Iganga School of Nursing and Midwifery</title>
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
            padding: 0 2rem;
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
            background: var(--gradient-primary);
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
            background: linear-gradient(135deg, var(--accent-gold), var(--golden-yellow));
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
            font-weight: 600;
            font-size: 0.75rem;
            padding: 0.3rem 0.6rem;
            border-radius: 4px;
            transition: all 0.3s ease;
            background: white;
            border: 1px solid rgba(220, 220, 220, 0.9);
            font-family: 'Inter', sans-serif;
            transform-style: preserve-3d;
            transform: translateZ(0);
            letter-spacing: 0.5px;
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

        .home-link {
            background: var(--gradient-primary);
            color: var(--white);
            font-weight: 700;
            border-color: var(--accent-gold);
            position: relative;
            overflow: hidden;
        }

        .home-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        .home-link:hover {
            background: var(--gradient-luxury);
            color: var(--primary-dark);
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 8px 20px rgba(255,215,0,0.3);
        }

        .home-link:hover::before {
            left: 100%;
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
            background: var(--gradient-clean);
            color: var(--primary-dark);
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

        /* Main Content */
        .main-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 3rem 2rem;
        }

        /* Gallery Section */
        .gallery-section {
            margin-bottom: 4rem;
            opacity: 0;
            animation: fadeInUp 0.8s ease forwards;
        }

        .gallery-section:nth-child(1) { animation-delay: 0.1s; }
        .gallery-section:nth-child(2) { animation-delay: 0.2s; }
        .gallery-section:nth-child(3) { animation-delay: 0.3s; }
        .gallery-section:nth-child(4) { animation-delay: 0.4s; }
        .gallery-section:nth-child(5) { animation-delay: 0.5s; }
        .gallery-section:nth-child(6) { animation-delay: 0.6s; }

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
            color: var(--primary-dark);
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
            color: var(--gray-dark);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Gallery Grid */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .gallery-item {
            background: linear-gradient(135deg, rgba(255,255,255,0.95), rgba(248,248,255,0.9));
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 
                0 10px 30px rgba(26,26,26,0.15),
                0 20px 60px rgba(26,26,26,0.1),
                inset 0 1px 0 rgba(255,255,255,0.8);
            transform-style: preserve-3d;
            transform: translateZ(0) rotateX(0deg);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(26,26,26,0.08);
        }

        .gallery-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-gold), var(--primary-dark), var(--accent-gold));
            transform: scaleX(0);
            transition: transform 0.6s ease;
            border-radius: 20px 20px 0 0;
        }

        .gallery-item::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="gallery-pattern" width="30" height="30" patternUnits="userSpaceOnUse"><circle cx="15" cy="15" r="2" fill="rgba(26,26,26,0.08)"/><path d="M5 15 Q15 5, 25 15 T45 15" stroke="rgba(255,215,0,0.15)" stroke-width="1" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23gallery-pattern)"/></svg>'),
                radial-gradient(circle at 50% 50%, rgba(255,215,0,0.03) 0%, transparent 70%);
            background-size: 60px 60px, cover;
            background-position: 0 0, center;
            transform: translateX(-100%) translateY(-100%);
            transition: transform 1.2s ease;
            pointer-events: none;
            opacity: 0.6;
            border-radius: 20px;
        }

        .gallery-item:hover {
            transform: translateY(-12px) translateZ(25px) rotateX(3deg) rotateY(2deg);
            box-shadow: 
                0 20px 50px rgba(26,26,26,0.25),
                0 40px 80px rgba(26,26,26,0.15),
                inset 0 2px 0 rgba(255,215,0,0.2);
            border-color: var(--accent-gold);
            background: linear-gradient(135deg, rgba(255,255,255,0.98), rgba(255,248,220,0.95));
        }

        .gallery-item:hover::before {
            transform: scaleX(1);
        }

        .gallery-item:hover::after {
            transform: translateX(100%) translateY(100%);
            opacity: 0.8;
        }

        .gallery-image {
            width: 100%;
            height: 280px;
            object-fit: cover;
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            filter: brightness(1.05) contrast(1.05) saturate(1.1);
        }

        .gallery-item:hover .gallery-image {
            transform: scale(1.08) rotateY(-8deg);
            filter: brightness(1.15) contrast(1.15) saturate(1.2);
        }

        .gallery-content {
            padding: 1.5rem;
            position: relative;
            z-index: 2;
        }

        .gallery-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 0.5rem;
            transform-style: preserve-3d;
            transform: translateZ(5px);
        }

        .gallery-description {
            color: var(--gray-dark);
            font-size: 0.95rem;
            line-height: 1.6;
            transform-style: preserve-3d;
            transform: translateZ(3px);
        }

        /* Mobile Menu Toggle */
        .mobile-menu-btn {
            display: none;
            background: var(--gradient-primary);
            color: white;
            border: none;
            padding: 0.8rem;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1.2rem;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
            position: relative;
            z-index: 10;
        }

        .mobile-menu-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .nav-links.mobile-active {
            display: flex !important;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            flex-direction: column;
            padding: 1rem;
            box-shadow: var(--shadow-lg);
            border-radius: 0 0 15px 15px;
            gap: 0.5rem;
            animation: mobileMenuSlide 0.3s ease;
        }

        @keyframes mobileMenuSlide {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
                background: white;
                flex-direction: column;
                padding: 1rem;
                box-shadow: var(--shadow-lg);
                border-radius: 0 0 15px 15px;
                gap: 0.5rem;
                z-index: 1000;
            }
            
            .nav-container {
                padding: 0 1rem;
            }
            
            .nav-links {
                gap: 0.2rem;
            }
            
            .nav-link {
                font-size: 0.65rem;
                padding: 0.25rem 0.5rem;
            }
            
            .nav-logo {
                font-size: 1.2rem;
            }
            
            .nav-logo img {
                width: 50px;
                height: 50px;
            }
            
            .page-title {
                font-size: 2.2rem;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
            
            .section-subtitle {
                font-size: 1rem;
            }
            
            .gallery-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            
            .gallery-image {
                height: 250px;
            }
        }

        @media (max-width: 480px) {
            .nav-container {
                padding: 0 0.5rem;
            }
            
            .nav-links {
                gap: 0.15rem;
            }
            
            .nav-link {
                font-size: 0.6rem;
                padding: 0.2rem 0.4rem;
            }
            
            .page-title {
                font-size: 1.8rem;
            }
            
            .section-title {
                font-size: 1.5rem;
            }
            
            .gallery-image {
                height: 200px;
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
                    <img src="assets/school-logo.png" alt="ISNM Logo" style="width: 75px; height: 75px;">
                    <div class="nav-logo-text">
                         </div>
                </a>
                <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Toggle menu">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="nav-links" id="navLinks">
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
                    <a href="index.php" class="nav-link home-link">🏠 Go Back</a>
                </div>
            </div>
        </nav>
    </div>

    <!-- Page Title Section -->
    <div class="page-header-section">
        <div class="page-header-content">
            <h1 class="page-title">School Gallery</h1>
            <div class="breadcrumb">
                <p>Home / Gallery</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Graduation Gallery -->
        <section class="gallery-section">
            <div class="section-header">
                <h2 class="section-title">Graduation Ceremonies</h2>
                <p class="section-subtitle">Celebrating our graduates' achievements and milestones</p>
            </div>
            
            <div class="gallery-grid">
                <div class="gallery-item">
                    <img src="assets/graduation-ceremony.jpg" alt="Graduation Ceremony" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">Graduation Ceremony</h3>
                        <p class="gallery-description">Annual graduation ceremony celebrating the achievements of our nursing and midwifery graduates.</p>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <img src="assets/graduants-celebrating-their-graduation.jpg" alt="Graduates Celebrating" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">Graduates Celebration</h3>
                        <p class="gallery-description">Joyful moments as our graduates celebrate their successful completion of studies.</p>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <img src="assets/graduants-rejoicing.jpg" alt="Graduates Rejoicing" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">Success Celebration</h3>
                        <p class="gallery-description">Graduates expressing joy and excitement as they receive their certificates.</p>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <img src="assets/graduation-day-students-matching-while-playing-trumpets-and-drum.jpg" alt="Graduation Day Parade" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">Graduation Parade</h3>
                        <p class="gallery-description">Students marching with trumpets and drums during graduation celebrations.</p>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <img src="assets/graduation-parad-2023-students-holding-the-banner.jpg" alt="Graduation Banner" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">Graduation Banner</h3>
                        <p class="gallery-description">Class of 2023 proudly displaying their graduation banner.</p>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <img src="assets/iganga-school-of-nursing-celebrating-3rd-graduation.jpg" alt="3rd Graduation Celebration" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">3rd Graduation</h3>
                        <p class="gallery-description">Celebrating our third graduation ceremony with pride and excellence.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Student Life Gallery -->
        <section class="gallery-section">
            <div class="section-header">
                <h2 class="section-title">Student Life</h2>
                <p class="section-subtitle">Daily activities and experiences of our students</p>
            </div>
            
            <div class="gallery-grid">
                <div class="gallery-item">
                    <img src="assets/students-in-class.jpg" alt="Students in Classroom" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">Classroom Learning</h3>
                        <p class="gallery-description">Students engaged in active learning sessions in our modern classrooms.</p>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <img src="assets/students-in-skill-laboratory-in-practical-training.jpg" alt="Practical Training" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">Practical Training</h3>
                        <p class="gallery-description">Hands-on training in our state-of-the-art skills laboratory.</p>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <img src="assets/certificate-in-nursing-students-in-examamination-room.jpg" alt="Examination Room" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">Examination Hall</h3>
                        <p class="gallery-description">Students taking their certification examinations in nursing.</p>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <img src="assets/revision-session-at-the-school-library.jpg" alt="Library Study" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">Library Sessions</h3>
                        <p class="gallery-description">Students conducting revision sessions in the school library.</p>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <img src="assets/students-standing-upstairs-of-their-classroom-in-breaktime.jpg" alt="Break Time" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">Break Time</h3>
                        <p class="gallery-description">Students enjoying break time outside their classrooms.</p>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <img src="assets/students-sitting-in-the-graduation-use-it-in-hero-and-pages.jpg" alt="Graduation Seating" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">Graduation Seating</h3>
                        <p class="gallery-description">Students seated during graduation ceremony preparations.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sports Gallery -->
        <section class="gallery-section">
            <div class="section-header">
                <h2 class="section-title">Sports & Activities</h2>
                <p class="section-subtitle">Extracurricular activities and sports events</p>
            </div>
            
            <div class="gallery-grid">
                <div class="gallery-item">
                    <img src="assets/footbal-team-student-images1.jpg" alt="Football Team 1" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">Football Team</h3>
                        <p class="gallery-description">Our school football team in action during inter-school competitions.</p>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <img src="assets/footbal-team-student-images2.jpg" alt="Football Team 2" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">Team Spirit</h3>
                        <p class="gallery-description">Students showing team spirit and sportsmanship on the field.</p>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <img src="assets/footbal-team-student-images3.jpg" alt="Football Team 3" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">Athletic Excellence</h3>
                        <p class="gallery-description">Our athletes demonstrating skill and dedication in sports.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Infrastructure Gallery -->
        <section class="gallery-section">
            <div class="section-header">
                <h2 class="section-title">School Infrastructure</h2>
                <p class="section-subtitle">Our modern facilities and learning environment</p>
            </div>
            
            <div class="gallery-grid">
                <div class="gallery-item">
                    <img src="assets/classroom-building.jpg" alt="Classroom Building" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">Classroom Building</h3>
                        <p class="gallery-description">Modern classroom building designed for optimal learning experience.</p>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <img src="assets/dinnin-hall-or-main-hall.jpg" alt="Dining Hall" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">Dining Hall</h3>
                        <p class="gallery-description">Spacious dining hall providing nutritious meals for students.</p>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <img src="assets/school-kitchen.jpg" alt="School Kitchen" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">School Kitchen</h3>
                        <p class="gallery-description">Modern kitchen facilities ensuring hygienic food preparation.</p>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <img src="assets/school-borehole-a-student-is-fetching-water.jpg" alt="School Borehole" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">Water Facility</h3>
                        <p class="gallery-description">Clean water borehole providing safe drinking water for students.</p>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <img src="assets/school-mini-buses-2-costers.jpg" alt="School Transport" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">School Transport</h3>
                        <p class="gallery-description">School mini-buses providing safe transportation for students.</p>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <img src="assets/diploma-hostel.jpg" alt="Diploma Hostel" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">Diploma Hostel</h3>
                        <p class="gallery-description">Comfortable hostel accommodation for diploma program students.</p>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <img src="assets/girls-hostel.jpg" alt="Girls Hostel" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">Girls Hostel</h3>
                        <p class="gallery-description">Safe and secure hostel facilities for female students.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Practical Training Gallery -->
        <section class="gallery-section">
            <div class="section-header">
                <h2 class="section-title">Practical Training</h2>
                <p class="section-subtitle">Hands-on experience and clinical practice</p>
            </div>
            
            <div class="gallery-grid">
                <div class="gallery-item">
                    <img src="assets/student-at-practicum-site2.jpg" alt="Practicum Site 2" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">Clinical Practice</h3>
                        <p class="gallery-description">Students gaining practical experience at clinical sites.</p>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <img src="assets/student-st-practicum-sites1.jpg" alt="Practicum Site 1" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">Field Training</h3>
                        <p class="gallery-description">Hands-on training at various healthcare facilities.</p>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <img src="assets/tom-serawaji-a-school-nurse-working-at-sick-bay.jpg" alt="School Nurse" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">School Nurse</h3>
                        <p class="gallery-description">Our school nurse providing healthcare services to students.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Special Moments Gallery -->
        <section class="gallery-section">
            <div class="section-header">
                <h2 class="section-title">Special Moments</h2>
                <p class="section-subtitle">Memorable events and achievements</p>
            </div>
            
            <div class="gallery-grid">
                <div class="gallery-item">
                    <img src="assets/old-principal-and-new-principal.jpg" alt="Principal Transition" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">Leadership Transition</h3>
                        <p class="gallery-description">Handover ceremony between outgoing and incoming principals.</p>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <img src="assets/staffs-meeting.jpg" alt="Staff Meeting" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">Staff Meeting</h3>
                        <p class="gallery-description">Regular staff meetings for continuous improvement.</p>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <img src="assets/administration-block.jpg" alt="Administration Block" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">Administration</h3>
                        <p class="gallery-description">School administration block housing management offices.</p>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <img src="assets/mama-baby-in-her-graduation.jpg" alt="Graduate with Baby" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">Proud Graduate</h3>
                        <p class="gallery-description">A proud graduate celebrating with her baby at graduation.</p>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <img src="assets/boys-in-graduation.jpg" alt="Boys Graduation" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">Male Graduates</h3>
                        <p class="gallery-description">Male students celebrating their graduation achievement.</p>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <img src="assets/girls-in-graduation-ceremony.jpg" alt="Girls Graduation" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">Female Graduates</h3>
                        <p class="gallery-description">Female students celebrating their successful graduation.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Academic Excellence Gallery -->
        <section class="gallery-section">
            <div class="section-header">
                <h2 class="section-title">Academic Excellence</h2>
                <p class="section-subtitle">Certificates and academic achievements</p>
            </div>
            
            <div class="gallery-grid">
                <div class="gallery-item">
                    <img src="assets/diploma-in-nursing-and-midwifery-extension-images-for-students.jpg" alt="Diploma Certificates" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">Diploma Certificates</h3>
                        <p class="gallery-description">Nursing and midwifery diploma certificates for graduates.</p>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <img src="assets/graduations-hero.jpg" alt="Graduation Hero" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">Graduation Highlights</h3>
                        <p class="gallery-description">Highlight moments from our graduation ceremonies.</p>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <img src="assets/hero.jpg" alt="School Hero" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">School Pride</h3>
                        <p class="gallery-description">Showcasing our school's excellence and achievements.</p>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <img src="assets/hero6.jpg" alt="Hero Image 6" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">Excellence Showcase</h3>
                        <p class="gallery-description">Demonstrating our commitment to healthcare education.</p>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <img src="assets/current-principal.jpg" alt="Current Principal" class="gallery-image">
                    <div class="gallery-content">
                        <h3 class="gallery-title">School Leadership</h3>
                        <p class="gallery-description">Current principal leading the school to greater heights.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-grid">
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="about.php"><i class="fas fa-angle-right"></i> About Us</a></li>
                        <li><a href="programs.php"><i class="fas fa-angle-right"></i> Programs</a></li>
                        <li><a href="application.php"><i class="fas fa-angle-right"></i> Application</a></li>
                        <li><a href="gallery.php"><i class="fas fa-angle-right"></i> Gallery</a></li>
                        <li><a href="contact.php"><i class="fas fa-angle-right"></i> Contact</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Academics</h3>
                    <ul class="footer-links">
                        <li><a href="programs.php"><i class="fas fa-angle-right"></i> Certificate Programs</a></li>
                        <li><a href="programs.php"><i class="fas fa-angle-right"></i> Diploma Programs</a></li>
                        <li><a href="achievements.php"><i class="fas fa-angle-right"></i> Achievements</a></li>
                        <li><a href="history.php"><i class="fas fa-angle-right"></i> Our History</a></li>
                        <li><a href="governance.php"><i class="fas fa-angle-right"></i> Governance</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Student Life</h3>
                    <ul class="footer-links">
                        <li><a href="activities.php"><i class="fas fa-angle-right"></i> Activities</a></li>
                        <li><a href="infrastructure.php"><i class="fas fa-angle-right"></i> Infrastructure</a></li>
                        <li><a href="gallery.php"><i class="fas fa-angle-right"></i> Gallery</a></li>
                        <li><a href="application.php"><i class="fas fa-angle-right"></i> Apply Now</a></li>
                        <li><a href="login-portal.php"><i class="fas fa-angle-right"></i> Student Portal</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Contact Info</h3>
                    <div class="contact-info">
                        <p><i class="fas fa-map-marker-alt"></i> Iganga, Uganda</p>
                        <p><i class="fas fa-phone"></i> +256 XXX XXX XXX</p>
                        <p><i class="fas fa-envelope"></i> info@isnm.ac.ug</p>
                        <p><i class="fas fa-clock"></i> Mon-Fri: 8:00 AM - 5:00 PM</p>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="footer-title">Iganga School of Nursing & Midwifery</div>
                <div class="footer-subtitle">Excellence in Healthcare Education Since 2012</div>
                <div class="footer-buttons">
                    <a href="https://wa.me/256XXXXXXXXXX" class="whatsapp-btn">
                        <i class="fab fa-whatsapp"></i>
                        Chat on WhatsApp
                    </a>
                </div>
                <div class="copyright">
                    <p>&copy; 2024 Iganga School of Nursing and Midwifery. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

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

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Add error handling for images
        document.querySelectorAll('img').forEach(img => {
            img.addEventListener('error', function() {
                this.style.display = 'none';
                console.warn('Image failed to load:', this.src);
            });
        });

        // Mobile menu toggle functionality
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const navLinks = document.getElementById('navLinks');
        
        if (mobileMenuBtn && navLinks) {
            mobileMenuBtn.addEventListener('click', function() {
                navLinks.classList.toggle('mobile-active');
            });
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            if (mobileMenuBtn && navLinks && 
                !navLinks.contains(event.target) && 
                !mobileMenuBtn.contains(event.target)) {
                navLinks.classList.remove('mobile-active');
            }
        });
    </script>
</body>
</html>
