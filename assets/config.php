<?php
/**
 * Legacy admin/assets DB bootstrap — uses central config/database.php
 */
require_once __DIR__ . '/../config/database.php';

if (!isset($conn) || !($conn instanceof mysqli)) {
    $conn = getStaffConnection();
}

if (!$conn) {
    header('Location: ../errors/error.html');
    exit();
}
