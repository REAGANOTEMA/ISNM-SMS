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
    <title>Infrastructure - Iganga School of Nursing and Midwifery</title>
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

        /* Premium Design System Variables */
        :root {
            /* Professional Color Palette */
            --primary-dark: #0a1628;
            --secondary-dark: #1e3a5f;
            --accent-blue: #2563eb;
            --accent-cyan: #06b6d4;
            --accent-light-blue: #3b82f6;
            --accent-dark-blue: #1e40af;
            --accent-gold: #FFD700;
            --accent-gold-light: #fbbf24;
            --medical-blue: #0066cc;
            --medical-cyan: #00bcd4;
            --success-green: #22c55e;
            --error-red: #ef4444;
            --warning-orange: #f97316;
            
            /* Neutral Colors */
            --white: #ffffff;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            
            /* Text Colors */
            --text-primary: var(--gray-900);
            --text-secondary: var(--gray-600);
            --text-muted: var(--gray-500);
            --text-inverse: var(--white);
            
            /* Background Colors */
            --bg-primary: var(--white);
            --bg-secondary: var(--gray-50);
            --bg-tertiary: var(--gray-100);
            
            /* Border Colors */
            --border-light: var(--gray-200);
            --border-medium: var(--gray-300);
            --border-dark: var(--gray-400);
            
            /* Premium Gradients */
            --gradient-primary: linear-gradient(135deg, var(--primary-dark) 0%, var(--accent-blue) 100%);
            --gradient-secondary: linear-gradient(135deg, var(--accent-blue) 0%, var(--accent-cyan) 100%);
            --gradient-gold: linear-gradient(135deg, var(--accent-gold) 0%, var(--accent-gold-light) 100%);
            --gradient-success: linear-gradient(135deg, var(--success-green) 0%, #16a34a 100%);
            --gradient-hero: linear-gradient(135deg, var(--primary-dark) 0%, var(--secondary-dark) 50%, var(--accent-blue) 100%);
            
            /* Advanced Shadows */
            --shadow-xs: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.07), 0 2px 4px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1), 0 4px 6px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px rgba(0, 0, 0, 0.1), 0 10px 10px rgba(0, 0, 0, 0.04);
            --shadow-2xl: 0 25px 50px rgba(0, 0, 0, 0.25);
            --shadow-glow: 0 0 20px rgba(37, 99, 235, 0.3);
            --shadow-glow-gold: 0 0 30px rgba(255, 215, 0, 0.4);
            
            /* Transitions */
            --transition-fast: 150ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-normal: 300ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-slow: 500ms cubic-bezier(0.4, 0, 0.2, 1);
            
            /* Professional Spacing */
            --space-1: 0.25rem;
            --space-2: 0.5rem;
            --space-3: 0.75rem;
            --space-4: 1rem;
            --space-5: 1.25rem;
            --space-6: 1.5rem;
            --space-8: 2rem;
            --space-10: 2.5rem;
            --space-12: 3rem;
            --space-16: 4rem;
            --space-20: 5rem;
            --space-24: 6rem;
            
            /* Typography */
            --text-xs: 0.75rem;
            --text-sm: 0.875rem;
            --text-base: 1rem;
            --text-lg: 1.125rem;
            --text-xl: 1.25rem;
            --text-2xl: 1.5rem;
            --text-3xl: 1.875rem;
            --text-4xl: 2.25rem;
            --text-5xl: 3rem;
            
            /* Border Radius */
            --radius-sm: 0.25rem;
            --radius-md: 0.375rem;
            --radius-lg: 0.5rem;
            --radius-xl: 0.75rem;
            --radius-2xl: 1rem;
            --radius-full: 9999px;
        }

        /* Professional Navigation System */
        .navbar {
            position: fixed;
            top: 40px;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-light);
            z-index: 1001;
            padding: var(--space-4) 0;
            box-shadow: var(--shadow-lg);
            transition: all var(--transition-normal);
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
            background: var(--gradient-primary);
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
            padding: 0 var(--space-8);
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
            gap: var(--space-4);
            font-weight: 900;
            font-size: var(--text-2xl);
            color: var(--text-primary);
            text-decoration: none;
            font-family: 'Copperplate Gothic Bold', 'Rockwell Extra Bold', serif;
            transform-style: preserve-3d;
            transition: all var(--transition-normal);
            position: relative;
            z-index: 5;
            padding: 0;
            margin: 0;
        }

        .nav-logo::before {
            content: '';
            position: absolute;
            top: -8px;
            left: -8px;
            right: -8px;
            bottom: -8px;
            background: var(--gradient-primary);
            border-radius: var(--radius-full);
            opacity: 0;
            transition: opacity var(--transition-normal);
            z-index: -1;
            filter: blur(8px);
        }

        .nav-logo:hover::before {
            opacity: 0.15;
        }

        .nav-logo img {
            width: 64px;
            height: 64px;
            object-fit: cover;
            border: 3px solid var(--border-light);
            border-radius: var(--radius-full);
            transition: all var(--transition-normal);
            box-shadow: var(--shadow-lg);
            transform-style: preserve-3d;
            background: var(--bg-primary);
            position: relative;
            z-index: 3;
        }

        .nav-logo:hover {
            transform: translateY(-4px) scale(1.02);
        }

        .nav-logo:hover img {
            transform: scale(1.05) rotateZ(2deg);
            box-shadow: var(--shadow-xl);
            border-color: var(--accent-gold);
        }

        .nav-links {
            display: flex;
            gap: var(--space-2);
            align-items: center;
            transform-style: preserve-3d;
            position: relative;
            z-index: 2;
            flex-wrap: wrap;
        }

        /* Navigation Dropdown */
        .nav-dropdown {
            position: relative;
        }

        .nav-dropdown-toggle {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .nav-dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 2px solid #000000;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-xl);
            min-width: 220px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all var(--transition-normal);
            z-index: 1000;
        }

        .nav-dropdown:hover .nav-dropdown-menu,
        .nav-dropdown.active .nav-dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .nav-dropdown-menu a {
            display: block;
            padding: var(--space-3) var(--space-4);
            color: #000000;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all var(--transition-fast);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            font-family: 'Inter', sans-serif;
        }

        .nav-dropdown-menu a:hover {
            background: #000000;
            color: #FFFFFF;
            padding-left: var(--space-6);
            border-bottom-color: transparent;
        }

        .nav-dropdown-menu a:last-child {
            border-bottom: none;
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

        /* Premium Page Header Section */
        .page-header-section {
            background: var(--gradient-hero);
            color: var(--text-inverse);
            padding: calc(var(--space-20) + 120px) 0 var(--space-20);
            text-align: center;
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            margin-top: 0;
        }

        .page-header-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            animation: pageHeaderFloat 20s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes pageHeaderFloat {
            0%, 100% { 
                transform: translateX(0) translateY(0) rotate(0deg); 
            }
            33% { 
                transform: translateX(10px) translateY(-5px) rotate(1deg); 
            }
            66% { 
                transform: translateX(-10px) translateY(5px) rotate(-1deg); 
            }
        }

        .page-header-content {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 var(--space-8);
        }

        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: var(--text-5xl);
            font-weight: 900;
            margin-bottom: var(--space-4);
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            transform-style: preserve-3d;
            transform: translateZ(20px);
            animation: titleGlow 3s ease-in-out infinite alternate;
        }

        @keyframes titleGlow {
            0% {
                text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            }
            100% {
                text-shadow: 0 4px 16px rgba(255, 215, 0, 0.4);
            }
        }

        .breadcrumb {
            opacity: 0.9;
            font-size: var(--text-lg);
            transform-style: preserve-3d;
            transform: translateZ(10px);
            color: var(--accent-gold-light);
        }

        @keyframes navbarShine {
            0%, 100% {
                transform: translateX(-100%);
            }
            50% {
                transform: translateX(100%);
            }
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            font-size: var(--text-base);
            line-height: 1.6;
            color: var(--text-primary);
            background: linear-gradient(135deg, var(--bg-secondary) 0%, var(--bg-primary) 50%, var(--bg-secondary) 100%);
            min-height: 100vh;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }


        /* Premium Main Content */
        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: var(--space-20) var(--space-8);
            position: relative;
            z-index: 1;
        }

        /* Premium Section Styles */
        .section {
            margin-bottom: var(--space-24);
            opacity: 0;
            animation: fadeInUp 1s cubic-bezier(0.4, 0, 0.2, 1) forwards;
            transform-style: preserve-3d;
        }

        .section:nth-child(1) { animation-delay: 0.1s; }
        .section:nth-child(2) { animation-delay: 0.2s; }
        .section:nth-child(3) { animation-delay: 0.3s; }
        .section:nth-child(4) { animation-delay: 0.4s; }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px) translateZ(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0) translateZ(0);
            }
        }

        .section-header {
            text-align: center;
            margin-bottom: var(--space-12);
            position: relative;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: var(--text-4xl);
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: var(--space-4);
            position: relative;
            display: inline-block;
            transform: translateZ(10px);
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: var(--gradient-gold);
            border-radius: var(--radius-full);
            box-shadow: var(--shadow-glow-gold);
            animation: titleUnderline 3s ease-in-out infinite;
        }

        @keyframes titleUnderline {
            0%, 100% { width: 100px; }
            50% { width: 120px; }
        }

        .section-subtitle {
            color: var(--text-secondary);
            font-size: var(--text-lg);
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.7;
            transform: translateZ(5px);
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            flex-direction: column;
            gap: 4px;
            background: #000000;
            border: none;
            border-radius: var(--radius-md);
            padding: var(--space-2);
            cursor: pointer;
            transition: all var(--transition-normal);
            position: relative;
            z-index: 10;
        }

        .mobile-menu-toggle span {
            width: 25px;
            height: 3px;
            background: #FFFFFF;
            border-radius: var(--radius-sm);
            transition: all var(--transition-normal);
        }

        .mobile-menu-toggle:hover {
            background: #333333;
            transform: scale(1.05);
        }

        .mobile-menu-toggle.active span:nth-child(1) {
            transform: rotate(45deg) translate(6px, 6px);
        }

        .mobile-menu-toggle.active span:nth-child(2) {
            opacity: 0;
        }

        /* Infrastructure Overview */
        .infrastructure-overview {
            background: var(--bg-primary);
            border-radius: var(--radius-2xl);
            padding: var(--space-12);
            box-shadow: var(--shadow-xl);
            border: 1px solid var(--border-light);
            margin-bottom: var(--space-12);
            text-align: center;
        }

        .overview-text {
            font-size: var(--text-xl);
            line-height: 1.8;
            color: var(--text-primary);
            margin-bottom: var(--space-8);
        }

        /* Facilities Grid */
        .facilities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .facility-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            position: relative;
            animation: facilityCardFloat 5s ease-in-out infinite;
        }

        .facility-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: var(--shadow-xl);
        }

        .facility-card img {
            transition: all 0.3s ease;
        }

        .facility-card:hover img {
            transform: scale(1.05);
        }

        @keyframes facilityCardFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }

        .facility-image {
            height: 250px;
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow-lg);
            transform-style: preserve-3d;
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .facility-image:hover {
            transform: translateY(-10px) rotateX(5deg) scale(1.02);
            box-shadow: var(--shadow-xl);
        }

        .facility-image::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, rgba(255,215,0,0.1) 50%, transparent 70%);
            animation: rotateShimmer 20s linear infinite;
            opacity: 0.8;
        }

        .facility-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.1) 50%, transparent 70%);
            animation: lightSweep 4s ease-in-out infinite;
        }

        @keyframes rotateShimmer {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        @keyframes lightSweep {
            0%, 100% { transform: translateX(-100%) skewX(-15deg); opacity: 0; }
            50% { transform: translateX(100%) skewX(-15deg); opacity: 1; }
        }

        .facility-content {
            padding: 2rem;
        }

        .facility-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }

        .facility-description {
            color: var(--text-primary);
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .facility-specs {
            background: rgba(30, 58, 138, 0.05);
            border-radius: 10px;
            padding: 1.5rem;
        }

        .spec-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .spec-item:last-child {
            border-bottom: none;
        }

        .spec-icon {
            width: 40px;
            height: 40px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .spec-text {
            color: var(--text-primary);
            font-weight: 500;
        }

        /* Utilities Section */
        .utilities-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            margin-bottom: 3rem;
        }

        .utilities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .utility-card {
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.05), rgba(55, 48, 163, 0.05));
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .utility-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.1), rgba(55, 48, 163, 0.1));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .utility-card:hover::before {
            opacity: 1;
        }

        .utility-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-xl);
        }

        .utility-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            box-shadow: 0 0 20px rgba(30, 58, 138, 0.3);
            position: relative;
            z-index: 1;
        }

        .utility-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .utility-description {
            color: var(--text-primary);
            font-size: 1.1rem;
            line-height: 1.6;
            position: relative;
            z-index: 1;
        }

        .utility-stats {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 1.5rem;
            position: relative;
            z-index: 1;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--accent-blue);
            display: block;
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        /* Transport Section */
        .transport-section {
            background: var(--gradient-primary);
            color: white;
            border-radius: 20px;
            padding: 3rem;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        .transport-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        .transport-content {
            position: relative;
            z-index: 1;
        }

        .transport-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
        }

        .transport-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .transport-item {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .transport-item:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
        }

        .transport-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .transport-name {
            font-weight: 600;
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
        }

        .transport-description {
            opacity: 0.9;
            line-height: 1.6;
        }

        /* Security Section */
        .security-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
        }

        .security-features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .security-feature {
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.05), rgba(55, 48, 163, 0.05));
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .security-feature:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .security-icon {
            width: 70px;
            height: 70px;
            background: var(--gradient-luxury);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.8rem;
            margin: 0 auto 1.5rem;
        }

        .security-title {
            font-weight: 600;
            color: var(--primary-blue);
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .security-description {
            color: var(--text-primary);
            line-height: 1.6;
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
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(25px);
                -webkit-backdrop-filter: blur(25px);
                flex-direction: column;
                gap: 0;
                padding: var(--space-8);
                box-shadow: var(--shadow-2xl);
                border-top: 2px solid var(--accent-gold);
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
                padding: var(--space-4);
                border-radius: 0;
                border-bottom: 1px solid var(--border-light);
                text-align: center;
                font-size: var(--text-base);
                background: rgba(255, 255, 255, 0.95);
                border: 2px solid #000000;
                color: #000000;
            }

            .nav-link:last-child {
                border-bottom: none;
            }

            .nav-dropdown-menu {
                position: static;
                background: rgba(255, 255, 255, 0.98);
                box-shadow: none;
                border: 2px solid #000000;
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
                padding: var(--space-3) var(--space-4);
                font-size: var(--text-sm);
                border-bottom: 1px solid var(--border-light);
                background: transparent;
                color: #000000;
            }

            .nav-dropdown-menu a:hover {
                background: #000000;
                color: #FFFFFF;
                transform: none;
            }

            .navbar {
                padding: var(--space-4);
            }

            .nav-container {
                flex-wrap: wrap;
                position: relative;
            }

            .nav-logo {
                font-size: var(--text-xl);
                gap: var(--space-4);
            }

            .nav-logo img {
                width: 50px;
                height: 50px;
            }
            
            .page-title {
                font-size: var(--text-2xl);
            }
            
            .section-title {
                font-size: var(--text-2xl);
            }
            
            .facilities-grid {
                grid-template-columns: 1fr;
            }
            
            .utilities-grid {
                grid-template-columns: 1fr;
            }
            
            .transport-grid {
                grid-template-columns: 1fr;
            }
            
            .security-features {
                grid-template-columns: 1fr;
            }
        }
    </style>

    </style>
