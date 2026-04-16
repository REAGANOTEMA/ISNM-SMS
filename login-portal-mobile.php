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
    <title>ISNM - Department Login Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--light-green) 50%, var(--creamy-yellow) 100%);
            min-height: 100vh;
            color: var(--text-dark);
            line-height: 1.6;
            position: relative;
            overflow-x: hidden;
        }

        .mobile-container {
            max-width: 100%;
            margin: 0;
            padding: 0;
            background: rgba(255, 255, 255, 0.95);
            min-height: 100vh;
        }

        .header {
            background: var(--gradient-primary);
            color: white;
            padding: 2rem 1rem;
            text-align: center;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: pulse 4s ease-in-out infinite;
        }

        .school-logo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: 0 auto 1rem;
            box-shadow: var(--shadow-lg);
            border: 3px solid white;
            position: relative;
            z-index: 1;
        }

        .header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .header p {
            font-size: 1rem;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .department-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
            padding: 1rem;
            margin-bottom: 2rem;
        }

        .department-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            border: 2px solid transparent;
        }

        .department-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }

        .department-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-xl);
            border-color: var(--primary-blue);
        }

        .department-card.admin {
            border-left: 4px solid var(--primary-blue);
        }

        .department-card.lecturer {
            border-left: 4px solid var(--mint-green);
        }

        .department-card.student {
            border-left: 4px solid var(--warm-yellow);
        }

        .department-card.support {
            border-left: 4px solid var(--secondary-blue);
        }

        .department-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .department-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            flex-shrink: 0;
        }

        .department-icon.admin {
            background: var(--gradient-primary);
        }

        .department-icon.lecturer {
            background: var(--gradient-secondary);
        }

        .department-icon.student {
            background: var(--gradient-tertiary);
        }

        .department-icon.support {
            background: linear-gradient(135deg, var(--secondary-blue), var(--accent-blue));
        }

        .department-info h3 {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
            color: var(--text-dark);
        }

        .department-info p {
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .department-roles {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .role-item {
            background: var(--light-gray);
            border-radius: 8px;
            padding: 0.75rem;
            text-align: center;
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--text-dark);
            transition: all 0.2s ease;
        }

        .role-item:hover {
            background: var(--soft-gray);
            transform: translateY(-2px);
        }

        .role-icon {
            display: block;
            font-size: 1.2rem;
            margin-bottom: 0.25rem;
            color: var(--primary-blue);
        }

        .quick-login {
            padding: 1rem;
            background: linear-gradient(135deg, var(--light-gray), white);
            margin: 1rem;
            border-radius: 16px;
            box-shadow: var(--shadow-sm);
        }

        .quick-login h3 {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-align: center;
            color: var(--text-dark);
        }

        .role-buttons {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.75rem;
        }

        .role-btn {
            padding: 1rem;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .role-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.6s ease;
        }

        .role-btn:hover::before {
            left: 100%;
        }

        .role-btn:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
        }

        .role-btn.admin {
            background: var(--gradient-primary);
        }

        .role-btn.lecturer {
            background: var(--gradient-secondary);
        }

        .role-btn.student {
            background: var(--gradient-tertiary);
        }

        .role-btn.support {
            background: linear-gradient(135deg, var(--secondary-blue), var(--accent-blue));
        }

        .footer {
            background: var(--gradient-primary);
            color: white;
            padding: 2rem 1rem;
            text-align: center;
            margin-top: auto;
        }

        .footer-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .footer-subtitle {
            font-size: 0.9rem;
            margin-bottom: 1rem;
            opacity: 0.9;
        }

        .contact-buttons {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .whatsapp-btn {
            padding: 0.75rem 1.5rem;
            background: linear-gradient(145deg, #25d366, #128c7e);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-md);
        }

        .whatsapp-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 0.3;
            }
            50% {
                opacity: 0.6;
            }
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

        .department-card {
            animation: fadeIn 0.6s ease-out;
        }

        .department-card:nth-child(1) { animation-delay: 0.1s; }
        .department-card:nth-child(2) { animation-delay: 0.2s; }
        .department-card:nth-child(3) { animation-delay: 0.3s; }
        .department-card:nth-child(4) { animation-delay: 0.4s; }

        @media (max-width: 480px) {
            .header h1 {
                font-size: 1.5rem;
            }

            .department-header {
                flex-direction: column;
                text-align: center;
            }

            .department-icon {
                margin: 0 auto 0.5rem;
            }

            .role-buttons {
                grid-template-columns: 1fr;
            }

            .department-roles {
                grid-template-columns: 1fr;
            }
        }

        @media (min-width: 768px) {
            .department-grid {
                grid-template-columns: repeat(2, 1fr);
                padding: 2rem;
            }

            .role-buttons {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .department-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .mobile-container {
                max-width: 1200px;
                margin: 0 auto;
                border-radius: 20px;
                margin-top: 2rem;
                margin-bottom: 2rem;
                overflow: hidden;
                box-shadow: var(--shadow-xl);
            }
        }
    </style>
</head>
<body>
    <div class="mobile-container">
        <header class="header">
            <img src="assets/school-logo.png" alt="ISNM Logo" class="school-logo">
            <h1>Iganga School of Nursing & Midwifery</h1>
            <p>Department Login Portal</p>
        </header>

        <div class="quick-login">
            <h3>Quick Access</h3>
            <div class="role-buttons">
                <a href="login.php?role=admin" class="role-btn admin">
                    <i class="fas fa-user-shield"></i> Admin
                </a>
                <a href="login.php?role=lecturer" class="role-btn lecturer">
                    <i class="fas fa-chalkboard-teacher"></i> Lecturer
                </a>
                <a href="login.php?role=student" class="role-btn student">
                    <i class="fas fa-user-graduate"></i> Student
                </a>
                <a href="login.php?role=support" class="role-btn support">
                    <i class="fas fa-tools"></i> Support
                </a>
            </div>
        </div>

        <div class="department-grid">
            <div class="department-card admin" onclick="handleSectionClick('director')">
                <div class="department-header">
                    <div class="department-icon admin">
                        <i class="fas fa-crown"></i>
                    </div>
                    <div class="department-info">
                        <h3>Director's Office</h3>
                        <p>Institutional Leadership</p>
                    </div>
                </div>
                <div class="department-roles">
                    <div class="role-item">
                        <i class="fas fa-user-tie role-icon"></i>
                        School Director
                    </div>
                </div>
            </div>

            <div class="department-card admin" onclick="handleSectionClick('board')">
                <div class="department-header">
                    <div class="department-icon admin">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="department-info">
                        <h3>Board of Governors</h3>
                        <p>Governance & Oversight</p>
                    </div>
                </div>
                <div class="department-roles">
                    <div class="role-item">
                        <i class="fas fa-user-tie role-icon"></i>
                        Board Chairman
                    </div>
                    <div class="role-item">
                        <i class="fas fa-users role-icon"></i>
                        Board Members
                    </div>
                </div>
            </div>

            <div class="department-card admin" onclick="handleSectionClick('management')">
                <div class="department-header">
                    <div class="department-icon admin">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="department-info">
                        <h3>Top Management</h3>
                        <p>Executive Administration</p>
                    </div>
                </div>
                <div class="department-roles">
                    <div class="role-item">
                        <i class="fas fa-user-tie role-icon"></i>
                        Principal
                    </div>
                    <div class="role-item">
                        <i class="fas fa-user-tie role-icon"></i>
                        Deputy Principal
                    </div>
                </div>
            </div>

            <div class="department-card lecturer" onclick="handleSectionClick('academic-registrar')">
                <div class="department-header">
                    <div class="department-icon lecturer">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="department-info">
                        <h3>Academic Registrar</h3>
                        <p>Academic Administration</p>
                    </div>
                </div>
                <div class="department-roles">
                    <div class="role-item">
                        <i class="fas fa-user-tie role-icon"></i>
                        Academic Registrar
                    </div>
                    <div class="role-item">
                        <i class="fas fa-file-alt role-icon"></i>
                        Records Officer
                    </div>
                </div>
            </div>

            <div class="department-card lecturer" onclick="handleSectionClick('academic')">
                <div class="department-header">
                    <div class="department-icon lecturer">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="department-info">
                        <h3>Academic Heads</h3>
                        <p>Department Leadership</p>
                    </div>
                </div>
                <div class="department-roles">
                    <div class="role-item">
                        <i class="fas fa-user-tie role-icon"></i>
                        Head of Department
                    </div>
                    <div class="role-item">
                        <i class="fas fa-clipboard role-icon"></i>
                        Program Coordinators
                    </div>
                </div>
            </div>

            <div class="department-card lecturer" onclick="handleSectionClick('staff')">
                <div class="department-header">
                    <div class="department-icon lecturer">
                        <i class="fas fa-chalkboard"></i>
                    </div>
                    <div class="department-info">
                        <h3>Academic Staff</h3>
                        <p>Teaching Faculty</p>
                    </div>
                </div>
                <div class="department-roles">
                    <div class="role-item">
                        <i class="fas fa-user role-icon"></i>
                        Lecturers
                    </div>
                    <div class="role-item">
                        <i class="fas fa-user-graduate role-icon"></i>
                        Tutors
                    </div>
                </div>
            </div>

            <div class="department-card student" onclick="handleSectionClick('student-affairs')">
                <div class="department-header">
                    <div class="department-icon student">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="department-info">
                        <h3>Student Affairs</h3>
                        <p>Student Welfare Services</p>
                    </div>
                </div>
                <div class="department-roles">
                    <div class="role-item">
                        <i class="fas fa-user-tie role-icon"></i>
                        Dean of Students
                    </div>
                    <div class="role-item">
                        <i class="fas fa-hands-helping role-icon"></i>
                        Counselors
                    </div>
                </div>
            </div>

            <div class="department-card student" onclick="handleSectionClick('representation')">
                <div class="department-header">
                    <div class="department-icon student">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="department-info">
                        <h3>Student Representation</h3>
                        <p>Student Leadership</p>
                    </div>
                </div>
                <div class="department-roles">
                    <div class="role-item">
                        <i class="fas fa-crown role-icon"></i>
                        Guild President
                    </div>
                    <div class="role-item">
                        <i class="fas fa-users role-icon"></i>
                        Class Representatives
                    </div>
                </div>
            </div>

            <div class="department-card admin" onclick="handleSectionClick('accounts')">
                <div class="department-header">
                    <div class="department-icon admin">
                        <i class="fas fa-calculator"></i>
                    </div>
                    <div class="department-info">
                        <h3>Accounts Department</h3>
                        <p>Financial Management</p>
                    </div>
                </div>
                <div class="department-roles">
                    <div class="role-item">
                        <i class="fas fa-user-tie role-icon"></i>
                        School Accountant
                    </div>
                    <div class="role-item">
                        <i class="fas fa-money-bill role-icon"></i>
                        Finance Officer
                    </div>
                </div>
            </div>

            <div class="department-card support" onclick="handleSectionClick('security')">
                <div class="department-header">
                    <div class="department-icon support">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="department-info">
                        <h3>Security Department</h3>
                        <p>Campus Safety & Security</p>
                    </div>
                </div>
                <div class="department-roles">
                    <div class="role-item">
                        <i class="fas fa-user-tie role-icon"></i>
                        Security Officer
                    </div>
                    <div class="role-item">
                        <i class="fas fa-shield-alt role-icon"></i>
                        Security Guards
                    </div>
                </div>
            </div>

            <div class="department-card support" onclick="handleSectionClick('kitchen')">
                <div class="department-header">
                    <div class="department-icon support">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <div class="department-info">
                        <h3>Kitchen Department</h3>
                        <p>Food Services</p>
                    </div>
                </div>
                <div class="department-roles">
                    <div class="role-item">
                        <i class="fas fa-user-tie role-icon"></i>
                        Head Chef
                    </div>
                    <div class="role-item">
                        <i class="fas fa-utensils role-icon"></i>
                        Kitchen Staff
                    </div>
                </div>
            </div>

            <div class="department-card support" onclick="handleSectionClick('gardening')">
                <div class="department-header">
                    <div class="department-icon support">
                        <i class="fas fa-tree"></i>
                    </div>
                    <div class="department-info">
                        <h3>Gardening Department</h3>
                        <p>Grounds Maintenance</p>
                    </div>
                </div>
                <div class="department-roles">
                    <div class="role-item">
                        <i class="fas fa-user-tie role-icon"></i>
                        Head Gardener
                    </div>
                    <div class="role-item">
                        <i class="fas fa-seedling role-icon"></i>
                        Gardeners
                    </div>
                </div>
            </div>

            <div class="department-card support" onclick="handleSectionClick('cleaning')">
                <div class="department-header">
                    <div class="department-icon support">
                        <i class="fas fa-broom"></i>
                    </div>
                    <div class="department-info">
                        <h3>Cleaning Department</h3>
                        <p>Facility Hygiene</p>
                    </div>
                </div>
                <div class="department-roles">
                    <div class="role-item">
                        <i class="fas fa-user-tie role-icon"></i>
                        Head Cleaner
                    </div>
                    <div class="role-item">
                        <i class="fas fa-mop role-icon"></i>
                        Cleaning Staff
                    </div>
                </div>
            </div>

            <div class="department-card support" onclick="handleSectionClick('tailoring')">
                <div class="department-header">
                    <div class="department-icon support">
                        <i class="fas fa-cutting"></i>
                    </div>
                    <div class="department-info">
                        <h3>Tailoring Department</h3>
                        <p>Uniform Production</p>
                    </div>
                </div>
                <div class="department-roles">
                    <div class="role-item">
                        <i class="fas fa-user-tie role-icon"></i>
                        Head Tailor
                    </div>
                    <div class="role-item">
                        <i class="fas fa-tshirt role-icon"></i>
                        Tailors
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <h3 class="footer-title">Designed and Developed by Reagan Otema</h3>
            <p class="footer-subtitle">For system errors, contact via WhatsApp</p>
            <div class="contact-buttons">
                <a href="https://wa.me/256772514889" target="_blank" class="whatsapp-btn">
                    <i class="fab fa-whatsapp"></i> MTN: +256772514889
                </a>
                <a href="https://wa.me/256730314979" target="_blank" class="whatsapp-btn">
                    <i class="fab fa-whatsapp"></i> Airtel: +256730314979
                </a>
            </div>
        </footer>
    </div>

    <script>
        function handleSectionClick(section) {
            // Define department to role mapping
            const departmentRoles = {
                'director': 'admin',
                'board': 'admin', 
                'management': 'admin',
                'academic-registrar': 'lecturer',
                'academic': 'lecturer',
                'staff': 'lecturer',
                'student-affairs': 'student',
                'representation': 'student',
                'support': 'support',
                'security': 'support',
                'kitchen': 'support',
                'gardening': 'support',
                'cleaning': 'support',
                'tailoring': 'support',
                'accounts': 'admin'
            };
            
            // Get role for this department
            const role = departmentRoles[section] || 'admin';
            
            // Redirect to login page with specific role and department
            window.location.href = `login.php?role=${role}&department=${section}`;
        }

        // Add touch feedback for mobile
        document.querySelectorAll('.department-card, .role-btn').forEach(element => {
            element.addEventListener('touchstart', function() {
                this.style.transform = 'scale(0.98)';
            });
            
            element.addEventListener('touchend', function() {
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });

        // Add loading animation
        document.querySelectorAll('.department-card').forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                card.style.transition = 'all 0.6s ease-out';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    </script>
</body>
</html>


