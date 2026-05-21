<?php
/**
 * ISNM brand assets + Progressive Web App (installable on mobile & desktop).
 */
if (!defined('ISNM_LOGO_FILE')) {
    define('ISNM_LOGO_FILE', 'images/school-logo.png');
}

if (!function_exists('isnmWebBase')) {
    /**
     * Relative URL prefix from current script to site root (e.g. "../" from dashboards/).
     */
    function isnmWebBase(): string {
        static $base = null;
        if ($base !== null) {
            return $base;
        }
        $projectRoot = realpath(dirname(__DIR__));
        $scriptDir = realpath(dirname($_SERVER['SCRIPT_FILENAME'] ?? __DIR__));
        if (!$projectRoot || !$scriptDir || strpos($scriptDir, $projectRoot) !== 0) {
            $base = '';
            return $base;
        }
        $relative = trim(str_replace('\\', '/', substr($scriptDir, strlen($projectRoot))), '/');
        $base = $relative === '' ? '' : str_repeat('../', substr_count($relative, '/') + 1);
        return $base;
    }
}

if (!function_exists('isnmLogoUrl')) {
    function isnmLogoUrl(): string {
        return isnmWebBase() . ISNM_LOGO_FILE;
    }
}

if (!function_exists('isnmManifestUrl')) {
    function isnmManifestUrl(): string {
        return isnmWebBase() . 'manifest.json';
    }
}

if (!function_exists('isnmSwUrl')) {
    function isnmSwUrl(): string {
        return isnmWebBase() . 'sw.js';
    }
}

if (!function_exists('isnmPwaHead')) {
    /**
     * @param string $themeColor Hex color for browser chrome
     */
    function isnmPwaHead(string $themeColor = '#3E2723'): void {
        $base = isnmWebBase();
        $logo = htmlspecialchars(isnmLogoUrl(), ENT_QUOTES, 'UTF-8');
        $manifest = htmlspecialchars(isnmManifestUrl(), ENT_QUOTES, 'UTF-8');
        $theme = htmlspecialchars($themeColor, ENT_QUOTES, 'UTF-8');
        $bc = htmlspecialchars($base . 'browserconfig.xml', ENT_QUOTES, 'UTF-8');
        ?>
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="default">
  <meta name="apple-mobile-web-app-title" content="ISNM">
  <meta name="application-name" content="ISNM">
  <meta name="theme-color" content="<?php echo $theme; ?>">
  <meta name="msapplication-TileColor" content="<?php echo $theme; ?>">
  <meta name="msapplication-TileImage" content="<?php echo $logo; ?>">
  <meta name="msapplication-config" content="<?php echo $bc; ?>">
  <link rel="manifest" href="<?php echo $manifest; ?>">
  <link rel="icon" href="<?php echo $logo; ?>" type="image/png">
  <link rel="shortcut icon" href="<?php echo $logo; ?>" type="image/png">
  <link rel="apple-touch-icon" href="<?php echo $logo; ?>">
  <link rel="apple-touch-icon" sizes="57x57" href="<?php echo $logo; ?>">
  <link rel="apple-touch-icon" sizes="60x60" href="<?php echo $logo; ?>">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $logo; ?>">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $logo; ?>">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $logo; ?>">
  <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $logo; ?>">
  <link rel="apple-touch-icon" sizes="144x144" href="<?php echo $logo; ?>">
  <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $logo; ?>">
  <link rel="apple-touch-icon" sizes="167x167" href="<?php echo $logo; ?>">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $logo; ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $logo; ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $logo; ?>">
  <link rel="icon" type="image/png" sizes="96x96" href="<?php echo $logo; ?>">
  <link rel="icon" type="image/png" sizes="192x192" href="<?php echo $logo; ?>">
  <link rel="icon" type="image/png" sizes="512x512" href="<?php echo $logo; ?>">
  <?php
  if (!function_exists('isnmSiteUrl')) {
      require_once __DIR__ . '/site_config.php';
  }
  $canonical = htmlspecialchars(isnmSiteUrl(), ENT_QUOTES, 'UTF-8');
  ?>
  <link rel="canonical" href="<?php echo $canonical; ?>">
  <meta property="og:url" content="<?php echo $canonical; ?>">
  <meta property="og:image" content="<?php echo $logo; ?>">
  <meta name="twitter:image" content="<?php echo $logo; ?>">
  <link rel="preload" href="<?php echo $logo; ?>" as="image" type="image/png">
        <?php
    }
}

