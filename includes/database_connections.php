<?php
/**
 * ISNM Unified Database Connection System
 * Delegates to config/database.php per-database credentials.
 */

class DatabaseConnection {
    private static $connections = [];
    private static $map = null;

    private static function getMap(): array {
        if (self::$map === null) {
            require_once __DIR__ . '/../config/database.php';
            self::$map = unserialize(DB_MAP);
        }
        return self::$map;
    }

    /** @param string $key students|staffs|website or legacy staffs_db|students_db|website_db */
    private static function resolveKey(string $database): string {
        $aliases = [
            'staffs_db' => 'staffs',
            'students_db' => 'students',
            'website_db' => 'website',
            'staffs' => 'staffs',
            'students' => 'students',
            'website' => 'website',
        ];
        return $aliases[$database] ?? $database;
    }

    public static function getConnection($database) {
        $key = self::resolveKey($database);
        if (!isset(self::$connections[$key])) {
            $map = self::getMap();
            if (!isset($map[$key])) {
                throw new Exception("Unknown database: {$database}");
            }
            $c = $map[$key];
            $conn = @new mysqli($c['host'], $c['user'], $c['pass'], $c['name']);
            if ($conn->connect_error) {
                error_log("Database connection error ({$key}): " . $conn->connect_error);
                throw new Exception('Database connection failed. Please contact administrator.');
            }
            $conn->set_charset(DB_CHARSET);
            self::$connections[$key] = $conn;
        }
        return self::$connections[$key];
    }

    public static function getStaffConnection() {
        return self::getConnection('staffs');
    }

    public static function getStudentsConnection() {
        return self::getConnection('students');
    }

    public static function getWebsiteConnection() {
        return self::getConnection('website');
    }

    public static function closeConnection($database) {
        $key = self::resolveKey($database);
        if (isset(self::$connections[$key])) {
            self::$connections[$key]->close();
            unset(self::$connections[$key]);
        }
    }

    public static function closeAllConnections() {
        foreach (self::$connections as $connection) {
            $connection->close();
        }
        self::$connections = [];
    }

    public static function testConnection($database) {
        try {
            $conn = self::getConnection($database);
            return $conn->query('SELECT 1') !== false;
        } catch (Exception $e) {
            error_log('Connection test failed for ' . $database . ': ' . $e->getMessage());
            return false;
        }
    }

    public static function testAllConnections() {
        $results = [];
        foreach (['staffs', 'students', 'website'] as $database) {
            $results[$database] = self::testConnection($database);
        }
        return $results;
    }

    public static function getConnectionInfo($database) {
        $key = self::resolveKey($database);
        $conn = self::getConnection($database);
        $map = self::getMap();
        return [
            'host' => $map[$key]['host'],
            'database' => $map[$key]['name'],
            'charset' => DB_CHARSET,
            'connected' => $conn->ping(),
            'server_info' => $conn->get_server_info(),
            'client_info' => $conn->get_client_info(),
        ];
    }

    public static function executeQuery($database, $sql, $params = [], $types = '') {
        try {
            $conn = self::getConnection($database);
            $stmt = $conn->prepare($sql);
            if (!empty($params) && !empty($types)) {
                $stmt->bind_param($types, ...$params);
            }
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            return $result;
        } catch (Exception $e) {
            error_log("Query execution error in {$database}: " . $e->getMessage());
            return false;
        }
    }

    public static function executeInsert($database, $sql, $params = [], $types = '') {
        try {
            $conn = self::getConnection($database);
            $stmt = $conn->prepare($sql);
            if (!empty($params) && !empty($types)) {
                $stmt->bind_param($types, ...$params);
            }
            $stmt->execute();
            $insert_id = $conn->insert_id;
            $stmt->close();
            return $insert_id;
        } catch (Exception $e) {
            error_log("Insert execution error in {$database}: " . $e->getMessage());
            return false;
        }
    }

    public static function executeUpdate($database, $sql, $params = [], $types = '') {
        try {
            $conn = self::getConnection($database);
            $stmt = $conn->prepare($sql);
            if (!empty($params) && !empty($types)) {
                $stmt->bind_param($types, ...$params);
            }
            $stmt->execute();
            $affected_rows = $conn->affected_rows;
            $stmt->close();
            return $affected_rows;
        } catch (Exception $e) {
            error_log("Update execution error in {$database}: " . $e->getMessage());
            return false;
        }
    }

    public static function sanitizeInput($input) {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    public static function beginTransaction($database) {
        self::getConnection($database)->begin_transaction();
    }

    public static function commitTransaction($database) {
        self::getConnection($database)->commit();
    }

    public static function rollbackTransaction($database) {
        self::getConnection($database)->rollback();
    }

    public static function escapeString($database, $string) {
        return self::getConnection($database)->real_escape_string($string);
    }
}

// Legacy wrappers only if config/database.php did not define them
if (!function_exists('executeQuery')) {
    function executeQuery($database, $sql, $params = [], $types = '') {
        return DatabaseConnection::executeQuery($database, $sql, $params, $types);
    }
}

if (!function_exists('executeInsert')) {
    function executeInsert($database, $sql, $params = [], $types = '') {
        return DatabaseConnection::executeInsert($database, $sql, $params, $types);
    }
}

if (!function_exists('executeUpdate')) {
    function executeUpdate($database, $sql, $params = [], $types = '') {
        return DatabaseConnection::executeUpdate($database, $sql, $params, $types);
    }
}

if (defined('TEST_CONNECTIONS') && TEST_CONNECTIONS) {
    $test_results = DatabaseConnection::testAllConnections();
    echo '<h3>Database Connection Test Results</h3><pre>';
    print_r($test_results);
    echo '</pre>';
}
