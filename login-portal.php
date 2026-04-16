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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&family=Rockwell:wght@400;700;900&display=swap" rel="stylesheet">`n    <link rel="stylesheet" href="assets/modern-theme.css">`n    <link rel="stylesheet" href="assets/modern-theme.css">
    <link rel="stylesheet" href="assets/modern-theme.css">
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
            --shadow-glass: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
            
            /* Alignment & Spacing Defaults */
            --card-padding: 1.5rem;
        }

        body {
            font-family: 'Inter', 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
            background: var(--gradient-clean);
            min-height: 100vh;
            color: var(--primary-dark);
            line-height: 1.6;
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
                radial-gradient(circle at 20% 50%, rgba(26, 26, 26, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(45, 45, 45, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 50% 20%, rgba(255, 215, 0, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 50% 80%, rgba(255, 248, 220, 0.08) 0%, transparent 50%);
            animation: aurora 20s ease-in-out infinite;
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
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="gold-3d-pattern" width="40" height="40" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1.5" fill="rgba(212,175,55,0.1)"/><path d="M10 20 Q20 10, 30 20 T50 20" stroke="rgba(184,134,11,0.05)" stroke-width="1" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23gold-3d-pattern)"/></svg>'),
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><defs><pattern id="gold-3d-grid" width="100" height="100" patternUnits="userSpaceOnUse"><rect x="10" y="10" width="80" height="80" fill="none" stroke="rgba(212,175,55,0.03)" stroke-width="1"/></pattern></defs><rect width="200" height="200" fill="url(%23gold-3d-grid)"/></svg>');
            background-size: 40px 40px, 120px 120px;
            animation: medical3DFloat 30s linear infinite;
            pointer-events: none;
            z-index: -1;
        }

        .organogram-header {
            background: var(--luxury-white);
            color: white;
            padding: 4rem 2rem;
            text-align: center;
            position: relative;
            box-shadow: var(--shadow-luxury);
            border-bottom: 3px solid var(--luxury-gold);
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
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><defs><pattern id="header-pattern" width="40" height="40" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1" fill="%23D4AF37" opacity="0.1"/><path d="M10 20 Q20 10, 30 20 T50 20" stroke="%23D4AF37" stroke-width="0.5" fill="none" opacity="0.1"/></pattern></defs><rect width="200" height="200" fill="url(%23header-pattern)"/></svg>'),
                linear-gradient(135deg, var(--luxury-cream) 0%, var(--luxury-white) 100%);
            background-size: 80px 80px, cover;
            background-position: 0 0, center;
            animation: headerPatternFloat 15s ease-in-out infinite;
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
            border: 2px solid var(--luxury-gold);
            box-shadow: var(--shadow-luxury), 0 0 30px rgba(212,175,55,0.2);
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
            background: var(--gradient-gold);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 4px 8px rgba(0,0,0,0.1);
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .organogram-subtitle {
            font-family: 'Bernard MT Condensed', 'Arial Narrow', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0.5rem 0 0 0;
            color: var(--luxury-gold-deep);
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .organogram-container {
            background: var(--luxury-cream);
            min-height: 100vh;
            padding: 5rem 2rem;
            display: flex;
            justify-content: center;
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
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 400"><defs><pattern id="container-pattern" width="60" height="60" patternUnits="userSpaceOnUse"><circle cx="30" cy="30" r="1.5" fill="%23D4AF37" opacity="0.05"/></pattern></defs><rect width="400" height="400" fill="url(%23container-pattern)"/></svg>'),
                linear-gradient(135deg, var(--luxury-white) 0%, var(--luxury-cream-alt) 100%);
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

        .org-box.root .org-icon {
            background: var(--gradient-gold);
            color: var(--luxury-white);
        }

        .org-title {
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--luxury-text);
            margin-bottom: 0.4rem;
            text-transform: uppercase;
            letter-spacing: 0.02em;
        }

        .org-subtitle {
            font-size: 0.75rem;
            color: var(--luxury-text-muted);
            font-weight: 500;
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
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .auth-button {
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(12px);
            color: var(--luxury-text);
            border: 1px solid var(--luxury-gold-light);
            border-radius: 20px;
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            box-shadow: 
                var(--shadow-luxury), 
                inset 0 2px 4px rgba(255, 255, 255, 0.5);
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            position: relative;
            transform: translateZ(0);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-family: 'Copperplate Gothic Bold', 'Rockwell Extra Bold', serif;
            animation: authButtonFloat 4s ease-in-out infinite;
        }

        .auth-button:nth-child(1) { animation-delay: 0s; }
        .auth-button:nth-child(2) { animation-delay: 0.5s; }
        .auth-button:nth-child(3) { animation-delay: 1s; }
        .auth-button:nth-child(4) { animation-delay: 1.5s; }

        .auth-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.8), transparent);
            transition: left 0.8s ease;
        }

        .auth-button::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="auth-medical" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M5 10 Q10 5, 15 10 T25 10" stroke="var(--primary-blue)" stroke-width="1.5" fill="none" opacity="0.3"/><circle cx="5" cy="10" r="3" fill="var(--golden-yellow)" opacity="0.4"/><circle cx="25" cy="10" r="3" fill="var(--golden-yellow)" opacity="0.4"/></pattern></defs><rect width="100" height="100" fill="url(%23auth-medical)"/></svg>'),
                linear-gradient(135deg, transparent 40%, rgba(255,255,255,0.3) 50%, transparent 60%);
            background-size: 40px 40px, cover;
            background-position: 0 0, center;
            transform: translateX(-100%);
            transition: transform 1s ease;
            pointer-events: none;
        }

        .auth-button:hover {
            transform: translateY(-12px) scale(1.15) rotateX(-5deg) rotateY(5deg) translateZ(20px);
            box-shadow: 
                var(--shadow-2xl), 
                0 0 60px rgba(251, 191, 36, 0.6),
                0 0 80px rgba(37, 99, 235, 0.4),
                inset 0 2px 4px rgba(255, 255, 255, 0.9),
                inset 0 -2px 4px rgba(0, 0, 0, 0.2);
            background: linear-gradient(145deg, var(--light-green), var(--creamy-yellow));
            color: var(--primary-blue);
            border-color: var(--primary-blue);
        }

        .auth-button:hover::before {
            left: 100%;
        }

        .auth-button:hover::after {
            transform: translateX(100%);
        }

        .auth-button:active {
            transform: translateY(-6px) scale(1.08) rotateX(-2deg) rotateY(2deg) translateZ(10px);
            transition: all 0.1s ease;
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

        .department-card:hover .department-icon {
            transform: scale(1.1) rotateY(10deg);
            background: linear-gradient(145deg, var(--golden-yellow), var(--warm-yellow));
        }

        .department-card:hover .department-icon::before {
            left: 100%;
        }

        .department-name {
            font-family: 'Copperplate Gothic Bold', 'Rockwell Extra Bold', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
        }

        .department-role {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .department-access {
            background: var(--gradient-primary);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
            margin-top: 1rem;
        }

        @keyframes deptPatternFloat {
            0%, 100% { transform: translateY(0px); opacity: 0.3; }
            50% { transform: translateY(-5px); opacity: 0.6; }
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

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .navbar {
                padding: 0.5rem 0;
            }

            .nav-container {
                padding: 0 1rem;
            }

            .nav-logo {
                font-size: 0.9rem;
            }

            .nav-logo img {
                width: 35px;
                height: 35px;
            }

            .nav-links {
                gap: 0.25rem;
            }

            .nav-link {
                padding: 0.4rem 0.8rem;
                font-size: 0.8rem;
            }

            .org-box {
                min-width: 140px;
                max-width: 160px;
                padding: 0.8rem;
            }

            .org-level {
                gap: 0.5rem;
            }

            .org-title {
                font-size: 0.9rem;
            }

            .org-subtitle {
                font-size: 0.8rem;
            }

            .org-icon {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }

            .organogram-header {
                padding: 1.5rem 1rem;
            }

            .organogram-header h1 {
                font-size: 1.5rem;
            }

            .organogram-header p {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .nav-links {
                display: none;
            }

            .org-box {
                min-width: 120px;
                max-width: 140px;
                padding: 0.6rem;
            }

            .org-title {
                font-size: 0.8rem;
            }

            .org-subtitle {
                font-size: 0.7rem;
            }

            .org-icon {
                width: 35px;
                height: 35px;
                font-size: 0.9rem;
            }

            .organogram-header {
                padding: 1rem 0.5rem;
            }

            .organogram-header h1 {
                font-size: 1.2rem;
            }

            .organogram-header p {
                font-size: 0.8rem;
            }

            .org-level {
                gap: 0.3rem;
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
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="nav-logo">
                <img src="assets/school-logo.png" alt="ISNM">
                <span>IGANGA SCHOOL OF NURSING AND MIDWIFERY</span>
            </a>
            <div class="nav-links">
                <a href="index.php" class="nav-link">
                    <i class="fas fa-home"></i>
                    Home
                </a>
                <a href="about.php" class="nav-link">
                    <i class="fas fa-info-circle"></i>
                    About
                </a>
                <a href="governance.php" class="nav-link">
                    <i class="fas fa-users"></i>
                    Governance
                </a>
                <a href="programs.php" class="nav-link">
                    <i class="fas fa-graduation-cap"></i>
                    Programs
                </a>
                <a href="admissions.php" class="nav-link">
                    <i class="fas fa-user-plus"></i>
                    Admissions
                </a>
                <a href="activities.php" class="nav-link">
                    <i class="fas fa-running"></i>
                    Activities
                </a>
                <a href="infrastructure.php" class="nav-link">
                    <i class="fas fa-building"></i>
                    Infrastructure
                </a>
                <a href="achievements.php" class="nav-link">
                    <i class="fas fa-trophy"></i>
                    Achievements
                </a>
                <a href="history.php" class="nav-link">
                    <i class="fas fa-history"></i>
                    History
                </a>
                <a href="contact.php" class="nav-link">
                    <i class="fas fa-envelope"></i>
                    Contact
                </a>
            </div>
        </div>
    </nav>

    <header class="organogram-header">
        <div class="header-content">
            <div class="logo-section">
                <img src="assets/school-logo.png" alt="ISNM Official Logo" class="organogram-logo">
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
            <!-- Level 1: Directors (4 Individual Directors) -->
            <div class="org-level org-level-1">
                <div class="org-box root" onclick="handleSectionClick('director-overall')">
                    <div class="org-icon">
                        <i class="fas fa-crown"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">Director Overall</h3>
                        <p class="org-subtitle">Chief Executive Officer</p>
                                            </div>
                </div>
                <div class="org-box root" onclick="handleSectionClick('director-academic')">
                    <div class="org-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">Director Academic</h3>
                        <p class="org-subtitle">Academic Affairs</p>
                                            </div>
                </div>
                <div class="org-box root" onclick="handleSectionClick('director-ict-sports')">
                    <div class="org-icon">
                        <i class="fas fa-laptop"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">Director ICT & Sports</h3>
                        <p class="org-subtitle">Technology & Sports</p>
                                            </div>
                </div>
                <div class="org-box root" onclick="handleSectionClick('director-requirements')">
                    <div class="org-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">Director Requirements & Admission</h3>
                        <p class="org-subtitle">Admissions & Requirements</p>
                                            </div>
                </div>
            </div>

            <!-- Connection Lines from Directors to Principal -->
            <div class="connection-lines level-1-to-2">
                <div class="arrow-line director-to-principal"></div>
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

            <!-- Connection Lines from Principal to Deputy Principal -->
            <div class="connection-lines level-2-to-3">
                <div class="arrow-line principal-to-deputy"></div>
            </div>

            <!-- Level 3: Deputy Principal -->
            <div class="org-level org-level-3">
                <div class="org-box executive" onclick="handleSectionClick('deputy-principal')">
                    <div class="org-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">DEPUTY PRINCIPAL</h3>
                        <p class="org-subtitle">Academic Administration</p>
                                            </div>
                </div>
            </div>

            <!-- Connection Lines from Deputy Principal to Administrative Staff -->
            <div class="connection-lines level-3-to-4">
                <div class="arrow-line deputy-to-hr"></div>
                <div class="arrow-line deputy-to-academic"></div>
                <div class="arrow-line deputy-to-bursar"></div>
                <div class="arrow-line deputy-to-secretary"></div>
            </div>

            <!-- Level 4: Key Administrative Staff (Individual Boxes) -->
            <div class="org-level org-level-4">
                <div class="org-box management" onclick="handleSectionClick('hr-manager')">
                    <div class="org-icon">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">HR Manager</h3>
                        <p class="org-subtitle">Human Resources</p>
                                            </div>
                </div>
                <div class="org-box management" onclick="handleSectionClick('academic-registrar')">
                    <div class="org-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">Academic Registrar</h3>
                        <p class="org-subtitle">Academic Records</p>
                                            </div>
                </div>
                <div class="org-box management" onclick="handleSectionClick('school-bursar')">
                    <div class="org-icon">
                        <i class="fas fa-calculator"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">School Bursar</h3>
                        <p class="org-subtitle">Financial Management</p>
                                            </div>
                </div>
                <div class="org-box management" onclick="handleSectionClick('secretary')">
                    <div class="org-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">Secretary</h3>
                        <p class="org-subtitle">Administrative Support</p>
                                            </div>
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

            <!-- Level 5: Department Heads & Key Staff (Individual Boxes) -->
            <div class="org-level org-level-5">
                <!-- Medical Department -->
                <div class="org-box operational" onclick="handleSectionClick('sick-bay')">
                    <div class="org-icon">
                        <i class="fas fa-hospital"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">SICK BAY</h3>
                        <p class="org-subtitle">Medical Services</p>
                                            </div>
                </div>

                <!-- ICT Department -->
                <div class="org-box operational" onclick="handleSectionClick('ict-director')">
                    <div class="org-icon">
                        <i class="fas fa-laptop"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">ICT DIRECTOR</h3>
                        <p class="org-subtitle">Technology Management</p>
                                            </div>
                </div>
                
                <!-- Computer Lab Attendants -->
                <div class="org-box operational" onclick="handleSectionClick('computer-lab-1')">
                    <div class="org-icon">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">LAB ATTENDANT 1</h3>
                        <p class="org-subtitle">Computer Lab</p>
                                            </div>
                </div>
                
                <div class="org-box operational" onclick="handleSectionClick('computer-lab-2')">
                    <div class="org-icon">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">LAB ATTENDANT 2</h3>
                        <p class="org-subtitle">Computer Lab</p>
                                            </div>
                </div>

                <!-- Library -->
                <div class="org-box operational" onclick="handleSectionClick('librarian')">
                    <div class="org-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">LIBRARIAN</h3>
                        <p class="org-subtitle">Library Services</p>
                                            </div>
                </div>

                <!-- Skills Lab Attendants -->
                <div class="org-box operational" onclick="handleSectionClick('skills-lab-1')">
                    <div class="org-icon">
                        <i class="fas fa-flask"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">SKILLS LAB 1</h3>
                        <p class="org-subtitle">Nursing Skills</p>
                                            </div>
                </div>
                
                <div class="org-box operational" onclick="handleSectionClick('skills-lab-2')">
                    <div class="org-icon">
                        <i class="fas fa-flask"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">SKILLS LAB 2</h3>
                        <p class="org-subtitle">Midwifery Skills</p>
                                            </div>
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

            <!-- Level 6: Student Services & Support Staff (Individual Boxes) -->
            <div class="org-level org-level-6">
                <!-- Matrons (3 Individual) -->
                <div class="org-box operational" onclick="handleSectionClick('matron-1')">
                    <div class="org-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">MATRON 1</h3>
                        <p class="org-subtitle">Girls Hostel A</p>
                                            </div>
                </div>
                
                <div class="org-box operational" onclick="handleSectionClick('matron-2')">
                    <div class="org-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">MATRON 2</h3>
                        <p class="org-subtitle">Girls Hostel B</p>
                                            </div>
                </div>
                
                <div class="org-box operational" onclick="handleSectionClick('matron-3')">
                    <div class="org-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">MATRON 3</h3>
                        <p class="org-subtitle">Girls Hostel C</p>
                                            </div>
                </div>

                <!-- Warden/Area Manager -->
                <div class="org-box operational" onclick="handleSectionClick('warden')">
                    <div class="org-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">WARDEN</h3>
                        <p class="org-subtitle">Boys Affairs & Area Manager</p>
                                            </div>
                </div>

                <!-- Academic Heads (2 Individual) -->
                <div class="org-box operational" onclick="handleSectionClick('head-nursing')">
                    <div class="org-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">HEAD NURSING</h3>
                        <p class="org-subtitle">Nursing Department</p>
                                            </div>
                </div>
                
                <div class="org-box operational" onclick="handleSectionClick('head-midwifery')">
                    <div class="org-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">HEAD MIDWIFERY</h3>
                        <p class="org-subtitle">Midwifery Department</p>
                                            </div>
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

            <!-- Level 7: Teaching Staff, Clinical Instructors, and Tutors (Individual Boxes) -->
            <div class="org-level org-level-7">
                <!-- Teaching Staff (Sample - 17 total) -->
                <div class="org-box operational" onclick="handleSectionClick('teaching-staff-1')">
                    <div class="org-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">TEACHER 1</h3>
                        <p class="org-subtitle">Teaching Staff</p>
                        <div class="org-contact">
                            <i class="fas fa-envelope"></i> teacher1@isnm.ac.ug
                        </div>
                    </div>
                </div>
                
                <div class="org-box operational" onclick="handleSectionClick('teaching-staff-2')">
                    <div class="org-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">TEACHER 2</h3>
                        <p class="org-subtitle">Teaching Staff</p>
                        <div class="org-contact">
                            <i class="fas fa-envelope"></i> teacher2@isnm.ac.ug
                        </div>
                    </div>
                </div>
                
                <!-- Clinical Instructors - Nursing (3) -->
                <div class="org-box operational" onclick="handleSectionClick('clinical-nursing-1')">
                    <div class="org-icon">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">CLINICAL N1</h3>
                        <p class="org-subtitle">Nursing Clinical</p>
                        <div class="org-contact">
                            <i class="fas fa-envelope"></i> clinicaln1@isnm.ac.ug
                        </div>
                    </div>
                </div>
                
                <div class="org-box operational" onclick="handleSectionClick('clinical-nursing-2')">
                    <div class="org-icon">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">CLINICAL N2</h3>
                        <p class="org-subtitle">Nursing Clinical</p>
                        <div class="org-contact">
                            <i class="fas fa-envelope"></i> clinicaln2@isnm.ac.ug
                        </div>
                    </div>
                </div>
                
                <div class="org-box operational" onclick="handleSectionClick('clinical-nursing-3')">
                    <div class="org-icon">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">CLINICAL N3</h3>
                        <p class="org-subtitle">Nursing Clinical</p>
                        <div class="org-contact">
                            <i class="fas fa-envelope"></i> clinicaln3@isnm.ac.ug
                        </div>
                    </div>
                </div>
                
                <!-- Clinical Instructors - Midwifery (3) -->
                <div class="org-box operational" onclick="handleSectionClick('clinical-midwifery-1')">
                    <div class="org-icon">
                        <i class="fas fa-baby"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">CLINICAL M1</h3>
                        <p class="org-subtitle">Midwifery Clinical</p>
                        <div class="org-contact">
                            <i class="fas fa-envelope"></i> clinicalm1@isnm.ac.ug
                        </div>
                    </div>
                </div>
                
                <!-- Tutors (Sample - 9 total) -->
                <div class="org-box operational" onclick="handleSectionClick('tutor-1')">
                    <div class="org-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">TUTOR 1</h3>
                        <p class="org-subtitle">Academic Tutor</p>
                                            </div>
                </div>
            </div>

            <!-- Additional Teaching Staff Indicator -->
            <div class="more-staff-indicator">
                <p><i class="fas fa-ellipsis-h"></i> Additional Staff: 15 more Teachers, 2 more Clinical Midwifery, 8 more Tutors <i class="fas fa-ellipsis-h"></i></p>
            </div>

            <!-- Support Departments (Individual Boxes) -->
            <div class="org-level org-level-8">
                <div class="org-box operational" onclick="handleSectionClick('drivers')">
                    <div class="org-icon">
                        <i class="fas fa-bus"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">DRIVERS</h3>
                        <p class="org-subtitle">Transportation</p>
                                            </div>
                </div>
                
                <div class="org-box operational" onclick="handleSectionClick('cooks')">
                    <div class="org-icon">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">COOKS</h3>
                        <p class="org-subtitle">Kitchen Services</p>
                                            </div>
                </div>
                
                <div class="org-box operational" onclick="handleSectionClick('cleaners')">
                    <div class="org-icon">
                        <i class="fas fa-broom"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">CLEANERS</h3>
                        <p class="org-subtitle">Cleaning Services</p>
                                            </div>
                </div>
                
                <div class="org-box operational" onclick="handleSectionClick('security')">
                    <div class="org-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">SECURITY</h3>
                        <p class="org-subtitle">Campus Security</p>
                                            </div>
                </div>
                
                <div class="org-box operational" onclick="handleSectionClick('tailors')">
                    <div class="org-icon">
                        <i class="fas fa-cut"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">TAILORS</h3>
                        <p class="org-subtitle">Uniform Services</p>
                                            </div>
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
                    <div class="auth-button-icon">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div class="auth-button-text">ADMIN</div>
                    <div class="auth-button-subtext">System Administrator</div>
                </a>
                <a href="login.php?role=lecturer" class="auth-button">
                    <div class="auth-button-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="auth-button-text">LECTURER</div>
                    <div class="auth-button-subtext">Teaching Staff</div>
                </a>
                <a href="login.php?role=student" class="auth-button">
                    <div class="auth-button-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="auth-button-text">STUDENT</div>
                    <div class="auth-button-subtext">Nursing & Midwifery</div>
                </a>
                <a href="login.php?role=support" class="auth-button">
                    <div class="auth-button-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <div class="auth-button-text">SUPPORT</div>
                    <div class="auth-button-subtext">Support Staff</div>
                </a>
            </div>

            <!-- Department Portals Section -->
            <section class="department-portals">
                <h2 class="department-title">
                    <i class="fas fa-building"></i> DEPARTMENT PORTALS
                </h2>
                <p class="department-subtitle">
                    Access specific department portals and management systems
                </p>
                <div class="department-grid">
                    <!-- Administrative Portals -->
                    <a href="dashboard-director.php" class="department-card">
                        <div class="department-icon">
                            <i class="fas fa-crown"></i>
                        </div>
                        <h3 class="department-name">Director Portal</h3>
                        <p class="department-role">Executive Management</p>
                        <span class="department-access">Admin Access</span>
                    </a>

                    <a href="dashboard-principal.php" class="department-card">
                        <div class="department-icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <h3 class="department-name">Principal Portal</h3>
                        <p class="department-role">School Administration</p>
                        <span class="department-access">Admin Access</span>
                    </a>

                    <a href="dashboard-hr-manager.php" class="department-card">
                        <div class="department-icon">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <h3 class="department-name">HR Portal</h3>
                        <p class="department-role">Human Resources</p>
                        <span class="department-access">Admin Access</span>
                    </a>

                    <!-- Academic Portals -->
                    <a href="dashboard-academic.php" class="department-card">
                        <div class="department-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3 class="department-name">Academic Portal</h3>
                        <p class="department-role">Academic Management</p>
                        <span class="department-access">Lecturer Access</span>
                    </a>

                    <a href="dashboard-nursing.php" class="department-card">
                        <div class="department-icon">
                            <i class="fas fa-stethoscope"></i>
                        </div>
                        <h3 class="department-name">Nursing Dept</h3>
                        <p class="department-role">Nursing Department</p>
                        <span class="department-access">Lecturer Access</span>
                    </a>

                    <a href="dashboard-midwifery.php" class="department-card">
                        <div class="department-icon">
                            <i class="fas fa-baby"></i>
                        </div>
                        <h3 class="department-name">Midwifery Dept</h3>
                        <p class="department-role">Midwifery Department</p>
                        <span class="department-access">Lecturer Access</span>
                    </a>

                    <!-- Student Services Portals -->
                    <a href="dashboard-student.php" class="department-card">
                        <div class="department-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h3 class="department-name">Student Portal</h3>
                        <p class="department-role">Student Services</p>
                        <span class="department-access">Student Access</span>
                    </a>

                    <a href="dashboard-library.php" class="department-card">
                        <div class="department-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <h3 class="department-name">Library Portal</h3>
                        <p class="department-role">Library Services</p>
                        <span class="department-access">Support Access</span>
                    </a>

                    <!-- Support Services Portals -->
                    <a href="dashboard-ict.php" class="department-card">
                        <div class="department-icon">
                            <i class="fas fa-laptop"></i>
                        </div>
                        <h3 class="department-name">ICT Portal</h3>
                        <p class="department-role">IT Services</p>
                        <span class="department-access">Support Access</span>
                    </a>

                    <a href="dashboard-finance.php" class="department-card">
                        <div class="department-icon">
                            <i class="fas fa-calculator"></i>
                        </div>
                        <h3 class="department-name">Finance Portal</h3>
                        <p class="department-role">Financial Services</p>
                        <span class="department-access">Admin Access</span>
                    </a>

                    <a href="dashboard-hostel.php" class="department-card">
                        <div class="department-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <h3 class="department-name">Hostel Portal</h3>
                        <p class="department-role">Student Housing</p>
                        <span class="department-access">Support Access</span>
                    </a>

                    <a href="dashboard-clinical.php" class="department-card">
                        <div class="department-icon">
                            <i class="fas fa-hospital"></i>
                        </div>
                        <h3 class="department-name">Clinical Portal</h3>
                        <p class="department-role">Clinical Training</p>
                        <span class="department-access">Lecturer Access</span>
                    </a>
                </div>
            </section>
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


