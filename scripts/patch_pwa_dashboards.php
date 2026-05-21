<?php
/**
 * One-time patch: add PWA head include to dashboard PHP files.
 */
$dir = dirname(__DIR__) . '/dashboards';
$snippet = "    <?php include __DIR__ . '/partials/_pwa_head.php'; ?>\n";
$patched = 0;

foreach (glob($dir . '/*.php') as $file) {
    $name = basename($file);
    if (in_array($name, ['director-finance.php', 'school-bursar.php', 'bursar.php'], true)) {
        continue;
    }
    $content = file_get_contents($file);
    if ($content === false || strpos($content, '_pwa_head') !== false || strpos($content, '<head>') === false) {
        continue;
    }
    $new = preg_replace(
        '/(<head>\s*\n\s*<meta charset="UTF-8">)/i',
        '$1' . "\n" . $snippet,
        $content,
        1,
        $count
    );
    if ($count > 0 && $new !== null) {
        file_put_contents($file, $new);
        $patched++;
        echo "Patched: {$name}\n";
    }
}

echo "Done. Patched {$patched} files.\n";
