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
    <title>Iganga School of Nursing and Midwifery - Excellence in Healthcare Education</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-blue: #0066ff;
            --secondary-blue: #0052cc;
            --accent-blue: #3399ff;
            --light-green: #86efac;
            --creamy-yellow: #fef3c7;
            --golden-yellow: #fbbf24;
            --neon-cyan: #00ffff;
            --clean-white: #ffffff;
            --text-primary: #001a33;
            --text-secondary: #334455;
            --shadow-sm: 0 4px 8px rgba(0, 0, 0, 0.15);
            --shadow-md: 0 8px 16px rgba(0, 0, 0, 0.2);
            --shadow-xl: 0 32px 64px rgba(0, 0, 0, 0.3);
            --border-color: #cce5ff;
            --gradient-primary: linear-gradient(135deg, #0066ff 0%, #0052cc 25%, #00cccc 50%, #00cc66 75%, #fbbf24 100%);
            --gradient-hero: linear-gradient(135deg, #0052cc 0%, #00cccc 33%, #00cc66 66%, #fbbf24 100%);
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
            background: linear-gradient(45deg, #000428, #004e92, #001a33);
            color: var(--text-primary);
            line-height: 1.6;
            overflow-x: hidden;
            position: relative;
            min-height: 100vh;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 50%, rgba(0, 255, 255, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(134, 239, 172, 0.2) 0%, transparent 50%);
            animation: auroraBorealis 15s ease-in-out infinite;
            pointer-events: none;
            z-index: -1;
        }

        /* Navigation */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(0, 26, 51, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 2px solid var(--neon-cyan);
            z-index: 1000;
            padding: 1rem 0;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-md);
        }

        .navbar.scrolled {
            background: rgba(0, 26, 51, 0.98);
            box-shadow: var(--shadow-xl);
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
            font-weight: 800;
            font-size: 1.4rem;
            color: var(--neon-cyan);
            text-decoration: none;
            text-shadow: 0 0 10px rgba(0, 255, 255, 0.6);
            position: relative;
        }

        .nav-logo img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border: 2px solid var(--neon-cyan);
            box-shadow: var(--shadow-md);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-link {
            color: var(--clean-white);
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            position: relative;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            background: rgba(0, 255, 255, 0.1);
            border: 1px solid transparent;
        }

        .nav-link:hover {
            color: var(--neon-cyan);
            background: rgba(0, 255, 255, 0.2);
            border-color: var(--neon-cyan);
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: var(--gradient-hero);
            position: relative;
            overflow: hidden;
            margin-top: 70px;
        }

        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0.2;
        }

        .hero-particles {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 20% 80%, rgba(0, 255, 255, 0.6) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(134, 239, 172, 0.6) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(251, 191, 36, 0.4) 0%, transparent 50%),
                radial-gradient(circle at 60% 60%, rgba(0, 204, 102, 0.4) 0%, transparent 50%);
            animation: particleFloat 20s ease-in-out infinite;
        }

        .hero-aurora {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--gradient-aurora);
            opacity: 0.3;
            animation: auroraWave 10s ease-in-out infinite;
            filter: blur(40px);
        }

        .hero-grid {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M20 0 L0 0 0 20" fill="none" stroke="rgba(0,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>'),
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><defs><pattern id="medical-grid" width="40" height="40" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="2" fill="rgba(134,239,172,0.3)"/><path d="M10 20 Q20 10, 30 20 T50 20" stroke="rgba(251,191,36,0.4)" stroke-width="1" fill="none"/></pattern></defs><rect width="200" height="200" fill="url(%23medical-grid)"/></svg>');
            background-size: 20px 20px, 80px 80px;
            animation: gridMove 30s linear infinite;
            opacity: 0.6;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            margin: 0 auto;
            padding: 4rem 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .hero-text {
            animation: fadeInUp 1s ease-out;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(0, 255, 255, 0.2);
            backdrop-filter: blur(20px);
            padding: 0.8rem 1.5rem;
            border-radius: 50px;
            color: var(--neon-cyan);
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 2rem;
            border: 2px solid var(--neon-cyan);
            box-shadow: var(--shadow-neon);
            animation: badgePulse 2s ease-in-out infinite;
            position: relative;
            overflow: hidden;
        }

        .hero-badge::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 255, 255, 0.6), transparent);
            animation: badgeShine 3s ease-in-out infinite;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 900;
            line-height: 1.1;
            color: white;
            margin-bottom: 2rem;
            text-shadow: 
                0 1px 0 #ccc,
                0 2px 0 #c9c9c9,
                0 3px 0 #bbb,
                0 4px 0 #b9b9b9,
                0 5px 0 #aaa,
                0 6px 1px rgba(0,0,0,.1),
                0 0 5px rgba(0,0,0,.1),
                0 1px 3px rgba(0,0,0,.3),
                0 3px 5px rgba(0,0,0,.2),
                0 5px 10px rgba(0,0,0,.25),
                0 10px 10px rgba(0,0,0,.2),
                0 20px 20px rgba(0,0,0,.15);
            animation: title3DFloat 4s ease-in-out infinite;
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 2rem;
            line-height: 1.6;
            text-shadow: 0 0 20px rgba(0, 255, 255, 0.6);
        }

        .hero-stats {
            display: flex;
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .hero-stat {
            text-align: center;
        }

        .hero-stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: white;
            display: block;
            margin-bottom: 0.5rem;
        }

        .hero-stat-label {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .hero-visual {
            position: relative;
            animation: fadeInRight 1s ease-out;
        }

        .hero-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 3rem;
            box-shadow: var(--shadow-2xl);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .hero-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }

        .hero-card-icon {
            width: 80px;
            height: 80px;
            background: var(--gradient-primary);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            margin-bottom: 2rem;
            animation: pulse 2s ease-in-out infinite;
        }

        .hero-card-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .hero-card-description {
            color: var(--text-secondary);
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .hero-buttons {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
            margin-top: 3rem;
        }

        .btn {
            padding: 1.5rem 3rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.2rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            border: none;
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.6s ease;
        }

        .btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.5) 0%, transparent 70%);
            transform: translate(-50%, -50%);
            transition: all 0.5s ease;
            border-radius: 50%;
        }

        .btn-primary {
            background: var(--gradient-neon);
            color: white;
            box-shadow: var(--shadow-neon);
            border: 2px solid var(--neon-cyan);
            animation: btnPulse 2s ease-in-out infinite;
        }

        .btn-primary:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: var(--shadow-glow), var(--shadow-xl);
            background: var(--gradient-aurora);
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover::after {
            width: 150%;
            height: 150%;
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: var(--neon-cyan);
            border: 2px solid var(--light-green);
            backdrop-filter: blur(20px);
            box-shadow: var(--shadow-glow);
        }

        .btn-secondary:hover {
            background: rgba(134, 239, 172, 0.3);
            transform: translateY(-5px) scale(1.05);
            box-shadow: var(--shadow-pulse), var(--shadow-xl);
            border-color: var(--light-green);
        }

        .btn-secondary:hover::before {
            left: 100%;
        }

        .btn-secondary:hover::after {
            width: 150%;
            height: 150%;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--golden-yellow), var(--warm-yellow));
            color: var(--primary-blue);
            box-shadow: var(--shadow-yellow);
            border: 2px solid var(--golden-yellow);
            animation: loginBtnGlow 3s ease-in-out infinite;
        }

        .btn-login:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: var(--shadow-glow), var(--shadow-2xl);
            background: linear-gradient(135deg, var(--warm-yellow), var(--golden-yellow));
            color: white;
        }

        /* Features Section */
        .features-section {
            padding: 6rem 2rem;
            background: white;
        }

        .section-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--gradient-secondary);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 1rem;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: var(--text-secondary);
            max-width: 600px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 2.5rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--gradient-primary);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            box-shadow: var(--shadow-xl);
            transform: translateY(-5px);
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: var(--gradient-primary);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 1.5rem;
        }

        .feature-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .feature-description {
            color: var(--text-secondary);
            line-height: 1.6;
        }

        /* Programs Section */
        .programs-section {
            padding: 6rem 2rem;
            background: var(--soft-gray);
        }

        .programs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .program-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            transition: all 0.3s ease;
            position: relative;
        }

        .program-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-2xl);
        }

        .program-header {
            background: var(--gradient-primary);
            padding: 2rem;
            text-align: center;
            color: white;
        }

        .program-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .program-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .program-duration {
            opacity: 0.9;
            font-size: 0.9rem;
        }

        .program-body {
            padding: 2rem;
        }

        .program-features {
            list-style: none;
            margin-bottom: 2rem;
        }

        .program-feature {
            padding: 0.5rem 0;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .program-feature::before {
            content: 'i';
            color: var(--health-green);
            font-weight: bold;
            font-style: normal;
        }

        .program-fee {
            background: var(--light-slate);
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            text-align: center;
        }

        .program-fee-label {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
        }

        .program-fee-amount {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--primary-blue);
        }

        /* Admission Section */
        .admission-section {
            padding: 6rem 2rem;
            background: var(--gradient-primary);
            color: white;
            position: relative;
            overflow: hidden;
        }

        .admission-background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0.1;
            background-image: 
                radial-gradient(circle at 20% 20%, rgba(255, 255, 255, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.3) 0%, transparent 50%);
        }

        .admission-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .admission-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .admission-subtitle {
            font-size: 1.3rem;
            opacity: 0.9;
            margin-bottom: 3rem;
        }

        .admission-requirements {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 3rem;
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .requirements-list {
            text-align: left;
            list-style: none;
        }

        .requirements-list li {
            padding: 1rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .requirements-list li:last-child {
            border-bottom: none;
        }

        .requirements-list li::before {
            content: 'i';
            color: white;
            font-weight: bold;
            font-style: normal;
            font-size: 1.2rem;
        }

        /* Footer */
        .footer {
            background: var(--text-primary);
            color: white;
            padding: 3rem 2rem 2rem;
            text-align: center;
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

        .footer-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
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
        }

        /* Mind-Blowing Animations */
        @keyframes auroraBorealis {
            0%, 100% {
                transform: translateX(0) translateY(0) rotate(0deg);
                opacity: 0.3;
            }
            25% {
                transform: translateX(50px) translateY(-30px) rotate(90deg);
                opacity: 0.5;
            }
            50% {
                transform: translateX(-30px) translateY(50px) rotate(180deg);
                opacity: 0.7;
            }
            75% {
                transform: translateX(30px) translateY(-20px) rotate(270deg);
                opacity: 0.4;
            }
        }

        @keyframes particleFloat {
            0%, 100% {
                transform: translateY(0) translateX(0) rotate(0deg);
                opacity: 0.6;
            }
            25% {
                transform: translateY(-30px) translateX(20px) rotate(90deg);
                opacity: 0.8;
            }
            50% {
                transform: translateY(-50px) translateX(-20px) rotate(180deg);
                opacity: 1;
            }
            75% {
                transform: translateY(-20px) translateX(30px) rotate(270deg);
                opacity: 0.7;
            }
        }

        @keyframes auroraWave {
            0%, 100% {
                transform: translateX(0) translateY(0) scale(1);
                opacity: 0.3;
            }
            25% {
                transform: translateX(100px) translateY(-50px) scale(1.2);
                opacity: 0.5;
            }
            50% {
                transform: translateX(-100px) translateY(50px) scale(0.8);
                opacity: 0.7;
            }
            75% {
                transform: translateX(50px) translateY(-30px) scale(1.1);
                opacity: 0.4;
            }
        }

        @keyframes gridMove {
            0% {
                transform: translate(0, 0);
            }
            100% {
                transform: translate(100px, 100px);
            }
        }

        @keyframes logoGlow {
            0%, 100% {
                text-shadow: 0 0 20px rgba(0, 255, 255, 0.8);
                transform: scale(1);
            }
            50% {
                text-shadow: 0 0 40px rgba(0, 255, 255, 1), 0 0 60px rgba(251, 191, 36, 0.8);
                transform: scale(1.05);
            }
        }

        @keyframes logoPulse {
            0%, 100% {
                opacity: 0.3;
                transform: scale(1);
            }
            50% {
                opacity: 0.6;
                transform: scale(1.1);
            }
        }

        @keyframes title3DFloat {
            0%, 100% {
                transform: translateY(0) rotateX(0deg) rotateY(0deg);
            }
            25% {
                transform: translateY(-10px) rotateX(2deg) rotateY(2deg);
            }
            50% {
                transform: translateY(-20px) rotateX(0deg) rotateY(0deg);
            }
            75% {
                transform: translateY(-10px) rotateX(-2deg) rotateY(-2deg);
            }
        }

        @keyframes badgePulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 0 20px rgba(0, 255, 255, 0.6);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 0 40px rgba(0, 255, 255, 0.9);
            }
        }

        @keyframes badgeShine {
            0%, 100% {
                left: -100%;
            }
            50% {
                left: 100%;
            }
        }

        @keyframes btnPulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 0 30px rgba(0, 255, 255, 0.8);
            }
            50% {
                transform: scale(1.02);
                box-shadow: 0 0 50px rgba(0, 255, 255, 1);
            }
        }

        @keyframes loginBtnGlow {
            0%, 100% {
                box-shadow: 0 0 30px rgba(251, 191, 36, 0.8), 0 0 60px rgba(134, 239, 172, 0.6);
            }
            50% {
                box-shadow: 0 0 50px rgba(251, 191, 36, 1), 0 0 100px rgba(134, 239, 172, 0.8);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
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

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .hero-content {
                grid-template-columns: 1fr;
                gap: 2rem;
                padding: 2rem 1rem;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-stats {
                gap: 2rem;
            }

            .hero-card {
                padding: 2rem;
            }

            .features-grid,
            .programs-grid {
                grid-template-columns: 1fr;
            }

            .section-title {
                font-size: 2rem;
            }

            .footer-buttons {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <a href="#" class="nav-logo">
                <img src="public/isnm-logo.jpeg" alt="ISNM">
                <span>IGANGA SCHOOL OF NURSING AND MIDWIFERY</span>
            </a>
            <div class="nav-links">
                <a href="#home" class="nav-link">Home</a>
                 <a href="login-portal.php" class="btn btn-primary">Login</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="hero-background"></div>
        <div class="hero-particles"></div>
        <div class="hero-content">
            <div class="hero-text">
                <div class="hero-badge">
                    <i class="fas fa-award"></i>
                    <span>Excellence in Healthcare Education Since 2009</span>
                </div>
                <h1 class="hero-title">Chosen to Serve</h1>
                <p class="hero-subtitle">
                    Join Iganga School of Nursing and Midwifery for world-class education, 
                    hands-on training, and a rewarding career in healthcare.
                </p>
                <div class="hero-stats">
                    <div class="hero-stat">
                        <span class="hero-stat-number">5000+</span>
                        <span class="hero-stat-label">Graduates</span>
                    </div>
                    <div class="hero-stat">
                        <span class="hero-stat-number">95%</span>
                        <span class="hero-stat-label">Employment Rate</span>
                    </div>
                    <div class="hero-stat">
                        <span class="hero-stat-number">15+</span>
                        <span class="hero-stat-label">Years Experience</span>
                    </div>
                </div>
                <div class="hero-buttons">
                    <a href="admissions.php" class="btn btn-primary">
                        <i class="fas fa-graduation-cap"></i>
                        Apply Now
                    </a>
                    <a href="login-portal.php" class="btn btn-login">
                        <i class="fas fa-sign-in-alt"></i>
                        Login Portal
                    </a>
                    <a href="#programs" class="btn btn-secondary">
                        <i class="fas fa-book-open"></i>
                        Explore Programs
                    </a>
                </div>
            </div>
            <div class="hero-visual">
                <div class="hero-card">
                    <div class="hero-card-icon">
                        <i class="fas fa-heart-pulse"></i>
                    </div>
                    <h3 class="hero-card-title">Start Your Healthcare Journey</h3>
                    <p class="hero-card-description">
                        Take the first step towards a fulfilling career in nursing and midwifery. 
                        Our comprehensive programs prepare you for excellence in healthcare.
                    </p>
                    <div class="hero-buttons">
                        <a href="admissions.php" class="btn btn-primary">
                            <i class="fas fa-arrow-right"></i>
                            Get Started
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="section-container">
            <div class="section-header">
                <div class="section-badge">
                    <i class="fas fa-star"></i>
                    <span>Why Choose ISNM</span>
                </div>
                <h2 class="section-title">Excellence in Healthcare Education</h2>
                <p class="section-subtitle">
                    We provide comprehensive training, modern facilities, and experienced faculty 
                    to ensure your success in the healthcare industry.
                </p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h3 class="feature-title">Expert Faculty</h3>
                    <p class="feature-description">
                        Learn from experienced healthcare professionals and educators 
                        dedicated to your success and professional growth.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-hospital"></i>
                    </div>
                    <h3 class="feature-title">Clinical Training</h3>
                    <p class="feature-description">
                        Gain hands-on experience through partnerships with leading hospitals 
                        and healthcare facilities in the region.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h3 class="feature-title">Recognized Certification</h3>
                    <p class="feature-description">
                        Earn nationally and internationally recognized qualifications 
                        that open doors to global career opportunities.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs Section -->
    <section class="programs-section" id="programs">
        <div class="section-container">
            <div class="section-header">
                <div class="section-badge">
                    <i class="fas fa-book"></i>
                    <span>Academic Programs</span>
                </div>
                <h2 class="section-title">Choose Your Path to Excellence</h2>
                <p class="section-subtitle">
                    Select from our comprehensive range of diploma and certificate programs 
                    designed to meet your career goals.
                </p>
            </div>
            <div class="programs-grid">
                <div class="program-card">
                    <div class="program-header">
                        <div class="program-icon">
                            <i class="fas fa-user-nurse"></i>
                        </div>
                        <h3 class="program-title">Diploma in Nursing</h3>
                        <p class="program-duration">3 Years</p>
                    </div>
                    <div class="program-body">
                        <ul class="program-features">
                            <li class="program-feature">Comprehensive nursing education</li>
                            <li class="program-feature">Clinical rotations</li>
                            <li class="program-feature">Advanced patient care</li>
                            <li class="program-feature">Professional certification</li>
                        </ul>
                        <div class="program-fee">
                            <div class="program-fee-label">Admission Fee</div>
                            <div class="program-fee-amount">90,000 UGX</div>
                        </div>
                        <a href="admissions.php" class="btn btn-primary" style="width: 100%;">
                            <i class="fas fa-arrow-right"></i>
                            Apply Now
                        </a>
                    </div>
                </div>

                <div class="program-card">
                    <div class="program-header">
                        <div class="program-icon">
                            <i class="fas fa-baby"></i>
                        </div>
                        <h3 class="program-title">Diploma in Midwifery</h3>
                        <p class="program-duration">3 Years</p>
                    </div>
                    <div class="program-body">
                        <ul class="program-features">
                            <li class="program-feature">Maternal health expertise</li>
                            <li class="program-feature">Neonatal care training</li>
                            <li class="program-feature">Community health</li>
                            <li class="program-feature">Delivery management</li>
                        </ul>
                        <div class="program-fee">
                            <div class="program-fee-label">Admission Fee</div>
                            <div class="program-fee-amount">95,000 UGX</div>
                        </div>
                        <a href="admissions.php" class="btn btn-primary" style="width: 100%;">
                            <i class="fas fa-arrow-right"></i>
                            Apply Now
                        </a>
                    </div>
                </div>

                <div class="program-card">
                    <div class="program-header">
                        <div class="program-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <h3 class="program-title">Certificate in Nursing</h3>
                        <p class="program-duration">2 Years</p>
                    </div>
                    <div class="program-body">
                        <ul class="program-features">
                            <li class="program-feature">Essential nursing skills</li>
                            <li class="program-feature">Quick career entry</li>
                            <li class="program-feature">Foundation training</li>
                            <li class="program-feature">Pathway to diploma</li>
                        </ul>
                        <div class="program-fee">
                            <div class="program-fee-label">Admission Fee</div>
                            <div class="program-fee-amount">90,000 UGX</div>
                        </div>
                        <a href="admissions.php" class="btn btn-primary" style="width: 100%;">
                            <i class="fas fa-arrow-right"></i>
                            Apply Now
                        </a>
                    </div>
                </div>

                <div class="program-card">
                    <div class="program-header">
                        <div class="program-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h3 class="program-title">Certificate in Midwifery</h3>
                        <p class="program-duration">2 Years</p>
                    </div>
                    <div class="program-body">
                        <ul class="program-features">
                            <li class="program-feature">Core midwifery skills</li>
                            <li class="program-feature">Hands-on training</li>
                            <li class="program-feature">Maternal care focus</li>
                            <li class="program-feature">Career advancement</li>
                        </ul>
                        <div class="program-fee">
                            <div class="program-fee-label">Admission Fee</div>
                            <div class="program-fee-amount">90,000 UGX</div>
                        </div>
                        <a href="admissions.php" class="btn btn-primary" style="width: 100%;">
                            <i class="fas fa-arrow-right"></i>
                            Apply Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Admission Section -->
    <section class="admission-section" id="admissions">
        <div class="admission-background"></div>
        <div class="section-container">
            <div class="admission-content">
                <div class="section-badge" style="background: rgba(255, 255, 255, 0.2);">
                    <i class="fas fa-info-circle"></i>
                    <span>Admission Information</span>
                </div>
                <h2 class="admission-title">Join Our Healthcare Community</h2>
                <p class="admission-subtitle">
                    Take the first step towards a rewarding career in healthcare
                </p>
                <div class="admission-requirements">
                    <h3 style="margin-bottom: 2rem; font-size: 1.5rem;">Admission Requirements</h3>
                    <ul class="requirements-list">
                        <li>Uganda Certificate of Education (UCE) with at least 5 passes</li>
                        <li>Uganda Advanced Certificate of Education (UACE) with at least 2 principal passes</li>
                        <li>Science subjects (Biology, Chemistry, Physics) preferred</li>
                        <li>Minimum age: 17 years</li>
                        <li>Medical fitness certificate</li>
                        <li>Two passport photographs</li>
                        <li>Copies of academic certificates</li>
                        <li>Interview and assessment</li>
                    </ul>
                    <div style="margin-top: 2rem; padding: 1.5rem; background: rgba(255, 255, 255, 0.1); border-radius: 12px;">
                        <div style="font-size: 1.8rem; font-weight: 800; margin-bottom: 0.5rem;">90,000 UGX</div>
                        <div style="opacity: 0.9;">Admission Fee (One-time payment)</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="contact">
        <div class="footer-content">
            <h3 class="footer-title">Designed and Developed by Reagan Otema</h3>
            <p class="footer-subtitle">For system errors, contact via WhatsApp</p>
            <div class="footer-buttons">
                <a href="https://wa.me/256772514889" target="_blank" class="whatsapp-btn">
                    <i class="fab fa-whatsapp"></i>
                    MTN WhatsApp: +256772514889
                </a>
                <a href="https://wa.me/256730314979" target="_blank" class="whatsapp-btn">
                    <i class="fab fa-whatsapp"></i>
                    Airtel WhatsApp: +256730314979
                </a>
            </div>
        </div>
    </footer>

    <script>
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

        // Intersection Observer for animations
        if ('IntersectionObserver' in window) {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animation = 'fadeInUp 0.8s ease-out';
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            // Observe feature cards and program cards
            document.querySelectorAll('.feature-card, .program-card').forEach(card => {
                observer.observe(card);
            });
        }

        // Parallax effect for hero section
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const heroBackground = document.querySelector('.hero-background');
            const heroParticles = document.querySelector('.hero-particles');
            
            if (heroBackground && heroParticles) {
                heroBackground.style.transform = `translateY(${scrolled * 0.5}px)`;
                heroParticles.style.transform = `translateY(${scrolled * 0.3}px)`;
            }
        });
    </script>
</body>
</html>
