<?php
// Test database connection
require_once 'config.php';

echo "<h2>Database Connection Test</h2>";

try {
    echo "<p style='color: green;'>✓ Database connection successful!</p>";
    echo "<p>Connected to database: " . $dbname . "</p>";
    echo "<p>MySQL version: " . $pdo->getAttribute(PDO::ATTR_SERVER_VERSION) . "</p>";
    
    // Test basic query
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "<h3>Tables in database:</h3>";
    echo "<ul>";
    foreach ($tables as $table) {
        echo "<li>" . htmlspecialchars($table) . "</li>";
    }
    echo "</ul>";
    
    // Test if required tables exist
    $required_tables = ['users', 'staff_users', 'students', 'positions', 'departments', 'programs'];
    echo "<h3>Required Tables Check:</h3>";
    foreach ($required_tables as $table) {
        if (in_array($table, $tables)) {
            echo "<p style='color: green;'>✓ $table exists</p>";
        } else {
            echo "<p style='color: red;'>✗ $table missing</p>";
        }
    }
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>✗ Database connection failed: " . $e->getMessage() . "</p>";
}

echo "<h3>Configuration Info:</h3>";
echo "<p>Host: " . $host . "</p>";
echo "<p>Database: " . $dbname . "</p>";
echo "<p>Username: " . $username . "</p>";
echo "<p>Password: " . (empty($password) ? "(empty)" : "*****") . "</p>";
?>
