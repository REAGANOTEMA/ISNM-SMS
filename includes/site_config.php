<?php
/**
 * Official ISNM public website URL (use everywhere for site links).
 */
if (!defined('ISNM_SITE_URL')) {
    define('ISNM_SITE_URL', 'https://igangaschoolofnursingandmidwifery.ac.ug');
}
if (!defined('ISNM_SITE_HOST')) {
    define('ISNM_SITE_HOST', 'igangaschoolofnursingandmidwifery.ac.ug');
}

if (!function_exists('isnmSiteUrl')) {
    function isnmSiteUrl(): string {
        return ISNM_SITE_URL;
    }
}

if (!function_exists('isnmSiteHost')) {
    function isnmSiteHost(): string {
        return ISNM_SITE_HOST;
    }
}

if (!function_exists('isnmSiteLinkHtml')) {
    /**
     * Clickable website link for templates.
     */
    function isnmSiteLinkHtml(?string $label = null, string $class = ''): string {
        $url = isnmSiteUrl();
        $label = $label ?? isnmSiteHost();
        $classAttr = $class !== '' ? ' class="' . htmlspecialchars($class, ENT_QUOTES, 'UTF-8') . '"' : '';
        return '<a href="' . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . '"' . $classAttr
            . ' target="_blank" rel="noopener noreferrer">' . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . '</a>';
    }
}

if (!function_exists('isnmResolveBaseUrl')) {
    /** Application base URL for redirects and emails. */
    function isnmResolveBaseUrl(): string {
        static $base = null;
        if ($base !== null) {
            return $base;
        }
        $host = strtolower($_SERVER['HTTP_HOST'] ?? '');
        if (strpos($host, 'igangaschoolofnursingandmidwifery.ac.ug') !== false) {
            $base = 'https://igangaschoolofnursingandmidwifery.ac.ug/';
            return $base;
        }
        $https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            || (isset($_SERVER['SERVER_PORT']) && (int) $_SERVER['SERVER_PORT'] === 443);
        $protocol = $https ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '/index.php');
        $dir = rtrim(dirname($script), '/');
        if ($dir === '' || $dir === '.') {
            $path = '/';
        } else {
            $path = $dir . '/';
        }
        $base = $protocol . '://' . $host . $path;
        return $base;
    }
}

if (!function_exists('isnmWebsiteFooterLine')) {
    /** HTML paragraph for footer contact block. */
    function isnmWebsiteFooterLine(): string {
        return '<p><i class="fas fa-globe"></i> Website: ' . isnmSiteLinkHtml() . '</p>';
    }
}
