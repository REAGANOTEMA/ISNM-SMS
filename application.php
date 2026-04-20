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
    <title>Application - Iganga School of Nursing and Midwifery</title>
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
            --creamy-yellow: #FFF8DC;
            --accent-gold: #FFD700;
            --secondary-dark: #2d2d2d;
            --light-cream: #FAF0E6;
            --dark-accent: #B8860B;
            --white: #FFFFFF;
            --gray-light: #F5F5F5;
            --gray-medium: #D3D3D3;
            --gray-dark: #696969;
            
            /* Additional colors for form */
            --primary-blue: #2563eb;
            --text-primary: #1a202c;
            --text-secondary: #4a5568;
            --border-color: #e2e8f0;
            --cream-white: #fefefe;
            --clean-white: #ffffff;
            --light-green: #10b981;
            
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
            background: linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #334155 100%);
            color: var(--pure-white);
            line-height: 1.6;
            overflow-x: hidden;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 50%, rgba(139, 92, 246, 0.4) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(59, 130, 246, 0.4) 0%, transparent 50%),
                radial-gradient(circle at 50% 20%, rgba(236, 72, 153, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 50% 80%, rgba(249, 115, 22, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 30% 70%, rgba(16, 185, 129, 0.2) 0%, transparent 50%);
            animation: modernAurora 15s ease-in-out infinite;
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
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="modern-admissions-pattern" width="30" height="30" patternUnits="userSpaceOnUse"><circle cx="15" cy="15" r="3" fill="rgba(139,92,246,0.3)"/><path d="M5 15 Q15 5, 25 15 T45 15" stroke="rgba(59,130,246,0.4)" stroke-width="2" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23modern-admissions-pattern)"/></svg>'),
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><defs><pattern id="vibrant-admissions-pattern" width="50" height="50" patternUnits="userSpaceOnUse"><rect x="10" y="10" width="30" height="30" fill="none" stroke="rgba(236,72,153,0.3)" stroke-width="2"/><circle cx="25" cy="25" r="6" fill="rgba(249,115,22,0.4)"/></pattern></defs><rect width="200" height="200" fill="url(%23vibrant-admissions-pattern)"/></svg>');
            background-size: 30px 30px, 100px 100px;
            animation: modernPatternFloat 25s linear infinite;
            pointer-events: none;
            z-index: -1;
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

        .nav-links a:hover {
            color: #FFFFFF;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
            border-color: #000000;
            background: #000000;
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

        /* Admission Overview */
        .admission-overview {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        .admission-overview::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }

        .overview-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .overview-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }

        .overview-subtitle {
            font-size: 1.2rem;
            color: var(--text-secondary);
            max-width: 800px;
            margin: 0 auto;
        }

        /* Program Tabs */
        .program-tabs {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 3rem;
            flex-wrap: wrap;
        }

        .tab-btn {
            padding: 1rem 2rem;
            border: none;
            background: var(--cream-white);
            color: var(--text-primary);
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Copperplate Gothic Bold', 'Rockwell Extra Bold', serif;
            border: 2px solid var(--border-color);
        }

        .tab-btn.active {
            background: var(--gradient-primary);
            color: white;
            border-color: var(--primary-blue);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .tab-btn:hover:not(.active) {
            background: var(--light-green);
            color: white;
            border-color: var(--light-green);
        }

        /* Program Content */
        .program-content {
            display: none;
            animation: fadeInUp 0.5s ease;
        }

        .program-content.active {
            display: block;
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

        /* Admission Requirements */
        .admission-requirements {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .requirements-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .requirements-list {
            list-style: none;
            display: grid;
            gap: 1rem;
        }

        .requirement-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 1rem;
            background: white;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .requirement-item:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
            border-color: var(--accent-blue);
        }

        .requirement-icon {
            width: 40px;
            height: 40px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            flex-shrink: 0;
        }

        .requirement-text {
            flex: 1;
        }

        .requirement-title {
            font-weight: 600;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
        }

        .requirement-description {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        /* Program Details */
        .program-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .detail-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .detail-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .detail-icon {
            width: 60px;
            height: 60px;
            background: var(--gradient-luxury);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .detail-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }

        .detail-description {
            color: var(--text-secondary);
            line-height: 1.6;
        }

        /* Fee Structure */
        .fee-structure {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            border: 1px solid var(--border-color);
            margin-bottom: 2rem;
        }

        .fee-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .fee-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.5rem;
        }

        .fee-table-container {
            overflow-x: auto;
            margin-bottom: 1.5rem;
        }

        .fee-table th,
        .fee-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .fee-table th {
            background: var(--gradient-primary);
            color: white;
            font-weight: 600;
        }

        .fee-table tr:hover {
            background: var(--cream-white);
        }

        .fee-amount {
            font-weight: 700;
            color: var(--primary-blue);
            font-size: 1.1rem;
        }

        /* Application Process */
        .application-process {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .process-steps {
            display: grid;
            gap: 1.5rem;
        }

        .process-step {
            display: flex;
            align-items: flex-start;
            gap: 1.5rem;
            padding: 1.5rem;
            background: white;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .process-step:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        .step-number {
            width: 50px;
            height: 50px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .step-content {
            flex: 1;
        }

        .step-title {
            font-weight: 600;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
        }

        .step-description {
            color: var(--text-secondary);
        }

        /* CTA Section */
        .cta-section {
            background: var(--gradient-primary);
            color: white;
            border-radius: 20px;
            padding: 3rem;
            text-align: center;
            margin-top: 3rem;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
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

        .cta-content {
            position: relative;
            z-index: 1;
        }

        .cta-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .cta-description {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .cta-btn {
            padding: 1.2rem 2.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            font-family: 'Copperplate Gothic Bold', 'Rockwell Extra Bold', serif;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .cta-btn-primary {
            background: white;
            color: var(--primary-blue);
            box-shadow: var(--shadow-md);
        }

        .cta-btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-xl);
        }

        .cta-btn-secondary {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .cta-btn-secondary:hover {
            background: white;
            color: var(--primary-blue);
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
            
            .header-nav {
                flex-wrap: wrap;
                position: relative;
            }
            
            .logo-section {
                flex: 1;
            }
            
            .page-title {
                font-size: 2rem;
            }
            
            .program-tabs {
                flex-direction: column;
                align-items: center;
            }
            
            .tab-btn {
                width: 100%;
                max-width: 300px;
            }
            
            .program-details {
                grid-template-columns: 1fr;
            }
            
            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .main-content {
                padding: 2rem 1rem;
            }
            
            .admission-overview,
            .application-form-section {
                padding: 2rem 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .page-title {
                font-size: 1.5rem;
            }
            
            .overview-title,
            .form-title {
                font-size: 2rem;
            }
            
            .admission-overview,
            .application-form-section {
                padding: 1.5rem 1rem;
            }
        }

        /* Application Form Styles */
        .application-form-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            margin-bottom: 3rem;
        }

        .application-form-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }

        .form-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .form-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }

        .form-description {
            font-size: 1.2rem;
            color: var(--text-secondary);
            max-width: 800px;
            margin: 0 auto;
        }

        .application-form {
            max-width: 800px;
            margin: 0 auto;
        }

        .form-row {
            display: flex;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .form-group {
            flex: 1;
        }

        .form-group.full-width {
            width: 100%;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 1rem;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
            background: var(--white);
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .file-upload {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .file-upload input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .file-upload-label {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            border: 2px dashed var(--border-color);
            border-radius: 10px;
            background: var(--gray-light);
            cursor: pointer;
            transition: all 0.3s ease;
            min-height: 60px;
        }

        .file-upload-label:hover {
            border-color: var(--primary-blue);
            background: rgba(37, 99, 235, 0.05);
        }

        .file-upload-label i {
            margin-right: 0.5rem;
            color: var(--text-secondary);
        }

        .file-name {
            margin-left: 0.5rem;
            color: var(--primary-blue);
            font-weight: 500;
        }

        .submit-btn {
            display: block;
            width: 100%;
            padding: 1.2rem;
            background: var(--gradient-primary);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 1.2rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Copperplate Gothic Bold', 'Rockwell Extra Bold', serif;
            margin-top: 2rem;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .required {
            color: #dc2626;
        }

        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 1rem;
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
    <!-- Luxury Header -->
    <header class="luxury-header">
        <div class="header-content">
            <nav class="header-nav">
                <div class="logo-section">
                    <img src="assets/school-logo.png" alt="ISNM Logo" class="logo">
                    <div>
                        <h1 style="font-family: 'Copperplate Gothic Bold', 'Rockwell Extra Bold', serif; font-size: 1.2rem; font-weight: 900;">ISNM</h1>
                        <p style="font-size: 0.8rem; opacity: 0.9;">Excellence in Healthcare Education</p>
                    </div>
                </div>
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
            </nav>
            <div class="page-title">Application</div>
            <div class="breadcrumb">
                <p>Home / Application</p>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Application Overview -->
        <section class="admission-overview">
            <div class="overview-header">
                <h2 class="overview-title">Join Our Healthcare Community</h2>
                <p class="overview-subtitle">
                    Take the first step towards a rewarding career in nursing and midwifery. 
                    Our comprehensive programs are designed to meet the highest standards of healthcare education.
                </p>
            </div>

            <!-- Program Tabs -->
            <div class="program-tabs">
                <button class="tab-btn active" onclick="showProgram('diploma')">
                    <i class="fas fa-graduation-cap"></i> Diploma Programs
                </button>
                <button class="tab-btn" onclick="showProgram('certificate')">
                    <i class="fas fa-certificate"></i> Certificate Programs
                </button>
            </div>

            <!-- Diploma Program Content -->
            <div id="diploma" class="program-content active">
                <div class="admission-requirements">
                    <h3 class="requirements-title">
                        <i class="fas fa-clipboard-check"></i>
                        Diploma Application Requirements
                    </h3>
                    <ul class="requirements-list">
                        <li class="requirement-item">
                            <div class="requirement-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="requirement-text">
                                <div class="requirement-title">Academic Qualifications</div>
                                <div class="requirement-description">
                                    Uganda Advanced Certificate of Education (UACE) with at least 2 principal passes in any subjects
                                </div>
                            </div>
                        </li>
                        <li class="requirement-item">
                            <div class="requirement-icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="requirement-text">
                                <div class="requirement-title">O-Level Requirements</div>
                                <div class="requirement-description">
                                    Uganda Certificate of Education (UCE) with at least 5 passes, including English, Biology, Chemistry, and Physics
                                </div>
                            </div>
                        </li>
                        <li class="requirement-item">
                            <div class="requirement-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="requirement-text">
                                <div class="requirement-title">Age Requirement</div>
                                <div class="requirement-description">
                                    No age restriction, at the time of admission
                                </div>
                            </div>
                        </li>
                        <li class="requirement-item">
                            <div class="requirement-icon">
                                <i class="fas fa-heartbeat"></i>
                            </div>
                            <div class="requirement-text">
                                <div class="requirement-title">Medical Fitness</div>
                                <div class="requirement-description">
                                    Medical fitness certificate from a registered medical practitioner
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="program-details">
                    <div class="detail-card">
                        <div class="detail-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                         <h3 class="detail-title">Program Duration</h3>
                        <p class="detail-description">
                            3 semesters (1.5 years) extension program with comprehensive theoretical and practical training
                        </p>
                    </div>
                    <div class="detail-card">
                        <div class="detail-icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <h3 class="detail-title">Award</h3>
                        <p class="detail-description">
                            Diploma in Midwifery recognized by Uganda Nursing and Midwifery Council
                        </p>
                    </div>
                    <div class="detail-card">
                        <div class="detail-icon">
                            <i class="fas fa-hospital"></i>
                        </div>
                        <h3 class="detail-title">Clinical Practice</h3>
                        <p class="detail-description">
                            Extensive clinical rotations in partner hospitals and healthcare facilities with specialized midwifery focus
                        </p>
                    </div>
                </div>
            </div>

            <!-- Certificate Program Content -->
            <div id="certificate" class="program-content">
                <div class="admission-requirements">
                    <h3 class="requirements-title">
                        <i class="fas fa-clipboard-check"></i>
                        Certificate Application Requirements
                    </h3>
                    <ul class="requirements-list">
                        <li class="requirement-item">
                            <div class="requirement-icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="requirement-text">
                                <div class="requirement-title">Academic Qualifications</div>
                                <div class="requirement-description">
                                    Uganda Certificate of Education (UCE) with at least 5 passes
                                </div>
                            </div>
                        </li>
                        <li class="requirement-item">
                            <div class="requirement-icon">
                                <i class="fas fa-flask"></i>
                            </div>
                            <div class="requirement-text">
                                <div class="requirement-title">Science Subjects</div>
                                <div class="requirement-description">
                                    Preference given to candidates with passes in Biology, Chemistry, and Physics
                                </div>
                            </div>
                        </li>
                        <li class="requirement-item">
                            <div class="requirement-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="requirement-text">
                                <div class="requirement-title">Age Requirement</div>
                                <div class="requirement-description">
                                    Minimum age of 18 years at the time of admission
                                </div>
                            </div>
                        </li>
                        <li class="requirement-item">
                            <div class="requirement-icon">
                                <i class="fas fa-heartbeat"></i>
                            </div>
                            <div class="requirement-text">
                                <div class="requirement-title">Medical Fitness</div>
                                <div class="requirement-description">
                                    Medical fitness certificate from a registered medical practitioner
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="program-details">
                    <div class="detail-card">
                        <div class="detail-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3 class="detail-title">Program Duration</h3>
                        <p class="detail-description">
                            2.5 years (5 semesters) full-time program with comprehensive theoretical and practical training
                        </p>
                    </div>
                    <div class="detail-card">
                        <div class="detail-icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <h3 class="detail-title">Award</h3>
                        <p class="detail-description">
                            Certificate in Nursing recognized by Uganda Nursing and Midwifery Council
                        </p>
                    </div>
                    <div class="detail-card">
                        <div class="detail-icon">
                            <i class="fas fa-hospital"></i>
                        </div>
                        <h3 class="detail-title">Clinical Practice</h3>
                        <p class="detail-description">
                            Structured clinical placements in partner healthcare facilities
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Application Process -->
        <section class="application-process">
            <h3 class="requirements-title">
                <i class="fas fa-tasks"></i>
                Application Process
            </h3>
            <div class="process-steps">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h4 class="step-title">Obtain Application Form</h4>
                        <p class="step-description">
                            Collect application form from the school administration office or download from our website
                        </p>
                    </div>
                </div>
                <div class="process-step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h4 class="step-title">Complete Application</h4>
                        <p class="step-description">
                            Fill in all required information and attach necessary documents
                        </p>
                    </div>
                </div>
                <div class="process-step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h4 class="step-title">Submit Application</h4>
                        <p class="step-description">
                            Submit completed application form with required documents and pay application fee
                        </p>
                    </div>
                </div>
                <div class="process-step">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h4 class="step-title">Interview & Assessment</h4>
                        <p class="step-description">
                            Attend scheduled interview and assessment session
                        </p>
                    </div>
                </div>
                <div class="process-step">
                    <div class="step-number">5</div>
                    <div class="step-content">
                        <h4 class="step-title">Application Confirmation</h4>
                        <p class="step-description">
                            Receive application letter and complete registration process
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section">
            <div class="cta-content">
                <h2 class="cta-title">Ready to Start Your Healthcare Journey?</h2>
                <p class="cta-description">
                    Join thousands of successful healthcare professionals who started their careers at ISNM
                </p>
                    <a href="contact.php" class="cta-btn cta-btn-secondary">
                        <i class="fas fa-phone"></i> Contact Application Office
                    </a>
                </div>
            </div>
        </section>

        <!-- Online Application Form -->
        <section class="application-form-section">
            <div class="form-header">
                <h2 class="form-title">Online Application Form</h2>
                <p class="form-description">
                    Apply online for application to Iganga School of Nursing and Midwifery. Fill in all required information carefully.
                </p>
            </div>
            <form class="application-form" action="submit-application.php" method="POST" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name" class="form-label">First Name <span class="required">*</span></label>
                        <input type="text" id="first_name" name="first_name" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="surname" class="form-label">Surname <span class="required">*</span></label>
                        <input type="text" id="surname" name="surname" class="form-input" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="date_of_birth" class="form-label">Date of Birth <span class="required">*</span></label>
                        <input type="date" id="date_of_birth" name="date_of_birth" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="contacts" class="form-label">Contact Number <span class="required">*</span></label>
                        <input type="tel" id="contacts" name="contacts" class="form-input" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="level" class="form-label">Level Applying For <span class="required">*</span></label>
                        <select id="level" name="level" class="form-select" required>
                            <option value="">Select Level</option>
                            <option value="Certificate">Certificate</option>
                            <option value="Diploma">Diploma</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="course" class="form-label">Course <span class="required">*</span></label>
                        <select id="course" name="course" class="form-select" required>
                            <option value="">Select Course</option>
                            <option value="Diploma in Nursing"> Nursing</option>
                            <option value="Diploma in Midwifery">Midwifery</option>
                        </select>
                    </div>
                </div>
                <div class="form-group full-width">
                    <label for="address" class="form-label">Location Address <span class="required">*</span></label>
                    <textarea id="address" name="address" class="form-textarea" placeholder="Enter your full address" required></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Upload Academic Document (PDF, JPEG, PNG, DOC) <span class="required">*</span></label>
                        <div class="file-upload">
                            <input type="file" id="document" name="document" accept=".pdf,.jpeg,.jpg,.png,.doc,.docx" required>
                            <label for="document" class="file-upload-label">
                                <i class="fas fa-upload"></i>
                                <span>Choose file...</span>
                                <span id="document-name" class="file-name"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Upload Your Photo <span class="required">*</span></label>
                        <div class="file-upload">
                            <input type="file" id="image" name="image" accept=".jpeg,.jpg,.png" required>
                            <label for="image" class="file-upload-label">
                                <i class="fas fa-camera"></i>
                                <span>Choose image...</span>
                                <span id="image-name" class="file-name"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="submit-btn">
                    <i class="fas fa-paper-plane"></i> Submit Application
                </button>
            </form>
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
        });
    </script>
</body>
</html>

        function showProgram(programType) {
            // Hide all program contents
            document.querySelectorAll('.program-content').forEach(content => {
                content.classList.remove('active');
            });
            
            // Remove active class from all tabs
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            
            // Show selected program content
            const selectedProgram = document.getElementById(programType);
            if (selectedProgram) {
                selectedProgram.classList.add('active');
            }
            
            // Add active class to clicked tab
            if (event && event.target) {
                event.target.classList.add('active');
            }
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

        // File upload display
        const documentInput = document.getElementById('document');
        const imageInput = document.getElementById('image');
        
        if (documentInput) {
            documentInput.addEventListener('change', function(e) {
                const fileName = e.target.files[0] ? e.target.files[0].name : '';
                const fileNameElement = document.getElementById('document-name');
                if (fileNameElement) {
                    fileNameElement.textContent = fileName;
                }
            });
        }
        
        if (imageInput) {
            imageInput.addEventListener('change', function(e) {
                const fileName = e.target.files[0] ? e.target.files[0].name : '';
                const fileNameElement = document.getElementById('image-name');
                if (fileNameElement) {
                    fileNameElement.textContent = fileName;
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
    </script>
</body>
</html>


