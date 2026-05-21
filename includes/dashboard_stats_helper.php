<?php
/**
 * Safe dashboard statistics — avoids fatal errors if stored procedure is missing.
 */
if (!function_exists('fetchStaffDashboardStats')) {
    function fetchStaffDashboardStats(mysqli $conn, int $userId, string $userRole): array {
        $defaults = [
            'total_students' => 0,
            'total_staff' => 0,
            'pending_applications' => 0,
            'active_programs' => 0,
        ];

        try {
            $stmt = $conn->prepare('CALL get_dashboard_statistics(?, ?)');
            if ($stmt) {
                $stmt->bind_param('is', $userId, $userRole);
                if ($stmt->execute()) {
                    $result = $stmt->get_result();
                    if ($result && ($row = $result->fetch_assoc())) {
                        $stmt->close();
                        while ($conn->more_results()) {
                            $conn->next_result();
                        }
                        return array_merge($defaults, $row);
                    }
                }
                $stmt->close();
                while ($conn->more_results()) {
                    $conn->next_result();
                }
            }
        } catch (Throwable $e) {
            error_log('fetchStaffDashboardStats: ' . $e->getMessage());
        }

        try {
            $r = $conn->query('SELECT COUNT(*) AS c FROM staff WHERE status = "Active"');
            if ($r && ($row = $r->fetch_assoc())) {
                $defaults['total_staff'] = (int) $row['c'];
            }
        } catch (Throwable $e) {
            // ignore
        }

        return $defaults;
    }
}
