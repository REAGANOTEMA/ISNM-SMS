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
            --gradient-3d-clean: linear-gradient(135deg, var(--gray-light) 0%, var(--white) 100%);
            
            /* Professional Shadows */
            --shadow-sm: 0 2px 4px rgba(10, 22, 40, 0.1);
            --shadow-md: 0 4px 8px rgba(10, 22, 40, 0.15);
            --shadow-lg: 0 8px 16px rgba(10, 22, 40, 0.2);
            --shadow-xl: 0 20px 40px rgba(10, 22, 40, 0.25);
            --shadow-3d-sm: 0 2px 4px rgba(37, 99, 235, 0.3), 0 1px 2px rgba(37, 99, 235, 0.06);
            --shadow-3d-md: 0 4px 8px rgba(37, 99, 235, 0.4), 0 2px 4px rgba(37, 99, 235, 0.08);
            --shadow-3d-lg: 0 8px 16px rgba(37, 99, 235, 0.5), 0 4px 8px rgba(37, 99, 235, 0.1);
            --shadow-3d-xl: 0 20px 40px rgba(37, 99, 235, 0.6), 0 10px 20px rgba(37, 99, 235, 0.15);
            --shadow-3d-neon: 0 0 20px rgba(37, 99, 235, 0.3), 0 0 40px rgba(6, 182, 212, 0.2);
            
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
            --creamy-yellow: #FFF8DC;
            --accent-gold: #FFD700;
            --success-3d: #10B981;
            --warning-3d: #F59E0B;
            --danger-3d: #EF4444;
            --info-3d: #06B6D4;
            --dark-3d: #0F172A;
            --light-3d: #F1F5F9;
            --border-3d-medium: #CBD5E1;
            --border-3d-dark: #94A3B8;
        }

        /* Cinema-Quality 3D Navigation - No Space Above */
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
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--secondary-dark) 50%, var(--accent-blue) 100%);
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
            color: var(--text-primary);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 0.5rem 0.8rem;
            border-radius: 8px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.2);
            font-family: 'Inter', sans-serif;
            transform-style: preserve-3d;
            transform: translateZ(0);
            letter-spacing: 0.6px;
            text-transform: uppercase;
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--gradient-3d-primary);
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
            transform: translateY(-5px) translateZ(15px) rotateX(-3deg) rotateY(4deg);
            box-shadow: 
                0 12px 24px rgba(0, 0, 0, 0.3),
                0 0 30px rgba(37, 99, 235, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
            border-color: rgba(37, 99, 235, 0.6);
            background: rgba(37, 99, 235, 0.9);
        }

        .nav-link:hover::before {
            opacity: 1;
        }

        .nav-link:hover::after {
            opacity: 0.15;
        }

        /* Page Header Section */
        .page-header-section {
            background: 
                linear-gradient(135deg, var(--primary-dark) 0%, var(--secondary-dark) 25%, var(--accent-blue) 50%, var(--accent-dark-blue) 75%, var(--primary-dark) 100%),
                radial-gradient(circle at 50% 50%, rgba(37, 99, 235, 0.3) 0%, transparent 70%);
            color: white;
            padding: 4rem 0;
            text-align: center;
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            perspective: 1000px;
            border-bottom: 3px solid var(--accent-cyan);
        }

        .page-header-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="page-header-pattern" width="60" height="60" patternUnits="userSpaceOnUse"><rect x="20" y="20" width="20" height="20" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="3"/><circle cx="30" cy="30" r="8" fill="rgba(37,99,235,0.2)"/></pattern></defs><rect width="100" height="100" fill="url(%23page-header-pattern)"/></svg>'),
                radial-gradient(circle at 30% 30%, rgba(6, 182, 212, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 70% 70%, rgba(37, 99, 235, 0.15) 0%, transparent 50%);
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
            font-size: clamp(2.5rem, 5vw, 3.5rem);
            font-weight: 900;
            margin-bottom: 1rem;
            text-shadow: 
                0 4px 12px rgba(0, 0, 0, 0.6),
                0 0 30px rgba(37, 99, 235, 0.4),
                0 0 50px rgba(6, 182, 212, 0.3);
            transform-style: preserve-3d;
            transform: translateZ(20px);
            animation: titleGlow 4s ease-in-out infinite;
        }

        .breadcrumb {
            opacity: 0.95;
            font-size: 1.1rem;
            transform-style: preserve-3d;
            transform: translateZ(10px);
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
            animation: breadcrumbFloat 6s ease-in-out infinite;
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
            background: 
                linear-gradient(180deg, var(--gray-light) 0%, var(--white) 45%, var(--gray-light) 100%),
                radial-gradient(circle at 20% 50%, rgba(10, 22, 40, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(30, 58, 95, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 50% 20%, rgba(37, 99, 235, 0.06) 0%, transparent 50%),
                radial-gradient(circle at 50% 80%, rgba(6, 182, 212, 0.06) 0%, transparent 50%),
                radial-gradient(circle at 30% 70%, rgba(14, 165, 233, 0.04) 0%, transparent 50%);
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
                radial-gradient(circle at 30% 70%, rgba(14, 165, 233, 0.04) 0%, transparent 50%);
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

        /* Introduction Section - Premium 3D Glassmorphism */
        .intro-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border-radius: 25px;
            padding: 3rem;
            box-shadow: 
                var(--shadow-3d-lg),
                0 0 40px rgba(37, 99, 235, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
            border: 2px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            transform: translateZ(0);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .intro-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--accent-dark-blue) 0%, var(--accent-blue) 50%, var(--accent-cyan) 100%);
            animation: introCardGlow 3s ease-in-out infinite;
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
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(15px);
            border-radius: 25px;
            padding: 2.5rem;
            box-shadow: 
                var(--shadow-3d-md),
                0 0 30px rgba(37, 99, 235, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.15);
            text-align: center;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
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
            transform: translateY(-12px) translateZ(25px) rotateX(2deg) rotateY(1deg);
            box-shadow: 
                var(--shadow-3d-lg),
                0 0 50px rgba(37, 99, 235, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
            border-color: rgba(37, 99, 235, 0.3);
            background: rgba(255, 255, 255, 0.9);
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

        /* Advanced 3D Animations */
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
        
        @keyframes particleFloat {
            0%, 100% {
                transform: translateY(0) translateX(0) scale(1);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            50% {
                transform: translateY(-100px) translateX(50px) scale(1.5);
                opacity: 0.8;
            }
            90% {
                opacity: 0.3;
            }
        }
        
        @keyframes float3D {
            0%, 100% {
                transform: translateY(0) translateX(0) rotateX(0deg) rotateY(0deg);
            }
            25% {
                transform: translateY(-20px) translateX(10px) rotateX(5deg) rotateY(10deg);
            }
            50% {
                transform: translateY(-40px) translateX(20px) rotateX(10deg) rotateY(20deg);
            }
            75% {
                transform: translateY(-20px) translateX(10px) rotateX(5deg) rotateY(10deg);
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
            }
            25% {
                transform: translateY(-30px) translateX(15px) scale(1.1);
            }
            50% {
                transform: translateY(-60px) translateX(30px) scale(1.2);
            }
            75% {
                transform: translateY(-30px) translateX(15px) scale(1.1);
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
        
        @keyframes navbarShine {
            0%, 100% {
                transform: translateX(-100%);
            }
            50% {
                transform: translateX(100%);
            }
        }
        
        @keyframes titleGlow {
            0%, 100% {
                text-shadow: 
                    0 4px 12px rgba(0, 0, 0, 0.6),
                    0 0 30px rgba(37, 99, 235, 0.4),
                    0 0 50px rgba(6, 182, 212, 0.3);
            }
            50% {
                text-shadow: 
                    0 4px 12px rgba(0, 0, 0, 0.8),
                    0 0 50px rgba(37, 99, 235, 0.6),
                    0 0 80px rgba(6, 182, 212, 0.4);
            }
        }
        
        @keyframes breadcrumbFloat {
            0%, 100% {
                transform: translateZ(10px) translateY(0);
            }
            50% {
                transform: translateZ(15px) translateY(-5px);
            }
        }
        
        @keyframes introCardGlow {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.7;
                filter: brightness(1.2);
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
        
        @keyframes footerTitleGlow {
            0%, 100% {
                opacity: 0.1;
            }
            50% {
                opacity: 0.2;
                filter: brightness(1.3);
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
            border: 2px solid var(--accent-blue);
            border-radius: 12px;
            box-shadow: 0 12px 24px rgba(10, 22, 40, 0.2);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px) translateZ(-20px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-width: 180px;
            z-index: 1000;
        }

        .nav-dropdown:hover .nav-dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) translateZ(10px);
        }

        .nav-dropdown-menu a {
            display: block;
            padding: 0.6rem 0.8rem;
            color: var(--text-primary);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            border-bottom: 1px solid transparent;
            transform-style: preserve-3d;
            transform: translateZ(0);
        }

        .nav-dropdown-menu a:hover {
            background: var(--accent-light-blue);
            color: var(--white);
            transform: translateX(5px) translateZ(5px);
            border-bottom-color: var(--accent-blue);
        }

        .nav-dropdown-menu a:first-child {
            border-radius: 10px 10px 0 0;
        }

        .nav-dropdown-menu a:last-child {
            border-radius: 0 0 10px 10px;
        }

        @keyframes navPatternFloat {
            0% { transform: translateX(0) translateY(0); }
            25% { transform: translateX(10px) translateY(-5px); }
            50% { transform: translateX(20px) translateY(0); }
            75% { transform: translateX(10px) translateY(5px); }
            100% { transform: translateX(0) translateY(0); }
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

        /* Enhanced 3D Footer */
        .footer {
            background: 
                linear-gradient(135deg, var(--primary-dark) 0%, var(--secondary-dark) 25%, var(--accent-blue) 50%, var(--accent-dark-blue) 75%, var(--primary-dark) 100%),
                linear-gradient(45deg, rgba(37, 99, 235, 0.1) 0%, rgba(6, 182, 212, 0.1) 100%);
            color: white;
            padding: 4rem 2rem 2rem;
            margin-top: 4rem;
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            perspective: 1000px;
            border-top: 3px solid var(--accent-cyan);
        }
        
        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--accent-dark-blue) 0%, var(--accent-blue) 50%, var(--accent-cyan) 100%);
            animation: footerShine 4s ease-in-out infinite;
        }
        
        .footer::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 20%, rgba(37, 99, 235, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(6, 182, 212, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 50% 50%, rgba(59, 130, 246, 0.05) 0%, transparent 50%);
            pointer-events: none;
            animation: footerAurora 15s ease-in-out infinite;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .footer-section h3 {
            font-size: 1.4rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            color: var(--accent-cyan);
            text-shadow: 0 2px 4px rgba(6, 182, 212, 0.3);
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
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-cyan));
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
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-cyan));
            border-radius: 8px;
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: -1;
        }
        
        .footer-links a:hover {
            color: var(--primary-dark);
            transform: translateX(8px) translateZ(15px) rotateY(5deg);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.4);
        }
        
        .footer-links a:hover::before {
            opacity: 1;
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
                    <img src="assets/school-logo.png" alt="ISNM Logo" style="width: 75px; height: 75px;">
                    <div class="nav-logo-text">
                         </div>
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
            <h1 class="page-title">About Our School</h1>
            <div class="breadcrumb">
                <p>Home / About</p>
            </div>
        </div>
    </div>

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
                    <img src="assets/hero.jpg" alt="ISNM Hero Image - School Excellence" class="intro-image">
                    <div class="image-overlay">
                        <h4>School Excellence</h4>
                        <p>Demonstrating our commitment to healthcare education</p>
                    </div>
                </div>
                
                <div class="intro-image-card">
                    <img src="assets/graduations-hero.jpg" alt="ISNM Graduations Hero - Student Success" class="intro-image">
                    <div class="image-overlay">
                        <h4>Graduate Success</h4>
                        <p>Celebrating our students' achievements and milestones</p>
                    </div>
                </div>
                
                <div class="intro-image-card">
                    <img src="assets/current-principal.jpg" alt="ISNM Current Principal - School Leadership" class="intro-image">
                    <div class="image-overlay">
                        <h4>Leadership Excellence</h4>
                        <p>Current principal leading the school to greater heights</p>
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

        // Add error handling for images
        document.querySelectorAll('img').forEach(img => {
            img.addEventListener('error', function() {
                this.style.display = 'none';
                console.warn('Image failed to load:', this.src);
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
    </script>
</body>
</html>
