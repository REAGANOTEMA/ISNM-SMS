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
            /* Dark Blue Professional Color Palette */
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
            
            /* Professional Gradients */
            --gradient-hero: linear-gradient(135deg, var(--primary-dark) 0%, var(--secondary-dark) 50%, var(--accent-blue) 100%);
            --gradient-primary: linear-gradient(135deg, var(--accent-dark-blue) 0%, var(--accent-blue) 100%);
            --gradient-secondary: linear-gradient(135deg, var(--accent-blue) 0%, var(--accent-cyan) 100%);
            --gradient-luxury: linear-gradient(135deg, var(--accent-light-blue) 0%, var(--accent-cyan) 100%);
            --gradient-clean: linear-gradient(135deg, var(--gray-light) 0%, var(--white) 100%);
            --gradient-3d-primary: linear-gradient(135deg, var(--medical-blue), var(--medical-cyan));
            --gradient-3d-luxury: linear-gradient(135deg, var(--accent-light-blue), var(--accent-cyan));
            
            /* Professional Shadows */
            --shadow-sm: 0 2px 4px rgba(10, 22, 40, 0.1);
            --shadow-md: 0 4px 8px rgba(10, 22, 40, 0.15);
            --shadow-lg: 0 8px 16px rgba(10, 22, 40, 0.2);
            --shadow-xl: 0 20px 40px rgba(10, 22, 40, 0.25);
            --shadow-3d-sm: 0 4px 8px rgba(37, 99, 235, 0.3);
            --shadow-3d-md: 0 8px 16px rgba(37, 99, 235, 0.4);
            --shadow-3d-lg: 0 12px 24px rgba(37, 99, 235, 0.5);
            --shadow-3d-xl: 0 20px 40px rgba(37, 99, 235, 0.6);
            
            /* Professional Borders */
            --border-light: var(--gray-medium);
            --border-medium: var(--gray-dark);
            --border-dark: var(--primary-dark);
            --border-3d-light: var(--gray-medium);
            
            /* Medical Theme Colors */
            --medical-white: #ffffff;
            --medical-primary: var(--text-primary);
            --medical-secondary: var(--text-secondary);
            --medical-accent: var(--accent-blue);
            --health-green: #10b981;
            --light-slate: #f1f5f9;
            --primary-blue: var(--accent-blue);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(180deg, var(--gray-light) 0%, var(--white) 45%, var(--gray-light) 100%);
            color: var(--text-primary);
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
                radial-gradient(circle at 20% 50%, rgba(10, 22, 40, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(30, 58, 95, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 50% 20%, rgba(37, 99, 235, 0.06) 0%, transparent 50%),
                radial-gradient(circle at 50% 80%, rgba(6, 182, 212, 0.06) 0%, transparent 50%),
                radial-gradient(circle at 30% 70%, rgba(30, 64, 175, 0.04) 0%, transparent 50%);
            animation: medicalAurora 20s ease-in-out infinite;
            pointer-events: none;
            z-index: -1;
        }

        /* Premium Floating Particles */
        .particles-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-cyan), var(--accent-light-blue));
            border-radius: 50%;
            pointer-events: none;
            opacity: 0;
            animation: particleFloat 15s infinite ease-in-out;
            box-shadow: 0 0 20px rgba(37, 99, 235, 0.6);
        }

        .particle:nth-child(1) { width: 4px; height: 4px; left: 10%; animation-delay: 0s; animation-duration: 12s; }
        .particle:nth-child(2) { width: 6px; height: 6px; left: 20%; animation-delay: 2s; animation-duration: 15s; }
        .particle:nth-child(3) { width: 3px; height: 3px; left: 30%; animation-delay: 4s; animation-duration: 10s; }
        .particle:nth-child(4) { width: 5px; height: 5px; left: 40%; animation-delay: 1s; animation-duration: 18s; }
        .particle:nth-child(5) { width: 7px; height: 7px; left: 50%; animation-delay: 3s; animation-duration: 14s; }
        .particle:nth-child(6) { width: 4px; height: 4px; left: 60%; animation-delay: 5s; animation-duration: 16s; }
        .particle:nth-child(7) { width: 6px; height: 6px; left: 70%; animation-delay: 2s; animation-duration: 13s; }
        .particle:nth-child(8) { width: 3px; height: 3px; left: 80%; animation-delay: 6s; animation-duration: 11s; }
        .particle:nth-child(9) { width: 5px; height: 5px; left: 90%; animation-delay: 4s; animation-duration: 17s; }

        /* Advanced 3D Floating Elements */
        .floating-element {
            position: absolute;
            pointer-events: none;
            opacity: 0.3;
            animation: float3D 20s infinite ease-in-out;
            transform-style: preserve-3d;
        }

        .floating-cube {
            width: 30px;
            height: 30px;
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-cyan));
            transform-style: preserve-3d;
            animation: rotateCube 10s infinite linear;
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.4);
        }

        .floating-sphere {
            width: 40px;
            height: 40px;
            background: radial-gradient(circle at 30% 30%, var(--accent-light-blue), var(--accent-blue));
            border-radius: 50%;
            animation: floatSphere 15s infinite ease-in-out;
            box-shadow: 0 15px 35px rgba(6, 182, 212, 0.5);
        }

        .floating-pyramid {
            width: 0;
            height: 0;
            border-left: 20px solid transparent;
            border-right: 20px solid transparent;
            border-bottom: 35px solid var(--accent-dark-blue);
            animation: rotatePyramid 12s infinite linear;
            filter: drop-shadow(0 10px 25px rgba(30, 64, 175, 0.6));
        }

        .morphing-shape {
            position: absolute;
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, var(--accent-blue), var(--accent-cyan), var(--accent-light-blue));
            animation: morphShape 8s infinite ease-in-out;
            opacity: 0.2;
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            box-shadow: 0 20px 40px rgba(37, 99, 235, 0.3);
        }

        /* Medical Cross Particles */
        .medical-particle {
            position: absolute;
            width: 20px;
            height: 20px;
            opacity: 0.1;
            animation: medicalCrossFloat 25s infinite ease-in-out;
        }

        .medical-particle::before {
            content: '+';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: var(--accent-blue);
            font-size: 16px;
            font-weight: bold;
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

        /* Premium 3D Navigation with Dark Blue Theme */
        .navbar {
            position: fixed;
            top: 40px;
            left: 0;
            right: 0;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(20px);
            border-bottom: 2px solid rgba(37, 99, 235, 0.3);
            z-index: 1001;
            padding: 0.75rem 0;
            box-shadow: 
                0 14px 34px rgba(10, 22, 40, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            height: auto;
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
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="nav-pattern" width="30" height="30" patternUnits="userSpaceOnUse"><rect x="10" y="10" width="10" height="10" fill="none" stroke="rgba(37,99,235,0.1)" stroke-width="2"/><circle cx="15" cy="15" r="3" fill="rgba(6,182,212,0.15)"/></pattern></defs><rect width="100" height="100" fill="url(%23nav-pattern)"/></svg>'),
                linear-gradient(135deg, rgba(37, 99, 235, 0.02), rgba(6, 182, 212, 0.02));
            opacity: 0.08;
            pointer-events: none;
            animation: navPatternFloat 30s linear infinite;
        }

        .brand-banner {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--accent-dark-blue) 50%, var(--accent-blue) 100%);
            border-bottom: 2px solid var(--accent-blue);
            z-index: 1002;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            box-shadow: 0 16px 40px rgba(10, 22, 40, 0.15);
            transform-style: preserve-3d;
            perspective: 1000px;
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
            text-shadow: 0 2px 4px rgba(10, 22, 40, 0.3);
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
                0 18px 50px rgba(10, 22, 40, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
            border-bottom-color: var(--accent-blue);
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
            color: var(--text-primary);
            text-decoration: none;
            font-family: 'Copperplate Gothic Bold', 'Rockwell Extra Bold', serif;
            transform-style: preserve-3d;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
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
            width: 55px;
            height: 55px;
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
            transform: translateY(-3px) rotateX(-2deg) rotateY(2deg);
        }

        .nav-logo:hover img {
            transform: scale(1.05) rotateX(-1deg) rotateY(1deg);
            box-shadow: 0 16px 36px rgba(10, 22, 40, 0.25);
            border-color: var(--accent-blue);
        }

        .nav-logo:hover img::after {
            opacity: 0;
        }

        .nav-links {
            display: flex;
            gap: 0.3rem;
            align-items: center;
            transform-style: preserve-3d;
            position: relative;
            z-index: 2;
            flex-wrap: nowrap;
            justify-content: center;
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            background: #000000;
            border: 2px solid #000000;
            color: #FFFFFF;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .mobile-menu-toggle:hover {
            background: #333333;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .mobile-menu-toggle span {
            display: block;
            width: 25px;
            height: 3px;
            background: #FFFFFF;
            margin: 5px 0;
            transition: all 0.3s ease;
            border-radius: 2px;
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
            transform: translateY(-2px) translateZ(10px) rotateX(-2deg);
            box-shadow: 0 8px 20px rgba(10, 22, 40, 0.3);
        }

        .mobile-menu-toggle.active::before {
            transform: translate(-50%, -50%) rotate(45deg);
        }

        .mobile-menu-toggle.active::after {
            transform: translate(-50%, -50%) rotate(-45deg);
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
            color: #000000;
        }

        .nav-dropdown:hover .nav-dropdown-toggle::after {
            transform: rotate(180deg);
            color: #FFFFFF;
        }

        .nav-dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            background: rgba(255, 255, 255, 0.98);
            border: 2px solid #000000;
            border-radius: 8px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            min-width: 180px;
            z-index: 1000;
            backdrop-filter: blur(10px);
        }

        .nav-dropdown:hover .nav-dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) translateZ(10px);
        }

        .nav-dropdown-menu a {
            display: block;
            padding: 0.8rem 1rem;
            color: #000000;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .nav-dropdown-menu a:hover {
            background: #000000;
            color: #FFFFFF;
            transform: translateX(5px);
        }

        .nav-dropdown-menu a:first-child {
            border-radius: 10px 10px 0 0;
        }

        .nav-dropdown-menu a:last-child {
            border-radius: 0 0 10px 10px;
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
            transition: opacity 1.5s cubic-bezier(0.4, 0, 0.2, 1), transform 1.5s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            transform: scale(1.05) rotateX(2deg);
        }

        .slide.active {
            opacity: 1;
            transform: scale(1) rotateX(0deg) translateZ(0);
        }

        .slide::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 50%, rgba(10, 22, 40, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(30, 58, 95, 0.1) 0%, transparent 50%),
                linear-gradient(45deg, rgba(20, 22, 30, 0.05) 0%, rgba(10, 12, 18, 0.1) 100%);
            animation: heroOverlayPulse 8s ease-in-out infinite;
        }

        .slide-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 50% 50%, rgba(37, 99, 235, 0.03) 0%, transparent 70%),
                rgba(26, 26, 26, 0.02);
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(0.5px);
            animation: heroOverlayFloat 15s ease-in-out infinite;
        }

        .slide-content {
            text-align: center;
            color: var(--white);
            z-index: 2;
            max-width: 800px;
            padding: 2rem;
            animation: slideInUp 1.2s ease-out, heroContentGlow 4s ease-in-out infinite;
            transform-style: preserve-3d;
            text-shadow: 
                0 4px 12px rgba(0, 0, 0, 0.8),
                0 0 20px rgba(37, 99, 235, 0.2);
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(5px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.5),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
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
            background: rgba(255, 215, 0, 0.9);
            backdrop-filter: blur(10px);
            color: var(--primary-dark);
            text-decoration: none;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.05rem;
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 215, 0, 0.8);
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            box-shadow: 
                0 6px 20px rgba(255, 215, 0, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
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
            transform: translateY(-8px) translateZ(10px) rotateX(-2deg) rotateY(2deg) scale(1.05);
            background: rgba(255, 255, 255, 0.95);
            color: var(--primary-dark);
            border-color: rgba(255, 255, 255, 0.9);
            box-shadow: 
                0 8px 30px rgba(255, 215, 0, 0.6),
                0 0 40px rgba(255, 215, 0, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.5);
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
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            width: 56px;
            height: 56px;
            border-radius: 50%;
            font-size: 1.6rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 
                0 14px 28px rgba(0,0,0,0.12),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            color: var(--primary-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            transform-style: preserve-3d;
            transform: translateZ(0);
        }

        .slider-btn:hover {
            background: rgba(255, 215, 0, 0.9);
            transform: translateZ(15px) rotateX(-2deg) rotateY(2deg) scale(1.1);
            box-shadow: 
                0 16px 32px rgba(0,0,0,0.16),
                0 0 30px rgba(255, 215, 0, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.4);
            color: var(--primary-dark);
            border-color: rgba(255, 215, 0, 0.8);
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

            /* Mobile Menu */
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
                background: rgba(255, 255, 255, 0.98);
                flex-direction: column;
                gap: 0;
                padding: 1rem;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
                border-top: 3px solid #000000;
                z-index: 999;
                transform: translateY(-100%);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                backdrop-filter: blur(10px);
            }

            .nav-links.active {
                display: flex;
                transform: translateY(0);
            }

            .nav-links .nav-link {
                width: 100%;
                padding: 1.2rem;
                border-radius: 0;
                border-bottom: 2px solid rgba(0, 0, 0, 0.1);
                text-align: center;
                font-size: 1.1rem;
                color: #000000;
                background: rgba(255, 255, 255, 0.9);
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                border-left: 4px solid transparent;
                border-right: 4px solid transparent;
                transition: all 0.3s ease;
            }

            .nav-links .nav-link:hover {
                background: #000000;
                color: #FFFFFF;
                border-left-color: #000000;
                border-right-color: #000000;
                transform: translateX(0);
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
                min-width: 100%;
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
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 
                var(--shadow-3d-md),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            transform: translateZ(0);
            cursor: pointer;
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
            transition: transform 0.4s ease;
        }

        .showcase-card::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 215, 0, 0.1) 0%, transparent 70%);
            opacity: 0;
            transition: all 0.4s ease;
            pointer-events: none;
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
            transform: translateY(-12px) translateZ(25px) rotateX(3deg) rotateY(2deg);
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 
                var(--shadow-3d-xl),
                0 0 50px rgba(37, 99, 235, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.4);
            border-color: rgba(37, 99, 235, 0.4);
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
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.15);
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
            background: rgba(255, 255, 255, 0.12);
            box-shadow: 
                var(--shadow-3d-lg),
                0 0 40px rgba(37, 99, 235, 0.2);
            transform: translateY(-10px) translateZ(20px) rotateX(2deg) rotateY(1deg);
            border-color: rgba(37, 99, 235, 0.3);
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

        /* Premium Footer */
        .footer {
            background: linear-gradient(135deg, 
                var(--primary-dark) 0%, 
                var(--secondary-dark) 25%, 
                var(--accent-gold) 50%, 
                var(--dark-accent) 75%, 
                var(--primary-dark) 100%);
            color: white;
            padding: 4rem 2rem 2rem;
            position: relative;
            overflow: hidden;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, 
                var(--accent-gold) 0%, 
                var(--creamy-yellow) 25%, 
                var(--white) 50%, 
                var(--creamy-yellow) 75%, 
                var(--accent-gold) 100%);
            animation: footerShine 3s ease-in-out infinite;
        }

        .footer::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 20%, rgba(255, 215, 0, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 248, 220, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 50% 50%, rgba(184, 134, 11, 0.05) 0%, transparent 50%);
            pointer-events: none;
            animation: footerAurora 15s ease-in-out infinite;
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
            font-size: 1.4rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            color: var(--accent-gold);
            text-shadow: 0 2px 4px rgba(255, 215, 0, 0.3);
            transform-style: preserve-3d;
            transform: translateZ(10px);
            position: relative;
        }

        .footer-section h3::before {
            content: '';
            position: absolute;
            top: -5px;
            left: -10px;
            right: -10px;
            bottom: -5px;
            background: linear-gradient(135deg, var(--accent-gold), var(--creamy-yellow));
            border-radius: 8px;
            opacity: 0.1;
            z-index: -1;
            animation: footerTitleGlow 3s ease-in-out infinite;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            position: relative;
            transform-style: preserve-3d;
            transform: translateZ(0);
        }

        .footer-links a::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, var(--accent-gold), var(--creamy-yellow));
            border-radius: 8px;
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: -1;
        }

        .footer-links a:hover {
            color: var(--primary-dark);
            transform: translateX(8px) translateZ(15px) rotateY(5deg);
            box-shadow: 0 8px 25px rgba(255, 215, 0, 0.4);
        }

        .footer-links a:hover::before {
            opacity: 1;
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
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 215, 0, 0.2);
            border-radius: 50%;
            padding: 4px;
            animation: contactIconPulse 2s ease-in-out infinite;
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
            gap: 0.8rem;
            background: linear-gradient(135deg, #25d366 0%, #128c7e 100%);
            color: white;
            padding: 1.2rem 2.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            transform: translateZ(0);
            box-shadow: 0 8px 25px rgba(37, 211, 102, 0.4);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .whatsapp-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s ease;
        }

        .whatsapp-btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.8) 0%, transparent 70%);
            transform: translate(-50%, -50%);
            transition: all 0.6s ease;
            border-radius: 50%;
        }

        .whatsapp-btn:hover {
            background: linear-gradient(135deg, #128c7e 0%, #25d366 100%);
            transform: translateY(-8px) translateZ(20px) rotateX(-5deg) rotateY(5deg);
            box-shadow: 0 15px 40px rgba(37, 211, 102, 0.6);
            border-color: rgba(255, 255, 255, 0.6);
        }

        .whatsapp-btn:hover::before {
            left: 100%;
        }

        .whatsapp-btn:hover::after {
            width: 300%;
            height: 300%;
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

        @keyframes particleFloat {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }

        @keyframes medicalCrossFloat {
            0%, 100% {
                transform: translate(0, 0) rotate(0deg);
                opacity: 0.1;
            }
            25% {
                transform: translate(30px, -20px) rotate(90deg);
                opacity: 0.3;
            }
            50% {
                transform: translate(-20px, -40px) rotate(180deg);
                opacity: 0.2;
            }
            75% {
                transform: translate(-40px, -20px) rotate(270deg);
                opacity: 0.3;
            }
        }

        @keyframes footerShine {
            0%, 100% {
                transform: translateX(-100%);
            }
            50% {
                transform: translateX(100%);
            }
        }

        @keyframes footerAurora {
            0%, 100% {
                transform: rotate(0deg) scale(1);
                opacity: 0.8;
            }
            33% {
                transform: rotate(120deg) scale(1.1);
                opacity: 0.6;
            }
            66% {
                transform: rotate(240deg) scale(1.2);
                opacity: 0.4;
            }
        }

        @keyframes footerTitleGlow {
            0%, 100% {
                box-shadow: 0 0 20px rgba(255, 215, 0, 0.6);
                transform: scale(1);
            }
            50% {
                box-shadow: 0 0 40px rgba(255, 215, 0, 0.9);
                transform: scale(1.05);
            }
        }

        @keyframes contactIconPulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 0 15px rgba(255, 215, 0, 0.6);
            }
            50% {
                transform: scale(1.1);
                box-shadow: 0 0 25px rgba(255, 215, 0, 0.9);
            }
        }

        @keyframes showcaseGlow {
            0%, 100% {
                box-shadow: 0 0 30px rgba(255, 215, 0, 0.4);
                transform: scale(1);
            }
            50% {
                box-shadow: 0 0 50px rgba(255, 215, 0, 0.7);
                transform: scale(1.02);
            }
        }

        @keyframes featurePulse {
            0%, 100% {
                box-shadow: 0 0 25px rgba(255, 215, 0, 0.3);
                transform: scale(1);
            }
            50% {
                box-shadow: 0 0 40px rgba(255, 215, 0, 0.6);
                transform: scale(1.05);
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

        /* Advanced 3D Animations */
        @keyframes float3D {
            0%, 100% {
                transform: translateY(0) translateX(0) translateZ(0) rotateX(0deg) rotateY(0deg);
            }
            25% {
                transform: translateY(-30px) translateX(20px) translateZ(50px) rotateX(5deg) rotateY(10deg);
            }
            50% {
                transform: translateY(-60px) translateX(40px) translateZ(100px) rotateX(10deg) rotateY(20deg);
            }
            75% {
                transform: translateY(-30px) translateX(20px) translateZ(50px) rotateX(5deg) rotateY(10deg);
            }
        }

        @keyframes rotateCube {
            0% {
                transform: rotateX(0deg) rotateY(0deg) rotateZ(0deg);
            }
            100% {
                transform: rotateX(360deg) rotateY(360deg) rotateZ(360deg);
            }
        }

        @keyframes floatSphere {
            0%, 100% {
                transform: translateY(0) translateX(0) scale(1);
                box-shadow: 0 15px 35px rgba(6, 182, 212, 0.5);
            }
            25% {
                transform: translateY(-40px) translateX(30px) scale(1.1);
                box-shadow: 0 25px 50px rgba(6, 182, 212, 0.7);
            }
            50% {
                transform: translateY(-80px) translateX(60px) scale(1.2);
                box-shadow: 0 35px 65px rgba(6, 182, 212, 0.9);
            }
            75% {
                transform: translateY(-40px) translateX(30px) scale(1.1);
                box-shadow: 0 25px 50px rgba(6, 182, 212, 0.7);
            }
        }

        @keyframes rotatePyramid {
            0% {
                transform: rotateY(0deg) rotateX(0deg);
            }
            100% {
                transform: rotateY(360deg) rotateX(360deg);
            }
        }

        @keyframes morphShape {
            0%, 100% {
                border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
                transform: rotate(0deg) scale(1);
            }
            25% {
                border-radius: 70% 30% 30% 70% / 70% 70% 30% 30%;
                transform: rotate(90deg) scale(1.1);
            }
            50% {
                border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
                transform: rotate(180deg) scale(1.2);
            }
            75% {
                border-radius: 70% 30% 30% 70% / 70% 70% 30% 30%;
                transform: rotate(270deg) scale(1.1);
            }
        }

        @keyframes heroOverlayPulse {
            0%, 100% {
                opacity: 0.8;
                transform: scale(1);
            }
            50% {
                opacity: 1;
                transform: scale(1.05);
            }
        }

        @keyframes heroOverlayFloat {
            0%, 100% {
                transform: translateY(0) translateX(0);
            }
            25% {
                transform: translateY(-10px) translateX(20px);
            }
            50% {
                transform: translateY(-20px) translateX(40px);
            }
            75% {
                transform: translateY(-10px) translateX(20px);
            }
        }

        @keyframes heroContentGlow {
            0%, 100% {
                box-shadow: 
                    0 20px 40px rgba(0, 0, 0, 0.3),
                    inset 0 1px 0 rgba(255, 255, 255, 0.2),
                    0 0 30px rgba(37, 99, 235, 0.2);
            }
            50% {
                box-shadow: 
                    0 25px 50px rgba(0, 0, 0, 0.4),
                    inset 0 1px 0 rgba(255, 255, 255, 0.3),
                    0 0 50px rgba(37, 99, 235, 0.4);
            }
        }
        
        /* Footer 3D Animations */
        @keyframes footerRotateCube {
            0% {
                transform: rotateX(0deg) rotateY(0deg) rotateZ(0deg);
            }
            100% {
                transform: rotateX(360deg) rotateY(360deg) rotateZ(360deg);
            }
        }
        
        @keyframes footerFloatSphere {
            0%, 100% {
                transform: translateY(0) translateX(0) scale(1);
            }
            25% {
                transform: translateY(-20px) translateX(15px) scale(1.1);
            }
            50% {
                transform: translateY(-40px) translateX(30px) scale(1.2);
            }
            75% {
                transform: translateY(-20px) translateX(15px) scale(1.1);
            }
        }
        
        @keyframes footerRotatePyramid {
            0% {
                transform: rotateY(0deg) rotateX(0deg);
            }
            100% {
                transform: rotateY(360deg) rotateX(360deg);
            }
        }
        
        @keyframes footerMorphShape {
            0%, 100% {
                border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
                transform: rotate(0deg) scale(1);
            }
            25% {
                border-radius: 70% 30% 30% 70% / 70% 70% 30% 30%;
                transform: rotate(90deg) scale(1.1);
            }
            50% {
                border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
                transform: rotate(180deg) scale(1.2);
            }
            75% {
                border-radius: 70% 30% 30% 70% / 70% 70% 30% 30%;
                transform: rotate(270deg) scale(1.1);
            }
        }
        
        @keyframes footerStripeFloat {
            0%, 100% {
                transform: translateX(0) translateY(0);
            }
            25% {
                transform: translateX(10px) translateY(-5px);
            }
            50% {
                transform: translateX(20px) translateY(-10px);
            }
            75% {
                transform: translateX(10px) translateY(-5px);
            }
        }
        
        @keyframes footerShine {
            0%, 100% {
                transform: translateX(-100%);
            }
            50% {
                transform: translateX(100%);
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

        /* Premium Gallery Section Styles */
        .premium-gallery-section {
            padding: 6rem 2rem;
            background: linear-gradient(135deg, var(--gray-light) 0%, var(--white) 50%, var(--gray-light) 100%);
            position: relative;
            overflow: hidden;
        }

        .premium-gallery-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 20%, rgba(37, 99, 235, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(6, 182, 212, 0.03) 0%, transparent 50%),
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="gallery-bg-pattern" width="40" height="40" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="2" fill="rgba(37, 99, 235, 0.08)"/><path d="M10 20 Q20 10, 30 20 T50 20" stroke="rgba(6, 182, 212, 0.06)" stroke-width="1" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23gallery-bg-pattern)"/></svg>');
            background-size: cover, cover, 80px 80px;
            background-position: center, center, 0 0;
            animation: galleryFloat 40s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes galleryFloat {
            0%, 100% { transform: translateX(0) translateY(0) rotate(0deg); }
            25% { transform: translateX(15px) translateY(-8px) rotate(0.5deg); }
            50% { transform: translateX(30px) translateY(0) rotate(0deg); }
            75% { transform: translateX(15px) translateY(8px) rotate(-0.5deg); }
        }

        .premium-gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            grid-auto-rows: 250px;
            gap: 1.5rem;
            position: relative;
            z-index: 2;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            transform-style: preserve-3d;
            transform: translateZ(0);
            background: var(--white);
        }

        .gallery-item-large {
            grid-column: span 2;
            grid-row: span 2;
        }

        .gallery-item-wide {
            grid-column: span 2;
        }

        .gallery-image-wrapper {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
            border-radius: 20px;
        }

        .gallery-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            transform: scale(1);
            filter: brightness(1) contrast(1) saturate(1);
        }

        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(
                to bottom,
                transparent 0%,
                transparent 40%,
                rgba(10, 22, 40, 0.7) 70%,
                rgba(10, 22, 40, 0.9) 100%
            );
            display: flex;
            align-items: flex-end;
            padding: 2rem;
            opacity: 0;
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            transform: translateY(20px);
        }

        .gallery-content {
            color: var(--white);
            transform: translateZ(10px);
        }

        .gallery-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .gallery-description {
            font-size: 1rem;
            line-height: 1.5;
            margin-bottom: 1rem;
            opacity: 0.9;
        }

        .gallery-badges {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .gallery-badge {
            background: var(--gradient-primary);
            color: var(--white);
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        /* Gallery Hover Effects */
        .gallery-item:hover {
            transform: translateY(-15px) translateZ(30px) rotateX(3deg) rotateY(-2deg);
            box-shadow: 
                var(--shadow-xl),
                0 0 50px rgba(37, 99, 235, 0.3),
                0 0 100px rgba(6, 182, 212, 0.2);
        }

        .gallery-item:hover .gallery-image {
            transform: scale(1.1) rotateX(2deg) rotateY(-2deg);
            filter: brightness(1.1) contrast(1.05) saturate(1.1);
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
            transform: translateY(0);
            background: linear-gradient(
                to bottom,
                transparent 0%,
                transparent 30%,
                rgba(10, 22, 40, 0.6) 60%,
                rgba(10, 22, 40, 0.8) 100%
            );
        }

        /* Gallery Item Animations */
        .gallery-item:nth-child(1) { animation: gallerySlideIn 0.8s ease-out 0.1s both; }
        .gallery-item:nth-child(2) { animation: gallerySlideIn 0.8s ease-out 0.2s both; }
        .gallery-item:nth-child(3) { animation: gallerySlideIn 0.8s ease-out 0.3s both; }
        .gallery-item:nth-child(4) { animation: gallerySlideIn 0.8s ease-out 0.4s both; }
        .gallery-item:nth-child(5) { animation: gallerySlideIn 0.8s ease-out 0.5s both; }
        .gallery-item:nth-child(6) { animation: gallerySlideIn 0.8s ease-out 0.6s both; }
        .gallery-item:nth-child(7) { animation: gallerySlideIn 0.8s ease-out 0.7s both; }
        .gallery-item:nth-child(8) { animation: gallerySlideIn 0.8s ease-out 0.8s both; }
        .gallery-item:nth-child(9) { animation: gallerySlideIn 0.8s ease-out 0.9s both; }
        .gallery-item:nth-child(10) { animation: gallerySlideIn 0.8s ease-out 1.0s both; }

        @keyframes gallerySlideIn {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.9);
                filter: blur(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
                filter: blur(0);
            }
        }

        /* Responsive Gallery */
        @media (max-width: 1024px) {
            .premium-gallery-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                grid-auto-rows: 200px;
                gap: 1rem;
            }

            .gallery-item-large {
                grid-column: span 1;
                grid-row: span 1;
            }

            .gallery-item-wide {
                grid-column: span 1;
            }

            .gallery-title {
                font-size: 1.2rem;
            }

            .gallery-description {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 768px) {
            .premium-gallery-section {
                padding: 4rem 1rem;
            }

            .premium-gallery-grid {
                grid-template-columns: 1fr;
                grid-auto-rows: 250px;
                gap: 1rem;
            }

            .gallery-item-large,
            .gallery-item-wide {
                grid-column: span 1;
                grid-row: span 1;
            }

            .gallery-overlay {
                padding: 1.5rem;
            }

            .gallery-title {
                font-size: 1.3rem;
            }

            .gallery-description {
                font-size: 0.95rem;
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
    <!-- Premium Floating Particles -->
    <div class="particles-container">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="medical-particle" style="top: 15%; left: 10%;"></div>
        <div class="medical-particle" style="top: 25%; left: 85%;"></div>
        <div class="medical-particle" style="top: 65%; left: 20%;"></div>
        <div class="medical-particle" style="top: 75%; left: 75%;"></div>
        
        <!-- Advanced 3D Floating Elements -->
        <div class="floating-element floating-cube" style="top: 20%; left: 15%;"></div>
        <div class="floating-element floating-sphere" style="top: 60%; left: 80%;"></div>
        <div class="floating-element floating-pyramid" style="top: 40%; left: 70%;"></div>
        <div class="floating-element floating-cube" style="top: 80%; left: 25%; animation-delay: 2s;"></div>
        <div class="floating-element floating-sphere" style="top: 30%; left: 50%; animation-delay: 1s;"></div>
        <div class="floating-element floating-pyramid" style="top: 70%; left: 40%; animation-delay: 3s;"></div>
        
        <!-- Morphing Shapes -->
        <div class="morphing-shape" style="top: 10%; left: 60%; animation-delay: 0s;"></div>
        <div class="morphing-shape" style="top: 50%; left: 20%; animation-delay: 2s;"></div>
        <div class="morphing-shape" style="top: 80%; left: 70%; animation-delay: 4s;"></div>
    </div>

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
                    <a href="organogram.php" class="nav-link">Portal</a>
                </div>
            </div>
        </nav>
    </div>

    <!-- Hero Section with Slider -->
    <section class="hero-section" id="home">
        <div class="hero-slider">
            <div class="slide active" style="background-image: url('assets/images/hero/hero1-students-in-group-picture-in-skills-lab.jpeg');">
                <div class="slide-overlay">
                    <div class="slide-content">
                        <h1 class="slide-title">WELCOME TO IGANGA SCHOOL OF NURSING AND MIDWIFERY</h1>
                        <p class="slide-subtitle">Excellence in Healthcare Education</p>
                        <a href="programs.php" class="slide-btn">Explore Programs</a>
                    </div>
                </div>
            </div>
            <div class="slide" style="background-image: url('assets/images/hero/hero2-students-in-skills-lab.jpeg');">
                <div class="slide-overlay">
                    <div class="slide-content">
                        <h1 class="slide-title">State-of-the-Art Skills Lab</h1>
                        <p class="slide-subtitle">Hands-on training for future nurses</p>
                        <a href="infrastructure.php" class="slide-btn">View Facilities</a>
                    </div>
                </div>
            </div>
            <div class="slide" style="background-image: url('assets/images/hero/hero3-student-girls-nurses.jpeg');">
                <div class="slide-overlay">
                    <div class="slide-content">
                        <h1 class="slide-title">Empowering Future Nurses</h1>
                        <p class="slide-subtitle">Comprehensive nursing education</p>
                        <a href="application.php" class="slide-btn">Apply Now</a>
                    </div>
                </div>
            </div>
            <div class="slide" style="background-image: url('assets/images/academic/students-in-skill-laboratory-in-practical-training.jpg');">
                <div class="slide-overlay">
                    <div class="slide-content">
                        <h1 class="slide-title">Advanced Practical Training</h1>
                        <p class="slide-subtitle">Master cutting-edge healthcare skills in our modern skills laboratory</p>
                        <a href="activities.php" class="slide-btn">Explore Training</a>
                    </div>
                </div>
            </div>
            <div class="slide" style="background-image: url('assets/images/academic/certificate-in-nursing-students-in-examamination-room.jpg');">
                <div class="slide-overlay">
                    <div class="slide-content">
                        <h1 class="slide-title">Academic Excellence</h1>
                        <p class="slide-subtitle">Rigorous assessment ensuring professional competency and excellence</p>
                        <a href="programs.php" class="slide-btn">View Programs</a>
                    </div>
                </div>
            </div>
            <div class="slide" style="background-image: url('assets/images/hero/hero6.jpg');">
                <div class="slide-overlay">
                    <div class="slide-content">
                        <h1 class="slide-title">Professional Healthcare Training</h1>
                        <p class="slide-subtitle">Preparing compassionate healthcare providers for global service</p>
                        <a href="about.php" class="slide-btn">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="slide" style="background-image: url('assets/images/hero/hero-graduations.jpg');">
                <div class="slide-overlay">
                    <div class="slide-content">
                        <h1 class="slide-title">Celebrating Success</h1>
                        <p class="slide-subtitle">Honoring outstanding achievements in nursing and midwifery</p>
                        <a href="achievements.php" class="slide-btn">Our Achievements</a>
                    </div>
                </div>
            </div>
            <div class="slide" style="background-image: url('assets/images/hero/graduations-hero.jpg');">
                <div class="slide-overlay">
                    <div class="slide-content">
                        <h1 class="slide-title">Graduation Excellence</h1>
                        <p class="slide-subtitle">Recognizing our accomplished healthcare professionals</p>
                        <a href="achievements.php" class="slide-btn">View Success Stories</a>
                    </div>
                </div>
            </div>
            <div class="slide" style="background-image: url('assets/images/hero/students-sitting-in-the-graduation-use-it-in-hero-and-pages.jpg');">
                <div class="slide-overlay">
                    <div class="slide-content">
                        <h1 class="slide-title">Academic Achievement</h1>
                        <p class="slide-subtitle">Excellence in nursing and midwifery education since 2009</p>
                        <a href="history.php" class="slide-btn">Our Legacy</a>
                    </div>
                </div>
            </div>
            <div class="slide" style="background-image: url('assets/images/facilities/classroom-building.jpg');">
                <div class="slide-overlay">
                    <div class="slide-content">
                        <h1 class="slide-title">Modern Learning Facilities</h1>
                        <p class="slide-subtitle">State-of-the-art classrooms equipped for optimal learning</p>
                        <a href="infrastructure.php" class="slide-btn">Explore Campus</a>
                    </div>
                </div>
            </div>
            <div class="slide" style="background-image: url('assets/images/facilities/administration-block.jpg');">
                <div class="slide-overlay">
                    <div class="slide-content">
                        <h1 class="slide-title">Administrative Excellence</h1>
                        <p class="slide-subtitle">Professional management ensuring institutional success</p>
                        <a href="governance.php" class="slide-btn">Meet Leadership</a>
                    </div>
                </div>
            </div>
            <div class="slide" style="background-image: url('assets/images/hero/students-standing-upstairs-of-their-classroom-in-breaktime.jpg');">
                <div class="slide-overlay">
                    <div class="slide-content">
                        <h1 class="slide-title">Vibrant Student Life</h1>
                        <p class="slide-subtitle">Dynamic campus community fostering growth and friendship</p>
                        <a href="activities.php" class="slide-btn">Student Activities</a>
                    </div>
                </div>
            </div>
            <div class="slide" style="background-image: url('assets/images/hero/students-in-class.jpg');">
                <div class="slide-overlay">
                    <div class="slide-content">
                        <h1 class="slide-title">Interactive Learning</h1>
                        <p class="slide-subtitle">Engaging classroom experiences with expert faculty</p>
                        <a href="programs.php" class="slide-btn">Academic Programs</a>
                    </div>
                </div>
            </div>
            <div class="slide" style="background-image: url('assets/images/hero/hero6-.jpeg');">
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

    <!-- Premium Image Gallery Section -->
    <section class="premium-gallery-section">
        <div class="section-container">
            <div class="section-header">
                <div class="section-badge">
                    <i class="fas fa-images"></i>
                    <span>Campus Showcase</span>
                </div>
                <h2 class="section-title">Experience Our World-Class Facilities</h2>
                <p class="section-subtitle">
                    Explore our modern campus infrastructure, state-of-the-art laboratories, 
                    and vibrant learning environments designed for excellence.
                </p>
            </div>
            
            <div class="premium-gallery-grid">
                <div class="gallery-item gallery-item-large">
                    <div class="gallery-image-wrapper">
                        <img src="assets/images/hero/graduations-hero.jpg" alt="ISNM Graduation Ceremony - Academic Excellence" class="gallery-image">
                        <div class="gallery-overlay">
                            <div class="gallery-content">
                                <h3 class="gallery-title">Graduation Excellence</h3>
                                <p class="gallery-description">Celebrating academic achievement and professional success</p>
                                <div class="gallery-badges">
                                    <span class="gallery-badge">Achievement</span>
                                    <span class="gallery-badge">Success</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <div class="gallery-image-wrapper">
                        <img src="assets/images/academic/students-in-skill-laboratory-in-practical-training.jpg" alt="ISNM Skills Laboratory - Practical Training" class="gallery-image">
                        <div class="gallery-overlay">
                            <div class="gallery-content">
                                <h3 class="gallery-title">Skills Laboratory</h3>
                                <p class="gallery-description">Advanced practical training facilities</p>
                                <div class="gallery-badges">
                                    <span class="gallery-badge">Training</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <div class="gallery-image-wrapper">
                        <img src="assets/images/facilities/administration-block.jpg" alt="ISNM Administration Block - Professional Management" class="gallery-image">
                        <div class="gallery-overlay">
                            <div class="gallery-content">
                                <h3 class="gallery-title">Administration Block</h3>
                                <p class="gallery-description">Professional management hub</p>
                                <div class="gallery-badges">
                                    <span class="gallery-badge">Management</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <div class="gallery-image-wrapper">
                        <img src="assets/images/facilities/classroom-building.jpg" alt="ISNM Modern Classrooms - Learning Environment" class="gallery-image">
                        <div class="gallery-overlay">
                            <div class="gallery-content">
                                <h3 class="gallery-title">Modern Classrooms</h3>
                                <p class="gallery-description">State-of-the-art learning spaces</p>
                                <div class="gallery-badges">
                                    <span class="gallery-badge">Learning</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="gallery-item gallery-item-wide">
                    <div class="gallery-image-wrapper">
                        <img src="assets/images/hero/students-in-class.jpg" alt="ISNM Interactive Learning - Student Engagement" class="gallery-image">
                        <div class="gallery-overlay">
                            <div class="gallery-content">
                                <h3 class="gallery-title">Interactive Learning</h3>
                                <p class="gallery-description">Engaging classroom experiences with expert faculty</p>
                                <div class="gallery-badges">
                                    <span class="gallery-badge">Education</span>
                                    <span class="gallery-badge">Excellence</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <div class="gallery-image-wrapper">
                        <img src="assets/images/facilities/diploma-hostel.jpg" alt="ISNM Diploma Hostel - Student Accommodation" class="gallery-image">
                        <div class="gallery-overlay">
                            <div class="gallery-content">
                                <h3 class="gallery-title">Diploma Hostel</h3>
                                <p class="gallery-description">Comfortable student accommodation</p>
                                <div class="gallery-badges">
                                    <span class="gallery-badge">Housing</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <div class="gallery-image-wrapper">
                        <img src="assets/images/facilities/girls-hostel.jpg" alt="ISNM Girls Hostel - Safe Living Environment" class="gallery-image">
                        <div class="gallery-overlay">
                            <div class="gallery-content">
                                <h3 class="gallery-title">Girls Hostel</h3>
                                <p class="gallery-description">Safe and comfortable living spaces</p>
                                <div class="gallery-badges">
                                    <span class="gallery-badge">Safety</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <div class="gallery-image-wrapper">
                        <img src="assets/images/facilities/school-kitchen.jpg" alt="ISNM School Kitchen - Nutrition Services" class="gallery-image">
                        <div class="gallery-overlay">
                            <div class="gallery-content">
                                <h3 class="gallery-title">School Kitchen</h3>
                                <p class="gallery-description">Nutritious meal preparation facilities</p>
                                <div class="gallery-badges">
                                    <span class="gallery-badge">Nutrition</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="gallery-item gallery-item-large">
                    <div class="gallery-image-wrapper">
                        <img src="assets/images/achievements/graduation-ceremony.jpg" alt="ISNM Graduation Ceremony - Student Success" class="gallery-image">
                        <div class="gallery-overlay">
                            <div class="gallery-content">
                                <h3 class="gallery-title">Graduation Ceremony</h3>
                                <p class="gallery-description">Celebrating student success and professional achievement</p>
                                <div class="gallery-badges">
                                    <span class="gallery-badge">Success</span>
                                    <span class="gallery-badge">Excellence</span>
                                </div>
                            </div>
                        </div>
                    </div>
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

    
    
    <!-- Enhanced 3D Footer -->
    <footer class="footer" id="contact">
        <!-- Decorative 3D Elements -->
        <div class="footer-3d-elements">
            <div class="footer-cube"></div>
            <div class="footer-sphere"></div>
            <div class="footer-pyramid"></div>
            <div class="footer-morph"></div>
        </div>
        
        <!-- Striped Background Pattern -->
        <div class="footer-stripes"></div>
        
        <!-- Main Footer Content -->
        <div class="footer-content">
            <div class="footer-grid">
                <div class="footer-section">
                    <div class="footer-card">
                        <div class="footer-icon-wrapper">
                            <i class="fas fa-link"></i>
                        </div>
                        <h3 class="footer-title">Quick Links</h3>
                        <ul class="footer-links">
                            <li><a href="about.php"><i class="fas fa-chevron-right"></i> About ISNM</a></li>
                            <li><a href="governance.php"><i class="fas fa-chevron-right"></i> Governance</a></li>
                            <li><a href="programs.php"><i class="fas fa-chevron-right"></i> Academic Programs</a></li>
                            <li><a href="activities.php"><i class="fas fa-chevron-right"></i> School Activities</a></li>
                            <li><a href="infrastructure.php"><i class="fas fa-chevron-right"></i> Infrastructure</a></li>
                            <li><a href="achievements.php"><i class="fas fa-chevron-right"></i> Achievements</a></li>
                            <li><a href="history.php"><i class="fas fa-chevron-right"></i> School History</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="footer-section">
                    <div class="footer-card">
                        <div class="footer-icon-wrapper">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3 class="footer-title">Application</h3>
                        <ul class="footer-links">
                            <li><a href="application.php"><i class="fas fa-chevron-right"></i> Apply Now</a></li>
                            <li><a href="programs.php"><i class="fas fa-chevron-right"></i> Program Requirements</a></li>
                            <li><a href="programs.php"><i class="fas fa-chevron-right"></i> Fee Structure</a></li>
                            <li><a href="organogram.php"><i class="fas fa-chevron-right"></i> Student Portal</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="footer-section">
                    <div class="footer-card">
                        <div class="footer-icon-wrapper">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <h3 class="footer-title">Contact Info</h3>
                        <div class="contact-info">
                            <p><i class="fas fa-map-marker-alt"></i> <span>Iganga, Uganda</span></p>
                            <p><i class="fas fa-phone"></i> <span>+256 782633253</span></p>
                            <p><i class="fas fa-phone"></i> <span>+256 703999796</span></p>
                            <p><i class="fas fa-phone"></i> <span>+256 753393340</span></p>
                            <p><i class="fas fa-envelope"></i> <span>info@isnm.ug.edu</span></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Enhanced Footer Bottom -->
            <div class="footer-bottom">
                <div class="footer-bottom-card">
                    <div class="developer-section">
                        <div class="footer-icon-wrapper">
                            <i class="fas fa-code"></i>
                        </div>
                        <h3 class="footer-title">Designed and Developed by Reagan Otema</h3>
                        <p class="footer-subtitle">For system errors, contact via WhatsApp</p>
                    </div>
                    
                    <div class="footer-buttons">
                        <a href="https://wa.me/256772514889" target="_blank" class="whatsapp-btn">
                            <i class="fab fa-whatsapp"></i>
                            <span>MTN: +256772514889</span>
                        </a>
                        <a href="https://wa.me/256730314979" target="_blank" class="whatsapp-btn">
                            <i class="fab fa-whatsapp"></i>
                            <span>Airtel: +256730314979</span>
                        </a>
                    </div>
                    
                    <div class="copyright">
                        <p>&copy; 2026 Iganga School of Nursing and Midwifery. All rights reserved.</p>
                    </div>
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

        // Enhanced Intersection Observer for premium animations
        if ('IntersectionObserver' in window) {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -100px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        const element = entry.target;
                        const delay = index * 0.1;
                        
                        // Add staggered animation based on element type
                        if (element.classList.contains('showcase-card')) {
                            element.style.animation = `slideInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) ${delay}s, showcaseGlow 2s ease-in-out infinite ${delay + 0.5}s`;
                        } else if (element.classList.contains('feature-card')) {
                            element.style.animation = `slideInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) ${delay}s, featurePulse 3s ease-in-out infinite ${delay + 1}s`;
                        } else if (element.classList.contains('program-card')) {
                            element.style.animation = `slideInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) ${delay}s`;
                        } else {
                            element.style.animation = `slideInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) ${delay}s`;
                        }
                        
                        observer.unobserve(element);
                    }
                });
            }, observerOptions);

            // Observe all animated elements
            document.querySelectorAll('.showcase-card, .feature-card, .program-card, .section-header').forEach(element => {
                observer.observe(element);
            });
        }

        // Advanced scroll-based parallax and animations
        let lastScrollY = 0;
        let scrollVelocity = 0;
        
        function handleScroll() {
            const scrollY = window.pageYOffset;
            const windowHeight = window.innerHeight;
            const documentHeight = document.documentElement.scrollHeight;
            const scrollPercent = (scrollY / (documentHeight - windowHeight)) * 100;
            
            // Calculate scroll velocity
            scrollVelocity = Math.abs(scrollY - lastScrollY);
            lastScrollY = scrollY;
            
            // Parallax effects for hero section
            const heroSection = document.querySelector('.hero-section');
            if (heroSection) {
                const heroOpacity = Math.max(0, 1 - (scrollY / windowHeight));
                heroSection.style.transform = `translateY(${scrollY * 0.5}px) scale(${1 - scrollY * 0.0005})`;
                heroSection.style.opacity = heroOpacity;
            }
            
            // Floating elements parallax
            const floatingElements = document.querySelectorAll('.floating-element, .morphing-shape');
            floatingElements.forEach((element, index) => {
                const speed = 0.2 + (index * 0.05);
                const yPos = -(scrollY * speed);
                const rotation = scrollY * 0.1;
                element.style.transform = `translateY(${yPos}px) rotate(${rotation}deg) translateZ(${index * 10}px)`;
            });
            
            // Particles parallax
            const particles = document.querySelectorAll('.particle, .medical-particle');
            particles.forEach((particle, index) => {
                const speed = 0.1 + (index * 0.02);
                const yPos = -(scrollY * speed);
                particle.style.transform = `translateY(${yPos}px) translateZ(${index * 5}px)`;
            });
            
            // Navigation scroll effects
            const navbar = document.querySelector('.navbar');
            if (navbar) {
                if (scrollY > 100) {
                    navbar.style.background = 'rgba(255, 255, 255, 0.95)';
                    navbar.style.backdropFilter = 'blur(25px)';
                } else {
                    navbar.style.background = 'rgba(255,255,255,0.1)';
                    navbar.style.backdropFilter = 'blur(20px)';
                }
            }
            
            // Dynamic gradient background based on scroll
            const body = document.body;
            if (body) {
                const hue = 200 + (scrollPercent * 0.5);
                const saturation = 50 + (scrollPercent * 0.2);
                body.style.background = `linear-gradient(180deg, hsl(${hue}, ${saturation}%, 95%) 0%, hsl(${hue}, ${saturation}%, 98%) 45%, hsl(${hue}, ${saturation}%, 95%) 100%)`;
            }
        }
        
        // Throttled scroll handler
        let ticking = false;
        function requestTick() {
            if (!ticking) {
                window.requestAnimationFrame(handleScroll);
                ticking = true;
                setTimeout(() => ticking = false, 16);
            }
        }
        
        window.addEventListener('scroll', requestTick);
        
        // Loading animation
        function createLoadingAnimation() {
            const loader = document.createElement('div');
            loader.className = 'page-loader';
            loader.innerHTML = `
                <div class="loader-content">
                    <div class="loader-cube"></div>
                    <div class="loader-sphere"></div>
                    <div class="loader-pyramid"></div>
                    <div class="loader-text">Loading Amazing Experience...</div>
                </div>
            `;
            
            const style = document.createElement('style');
            style.textContent = `
                .page-loader {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: linear-gradient(135deg, #0a1628 0%, #1e3a5f 50%, #2563eb 100%);
                    z-index: 9999;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    backdrop-filter: blur(10px);
                }
                
                .loader-content {
                    text-align: center;
                    position: relative;
                }
                
                .loader-cube {
                    width: 60px;
                    height: 60px;
                    background: linear-gradient(135deg, #2563eb, #06b6d4);
                    margin: 0 auto 20px;
                    animation: rotateCube 2s infinite linear;
                    transform-style: preserve-3d;
                    box-shadow: 0 20px 40px rgba(37, 99, 235, 0.4);
                }
                
                .loader-sphere {
                    width: 50px;
                    height: 50px;
                    background: radial-gradient(circle at 30% 30%, #3b82f6, #2563eb);
                    border-radius: 50%;
                    margin: 0 auto 20px;
                    animation: floatSphere 1.5s infinite ease-in-out;
                    box-shadow: 0 15px 35px rgba(6, 182, 212, 0.5);
                }
                
                .loader-pyramid {
                    width: 0;
                    height: 0;
                    border-left: 25px solid transparent;
                    border-right: 25px solid transparent;
                    border-bottom: 40px solid #1e40af;
                    margin: 0 auto 20px;
                    animation: rotatePyramid 1.8s infinite linear;
                    filter: drop-shadow(0 10px 25px rgba(30, 64, 175, 0.6));
                }
                
                .loader-text {
                    color: white;
                    font-size: 1.2rem;
                    font-weight: 600;
                    text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
                    animation: pulse 1s infinite ease-in-out;
                }
            `;
            
            document.head.appendChild(style);
            document.body.appendChild(loader);
            
            // Remove loader after page loads
            setTimeout(() => {
                loader.style.opacity = '0';
                loader.style.transition = 'opacity 0.5s ease';
                setTimeout(() => {
                    document.body.removeChild(loader);
                    document.head.removeChild(style);
                }, 500);
            }, 2000);
        }
        
        // Initialize loading animation
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', createLoadingAnimation);
        } else {
            createLoadingAnimation();
        }

        // Smooth parallax scrolling for enhanced depth
        let ticking = false;
        function updateParallax() {
            const scrolled = window.pageYOffset;
            const parallaxElements = document.querySelectorAll('.showcase-card, .feature-card');
            
            parallaxElements.forEach((element, index) => {
                const speed = 0.5 + (index * 0.1);
                const yPos = -(scrolled * speed);
                element.style.transform = `translateY(${yPos}px) translateZ(${index * 5}px)`;
            });
            
            ticking = false;
        }

        function requestTick() {
            if (!ticking) {
                window.requestAnimationFrame(updateParallax);
                ticking = true;
            }
        }

        window.addEventListener('scroll', () => {
            requestTick();
        });

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


