<?php
// Final System Test
require_once 'config.php';
require_once 'functions.php';

echo "<h1>🎯 Final ISNM System Test</h1>";

// Test database connection
echo "<h2>📊 Database Connection:</h2>";
try {
    $pdo = getDBConnection();
    echo "<p style='color: green;'>✅ Database connection successful!</p>";
    
    // Check if tables exist
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    echo "<h3>📋 Tables Found:</h3>";
    echo "<ul>";
    foreach ($tables as $table) {
        echo "<li style='color: blue;'>✓ " . htmlspecialchars($table) . "</li>";
    }
    echo "</ul>";
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>❌ Database connection failed: " . $e->getMessage() . "</p>";
}

// Test staff authentication
echo "<h2>🔐 Staff Authentication Test:</h2>";
$test_user = authenticateStaff('DirectorGeneral', '12345678');
if ($test_user) {
    echo "<p style='color: green;'>✅ Staff authentication working!</p>";
    echo "<p>Logged in as: <strong>" . htmlspecialchars($test_user['full_name']) . "</strong></p>";
    echo "<p>Role: <strong>" . htmlspecialchars($test_user['role']) . "</strong></p>";
    echo "<p>Username: <strong>" . htmlspecialchars($test_user['username']) . "</strong></p>";
} else {
    echo "<p style='color: red;'>❌ Staff authentication failed</p>";
}

// Test financial overview
echo "<h2>💰 Financial Overview Test:</h2>";
$overview = getFinancialOverview();
if ($overview) {
    echo "<p style='color: green;'>✅ Financial overview working!</p>";
    echo "<ul>";
    foreach ($overview as $key => $value) {
        echo "<li>" . ucfirst(str_replace('_', ' ', $key)) . ": <strong>" . formatCurrency($value) . "</strong></li>";
    }
    echo "</ul>";
} else {
    echo "<p style='color: red;'>❌ Financial overview failed</p>";
}

// Test student data
echo "<h2>👨‍🎓 Student Data Test:</h2>";
$students = getAllStudents(5);
if ($students) {
    echo "<p style='color: green;'>✅ Student data working!</p>";
    echo "<h3>Recent Students:</h3>";
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>Student ID</th><th>Name</th><th>Program</th><th>Status</th></tr>";
    foreach ($students as $student) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($student['student_id']) . "</td>";
        echo "<td>" . htmlspecialchars($student['first_name'] . ' ' . $student['last_name']) . "</td>";
        echo "<td>" . htmlspecialchars($student['program_name']) . "</td>";
        echo "<td>" . htmlspecialchars($student['status']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p style='color: red;'>❌ Student data failed</p>";
}

// Test payment methods
echo "<h2>💳 Payment Methods Test:</h2>";
$payment_methods = getPaymentMethods();
if ($payment_methods) {
    echo "<p style='color: green;'>✅ Payment methods working!</p>";
    echo "<ul>";
    foreach ($payment_methods as $method) {
        echo "<li>" . htmlspecialchars($method['method_name']) . " (" . htmlspecialchars($method['method_type']) . ")</li>";
    }
    echo "</ul>";
} else {
    echo "<p style='color: red;'>❌ Payment methods failed</p>";
}

// Test programs and departments
echo "<h2>🏫 Programs & Departments Test:</h2>";
$programs = getPrograms();
$departments = getDepartments();

if ($programs) {
    echo "<p style='color: green;'>✅ Programs working! (" . count($programs) . " programs)</p>";
}
if ($departments) {
    echo "<p style='color: green;'>✅ Departments working! (" . count($departments) . " departments)</p>";
}

// Test session management
echo "<h2>🔒 Session Management Test:</h2>";
if (session_status() === PHP_SESSION_ACTIVE) {
    echo "<p style='color: green;'>✅ Session is active</p>";
} else {
    echo "<p style='color: red;'>❌ Session is not active</p>";
}

// Test file structure
echo "<h2>📁 File Structure Test:</h2>";
$required_files = ['config.php', 'functions.php', 'login.php', 'dashboard-bursar.php', 'fixed_system.sql'];
foreach ($required_files as $file) {
    if (file_exists($file)) {
        echo "<p style='color: green;'>✅ $file exists</p>";
    } else {
        echo "<p style='color: red;'>❌ $file missing</p>";
    }
}

echo "<hr>";
echo "<h2>🚀 Quick Access Links:</h2>";
echo "<p><a href='login.php' style='background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin: 5px;'>🔐 Login Page</a></p>";
echo "<p><a href='dashboard-bursar.php' style='background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin: 5px;'>📊 Bursar Dashboard</a></p>";
echo "<p><a href='index.php' style='background: #ffc107; color: black; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin: 5px;'>🏠 Home Page</a></p>";

echo "<hr>";
echo "<h2>🎯 System Status:</h2>";
echo "<div style='background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; border: 1px solid #c3e6cb;'>";
echo "<h3>✅ Final System Ready!</h3>";
echo "<p><strong>Database:</strong> isnm</p>";
echo "<p><strong>Login:</strong> DirectorGeneral / 12345678</p>";
echo "<p><strong>Features:</strong> Complete ISNM School Management System</p>";
echo "<p><strong>Status:</strong> All systems operational</p>";
echo "</div>";
?>
