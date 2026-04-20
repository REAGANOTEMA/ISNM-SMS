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
    <title>Institutional Activities - Iganga School of Nursing and Midwifery</title>
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

        :root {
            /* Dark Blue Professional Color Palette - Matching contact.php */
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
            --accent-gold: #FFD700;
            --creamy-yellow: #FFF8DC;
            --light-cream: #FAF0E6;
            --border-color: #e2e8f0;
            
            /* Gradients */
            --gradient-hero: linear-gradient(135deg, var(--primary-dark) 0%, var(--secondary-dark) 50%, var(--accent-blue) 100%);
            --gradient-primary: linear-gradient(135deg, var(--primary-dark) 0%, var(--accent-blue) 100%);
            --gradient-secondary: linear-gradient(135deg, var(--accent-blue) 0%, var(--accent-cyan) 100%);
            --gradient-clean: linear-gradient(135deg, var(--gray-light) 0%, var(--white) 100%);
            --gradient-luxury: linear-gradient(135deg, var(--accent-gold) 0%, var(--creamy-yellow) 100%);
            
            /* Shadows */
            --shadow-sm: 0 2px 4px rgba(10, 22, 40, 0.1);
            --shadow-md: 0 4px 8px rgba(10, 22, 40, 0.15);
            --shadow-lg: 0 8px 16px rgba(10, 22, 40, 0.2);
            --shadow-xl: 0 20px 40px rgba(10, 22, 40, 0.25);
            --shadow-2xl: 0 25px 50px rgba(10, 22, 40, 0.3);
            
            /* Borders */
            --border-light: var(--gray-medium);
            --border-medium: var(--gray-dark);
            --border-dark: var(--primary-dark);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--gray-light) 0%, var(--white) 45%, var(--gray-light) 100%);
            color: var(--text-primary);
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
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="modern-activities-pattern" width="30" height="30" patternUnits="userSpaceOnUse"><circle cx="15" cy="15" r="3" fill="rgba(139,92,246,0.3)"/><path d="M5 15 Q15 5, 25 15 T45 15" stroke="rgba(59,130,246,0.4)" stroke-width="2" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23modern-activities-pattern)"/></svg>'),
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><defs><pattern id="vibrant-activities-pattern" width="50" height="50" patternUnits="userSpaceOnUse"><rect x="10" y="10" width="30" height="30" fill="none" stroke="rgba(236,72,153,0.3)" stroke-width="2"/><circle cx="25" cy="25" r="6" fill="rgba(249,115,22,0.4)"/></pattern></defs><rect width="200" height="200" fill="url(%23vibrant-activities-pattern)"/></svg>');
            background-size: 30px 30px, 100px 100px;
            animation: modernPatternFloat 25s linear infinite;
            pointer-events: none;
            z-index: -1;
        }

        @keyframes modernAurora {
            0%, 100% { transform: rotate(0deg) scale(1); }
            25% { transform: rotate(90deg) scale(1.1); }
            50% { transform: rotate(180deg) scale(1); }
            75% { transform: rotate(270deg) scale(1.1); }
        }

        @keyframes modernPatternFloat {
            0% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(10px, -10px) rotate(180deg); }
            100% { transform: translate(20px, 0) rotate(360deg); }
        }

        /* Premium 3D Navigation - Matching contact.php */
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

        /* Mobile Menu Button */
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
            transform: translateY(0);
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
            border-radius: 6px 6px 0 0;
        }

        .nav-dropdown-menu a:last-child {
            border-radius: 0 0 6px 6px;
            border-bottom: none;
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
            color: var(--accent-dark-blue);
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
            background: var(--gradient-secondary);
            border-radius: 2px;
        }

        .section-subtitle {
            color: var(--text-secondary);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Academic Activities */
        .academic-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            margin-bottom: 3rem;
        }

        .activities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .activity-card {
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.05), rgba(55, 48, 163, 0.05));
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .activity-card::before {
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

        .activity-card:hover::before {
            opacity: 1;
        }

        .activity-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: var(--shadow-xl);
        }

        .activity-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 1rem;
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            transform-style: preserve-3d;
            box-shadow: var(--shadow-md);
        }

        .activity-image:hover {
            transform: scale(1.05) rotateX(2deg) translateZ(10px);
            box-shadow: var(--shadow-lg);
        }

        .activity-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 40%, rgba(255,255,255,0.3) 50%, transparent 60%);
            transform: translateX(-100%);
            transition: transform 0.8s ease;
            pointer-events: none;
            border-radius: 12px;
        }

        .activity-card:hover .activity-image::before {
            transform: translateX(100%);
        }

        .activity-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: var(--white);
            box-shadow: 0 0 20px rgba(30, 58, 138, 0.3);
            position: relative;
            z-index: 1;
        }

        .activity-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--accent-dark-blue);
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .activity-description {
            color: var(--text-primary);
            font-size: 1.1rem;
            line-height: 1.6;
            position: relative;
            z-index: 1;
        }

        /* Academic Activities */
        .academic-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            margin-bottom: 3rem;
        }

        .activities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .activity-card {
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.05), rgba(55, 48, 163, 0.05));
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .activity-card::before {
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

        .activity-card:hover::before {
            opacity: 1;
        }

        .activity-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: var(--shadow-xl);
        }

        .activity-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 1rem;
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            transform-style: preserve-3d;
            box-shadow: var(--shadow-md);
        }

        .activity-image:hover {
            transform: scale(1.05) rotateX(2deg) translateZ(10px);
            box-shadow: var(--shadow-lg);
        }

        .activity-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 40%, rgba(255,255,255,0.3) 50%, transparent 60%);
            transform: translateX(-100%);
            transition: transform 0.8s ease;
            pointer-events: none;
            border-radius: 12px;
        }

        .activity-card:hover .activity-image::before {
            transform: translateX(100%);
        }

        .activity-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: var(--white);
            box-shadow: 0 0 20px rgba(30, 58, 138, 0.3);
            position: relative;
            z-index: 1;
        }

        .activity-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .activity-description {
            color: var(--text-primary);
            font-size: 1.1rem;
            line-height: 1.6;
            position: relative;
            z-index: 1;
        }

        /* Practicum Sites */
        .practicum-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            margin-bottom: 3rem;
        }

        .practicum-intro {
            font-size: 1.2rem;
            line-height: 1.8;
            color: var(--text-primary);
            margin-bottom: 2rem;
            text-align: center;
        }

        .practicum-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2rem;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .practicum-table th {
            background: var(--gradient-primary);
            color: var(--white);
            padding: 1rem;
            text-align: left;
            font-weight: 600;
        }

        .practicum-table td {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .practicum-table tr:hover {
            background: rgba(37, 99, 235, 0.05);
        }

        .practicum-table tr:last-child td {
            border-bottom: none;
        }

        .ownership-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .ownership-badge.government {
            background: rgba(37, 99, 235, 0.1);
            color: var(--accent-blue);
        }

        .distance-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-secondary);
        }

        .bed-capacity {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--accent-blue);
            font-weight: 600;
        }

        /* Co-curricular Activities */
        .co-curricular-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
        }

        .sports-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .sport-card {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.05), rgba(6, 182, 212, 0.05));
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            animation: sportCardFloat 4s ease-in-out infinite;
        }

        .sport-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: var(--shadow-xl);
        }

        .sport-card img {
            transition: all 0.3s ease;
        }

        .sport-card:hover img {
            transform: scale(1.05);
        }

        @keyframes sportCardFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-3px); }
        }

        .sport-icon {
            width: 60px;
            height: 60px;
            background: var(--gradient-secondary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 1.5rem;
            margin: 0 auto 1rem;
        }

        .sport-name {
            font-weight: 600;
            color: var(--accent-dark-blue);
            margin-bottom: 0.5rem;
        }

        .indoor-activities {
            background: rgba(37, 99, 235, 0.05);
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem 0;
        }

        .indoor-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--accent-dark-blue);
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .indoor-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .indoor-item {
            background: white;
            border-radius: 10px;
            padding: 1rem;
            text-align: center;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .indoor-item:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-sm);
        }

        .indoor-icon {
            font-size: 1.5rem;
            color: var(--accent-blue);
            margin-bottom: 0.5rem;
        }

        /* Co-curricular Activities */
        .co-curricular-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
        }

        .sports-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .sport-card {
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.05), rgba(55, 48, 163, 0.05));
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            animation: sportCardFloat 4s ease-in-out infinite;
        }

        .sport-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: var(--shadow-xl);
        }

        .sport-card img {
            transition: all 0.3s ease;
        }

        .sport-card:hover img {
            transform: scale(1.05);
        }

        @keyframes sportCardFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-3px); }
        }

        .sport-icon {
            width: 60px;
            height: 60px;
            background: var(--gradient-luxury);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-dark);
            font-size: 1.5rem;
            margin: 0 auto 1rem;
        }

        .sport-name {
            font-weight: 600;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
        }

        .indoor-activities {
            background: rgba(30, 58, 138, 0.05);
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem 0;
        }

        .indoor-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .indoor-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .indoor-item {
            background: white;
            border-radius: 10px;
            padding: 1rem;
            text-align: center;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .indoor-item:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-sm);
        }

        .indoor-icon {
            font-size: 1.5rem;
            color: var(--accent-blue);
            margin-bottom: 0.5rem;
        }

        .associations-section {
            background: var(--gradient-primary);
            color: var(--white);
            border-radius: 20px;
            padding: 3rem;
            margin-top: 3rem;
            position: relative;
            overflow: hidden;
        }

        .associations-section::before {
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

        .associations-content {
            position: relative;
            z-index: 1;
        }

        .associations-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
        }

        .associations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .association-item {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .association-item:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
        }

        .association-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .association-name {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .community-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            margin-top: 3rem;
            text-align: center;
        }

        .community-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 2rem;
        }

        .community-activities {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .community-item {
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.05), rgba(55, 48, 163, 0.05));
            border-radius: 15px;
            padding: 2rem;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .community-item:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .community-icon {
            width: 60px;
            height: 60px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 1.5rem;
            margin: 0 auto 1rem;
        }

        .community-name {
            font-weight: 600;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
        }

        /* Mobile Menu Button */
        .mobile-menu-toggle {
            display: none;
            background: var(--gradient-primary);
            border: 2px solid var(--accent-light-blue);
            color: var(--text-inverse);
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .mobile-menu-toggle:hover {
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
                background: rgba(0, 0, 0, 0.05);
                box-shadow: none;
                border: 2px solid #000000;
                border-radius: 0;
                transform: none;
                opacity: 1;
                visibility: visible;
                display: none;
                margin-top: 0;
                min-width: auto;
                backdrop-filter: blur(5px);
            }

            .nav-dropdown.active .nav-dropdown-menu {
                display: block;
            }

            .nav-dropdown-toggle::after {
                display: none;
            }

            .nav-dropdown-menu a {
                padding: 1rem;
                font-size: 1rem;
                border-bottom: 1px solid rgba(0, 0, 0, 0.1);
                background: rgba(255, 255, 255, 0.8);
                color: #000000;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.3px;
                border-left: 3px solid transparent;
                transition: all 0.3s ease;
            }

            .nav-dropdown-menu a:hover {
                background: #000000;
                color: #FFFFFF;
                border-left-color: #000000;
                transform: translateX(5px);
            }

            .nav-dropdown-menu a:last-child {
                border-bottom: none;
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
                font-size: 1.8rem;
            }
            
            .activities-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            
            .activity-card {
                padding: 1.5rem;
            }
            
            .activity-icon {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }
            
            .activity-title {
                font-size: 1.3rem;
            }
            
            .activity-description {
                font-size: 1rem;
            }
            
            .practicum-table {
                font-size: 0.85rem;
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            
            .practicum-table th,
            .practicum-table td {
                padding: 0.75rem 0.5rem;
                min-width: 120px;
            }
            
            .sports-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .sport-card {
                padding: 1.5rem;
            }
            
            .indoor-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 0.75rem;
            }
            
            .associations-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .community-activities {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            
            .main-content {
                padding: 2rem 1rem;
            }
            
            .academic-section,
            .practicum-section,
            .co-curricular-section,
            .community-section {
                padding: 2rem 1.5rem;
            }
            
            .section-header {
                margin-bottom: 2rem;
            }
        }

        @media (max-width: 480px) {
            .page-title {
                font-size: 1.5rem;
            }
            
            .section-title {
                font-size: 1.5rem;
            }
            
            .activity-card,
            .sport-card,
            .academic-section,
            .practicum-section,
            .co-curricular-section,
            .community-section {
                padding: 1rem;
            }
            
            .activity-icon,
            .sport-icon,
            .community-icon {
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
            }
            
            .activity-title,
            .sport-name,
            .community-name {
                font-size: 1.1rem;
            }
            
            .activity-description {
                font-size: 0.9rem;
            }
        }

        /* Premium Activities Gallery Section Styles */
        .activities-gallery-section {
            padding: 6rem 2rem;
            background: linear-gradient(135deg, var(--gray-light) 0%, var(--white) 50%, var(--gray-light) 100%);
            position: relative;
            overflow: hidden;
        }

        .activities-gallery-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 42% 42%, rgba(37, 99, 235, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 58% 58%, rgba(6, 182, 212, 0.03) 0%, transparent 50%),
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="activities-bg-pattern" width="52" height="52" patternUnits="userSpaceOnUse"><circle cx="26" cy="26" r="3.5" fill="rgba(37, 99, 235, 0.06)"/><path d="M16 26 Q26 16, 36 26 T56 26" stroke="rgba(6, 182, 212, 0.04)" stroke-width="1" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23activities-bg-pattern)"/></svg>');
            background-size: cover, cover, 104px 104px;
            background-position: center, center, 0 0;
            animation: activitiesFloat 70s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes activitiesFloat {
            0%, 100% { transform: translateX(0) translateY(0) rotate(0deg); }
            25% { transform: translateX(24px) translateY(-15px) rotate(0.8deg); }
            50% { transform: translateX(48px) translateY(0) rotate(0deg); }
            75% { transform: translateX(24px) translateY(15px) rotate(-0.8deg); }
        }

        .activities-gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(370px, 1fr));
            grid-auto-rows: 350px;
            gap: 2.9rem;
            position: relative;
            z-index: 2;
        }

        .activity-item {
            position: relative;
            overflow: hidden;
            border-radius: 33px;
            box-shadow: var(--shadow-xl);
            transition: all 1.05s cubic-bezier(0.4, 0, 0.2, 1);
            transform-style: preserve-3d;
            transform: translateZ(0);
            background: var(--white);
        }

        .activity-item-large {
            grid-column: span 2;
            grid-row: span 2;
        }

        .activity-item-wide {
            grid-column: span 2;
        }

        .activity-image-wrapper {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
            border-radius: 33px;
        }

        .activity-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 1.25s cubic-bezier(0.4, 0, 0.2, 1);
            transform: scale(1);
            filter: brightness(1) contrast(1) saturate(1);
        }

        .activity-overlay {
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

        .activity-content {
            color: var(--white);
            transform: translateZ(32px);
        }

        .activity-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.05rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            text-shadow: 4px 4px 14px rgba(0, 0, 0, 0.92);
        }

        .activity-description {
            font-size: 1.22rem;
            line-height: 1.95;
            margin-bottom: 2.1rem;
            opacity: 0.94;
        }

        .activity-badges {
            display: flex;
            gap: 1.3rem;
            flex-wrap: wrap;
        }

        .activity-badge {
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

        /* Activities Gallery Hover Effects */
        .activity-item:hover {
            transform: translateY(-38px) translateZ(75px) rotateX(7.5deg) rotateY(-6.5deg);
            box-shadow: 
                var(--shadow-2xl),
                0 0 140px rgba(37, 99, 235, 0.75),
                0 0 280px rgba(6, 182, 212, 0.65);
        }

        .activity-item:hover .activity-image {
            transform: scale(1.23) rotateX(6.5deg) rotateY(-6.5deg);
            filter: brightness(1.32) contrast(1.22) saturate(1.32);
        }

        .activity-item:hover .activity-overlay {
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

        /* Activity Item Animations */
        .activity-item:nth-child(1) { animation: activitySlideIn 1.25s ease-out 0.1s both; }
        .activity-item:nth-child(2) { animation: activitySlideIn 1.25s ease-out 0.2s both; }
        .activity-item:nth-child(3) { animation: activitySlideIn 1.25s ease-out 0.3s both; }
        .activity-item:nth-child(4) { animation: activitySlideIn 1.25s ease-out 0.4s both; }
        .activity-item:nth-child(5) { animation: activitySlideIn 1.25s ease-out 0.5s both; }
        .activity-item:nth-child(6) { animation: activitySlideIn 1.25s ease-out 0.6s both; }
        .activity-item:nth-child(7) { animation: activitySlideIn 1.25s ease-out 0.7s both; }

        @keyframes activitySlideIn {
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

        /* Responsive Activities Gallery */
        @media (max-width: 1024px) {
            .activities-gallery-grid {
                grid-template-columns: repeat(auto-fit, minmax(330px, 1fr));
                grid-auto-rows: 310px;
                gap: 2.4rem;
            }

            .activity-item-large {
                grid-column: span 1;
                grid-row: span 1;
            }

            .activity-item-wide {
                grid-column: span 1;
            }

            .activity-title {
                font-size: 1.75rem;
            }

            .activity-description {
                font-size: 1.12rem;
            }
        }

        @media (max-width: 768px) {
            .activities-gallery-section {
                padding: 4rem 1rem;
            }

            .activities-gallery-grid {
                grid-template-columns: 1fr;
                grid-auto-rows: 350px;
                gap: 2.1rem;
            }

            .activity-item-large,
            .activity-item-wide {
                grid-column: span 1;
                grid-row: span 1;
            }

            .activity-overlay {
                padding: 3.8rem;
            }

            .activity-title {
                font-size: 1.85rem;
            }

            .activity-description {
                font-size: 1.17rem;
            }
        }

        @media (max-width: 480px) {
            .activity-title {
                font-size: 1.65rem;
            }

            .activity-description {
                font-size: 1.08rem;
            }

            .activity-badge {
                font-size: 0.87rem;
                padding: 0.75rem 1.5rem;
            }
        }

        /* Section Container Styles */
        .section-container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .section-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, var(--accent-blue) 0%, var(--accent-cyan) 100%);
            color: var(--white);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 1rem;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
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

        /* Page Header Section */
        .page-header-section {
            background: var(--gradient-primary);
            color: var(--white);
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

        /* Navigation */
        .navbar {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-logo img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 2px solid var(--accent-gold);
        }

        /* Navigation Dropdown */
        .nav-dropdown {
            position: relative;
        }

        .nav-dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            background: var(--white);
            min-width: 200px;
            box-shadow: var(--shadow-lg);
            border-radius: 8px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1001;
        }

        .nav-dropdown.active .nav-dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .nav-dropdown-menu a {
            display: block;
            padding: 0.75rem 1rem;
            color: var(--primary-dark);
            text-decoration: none;
            transition: all 0.3s ease;
            border-bottom: 1px solid var(--border-color);
        }

        .nav-dropdown-menu a:hover {
            background: var(--accent-blue);
            color: var(--white);
        }

        .nav-dropdown-menu a:last-child {
            border-bottom: none;
        }

        /* Mobile Menu Styles */
        .mobile-menu-toggle {
            display: none;
            flex-direction: column;
            gap: 4px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.5rem;
        }

        .mobile-menu-toggle span {
            width: 25px;
            height: 3px;
            background: var(--white);
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .mobile-menu-toggle.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .mobile-menu-toggle.active span:nth-child(2) {
            opacity: 0;
        }

        .mobile-menu-toggle.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -6px);
        }

        @media (max-width: 768px) {
            .mobile-menu-toggle {
                display: flex;
            }

            .nav-links {
                position: fixed;
                top: 100px;
                left: 0;
                right: 0;
                background: var(--white);
                flex-direction: column;
                padding: 1rem;
                box-shadow: var(--shadow-lg);
                transform: translateY(-100%);
                transition: all 0.3s ease;
                z-index: 999;
            }

            .nav-links.active {
                transform: translateY(0);
            }

            .nav-links .nav-link {
                color: var(--primary-dark);
                padding: 1rem;
                border-bottom: 1px solid var(--border-color);
                text-align: center;
            }

            .nav-dropdown-menu {
                position: static;
                background: var(--gray-light);
                box-shadow: none;
                opacity: 1;
                visibility: visible;
                transform: none;
                display: none;
            }

            .nav-dropdown.active .nav-dropdown-menu {
                display: block;
            }
        }

    /* Premium Footer Styling */
        .footer {
            background: var(--gradient-primary);
            color: var(--white);
            padding: 5rem 2rem 2rem;
            margin-top: 6rem;
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
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .footer-section h3 {
            font-size: 1.25rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            color: var(--accent-gold);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            transform: translateZ(10px);
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 1rem;
            transform: translateZ(5px);
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
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
            transition: left 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--accent-gold);
            transform: translateX(8px) translateZ(5px);
        }

        .footer-links a:hover::before {
            left: 100%;
        }

        .contact-info p {
            margin-bottom: 1rem;
            color: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 500;
            transform: translateZ(5px);
        }

        .contact-info i {
            color: var(--accent-gold);
            width: 20px;
            font-size: 1.125rem;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            z-index: 2;
        }

        .footer-title {
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            color: var(--accent-gold);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            transform: translateZ(10px);
        }

        .footer-subtitle {
            font-size: 1.125rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            transform: translateZ(5px);
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
            color: var(--white);
            padding: 1rem 2rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s ease;
            font-size: 1rem;
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
            transition: left 0.3s ease;
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
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            color: rgba(255, 255, 255, 0.7);
            font-weight: 500;
            transform: translateZ(5px);
        }

        @media (max-width: 768px) {
            .footer {
                padding: 4rem 1rem 2rem;
            }

            .footer-grid {
                gap: 1.5rem;
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
            <h1 class="page-title">Institutional Activities</h1>
            <div class="breadcrumb">
                <p>Home / School Life / Activities</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Academic Activities Section -->
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">5.0 Institutional Activities</h2>
                <p class="section-subtitle">Comprehensive academic and co-curricular activities for holistic development</p>
            </div>
            
            <div class="academic-section">
                <div class="section-header">
                    <h3 class="section-title">5.1 Academic Activities</h3>
                    <p class="section-subtitle">Core academic programs and learning experiences</p>
                </div>
                
                <div class="activities-grid">
                    <div class="activity-card">
                        <div class="activity-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h4 class="activity-title">Teaching & Learning</h4>
                        <p class="activity-description">
                            Comprehensive teaching and learning activities through lectures, 
                            interactive sessions, and modern educational methodologies.
                        </p>
                    </div>
                    
                    <div class="activity-card" style="position: relative;">
                        <img src="assets/images/academic/students-in-skill-laboratory-in-practical-training.jpg" alt="ISNM Practical Training - Skills Laboratory" class="activity-image">
                        <div class="activity-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                            <i class="fas fa-flask"></i>
                        </div>
                        <h4 class="activity-title">Practical Training</h4>
                        <p class="activity-description">
                            Hands-on practical training in skills laboratory in school and 
                            practicum in Hospitals/Health Centres.
                        </p>
                    </div>
                    
                    <div class="activity-card">
                        <div class="activity-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h4 class="activity-title">Counseling Services</h4>
                        <p class="activity-description">
                            Professional counseling services for students and staff to support 
                            mental health and personal development.
                        </p>
                    </div>
                    
                    <div class="activity-card">
                        <div class="activity-icon">
                            <i class="fas fa-book-medical"></i>
                        </div>
                        <h4 class="activity-title">Assessment & Evaluation</h4>
                        <p class="activity-description">
                            Regular assessment of practical tool books and midwifery case books 
                            to monitor progress and competency development.
                        </p>
                    </div>
                    
                    <div class="activity-card">
                        <img src="assets/images/academic/certificate-in-nursing-students-in-examamination-room.jpg" alt="ISNM Examination Room - Academic Assessment" class="activity-image">
                        <div class="activity-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <h4 class="activity-title">Testing & Examinations</h4>
                        <p class="activity-description">
                            Setting and marking tests, exams, and case studies to evaluate 
                            student learning and academic achievement.
                        </p>
                    </div>
                    
                    <div class="activity-card" style="position: relative;">
                        <img src="assets/images/academic/revision-session-at-the-school-library.jpg" alt="ISNM Library Revision - Academic Study" style="width: 100%; height: 150px; object-fit: cover; border-radius: 10px;">
                        <div class="activity-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                            <i class="fas fa-book"></i>
                        </div>
                        <h4 class="activity-title">Library Revision Sessions</h4>
                        <p class="activity-description">
                            Students conducting revision sessions in the school library 
                            for enhanced learning and exam preparation.
                        </p>
                    </div>
                    
                    <div class="activity-card" style="position: relative;">
                        <img src="assets/images/academic/diploma-in-nursing-and-midwifery-extension-images-for-students.jpg" alt="ISNM Diploma Programs - Advanced Training" class="activity-image">
                        <div class="activity-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h4 class="activity-title">Diploma Programs</h4>
                        <p class="activity-description">
                            Advanced diploma programs in nursing and midwifery with 
                            comprehensive curriculum and clinical training.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Practicum Sites Section -->
        <section class="section">
            <div class="practicum-section">
                <div class="section-header">
                    <h3 class="section-title">5.1.1 Practicum Sites</h3>
                    <p class="section-subtitle">Partner hospitals for clinical training and practical experience</p>
                </div>
                
                <div class="practicum-intro">
                    <p>
                        Iganga School of Nursing and Midwifery entered into a Memorandum of Understanding (MOU) 
                        with Iganga, Bugiri, Busolwe, Tororo, Masafu and Mbale Regional Referral hospitals for 
                        the purpose of giving our students hands-on practical experience. Clinical mentors at the 
                        respective hospitals assist the students on a daily basis while our tutors conduct support 
                        supervision on a weekly basis. By the time of completion of the course, the students have 
                        had an opportunity to rotate in all the hospitals.
                    </p>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem; margin-top: 2rem;">
                        <img src="assets/images/academic/student-st-practicum-sites1.jpg" alt="ISNM Practicum Training - Hospital Experience" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">
                        <img src="assets/images/academic/student-at-practicum-site2.jpg" alt="ISNM Clinical Training - Healthcare Practice" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">
                    </div>
                </div>
                
                <table class="practicum-table">
                    <thead>
                        <tr>
                            <th>Name of Hospital</th>
                            <th>Ownership</th>
                            <th>Distance from School</th>
                            <th>Bed Capacity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Iganga Hospital</strong></td>
                            <td><span class="ownership-badge government">Government</span></td>
                            <td><span class="distance-badge"><i class="fas fa-map-marker-alt"></i> 3km</span></td>
                            <td><span class="bed-capacity"><i class="fas fa-bed"></i> 200</span></td>
                        </tr>
                        <tr>
                            <td><strong>Bugiri Hospital</strong></td>
                            <td><span class="ownership-badge government">Government</span></td>
                            <td><span class="distance-badge"><i class="fas fa-map-marker-alt"></i> 30km</span></td>
                            <td><span class="bed-capacity"><i class="fas fa-bed"></i> 200</span></td>
                        </tr>
                        <tr>
                            <td><strong>Tororo Hospital</strong></td>
                            <td><span class="ownership-badge government">Government</span></td>
                            <td><span class="distance-badge"><i class="fas fa-map-marker-alt"></i> 50km</span></td>
                            <td><span class="bed-capacity"><i class="fas fa-bed"></i> 200</span></td>
                        </tr>
                        <tr>
                            <td><strong>Busolwe Hospital</strong></td>
                            <td><span class="ownership-badge government">Government</span></td>
                            <td><span class="distance-badge"><i class="fas fa-map-marker-alt"></i> 40km</span></td>
                            <td><span class="bed-capacity"><i class="fas fa-bed"></i> 200</span></td>
                        </tr>
                        <tr>
                            <td><strong>Masafu Hospital</strong></td>
                            <td><span class="ownership-badge government">Government</span></td>
                            <td><span class="distance-badge"><i class="fas fa-map-marker-alt"></i> 40km</span></td>
                            <td><span class="bed-capacity"><i class="fas fa-bed"></i> 200</span></td>
                        </tr>
                        <tr>
                            <td><strong>Mbale Regional Referral Hospital</strong></td>
                            <td><span class="ownership-badge government">Government</span></td>
                            <td><span class="distance-badge"><i class="fas fa-map-marker-alt"></i> 80km</span></td>
                            <td><span class="bed-capacity"><i class="fas fa-bed"></i> 300</span></td>
                        </tr>
                        <tr>
                            <td><strong>Kayunga Hospital</strong></td>
                            <td><span class="ownership-badge government">Government</span></td>
                            <td><span class="distance-badge"><i class="fas fa-map-marker-alt"></i> 80km</span></td>
                            <td><span class="bed-capacity"><i class="fas fa-bed"></i> 200</span></td>
                        </tr>
                    </tbody>
                </table>
                
                <p style="margin-top: 2rem; text-align: center; color: var(--text-secondary);">
                    During each semester at least 8 (Eight) weeks are spent at the practicum sites while the rest 
                    of the time is for block study, skills laboratory training, tests and examinations. At the end 
                    of each placement, the respective Principal Nursing Officers compile a report about the student's 
                    performance and discipline and corrective action is taken where necessary.
                </p>
            </div>
        </section>

        <!-- Premium Activities Gallery Section -->
        <section class="activities-gallery-section">
            <div class="section-container">
                <div class="section-header">
                    <div class="section-badge">
                        <i class="fas fa-images"></i>
                        <span>Activities Showcase</span>
                    </div>
                    <h2 class="section-title">Experience Our Vibrant Campus Life</h2>
                    <p class="section-subtitle">
                        Discover our diverse range of activities including sports, cultural events, 
                        community service, and co-curricular programs for holistic student development.
                    </p>
                </div>
                
                <div class="activities-gallery-grid">
                    <div class="activity-item activity-item-large">
                        <div class="activity-image-wrapper">
                            <img src="assets/images/activities/footbal-team-student-images1.jpg" alt="ISNM Football Team - Professional Training Session" class="activity-image">
                            <div class="activity-overlay">
                                <div class="activity-content">
                                    <h3 class="activity-title">Football Excellence</h3>
                                    <p class="activity-description">Professional football training with competitive matches and tournaments against partner institutions</p>
                                    <div class="activity-badges">
                                        <span class="activity-badge">Sports</span>
                                        <span class="activity-badge">Teamwork</span>
                                        <span class="activity-badge">Excellence</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-image-wrapper">
                            <img src="assets/images/activities/footbal-team-student-images2.jpg" alt="ISNM Football Match - Competitive Sports" class="activity-image">
                            <div class="activity-overlay">
                                <div class="activity-content">
                                    <h3 class="activity-title">Competitive Matches</h3>
                                    <p class="activity-description">Regular competitions with Uganda Christian University and other institutions</p>
                                    <div class="activity-badges">
                                        <span class="activity-badge">Competition</span>
                                        <span class="activity-badge">Victory</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-image-wrapper">
                            <img src="assets/images/activities/footbal-team-student-images3.jpg" alt="ISNM Football Training - Skill Development" class="activity-image">
                            <div class="activity-overlay">
                                <div class="activity-content">
                                    <h3 class="activity-title">Professional Coaching</h3>
                                    <p class="activity-description">Expert coaching sessions focusing on technical skills and sportsmanship</p>
                                    <div class="activity-badges">
                                        <span class="activity-badge">Training</span>
                                        <span class="activity-badge">Development</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="activity-item activity-item-wide">
                        <div class="activity-image-wrapper">
                            <img src="assets/images/achievements/graduation-day-students-matching-while-playing-trumpets-and-drum.jpg" alt="ISNM Graduation Celebration - Musical Excellence" class="activity-image">
                            <div class="activity-overlay">
                                <div class="activity-content">
                                    <h3 class="activity-title">Graduation Celebrations</h3>
                                    <p class="activity-description">Vibrant graduation ceremonies with musical performances and cultural displays</p>
                                    <div class="activity-badges">
                                        <span class="activity-badge">Achievement</span>
                                        <span class="activity-badge">Celebration</span>
                                        <span class="activity-badge">Music</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-image-wrapper">
                            <img src="assets/images/achievements/graduation-ceremony.jpg" alt="ISNM Academic Excellence - Graduation Success" class="activity-image">
                            <div class="activity-overlay">
                                <div class="activity-content">
                                    <h3 class="activity-title">Academic Excellence</h3>
                                    <p class="activity-description">Celebrating academic achievements and professional success of our graduates</p>
                                    <div class="activity-badges">
                                        <span class="activity-badge">Excellence</span>
                                        <span class="activity-badge">Success</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-image-wrapper">
                            <img src="assets/images/achievements/nurses-and-midwifes-students-matching-on-graduation-day.jpg" alt="ISNM Student Achievement - Professional Pride" class="activity-image">
                            <div class="activity-overlay">
                                <div class="activity-content">
                                    <h3 class="activity-title">Professional Pride</h3>
                                    <p class="activity-description">Students celebrating their journey to becoming healthcare professionals</p>
                                    <div class="activity-badges">
                                        <span class="activity-badge">Pride</span>
                                        <span class="activity-badge">Professional</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-image-wrapper">
                            <img src="assets/images/achievements/graduants-celebrating-their-graduation.jpg" alt="ISNM Student Joy - Achievement Celebration" class="activity-image">
                            <div class="activity-overlay">
                                <div class="activity-content">
                                    <h3 class="activity-title">Student Joy</h3>
                                    <p class="activity-description">Pure joy and excitement as graduates celebrate their academic achievements</p>
                                    <div class="activity-badges">
                                        <span class="activity-badge">Joy</span>
                                        <span class="activity-badge">Celebration</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="activity-item activity-item-large">
                        <div class="activity-image-wrapper">
                            <img src="assets/images/hero/students-standing-upstairs-of-their-classroom-in-breaktime.jpg" alt="ISNM Campus Life - Student Community" class="activity-image">
                            <div class="activity-overlay">
                                <div class="activity-content">
                                    <h3 class="activity-title">Campus Community</h3>
                                    <p class="activity-description">Vibrant student life with friendship, collaboration, and shared learning experiences</p>
                                    <div class="activity-badges">
                                        <span class="activity-badge">Community</span>
                                        <span class="activity-badge">Friendship</span>
                                        <span class="activity-badge">Learning</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-image-wrapper">
                            <img src="assets/images/hero/students-in-class.jpg" alt="ISNM Learning Environment - Academic Focus" class="activity-image">
                            <div class="activity-overlay">
                                <div class="activity-content">
                                    <h3 class="activity-title">Learning Environment</h3>
                                    <p class="activity-description">Modern classroom settings fostering academic excellence and interactive learning</p>
                                    <div class="activity-badges">
                                        <span class="activity-badge">Education</span>
                                        <span class="activity-badge">Technology</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-image-wrapper">
                            <img src="assets/images/hero/graduations-hero.jpg" alt="ISNM Graduation Success - Professional Achievement" class="activity-image">
                            <div class="activity-overlay">
                                <div class="activity-content">
                                    <h3 class="activity-title">Professional Achievement</h3>
                                    <p class="activity-description">Graduates ready to make their mark in the healthcare industry</p>
                                    <div class="activity-badges">
                                        <span class="activity-badge">Success</span>
                                        <span class="activity-badge">Career</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Co-curricular Activities Section -->
        <section class="section">
            <div class="co-curricular-section">
                <div class="section-header">
                    <h3 class="section-title">5.2 Co-curricular Activities</h3>
                    <p class="section-subtitle">Extra-curricular activities for holistic student development</p>
                </div>
                
                <div class="sports-grid">
                    <div class="sport-card" style="position: relative;">
                        <img src="assets/images/activities/footbal-team-student-images1.jpg" alt="ISNM Football Team in Training" title="ISNM Football Team - Regular Training Session" style="width: 100%; height: 150px; object-fit: cover; border-radius: 10px;">
                        <div class="sport-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                            <i class="fas fa-futbol"></i>
                        </div>
                        <h4 class="sport-name">Football Excellence</h4>
                        <p>Professional football training with competitive matches and tournaments against partner institutions</p>
                    </div>
                    
                    <div class="sport-card" style="position: relative;">
                        <img src="assets/images/activities/footbal-team-student-images2.jpg" alt="ISNM Football Match Against UCU" title="ISNM Football Team - Competitive Match" style="width: 100%; height: 150px; object-fit: cover; border-radius: 10px;">
                        <div class="sport-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <h4 class="sport-name">Competitive Matches</h4>
                        <p>Regular friendly matches and competitive tournaments with Uganda Christian University and other institutions</p>
                    </div>
                    
                    <div class="sport-card" style="position: relative;">
                        <img src="assets/images/activities/footbal-team-student-images3.jpg" alt="ISNM Football Professional Coaching" title="ISNM Football Team - Professional Coaching Session" style="width: 100%; height: 150px; object-fit: cover; border-radius: 10px;">
                        <div class="sport-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                            <i class="fas fa-whistle"></i>
                        </div>
                        <h4 class="sport-name">Professional Coaching</h4>
                        <p>Expert coaching sessions focusing on technical skills, teamwork, and sportsmanship development</p>
                    </div>
                    
                    <div class="sport-card" style="position: relative;">
                        <img src="assets/images/achievements/graduation-day-students-matching-while-playing-trumpets-and-drum.jpg" alt="ISNM Sports Celebration - Musical Performances" style="width: 100%; height: 150px; object-fit: cover; border-radius: 10px;">
                        <div class="sport-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                            <i class="fas fa-music"></i>
                        </div>
                        <h4 class="sport-name">Sports Celebrations</h4>
                        <p>Vibrant celebrations with musical performances during sports victories and special events</p>
                    </div>
                    
                    <div class="sport-card" style="position: relative;">
                        <img src="assets/images/achievements/nurses-and-midwifes-students-matching-on-graduation-day.jpg" alt="ISNM Student Sports - Team Spirit" style="width: 100%; height: 150px; object-fit: cover; border-radius: 10px;">
                        <div class="sport-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4 class="sport-name">Team Spirit</h4>
                        <p>Building camaraderie and teamwork through sports activities and collaborative events</p>
                    </div>
                    
                    <div class="sport-card" style="position: relative;">
                        <img src="assets/images/hero/students-sitting-in-the-graduation-use-it-in-hero-and-pages.jpg" alt="ISNM Student Achievement - Sports Recognition" style="width: 100%; height: 150px; object-fit: cover; border-radius: 10px;">
                        <div class="sport-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                            <i class="fas fa-medal"></i>
                        </div>
                        <h4 class="sport-name">Achievement Recognition</h4>
                        <p>Celebrating student achievements in sports and extracurricular activities with awards and recognition</p>
                    </div>
                </div>
                
                <div class="indoor-activities">
                    <h3 class="indoor-title">Indoor Games</h3>
                    <div class="indoor-grid">
                        <div class="indoor-item">
                            <div class="indoor-icon">
                                <i class="fas fa-chess"></i>
                            </div>
                            <h4>Chess</h4>
                        </div>
                        <div class="indoor-item">
                            <div class="indoor-icon">
                                <i class="fas fa-dice"></i>
                            </div>
                            <h4>Draft</h4>
                        </div>
                        <div class="indoor-item">
                            <div class="indoor-icon">
                                <i class="fas fa-puzzle-piece"></i>
                            </div>
                            <h4>Scrabble</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Cultural and Religious Associations -->
        <section class="section">
            <div class="associations-section">
                <div class="associations-content">
                    <h2 class="associations-title">Cultural & Religious Associations</h2>
                    <div class="associations-grid">
                        <div class="association-item" style="position: relative;">
                            <img src="assets/images/achievements/graduation-day-students-matching-while-playing-trumpets-and-drum.jpg" alt="ISNM Music & Dance - Cultural Performances" style="width: 100%; height: 120px; object-fit: cover; border-radius: 10px; margin-bottom: 1rem;">
                            <div class="association-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                                <i class="fas fa-music"></i>
                            </div>
                            <h4 class="association-name">Music, Dance & Drama</h4>
                            <p>Cultural performances showcasing traditional and contemporary arts during graduation ceremonies and special events</p>
                        </div>
                        
                        <div class="association-item" style="position: relative;">
                            <img src="assets/images/achievements/nurses-and-midwifes-students-matching-on-graduation-day.jpg" alt="ISNM Cultural Heritage - Basoga Nseete" style="width: 100%; height: 120px; object-fit: cover; border-radius: 10px; margin-bottom: 1rem;">
                            <div class="association-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                                <i class="fas fa-users"></i>
                            </div>
                            <h4 class="association-name">Basoga Nseete</h4>
                            <p>Local cultural association promoting Basoga heritage and traditional values among students</p>
                        </div>
                        
                        <div class="association-item" style="position: relative;">
                            <img src="assets/images/achievements/graduants-rejoicing.jpg" alt="ISNM Westerners Association - Cultural Diversity" style="width: 100%; height: 120px; object-fit: cover; border-radius: 10px; margin-bottom: 1rem;">
                            <div class="association-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                                <i class="fas fa-globe"></i>
                            </div>
                            <h4 class="association-name">Westerners Association</h4>
                            <p>Regional cultural group celebrating diverse backgrounds and fostering unity among students</p>
                        </div>
                        
                        <div class="association-item" style="position: relative;">
                            <img src="assets/images/achievements/graduation-parad-2023-students-holding-the-banner.jpg" alt="ISNM Nkobazambogo - Cultural Pride" style="width: 100%; height: 120px; object-fit: cover; border-radius: 10px; margin-bottom: 1rem;">
                            <div class="association-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                                <i class="fas fa-crown"></i>
                            </div>
                            <h4 class="association-name">Nkobazambogo</h4>
                            <p>Cultural heritage association preserving and promoting traditional customs and practices</p>
                        </div>
                        
                        <div class="association-item" style="position: relative;">
                            <img src="assets/images/achievements/iganga-school-of-nursing-celebrating-3rd-graduation.jpg" alt="ISNM Religious Associations - Faith Communities" style="width: 100%; height: 120px; object-fit: cover; border-radius: 10px; margin-bottom: 1rem;">
                            <div class="association-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                                <i class="fas fa-pray"></i>
                            </div>
                            <h4 class="association-name">Religious Associations</h4>
                            <p>Various faith-based groups providing spiritual support and organizing religious activities</p>
                        </div>
                        
                        <div class="association-item" style="position: relative;">
                            <img src="assets/images/achievements/mama-baby-in-her-graduation.jpg" alt="ISNM Cultural Excellence - Achievement Celebration" style="width: 100%; height: 120px; object-fit: cover; border-radius: 10px; margin-bottom: 1rem;">
                            <div class="association-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                                <i class="fas fa-star"></i>
                            </div>
                            <h4 class="association-name">Cultural Excellence</h4>
                            <p>Showcasing cultural diversity and excellence through various celebrations and performances</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Community Service -->
        <section class="section">
            <div class="community-section">
                <h2 class="community-title">Community Service Activities</h2>
                <div class="community-activities">
                    <div class="community-item" style="position: relative;">
                        <img src="assets/images/hero/students-standing-upstairs-of-their-classroom-in-breaktime.jpg" alt="ISNM Community Service - Town Cleaning" style="width: 100%; height: 150px; object-fit: cover; border-radius: 10px; margin-bottom: 1rem;">
                        <div class="community-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                            <i class="fas fa-broom"></i>
                        </div>
                        <h3 class="community-name">Town Cleaning</h3>
                        <p>Students actively participate in cleaning Iganga Town, promoting environmental awareness and civic responsibility</p>
                    </div>
                    
                    <div class="community-item" style="position: relative;">
                        <img src="assets/images/hero/students-sitting-in-the-graduation-use-it-in-hero-and-pages.jpg" alt="ISNM Charitable Work - Community Support" style="width: 100%; height: 150px; object-fit: cover; border-radius: 10px; margin-bottom: 1rem;">
                        <div class="community-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h3 class="community-name">Charitable Work</h3>
                        <p>Regular visits to prisons and hospitals to provide care and support to the needy in our community</p>
                    </div>
                    
                    <div class="community-item" style="position: relative;">
                        <img src="assets/images/hero/students-in-class.jpg" alt="ISNM Health Outreach - Medical Services" style="width: 100%; height: 150px; object-fit: cover; border-radius: 10px; margin-bottom: 1rem;">
                        <div class="community-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h3 class="community-name">Health Outreach</h3>
                        <p>Community health education programs and medical services provided by our nursing students</p>
                    </div>
                    
                    <div class="community-item" style="position: relative;">
                        <img src="assets/images/academic/student-at-practicum-site2.jpg" alt="ISNM Healthcare Training - Community Service" style="width: 100%; height: 150px; object-fit: cover; border-radius: 10px; margin-bottom: 1rem;">
                        <div class="community-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                            <i class="fas fa-medkit"></i>
                        </div>
                        <h3 class="community-name">Medical Camps</h3>
                        <p>Free medical camps and health screening services organized in local communities</p>
                    </div>
                    
                    <div class="community-item" style="position: relative;">
                        <img src="assets/images/academic/student-st-practicum-sites1.jpg" alt="ISNM Public Health - Community Education" style="width: 100%; height: 150px; object-fit: cover; border-radius: 10px; margin-bottom: 1rem;">
                        <div class="community-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3 class="community-name">Health Education</h3>
                        <p>Educational programs on hygiene, nutrition, and disease prevention for community members</p>
                    </div>
                    
                    <div class="community-item" style="position: relative;">
                        <img src="assets/images/academic/students-in-skill-laboratory-in-practical-training.jpg" alt="ISNM Skills Training - Community Support" style="width: 100%; height: 150px; object-fit: cover; border-radius: 10px; margin-bottom: 1rem;">
                        <div class="community-icon" style="position: absolute; top: 10px; right: 10px; background: var(--gradient-luxury);">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <h3 class="community-name">Emergency Response</h3>
                        <p>Emergency medical response training and participation in community disaster relief efforts</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Campus Facilities Showcase -->
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">Campus Facilities & Infrastructure</h2>
                <p class="section-subtitle">State-of-the-art facilities supporting comprehensive learning and student life</p>
            </div>
            
            <div class="activities-gallery-section" style="background: var(--gradient-clean);">
                <div class="section-container">
                    <div class="activities-gallery-grid">
                        <div class="activity-item activity-item-large">
                            <div class="activity-image-wrapper">
                                <img src="assets/images/facilities/administration-block.jpg" alt="ISNM Administration Block - Professional Leadership" class="activity-image">
                                <div class="activity-overlay">
                                    <div class="activity-content">
                                        <h3 class="activity-title">Administration Block</h3>
                                        <p class="activity-description">Modern administrative facilities providing efficient management and student support services</p>
                                        <div class="activity-badges">
                                            <span class="activity-badge">Administration</span>
                                            <span class="activity-badge">Management</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-image-wrapper">
                                <img src="assets/images/facilities/classroom-building.jpg" alt="ISNM Classroom Building - Modern Learning" class="activity-image">
                                <div class="activity-overlay">
                                    <div class="activity-content">
                                        <h3 class="activity-title">Classroom Building</h3>
                                        <p class="activity-description">Well-equipped classrooms fostering interactive learning experiences</p>
                                        <div class="activity-badges">
                                            <span class="activity-badge">Learning</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-image-wrapper">
                                <img src="assets/images/facilities/dinnin-hall-or-main-hall.jpg" alt="ISNM Main Hall - Events & Gatherings" class="activity-image">
                                <div class="activity-overlay">
                                    <div class="activity-content">
                                        <h3 class="activity-title">Main Hall</h3>
                                        <p class="activity-description">Spacious hall for events, ceremonies, and large gatherings</p>
                                        <div class="activity-badges">
                                            <span class="activity-badge">Events</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="activity-item activity-item-wide">
                            <div class="activity-image-wrapper">
                                <img src="assets/images/facilities/girls-hostel.jpg" alt="ISNM Girls Hostel - Comfortable Living" class="activity-image">
                                <div class="activity-overlay">
                                    <div class="activity-content">
                                        <h3 class="activity-title">Girls Hostel</h3>
                                        <p class="activity-description">Safe and comfortable accommodation facilities with modern amenities</p>
                                        <div class="activity-badges">
                                            <span class="activity-badge">Accommodation</span>
                                            <span class="activity-badge">Safety</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-image-wrapper">
                                <img src="assets/images/facilities/diploma-hostel.jpg" alt="ISNM Diploma Hostel - Student Living" class="activity-image">
                                <div class="activity-overlay">
                                    <div class="activity-content">
                                        <h3 class="activity-title">Diploma Hostel</h3>
                                        <p class="activity-description">Quality accommodation for diploma program students</p>
                                        <div class="activity-badges">
                                            <span class="activity-badge">Living</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-image-wrapper">
                                <img src="assets/images/facilities/school-kitchen.jpg" alt="ISNM School Kitchen - Nutrition Services" class="activity-image">
                                <div class="activity-overlay">
                                    <div class="activity-content">
                                        <h3 class="activity-title">School Kitchen</h3>
                                        <p class="activity-description">Modern kitchen facilities providing nutritious meals for students</p>
                                        <div class="activity-badges">
                                            <span class="activity-badge">Nutrition</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-image-wrapper">
                                <img src="assets/images/facilities/school-borehole-a-student-is-fetching-water.jpg" alt="ISNM Water Supply - Clean Water Access" class="activity-image">
                                <div class="activity-overlay">
                                    <div class="activity-content">
                                        <h3 class="activity-title">Water Supply</h3>
                                        <p class="activity-description">Clean water facilities ensuring health and hygiene standards</p>
                                        <div class="activity-badges">
                                            <span class="activity-badge">Health</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="activity-item activity-item-wide">
                            <div class="activity-image-wrapper">
                                <img src="assets/images/facilities/school-mini-buses-2-costers.jpg" alt="ISNM Transport - Student Mobility" class="activity-image">
                                <div class="activity-overlay">
                                    <div class="activity-content">
                                        <h3 class="activity-title">Transport Services</h3>
                                        <p class="activity-description">School buses providing safe transportation for students and staff</p>
                                        <div class="activity-badges">
                                            <span class="activity-badge">Transport</span>
                                            <span class="activity-badge">Safety</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

        // Add parallax effect to header (disabled on mobile for performance)
        if (!isMobile) {
            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const header = document.querySelector('.luxury-header');
                if (header) {
                    header.style.transform = `translateY(${scrolled * 0.5}px)`;
                }
            });
        }

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
</body>
</html>
