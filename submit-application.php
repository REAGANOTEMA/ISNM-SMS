<?php
// Error reporting for development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set headers
header('Content-Type: text/html; charset=UTF-8');

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $first_name = htmlspecialchars($_POST['first_name'] ?? '');
    $surname = htmlspecialchars($_POST['surname'] ?? '');
    $date_of_birth = htmlspecialchars($_POST['date_of_birth'] ?? '');
    $contacts = htmlspecialchars($_POST['contacts'] ?? '');
    $level = htmlspecialchars($_POST['level'] ?? '');
    $course = htmlspecialchars($_POST['course'] ?? '');
    $address = htmlspecialchars($_POST['address'] ?? '');

    // Handle file uploads
    $document_path = '';
    $image_path = '';

    // Create uploads directory if it doesn't exist
    $upload_dir = 'uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    // Handle document upload
    if (isset($_FILES['document']) && $_FILES['document']['error'] === UPLOAD_ERR_OK) {
        $document_name = basename($_FILES['document']['name']);
        $document_path = $upload_dir . time() . '_' . $document_name;
        move_uploaded_file($_FILES['document']['tmp_name'], $document_path);
    }

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_name = basename($_FILES['image']['name']);
        $image_path = $upload_dir . time() . '_img_' . $image_name;
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
    }

    // Here you would typically save to database
    // For now, we'll just display the information

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Application Submitted - Iganga School of Nursing and Midwifery</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Inter', sans-serif;
                background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
                color: #1a202c;
                line-height: 1.6;
                margin: 0;
                padding: 2rem;
            }
            .container {
                max-width: 800px;
                margin: 0 auto;
                background: white;
                border-radius: 20px;
                padding: 3rem;
                box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            }
            .success-icon {
                text-align: center;
                color: #10b981;
                font-size: 4rem;
                margin-bottom: 1rem;
            }
            .title {
                text-align: center;
                font-family: 'Playfair Display', serif;
                font-size: 2.5rem;
                color: #1a202c;
                margin-bottom: 2rem;
            }
            .application-details {
                background: #f8fafc;
                border-radius: 10px;
                padding: 2rem;
                margin-bottom: 2rem;
            }
            .detail-row {
                display: flex;
                margin-bottom: 1rem;
                border-bottom: 1px solid #e2e8f0;
                padding-bottom: 0.5rem;
            }
            .detail-label {
                font-weight: 600;
                width: 200px;
                color: #4a5568;
            }
            .detail-value {
                flex: 1;
                color: #1a202c;
            }
            .back-btn {
                display: inline-block;
                padding: 1rem 2rem;
                background: linear-gradient(135deg, #1a202c 0%, #ffd700 100%);
                color: white;
                text-decoration: none;
                border-radius: 50px;
                font-weight: 600;
                transition: all 0.3s ease;
                margin-top: 2rem;
            }
            .back-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h1 class="title">Application Submitted Successfully!</h1>
            <p style="text-align: center; color: #4a5568; margin-bottom: 2rem;">
                Thank you for applying to Iganga School of Nursing and Midwifery. Your application has been received and will be processed shortly.
            </p>

            <div class="application-details">
                <h3 style="margin-bottom: 1.5rem; color: #1a202c;">Application Details</h3>
                <div class="detail-row">
                    <div class="detail-label">First Name:</div>
                    <div class="detail-value"><?php echo $first_name; ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Surname:</div>
                    <div class="detail-value"><?php echo $surname; ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Date of Birth:</div>
                    <div class="detail-value"><?php echo $date_of_birth; ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Contact Number:</div>
                    <div class="detail-value"><?php echo $contacts; ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Level:</div>
                    <div class="detail-value"><?php echo $level; ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Course:</div>
                    <div class="detail-value"><?php echo $course; ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Address:</div>
                    <div class="detail-value"><?php echo nl2br($address); ?></div>
                </div>
                <?php if ($document_path): ?>
                <div class="detail-row">
                    <div class="detail-label">Document:</div>
                    <div class="detail-value"><a href="<?php echo $document_path; ?>" target="_blank">View Document</a></div>
                </div>
                <?php endif; ?>
                <?php if ($image_path): ?>
                <div class="detail-row">
                    <div class="detail-label">Image:</div>
                    <div class="detail-value"><a href="<?php echo $image_path; ?>" target="_blank">View Image</a></div>
                </div>
                <?php endif; ?>
            </div>

            <div style="text-align: center;">
                <a href="admissions.php" class="back-btn">
                    <i class="fas fa-arrow-left"></i> Back to Admissions
                </a>
            </div>
        </div>
    </body>
    </html>
    <?php
} else {
    // Redirect if accessed directly
    header('Location: admissions.php');
    exit;
}
?>