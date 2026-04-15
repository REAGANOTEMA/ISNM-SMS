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
    <title>School History - Iganga School of Nursing and Midwifery</title>
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

        /* History Introduction */
        .history-intro {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            margin-bottom: 3rem;
            text-align: center;
        }

        .intro-text {
            font-size: 1.2rem;
            line-height: 1.8;
            color: var(--text-primary);
            margin-bottom: 2rem;
        }

        .founding-year {
            display: inline-block;
            background: var(--gradient-primary);
            color: white;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 1rem 0;
        }

        /* Timeline */
        .timeline-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            margin-bottom: 3rem;
        }

        .timeline {
            position: relative;
            padding: 2rem 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 4px;
            background: var(--gradient-primary);
            transform: translateX(-50%);
        }

        .timeline-item {
            position: relative;
            padding: 2rem 0;
            display: flex;
            align-items: center;
        }

        .timeline-item:nth-child(odd) {
            flex-direction: row-reverse;
        }

        .timeline-content {
            flex: 1;
            padding: 0 2rem;
        }

        .timeline-item:nth-child(odd) .timeline-content {
            text-align: right;
        }

        .timeline-date {
            background: var(--gradient-luxury);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 1rem;
            font-family: 'Playfair Display', serif;
        }

        .timeline-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }

        .timeline-description {
            color: var(--text-primary);
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .timeline-dot {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 20px;
            background: var(--golden-yellow);
            border: 4px solid var(--primary-blue);
            border-radius: 50%;
            z-index: 2;
        }

        /* Milestones */
        .milestones-section {
            background: var(--gradient-primary);
            color: white;
            border-radius: 20px;
            padding: 3rem;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        .milestones-section::before {
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

        .milestones-content {
            position: relative;
            z-index: 1;
        }

        .milestones-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
        }

        .milestones-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .milestone-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .milestone-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
        }

        .milestone-year {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--golden-yellow);
        }

        .milestone-title {
            font-weight: 600;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        .milestone-description {
            opacity: 0.9;
            line-height: 1.6;
        }

        /* Growth Section */
        .growth-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
        }

        .growth-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .growth-item {
            text-align: center;
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.05), rgba(55, 48, 163, 0.05));
            border-radius: 15px;
            padding: 2rem;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .growth-item:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .growth-number {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 900;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
            display: block;
        }

        .growth-label {
            color: var(--text-secondary);
            font-size: 1.1rem;
        }

        .growth-icon {
            width: 60px;
            height: 60px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin: 0 auto 1rem;
        }

        /* Vision Section */
        .vision-section {
            background: var(--gradient-luxury);
            color: white;
            border-radius: 20px;
            padding: 3rem;
            margin-top: 3rem;
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .vision-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 25s linear infinite;
        }

        .vision-content {
            position: relative;
            z-index: 1;
        }

        .vision-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
        }

        .vision-text {
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
            
            .timeline::before {
                left: 20px;
            }
            
            .timeline-item {
                flex-direction: column !important;
                padding-left: 60px;
            }
            
            .timeline-content {
                text-align: left !important;
                padding: 0;
            }
            
            .timeline-dot {
                left: 20px;
            }
            
            .milestones-grid {
                grid-template-columns: 1fr;
            }
            
            .growth-stats {
                grid-template-columns: repeat(2, 1fr);
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
                    <li><a href="history.php"><i class="fas fa-history"></i> History</a></li>
                    <li><a href="programs.php"><i class="fas fa-graduation-cap"></i> Programs</a></li>
                    <li><a href="admissions.php"><i class="fas fa-user-plus"></i> Admissions</a></li>
                    <li><a href="contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
                    <li><a href="login-portal.php"><i class="fas fa-sign-in-alt"></i> Portal</a></li>
                </ul>
            </nav>
            <div class="page-title">School History</div>
            <div class="breadcrumb">
                <p>Home / About / Our History</p>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- History Introduction -->
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">Our Journey Through Time</h2>
                <p class="section-subtitle">The remarkable story of Iganga School of Nursing and Midwifery</p>
            </div>
            
            <div class="history-intro">
                <p class="intro-text">
                    Founded with a vision to transform healthcare education in Uganda, Iganga School of Nursing and Midwifery 
                    has grown from humble beginnings to become a leading institution in nursing and midwifery training.
                </p>
                <div class="founding-year">Founded in 2009</div>
                <p class="intro-text">
                    From our initial cohort of 13 students to over 300 students today, our journey has been marked by 
                    continuous growth, academic excellence, and unwavering commitment to producing world-class healthcare professionals.
                </p>
            </div>
        </section>

        <!-- Timeline Section -->
        <section class="section">
            <div class="timeline-section">
                <div class="section-header">
                    <h3 class="section-title">Historical Timeline</h3>
                    <p class="section-subtitle">Key milestones in our development</p>
                </div>
                
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-date">2009</div>
                            <h4 class="timeline-title">The Beginning</h4>
                            <p class="timeline-description">
                                ISNM was founded with 13 pioneering students. The school was established by three founding members 
                                who formed the Board of Directors with a vision to provide quality healthcare education.
                            </p>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-date">2010-2012</div>
                            <h4 class="timeline-title">Early Growth</h4>
                            <p class="timeline-description">
                                Rapid expansion of student enrollment and development of basic infrastructure. 
                                Established partnerships with local hospitals for clinical training.
                            </p>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-date">2013-2015</div>
                            <h4 class="timeline-title">Academic Excellence</h4>
                            <p class="timeline-description">
                                Achieved remarkable results in national examinations with 100% pass rate in midwifery 
                                and over 85% in nursing programs. Expanded curriculum and facilities.
                            </p>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-date">2016-2018</div>
                            <h4 class="timeline-title">Infrastructure Development</h4>
                            <p class="timeline-description">
                                Construction of multi-purpose hall and first phase of girls' hostel. 
                                Acquisition of additional transportation and enhanced laboratory facilities.
                            </p>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-date">2019-2021</div>
                            <h4 class="timeline-title">Modernization</h4>
                            <p class="timeline-description">
                                Installation of solar panels and generators for reliable power supply. 
                                Separated and equipped skills laboratories for Nursing and Midwifery.
                            </p>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-date">2022-Present</div>
                            <h4 class="timeline-title">Digital Transformation</h4>
                            <p class="timeline-description">
                                Enhanced computer laboratory with 60 functional computers and full internet access. 
                                Implementation of modern management systems and expanded practicum partnerships.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Key Milestones -->
        <section class="section">
            <div class="milestones-section">
                <div class="milestones-content">
                    <h2 class="milestones-title">Key Milestones</h2>
                    <div class="milestones-grid">
                        <div class="milestone-card">
                            <div class="milestone-year">2009</div>
                            <h3 class="milestone-title">School Foundation</h3>
                            <p class="milestone-description">
                                Established with 13 students and 3 founding directors
                            </p>
                        </div>
                        
                        <div class="milestone-card">
                            <div class="milestone-year">2012</div>
                            <h3 class="milestone-title">First Graduation</h3>
                            <p class="milestone-description">
                                Celebrated first cohort of graduating nurses and midwives
                            </p>
                        </div>
                        
                        <div class="milestone-card">
                            <div class="milestone-year">2015</div>
                            <h3 class="milestone-title">MOES Registration</h3>
                            <p class="milestone-description">
                                Officially registered with Ministry of Education & Sports
                            </p>
                        </div>
                        
                        <div class="milestone-card">
                            <div class="milestone-year">2017</div>
                            <h3 class="milestone-title">UNMC Accreditation</h3>
                            <p class="milestone-description">
                                Full accreditation by Uganda Nurses and Midwives Council
                            </p>
                        </div>
                        
                        <div class="milestone-card">
                            <div class="milestone-year">2019</div>
                            <h3 class="milestone-title">Infrastructure Expansion</h3>
                            <p class="milestone-description">
                                Completion of multi-purpose hall and hostel facilities
                            </p>
                        </div>
                        
                        <div class="milestone-card">
                            <div class="milestone-year">2021</div>
                            <h3 class="milestone-title">Land Acquisition</h3>
                            <p class="milestone-description">
                                Acquired 12+ acres for future expansion and development
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Growth Statistics -->
        <section class="section">
            <div class="growth-section">
                <div class="section-header">
                    <h3 class="section-title">Growth Over the Years</h3>
                    <p class="section-subtitle">Our journey of expansion and development</p>
                </div>
                
                <div class="growth-stats">
                    <div class="growth-item">
                        <div class="growth-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <span class="growth-number">13</span>
                        <span class="growth-label">Students (2009)</span>
                    </div>
                    
                    <div class="growth-item">
                        <div class="growth-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <span class="growth-number">315+</span>
                        <span class="growth-label">Students (Current)</span>
                    </div>
                    
                    <div class="growth-item">
                        <div class="growth-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <span class="growth-number">4</span>
                        <span class="growth-label">Programs</span>
                    </div>
                    
                    <div class="growth-item">
                        <div class="growth-icon">
                            <i class="fas fa-hospital"></i>
                        </div>
                        <span class="growth-number">7</span>
                        <span class="growth-label">Practicum Sites</span>
                    </div>
                    
                    <div class="growth-item">
                        <div class="growth-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <span class="growth-number">6</span>
                        <span class="growth-label">Classrooms</span>
                    </div>
                    
                    <div class="growth-item">
                        <div class="growth-icon">
                            <i class="fas fa-desktop"></i>
                        </div>
                        <span class="growth-number">60</span>
                        <span class="growth-label">Computers</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Vision Section -->
        <section class="section">
            <div class="vision-section">
                <div class="vision-content">
                    <h2 class="vision-title">Looking Forward</h2>
                    <p class="vision-text">
                        As we continue our journey, we remain committed to our founding vision of producing world-class 
                        healthcare professionals. Our history has taught us the value of perseverance, quality education, 
                        and community service. We look forward to continuing our growth and making even greater contributions 
                        to healthcare in Uganda and beyond.
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

        // Animate timeline items on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.timeline-item').forEach(item => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(30px)';
            item.style.transition = 'all 0.6s ease';
            observer.observe(item);
        });
    </script>
</body>
</html>
