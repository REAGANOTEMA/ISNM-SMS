<?php
require_once 'config.php';

// Initialize session only if not already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Handle logout request
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}

// Check if user is already logged in
if (isset($_SESSION['user'])) {
    // Debug: Show user info
    if (isset($_GET['debug'])) {
        echo "<pre>";
        echo "User session data:\n";
        print_r($_SESSION['user']);
        echo "</pre>";
        echo "<a href='?logout=1'>Logout</a>";
        exit();
    }
    
    // Redirect to appropriate dashboard based on role
    $user_role = $_SESSION['user']['role'];
    if ($user_role === 'student') {
        header('Location: dashboard-student.php');
    } else {
        // For staff, redirect based on role directly
        redirectBasedOnPosition($user_role);
    }
    exit();
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Prevent multiple login submissions
    if (isset($_SESSION['login_attempt']) && $_SESSION['login_attempt'] > time() - 5) {
        $errors[] = "Please wait before trying again.";
    } else {
        $_SESSION['login_attempt'] = time();
        
        $username = trim(isset($_POST['username']) ? $_POST['username'] : '');
        $password = trim(isset($_POST['password']) ? $_POST['password'] : '');
        $user_type = isset($_POST['user_type']) ? $_POST['user_type'] : '';
        
        $errors = [];
    
    // Validation
    if (empty($username)) {
        $errors[] = "Username/ID is required";
    }
    
    if (empty($password)) {
        $errors[] = "Password is required";
    }
    
    if (empty($user_type)) {
        $errors[] = "User type is required";
    }
    
    if (empty($errors)) {
        // Try database authentication first, fallback to mock credentials
        $authenticated = false;
        
        try {
            // Check if database tables exist
            $stmt = $pdo->query("SHOW TABLES LIKE 'staff_users'");
            $tables_exist = $stmt->rowCount() > 0;
            
            if ($tables_exist && $user_type === 'staff') {
                // Staff authentication from database
                $stmt = $pdo->prepare("
                    SELECT su.*, p.position_name, d.department_name 
                    FROM staff_users su 
                    LEFT JOIN positions p ON su.position_id = p.id 
                    LEFT JOIN departments d ON su.department_id = d.id 
                    WHERE su.staff_id = ? AND su.status = 'active'
                ");
                $stmt->execute([$username]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($user && password_verify($password, $user['password'])) {
                    $authenticated = true;
                    $_SESSION['user'] = [
                        'id' => $user['staff_id'],
                        'username' => $user['staff_id'],
                        'name' => $user['first_name'] . ' ' . $user['last_name'],
                        'email' => $user['email'],
                        'role' => 'staff',
                        'position' => $user['position_name'],
                        'department' => $user['department_name'],
                        'login_time' => date('Y-m-d H:i:s')
                    ];
                    
                    // Log activity
                    logActivity($user['staff_id'], 'staff', 'LOGIN', 'Staff login successful');
                    
                    // Clear login attempt and redirect to appropriate dashboard
                    unset($_SESSION['login_attempt']);
                    $position_code = strtolower(str_replace(' ', '-', $user['position_name']));
                    redirectBasedOnPosition($position_code);
                    exit();
                }
            } elseif ($tables_exist && $user_type === 'student') {
                // Student authentication from database
                $stmt = $pdo->prepare("
                    SELECT s.*, p.program_name 
                    FROM students s 
                    LEFT JOIN programs p ON s.program_id = p.id 
                    WHERE s.student_id = ? AND s.status = 'active'
                ");
                $stmt->execute([$username]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($user && password_verify($password, $user['password'])) {
                    $authenticated = true;
                    $_SESSION['user'] = [
                        'id' => $user['student_id'],
                        'username' => $user['student_id'],
                        'name' => $user['first_name'] . ' ' . $user['last_name'],
                        'email' => $user['email'],
                        'role' => 'student',
                        'program' => $user['program_name'],
                        'year' => $user['academic_year'],
                        'login_time' => date('Y-m-d H:i:s')
                    ];
                    
                    // Log activity
                    logActivity($user['student_id'], 'student', 'LOGIN', 'Student login successful');
                    
                    // Clear login attempt and redirect to student dashboard
                    unset($_SESSION['login_attempt']);
                    header('Location: dashboard-student.php');
                    exit();
                }
            }
        } catch (PDOException $e) {
            // Database error, continue to mock authentication
            error_log("Database login error, falling back to mock auth: " . $e->getMessage());
        }
        
        // Fallback to mock credentials if database authentication failed
        if (!$authenticated) {
            // Mock user data for each individual position
            $mock_users = [
                // Executive Directors
                'director-general' => [
                    'valid_ids' => ['DIR001', 'DIRECTOR-GENERAL', 'DG', 'DIR-GEN'],
                    'password' => 'DG@ISNM2024',
                    'name' => 'Director General',
                    'dashboard' => 'dashboard-director-general.php'
                ],
                'director-academics' => [
                    'valid_ids' => ['DIR002', 'DIRECTOR-ACADEMICS', 'DA', 'DIR-ACAD'],
                    'password' => 'DA@ISNM2024',
                    'name' => 'Director of Academics',
                    'dashboard' => 'dashboard.php'
                ],
                'director-ict' => [
                    'valid_ids' => ['DIR003', 'DIRECTOR-ICT', 'DI', 'DIR-ICT'],
                    'password' => 'DI@ISNM2024',
                    'name' => 'Director of ICT',
                    'dashboard' => 'dashboard.php'
                ],
                'director-finance' => [
                    'valid_ids' => ['DIR004', 'DIRECTOR-FINANCE', 'DF', 'DIR-FIN'],
                    'password' => 'DF@ISNM2024',
                    'name' => 'Director of Finance',
                    'dashboard' => 'dashboard.php'
                ],
                
                // Principal Office
                'principal' => [
                    'valid_ids' => ['PRINCIPAL', 'PRIN001', 'PRIN', 'SCHOOL-PRINCIPAL'],
                    'password' => 'PRIN@ISNM2024',
                    'name' => 'School Principal',
                    'dashboard' => 'dashboard-principal.php'
                ],
                'deputy-principal' => [
                    'valid_ids' => ['DEPUTY', 'DEP001', 'DP', 'DEPUTY-PRINCIPAL'],
                    'password' => 'DP@ISNM2024',
                    'name' => 'Deputy Principal',
                    'dashboard' => 'dashboard.php'
                ],
                
                // Financial Management
                'school-bursar' => [
                    'valid_ids' => ['BURSAR', 'BUR001', 'SB', 'SCHOOL-BURSAR', 'Emurun123'],
                    'password' => 'BURSAR@ISNM2024',
                    'name' => 'School Bursar / Chief Accountant',
                    'dashboard' => 'dashboard-bursar.php'
                ],
                'accounts-assistant' => [
                    'valid_ids' => ['ACC-AST', 'ACC001', 'AA', 'ACCOUNTS-ASSISTANT'],
                    'password' => 'ACC@ISNM2024',
                    'name' => 'Accounts Assistant',
                    'dashboard' => 'dashboard.php'
                ],
                'finance-officer' => [
                    'valid_ids' => ['FIN-OFF', 'FIN001', 'FO', 'FINANCE-OFFICER'],
                    'password' => 'FIN@ISNM2024',
                    'name' => 'Finance Officer',
                    'dashboard' => 'dashboard.php'
                ],
                
                // Administrative Staff
                'academic-registrar' => [
                    'valid_ids' => ['REGISTRAR', 'REG001', 'AR', 'ACADEMIC-REGISTRAR'],
                    'password' => 'REG@ISNM2024',
                    'name' => 'Academic Registrar',
                    'dashboard' => 'dashboard-academic-registrar.php'
                ],
                'hr-manager' => [
                    'valid_ids' => ['HR-MGR', 'HR001', 'HRM', 'HR-MANAGER'],
                    'password' => 'HR@ISNM2024',
                    'name' => 'HR Manager',
                    'dashboard' => 'dashboard.php'
                ],
                'secretary' => [
                    'valid_ids' => ['SECRETARY', 'SEC001', 'SEC', 'SCHOOL-SECRETARY'],
                    'password' => 'SEC@ISNM2024',
                    'name' => 'School Secretary',
                    'dashboard' => 'dashboard.php'
                ],
                'librarian' => [
                    'valid_ids' => ['LIBRARIAN', 'LIB001', 'LIB', 'SCHOOL-LIBRARIAN'],
                    'password' => 'LIB@ISNM2024',
                    'name' => 'School Librarian',
                    'dashboard' => 'dashboard.php'
                ],
                
                // Academic Staff
                'head-nursing' => [
                    'valid_ids' => ['HOD-NURS', 'HN001', 'HON', 'HEAD-NURSING'],
                    'password' => 'HON@ISNM2024',
                    'name' => 'Head of Nursing Department',
                    'dashboard' => 'dashboard.php'
                ],
                'head-midwifery' => [
                    'valid_ids' => ['HOD-MID', 'HM001', 'HOM', 'HEAD-MIDWIFERY'],
                    'password' => 'HOM@ISNM2024',
                    'name' => 'Head of Midwifery Department',
                    'dashboard' => 'dashboard.php'
                ],
                'senior-lecturer' => [
                    'valid_ids' => ['SR-LECT', 'SL001', 'SL', 'SENIOR-LECTURER'],
                    'password' => 'SL@ISNM2024',
                    'name' => 'Senior Lecturer',
                    'dashboard' => 'dashboard.php'
                ],
                'lecturer' => [
                    'valid_ids' => ['LECTURER', 'LEC001', 'LEC', 'ACADEMIC-STAFF'],
                    'password' => 'LEC@ISNM2024',
                    'name' => 'Lecturer',
                    'dashboard' => 'dashboard.php'
                ],
                'clinical-instructor' => [
                    'valid_ids' => ['CLIN-INST', 'CI001', 'CI', 'CLINICAL-INSTRUCTOR'],
                    'password' => 'CI@ISNM2024',
                    'name' => 'Clinical Instructor',
                    'dashboard' => 'dashboard.php'
                ],
                'tutor' => [
                    'valid_ids' => ['TUTOR', 'TUT001', 'TUT', 'ACADEMIC-TUTOR'],
                    'password' => 'TUT@ISNM2024',
                    'name' => 'Academic Tutor',
                    'dashboard' => 'dashboard.php'
                ],
                
                // Support Staff
                'matron-1' => [
                    'valid_ids' => ['MATRON1', 'MAT001', 'M1', 'MATRON-ONE'],
                    'password' => 'MAT1@ISNM2024',
                    'name' => 'Matron 1',
                    'dashboard' => 'dashboard.php'
                ],
                'matron-2' => [
                    'valid_ids' => ['MATRON2', 'MAT002', 'M2', 'MATRON-TWO'],
                    'password' => 'MAT2@ISNM2024',
                    'name' => 'Matron 2',
                    'dashboard' => 'dashboard.php'
                ],
                'matron-3' => [
                    'valid_ids' => ['MATRON3', 'MAT003', 'M3', 'MATRON-THREE'],
                    'password' => 'MAT3@ISNM2024',
                    'name' => 'Matron 3',
                    'dashboard' => 'dashboard.php'
                ],
                'warden' => [
                    'valid_ids' => ['WARDEN', 'WAR001', 'WAR', 'HOSTEL-WARDEN'],
                    'password' => 'WAR@ISNM2024',
                    'name' => 'Hostel Warden',
                    'dashboard' => 'dashboard.php'
                ],
                'lab-technician' => [
                    'valid_ids' => ['LAB-TECH', 'LT001', 'LT', 'LAB-TECHNICIAN'],
                    'password' => 'LAB@ISNM2024',
                    'name' => 'Laboratory Technician',
                    'dashboard' => 'dashboard.php'
                ],
                'driver' => [
                    'valid_ids' => ['DRIVER', 'DRV001', 'DRV', 'SCHOOL-DRIVER'],
                    'password' => 'DRV@ISNM2024',
                    'name' => 'School Driver',
                    'dashboard' => 'dashboard.php'
                ],
                'cook' => [
                    'valid_ids' => ['COOK', 'CK001', 'CK', 'SCHOOL-COOK'],
                    'password' => 'COOK@ISNM2024',
                    'name' => 'School Cook',
                    'dashboard' => 'dashboard.php'
                ],
                'cleaner' => [
                    'valid_ids' => ['CLEANER', 'CLN001', 'CLN', 'SCHOOL-CLEANER'],
                    'password' => 'CLN@ISNM2024',
                    'name' => 'School Cleaner',
                    'dashboard' => 'dashboard.php'
                ],
                'security' => [
                    'valid_ids' => ['SECURITY', 'SEC001', 'SEC', 'SCHOOL-SECURITY'],
                    'password' => 'SEC@ISNM2024',
                    'name' => 'Security Officer',
                    'dashboard' => 'dashboard.php'
                ],
                'gardener' => [
                    'valid_ids' => ['GARDENER', 'GRD001', 'GRD', 'SCHOOL-GARDENER'],
                    'password' => 'GRD@ISNM2024',
                    'name' => 'School Gardener',
                    'dashboard' => 'dashboard.php'
                ],
                
                // Students
                'student' => [
                    'valid_ids' => ['STUDENT', 'STU001', '2024/001', 'LEARNER'],
                    'password' => 'STU@ISNM2024',
                    'name' => 'Student',
                    'dashboard' => 'dashboard.php'
                ],
                'guild-president' => [
                    'valid_ids' => ['GUILD-PRES', 'GP001', 'GP', 'GUILD-PRESIDENT'],
                    'password' => 'GP@ISNM2024',
                    'name' => 'Guild President',
                    'dashboard' => 'dashboard.php'
                ],
                'class-rep' => [
                    'valid_ids' => ['CLASS-REP', 'CR001', 'CR', 'CLASS-REPRESENTATIVE'],
                    'password' => 'CR@ISNM2024',
                    'name' => 'Class Representative',
                    'dashboard' => 'dashboard.php'
                ],
                'club-leader' => [
                    'valid_ids' => ['CLUB-LEAD', 'CL001', 'CL', 'CLUB-LEADER'],
                    'password' => 'CL@ISNM2024',
                    'name' => 'Club Leader',
                    'dashboard' => 'dashboard.php'
                ]
            ];
            
            // Get the role from URL or use user_type
            $selected_role = isset($_GET['role']) ? $_GET['role'] : $user_type;
            
            // Validate credentials for the specific role
            $role_config = isset($mock_users[$selected_role]) ? $mock_users[$selected_role] : null;
            if ($role_config && in_array($username, $role_config['valid_ids']) && $password === $role_config['password']) {
                // Create user session with role-specific data
                $_SESSION['user'] = [
                    'username' => $username,
                    'role' => $selected_role,
                    'name' => $role_config['name'],
                    'login_time' => date('Y-m-d H:i:s')
                ];
                
                // Log activity (only if database is available)
                try {
                    logActivity($username, $selected_role, 'LOGIN', 'Mock login successful');
                } catch (PDOException $e) {
                    // Ignore logging errors in mock mode
                }
                
                // Clear login attempt and redirect to individual dashboard based on specific role
                unset($_SESSION['login_attempt']);
                header('Location: ' . $role_config['dashboard']);
                exit();
            } else {
                $role_name = isset($role_config['name']) ? $role_config['name'] : 'selected role';
                $errors[] = "Invalid username or password for {$role_name}";
            }
        }
    }
    }
}

// Function to redirect based on position
function redirectBasedOnPosition($position) {
    // Specialized dashboards that exist
    $specialized_dashboards = [
        'school-bursar' => 'dashboard-bursar.php',
        'director-general' => 'dashboard-director-general.php',
        'principal' => 'dashboard-principal.php',
        'academic-registrar' => 'dashboard-academic-registrar.php'
    ];
    
    // Check if there's a specialized dashboard for this role
    if (isset($specialized_dashboards[$position]) && file_exists($specialized_dashboards[$position])) {
        $dashboard = $specialized_dashboards[$position];
    } else {
        // Use universal dashboard for all other roles
        $dashboard = 'dashboard.php';
    }
    
    header('Location: ' . $dashboard);
    exit();
}

// Function to log activity
function logActivity($user_id, $user_type, $action, $description, $status = 'success') {
    global $pdo;
    try {
        $stmt = $pdo->prepare("
            INSERT INTO activity_log (user_id, user_type, action, description, status, ip_address, user_agent, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
        ");
        $stmt->execute([
            $user_id,
            $user_type,
            $action,
            $description,
            $status,
            isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '',
            isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : ''
        ]);
    } catch (PDOException $e) {
        error_log("Activity log error: " . $e->getMessage());
    }
}

// Get role from URL parameter for backward compatibility
$role = isset($_GET['role']) ? $_GET['role'] : 'admin';
$department = isset($_GET['department']) ? $_GET['department'] : '';

// Define role configurations with specific office names
$roles = [
    'director-general' => [
        'title' => 'Director General Login',
        'subtitle' => 'Executive Director Office Access',
        'icon' => 'fas fa-user-tie',
        'color' => '#1e40af'
    ],
    'director-academics' => [
        'title' => 'Director of Academics Login',
        'subtitle' => 'Academic Director Office Access',
        'icon' => 'fas fa-graduation-cap',
        'color' => '#1e40af'
    ],
    'director-ict' => [
        'title' => 'Director of ICT Login',
        'subtitle' => 'ICT Director Office Access',
        'icon' => 'fas fa-laptop-code',
        'color' => '#1e40af'
    ],
    'director-finance' => [
        'title' => 'Director of Finance Login',
        'subtitle' => 'Finance Director Office Access',
        'icon' => 'fas fa-chart-line',
        'color' => '#1e40af'
    ],
    'principal' => [
        'title' => 'School Principal Login',
        'subtitle' => 'Principal Office Access',
        'icon' => 'fas fa-user-shield',
        'color' => '#dc2626'
    ],
    'deputy-principal' => [
        'title' => 'Deputy Principal Login',
        'subtitle' => 'Deputy Principal Office Access',
        'icon' => 'fas fa-user-tie',
        'color' => '#dc2626'
    ],
    'school-bursar' => [
        'title' => 'School Bursar Login',
        'subtitle' => 'Bursar Office Access',
        'icon' => 'fas fa-coins',
        'color' => '#059669'
    ],
    'academic-registrar' => [
        'title' => 'Academic Registrar Login',
        'subtitle' => 'Registrar Office Access',
        'icon' => 'fas fa-file-alt',
        'color' => '#7c3aed'
    ],
    'hr-manager' => [
        'title' => 'HR Manager Login',
        'subtitle' => 'Human Resources Office Access',
        'icon' => 'fas fa-users',
        'color' => '#7c3aed'
    ],
    'head-nursing' => [
        'title' => 'Head of Nursing Login',
        'subtitle' => 'Nursing Department Office Access',
        'icon' => 'fas fa-user-nurse',
        'color' => '#0891b2'
    ],
    'head-midwifery' => [
        'title' => 'Head of Midwifery Login',
        'subtitle' => 'Midwifery Department Office Access',
        'icon' => 'fas fa-baby',
        'color' => '#0891b2'
    ],
    'lecturer' => [
        'title' => 'Lecturer Login',
        'subtitle' => 'Academic Staff Office Access',
        'icon' => 'fas fa-chalkboard-teacher',
        'color' => '#0891b2'
    ],
    'student' => [
        'title' => 'Student Login',
        'subtitle' => 'Student Portal Access',
        'icon' => 'fas fa-user-graduate',
        'color' => '#ea580c'
    ],
    'support' => [
        'title' => 'Support Staff Login',
        'subtitle' => 'Support Services Office Access',
        'icon' => 'fas fa-tools',
        'color' => '#65a30d'
    ],
    'admin' => [
        'title' => 'Administrator Login',
        'subtitle' => 'System Administration Access',
        'icon' => 'fas fa-user-shield',
        'color' => '#2563eb'
    ]
];

// Get current role configuration
$current_role = isset($roles[$role]) ? $roles[$role] : $roles['admin'];

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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(134, 239, 172, 0.1) 0%, transparent 50%);
            animation: float 20s ease-in-out infinite;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: var(--shadow-xl);
            max-width: 450px;
            width: 100%;
            margin: 2rem;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .login-container::before {
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
        }
        
        .school-logo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 1rem;
            box-shadow: var(--shadow-md);
            border: 3px solid var(--primary);
        }

        .role-icon {
            width: 80px;
            height: 80px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            margin: 0 auto 1.5rem;
            box-shadow: var(--shadow-md);
        }

        .login-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
            display: block;
        }

        .login-subtitle {
            color: #6b7280;
            font-size: 0.95rem;
            display: block;
        }

        .department-info {
            background: linear-gradient(135deg, #FFF8DC, #FFD700);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 2rem;
            text-align: center;
            font-size: 0.9rem;
            color: #1a1a1a;
            font-weight: 500;
            display: block;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #1a1a1a;
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
        }

        .form-input:focus {
            outline: none;
            border-color: <?php echo $current_role['color']; ?>;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
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
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .alert {
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
        }

        .alert-error {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .back-link {
            text-align: center;
            margin-top: 2rem;
        }

        .back-link a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .back-link a:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }

        .role-selector {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            justify-content: center;
        }

        .role-tab {
            padding: 0.5rem 1rem;
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .role-tab.active {
            background: linear-gradient(135deg, #2563eb 0%, #667eea 100%);
            color: white;
            border-color: #2563eb;
        }

        .role-tab:hover:not(.active) {
            border-color: #2563eb;
            background: rgba(37, 99, 235, 0.1);
        }

        .user-type-selector {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .user-type-option {
            flex: 1;
            padding: 1rem;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
        }
        
        .user-type-option:hover {
            border-color: #667eea;
            background: #f8f9ff;
        }
        
        .user-type-option.selected {
            border-color: #667eea;
            background: #667eea;
            color: white;
        }

        .credentials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 0.75rem;
            margin-top: 1rem;
        }

        .credential-item {
            background: rgba(255, 255, 255, 0.8);
            padding: 0.75rem;
            border-radius: 8px;
            border-left: 4px solid #FFD700;
            font-size: 0.85rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .credential-item code {
            background: #f3f4f6;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
            color: #dc2626;
            font-weight: 600;
        }

        .login-guide {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            padding: 1.5rem;
            margin-top: 2rem;
            border: 1px solid #e5e7eb;
        }

        .login-guide h4 {
            color: #1a1a1a;
            margin-bottom: 1rem;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .guide-note {
            margin-top: 1rem;
            padding: 0.75rem;
            background: #f0f9ff;
            border-radius: 8px;
            font-size: 0.85rem;
            color: #0369a1;
            border-left: 4px solid #0ea5e9;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            25% {
                transform: translateY(-20px) rotate(90deg);
            }
            50% {
                transform: translateY(0px) rotate(180deg);
            }
            75% {
                transform: translateY(-10px) rotate(270deg);
            }
        }

        @media (max-width: 768px) {
            .login-container {
                padding: 2rem;
                margin: 1rem;
            }
            
            .login-title {
                font-size: 1.5rem;
            }
            
            .role-selector {
                flex-wrap: wrap;
            }
        }

        
            </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <img src="assets/school-logo.png" alt="ISNM Logo" class="school-logo">
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

        <?php if (isset($error)): ?>
            <div class="alert alert-error">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="user-type-selector">
                <div class="user-type-option selected" data-type="staff">
                    <i class="fas fa-user-tie"></i>
                    <div>Staff</div>
                </div>
                <div class="user-type-option" data-type="student">
                    <i class="fas fa-user-graduate"></i>
                    <div>Student</div>
                </div>
            </div>
            
            <input type="hidden" name="user_type" id="user_type" value="staff">
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
                    value="<?php echo htmlspecialchars(isset($_POST['username']) ? $_POST['username'] : ''); ?>"
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
            <a href="login.php?role=director-general" class="role-tab <?php echo $role === 'director-general' ? 'active' : ''; ?>">
                <i class="fas fa-user-tie"></i> Director
            </a>
            <a href="login.php?role=principal" class="role-tab <?php echo $role === 'principal' ? 'active' : ''; ?>">
                <i class="fas fa-user-shield"></i> Principal
            </a>
            <a href="login.php?role=school-bursar" class="role-tab <?php echo $role === 'school-bursar' ? 'active' : ''; ?>">
                <i class="fas fa-coins"></i> Bursar
            </a>
            <a href="login.php?role=academic-registrar" class="role-tab <?php echo $role === 'academic-registrar' ? 'active' : ''; ?>">
                <i class="fas fa-file-alt"></i> Registrar
            </a>
            <a href="login.php?role=head-nursing" class="role-tab <?php echo $role === 'head-nursing' ? 'active' : ''; ?>">
                <i class="fas fa-user-nurse"></i> Nursing
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

        <div class="login-guide">
            <h4><i class="fas fa-info-circle"></i> Office Login Credentials</h4>
            <div class="credentials-grid">
                <div class="credential-item">
                    <strong>Director General:</strong> Any ID | Password: <code>director123</code>
                </div>
                <div class="credential-item">
                    <strong>School Principal:</strong> Any ID | Password: <code>principal123</code>
                </div>
                <div class="credential-item">
                    <strong>School Bursar:</strong> Any ID | Password: <code>12345678</code>
                </div>
                <div class="credential-item">
                    <strong>Academic Registrar:</strong> Any ID | Password: <code>admin123</code>
                </div>
                <div class="credential-item">
                    <strong>Head of Nursing:</strong> Any ID | Password: <code>lecturer123</code>
                </div>
                <div class="credential-item">
                    <strong>Head of Midwifery:</strong> Any ID | Password: <code>lecturer123</code>
                </div>
                <div class="credential-item">
                    <strong>Lecturer:</strong> Any ID | Password: <code>lecturer123</code>
                </div>
                <div class="credential-item">
                    <strong>HR Manager:</strong> Any ID | Password: <code>admin123</code>
                </div>
                <div class="credential-item">
                    <strong>Support Staff:</strong> Any ID | Password: <code>support123</code>
                </div>
                <div class="credential-item">
                    <strong>Student:</strong> Any ID | Password: <code>student123</code>
                </div>
            </div>
            <p class="guide-note">
                <i class="fas fa-lightbulb"></i> 
                Use any username/ID with the correct password for your specific office
            </p>
        </div>

        <div class="back-link">
            <a href="login-portal.php">
                <i class="fas fa-arrow-left"></i> Back to Department Selection
            </a>
        </div>
    </div>

    <script>
        // Auto-focus on username field
        document.addEventListener('DOMContentLoaded', function() {
            const usernameField = document.getElementById('username');
            if (usernameField) {
                usernameField.focus();
            }
        });

        // User type selector
        document.querySelectorAll('.user-type-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.user-type-option').forEach(opt => {
                    opt.classList.remove('selected');
                });
                this.classList.add('selected');
                document.getElementById('user_type').value = this.dataset.type;
            });
        });

        // Add smooth transitions for role tabs
        document.querySelectorAll('.role-tab').forEach(tab => {
            tab.addEventListener('click', function(e) {
                // Add loading state
                this.style.opacity = '0.7';
            });
        });
    </script>
</body>
</html>


