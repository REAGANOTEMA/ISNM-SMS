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
    <title>Governance - Iganga School of Nursing and Midwifery</title>
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
            background: var(--gradient-3d-clean);
            color: var(--medical-dark);
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
            color: var(--primary-blue);
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
            color: var(--text-secondary);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Board of Directors - Hospital-Quality 3D */
        .board-section {
            background: linear-gradient(135deg, rgba(255,255,255,0.95), rgba(248,248,255,0.9));
            border-radius: 30px;
            padding: 3.5rem;
            box-shadow: 
                0 15px 40px rgba(26,26,26,0.15),
                0 30px 80px rgba(26,26,26,0.1),
                inset 0 2px 0 rgba(255,215,0,0.1);
            border: 2px solid rgba(26,26,26,0.08);
            margin-bottom: 3rem;
            transform-style: preserve-3d;
            position: relative;
            backdrop-filter: blur(15px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .board-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--accent-gold), var(--primary-dark), var(--accent-gold));
            border-radius: 30px 30px 0 0;
            opacity: 0.9;
            animation: boardGlow 4s ease-in-out infinite;
        }

        .board-section::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="board-pattern" width="40" height="40" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="3" fill="rgba(26,26,26,0.05)"/><path d="M10 20 Q20 10, 30 20 T50 20" stroke="rgba(255,215,0,0.08)" stroke-width="2" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23board-pattern)"/></svg>'),
                radial-gradient(circle at 20% 80%, rgba(255,215,0,0.02) 0%, transparent 50%);
            background-size: 80px 80px, cover;
            background-position: 0 0, center;
            transform: translateX(-100%) translateY(-100%);
            transition: transform 1.5s ease;
            pointer-events: none;
            opacity: 0.4;
            border-radius: 30px;
        }

        .board-section:hover {
            transform: translateY(-5px) translateZ(15px) rotateX(1deg);
            box-shadow: 
                0 25px 60px rgba(26,26,26,0.2),
                0 50px 120px rgba(26,26,26,0.15),
                inset 0 3px 0 rgba(255,215,0,0.2);
            border-color: var(--accent-gold);
            background: linear-gradient(135deg, rgba(255,255,255,0.98), rgba(255,248,220,0.95));
        }

        .board-section:hover::after {
            transform: translateX(100%) translateY(100%);
            opacity: 0.6;
        }

        @keyframes boardGlow {
            0%, 100% { opacity: 0.7; }
            50% { opacity: 1; }
        }

        .board-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .board-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--medical-primary);
            margin-bottom: 1rem;
            transform-style: preserve-3d;
            transform: translateZ(10px);
        }

        .board-description {
            color: var(--medical-secondary);
            font-size: 1.1rem;
            max-width: 800px;
            margin: 0 auto 2rem;
            line-height: 1.8;
        }

        .directors-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
            align-items: stretch;
        }

        .director-card {
            background: linear-gradient(135deg, rgba(255,255,255,0.95), rgba(248,248,255,0.9));
            border-radius: 25px;
            padding: 3rem;
            text-align: center;
            border: 2px solid rgba(26,26,26,0.08);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 
                0 10px 30px rgba(26,26,26,0.15),
                0 20px 60px rgba(26,26,26,0.1),
                inset 0 1px 0 rgba(255,255,255,0.8);
            transform-style: preserve-3d;
            transform: translateZ(0) rotateX(0deg);
            display: flex;
            flex-direction: column;
            align-items: center;
            backdrop-filter: blur(10px);
        }

        .director-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--accent-gold), var(--primary-dark), var(--accent-gold));
            transform: scaleX(0);
            transition: transform 0.6s ease;
            border-radius: 25px 25px 0 0;
            animation: directorGlow 3s ease-in-out infinite;
        }

        .director-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="medical-director-pattern" width="30" height="30" patternUnits="userSpaceOnUse"><circle cx="15" cy="15" r="2" fill="rgba(26,26,26,0.08)"/><path d="M5 15 Q15 5, 25 15 T45 15" stroke="rgba(255,215,0,0.15)" stroke-width="1" fill="none"/><circle cx="30" cy="0" r="1" fill="rgba(255,215,0,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23medical-director-pattern)"/></svg>'),
                radial-gradient(circle at 50% 50%, rgba(255,215,0,0.03) 0%, transparent 70%);
            background-size: 60px 60px, cover;
            background-position: 0 0, center;
            transform: translateX(-100%) translateY(-100%);
            transition: transform 1.2s ease;
            pointer-events: none;
            opacity: 0.6;
        }

        .director-card:hover {
            transform: translateY(-12px) translateZ(25px) rotateX(3deg) rotateY(2deg);
            box-shadow: 
                0 20px 50px rgba(26,26,26,0.25),
                0 40px 80px rgba(26,26,26,0.15),
                inset 0 2px 0 rgba(255,215,0,0.2);
            border-color: var(--accent-gold);
            background: linear-gradient(135deg, rgba(255,255,255,0.98), rgba(255,248,220,0.95));
        }

        .director-card:hover::before {
            transform: scaleX(1);
            animation: directorPulse 2s ease-in-out infinite;
        }

        .director-card:hover::after {
            transform: translateX(100%) translateY(100%);
            opacity: 0.8;
        }

        .director-avatar {
            width: 220px;
            height: 220px;
            border-radius: 30px;
            margin: 0 auto 3rem;
            overflow: hidden;
            position: relative;
            box-shadow: 
                0 20px 50px rgba(26,26,26,0.25),
                0 40px 100px rgba(26,26,26,0.15),
                0 60px 150px rgba(26,26,26,0.1),
                inset 0 0 40px rgba(255,215,0,0.4);
            animation: director3DFloat 6s ease-in-out infinite;
            transition: all 1s cubic-bezier(0.4, 0, 0.2, 1);
            border: 6px solid transparent;
            background: linear-gradient(white, white) padding-box,
                        linear-gradient(135deg, var(--accent-gold), var(--primary-dark), var(--accent-gold)) border-box;
            transform-style: preserve-3d;
        }

        .director-avatar:hover {
            transform: scale(1.08) rotateY(12deg) translateZ(30px);
            box-shadow: 
                0 25px 60px rgba(26,26,26,0.3),
                0 50px 100px rgba(26,26,26,0.2),
                inset 0 0 40px rgba(255,215,0,0.4);
            border-color: var(--accent-gold);
        }

        .director-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            filter: brightness(1.08) contrast(1.08) saturate(1.1);
        }

        .director-avatar:hover img {
            transform: scale(1.08) rotateY(-8deg);
            filter: brightness(1.15) contrast(1.15) saturate(1.2);
        }

        .director-avatar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, transparent 30%, rgba(255,215,0,0.4) 50%, transparent 70%);
            transform: translateX(-100%) translateY(-100%);
            transition: transform 1.2s ease;
            pointer-events: none;
            border-radius: 25px;
            opacity: 0.8;
        }

        .director-avatar:hover::before {
            transform: translateX(100%) translateY(100%);
        }

        .director-rank {
            position: absolute;
            top: -15px;
            right: -15px;
            background: linear-gradient(135deg, var(--accent-gold), var(--primary-dark));
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 1.4rem;
            box-shadow: 
                0 8px 25px rgba(255,215,0,0.5),
                0 15px 40px rgba(26,26,26,0.2);
            border: 4px solid white;
            z-index: 10;
            animation: rankFloat 3s ease-in-out infinite;
            font-family: 'Copperplate Gothic Bold', 'Rockwell Extra Bold', serif;
        }

        @keyframes directorGlow {
            0%, 100% { opacity: 0.6; }
            50% { opacity: 1; }
        }

        @keyframes directorPulse {
            0%, 100% { transform: scaleX(1); }
            50% { transform: scaleX(1.05); }
        }

        @keyframes rankFloat {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-3px) scale(1.05); }
        }

        @keyframes directorFloat {
            0%, 100% { 
                transform: translateY(0px) translateZ(0px) rotateY(0deg) scale(1); 
                filter: brightness(1) contrast(1);
            }
            25% { 
                transform: translateY(-10px) translateZ(15px) rotateY(3deg) scale(1.02); 
                filter: brightness(1.05) contrast(1.05);
            }
            50% { 
                transform: translateY(-18px) translateZ(30px) rotateY(0deg) scale(1.05); 
                filter: brightness(1.1) contrast(1.1);
            }
            75% { 
                transform: translateY(-10px) translateZ(15px) rotateY(-3deg) scale(1.02); 
                filter: brightness(1.05) contrast(1.05);
            }
        }

        .director-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--medical-primary);
            margin-bottom: 0.8rem;
            text-shadow: 0 2px 4px rgba(15, 76, 117, 0.1);
            position: relative;
            transform-style: preserve-3d;
            transform: translateZ(5px);
        }

        .director-name::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 2px;
            background: var(--gradient-3d-primary);
            border-radius: 1px;
        }

        .director-title {
            color: var(--medical-secondary);
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .director-role {
            color: var(--medical-accent);
            font-size: 1rem;
            font-weight: 500;
            font-style: italic;
            margin-bottom: 1rem;
        }

        .director-badges {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .director-badge {
            background: var(--gradient-3d-primary);
            color: var(--medical-white);
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: var(--shadow-3d-sm);
            transform-style: preserve-3d;
            transform: translateZ(3px);
        }

        /* Classroom Photo Section - Perfect Design */
        .classroom-photo-section {
            margin: 3rem 0;
            position: relative;
            overflow: hidden;
            border-radius: 30px;
            animation: photoSectionFloat 6s ease-in-out infinite;
        }

        .classroom-photo-container {
            position: relative;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 
                0 20px 50px rgba(26,26,26,0.2),
                0 40px 100px rgba(26,26,26,0.15),
                0 60px 150px rgba(26,26,26,0.1);
            transform-style: preserve-3d;
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .classroom-photo {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 30px;
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            filter: brightness(1.05) contrast(1.05) saturate(1.1);
        }

        .classroom-photo-container:hover .classroom-photo {
            transform: scale(1.02) translateY(-5px);
            filter: brightness(1.1) contrast(1.1) saturate(1.2);
        }

        .photo-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(26,26,26,0.9) 0%, transparent 100%);
            padding: 3rem 2rem 2rem;
            border-radius: 0 0 30px 30px;
            transform: translateY(100%);
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .classroom-photo-container:hover .photo-overlay {
            transform: translateY(0);
        }

        .photo-content {
            text-align: center;
            color: var(--white);
            position: relative;
            z-index: 2;
        }

        .photo-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            transform-style: preserve-3d;
            transform: translateZ(10px);
        }

        .photo-description {
            font-size: 1.1rem;
            line-height: 1.8;
            max-width: 800px;
            margin: 0 auto;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
            transform-style: preserve-3d;
            transform: translateZ(5px);
        }

        .classroom-photo-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="classroom-pattern" width="40" height="40" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="3" fill="rgba(255,215,0,0.1)"/><path d="M10 20 Q20 10, 30 20 T50 20" stroke="rgba(255,215,0,0.15)" stroke-width="2" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23classroom-pattern)"/></svg>'),
                radial-gradient(circle at 30% 70%, rgba(255,215,0,0.05) 0%, transparent 50%);
            background-size: 80px 80px, cover;
            background-position: 0 0, center;
            transform: translateX(-100%) translateY(-100%);
            transition: transform 1.5s ease;
            pointer-events: none;
            opacity: 0.6;
            border-radius: 30px;
        }

        .classroom-photo-container:hover::before {
            transform: translateX(100%) translateY(100%);
            opacity: 0.8;
        }

        @keyframes photoSectionFloat {
            0%, 100% { 
                transform: translateY(0px) translateZ(0px); 
            }
            25% { 
                transform: translateY(-5px) translateZ(10px); 
            }
            50% { 
                transform: translateY(-10px) translateZ(20px); 
            }
            75% { 
                transform: translateY(-5px) translateZ(10px); 
            }
        }

        /* Board Functions - Hospital-Quality */
        .functions-list {
            background: rgba(15, 76, 117, 0.05);
            border-radius: 15px;
            padding: 2rem;
            margin-top: 2rem;
            border: 1px solid var(--border-3d-light);
        }

        .function-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid var(--border-3d-light);
            transition: all 0.3s ease;
        }

        .function-item:last-child {
            border-bottom: none;
        }

        .function-item:hover {
            background: rgba(15, 76, 117, 0.02);
            transform: translateX(5px);
        }

        .function-icon {
            width: 40px;
            height: 40px;
            background: var(--gradient-3d-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--medical-white);
            font-size: 1rem;
            flex-shrink: 0;
            box-shadow: var(--shadow-3d-sm);
            transform-style: preserve-3d;
            transform: translateZ(5px);
        }

        .function-text {
            font-size: 1.1rem;
            line-height: 1.6;
            color: var(--medical-dark);
        }

        /* Board of Governors - Hospital-Quality 3D */
        .governors-section {
            background: var(--medical-white);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-3d-md);
            border: 1px solid var(--border-3d-light);
            transform-style: preserve-3d;
        }

        .chairman-highlight {
            background: var(--gradient-3d-primary);
            color: var(--medical-white);
            border-radius: 20px;
            padding: 3rem;
            margin-bottom: 3rem;
            text-align: center;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-3d-lg);
            transform-style: preserve-3d;
        }

        .chairman-highlight::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 70%);
            animation: medical3DFloat 20s linear infinite;
        }

        .chairman-highlight::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="medical-chairman-pattern" width="25" height="25" patternUnits="userSpaceOnUse"><circle cx="12.5" cy="12.5" r="2" fill="rgba(255,255,255,0.08)"/><path d="M5 12.5 Q12.5 5, 20 12.5 T35 12.5" stroke="rgba(255,255,255,0.1)" stroke-width="1" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23medical-chairman-pattern)"/></svg>');
            opacity: 0.2;
            pointer-events: none;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .chairman-name {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 0.8rem;
            position: relative;
            z-index: 1;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .chairman-title {
            font-size: 1.3rem;
            opacity: 0.95;
            position: relative;
            z-index: 1;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .chairman-badges {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1.5rem;
            position: relative;
            z-index: 1;
        }

        .chairman-badge {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            border: 1px solid rgba(255, 255, 255, 0.3);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .members-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .member-item {
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.05), rgba(55, 48, 163, 0.05));
            border-radius: 10px;
            padding: 1.5rem;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .member-item:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-sm);
        }

        .member-title {
            font-weight: 600;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
        }

        .member-description {
            color: var(--text-secondary);
            font-size: 0.95rem;
        }

        /* Management Section - Hospital-Quality 3D */
        .management-section {
            background: var(--medical-white);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-3d-md);
            border: 1px solid var(--border-3d-light);
            text-align: center;
            transform-style: preserve-3d;
        }

        .principal-card {
            background: var(--gradient-3d-primary);
            color: var(--medical-white);
            border-radius: 20px;
            padding: 3.5rem;
            margin-top: 2rem;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-3d-xl);
            transform-style: preserve-3d;
        }

        .principal-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 70%);
            animation: medical3DFloat 25s linear infinite reverse;
        }

        .principal-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="medical-principal-pattern" width="30" height="30" patternUnits="userSpaceOnUse"><circle cx="15" cy="15" r="3" fill="rgba(255,255,255,0.08)"/><path d="M5 15 Q15 5, 25 15 T45 15" stroke="rgba(255,255,255,0.1)" stroke-width="1.5" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23medical-principal-pattern)"/></svg>');
            opacity: 0.2;
            pointer-events: none;
        }

        .principal-avatar {
            width: 240px;
            height: 240px;
            border-radius: 20px;
            margin: 0 auto 2.5rem;
            overflow: hidden;
            position: relative;
            box-shadow: 
                0 0 50px rgba(30, 58, 138, 0.5),
                0 20px 40px rgba(30, 58, 138, 0.3),
                inset 0 0 40px rgba(255, 255, 255, 0.2);
            animation: principalGlow 4s ease-in-out infinite;
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            border: 5px solid transparent;
            background: linear-gradient(white, white) padding-box,
                        var(--gradient-luxury) border-box;
        }

        .principal-avatar:hover {
            transform: scale(1.1) rotateY(15deg) translateZ(20px);
            box-shadow: 
                0 0 50px rgba(30, 58, 138, 0.7),
                0 20px 40px rgba(30, 58, 138, 0.5),
                inset 0 0 40px rgba(255, 255, 255, 0.3);
            border-color: var(--golden-yellow);
        }

        .principal-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            filter: brightness(1.05) contrast(1.05) saturate(1.1);
        }

        .principal-avatar:hover img {
            transform: scale(1.05) rotateY(-8deg);
            filter: brightness(1.1) contrast(1.1) saturate(1.2);
        }

        .principal-avatar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, transparent 40%, rgba(255,255,255,0.4) 50%, transparent 60%);
            transform: translateX(-100%);
            transition: transform 0.8s ease;
            pointer-events: none;
            border-radius: 20px;
        }

        .principal-avatar:hover::before {
            transform: translateX(100%);
        }

        .principal-rank {
            position: absolute;
            top: -15px;
            right: -15px;
            background: var(--gradient-luxury);
            color: var(--primary-blue);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 1.4rem;
            box-shadow: 0 8px 20px rgba(251, 191, 36, 0.5);
            border: 4px solid white;
            z-index: 10;
            font-family: 'Copperplate Gothic Bold', 'Rockwell Extra Bold', serif;
        }

        @keyframes principalGlow {
            0%, 100% { 
                transform: translateY(0px) translateZ(0px) rotateY(0deg); 
                box-shadow: 0 0 40px rgba(30, 58, 138, 0.5);
            }
            25% { 
                transform: translateY(-10px) translateZ(15px) rotateY(3deg); 
                box-shadow: 0 0 50px rgba(30, 58, 138, 0.6);
            }
            50% { 
                transform: translateY(-15px) translateZ(25px) rotateY(0deg); 
                box-shadow: 0 0 60px rgba(30, 58, 138, 0.7);
            }
            75% { 
                transform: translateY(-10px) translateZ(15px) rotateY(-3deg); 
                box-shadow: 0 0 50px rgba(30, 58, 138, 0.6);
            }
        }

        .principal-badges {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
            position: relative;
            z-index: 1;
        }

        .principal-badge {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 600;
            border: 1px solid rgba(255, 255, 255, 0.3);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .chairman-avatar {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            overflow: hidden;
            position: relative;
            display: inline-block;
            border: 3px solid var(--medical-accent);
            box-shadow: var(--shadow-3d-md);
            animation: chairman3DShine 3s ease-in-out infinite;
            transition: all 0.3s ease;
            transform-style: preserve-3d;
        }

        .chairman-avatar:hover {
            transform: scale(1.05) rotateY(5deg) translateZ(10px);
            box-shadow: var(--shadow-3d-lg);
            border-color: var(--medical-cyan);
        }

        .chairman-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .chairman-avatar:hover img {
            transform: scale(1.02);
        }

        .chairman-avatar::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(15, 76, 117, 0.1), rgba(30, 107, 168, 0.1));
            border-radius: 50%;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .chairman-avatar:hover::after {
            opacity: 1;
        }

        @keyframes chairman3DShine {
            0%, 100% { 
                transform: translateY(0px) scale(1) translateZ(0); 
                box-shadow: var(--shadow-3d-md);
            }
            50% { 
                transform: translateY(-3px) scale(1.02) translateZ(5px); 
                box-shadow: var(--shadow-3d-lg);
            }
        }

        .principal-name {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .principal-title {
            font-size: 1.3rem;
            opacity: 0.9;
            margin-bottom: 2rem;
            position: relative;
            z-index: 1;
        }

        .principal-description {
            font-size: 1.1rem;
            line-height: 1.8;
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
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

        @keyframes director3DFloat {
            0%, 100% { 
                transform: translateY(0px) translateZ(0px) rotateY(0deg); 
            }
            25% { 
                transform: translateY(-5px) translateZ(10px) rotateY(2deg); 
            }
            50% { 
                transform: translateY(-10px) translateZ(20px) rotateY(0deg); 
            }
            75% { 
                transform: translateY(-5px) translateZ(10px) rotateY(-2deg); 
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
        /* Premium Governance Gallery Section Styles */
        .governance-gallery-section {
            padding: 6rem 2rem;
            background: linear-gradient(135deg, var(--gray-light) 0%, var(--white) 50%, var(--gray-light) 100%);
            position: relative;
            overflow: hidden;
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
            
            .directors-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            
            .director-card {
                padding: 2rem;
            }
            
            .director-avatar {
                width: 160px;
                height: 160px;
            }
            
            .director-name {
                font-size: 1.4rem;
            }
            
            .members-list {
                grid-template-columns: 1fr;
            }
            
            .board-section {
                padding: 2rem;
            }
            
            .governors-section {
                padding: 2rem;
            }
            
            .management-section {
                padding: 2rem;
            }
            
            .principal-card {
                padding: 2rem;
            }
            
            .principal-avatar {
                width: 150px;
                height: 150px;
            }
            
            .classroom-photo {
                height: 300px;
            }
            
            .photo-title {
                font-size: 1.6rem;
            }
            
            .photo-description {
                font-size: 1rem;
                padding: 0 1rem;
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
            
            .director-card {
                padding: 1.5rem;
            }
            
            .director-avatar {
                width: 120px;
                height: 120px;
            }
            
            .board-section,
            .governors-section,
            .management-section {
                padding: 1.5rem;
            }
        }

        /* Floating About Button - Perfect Design */
        .floating-about-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
            animation: aboutButtonFloat 4s ease-in-out infinite;
        }

        .about-btn-content {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            background: linear-gradient(135deg, var(--accent-gold), var(--primary-dark));
            color: var(--white);
            padding: 1rem 1.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1rem;
            box-shadow: 
                0 10px 30px rgba(26,26,26,0.3),
                0 20px 60px rgba(26,26,26,0.2),
                inset 0 0 20px rgba(255,215,0,0.3);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            transform-style: preserve-3d;
            transform: translateZ(0) rotateX(0deg);
            border: 2px solid transparent;
            background-clip: padding-box;
            backdrop-filter: blur(10px);
            font-family: 'Inter', sans-serif;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .about-btn-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, transparent 40%, rgba(255,255,255,0.2) 50%, transparent 60%);
            border-radius: 50px;
            transform: translateX(-100%);
            transition: transform 0.8s ease;
            pointer-events: none;
        }

        .about-btn-content::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="about-btn-pattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="2" fill="rgba(255,255,255,0.1)"/><path d="M5 10 Q10 5, 15 10 T25 10" stroke="rgba(255,215,0,0.2)" stroke-width="1" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23about-btn-pattern)"/></svg>'),
                radial-gradient(circle at 30% 70%, rgba(255,215,0,0.05) 0%, transparent 50%);
            background-size: 40px 40px, cover;
            background-position: 0 0, center;
            transform: translateX(-100%) translateY(-100%);
            transition: transform 1.2s ease;
            pointer-events: none;
            opacity: 0.6;
            border-radius: 50px;
        }

        .about-btn-content:hover {
            transform: translateY(-8px) translateZ(20px) rotateX(5deg) scale(1.05);
            box-shadow: 
                0 20px 50px rgba(26,26,26,0.4),
                0 40px 80px rgba(26,26,26,0.3),
                inset 0 0 30px rgba(255,215,0,0.4);
            background: linear-gradient(135deg, var(--primary-dark), var(--accent-gold));
            border-color: var(--accent-gold);
        }

        .about-btn-content:hover::before {
            transform: translateX(100%);
        }

        .about-btn-content:hover::after {
            transform: translateX(100%) translateY(100%);
            opacity: 0.8;
        }

        .about-btn-content i {
            font-size: 1.2rem;
            animation: aboutIconPulse 2s ease-in-out infinite;
        }

        .about-btn-content span {
            font-weight: 800;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            position: relative;
            z-index: 2;
        }

        @keyframes aboutButtonFloat {
            0%, 100% { 
                transform: translateY(0px) scale(1); 
            }
            25% { 
                transform: translateY(-5px) scale(1.02); 
            }
            50% { 
                transform: translateY(-8px) scale(1.05); 
            }
            75% { 
                transform: translateY(-5px) scale(1.02); 
            }
        }

        @keyframes aboutIconPulse {
            0%, 100% { 
                transform: scale(1); 
                color: var(--white);
            }
            50% { 
                transform: scale(1.1); 
                color: var(--accent-gold);
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
            <h1 class="page-title">School Governance</h1>
            <div class="breadcrumb">
                <p>Home / About / Governance</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Premium Governance Gallery Section -->
        <section class="governance-gallery-section">
            <div class="section-container">
                <div class="section-header">
                    <div class="section-badge">
                        <i class="fas fa-users-cog"></i>
                        <span>Leadership Excellence</span>
                    </div>
                    <h2 class="section-title">Experience Our World-Class Governance</h2>
                    <p class="section-subtitle">
                        Discover our distinguished leadership team and administrative facilities 
                        that ensure institutional excellence and strategic growth.
                    </p>
                </div>
                
                <div class="governance-gallery-grid">
                    <div class="governance-item governance-item-large">
                        <div class="governance-image-wrapper">
                            <img src="assets/images/facilities/administration-block.jpg" alt="ISNM Administration Block - Professional Management" class="governance-image">
                            <div class="governance-overlay">
                                <div class="governance-content">
                                    <h3 class="governance-title">Administrative Excellence</h3>
                                    <p class="governance-description">Professional management hub ensuring institutional governance and strategic leadership</p>
                                    <div class="governance-badges">
                                        <span class="governance-badge">Leadership</span>
                                        <span class="governance-badge">Excellence</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="governance-item">
                        <div class="governance-image-wrapper">
                            <img src="assets/images/staff/chairman-board-of-director-mr-baliddawa-david-byawaka.jpg" alt="Mr. Baliddawa David Byawaka - Chairman Board of Directors" class="governance-image">
                            <div class="governance-overlay">
                                <div class="governance-content">
                                    <h3 class="governance-title">Board Leadership</h3>
                                    <p class="governance-description">Visionary leadership guiding institutional success and strategic direction</p>
                                    <div class="governance-badges">
                                        <span class="governance-badge">Chairman</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="governance-item">
                        <div class="governance-image-wrapper">
                            <img src="assets/images/staff/academic-director-stephen.jpg" alt="Dr. Banonya Stephen - Academic Director" class="governance-image">
                            <div class="governance-overlay">
                                <div class="governance-content">
                                    <h3 class="governance-title">Academic Leadership</h3>
                                    <p class="governance-description">Expert academic guidance ensuring educational excellence and innovation</p>
                                    <div class="governance-badges">
                                        <span class="governance-badge">Academic</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="governance-item governance-item-wide">
                        <div class="governance-image-wrapper">
                            <img src="assets/images/academic/classroom-photo-certificates-in-nurses-and-diploma.jpeg" alt="ISNM Academic Excellence - Certified Programs" class="governance-image">
                            <div class="governance-overlay">
                                <div class="governance-content">
                                    <h3 class="governance-title">Academic Excellence</h3>
                                    <p class="governance-description">Certified programs with internationally recognized qualifications in healthcare education</p>
                                    <div class="governance-badges">
                                        <span class="governance-badge">Certification</span>
                                        <span class="governance-badge">Quality</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="governance-item">
                        <div class="governance-image-wrapper">
                            <img src="assets/images/staff/member-board-of-directors-mrs-mercy-byawaka.jpg" alt="Mrs. Mercy Byawaka - Board Member" class="governance-image">
                            <div class="governance-overlay">
                                <div class="governance-content">
                                    <h3 class="governance-title">Administrative Leadership</h3>
                                    <p class="governance-description">Strategic administrative management supporting institutional operations</p>
                                    <div class="governance-badges">
                                        <span class="governance-badge">Management</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="governance-item">
                        <div class="governance-image-wrapper">
                            <img src="assets/images/hero/graduations-hero.jpg" alt="ISNM Graduation Success - Achievement Celebration" class="governance-image">
                            <div class="governance-overlay">
                                <div class="governance-content">
                                    <h3 class="governance-title">Success Celebration</h3>
                                    <p class="governance-description">Celebrating graduation achievements and professional success of our students</p>
                                    <div class="governance-badges">
                                        <span class="governance-badge">Achievement</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="governance-item governance-item-large">
                        <div class="governance-image-wrapper">
                            <img src="assets/images/hero/students-in-class.jpg" alt="ISNM Interactive Learning - Student Engagement" class="governance-image">
                            <div class="governance-overlay">
                                <div class="governance-content">
                                    <h3 class="governance-title">Interactive Learning Environment</h3>
                                    <p class="governance-description">Engaging educational experiences fostering professional development and excellence</p>
                                    <div class="governance-badges">
                                        <span class="governance-badge">Learning</span>
                                        <span class="governance-badge">Engagement</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Board of Directors Section -->
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">3.1 Board of Directors</h2>
                <p class="section-subtitle">The founding members and strategic leaders of our institution</p>
            </div>
            
            <div class="board-section">
                <div class="board-header">
                    <h3 class="board-title">BOARD OF DIRECTORS</h3>
                    <p class="board-description">
                        The school is owned by three (3) founding members who also constitute the Board of Directors. 
                        The Board performs the following functions:-
                    </p>
                </div>
                
                <div class="directors-grid">
                    <div class="director-card">
                        <div class="director-avatar" title="Mr. Baliddawa David Byawaka - Chairman Board of Directors">
                            <img src="assets/images/staff/chairman-board-of-director-mr-baliddawa-david-byawaka.jpg" alt="Mr. Baliddawa David Byawaka - Chairman Board of Directors">
                            <div class="director-rank">1</div>
                        </div>
                        <h4 class="director-name">Mr. Baliddawa David Byawaka</h4>
                        <p class="director-title">CHAIRMAN</p>
                        <p class="director-role">Board of Directors</p>
                        <div class="director-badges">
                            <span class="director-badge">Founder</span>
                            <span class="director-badge">Chairman</span>
                        </div>
                    </div>
                    
                    <div class="director-card">
                        <div class="director-avatar" title="Mrs. Mercy Byawaka - Member Board of Directors">
                            <img src="assets/images/staff/member-board-of-directors-mrs-mercy-byawaka.jpg" alt="Mrs. Mercy Byawaka - Member Board of Directors">
                            <div class="director-rank">3</div>
                        </div>
                        <h4 class="director-name">Mrs. Mercy Byawaka</h4>
                        <p class="director-title">MEMBER</p>
                        <p class="director-role">Board of Directors</p>
                        <div class="director-badges">
                            <span class="director-badge">Founder</span>
                            <span class="director-badge">Admin</span>
                        </div>
                    </div>
                </div>
                <div class="director-card">
                        <div class="director-avatar" title="Dr. Banonya Stephen - Member Board of Directors">
                            <img src="assets/images/staff/academic-director-stephen.jpg" alt="Dr. Banonya Stephen - Member Board of Directors">
                            <div class="director-rank">2</div>
                        </div>
                        <h4 class="director-name">Dr. Banonya Stephen</h4>
                        <p class="director-title">MEMBER</p>
                        <p class="director-role">Board of Directors</p>
                        <div class="director-badges">
                            <span class="director-badge">Founder</span>
                            <span class="director-badge">Medical</span>
                        </div>
                    </div>
                <!-- Classroom Photo Section -->
                <div class="classroom-photo-section">
                    <div class="classroom-photo-container">
                        <img src="assets/images/academic/classroom-photo-certificates-in-nurses-and-diploma.jpeg" alt="Classroom with Certificates in Nursing and Diploma" class="classroom-photo">
                        <div class="photo-overlay">
                            <div class="photo-content">
                                <h3 class="photo-title">Excellence in Healthcare Education</h3>
                                <p class="photo-description">
                                    Our state-of-the-art classrooms and certified programs provide students with hands-on training 
                                    and internationally recognized qualifications in nursing and midwifery. Every graduate receives 
                                    comprehensive certificates and diplomas that open doors to global healthcare opportunities.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="functions-list">
                    <div class="function-item">
                        <div class="function-icon">
                            <i class="fas fa-compass"></i>
                        </div>
                        <div class="function-text">
                            <strong>Offer strategic direction</strong> to the school
                        </div>
                    </div>
                    
                    <div class="function-item">
                        <div class="function-icon">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        <div class="function-text">
                            <strong>Mobilize resources</strong> for academic and development activities
                        </div>
                    </div>
                    
                    <div class="function-item">
                        <div class="function-icon">
                            <i class="fas fa-school"></i>
                        </div>
                        <div class="function-text">
                            <strong>Ensure proper teaching and learning</strong> environment
                        </div>
                    </div>
                    
                    <div class="function-item">
                        <div class="function-icon">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <div class="function-text">
                            <strong>Recruitment, training and retention</strong> of appropriate human resource
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Board of Governors Section -->
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">3.2 Board of Governors</h2>
                <p class="section-subtitle">Advisory council representing various stakeholders</p>
            </div>
            
            <div class="governors-section">
                <div class="chairman-highlight">
                    <div style="text-align: center; margin-bottom: 2rem; position: relative;">
                        <div class="chairman-avatar" title="Mr. Naluwairo David Kigenyi - Chairman Board of Governors">
                            <img src="assets/images/staff/chairman-governing-council-mr-david-kigenyi-naluwayiro.jpeg" alt="Mr. Naluwairo David Kigenyi - Chairman Board of Governors">
                        </div>
                        <div class="director-rank" style="position: absolute; top: -5px; right: calc(50% - 100px);">CHAIR</div>
                    </div>
                    <h3 class="chairman-name">Mr. Naluwairo David Kigenyi</h3>
                    <p class="chairman-title">Chairman Governing Council</p>
                    <div class="chairman-badges">
                        <span class="chairman-badge">Board of Governors</span>
                        <span class="chairman-badge">Chairman</span>
                        <span class="chairman-badge">Leadership</span>
                    </div>
                </div>
                
                <div class="board-description">
                    <p>
                        The school has an advisory (Board of Governors) with members representing several constituents. 
                        They include:
                    </p>
                </div>
                
                <div class="members-list">
                    <div class="member-item">
                        <h4 class="member-title">Principal of ISNM</h4>
                        <p class="member-description">Secretary to the council</p>
                    </div>
                    
                    <div class="member-item">
                        <h4 class="member-title">Staff Representative</h4>
                        <p class="member-description">ISNM Staff Representative</p>
                    </div>
                    
                    <div class="member-item">
                        <h4 class="member-title">Parent Representative</h4>
                        <p class="member-description">Representative of the parents</p>
                    </div>
                    
                    <div class="member-item">
                        <h4 class="member-title">Student Representatives</h4>
                        <p class="member-description">2 Student representatives (male & female)</p>
                    </div>
                    
                    <div class="member-item">
                        <h4 class="member-title">Health Institution Representative</h4>
                        <p class="member-description">Busitema University Representative</p>
                    </div>
                    
                    <div class="member-item">
                        <h4 class="member-title">PNO of Iganga Hospital</h4>
                        <p class="member-description">Principal Nursing Officer</p>
                    </div>
                    
                    <div class="member-item">
                        <h4 class="member-title">Medical Superintendent</h4>
                        <p class="member-description">Iganga Hospital</p>
                    </div>
                    
                    <div class="member-item">
                        <h4 class="member-title">Religious Leader</h4>
                        <p class="member-description">Religious Representative</p>
                    </div>
                    
                    <div class="member-item">
                        <h4 class="member-title">Experienced Administrator</h4>
                        <p class="member-description">Rtd CAO, Wakiso District</p>
                    </div>
                    
                    <div class="member-item">
                        <h4 class="member-title">Board Representative</h4>
                        <p class="member-description">Representative of the Board of Directors</p>
                    </div>
                </div>
                
                <div class="board-description" style="margin-top: 2rem;">
                    <p>
                        The Board of Governors meets twice in each semester to advise the directors on all matters of the school 
                        with emphasis on quality education, staff and student discipline. They are also concerned with strategic 
                        planning, reviewing reports and recommendations from their standing committee. Ensure the smooth running 
                        of the school's programmes both academic and non-academic by setting priorities administratively.
                    </p>
                </div>
            </div>
        </section>

        <!-- Management Section -->
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">3.3 Management of the School</h2>
                <p class="section-subtitle">Day-to-day leadership and administration</p>
            </div>
            
            <div class="management-section">
                <div class="principal-card">
                    <div style="text-align: center; margin-bottom: 2rem; position: relative;">
                        <div class="principal-avatar" title="Sr. Edith Mwebaza - Principal of Iganga School of Nursing and Midwifery">
                            <img src="assets/current-principal.jpg" alt="Sr. Edith Mwebaza - Principal of Iganga School of Nursing and Midwifery">
                            <div class="principal-rank">PRINCIPAL</div>
                        </div>
                    </div>
                    <h3 class="principal-name">Sr. Edith Mwebaza</h3>
                    <p class="principal-title">Principal of the School</p>
                    <div class="principal-badges">
                        <span class="principal-badge">Leadership</span>
                        <span class="principal-badge">Administration</span>
                        <span class="principal-badge">Academic</span>
                    </div>
                    <p class="principal-description">
                        The Principal is responsible for the day to day running of the school assisted by the Deputy and other staff. 
                        The staff serves in various committees such as academic, disciplinary, welfare, health and sanitation. 
                        Staff meetings are held regularly. The students have a democratically elected guild council for purposes 
                        of addressing student concerns, and liaising between the administration and the students.
                    </p>
                </div>
            </div>
        </section>
    </main>

    <!-- Floating About Button -->
    <div class="floating-about-btn" id="floatingAboutBtn">
        <a href="about.php" class="about-btn-content">
            <i class="fas fa-info-circle"></i>
            <span>About</span>
        </a>
    </div>

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
    </script>
</body>
</html>


