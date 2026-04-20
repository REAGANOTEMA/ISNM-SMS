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
    <title>School History - Iganga School of Nursing and Midwifery</title>
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

        .nav-link:hover {
            color: #FFFFFF;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
            border-color: #000000;
            background: #000000;
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


        /* History Introduction */
        .history-intro {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            margin-bottom: 3rem;
            text-align: center;
        }

        .intro-text {
            font-size: 1.2rem;
            line-height: 1.8;
            color: var(--text-primary);
            margin-bottom: 2rem;
        }

        .founding-year {
            display: inline-block;
            background: var(--gradient-primary);
            color: white;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 1rem 0;
        }

        /* Timeline */
        .timeline-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            margin-bottom: 3rem;
        }

        .timeline {
            position: relative;
            padding: 2rem 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 4px;
            background: var(--gradient-primary);
            transform: translateX(-50%);
        }

        .timeline-item {
            position: relative;
            padding: 2rem 0;
            display: flex;
            align-items: center;
        }

        .timeline-item:nth-child(odd) {
            flex-direction: row-reverse;
        }

        .timeline-content {
            flex: 1;
            padding: 0 2rem;
        }

        .timeline-item:nth-child(odd) .timeline-content {
            text-align: right;
        }

        .timeline-date {
            background: var(--gradient-luxury);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 1rem;
            font-family: 'Playfair Display', serif;
        }

        .timeline-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }

        .timeline-description {
            color: var(--text-primary);
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .timeline-dot {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 20px;
            background: var(--golden-yellow);
            border: 4px solid var(--primary-blue);
            border-radius: 50%;
            z-index: 2;
        }

        /* Milestones */
        .milestones-section {
            background: var(--gradient-primary);
            color: white;
            border-radius: 20px;
            padding: 3rem;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        .milestones-section::before {
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

        .milestones-content {
            position: relative;
            z-index: 1;
        }

        .milestones-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
        }

        .milestones-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .milestone-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .milestone-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
        }

        .milestone-year {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--golden-yellow);
        }

        .milestone-title {
            font-weight: 600;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        .milestone-description {
            opacity: 0.9;
            line-height: 1.6;
        }

        /* Growth Section */
        .growth-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
        }

        .growth-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .growth-item {
            text-align: center;
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.05), rgba(55, 48, 163, 0.05));
            border-radius: 15px;
            padding: 2rem;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .growth-item:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .growth-number {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 900;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
            display: block;
        }

        .growth-label {
            color: var(--text-secondary);
            font-size: 1.1rem;
        }

        .growth-icon {
            width: 60px;
            height: 60px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin: 0 auto 1rem;
        }

        /* Enhanced History Gallery */
        .history-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2.5rem;
            margin: 3rem 0;
        }

        .history-card {
            background: linear-gradient(145deg, var(--white), var(--cream-white));
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            transform-style: preserve-3d;
            transform: translateZ(0);
            border: 2px solid transparent;
        }

        .history-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-blue), var(--light-green), var(--golden-yellow));
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .history-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="history-pattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="2" fill="var(--golden-yellow)" opacity="0.2"/><path d="M5 10 Q10 5, 15 10 T25 10" stroke="var(--light-green)" stroke-width="1" fill="none" opacity="0.3"/></pattern></defs><rect width="100" height="100" fill="url(%23history-pattern)"/></svg>'),
                linear-gradient(135deg, transparent 40%, rgba(255,255,255,0.2) 50%, transparent 60%);
            background-size: 40px 40px, cover;
            background-position: 0 0, center;
            transform: translateX(-100%);
            transition: transform 0.8s ease;
            pointer-events: none;
        }

        .history-card:hover {
            transform: translateY(-15px) scale(1.02) rotateX(3deg) translateZ(25px);
            box-shadow: var(--shadow-xl), 0 0 40px rgba(37, 99, 235, 0.3);
            border-color: var(--primary-blue);
        }

        .history-card:hover::before {
            transform: scaleX(1);
        }

        .history-card:hover::after {
            transform: translateX(100%);
        }

        .history-image {
            width: 100%;
            height: 280px;
            object-fit: cover;
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            transform-style: preserve-3d;
            transform: translateZ(0);
            border-radius: 15px;
            box-shadow: var(--shadow-md);
        }

        .history-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, transparent 40%, rgba(255,255,255,0.4) 50%, rgba(255,215,0,0.2) 60%, transparent 70%);
            transform: translateX(-100%) skewX(-15deg);
            transition: transform 1s ease;
            pointer-events: none;
            border-radius: 15px;
        }

        .history-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 50% 50%, transparent 40%, rgba(0,0,0,0.1) 100%);
            opacity: 0;
            transition: opacity 0.6s ease;
            border-radius: 15px;
        }

        .history-card:hover .history-image {
            transform: scale(1.08) rotateX(3deg) rotateY(2deg) translateZ(20px);
            box-shadow: var(--shadow-xl);
        }

        .history-card:hover .history-image::before {
            transform: translateX(100%) skewX(-15deg);
        }

        .history-card:hover .history-image::after {
            opacity: 1;
        }

        .history-card-content {
            padding: 2rem;
        }

        .history-card-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }

        .history-card-description {
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .history-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .history-badge {
            display: inline-block;
            background: var(--gradient-primary);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        @keyframes historyFloat {
            0%, 100% { transform: translateY(0px) translateZ(0px); }
            50% { transform: translateY(-5px) translateZ(10px); }
        }

        /* Vision Section */
        .vision-section {
            background: var(--gradient-luxury);
            color: white;
            border-radius: 20px;
            padding: 3rem;
            margin-top: 3rem;
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .vision-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 25s linear infinite;
        }

        .vision-content {
            position: relative;
            z-index: 1;
        }

        .vision-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
        }

        .vision-text {
            font-size: 1.2rem;
            line-height: 1.8;
            max-width: 800px;
            margin: 0 auto;
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

            .luxury-header {
                padding: 1rem;
            }

            .header-content {
                flex-wrap: wrap;
                position: relative;
            }

            .logo-section {
                flex: 1;
            }
            
            .page-title {
                font-size: 2rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .timeline::before {
                left: 20px;
            }
            
            .timeline-item {
                flex-direction: column !important;
                padding-left: 60px;
            }
            
            .timeline-content {
                text-align: left !important;
                padding: 0;
            }
            
            .timeline-dot {
                left: 20px;
            }
            
            .milestones-grid {
                grid-template-columns: 1fr;
            }
            
            .growth-stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Premium History Gallery Section Styles */
        .history-gallery-section {
            padding: 6rem 2rem;
            background: linear-gradient(135deg, var(--gray-light) 0%, var(--white) 50%, var(--gray-light) 100%);
            position: relative;
            overflow: hidden;
        }

        .history-gallery-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 42% 42%, rgba(37, 99, 235, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 58% 58%, rgba(6, 182, 212, 0.03) 0%, transparent 50%),
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="history-bg-pattern" width="52" height="52" patternUnits="userSpaceOnUse"><circle cx="26" cy="26" r="3.5" fill="rgba(37, 99, 235, 0.06)"/><path d="M16 26 Q26 16, 36 26 T56 26" stroke="rgba(6, 182, 212, 0.04)" stroke-width="1" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23history-bg-pattern)"/></svg>');
            background-size: cover, cover, 104px 104px;
            background-position: center, center, 0 0;
            animation: historyFloat 70s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes historyFloat {
            0%, 100% { transform: translateX(0) translateY(0) rotate(0deg); }
            25% { transform: translateX(24px) translateY(-15px) rotate(0.8deg); }
            50% { transform: translateX(48px) translateY(0) rotate(0deg); }
            75% { transform: translateX(24px) translateY(15px) rotate(-0.8deg); }
        }

        .history-gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(370px, 1fr));
            grid-auto-rows: 350px;
            gap: 2.9rem;
            position: relative;
            z-index: 2;
        }

        .history-item {
            position: relative;
            overflow: hidden;
            border-radius: 33px;
            box-shadow: var(--shadow-xl);
            transition: all 1.05s cubic-bezier(0.4, 0, 0.2, 1);
            transform-style: preserve-3d;
            transform: translateZ(0);
            background: var(--white);
        }

        .history-item-large {
            grid-column: span 2;
            grid-row: span 2;
        }

        .history-item-wide {
            grid-column: span 2;
        }

        .history-image-wrapper {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
            border-radius: 33px;
        }

        .history-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 1.25s cubic-bezier(0.4, 0, 0.2, 1);
            transform: scale(1);
            filter: brightness(1) contrast(1) saturate(1);
        }

        .history-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(
                to bottom,
                transparent 0%,
                transparent 37%,
                rgba(10, 22, 40, 0.86) 76%,
                rgba(10, 22, 40, 0.97) 100%
            );
            display: flex;
            align-items: flex-end;
            padding: 4.2rem;
            opacity: 0;
            transition: all 1.05s cubic-bezier(0.4, 0, 0.2, 1);
            transform: translateY(42px);
        }

        .history-content {
            color: var(--white);
            transform: translateZ(32px);
        }

        .history-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.05rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            text-shadow: 4px 4px 14px rgba(0, 0, 0, 0.92);
        }

        .history-description {
            font-size: 1.22rem;
            line-height: 1.95;
            margin-bottom: 2.1rem;
            opacity: 0.94;
        }

        .history-badges {
            display: flex;
            gap: 1.3rem;
            flex-wrap: wrap;
        }

        .history-badge {
            background: linear-gradient(135deg, var(--accent-blue) 0%, var(--accent-cyan) 100%);
            color: var(--white);
            padding: 0.85rem 1.7rem;
            border-radius: 42px;
            font-size: 0.97rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.3px;
            box-shadow: 0 14px 32px rgba(37, 99, 235, 0.75);
        }

        /* History Gallery Hover Effects */
        .history-item:hover {
            transform: translateY(-38px) translateZ(75px) rotateX(7.5deg) rotateY(-6.5deg);
            box-shadow: 
                var(--shadow-2xl),
                0 0 140px rgba(37, 99, 235, 0.75),
                0 0 280px rgba(6, 182, 212, 0.65);
        }

        .history-item:hover .history-image {
            transform: scale(1.23) rotateX(6.5deg) rotateY(-6.5deg);
            filter: brightness(1.32) contrast(1.22) saturate(1.32);
        }

        .history-item:hover .history-overlay {
            opacity: 1;
            transform: translateY(0);
            background: linear-gradient(
                to bottom,
                transparent 0%,
                transparent 27%,
                rgba(10, 22, 40, 0.78) 67%,
                rgba(10, 22, 40, 0.91) 100%
            );
        }

        /* History Item Animations */
        .history-item:nth-child(1) { animation: historySlideIn 1.25s ease-out 0.1s both; }
        .history-item:nth-child(2) { animation: historySlideIn 1.25s ease-out 0.2s both; }
        .history-item:nth-child(3) { animation: historySlideIn 1.25s ease-out 0.3s both; }
        .history-item:nth-child(4) { animation: historySlideIn 1.25s ease-out 0.4s both; }
        .history-item:nth-child(5) { animation: historySlideIn 1.25s ease-out 0.5s both; }
        .history-item:nth-child(6) { animation: historySlideIn 1.25s ease-out 0.6s both; }
        .history-item:nth-child(7) { animation: historySlideIn 1.25s ease-out 0.7s both; }
        .history-item:nth-child(8) { animation: historySlideIn 1.25s ease-out 0.8s both; }

        @keyframes historySlideIn {
            from {
                opacity: 0;
                transform: translateY(75px) scale(0.68);
                filter: blur(28px);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
                filter: blur(0);
            }
        }

        /* Responsive History Gallery */
        @media (max-width: 1024px) {
            .history-gallery-grid {
                grid-template-columns: repeat(auto-fit, minmax(330px, 1fr));
                grid-auto-rows: 310px;
                gap: 2.4rem;
            }

            .history-item-large {
                grid-column: span 1;
                grid-row: span 1;
            }

            .history-item-wide {
                grid-column: span 1;
            }

            .history-title {
                font-size: 1.75rem;
            }

            .history-description {
                font-size: 1.12rem;
            }
        }

        @media (max-width: 768px) {
            .history-gallery-section {
                padding: 4rem 1rem;
            }

            .history-gallery-grid {
                grid-template-columns: 1fr;
                grid-auto-rows: 350px;
                gap: 2.1rem;
            }

            .history-item-large,
            .history-item-wide {
                grid-column: span 1;
                grid-row: span 1;
            }

            .history-overlay {
                padding: 3.8rem;
            }

            .history-title {
                font-size: 1.85rem;
            }

            .history-description {
                font-size: 1.17rem;
            }
        }

        @media (max-width: 480px) {
            .history-title {
                font-size: 1.65rem;
            }

            .history-description {
                font-size: 1.08rem;
            }

            .history-badge {
                font-size: 0.87rem;
                padding: 0.75rem 1.5rem;
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
            <h1 class="page-title">School History</h1>
            <div class="breadcrumb">
                <p>Home / About / Our History</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Premium History Gallery Section -->
        <section class="history-gallery-section">
            <div class="section-container">
                <div class="section-header">
                    <div class="section-badge">
                        <i class="fas fa-history"></i>
                        <span>Historical Journey</span>
                    </div>
                    <h2 class="section-title">Experience Our Remarkable Evolution</h2>
                    <p class="section-subtitle">
                        Witness our transformation from humble beginnings to a leading healthcare 
                        education institution through our historical milestones and achievements.
                    </p>
                </div>
                
                <div class="history-gallery-grid">
                    <div class="history-item history-item-large">
                        <div class="history-image-wrapper">
                            <img src="assets/images/staff/old-principal-and-new-principal.jpg" alt="ISNM Founding Leadership - Historical Beginnings" class="history-image">
                            <div class="history-overlay">
                                <div class="history-content">
                                    <h3 class="history-title">Founding Vision</h3>
                                    <p class="history-description">Our founding leadership establishing the foundation for healthcare excellence in 2009</p>
                                    <div class="history-badges">
                                        <span class="history-badge">Foundation</span>
                                        <span class="history-badge">Leadership</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="history-item">
                        <div class="history-image-wrapper">
                            <img src="assets/images/achievements/graduation-day-students-matching-while-playing-trumpets-and-drum.jpg" alt="ISNM Early Graduation Celebrations - Student Success" class="history-image">
                            <div class="history-overlay">
                                <div class="history-content">
                                    <h3 class="history-title">Early Success</h3>
                                    <p class="history-description">Celebrating our first graduation with musical performances and achievements</p>
                                    <div class="history-badges">
                                        <span class="history-badge">Celebration</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="history-item">
                        <div class="history-image-wrapper">
                            <img src="assets/images/facilities/administration-block.jpg" alt="ISNM Administrative Excellence - Institutional Growth" class="history-image">
                            <div class="history-overlay">
                                <div class="history-content">
                                    <h3 class="history-title">Institutional Growth</h3>
                                    <p class="history-description">Professional administration supporting our expanding educational mission</p>
                                    <div class="history-badges">
                                        <span class="history-badge">Growth</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="history-item history-item-wide">
                        <div class="history-image-wrapper">
                            <img src="assets/images/hero/graduations-hero.jpg" alt="ISNM Graduation Excellence - Academic Achievement" class="history-image">
                            <div class="history-overlay">
                                <div class="history-content">
                                    <h3 class="history-title">Academic Excellence</h3>
                                    <p class="history-description">Celebrating graduation excellence and professional achievement of our students</p>
                                    <div class="history-badges">
                                        <span class="history-badge">Excellence</span>
                                        <span class="history-badge">Achievement</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="history-item">
                        <div class="history-image-wrapper">
                            <img src="assets/images/facilities/classroom-building.jpg" alt="ISNM Modern Infrastructure - Educational Facilities" class="history-image">
                            <div class="history-overlay">
                                <div class="history-content">
                                    <h3 class="history-title">Modern Infrastructure</h3>
                                    <p class="history-description">State-of-the-art facilities supporting advanced healthcare education</p>
                                    <div class="history-badges">
                                        <span class="history-badge">Infrastructure</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="history-item">
                        <div class="history-image-wrapper">
                            <img src="assets/images/academic/students-in-skill-laboratory-in-practical-training.jpg" alt="ISNM Advanced Training - Practical Skills Development" class="history-image">
                            <div class="history-overlay">
                                <div class="history-content">
                                    <h3 class="history-title">Advanced Training</h3>
                                    <p class="history-description">Modern practical training facilities with cutting-edge medical equipment</p>
                                    <div class="history-badges">
                                        <span class="history-badge">Training</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="history-item history-item-large">
                        <div class="history-image-wrapper">
                            <img src="assets/images/hero/students-in-class.jpg" alt="ISNM Educational Journey - Learning Excellence" class="history-image">
                            <div class="history-overlay">
                                <div class="history-content">
                                    <h3 class="history-title">Educational Journey</h3>
                                    <p class="history-description">Interactive learning experiences fostering professional development and excellence</p>
                                    <div class="history-badges">
                                        <span class="history-badge">Learning</span>
                                        <span class="history-badge">Development</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- History Introduction -->
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">Our Journey Through Time</h2>
                <p class="section-subtitle">The remarkable story of Iganga School of Nursing and Midwifery</p>
            </div>
            
            <div class="history-intro">
                <p class="intro-text">
                    Founded with a vision to transform healthcare education in Uganda, Iganga School of Nursing and Midwifery 
                    has grown from humble beginnings to become a leading institution in nursing and midwifery training.
                </p>
                <div class="founding-year">Founded in 2009</div>
                <p class="intro-text">
                    From our initial cohort of 13 students to over 300 students today, our journey has been marked by 
                    continuous growth, academic excellence, and unwavering commitment to producing world-class healthcare professionals.
                </p>
            </div>
        </section>

        <!-- Timeline Section -->
        <section class="section">
            <div class="timeline-section">
                <div class="section-header">
                    <h3 class="section-title">Historical Timeline</h3>
                    <p class="section-subtitle">Key milestones in our development</p>
                </div>
                
                <div class="timeline">
                    <div class="timeline-item" style="position: relative;">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-date">2009</div>
                            <img src="assets/images/staff/old-principal-and-new-principal.jpg" alt="School Founding Leadership" style="width: 100%; height: 150px; object-fit: cover; border-radius: 8px; margin-bottom: 1rem;">
                            <h4 class="timeline-title">The Beginning</h4>
                            <p class="timeline-description">
                                ISNM was founded with 13 pioneering students. The school was established by three founding members 
                                who formed the Board of Directors with a vision to provide quality healthcare education.
                            </p>
                        </div>
                    </div>
                    
                    <div class="timeline-item" style="position: relative;">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-date">2010-2012</div>
                            <img src="assets/images/achievements/graduation-day-students-matching-while-playing-trumpets-and-drum.jpg" alt="Early Graduation Celebrations" style="width: 100%; height: 150px; object-fit: cover; border-radius: 8px; margin-bottom: 1rem;">
                            <h4 class="timeline-title">Early Growth</h4>
                            <p class="timeline-description">
                                Rapid expansion of student enrollment and development of basic infrastructure. 
                                Established partnerships with local hospitals for clinical training.
                            </p>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-date">2013-2015</div>
                            <h4 class="timeline-title">Academic Excellence</h4>
                            <p class="timeline-description">
                                Achieved remarkable results in national examinations with 100% pass rate in midwifery 
                                and over 85% in nursing programs. Expanded curriculum and facilities.
                            </p>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-date">2016-2018</div>
                            <h4 class="timeline-title">Infrastructure Development</h4>
                            <p class="timeline-description">
                                Construction of multi-purpose hall and first phase of girls' hostel. 
                                Acquisition of additional transportation and enhanced laboratory facilities.
                            </p>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-date">2019-2021</div>
                            <h4 class="timeline-title">Modernization</h4>
                            <p class="timeline-description">
                                Installation of solar panels and generators for reliable power supply. 
                                Separated and equipped skills laboratories for Nursing and Midwifery.
                            </p>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-date">2022-Present</div>
                            <h4 class="timeline-title">Digital Transformation</h4>
                            <p class="timeline-description">
                                Enhanced computer laboratory with 60 functional computers and full internet access. 
                                Implementation of modern management systems and expanded practicum partnerships.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Key Milestones -->
        <section class="section">
            <div class="milestones-section">
                <div class="milestones-content">
                    <h2 class="milestones-title">Key Milestones</h2>
                    <div class="milestones-grid">
                        <div class="milestone-card">
                            <div class="milestone-year">2009</div>
                            <h3 class="milestone-title">School Foundation</h3>
                            <p class="milestone-description">
                                Established with 13 students and 3 founding directors
                            </p>
                        </div>
                        
                        <div class="milestone-card">
                            <div class="milestone-year">2012</div>
                            <h3 class="milestone-title">First Graduation</h3>
                            <p class="milestone-description">
                                Celebrated first cohort of graduating nurses and midwives
                            </p>
                        </div>
                        
                        <div class="milestone-card">
                            <div class="milestone-year">2015</div>
                            <h3 class="milestone-title">MOES Registration</h3>
                            <p class="milestone-description">
                                Officially registered with Ministry of Education & Sports
                            </p>
                        </div>
                        
                        <div class="milestone-card">
                            <div class="milestone-year">2017</div>
                            <h3 class="milestone-title">UNMC Accreditation</h3>
                            <p class="milestone-description">
                                Full accreditation by Uganda Nurses and Midwives Council
                            </p>
                        </div>
                        
                        <div class="milestone-card">
                            <div class="milestone-year">2019</div>
                            <h3 class="milestone-title">Infrastructure Expansion</h3>
                            <p class="milestone-description">
                                Completion of multi-purpose hall and hostel facilities
                            </p>
                        </div>
                        
                        <div class="milestone-card">
                            <div class="milestone-year">2021</div>
                            <h3 class="milestone-title">Land Acquisition</h3>
                            <p class="milestone-description">
                                Acquired 12+ acres for future expansion and development
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Growth Statistics -->
        <section class="section">
            <div class="growth-section">
                <div class="section-header">
                    <h3 class="section-title">Growth Over the Years</h3>
                    <p class="section-subtitle">Our journey of expansion and development</p>
                </div>
                
                <div class="growth-stats">
                    <div class="growth-item">
                        <div class="growth-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <span class="growth-number">13</span>
                        <span class="growth-label">Students (2009)</span>
                    </div>
                    
                    <div class="growth-item">
                        <div class="growth-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <span class="growth-number">315+</span>
                        <span class="growth-label">Students (Current)</span>
                    </div>
                    
                    <div class="growth-item">
                        <div class="growth-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <span class="growth-number">4</span>
                        <span class="growth-label">Programs</span>
                    </div>
                    
                    <div class="growth-item">
                        <div class="growth-icon">
                            <i class="fas fa-hospital"></i>
                        </div>
                        <span class="growth-number">7</span>
                        <span class="growth-label">Practicum Sites</span>
                    </div>
                    
                    <div class="growth-item">
                        <div class="growth-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <span class="growth-number">6</span>
                        <span class="growth-label">Classrooms</span>
                    </div>
                    
                    <div class="growth-item">
                        <div class="growth-icon">
                            <i class="fas fa-desktop"></i>
                        </div>
                        <span class="growth-number">60</span>
                        <span class="growth-label">Computers</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- History Gallery Section -->
        <section class="section">
            <div class="history-gallery-section">
                <div class="section-header">
                    <h2 class="section-title">Historical Gallery</h2>
                    <p class="section-subtitle">Visual memories of our journey through the years</p>
                </div>
                
                <div class="history-gallery">
                    <!-- Football Team Images -->
                    <div class="history-card">
                        <img src="assets/images/activities/footbal-team-student-images1.jpg" alt="ISNM Football Team - Student Sports Activities" title="ISNM Football Team - Building Team Spirit and Physical Fitness" class="history-image">
                        <div class="history-card-content">
                            <h3 class="history-card-title">Football Team</h3>
                            <p class="history-card-description">
                                Our talented football team representing ISNM in various competitions
                            </p>
                            <div class="history-badges">
                                <span class="history-badge">Sports</span>
                                <span class="history-badge">Team Spirit</span>
                            </div>
                        </div>
                    </div>

                    <div class="history-card">
                        <img src="assets/images/activities/footbal-team-student-images2.jpg" alt="ISNM Football Team in Action - Competitive Sports" title="ISNM Football Team - Competitive Sports and Team Building" class="history-image">
                        <div class="history-card-content">
                            <h3 class="history-card-title">Team Competition</h3>
                            <p class="history-card-description">
                                Students showcasing their skills in competitive football matches
                            </p>
                            <div class="history-badges">
                                <span class="history-badge">Competition</span>
                                <span class="history-badge">Excellence</span>
                            </div>
                        </div>
                    </div>

                    <div class="history-card">
                        <img src="assets/images/activities/footbal-team-student-images3.jpg" alt="ISNM Football Team Training - Sports Development" title="ISNM Football Team - Training and Skills Development" class="history-image">
                        <div class="history-card-content">
                            <h3 class="history-card-title">Training Sessions</h3>
                            <p class="history-card-description">
                                Intensive training sessions to develop athletic skills and teamwork
                            </p>
                            <div class="history-badges">
                                <span class="history-badge">Training</span>
                                <span class="history-badge">Development</span>
                            </div>
                        </div>
                    </div>

                    <!-- Practicum Site Images -->
                    <div class="history-card">
                        <img src="assets/images/academic/student-st-practicum-sites1.jpg" alt="ISNM Students at Practicum Site - Clinical Training" title="ISNM Students - Hands-on Clinical Training at Practicum Sites" class="history-image">
                        <div class="history-card-content">
                            <h3 class="history-card-title">Clinical Practicum</h3>
                            <p class="history-card-description">
                                Students gaining practical experience at partner healthcare facilities
                            </p>
                            <div class="history-badges">
                                <span class="history-badge">Clinical</span>
                                <span class="history-badge">Training</span>
                            </div>
                        </div>
                    </div>

                    <div class="history-card">
                        <img src="assets/images/academic/student-at-practicum-site2.jpg" alt="ISNM Students at Practicum Site - Healthcare Experience" title="ISNM Students - Real-world Healthcare Experience" class="history-image">
                        <div class="history-card-content">
                            <h3 class="history-card-title">Healthcare Experience</h3>
                            <p class="history-card-description">
                                Students applying their knowledge in real healthcare settings
                            </p>
                            <div class="history-badges">
                                <span class="history-badge">Experience</span>
                                <span class="history-badge">Application</span>
                            </div>
                        </div>
                    </div>

                    <!-- School Infrastructure Images -->
                    <div class="history-card">
                        <img src="assets/images/facilities/school-borehole-a-student-is-fetching-water.jpg" alt="ISNM School Borehole - Water Supply System" title="ISNM Water Supply - Student Fetching Water from School Borehole" class="history-image">
                        <div class="history-card-content">
                            <h3 class="history-card-title">Water Supply</h3>
                            <p class="history-card-description">
                                School borehole providing clean water for students and staff
                            </p>
                            <div class="history-badges">
                                <span class="history-badge">Infrastructure</span>
                                <span class="history-badge">Sustainability</span>
                            </div>
                        </div>
                    </div>

                    <div class="history-card">
                        <img src="assets/images/facilities/school-mini-buses-2-costers.jpg" alt="ISNM School Transport - Two Coaster Buses" title="ISNM School Transport - Two Coaster Buses for Student Transportation" class="history-image">
                        <div class="history-card-content">
                            <h3 class="history-card-title">School Transport</h3>
                            <p class="history-card-description">
                                Two coaster buses providing transportation for students to practicum sites
                            </p>
                            <div class="history-badges">
                                <span class="history-badge">Transport</span>
                                <span class="history-badge">Logistics</span>
                            </div>
                        </div>
                    </div>

                    <!-- Leadership Images -->
                    <div class="history-card">
                        <img src="assets/images/staff/principle.jpeg" alt="Sr. Edith Mwebaza - ISNM School Principal" title="Sr. Edith Mwebaza - Principal of Iganga School of Nursing and Midwifery" class="history-image">
                        <div class="history-card-content">
                            <h3 class="history-card-title">School Leadership</h3>
                            <p class="history-card-description">
                                Sr. Edith Mwebaza, the dedicated principal leading our institution
                            </p>
                            <div class="history-badges">
                                <span class="history-badge">Leadership</span>
                                <span class="history-badge">Excellence</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Vision Section -->
        <section class="section">
            <div class="vision-section">
                <div class="vision-content">
                    <h2 class="vision-title">Looking Forward</h2>
                    <p class="vision-text">
                        As we continue our journey, we remain committed to our founding vision of producing world-class 
                        healthcare professionals. Our history has taught us the value of perseverance, quality education, 
                        and community service. We look forward to continuing our growth and making even greater contributions 
                        to healthcare in Uganda and beyond.
                    </p>
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

        // Animate timeline items on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.timeline-item').forEach(item => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(30px)';
            item.style.transition = 'all 0.6s ease';
            observer.observe(item);
        });
    </script>
</body>
</html>


