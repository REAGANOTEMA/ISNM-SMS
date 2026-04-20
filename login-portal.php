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
    <title>Student Portal - Iganga School of Nursing and Midwifery</title>
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

        /* Portal Login Section */
        .portal-login-section {
            padding: var(--space-20) 0;
            position: relative;
        }

        .section-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 var(--space-8);
            position: relative;
        }

        .section-header {
            text-align: center;
            margin-bottom: var(--space-12);
            position: relative;
        }

        .section-badge {
            display: inline-flex;
            align-items: center;
            gap: var(--space-2);
            background: var(--gradient-gold);
            color: var(--text-primary);
            padding: var(--space-2) var(--space-4);
            border-radius: var(--radius-full);
            font-weight: 600;
            font-size: var(--text-sm);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            box-shadow: var(--shadow-glow-gold);
            margin-bottom: var(--space-4);
            animation: badgePulse 2s ease-in-out infinite;
        }

        @keyframes badgePulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
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

        .section-subtitle {
            color: var(--text-secondary);
            font-size: var(--text-lg);
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.7;
            transform: translateZ(5px);
        }

        /* Login Form Container */
        .login-form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: var(--space-8) 0;
        }

        .login-card {
            background: var(--bg-primary);
            border-radius: var(--radius-2xl);
            box-shadow: var(--shadow-xl);
            border: 1px solid var(--border-light);
            overflow: hidden;
            width: 100%;
            max-width: 480px;
            position: relative;
            transform-style: preserve-3d;
            transform: translateZ(0);
            transition: all var(--transition-normal);
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
            box-shadow: var(--shadow-glow);
        }

        .login-card:hover {
            transform: translateY(-8px) translateZ(20px);
            box-shadow: var(--shadow-2xl);
        }

        .login-header {
            text-align: center;
            padding: var(--space-8) var(--space-6) var(--space-6);
            background: linear-gradient(135deg, var(--bg-secondary) 0%, var(--bg-primary) 100%);
            border-bottom: 1px solid var(--border-light);
            position: relative;
        }

        .login-icon {
            width: 80px;
            height: 80px;
            border-radius: var(--radius-full);
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto var(--space-4);
            color: var(--white);
            font-size: 2rem;
            box-shadow: var(--shadow-lg);
            position: relative;
            overflow: hidden;
        }

        .login-icon::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.1) 50%, transparent 70%);
            animation: iconShine 3s ease-in-out infinite;
        }

        @keyframes iconShine {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .login-title {
            font-family: 'Playfair Display', serif;
            font-size: var(--text-2xl);
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: var(--space-2);
        }

        .login-subtitle {
            color: var(--text-secondary);
            font-size: var(--text-sm);
            margin-bottom: 0;
        }

        /* Login Form Elements */
        .login-form {
            padding: var(--space-8) var(--space-6);
        }

        .form-group {
            margin-bottom: var(--space-6);
            position: relative;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            font-weight: 600;
            color: var(--text-primary);
            font-size: var(--text-sm);
            margin-bottom: var(--space-2);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .form-label i {
            color: var(--accent-blue);
            font-size: var(--text-base);
            width: 20px;
            text-align: center;
        }

        .form-input {
            width: 100%;
            padding: var(--space-4) var(--space-4) var(--space-4) calc(var(--space-4) + 24px);
            border: 2px solid var(--border-light);
            border-radius: var(--radius-lg);
            font-size: var(--text-base);
            font-family: 'Inter', sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            transition: all var(--transition-normal);
            box-shadow: var(--shadow-sm);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--accent-blue);
            box-shadow: var(--shadow-glow), var(--shadow-md);
            transform: translateY(-2px);
        }

        .form-input::placeholder {
            color: var(--text-muted);
            font-style: italic;
        }

        .password-input-container {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: var(--space-3);
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            font-size: var(--text-lg);
            transition: all var(--transition-fast);
            padding: var(--space-1);
        }

        .password-toggle:hover {
            color: var(--accent-blue);
        }

        .form-select {
            width: 100%;
            padding: var(--space-4);
            border: 2px solid var(--border-light);
            border-radius: var(--radius-lg);
            font-size: var(--text-base);
            font-family: 'Inter', sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            transition: all var(--transition-normal);
            box-shadow: var(--shadow-sm);
            cursor: pointer;
        }

        .form-select:focus {
            outline: none;
            border-color: var(--accent-blue);
            box-shadow: var(--shadow-glow), var(--shadow-md);
            transform: translateY(-2px);
        }

        .form-actions {
            display: flex;
            flex-direction: column;
            gap: var(--space-4);
            margin-top: var(--space-8);
        }

        .login-button {
            background: var(--gradient-primary);
            color: var(--white);
            border: none;
            border-radius: var(--radius-lg);
            padding: var(--space-4) var(--space-6);
            font-size: var(--text-lg);
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all var(--transition-normal);
            box-shadow: var(--shadow-lg);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            transform: translateZ(0);
        }

        .login-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left var(--transition-slow);
        }

        .login-button:hover {
            transform: translateY(-3px) translateZ(10px);
            box-shadow: var(--shadow-xl), var(--shadow-glow);
            background: var(--gradient-secondary);
        }

        .login-button:hover::before {
            left: 100%;
        }

        .login-button:active {
            transform: translateY(-1px) translateZ(5px);
        }

        .forgot-password {
            text-align: center;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: var(--text-sm);
            transition: all var(--transition-fast);
            padding: var(--space-2);
            border-radius: var(--radius-md);
        }

        .forgot-password:hover {
            color: var(--accent-blue);
            background: var(--bg-secondary);
            transform: translateX(4px);
        }

        .login-footer {
            padding: var(--space-6) var(--space-8);
            background: var(--bg-secondary);
            border-top: 1px solid var(--border-light);
        }

        .login-help {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            color: var(--text-secondary);
            font-size: var(--text-sm);
            margin-bottom: var(--space-4);
            font-weight: 500;
        }

        .login-help i {
            color: var(--accent-gold);
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: var(--space-2);
        }

        .contact-info p {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            color: var(--text-secondary);
            font-size: var(--text-sm);
            margin: 0;
        }

        .contact-info i {
            color: var(--accent-blue);
            width: 16px;
            text-align: center;
        }

        .more-staff-indicator {
            text-align: center;
            margin: 2rem 0;
            padding: 1rem;
            background: linear-gradient(145deg, var(--cream-white), var(--white));
            border-radius: 12px;
            border: 1px dashed var(--primary-blue);
            color: var(--primary-blue);
            font-weight: 600;
            font-size: 0.9rem;
        }

        .org-box {
            background: var(--luxury-white);
            border: 1px solid var(--border-3d-light);
            border-radius: 12px;
            padding: 0.8rem;
            min-width: 140px;
            max-width: 160px;
            box-shadow: var(--shadow-3d-sm);
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            text-align: center;
            overflow: hidden;
            transform-style: preserve-3d;
            transform: translateZ(0);
        }

        .org-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--gradient-3d-primary);
            border-radius: 12px;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }

        .org-box:hover {
            transform: translateY(-3px) translateZ(15px) rotateX(2deg);
            box-shadow: var(--shadow-3d-lg);
            border-color: var(--medical-primary);
        }

        .org-box:hover::before {
            opacity: 0.1;
        }

        
        .org-box.root {
            border: 3px solid var(--golden-yellow);
            background: linear-gradient(145deg, var(--white), var(--creamy-yellow));
            box-shadow: var(--shadow-2xl), 0 0 30px rgba(251,191,36,0.4);
            transform: scale(1.08) translateZ(10px);
            position: relative;
        }

        .org-box.root::before {
            height: 6px;
            background: linear-gradient(90deg, var(--golden-yellow), var(--warm-yellow), var(--golden-yellow));
            transform: scaleX(1);
        }

        .org-box.executive {
            border: 2.5px solid var(--primary-blue);
            background: linear-gradient(145deg, var(--white), var(--light-gray));
            transform: scale(1.05) translateZ(5px);
            box-shadow: var(--shadow-xl), 0 0 20px rgba(37,99,235,0.3);
        }

        .org-box.management {
            border: 2px solid var(--light-green);
            background: linear-gradient(145deg, var(--white), var(--soft-gray));
            transform: scale(1.02) translateZ(3px);
            box-shadow: var(--shadow-lg), 0 0 15px rgba(74,222,128,0.2);
        }

        .org-box.operational {
            border: 1.5px solid var(--text-muted);
            background: linear-gradient(145deg, var(--white), var(--light-gray));
            transform: translateZ(2px);
            box-shadow: var(--shadow-md);
        }

        .org-box:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-clean-md);
            border-color: var(--school-primary);
        }

        .org-box:hover::before {
            transform: scaleX(1);
        }

        .org-box:hover::after {
            transform: translateX(100%);
        }

        .org-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin: 0 auto 1rem;
            color: var(--luxury-gold-deep);
            background: var(--gradient-cream);
            box-shadow: var(--shadow-glass);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            transform: translateZ(0);
        }

        .org-icon::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.6), transparent);
            transition: left 0.6s ease;
        }

        .org-icon::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: radial-gradient(circle, rgba(255,255,255,0.4) 0%, transparent 70%);
            transform: translate(-50%, -50%);
            transition: all 0.4s ease;
            border-radius: 50%;
        }

        .org-box:hover .org-icon {
            transform: scale(1.1);
            box-shadow: var(--shadow-xl), 0 0 25px rgba(251, 191, 36, 0.4);
        }

        .org-box:hover .org-icon::before {
            left: 100%;
        }

        .org-box:hover .org-icon::after {
            width: 100%;
            height: 100%;
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
                position: fixed;
                top: 40px;
                left: 0;
                right: 0;
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(20px);
                flex-direction: column;
                padding: var(--space-8);
                gap: var(--space-4);
                box-shadow: var(--shadow-xl);
                transform: translateY(-100%);
                transition: transform var(--transition-normal);
                z-index: 999;
            }

            .nav-links.active {
                transform: translateY(0);
            }

            .nav-dropdown-menu {
                position: static;
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
                box-shadow: none;
                border: none;
                background: transparent;
                padding-left: var(--space-8);
            }

            .mobile-menu-toggle {
                display: flex;
            }

            .page-header-section {
                padding: calc(var(--space-20) + 80px) 0 var(--space-12);
            }

            .page-title {
                font-size: var(--text-3xl);
            }

            .section-title {
                font-size: var(--text-2xl);
            }

            .login-form-container {
                padding: var(--space-4) 0;
            }

            .login-card {
                max-width: 100%;
                margin: 0 var(--space-4);
            }

            .form-input {
                padding: var(--space-3) var(--space-4) var(--space-3) calc(var(--space-4) + 24px);
            }
        }

        @media (max-width: 480px) {
            .nav-logo {
                font-size: var(--text-xl);
            }

            .nav-logo img {
                width: 48px;
                height: 48px;
            }

            .page-title {
                font-size: var(--text-2xl);
            }

            .section-title {
                font-size: var(--text-xl);
            }

            .login-icon {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }

            .form-input {
                font-size: var(--text-sm);
            }
        }

        .connection-lines {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            z-index: -1;
        }

        .vertical-line {
            position: absolute;
            background: linear-gradient(to bottom, var(--primary-blue), var(--secondary-blue));
            width: 3px;
            border-radius: 2px;
            box-shadow: 0 0 10px rgba(30, 58, 138, 0.3);
        }

        .horizontal-line {
            position: absolute;
            background: linear-gradient(to right, var(--primary-blue), var(--secondary-blue));
            height: 3px;
            border-radius: 2px;
            box-shadow: 0 0 10px rgba(30, 58, 138, 0.3);
        }

        .arrow-line {
            position: absolute;
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            border-radius: 2px;
            box-shadow: 0 0 15px rgba(30, 58, 138, 0.4);
        }

        .arrow-line::after {
            content: '';
            position: absolute;
            width: 0;
            height: 0;
            border-left: 8px solid var(--secondary-blue);
            border-top: 6px solid transparent;
            border-bottom: 6px solid transparent;
        }

        .director-to-principal {
            top: 140px;
            left: 50%;
            transform: translateX(-50%);
            width: 3px;
            height: 40px;
        }

        .director-to-principal::after {
            bottom: -10px;
            left: -5.5px;
        }

        .principal-to-deputy {
            top: 280px;
            left: 50%;
            transform: translateX(-50%);
            width: 3px;
            height: 40px;
        }

        .principal-to-deputy::after {
            bottom: -10px;
            left: -5.5px;
        }

        .deputy-to-hr {
            top: 420px;
            left: 20%;
            width: 3px;
            height: 60px;
        }

        .deputy-to-hr::after {
            bottom: -12px;
            left: -6.5px;
        }

        .deputy-to-academic {
            top: 420px;
            left: 35%;
            width: 3px;
            height: 60px;
        }

        .deputy-to-academic::after {
            bottom: -12px;
            left: -6.5px;
        }

        .deputy-to-bursar {
            top: 420px;
            left: 50%;
            width: 3px;
            height: 60px;
        }

        .deputy-to-bursar::after {
            bottom: -12px;
            left: -6.5px;
        }

        .deputy-to-secretary {
            top: 420px;
            left: 65%;
            width: 3px;
            height: 60px;
        }

        .deputy-to-secretary::after {
            bottom: -12px;
            left: -6.5px;
        }

        .level-1-to-2 {
            top: 140px;
            left: 0;
            right: 0;
            height: 60px;
        }

        .level-2-to-3 {
            top: 280px;
            left: 0;
            right: 0;
            height: 60px;
        }

        .level-3-to-4 {
            top: 420px;
            left: 0;
            right: 0;
            height: 60px;
        }

        .communication-flow {
            position: absolute;
            bottom: -2.5rem;
            left: 50%;
            transform: translateX(-50%);
            background: var(--gradient-primary);
            color: white;
            padding: 0.4rem 0.8rem;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 800;
            white-space: nowrap;
            box-shadow: var(--shadow-luxury);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            border: 1px solid var(--luxury-gold-light);
            transition: all 0.3s ease;
        }

        .org-box:hover .communication-flow {
            transform: translateX(-50%) translateY(-3px);
            box-shadow: var(--shadow-lg);
            background: var(--gradient-tertiary);
            color: var(--primary-blue);
        }

        .org-legend {
            display: flex;
            justify-content: center;
            gap: 2.5rem;
            margin: 4rem 0 2rem;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(10px);
            border-radius: 50px;
            border: 1px solid var(--luxury-gold-light);
            box-shadow: var(--shadow-luxury);
            position: relative;
            overflow: hidden;
        }

        .org-legend::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: var(--gradient-gold);
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }

        .org-legend::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><defs><pattern id="legend-pattern" width="30" height="30" patternUnits="userSpaceOnUse"><circle cx="15" cy="15" r="2" fill="var(--golden-yellow)" opacity="0.1"/><path d="M8 15 Q15 8, 22 15 T37 15" stroke="var(--primary-blue)" stroke-width="1" fill="none" opacity="0.15"/></pattern></defs><rect width="200" height="200" fill="url(%23legend-pattern)"/></svg>'),
                linear-gradient(135deg, transparent 40%, rgba(255,255,255,0.2) 50%, transparent 60%);
            background-size: 60px 60px, cover;
            background-position: 0 0, center;
            pointer-events: none;
            animation: legendPatternFloat 8s ease-in-out infinite;
        }

        /* Footer Styling */
        .footer {
            background: var(--gradient-primary);
            color: var(--text-inverse);
            padding: var(--space-16) var(--space-8) var(--space-8);
            margin-top: var(--space-24);
            position: relative;
            transform-style: preserve-3d;
            box-shadow: var(--shadow-2xl);
            border-top: 4px solid var(--accent-gold);
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: var(--gradient-gold);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .footer::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><defs><pattern id="footer-pattern" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M10 20 Q20 10, 30 20 T50 20" stroke="white" stroke-width="2" fill="none" opacity="0.15"/><circle cx="10" cy="20" r="4" fill="white" opacity="0.2"/><circle cx="50" cy="20" r="4" fill="white" opacity="0.2"/></pattern></defs><rect width="200" height="200" fill="url(%23footer-pattern)"/></svg>'),
                linear-gradient(135deg, rgba(255,255,255,0.05) 0%, transparent 50%, rgba(251,191,36,0.05) 100%);
            background-size: 80px 80px, cover;
            background-position: 0 0, center;
            pointer-events: none;
            animation: footerPatternFloat 8s ease-in-out infinite;
        }

        @keyframes footerPatternFloat {
            0%, 100% {
                transform: translateY(0px);
                opacity: 0.3;
            }
            50% {
                transform: translateY(-3px);
                opacity: 0.6;
            }
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .footer-title {
            font-family: 'Copperplate Gothic Bold', 'Rockwell Extra Bold', serif;
            font-size: var(--text-2xl);
            font-weight: 900;
            margin-bottom: var(--space-4);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            animation: titleGlow 3s ease-in-out infinite alternate;
        }

        .footer-subtitle {
            font-size: var(--text-lg);
            margin-bottom: var(--space-8);
            opacity: 0.9;
        }

        .contact-buttons {
            display: flex;
            justify-content: center;
            gap: var(--space-4);
            flex-wrap: wrap;
            margin-bottom: var(--space-8);
        }

        .whatsapp-button {
            display: inline-flex;
            align-items: center;
            gap: var(--space-2);
            background: linear-gradient(145deg, #25d366, #128c7e);
            color: var(--white);
            text-decoration: none;
            border-radius: var(--radius-xl);
            font-weight: 700;
            font-size: var(--text-base);
            padding: var(--space-4) var(--space-6);
            transition: all var(--transition-normal);
            box-shadow: var(--shadow-lg);
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            transform: translateZ(0);
            border: 2px solid #25d366;
        }

        .whatsapp-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left var(--transition-slow);
        }

        .whatsapp-button:hover {
            transform: translateY(-6px) translateZ(20px);
            box-shadow: var(--shadow-xl), 0 0 30px rgba(37, 211, 102, 0.4);
            background: linear-gradient(145deg, #128c7e, #0e5f54);
            border-color: #128c7e;
        }

        .whatsapp-button:hover::before {
            left: 100%;
        }

        .whatsapp-button:active {
            transform: translateY(-3px) translateZ(10px);
        }

        
        
        
        
        
        
        
        
        
                
                
        .executive-level {
            border: 2px solid var(--primary-blue);
            background: linear-gradient(145deg, var(--white), var(--light-gray));
            transform: scale(1.02);
        }
        
        .management-level {
            border: 2px solid var(--light-green);
            background: linear-gradient(145deg, var(--white), var(--soft-gray));
        }

        .structure-section {
            background: linear-gradient(145deg, var(--cream-white), var(--white));
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: var(--shadow-lg), var(--shadow-inset);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            animation: fadeIn 0.8s ease-out;
            border: 2px solid transparent;
            transform-style: preserve-3d;
            transform: translateZ(0);
        }

        .auth-button-icon {
            font-size: 2.2rem;
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: iconPulse 2s ease-in-out infinite;
            position: relative;
        }

        .auth-button:hover .auth-button-icon {
            animation: iconRotate 1s ease-in-out;
            background: linear-gradient(135deg, var(--golden-yellow), var(--warm-yellow));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .auth-button-text {
            font-size: 0.9rem;
            font-weight: 700;
        }

        .auth-button-subtext {
            font-size: 0.7rem;
            opacity: 0.8;
            font-weight: 600;
        }

        @keyframes authButtonFloat {
            0%, 100% { 
                transform: translateY(0px) translateZ(0px) rotateX(0deg) rotateY(0deg); 
            }
            25% { 
                transform: translateY(-5px) translateZ(5px) rotateX(1deg) rotateY(1deg); 
            }
            50% { 
                transform: translateY(-10px) translateZ(10px) rotateX(0deg) rotateY(0deg); 
            }
            75% { 
                transform: translateY(-5px) translateZ(5px) rotateX(-1deg) rotateY(-1deg); 
            }
        }

        @keyframes iconPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        @keyframes iconRotate {
            0% { transform: rotateY(0deg); }
            100% { transform: rotateY(360deg); }
        }

        /* Department Portal Section */
        .department-portals {
            background: var(--luxury-cream);
            border-radius: 30px;
            padding: 3rem;
            margin: 3rem auto;
            max-width: 1400px;
            box-shadow: var(--shadow-luxury);
            position: relative;
            overflow: hidden;
            border: 1px solid var(--luxury-gold-light);
        }

        .department-portals::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--primary-blue), var(--light-green), var(--golden-yellow));
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }

        .department-portals::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><defs><pattern id="dept-pattern" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M10 20 Q20 10, 30 20 T50 20" stroke="var(--primary-blue)" stroke-width="1" fill="none" opacity="0.15"/><circle cx="10" cy="20" r="3" fill="var(--light-green)" opacity="0.2"/><circle cx="50" cy="20" r="3" fill="var(--light-green)" opacity="0.2"/></pattern></defs><rect width="200" height="200" fill="url(%23dept-pattern)"/></svg>'),
                linear-gradient(135deg, transparent 40%, rgba(255,255,255,0.2) 50%, transparent 60%);
            background-size: 80px 80px, cover;
            background-position: 0 0, center;
            pointer-events: none;
            animation: deptPatternFloat 12s ease-in-out infinite;
        }

        .department-title {
            font-family: 'Copperplate Gothic Bold', 'Rockwell Extra Bold', serif;
            font-size: 2rem;
            font-weight: 900;
            background: var(--gradient-gold);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
            margin-bottom: 0.5rem;
            z-index: 1;
        }

        .department-subtitle {
            text-align: center;
            color: var(--text-secondary);
            font-size: 1.2rem;
            margin-bottom: 4rem;
            position: relative;
            z-index: 1;
        }

        .department-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            position: relative;
            z-index: 1;
        }

        .department-card {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(212, 175, 55, 0.2);
            border-radius: 20px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            transform: translateZ(0);
            text-decoration: none;
            color: var(--luxury-text);
            box-shadow: 0 8px 32px 0 rgba(15, 76, 117, 0.05);
        }

        .department-card::before {
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

        .department-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dept-card-pattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="2" fill="var(--golden-yellow)" opacity="0.2"/><path d="M5 10 Q10 5, 15 10 T25 10" stroke="var(--light-green)" stroke-width="1" fill="none" opacity="0.3"/></pattern></defs><rect width="100" height="100" fill="url(%23dept-card-pattern)"/></svg>'),
                linear-gradient(135deg, transparent 40%, rgba(255,255,255,0.3) 50%, transparent 60%);
            background-size: 40px 40px, cover;
            background-position: 0 0, center;
            transform: translateX(-100%);
            transition: transform 0.8s ease;
            pointer-events: none;
        }

        .department-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 45px rgba(212, 175, 55, 0.2);
            border-color: var(--luxury-gold);
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
        }

        .department-icon {
            width: 55px;
            height: 55px;
            background: var(--gradient-cream);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--luxury-gold-deep);
            margin: 0 auto 1rem;
            transition: all 0.4s ease;
            box-shadow: var(--shadow-glass);
            position: relative;
            overflow: hidden;
        }

        .department-icon::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.6), transparent);
            transition: left 0.6s ease;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
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

        .contact-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }

        .whatsapp-button {
            padding: 1rem 2rem;
            background: linear-gradient(145deg, #25d366, #128c7e);
            color: white;
            text-decoration: none;
            border-radius: 16px;
            font-weight: 700;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-green), var(--shadow-inset);
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            transform: translateZ(0);
            border: 2px solid #25d366;
        }

        .whatsapp-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.6s ease;
        }

        .whatsapp-button::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: radial-gradient(circle, rgba(255,255,255,0.4) 0%, transparent 70%);
            transform: translate(-50%, -50%);
            transition: all 0.5s ease;
            border-radius: 50%;
        }

        .whatsapp-button:hover {
            transform: translateY(-6px) scale(1.08) rotateX(5deg);
            box-shadow: 0 20px 40px rgba(37, 211, 102, 0.4), var(--shadow-inset);
            background: linear-gradient(145deg, #128c7e, #0e5f54);
        }

        .whatsapp-button:hover::before {
            left: 100%;
        }

        .whatsapp-button:hover::after {
            width: 120%;
            height: 120%;
        }

        .whatsapp-button:active {
            transform: translateY(-3px) scale(1.04) rotateX(2deg);
            transition: all 0.1s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
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

        @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes inject {
            0%, 100% {
                transform: translateX(0);
            }
            50% {
                transform: translateX(10px);
            }
        }

        @keyframes heartbeat {
            0% {
                left: -100%;
            }
            100% {
                left: 100%;
            }
        }

            
                        
                        
                            padding: 1.5rem;
            }
            
                        
            .nav-logo span {
                font-family: 'Rockwell Extra Bold', 'Rockwell', serif;
                font-size: 0.9rem;
        @media (max-width: 480px) {
            .institution-title {
                font-family: 'Copperplate Gothic Bold', 'Rockwell Extra Bold', serif;
                font-size: 1.5rem;
                font-weight: 900;
            }
            
            .subtitle {
                font-family: 'Bernard MT Condensed', 'Arial Narrow', sans-serif;
                font-size: 1rem;
                font-weight: 700;
            }
            
            .section-header {
                flex-direction: column;
                text-align: center;
                gap: 0.8rem;
            }
            
            .tools-grid {
                grid-template-columns: 1fr;
            }
            
            .auth-button {
                padding: 1rem 1.5rem;
                font-size: 0.9rem;
            }
        }

        /* Navigation */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 2px solid var(--golden-yellow);
            z-index: 1000;
            padding: 1rem 0;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-md);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-family: 'Rockwell Extra Bold', 'Rockwell', serif;
            font-weight: 900;
            font-size: 1.2rem;
            color: var(--primary-blue);
            text-decoration: none;
            transition: all 0.3s ease;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
            letter-spacing: 0.02em;
            transform-style: preserve-3d;
        }

        .nav-logo:hover {
            transform: translateY(-2px) rotateX(5deg) rotateY(5deg);
            color: var(--ocean-blue);
            animation: navLogo3D 0.6s ease-in-out;
            text-shadow: 
                0 4px 8px rgba(0,0,0,0.4),
                0 0 20px rgba(14,165,233,0.6);
        }

        .nav-logo img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--golden-yellow);
            box-shadow: var(--shadow-sm);
        }

        .nav-links {
            display: flex;
            gap: 1rem;
            align-items: center;
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

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .mobile-menu-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .navbar {
                padding: 0.5rem 0;
            }
            
            .nav-container {
                padding: 0 1rem;
                flex-wrap: wrap;
                position: relative;
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

            .nav-logo {
                font-size: 1.3rem;
                gap: 1rem;
            }

            .nav-logo img {
                width: 50px;
                height: 50px;
            }

            .nav-links {
                gap: 0.25rem;
            }

            .nav-link {
                padding: 0.4rem 0.8rem;
                font-size: 0.8rem;
            }
        }

        
        /* Mind-Blowing Medical 3D Animations */
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

        /* Organogram Section Styling */
        .organogram-section {
            background: linear-gradient(135deg, var(--cream-white), var(--white));
            border-radius: 30px;
            padding: 4rem 2rem;
            margin: 4rem auto;
            box-shadow: var(--shadow-xl), 0 0 40px rgba(37, 99, 235, 0.1);
            position: relative;
            overflow: hidden;
            border: 1px solid var(--light-green);
        }

        .organogram-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--primary-blue), var(--light-green), var(--golden-yellow));
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .organogram-level {
            display: flex;
            justify-content: center;
            margin-bottom: 3rem;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .org-box {
            min-width: 180px;
            max-width: 220px;
            padding: 1.5rem;
            background: linear-gradient(145deg, var(--white), var(--cream-white));
            border-radius: 20px;
            box-shadow: var(--shadow-lg), var(--shadow-inset);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            border: 2px solid transparent;
            transform-style: preserve-3d;
            transform: translateZ(0);
        }

        .org-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-blue), var(--light-green), var(--golden-yellow));
            transform: scaleX(0);
            transition: transform 0.4s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .org-box:hover {
            transform: translateY(-8px) scale(1.05);
            box-shadow: var(--shadow-xl), 0 0 30px rgba(37, 99, 235, 0.2);
            border-color: var(--light-green);
            background: linear-gradient(145deg, var(--white), var(--creamy-yellow));
        }

        .org-box:hover::before {
            transform: scaleX(1);
        }

        .org-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--white);
            background: linear-gradient(145deg, var(--primary-blue), var(--secondary-blue));
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        .org-content {
            text-align: center;
        }

        .org-title {
            font-family: 'Copperplate Gothic Bold', 'Rockwell Extra Bold', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
        }

        .org-subtitle {
            font-size: 0.9rem;
            color: var(--text-light);
            margin-bottom: 1rem;
        }

        .org-roles {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.8rem;
        }

        .org-role {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem;
            background: linear-gradient(145deg, var(--cream-white), var(--white));
            border-radius: 10px;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .org-role:hover {
            transform: translateX(5px) scale(1.05);
            background: linear-gradient(145deg, var(--light-green), var(--creamy-yellow));
            border-color: var(--light-green);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .org-role i {
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .org-role span {
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--text-dark);
        }

        .org-legend {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 3rem;
            flex-wrap: wrap;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.5rem;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: var(--shadow-md);
        }

        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            box-shadow: var(--shadow-sm);
        }

        .legend-item span {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        @media (max-width: 768px) {
            .organogram-section {
                padding: 2rem 1rem;
                margin: 2rem 1rem;
            }

            .organogram-level {
                flex-direction: column;
                gap: 1.5rem;
            }

            .org-box {
                min-width: 140px;
                max-width: 160px;
                padding: 1rem;
            }

            .org-icon {
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
            }

            .org-title {
                font-size: 1.1rem;
            }

            .org-roles {
                grid-template-columns: 1fr;
                gap: 0.5rem;
            }

            .org-legend {
                flex-direction: column;
                gap: 1rem;
            }

            .legend-item {
                padding: 0.8rem 1rem;
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
            <h1 class="page-title">Student Portal</h1>
            <div class="breadcrumb">
                <p>Home / Student Portal</p>
            </div>
        </div>
    </div>


    <!-- Main Content -->
    <main class="main-content">
        <!-- Portal Login Section -->
        <section class="portal-login-section">
            <div class="section-container">
                <div class="section-header">
                    <div class="section-badge">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Student Portal Access</span>
                    </div>
                    <h2 class="section-title">Welcome to Student Portal</h2>
                    <p class="section-subtitle">Access your academic records, grades, and campus resources</p>
                </div>
                <!-- Login Form -->
                <div class="login-form-container">
                    <div class="login-card">
                        <div class="login-header">
                            <div class="login-icon">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <h3 class="login-title">Student Login</h3>
                            <p class="login-subtitle">Enter your credentials to access the portal</p>
                        </div>
                        
                        <form class="login-form" method="POST" action="login-process.php">
                            <div class="form-group">
                                <label for="student-id" class="form-label">
                                    <i class="fas fa-id-card"></i>
                                    Student ID / Registration Number
                                </label>
                                <input 
                                    type="text" 
                                    id="student-id" 
                                    name="student_id" 
                                    class="form-input" 
                                    placeholder="Enter your Student ID" 
                                    required
                                    autocomplete="username"
                                >
                            </div>
                            
                            <div class="form-group">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock"></i>
                                    Password
                                </label>
                                <div class="password-input-container">
                                    <input 
                                        type="password" 
                                        id="password" 
                                        name="password" 
                                        class="form-input" 
                                        placeholder="Enter your password" 
                                        required
                                        autocomplete="current-password"
                                    >
                                    <button type="button" class="password-toggle" id="passwordToggle">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="user-type" class="form-label">
                                    <i class="fas fa-user-tag"></i>
                                    User Type
                                </label>
                                <select id="user-type" name="user_type" class="form-select" required>
                                    <option value="">Select User Type</option>
                                    <option value="student">Student</option>
                                    <option value="lecturer">Lecturer</option>
                                    <option value="admin">Administrator</option>
                                    <option value="support">Support Staff</option>
                                </select>
                            </div>
                            
                            <div class="form-actions">
                                <button type="submit" class="login-button">
                                    <i class="fas fa-sign-in-alt"></i>
                                    Sign In
                                </button>
                                <a href="forgot-password.php" class="forgot-password">
                                    <i class="fas fa-question-circle"></i>
                                    Forgot Password?
                                </a>
                            </div>
                        </form>
                        
                        <div class="login-footer">
                            <p class="login-help">
                                <i class="fas fa-info-circle"></i>
                                For login assistance, contact the IT Department
                            </p>
                            <div class="contact-info">
                                <p><i class="fas fa-phone"></i> +256 772 514 889</p>
                                <p><i class="fas fa-envelope"></i> support@isnm.ac.ug</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>



    </main>
        
        <!-- Organogram Section -->
        <section class="organogram-section">
            <div class="section-container">
                <div class="section-header">
                    <div class="section-badge">
                        <i class="fas fa-sitemap"></i>
                        <span>Institutional Structure</span>
                    </div>
                    <h2 class="section-title">ISNM Organizational Structure</h2>
                    <p class="section-subtitle">Complete hierarchy of staff and student roles with dashboard access</p>
                </div>
                
                <!-- Top Management Level -->
                <div class="organogram-level">
                    <div class="org-box executive-level" onclick="handleOrgClick('director')">
                        <div class="org-icon">
                            <i class="fas fa-crown"></i>
                        </div>
                        <div class="org-content">
                            <h3 class="org-title">Director</h3>
                            <p class="org-subtitle">Overall Management</p>
                            <div class="org-roles">
                                <div class="org-role">
                                    <i class="fas fa-user-tie"></i>
                                    <span>Director General</span>
                                </div>
                                <div class="org-role">
                                    <i class="fas fa-user-tie"></i>
                                    <span>Director Academics</span>
                                </div>
                                <div class="org-role">
                                    <i class="fas fa-user-tie"></i>
                                    <span>Director ICT</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Principal Level -->
                <div class="organogram-level">
                    <div class="org-box executive-level" onclick="handleOrgClick('principal')">
                        <div class="org-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="org-content">
                            <h3 class="org-title">Principal</h3>
                            <p class="org-subtitle">Chief Executive</p>
                            <div class="org-roles">
                                <div class="org-role">
                                    <i class="fas fa-user-graduate"></i>
                                    <span>Principal</span>
                                </div>
                                <div class="org-role">
                                    <i class="fas fa-user-graduate"></i>
                                    <span>Deputy Principal</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Administrative Staff -->
                <div class="organogram-level">
                    <div class="org-box management-level" onclick="handleOrgClick('admin')">
                        <div class="org-icon">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <div class="org-content">
                            <h3 class="org-title">Administrative Staff</h3>
                            <p class="org-subtitle">Management & Support</p>
                            <div class="org-roles">
                                <div class="org-role">
                                    <i class="fas fa-user-tie"></i>
                                    <span>Academic Registrar</span>
                                </div>
                                <div class="org-role">
                                    <i class="fas fa-user-tie"></i>
                                    <span>School Bursar</span>
                                </div>
                                <div class="org-role">
                                    <i class="fas fa-user-tie"></i>
                                    <span>HR Manager</span>
                                </div>
                                <div class="org-role">
                                    <i class="fas fa-user-tie"></i>
                                    <span>Secretary</span>
                                </div>
                                <div class="org-role">
                                    <i class="fas fa-user-tie"></i>
                                    <span>Librarian</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Academic Staff -->
                <div class="organogram-level">
                    <div class="org-box management-level" onclick="handleOrgClick('lecturer')">
                        <div class="org-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div class="org-content">
                            <h3 class="org-title">Academic Staff</h3>
                            <p class="org-subtitle">Teaching & Clinical</p>
                            <div class="org-roles">
                                <div class="org-role">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    <span>Head Nursing</span>
                                </div>
                                <div class="org-role">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    <span>Head Midwifery</span>
                                </div>
                                <div class="org-role">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    <span>Senior Lecturers</span>
                                </div>
                                <div class="org-role">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    <span>Lecturers</span>
                                </div>
                                <div class="org-role">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    <span>Clinical Instructors</span>
                                </div>
                                <div class="org-role">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    <span>Tutors</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Support Staff -->
                <div class="organogram-level">
                    <div class="org-box operational-level" onclick="handleOrgClick('support')">
                        <div class="org-icon">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <div class="org-content">
                            <h3 class="org-title">Support Staff</h3>
                            <p class="org-subtitle">Student Services</p>
                            <div class="org-roles">
                                <div class="org-role">
                                    <i class="fas fa-user-nurse"></i>
                                    <span>Matron 1</span>
                                </div>
                                <div class="org-role">
                                    <i class="fas fa-user-nurse"></i>
                                    <span>Matron 2</span>
                                </div>
                                <div class="org-role">
                                    <i class="fas fa-user-nurse"></i>
                                    <span>Matron 3</span>
                                </div>
                                <div class="org-role">
                                    <i class="fas fa-user-shield"></i>
                                    <span>Warden</span>
                                </div>
                                <div class="org-role">
                                    <i class="fas fa-tools"></i>
                                    <span>Lab Technicians</span>
                                </div>
                                <div class="org-role">
                                    <i class="fas fa-tools"></i>
                                    <span>Drivers</span>
                                </div>
                                <div class="org-role">
                                    <i class="fas fa-tools"></i>
                                    <span>Cooks</span>
                                </div>
                                <div class="org-role">
                                    <i class="fas fa-broom"></i>
                                    <span>Cleaners</span>
                                </div>
                                <div class="org-role">
                                    <i class="fas fa-user-tie"></i>
                                    <span>Tailors</span>
                                </div>
                                <div class="org-role">
                                    <i class="fas fa-user-shield"></i>
                                    <span>Security</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Student Body -->
                <div class="organogram-level">
                    <div class="org-box operational-level" onclick="handleOrgClick('student')">
                        <div class="org-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="org-content">
                            <h3 class="org-title">Student Body</h3>
                            <p class="org-subtitle">Student Leadership</p>
                            <div class="org-roles">
                                <div class="org-role">
                                    <i class="fas fa-user-graduate"></i>
                                    <span>Guild President</span>
                                </div>
                                <div class="org-role">
                                    <i class="fas fa-user-graduate"></i>
                                    <span>Guild Vice President</span>
                                </div>
                                <div class="org-role">
                                    <i class="fas fa-user-graduate"></i>
                                    <span>Class Representatives</span>
                                </div>
                                <div class="org-role">
                                    <i class="fas fa-user-graduate"></i>
                                    <span>Club Leaders</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Legend -->
                <div class="org-legend">
                    <div class="legend-item">
                        <div class="legend-color executive-level"></div>
                        <span>Executive Level - Director Dashboard</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color management-level"></div>
                        <span>Management Level - Admin Dashboard</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color operational-level"></div>
                        <span>Operational Level - Support Dashboard</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color operational-level"></div>
                        <span>Student Level - Student Dashboard</span>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <h3 class="footer-title">Designed and Developed by Reagan Otema</h3>
            <p class="footer-subtitle">For system errors, contact via WhatsApp</p>
            <div class="contact-buttons">
                <a href="https://wa.me/256772514889" target="_blank" class="whatsapp-button">
                    <i class="fab fa-whatsapp"></i> MTN WhatsApp: +256772514889
                </a>
                <a href="https://wa.me/256730314979" target="_blank" class="whatsapp-button">
                    <i class="fab fa-whatsapp"></i> Airtel WhatsApp: +256730314979
                </a>
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

        // Password toggle functionality
        const passwordToggle = document.getElementById('passwordToggle');
        const passwordInput = document.getElementById('password');
        
        if (passwordToggle && passwordInput) {
            passwordToggle.addEventListener('click', () => {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                passwordToggle.classList.toggle('active');
                
                // Update icon
                const icon = passwordToggle.querySelector('i');
                if (type === 'text') {
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        }
        
        // Form validation and submission
        const loginForm = document.querySelector('.login-form');
        if (loginForm) {
            loginForm.addEventListener('submit', (e) => {
                e.preventDefault();
                
                const studentId = document.getElementById('student-id').value;
                const password = passwordInput.value;
                const userType = document.getElementById('user-type').value;
                
                // Basic validation
                if (!studentId || !password || !userType) {
                    alert('Please fill in all fields');
                    return;
                }
                
                // Show loading state
                const submitButton = loginForm.querySelector('.login-button');
                const originalText = submitButton.innerHTML;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Signing In...';
                submitButton.disabled = true;
                
                // Simulate login process (replace with actual authentication)
                setTimeout(() => {
                    // Reset button
                    submitButton.innerHTML = originalText;
                    submitButton.disabled = false;
                    
                    // For demo purposes, show success message
                    alert(`Login successful! User Type: ${userType}`);
                    // In production, redirect to appropriate dashboard
                    // window.location.href = `dashboard-${userType}.php`;
                }, 2000);
            });
        }
        
        // Add input focus effects
        const formInputs = document.querySelectorAll('.form-input, .form-select');
        formInputs.forEach(input => {
            input.addEventListener('focus', () => {
                input.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', () => {
                input.parentElement.classList.remove('focused');
            });
        });

        // Organogram Click Handler
        function handleOrgClick(role) {
            // Map roles to dashboard URLs
            const dashboardMap = {
                'director': 'dashboard-director.php',
                'principal': 'dashboard-principal.php', 
                'admin': 'dashboard-admin.php',
                'lecturer': 'dashboard-lecturer.php',
                'support': 'dashboard-support.php',
                'student': 'dashboard-student.php'
            };

            const dashboardUrl = dashboardMap[role];
            if (dashboardUrl) {
                // Show loading state
                const clickedBox = event.currentTarget;
                clickedBox.style.transform = 'scale(0.95)';
                clickedBox.style.opacity = '0.7';
                
                // Simulate navigation delay
                setTimeout(() => {
                    clickedBox.style.transform = '';
                    clickedBox.style.opacity = '';
                    // In production, redirect to actual dashboard
                    // window.location.href = dashboardUrl;
                    alert(`Navigating to ${role} dashboard: ${dashboardUrl}`);
                }, 300);
            }
        }
    </script>
</body>
</html>


