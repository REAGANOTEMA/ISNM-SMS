<?php
// ISNM School Management System - Database Functions
require_once 'config.php';

// Function to sanitize input
function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

// Function to get user role
function getUserRole() {
    return isset($_SESSION['user_role']) ? $_SESSION['user_role'] : null;
}

// Function to redirect if not logged in
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
}

// Function to redirect if not admin
function requireAdmin() {
    requireLogin();
    if (getUserRole() !== 'admin' && getUserRole() !== 'director') {
        header('Location: dashboard.php');
        exit();
    }
}

// Function to hash password
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Function to verify password
function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

// Function to generate random token
function generateToken($length = 32) {
    return bin2hex(random_bytes($length));
}

// Function to send email (basic implementation)
function sendEmail($to, $subject, $message) {
    $headers = "From: " . FROM_EMAIL . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    
    return mail($to, $subject, $message, $headers);
}

// Function to get staff user by ID
function getStaffUser($staff_id) {
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("SELECT * FROM staff_users WHERE staff_id = ? AND is_active = 1");
    $stmt->execute([$staff_id]);
    return $stmt->fetch();
}

// Function to get staff user by username
function getStaffUserByUsername($username) {
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("SELECT * FROM staff_users WHERE username = ? AND is_active = 1");
    $stmt->execute([$username]);
    return $stmt->fetch();
}

// Function to authenticate staff login
function authenticateStaff($username, $password) {
    $user = getStaffUserByUsername($username);
    
    if ($user && verifyPassword($password, $user['password_hash'])) {
        // Update last login
        $pdo = getDBConnection();
        $stmt = $pdo->prepare("UPDATE staff_users SET last_login = NOW() WHERE staff_id = ?");
        $stmt->execute([$user['staff_id']]);
        
        // Set session
        $_SESSION['user_id'] = $user['staff_id'];
        $_SESSION['user_type'] = 'staff';
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['username'] = $user['username'];
        
        return $user;
    }
    
    return false;
}

