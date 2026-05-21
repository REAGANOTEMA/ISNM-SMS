<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$page = $argv[1] ?? 'dashboard.php';
ob_start();
try {
    include __DIR__ . '/' . $page;
} catch (Throwable $e) {
    ob_end_clean();
    echo "FAIL: " . $e->getMessage();
    exit(1);
}
$out = ob_get_clean();
echo "OK " . strlen($out) . " bytes";
