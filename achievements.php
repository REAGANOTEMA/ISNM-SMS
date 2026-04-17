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
    <title>Achievements & Future Plans - Iganga School of Nursing and Midwifery</title>
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
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="modern-achievements-pattern" width="30" height="30" patternUnits="userSpaceOnUse"><circle cx="15" cy="15" r="3" fill="rgba(139,92,246,0.3)"/><path d="M5 15 Q15 5, 25 15 T45 15" stroke="rgba(59,130,246,0.4)" stroke-width="2" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23modern-achievements-pattern)"/></svg>'),
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><defs><pattern id="vibrant-achievements-pattern" width="50" height="50" patternUnits="userSpaceOnUse"><rect x="10" y="10" width="30" height="30" fill="none" stroke="rgba(236,72,153,0.3)" stroke-width="2"/><circle cx="25" cy="25" r="6" fill="rgba(249,115,22,0.4)"/></pattern></defs><rect width="200" height="200" fill="url(%23vibrant-achievements-pattern)"/></svg>');
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
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 8px;
        }

        .nav-links a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
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

        /* Achievements Section */
        .achievements-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            margin-bottom: 3rem;
        }

        .achievements-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .achievement-card {
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.05), rgba(55, 48, 163, 0.05));
            border-radius: 15px;
            padding: 2rem;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .achievement-card::before {
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

        .achievement-card:hover::before {
            opacity: 1;
        }

        .achievement-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-xl);
        }

        .achievement-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: var(--gradient-luxury);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            box-shadow: 0 0 20px rgba(251, 191, 36, 0.3);
            position: relative;
            z-index: 1;
        }

        .achievement-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .achievement-description {
            color: var(--text-primary);
            font-size: 1.1rem;
            line-height: 1.6;
            position: relative;
            z-index: 1;
        }

        /* Statistics Section */
        .stats-section {
            background: var(--gradient-primary);
            color: white;
            border-radius: 20px;
            padding: 3rem;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        .stats-section::before {
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

        .stats-content {
            position: relative;
            z-index: 1;
        }

        .stats-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
        }

        .stat-item {
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 2rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
        }

        .stat-number {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
            display: block;
        }

        .stat-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* Challenges Section */
        .challenges-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            margin-bottom: 3rem;
        }

        .challenges-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .challenge-card {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.05), rgba(220, 38, 38, 0.05));
            border-radius: 15px;
            padding: 2rem;
            border: 1px solid rgba(239, 68, 68, 0.2);
            transition: all 0.3s ease;
        }

        .challenge-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .challenge-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin: 0 auto 1.5rem;
        }

        .challenge-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: #dc2626;
            margin-bottom: 1rem;
            text-align: center;
        }

        .challenge-description {
            color: var(--text-primary);
            font-size: 1.1rem;
            line-height: 1.6;
            text-align: center;
        }

        /* Future Plans Section */
        .future-plans-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
        }

        .plans-tabs {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 3rem;
            flex-wrap: wrap;
        }

        .plan-tab {
            padding: 1rem 2rem;
            background: var(--gradient-primary);
            color: white;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }

        .plan-tab:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .plan-tab.active {
            background: var(--gradient-luxury);
        }

        .plans-content {
            display: none;
        }

        .plans-content.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .plans-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .plan-card {
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.05), rgba(55, 48, 163, 0.05));
            border-radius: 15px;
            padding: 2rem;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .plan-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        /* Enhanced Achievement Gallery */
        .achievement-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2.5rem;
            margin: 3rem 0;
        }

        .achievement-card {
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

        .achievement-card::before {
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

        .achievement-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="achievement-pattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="2" fill="var(--golden-yellow)" opacity="0.2"/><path d="M5 10 Q10 5, 15 10 T25 10" stroke="var(--light-green)" stroke-width="1" fill="none" opacity="0.3"/></pattern></defs><rect width="100" height="100" fill="url(%23achievement-pattern)"/></svg>'),
                linear-gradient(135deg, transparent 40%, rgba(255,255,255,0.2) 50%, transparent 60%);
            background-size: 40px 40px, cover;
            background-position: 0 0, center;
            transform: translateX(-100%);
            transition: transform 0.8s ease;
            pointer-events: none;
        }

        .achievement-card:hover {
            transform: translateY(-15px) scale(1.02) rotateX(3deg) translateZ(25px);
            box-shadow: var(--shadow-xl), 0 0 40px rgba(37, 99, 235, 0.3);
            border-color: var(--primary-blue);
        }

        .achievement-card:hover::before {
            transform: scaleX(1);
        }

        .achievement-card:hover::after {
            transform: translateX(100%);
        }

        .achievement-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            transform-style: preserve-3d;
            transform: translateZ(0);
        }

        .achievement-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, transparent 40%, rgba(255,255,255,0.3) 50%, transparent 60%);
            transform: translateX(-100%);
            transition: transform 0.8s ease;
            pointer-events: none;
        }

        .achievement-card:hover .achievement-image {
            transform: scale(1.05) rotateX(2deg) translateZ(10px);
        }

        .achievement-card:hover .achievement-image::before {
            transform: translateX(100%);
        }

        .achievement-card-content {
            padding: 2rem;
        }

        .achievement-card-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }

        .achievement-card-description {
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .achievement-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .achievement-badge {
            display: inline-block;
            background: var(--gradient-primary);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        @keyframes achievementFloat {
            0%, 100% { transform: translateY(0px) translateZ(0px); }
            50% { transform: translateY(-5px) translateZ(10px); }
        }

        .plan-icon {
            width: 60px;
            height: 60px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin: 0 auto 1.5rem;
        }

        .plan-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
            text-align: center;
        }

        .plan-description {
            color: var(--text-primary);
            font-size: 1.1rem;
            line-height: 1.6;
            text-align: center;
        }

        /* Conclusion Section */
        .conclusion-section {
            background: var(--gradient-primary);
            color: white;
            border-radius: 20px;
            padding: 3rem;
            margin-top: 3rem;
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .conclusion-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 25s linear infinite;
        }

        .conclusion-content {
            position: relative;
            z-index: 1;
        }

        .conclusion-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
        }

        .conclusion-text {
            font-size: 1.2rem;
            line-height: 1.8;
            max-width: 800px;
            margin: 0 auto;
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
            
            .achievements-grid {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .challenges-list {
                grid-template-columns: 1fr;
            }
            
            .plans-grid {
                grid-template-columns: 1fr;
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
            <div class="page-title">Achievements & Future Plans</div>
            <div class="breadcrumb">
                <p>Home / About / Achievements & Plans</p>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Achievements Section -->
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">10.0 Achievements, Challenges & Future Plans</h2>
                <p class="section-subtitle">Our journey of excellence and vision for the future</p>
            </div>
            
            <div class="achievements-section">
                <div class="section-header">
                    <h3 class="section-title">10.1 Achievements</h3>
                    <p class="section-subtitle">Milestones and accomplishments in our educational journey</p>
                </div>
                
                <div class="achievements-grid">
                    <div class="achievement-card">
                        <div class="achievement-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <h4 class="achievement-title">Infrastructure Development</h4>
                        <p class="achievement-description">
                            Completion of a multi-purpose hall and first phase of a new storeyed girls' hostel
                        </p>
                    </div>
                    
                    <div class="achievement-card">
                        <div class="achievement-icon">
                            <i class="fas fa-bus"></i>
                        </div>
                        <h4 class="achievement-title">Transport Enhancement</h4>
                        <p class="achievement-description">
                            Acquisition of another coaster bus to help in transportation of students and staff
                        </p>
                    </div>
                    
                    <div class="achievement-card">
                        <div class="achievement-icon">
                            <i class="fas fa-flask"></i>
                        </div>
                        <h4 class="achievement-title">Skills Laboratories</h4>
                        <p class="achievement-description">
                            Separated and equipped the skills laboratories for Midwifery and Nursing sections
                        </p>
                    </div>
                    
                    <div class="achievement-card">
                        <div class="achievement-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h4 class="achievement-title">Academic Excellence</h4>
                        <p class="achievement-description">
                            Performed very well in past state final examinations with 100% pass rate in midwifery and over 85% in nursing
                        </p>
                    </div>
                    
                    <div class="achievement-card">
                        <div class="achievement-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4 class="achievement-title">Student Growth</h4>
                        <p class="achievement-description">
                            Increased student population from 13 in 2009 to current 315 (231 females, 84 males, 117 midwives)
                        </p>
                    </div>
                    
                    <div class="achievement-card">
                        <div class="achievement-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h4 class="achievement-title">Staff Development</h4>
                        <p class="achievement-description">
                            Sponsoring four staff members at Health Tutors' College - Mulage for Medical Education
                        </p>
                    </div>
                    
                    <div class="achievement-card">
                        <div class="achievement-icon">
                            <i class="fas fa-drafting-compass"></i>
                        </div>
                        <h4 class="achievement-title">Structural Planning</h4>
                        <p class="achievement-description">
                            The school has drawn a structural plan to guide future developments
                        </p>
                    </div>
                    
                    <div class="achievement-card">
                        <div class="achievement-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h4 class="achievement-title">Power Solutions</h4>
                        <p class="achievement-description">
                            Acquired generators and solar panels to address load shedding problems
                        </p>
                    </div>
                    
                    <div class="achievement-card">
                        <div class="achievement-icon">
                            <i class="fas fa-map"></i>
                        </div>
                        <h4 class="achievement-title">Land Acquisition</h4>
                        <p class="achievement-description">
                            Acquired over 12 acres of registered/leased land (freehold) for future development
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Statistics Section -->
        <section class="section">
            <div class="stats-section">
                <div class="stats-content">
                    <h2 class="stats-title">Our Impact in Numbers</h2>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-number">315</span>
                            <span class="stat-label">Total Students</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">100%</span>
                            <span class="stat-label">Midwifery Pass Rate</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">85%</span>
                            <span class="stat-label">Nursing Pass Rate</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">12+</span>
                            <span class="stat-label">Acres of Land</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">4</span>
                            <span class="stat-label">Programs Offered</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">7</span>
                            <span class="stat-label">Practicum Sites</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Challenges Section -->
        <section class="section">
            <div class="challenges-section">
                <div class="section-header">
                    <h3 class="section-title">10.2 Challenges</h3>
                    <p class="section-subtitle">Current challenges we are working to overcome</p>
                </div>
                
                <div class="challenges-list">
                    <div class="challenge-card">
                        <div class="challenge-icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <h4 class="challenge-title">Inadequate Funding</h4>
                        <p class="challenge-description">
                            The school currently depends on tuition fees collected from students
                        </p>
                    </div>
                    
                    <div class="challenge-card">
                        <div class="challenge-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <h4 class="challenge-title">Administration Block</h4>
                        <p class="challenge-description">
                            Need for construction of a proper administration block
                        </p>
                    </div>
                    
                    <div class="challenge-card">
                        <div class="challenge-icon">
                            <i class="fas fa-hospital"></i>
                        </div>
                        <h4 class="challenge-title">Hospital Site</h4>
                        <p class="challenge-description">
                            Construction of a basic hospital site for community and student practicum
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Future Plans Section -->
        <section class="section">
            <div class="future-plans-section">
                <div class="section-header">
                    <h3 class="section-title">10.3 Future Plans</h3>
                    <p class="section-subtitle">Our vision for growth and development</p>
                </div>
                
                <div class="plans-tabs">
                    <button class="plan-tab active" onclick="showPlan('short-term')">Short Term</button>
                    <button class="plan-tab" onclick="showPlan('long-term')">Long Term</button>
                </div>
                
                <div id="short-term" class="plans-content active">
                    <div class="plans-grid">
                        <div class="plan-card">
                            <div class="plan-icon">
                                <i class="fas fa-hand-holding-usd"></i>
                            </div>
                            <h4 class="plan-title">Resource Mobilization</h4>
                            <p class="plan-description">
                                Mobilize more resources from within and without
                            </p>
                        </div>
                        
                        <div class="plan-card">
                            <div class="plan-icon">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <h4 class="plan-title">Staff Welfare</h4>
                            <p class="plan-description">
                                Improve the working conditions of our teaching and non-teaching staff
                            </p>
                        </div>
                        
                        <div class="plan-card">
                            <div class="plan-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <h4 class="plan-title">Infrastructure Development</h4>
                            <p class="plan-description">
                                Construct an administration block, classroom block, boys' hostel
                            </p>
                        </div>
                        
                        <div class="plan-card">
                            <div class="plan-icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <h4 class="plan-title">Library Enhancement</h4>
                            <p class="plan-description">
                                Procure more reference books for the library
                            </p>
                        </div>
                        
                        <div class="plan-card">
                            <div class="plan-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <h4 class="plan-title">Staff Training</h4>
                            <p class="plan-description">
                                Continue supporting our clinical instructors to enroll for the Tutors' Training
                            </p>
                        </div>
                    </div>
                </div>
                
                <div id="long-term" class="plans-content">
                    <div class="plans-grid">
                        <div class="plan-card">
                            <div class="plan-icon">
                                <i class="fas fa-desktop"></i>
                            </div>
                            <h4 class="plan-title">Computer Laboratory</h4>
                            <p class="plan-description">
                                Put up a fully registered Computer Laboratory within the school for student certifications
                            </p>
                        </div>
                        
                        <div class="plan-card">
                            <div class="plan-icon">
                                <i class="fas fa-sitemap"></i>
                            </div>
                            <h4 class="plan-title">Institutional Capacity</h4>
                            <p class="plan-description">
                                Improve institutional capacity through setting up of departments like Human Resource, Planning, Administration, Accounts and Finance
                            </p>
                        </div>
                        
                        <div class="plan-card">
                            <div class="plan-icon">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <h4 class="plan-title">Twinning Programs</h4>
                            <p class="plan-description">
                                Twinning with other schools for enhanced collaboration and learning
                            </p>
                        </div>
                        
                        <div class="plan-card">
                            <div class="plan-icon">
                                <i class="fas fa-hospital"></i>
                            </div>
                            <h4 class="plan-title">Community Hospital</h4>
                            <p class="plan-description">
                                Construct a hospital for the community and student's practicum
                            </p>
                        </div>
                        
                        <div class="plan-card">
                            <div class="plan-icon">
                                <i class="fas fa-landmark"></i>
                            </div>
                            <h4 class="plan-title">Government Support</h4>
                            <p class="plan-description">
                                Appeal to the government to support the school through delegated funds
                            </p>
                        </div>
                        
                        <div class="plan-card">
                            <div class="plan-icon">
                                <i class="fas fa-hands-helping"></i>
                            </div>
                            <h4 class="plan-title">Donor Support</h4>
                            <p class="plan-description">
                                Appeal to Ministry of Education and Sports (MOES) and Ministry of Health (MOH) to identify donors to support the school
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Achievement Gallery Section -->
        <section class="section">
            <div class="achievement-gallery-section">
                <div class="section-content">
                    <h2 class="section-title">Achievement Gallery</h2>
                    <p class="section-description">
                        Visual showcase of our major achievements and milestones throughout the years
                    </p>
                    
                    <div class="achievement-gallery">
                        <!-- Administration Block -->
                        <div class="achievement-card">
                            <img src="assets/administration-block.jpg" alt="ISNM Administration Block - Main Administrative Building" title="ISNM Administration Block - Central Hub of School Management" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Administration Block</h3>
                                <p class="achievement-card-description">
                                    Our modern administration block serves as the central hub for school management and operations
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Infrastructure</span>
                                    <span class="achievement-badge">Management</span>
                                </div>
                            </div>
                        </div>

                        <!-- Certificate Students in Examination -->
                        <div class="achievement-card">
                            <img src="assets/certificate-in-nursing-students-in-examamination-room.jpg" alt="ISNM Certificate Nursing Students in Examination Room" title="ISNM Certificate Nursing Students - Academic Assessment in Progress" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Academic Excellence</h3>
                                <p class="achievement-card-description">
                                    Certificate nursing students demonstrating their knowledge during rigorous examinations
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Academics</span>
                                    <span class="achievement-badge">Assessment</span>
                                </div>
                            </div>
                        </div>

                        <!-- Classroom Building -->
                        <div class="achievement-card">
                            <img src="assets/classroom-building.jpg" alt="ISNM Classroom Building - Modern Learning Facilities" title="ISNM Classroom Building - State-of-the-Art Learning Environment" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Modern Classrooms</h3>
                                <p class="achievement-card-description">
                                    Well-equipped classroom buildings providing conducive learning environments
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Infrastructure</span>
                                    <span class="achievement-badge">Learning</span>
                                </div>
                            </div>
                        </div>

                        <!-- Dining Hall -->
                        <div class="achievement-card">
                            <img src="assets/dinnin-hall-or-main-hall.jpg" alt="ISNM Dining Hall - Student Dining Facilities" title="ISNM Main Dining Hall - Student Nutrition and Social Space" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Dining Hall</h3>
                                <p class="achievement-card-description">
                                    Spacious dining hall providing nutritious meals and social interaction space
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Facilities</span>
                                    <span class="achievement-badge">Student Life</span>
                                </div>
                            </div>
                        </div>

                        <!-- Diploma Hostel -->
                        <div class="achievement-card">
                            <img src="assets/diploma-hostel.jpg" alt="ISNM Diploma Hostel - Student Accommodation" title="ISNM Diploma Hostel - Comfortable Student Living Facilities" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Diploma Hostel</h3>
                                <p class="achievement-card-description">
                                    Modern hostel facilities providing comfortable accommodation for diploma students
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Accommodation</span>
                                    <span class="achievement-badge">Student Welfare</span>
                                </div>
                            </div>
                        </div>

                        <!-- Diploma Extension Images -->
                        <div class="achievement-card">
                            <img src="assets/diploma-in-nursing-and-midwifery-extension-images-for-students.jpg" alt="ISNM Diploma Extension Program - Student Activities" title="ISNM Diploma Extension Program - Enhanced Learning Opportunities" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Extension Programs</h3>
                                <p class="achievement-card-description">
                                    Diploma in nursing and midwifery extension programs enhancing student opportunities
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Programs</span>
                                    <span class="achievement-badge">Innovation</span>
                                </div>
                            </div>
                        </div>

                        <!-- Girls Hostel -->
                        <div class="achievement-card">
                            <img src="assets/girls-hostel.jpg" alt="ISNM Girls Hostel - Female Student Accommodation" title="ISNM Girls Hostel - Safe and Comfortable Living Environment" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Girls Hostel</h3>
                                <p class="achievement-card-description">
                                    Secure and comfortable hostel facilities specifically designed for female students
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Accommodation</span>
                                    <span class="achievement-badge">Safety</span>
                                </div>
                            </div>
                        </div>

                        <!-- Library Revision Session -->
                        <div class="achievement-card">
                            <img src="assets/revision-session-at-the-school-library.jpg" alt="ISNM Library Revision Session - Student Study" title="ISNM Library Revision Session - Academic Excellence in Progress" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Library Studies</h3>
                                <p class="achievement-card-description">
                                    Students engaged in intensive revision sessions at the school library
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Academics</span>
                                    <span class="achievement-badge">Library</span>
                                </div>
                            </div>
                        </div>

                        <!-- School Kitchen -->
                        <div class="achievement-card">
                            <img src="assets/school-kitchen.jpg" alt="ISNM School Kitchen - Food Preparation Facilities" title="ISNM School Kitchen - Modern Food Preparation and Nutrition Center" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">School Kitchen</h3>
                                <p class="achievement-card-description">
                                    Modern kitchen facilities ensuring nutritious meal preparation for all students
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Facilities</span>
                                    <span class="achievement-badge">Nutrition</span>
                                </div>
                            </div>
                        </div>

                        <!-- Skills Laboratory -->
                        <div class="achievement-card">
                            <img src="assets/students-in-skill-laboratory-in-practical-training.jpg" alt="ISNM Skills Laboratory - Practical Training Session" title="ISNM Skills Laboratory - Hands-on Practical Training for Students" class="achievement-image">
                            <div class="achievement-card-content">
                                <h3 class="achievement-card-title">Skills Laboratory</h3>
                                <p class="achievement-card-description">
                                    Students engaged in practical training sessions in our modern skills laboratory
                                </p>
                                <div class="achievement-badges">
                                    <span class="achievement-badge">Training</span>
                                    <span class="achievement-badge">Skills</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Conclusion Section -->
        <section class="section">
            <div class="conclusion-section">
                <div class="conclusion-content">
                    <h2 class="conclusion-title">Conclusion</h2>
                    <p class="conclusion-text">
                        Iganga School of Nursing and Midwifery is committed to fulfilling its objectives as evidenced by its achievements within the years of its existence. This has been attained as a result of the support and guidance from several stakeholders for whom we are grateful. We intend to build on these achievements to take the school to the next level. We call upon the government and all the key stakeholders to continue supporting and guiding the school in this endeavour.
                    </p>
                </div>
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
                    <h3 class="footer-title">Admissions</h3>
                    <ul class="footer-links">
                        <li><a href="admissions.php">Apply Now</a></li>
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
        // Plan tabs functionality
        function showPlan(planType) {
            // Remove active class from all tabs and contents
            document.querySelectorAll('.plan-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            document.querySelectorAll('.plans-content').forEach(content => {
                content.classList.remove('active');
            });
            
            // Add active class to selected tab and content
            event.target.classList.add('active');
            document.getElementById(planType).classList.add('active');
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


