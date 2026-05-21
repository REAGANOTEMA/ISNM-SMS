<?php
/**
 * Root legacy config — unified with config/database.php (staffs_db + students_db)
 */
require_once __DIR__ . '/config/database.php';

$host = STAFF_DB_HOST;
$username = STAFF_DB_USER;
$password = STAFF_DB_PASS;
$dbname = STAFF_DB_NAME;

try {
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . STAFF_DB_NAME . ';charset=' . DB_CHARSET,
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
    );
    $pdo->exec('SET NAMES utf8mb4');
} catch (PDOException $e) {
    error_log('PDO connection failed: ' . $e->getMessage());
    die('Database connection failed. Please contact administrator.');
}

$mysqli = getStaffConnection();

function getDBConnection() {
    global $pdo;
    return $pdo;
}

function getMySQLiConnection() {
    global $mysqli;
    return $mysqli;
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!headers_sent()) {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: DENY');
    header('X-XSS-Protection: 1; mode=block');
}

error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
date_default_timezone_set('Africa/Kampala');

if (!defined('APP_NAME')) {
    define('APP_NAME', 'ISNM School Management System');
}
if (!defined('APP_VERSION')) {
    define('APP_VERSION', '1.0.0');
}
if (!defined('BASE_URL')) {
    require_once __DIR__ . '/includes/site_config.php';
    define('BASE_URL', isnmResolveBaseUrl());
}
if (!defined('UPLOAD_PATH')) {
    define('UPLOAD_PATH', __DIR__ . '/uploads/');
}
if (!defined('MAX_FILE_SIZE')) {
    define('MAX_FILE_SIZE', 5 * 1024 * 1024);
}
if (!defined('MIN_PASSWORD_LENGTH')) {
    define('MIN_PASSWORD_LENGTH', 8);
}
if (!defined('SESSION_TIMEOUT')) {
    define('SESSION_TIMEOUT', 3600);
}
if (!defined('MAX_LOGIN_ATTEMPTS')) {
    define('MAX_LOGIN_ATTEMPTS', 5);
}
if (!defined('LOCKOUT_TIME')) {
    define('LOCKOUT_TIME', 1800);
}
if (!defined('SMTP_HOST')) {
    define('SMTP_HOST', 'localhost');
    define('SMTP_PORT', 587);
    define('SMTP_USERNAME', '');
    define('SMTP_PASSWORD', '');
    define('FROM_EMAIL', 'noreply@isnm.ac.ug');
    define('FROM_NAME', 'ISNM School Management System');
}
