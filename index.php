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
    <title>Iganga School of Nursing and Midwifery - Excellence in Healthcare Education</title>
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

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(180deg, #f3efe5 0%, #f7f5ef 45%, #fbfaf8 100%);
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
                radial-gradient(circle at 20% 50%, rgba(26, 26, 26, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(45, 45, 45, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 50% 20%, rgba(255, 215, 0, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 50% 80%, rgba(255, 248, 220, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 30% 70%, rgba(184, 134, 11, 0.06) 0%, transparent 50%);
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
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="medical-3d-pattern" width="40" height="40" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="3" fill="rgba(26,26,26,0.1)"/><path d="M10 20 Q20 10, 30 20 T50 20" stroke="rgba(45,45,45,0.15)" stroke-width="2" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23medical-3d-pattern)"/></svg>'),
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><defs><pattern id="medical-3d-grid" width="60" height="60" patternUnits="userSpaceOnUse"><rect x="15" y="15" width="30" height="30" fill="none" stroke="rgba(255,215,0,0.1)" stroke-width="2"/><circle cx="30" cy="30" r="8" fill="rgba(255,248,220,0.15)"/></pattern></defs><rect width="200" height="200" fill="url(%23medical-3d-grid)"/></svg>');
            background-size: 40px 40px, 120px 120px;
            animation: medical3DFloat 30s linear infinite;
            pointer-events: none;
            z-index: -1;
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

        /* Hero Section with Slider */
        .hero-section {
            min-height: calc(100vh - 60px);
            position: relative;
            overflow: hidden;
            margin-top: 0;
            transform-style: preserve-3d;
            perspective: 1000px;
            padding-top: 60px;
        }

        .hero-slider {
            position: relative;
            width: 100%;
            height: 100vh;
        }

        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            image-rendering: -webkit-optimize-contrast;
            image-rendering: crisp-edges;
            opacity: 0;
            transition: opacity 1s ease, transform 1s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            transform: scale(1.03);
        }

        .slide.active {
            opacity: 1;
            transform: scale(1) rotateX(0deg);
        }

        .slide::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(20, 22, 30, 0.15) 0%, rgba(10, 12, 18, 0.2) 100%);
        }

        .slide-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(26, 26, 26, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: none;
        }

        .slide-content {
            text-align: center;
            color: var(--white);
            z-index: 2;
            max-width: 800px;
            padding: 2rem;
            animation: slideInUp 1.2s ease-out;
            transform-style: preserve-3d;
            text-shadow: 0 3px 8px rgba(0, 0, 0, 0.5);
        }

        .slide-title {
            font-size: clamp(2.6rem, 5vw, 4rem);
            font-weight: 900;
            margin-bottom: 1rem;
            font-family: 'Playfair Display', serif;
            letter-spacing: -0.5px;
            line-height: 1.05;
            text-shadow: 0 4px 12px rgba(0, 0, 0, 0.6);
        }

        .slide-subtitle {
            font-size: clamp(1rem, 2.5vw, 1.4rem);
            margin-bottom: 1.75rem;
            font-weight: 400;
            line-height: 1.6;
            opacity: 0.95;
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.5);
        }

        .slide-btn {
            display: inline-block;
            padding: 1rem 2.5rem;
            background: var(--accent-gold);
            color: var(--primary-dark);
            text-decoration: none;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.05rem;
            transition: all 0.3s ease;
            border: 2px solid var(--accent-gold);
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .slide-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .slide-btn:hover {
            transform: translateY(-5px) scale(1.05);
            background: var(--white);
            color: var(--primary-dark);
            border-color: var(--white);
            box-shadow: 0 8px 30px rgba(255, 215, 0, 0.6);
        }

        .slide-btn:hover::before {
            left: 100%;
        }

        .slider-controls {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
            z-index: 10;
            padding: 0 1.5rem;
        }

        .slider-btn {
            background: rgba(255, 255, 255, 0.98);
            border: 1px solid rgba(200,200,200,0.8);
            width: 56px;
            height: 56px;
            border-radius: 50%;
            font-size: 1.6rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 14px 28px rgba(0,0,0,0.12);
            color: var(--primary-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
        }

        .slider-btn:hover {
            background: var(--accent-gold);
            transform: scale(1.04);
            box-shadow: 0 16px 32px rgba(0,0,0,0.16);
            color: var(--white);
        }

        .slider-dots {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 15px;
            z-index: 10;
        }

        .dot {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid var(--accent-gold);
            position: relative;
        }

        .dot::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 6px;
            height: 6px;
            background: var(--accent-gold);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .dot.active {
            background: var(--accent-gold);
            transform: scale(1.3);
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.5);
        }

        .dot.active::before {
            opacity: 1;
        }

        .dot:hover {
            transform: scale(1.2);
            background: rgba(255, 215, 0, 0.8);
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .hero-section {
                margin-top: 0;
                padding-top: 60px;
                min-height: 85vh;
            }

            .hero-slider {
                height: 85vh;
            }

            .slide-content {
                padding: 1rem;
            }

            .slide-title {
                font-size: 2.2rem;
                margin-bottom: 0.8rem;
            }

            .slide-subtitle {
                font-size: 1.1rem;
                margin-bottom: 1.5rem;
            }

            .slide-btn {
                padding: 0.8rem 2rem;
                font-size: 1rem;
            }

            .slider-controls {
                padding: 0 1rem;
            }

            .slider-btn {
                width: 50px;
                height: 50px;
                font-size: 1.5rem;
            }

            .slider-dots {
                bottom: 20px;
                gap: 10px;
            }

            .dot {
                width: 14px;
                height: 14px;
            }
        }

        @media (max-width: 480px) {
            .slide-title {
                font-size: 1.8rem;
            }

            .slide-subtitle {
                font-size: 1rem;
            }

            .slide-btn {
                padding: 0.7rem 1.5rem;
                font-size: 0.9rem;
            }

            .slider-btn {
                width: 45px;
                height: 45px;
                font-size: 1.2rem;
            }
        }

        /* Animations */
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1.2;
            color: var(--medical-white);
            margin-bottom: 1.5rem;
            font-family: 'Inter', sans-serif;
            transform-style: preserve-3d;
            transform: translateZ(20px);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero-subtitle {
            font-size: 1.1rem;
            color: var(--medical-white);
            margin-bottom: 1.5rem;
            line-height: 1.5;
            transform-style: preserve-3d;
            transform: translateZ(15px);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }

        .hero-buttons {
            display: flex;
            gap: 0.8rem;
            margin-top: 1.5rem;
            transform-style: preserve-3d;
            transform: translateZ(25px);
        }

        .hero-button {
            padding: 0.6rem 1.2rem;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
            transform-style: preserve-3d;
            transform: translateZ(0);
            position: relative;
            overflow: hidden;
        }

        .hero-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .hero-button.primary {
            background: var(--gradient-3d-primary);
            color: var(--medical-white);
            box-shadow: var(--shadow-3d-md);
        }

        .hero-button.secondary {
            background: var(--medical-white);
            color: var(--medical-primary);
            border: 1px solid var(--border-3d-light);
            box-shadow: var(--shadow-3d-sm);
        }

        .hero-button:hover {
            transform: translateY(-3px) translateZ(15px) rotateX(2deg);
            box-shadow: var(--shadow-3d-lg);
        }

        .hero-button:hover::before {
            opacity: 1;
        }

        .hero-button.primary:hover {
            border-color: var(--medical-accent);
        }

        .hero-button.secondary:hover {
            background: var(--gradient-3d-primary);
            color: var(--medical-white);
            border-color: var(--medical-primary);
        }

        .hero-visual {
            position: relative;
            animation: fadeInRight 1s ease-out;
        }

        .hero-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 3rem;
            box-shadow: var(--shadow-3d-xl);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
        }

        .hero-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-3d-primary);
        }

        .hero-card-icon {
            width: 80px;
            height: 80px;
            background: var(--gradient-3d-primary);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: var(--medical-white);
            margin-bottom: 2rem;
            animation: pulse 2s ease-in-out infinite;
            box-shadow: var(--shadow-3d-md);
            transform-style: preserve-3d;
            transform: translateZ(5px);
        }

        .hero-card-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--medical-primary);
            margin-bottom: 1rem;
            transform-style: preserve-3d;
            transform: translateZ(3px);
        }

        .hero-card-description {
            color: var(--medical-secondary);
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
            transform-style: preserve-3d;
            transform: translateZ(25px);
        }

        .hero-button {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
            transform-style: preserve-3d;
            transform: translateZ(0);
            position: relative;
            overflow: hidden;
        }

        .hero-button.primary {
            background: var(--gradient-3d-primary);
            color: var(--medical-white);
            box-shadow: var(--shadow-3d-md);
        }

        .hero-button.secondary {
            background: var(--medical-white);
            color: var(--medical-primary);
            border: 1px solid var(--border-3d-light);
            box-shadow: var(--shadow-3d-sm);
        }

        .hero-button:hover {
            transform: translateY(-3px) translateZ(15px) rotateX(2deg);
            box-shadow: var(--shadow-3d-lg);
        }

        .btn {
            padding: 1.8rem 3.5rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            border: none;
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-family: 'Copperplate Gothic Bold', 'Rockwell Extra Bold', serif;
            transform-style: preserve-3d;
            perspective: 1000px;
            margin: 0 0.5rem;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.6), transparent);
            transition: left 0.8s ease;
        }

        .btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.7) 0%, transparent 70%);
            transform: translate(-50%, -50%);
            transition: all 0.6s ease;
            border-radius: 50%;
        }

        .btn-primary {
            background: var(--gradient-3d-primary);
            color: var(--medical-white);
            box-shadow: var(--shadow-3d-xl);
            border: 3px solid rgba(255, 255, 255, 0.3);
            animation: medical3DFloat 5s ease-in-out infinite;
            transform: translateZ(25px);
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="medical-btn-pattern" width="25" height="25" patternUnits="userSpaceOnUse"><circle cx="12.5" cy="12.5" r="2" fill="rgba(15,76,117,0.2)"/><path d="M5 12.5 Q12.5 5, 20 12.5 T35 12.5" stroke="rgba(30,107,168,0.3)" stroke-width="1" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23medical-btn-pattern)"/></svg>');
            opacity: 0.3;
            pointer-events: none;
        }

        .btn-primary:hover {
            transform: translateY(-12px) translateZ(35px) rotateX(-8deg) rotateY(8deg);
            box-shadow: var(--shadow-3d-xl);
            background: var(--gradient-3d-luxury);
        }

        .btn-secondary {
            background: var(--gradient-3d-luxury);
            color: var(--medical-white);
            border: 3px solid var(--medical-accent);
            backdrop-filter: blur(25px);
            box-shadow: var(--shadow-3d-xl);
            animation: medical3DFloat 5s ease-in-out infinite 0.7s;
            transform: translateZ(25px);
            position: relative;
            overflow: hidden;
        }

        .btn-secondary::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="medical-btn-secondary-pattern" width="30" height="30" patternUnits="userSpaceOnUse"><circle cx="15" cy="15" r="3" fill="rgba(15,76,117,0.2)"/><path d="M5 15 Q15 5, 25 15 T45 15" stroke="rgba(30,107,168,0.3)" stroke-width="1.5" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23medical-btn-secondary-pattern)"/></svg>');
            opacity: 0.3;
            pointer-events: none;
        }

        .btn-secondary:hover {
            transform: translateY(-12px) translateZ(35px) rotateX(-8deg) rotateY(8deg);
            box-shadow: var(--shadow-3d-xl);
            background: var(--gradient-3d-primary);
            border-color: var(--medical-primary);
        }

        .btn-portal {
            background: var(--gradient-3d-luxury);
            color: var(--medical-white);
            box-shadow: var(--shadow-3d-xl);
            border: 3px solid var(--medical-accent);
            animation: medical3DFloat 5s ease-in-out infinite;
            transform: translateZ(25px);
            position: relative;
            overflow: hidden;
        }

        .btn-portal::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="medical-btn-portal-pattern" width="35" height="35" patternUnits="userSpaceOnUse"><rect x="10" y="10" width="15" height="15" fill="none" stroke="rgba(15,76,117,0.2)" stroke-width="2"/><circle cx="17.5" cy="17.5" r="4" fill="rgba(30,107,168,0.3)"/></pattern></defs><rect width="100" height="100" fill="url(%23medical-btn-portal-pattern)"/></svg>');
            opacity: 0.3;
            pointer-events: none;
        }

        .btn-portal:hover {
            transform: translateY(-12px) translateZ(35px) rotateX(-8deg) rotateY(8deg);
            box-shadow: var(--shadow-3d-xl);
            background: var(--gradient-3d-primary);
            color: var(--medical-white);
        }

        .btn-portal:hover::before {
            left: 100%;
        }

        .btn-portal:hover::after {
            width: 200%;
            height: 200%;
        }

        @keyframes luxuryBtnFloat {
            0%, 100% { 
                transform: translateY(0px) translateZ(20px) rotateX(0deg) rotateY(0deg); 
            }
            25% { 
                transform: translateY(-3px) translateZ(25px) rotateX(1deg) rotateY(1deg); 
            }
            50% { 
                transform: translateY(-6px) translateZ(30px) rotateX(0deg) rotateY(0deg); 
            }
            75% { 
                transform: translateY(-3px) translateZ(25px) rotateX(-1deg) rotateY(-1deg); 
            }
        }

        /* Showcase Section */
        .showcase-section {
            padding: 6rem 2rem;
            background: var(--gradient-3d-clean);
        }

        .showcase-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .showcase-card {
            background: var(--medical-white);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: var(--shadow-3d-md);
            border: 1px solid var(--border-3d-light);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            transform: translateZ(0);
        }

        .showcase-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-3d-primary);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .showcase-card:hover {
            transform: translateY(-8px) translateZ(15px) rotateX(2deg);
            box-shadow: var(--shadow-3d-lg);
        }

        .showcase-card:hover::before {
            transform: scaleX(1);
        }

        .showcase-icon {
            width: 70px;
            height: 70px;
            background: var(--gradient-3d-primary);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: var(--medical-white);
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow-3d-md);
            transform-style: preserve-3d;
            transform: translateZ(5px);
        }

        .showcase-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--medical-primary);
            margin-bottom: 1rem;
            transform-style: preserve-3d;
            transform: translateZ(3px);
        }

        .showcase-description {
            color: var(--medical-secondary);
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .showcase-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--medical-primary);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            transform-style: preserve-3d;
            transform: translateZ(0);
        }

        .showcase-link:hover {
            color: var(--medical-accent);
            transform: translateX(5px) translateZ(10px) rotateY(2deg);
        }

        /* Features Section */
        .features-section {
            padding: 6rem 2rem;
            background: var(--medical-white);
        }

        .section-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--gradient-secondary);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 1rem;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: var(--text-secondary);
            max-width: 600px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: var(--medical-white);
            border: 1px solid var(--border-3d-light);
            border-radius: 20px;
            padding: 2.5rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            transform: translateZ(0);
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--gradient-3d-primary);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            box-shadow: var(--shadow-3d-lg);
            transform: translateY(-8px) translateZ(15px) rotateX(2deg);
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: var(--gradient-3d-primary);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--medical-white);
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow-3d-md);
            transform-style: preserve-3d;
            transform: translateZ(5px);
        }

        .feature-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--medical-primary);
            margin-bottom: 1rem;
            transform-style: preserve-3d;
            transform: translateZ(3px);
        }

        .feature-description {
            color: var(--medical-secondary);
            line-height: 1.6;
        }

        /* Programs Section */
        .programs-section {
            padding: 6rem 2rem;
            background: var(--gradient-3d-clean);
        }

        .programs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .program-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            transition: all 0.3s ease;
            position: relative;
        }

        .program-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-2xl);
        }

        .program-header {
            background: var(--gradient-primary);
            padding: 2rem;
            text-align: center;
            color: white;
        }

        .program-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .program-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .program-duration {
            opacity: 0.9;
            font-size: 0.9rem;
        }

        .program-body {
            padding: 2rem;
        }

        .program-features {
            list-style: none;
            margin-bottom: 2rem;
        }

        .program-feature {
            padding: 0.5rem 0;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .program-feature::before {
            content: 'i';
            color: var(--health-green);
            font-weight: bold;
            font-style: normal;
        }

        .program-fee {
            background: var(--light-slate);
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            text-align: center;
        }

        .program-fee-label {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
        }

        .program-fee-amount {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--primary-blue);
        }

        /* Admission Section */
        .admission-section {
            padding: 6rem 2rem;
            background: var(--gradient-primary);
            color: white;
            position: relative;
            overflow: hidden;
        }

        .admission-background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0.1;
            background-image: 
                radial-gradient(circle at 20% 20%, rgba(255, 255, 255, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.3) 0%, transparent 50%);
        }

        .admission-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .admission-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .admission-subtitle {
            font-size: 1.3rem;
            opacity: 0.9;
            margin-bottom: 3rem;
        }

        .admission-requirements {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 3rem;
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .requirements-list {
            text-align: left;
            list-style: none;
        }

        .requirements-list li {
            padding: 1rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .requirements-list li:last-child {
            border-bottom: none;
        }

        .requirements-list li::before {
            content: 'i';
            color: white;
            font-weight: bold;
            font-style: normal;
            font-size: 1.2rem;
        }

        /* Footer */
        .footer {
            background: var(--text-primary);
            color: white;
            padding: 3rem 2rem 2rem;
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
            color: var(--neon-cyan);
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
            color: var(--neon-cyan);
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
            color: var(--neon-cyan);
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

        /* Modern Mind-Blowing Animations */
        @keyframes modernAurora {
            0%, 100% {
                transform: translateX(0) translateY(0) rotate(0deg);
                opacity: 0.4;
            }
            25% {
                transform: translateX(80px) translateY(-50px) rotate(90deg);
                opacity: 0.6;
            }
            50% {
                transform: translateX(-60px) translateY(80px) rotate(180deg);
                opacity: 0.8;
            }
            75% {
                transform: translateX(50px) translateY(-40px) rotate(270deg);
                opacity: 0.5;
            }
        }

        @keyframes modernParticleFloat {
            0%, 100% {
                transform: translateY(0) translateX(0) rotate(0deg);
                opacity: 0.7;
            }
            25% {
                transform: translateY(-50px) translateX(40px) rotate(90deg);
                opacity: 0.9;
            }
            50% {
                transform: translateY(-80px) translateX(-40px) rotate(180deg);
                opacity: 1;
            }
            75% {
                transform: translateY(-40px) translateX(50px) rotate(270deg);
                opacity: 0.8;
            }
        }

        @keyframes modernAuroraWave {
            0%, 100% {
                transform: translateX(0) translateY(0) scale(1);
                opacity: 0.3;
            }
            25% {
                transform: translateX(150px) translateY(-80px) scale(1.4);
                opacity: 0.5;
            }
            50% {
                transform: translateX(-150px) translateY(80px) scale(0.6);
                opacity: 0.7;
            }
            75% {
                transform: translateX(80px) translateY(-50px) scale(1.3);
                opacity: 0.4;
            }
        }

        @keyframes modernGridMove {
            0% {
                transform: translate(0, 0);
            }
            100% {
                transform: translate(150px, 150px);
            }
        }

        @keyframes modernPatternFloat {
            0% {
                transform: translate(0, 0);
            }
            100% {
                transform: translate(100px, 100px);
            }
        }

        @keyframes navbarShine {
            0%, 100% {
                transform: translateX(-100%);
            }
            50% {
                transform: translateX(100%);
            }
        }

        @keyframes logoGlow {
            0%, 100% {
                text-shadow: 0 0 30px rgba(139, 92, 246, 0.8);
                transform: scale(1);
            }
            50% {
                text-shadow: 0 0 50px rgba(139, 92, 246, 1), 0 0 70px rgba(59, 130, 246, 0.8);
                transform: scale(1.05);
            }
        }

        @keyframes logoRotate {
            0% {
                transform: rotateY(0deg);
            }
            100% {
                transform: rotateY(360deg);
            }
        }

        @keyframes modernBadgePulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 0 40px rgba(139, 92, 246, 0.6);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 0 60px rgba(139, 92, 246, 0.8);
            }
        }

        @keyframes modernBadgeShine {
            0%, 100% {
                transform: translateX(-100%);
            }
            50% {
                transform: translateX(100%);
            }
        }

        @keyframes modernTitleGlow {
            0%, 100% {
                filter: brightness(1) hue-rotate(0deg);
                transform: translateY(0);
            }
            25% {
                filter: brightness(1.2) hue-rotate(90deg);
                transform: translateY(-5px);
            }
            50% {
                filter: brightness(1.4) hue-rotate(180deg);
                transform: translateY(-10px);
            }
            75% {
                filter: brightness(1.2) hue-rotate(270deg);
                transform: translateY(-5px);
            }
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .navbar {
                padding: 0.5rem 0;
            }

            .nav-container {
                padding: 0 1rem;
            }

            .nav-logo {
                font-size: 1rem;
            }

            .nav-logo img {
                width: 40px;
                height: 40px;
            }

            .nav-links {
                gap: 0.3rem;
                justify-content: center;
            }

            .nav-link {
                font-size: 0.8rem;
                padding: 0.3rem 0.6rem;
            }

            .nav-link {
                padding: 0.4rem 0.8rem;
                font-size: 0.8rem;
            }

            .hero-section {
                min-height: 50vh;
                margin-top: 0;
                padding-top: 60px;
            }

            .hero-content {
                padding: 1rem;
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .hero-badge {
                font-size: 0.8rem;
                padding: 0.4rem 0.8rem;
                margin-bottom: 1rem;
            }

            .hero-title {
                font-size: 1.8rem;
                margin-bottom: 1rem;
            }

            .hero-subtitle {
                font-size: 0.95rem;
                margin-bottom: 1rem;
            }

            .hero-buttons {
                gap: 0.5rem;
                margin-top: 1rem;
            }

            .hero-button {
                padding: 0.6rem 1rem;
                font-size: 0.85rem;
            }
        }

        @media (max-width: 480px) {
            .nav-links {
                display: none;
            }

            .hero-title {
                font-size: 1.5rem;
            }

            .hero-subtitle {
                font-size: 0.9rem;
            }

            .hero-button {
                padding: 0.5rem 0.8rem;
                font-size: 0.8rem;
            }

            .hero-buttons {
                flex-direction: column;
                gap: 0.5rem;
            }
        }

        @keyframes logoGlow {
            0%, 100% {
                text-shadow: 0 0 20px rgba(0, 255, 255, 0.8);
                transform: scale(1);
            }
            50% {
                text-shadow: 0 0 40px rgba(0, 255, 255, 1), 0 0 60px rgba(251, 191, 36, 0.8);
                transform: scale(1.05);
            }
        }

        @keyframes logoPulse {
            0%, 100% {
                opacity: 0.3;
                transform: scale(1);
            }
            50% {
                opacity: 0.6;
                transform: scale(1.1);
            }
        }

        @keyframes title3DFloat {
            0%, 100% {
                transform: translateY(0) rotateX(0deg) rotateY(0deg);
            }
            25% {
                transform: translateY(-10px) rotateX(2deg) rotateY(2deg);
            }
            50% {
                transform: translateY(-20px) rotateX(0deg) rotateY(0deg);
            }
            75% {
                transform: translateY(-10px) rotateX(-2deg) rotateY(-2deg);
            }
        }

        @keyframes badgePulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 0 20px rgba(0, 255, 255, 0.6);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 0 40px rgba(0, 255, 255, 0.9);
            }
        }

        @keyframes badgeShine {
            0%, 100% {
                left: -100%;
            }
            50% {
                left: 100%;
            }
        }

        @keyframes btnPulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 0 30px rgba(0, 255, 255, 0.8);
            }
            50% {
                transform: scale(1.02);
                box-shadow: 0 0 50px rgba(0, 255, 255, 1);
            }
        }

        @keyframes loginBtnGlow {
            0%, 100% {
                box-shadow: 0 0 30px rgba(251, 191, 36, 0.8), 0 0 60px rgba(134, 239, 172, 0.6);
            }
            50% {
                box-shadow: 0 0 50px rgba(251, 191, 36, 1), 0 0 100px rgba(134, 239, 172, 0.8);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.1);
                opacity: 0.8;
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Cinema-Like Medical 3D Animations */

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

        @keyframes hero3DAurora {
            0%, 100% {
                transform: rotate(0deg) scale(1) translateZ(0);
                opacity: 0.9;
            }
            33% {
                transform: rotate(120deg) scale(1.05) translateZ(10px);
                opacity: 0.7;
            }
            66% {
                transform: rotate(240deg) scale(1.1) translateZ(20px);
                opacity: 0.5;
            }
        }

        @keyframes hero3DFloat {
            0% {
                transform: translateX(0) translateY(0) translateZ(0) rotate(0deg);
            }
            25% {
                transform: translateX(15px) translateY(-8px) translateZ(5px) rotate(1deg);
            }
            50% {
                transform: translateX(30px) translateY(0) translateZ(10px) rotate(2deg);
            }
            75% {
                transform: translateX(15px) translateY(8px) translateZ(5px) rotate(1deg);
            }
            100% {
                transform: translateX(0) translateY(0) translateZ(0) rotate(0deg);
            }
        }

        /* Professional Header Section */
        .header-section {
            position: relative;
            z-index: 1001;
        }

        /* Navigation Logo Text Styling */
        .nav-logo-text {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            transform-style: preserve-3d;
            transform: translateZ(2px);
            background: linear-gradient(135deg, var(--medical-primary), var(--medical-accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-logo-text span:first-child {
            margin-bottom: 0.2rem;
            text-shadow: 0 3px 6px rgba(15, 76, 117, 0.25);
            letter-spacing: 1px;
        }

        .nav-logo-text span:last-child {
            font-weight: 400;
            text-shadow: 0 2px 4px rgba(15, 76, 117, 0.2);
            font-size: 0.8rem;
            opacity: 0.95;
        }

        /* Perfect Mobile Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                padding: 1rem 0;
            }

            .nav-container {
                padding: 0 1.5rem;
                flex-wrap: wrap;
                gap: 2rem;
            }

            .nav-logo {
                font-size: 1.3rem;
                gap: 1rem;
            }

            .nav-logo img {
                width: 50px;
                height: 50px;
            }

            .nav-links {
                display: flex;
                gap: 0.5rem;
                flex-wrap: wrap;
                justify-content: center;
                width: 100%;
                margin-top: 1rem;
            }

            .nav-link {
                font-size: 0.85rem;
                padding: 0.6rem 1rem;
                border-radius: 12px;
                letter-spacing: 0.5px;
            }

            .hero-content {
                grid-template-columns: 1fr;
                gap: 2rem;
                padding: 2rem 1rem;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-badge {
                font-size: 0.9rem;
                padding: 0.8rem 1.5rem;
            }

            .hero-stats {
                gap: 2rem;
            }

            .hero-card {
                padding: 2rem;
            }

            .showcase-grid,
            .features-grid,
            .programs-grid {
                grid-template-columns: 1fr;
            }

            .section-title {
                font-size: 2rem;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .footer-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                padding: 1.5rem 2.5rem;
                font-size: 1rem;
            }
        }

        @media (max-width: 1024px) {
            .nav-links {
                flex-wrap: wrap;
                gap: 0.6rem;
                justify-content: center;
            }

            .nav-link {
                font-size: 0.85rem;
                padding: 0.35rem 0.7rem;
            }
            
            .nav-link {
                font-size: 0.9rem;
                padding: 0.6rem 1rem;
            }

            .hero-content {
                gap: 3rem;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
            }

            .btn {
                padding: 1.2rem 2rem;
                font-size: 0.9rem;
            }

            .hero-stats {
                flex-direction: column;
                gap: 1rem;
            }
        }

        @media (max-width: 768px) {
            .hero-slider {
                height: 70vh;
            }

            .slide-title {
                font-size: 2.5rem;
            }

            .slide-subtitle {
                font-size: 1.2rem;
            }

            .slider-controls {
                display: none;
            }

            .nav-links {
                display: none;
            }

            .navbar {
                padding: 1rem 0;
            }

            .nav-logo {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 480px) {
            .slide-title {
                font-size: 2rem;
            }

            .slide-subtitle {
                font-size: 1rem;
            }

            .slide-btn {
                padding: 0.8rem 1.5rem;
                font-size: 0.9rem;
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
                <a href="#" class="nav-logo">
                    <img src="assets/school-logo.png" alt="ISNM Logo" style="width: 75px; height: 75px;">
                    <div class="nav-logo-text">
                         </div>
                </a>
                <div class="nav-links">
                    <a href="#home" class="nav-link">Home</a>
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

    <!-- Hero Section with Slider -->
    <section class="hero-section" id="home">
        <div class="hero-slider">
            <div class="slide active" style="background-image: url('assets/hero1-students-in-group-picture-in-skills-lab.jpeg');">
                <div class="slide-overlay">
                    <div class="slide-content">
                        <h1 class="slide-title">WELCOME TO IGANGA SCHOOL OF NURSING AND MIDWIFERY</h1>
                        <p class="slide-subtitle">Excellence in Healthcare Education</p>
                        <a href="programs.php" class="slide-btn">Explore Programs</a>
                    </div>
                </div>
            </div>
            <div class="slide" style="background-image: url('assets/hero2-students-in-skills-lab.jpeg');">
                <div class="slide-overlay">
                    <div class="slide-content">
                        <h1 class="slide-title">State-of-the-Art Skills Lab</h1>
                        <p class="slide-subtitle">Hands-on training for future nurses</p>
                        <a href="infrastructure.php" class="slide-btn">View Facilities</a>
                    </div>
                </div>
            </div>
            <div class="slide" style="background-image: url('assets/hero3-student-girls-nurses.jpeg');">
                <div class="slide-overlay">
                    <div class="slide-content">
                        <h1 class="slide-title">Empowering Future Nurses</h1>
                        <p class="slide-subtitle">Comprehensive nursing education</p>
                        <a href="application.php" class="slide-btn">Apply Now</a>
                    </div>
                </div>
            </div>
            <div class="slide" style="background-image: url('assets/hero4-students-in-skills-lab.jpeg');">
                <div class="slide-overlay">
                    <div class="slide-content">
                        <h1 class="slide-title">Practical Training</h1>
                        <p class="slide-subtitle">Real-world healthcare experience</p>
                        <a href="activities.php" class="slide-btn">Our Activities</a>
                    </div>
                </div>
            </div>
            <div class="slide" style="background-image: url('assets/hero5-students-bandaging-their-fellow.jpeg');">
                <div class="slide-overlay">
                    <div class="slide-content">
                        <h1 class="slide-title">Clinical Excellence</h1>
                        <p class="slide-subtitle">Mastering essential nursing skills</p>
                        <a href="about.php" class="slide-btn">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="slide" style="background-image: url('assets/hero6-.jpeg');">
                <div class="slide-overlay">
                    <div class="slide-content">
                        <h1 class="slide-title">Holistic Healthcare Education</h1>
                        <p class="slide-subtitle">Nurturing compassionate caregivers</p>
                        <a href="contact.php" class="slide-btn">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="slider-controls">
            <button class="slider-btn prev" onclick="prevSlide()">&#10094;</button>
            <button class="slider-btn next" onclick="nextSlide()">&#10095;</button>
        </div>
        <div class="slider-dots">
            <span class="dot active" onclick="currentSlide(0)"></span>
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
            <span class="dot" onclick="currentSlide(4)"></span>
            <span class="dot" onclick="currentSlide(5)"></span>
        </div>
    </section>

    <!-- School Showcase Section -->
    <section class="showcase-section">
        <div class="decorative-circle" style="top: 10%; left: 10%;"></div>
        <div class="decorative-square" style="top: 20%; right: 15%;"></div>
        <div class="decorative-triangle" style="bottom: 15%; left: 20%;"></div>
        <div class="section-container">
            <div class="section-header">
                <div class="section-badge bounce-in">
                    <i class="fas fa-star spin"></i>
                    <span>Discover ISNM</span>
                </div>
                <h2 class="section-title slide-up">Why Choose Iganga School of Nursing & Midwifery</h2>
                <p class="section-subtitle slide-up">
                    Experience excellence in healthcare education with our comprehensive programs, 
                    modern facilities, and commitment to student success.
                </p>
            </div>
            <div class="showcase-grid">
                <div class="showcase-card rotate-in">
                    <div class="showcase-icon pulse">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3 class="showcase-title">Academic Excellence</h3>
                    <p class="showcase-description">
                        World-class education with 100% pass rate in midwifery and 85% in nursing programs
                    </p>
                    <a href="programs.php" class="showcase-link">
                        <i class="fas fa-arrow-right"></i>
                        Explore Programs
                    </a>
                </div>
                
                <div class="showcase-card rotate-in">
                    <div class="showcase-icon float">
                        <i class="fas fa-building"></i>
                    </div>
                    <h3 class="showcase-title">Modern Infrastructure</h3>
                    <p class="showcase-description">
                        State-of-the-art facilities including computer labs, skills laboratories, and multi-purpose hall
                    </p>
                    <a href="infrastructure.php" class="showcase-link">
                        <i class="fas fa-arrow-right"></i>
                        View Facilities
                    </a>
                </div>
                
                <div class="showcase-card">
                    <div class="showcase-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h3 class="showcase-title">Proven Excellence</h3>
                    <p class="showcase-description">
                        15+ years of excellence with over 5000 graduates and 95% employment rate
                    </p>
                    <a href="achievements.php" class="showcase-link">
                        <i class="fas fa-arrow-right"></i>
                        Our Achievements
                    </a>
                </div>
                
                <div class="showcase-card">
                    <div class="showcase-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="showcase-title">Strong Governance</h3>
                    <p class="showcase-description">
                        Led by experienced Board of Directors and Governors with a vision for excellence
                    </p>
                    <a href="governance.php" class="showcase-link">
                        <i class="fas fa-arrow-right"></i>
                        Meet Our Leaders
                    </a>
                </div>
                
                <div class="showcase-card">
                    <div class="showcase-icon">
                        <i class="fas fa-running"></i>
                    </div>
                    <h3 class="showcase-title">Vibrant Campus Life</h3>
                    <p class="showcase-description">
                        Rich co-curricular activities, sports, and community service opportunities
                    </p>
                    <a href="activities.php" class="showcase-link">
                        <i class="fas fa-arrow-right"></i>
                        Campus Activities
                    </a>
                </div>
                
                <div class="showcase-card">
                    <div class="showcase-icon">
                        <i class="fas fa-history"></i>
                    </div>
                    <h3 class="showcase-title">Rich Heritage</h3>
                    <p class="showcase-description">
                        Founded in 2009 with a legacy of producing world-class healthcare professionals
                    </p>
                    <a href="history.php" class="showcase-link">
                        <i class="fas fa-arrow-right"></i>
                        Our History
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="section-container">
            <div class="section-header">
                <div class="section-badge">
                    <i class="fas fa-star"></i>
                    <span>Why Choose ISNM</span>
                </div>
                <h2 class="section-title">Excellence in Healthcare Education</h2>
                <p class="section-subtitle">
                    We provide comprehensive training, modern facilities, and experienced faculty 
                    to ensure your success in the healthcare industry.
                </p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h3 class="feature-title">Expert Faculty</h3>
                    <p class="feature-description">
                        Learn from experienced healthcare professionals and educators 
                        dedicated to your success and professional growth.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-hospital"></i>
                    </div>
                    <h3 class="feature-title">Clinical Training</h3>
                    <p class="feature-description">
                        Gain hands-on experience through partnerships with leading hospitals 
                        and healthcare facilities in the region.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h3 class="feature-title">Recognized Certification</h3>
                    <p class="feature-description">
                        Earn nationally and internationally recognized qualifications 
                        that open doors to global career opportunities.
                    </p>
                </div>
            </div>
        </div>
    </section>

    
    
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
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]:not([href="#"])').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const hash = this.getAttribute('href');
                if (!hash || hash === '#') return;

                let target = null;
                try {
                    target = document.querySelector(hash);
                } catch (error) {
                    console.warn('Invalid anchor hash:', hash, error);
                }

                if (target instanceof Element) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Intersection Observer for animations
        if ('IntersectionObserver' in window) {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animation = 'fadeInUp 0.8s ease-out';
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            // Observe feature cards and program cards
            document.querySelectorAll('.feature-card, .program-card').forEach(card => {
                observer.observe(card);
            });
        }

        // Slider functionality
        let currentSlideIndex = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.dot');

        function showSlide(index) {
            if (!slides.length || !dots.length) return;
            const slide = slides[index];
            const dot = dots[index];
            if (!slide || !dot) return;

            slides.forEach(slideItem => slideItem.classList.remove('active'));
            dots.forEach(dotItem => dotItem.classList.remove('active'));
            slide.classList.add('active');
            dot.classList.add('active');
            currentSlideIndex = index;
        }

        function nextSlide() {
            if (!slides.length) return;
            currentSlideIndex = (currentSlideIndex + 1) % slides.length;
            showSlide(currentSlideIndex);
        }

        function prevSlide() {
            if (!slides.length) return;
            currentSlideIndex = (currentSlideIndex - 1 + slides.length) % slides.length;
            showSlide(currentSlideIndex);
        }

        function currentSlide(index) {
            showSlide(index);
        }

        // Auto slide
        if (slides.length && dots.length) {
            setInterval(nextSlide, 5000);
            showSlide(0);
        }

        // Parallax effect for hero section
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const heroBackground = document.querySelector('.hero-background');
            const heroParticles = document.querySelector('.hero-particles');
            
            if (heroBackground && heroParticles) {
                heroBackground.style.transform = `translateY(${scrolled * 0.5}px)`;
                heroParticles.style.transform = `translateY(${scrolled * 0.3}px)`;
            }
        });
    </script>
</body>
</html>


