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

        /* Board of Directors */
        .board-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            margin-bottom: 3rem;
        }

        .board-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .board-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }

        .board-description {
            color: var(--text-secondary);
            font-size: 1.1rem;
            max-width: 800px;
            margin: 0 auto 2rem;
            line-height: 1.8;
        }

        .directors-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .director-card {
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.05), rgba(55, 48, 163, 0.05));
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            position: relative;
        }

        .director-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-xl);
            border-color: var(--accent-blue);
        }

        .director-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
            box-shadow: 0 0 20px rgba(30, 58, 138, 0.3);
        }

        .director-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
        }

        .director-title {
            color: var(--text-secondary);
            font-size: 1.1rem;
            font-style: italic;
        }

        /* Board Functions */
        .functions-list {
            background: rgba(30, 58, 138, 0.05);
            border-radius: 15px;
            padding: 2rem;
            margin-top: 2rem;
        }

        .function-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .function-item:last-child {
            border-bottom: none;
        }

        .function-icon {
            width: 40px;
            height: 40px;
            background: var(--gradient-luxury);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .function-text {
            font-size: 1.1rem;
            line-height: 1.6;
            color: var(--text-primary);
        }

        /* Board of Governors */
        .governors-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
        }

        .chairman-highlight {
            background: var(--gradient-primary);
            color: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 3rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .chairman-highlight::before {
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

        .chairman-name {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .chairman-title {
            font-size: 1.2rem;
            opacity: 0.9;
            position: relative;
            z-index: 1;
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

        /* Management Section */
        .management-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            text-align: center;
        }

        .principal-card {
            background: var(--gradient-primary);
            color: white;
            border-radius: 15px;
            padding: 3rem;
            margin-top: 2rem;
            position: relative;
            overflow: hidden;
        }

        .principal-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 25s linear infinite reverse;
        }

        .principal-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin: 0 auto 2rem;
            background: var(--gradient-luxury);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 4rem;
            box-shadow: 0 0 30px rgba(251, 191, 36, 0.5);
            position: relative;
            z-index: 1;
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
                    <li><a href="governance.php"><i class="fas fa-users"></i> Governance</a></li>
                    <li><a href="programs.php"><i class="fas fa-graduation-cap"></i> Programs</a></li>
                    <li><a href="admissions.php"><i class="fas fa-user-plus"></i> Admissions</a></li>
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
                        <div class="director-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <h4 class="director-name">Mr. Baliddawa David Byawaka</h4>
                        <p class="director-title">Member Board of Directors</p>
                    </div>
                    
                    <div class="director-card">
                        <div class="director-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <h4 class="director-name">Dr. Banonya Stephen</h4>
                        <p class="director-title">Member Board of Directors</p>
                    </div>
                    
                    <div class="director-card">
                        <div class="director-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <h4 class="director-name">Mrs. Mercy Byawaka</h4>
                        <p class="director-title">Member Board of Directors</p>
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
                    <h3 class="chairman-name">Mr. Naluwairo David Kigenyi</h3>
                    <p class="chairman-title">Chairman Governing Council</p>
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
                    <div class="principal-avatar">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h3 class="principal-name">Sr. Joyce C. Zirabamuzale</h3>
                    <p class="principal-title">Principal of the School</p>
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
