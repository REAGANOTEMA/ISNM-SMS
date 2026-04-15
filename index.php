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
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Inter:wght@300;400;500;600;700&family=Copperplate+Gothic+Bold&family=Rockwell+Extra+Bold&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            /* Hospital-Quality Professional Color Palette */
            --medical-primary: #0F4C75;
            --medical-secondary: #1E6BA8;
            --medical-accent: #2E8BC0;
            --medical-teal: #16A5A5;
            --medical-cyan: #0EA5E9;
            --medical-blue: #3B82F6;
            --medical-green: #10B981;
            --medical-white: #FFFFFF;
            --medical-gray: #F8FAFC;
            --medical-dark: #0F172A;
            --medical-light: #F1F5F9;
            
            /* Medical 3D Color Variations */
            --primary-3d: #0F4C75;
            --secondary-3d: #1E6BA8;
            --accent-3d: #2E8BC0;
            --success-3d: #10B981;
            --warning-3d: #F59E0B;
            --danger-3d: #EF4444;
            --info-3d: #06B6D4;
            --dark-3d: #0F172A;
            --light-3d: #F1F5F9;
            
            /* Mind-Blowing 3D Gradients */
            --gradient-3d-hero: linear-gradient(135deg, #0F4C75 0%, #1E6BA8 25%, #2E8BC0 50%, #16A5A5 75%, #0EA5E9 100%);
            --gradient-3d-primary: linear-gradient(135deg, #0F4C75 0%, #1E6BA8 50%, #2E8BC0 100%);
            --gradient-3d-luxury: linear-gradient(135deg, #3B82F6 0%, #06B6D4 50%, #10B981 100%);
            --gradient-3d-clean: linear-gradient(135deg, #F8FAFC 0%, #F1F5F9 50%, #FFFFFF 100%);
            --gradient-3d-success: linear-gradient(135deg, #10B981 0%, #34D399 100%);
            --gradient-3d-warning: linear-gradient(135deg, #F59E0B 0%, #FCD34D 100%);
            
            /* Professional 3D Shadows */
            --shadow-3d-sm: 0 2px 4px rgba(15, 76, 117, 0.1), 0 1px 2px rgba(15, 76, 117, 0.06);
            --shadow-3d-md: 0 4px 8px rgba(15, 76, 117, 0.15), 0 2px 4px rgba(15, 76, 117, 0.08);
            --shadow-3d-lg: 0 8px 16px rgba(15, 76, 117, 0.2), 0 4px 8px rgba(15, 76, 117, 0.1);
            --shadow-3d-xl: 0 20px 40px rgba(15, 76, 117, 0.25), 0 10px 20px rgba(15, 76, 117, 0.15);
            --shadow-3d-neon: 0 0 20px rgba(15, 76, 117, 0.3), 0 0 40px rgba(30, 107, 168, 0.2);
            
            /* 3D Border Colors */
            --border-3d-light: #E2E8F0;
            --border-3d-medium: #CBD5E1;
            --border-3d-dark: #94A3B8;
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
                radial-gradient(circle at 20% 50%, rgba(15, 76, 117, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(30, 107, 168, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 50% 20%, rgba(46, 139, 192, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 50% 80%, rgba(22, 165, 165, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 30% 70%, rgba(14, 165, 233, 0.06) 0%, transparent 50%);
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
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="medical-3d-pattern" width="40" height="40" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="3" fill="rgba(15,76,117,0.1)"/><path d="M10 20 Q20 10, 30 20 T50 20" stroke="rgba(30,107,168,0.15)" stroke-width="2" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23medical-3d-pattern)"/></svg>'),
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><defs><pattern id="medical-3d-grid" width="60" height="60" patternUnits="userSpaceOnUse"><rect x="15" y="15" width="30" height="30" fill="none" stroke="rgba(46,139,192,0.1)" stroke-width="2"/><circle cx="30" cy="30" r="8" fill="rgba(22,165,165,0.15)"/></pattern></defs><rect width="200" height="200" fill="url(%23medical-3d-grid)"/></svg>');
            background-size: 40px 40px, 120px 120px;
            animation: medical3DFloat 30s linear infinite;
            pointer-events: none;
            z-index: -1;
        }

        /* Hospital-Quality 3D Navigation */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: var(--medical-white);
            border-bottom: 2px solid var(--border-3d-light);
            z-index: 1000;
            padding: 0.75rem 0;
            box-shadow: var(--shadow-3d-md);
            transform-style: preserve-3d;
            transition: all 0.3s ease;
        }

        .navbar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--medical-primary), transparent);
            opacity: 0.3;
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: var(--shadow-3d-lg);
            border-bottom-color: var(--border-3d-medium);
            transform: translateY(0);
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
            gap: 0.75rem;
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--medical-primary);
            text-decoration: none;
            font-family: 'Inter', sans-serif;
            transform-style: preserve-3d;
            transition: all 0.3s ease;
        }

        .nav-logo img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border: 2px solid var(--medical-primary);
            border-radius: 50%;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-3d-sm);
            transform-style: preserve-3d;
        }

        .nav-logo:hover {
            transform: translateY(-2px) rotateX(2deg);
        }

        .nav-logo:hover img {
            transform: scale(1.05) rotateY(5deg);
            box-shadow: var(--shadow-3d-lg);
            border-color: var(--medical-accent);
        }

        .nav-links {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            transform-style: preserve-3d;
        }

        .nav-link {
            color: var(--medical-dark);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            position: relative;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            background: transparent;
            border: 1px solid transparent;
            font-family: 'Inter', sans-serif;
            transform-style: preserve-3d;
            transform: translateZ(0);
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--gradient-3d-primary);
            border-radius: 8px;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }

        .nav-link:hover {
            color: var(--medical-white);
            transform: translateY(-3px) translateZ(10px) rotateX(2deg);
            box-shadow: var(--shadow-3d-md);
            border-color: var(--medical-primary);
        }

        .nav-link:hover::before {
            opacity: 1;
        }

        /* Hospital-Quality 3D Hero Section */
        .hero-section {
            min-height: 60vh;
            display: flex;
            align-items: center;
            background: var(--gradient-3d-hero);
            position: relative;
            overflow: hidden;
            margin-top: 70px;
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(15, 76, 117, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(30, 107, 168, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 50% 20%, rgba(46, 139, 192, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 50% 80%, rgba(22, 165, 165, 0.2) 0%, transparent 50%);
            animation: hero3DAurora 15s ease-in-out infinite;
            pointer-events: none;
            z-index: 1;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="hero-3d-pattern" width="50" height="50" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="4" fill="rgba(15,76,117,0.2)"/><path d="M15 25 Q25 15, 35 25 T55 25" stroke="rgba(30,107,168,0.3)" stroke-width="2" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23hero-3d-pattern)"/></svg>'),
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><defs><pattern id="hero-3d-grid" width="80" height="80" patternUnits="userSpaceOnUse"><rect x="20" y="20" width="40" height="40" fill="none" stroke="rgba(46,139,192,0.2)" stroke-width="3"/><circle cx="40" cy="40" r="10" fill="rgba(22,165,165,0.25)"/></pattern></defs><rect width="200" height="200" fill="url(%23hero-3d-grid)"/></svg>');
            background-size: 50px 50px, 160px 160px;
            animation: hero3DFloat 25s linear infinite;
            pointer-events: none;
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            transform-style: preserve-3d;
        }

        .hero-text {
            animation: fadeInUp 1s ease-out;
            transform-style: preserve-3d;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--medical-light);
            padding: 0.4rem 0.8rem;
            border-radius: 12px;
            color: var(--medical-primary);
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            border: 1px solid var(--border-3d-light);
            font-family: 'Inter', sans-serif;
            transform-style: preserve-3d;
            transform: translateZ(10px);
            box-shadow: var(--shadow-3d-sm);
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1.2;
            color: var(--medical-white);
            margin-bottom: 1.5rem;
            font-family: 'Inter', sans-serif;
            transform-style: preserve-3d;
            transform: translateZ(20px);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero-subtitle {
            font-size: 1.1rem;
            color: var(--medical-white);
            margin-bottom: 1.5rem;
            line-height: 1.5;
            transform-style: preserve-3d;
            transform: translateZ(15px);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }

        .hero-buttons {
            display: flex;
            gap: 0.8rem;
            margin-top: 1.5rem;
            transform-style: preserve-3d;
            transform: translateZ(25px);
        }

        .hero-button {
            padding: 0.6rem 1.2rem;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
            transform-style: preserve-3d;
            transform: translateZ(0);
            position: relative;
            overflow: hidden;
        }

        .hero-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .hero-button.primary {
            background: var(--gradient-3d-primary);
            color: var(--medical-white);
            box-shadow: var(--shadow-3d-md);
        }

        .hero-button.secondary {
            background: var(--medical-white);
            color: var(--medical-primary);
            border: 1px solid var(--border-3d-light);
            box-shadow: var(--shadow-3d-sm);
        }

        .hero-button:hover {
            transform: translateY(-3px) translateZ(15px) rotateX(2deg);
            box-shadow: var(--shadow-3d-lg);
        }

        .hero-button:hover::before {
            opacity: 1;
        }

        .hero-button.primary:hover {
            border-color: var(--medical-accent);
        }

        .hero-button.secondary:hover {
            background: var(--gradient-3d-primary);
            color: var(--medical-white);
            border-color: var(--medical-primary);
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
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .hero-button {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
        }

        .hero-button.primary {
            background: var(--gradient-primary);
            color: white;
            box-shadow: var(--shadow-clean-md);
        }

        .hero-button.secondary {
            background: var(--school-white);
            color: var(--school-primary);
            border: 1px solid var(--border-light);
            box-shadow: var(--shadow-clean-sm);
        }

        .hero-button:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-clean-lg);
        }

        .btn {
            padding: 1.8rem 3.5rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            border: none;
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-family: 'Copperplate Gothic Bold', 'Rockwell Extra Bold', serif;
            transform-style: preserve-3d;
            perspective: 1000px;
            margin: 0 0.5rem;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.6), transparent);
            transition: left 0.8s ease;
        }

        .btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.7) 0%, transparent 70%);
            transform: translate(-50%, -50%);
            transition: all 0.6s ease;
            border-radius: 50%;
        }

        .btn-primary {
            background: var(--gradient-primary);
            color: var(--school-white);
            box-shadow: 
                0 15px 35px rgba(107, 68, 35, 0.4),
                0 8px 20px rgba(107, 68, 35, 0.3),
                inset 0 2px 0 rgba(255, 255, 255, 0.3),
                inset 0 -2px 0 rgba(0, 0, 0, 0.2);
            border: 3px solid rgba(255, 255, 255, 0.3);
            animation: luxuryBtnFloat 5s ease-in-out infinite;
            transform: translateZ(25px);
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="btn-pattern" width="25" height="25" patternUnits="userSpaceOnUse"><circle cx="12.5" cy="12.5" r="2" fill="rgba(255,255,255,0.2)"/><path d="M5 12.5 Q12.5 5, 20 12.5 T35 12.5" stroke="rgba(255,255,255,0.3)" stroke-width="1" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23btn-pattern)"/></svg>');
            opacity: 0.3;
            pointer-events: none;
        }

        .btn-primary:hover {
            transform: translateY(-12px) translateZ(35px) rotateX(-8deg) rotateY(8deg);
            box-shadow: 
                0 25px 50px rgba(107, 68, 35, 0.6),
                0 15px 30px rgba(107, 68, 35, 0.4),
                inset 0 2px 0 rgba(255, 255, 255, 0.4),
                inset 0 -2px 0 rgba(0, 0, 0, 0.3);
            background: linear-gradient(135deg, var(--secondary-coffee) 0%, var(--school-blue-dark) 25%, var(--school-green-dark) 50%, var(--school-gold-dark) 75%, var(--school-gold-light) 100%);
        }

        .btn-secondary {
            background: linear-gradient(135deg, rgba(245, 230, 211, 0.2), rgba(245, 230, 211, 0.3));
            color: var(--school-white);
            border: 3px solid rgba(245, 230, 211, 0.5);
            backdrop-filter: blur(25px);
            box-shadow: 
                0 15px 35px rgba(245, 230, 211, 0.3),
                0 8px 20px rgba(245, 230, 211, 0.2),
                inset 0 2px 0 rgba(255, 255, 255, 0.3),
                inset 0 -2px 0 rgba(0, 0, 0, 0.2);
            animation: luxuryBtnFloat 5s ease-in-out infinite 0.7s;
            transform: translateZ(25px);
            position: relative;
            overflow: hidden;
        }

        .btn-secondary::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="btn-secondary-pattern" width="30" height="30" patternUnits="userSpaceOnUse"><circle cx="15" cy="15" r="3" fill="rgba(107,68,35,0.2)"/><path d="M5 15 Q15 5, 25 15 T45 15" stroke="rgba(74,124,89,0.3)" stroke-width="1.5" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23btn-secondary-pattern)"/></svg>');
            opacity: 0.3;
            pointer-events: none;
        }

        .btn-secondary:hover {
            transform: translateY(-12px) translateZ(35px) rotateX(-8deg) rotateY(8deg);
            box-shadow: 
                0 25px 50px rgba(245, 230, 211, 0.5),
                0 15px 30px rgba(245, 230, 211, 0.3),
                inset 0 2px 0 rgba(255, 255, 255, 0.5),
                inset 0 -2px 0 rgba(0, 0, 0, 0.3);
            background: linear-gradient(135deg, rgba(245, 230, 211, 0.3), rgba(245, 230, 211, 0.4));
            border-color: rgba(245, 230, 211, 0.7);
        }

        .btn-portal {
            background: var(--gradient-luxury);
            color: var(--school-coffee-brown);
            box-shadow: 
                0 15px 35px rgba(212, 175, 55, 0.4),
                0 8px 20px rgba(212, 175, 55, 0.3),
                inset 0 2px 0 rgba(255, 255, 255, 0.4),
                inset 0 -2px 0 rgba(0, 0, 0, 0.2);
            border: 3px solid rgba(255, 255, 255, 0.3);
            animation: luxuryBtnFloat 5s ease-in-out infinite 1.4s;
            transform: translateZ(25px);
            position: relative;
            overflow: hidden;
        }

        .btn-portal::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="btn-portal-pattern" width="35" height="35" patternUnits="userSpaceOnUse"><rect x="10" y="10" width="15" height="15" fill="none" stroke="rgba(107,68,35,0.3)" stroke-width="2"/><circle cx="17.5" cy="17.5" r="4" fill="rgba(74,124,89,0.4)"/></pattern></defs><rect width="100" height="100" fill="url(%23btn-portal-pattern)"/></svg>');
            opacity: 0.3;
            pointer-events: none;
        }

        .btn-portal:hover {
            transform: translateY(-12px) translateZ(35px) rotateX(-8deg) rotateY(8deg);
            box-shadow: 
                0 25px 50px rgba(212, 175, 55, 0.6),
                0 15px 30px rgba(212, 175, 55, 0.4),
                inset 0 2px 0 rgba(255, 255, 255, 0.5),
                inset 0 -2px 0 rgba(0, 0, 0, 0.3);
            background: linear-gradient(135deg, var(--school-gold-light) 0%, var(--school-yellow-cream) 50%, var(--school-gold-dark) 100%);
            color: var(--school-white);
        }

        .btn-portal:hover::before {
            left: 100%;
        }

        .btn-portal:hover::after {
            width: 200%;
            height: 200%;
        }

        @keyframes luxuryBtnFloat {
            0%, 100% { 
                transform: translateY(0px) translateZ(20px) rotateX(0deg) rotateY(0deg); 
            }
            25% { 
                transform: translateY(-3px) translateZ(25px) rotateX(1deg) rotateY(1deg); 
            }
            50% { 
                transform: translateY(-6px) translateZ(30px) rotateX(0deg) rotateY(0deg); 
            }
            75% { 
                transform: translateY(-3px) translateZ(25px) rotateX(-1deg) rotateY(-1deg); 
            }
        }

        /* Showcase Section */
        .showcase-section {
            padding: 6rem 2rem;
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
        }

        .showcase-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .showcase-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .showcase-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .showcase-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-xl);
        }

        .showcase-card:hover::before {
            transform: scaleX(1);
        }

        .showcase-icon {
            width: 70px;
            height: 70px;
            background: var(--gradient-primary);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: white;
            margin-bottom: 1.5rem;
            box-shadow: 0 0 20px rgba(0, 102, 255, 0.3);
        }

        .showcase-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .showcase-description {
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .showcase-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .showcase-link:hover {
            color: var(--accent-blue);
            transform: translateX(5px);
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
            color: var(--neon-cyan);
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
            color: var(--neon-cyan);
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
            color: var(--neon-cyan);
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

        /* Modern Mind-Blowing Animations */
        @keyframes modernAurora {
            0%, 100% {
                transform: translateX(0) translateY(0) rotate(0deg);
                opacity: 0.4;
            }
            25% {
                transform: translateX(80px) translateY(-50px) rotate(90deg);
                opacity: 0.6;
            }
            50% {
                transform: translateX(-60px) translateY(80px) rotate(180deg);
                opacity: 0.8;
            }
            75% {
                transform: translateX(50px) translateY(-40px) rotate(270deg);
                opacity: 0.5;
            }
        }

        @keyframes modernParticleFloat {
            0%, 100% {
                transform: translateY(0) translateX(0) rotate(0deg);
                opacity: 0.7;
            }
            25% {
                transform: translateY(-50px) translateX(40px) rotate(90deg);
                opacity: 0.9;
            }
            50% {
                transform: translateY(-80px) translateX(-40px) rotate(180deg);
                opacity: 1;
            }
            75% {
                transform: translateY(-40px) translateX(50px) rotate(270deg);
                opacity: 0.8;
            }
        }

        @keyframes modernAuroraWave {
            0%, 100% {
                transform: translateX(0) translateY(0) scale(1);
                opacity: 0.3;
            }
            25% {
                transform: translateX(150px) translateY(-80px) scale(1.4);
                opacity: 0.5;
            }
            50% {
                transform: translateX(-150px) translateY(80px) scale(0.6);
                opacity: 0.7;
            }
            75% {
                transform: translateX(80px) translateY(-50px) scale(1.3);
                opacity: 0.4;
            }
        }

        @keyframes modernGridMove {
            0% {
                transform: translate(0, 0);
            }
            100% {
                transform: translate(150px, 150px);
            }
        }

        @keyframes modernPatternFloat {
            0% {
                transform: translate(0, 0);
            }
            100% {
                transform: translate(100px, 100px);
            }
        }

        @keyframes navbarShine {
            0%, 100% {
                transform: translateX(-100%);
            }
            50% {
                transform: translateX(100%);
            }
        }

        @keyframes logoGlow {
            0%, 100% {
                text-shadow: 0 0 30px rgba(139, 92, 246, 0.8);
                transform: scale(1);
            }
            50% {
                text-shadow: 0 0 50px rgba(139, 92, 246, 1), 0 0 70px rgba(59, 130, 246, 0.8);
                transform: scale(1.05);
            }
        }

        @keyframes logoRotate {
            0% {
                transform: rotateY(0deg);
            }
            100% {
                transform: rotateY(360deg);
            }
        }

        @keyframes modernBadgePulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 0 40px rgba(139, 92, 246, 0.6);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 0 60px rgba(139, 92, 246, 0.8);
            }
        }

        @keyframes modernBadgeShine {
            0%, 100% {
                transform: translateX(-100%);
            }
            50% {
                transform: translateX(100%);
            }
        }

        @keyframes modernTitleGlow {
            0%, 100% {
                filter: brightness(1) hue-rotate(0deg);
                transform: translateY(0);
            }
            25% {
                filter: brightness(1.2) hue-rotate(90deg);
                transform: translateY(-5px);
            }
            50% {
                filter: brightness(1.4) hue-rotate(180deg);
                transform: translateY(-10px);
            }
            75% {
                filter: brightness(1.2) hue-rotate(270deg);
                transform: translateY(-5px);
            }
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .navbar {
                padding: 0.5rem 0;
            }

            .nav-container {
                padding: 0 1rem;
            }

            .nav-logo {
                font-size: 1rem;
            }

            .nav-logo img {
                width: 40px;
                height: 40px;
            }

            .nav-links {
                gap: 0.25rem;
            }

            .nav-link {
                padding: 0.4rem 0.8rem;
                font-size: 0.8rem;
            }

            .hero-section {
                min-height: 50vh;
                margin-top: 60px;
            }

            .hero-content {
                padding: 1rem;
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .hero-badge {
                font-size: 0.8rem;
                padding: 0.4rem 0.8rem;
                margin-bottom: 1rem;
            }

            .hero-title {
                font-size: 1.8rem;
                margin-bottom: 1rem;
            }

            .hero-subtitle {
                font-size: 0.95rem;
                margin-bottom: 1rem;
            }

            .hero-buttons {
                gap: 0.5rem;
                margin-top: 1rem;
            }

            .hero-button {
                padding: 0.6rem 1rem;
                font-size: 0.85rem;
            }
        }

        @media (max-width: 480px) {
            .nav-links {
                display: none;
            }

            .hero-title {
                font-size: 1.5rem;
            }

            .hero-subtitle {
                font-size: 0.9rem;
            }

            .hero-button {
                padding: 0.5rem 0.8rem;
                font-size: 0.8rem;
            }

            .hero-buttons {
                flex-direction: column;
                gap: 0.5rem;
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

        @keyframes hero3DAurora {
            0%, 100% {
                transform: rotate(0deg) scale(1) translateZ(0);
                opacity: 0.9;
            }
            33% {
                transform: rotate(120deg) scale(1.05) translateZ(10px);
                opacity: 0.7;
            }
            66% {
                transform: rotate(240deg) scale(1.1) translateZ(20px);
                opacity: 0.5;
            }
        }

        @keyframes hero3DFloat {
            0% {
                transform: translateX(0) translateY(0) translateZ(0) rotate(0deg);
            }
            25% {
                transform: translateX(15px) translateY(-8px) translateZ(5px) rotate(1deg);
            }
            50% {
                transform: translateX(30px) translateY(0) translateZ(10px) rotate(2deg);
            }
            75% {
                transform: translateX(15px) translateY(8px) translateZ(5px) rotate(1deg);
            }
            100% {
                transform: translateX(0) translateY(0) translateZ(0) rotate(0deg);
            }
        }

        /* Perfect Mobile Responsive Design */
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

            .hero-badge {
                font-size: 0.9rem;
                padding: 0.8rem 1.5rem;
            }

            .hero-stats {
                gap: 2rem;
            }

            .hero-card {
                padding: 2rem;
            }

            .showcase-grid,
            .features-grid,
            .programs-grid {
                grid-template-columns: 1fr;
            }

            .section-title {
                font-size: 2rem;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .footer-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                padding: 1.5rem 2.5rem;
                font-size: 1rem;
            }
        }

        @media (max-width: 1024px) {
            .nav-links {
                flex-wrap: wrap;
                gap: 1rem;
            }
            
            .nav-link {
                font-size: 0.9rem;
                padding: 0.6rem 1rem;
            }

            .hero-content {
                gap: 3rem;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
            }

            .btn {
                padding: 1.2rem 2rem;
                font-size: 0.9rem;
            }

            .hero-stats {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <a href="#" class="nav-logo">
                <img src="public/isnm-logo.jpeg" alt="ISNM" style="width: 80px; height: 80px;">
            </a>
            <div class="nav-links">
                <a href="#home" class="nav-link">Home</a>
                <a href="about.php" class="nav-link">About</a>
                <a href="governance.php" class="nav-link">Governance</a>
                <a href="programs.php" class="nav-link">Programs</a>
                <a href="admissions.php" class="nav-link">Admissions</a>
                <a href="activities.php" class="nav-link">Activities</a>
                <a href="infrastructure.php" class="nav-link">Infrastructure</a>
                <a href="achievements.php" class="nav-link">Achievements</a>
                <a href="history.php" class="nav-link">History</a>
                <a href="contact.php" class="nav-link">Contact</a>
                <a href="login-portal.php" class="nav-link">Portal</a>
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
                <h1 class="hero-title">Welcome to</h1>
                <h2 class="hero-subtitle" style="font-family: 'Copperplate Gothic Bold', 'Rockwell Extra Bold', serif; font-size: 2.5rem; font-weight: 900; color: white; margin-bottom: 1rem; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);">
                    IGANGA SCHOOL OF NURSING AND MIDWIFERY
                </h2>
                <h3 class="hero-title" style="font-size: 3rem; margin-top: 1rem;">Chosen to Serve</h3>
                <p class="hero-subtitle" style="margin-top: 2rem;">
                    Join us for world-class education, hands-on training, and a rewarding career in healthcare.
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
                    <a href="programs.php" class="btn btn-primary">
                        <i class="fas fa-graduation-cap"></i>
                        Explore Programs
                    </a>
                    <a href="login-portal.php" class="btn btn-portal">
                        <i class="fas fa-sign-in-alt"></i>
                        Go to Portal
                    </a>
                    <a href="about.php" class="btn btn-secondary">
                        <i class="fas fa-info-circle"></i>
                        Learn More
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
                        <a href="programs.php" class="btn btn-primary">
                            <i class="fas fa-arrow-right"></i>
                            Get Started
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- School Showcase Section -->
    <section class="showcase-section">
        <div class="section-container">
            <div class="section-header">
                <div class="section-badge">
                    <i class="fas fa-star"></i>
                    <span>Discover ISNM</span>
                </div>
                <h2 class="section-title">Why Choose Iganga School of Nursing & Midwifery</h2>
                <p class="section-subtitle">
                    Experience excellence in healthcare education with our comprehensive programs, 
                    modern facilities, and commitment to student success.
                </p>
            </div>
            <div class="showcase-grid">
                <div class="showcase-card">
                    <div class="showcase-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3 class="showcase-title">Academic Excellence</h3>
                    <p class="showcase-description">
                        World-class education with 100% pass rate in midwifery and 85% in nursing programs
                    </p>
                    <a href="programs.php" class="showcase-link">
                        <i class="fas fa-arrow-right"></i>
                        Explore Programs
                    </a>
                </div>
                
                <div class="showcase-card">
                    <div class="showcase-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <h3 class="showcase-title">Modern Infrastructure</h3>
                    <p class="showcase-description">
                        State-of-the-art facilities including computer labs, skills laboratories, and multi-purpose hall
                    </p>
                    <a href="infrastructure.php" class="showcase-link">
                        <i class="fas fa-arrow-right"></i>
                        View Facilities
                    </a>
                </div>
                
                <div class="showcase-card">
                    <div class="showcase-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h3 class="showcase-title">Proven Excellence</h3>
                    <p class="showcase-description">
                        15+ years of excellence with over 5000 graduates and 95% employment rate
                    </p>
                    <a href="achievements.php" class="showcase-link">
                        <i class="fas fa-arrow-right"></i>
                        Our Achievements
                    </a>
                </div>
                
                <div class="showcase-card">
                    <div class="showcase-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="showcase-title">Strong Governance</h3>
                    <p class="showcase-description">
                        Led by experienced Board of Directors and Governors with a vision for excellence
                    </p>
                    <a href="governance.php" class="showcase-link">
                        <i class="fas fa-arrow-right"></i>
                        Meet Our Leaders
                    </a>
                </div>
                
                <div class="showcase-card">
                    <div class="showcase-icon">
                        <i class="fas fa-running"></i>
                    </div>
                    <h3 class="showcase-title">Vibrant Campus Life</h3>
                    <p class="showcase-description">
                        Rich co-curricular activities, sports, and community service opportunities
                    </p>
                    <a href="activities.php" class="showcase-link">
                        <i class="fas fa-arrow-right"></i>
                        Campus Activities
                    </a>
                </div>
                
                <div class="showcase-card">
                    <div class="showcase-icon">
                        <i class="fas fa-history"></i>
                    </div>
                    <h3 class="showcase-title">Rich Heritage</h3>
                    <p class="showcase-description">
                        Founded in 2009 with a legacy of producing world-class healthcare professionals
                    </p>
                    <a href="history.php" class="showcase-link">
                        <i class="fas fa-arrow-right"></i>
                        Our History
                    </a>
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
                        <p><i class="fas fa-phone"></i> +256 XXX XXX XXX</p>
                        <p><i class="fas fa-envelope"></i> info@isnm.ac.ug</p>
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
                    <p>&copy; 2024 Iganga School of Nursing and Midwifery. All rights reserved.</p>
                </div>
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
