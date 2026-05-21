<?php
/**
 * One-time: update school_website setting in website DB to production URL.
 * Run: php scripts/update_site_url_db.php
 */
require_once __DIR__ . '/../config/database.php';

$url = isnmSiteUrl();
$conn = getWebsiteConnection();
$stmt = $conn->prepare("UPDATE site_settings SET setting_value = ? WHERE setting_key = 'school_website'");
if ($stmt) {
    $stmt->bind_param('s', $url);
    $stmt->execute();
    echo "Updated school_website to {$url} (rows: {$stmt->affected_rows})\n";
    $stmt->close();
} else {
    echo "site_settings table may not exist yet.\n";
}
