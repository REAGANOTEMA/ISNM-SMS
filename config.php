<?php
// ISNM School Management System Database Configuration
$host = 'localhost';
$dbname = 'isnm';
$username = 'root';
$password = 'ReagaN23#';

// Create database connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // Set charset to utf8mb4 for full Unicode support
    $pdo->exec("SET NAMES utf8mb4");
    
    // Enable persistent connection for better performance
    $pdo->setAttribute(PDO::ATTR_PERSISTENT, true);
    
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// MySQLi connection (for legacy code)
$mysqli = new mysqli($host, $username, $password, $dbname);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
$mysqli->set_charset("utf8mb4");

// Database connection function
function getDBConnection() {
    global $pdo;
    return $pdo;
}

// MySQLi connection function
function getMySQLiConnection() {
    global $mysqli;
    return $mysqli;
}

// Session configuration
session_start();

// Security headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');

// Error reporting for development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Timezone
date_default_timezone_set('Africa/Kampala');

// Application settings
define('APP_NAME', 'ISNM School Management System');
define('APP_VERSION', '1.0.0');
define('BASE_URL', 'http://localhost/ISNM-SMS/');
define('UPLOAD_PATH', __DIR__ . '/uploads/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB

// Password settings
define('MIN_PASSWORD_LENGTH', 8);
define('SESSION_TIMEOUT', 3600); // 1 hour

// Login attempts
define('MAX_LOGIN_ATTEMPTS', 5);
define('LOCKOUT_TIME', 1800); // 30 minutes

// Email settings (configure as needed)
define('SMTP_HOST', 'localhost');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', '');
define('SMTP_PASSWORD', '');
define('FROM_EMAIL', 'noreply@isnm.ac.ug');
define('FROM_NAME', 'ISNM School Management System');
?>