// Function to get student by ID
function getStudent($student_id) {
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("SELECT s.*, p.program_name, d.department_name, ay.year_name 
                           FROM students s 
                           LEFT JOIN programs p ON s.program_id = p.id 
                           LEFT JOIN departments d ON p.department_id = d.id 
                           LEFT JOIN academic_years ay ON s.academic_year_id = ay.id 
                           WHERE s.student_id = ? AND s.status = 'active'");
    $stmt->execute([$student_id]);
    return $stmt->fetch();
}

// Function to get student fee assignments
function getStudentFeeAssignments($student_id) {
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("SELECT sfa.*, fs.semester, p.program_name, ay.year_name 
                           FROM student_fee_assignments sfa 
                           JOIN fee_structures fs ON sfa.fee_structure_id = fs.id 
                           JOIN programs p ON fs.program_id = p.id 
                           JOIN academic_years ay ON fs.academic_year_id = ay.id 
                           WHERE sfa.student_id = ? 
                           ORDER BY sfa.due_date ASC");
    $stmt->execute([$student_id]);
    return $stmt->fetchAll();
}

// Function to get payment methods
function getPaymentMethods() {
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("SELECT * FROM payment_methods WHERE is_active = 1 ORDER BY method_name");
    $stmt->execute();
    return $stmt->fetchAll();
}

// Function to process payment
function processPayment($student_id, $amount, $payment_method_id, $description, $created_by) {
    $pdo = getDBConnection();
    
    try {
        $pdo->beginTransaction();
        
        // Generate payment ID and receipt number
        $payment_id = 'PAY' . date('Ymd') . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
        $receipt_number = 'RCP' . date('Ymd') . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
        
        // Get most recent fee assignment with outstanding balance
        $stmt = $pdo->prepare("SELECT id, outstanding_balance FROM student_fee_assignments 
                               WHERE student_id = ? AND outstanding_balance > 0 
                               ORDER BY due_date ASC LIMIT 1");
        $stmt->execute([$student_id]);
        $fee_assignment = $stmt->fetch();
        
        if ($fee_assignment) {
            $fee_assignment_id = $fee_assignment['id'];
            $outstanding_balance = $fee_assignment['outstanding_balance'];
            
            // Create payment record
            $stmt = $pdo->prepare("INSERT INTO payments (payment_id, student_id, fee_assignment_id, 
                                   amount, payment_method_id, payment_date, receipt_number, description, created_by) 
                                   VALUES (?, ?, ?, ?, ?, NOW(), ?, ?, ?)");
            $stmt->execute([$payment_id, $student_id, $fee_assignment_id, $amount, $payment_method_id, 
                          $receipt_number, $description, $created_by]);
            
            // Update fee assignment
            $new_amount_paid = min($amount, $outstanding_balance);
            $new_outstanding_balance = max(0, $outstanding_balance - $amount);
            $payment_status = ($new_outstanding_balance <= 0) ? 'paid' : 
                           ($new_amount_paid > 0 ? 'partial' : 'unpaid');
            
            $stmt = $pdo->prepare("UPDATE student_fee_assignments 
                                   SET amount_paid = amount_paid + ?, outstanding_balance = ?, 
                                       payment_status = ?, last_payment_date = CURDATE() 
                                   WHERE id = ?");
            $stmt->execute([$new_amount_paid, $new_outstanding_balance, $payment_status, $fee_assignment_id]);
            
            $pdo->commit();
            return [
                'success' => true,
                'payment_id' => $payment_id,
                'receipt_number' => $receipt_number,
                'message' => 'Payment processed successfully'
            ];
        } else {
            $pdo->rollBack();
            return ['success' => false, 'message' => 'No outstanding fee assignments found'];
        }
    } catch (PDOException $e) {
        $pdo->rollBack();
        return ['success' => false, 'message' => 'Payment processing failed: ' . $e->getMessage()];
    }
}

// Function to get all students
function getAllStudents($limit = 50, $offset = 0) {
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("SELECT s.*, p.program_name, d.department_name, ay.year_name 
                           FROM students s 
                           LEFT JOIN programs p ON s.program_id = p.id 
                           LEFT JOIN departments d ON p.department_id = d.id 
                           LEFT JOIN academic_years ay ON s.academic_year_id = ay.id 
                           WHERE s.status = 'active' 
                           ORDER BY s.created_at DESC 
                           LIMIT ? OFFSET ?");
    $stmt->execute([$limit, $offset]);
    return $stmt->fetchAll();
}

// Function to get all staff users
function getAllStaff($limit = 50, $offset = 0) {
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("SELECT * FROM staff_users WHERE is_active = 1 
                           ORDER BY created_at DESC LIMIT ? OFFSET ?");
    $stmt->execute([$limit, $offset]);
    return $stmt->fetchAll();
}

// Function to get financial overview
function getFinancialOverview() {
    $pdo = getDBConnection();
    
    $overview = [];
    
    // Total students
    $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM students WHERE status = 'active'");
    $stmt->execute();
    $overview['total_students'] = $stmt->fetch()['total'];
    
    // Total staff
    $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM staff_users WHERE is_active = 1");
    $stmt->execute();
    $overview['total_staff'] = $stmt->fetch()['total'];
    
    // Total collected this month
    $stmt = $pdo->prepare("SELECT COALESCE(SUM(amount), 0) as total FROM payments 
                           WHERE payment_status = 'completed' 
                           AND MONTH(payment_date) = MONTH(CURRENT_DATE()) 
                           AND YEAR(payment_date) = YEAR(CURRENT_DATE())");
    $stmt->execute();
    $overview['monthly_collections'] = $stmt->fetch()['total'];
    
    // Outstanding balances
    $stmt = $pdo->prepare("SELECT COALESCE(SUM(outstanding_balance), 0) as total 
                           FROM student_fee_assignments WHERE payment_status != 'paid'");
    $stmt->execute();
    $overview['outstanding_balances'] = $stmt->fetch()['total'];
    
    return $overview;
}

// Function to log activity
function logActivity($user_id, $user_type, $action_type, $action_description, $status = 'success') {
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("INSERT INTO user_activity_log 
                           (user_id, user_type, action_type, action_description, action_date, status) 
                           VALUES (?, ?, ?, ?, NOW(), ?)");
    $stmt->execute([$user_id, $user_type, $action_type, $action_description, $status]);
}

// Function to format currency
function formatCurrency($amount) {
    return 'UGX ' . number_format($amount, 0, '.', ',');
}

// Function to validate email
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to get current academic year
function getCurrentAcademicYear() {
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("SELECT * FROM academic_years WHERE is_active = 1 ORDER BY id DESC LIMIT 1");
    $stmt->execute();
    return $stmt->fetch();
}

// Function to get programs
function getPrograms() {
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("SELECT p.*, d.department_name FROM programs p 
                           LEFT JOIN departments d ON p.department_id = d.id 
                           WHERE p.is_active = 1 ORDER BY p.program_name");
    $stmt->execute();
    return $stmt->fetchAll();
}

// Function to get departments
function getDepartments() {
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("SELECT * FROM departments WHERE is_active = 1 ORDER BY department_name");
    $stmt->execute();
    return $stmt->fetchAll();
}

// Function to create notification
function createNotification($recipient_id, $recipient_type, $notification_type, $title, $message) {
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("INSERT INTO user_notifications 
                           (recipient_id, recipient_type, notification_type, title, message, created_at) 
                           VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->execute([$recipient_id, $recipient_type, $notification_type, $title, $message]);
}

// Function to get user notifications
function getUserNotifications($user_id, $user_type, $limit = 10) {
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("SELECT * FROM user_notifications 
                           WHERE recipient_id = ? AND recipient_type = ? 
                           ORDER BY created_at DESC LIMIT ?");
    $stmt->execute([$user_id, $user_type, $limit]);
    return $stmt->fetchAll();
}

// Function to mark notification as read
function markNotificationRead($notification_id) {
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("UPDATE user_notifications SET is_read = 1, read_at = NOW() WHERE id = ?");
    $stmt->execute([$notification_id]);
}

// Function to logout
function logout() {
    // Log activity
    if (isLoggedIn()) {
        logActivity($_SESSION['user_id'], $_SESSION['user_type'], 'LOGOUT', 'User logged out');
    }
    
    // Destroy session
    session_destroy();
    
    // Clear session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    header('Location: index.php');
    exit();
}
?>
