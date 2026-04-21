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
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            /* Professional Color Palette */
            --primary-dark: #0a1628;
            --secondary-dark: #1e3a5f;
            --accent-blue: #2563eb;
            --accent-cyan: #06b6d4;
            --accent-gold: #FFD700;
            --accent-gold-light: #fbbf24;
            --medical-blue: #0066cc;
            --medical-cyan: #00bcd4;
            --success-green: #22c55e;
            --error-red: #ef4444;
            
            /* Ultra-Premium Colors */
            --luxury-gold: #D4AF37;
            --platinum-silver: #E5E4E2;
            --royal-blue: #1A237E;
            --sapphire: #0F52BA;
            --diamond-white: #FAFAFA;
            --champagne: #F7E7CE;
            --pearl-white: #F8F6FF;
            --crystal-clear: rgba(255,255,255,0.95);
            
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
            
            /* Premium Gradients */
            --gradient-primary: linear-gradient(135deg, var(--primary-dark) 0%, var(--accent-blue) 100%);
            --gradient-secondary: linear-gradient(135deg, var(--accent-blue) 0%, var(--accent-cyan) 100%);
            --gradient-gold: linear-gradient(135deg, var(--accent-gold) 0%, var(--accent-gold-light) 100%);
            --gradient-luxury: linear-gradient(135deg, var(--luxury-gold) 0%, var(--champagne) 50%, var(--platinum-silver) 100%);
            --gradient-royal: linear-gradient(135deg, var(--royal-blue) 0%, var(--sapphire) 50%, var(--accent-blue) 100%);
            --gradient-3d-primary: linear-gradient(135deg, var(--medical-blue), var(--medical-cyan));
            
            /* Shadows */
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.07), 0 2px 4px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1), 0 4px 6px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px rgba(0, 0, 0, 0.1), 0 10px 10px rgba(0, 0, 0, 0.04);
            --shadow-2xl: 0 25px 50px rgba(0, 0, 0, 0.25);
            --shadow-luxury-sm: 0 4px 8px rgba(212, 175, 55, 0.3);
            --shadow-luxury-md: 0 8px 16px rgba(212, 175, 55, 0.4);
            --shadow-luxury-lg: 0 12px 24px rgba(212, 175, 55, 0.5);
            --shadow-luxury-xl: 0 20px 40px rgba(212, 175, 55, 0.6);
            --shadow-royal-sm: 0 4px 8px rgba(26, 35, 126, 0.3);
            --shadow-royal-md: 0 8px 16px rgba(26, 35, 126, 0.4);
            --shadow-royal-lg: 0 12px 24px rgba(26, 35, 126, 0.5);
            --shadow-royal-xl: 0 20px 40px rgba(26, 35, 126, 0.6);
            
            /* Transitions */
            --transition-fast: 150ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-normal: 300ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-slow: 500ms cubic-bezier(0.4, 0, 0.2, 1);
            
            /* Spacing */
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
            
            /* Typography */
            --text-xs: 0.75rem;
            --text-sm: 0.875rem;
            --text-base: 1rem;
            --text-lg: 1.125rem;
            --text-xl: 1.25rem;
            --text-2xl: 1.5rem;
            --text-3xl: 1.875rem;
            --text-4xl: 2.25rem;
            
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
            background: linear-gradient(135deg, var(--gray-50) 0%, var(--white) 50%, var(--gray-50) 100%);
            min-height: 100vh;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Navigation */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 2px solid var(--luxury-gold);
            z-index: 1000;
            padding: var(--space-4) 0;
            box-shadow: var(--shadow-lg);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 var(--space-6);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            font-weight: 700;
            font-size: var(--text-xl);
            color: var(--text-primary);
            text-decoration: none;
            font-family: 'Playfair Display', serif;
        }

        .nav-logo img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: var(--radius-full);
            border: 2px solid var(--luxury-gold);
        }

        .nav-links {
            display: flex;
            gap: var(--space-4);
            align-items: center;
        }

        .nav-link {
            color: var(--text-primary);
            text-decoration: none;
            font-weight: 600;
            font-size: var(--text-sm);
            padding: var(--space-2) var(--space-4);
            border-radius: var(--radius-lg);
            transition: all var(--transition-normal);
            border: 1px solid transparent;
        }

        .nav-link:hover {
            background: var(--gradient-primary);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .nav-link.active {
            background: var(--gradient-primary);
            color: var(--white);
        }

        /* Mobile Menu */
        .mobile-menu-toggle {
            display: none;
            flex-direction: column;
            gap: 4px;
            background: none;
            border: none;
            cursor: pointer;
            padding: var(--space-2);
        }

        .mobile-menu-toggle span {
            width: 25px;
            height: 3px;
            background: var(--text-primary);
            border-radius: var(--radius-sm);
            transition: all var(--transition-normal);
        }

        /* Page Header */
        .page-header {
            margin-top: 80px;
            padding: var(--space-16) 0;
            background: var(--gradient-primary);
            color: var(--white);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="medical-pattern" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M10 5 L10 15 M5 10 L15 10" stroke="rgba(255,255,255,0.1)" stroke-width="2"/></pattern></defs><rect width="100" height="100" fill="url(%23medical-pattern)"/></svg>');
            opacity: 0.3;
        }

        .page-header-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
            padding: 0 var(--space-6);
        }

        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: var(--text-4xl);
            font-weight: 800;
            margin-bottom: var(--space-4);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .page-subtitle {
            font-size: var(--text-lg);
            opacity: 0.9;
            margin-bottom: var(--space-6);
        }

        .breadcrumb {
            font-size: var(--text-sm);
            opacity: 0.8;
        }

        /* Main Content */
        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: var(--space-12) var(--space-6);
        }

        /* Portal Sections */
        .portal-section {
            margin-bottom: var(--space-16);
        }

        .section-header {
            text-align: center;
            margin-bottom: var(--space-12);
        }

        .section-badge {
            display: inline-flex;
            align-items: center;
            gap: var(--space-2);
            background: var(--gradient-gold);
            color: var(--white);
            padding: var(--space-2) var(--space-4);
            border-radius: var(--radius-full);
            font-weight: 600;
            font-size: var(--text-sm);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: var(--space-4);
            box-shadow: var(--shadow-md);
        }

        .director-badge {
            background: var(--gradient-luxury);
            box-shadow: var(--shadow-luxury-md);
        }

        .staff-badge {
            background: var(--gradient-royal);
            box-shadow: var(--shadow-royal-md);
        }

        .student-badge {
            background: var(--gradient-3d-primary);
            box-shadow: var(--shadow-md);
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: var(--text-3xl);
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: var(--space-4);
        }

        .section-subtitle {
            color: var(--text-secondary);
            font-size: var(--text-lg);
            max-width: 600px;
            margin: 0 auto;
        }

        /* Login Cards */
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: var(--space-8) 0;
        }

        .login-card {
            background: var(--white);
            border-radius: var(--radius-2xl);
            box-shadow: var(--shadow-xl);
            border: 1px solid var(--gray-200);
            overflow: hidden;
            width: 100%;
            max-width: 480px;
            position: relative;
            transition: all var(--transition-normal);
        }

        .login-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-2xl);
        }

        .director-card {
            border: 2px solid var(--luxury-gold);
            box-shadow: var(--shadow-luxury-lg);
        }

        .staff-card {
            border: 2px solid var(--royal-blue);
            box-shadow: var(--shadow-royal-lg);
        }

        .student-card {
            border: 2px solid var(--accent-blue);
            box-shadow: var(--shadow-lg);
        }

        .login-header {
            text-align: center;
            padding: var(--space-8) var(--space-6) var(--space-6);
            background: linear-gradient(135deg, var(--gray-50) 0%, var(--white) 100%);
            border-bottom: 1px solid var(--gray-200);
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
            font-size: 2rem;
            color: var(--white);
            box-shadow: var(--shadow-lg);
            transition: all var(--transition-normal);
        }

        .director-icon {
            background: var(--gradient-luxury);
            box-shadow: var(--shadow-luxury-md);
        }

        .staff-icon {
            background: var(--gradient-royal);
            box-shadow: var(--shadow-royal-md);
        }

        .student-icon {
            background: var(--gradient-3d-primary);
            box-shadow: var(--shadow-md);
        }

        .login-icon:hover {
            transform: scale(1.1);
        }

        .login-title {
            font-family: 'Playfair Display', serif;
            font-size: var(--text-2xl);
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: var(--space-2);
        }

        .login-subtitle {
            color: var(--text-secondary);
            font-size: var(--text-sm);
        }

        /* Login Form */
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
            width: 20px;
            text-align: center;
        }

        .form-input {
            width: 100%;
            padding: var(--space-4) var(--space-4) var(--space-4) calc(var(--space-4) + 24px);
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-lg);
            font-size: var(--text-base);
            font-family: 'Inter', sans-serif;
            background: var(--white);
            color: var(--text-primary);
            transition: all var(--transition-normal);
            box-shadow: var(--shadow-sm);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
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
            transform: translateY(-3px);
            box-shadow: var(--shadow-xl);
        }

        .login-button:hover::before {
            left: 100%;
        }

        .director-button {
            background: var(--gradient-luxury);
            box-shadow: var(--shadow-luxury-md);
        }

        .director-button:hover {
            box-shadow: var(--shadow-luxury-lg);
        }

        .staff-button {
            background: var(--gradient-royal);
            box-shadow: var(--shadow-royal-md);
        }

        .staff-button:hover {
            box-shadow: var(--shadow-royal-lg);
        }

        .student-button {
            background: var(--gradient-3d-primary);
            box-shadow: var(--shadow-md);
        }

        .student-button:hover {
            box-shadow: var(--shadow-lg);
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
            background: var(--gray-50);
            transform: translateX(4px);
        }

        .login-footer {
            padding: var(--space-6) var(--space-8);
            background: var(--gray-50);
            border-top: 1px solid var(--gray-200);
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

        /* Organogram Section */
        .organogram-section {
            background: var(--white);
            border-radius: var(--radius-2xl);
            padding: var(--space-12);
            margin: var(--space-16) 0;
            box-shadow: var(--shadow-xl);
            border: 1px solid var(--gray-200);
        }

        .organogram-level {
            display: flex;
            justify-content: center;
            gap: var(--space-8);
            margin-bottom: var(--space-12);
            flex-wrap: wrap;
        }

        .org-box {
            background: var(--white);
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-xl);
            padding: var(--space-6);
            min-width: 200px;
            max-width: 250px;
            box-shadow: var(--shadow-lg);
            transition: all var(--transition-normal);
            cursor: pointer;
            position: relative;
            text-align: center;
            transform-style: preserve-3d;
        }

        .org-box:hover {
            transform: translateY(-8px) scale(1.05);
            box-shadow: var(--shadow-2xl);
        }

        .org-box.executive {
            border-color: var(--luxury-gold);
            background: linear-gradient(145deg, var(--white), var(--champagne));
            box-shadow: var(--shadow-luxury-lg);
        }

        .org-box.management {
            border-color: var(--royal-blue);
            background: linear-gradient(145deg, var(--white), var(--pearl-white));
            box-shadow: var(--shadow-royal-lg);
        }

        .org-box.operational {
            border-color: var(--accent-blue);
            background: linear-gradient(145deg, var(--white), var(--gray-50));
            box-shadow: var(--shadow-lg);
        }

        .org-icon {
            width: 60px;
            height: 60px;
            border-radius: var(--radius-full);
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto var(--space-4);
            font-size: 1.5rem;
            color: var(--white);
            box-shadow: var(--shadow-md);
        }

        .org-box.executive .org-icon {
            background: var(--gradient-luxury);
            box-shadow: var(--shadow-luxury-md);
        }

        .org-box.management .org-icon {
            background: var(--gradient-royal);
            box-shadow: var(--shadow-royal-md);
        }

        .org-box.operational .org-icon {
            background: var(--gradient-3d-primary);
            box-shadow: var(--shadow-md);
        }

        .org-title {
            font-family: 'Playfair Display', serif;
            font-size: var(--text-xl);
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: var(--space-2);
        }

        .org-subtitle {
            color: var(--text-secondary);
            font-size: var(--text-sm);
            margin-bottom: var(--space-4);
        }

        .org-roles {
            display: grid;
            grid-template-columns: 1fr;
            gap: var(--space-2);
            text-align: left;
        }

        .org-role {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            font-size: var(--text-xs);
            color: var(--text-secondary);
            padding: var(--space-2);
            background: var(--gray-50);
            border-radius: var(--radius-md);
        }

        .org-role i {
            color: var(--accent-blue);
            width: 16px;
            text-align: center;
        }

        /* Footer */
        .footer {
            background: var(--primary-dark);
            color: var(--white);
            padding: var(--space-12) 0;
            text-align: center;
            margin-top: var(--space-20);
        }

        .footer-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 var(--space-6);
        }

        .footer-title {
            font-family: 'Playfair Display', serif;
            font-size: var(--text-2xl);
            font-weight: 700;
            margin-bottom: var(--space-4);
        }

        .footer-subtitle {
            font-size: var(--text-lg);
            opacity: 0.9;
            margin-bottom: var(--space-8);
        }

        .contact-buttons {
            display: flex;
            justify-content: center;
            gap: var(--space-4);
            flex-wrap: wrap;
        }

        .whatsapp-button {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            background: #25D366;
            color: var(--white);
            text-decoration: none;
            padding: var(--space-3) var(--space-6);
            border-radius: var(--radius-lg);
            font-weight: 600;
            transition: all var(--transition-normal);
            box-shadow: var(--shadow-lg);
        }

        .whatsapp-button:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-xl);
            background: #128C7E;
        }

        /* Credentials Guide Styles */
        .credentials-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .credentials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: var(--space-6);
            margin-bottom: var(--space-12);
        }

        .credential-card {
            background: var(--white);
            border-radius: var(--radius-xl);
            padding: var(--space-6);
            box-shadow: var(--shadow-lg);
            border: 2px solid var(--gray-200);
            transition: all var(--transition-normal);
            position: relative;
            overflow: hidden;
        }

        .credential-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-xl);
        }

        .credential-card.director-card {
            border-color: var(--luxury-gold);
            box-shadow: var(--shadow-luxury-lg);
        }

        .credential-card.staff-card {
            border-color: var(--royal-blue);
            box-shadow: var(--shadow-royal-lg);
        }

        .credential-card.student-card {
            border-color: var(--accent-blue);
            box-shadow: var(--shadow-lg);
        }

        .credential-header {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            margin-bottom: var(--space-4);
            padding-bottom: var(--space-3);
            border-bottom: 1px solid var(--gray-200);
        }

        .credential-header i {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-full);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: var(--white);
        }

        .credential-card.director-card .credential-header i {
            background: var(--gradient-luxury);
        }

        .credential-card.staff-card .credential-header i {
            background: var(--gradient-royal);
        }

        .credential-card.student-card .credential-header i {
            background: var(--gradient-3d-primary);
        }

        .credential-header h3 {
            font-size: var(--text-lg);
            font-weight: 700;
            color: var(--text-primary);
            margin: 0;
        }

        .credential-content p {
            margin-bottom: var(--space-3);
            font-size: var(--text-sm);
            color: var(--text-secondary);
        }

        .credential-content strong {
            color: var(--text-primary);
        }

        .credential-content code {
            background: var(--gray-100);
            padding: 0.2rem 0.4rem;
            border-radius: var(--radius-sm);
            font-family: 'Courier New', monospace;
            color: var(--accent-blue);
            font-weight: bold;
            font-size: 0.9em;
        }

        .credential-roles {
            display: flex;
            flex-wrap: wrap;
            gap: var(--space-2);
            margin-top: var(--space-3);
        }

        .credential-roles span {
            background: var(--gray-100);
            color: var(--text-secondary);
            padding: 0.3rem 0.6rem;
            border-radius: var(--radius-md);
            font-size: var(--text-xs);
            font-weight: 500;
            border: 1px solid var(--gray-200);
        }

        .guide-instructions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: var(--space-6);
            margin-top: var(--space-8);
        }

        .instruction-card {
            background: linear-gradient(135deg, var(--gray-50), var(--white));
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-xl);
            padding: var(--space-6);
            box-shadow: var(--shadow-md);
        }

        .instruction-card h4 {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            font-size: var(--text-lg);
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: var(--space-4);
        }

        .instruction-card h4 i {
            color: var(--accent-blue);
        }

        .instruction-card ol, .instruction-card ul {
            margin: 0;
            padding-left: var(--space-6);
        }

        .instruction-card li {
            margin-bottom: var(--space-2);
            font-size: var(--text-sm);
            color: var(--text-secondary);
            line-height: 1.6;
        }

        .instruction-card li::marker {
            color: var(--accent-blue);
            font-weight: bold;
        }

        /* Individual Login Grid */
        .individual-login-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: var(--space-6);
            margin-bottom: var(--space-8);
        }

        .individual-login-grid .login-card {
            max-width: 400px;
            margin: 0 auto;
        }

        .individual-login-grid .login-header {
            padding: var(--space-6) var(--space-4) var(--space-4);
        }

        .individual-login-grid .login-title {
            font-size: var(--text-xl);
        }

        .individual-login-grid .login-subtitle {
            font-size: var(--text-xs);
            color: var(--text-muted);
        }

        .individual-login-grid .login-form {
            padding: var(--space-6) var(--space-4);
        }

        .individual-login-grid .form-group {
            margin-bottom: var(--space-4);
        }

        .individual-login-grid .form-input {
            padding: var(--space-3);
            font-size: var(--text-sm);
        }

        .individual-login-grid .login-button {
            padding: var(--space-3) var(--space-4);
            font-size: var(--text-base);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .mobile-menu-toggle {
                display: flex;
            }

            .page-header {
                margin-top: 60px;
                padding: var(--space-12) 0;
            }

            .page-title {
                font-size: var(--text-3xl);
            }

            .main-content {
                padding: var(--space-8) var(--space-4);
            }

            .organogram-level {
                flex-direction: column;
                align-items: center;
            }

            .org-box {
                min-width: 180px;
                max-width: 220px;
            }

            .contact-buttons {
                flex-direction: column;
            }

            .credentials-grid {
                grid-template-columns: 1fr;
                gap: var(--space-4);
            }

            .credential-card {
                padding: var(--space-4);
            }

            .credential-roles {
                gap: var(--space-1);
            }

            .credential-roles span {
                font-size: 0.75rem;
                padding: 0.2rem 0.4rem;
            }

            .guide-instructions {
                grid-template-columns: 1fr;
                gap: var(--space-4);
            }
        }

        /* Animations */
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

        .portal-section {
            animation: fadeIn 0.8s ease-out;
        }

        .org-box {
            animation: fadeIn 0.8s ease-out;
        }

        .org-box:nth-child(1) { animation-delay: 0.1s; }
        .org-box:nth-child(2) { animation-delay: 0.2s; }
        .org-box:nth-child(3) { animation-delay: 0.3s; }
        .org-box:nth-child(4) { animation-delay: 0.4s; }
        .org-box:nth-child(5) { animation-delay: 0.5s; }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="nav-logo">
                <img src="assets/school-logo.png" alt="ISNM Logo">
                <span>ISNM</span>
            </a>
            
            <div class="nav-links">
                <a href="index.php" class="nav-link">Home</a>
                <a href="about.php" class="nav-link">About</a>
                <a href="programs.php" class="nav-link">Programs</a>
                <a href="admissions.php" class="nav-link">Admissions</a>
                <a href="contact.php" class="nav-link">Contact</a>
                <a href="login-portal.php" class="nav-link active">Portal</a>
            </div>
            
            <button class="mobile-menu-toggle" id="mobileMenuToggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </nav>

    <!-- Page Header -->
    <header class="page-header">
        <div class="page-header-content">
            <h1 class="page-title">Student Portal</h1>
            <p class="page-subtitle">Access your personalized dashboard and academic resources</p>
            <div class="breadcrumb">Home / Student Portal</div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Executive Directors Login Section -->
        <section class="portal-section">
            <div class="section-header">
                <div class="section-badge director-badge">
                    <i class="fas fa-crown"></i>
                    <span>Executive Directors</span>
                </div>
                <h2 class="section-title">Executive Directors Login Portal</h2>
                <p class="section-subtitle">Private access for each executive director position</p>
            </div>
            
            <div class="individual-login-grid">
                <!-- Director General -->
                <div class="login-card director-card">
                    <div class="login-header">
                        <div class="login-icon director-icon">
                            <i class="fas fa-crown"></i>
                        </div>
                        <h3 class="login-title">Director General</h3>
                        <p class="login-subtitle">Chief Executive Officer</p>
                    </div>
                    
                    <form class="login-form" method="POST" action="login.php">
                        <input type="hidden" name="user_type" value="director-general">
                        <div class="form-group">
                            <label for="dg-id" class="form-label">
                                <i class="fas fa-id-badge"></i>
                                Director ID
                            </label>
                            <input 
                                type="text" 
                                id="dg-id" 
                                name="username" 
                                class="form-input" 
                                placeholder="DIR001, DIRECTOR-GENERAL, DG" 
                                required
                                autocomplete="username"
                            >
                        </div>
                        
                        <div class="form-group">
                            <label for="dg-password" class="form-label">
                                <i class="fas fa-key"></i>
                                Password
                            </label>
                            <div class="password-input-container">
                                <input 
                                    type="password" 
                                    id="dg-password" 
                                    name="password" 
                                    class="form-input" 
                                    placeholder="Enter password" 
                                    required
                                    autocomplete="current-password"
                                >
                                <button type="button" class="password-toggle">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="login-button director-button">
                                <i class="fas fa-crown"></i>
                                Access Dashboard
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Director of Academics -->
                <div class="login-card director-card">
                    <div class="login-header">
                        <div class="login-icon director-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3 class="login-title">Director Academics</h3>
                        <p class="login-subtitle">Academic Affairs Director</p>
                    </div>
                    
                    <form class="login-form" method="POST" action="login.php">
                        <input type="hidden" name="user_type" value="director-academics">
                        <div class="form-group">
                            <label for="da-id" class="form-label">
                                <i class="fas fa-id-badge"></i>
                                Director ID
                            </label>
                            <input 
                                type="text" 
                                id="da-id" 
                                name="username" 
                                class="form-input" 
                                placeholder="DIR002, DIRECTOR-ACADEMICS, DA" 
                                required
                                autocomplete="username"
                            >
                        </div>
                        
                        <div class="form-group">
                            <label for="da-password" class="form-label">
                                <i class="fas fa-key"></i>
                                Password
                            </label>
                            <div class="password-input-container">
                                <input 
                                    type="password" 
                                    id="da-password" 
                                    name="password" 
                                    class="form-input" 
                                    placeholder="Enter password" 
                                    required
                                    autocomplete="current-password"
                                >
                                <button type="button" class="password-toggle">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="login-button director-button">
                                <i class="fas fa-graduation-cap"></i>
                                Access Dashboard
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Director of ICT -->
                <div class="login-card director-card">
                    <div class="login-header">
                        <div class="login-icon director-icon">
                            <i class="fas fa-laptop"></i>
                        </div>
                        <h3 class="login-title">Director ICT</h3>
                        <p class="login-subtitle">Information Technology Director</p>
                    </div>
                    
                    <form class="login-form" method="POST" action="login.php">
                        <input type="hidden" name="user_type" value="director-ict">
                        <div class="form-group">
                            <label for="di-id" class="form-label">
                                <i class="fas fa-id-badge"></i>
                                Director ID
                            </label>
                            <input 
                                type="text" 
                                id="di-id" 
                                name="username" 
                                class="form-input" 
                                placeholder="DIR003, DIRECTOR-ICT, DI" 
                                required
                                autocomplete="username"
                            >
                        </div>
                        
                        <div class="form-group">
                            <label for="di-password" class="form-label">
                                <i class="fas fa-key"></i>
                                Password
                            </label>
                            <div class="password-input-container">
                                <input 
                                    type="password" 
                                    id="di-password" 
                                    name="password" 
                                    class="form-input" 
                                    placeholder="Enter password" 
                                    required
                                    autocomplete="current-password"
                                >
                                <button type="button" class="password-toggle">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="login-button director-button">
                                <i class="fas fa-laptop"></i>
                                Access Dashboard
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Director of Finance -->
                <div class="login-card director-card">
                    <div class="login-header">
                        <div class="login-icon director-icon">
                            <i class="fas fa-coins"></i>
                        </div>
                        <h3 class="login-title">Director Finance</h3>
                        <p class="login-subtitle">Financial Affairs Director</p>
                    </div>
                    
                    <form class="login-form" method="POST" action="login.php">
                        <input type="hidden" name="user_type" value="director-finance">
                        <div class="form-group">
                            <label for="df-id" class="form-label">
                                <i class="fas fa-id-badge"></i>
                                Director ID
                            </label>
                            <input 
                                type="text" 
                                id="df-id" 
                                name="username" 
                                class="form-input" 
                                placeholder="DIR004, DIRECTOR-FINANCE, DF" 
                                required
                                autocomplete="username"
                            >
                        </div>
                        
                        <div class="form-group">
                            <label for="df-password" class="form-label">
                                <i class="fas fa-key"></i>
                                Password
                            </label>
                            <div class="password-input-container">
                                <input 
                                    type="password" 
                                    id="df-password" 
                                    name="password" 
                                    class="form-input" 
                                    placeholder="Enter password" 
                                    required
                                    autocomplete="current-password"
                                >
                                <button type="button" class="password-toggle">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="login-button director-button">
                                <i class="fas fa-coins"></i>
                                Access Dashboard
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Principal Office Login Section -->
        <section class="portal-section">
            <div class="section-header">
                <div class="section-badge staff-badge">
                    <i class="fas fa-user-graduate"></i>
                    <span>Principal Office</span>
                </div>
                <h2 class="section-title">Principal Office Login Portal</h2>
                <p class="section-subtitle">Private access for principal office positions</p>
            </div>
            
            <div class="individual-login-grid">
                <!-- Principal -->
                <div class="login-card staff-card">
                    <div class="login-header">
                        <div class="login-icon staff-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h3 class="login-title">School Principal</h3>
                        <p class="login-subtitle">Chief Executive Officer</p>
                    </div>
                    
                    <form class="login-form" method="POST" action="login.php">
                        <input type="hidden" name="user_type" value="principal">
                        <div class="form-group">
                            <label for="principal-id" class="form-label">
                                <i class="fas fa-id-card"></i>
                                Principal ID
                            </label>
                            <input 
                                type="text" 
                                id="principal-id" 
                                name="username" 
                                class="form-input" 
                                placeholder="PRINCIPAL, PRIN001, PRIN" 
                                required
                                autocomplete="username"
                            >
                        </div>
                        
                        <div class="form-group">
                            <label for="principal-password" class="form-label">
                                <i class="fas fa-key"></i>
                                Password
                            </label>
                            <div class="password-input-container">
                                <input 
                                    type="password" 
                                    id="principal-password" 
                                    name="password" 
                                    class="form-input" 
                                    placeholder="Enter password" 
                                    required
                                    autocomplete="current-password"
                                >
                                <button type="button" class="password-toggle">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="login-button staff-button">
                                <i class="fas fa-user-graduate"></i>
                                Access Dashboard
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Deputy Principal -->
                <div class="login-card staff-card">
                    <div class="login-header">
                        <div class="login-icon staff-icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <h3 class="login-title">Deputy Principal</h3>
                        <p class="login-subtitle">Assistant Chief Executive</p>
                    </div>
                    
                    <form class="login-form" method="POST" action="login.php">
                        <input type="hidden" name="user_type" value="deputy-principal">
                        <div class="form-group">
                            <label for="deputy-id" class="form-label">
                                <i class="fas fa-id-card"></i>
                                Deputy ID
                            </label>
                            <input 
                                type="text" 
                                id="deputy-id" 
                                name="username" 
                                class="form-input" 
                                placeholder="DEPUTY, DEP001, DP" 
                                required
                                autocomplete="username"
                            >
                        </div>
                        
                        <div class="form-group">
                            <label for="deputy-password" class="form-label">
                                <i class="fas fa-key"></i>
                                Password
                            </label>
                            <div class="password-input-container">
                                <input 
                                    type="password" 
                                    id="deputy-password" 
                                    name="password" 
                                    class="form-input" 
                                    placeholder="Enter password" 
                                    required
                                    autocomplete="current-password"
                                >
                                <button type="button" class="password-toggle">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="login-button staff-button">
                                <i class="fas fa-user-tie"></i>
                                Access Dashboard
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Financial Management Login Section -->
        <section class="portal-section">
            <div class="section-header">
                <div class="section-badge staff-badge">
                    <i class="fas fa-coins"></i>
                    <span>Financial Management</span>
                </div>
                <h2 class="section-title">Financial Management Login Portal</h2>
                <p class="section-subtitle">Private access for financial department positions</p>
            </div>
            
            <div class="individual-login-grid">
                <!-- School Bursar -->
                <div class="login-card staff-card">
                    <div class="login-header">
                        <div class="login-icon staff-icon">
                            <i class="fas fa-coins"></i>
                        </div>
                        <h3 class="login-title">School Bursar</h3>
                        <p class="login-subtitle">Chief Accountant</p>
                    </div>
                    
                    <form class="login-form" method="POST" action="login.php">
                        <input type="hidden" name="user_type" value="school-bursar">
                        <div class="form-group">
                            <label for="bursar-id" class="form-label">
                                <i class="fas fa-id-card"></i>
                                Bursar ID
                            </label>
                            <input 
                                type="text" 
                                id="bursar-id" 
                                name="username" 
                                class="form-input" 
                                placeholder="BURSAR, BUR001, SB" 
                                required
                                autocomplete="username"
                            >
                        </div>
                        
                        <div class="form-group">
                            <label for="bursar-password" class="form-label">
                                <i class="fas fa-key"></i>
                                Password
                            </label>
                            <div class="password-input-container">
                                <input 
                                    type="password" 
                                    id="bursar-password" 
                                    name="password" 
                                    class="form-input" 
                                    placeholder="Enter password" 
                                    required
                                    autocomplete="current-password"
                                >
                                <button type="button" class="password-toggle">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="login-button staff-button">
                                <i class="fas fa-coins"></i>
                                Access Dashboard
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Accounts Assistant -->
                <div class="login-card staff-card">
                    <div class="login-header">
                        <div class="login-icon staff-icon">
                            <i class="fas fa-calculator"></i>
                        </div>
                        <h3 class="login-title">Accounts Assistant</h3>
                        <p class="login-subtitle">Financial Support</p>
                    </div>
                    
                    <form class="login-form" method="POST" action="login.php">
                        <input type="hidden" name="user_type" value="accounts-assistant">
                        <div class="form-group">
                            <label for="acc-ast-id" class="form-label">
                                <i class="fas fa-id-card"></i>
                                Staff ID
                            </label>
                            <input 
                                type="text" 
                                id="acc-ast-id" 
                                name="username" 
                                class="form-input" 
                                placeholder="ACC-AST, ACC001, AA" 
                                required
                                autocomplete="username"
                            >
                        </div>
                        
                        <div class="form-group">
                            <label for="acc-ast-password" class="form-label">
                                <i class="fas fa-key"></i>
                                Password
                            </label>
                            <div class="password-input-container">
                                <input 
                                    type="password" 
                                    id="acc-ast-password" 
                                    name="password" 
                                    class="form-input" 
                                    placeholder="Enter password" 
                                    required
                                    autocomplete="current-password"
                                >
                                <button type="button" class="password-toggle">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="login-button staff-button">
                                <i class="fas fa-calculator"></i>
                                Access Dashboard
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Finance Officer -->
                <div class="login-card staff-card">
                    <div class="login-header">
                        <div class="login-icon staff-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="login-title">Finance Officer</h3>
                        <p class="login-subtitle">Financial Management</p>
                    </div>
                    
                    <form class="login-form" method="POST" action="login.php">
                        <input type="hidden" name="user_type" value="finance-officer">
                        <div class="form-group">
                            <label for="fin-off-id" class="form-label">
                                <i class="fas fa-id-card"></i>
                                Staff ID
                            </label>
                            <input 
                                type="text" 
                                id="fin-off-id" 
                                name="username" 
                                class="form-input" 
                                placeholder="FIN-OFF, FIN001, FO" 
                                required
                                autocomplete="username"
                            >
                        </div>
                        
                        <div class="form-group">
                            <label for="fin-off-password" class="form-label">
                                <i class="fas fa-key"></i>
                                Password
                            </label>
                            <div class="password-input-container">
                                <input 
                                    type="password" 
                                    id="fin-off-password" 
                                    name="password" 
                                    class="form-input" 
                                    placeholder="Enter password" 
                                    required
                                    autocomplete="current-password"
                                >
                                <button type="button" class="password-toggle">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="login-button staff-button">
                                <i class="fas fa-chart-line"></i>
                                Access Dashboard
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Administrative Staff Login Section -->
        <section class="portal-section">
            <div class="section-header">
                <div class="section-badge staff-badge">
                    <i class="fas fa-users-cog"></i>
                    <span>Administrative Staff</span>
                </div>
                <h2 class="section-title">Administrative Staff Login Portal</h2>
                <p class="section-subtitle">Private access for administrative positions</p>
            </div>
            
            <div class="individual-login-grid">
                <!-- Academic Registrar -->
                <div class="login-card staff-card">
                    <div class="login-header">
                        <div class="login-icon staff-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h3 class="login-title">Academic Registrar</h3>
                        <p class="login-subtitle">Academic Records</p>
                    </div>
                    
                    <form class="login-form" method="POST" action="login.php">
                        <input type="hidden" name="user_type" value="academic-registrar">
                        <div class="form-group">
                            <label for="reg-id" class="form-label">
                                <i class="fas fa-id-card"></i>
                                Staff ID
                            </label>
                            <input 
                                type="text" 
                                id="reg-id" 
                                name="username" 
                                class="form-input" 
                                placeholder="REGISTRAR, REG001, AR" 
                                required
                                autocomplete="username"
                            >
                        </div>
                        
                        <div class="form-group">
                            <label for="reg-password" class="form-label">
                                <i class="fas fa-key"></i>
                                Password
                            </label>
                            <div class="password-input-container">
                                <input 
                                    type="password" 
                                    id="reg-password" 
                                    name="password" 
                                    class="form-input" 
                                    placeholder="Enter password" 
                                    required
                                    autocomplete="current-password"
                                >
                                <button type="button" class="password-toggle">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="login-button staff-button">
                                <i class="fas fa-user-graduate"></i>
                                Access Dashboard
                            </button>
                        </div>
                    </form>
                </div>

                <!-- HR Manager -->
                <div class="login-card staff-card">
                    <div class="login-header">
                        <div class="login-icon staff-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="login-title">HR Manager</h3>
                        <p class="login-subtitle">Human Resources</p>
                    </div>
                    
                    <form class="login-form" method="POST" action="login.php">
                        <input type="hidden" name="user_type" value="hr-manager">
                        <div class="form-group">
                            <label for="hr-id" class="form-label">
                                <i class="fas fa-id-card"></i>
                                Staff ID
                            </label>
                            <input 
                                type="text" 
                                id="hr-id" 
                                name="username" 
                                class="form-input" 
                                placeholder="HR-MGR, HR001, HRM" 
                                required
                                autocomplete="username"
                            >
                        </div>
                        
                        <div class="form-group">
                            <label for="hr-password" class="form-label">
                                <i class="fas fa-key"></i>
                                Password
                            </label>
                            <div class="password-input-container">
                                <input 
                                    type="password" 
                                    id="hr-password" 
                                    name="password" 
                                    class="form-input" 
                                    placeholder="Enter password" 
                                    required
                                    autocomplete="current-password"
                                >
                                <button type="button" class="password-toggle">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="login-button staff-button">
                                <i class="fas fa-users"></i>
                                Access Dashboard
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Secretary -->
                <div class="login-card staff-card">
                    <div class="login-header">
                        <div class="login-icon staff-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h3 class="login-title">School Secretary</h3>
                        <p class="login-subtitle">Administrative Support</p>
                    </div>
                    
                    <form class="login-form" method="POST" action="login.php">
                        <input type="hidden" name="user_type" value="secretary">
                        <div class="form-group">
                            <label for="sec-id" class="form-label">
                                <i class="fas fa-id-card"></i>
                                Staff ID
                            </label>
                            <input 
                                type="text" 
                                id="sec-id" 
                                name="username" 
                                class="form-input" 
                                placeholder="SECRETARY, SEC001, SEC" 
                                required
                                autocomplete="username"
                            >
                        </div>
                        
                        <div class="form-group">
                            <label for="sec-password" class="form-label">
                                <i class="fas fa-key"></i>
                                Password
                            </label>
                            <div class="password-input-container">
                                <input 
                                    type="password" 
                                    id="sec-password" 
                                    name="password" 
                                    class="form-input" 
                                    placeholder="Enter password" 
                                    required
                                    autocomplete="current-password"
                                >
                                <button type="button" class="password-toggle">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="login-button staff-button">
                                <i class="fas fa-file-alt"></i>
                                Access Dashboard
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Librarian -->
                <div class="login-card staff-card">
                    <div class="login-header">
                        <div class="login-icon staff-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <h3 class="login-title">School Librarian</h3>
                        <p class="login-subtitle">Library Management</p>
                    </div>
                    
                    <form class="login-form" method="POST" action="login.php">
                        <input type="hidden" name="user_type" value="librarian">
                        <div class="form-group">
                            <label for="lib-id" class="form-label">
                                <i class="fas fa-id-card"></i>
                                Staff ID
                            </label>
                            <input 
                                type="text" 
                                id="lib-id" 
                                name="username" 
                                class="form-input" 
                                placeholder="LIBRARIAN, LIB001, LIB" 
                                required
                                autocomplete="username"
                            >
                        </div>
                        
                        <div class="form-group">
                            <label for="lib-password" class="form-label">
                                <i class="fas fa-key"></i>
                                Password
                            </label>
                            <div class="password-input-container">
                                <input 
                                    type="password" 
                                    id="lib-password" 
                                    name="password" 
                                    class="form-input" 
                                    placeholder="Enter password" 
                                    required
                                    autocomplete="current-password"
                                >
                                <button type="button" class="password-toggle">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="login-button staff-button">
                                <i class="fas fa-book"></i>
                                Access Dashboard
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Academic Staff Login Section -->
        <section class="portal-section">
            <div class="section-header">
                <div class="section-badge staff-badge">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span>Academic Staff</span>
                </div>
                <h2 class="section-title">Academic Staff Login Portal</h2>
                <p class="section-subtitle">Teaching and clinical staff dashboard access</p>
            </div>
            
            <div class="login-container">
                <div class="login-card staff-card">
                    <div class="login-header">
                        <div class="login-icon staff-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h3 class="login-title">Academic Staff Login</h3>
                        <p class="login-subtitle">Enter academic staff credentials</p>
                    </div>
                    
                    <form class="login-form" method="POST" action="login.php">
                        <input type="hidden" name="user_type" value="lecturer">
                        <div class="form-group">
                            <label for="lecturer-id" class="form-label">
                                <i class="fas fa-id-card"></i>
                                Staff ID / Employee Number
                            </label>
                            <input 
                                type="text" 
                                id="lecturer-id" 
                                name="username" 
                                class="form-input" 
                                placeholder="Enter Staff ID" 
                                required
                                autocomplete="username"
                            >
                        </div>
                        
                        <div class="form-group">
                            <label for="lecturer-password" class="form-label">
                                <i class="fas fa-lock"></i>
                                Academic Staff Password
                            </label>
                            <div class="password-input-container">
                                <input 
                                    type="password" 
                                    id="lecturer-password" 
                                    name="password" 
                                    class="form-input" 
                                    placeholder="Enter academic password" 
                                    required
                                    autocomplete="current-password"
                                >
                                <button type="button" class="password-toggle">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="login-button staff-button">
                                <i class="fas fa-chalkboard-teacher"></i>
                                Access Academic Dashboard
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
                            Access for: Head Nursing, Head Midwifery, Senior Lecturers, Lecturers, Clinical Instructors, Tutors
                        </p>
                        <div class="contact-info">
                            <p><i class="fas fa-phone"></i> +256 772 514 889</p>
                            <p><i class="fas fa-envelope"></i> academic@isnm.ac.ug</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Support Staff Login Section -->
        <section class="portal-section">
            <div class="section-header">
                <div class="section-badge staff-badge">
                    <i class="fas fa-hands-helping"></i>
                    <span>Support Staff</span>
                </div>
                <h2 class="section-title">Support Staff Login Portal</h2>
                <p class="section-subtitle">Student services and support staff dashboard access</p>
            </div>
            
            <div class="login-container">
                <div class="login-card staff-card">
                    <div class="login-header">
                        <div class="login-icon staff-icon">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h3 class="login-title">Support Staff Login</h3>
                        <p class="login-subtitle">Enter support staff credentials</p>
                    </div>
                    
                    <form class="login-form" method="POST" action="login.php">
                        <input type="hidden" name="user_type" value="support">
                        <div class="form-group">
                            <label for="support-id" class="form-label">
                                <i class="fas fa-id-card"></i>
                                Staff ID / Employee Number
                            </label>
                            <input 
                                type="text" 
                                id="support-id" 
                                name="username" 
                                class="form-input" 
                                placeholder="Enter Staff ID" 
                                required
                                autocomplete="username"
                            >
                        </div>
                        
                        <div class="form-group">
                            <label for="support-password" class="form-label">
                                <i class="fas fa-lock"></i>
                                Support Staff Password
                            </label>
                            <div class="password-input-container">
                                <input 
                                    type="password" 
                                    id="support-password" 
                                    name="password" 
                                    class="form-input" 
                                    placeholder="Enter support password" 
                                    required
                                    autocomplete="current-password"
                                >
                                <button type="button" class="password-toggle">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="login-button staff-button">
                                <i class="fas fa-hands-helping"></i>
                                Access Support Dashboard
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
                            Access for: Matrons, Wardens, Lab Technicians, Drivers, Cooks, Cleaners
                        </p>
                        <div class="contact-info">
                            <p><i class="fas fa-phone"></i> +256 772 514 889</p>
                            <p><i class="fas fa-envelope"></i> support@isnm.ac.ug</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Student Login Section -->
        <section class="portal-section">
            <div class="section-header">
                <div class="section-badge student-badge">
                    <i class="fas fa-user-graduate"></i>
                    <span>Student Access</span>
                </div>
                <h2 class="section-title">Student Login Portal</h2>
                <p class="section-subtitle">Student dashboard and academic portal access</p>
            </div>
            
            <div class="login-container">
                <div class="login-card student-card">
                    <div class="login-header">
                        <div class="login-icon student-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h3 class="login-title">Student Login</h3>
                        <p class="login-subtitle">Enter your student credentials</p>
                    </div>
                    
                    <form class="login-form" method="POST" action="login.php">
                        <input type="hidden" name="user_type" value="student">
                        <div class="form-group">
                            <label for="student-id" class="form-label">
                                <i class="fas fa-id-card"></i>
                                Student ID / Registration Number
                            </label>
                            <input 
                                type="text" 
                                id="student-id" 
                                name="username" 
                                class="form-input" 
                                placeholder="Enter your Student ID" 
                                required
                                autocomplete="username"
                            >
                        </div>
                        
                        <div class="form-group">
                            <label for="student-password" class="form-label">
                                <i class="fas fa-lock"></i>
                                Student Password
                            </label>
                            <div class="password-input-container">
                                <input 
                                    type="password" 
                                    id="student-password" 
                                    name="password" 
                                    class="form-input" 
                                    placeholder="Enter your password" 
                                    required
                                    autocomplete="current-password"
                                >
                                <button type="button" class="password-toggle">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="login-button student-button">
                                <i class="fas fa-graduation-cap"></i>
                                Access Student Dashboard
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
                            Access for: All Students including Guild Leaders, Class Representatives, Club Leaders
                        </p>
                        <div class="contact-info">
                            <p><i class="fas fa-phone"></i> +256 772 514 889</p>
                            <p><i class="fas fa-envelope"></i> student@isnm.ac.ug</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Organogram Section -->
        <section class="organogram-section">
            <div class="section-header">
                <div class="section-badge">
                    <i class="fas fa-sitemap"></i>
                    <span>Institutional Structure</span>
                </div>
                <h2 class="section-title">ISNM Organizational Structure</h2>
                <p class="section-subtitle">Complete hierarchy of staff and student roles with dashboard access</p>
            </div>
            
            <!-- Executive Level - Directors -->
            <div class="organogram-level">
                <div class="org-box executive" onclick="handleOrgClick('director')">
                    <div class="org-icon">
                        <i class="fas fa-crown"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">Directors</h3>
                        <p class="org-subtitle">Executive Management</p>
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
                            <div class="org-role">
                                <i class="fas fa-user-tie"></i>
                                <span>Director Finance</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Management Level - Principal -->
            <div class="organogram-level">
                <div class="org-box management" onclick="handleOrgClick('principal')">
                    <div class="org-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">Principal</h3>
                        <p class="org-subtitle">Chief Executive Officer</p>
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
            
            <!-- Financial Management -->
            <div class="organogram-level">
                <div class="org-box management" onclick="handleOrgClick('bursar')">
                    <div class="org-icon">
                        <i class="fas fa-coins"></i>
                    </div>
                    <div class="org-content">
                        <h3 class="org-title">School Accountant</h3>
                        <p class="org-subtitle">Chief Financial Officer</p>
                        <div class="org-roles">
                            <div class="org-role">
                                <i class="fas fa-user-tie"></i>
                                <span>School Bursar / Accountant</span>
                            </div>
                            <div class="org-role">
                                <i class="fas fa-user-tie"></i>
                                <span>Accounts Assistant</span>
                            </div>
                            <div class="org-role">
                                <i class="fas fa-user-tie"></i>
                                <span>Finance Officer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Administrative Staff -->
            <div class="organogram-level">
                <div class="org-box management" onclick="handleOrgClick('admin')">
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
                <div class="org-box management" onclick="handleOrgClick('lecturer')">
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
                <div class="org-box operational" onclick="handleOrgClick('support')">
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
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Student Body -->
            <div class="organogram-level">
                <div class="org-box operational" onclick="handleOrgClick('student')">
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
        </section>

        <!-- Login Credentials Guide Section -->
        <section class="portal-section">
            <div class="section-header">
                <div class="section-badge student-badge">
                    <i class="fas fa-key"></i>
                    <span>Login Help</span>
                </div>
                <h2 class="section-title">Login Credentials Guide</h2>
                <p class="section-subtitle">Use these credentials to access your specific dashboard</p>
            </div>
            
            <div class="credentials-container">
                <div class="credentials-grid">
                    <!-- Executive Directors -->
                    <div class="credential-card director-card">
                        <div class="credential-header">
                            <i class="fas fa-crown"></i>
                            <h3>Executive Directors</h3>
                        </div>
                        <div class="credential-content">
                            <p><strong>Username:</strong> Any Director ID (DIR001, DIRECTOR, etc.)</p>
                            <p><strong>Password:</strong> <code>director123</code></p>
                            <div class="credential-roles">
                                <span>Director General</span>
                                <span>Director Academics</span>
                                <span>Director ICT</span>
                                <span>Director Finance</span>
                            </div>
                        </div>
                    </div>

                    <!-- Principal -->
                    <div class="credential-card staff-card">
                        <div class="credential-header">
                            <i class="fas fa-user-graduate"></i>
                            <h3>Principal Office</h3>
                        </div>
                        <div class="credential-content">
                            <p><strong>Username:</strong> Any Principal ID (PRINCIPAL, PRIN001, etc.)</p>
                            <p><strong>Password:</strong> <code>principal123</code></p>
                            <div class="credential-roles">
                                <span>Principal</span>
                                <span>Deputy Principal</span>
                            </div>
                        </div>
                    </div>

                    <!-- School Accountant -->
                    <div class="credential-card staff-card">
                        <div class="credential-header">
                            <i class="fas fa-coins"></i>
                            <h3>School Accountant</h3>
                        </div>
                        <div class="credential-content">
                            <p><strong>Username:</strong> Any Accountant ID (BURSAR, BUR001, ACCOUNTANT, etc.)</p>
                            <p><strong>Password:</strong> <code>bursar123</code></p>
                            <div class="credential-roles">
                                <span>School Bursar / Accountant</span>
                                <span>Accounts Assistant</span>
                                <span>Finance Officer</span>
                            </div>
                        </div>
                    </div>

                    <!-- Administrative Staff -->
                    <div class="credential-card staff-card">
                        <div class="credential-header">
                            <i class="fas fa-users-cog"></i>
                            <h3>Administrative Staff</h3>
                        </div>
                        <div class="credential-content">
                            <p><strong>Username:</strong> Any Admin ID (ADMIN, ADMIN001, REGISTRAR, etc.)</p>
                            <p><strong>Password:</strong> <code>admin123</code></p>
                            <div class="credential-roles">
                                <span>Academic Registrar</span>
                                <span>HR Manager</span>
                                <span>Secretary</span>
                                <span>Librarian</span>
                            </div>
                        </div>
                    </div>

                    <!-- Academic Staff -->
                    <div class="credential-card staff-card">
                        <div class="credential-header">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <h3>Academic Staff</h3>
                        </div>
                        <div class="credential-content">
                            <p><strong>Username:</strong> Any Lecturer ID (LECTURER, LEC001, TEACHER, etc.)</p>
                            <p><strong>Password:</strong> <code>lecturer123</code></p>
                            <div class="credential-roles">
                                <span>Head Nursing</span>
                                <span>Head Midwifery</span>
                                <span>Senior Lecturers</span>
                                <span>Lecturers</span>
                                <span>Clinical Instructors</span>
                                <span>Tutors</span>
                            </div>
                        </div>
                    </div>

                    <!-- Support Staff -->
                    <div class="credential-card staff-card">
                        <div class="credential-header">
                            <i class="fas fa-hands-helping"></i>
                            <h3>Support Staff</h3>
                        </div>
                        <div class="credential-content">
                            <p><strong>Username:</strong> Any Support ID (SUPPORT, SUP001, MATRON, etc.)</p>
                            <p><strong>Password:</strong> <code>support123</code></p>
                            <div class="credential-roles">
                                <span>Matron 1, 2, 3</span>
                                <span>Warden</span>
                                <span>Lab Technicians</span>
                                <span>Drivers</span>
                                <span>Cooks</span>
                                <span>Cleaners</span>
                            </div>
                        </div>
                    </div>

                    <!-- Students -->
                    <div class="credential-card student-card">
                        <div class="credential-header">
                            <i class="fas fa-user-graduate"></i>
                            <h3>Students</h3>
                        </div>
                        <div class="credential-content">
                            <p><strong>Username:</strong> Any Student ID (STUDENT, STU001, 2024/001, etc.)</p>
                            <p><strong>Password:</strong> <code>student123</code></p>
                            <div class="credential-roles">
                                <span>All Students</span>
                                <span>Guild President</span>
                                <span>Class Representatives</span>
                                <span>Club Leaders</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="guide-instructions">
                    <div class="instruction-card">
                        <h4><i class="fas fa-info-circle"></i> How to Login</h4>
                        <ol>
                            <li>Find your role/position in the sections above</li>
                            <li>Go to your specific login section</li>
                            <li>Enter any valid ID/Username for your role</li>
                            <li>Use the password shown for your role type</li>
                            <li>Click "Access Dashboard" to login</li>
                        </ol>
                    </div>
                    <div class="instruction-card">
                        <h4><i class="fas fa-lightbulb"></i> Quick Tips</h4>
                        <ul>
                            <li>You can use any username/ID - only password matters</li>
                            <li>Each role type has a unique password</li>
                            <li>Make sure to select the correct login section</li>
                            <li>Contact support if you have login issues</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
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
        const navLinks = document.querySelector('.nav-links');
        
        if (mobileMenuToggle && navLinks) {
            mobileMenuToggle.addEventListener('click', function() {
                navLinks.style.display = navLinks.style.display === 'flex' ? 'none' : 'flex';
                mobileMenuToggle.classList.toggle('active');
            });
        }

        // Password toggle functionality
        document.querySelectorAll('.password-toggle').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.parentElement.querySelector('input');
                const icon = this.querySelector('i');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });

        // Dashboard Mapping for Role-Specific Access
        const dashboardMap = {
            'director': 'dashboard-director.php',
            'principal': 'dashboard-principal.php',
            'bursar': 'dashboard-bursar.php',
            'admin': 'dashboard-admin.php',
            'lecturer': 'dashboard-lecturer.php',
            'support': 'dashboard-support.php',
            'student': 'dashboard-student.php'
        };

        // Role Display Names
        const roleNames = {
            'director': 'Director',
            'principal': 'Principal',
            'bursar': 'School Accountant',
            'admin': 'Administrative Staff',
            'lecturer': 'Academic Staff',
            'support': 'Support Staff',
            'student': 'Student'
        };

        // Form validation and submission
        document.querySelectorAll('.login-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const username = this.querySelector('input[name="username"]').value;
                const password = this.querySelector('input[name="password"]').value;
                const userType = this.querySelector('input[name="user_type"]').value;
                
                if (!username || !password) {
                    e.preventDefault();
                    alert('Please fill in all fields');
                    return;
                }
                
                // Show loading state
                const submitButton = this.querySelector('.login-button');
                const originalText = submitButton.innerHTML;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Signing In...';
                submitButton.disabled = true;
                
                // Form will submit to login.php for authentication
                // login.php will handle the redirect to appropriate dashboard
            });
        });

        // Enhanced Organogram click handler with role-specific routing
        function handleOrgClick(role) {
            // Add visual feedback
            event.currentTarget.style.transform = 'scale(0.95)';
            
            setTimeout(() => {
                event.currentTarget.style.transform = '';
                
                const dashboardUrl = dashboardMap[role];
                const roleName = roleNames[role];
                
                if (dashboardUrl) {
                    // Redirect to the appropriate dashboard
                    window.location.href = dashboardUrl;
                } else {
                    alert('Invalid role. Please contact system administrator.');
                }
            }, 200);
        }

        // Add input focus effects
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');
            });
        });

        // Smooth scroll for navigation
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
    </script>
</body>
</html>
