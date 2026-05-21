<?php
$dirs = [
    dirname(__DIR__) . '/dashboards' => "    <?php include __DIR__ . '/partials/_pwa_footer.php'; ?>\n",
    dirname(__DIR__) . '/student_panel' => "    <?php require_once __DIR__ . '/../includes/brand_pwa.php'; isnmPwaFooter(); ?>\n",
];
$patched = 0;

foreach ($dirs as $dir => $snippet) {
    foreach (glob($dir . '/*.php') as $file) {
        $content = file_get_contents($file);
        if ($content === false || strpos($content, 'isnmPwaFooter') !== false || strpos($content, '_pwa_footer') !== false) {
            continue;
        }
        if (strpos($content, '</body>') === false) {
            continue;
        }
        $new = preg_replace('/\s*<\/body>/i', "\n" . $snippet . '</body>', $content, 1, $count);
        if ($count > 0) {
            file_put_contents($file, $new);
            $patched++;
            echo basename($dir) . '/' . basename($file) . "\n";
        }
    }
}
echo "Patched {$patched} footers.\n";
