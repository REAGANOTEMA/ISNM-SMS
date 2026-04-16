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

// Get role from URL parameter
$role = $_GET['role'] ?? 'admin';
$department = $_GET['department'] ?? '';

// Define role configurations
$roles = [
    'admin' => [
        'title' => 'Administrator Login',
        'subtitle' => 'System Administration Access',
        'icon' => 'fas fa-user-shield',
        'color' => '#2563eb',
        'departments' => ['director', 'board', 'management', 'accounts']
    ],
    'lecturer' => [
        'title' => 'Lecturer Login',
        'subtitle' => 'Academic Staff Access',
        'icon' => 'fas fa-chalkboard-teacher',
        'color' => '#059669',
        'departments' => ['academic-registrar', 'academic', 'staff']
    ],
    'student' => [
        'title' => 'Student Login',
        'subtitle' => 'Student Portal Access',
        'icon' => 'fas fa-user-graduate',
        'color' => '#dc2626',
        'departments' => ['student-affairs', 'representation']
    ],
    'support' => [
        'title' => 'Support Staff Login',
        'subtitle' => 'Support Services Access',
        'icon' => 'fas fa-tools',
        'color' => '#ea580c',
        'departments' => ['support', 'security', 'kitchen', 'gardening', 'cleaning', 'tailoring']
    ]
];

// Get current role configuration
$current_role = $roles[$role] ?? $roles['admin'];

