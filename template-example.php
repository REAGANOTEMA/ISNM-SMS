<?php
/**
 * Template for new public pages — uses shared header and footer.
 */
require_once 'includes/config_enhanced.php';
include_once 'shared/_header.php';
?>

<main>
<section style="max-width: 1200px; margin: 2rem auto; padding: 0 2rem;">
    <div style="background: white; padding: 3rem; border-radius: 12px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <h1 style="font-size: 2.5rem; color: #1a1a1a; margin-bottom: 1rem; font-weight: 900;">Page Title</h1>
        <p style="font-size: 1.1rem; color: #696969; line-height: 1.8; margin-bottom: 1.5rem;">
            Your page content goes here. This template uses <code>shared/_header.php</code> and <code>shared/_footer.php</code>.
        </p>
        <div style="background: #f5f5f5; padding: 2rem; border-radius: 8px; margin-top: 2rem;">
            <h2 style="font-size: 1.8rem; color: #1a1a1a; margin-bottom: 1rem;">Section Example</h2>
            <p style="color: #696969; line-height: 1.6;">Add your content sections here.</p>
        </div>
    </div>
</section>
</main>

<?php include 'shared/_footer.php'; ?>
