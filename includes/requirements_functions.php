<?php
/**
 * Requirements Portal Helper Functions
 * Functions for managing student requirements and clearance
 */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/requirements_items.php';

/**
 * Ensure tables, role, and all 20 requirement items exist
 */
function ensureRequirementsPortalReady() {
    try {
        $staffConn = getStaffConnection();

        $staffConn->query("
            CREATE TABLE IF NOT EXISTS requirement_items (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL UNIQUE,
                category VARCHAR(50) NOT NULL DEFAULT 'Required Items',
                display_order INT NOT NULL DEFAULT 0,
                status VARCHAR(20) DEFAULT 'active',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");

        $col = $staffConn->query("SHOW COLUMNS FROM requirement_items LIKE 'display_order'");
        if ($col && $col->num_rows === 0) {
            $staffConn->query("ALTER TABLE requirement_items ADD COLUMN display_order INT NOT NULL DEFAULT 0 AFTER category");
        }

        $staffConn->query("
            CREATE TABLE IF NOT EXISTS student_requirements (
                id INT AUTO_INCREMENT PRIMARY KEY,
                student_id INT NOT NULL,
                student_admission_number VARCHAR(50),
                student_name VARCHAR(100),
                student_phone VARCHAR(20),
                requirement_item_id INT NOT NULL,
                is_cleared TINYINT(1) DEFAULT 0,
                cleared_by VARCHAR(100),
                cleared_date DATETIME,
                notes TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                UNIQUE KEY uniq_student_item (student_id, requirement_item_id),
                INDEX idx_student (student_id),
                INDEX idx_item (requirement_item_id),
                INDEX idx_cleared (is_cleared)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");

        $roleName = 'Director of Requirements';
        $check = $staffConn->prepare("SELECT id FROM staff_roles WHERE role_name = ? LIMIT 1");
        $check->bind_param('s', $roleName);
        $check->execute();
        if ($check->get_result()->num_rows === 0) {
            $dash = 'dashboards/requirements-director.php';
            $desc = 'Manages student requirements and clearance tracking';
            $ins = $staffConn->prepare("INSERT INTO staff_roles (role_name, dashboard_path, description) VALUES (?, ?, ?)");
            $ins->bind_param('sss', $roleName, $dash, $desc);
            $ins->execute();
            $ins->close();
        }
        $check->close();

        $upsert = $staffConn->prepare("
            INSERT INTO requirement_items (name, category, display_order, status)
            VALUES (?, ?, ?, 'active')
            ON DUPLICATE KEY UPDATE category = VALUES(category), display_order = VALUES(display_order), status = 'active'
        ");
        foreach (REQUIREMENTS_ITEM_LIST as $row) {
            [$name, $category, $order] = $row;
            $upsert->bind_param('ssi', $name, $category, $order);
            $upsert->execute();
        }
        $upsert->close();

        return true;
    } catch (Exception $e) {
        error_log('ensureRequirementsPortalReady: ' . $e->getMessage());
        return false;
    }
}

/**
 * Fetch students by IDs from students_db
 */
function fetchStudentsByIds(array $studentIds) {
    $studentIds = array_values(array_filter(array_map('intval', $studentIds)));
    if (empty($studentIds)) {
        return [];
    }
    try {
        $conn = getStudentsConnection();
        $placeholders = implode(',', array_fill(0, count($studentIds), '?'));
        $types = str_repeat('i', count($studentIds));
        $sql = "SELECT id, index_number, full_name, phone FROM users
                WHERE role = 'student' AND is_active = 1 AND id IN ($placeholders)
                ORDER BY full_name ASC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$studentIds);
        $stmt->execute();
        $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $rows;
    } catch (Exception $e) {
        error_log('fetchStudentsByIds: ' . $e->getMessage());
        return [];
    }
}

/**
 * Get all students from students_db
 */
function getStudentsList($limit = null, $offset = 0) {
    try {
        $conn = getStudentsConnection();
        
        $query = "SELECT id, index_number, full_name, phone FROM users WHERE role = 'student' AND is_active = 1 ORDER BY full_name ASC";
        
        if ($limit) {
            $query .= " LIMIT " . intval($offset) . ", " . intval($limit);
        }
        
        $result = $conn->query($query);
        $students = [];
        
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
        
        return $students;
    } catch (Exception $e) {
        error_log("Error getting students list: " . $e->getMessage());
        return [];
    }
}

/**
 * Get total count of students
 */
function getTotalStudentsCount() {
    try {
        $conn = getStudentsConnection();
        $result = $conn->query("SELECT COUNT(*) as count FROM users WHERE role = 'student' AND is_active = 1");
        $row = $result->fetch_assoc();
        return (int) $row['count'];
    } catch (Exception $e) {
        return 0;
    }
}

/**
 * Search students by name, admission number, or phone
 * @param string $searchTerm
 * @param string $searchBy all|name|admission|phone
 */
function searchStudents($searchTerm, $searchBy = 'all') {
    try {
        $conn = getStudentsConnection();
        $term = '%' . trim($searchTerm) . '%';
        $searchBy = strtolower(trim($searchBy));

        switch ($searchBy) {
            case 'name':
                $sql = "SELECT id, index_number, full_name, phone FROM users
                        WHERE role = 'student' AND is_active = 1 AND full_name LIKE ?
                        ORDER BY full_name ASC";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('s', $term);
                break;
            case 'admission':
                $sql = "SELECT id, index_number, full_name, phone FROM users
                        WHERE role = 'student' AND is_active = 1 AND index_number LIKE ?
                        ORDER BY full_name ASC";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('s', $term);
                break;
            case 'phone':
                $sql = "SELECT id, index_number, full_name, phone FROM users
                        WHERE role = 'student' AND is_active = 1 AND phone LIKE ?
                        ORDER BY full_name ASC";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('s', $term);
                break;
            default:
                $sql = "SELECT id, index_number, full_name, phone FROM users
                        WHERE role = 'student' AND is_active = 1
                        AND (full_name LIKE ? OR index_number LIKE ? OR phone LIKE ?)
                        ORDER BY full_name ASC";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('sss', $term, $term, $term);
        }

        $stmt->execute();
        $students = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $students;
    } catch (Exception $e) {
        error_log("Error searching students: " . $e->getMessage());
        return [];
    }
}

/**
 * Get all requirement items
 */
function getAllRequirementItems() {
    try {
        $conn = getStaffConnection();
        
        $result = $conn->query("
            SELECT id, name, category, display_order, status, created_at 
            FROM requirement_items 
            WHERE status = 'active'
            ORDER BY display_order ASC, name ASC
        ");
        
        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        
        return $items;
    } catch (Exception $e) {
        error_log("Error getting requirement items: " . $e->getMessage());
        return [];
    }
}

/**
 * Get requirements for a specific student
 */
function getStudentRequirements($studentId) {
    try {
        $conn = getStaffConnection();
        
        $stmt = $conn->prepare("
            SELECT sr.*, ri.name, ri.category
            FROM student_requirements sr
            JOIN requirement_items ri ON sr.requirement_item_id = ri.id
            WHERE sr.student_id = ?
            ORDER BY ri.display_order ASC, ri.name ASC
        ");
        
        $stmt->bind_param("i", $studentId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $requirements = [];
        while ($row = $result->fetch_assoc()) {
            $requirements[] = $row;
        }
        
        $stmt->close();
        return $requirements;
    } catch (Exception $e) {
        error_log("Error getting student requirements: " . $e->getMessage());
        return [];
    }
}

/**
 * Initialize requirements for a student (create records for all items)
 */
function initializeStudentRequirements($studentId, $admissionNumber, $studentName, $studentPhone) {
    try {
        $conn = getStaffConnection();
        
        // Get all active requirement items
        $result = $conn->query("SELECT id FROM requirement_items WHERE status = 'active'");
        
        $stmt = $conn->prepare("
            INSERT IGNORE INTO student_requirements 
            (student_id, student_admission_number, student_name, student_phone, requirement_item_id, created_at)
            VALUES (?, ?, ?, ?, ?, NOW())
        ");
        
        $initialized = 0;
        while ($row = $result->fetch_assoc()) {
            $stmt->bind_param("isssi", $studentId, $admissionNumber, $studentName, $studentPhone, $row['id']);
            if ($stmt->execute()) {
                $initialized += $stmt->affected_rows;
            }
        }
        
        $stmt->close();
        return $initialized;
    } catch (Exception $e) {
        error_log("Error initializing student requirements: " . $e->getMessage());
        return 0;
    }
}

/**
 * Clear a specific requirement for a student
 */
function clearRequirement($studentId, $requirementId, $clearedBy) {
    try {
        $conn = getStaffConnection();
        
        $stmt = $conn->prepare("
            UPDATE student_requirements
            SET is_cleared = 1, cleared_by = ?, cleared_date = NOW(), updated_at = NOW()
            WHERE student_id = ? AND requirement_item_id = ?
        ");
        
        $stmt->bind_param("sii", $clearedBy, $studentId, $requirementId);
        $result = $stmt->execute();
        $stmt->close();
        
        return $result;
    } catch (Exception $e) {
        error_log("Error clearing requirement: " . $e->getMessage());
        return false;
    }
}

/**
 * Uncheck (reverse) a cleared requirement
 */
function unclearRequirement($studentId, $requirementId) {
    try {
        $conn = getStaffConnection();
        
        $stmt = $conn->prepare("
            UPDATE student_requirements
            SET is_cleared = 0, cleared_by = NULL, cleared_date = NULL, updated_at = NOW()
            WHERE student_id = ? AND requirement_item_id = ?
        ");
        
        $stmt->bind_param("ii", $studentId, $requirementId);
        $result = $stmt->execute();
        $stmt->close();
        
        return $result;
    } catch (Exception $e) {
        error_log("Error uncleaning requirement: " . $e->getMessage());
        return false;
    }
}

/**
 * Clear all requirements for a student
 */
function clearAllRequirements($studentId, $clearedBy) {
    try {
        $conn = getStaffConnection();
        
        $stmt = $conn->prepare("
            UPDATE student_requirements
            SET is_cleared = 1, cleared_by = ?, cleared_date = NOW(), updated_at = NOW()
            WHERE student_id = ? AND is_cleared = 0
        ");
        
        $stmt->bind_param("si", $clearedBy, $studentId);
        $result = $stmt->execute();
        $cleared = $stmt->affected_rows;
        $stmt->close();
        
        return $cleared;
    } catch (Exception $e) {
        error_log("Error clearing all requirements: " . $e->getMessage());
        return false;
    }
}

/**
 * Add note to a requirement
 */
function addRequirementNote($studentId, $requirementId, $notes) {
    try {
        $conn = getStaffConnection();
        
        $stmt = $conn->prepare("
            UPDATE student_requirements
            SET notes = ?, updated_at = NOW()
            WHERE student_id = ? AND requirement_item_id = ?
        ");
        
        $stmt->bind_param("sii", $notes, $studentId, $requirementId);
        $result = $stmt->execute();
        $stmt->close();
        
        return $result;
    } catch (Exception $e) {
        error_log("Error adding note: " . $e->getMessage());
        return false;
    }
}

/**
 * Get requirements statistics
 */
function getRequirementStats() {
    try {
        $conn = getStaffConnection();
        $studentsConn = getStudentsConnection();
        
        // Total students
        $studentsResult = $studentsConn->query("SELECT COUNT(*) as count FROM users WHERE role = 'student' AND is_active = 1");
        $studentsRow = $studentsResult->fetch_assoc();
        $totalStudents = (int) $studentsRow['count'];
        
        // Students with requirements initialized
        $initResult = $conn->query("SELECT COUNT(DISTINCT student_id) as count FROM student_requirements");
        $initRow = $initResult->fetch_assoc();
        $studentsWithRequirements = (int) $initRow['count'];
        
        // Students with all requirements cleared
        $allClearedResult = $conn->query("
            SELECT COUNT(DISTINCT student_id) as count FROM (
                SELECT DISTINCT student_id FROM student_requirements
                GROUP BY student_id
                HAVING SUM(CASE WHEN is_cleared = 0 THEN 1 ELSE 0 END) = 0
            ) as cleared_students
        ");
        $allClearedRow = $allClearedResult->fetch_assoc();
        $studentsAllCleared = (int) $allClearedRow['count'];
        
        // Total requirements
        $totalReqResult = $conn->query("SELECT COUNT(*) as count FROM requirement_items WHERE status = 'active'");
        $totalReqRow = $totalReqResult->fetch_assoc();
        $totalRequirements = (int) $totalReqRow['count'];
        
        // Total cleared
        $totalClearedResult = $conn->query("SELECT COUNT(*) as count FROM student_requirements WHERE is_cleared = 1");
        $totalClearedRow = $totalClearedResult->fetch_assoc();
        $totalCleared = (int) $totalClearedRow['count'];
        
        // Total pending
        $totalPendingResult = $conn->query("SELECT COUNT(*) as count FROM student_requirements WHERE is_cleared = 0");
        $totalPendingRow = $totalPendingResult->fetch_assoc();
        $totalPending = (int) $totalPendingRow['count'];
        
        // Percentage complete
        $percentComplete = ($totalCleared + $totalPending) > 0 
            ? round(($totalCleared / ($totalCleared + $totalPending)) * 100, 2)
            : 0;
        
        return [
            'totalStudents' => $totalStudents,
            'studentsWithRequirements' => $studentsWithRequirements,
            'studentsAllCleared' => $studentsAllCleared,
            'studentsPending' => $studentsWithRequirements - $studentsAllCleared,
            'totalRequirements' => $totalRequirements,
            'totalCleared' => $totalCleared,
            'totalPending' => $totalPending,
            'percentComplete' => $percentComplete
        ];
    } catch (Exception $e) {
        error_log("Error getting requirement stats: " . $e->getMessage());
        return [];
    }
}

/**
 * Get student progress (count of cleared vs total requirements)
 */
function getStudentProgress($studentId) {
    try {
        $conn = getStaffConnection();
        
        $stmt = $conn->prepare("
            SELECT 
                COUNT(*) as total,
                SUM(CASE WHEN is_cleared = 1 THEN 1 ELSE 0 END) as cleared
            FROM student_requirements
            WHERE student_id = ?
        ");
        
        $stmt->bind_param("i", $studentId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        
        $total = (int) $row['total'];
        $cleared = (int) $row['cleared'];
        $percentage = $total > 0 ? round(($cleared / $total) * 100, 2) : 0;
        
        return [
            'total' => $total,
            'cleared' => $cleared,
            'pending' => $total - $cleared,
            'percentage' => $percentage
        ];
    } catch (Exception $e) {
        error_log("Error getting student progress: " . $e->getMessage());
        return ['total' => 0, 'cleared' => 0, 'pending' => 0, 'percentage' => 0];
    }
}

/**
 * Filter students based on criteria
 */
function filterStudents($filterBy, $filterValue = '') {
    try {
        $staffConn = getStaffConnection();
        $studentIds = [];

        switch ($filterBy) {
            case 'all_cleared':
                $r = $staffConn->query("
                    SELECT student_id FROM student_requirements
                    GROUP BY student_id
                    HAVING SUM(CASE WHEN is_cleared = 0 THEN 1 ELSE 0 END) = 0
                       AND COUNT(*) > 0
                ");
                break;
            case 'pending':
                $r = $staffConn->query("
                    SELECT DISTINCT student_id FROM student_requirements
                    WHERE is_cleared = 0
                ");
                break;
            case 'initialized':
                $r = $staffConn->query("SELECT DISTINCT student_id FROM student_requirements");
                break;
            case 'not_initialized':
                $all = getStudentsList();
                $init = $staffConn->query("SELECT DISTINCT student_id FROM student_requirements");
                $initIds = [];
                while ($row = $init->fetch_assoc()) {
                    $initIds[(int) $row['student_id']] = true;
                }
                return array_values(array_filter($all, static function ($s) use ($initIds) {
                    return !isset($initIds[(int) $s['id']]);
                }));
            default:
                return getStudentsList();
        }

        if (isset($r) && $r) {
            while ($row = $r->fetch_assoc()) {
                $studentIds[] = (int) $row['student_id'];
            }
        }

        return fetchStudentsByIds($studentIds);
    } catch (Exception $e) {
        error_log("Error filtering students: " . $e->getMessage());
        return [];
    }
}

/**
 * Export requirements to CSV
 */
function exportRequirementsToCSV() {
    try {
        $conn = getStudentsConnection();
        $staffConn = getStaffConnection();
        
        // Get all students
        $students = $conn->query("
            SELECT id, index_number, full_name, phone FROM users 
            WHERE role = 'student' AND is_active = 1 
            ORDER BY full_name
        ")->fetch_all(MYSQLI_ASSOC);
        
        // Get all requirement items
        $items = $staffConn->query("
            SELECT id, name, category FROM requirement_items 
            WHERE status = 'active'
            ORDER BY display_order ASC, name ASC
        ")->fetch_all(MYSQLI_ASSOC);
        
        // Create CSV content
        $csv = "Student Admission Number,Student Name,Student Phone";
        
        foreach ($items as $item) {
            $csv .= "," . str_replace(',', ' ', $item['name']);
        }
        $csv .= ",Overall Progress\n";
        
        // Add student data
        foreach ($students as $student) {
            $progress = getStudentProgress($student['id']);
            $csv .= $student['index_number'] . "," 
                  . str_replace(',', ' ', $student['full_name']) . "," 
                  . $student['phone'];
            
            $requirements = getStudentRequirements($student['id']);
            $reqMap = [];
            
            foreach ($requirements as $req) {
                $reqMap[$req['requirement_item_id']] = $req['is_cleared'] ? 'Yes' : 'No';
            }
            
            foreach ($items as $item) {
                $csv .= "," . ($reqMap[$item['id']] ?? 'No');
            }
            
            $csv .= "," . $progress['percentage'] . "%\n";
        }
        
        return $csv;
    } catch (Exception $e) {
        error_log("Error exporting CSV: " . $e->getMessage());
        return null;
    }
}
?>
