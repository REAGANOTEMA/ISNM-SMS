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
    <link rel="stylesheet" href="assets/modern-theme.css">
    <link rel="stylesheet" href="assets/css/image-animations.css">
    <style>
        /* CSS Reset & Base */
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
            
            /* Border Radius */
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            --radius-2xl: 1.5rem;
            --radius-full: 9999px;
            
            /* Typography Scale */
            --text-xs: 0.75rem;
            --text-sm: 0.875rem;
            --text-base: 1rem;
            --text-lg: 1.125rem;
            --text-xl: 1.25rem;
            --text-2xl: 1.5rem;
            --text-3xl: 1.875rem;
            --text-4xl: 2.25rem;
            --text-5xl: 3rem;
            
            /* Spacing Scale */
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
        }

        /* Base Typography & Body */
        html {
            scroll-behavior: smooth;
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

        /* Premium Navigation System */
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

        @keyframes navbarShine {
            0%, 100% {
                transform: translateX(-100%);
            }
            50% {
                transform: translateX(100%);
            }
        }

        /* Premium Brand Banner */
        .brand-banner {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 40px;
            background: var(--gradient-hero);
            border-bottom: 1px solid var(--border-light);
            z-index: 1002;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            transform-style: preserve-3d;
        }

        .brand-marquee {
            display: inline-flex;
            align-items: center;
            gap: 3rem;
            white-space: nowrap;
            animation: marquee 18s linear infinite;
            font-weight: 700;
            letter-spacing: 1px;
            color: var(--text-inverse);
            font-size: var(--text-sm);
            transform: perspective(1000px) rotateX(0deg);
            line-height: 1;
            margin: 0;
            padding: 0;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }

        @keyframes marquee {
            0% { 
                transform: translateX(0) perspective(1000px) rotateX(2deg); 
            }
            100% { 
                transform: translateX(-100%) perspective(1000px) rotateX(2deg); 
            }
        }

        /* Fixed Header Container */
        .fixed-header {
            position: relative;
            z-index: 1000;
            width: 100%;
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            box-shadow: var(--shadow-xl);
            border-bottom-color: var(--border-light);
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

        /* Premium Programs Overview */
        .programs-overview {
            background: var(--bg-primary);
            border-radius: var(--radius-2xl);
            padding: var(--space-12);
            box-shadow: var(--shadow-xl);
            border: 1px solid var(--border-light);
            margin-bottom: var(--space-12);
            text-align: center;
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
        }

        .programs-overview::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-gold);
            animation: overviewShine 3s ease-in-out infinite;
        }

        @keyframes overviewShine {
            0%, 100% { opacity: 0.6; }
            50% { opacity: 1; }
        }

        .overview-text {
            font-size: var(--text-xl);
            line-height: 1.8;
            color: var(--text-primary);
            margin-bottom: var(--space-8);
            transform: translateZ(10px);
        }

        .programs-count {
            display: flex;
            justify-content: center;
            gap: var(--space-12);
            flex-wrap: wrap;
            margin-top: var(--space-8);
        }

        .count-item {
            text-align: center;
            padding: var(--space-6);
            background: var(--bg-secondary);
            border-radius: var(--radius-xl);
            border: 1px solid var(--border-light);
            transition: all var(--transition-normal);
            transform-style: preserve-3d;
            min-width: 150px;
        }

        .count-item:hover {
            transform: translateY(-8px) translateZ(10px) scale(1.05);
            box-shadow: var(--shadow-xl);
            background: var(--gradient-gold);
        }

        .count-number {
            font-family: 'Playfair Display', serif;
            font-size: var(--text-5xl);
            font-weight: 900;
            color: var(--accent-blue);
            display: block;
            margin-bottom: var(--space-2);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .count-item:hover .count-number {
            color: var(--text-inverse);
        }

        .count-label {
            color: var(--text-secondary);
            font-size: var(--text-base);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .count-item:hover .count-label {
            color: var(--text-inverse);
        }

        /* Premium Programs Grid */
        .programs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
            gap: var(--space-8);
            margin-top: var(--space-12);
        }

        .program-card {
            background: var(--bg-primary);
            border-radius: var(--radius-2xl);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-light);
            transition: all var(--transition-slow);
            position: relative;
            transform-style: preserve-3d;
            transform: translateZ(0);
        }

        .program-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, transparent 0%, rgba(255, 215, 0, 0.1) 100%);
            opacity: 0;
            transition: opacity var(--transition-normal);
            pointer-events: none;
            z-index: 1;
        }

        .program-card:hover {
            transform: translateY(-12px) translateZ(20px) rotateX(2deg);
            box-shadow: var(--shadow-2xl);
        }

        .program-card:hover::before {
            opacity: 1;
        }

        .program-header {
            background: var(--gradient-primary);
            color: var(--text-inverse);
            padding: var(--space-8);
            text-align: center;
            position: relative;
            z-index: 2;
            transform-style: preserve-3d;
        }

        .program-header.certificate {
            background: var(--gradient-success);
        }

        .program-header.diploma {
            background: var(--gradient-secondary);
        }

        .program-header::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 70% 70%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        .program-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: var(--radius-full);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: var(--text-3xl);
            margin: 0 auto var(--space-4);
            box-shadow: var(--shadow-lg);
            transform: translateZ(10px);
            transition: all var(--transition-normal);
        }

        .program-card:hover .program-icon {
            transform: translateZ(20px) scale(1.1) rotateY(10deg);
            box-shadow: var(--shadow-glow);
        }

        .program-title {
            font-family: 'Playfair Display', serif;
            font-size: var(--text-3xl);
            font-weight: 800;
            margin-bottom: var(--space-2);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            transform: translateZ(5px);
        }

        .program-type {
            font-size: var(--text-lg);
            opacity: 0.9;
            font-weight: 500;
            transform: translateZ(3px);
        }

        .program-image {
            position: relative;
            overflow: hidden;
            height: 220px;
            z-index: 1;
        }

        .program-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all var(--transition-slow);
            transform: scale(1);
        }

        .program-card:hover .program-img {
            transform: scale(1.15) rotate(2deg);
            filter: brightness(1.1);
        }

        .program-content {
            padding: var(--space-8);
            position: relative;
            z-index: 2;
            background: var(--bg-primary);
        }

        .program-description {
            color: var(--text-primary);
            font-size: var(--text-lg);
            line-height: 1.7;
            margin-bottom: var(--space-6);
            transform: translateZ(5px);
        }

        .program-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: var(--space-4) 0;
            border-top: 1px solid var(--border-light);
            margin-top: var(--space-4);
        }

        .duration {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            color: var(--text-secondary);
            font-weight: 600;
            transform: translateZ(5px);
        }

        .duration i {
            color: var(--accent-blue);
            font-size: var(--text-lg);
        }

        .apply-btn {
            background: var(--gradient-gold);
            color: var(--text-primary);
            border: none;
            padding: var(--space-3) var(--space-6);
            border-radius: var(--radius-full);
            font-weight: 700;
            cursor: pointer;
            transition: all var(--transition-normal);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: var(--space-2);
            font-size: var(--text-sm);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: var(--shadow-md);
            transform: translateZ(5px);
            position: relative;
            overflow: hidden;
        }

        .apply-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left var(--transition-normal);
        }

        .apply-btn:hover {
            transform: translateY(-4px) translateZ(10px) scale(1.05);
            box-shadow: var(--shadow-xl);
        }

        .apply-btn:hover::before {
            left: 100%;
        }

        /* Premium Program Features */
        .program-features {
            background: var(--bg-secondary);
            border-radius: var(--radius-xl);
            padding: var(--space-6);
            margin-top: var(--space-6);
            border: 1px solid var(--border-light);
            position: relative;
            overflow: hidden;
        }

        .program-features::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--gradient-primary);
            opacity: 0.6;
        }

        .feature-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: var(--space-4);
            margin-top: var(--space-4);
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            color: var(--text-primary);
            padding: var(--space-2);
            border-radius: var(--radius-md);
            transition: all var(--transition-fast);
            transform: translateZ(0);
        }

        .feature-item:hover {
            background: var(--bg-tertiary);
            transform: translateZ(5px) translateX(4px);
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            background: var(--gradient-primary);
            border-radius: var(--radius-full);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-inverse);
            font-size: var(--text-sm);
            flex-shrink: 0;
            box-shadow: var(--shadow-md);
            transform: translateZ(5px);
            transition: all var(--transition-normal);
        }

        .feature-item:hover .feature-icon {
            transform: translateZ(10px) scale(1.1) rotateY(15deg);
            box-shadow: var(--shadow-glow);
        }

        /* Admission requirements */
        .requirements-section {
            background: var(--bg-primary);
            border-radius: var(--radius-2xl);
            padding: var(--space-12);
            box-shadow: var(--shadow-xl);
            border: 1px solid var(--border-light);
            margin-top: var(--space-12);
        }

        .requirements-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: var(--space-8);
            margin-top: var(--space-8);
        }

        .requirement-card {
            background: var(--bg-secondary);
            border-radius: var(--radius-xl);
            padding: var(--space-8);
            border: 1px solid var(--border-light);
        }

        .requirement-title {
            font-family: 'Playfair Display', serif;
            font-size: var(--text-2xl);
            font-weight: 700;
            color: var(--accent-blue);
            margin-bottom: var(--space-4);
        }

        .requirement-list {
            list-style: none;
        }

        .requirement-list li {
            display: flex;
            align-items: flex-start;
            gap: var(--space-3);
            padding: var(--space-3) 0;
            border-bottom: 1px solid var(--border-light);
            color: var(--text-primary);
        }

        .requirement-list li:last-child {
            border-bottom: none;
        }

        .requirement-list li i {
            color: var(--success-green);
            margin-top: var(--space-1);
            flex-shrink: 0;
        }

        /* Career Opportunities */
        .careers-section {
            background: var(--gradient-primary);
            color: var(--text-inverse);
            border-radius: var(--radius-2xl);
            padding: var(--space-12);
            margin-top: var(--space-12);
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
            font-size: var(--text-3xl);
            font-weight: 700;
            margin-bottom: var(--space-8);
            text-align: center;
        }

        .careers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: var(--space-6);
        }

        .career-item {
            background: rgba(255, 255, 255, 0.1);
            border-radius: var(--radius-lg);
            padding: var(--space-6);
            text-align: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .career-icon {
            font-size: var(--text-3xl);
            margin-bottom: var(--space-4);
        }

        .career-title {
            font-weight: 600;
            margin-bottom: var(--space-2);
        }

        /* Premium Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            background: var(--gradient-primary);
            border: 2px solid var(--accent-light-blue);
            width: 50px;
            height: 50px;
            border-radius: var(--radius-lg);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all var(--transition-normal);
            transform-style: preserve-3d;
            transform: translateZ(0);
            box-shadow: var(--shadow-md);
        }

        .mobile-menu-toggle::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 24px;
            height: 2px;
            background: var(--text-inverse);
            transform: translate(-50%, -50%);
            transition: all var(--transition-normal);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        .mobile-menu-toggle::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 24px;
            height: 2px;
            background: var(--text-inverse);
            transform: translate(-50%, -50%) rotate(90deg);
            transition: all var(--transition-normal);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        .mobile-menu-toggle:hover {
            transform: translateY(-4px) translateZ(10px) rotateX(-2deg);
            box-shadow: var(--shadow-xl);
            background: var(--gradient-secondary);
        }

        .mobile-menu-toggle.active::before {
            transform: translate(-50%, -50%) rotate(45deg);
            background: var(--accent-gold);
        }

        .mobile-menu-toggle.active::after {
            transform: translate(-50%, -50%) rotate(-45deg);
            background: var(--accent-gold);
        }

        /* Premium Navigation Dropdown */
        .nav-dropdown {
            position: relative;
        }

        .nav-dropdown-toggle {
            display: flex;
            align-items: center;
            gap: var(--space-1);
            cursor: pointer;
            transform-style: preserve-3d;
        }

        .nav-dropdown-toggle::after {
            content: '▼';
            font-size: var(--text-xs);
            transition: all var(--transition-normal);
            color: var(--text-secondary);
            transform: translateZ(2px);
        }

        .nav-dropdown:hover .nav-dropdown-toggle::after {
            transform: translateZ(2px) rotate(180deg);
            color: var(--accent-blue);
        }

        .nav-dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            background: var(--bg-primary);
            border: 2px solid var(--accent-light-blue);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-xl);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px) translateZ(-20px);
            transition: all var(--transition-normal);
            min-width: 200px;
            z-index: 1000;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .nav-dropdown:hover .nav-dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) translateZ(10px);
        }

        .nav-dropdown-menu a {
            display: block;
            padding: var(--space-3) var(--space-4);
            color: var(--text-primary);
            text-decoration: none;
            font-weight: 600;
            font-size: var(--text-sm);
            transition: all var(--transition-fast);
            border-bottom: 1px solid transparent;
            transform-style: preserve-3d;
            transform: translateZ(0);
            position: relative;
            overflow: hidden;
        }

        .nav-dropdown-menu a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            right: 0;
            bottom: 0;
            background: var(--gradient-primary);
            transition: left var(--transition-fast);
            z-index: -1;
        }

        .nav-dropdown-menu a:hover {
            color: var(--text-inverse);
            transform: translateX(8px) translateZ(5px);
        }

        .nav-dropdown-menu a:hover::before {
            left: 0;
        }

        .nav-dropdown-menu a:first-child {
            border-radius: var(--radius-xl) var(--radius-xl) 0 0;
        }

        .nav-dropdown-menu a:last-child {
            border-radius: 0 0 var(--radius-xl) var(--radius-xl);
        }

        /* Premium Responsive Design */
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
                background: var(--bg-primary);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                flex-direction: column;
                gap: 0;
                padding: var(--space-4);
                box-shadow: var(--shadow-2xl);
                border-top: 2px solid var(--accent-light-blue);
                z-index: 999;
                transform: translateY(-100%);
                transition: all var(--transition-normal);
                max-height: 70vh;
                overflow-y: auto;
            }

            .nav-links.active {
                display: flex;
                transform: translateY(0);
            }

            .nav-link {
                width: 100%;
                padding: var(--space-4);
                border-radius: var(--radius-md);
                border-bottom: 1px solid var(--border-light);
                text-align: center;
                font-size: var(--text-base);
                margin-bottom: var(--space-2);
            }

            .nav-link:last-child {
                border-bottom: none;
                margin-bottom: 0;
            }

            .nav-dropdown-menu {
                position: static;
                background: var(--bg-secondary);
                box-shadow: none;
                border: 1px solid var(--border-light);
                border-radius: var(--radius-lg);
                transform: none;
                opacity: 1;
                visibility: visible;
                display: none;
                margin-top: var(--space-2);
                min-width: auto;
                padding: var(--space-2);
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
                color: var(--text-primary);
                border-radius: var(--radius-md);
                margin-bottom: var(--space-1);
            }

            .nav-dropdown-menu a:last-child {
                margin-bottom: 0;
                border-bottom: none;
            }

            .nav-dropdown-menu a:hover {
                background: var(--gradient-primary);
                color: var(--text-inverse);
                transform: none;
            }

            .navbar {
                padding: var(--space-4);
            }

            .nav-container {
                flex-wrap: wrap;
                position: relative;
                padding: 0 var(--space-4);
            }

            .nav-logo {
                font-size: var(--text-xl);
                gap: var(--space-3);
            }

            .nav-logo img {
                width: 50px;
                height: 50px;
            }
            
            .page-title {
                font-size: var(--text-3xl);
            }
            
            .section-title {
                font-size: var(--text-3xl);
            }
            
            .programs-grid {
                grid-template-columns: 1fr;
                gap: var(--space-6);
            }
            
            .programs-count {
                gap: var(--space-6);
                flex-direction: column;
                align-items: center;
            }
            
            .count-item {
                width: 100%;
                max-width: 200px;
            }
            
            .requirements-grid {
                grid-template-columns: 1fr;
                gap: var(--space-6);
            }
            
            .main-content {
                padding: var(--space-16) var(--space-4);
            }
            
            .program-card {
                margin-bottom: var(--space-6);
            }
        }
        /* Premium Footer Styling */
        .footer {
            background: var(--gradient-primary);
            color: var(--text-inverse);
            padding: var(--space-20) var(--space-8) var(--space-8);
            margin-top: var(--space-24);
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            animation: footerFloat 25s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes footerFloat {
            0%, 100% { transform: translateX(0) translateY(0); }
            33% { transform: translateX(10px) translateY(-5px); }
            66% { transform: translateX(-10px) translateY(5px); }
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: var(--space-8);
            margin-bottom: var(--space-12);
        }

        .footer-section h3 {
            font-size: var(--text-xl);
            font-weight: 800;
            margin-bottom: var(--space-6);
            color: var(--accent-gold);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            transform: translateZ(10px);
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: var(--space-4);
            transform: translateZ(5px);
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: all var(--transition-normal);
            display: inline-flex;
            align-items: center;
            gap: var(--space-2);
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .footer-links a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 215, 0, 0.3), transparent);
            transition: left var(--transition-normal);
        }

        .footer-links a:hover {
            color: var(--accent-gold);
            transform: translateX(8px) translateZ(5px);
        }

        .footer-links a:hover::before {
            left: 100%;
        }

        .contact-info p {
            margin-bottom: var(--space-4);
            color: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            gap: var(--space-3);
            font-weight: 500;
            transform: translateZ(5px);
        }

        .contact-info i {
            color: var(--accent-gold);
            width: 20px;
            font-size: var(--text-lg);
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }

        .footer-bottom {
            text-align: center;
            padding-top: var(--space-8);
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            z-index: 2;
        }

        .footer-title {
            font-size: var(--text-2xl);
            font-weight: 800;
            margin-bottom: var(--space-4);
            color: var(--accent-gold);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            transform: translateZ(10px);
        }

        .footer-subtitle {
            font-size: var(--text-lg);
            margin-bottom: var(--space-8);
            opacity: 0.9;
            transform: translateZ(5px);
        }

        .footer-buttons {
            display: flex;
            justify-content: center;
            gap: var(--space-4);
            flex-wrap: wrap;
            margin-bottom: var(--space-8);
        }

        .whatsapp-btn {
            display: inline-flex;
            align-items: center;
            gap: var(--space-2);
            background: #25d366;
            color: var(--text-inverse);
            padding: var(--space-4) var(--space-8);
            border-radius: var(--radius-xl);
            text-decoration: none;
            font-weight: 700;
            transition: all var(--transition-normal);
            font-size: var(--text-base);
            box-shadow: var(--shadow-lg);
            transform: translateZ(5px);
            position: relative;
            overflow: hidden;
        }

        .whatsapp-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left var(--transition-normal);
        }

        .whatsapp-btn:hover {
            background: #128c7e;
            transform: translateY(-4px) translateZ(10px) scale(1.05);
            box-shadow: var(--shadow-xl);
        }

        .whatsapp-btn:hover::before {
            left: 100%;
        }

        .copyright {
            margin-top: var(--space-8);
            padding-top: var(--space-8);
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            color: rgba(255, 255, 255, 0.7);
            font-weight: 500;
            transform: translateZ(5px);
        }

        @media (max-width: 768px) {
            .footer {
                padding: var(--space-16) var(--space-4) var(--space-8);
            }

            .footer-grid {
                gap: var(--space-6);
                grid-template-columns: 1fr;
            }

            .footer-buttons {
                flex-direction: column;
                align-items: center;
            }

            .whatsapp-btn {
                width: 100%;
                justify-content: center;
                max-width: 300px;
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
                            <a href="programs.php#requirements">requirements</a>
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
                <p class="section-subtitle">Comprehensive healthcare education programs designed for Excellence</p>
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
                        <img src="assets/images/academic/certificate-in-nursing-students-in-examination-room.jpg" alt="Certificate in Nursing Students in Examination Room" class="program-img">
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
                        <img src="assets/images/academic/students-in-skill-laboratory-in-practical-training.jpg" alt="ISNM Midwifery Students - Advanced Practical Training" class="program-img">
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
                        <img src="assets/images/academic/diploma-in-nursing-and-midwifery-extension-images-for-students.jpg" alt="ISNM Diploma Nursing Students - Advanced Clinical Training" class="program-img">
                    </div>
                    <div class="program-content">
                        <p class="program-description">
                            Advanced nursing program building on certificate foundation with specialized 
                            clinical skills, leadership training, and comprehensive patient care management.
                        </p>
                        <div class="program-features">
                            <h4>Key Features:</h4>
                            <div class="feature-list">
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="fas fa-user-tie"></i>
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
                        <img src="assets/images/academic/student-at-practicum-site2.jpg" alt="ISNM Students - Clinical Practicum Experience" class="program-img">
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

        <!-- Admission requirements -->
        <section class="section">
            <div class="requirements-section">
                <div class="section-header">
                    <h2 class="section-title">Admission requirements</h2>
                    <p class="section-subtitle">requirements for certificate and diploma programs</p>
                </div>
                
                <div class="requirements-grid">
                    <!-- Certificate requirements -->
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
                    
                    <!-- Diploma requirements -->
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
    </script>

    <!-- Premium Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-grid">
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                        <li><a href="programs.php"><i class="fas fa-graduation-cap"></i> Programs</a></li>
                        <li><a href="about.php"><i class="fas fa-info-circle"></i> About Us</a></li>
                        <li><a href="application.php"><i class="fas fa-edit"></i> Apply Now</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Academics</h3>
                    <ul class="footer-links">
                        <li><a href="programs.php#certificate"><i class="fas fa-certificate"></i> Certificate Programs</a></li>
                        <li><a href="programs.php#diploma"><i class="fas fa-medal"></i> Diploma Programs</a></li>
                        <li><a href="activities.php"><i class="fas fa-users"></i> Student Activities</a></li>
                        <li><a href="infrastructure.php"><i class="fas fa-building"></i> Infrastructure</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Contact Info</h3>
                    <div class="contact-info">
                        <p><i class="fas fa-map-marker-alt"></i> Iganga Municipality, Uganda</p>
                        <p><i class="fas fa-phone"></i> +256 123 456 789</p>
                        <p><i class="fas fa-envelope"></i> info@isnm.ac.ug</p>
                        <p><i class="fas fa-clock"></i> Mon-Fri: 8:00 AM - 5:00 PM</p>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <h3 class="footer-title">Iganga School of Nursing & Midwifery</h3>
                <p class="footer-subtitle">Excellence in Healthcare Education Since 1982</p>
                <div class="footer-buttons">
                    <a href="https://wa.me/256123456789" class="whatsapp-btn" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                        Chat on WhatsApp
                    </a>
                </div>
                <div class="copyright">
                    <p>&copy; 2024 Iganga School of Nursing & Midwifery. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>