</head>
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
            <h1 class="page-title">School Infrastructure</h1>
            <div class="breadcrumb">
                <p>Home / Infrastructure</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Infrastructure Overview -->
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">6.0 Infrastructure</h2>
                <p class="section-subtitle">State-of-the-art facilities designed for excellence in healthcare education</p>
            </div>
            
            <div class="infrastructure-overview">
                <p class="overview-text">
                    The school has made remarkable infrastructural development in the past year, 
                    creating an environment conducive to learning, practical training, and student welfare.
                </p>
            </div>
        </section>

        <!-- Facilities Grid -->
        <section class="section">
            <div class="facilities-grid">
                <!-- Multi-Purpose Hall -->
                <div class="facility-card">
                    <div class="facility-image">
                    <img src="assets/images/facilities/dinnin-hall-or-main-hall.jpg" alt="ISNM Multi-Purpose Hall - Examination and Events Center" title="ISNM Multi-Purpose Hall - Accommodates 300 Students for Exams and Events" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                    <div class="facility-content">
                        <h3 class="facility-title">Multi-Purpose Hall</h3>
                        <p class="facility-description">
                            A versatile space that can accommodate 300 students and is used to conduct 
                            internal and external exams as well as student recreational and entertainment activities.
                        </p>
                        <div class="facility-specs">
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="spec-text">Capacity: 300 students</div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fas fa-clipboard-check"></i>
                                </div>
                                <div class="spec-text">Examination Center</div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fas fa-music"></i>
                                </div>
                                <div class="spec-text">Entertainment Venue</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kitchen & Dining Hall -->
                <div class="facility-card">
                    <div class="facility-image">
                        <img src="assets/images/facilities/school-kitchen.jpg" alt="ISNM School Kitchen - Modern Food Preparation Facility" title="ISNM School Kitchen - Complete Kitchen and Food Store for Student Meals" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="facility-content">
                        <h3 class="facility-title">Kitchen & Dining Hall</h3>
                        <p class="facility-description">
                            A complete kitchen and food store in a permanent structure, connected to the main hall, 
                            where students sit for their meals.
                        </p>
                        <div class="facility-specs">
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fas fa-store"></i>
                                </div>
                                <div class="spec-text">Food Storage Facility</div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fas fa-wheat"></i>
                                </div>
                                <div class="spec-text">Modern Kitchen Equipment</div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fas fa-chair"></i>
                                </div>
                                <div class="spec-text">Dining Area</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Classrooms -->
                <div class="facility-card">
                    <div class="facility-image">
                        <img src="assets/images/facilities/classroom-building.jpg" alt="ISNM Classroom Building - Modern Learning Facilities" title="ISNM Classroom Building - Six Classrooms Accommodating 60 Students Each" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="facility-content">
                        <h3 class="facility-title">Classrooms</h3>
                        <p class="facility-description">
                            Six complete and permanent classrooms, each accommodating 60 well-seated students 
                            for optimal learning environment.
                        </p>
                        <div class="facility-specs">
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fas fa-door-open"></i>
                                </div>
                                <div class="spec-text">6 Classrooms</div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="spec-text">60 Students per classroom</div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fas fa-chair"></i>
                                </div>
                                <div class="spec-text">Comfortable Seating</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Girls Hostel -->
                <div class="facility-card">
                    <div class="facility-image">
                        <img src="assets/images/facilities/girls-hostel.jpg" alt="ISNM Girls Hostel - Modern Student Accommodation" title="ISNM Girls Hostel - Safe and Comfortable Accommodation for Female Students" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="facility-content">
                        <h3 class="facility-title">Girls Hostel</h3>
                        <p class="facility-description">
                            Modern hostel accommodation for female students with comfortable living spaces 
                            and 24/7 security for safe and conducive learning environment.
                        </p>
                        <div class="facility-specs">
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fas fa-bed"></i>
                                </div>
                                <div class="spec-text">Comfortable Accommodation</div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div class="spec-text">24/7 Security</div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="spec-text">Female Students Only</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Computer Laboratory -->
                <div class="facility-card">
                    <div class="facility-image">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <div class="facility-content">
                        <h3 class="facility-title">Computer Laboratory</h3>
                        <p class="facility-description">
                            A modern computer laboratory with 60 functional computers and two Computer Instructors 
                            who assist students with both theoretical and practical computer knowledge.
                        </p>
                        <div class="facility-specs">
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fas fa-desktop"></i>
                                </div>
                                <div class="spec-text">60 Computers</div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </div>
                                <div class="spec-text">2 Computer Instructors</div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fas fa-wifi"></i>
                                </div>
                                <div class="spec-text">Full Internet Access</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Utilities Section -->
        <section class="section">
            <div class="utilities-section">
                <div class="section-header">
                    <h2 class="section-title">7.0 Utilities</h2>
                    <p class="section-subtitle">Essential utilities supporting daily operations and student life</p>
                </div>
                
                <div class="utilities-grid">
                    <!-- Water Supply -->
                    <div class="utility-card" style="position: relative;">
                        <img src="assets/images/facilities/school-borehole-a-student-is-fetching-water.jpg" alt="ISNM Water Supply System - Borehole Water Facility" title="ISNM Water Supply - Student Fetching Water from School Borehole" style="width: 100%; height: 120px; object-fit: cover; border-radius: 10px; margin-bottom: 1rem;">
                        <div class="utility-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                            <i class="fas fa-tint"></i>
                        </div>
                        <h3 class="utility-title">Water Supply</h3>
                        <p class="utility-description">
                            The school has adequate water supplies from 3 boreholes and harvested rainwater ensuring constant availability.
                        </p>
                        <div class="utility-stats">
                            <div class="stat-item">
                                <span class="stat-number">3</span>
                                <span class="stat-label">Boreholes</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">2</span>
                                <span class="stat-label">Water Tanks</span>
                            </div>
                        </div>
                    </div>

                    <!-- Power Supply -->
                    <div class="utility-card">
                        <div class="utility-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h3 class="utility-title">Power Supply</h3>
                        <p class="utility-description">
                            Multiple power sources ensure constant electricity supply for all school operations.
                        </p>
                        <div class="utility-stats">
                            <div class="stat-item">
                                <span class="stat-number">3</span>
                                <span class="stat-label">Power Sources</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">24/7</span>
                                <span class="stat-label">Availability</span>
                            </div>
                        </div>
                    </div>

                    <!-- Internet -->
                    <div class="utility-card">
                        <div class="utility-icon">
                            <i class="fas fa-globe"></i>
                        </div>
                        <h3 class="utility-title">Internet Services</h3>
                        <p class="utility-description">
                            Full-time internet services help students in research work and academic activities.
                        </p>
                        <div class="utility-stats">
                            <div class="stat-item">
                                <span class="stat-number">High</span>
                                <span class="stat-label">Speed</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">Campus</span>
                                <span class="stat-label">Coverage</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Transport Section -->
        <section class="section">
            <div class="transport-section">
                <div class="transport-content">
                    <h2 class="transport-title">8.0 Transport</h2>
                    <div class="transport-grid">
                        <div class="transport-item">
                            <img src="assets/images/facilities/school-mini-buses-2-costers.jpg" alt="ISNM School Transport Fleet - Two Coaster Buses" title="ISNM School Transport - Two Coaster Buses for Student Transportation" style="width: 100%; height: 120px; object-fit: cover; border-radius: 10px; margin-bottom: 1rem;">
                            <div class="transport-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                                <i class="fas fa-bus"></i>
                            </div>
                            <h3 class="transport-name">Coaster Buses</h3>
                            <p class="transport-description">
                                Two coaster buses used to transport students to and from practicum sites 
                                and other school functions held outside the school.
                            </p>
                        </div>
                        
                        <div class="transport-item">
                            <div class="transport-icon">
                                <i class="fas fa-truck"></i>
                            </div>
                            <h3 class="transport-name">Lorry</h3>
                            <p class="transport-description">
                                A lorry used for ferrying firewood, food items and at times construction materials 
                                for school maintenance and development.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Security Section -->
        <section class="section">
            <div class="security-section">
                <div class="section-header">
                    <h2 class="section-title">9.0 Security</h2>
                    <p class="section-subtitle">Comprehensive security measures for student and staff safety</p>
                </div>
                
                <div class="security-features">
                    <div class="security-feature">
                        <div class="security-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="security-title">Perimeter Fence</h3>
                        <p class="security-description">
                            The school is surrounded with a perimeter fence of chain link ensuring controlled access.
                        </p>
                    </div>
                    
                    <div class="security-feature">
                        <div class="security-icon">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <h3 class="security-title">Security Guards</h3>
                        <p class="security-description">
                            Five security guards operate day and night to ensure utmost security and safety.
                        </p>
                    </div>
                    
                    <div class="security-feature">
                        <div class="security-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h3 class="security-title">Police Collaboration</h3>
                        <p class="security-description">
                            Regular meetings with the police to equip students and staff with security prevention measures.
                        </p>
                    </div>
                    
                    <div class="security-feature">
                        <div class="security-icon">
                            <i class="fas fa-fire-extinguisher"></i>
                        </div>
                        <h3 class="security-title">Fire Safety</h3>
                        <p class="security-description">
                            Fire extinguishers are available in case of a fire outbreak for emergency response.
                        </p>
                    </div>
                    
                    <div class="security-feature">
                        <div class="security-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="security-title">Community Relations</h3>
                        <p class="security-description">
                            Cordial working relationship with the surrounding community for enhanced security.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>

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