// Process login form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $login_role = $_POST['role'] ?? 'admin';
    $login_department = $_POST['department'] ?? '';
    
    $errors = [];
    
    // Validation
    if (empty($username)) {
        $errors[] = "Username is required";
    }
    
    if (empty($password)) {
        $errors[] = "Password is required";
    }
    
    if (empty($errors)) {
        // For demo purposes, accept any login
        // In production, this would validate against database
        $_SESSION['user'] = [
            'username' => $username,
            'role' => $login_role,
            'department' => $login_department,
            'login_time' => date('Y-m-d H:i:s')
        ];
        
        // Redirect based on department and role
        if ($login_department === 'director') {
            header('Location: dashboard-director.php');
        } elseif ($login_department === 'board') {
            header('Location: dashboard-board.php');
        } elseif ($login_department === 'management') {
            // Check if user is Principal or Deputy Principal based on username
            if (strpos(strtolower($username), 'principal') !== false || strpos(strtolower($username), 'admin') !== false) {
                header('Location: dashboard-principal.php');
            } else {
                header('Location: dashboard-deputy-principal.php');
            }
        } elseif ($login_department === 'academic-registrar') {
            header('Location: dashboard-academic-registrar.php');
        } elseif ($login_department === 'academic') {
            header('Location: dashboard-academic-heads.php');
        } elseif ($login_department === 'staff') {
            header('Location: dashboard-academic-staff.php');
        } elseif ($login_department === 'student-affairs') {
            header('Location: dashboard-student-affairs.php');
        } elseif ($login_department === 'representation') {
            header('Location: dashboard-representation.php');
        } elseif ($login_department === 'support') {
            header('Location: dashboard-support.php');
        } elseif ($login_department === 'security') {
            header('Location: dashboard-security.php');
        } elseif ($login_department === 'kitchen') {
            header('Location: dashboard-kitchen.php');
        } elseif ($login_department === 'gardening') {
            header('Location: dashboard-gardening.php');
        } elseif ($login_department === 'cleaning') {
            header('Location: dashboard-cleaning.php');
        } elseif ($login_department === 'tailoring') {
            header('Location: dashboard-tailoring.php');
        } elseif ($login_department === 'accounts') {
            header('Location: dashboard-accounts-enhanced.php');
        } elseif ($login_role === 'lecturer') {
            header('Location: dashboard-lecturer.php');
        } elseif ($login_role === 'student') {
            header('Location: dashboard-student.php');
        } elseif ($login_role === 'support') {
            header('Location: dashboard-support.php');
        } else {
            header('Location: dashboard-admin.php');
        }
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($current_role['title']); ?> - ISNM</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            position: relative;
            overflow-x: hidden;
        }

        .mobile-login-container {
            width: 100%;
            max-width: 400px;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: var(--shadow-xl);
            position: relative;
            overflow: hidden;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .mobile-login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
            position: relative;
            z-index: 1;
        }

        .school-logo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: 0 auto 1rem;
            box-shadow: var(--shadow-lg);
            border: 3px solid var(--primary-blue);
            display: block;
        }

        .role-icon {
            width: 70px;
            height: 70px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: white;
            margin: 0 auto 1.5rem;
            box-shadow: var(--shadow-md);
            position: relative;
            overflow: hidden;
        }

        .role-icon::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.3), transparent);
            animation: shine 3s ease-in-out infinite;
        }

        @keyframes shine {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            50% { transform: translateX(100%) translateY(100%) rotate(45deg); }
            100% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
        }

        .login-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .login-subtitle {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .department-info {
            background: linear-gradient(135deg, var(--creamy-yellow), var(--golden-yellow));
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            text-align: center;
            font-size: 0.85rem;
            color: var(--text-dark);
            font-weight: 500;
            box-shadow: var(--shadow-sm);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .form-input {
            width: 100%;
            padding: 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
            box-shadow: var(--shadow-sm);
        }

        .form-input:focus {
            outline: none;
            border-color: <?php echo $current_role['color']; ?>;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            transform: translateY(-2px);
        }

        .login-button {
            width: 100%;
            padding: 1rem;
            background: var(--gradient-primary);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-md);
        }

        .login-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.6s ease;
        }

        .login-button:hover::before {
            left: 100%;
        }

        .login-button:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
        }

        .login-button:active {
            transform: translateY(-1px);
        }

        .alert {
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-error {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            box-shadow: var(--shadow-md);
        }

        .role-selector {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .role-tab {
            padding: 0.75rem;
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.8rem;
            font-weight: 500;
            text-align: center;
            box-shadow: var(--shadow-sm);
        }

        .role-tab.active {
            background: var(--gradient-primary);
            color: white;
            border-color: var(--primary-blue);
            transform: scale(1.05);
            box-shadow: var(--shadow-md);
        }

        .role-tab:hover:not(.active) {
            border-color: var(--primary-blue);
            background: rgba(37, 99, 235, 0.1);
            transform: translateY(-2px);
        }

        .back-link {
            text-align: center;
            margin-top: 1.5rem;
        }

        .back-link a {
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .back-link a:hover {
            color: var(--secondary-blue);
            transform: translateX(-3px);
        }

        .footer {
            background: var(--gradient-primary);
            color: white;
            padding: 1.5rem;
            text-align: center;
            margin-top: 2rem;
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
        }

        .footer-title {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .footer-subtitle {
            font-size: 0.85rem;
            margin-bottom: 1rem;
            opacity: 0.9;
        }

        .contact-buttons {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .whatsapp-btn {
            padding: 0.75rem 1rem;
            background: linear-gradient(145deg, #25d366, #128c7e);
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
        }

        .whatsapp-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        @media (max-width: 480px) {
            .mobile-login-container {
                padding: 1.5rem;
                margin: 0.5rem;
            }

            .login-title {
                font-size: 1.4rem;
            }

            .role-selector {
                grid-template-columns: 1fr;
            }

            .school-logo {
                width: 60px;
                height: 60px;
            }

            .role-icon {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }
        }

        @media (min-width: 768px) {
            .mobile-login-container {
                max-width: 450px;
            }

            .role-selector {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .mobile-login-container {
                max-width: 500px;
                padding: 2.5rem;
            }
        }

        /* Touch feedback for mobile */
        .mobile-login-container * {
            -webkit-tap-highlight-color: transparent;
        }

        .login-button:active,
        .role-tab:active {
            transform: scale(0.98);
        }

        /* Loading animation */
        .loading {
            position: relative;
            overflow: hidden;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            animation: loading 1.5s ease-in-out infinite;
        }

        @keyframes loading {
            0% { left: -100%; }
            100% { left: 100%; }
        }
    </style>
</head>
<body>
    <div class="mobile-login-container">
        <div class="login-header">
            <img src="public/isnm-logo.jpeg" alt="ISNM Logo" class="school-logo">
            <div class="role-icon">
                <i class="<?php echo $current_role['icon']; ?>"></i>
            </div>
            <h1 class="login-title"><?php echo htmlspecialchars($current_role['title']); ?></h1>
            <p class="login-subtitle"><?php echo htmlspecialchars($current_role['subtitle']); ?></p>
        </div>

        <?php if ($department): ?>
            <div class="department-info">
                <i class="fas fa-building"></i> 
                <?php echo htmlspecialchars(ucwords(str_replace('-', ' ', $department))); ?> Department
            </div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-error">
                <?php foreach ($errors as $error): ?>
                    <div><?php echo htmlspecialchars($error); ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="hidden" name="role" value="<?php echo htmlspecialchars($role); ?>">
            <input type="hidden" name="department" value="<?php echo htmlspecialchars($department); ?>">
            
            <div class="form-group">
                <label class="form-label" for="username">
                    <i class="fas fa-user"></i> Username
                </label>
                <input 
                    type="text" 
                    id="username" 
                    name="username" 
                    class="form-input" 
                    placeholder="Enter your username"
                    value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label class="form-label" for="password">
                    <i class="fas fa-lock"></i> Password
                </label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-input" 
                    placeholder="Enter your password"
                    required
                >
            </div>

            <button type="submit" class="login-button">
                <i class="fas fa-sign-in-alt"></i> Sign In
            </button>
        </form>

        <div class="role-selector">
            <a href="login.php?role=admin" class="role-tab <?php echo $role === 'admin' ? 'active' : ''; ?>">
                <i class="fas fa-user-shield"></i> Admin
            </a>
            <a href="login.php?role=lecturer" class="role-tab <?php echo $role === 'lecturer' ? 'active' : ''; ?>">
                <i class="fas fa-chalkboard-teacher"></i> Lecturer
            </a>
            <a href="login.php?role=student" class="role-tab <?php echo $role === 'student' ? 'active' : ''; ?>">
                <i class="fas fa-user-graduate"></i> Student
            </a>
            <a href="login.php?role=support" class="role-tab <?php echo $role === 'support' ? 'active' : ''; ?>">
                <i class="fas fa-tools"></i> Support
            </a>
        </div>

        <div class="back-link">
            <a href="login-portal-mobile.php">
                <i class="fas fa-arrow-left"></i> Back to Departments
            </a>
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

    <script>
        // Auto-focus on username field
        document.addEventListener('DOMContentLoaded', function() {
            const usernameField = document.getElementById('username');
            if (usernameField) {
                usernameField.focus();
            }

            // Add loading state to form submission
            const form = document.querySelector('form');
            const submitButton = document.querySelector('.login-button');
            
            form.addEventListener('submit', function() {
                submitButton.classList.add('loading');
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Signing In...';
            });
        });

        // Add touch feedback for mobile
        document.querySelectorAll('.role-tab, .login-button').forEach(element => {
            element.addEventListener('touchstart', function() {
                this.style.transform = 'scale(0.95)';
            });
            
            element.addEventListener('touchend', function() {
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });

        // Add smooth transitions for role tabs
        document.querySelectorAll('.role-tab').forEach(tab => {
            tab.addEventListener('click', function(e) {
                // Add loading state
                this.style.opacity = '0.7';
                setTimeout(() => {
                    this.style.opacity = '1';
                }, 300);
            });
        });

        // Add input animations
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>


