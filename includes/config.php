<?php
/**
 * Legacy includes/config.php — delegates to unified database config.
 * Avoids duplicate executeQuery/sanitizeInput fatal errors.
 */
require_once __DIR__ . '/../config/database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Default legacy global $conn (students_db)
$conn = getStudentsConnection();

if (!function_exists('executeQueryLegacy')) {
    function executeQueryLegacy($sql, $params = [], $types = '') {
        global $conn;
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            return [];
        }
        if (!empty($params) && !empty($types)) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result === false) {
            return [];
        }
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $stmt->close();
        return $data;
    }
}

if (!function_exists('logActivity')) {
    function logActivity($user_id, $user_role, $activity_type, $activity_description, $module_affected, $record_id) {
        global $conn;
        $ip_address = $_SERVER['REMOTE_ADDR'] ?? '';
        $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        $sql = "INSERT INTO activity_logs (user_id, user_role, activity_type, activity_description, module_affected, record_id, ip_address, user_agent, activity_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            return;
        }
        $stmt->bind_param("ssssssss", $user_id, $user_role, $activity_type, $activity_description, $module_affected, $record_id, $ip_address, $user_agent);
        $stmt->execute();
        $stmt->close();
    }
}

if (!function_exists('isLoggedIn')) {
    function isLoggedIn() {
        return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
    }
}

if (!function_exists('checkAccessLevel')) {
    function checkAccessLevel($required_level) {
        if (!isset($_SESSION['access_level']) || $_SESSION['access_level'] < $required_level) {
            if (isset($_SESSION['role']) && $_SESSION['role'] === 'Student') {
                header("Location: ../student-login.php");
            } else {
                header("Location: ../staff-login.php");
            }
            exit();
        }
    }
}

if (!function_exists('getUserInfo')) {
    function getUserInfo($user_id) {
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $result = executeQueryLegacy($sql, [$user_id], 's');
        return $result[0] ?? null;
    }
}

if (!function_exists('formatDate')) {
    function formatDate($date, $format = 'd/m/Y') {
        if (empty($date)) {
            return '';
        }
        return date($format, strtotime($date));
    }
}

if (!function_exists('generatePagination')) {
    function generatePagination($current_page, $total_pages, $base_url) {
        $pagination = '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">';
        if ($current_page > 1) {
            $pagination .= '<li class="page-item"><a class="page-link" href="' . $base_url . '?page=' . ($current_page - 1) . '">Previous</a></li>';
        }
        $start_page = max(1, $current_page - 2);
        $end_page = min($total_pages, $current_page + 2);
        for ($i = $start_page; $i <= $end_page; $i++) {
            $active_class = $i == $current_page ? 'active' : '';
            $pagination .= '<li class="page-item ' . $active_class . '"><a class="page-link" href="' . $base_url . '?page=' . $i . '">' . $i . '</a></li>';
        }
        if ($current_page < $total_pages) {
            $pagination .= '<li class="page-item"><a class="page-link" href="' . $base_url . '?page=' . ($current_page + 1) . '">Next</a></li>';
        }
        $pagination .= '</ul></nav>';
        return $pagination;
    }
}

error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
date_default_timezone_set('Africa/Kampala');