if (!function_exists('isnmPwaFooter')) {
    function isnmPwaFooter(): void {
        $base = isnmWebBase();
        $sw = htmlspecialchars(isnmSwUrl(), ENT_QUOTES, 'UTF-8');
        $scope = htmlspecialchars($base === '' ? './' : $base, ENT_QUOTES, 'UTF-8');
        $logo = htmlspecialchars(isnmLogoUrl(), ENT_QUOTES, 'UTF-8');
        ?>
  <div id="isnm-pwa-install" class="isnm-pwa-install" hidden>
    <img src="<?php echo $logo; ?>" alt="ISNM" width="40" height="40">
    <div class="isnm-pwa-install-text">
      <strong>Install ISNM App</strong>
      <span>Add to home screen or desktop for quick access</span>
    </div>
    <button type="button" id="isnm-pwa-install-btn" class="isnm-pwa-install-btn">Install</button>
    <button type="button" id="isnm-pwa-install-dismiss" class="isnm-pwa-install-dismiss" aria-label="Dismiss">&times;</button>
  </div>
  <style>
    .isnm-pwa-install{position:fixed;bottom:16px;left:16px;right:16px;max-width:420px;margin:0 auto;z-index:99999;display:flex;align-items:center;gap:12px;padding:12px 14px;background:#3E2723;color:#fff;border-radius:12px;box-shadow:0 8px 32px rgba(0,0,0,.35);font-family:system-ui,sans-serif;font-size:14px}
    .isnm-pwa-install[hidden]{display:none!important}
    .isnm-pwa-install img{border-radius:8px;object-fit:contain;background:#fff}
    .isnm-pwa-install-text{flex:1;display:flex;flex-direction:column;gap:2px;line-height:1.3}
    .isnm-pwa-install-text span{font-size:12px;opacity:.9}
    .isnm-pwa-install-btn{background:#FFD700;color:#3E2723;border:none;padding:8px 16px;border-radius:8px;font-weight:700;cursor:pointer;white-space:nowrap}
    .isnm-pwa-install-dismiss{background:transparent;border:none;color:#fff;font-size:22px;cursor:pointer;padding:0 4px;line-height:1}
    @media(min-width:768px){.isnm-pwa-install{left:auto;right:20px;margin:0}}
  </style>
  <script>
  (function(){
    var swUrl = <?php echo json_encode(isnmSwUrl()); ?>;
    var scope = <?php echo json_encode($scope); ?>;
    if ('serviceWorker' in navigator) {
      window.addEventListener('load', function () {
        navigator.serviceWorker.register(swUrl, { scope: scope }).catch(function () {});
      });
    }
    var banner = document.getElementById('isnm-pwa-install');
    var installBtn = document.getElementById('isnm-pwa-install-btn');
    var dismissBtn = document.getElementById('isnm-pwa-install-dismiss');
    var deferredPrompt = null;
    var dismissed = false;
    try { dismissed = sessionStorage.getItem('isnm_pwa_dismiss') === '1'; } catch (e) {}
    window.addEventListener('beforeinstallprompt', function (e) {
      e.preventDefault();
      deferredPrompt = e;
      if (!dismissed && banner) banner.hidden = false;
    });
    if (installBtn) {
      installBtn.addEventListener('click', function () {
        if (!deferredPrompt) {
          alert('To install: use your browser menu — "Add to Home Screen" (iPhone) or "Install app" (Chrome/Edge/Android/Windows).');
          return;
        }
        deferredPrompt.prompt();
        deferredPrompt.userChoice.finally(function () { deferredPrompt = null; if (banner) banner.hidden = true; });
      });
    }
    if (dismissBtn) {
      dismissBtn.addEventListener('click', function () {
        if (banner) banner.hidden = true;
        try { sessionStorage.setItem('isnm_pwa_dismiss', '1'); } catch (e) {}
      });
    }
    if (window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone === true) {
      if (banner) banner.hidden = true;
    }
  })();
  </script>
        <?php
    }
}
