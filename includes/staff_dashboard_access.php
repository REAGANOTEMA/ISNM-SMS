<?php
/**
 * Shared staff dashboard authentication and multi-database bootstrap.
 */
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../auth-service.php';
require_once __DIR__ . '/dashboard_stats_helper.php';

if (!function_exists('bootstrapStaffDashboard')) {
    /**
     * @param array<int, string> $roleKeywords Empty = any authenticated staff.
     * @return array{auth: AuthenticationService, staff: mysqli, students: mysqli, website: mysqli, user: array}
     */
    function bootstrapStaffDashboard(array $roleKeywords = []) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        global $auth_service;
        if (!isset($auth_service) || !($auth_service instanceof AuthenticationService)) {
            $auth_service = new AuthenticationService();
        }

        if (!$auth_service->isAuthenticated() || ($_SESSION['type'] ?? '') !== 'staff') {
            $returnTo = '';
            if (!empty($_SESSION['organogram_position'])) {
                $returnTo = '?position=' . urlencode($_SESSION['organogram_position']);
            }
            header('Location: ../staff-login.php' . $returnTo);
            exit();
        }

        $role = $_SESSION['role'] ?? '';
        $allowed = empty($roleKeywords);

        if (!$allowed && $auth_service->hasFullInstitutionAccess($role)) {
            $allowed = true;
        }

        // Allow access when user logged in from organogram for this specific dashboard
        if (!$allowed && !empty($_SESSION['organogram_dashboard'])) {
            $currentScript = basename($_SERVER['SCRIPT_NAME'] ?? '');
            $targetScript = basename($_SESSION['organogram_dashboard']);
            if ($currentScript === $targetScript) {
                $allowed = true;
            }
        }

        if (!$allowed) {
            foreach ($roleKeywords as $keyword) {
                if ($keyword !== '' && stripos($role, $keyword) !== false) {
                    $allowed = true;
                    break;
                }
            }
        }

        if (!$allowed && !empty($_SESSION['organogram_position'])) {
            foreach ($roleKeywords as $keyword) {
                if ($keyword !== '' && stripos($_SESSION['organogram_position'], $keyword) !== false) {
                    $allowed = true;
                    break;
                }
            }
        }

        if (!$allowed) {
            header('Location: ../staff-login.php?error=unauthorized');
            exit();
        }

        return [
            'auth' => $auth_service,
            'staff' => getStaffConnection(),
            'students' => getStudentsConnection(),
            'website' => getWebsiteConnection(),
            'user' => $auth_service->getCurrentUser(),
        ];
    }

    function staffRequireRole(array $roleKeywords) {
        bootstrapStaffDashboard($roleKeywords);
    }
}
