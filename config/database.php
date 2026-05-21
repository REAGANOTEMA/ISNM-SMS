<?php
/**
 * Database Configuration for ISNM Student Management System
 * Override per environment via config/database.local.php (gitignored).
 */

mysqli_report(MYSQLI_REPORT_OFF);

$localConfig = __DIR__ . '/database.local.php';
if (is_readable($localConfig)) {
    require_once $localConfig;
}

if (!defined('APP_ENV')) {
    define('APP_ENV', 'production');
}

// Students database
if (!defined('STUDENTS_DB_HOST')) {
    define('STUDENTS_DB_HOST', 'localhost');
}
if (!defined('STUDENTS_DB_USER')) {
    define('STUDENTS_DB_USER', 'igangaschoolofl_students_db');
}
if (!defined('STUDENTS_DB_PASS')) {
    define('STUDENTS_DB_PASS', 'hbkKdmMHUfHTHuxWKPRf');
}
if (!defined('STUDENTS_DB_NAME')) {
    define('STUDENTS_DB_NAME', 'igangaschoolofl_students_db');
}

// Staff database
if (!defined('STAFF_DB_HOST')) {
    define('STAFF_DB_HOST', 'localhost');
}
if (!defined('STAFF_DB_USER')) {
    define('STAFF_DB_USER', 'igangaschoolofl_staffs_db');
}
if (!defined('STAFF_DB_PASS')) {
    define('STAFF_DB_PASS', 'AgKzJjZZnT5q58jCahs8');
}
if (!defined('STAFF_DB_NAME')) {
    define('STAFF_DB_NAME', 'igangaschoolofl_staffs_db');
}

// Website database
if (!defined('WEBSITE_DB_HOST')) {
    define('WEBSITE_DB_HOST', 'localhost');
}
if (!defined('WEBSITE_DB_USER')) {
    define('WEBSITE_DB_USER', 'igangaschoolofl_website_db');
}
if (!defined('WEBSITE_DB_PASS')) {
    define('WEBSITE_DB_PASS', 'AaCH75gXpekcFQj5wPZn');
}
if (!defined('WEBSITE_DB_NAME')) {
    define('WEBSITE_DB_NAME', 'igangaschoolofl_website_db');
}

define('DB_CHARSET', 'utf8mb4');
define('STAFF_DB_CHARSET', 'utf8mb4');

// Legacy aliases (used across the codebase)
define('DB_HOST', STUDENTS_DB_HOST);
define('DB_USER', STUDENTS_DB_USER);
define('DB_PASS', STUDENTS_DB_PASS);
define('DB_NAME', STUDENTS_DB_NAME);

/** Logical keys for DatabaseConnection class */
if (!defined('DB_MAP')) {
    define('DB_MAP', serialize([
        'students' => [
            'host' => STUDENTS_DB_HOST,
            'user' => STUDENTS_DB_USER,
            'pass' => STUDENTS_DB_PASS,
            'name' => STUDENTS_DB_NAME,
        ],
        'staffs' => [
            'host' => STAFF_DB_HOST,
            'user' => STAFF_DB_USER,
            'pass' => STAFF_DB_PASS,
            'name' => STAFF_DB_NAME,
        ],
        'website' => [
            'host' => WEBSITE_DB_HOST,
            'user' => WEBSITE_DB_USER,
            'pass' => WEBSITE_DB_PASS,
            'name' => WEBSITE_DB_NAME,
        ],
    ]));
}

if (!function_exists('isnmDbConnect')) {
    function isnmDbConnect(string $type): mysqli {
        $map = unserialize(DB_MAP);
        if (!isset($map[$type])) {
            throw new Exception("Unknown database type: {$type}");
        }
        $c = $map[$type];
        $conn = @new mysqli($c['host'], $c['user'], $c['pass'], $c['name']);
        if ($conn->connect_error) {
            error_log("ISNM DB ({$type}): " . $conn->connect_error);
            throw new Exception('Database connection failed. Please contact administrator.');
        }
        $conn->set_charset(DB_CHARSET);
        return $conn;
    }
}

if (!function_exists('getStudentsConnection')) {
    function getStudentsConnection(): mysqli {
        static $conn = null;
        if ($conn === null || !$conn->ping()) {
            $conn = isnmDbConnect('students');
        }
        return $conn;
    }
}

if (!function_exists('getStaffConnection')) {
    function getStaffConnection(): mysqli {
        static $conn = null;
        if ($conn === null || !$conn->ping()) {
            $conn = isnmDbConnect('staffs');
        }
        return $conn;
    }
}

if (!function_exists('getWebsiteConnection')) {
    function getWebsiteConnection(): mysqli {
        static $conn = null;
        if ($conn === null || !$conn->ping()) {
            $conn = isnmDbConnect('website');
        }
        return $conn;
    }
}

if (!function_exists('getConnection')) {
    function getConnection(): mysqli {
        return getStudentsConnection();
    }
}

if (!function_exists('closeConnection')) {
    function closeConnection($conn): void {
        if ($conn instanceof mysqli) {
            $conn->close();
        }
    }
}

if (!function_exists('executePrepared')) {
    function executePrepared($conn, $query, $types, $params) {
        try {
            $stmt = $conn->prepare($query);
            if (!$stmt) {
                throw new Exception('Prepare failed: ' . $conn->error);
            }
            if (!empty($params)) {
                $stmt->bind_param($types, ...$params);
            }
            if (!$stmt->execute()) {
                throw new Exception('Execute failed: ' . $stmt->error);
            }
            return $stmt;
        } catch (Exception $e) {
            error_log('Query Error: ' . $e->getMessage());
            throw $e;
        }
    }
}

if (!function_exists('validateIndexNumber')) {
    function validateIndexNumber($index_number) {
        return preg_match('/^U\d{3}\/(CM|CN|DMORDN)\/\d{3}\/\d{2}$/', $index_number);
    }
}

if (!function_exists('studentExistsByIndexNumber')) {
    function studentExistsByIndexNumber($indexNumber) {
        $conn = getConnection();
        $stmt = $conn->prepare("SELECT id FROM users WHERE index_number = ? AND role = 'student'");
        $stmt->bind_param('s', $indexNumber);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }
}

if (!function_exists('userExistsByEmail')) {
    function userExistsByEmail($email) {
        $conn = getConnection();
        $stmt = $conn->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }
}

if (!function_exists('sanitizeInput')) {
    function sanitizeInput($input) {
        $input = trim($input);
        $input = stripslashes($input);
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('validateEmail')) {
    function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
}

if (!function_exists('validatePhone')) {
    function validatePhone($phone) {
        $clean_phone = preg_replace('/[^0-9]/', '', $phone);
        if (strlen($clean_phone) === 10 && preg_match('/^0[7]\d{8}$/', $clean_phone)) {
            return true;
        }
        if (strlen($clean_phone) === 12 && preg_match('/^256[7]\d{8}$/', $clean_phone)) {
            return true;
        }
        return false;
    }
}

require_once __DIR__ . '/../includes/site_config.php';
