<?php
/**
 * Finance module access — School Bursar, Director Finance, Director General only.
 */
require_once __DIR__ . '/../config/database.php';

if (!function_exists('financeNormalizeRole')) {
    function financeNormalizeRole(?string $role): string {
        $role = strtolower(trim((string) $role));
        $role = preg_replace('/[_\-]+/', ' ', $role);
        $role = preg_replace('/\s+/', ' ', $role);
        return $role;
    }
}

if (!function_exists('financeAllowedRoles')) {
    /** @return string[] */
    function financeAllowedRoles(): array {
        return ['school bursar', 'bursar', 'director finance', 'director general'];
    }
}

if (!function_exists('financeRoleAllowed')) {
    function financeRoleAllowed(?string $role, ?string $organogramPosition = null): bool {
        $role = financeNormalizeRole($role);
        if (in_array($role, financeAllowedRoles(), true)) {
            return true;
        }
        $pos = financeNormalizeRole($organogramPosition ?? ($_SESSION['organogram_position'] ?? ''));
        return in_array($pos, financeAllowedRoles(), true);
    }
}

if (!function_exists('financeRequireAccess')) {
    function financeRequireAccess(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (($_SESSION['type'] ?? '') !== 'staff') {
            header('Location: ../staff-login.php?error=unauthorized');
            exit;
        }
        $role = $_SESSION['role'] ?? '';
        if (!financeRoleAllowed($role)) {
            header('Location: ../staff-login.php?error=unauthorized');
            exit;
        }
    }
}

if (!function_exists('finCanApprove')) {
    /** Day-to-day approvals: Bursar and Director Finance only. */
    function finCanApprove(): bool {
        $role = financeNormalizeRole($_SESSION['role'] ?? '');
        if (strpos($role, 'bursar') !== false && $role !== 'director general') {
            return true;
        }
        return $role === 'director finance';
    }
}
