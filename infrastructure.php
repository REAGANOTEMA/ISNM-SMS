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
    <title>Infrastructure - Iganga School of Nursing and Midwifery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Inter:wght@300;400;500;600;700&family=Copperplate+Gothic+Bold&family=Rockwell+Extra+Bold&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-blue: #1e3a8a;
            --secondary-blue: #3730a3;
            --accent-blue: #3b82f6;
            --light-green: #22c55e;
            --creamy-yellow: #fef3c7;
            --golden-yellow: #fbbf24;
            --neon-cyan: #06b6d4;
            --clean-white: #ffffff;
            --cream-white: #fafafa;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --shadow-sm: 0 4px 8px rgba(0, 0, 0, 0.15);
            --shadow-md: 0 8px 16px rgba(0, 0, 0, 0.2);
            --shadow-xl: 0 32px 64px rgba(0, 0, 0, 0.3);
            --border-color: #e2e8f0;
            --gradient-primary: linear-gradient(135deg, #1e3a8a 0%, #3730a3 25%, #3b82f6 50%, #06b6d4 75%, #22c55e 100%);
            --gradient-hero: linear-gradient(135deg, #1e3a8a 0%, #3730a3 33%, #3b82f6 66%, #06b6d4 100%);
            --gradient-luxury: linear-gradient(135deg, #fbbf24 0%, #f59e0b 50%, #d97706 100%);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--cream-white), var(--clean-white));
            color: var(--text-primary);
            line-height: 1.6;
            overflow-x: hidden;
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

        /* Infrastructure Overview */
        .infrastructure-overview {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            margin-bottom: 3rem;
            text-align: center;
        }

        .overview-text {
            font-size: 1.2rem;
            line-height: 1.8;
            color: var(--text-primary);
            margin-bottom: 2rem;
        }

        /* Facilities Grid */
        .facilities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .facility-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            position: relative;
        }

        .facility-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-xl);
        }

        .facility-image {
            height: 200px;
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
            position: relative;
            overflow: hidden;
        }

        .facility-image::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 15s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .facility-content {
            padding: 2rem;
        }

        .facility-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }

        .facility-description {
            color: var(--text-primary);
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .facility-specs {
            background: rgba(30, 58, 138, 0.05);
            border-radius: 10px;
            padding: 1.5rem;
        }

        .spec-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .spec-item:last-child {
            border-bottom: none;
        }

        .spec-icon {
            width: 40px;
            height: 40px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .spec-text {
            color: var(--text-primary);
            font-weight: 500;
        }

        /* Utilities Section */
        .utilities-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            margin-bottom: 3rem;
        }

        .utilities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .utility-card {
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.05), rgba(55, 48, 163, 0.05));
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .utility-card::before {
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

        .utility-card:hover::before {
            opacity: 1;
        }

        .utility-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-xl);
        }

        .utility-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            box-shadow: 0 0 20px rgba(30, 58, 138, 0.3);
            position: relative;
            z-index: 1;
        }

        .utility-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .utility-description {
            color: var(--text-primary);
            font-size: 1.1rem;
            line-height: 1.6;
            position: relative;
            z-index: 1;
        }

        .utility-stats {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 1.5rem;
            position: relative;
            z-index: 1;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--accent-blue);
            display: block;
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        /* Transport Section */
        .transport-section {
            background: var(--gradient-primary);
            color: white;
            border-radius: 20px;
            padding: 3rem;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        .transport-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        .transport-content {
            position: relative;
            z-index: 1;
        }

        .transport-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
        }

        .transport-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .transport-item {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .transport-item:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
        }

        .transport-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .transport-name {
            font-weight: 600;
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
        }

        .transport-description {
            opacity: 0.9;
            line-height: 1.6;
        }

        /* Security Section */
        .security-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
        }

        .security-features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .security-feature {
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.05), rgba(55, 48, 163, 0.05));
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .security-feature:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .security-icon {
            width: 70px;
            height: 70px;
            background: var(--gradient-luxury);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.8rem;
            margin: 0 auto 1.5rem;
        }

        .security-title {
            font-weight: 600;
            color: var(--primary-blue);
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .security-description {
            color: var(--text-primary);
            line-height: 1.6;
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
            
            .facilities-grid {
                grid-template-columns: 1fr;
            }
            
            .utilities-grid {
                grid-template-columns: 1fr;
            }
            
            .transport-grid {
                grid-template-columns: 1fr;
            }
            
            .security-features {
                grid-template-columns: 1fr;
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
                    <img src="public/isnm-logo.jpeg" alt="ISNM Logo" class="logo">
                    <div>
                        <h1 style="font-family: 'Copperplate Gothic Bold', 'Rockwell Extra Bold', serif; font-size: 1.2rem; font-weight: 900;">ISNM</h1>
                        <p style="font-size: 0.8rem; opacity: 0.9;">Excellence in Healthcare Education</p>
                    </div>
                </div>
                <ul class="nav-links">
                    <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="about.php"><i class="fas fa-info-circle"></i> About</a></li>
                    <li><a href="programs.php"><i class="fas fa-graduation-cap"></i> Programs</a></li>
                    <li><a href="infrastructure.php"><i class="fas fa-building"></i> Infrastructure</a></li>
                    <li><a href="admissions.php"><i class="fas fa-user-plus"></i> Admissions</a></li>
                    <li><a href="contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
                    <li><a href="login-portal.php"><i class="fas fa-sign-in-alt"></i> Portal</a></li>
                </ul>
            </nav>
            <div class="page-title">School Infrastructure</div>
            <div class="breadcrumb">
                <p>Home / Facilities / Infrastructure</p>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Infrastructure Overview -->
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">6.0 Infrastructure</h2>
                <p class="section-subtitle">State-of-the-art facilities designed for excellence in healthcare education</p>
            </div>
            
            <div class="infrastructure-overview">
                <p class="overview-text">
                    The school has made remarkable infrastructural development in the past year, 
                    creating an environment conducive to learning, practical training, and student welfare.
                </p>
            </div>
        </section>

        <!-- Facilities Grid -->
        <section class="section">
            <div class="facilities-grid">
                <!-- Multi-Purpose Hall -->
                <div class="facility-card">
                    <div class="facility-image">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="facility-content">
                        <h3 class="facility-title">Multi-Purpose Hall</h3>
                        <p class="facility-description">
                            A versatile space that can accommodate 300 students and is used to conduct 
                            internal and external exams as well as student recreational and entertainment activities.
                        </p>
                        <div class="facility-specs">
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="spec-text">Capacity: 300 students</div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fas fa-clipboard-check"></i>
                                </div>
                                <div class="spec-text">Examination Center</div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fas fa-music"></i>
                                </div>
                                <div class="spec-text">Entertainment Venue</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kitchen & Dining Hall -->
                <div class="facility-card">
                    <div class="facility-image">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <div class="facility-content">
                        <h3 class="facility-title">Kitchen & Dining Hall</h3>
                        <p class="facility-description">
                            A complete kitchen and food store in a permanent structure, connected to the main hall, 
                            where students sit for their meals.
                        </p>
                        <div class="facility-specs">
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fas fa-store"></i>
                                </div>
                                <div class="spec-text">Food Storage Facility</div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fas fa-wheat"></i>
                                </div>
                                <div class="spec-text">Modern Kitchen Equipment</div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fas fa-chair"></i>
                                </div>
                                <div class="spec-text">Dining Area</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Classrooms -->
                <div class="facility-card">
                    <div class="facility-image">
                        <i class="fas fa-chalkboard"></i>
                    </div>
                    <div class="facility-content">
                        <h3 class="facility-title">Classrooms</h3>
                        <p class="facility-description">
                            Six complete and permanent classrooms, each accommodating 60 well-seated students 
                            for optimal learning environment.
                        </p>
                        <div class="facility-specs">
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fas fa-door-open"></i>
                                </div>
                                <div class="spec-text">6 Classrooms</div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="spec-text">60 Students per classroom</div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fas fa-chair"></i>
                                </div>
                                <div class="spec-text">Comfortable Seating</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Computer Laboratory -->
                <div class="facility-card">
                    <div class="facility-image">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <div class="facility-content">
                        <h3 class="facility-title">Computer Laboratory</h3>
                        <p class="facility-description">
                            A modern computer laboratory with 60 functional computers and two Computer Instructors 
                            who assist students with both theoretical and practical computer knowledge.
                        </p>
                        <div class="facility-specs">
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fas fa-desktop"></i>
                                </div>
                                <div class="spec-text">60 Computers</div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </div>
                                <div class="spec-text">2 Computer Instructors</div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fas fa-wifi"></i>
                                </div>
                                <div class="spec-text">Full Internet Access</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Utilities Section -->
        <section class="section">
            <div class="utilities-section">
                <div class="section-header">
                    <h2 class="section-title">7.0 Utilities</h2>
                    <p class="section-subtitle">Essential utilities supporting daily operations and student life</p>
                </div>
                
                <div class="utilities-grid">
                    <!-- Water Supply -->
                    <div class="utility-card">
                        <div class="utility-icon">
                            <i class="fas fa-tint"></i>
                        </div>
                        <h3 class="utility-title">Water Supply</h3>
                        <p class="utility-description">
                            The school has adequate water supplies from multiple sources ensuring constant availability.
                        </p>
                        <div class="utility-stats">
                            <div class="stat-item">
                                <span class="stat-number">3</span>
                                <span class="stat-label">Boreholes</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">2</span>
                                <span class="stat-label">Water Tanks</span>
                            </div>
                        </div>
                    </div>

                    <!-- Power Supply -->
                    <div class="utility-card">
                        <div class="utility-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h3 class="utility-title">Power Supply</h3>
                        <p class="utility-description">
                            Multiple power sources ensure constant electricity supply for all school operations.
                        </p>
                        <div class="utility-stats">
                            <div class="stat-item">
                                <span class="stat-number">3</span>
                                <span class="stat-label">Power Sources</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">24/7</span>
                                <span class="stat-label">Availability</span>
                            </div>
                        </div>
                    </div>

                    <!-- Internet -->
                    <div class="utility-card">
                        <div class="utility-icon">
                            <i class="fas fa-globe"></i>
                        </div>
                        <h3 class="utility-title">Internet Services</h3>
                        <p class="utility-description">
                            Full-time internet services help students in research work and academic activities.
                        </p>
                        <div class="utility-stats">
                            <div class="stat-item">
                                <span class="stat-number">High</span>
                                <span class="stat-label">Speed</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">Campus</span>
                                <span class="stat-label">Coverage</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Transport Section -->
        <section class="section">
            <div class="transport-section">
                <div class="transport-content">
                    <h2 class="transport-title">8.0 Transport</h2>
                    <div class="transport-grid">
                        <div class="transport-item">
                            <div class="transport-icon">
                                <i class="fas fa-bus"></i>
                            </div>
                            <h3 class="transport-name">Coaster Buses</h3>
                            <p class="transport-description">
                                Two coaster buses used to transport students to and from practicum sites 
                                and other school functions held outside the school.
                            </p>
                        </div>
                        
                        <div class="transport-item">
                            <div class="transport-icon">
                                <i class="fas fa-truck"></i>
                            </div>
                            <h3 class="transport-name">Lorry</h3>
                            <p class="transport-description">
                                A lorry used for ferrying firewood, food items and at times construction materials 
                                for school maintenance and development.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Security Section -->
        <section class="section">
            <div class="security-section">
                <div class="section-header">
                    <h2 class="section-title">9.0 Security</h2>
                    <p class="section-subtitle">Comprehensive security measures for student and staff safety</p>
                </div>
                
                <div class="security-features">
                    <div class="security-feature">
                        <div class="security-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="security-title">Perimeter Fence</h3>
                        <p class="security-description">
                            The school is surrounded with a perimeter fence of chain link ensuring controlled access.
                        </p>
                    </div>
                    
                    <div class="security-feature">
                        <div class="security-icon">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <h3 class="security-title">Security Guards</h3>
                        <p class="security-description">
                            Five security guards operate day and night to ensure utmost security and safety.
                        </p>
                    </div>
                    
                    <div class="security-feature">
                        <div class="security-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h3 class="security-title">Police Collaboration</h3>
                        <p class="security-description">
                            Regular meetings with the police to equip students and staff with security prevention measures.
                        </p>
                    </div>
                    
                    <div class="security-feature">
                        <div class="security-icon">
                            <i class="fas fa-fire-extinguisher"></i>
                        </div>
                        <h3 class="security-title">Fire Safety</h3>
                        <p class="security-description">
                            Fire extinguishers are available in case of a fire outbreak for emergency response.
                        </p>
                    </div>
                    
                    <div class="security-feature">
                        <div class="security-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="security-title">Community Relations</h3>
                        <p class="security-description">
                            Cordial working relationship with the surrounding community for enhanced security.
                        </p>
                    </div>
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
