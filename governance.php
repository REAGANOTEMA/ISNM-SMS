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
            background: var(--medical-white);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-3d-md);
            border: 1px solid var(--border-3d-light);
            margin-bottom: 3rem;
            transform-style: preserve-3d;
            position: relative;
        }

        .board-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-3d-primary);
            border-radius: 20px 20px 0 0;
            opacity: 0.8;
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
            gap: 2.5rem;
            margin-bottom: 3rem;
            align-items: stretch;
        }

        .director-card {
            background: var(--medical-white);
            border-radius: 20px;
            padding: 2.5rem;
            text-align: center;
            border: 2px solid var(--border-3d-light);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-3d-md);
            transform-style: preserve-3d;
            transform: translateZ(0);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .director-card::before {
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

        .director-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="medical-director-pattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(15,76,117,0.1)"/><path d="M5 10 Q10 5, 15 10 T25 10" stroke="rgba(30,107,168,0.1)" stroke-width="0.5" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23medical-director-pattern)"/></svg>'),
                linear-gradient(135deg, transparent 40%, rgba(15,76,117,0.05) 50%, transparent 60%);
            background-size: 40px 40px, cover;
            background-position: 0 0, center;
            transform: translateX(-100%);
            transition: transform 0.8s ease;
            pointer-events: none;
        }

        .director-card:hover {
            transform: translateY(-8px) translateZ(15px) rotateX(2deg);
            box-shadow: var(--shadow-3d-lg);
            border-color: var(--medical-primary);
        }

        .director-card:hover::before {
            transform: scaleX(1);
        }

        .director-card:hover::after {
            transform: translateX(100%);
        }

        .director-avatar {
            width: 160px;
            height: 160px;
            border-radius: 20px;
            margin: 0 auto 2rem;
            overflow: hidden;
            position: relative;
            box-shadow: var(--shadow-3d-lg);
            animation: director3DFloat 4s ease-in-out infinite;
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            border: 4px solid transparent;
            background: linear-gradient(var(--medical-white), var(--medical-white)) padding-box,
                        var(--gradient-3d-primary) border-box;
            transform-style: preserve-3d;
        }

        .director-avatar:hover {
            transform: scale(1.05) rotateY(8deg) translateZ(20px);
            box-shadow: var(--shadow-3d-xl);
            border-color: var(--medical-cyan);
        }

        .director-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            filter: brightness(1.05) contrast(1.05);
        }

        .director-avatar:hover img {
            transform: scale(1.05) rotateY(-5deg);
            filter: brightness(1.1) contrast(1.1);
        }

        .director-avatar::before {
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

        .director-avatar:hover::before {
            transform: translateX(100%);
        }

        .director-rank {
            position: absolute;
            top: -10px;
            right: -10px;
            background: var(--gradient-luxury);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.2rem;
            box-shadow: 0 5px 15px rgba(251, 191, 36, 0.4);
            border: 3px solid white;
            z-index: 10;
        }

        @keyframes directorFloat {
            0%, 100% { 
                transform: translateY(0px) translateZ(0px) rotateY(0deg); 
            }
            25% { 
                transform: translateY(-8px) translateZ(10px) rotateY(2deg); 
            }
            50% { 
                transform: translateY(-12px) translateZ(20px) rotateY(0deg); 
            }
            75% { 
                transform: translateY(-8px) translateZ(10px) rotateY(-2deg); 
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
            width: 200px;
            height: 200px;
            border-radius: 20px;
            margin: 0 auto 2.5rem;
            overflow: hidden;
            position: relative;
            box-shadow: 
                0 0 40px rgba(30, 58, 138, 0.5),
                0 15px 30px rgba(30, 58, 138, 0.3),
                inset 0 0 30px rgba(255, 255, 255, 0.2);
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
            width: 120px;
            height: 120px;
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .page-title {
                font-size: 2rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .directors-grid {
                grid-template-columns: 1fr;
            }
            
            .members-list {
                grid-template-columns: 1fr;
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
                <ul class="nav-links">
                    <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="about.php"><i class="fas fa-info-circle"></i> About</a></li>
                    <li><a href="governance.php"><i class="fas fa-users"></i> Governance</a></li>
                    <li><a href="programs.php"><i class="fas fa-graduation-cap"></i> Programs</a></li>
                    <li><a href="admissions.php"><i class="fas fa-user-plus"></i> Admissions</a></li>
                    <li><a href="activities.php"><i class="fas fa-running"></i> Activities</a></li>
                    <li><a href="infrastructure.php"><i class="fas fa-building"></i> Infrastructure</a></li>
                    <li><a href="achievements.php"><i class="fas fa-trophy"></i> Achievements</a></li>
                    <li><a href="history.php"><i class="fas fa-history"></i> History</a></li>
                    <li><a href="contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
                    <li><a href="login-portal.php"><i class="fas fa-sign-in-alt"></i> Portal</a></li>
                </ul>
            </nav>
            <div class="page-title">School Governance</div>
            <div class="breadcrumb">
                <p>Home / About / Governance</p>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
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
                            <img src="assets/founder-and-executive-director-mr-david-baliddawa.jpeg" alt="Mr. Baliddawa David Byawaka - Chairman Board of Directors">
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
                        <div class="director-avatar" title="Dr. Banonya Stephen - Member Board of Directors">
                            <img src="assets/member-board-of-directors-dr-banonya-stephen.jpg" alt="Dr. Banonya Stephen - Member Board of Directors">
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
                    
                    <div class="director-card">
                        <div class="director-avatar" title="Mrs. Mercy Byawaka - Member Board of Directors">
                            <img src="assets/member-board-of-directors-mrs-mercy-byawaka.jpg" alt="Mrs. Mercy Byawaka - Member Board of Directors">
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
                            <img src="assets/chairman-governing-council-mr-david-kigenyi-naluwayiro.jpeg" alt="Mr. Naluwairo David Kigenyi - Chairman Board of Governors">
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
                            <img src="assets/principle.jpeg" alt="Sr. Edith Mwebaza - Principal of Iganga School of Nursing and Midwifery">
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


