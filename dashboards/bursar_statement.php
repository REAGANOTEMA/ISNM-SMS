<?php
/**
 * Student fee statement — print / PDF (browser print)
 */
require_once __DIR__ . '/../includes/staff_dashboard_access.php';
require_once __DIR__ . '/../includes/bursar_finance.php';

bootstrapStaffDashboard(['bursar', 'finance', 'accountant', 'school bursar']);

$studentId = trim($_GET['student_id'] ?? '');
if ($studentId === '') {
    http_response_code(400);
    die('Student ID is required.');
}

$statement = bursarGetStudentStatement($studentId);
if (!$statement) {
    http_response_code(404);
    die('Student account not found for: ' . htmlspecialchars($studentId));
}

$logoUrl = '../images/school-logo.png';
$forPrint = isset($_GET['print']) || isset($_GET['autoprint']);

require __DIR__ . '/../templates/financial_statement.php';
