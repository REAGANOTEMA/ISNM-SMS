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
    <title>Iganga School of Nursing and Midwifery - Organizational Structure</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&family=Rockwell:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-blue: #2563eb;
            --secondary-blue: #3b82f6;
            --accent-blue: #60a5fa;
            --sky-blue: #0ea5e9;
            --ocean-blue: #0284c7;
            --light-green: #86efac;
            --soft-green: #4ade80;
            --mint-green: #10b981;
            --lime-green: #84cc16;
            --creamy-yellow: #fef3c7;
            --golden-yellow: #fbbf24;
            --warm-yellow: #f59e0b;
            --soft-yellow: #fde68a;
            --white: #ffffff;
            --cream-white: #fefaf3;
            --light-gray: #f8fafc;
            --soft-gray: #f1f5f9;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --text-muted: #94a3b8;
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 8px 16px rgba(0, 0, 0, 0.15);
            --shadow-lg: 0 16px 32px rgba(0, 0, 0, 0.2);
            --shadow-xl: 0 24px 48px rgba(0, 0, 0, 0.25);
            --shadow-2xl: 0 32px 64px rgba(0, 0, 0, 0.3);
            --shadow-3d: 0 12px 24px rgba(0, 0, 0, 0.3), 0 8px 16px rgba(0, 0, 0, 0.2);
            --shadow-gold: 0 8px 16px rgba(251, 191, 36, 0.4);
            --shadow-blue: 0 8px 16px rgba(37, 99, 235, 0.4);
            --shadow-green: 0 8px 16px rgba(74, 222, 128, 0.4);
            --shadow-yellow: 0 8px 16px rgba(251, 191, 36, 0.3);
            --shadow-inset: inset 0 2px 4px rgba(0, 0, 0, 0.1);
            --shadow-inset-light: inset 0 1px 2px rgba(255, 255, 255, 0.8);
            --gradient-primary: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue), var(--accent-blue));
            --gradient-secondary: linear-gradient(135deg, var(--light-green), var(--soft-green), var(--mint-green));
            --gradient-tertiary: linear-gradient(135deg, var(--creamy-yellow), var(--golden-yellow), var(--warm-yellow));
            --gradient-hero: linear-gradient(135deg, var(--ocean-blue), var(--light-green), var(--creamy-yellow));
        }

        body {
            font-family: 'Inter', 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--light-green) 50%, var(--creamy-yellow) 100%);
            min-height: 100vh;
            color: var(--text-dark);
            line-height: 1.6;
            position: relative;
            perspective: 1000px;
            transform-style: preserve-3d;
            font-weight: 400;
            letter-spacing: -0.01em;
        }

        .organogram-header {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: white;
            padding: 3rem 2rem;
            text-align: center;
            position: relative;
            box-shadow: var(--shadow-xl);
            border-bottom: 4px solid var(--golden-yellow);
            overflow: hidden;
        }

        .organogram-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><defs><pattern id="header-pattern" width="40" height="40" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="3" fill="white" opacity="0.1"/><path d="M10 20 Q20 10, 30 20 T50 20" stroke="white" stroke-width="1" fill="none" opacity="0.15"/></pattern></defs><rect width="200" height="200" fill="url(%23header-pattern)"/></svg>'),
                linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 50%, rgba(251,191,36,0.1) 100%);
            background-size: 80px 80px, cover;
            background-position: 0 0, center;
            animation: headerPatternFloat 10s ease-in-out infinite;
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 3rem;
            position: relative;
            z-index: 1;
        }

        .logo-section {
            flex-shrink: 0;
        }

        .organogram-logo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid var(--golden-yellow);
            box-shadow: var(--shadow-xl), 0 0 20px rgba(251,191,36,0.4);
            animation: logoFloat 3s ease-in-out infinite;
        }

        .title-section {
            text-align: left;
        }

        .organogram-title {
            font-family: 'Copperplate Gothic Bold', 'Rockwell Extra Bold', serif;
            font-size: 2rem;
            font-weight: 900;
            margin: 0;
            background: linear-gradient(135deg, var(--white) 0%, var(--creamy-yellow) 50%, var(--golden-yellow) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }

        .organogram-subtitle {
            font-family: 'Bernard MT Condensed', 'Arial Narrow', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0.5rem 0 0 0;
            opacity: 0.9;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .organogram-container {
            background: linear-gradient(135deg, var(--cream-white), var(--white));
            min-height: 100vh;
            padding: 3rem 2rem;
            position: relative;
            overflow-x: auto;
        }

        .organogram-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 400"><defs><pattern id="container-pattern" width="60" height="60" patternUnits="userSpaceOnUse"><circle cx="30" cy="30" r="2" fill="var(--primary-blue)" opacity="0.05"/><path d="M15 30 Q30 15, 45 30 T75 30" stroke="var(--light-green)" stroke-width="1" fill="none" opacity="0.08"/></pattern></defs><rect width="400" height="400" fill="url(%23container-pattern)"/></svg>'),
                linear-gradient(135deg, rgba(255,255,255,0.8) 0%, transparent 50%, rgba(251,191,36,0.05) 100%);
            background-size: 120px 120px, cover;
            background-position: 0 0, center;
            pointer-events: none;
            animation: containerPatternFloat 15s ease-in-out infinite;
        }

        .organogram-wrapper {
            max-width: 1600px;
            margin: 0 auto;
            position: relative;
            min-width: 1400px;
        }

        .organogram-chart {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2rem;
            position: relative;
            padding: 2rem 0;
        }

        .org-level {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2.5rem;
            width: 100%;
            position: relative;
            margin: 2rem 0;
            padding: 1rem 0;
        }

        .org-level-1 { 
            justify-content: center; 
            gap: 2.5rem; 
            position: relative;
        }
        
        .org-level-2 { 
            justify-content: center; 
            margin-top: 3rem;
        }
        
        .org-level-3 { 
            justify-content: center; 
            margin-top: 3rem;
        }
        
        .org-level-4 { 
            justify-content: center; 
            gap: 2rem; 
            margin-top: 3rem;
        }
        
        .org-level-5 { 
            justify-content: center; 
            gap: 1.8rem; 
            flex-wrap: wrap; 
            margin-top: 3rem;
            max-width: 1400px;
        }
        
        .org-level-6 { 
            justify-content: center; 
            gap: 1.8rem; 
            flex-wrap: wrap; 
            margin-top: 3rem;
            max-width: 1400px;
        }
        
        .org-level-7 { 
            justify-content: center; 
            gap: 1.5rem; 
            flex-wrap: wrap; 
            margin-top: 3rem;
            max-width: 1400px;
        }
        
        .org-level-8 { 
            justify-content: center; 
            gap: 1.5rem; 
            flex-wrap: wrap; 
            margin-top: 3rem;
            max-width: 1200px;
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
            background: linear-gradient(145deg, var(--white), var(--cream-white));
            border: 2px solid var(--primary-blue);
            border-radius: 16px;
            padding: 2rem 1.5rem;
            min-width: 220px;
            max-width: 300px;
            box-shadow: var(--shadow-lg);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
            text-align: center;
            transform-style: preserve-3d;
            transform: translateZ(0);
            overflow: hidden;
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
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }

        .org-box::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="box-pattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1.5" fill="var(--golden-yellow)" opacity="0.15"/><path d="M5 10 Q10 5, 15 10 T25 10" stroke="var(--light-green)" stroke-width="0.5" fill="none" opacity="0.2"/></pattern></defs><rect width="100" height="100" fill="url(%23box-pattern)"/></svg>'),
                linear-gradient(135deg, transparent 40%, rgba(255,255,255,0.3) 50%, transparent 60%);
            background-size: 40px 40px, cover;
            background-position: 0 0, center;
            transform: translateX(-100%);
            transition: transform 0.8s ease;
            pointer-events: none;
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
            transform: translateY(-8px) scale(1.08) rotateX(2deg) translateZ(20px);
            box-shadow: var(--shadow-2xl), 0 0 40px rgba(251,191,36,0.3);
            border-color: var(--golden-yellow);
            background: linear-gradient(145deg, var(--light-green), var(--creamy-yellow));
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
            margin: 0 auto 1.5rem;
            color: var(--primary-blue);
            background: linear-gradient(145deg, var(--creamy-yellow), var(--golden-yellow));
            box-shadow: var(--shadow-gold), var(--shadow-inset);
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
            transform: scale(1.15) rotateY(10deg) rotateX(5deg) translateZ(10px);
            box-shadow: var(--shadow-xl), 0 0 25px rgba(251, 191, 36, 0.4);
        }

        .org-box:hover .org-icon::before {
            left: 100%;
        }

        .org-box:hover .org-icon::after {
            width: 100%;
            height: 100%;
        }

        .org-box.root .org-icon {
            background: linear-gradient(145deg, var(--golden-yellow), var(--warm-yellow));
            color: var(--primary-blue);
            animation: glowPulse 2s ease-in-out infinite;
            box-shadow: var(--shadow-xl), 0 0 20px rgba(251,191,36,0.4);
            transform: scale(1.1) translateZ(5px);
        }

        .org-title {
            font-family: 'Copperplate Gothic Bold', 'Rockwell Extra Bold', serif;
            font-size: 1.3rem;
            font-weight: 900;
            color: var(--primary-blue);
            margin-bottom: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
            position: relative;
        }

        .org-description {
            font-size: 0.9rem;
            color: var(--text-light);
            margin-bottom: 1.2rem;
            font-weight: 500;
            line-height: 1.4;
        }

        .org-roles {
            text-align: left;
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .org-role-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.4rem 0;
            border-bottom: 1px solid rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .org-role-item:hover {
            color: var(--primary-blue);
            transform: translateX(3px);
        }

        .org-role-item:last-child {
            border-bottom: none;
        }

        .org-role-icon {
            font-size: 1rem;
            color: var(--light-green);
            transition: all 0.3s ease;
        }

        .org-role-item:hover .org-role-icon {
            color: var(--golden-yellow);
            transform: scale(1.2);
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
            width: 3px;
            background: linear-gradient(180deg, var(--primary-blue), var(--light-green));
            left: 50%;
            transform: translateX(-50%);
            box-shadow: 0 0 10px rgba(37,99,235,0.4);
            border-radius: 2px;
        }

        .horizontal-line {
            position: absolute;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-blue), var(--light-green), var(--primary-blue));
            box-shadow: 0 0 10px rgba(37,99,235,0.4);
            border-radius: 2px;
        }

        .communication-flow {
            position: absolute;
            bottom: -2.5rem;
            left: 50%;
            transform: translateX(-50%);
            background: var(--gradient-primary);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.8rem;
            font-weight: 700;
            white-space: nowrap;
            box-shadow: var(--shadow-md);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border: 1px solid rgba(255,255,255,0.2);
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
            padding: 2rem;
            background: linear-gradient(145deg, var(--cream-white), var(--white));
            border-radius: 20px;
            box-shadow: var(--shadow-xl);
            position: relative;
            overflow: hidden;
            border: 2px solid var(--soft-gray);
        }

        .org-legend::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--golden-yellow), var(--primary-blue), var(--light-green));
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

        .legend-item {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            font-size: 1rem;
            font-weight: 700;
            padding: 0.5rem 1rem;
            background: linear-gradient(145deg, var(--white), var(--cream-white));
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .legend-item:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        .legend-color {
            width: 24px;
            height: 24px;
            border-radius: 8px;
            border: 2px solid;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
        }

        .legend-item:hover .legend-color {
            transform: scale(1.2);
            box-shadow: var(--shadow-gold);
        }

        .legend-color.root { 
            border-color: var(--golden-yellow); 
            background: linear-gradient(145deg, var(--creamy-yellow), var(--golden-yellow));
        }
        
        .legend-color.executive { 
            border-color: var(--primary-blue); 
            background: linear-gradient(145deg, var(--light-gray), var(--primary-blue));
        }
        
        .legend-color.management { 
            border-color: var(--light-green); 
            background: linear-gradient(145deg, var(--soft-gray), var(--light-green));
        }
        
        .legend-color.operational { 
            border-color: var(--text-muted); 
            background: linear-gradient(145deg, var(--light-gray), var(--text-muted));
        }

        .medical-tools-showcase {
            background: var(--cream-white);
            border-radius: 20px;
            padding: 2rem;
            margin: 2rem 0;
            box-shadow: var(--shadow-3d);
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            transform: rotateX(2deg);
            border: 2px solid var(--light-green);
            transition: all 0.4s ease;
        }

        .medical-tools-showcase:hover {
            transform: rotateX(0deg) translateY(-10px);
            box-shadow: 0 32px 64px rgba(0, 0, 0, 0.3), 0 16px 32px rgba(0, 0, 0, 0.2);
        }

        .medical-tools-showcase::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--primary-blue), var(--light-green), var(--golden-yellow));
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .medical-tools-showcase::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><defs><pattern id="real-stethoscope" width="50" height="50" patternUnits="userSpaceOnUse"><path d="M10 25 Q25 10, 40 25 T70 25" stroke="var(--primary-blue)" stroke-width="2" fill="none" opacity="0.3"/><circle cx="10" cy="25" r="4" fill="var(--primary-blue)" opacity="0.4"/><circle cx="70" cy="25" r="4" fill="var(--primary-blue)" opacity="0.4"/></pattern></defs><rect width="200" height="200" fill="url(%23real-stethoscope)"/></svg>'),
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 150 150"><defs><pattern id="real-syringe" width="30" height="30" patternUnits="userSpaceOnUse"><rect x="5" y="10" width="20" height="4" fill="var(--secondary-blue)" opacity="0.3"/><rect x="22" y="9" width="6" height="6" fill="var(--secondary-blue)" opacity="0.4"/><rect x="4" y="9" width="6" height="6" fill="var(--secondary-blue)" opacity="0.4"/><path d="M26 12 L28 14" stroke="var(--secondary-blue)" stroke-width="1" opacity="0.5"/></pattern></defs><rect width="150" height="150" fill="url(%23real-syringe)"/></svg>'),
                linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 50%, rgba(251,191,36,0.1) 100%);
            background-size: 100px 100px, 75px 75px, cover;
            background-position: 0 0, 25px 25px, center;
            pointer-events: none;
            animation: medicalToolsFloat 6s ease-in-out infinite;
        }

        .tools-title {
            text-align: center;
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 2rem;
        }

        .tools-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .tool-item {
            text-align: center;
            padding: 2rem;
            background: linear-gradient(145deg, var(--white), var(--cream-white));
            border-radius: 20px;
            box-shadow: var(--shadow-md), var(--shadow-inset);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            transform: translateZ(0);
            border: 2px solid transparent;
        }

        .tool-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="tool-pattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="2" fill="var(--golden-yellow)" opacity="0.3"/><path d="M5 5 L15 15 M15 5 L5 15" stroke="var(--light-green)" stroke-width="1" opacity="0.4"/></pattern></defs><rect width="100" height="100" fill="url(%23tool-pattern)"/></svg>'),
                linear-gradient(135deg, transparent 30%, rgba(255,255,255,0.3) 50%, transparent 70%);
            background-size: 40px 40px, cover;
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }

        .tool-item:hover {
            transform: translateY(-15px) scale(1.08) rotateX(5deg);
            box-shadow: var(--shadow-xl), 0 0 20px rgba(251, 191, 36, 0.3);
            background: linear-gradient(145deg, var(--light-green), var(--creamy-yellow));
            border-color: var(--golden-yellow);
        }

        .tool-item:hover::before {
            transform: translateX(100%);
        }

        .tool-item:active {
            transform: translateY(-5px) scale(1.05) rotateX(2deg);
            transition: all 0.1s ease;
        }

        .tool-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: pulse 2s ease-in-out infinite;
            position: relative;
        }

        .tool-icon::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 120%;
            height: 120%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><radialGradient id="toolGlow"><stop offset="0%" stop-color="var(--golden-yellow)" stop-opacity="0.4"/><stop offset="100%" stop-color="var(--golden-yellow)" stop-opacity="0"/></radialGradient></defs><circle cx="50" cy="50" r="40" fill="url(%23toolGlow)"/></svg>');
            background-size: contain;
            transform: translate(-50%, -50%);
            animation: toolIconGlow 3s ease-in-out infinite;
            pointer-events: none;
        }

        .tool-name {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 0.9rem;
        }

        .tool-item:hover .tool-icon {
            animation: rotate 1s ease-in-out;
        }

        .injection-animation {
            position: relative;
            width: 60px;
            height: 60px;
            margin: 0 auto 1rem;
        }

        .syringe {
            width: 100%;
            height: 100%;
            position: relative;
            animation: inject 3s ease-in-out infinite;
        }

        .heartbeat-monitor {
            width: 100%;
            height: 60px;
            margin: 0 auto 1rem;
            position: relative;
            overflow: hidden;
        }

        .heartbeat-line {
            position: absolute;
            width: 200%;
            height: 2px;
            background: var(--primary-blue);
            top: 50%;
            left: -100%;
            animation: heartbeat 2s linear infinite;
        }

        .structure-grid {
            display: grid;
            gap: 1.5rem;
            margin-top: 2rem;
            position: relative;
        }
        
        .hierarchy-line {
            position: absolute;
            left: 50%;
            width: 2px;
            background: linear-gradient(180deg, var(--primary-blue), var(--light-green));
            transform: translateX(-50%);
            z-index: -1;
            box-shadow: 0 0 10px rgba(37, 99, 235, 0.3);
        }
        
        .level-indicator {
            position: absolute;
            left: -60px;
            top: 50%;
            transform: translateY(-50%);
            background: var(--gradient-primary);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            box-shadow: var(--shadow-md);
            animation: pulse 2s ease-in-out infinite;
            z-index: 10;
        }
        
        .root-level {
            border: 3px solid var(--golden-yellow);
            background: linear-gradient(145deg, var(--white), var(--creamy-yellow));
            transform: scale(1.05);
            box-shadow: var(--shadow-xl), 0 0 30px rgba(251, 191, 36, 0.4);
        }
        
        .root-level .section-icon {
            background: linear-gradient(145deg, var(--golden-yellow), var(--warm-yellow));
            color: var(--primary-blue);
            animation: glowPulse 2s ease-in-out infinite;
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
        
        .operational-level {
            border: 1px solid var(--text-muted);
            background: linear-gradient(145deg, var(--white), var(--light-gray));
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

        .structure-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--primary-blue), var(--light-green), var(--golden-yellow));
            transform: scaleX(0);
            transition: transform 0.4s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .structure-section::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 150 150"><defs><pattern id="section-medical" width="30" height="30" patternUnits="userSpaceOnUse"><path d="M5 15 Q15 5, 25 15 T45 15" stroke="var(--primary-blue)" stroke-width="1.5" fill="none" opacity="0.2"/><circle cx="5" cy="15" r="3" fill="var(--light-green)" opacity="0.3"/><circle cx="45" cy="15" r="3" fill="var(--light-green)" opacity="0.3"/></pattern></defs><rect width="150" height="150" fill="url(%23section-medical)"/></svg>'),
                linear-gradient(135deg, transparent 40%, rgba(255,255,255,0.2) 50%, transparent 60%);
            background-size: 60px 60px, cover;
            background-position: 0 0, center;
            transform: translateX(-100%);
            transition: transform 0.8s ease;
            pointer-events: none;
        }

        .structure-section:hover {
            transform: translateY(-12px) scale(1.03) rotateX(3deg);
            box-shadow: var(--shadow-xl), 0 0 30px rgba(37, 99, 235, 0.2);
            border-color: var(--light-green);
            background: linear-gradient(145deg, var(--white), var(--creamy-yellow));
        }

        .structure-section:hover::before {
            transform: scaleX(1);
        }

        .structure-section:hover::after {
            transform: translateX(100%);
        }

        .structure-section:active {
            transform: translateY(-6px) scale(1.01) rotateX(1deg);
            transition: all 0.1s ease;
        }

        .section-header {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            gap: 1rem;
        }

        .section-icon {
            width: 70px;
            height: 70px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: var(--primary-blue);
            background: linear-gradient(145deg, var(--creamy-yellow), var(--golden-yellow));
            box-shadow: var(--shadow-gold), var(--shadow-inset);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            transform: translateZ(0);
        }

        .section-icon::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.6), transparent);
            transition: left 0.6s ease;
        }

        .section-icon::after {
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

        .structure-section:hover .section-icon {
            transform: scale(1.15) rotateY(10deg) rotateX(5deg);
            box-shadow: var(--shadow-xl), 0 0 25px rgba(251, 191, 36, 0.4);
        }

        .structure-section:hover .section-icon::before {
            left: 100%;
        }

        .structure-section:hover .section-icon::after {
            width: 100%;
            height: 100%;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
        }

        .section-description {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .role-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 0.75rem;
            margin-top: 0.75rem;
        }

        .role-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            background: linear-gradient(145deg, var(--white), var(--cream-white));
            border-radius: 10px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            transform: translateZ(0);
            box-shadow: var(--shadow-sm), var(--shadow-inset);
        }

        .role-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, var(--light-green), transparent);
            transition: left 0.6s ease;
            opacity: 0.4;
        }

        .role-item::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="role-medical" width="20" height="20" patternUnits="userSpaceOnUse"><rect x="8" y="8" width="4" height="4" fill="var(--golden-yellow)" opacity="0.2"/><circle cx="10" cy="10" r="6" stroke="var(--light-green)" stroke-width="1" fill="none" opacity="0.3"/></pattern></defs><rect width="100" height="100" fill="url(%23role-medical)"/></svg>'),
                linear-gradient(135deg, transparent 40%, rgba(255,255,255,0.3) 50%, transparent 60%);
            background-size: 40px 40px, cover;
            background-position: 0 0, center;
            transform: translateX(-100%);
            transition: transform 0.8s ease;
            pointer-events: none;
        }

        .role-item:hover {
            background: linear-gradient(145deg, var(--light-green), var(--creamy-yellow));
            color: var(--primary-blue);
            transform: translateX(12px) scale(1.08) rotateY(5deg);
            box-shadow: var(--shadow-gold), 0 0 20px rgba(74, 222, 128, 0.3);
            border-color: var(--golden-yellow);
        }

        .role-item:hover::before {
            left: 100%;
        }

        .role-item:hover::after {
            transform: translateX(100%);
        }

        .role-item:active {
            transform: translateX(6px) scale(1.04) rotateY(2deg);
            transition: all 0.1s ease;
        }

        .role-icon {
            font-size: 1.1rem;
            opacity: 0.8;
        }

        .role-name {
            font-weight: 500;
            font-size: 0.95rem;
        }

        .arrow-indicator {
            text-align: center;
            margin: 0.5rem 0;
            font-size: 1.5rem;
            color: var(--primary-blue);
            animation: bounce 2s infinite;
        }

        .system-entry-concept {
            background: linear-gradient(135deg, var(--primary-blue), var(--light-green), var(--creamy-yellow));
            color: var(--white);
            border-radius: 24px;
            padding: 3rem 2rem;
            margin-top: 3rem;
            text-align: center;
            box-shadow: var(--shadow-2xl);
            animation: fadeIn 1s ease-out 0.5s both;
            position: relative;
            overflow: hidden;
            border: 2px solid rgba(255,255,255,0.2);
        }

        .system-entry-concept::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><defs><pattern id="hearts" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M20 12 C20 8, 16 4, 12 4 C8 4, 4 8, 4 12 C4 16, 8 20, 20 32 C32 20, 36 16, 36 12 C36 8, 32 4, 28 4 C24 4, 20 8, 20 12 Z" fill="white" opacity="0.15"/></pattern></defs><rect width="200" height="200" fill="url(%23hearts)"/></svg>'),
                linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 50%, rgba(251,191,36,0.1) 100%);
            background-size: 80px 80px, cover;
            background-position: 0 0, center;
            animation: systemEntryFloat 12s ease-in-out infinite;
            pointer-events: none;
        }

        .system-entry-concept::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--golden-yellow), var(--primary-blue), var(--light-green));
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }

        .concept-title {
            font-family: 'Copperplate Gothic Bold', 'Rockwell Extra Bold', serif;
            font-size: 2.5rem;
            font-weight: 900;
            margin-bottom: 2rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            position: relative;
            z-index: 1;
            animation: titleGlow 3s ease-in-out infinite;
        }

        .concept-description {
            font-size: 1.2rem;
            margin-bottom: 3rem;
            opacity: 0.95;
            line-height: 1.6;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            position: relative;
            z-index: 1;
        }

        .auth-gateway {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1.5rem;
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .auth-button {
            padding: 2rem 2.5rem;
            background: var(--gradient-tertiary);
            color: var(--primary-blue);
            border: 3px solid var(--golden-yellow);
            border-radius: 20px;
            font-weight: 900;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-xl), var(--shadow-inset);
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            transform: translateZ(0);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-family: 'Copperplate Gothic Bold', 'Rockwell Extra Bold', serif;
        }

        .auth-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.6), transparent);
            transition: left 0.6s ease;
        }

        .auth-button::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80"><defs><pattern id="auth-medical" width="16" height="16" patternUnits="userSpaceOnUse"><path d="M4 8 Q8 4, 12 8 T20 8" stroke="white" stroke-width="1" fill="none" opacity="0.4"/><circle cx="4" cy="8" r="2" fill="white" opacity="0.5"/><circle cx="20" cy="8" r="2" fill="white" opacity="0.5"/></pattern></defs><rect width="80" height="80" fill="url(%23auth-medical)"/></svg>'),
                radial-gradient(circle, rgba(255,255,255,0.5) 0%, transparent 70%);
            background-size: 32px 32px, cover;
            background-position: 0 0, center;
            transform: translate(-50%, -50%);
            transition: all 0.5s ease;
            border-radius: 50%;
        }

        .auth-button:hover {
            transform: translateY(-8px) scale(1.1) rotateX(5deg);
            box-shadow: var(--shadow-xl), 0 0 30px rgba(251, 191, 36, 0.5);
            background: var(--gradient-primary);
            color: white;
            border-color: var(--primary-blue);
        }

        .auth-button:hover::before {
            left: 100%;
        }

        .auth-button:hover::after {
            width: 120%;
            height: 120%;
        }

        .auth-button:active {
            transform: translateY(-4px) scale(1.05) rotateX(2deg);
            transition: all 0.1s ease;
        }

        .footer {
            background: var(--gradient-primary);
            color: white;
            padding: 3rem 2rem 2rem;
            text-align: center;
            position: relative;
            margin-top: 4rem;
            transform-style: preserve-3d;
            box-shadow: 0 -20px 40px rgba(0, 0, 0, 0.2);
            border-top: 4px solid var(--golden-yellow);
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--soft-green), var(--accent-blue), var(--golden-yellow));
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
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><defs><pattern id="footer-medical" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M10 20 Q20 10, 30 20 T50 20" stroke="white" stroke-width="2" fill="none" opacity="0.15"/><circle cx="10" cy="20" r="4" fill="white" opacity="0.2"/><circle cx="50" cy="20" r="4" fill="white" opacity="0.2"/></pattern></defs><rect width="200" height="200" fill="url(%23footer-medical)"/></svg>'),
                linear-gradient(135deg, rgba(255,255,255,0.05) 0%, transparent 50%, rgba(251,191,36,0.05) 100%);
            background-size: 80px 80px, cover;
            background-position: 0 0, center;
            pointer-events: none;
            animation: footerMedicalFloat 8s ease-in-out infinite;
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

        @keyframes logoFloat {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes medicalGlow {
            0%, 100% {
                opacity: 0.3;
                transform: scale(1);
            }
            50% {
                opacity: 0.6;
                transform: scale(1.1);
            }
        }

        @keyframes medicalToolsFloat {
            0%, 100% {
                transform: translateY(0px);
                opacity: 0.5;
            }
            50% {
                transform: translateY(-5px);
                opacity: 0.8;
            }
        }

        @keyframes footerMedicalFloat {
            0%, 100% {
                transform: translateY(0px);
                opacity: 0.3;
            }
            50% {
                transform: translateY(-3px);
                opacity: 0.6;
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes shimmer {
            0% {
                background-position: -1000px 0;
            }
            100% {
                background-position: 1000px 0;
            }
        }

        @keyframes glowPulse {
            0%, 100% {
                box-shadow: 0 0 5px rgba(37, 99, 235, 0.5);
            }
            50% {
                box-shadow: 0 0 20px rgba(37, 99, 235, 0.8), 0 0 30px rgba(37, 99, 235, 0.4);
            }
        }

        @keyframes textShimmer {
            0% {
                background-position: -200% center;
            }
            100% {
                background-position: 200% center;
            }
        }

        @keyframes textGlow3D {
            0%, 100% {
                text-shadow: 
                    0 0 10px rgba(251,191,36,0.8),
                    0 0 20px rgba(251,191,36,0.6),
                    0 0 30px rgba(251,191,36,0.4),
                    2px 2px 4px rgba(0,0,0,0.3);
            }
            50% {
                text-shadow: 
                    0 0 20px rgba(251,191,36,1),
                    0 0 30px rgba(251,191,36,0.8),
                    0 0 40px rgba(251,191,36,0.6),
                    3px 3px 6px rgba(0,0,0,0.4);
            }
        }

        @keyframes headerPatternFloat {
            0%, 100% {
                transform: translateY(0px);
                opacity: 0.5;
            }
            50% {
                transform: translateY(-5px);
                opacity: 0.8;
            }
        }

        @keyframes containerPatternFloat {
            0%, 100% {
                transform: translateX(0px);
                opacity: 0.3;
            }
            50% {
                transform: translateX(10px);
                opacity: 0.6;
            }
        }

        @keyframes legendPatternFloat {
            0%, 100% {
                transform: translateY(0px);
                opacity: 0.4;
            }
            50% {
                transform: translateY(-3px);
                opacity: 0.7;
            }
        }

        @keyframes navLogo3D {
            0%, 100% {
                transform: translateY(0) rotateX(0) rotateY(0);
                text-shadow: 
                    0 2px 4px rgba(0,0,0,0.3),
                    0 0 10px rgba(37,99,235,0.4);
            }
            50% {
                transform: translateY(-2px) rotateX(2deg) rotateY(2deg);
                text-shadow: 
                    0 4px 8px rgba(0,0,0,0.4),
                    0 0 20px rgba(37,99,235,0.6);
            }
        }

        @media (max-width: 768px) {
            .institution-title {
                font-family: 'Copperplate Gothic Bold', 'Rockwell Extra Bold', serif;
                font-size: 1.8rem;
                font-weight: 900;
                line-height: 1.2;
                text-shadow: 2px 2px 4px rgba(0,0,0,0.4);
            }
            
            .subtitle {
                font-family: 'Bernard MT Condensed', 'Arial Narrow', sans-serif;
                font-size: 1.1rem;
                font-weight: 700;
                text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
            }
            
            .main-container {
                padding: 2rem 1rem 6rem;
            }
            
            .structure-section {
                padding: 1.2rem;
                margin-bottom: 1rem;
            }
            
            .section-icon {
                width: 50px;
                height: 50px;
                font-size: 1.4rem;
            }
            
            .section-title {
                font-size: 1.2rem;
            }
            
            .section-description {
                font-size: 0.85rem;
            }
            
            .role-list {
                grid-template-columns: 1fr;
                gap: 0.5rem;
            }
            
            .role-item {
                padding: 0.6rem;
                font-size: 0.9rem;
            }
            
            .auth-gateway {
                grid-template-columns: 1fr;
                gap: 0.8rem;
            }
            
            .auth-button {
                padding: 1.2rem 1.8rem;
                font-size: 1rem;
            }
            
            .contact-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .official-logo {
                width: 80px;
                height: 80px;
            }
            
            .hero-section {
                padding: 3rem 1.5rem;
            }
            
            .tools-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
            
            .tool-item {
                padding: 1.5rem;
            }
            
            .tool-icon {
                font-size: 2.2rem;
            }
            
            .nav-container {
                padding: 0 1rem;
            }
            
            .nav-logo span {
                font-family: 'Rockwell Extra Bold', 'Rockwell', serif;
                font-size: 0.9rem;
                font-weight: 900;
            }
            
            .nav-link {
                padding: 0.6rem 1.2rem;
                font-size: 0.9rem;
            }
        }

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
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: var(--gradient-primary);
            color: white;
            text-decoration: none;
            font-weight: 600;
            border-radius: 25px;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
        }

        .nav-link:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            background: var(--gradient-secondary);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="nav-logo">
                <img src="public/isnm-logo.jpeg" alt="ISNM">
                <span>IGANGA SCHOOL OF NURSING AND MIDWIFERY</span>
            </a>
            <div class="nav-links">
                <a href="index.php" class="nav-link">
                    <i class="fas fa-home"></i>
                    Back to Home
                </a>
            </div>
        </div>
    </nav>

    <header class="organogram-header">
        <div class="header-content">
            <div class="logo-section">
                <img src="public/isnm-logo.jpeg" alt="ISNM Official Logo" class="organogram-logo">
            </div>
            <div class="title-section">
                <h1 class="organogram-title">IGANGA SCHOOL OF NURSING AND MIDWIFERY</h1>
                <p class="organogram-subtitle">ORGANIZATIONAL STRUCTURE & COMMUNICATION CHANNELS</p>
            </div>
        </div>
    </header>

    <main class="organogram-container">
        <div class="organogram-wrapper">
            <div class="organogram-chart">
            <!-- Level 1: Directors (ROOT) -->
            <div class="org-level org-level-1">
                <div class="org-box root" onclick="handleSectionClick('director-overall')">
                    <div class="org-icon">
                        <i class="fas fa-crown"></i>
                    </div>
                    <h3 class="org-title">DIRECTOR</h3>
                    <p class="org-description">Overall Operations & All Departments</p>
                    <div class="communication-flow">OVERALL AUTHORITY</div>
                </div>
                
                <div class="org-box root" onclick="handleSectionClick('director-academic')">
                    <div class="org-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3 class="org-title">DIRECTOR</h3>
                    <p class="org-description">Academic Affairs</p>
                    <div class="communication-flow">ACADEMIC AUTHORITY</div>
                </div>
                
                <div class="org-box root" onclick="handleSectionClick('director-ict')">
                    <div class="org-icon">
                        <i class="fas fa-laptop"></i>
                    </div>
                    <h3 class="org-title">DIRECTOR</h3>
                    <p class="org-description">ICT & Sports</p>
                    <div class="communication-flow">ICT & SPORTS</div>
                </div>
                
                <div class="org-box root" onclick="handleSectionClick('director-admission')">
                    <div class="org-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h3 class="org-title">DIRECTOR</h3>
                    <p class="org-description">Requirements & Admission</p>
                    <div class="communication-flow">ADMISSION AUTHORITY</div>
                </div>
            </div>

            <!-- Connection Lines to Level 2 -->
            <div class="connection-lines">
                <div class="vertical-line" style="top: 120px; height: 40px;"></div>
                <div class="horizontal-line" style="top: 160px; left: 200px; width: 1000px;"></div>
                <div class="vertical-line" style="top: 160px; left: 200px; height: 40px;"></div>
                <div class="vertical-line" style="top: 160px; left: 500px; height: 40px;"></div>
                <div class="vertical-line" style="top: 160px; left: 800px; height: 40px;"></div>
                <div class="vertical-line" style="top: 160px; left: 1100px; height: 40px;"></div>
            </div>

            <!-- Level 2: Principal -->
            <div class="org-level org-level-2">
                <div class="org-box executive" onclick="handleSectionClick('principal')">
                    <div class="org-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h3 class="org-title">PRINCIPAL</h3>
                    <p class="org-description">School Administration</p>
                    <div class="communication-flow">SCHOOL LEADERSHIP</div>
                </div>
            </div>

            <!-- Connection Lines to Level 3 -->
            <div class="connection-lines">
                <div class="vertical-line" style="top: 280px; height: 40px;"></div>
            </div>

            <!-- Level 3: Deputy Principal -->
            <div class="org-level org-level-3">
                <div class="org-box executive" onclick="handleSectionClick('deputy-principal')">
                    <div class="org-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <h3 class="org-title">DEPUTY PRINCIPAL</h3>
                    <p class="org-description">Assistant School Administration</p>
                    <div class="communication-flow">ASSIST LEADERSHIP</div>
                </div>
            </div>

            <!-- Connection Lines to Level 4 -->
            <div class="connection-lines">
                <div class="vertical-line" style="top: 400px; height: 40px;"></div>
                <div class="horizontal-line" style="top: 440px; left: 200px; width: 800px;"></div>
                <div class="vertical-line" style="top: 440px; left: 200px; height: 40px;"></div>
                <div class="vertical-line" style="top: 440px; left: 500px; height: 40px;"></div>
                <div class="vertical-line" style="top: 440px; left: 800px; height: 40px;"></div>
            </div>

            <!-- Level 4: Key Administrative Staff -->
            <div class="org-level org-level-4">
                <div class="org-box management" onclick="handleSectionClick('hr-manager')">
                    <div class="org-icon">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <h3 class="org-title">HR MANAGER</h3>
                    <p class="org-description">Human Resources</p>
                    <div class="communication-flow">HR ADMINISTRATION</div>
                </div>
                
                <div class="org-box management" onclick="handleSectionClick('academic-registrar')">
                    <div class="org-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3 class="org-title">ACADEMIC REGISTRAR</h3>
                    <p class="org-description">Academic Records</p>
                    <div class="communication-flow">ACADEMIC RECORDS</div>
                </div>
                
                <div class="org-box management" onclick="handleSectionClick('school-bursar')">
                    <div class="org-icon">
                        <i class="fas fa-calculator"></i>
                    </div>
                    <h3 class="org-title">SCHOOL BURSAR</h3>
                    <p class="org-description">Financial Management</p>
                    <div class="communication-flow">FINANCIAL CONTROL</div>
                </div>
                
                <div class="org-box management" onclick="handleSectionClick('secretary')">
                    <div class="org-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h3 class="org-title">SECRETARY</h3>
                    <p class="org-description">Administrative Support</p>
                    <div class="communication-flow">ADMIN SUPPORT</div>
                </div>
            </div>

            <!-- Connection Lines to Level 5 -->
            <div class="connection-lines">
                <div class="vertical-line" style="top: 560px; height: 40px;"></div>
                <div class="horizontal-line" style="top: 600px; left: 100px; width: 1200px;"></div>
                <div class="vertical-line" style="top: 600px; left: 100px; height: 40px;"></div>
                <div class="vertical-line" style="top: 600px; left: 300px; height: 40px;"></div>
                <div class="vertical-line" style="top: 600px; left: 500px; height: 40px;"></div>
                <div class="vertical-line" style="top: 600px; left: 700px; height: 40px;"></div>
                <div class="vertical-line" style="top: 600px; left: 900px; height: 40px;"></div>
                <div class="vertical-line" style="top: 600px; left: 1100px; height: 40px;"></div>
            </div>

            <!-- Level 5: Department Heads & Key Staff -->
            <div class="org-level org-level-5">
                <!-- Medical Department -->
                <div class="org-box operational" onclick="handleSectionClick('sick-bay')">
                    <div class="org-icon">
                        <i class="fas fa-hospital"></i>
                    </div>
                    <h3 class="org-title">SICK BAY</h3>
                    <p class="org-description">Medical Services</p>
                    <div class="communication-flow">HEALTH SERVICES</div>
                </div>

                <!-- ICT Department -->
                <div class="org-box operational" onclick="handleSectionClick('ict-director')">
                    <div class="org-icon">
                        <i class="fas fa-laptop"></i>
                    </div>
                    <h3 class="org-title">ICT DIRECTOR</h3>
                    <p class="org-description">Technology Management</p>
                    <div class="communication-flow">TECH LEADERSHIP</div>
                </div>
                
                <div class="org-box operational" onclick="handleSectionClick('computer-lab-1')">
                    <div class="org-icon">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <h3 class="org-title">LAB ATTENDANT 1</h3>
                    <p class="org-description">Computer Lab</p>
                    <div class="communication-flow">LAB SUPPORT</div>
                </div>
                
                <div class="org-box operational" onclick="handleSectionClick('computer-lab-2')">
                    <div class="org-icon">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <h3 class="org-title">LAB ATTENDANT 2</h3>
                    <p class="org-description">Computer Lab</p>
                    <div class="communication-flow">LAB SUPPORT</div>
                </div>

                <!-- Library -->
                <div class="org-box operational" onclick="handleSectionClick('librarian')">
                    <div class="org-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <h3 class="org-title">LIBRARIAN</h3>
                    <p class="org-description">Library Services</p>
                    <div class="communication-flow">KNOWLEDGE MGMT</div>
                </div>

                <!-- Skills Lab -->
                <div class="org-box operational" onclick="handleSectionClick('skills-lab-1')">
                    <div class="org-icon">
                        <i class="fas fa-flask"></i>
                    </div>
                    <h3 class="org-title">SKILLS LAB 1</h3>
                    <p class="org-description">Nursing Skills</p>
                    <div class="communication-flow">NURSING LAB</div>
                </div>
                
                <div class="org-box operational" onclick="handleSectionClick('skills-lab-2')">
                    <div class="org-icon">
                        <i class="fas fa-flask"></i>
                    </div>
                    <h3 class="org-title">SKILLS LAB 2</h3>
                    <p class="org-description">Midwifery Skills</p>
                    <div class="communication-flow">MIDWIFERY LAB</div>
                </div>
            </div>

            <!-- Connection Lines to Level 6 -->
            <div class="connection-lines">
                <div class="vertical-line" style="top: 720px; height: 40px;"></div>
                <div class="horizontal-line" style="top: 760px; left: 100px; width: 1200px;"></div>
                <div class="vertical-line" style="top: 760px; left: 100px; height: 40px;"></div>
                <div class="vertical-line" style="top: 760px; left: 300px; height: 40px;"></div>
                <div class="vertical-line" style="top: 760px; left: 500px; height: 40px;"></div>
                <div class="vertical-line" style="top: 760px; left: 700px; height: 40px;"></div>
                <div class="vertical-line" style="top: 760px; left: 900px; height: 40px;"></div>
                <div class="vertical-line" style="top: 760px; left: 1100px; height: 40px;"></div>
            </div>

            <!-- Level 6: Student Services & Support Staff -->
            <div class="org-level org-level-6">
                <!-- Matrons (3) -->
                <div class="org-box operational" onclick="handleSectionClick('matron-1')">
                    <div class="org-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <h3 class="org-title">MATRON 1</h3>
                    <p class="org-description">Girls Hostel A</p>
                    <div class="communication-flow">GIRLS WELFARE</div>
                </div>
                
                <div class="org-box operational" onclick="handleSectionClick('matron-2')">
                    <div class="org-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <h3 class="org-title">MATRON 2</h3>
                    <p class="org-description">Girls Hostel B</p>
                    <div class="communication-flow">GIRLS WELFARE</div>
                </div>
                
                <div class="org-box operational" onclick="handleSectionClick('matron-3')">
                    <div class="org-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <h3 class="org-title">MATRON 3</h3>
                    <p class="org-description">Girls Hostel C</p>
                    <div class="communication-flow">GIRLS WELFARE</div>
                </div>

                <!-- Warden/Area Manager -->
                <div class="org-box operational" onclick="handleSectionClick('warden')">
                    <div class="org-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="org-title">WARDEN</h3>
                    <p class="org-description">Boys Affairs & Area Manager</p>
                    <div class="communication-flow">BOYS WELFARE</div>
                </div>

                <!-- Academic Heads -->
                <div class="org-box operational" onclick="handleSectionClick('head-nursing')">
                    <div class="org-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3 class="org-title">HEAD NURSING</h3>
                    <p class="org-description">Nursing Department</p>
                    <div class="communication-flow">NURSING LEAD</div>
                </div>
                
                <div class="org-box operational" onclick="handleSectionClick('head-midwifery')">
                    <div class="org-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3 class="org-title">HEAD MIDWIFERY</h3>
                    <p class="org-description">Midwifery Department</p>
                    <div class="communication-flow">MIDWIFERY LEAD</div>
                </div>
            </div>

            <!-- Connection Lines to Level 7 (Teaching Staff) -->
            <div class="connection-lines">
                <div class="vertical-line" style="top: 880px; height: 40px;"></div>
                <div class="horizontal-line" style="top: 920px; left: 50px; width: 1300px;"></div>
                <div class="vertical-line" style="top: 920px; left: 50px; height: 40px;"></div>
                <div class="vertical-line" style="top: 920px; left: 250px; height: 40px;"></div>
                <div class="vertical-line" style="top: 920px; left: 450px; height: 40px;"></div>
                <div class="vertical-line" style="top: 920px; left: 650px; height: 40px;"></div>
                <div class="vertical-line" style="top: 920px; left: 850px; height: 40px;"></div>
                <div class="vertical-line" style="top: 920px; left: 1050px; height: 40px;"></div>
                <div class="vertical-line" style="top: 920px; left: 1250px; height: 40px;"></div>
            </div>

            <!-- Level 7: Teaching Staff (Sample - will expand to 17) -->
            <div class="org-level org-level-7">
                <div class="org-box operational" onclick="handleSectionClick('teaching-staff-1')">
                    <div class="org-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3 class="org-title">TEACHER 1</h3>
                    <p class="org-description">Teaching Staff</p>
                    <div class="communication-flow">TEACHING</div>
                </div>
                
                <div class="org-box operational" onclick="handleSectionClick('teaching-staff-2')">
                    <div class="org-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3 class="org-title">TEACHER 2</h3>
                    <p class="org-description">Teaching Staff</p>
                    <div class="communication-flow">TEACHING</div>
                </div>
                
                <div class="org-box operational" onclick="handleSectionClick('clinical-nursing-1')">
                    <div class="org-icon">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <h3 class="org-title">CLINICAL N1</h3>
                    <p class="org-description">Nursing Clinical</p>
                    <div class="communication-flow">CLINICAL</div>
                </div>
                
                <div class="org-box operational" onclick="handleSectionClick('clinical-nursing-2')">
                    <div class="org-icon">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <h3 class="org-title">CLINICAL N2</h3>
                    <p class="org-description">Nursing Clinical</p>
                    <div class="communication-flow">CLINICAL</div>
                </div>
                
                <div class="org-box operational" onclick="handleSectionClick('clinical-nursing-3')">
                    <div class="org-icon">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <h3 class="org-title">CLINICAL N3</h3>
                    <p class="org-description">Nursing Clinical</p>
                    <div class="communication-flow">CLINICAL</div>
                </div>
                
                <div class="org-box operational" onclick="handleSectionClick('clinical-midwifery-1')">
                    <div class="org-icon">
                        <i class="fas fa-baby"></i>
                    </div>
                    <h3 class="org-title">CLINICAL M1</h3>
                    <p class="org-description">Midwifery Clinical</p>
                    <div class="communication-flow">CLINICAL</div>
                </div>
                
                <div class="org-box operational" onclick="handleSectionClick('tutor-1')">
                    <div class="org-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h3 class="org-title">TUTOR 1</h3>
                    <p class="org-description">Academic Tutor</p>
                    <div class="communication-flow">TUTORING</div>
                </div>
            </div>

            <!-- Continue pattern for all remaining staff... -->
            <div class="more-staff-indicator">
                <p><i class="fas fa-ellipsis-h"></i> Additional Teaching Staff (10 more Teachers, 3 more Clinical Midwifery, 8 more Tutors) <i class="fas fa-ellipsis-h"></i></p>
            </div>

            <!-- Support Departments -->
            <div class="org-level org-level-8">
                <div class="org-box operational" onclick="handleSectionClick('drivers')">
                    <div class="org-icon">
                        <i class="fas fa-bus"></i>
                    </div>
                    <h3 class="org-title">DRIVERS</h3>
                    <p class="org-description">Transportation</p>
                    <div class="communication-flow">TRANSPORT</div>
                </div>
                
                <div class="org-box operational" onclick="handleSectionClick('cooks')">
                    <div class="org-icon">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <h3 class="org-title">COOKS</h3>
                    <p class="org-description">Kitchen Services</p>
                    <div class="communication-flow">FOOD SERVICES</div>
                </div>
                
                <div class="org-box operational" onclick="handleSectionClick('cleaners')">
                    <div class="org-icon">
                        <i class="fas fa-broom"></i>
                    </div>
                    <h3 class="org-title">CLEANERS</h3>
                    <p class="org-description">Cleaning Services</p>
                    <div class="communication-flow">CLEANING</div>
                </div>
                
                <div class="org-box operational" onclick="handleSectionClick('security')">
                    <div class="org-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="org-title">SECURITY</h3>
                    <p class="org-description">Campus Security</p>
                    <div class="communication-flow">SECURITY</div>
                </div>
                
                <div class="org-box operational" onclick="handleSectionClick('tailors')">
                    <div class="org-icon">
                        <i class="fas fa-cutting"></i>
                    </div>
                    <h3 class="org-title">TAILORS</h3>
                    <p class="org-description">Uniform Services</p>
                    <div class="communication-flow">UNIFORMS</div>
                </div>
            </div>
        </div>

        <!-- Organogram Legend -->
        <div class="org-legend">
            <div class="legend-item">
                <div class="legend-color root"></div>
                <span>Root Level (Director)</span>
            </div>
            <div class="legend-item">
                <div class="legend-color executive"></div>
                <span>Executive Level</span>
            </div>
            <div class="legend-item">
                <div class="legend-color management"></div>
                <span>Management Level</span>
            </div>
            <div class="legend-item">
                <div class="legend-color operational"></div>
                <span>Operational Level</span>
            </div>
        </div>

        <!-- System Entry Concept -->
        <section class="system-entry-concept">
            <h2 class="concept-title">
                <i class="fas fa-sign-in-alt"></i> SYSTEM ENTRY CONCEPT
            </h2>
            <p class="concept-description">
                This structure represents the ROOT ENTRY VIEW of the system. Users will first see this organizational hierarchy landing page. 
                Clicking any section will lead to authentication (login). After login, users will be routed based on role.
            </p>
            <div class="auth-gateway">
                <a href="login.php?role=admin" class="auth-button">
                    <i class="fas fa-user-shield"></i> Admin
                </a>
                <a href="login.php?role=lecturer" class="auth-button">
                    <i class="fas fa-chalkboard-teacher"></i> Lecturer
                </a>
                <a href="login.php?role=student" class="auth-button">
                    <i class="fas fa-user-graduate"></i> Student
                </a>
                <a href="login.php?role=support" class="auth-button">
                    <i class="fas fa-tools"></i> Support
                </a>
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
        <?php
        // Add any dynamic PHP variables if needed
        $base_url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
        $base_url .= "://".$_SERVER['HTTP_HOST'];
        ?>
        
        function handleSectionClick(section) {
            // Define department to role mapping for individual positions
            const departmentRoles = {
                // Directors (ROOT Level)
                'director-overall': 'admin',
                'director-academic': 'admin',
                'director-ict': 'admin',
                'director-admission': 'admin',
                
                // Top Management
                'principal': 'admin',
                'deputy-principal': 'admin',
                
                // Key Administrative Staff
                'hr-manager': 'admin',
                'academic-registrar': 'lecturer',
                'school-bursar': 'admin',
                'secretary': 'admin',
                
                // Department Heads & Key Staff
                'sick-bay': 'lecturer',
                'ict-director': 'admin',
                'computer-lab-1': 'support',
                'computer-lab-2': 'support',
                'librarian': 'support',
                'skills-lab-1': 'support',
                'skills-lab-2': 'support',
                
                // Student Services
                'matron-1': 'support',
                'matron-2': 'support',
                'matron-3': 'support',
                'warden': 'support',
                
                // Academic Heads
                'head-nursing': 'lecturer',
                'head-midwifery': 'lecturer',
                
                // Teaching Staff (Sample - will expand)
                'teaching-staff-1': 'lecturer',
                'teaching-staff-2': 'lecturer',
                'teaching-staff-3': 'lecturer',
                'teaching-staff-4': 'lecturer',
                'teaching-staff-5': 'lecturer',
                'teaching-staff-6': 'lecturer',
                'teaching-staff-7': 'lecturer',
                'teaching-staff-8': 'lecturer',
                'teaching-staff-9': 'lecturer',
                'teaching-staff-10': 'lecturer',
                'teaching-staff-11': 'lecturer',
                'teaching-staff-12': 'lecturer',
                'teaching-staff-13': 'lecturer',
                'teaching-staff-14': 'lecturer',
                'teaching-staff-15': 'lecturer',
                'teaching-staff-16': 'lecturer',
                'teaching-staff-17': 'lecturer',
                
                // Clinical Instructors
                'clinical-nursing-1': 'lecturer',
                'clinical-nursing-2': 'lecturer',
                'clinical-nursing-3': 'lecturer',
                'clinical-midwifery-1': 'lecturer',
                'clinical-midwifery-2': 'lecturer',
                'clinical-midwifery-3': 'lecturer',
                
                // Tutors
                'tutor-1': 'lecturer',
                'tutor-2': 'lecturer',
                'tutor-3': 'lecturer',
                'tutor-4': 'lecturer',
                'tutor-5': 'lecturer',
                'tutor-6': 'lecturer',
                'tutor-7': 'lecturer',
                'tutor-8': 'lecturer',
                'tutor-9': 'lecturer',
                
                // Support Departments
                'drivers': 'support',
                'cooks': 'support',
                'cleaners': 'support',
                'security': 'support',
                'tailors': 'support'
            };
            
            // Get role for this department
            const role = departmentRoles[section] || 'admin';
            
            // Redirect to login page with specific role and department
            window.location.href = `login.php?role=${role}&department=${section}`;
        }

        function animateTool(element, toolType) {
            // Remove existing animations
            element.style.animation = 'none';
            element.offsetHeight; // Trigger reflow
            
            // Add specific animations based on tool type
            switch(toolType) {
                case 'syringe':
                    element.style.animation = 'inject 1s ease-in-out 3';
                    break;
                case 'heartbeat':
                    const heartbeatLine = element.querySelector('.heartbeat-line');
                    if (heartbeatLine) {
                        heartbeatLine.style.animation = 'heartbeat 0.5s linear 6';
                    }
                    element.style.animation = 'pulse 1s ease-in-out 3';
                    break;
                case 'stethoscope':
                    element.style.animation = 'pulse 0.5s ease-in-out 6';
                    break;
                case 'pills':
                    element.style.animation = 'rotate 2s ease-in-out';
                    break;
                case 'thermometer':
                    element.style.animation = 'pulse 0.8s ease-in-out 4';
                    break;
                case 'bandage':
                    element.style.animation = 'pulse 1.2s ease-in-out 3';
                    break;
                case 'blood':
                    element.style.animation = 'pulse 0.6s ease-in-out 5';
                    break;
                case 'baby':
                    element.style.animation = 'bounce 1s ease-in-out 3';
                    break;
                default:
                    element.style.animation = 'pulse 1s ease-in-out 3';
            }
            
            // Add glow effect
            element.style.boxShadow = '0 0 20px rgba(251, 191, 36, 0.6)';
            setTimeout(() => {
                element.style.boxShadow = '';
            }, 2000);
        }

        // Add entrance animations on scroll
        if ('IntersectionObserver' in window) {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animation = 'fadeIn 0.8s ease-out';
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            // Observe all sections
            const sections = document.querySelectorAll('.structure-section');
            sections.forEach(section => {
                observer.observe(section);
            });
        }

        // Add interactive hover effects
        const roleItems = document.querySelectorAll('.role-item');
        roleItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(8px) scale(1.02)';
            });
            
            item.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0) scale(1)';
            });
        });

        // Parallax effect for hero section
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const hero = document.querySelector('.hero-section');
            if (hero) {
                hero.style.transform = `translateY(${scrolled * 0.5}px)`;
            }
        });
    </script>
</body>
</html>
