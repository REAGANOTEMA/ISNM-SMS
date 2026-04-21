<?php
// Start session
session_start();

// Check if user is logged in and is student
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
    header('Location: login-portal.php');
    exit();
}

// Mock student data - in production, this would come from database
$student = [
    'id' => 'STU2024001',
    'name' => 'Jane Doe',
    'email' => 'jane.doe@isnm.ac.ug',
    'phone' => '+256 712 345 678',
    'gender' => 'F', // F for female, M for male
    'program' => 'Bachelor of Nursing Science',
    'courses' => ['Anatomy & Physiology', 'Nursing Fundamentals', 'Pharmacology', 'Medical-Surgical Nursing'],
    'semester' => 'Semester 2',
    'set' => 'Set 1',
    'year' => 1,
    'registration_status' => 'Active',
    'finance' => [
        'total_fees' => 2500000,
        'paid_amount' => 1500000,
        'balance' => 1000000,
        'last_payment_date' => '2024-01-15',
        'payment_method' => 'Bank Deposit'
    ]
];

// Enhanced announcements data with multiple sender types
$announcements = [
    ['id' => 1, 'title' => 'Matron Notice: Room Inspection Tomorrow', 'content' => 'All female students should prepare for room inspection tomorrow at 10am.', 'author' => 'Matron', 'date' => '2024-01-20', 'target_gender' => 'F', 'category' => 'hostel'],
    ['id' => 2, 'title' => 'Warden Notice: Boys Hostel Meeting', 'content' => 'All male students should attend hostel meeting tonight at 7pm.', 'author' => 'Warden', 'date' => '2024-01-20', 'target_gender' => 'M', 'category' => 'hostel'],
    ['id' => 3, 'title' => 'General Notice: Exam Schedule', 'content' => 'Final exams will start next week. All students should prepare.', 'author' => 'Academic Office', 'date' => '2024-01-19', 'target_gender' => 'ALL', 'category' => 'academic'],
    ['id' => 4, 'title' => 'Principal Address: Academic Excellence', 'content' => 'I want to encourage all students to maintain academic excellence and uphold the values of our institution.', 'author' => 'Principal', 'date' => '2024-01-18', 'target_gender' => 'ALL', 'category' => 'administrative'],
    ['id' => 5, 'title' => 'Director General: New Policy Implementation', 'content' => 'New academic policies will be implemented starting next semester. All students should review the updated guidelines.', 'author' => 'Director General', 'date' => '2024-01-17', 'target_gender' => 'ALL', 'category' => 'administrative'],
    ['id' => 6, 'title' => 'Dr. Smith: Anatomy Assignment Due', 'content' => 'Reminder: Your anatomy assignment is due this Friday. Please submit before 5pm.', 'author' => 'Dr. Smith', 'date' => '2024-01-16', 'target_gender' => 'ALL', 'category' => 'academic'],
    ['id' => 7, 'title' => 'Ms. Johnson: Clinical Practice Schedule', 'content' => 'Updated clinical practice schedule has been posted. Check your assigned times and locations.', 'author' => 'Ms. Johnson', 'date' => '2024-01-15', 'target_gender' => 'ALL', 'category' => 'academic'],
    ['id' => 8, 'title' => 'Prof. Brown: Pharmacology Lab Results', 'content' => 'Lab results for last week\'s pharmacology practical are now available for viewing.', 'author' => 'Prof. Brown', 'date' => '2024-01-14', 'target_gender' => 'ALL', 'category' => 'academic'],
    ['id' => 9, 'title' => 'Director Academics: Registration Reminder', 'content' => 'Course registration for next semester closes next week. Please complete your registration on time.', 'author' => 'Director Academics', 'date' => '2024-01-13', 'target_gender' => 'ALL', 'category' => 'administrative'],
    ['id' => 10, 'title' => 'Matron: Health Screening Notice', 'content' => 'Annual health screening for female students scheduled for next Wednesday. Please be prepared.', 'author' => 'Matron', 'date' => '2024-01-12', 'target_gender' => 'F', 'category' => 'health'],
    ['id' => 11, 'title' => 'Warden: Maintenance Schedule', 'content' => 'Water supply will be interrupted tomorrow from 9am-12pm for maintenance. Male students please plan accordingly.', 'author' => 'Warden', 'date' => '2024-01-11', 'target_gender' => 'M', 'category' => 'hostel'],
    ['id' => 12, 'title' => 'Principal: Graduation Requirements', 'content' => 'Important information about graduation requirements and clearance procedures for final year students.', 'author' => 'Principal', 'date' => '2024-01-10', 'target_gender' => 'ALL', 'category' => 'administrative']
];

// Mock exam results data
$exam_results = [
    ['course' => 'Anatomy & Physiology', 'score' => 85, 'grade' => 'B+', 'credits' => 4, 'semester' => 'Semester 1'],
    ['course' => 'Nursing Fundamentals', 'score' => 92, 'grade' => 'A', 'credits' => 3, 'semester' => 'Semester 1'],
    ['course' => 'Pharmacology', 'score' => 78, 'grade' => 'B', 'credits' => 3, 'semester' => 'Semester 2'],
    ['course' => 'Medical-Surgical Nursing', 'score' => 88, 'grade' => 'B+', 'credits' => 4, 'semester' => 'Semester 2']
];

// Mock attendance data
$attendance = [
    'total_classes' => 120,
    'attended' => 115,
    'percentage' => 95.8,
    'monthly_breakdown' => [
        'January' => ['attended' => 28, 'total' => 30],
        'February' => ['attended' => 27, 'total' => 28],
        'March' => ['attended' => 30, 'total' => 30],
        'April' => ['attended' => 30, 'total' => 32]
    ]
];

// Mock academic calendar events
$calendar_events = [
    ['title' => 'Mid-Semester Exams', 'date' => '2024-02-15', 'type' => 'exam'],
    ['title' => 'Semester Break', 'date' => '2024-03-01', 'type' => 'holiday'],
    ['title' => 'Final Exams Begin', 'date' => '2024-04-20', 'type' => 'exam'],
    ['title' => 'Graduation Ceremony', 'date' => '2024-05-15', 'type' => 'event'],
    ['title' => 'Registration Deadline', 'date' => '2024-01-25', 'type' => 'deadline']
];

// Mock timetable data
$timetable = [
    'Monday' => [
        ['time' => '8:00-10:00', 'course' => 'Anatomy & Physiology', 'room' => 'Lab 101', 'lecturer' => 'Dr. Smith'],
        ['time' => '10:30-12:30', 'course' => 'Nursing Fundamentals', 'room' => 'Class 205', 'lecturer' => 'Ms. Johnson'],
        ['time' => '2:00-4:00', 'course' => 'Pharmacology', 'room' => 'Lab 102', 'lecturer' => 'Dr. Brown']
    ],
    'Tuesday' => [
        ['time' => '8:00-10:00', 'course' => 'Medical-Surgical Nursing', 'room' => 'Hospital Ward', 'lecturer' => 'Dr. Davis'],
        ['time' => '10:30-12:30', 'course' => 'Clinical Practice', 'room' => 'Clinical Lab', 'lecturer' => 'Ms. Wilson']
    ]
];

// Mock library resources
$library_resources = [
    ['title' => 'Nursing Textbook Collection', 'type' => 'books', 'available' => true],
    ['title' => 'Medical Journals Database', 'type' => 'digital', 'available' => true],
    ['title' => 'Research Papers Archive', 'type' => 'papers', 'available' => true],
    ['title' => 'Study Rooms', 'type' => 'facility', 'available' => false]
];

// Mock messages from staff
$messages = [
    ['from' => 'Dr. Smith', 'subject' => 'Assignment Reminder', 'content' => 'Please submit your anatomy assignment by Friday.', 'date' => '2024-01-19', 'unread' => true],
    ['from' => 'Ms. Johnson', 'subject' => 'Clinical Practice Schedule', 'content' => 'Your clinical practice schedule has been updated.', 'date' => '2024-01-18', 'unread' => false],
    ['from' => 'Academic Office', 'subject' => 'Registration Confirmation', 'content' => 'Your course registration has been confirmed.', 'date' => '2024-01-17', 'unread' => false]
];

// Mock hostel information
$hostel_info = [
    'room_number' => 'A-205',
    'block' => 'Block A',
    'room_type' => 'Single Room',
    'room_mates' => [],
    'fees_paid' => true,
    'check_in_date' => '2024-01-10'
];

// Mock emergency contacts
$emergency_contacts = [
    ['name' => 'Parent/Guardian', 'phone' => '+256 777 123 456', 'relation' => 'Parent'],
    ['name' => 'School Medical Officer', 'phone' => '+256 772 514 889', 'relation' => 'School'],
    ['name' => 'Local Hospital', 'phone' => '+256 777 987 654', 'relation' => 'Medical Emergency']
];

// Filter announcements based on student gender
$filtered_announcements = array_filter($announcements, function($announcement) use ($student) {
    return $announcement['target_gender'] === 'ALL' || $announcement['target_gender'] === $student['gender'];
});
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Iganga School of Nursing and Midwifery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            /* Professional Color Palette */
            --primary-dark: #0a1628;
            --secondary-dark: #1e3a5f;
            --accent-blue: #2563eb;
            --accent-cyan: #06b6d4;
            --accent-gold: #FFD700;
            --medical-blue: #0066cc;
            --success-green: #22c55e;
            --error-red: #ef4444;
            --warning-orange: #f97316;
            
            /* Ultra-Premium Colors */
            --luxury-gold: #D4AF37;
            --champagne: #F7E7CE;
            --pearl-white: #F8F6FF;
            --diamond-white: #FAFAFA;
            
            /* Neutral Colors */
            --white: #ffffff;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            
            /* Gradients */
            --gradient-primary: linear-gradient(135deg, var(--primary-dark) 0%, var(--accent-blue) 100%);
            --gradient-luxury: linear-gradient(135deg, var(--luxury-gold) 0%, var(--champagne) 100%);
            --gradient-success: linear-gradient(135deg, var(--success-green) 0%, #16a34a 100%);
            
            /* Shadows */
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.07);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px rgba(0, 0, 0, 0.1);
            --shadow-2xl: 0 25px 50px rgba(0, 0, 0, 0.25);
            
            /* Transitions */
            --transition-fast: 150ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-normal: 300ms cubic-bezier(0.4, 0, 0.2, 1);
            
            /* Spacing */
            --space-1: 0.25rem;
            --space-2: 0.5rem;
            --space-3: 0.75rem;
            --space-4: 1rem;
            --space-5: 1.25rem;
            --space-6: 1.5rem;
            --space-8: 2rem;
            --space-10: 2.5rem;
            --space-12: 3rem;
            --space-16: 4rem;
            
            /* Typography */
            --text-xs: 0.75rem;
            --text-sm: 0.875rem;
            --text-base: 1rem;
            --text-lg: 1.125rem;
            --text-xl: 1.25rem;
            --text-2xl: 1.5rem;
            --text-3xl: 1.875rem;
            --text-4xl: 2.25rem;
            
            /* Border Radius */
            --radius-sm: 0.25rem;
            --radius-md: 0.375rem;
            --radius-lg: 0.5rem;
            --radius-xl: 0.75rem;
            --radius-2xl: 1rem;
            --radius-full: 9999px;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            font-size: var(--text-base);
            line-height: 1.6;
            color: var(--text-primary);
            background: linear-gradient(135deg, var(--gray-50) 0%, var(--white) 50%, var(--gray-50) 100%);
            min-height: 100vh;
        }

        /* Navigation */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 2px solid var(--luxury-gold);
            z-index: 1000;
            padding: var(--space-4) 0;
            box-shadow: var(--shadow-lg);
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 var(--space-6);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            font-weight: 700;
            font-size: var(--text-xl);
            color: var(--text-primary);
            text-decoration: none;
            font-family: 'Playfair Display', serif;
        }

        .nav-user {
            display: flex;
            align-items: center;
            gap: var(--space-4);
        }

        .user-info {
            text-align: right;
        }

        .user-name {
            font-weight: 600;
            color: var(--text-primary);
            font-size: var(--text-sm);
        }

        .user-role {
            color: var(--text-secondary);
            font-size: var(--text-xs);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-full);
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: 600;
        }

        .logout-btn {
            background: var(--error-red);
            color: var(--white);
            border: none;
            border-radius: var(--radius-lg);
            padding: var(--space-2) var(--space-4);
            font-size: var(--text-sm);
            font-weight: 600;
            cursor: pointer;
            transition: all var(--transition-normal);
        }

        .logout-btn:hover {
            background: #dc2626;
            transform: translateY(-2px);
        }

        /* Main Layout */
        .main-container {
            margin-top: 80px;
            padding: var(--space-8) var(--space-6);
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Dashboard Grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: var(--space-6);
            margin-bottom: var(--space-8);
        }

        /* Cards */
        .card {
            background: var(--white);
            border-radius: var(--radius-2xl);
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--gray-200);
            overflow: hidden;
            transition: all var(--transition-normal);
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-xl);
        }

        .card-header {
            padding: var(--space-6);
            background: linear-gradient(135deg, var(--gray-50) 0%, var(--white) 100%);
            border-bottom: 1px solid var(--gray-200);
        }

        .card-title {
            font-family: 'Playfair Display', serif;
            font-size: var(--text-xl);
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: var(--space-2);
            display: flex;
            align-items: center;
            gap: var(--space-3);
        }

        .card-title i {
            color: var(--luxury-gold);
        }

        .card-subtitle {
            color: var(--text-secondary);
            font-size: var(--text-sm);
        }

        .card-body {
            padding: var(--space-6);
        }

        /* Academic Info */
        .academic-info {
            display: grid;
            gap: var(--space-4);
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: var(--space-3);
            background: var(--gray-50);
            border-radius: var(--radius-lg);
            border-left: 4px solid var(--accent-blue);
        }

        .info-label {
            font-weight: 600;
            color: var(--text-primary);
            font-size: var(--text-sm);
            display: flex;
            align-items: center;
            gap: var(--space-2);
        }

        .info-value {
            color: var(--text-secondary);
            font-size: var(--text-sm);
            font-weight: 500;
        }

        /* Courses List */
        .courses-list {
            display: grid;
            gap: var(--space-3);
        }

        .course-item {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            padding: var(--space-4);
            background: var(--gray-50);
            border-radius: var(--radius-lg);
            border-left: 4px solid var(--success-green);
            transition: all var(--transition-fast);
        }

        .course-item:hover {
            background: var(--gray-100);
            transform: translateX(4px);
        }

        .course-icon {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-lg);
            background: var(--gradient-success);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: var(--text-sm);
        }

        .course-info {
            flex: 1;
        }

        .course-name {
            font-weight: 600;
            color: var(--text-primary);
            font-size: var(--text-sm);
        }

        .course-code {
            color: var(--text-secondary);
            font-size: var(--text-xs);
        }

        /* Finance Card */
        .finance-summary {
            display: grid;
            gap: var(--space-4);
        }

        .finance-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: var(--space-4);
            background: var(--gray-50);
            border-radius: var(--radius-lg);
        }

        .finance-label {
            font-weight: 600;
            color: var(--text-primary);
            font-size: var(--text-sm);
        }

        .finance-value {
            font-weight: 700;
            font-size: var(--text-lg);
        }

        .finance-value.positive {
            color: var(--success-green);
        }

        .finance-value.negative {
            color: var(--error-red);
        }

        .finance-value.neutral {
            color: var(--text-primary);
        }

        /* Payment Section */
        .payment-form {
            display: grid;
            gap: var(--space-4);
            margin-top: var(--space-6);
        }

        .form-group {
            display: grid;
            gap: var(--space-2);
        }

        .form-label {
            font-weight: 600;
            color: var(--text-primary);
            font-size: var(--text-sm);
        }

        .form-input {
            padding: var(--space-3);
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-lg);
            font-size: var(--text-base);
            font-family: 'Inter', sans-serif;
            transition: all var(--transition-normal);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-select {
            padding: var(--space-3);
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-lg);
            font-size: var(--text-base);
            font-family: 'Inter', sans-serif;
            background: var(--white);
            cursor: pointer;
        }

        .btn {
            padding: var(--space-3) var(--space-6);
            border: none;
            border-radius: var(--radius-lg);
            font-size: var(--text-base);
            font-weight: 600;
            cursor: pointer;
            transition: all var(--transition-normal);
            display: inline-flex;
            align-items: center;
            gap: var(--space-2);
        }

        .btn-primary {
            background: var(--gradient-primary);
            color: var(--white);
        }

        .btn-success {
            background: var(--gradient-success);
            color: var(--white);
        }

        .btn-warning {
            background: var(--warning-orange);
            color: var(--white);
        }

        .btn-danger {
            background: var(--error-red);
            color: var(--white);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        /* Announcements */
        .announcements-list {
            display: grid;
            gap: var(--space-4);
            max-height: 400px;
            overflow-y: auto;
        }

        .announcement-item {
            padding: var(--space-4);
            background: var(--gray-50);
            border-radius: var(--radius-lg);
            border-left: 4px solid var(--luxury-gold);
            transition: all var(--transition-fast);
        }

        .announcement-item:hover {
            background: var(--gray-100);
            transform: translateX(4px);
        }

        .announcement-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--space-2);
        }

        .announcement-title {
            font-weight: 600;
            color: var(--text-primary);
            font-size: var(--text-sm);
        }

        .announcement-date {
            color: var(--text-secondary);
            font-size: var(--text-xs);
        }

        .announcement-author {
            color: var(--accent-blue);
            font-size: var(--text-xs);
            margin-bottom: var(--space-2);
        }

        .announcement-content {
            color: var(--text-secondary);
            font-size: var(--text-sm);
            line-height: 1.5;
        }

        /* Request Forms */
        .request-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: var(--space-4);
        }

        .request-card {
            padding: var(--space-6);
            background: var(--gray-50);
            border-radius: var(--radius-lg);
            text-align: center;
            transition: all var(--transition-normal);
            cursor: pointer;
            border: 2px solid transparent;
        }

        .request-card:hover {
            background: var(--white);
            border-color: var(--accent-blue);
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .request-icon {
            width: 60px;
            height: 60px;
            border-radius: var(--radius-full);
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto var(--space-4);
            color: var(--white);
            font-size: var(--text-xl);
        }

        .request-title {
            font-weight: 600;
            color: var(--text-primary);
            font-size: var(--text-base);
            margin-bottom: var(--space-2);
        }

        .request-description {
            color: var(--text-secondary);
            font-size: var(--text-sm);
        }

        /* Enhanced Dashboard Styles */
        
        /* Results List */
        .results-list {
            display: grid;
            gap: var(--space-3);
        }
        
        .result-item {
            padding: var(--space-4);
            background: var(--gray-50);
            border-radius: var(--radius-lg);
            border-left: 4px solid var(--success-green);
            transition: all var(--transition-fast);
        }
        
        .result-item:hover {
            background: var(--gray-100);
            transform: translateX(4px);
        }
        
        .result-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--space-2);
        }
        
        .result-course {
            font-weight: 600;
            color: var(--text-primary);
            font-size: var(--text-sm);
        }
        
        .result-grade {
            font-weight: 700;
            color: var(--success-green);
            font-size: var(--text-lg);
            background: var(--success-green);
            color: var(--white);
            padding: var(--space-1) var(--space-3);
            border-radius: var(--radius-full);
        }
        
        .result-details {
            display: flex;
            gap: var(--space-4);
            font-size: var(--text-xs);
            color: var(--text-secondary);
        }
        
        .result-score {
            font-weight: 600;
            color: var(--text-primary);
        }
        
        /* Attendance Styles */
        .attendance-summary {
            display: flex;
            align-items: center;
            gap: var(--space-6);
        }
        
        .attendance-percentage {
            text-align: center;
        }
        
        .percentage-circle {
            width: 80px;
            height: 80px;
            border-radius: var(--radius-full);
            background: var(--gradient-success);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: 700;
            font-size: var(--text-xl);
            margin-bottom: var(--space-2);
        }
        
        .percentage-label {
            font-size: var(--text-sm);
            color: var(--text-secondary);
            font-weight: 600;
        }
        
        .attendance-stats {
            flex: 1;
            display: grid;
            gap: var(--space-3);
        }
        
        .stat-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: var(--space-3);
            background: var(--gray-50);
            border-radius: var(--radius-lg);
        }
        
        .stat-label {
            font-weight: 600;
            color: var(--text-primary);
            font-size: var(--text-sm);
        }
        
        .stat-value {
            font-weight: 700;
            color: var(--text-primary);
            font-size: var(--text-lg);
        }
        
        /* Calendar Events */
        .calendar-events {
            display: grid;
            gap: var(--space-3);
        }
        
        .event-item {
            display: flex;
            align-items: center;
            gap: var(--space-4);
            padding: var(--space-4);
            background: var(--gray-50);
            border-radius: var(--radius-lg);
            transition: all var(--transition-fast);
        }
        
        .event-item:hover {
            background: var(--gray-100);
            transform: translateX(4px);
        }
        
        .event-date {
            font-weight: 600;
            color: var(--accent-blue);
            font-size: var(--text-sm);
            white-space: nowrap;
        }
        
        .event-info {
            flex: 1;
        }
        
        .event-title {
            font-weight: 600;
            color: var(--text-primary);
            font-size: var(--text-sm);
            margin-bottom: var(--space-1);
        }
        
        .event-type {
            font-size: var(--text-xs);
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        /* Timetable Styles */
        .timetable-tabs {
            display: flex;
            gap: var(--space-2);
            margin-bottom: var(--space-4);
        }
        
        .tab-btn {
            padding: var(--space-3) var(--space-6);
            border: 2px solid var(--gray-200);
            background: var(--white);
            border-radius: var(--radius-lg);
            font-weight: 600;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all var(--transition-normal);
        }
        
        .tab-btn.active {
            background: var(--gradient-primary);
            color: var(--white);
            border-color: var(--accent-blue);
        }
        
        .tab-btn:hover:not(.active) {
            background: var(--gray-50);
            border-color: var(--accent-blue);
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        .class-item {
            display: flex;
            align-items: center;
            gap: var(--space-4);
            padding: var(--space-4);
            background: var(--gray-50);
            border-radius: var(--radius-lg);
            margin-bottom: var(--space-3);
            transition: all var(--transition-fast);
        }
        
        .class-item:hover {
            background: var(--gray-100);
            transform: translateX(4px);
        }
        
        .class-time {
            font-weight: 700;
            color: var(--accent-blue);
            font-size: var(--text-sm);
            white-space: nowrap;
        }
        
        .class-info {
            flex: 1;
        }
        
        .class-name {
            font-weight: 600;
            color: var(--text-primary);
            font-size: var(--text-sm);
            margin-bottom: var(--space-1);
        }
        
        .class-details {
            display: flex;
            gap: var(--space-4);
            font-size: var(--text-xs);
            color: var(--text-secondary);
        }
        
        .class-details span {
            display: flex;
            align-items: center;
            gap: var(--space-1);
        }
        
        /* Library Resources */
        .library-grid {
            display: grid;
            gap: var(--space-3);
        }
        
        .resource-item {
            display: flex;
            align-items: center;
            gap: var(--space-4);
            padding: var(--space-4);
            background: var(--gray-50);
            border-radius: var(--radius-lg);
            transition: all var(--transition-fast);
            cursor: pointer;
        }
        
        .resource-item:hover {
            background: var(--gray-100);
            transform: translateX(4px);
        }
        
        .resource-icon {
            width: 50px;
            height: 50px;
            border-radius: var(--radius-lg);
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: var(--text-lg);
        }
        
        .resource-info {
            flex: 1;
        }
        
        .resource-title {
            font-weight: 600;
            color: var(--text-primary);
            font-size: var(--text-sm);
            margin-bottom: var(--space-1);
        }
        
        .resource-status {
            font-size: var(--text-xs);
            font-weight: 600;
            padding: var(--space-1) var(--space-3);
            border-radius: var(--radius-full);
        }
        
        .resource-status.available {
            background: var(--success-green);
            color: var(--white);
        }
        
        .resource-status.unavailable {
            background: var(--error-red);
            color: var(--white);
        }
        
        /* Enhanced Announcements */
        .announcements-filters {
            display: flex;
            gap: var(--space-2);
            margin-bottom: var(--space-4);
            flex-wrap: wrap;
        }
        
        .filter-btn {
            padding: var(--space-2) var(--space-4);
            border: 2px solid var(--gray-200);
            background: var(--white);
            border-radius: var(--radius-lg);
            font-size: var(--text-xs);
            font-weight: 600;
            cursor: pointer;
            transition: all var(--transition-normal);
        }
        
        .filter-btn.active {
            background: var(--gradient-primary);
            color: var(--white);
            border-color: var(--accent-blue);
        }
        
        .filter-btn:hover:not(.active) {
            background: var(--gray-50);
            border-color: var(--accent-blue);
        }
        
        .announcements-list {
            display: grid;
            gap: var(--space-3);
            max-height: 500px;
            overflow-y: auto;
        }
        
        .announcement-item {
            padding: var(--space-4);
            background: var(--gray-50);
            border-radius: var(--radius-lg);
            transition: all var(--transition-fast);
            border-left: 4px solid var(--luxury-gold);
        }
        
        .announcement-item:hover {
            background: var(--gray-100);
            transform: translateX(4px);
        }
        
        .announcement-item[data-category="administrative"] {
            border-left-color: var(--luxury-gold);
        }
        
        .announcement-item[data-category="academic"] {
            border-left-color: var(--accent-blue);
        }
        
        .announcement-item[data-category="hostel"] {
            border-left-color: var(--success-green);
        }
        
        .announcement-item[data-category="health"] {
            border-left-color: var(--error-red);
        }
        
        .announcement-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--space-2);
        }
        
        .announcement-sender {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            font-weight: 600;
            color: var(--text-primary);
            font-size: var(--text-sm);
        }
        
        .announcement-sender i {
            color: var(--luxury-gold);
        }
        
        .announcement-meta {
            display: flex;
            gap: var(--space-3);
            align-items: center;
        }
        
        .announcement-category {
            font-size: var(--text-xs);
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 600;
        }
        
        .announcement-date {
            color: var(--text-secondary);
            font-size: var(--text-xs);
        }
        
        .announcement-title {
            font-weight: 600;
            color: var(--text-primary);
            font-size: var(--text-sm);
            margin-bottom: var(--space-2);
        }
        
        .announcement-content {
            color: var(--text-secondary);
            font-size: var(--text-sm);
            line-height: 1.5;
            margin-bottom: var(--space-3);
        }
        
        .announcement-actions {
            display: flex;
            gap: var(--space-2);
            margin-top: var(--space-3);
        }
        
        .announcement-btn {
            padding: var(--space-1) var(--space-3);
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-md);
            font-size: var(--text-xs);
            color: var(--text-secondary);
            cursor: pointer;
            transition: all var(--transition-fast);
            display: flex;
            align-items: center;
            gap: var(--space-1);
        }
        
        .announcement-btn:hover {
            background: var(--accent-blue);
            color: var(--white);
            border-color: var(--accent-blue);
        }
        
        .announcements-summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: var(--space-3);
            margin-top: var(--space-4);
            padding-top: var(--space-4);
            border-top: 1px solid var(--gray-200);
        }
        
        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: var(--space-2);
            background: var(--gray-50);
            border-radius: var(--radius-lg);
        }
        
        .summary-label {
            font-size: var(--text-xs);
            color: var(--text-secondary);
            font-weight: 600;
        }
        
        .summary-value {
            font-size: var(--text-sm);
            font-weight: 700;
            color: var(--accent-blue);
        }
        
        /* Messages */
        .messages-list {
            display: grid;
            gap: var(--space-3);
            max-height: 400px;
            overflow-y: auto;
        }
        
        .message-item {
            padding: var(--space-4);
            background: var(--gray-50);
            border-radius: var(--radius-lg);
            transition: all var(--transition-fast);
            cursor: pointer;
            position: relative;
        }
        
        .message-item:hover {
            background: var(--gray-100);
            transform: translateX(4px);
        }
        
        .message-item.unread {
            background: var(--pearl-white);
            border-left: 4px solid var(--accent-blue);
        }
        
        .message-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--space-2);
        }
        
        .message-from {
            font-weight: 600;
            color: var(--text-primary);
            font-size: var(--text-sm);
        }
        
        .message-date {
            font-size: var(--text-xs);
            color: var(--text-secondary);
        }
        
        .unread-indicator {
            width: 8px;
            height: 8px;
            background: var(--accent-blue);
            border-radius: var(--radius-full);
            position: absolute;
            top: var(--space-4);
            right: var(--space-4);
        }
        
        .message-subject {
            font-weight: 600;
            color: var(--text-primary);
            font-size: var(--text-sm);
            margin-bottom: var(--space-1);
        }
        
        .message-preview {
            color: var(--text-secondary);
            font-size: var(--text-sm);
            line-height: 1.4;
        }
        
        /* Emergency Contacts */
        .emergency-contacts {
            display: grid;
            gap: var(--space-3);
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: var(--space-4);
            padding: var(--space-4);
            background: var(--gray-50);
            border-radius: var(--radius-lg);
            transition: all var(--transition-fast);
        }
        
        .contact-item:hover {
            background: var(--gray-100);
            transform: translateY(-2px);
        }
        
        .contact-icon {
            width: 50px;
            height: 50px;
            border-radius: var(--radius-full);
            background: var(--error-red);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: var(--text-lg);
        }
        
        .contact-info {
            flex: 1;
        }
        
        .contact-name {
            font-weight: 600;
            color: var(--text-primary);
            font-size: var(--text-sm);
            margin-bottom: var(--space-1);
        }
        
        .contact-phone {
            font-weight: 600;
            color: var(--accent-blue);
            font-size: var(--text-sm);
            margin-bottom: var(--space-1);
        }
        
        .contact-relation {
            font-size: var(--text-xs);
            color: var(--text-secondary);
        }
        
        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: var(--white);
            border-radius: var(--radius-2xl);
            padding: var(--space-8);
            max-width: 600px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            box-shadow: var(--shadow-2xl);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--space-6);
        }

        .modal-title {
            font-family: 'Playfair Display', serif;
            font-size: var(--text-2xl);
            font-weight: 700;
            color: var(--text-primary);
        }

        .modal-close {
            background: none;
            border: none;
            font-size: var(--text-xl);
            color: var(--text-secondary);
            cursor: pointer;
            padding: var(--space-2);
        }

        .modal-close:hover {
            color: var(--error-red);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .request-grid {
                grid-template-columns: 1fr;
            }

            .nav-container {
                flex-direction: column;
                gap: var(--space-4);
            }

            .main-container {
                padding: var(--space-4);
            }
        }

        /* Loading Spinner */
        .spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: var(--white);
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Print Styles */
        @media print {
            .navbar, .btn, .request-card {
                display: none;
            }
            
            .card {
                break-inside: avoid;
                box-shadow: none;
                border: 1px solid var(--gray-300);
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="nav-logo">
                <img src="assets/school-logo.png" alt="ISNM Logo" style="width: 40px; height: 40px; border-radius: 50%;">
                <span>ISNM Student Portal</span>
            </a>
            
            <div class="nav-user">
                <div class="user-info">
                    <div class="user-name"><?php echo htmlspecialchars($student['name']); ?></div>
                    <div class="user-role">Student ID: <?php echo htmlspecialchars($student['id']); ?></div>
                </div>
                <div class="user-avatar">
                    <?php echo strtoupper(substr($student['name'], 0, 2)); ?>
                </div>
                <form action="logout.php" method="POST">
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="main-container">
        <!-- Welcome Section -->
        <div class="card" style="margin-bottom: var(--space-8);">
            <div class="card-header">
                <h1 class="card-title">
                    <i class="fas fa-graduation-cap"></i>
                    Welcome to Your Student Dashboard
                </h1>
                <p class="card-subtitle">Manage your academic journey, finances, and requests all in one place</p>
            </div>
        </div>

        <!-- Dashboard Grid -->
        <div class="dashboard-grid">
            <!-- Academic Information Card -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-book"></i>
                        Academic Information
                    </h2>
                    <p class="card-subtitle">Your current academic status and program details</p>
                </div>
                <div class="card-body">
                    <div class="academic-info">
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-user-graduate"></i>
                                Program
                            </span>
                            <span class="info-value"><?php echo htmlspecialchars($student['program']); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-calendar-alt"></i>
                                Current Semester
                            </span>
                            <span class="info-value"><?php echo htmlspecialchars($student['semester']); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-users"></i>
                                Set/Group
                            </span>
                            <span class="info-value"><?php echo htmlspecialchars($student['set']); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-check-circle"></i>
                                Registration Status
                            </span>
                            <span class="info-value" style="color: var(--success-green); font-weight: 600;">
                                <?php echo htmlspecialchars($student['registration_status']); ?>
                            </span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-layer-group"></i>
                                Academic Year
                            </span>
                            <span class="info-value">Year <?php echo htmlspecialchars($student['year']); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Registered Courses Card -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-book-open"></i>
                        Registered Courses
                    </h2>
                    <p class="card-subtitle">Courses you are currently enrolled in</p>
                </div>
                <div class="card-body">
                    <div class="courses-list">
                        <?php foreach ($student['courses'] as $index => $course): ?>
                            <div class="course-item">
                                <div class="course-icon">
                                    <i class="fas fa-book"></i>
                                </div>
                                <div class="course-info">
                                    <div class="course-name"><?php echo htmlspecialchars($course); ?></div>
                                    <div class="course-code">Course <?php echo $index + 1; ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Finance Account Card -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-wallet"></i>
                        Finance Account
                    </h2>
                    <p class="card-subtitle">Your financial status and payment history</p>
                </div>
                <div class="card-body">
                    <div class="finance-summary">
                        <div class="finance-item">
                            <span class="finance-label">Total Fees</span>
                            <span class="finance-value neutral">
                                UGX <?php echo number_format($student['finance']['total_fees']); ?>
                            </span>
                        </div>
                        <div class="finance-item">
                            <span class="finance-label">Paid Amount</span>
                            <span class="finance-value positive">
                                UGX <?php echo number_format($student['finance']['paid_amount']); ?>
                            </span>
                        </div>
                        <div class="finance-item">
                            <span class="finance-label">Outstanding Balance</span>
                            <span class="finance-value negative">
                                UGX <?php echo number_format($student['finance']['balance']); ?>
                            </span>
                        </div>
                        <div class="finance-item">
                            <span class="finance-label">Last Payment</span>
                            <span class="finance-value neutral" style="font-size: var(--text-sm);">
                                <?php echo htmlspecialchars($student['finance']['last_payment_date']); ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Announcements Card -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-bullhorn"></i>
                        Announcements & Notices
                    </h2>
                    <p class="card-subtitle">
                        Important notices from Principal, Directors, Teachers, and Staff 
                        <?php 
                        if ($student['gender'] === 'F') {
                            echo '(Female Students)';
                        } else {
                            echo '(Male Students)';
                        }
                        ?>
                    </p>
                </div>
                <div class="card-body">
                    <div class="announcements-filters">
                        <button class="filter-btn active" onclick="filterAnnouncements('all')">All</button>
                        <button class="filter-btn" onclick="filterAnnouncements('administrative')">Administrative</button>
                        <button class="filter-btn" onclick="filterAnnouncements('academic')">Academic</button>
                        <button class="filter-btn" onclick="filterAnnouncements('hostel')">Hostel</button>
                        <button class="filter-btn" onclick="filterAnnouncements('health')">Health</button>
                    </div>
                    <div class="announcements-list" id="announcementsList">
                        <?php foreach ($filtered_announcements as $announcement): ?>
                            <div class="announcement-item" data-category="<?php echo htmlspecialchars($announcement['category']); ?>">
                                <div class="announcement-header">
                                    <div class="announcement-sender">
                                        <?php
                                        // Display appropriate icon based on sender
                                        $sender = strtolower($announcement['author']);
                                        $icon = 'fa-user';
                                        if (strpos($sender, 'principal') !== false) {
                                            $icon = 'fa-user-graduate';
                                        } elseif (strpos($sender, 'director') !== false) {
                                            $icon = 'fa-crown';
                                        } elseif (strpos($sender, 'dr.') !== false || strpos($sender, 'prof.') !== false) {
                                            $icon = 'fa-chalkboard-teacher';
                                        } elseif (strpos($sender, 'ms.') !== false || strpos($sender, 'mr.') !== false) {
                                            $icon = 'fa-user-tie';
                                        } elseif (strpos($sender, 'matron') !== false) {
                                            $icon = 'fa-user-nurse';
                                        } elseif (strpos($sender, 'warden') !== false) {
                                            $icon = 'fa-user-shield';
                                        } elseif (strpos($sender, 'academic') !== false) {
                                            $icon = 'fa-school';
                                        }
                                        ?>
                                        <i class="fas <?php echo $icon; ?>"></i>
                                        <span><?php echo htmlspecialchars($announcement['author']); ?></span>
                                    </div>
                                    <div class="announcement-meta">
                                        <span class="announcement-category"><?php echo htmlspecialchars(ucfirst($announcement['category'])); ?></span>
                                        <span class="announcement-date"><?php echo htmlspecialchars($announcement['date']); ?></span>
                                    </div>
                                </div>
                                <div class="announcement-title"><?php echo htmlspecialchars($announcement['title']); ?></div>
                                <div class="announcement-content"><?php echo htmlspecialchars($announcement['content']); ?></div>
                                <div class="announcement-actions">
                                    <button class="announcement-btn" onclick="markAnnouncementAsRead(<?php echo $announcement['id']; ?>)">
                                        <i class="fas fa-check"></i> Mark as Read
                                    </button>
                                    <button class="announcement-btn" onclick="shareAnnouncement(<?php echo $announcement['id']; ?>)">
                                        <i class="fas fa-share"></i> Share
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="announcements-summary">
                        <div class="summary-item">
                            <span class="summary-label">Total Announcements:</span>
                            <span class="summary-value"><?php echo count($filtered_announcements); ?></span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">From Principal:</span>
                            <span class="summary-value"><?php echo count(array_filter($filtered_announcements, function($a) { return strpos(strtolower($a['author']), 'principal') !== false; })); ?></span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">From Directors:</span>
                            <span class="summary-value"><?php echo count(array_filter($filtered_announcements, function($a) { return strpos(strtolower($a['author']), 'director') !== false; })); ?></span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">From Teachers:</span>
                            <span class="summary-value"><?php echo count(array_filter($filtered_announcements, function($a) { return strpos(strtolower($a['author']), 'dr.') !== false || strpos(strtolower($a['author']), 'prof.') !== false || strpos(strtolower($a['author']), 'ms.') !== false; })); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Exam Results Card -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-chart-line"></i>
                        Exam Results
                    </h2>
                    <p class="card-subtitle">Your academic performance and grades</p>
                </div>
                <div class="card-body">
                    <div class="results-list">
                        <?php foreach ($exam_results as $result): ?>
                            <div class="result-item">
                                <div class="result-header">
                                    <div class="result-course"><?php echo htmlspecialchars($result['course']); ?></div>
                                    <div class="result-grade"><?php echo htmlspecialchars($result['grade']); ?></div>
                                </div>
                                <div class="result-details">
                                    <span class="result-score"><?php echo htmlspecialchars($result['score']); ?>%</span>
                                    <span class="result-credits"><?php echo htmlspecialchars($result['credits']); ?> credits</span>
                                    <span class="result-semester"><?php echo htmlspecialchars($result['semester']); ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Attendance Card -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-calendar-check"></i>
                        Attendance Tracking
                    </h2>
                    <p class="card-subtitle">Your class attendance record</p>
                </div>
                <div class="card-body">
                    <div class="attendance-summary">
                        <div class="attendance-percentage">
                            <div class="percentage-circle">
                                <span><?php echo number_format($attendance['percentage'], 1); ?>%</span>
                            </div>
                            <div class="percentage-label">Overall Attendance</div>
                        </div>
                        <div class="attendance-stats">
                            <div class="stat-item">
                                <span class="stat-label">Classes Attended</span>
                                <span class="stat-value"><?php echo htmlspecialchars($attendance['attended']); ?></span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-label">Total Classes</span>
                                <span class="stat-value"><?php echo htmlspecialchars($attendance['total_classes']); ?></span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-label">Classes Missed</span>
                                <span class="stat-value"><?php echo htmlspecialchars($attendance['total_classes'] - $attendance['attended']); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Academic Calendar Card -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-calendar-alt"></i>
                        Academic Calendar
                    </h2>
                    <p class="card-subtitle">Important dates and events</p>
                </div>
                <div class="card-body">
                    <div class="calendar-events">
                        <?php foreach ($calendar_events as $event): ?>
                            <div class="event-item">
                                <div class="event-date">
                                    <i class="fas fa-calendar"></i>
                                    <?php echo htmlspecialchars($event['date']); ?>
                                </div>
                                <div class="event-info">
                                    <div class="event-title"><?php echo htmlspecialchars($event['title']); ?></div>
                                    <div class="event-type"><?php echo htmlspecialchars($event['type']); ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Timetable Card -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-clock"></i>
                        Class Timetable
                    </h2>
                    <p class="card-subtitle">Your weekly class schedule</p>
                </div>
                <div class="card-body">
                    <div class="timetable-tabs">
                        <button class="tab-btn active" onclick="showTab('Monday')">Monday</button>
                        <button class="tab-btn" onclick="showTab('Tuesday')">Tuesday</button>
                    </div>
                    <div class="timetable-content">
                        <div class="tab-content active" id="Monday-tab">
                            <?php foreach ($timetable['Monday'] as $class): ?>
                                <div class="class-item">
                                    <div class="class-time"><?php echo htmlspecialchars($class['time']); ?></div>
                                    <div class="class-info">
                                        <div class="class-name"><?php echo htmlspecialchars($class['course']); ?></div>
                                        <div class="class-details">
                                            <span><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($class['room']); ?></span>
                                            <span><i class="fas fa-user"></i> <?php echo htmlspecialchars($class['lecturer']); ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="tab-content" id="Tuesday-tab">
                            <?php foreach ($timetable['Tuesday'] as $class): ?>
                                <div class="class-item">
                                    <div class="class-time"><?php echo htmlspecialchars($class['time']); ?></div>
                                    <div class="class-info">
                                        <div class="class-name"><?php echo htmlspecialchars($class['course']); ?></div>
                                        <div class="class-details">
                                            <span><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($class['room']); ?></span>
                                            <span><i class="fas fa-user"></i> <?php echo htmlspecialchars($class['lecturer']); ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Library Resources Card -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-book"></i>
                        Library Resources
                    </h2>
                    <p class="card-subtitle">Access digital and physical library materials</p>
                </div>
                <div class="card-body">
                    <div class="library-grid">
                        <?php foreach ($library_resources as $resource): ?>
                            <div class="resource-item">
                                <div class="resource-icon">
                                    <?php if ($resource['type'] === 'books'): ?>
                                        <i class="fas fa-book-open"></i>
                                    <?php elseif ($resource['type'] === 'digital'): ?>
                                        <i class="fas fa-database"></i>
                                    <?php elseif ($resource['type'] === 'papers'): ?>
                                        <i class="fas fa-file-alt"></i>
                                    <?php else: ?>
                                        <i class="fas fa-door-open"></i>
                                    <?php endif; ?>
                                </div>
                                <div class="resource-info">
                                    <div class="resource-title"><?php echo htmlspecialchars($resource['title']); ?></div>
                                    <div class="resource-status <?php echo $resource['available'] ? 'available' : 'unavailable'; ?>">
                                        <?php echo $resource['available'] ? 'Available' : 'Unavailable'; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Messages Card -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-envelope"></i>
                        Messages from Staff
                    </h2>
                    <p class="card-subtitle">Important communications from lecturers and staff</p>
                </div>
                <div class="card-body">
                    <div class="messages-list">
                        <?php foreach ($messages as $message): ?>
                            <div class="message-item <?php echo $message['unread'] ? 'unread' : ''; ?>">
                                <div class="message-header">
                                    <div class="message-from"><?php echo htmlspecialchars($message['from']); ?></div>
                                    <div class="message-date"><?php echo htmlspecialchars($message['date']); ?></div>
                                    <?php if ($message['unread']): ?>
                                        <div class="unread-indicator"></div>
                                    <?php endif; ?>
                                </div>
                                <div class="message-subject"><?php echo htmlspecialchars($message['subject']); ?></div>
                                <div class="message-preview"><?php echo htmlspecialchars(substr($message['content'], 0, 50)) . '...'; ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Hostel Information Card -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-bed"></i>
                        Hostel Information
                    </h2>
                    <p class="card-subtitle">Your accommodation details</p>
                </div>
                <div class="card-body">
                    <div class="hostel-info">
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-door-open"></i>
                                Room Number
                            </span>
                            <span class="info-value"><?php echo htmlspecialchars($hostel_info['room_number']); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-building"></i>
                                Block
                            </span>
                            <span class="info-value"><?php echo htmlspecialchars($hostel_info['block']); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-home"></i>
                                Room Type
                            </span>
                            <span class="info-value"><?php echo htmlspecialchars($hostel_info['room_type']); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-calendar-check"></i>
                                Check-in Date
                            </span>
                            <span class="info-value"><?php echo htmlspecialchars($hostel_info['check_in_date']); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-money-bill"></i>
                                Hostel Fees
                            </span>
                            <span class="info-value" style="color: var(--success-green);">
                                <?php echo $hostel_info['fees_paid'] ? 'Paid' : 'Unpaid'; ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Emergency Contacts Card -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-phone-alt"></i>
                        Emergency Contacts
                    </h2>
                    <p class="card-subtitle">Important contacts for emergencies</p>
                </div>
                <div class="card-body">
                    <div class="emergency-contacts">
                        <?php foreach ($emergency_contacts as $contact): ?>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="contact-info">
                                    <div class="contact-name"><?php echo htmlspecialchars($contact['name']); ?></div>
                                    <div class="contact-phone"><?php echo htmlspecialchars($contact['phone']); ?></div>
                                    <div class="contact-relation"><?php echo htmlspecialchars($contact['relation']); ?></div>
                                </div>
                                <button class="btn btn-primary" onclick="callEmergency('<?php echo htmlspecialchars($contact['phone']); ?>')">
                                    <i class="fas fa-phone"></i>
                                </button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Section -->
        <div class="card" style="margin-bottom: var(--space-8);">
            <div class="card-header">
                <h2 class="card-title">
                    <i class="fas fa-credit-card"></i>
                    Make Payment
                </h2>
                <p class="card-subtitle">Pay your tuition fees and print receipts</p>
            </div>
            <div class="card-body">
                <form class="payment-form" id="paymentForm">
                    <div class="form-group">
                        <label class="form-label">Payment Amount (UGX)</label>
                        <input type="number" class="form-input" id="paymentAmount" placeholder="Enter amount" required min="1000">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Payment Method</label>
                        <select class="form-select" id="paymentMethod" required>
                            <option value="">Select payment method</option>
                            <option value="bank">Bank Deposit</option>
                            <option value="mobile">Mobile Money</option>
                            <option value="cash">Cash Payment</option>
                            <option value="transfer">Bank Transfer</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Payment Reference (Optional)</label>
                        <input type="text" class="form-input" id="paymentReference" placeholder="Transaction reference number">
                    </div>
                    <div style="display: flex; gap: var(--space-4);">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check"></i>
                            Process Payment
                        </button>
                        <button type="button" class="btn btn-primary" onclick="printReceipt()">
                            <i class="fas fa-print"></i>
                            Print Receipt
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Request Forms Section -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">
                    <i class="fas fa-file-alt"></i>
                    Student Requests
                </h2>
                <p class="card-subtitle">Submit various requests and applications</p>
            </div>
            <div class="card-body">
                <div class="request-grid">
                    <div class="request-card" onclick="openModal('deadYearModal')">
                        <div class="request-icon">
                            <i class="fas fa-pause-circle"></i>
                        </div>
                        <div class="request-title">Dead Year Application</div>
                        <div class="request-description">Apply for academic leave or dead year</div>
                    </div>
                    
                    <div class="request-card" onclick="openModal('leaveModal')">
                        <div class="request-icon">
                            <i class="fas fa-plane"></i>
                        </div>
                        <div class="request-title">Leave Application</div>
                        <div class="request-description">Request leave for personal reasons</div>
                    </div>
                    
                    <div class="request-card" onclick="openModal('treatmentModal')">
                        <div class="request-icon">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <div class="request-title">Treatment Request</div>
                        <div class="request-description">Submit medical treatment requests</div>
                    </div>
                    
                    <div class="request-card" onclick="openModal('complaintModal')">
                        <div class="request-icon">
                            <i class="fas fa-comment-dots"></i>
                        </div>
                        <div class="request-title">File Complaint</div>
                        <div class="request-description">Report issues or concerns</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <!-- Dead Year Modal -->
    <div class="modal" id="deadYearModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Dead Year Application</h3>
                <button class="modal-close" onclick="closeModal('deadYearModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="deadYearForm">
                <div class="form-group">
                    <label class="form-label">Reason for Dead Year</label>
                    <textarea class="form-input" rows="4" placeholder="Explain why you need a dead year" required></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Duration</label>
                    <select class="form-select" required>
                        <option value="">Select duration</option>
                        <option value="1">1 Semester</option>
                        <option value="2">2 Semesters (1 Year)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Supporting Documents</label>
                    <input type="file" class="form-input" accept=".pdf,.doc,.docx">
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i>
                    Submit Application
                </button>
            </form>
        </div>
    </div>

    <!-- Leave Modal -->
    <div class="modal" id="leaveModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Leave Application</h3>
                <button class="modal-close" onclick="closeModal('leaveModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="leaveForm">
                <div class="form-group">
                    <label class="form-label">Leave Type</label>
                    <select class="form-select" required>
                        <option value="">Select leave type</option>
                        <option value="medical">Medical Leave</option>
                        <option value="personal">Personal Leave</option>
                        <option value="family">Family Emergency</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Start Date</label>
                    <input type="date" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">End Date</label>
                    <input type="date" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Reason</label>
                    <textarea class="form-input" rows="4" placeholder="Explain your reason for leave" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i>
                    Submit Application
                </button>
            </form>
        </div>
    </div>

    <!-- Treatment Modal -->
    <div class="modal" id="treatmentModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Treatment Request</h3>
                <button class="modal-close" onclick="closeModal('treatmentModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="treatmentForm">
                <div class="form-group">
                    <label class="form-label">Medical Condition</label>
                    <input type="text" class="form-input" placeholder="Describe your medical condition" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Treatment Type</label>
                    <select class="form-select" required>
                        <option value="">Select treatment type</option>
                        <option value="consultation">Consultation</option>
                        <option value="medication">Medication</option>
                        <option value="procedure">Medical Procedure</option>
                        <option value="emergency">Emergency Treatment</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Urgency Level</label>
                    <select class="form-select" required>
                        <option value="">Select urgency</option>
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                        <option value="emergency">Emergency</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Additional Notes</label>
                    <textarea class="form-input" rows="4" placeholder="Any additional information"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i>
                    Submit Request
                </button>
            </form>
        </div>
    </div>

    <!-- Complaint Modal -->
    <div class="modal" id="complaintModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">File Complaint</h3>
                <button class="modal-close" onclick="closeModal('complaintModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="complaintForm">
                <div class="form-group">
                    <label class="form-label">Complaint Category</label>
                    <select class="form-select" required>
                        <option value="">Select category</option>
                        <option value="academic">Academic Issues</option>
                        <option value="facilities">Facilities</option>
                        <option value="staff">Staff Related</option>
                        <option value="student">Student Related</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Subject</label>
                    <input type="text" class="form-input" placeholder="Brief subject of complaint" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Detailed Description</label>
                    <textarea class="form-input" rows="6" placeholder="Provide detailed description of your complaint" required></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Desired Resolution</label>
                    <textarea class="form-input" rows="3" placeholder="What outcome would you like?"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i>
                    Submit Complaint
                </button>
            </form>
        </div>
    </div>

    <script>
        // Enhanced Dashboard Functions
        
        // Timetable Tab Function
        function showTab(day) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            
            // Remove active class from all tab buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            
            // Show selected tab content
            document.getElementById(day + '-tab').classList.add('active');
            
            // Add active class to clicked button
            event.target.classList.add('active');
        }
        
        // Emergency Call Function
        function callEmergency(phone) {
            if (confirm(`Are you sure you want to call ${phone}?`)) {
                // In a real application, this would initiate a phone call
                alert(`Calling ${phone}...`);
                console.log('Emergency call to:', phone);
            }
        }
        
        // Message Read Function
        function markAsRead(messageId) {
            // In a real application, this would update the database
            const messageItem = document.querySelector(`[data-message-id="${messageId}"]`);
            if (messageItem) {
                messageItem.classList.remove('unread');
                const unreadIndicator = messageItem.querySelector('.unread-indicator');
                if (unreadIndicator) {
                    unreadIndicator.remove();
                }
            }
        }
        
        // Library Resource Access
        function accessResource(resourceType, title) {
            if (confirm(`Access ${title}?`)) {
                // In a real application, this would open the resource
                alert(`Opening ${title}...`);
                console.log('Accessing resource:', resourceType, title);
            }
        }
        
        // Calendar Event Reminder
        function setReminder(eventTitle, eventDate) {
            if (confirm(`Set reminder for "${eventTitle}" on ${eventDate}?`)) {
                // In a real application, this would set a calendar reminder
                alert(`Reminder set for ${eventTitle}`);
                console.log('Reminder set:', eventTitle, eventDate);
            }
        }
        
        // Download Academic Document
        function downloadDocument(documentType) {
            // In a real application, this would download the document
            alert(`Downloading ${documentType}...`);
            console.log('Downloading:', documentType);
        }
        
        // Print Academic Record
        function printAcademicRecord() {
            window.print();
        }
        
        // Refresh Dashboard Data
        function refreshDashboard() {
            // Show loading state
            const refreshBtn = document.querySelector('.refresh-btn');
            if (refreshBtn) {
                refreshBtn.innerHTML = '<span class="spinner"></span> Refreshing...';
                refreshBtn.disabled = true;
            }
            
            // Simulate data refresh
            setTimeout(() => {
                if (refreshBtn) {
                    refreshBtn.innerHTML = '<i class="fas fa-sync-alt"></i> Refresh';
                    refreshBtn.disabled = false;
                }
                
                // In a real application, this would fetch fresh data from the server
                console.log('Dashboard data refreshed');
                alert('Dashboard data refreshed successfully!');
            }, 2000);
        }
        
        // Search Function
        function searchDashboard(query) {
            // In a real application, this would filter dashboard content
            console.log('Searching for:', query);
            
            // Simple search implementation
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                const text = card.textContent.toLowerCase();
                if (text.includes(query.toLowerCase())) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
        
        // Notification System
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.innerHTML = `
                <div class="notification-content">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
                    <span>${message}</span>
                </div>
                <button class="notification-close" onclick="this.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            `;
            
            // Add notification styles if not already present
            if (!document.querySelector('#notification-styles')) {
                const style = document.createElement('style');
                style.id = 'notification-styles';
                style.textContent = `
                    .notification {
                        position: fixed;
                        top: 20px;
                        right: 20px;
                        background: var(--white);
                        border-radius: var(--radius-lg);
                        padding: var(--space-4);
                        box-shadow: var(--shadow-xl);
                        z-index: 3000;
                        display: flex;
                        align-items: center;
                        gap: var(--space-3);
                        min-width: 300px;
                        animation: slideInRight 0.3s ease-out;
                    }
                    .notification.success {
                        border-left: 4px solid var(--success-green);
                    }
                    .notification.error {
                        border-left: 4px solid var(--error-red);
                    }
                    .notification.info {
                        border-left: 4px solid var(--accent-blue);
                    }
                    .notification-content {
                        display: flex;
                        align-items: center;
                        gap: var(--space-2);
                        flex: 1;
                    }
                    .notification-close {
                        background: none;
                        border: none;
                        color: var(--text-secondary);
                        cursor: pointer;
                        padding: var(--space-2);
                    }
                    @keyframes slideInRight {
                        from {
                            transform: translateX(100%);
                            opacity: 0;
                        }
                        to {
                            transform: translateX(0);
                            opacity: 1;
                        }
                    }
                `;
                document.head.appendChild(style);
            }
            
            document.body.appendChild(notification);
            
            // Auto-remove after 5 seconds
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.remove();
                }
            }, 5000);
        }
        
        // Enhanced Announcements Functions
        function filterAnnouncements(category) {
            // Update button states
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');
            
            // Filter announcements
            const announcements = document.querySelectorAll('.announcement-item');
            announcements.forEach(item => {
                if (category === 'all') {
                    item.style.display = 'block';
                } else {
                    const itemCategory = item.getAttribute('data-category');
                    item.style.display = itemCategory === category ? 'block' : 'none';
                }
            });
        }
        
        function markAnnouncementAsRead(announcementId) {
            // In a real application, this would update the database
            const announcement = document.querySelector(`[data-announcement-id="${announcementId}"]`);
            if (announcement) {
                announcement.style.opacity = '0.6';
                showNotification('Announcement marked as read', 'success');
            }
            console.log('Marked announcement as read:', announcementId);
        }
        
        function shareAnnouncement(announcementId) {
            // In a real application, this would open a share dialog
            if (confirm('Share this announcement with other students?')) {
                showNotification('Announcement shared successfully!', 'success');
                console.log('Shared announcement:', announcementId);
            }
        }
        
        // Initialize Enhanced Features
        document.addEventListener('DOMContentLoaded', function() {
            // Add click handlers to resource items
            document.querySelectorAll('.resource-item').forEach(item => {
                item.addEventListener('click', function() {
                    const title = this.querySelector('.resource-title').textContent;
                    const type = this.querySelector('.resource-icon i').className;
                    accessResource(type, title);
                });
            });
            
            // Add click handlers to message items
            document.querySelectorAll('.message-item').forEach(item => {
                item.addEventListener('click', function() {
                    if (this.classList.contains('unread')) {
                        this.classList.remove('unread');
                        const unreadIndicator = this.querySelector('.unread-indicator');
                        if (unreadIndicator) {
                            unreadIndicator.remove();
                        }
                        showNotification('Message marked as read', 'success');
                    }
                });
            });
            
            // Add click handlers to calendar events
            document.querySelectorAll('.event-item').forEach(item => {
                item.addEventListener('click', function() {
                    const title = this.querySelector('.event-title').textContent;
                    const date = this.querySelector('.event-date').textContent.trim();
                    setReminder(title, date);
                });
            });
            
            // Add search functionality
            const searchInput = document.createElement('input');
            searchInput.type = 'text';
            searchInput.placeholder = 'Search dashboard...';
            searchInput.className = 'search-input';
            searchInput.style.cssText = `
                position: fixed;
                top: 80px;
                right: 20px;
                padding: var(--space-3);
                border: 2px solid var(--gray-200);
                border-radius: var(--radius-lg);
                font-size: var(--text-sm);
                width: 250px;
                z-index: 1000;
            `;
            
            searchInput.addEventListener('input', function() {
                searchDashboard(this.value);
            });
            
            document.body.appendChild(searchInput);
            
            // Add refresh button
            const refreshBtn = document.createElement('button');
            refreshBtn.className = 'refresh-btn';
            refreshBtn.innerHTML = '<i class="fas fa-sync-alt"></i> Refresh';
            refreshBtn.style.cssText = `
                position: fixed;
                top: 80px;
                right: 280px;
                padding: var(--space-3);
                background: var(--gradient-primary);
                color: var(--white);
                border: none;
                border-radius: var(--radius-lg);
                font-size: var(--text-sm);
                cursor: pointer;
                z-index: 1000;
            `;
            
            refreshBtn.addEventListener('click', refreshDashboard);
            document.body.appendChild(refreshBtn);
            
            // Show welcome notification
            setTimeout(() => {
                showNotification('Welcome to your enhanced student dashboard!', 'success');
            }, 1000);
        });
        
        // Modal Functions
        function openModal(modalId) {
            document.getElementById(modalId).classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal(this.id);
                }
            });
        });

        // Form Submissions
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const amount = document.getElementById('paymentAmount').value;
            const method = document.getElementById('paymentMethod').value;
            const reference = document.getElementById('paymentReference').value;
            
            // Show loading
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<span class="spinner"></span> Processing...';
            submitBtn.disabled = true;
            
            // Simulate payment processing
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                
                alert(`Payment of UGX ${amount} via ${method} processed successfully!`);
                
                // Reset form
                this.reset();
                
                // Update finance display (in real app, this would update from backend)
                updateFinanceDisplay(amount);
            }, 2000);
        });

        // Request form handlers
        document.getElementById('deadYearForm').addEventListener('submit', function(e) {
            e.preventDefault();
            submitRequest('Dead Year Application', this);
        });

        document.getElementById('leaveForm').addEventListener('submit', function(e) {
            e.preventDefault();
            submitRequest('Leave Application', this);
        });

        document.getElementById('treatmentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            submitRequest('Treatment Request', this);
        });

        document.getElementById('complaintForm').addEventListener('submit', function(e) {
            e.preventDefault();
            submitRequest('Complaint', this);
        });

        function submitRequest(type, form) {
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<span class="spinner"></span> Submitting...';
            submitBtn.disabled = true;
            
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                
                alert(`${type} submitted successfully! We will process your request and notify you soon.`);
                
                // Close modal and reset form
                form.closest('.modal').classList.remove('active');
                form.reset();
                document.body.style.overflow = 'auto';
            }, 2000);
        }

        // Print receipt function
        function printReceipt() {
            const studentData = {
                name: '<?php echo htmlspecialchars($student['name']); ?>',
                id: '<?php echo htmlspecialchars($student['id']); ?>',
                program: '<?php echo htmlspecialchars($student['program']); ?>',
                balance: '<?php echo number_format($student['finance']['balance']); ?>',
                paid: '<?php echo number_format($student['finance']['paid_amount']); ?>',
                total: '<?php echo number_format($student['finance']['total_fees']); ?>'
            };
            
            // Create receipt content
            const receiptContent = `
                <div style="font-family: Arial, sans-serif; padding: 20px; max-width: 400px; margin: 0 auto;">
                    <h2 style="text-align: center; color: #0a1628;">ISNM Fee Receipt</h2>
                    <hr style="margin: 20px 0;">
                    <p><strong>Student Name:</strong> ${studentData.name}</p>
                    <p><strong>Student ID:</strong> ${studentData.id}</p>
                    <p><strong>Program:</strong> ${studentData.program}</p>
                    <hr style="margin: 20px 0;">
                    <p><strong>Total Fees:</strong> UGX ${studentData.total}</p>
                    <p><strong>Amount Paid:</strong> UGX ${studentData.paid}</p>
                    <p><strong>Outstanding Balance:</strong> UGX ${studentData.balance}</p>
                    <hr style="margin: 20px 0;">
                    <p style="text-align: center; font-size: 12px; color: #666;">
                        Printed on: ${new Date().toLocaleString()}
                    </p>
                    <p style="text-align: center; font-size: 12px; color: #666;">
                        Iganga School of Nursing and Midwifery
                    </p>
                </div>
            `;
            
            // Open print window
            const printWindow = window.open('', '_blank');
            printWindow.document.write(receiptContent);
            printWindow.document.close();
            printWindow.print();
        }

        // Update finance display (simulation)
        function updateFinanceDisplay(paymentAmount) {
            // In real application, this would fetch updated data from backend
            console.log('Payment processed:', paymentAmount);
        }

        // Auto-refresh announcements
        setInterval(() => {
            // In real application, this would fetch new announcements from backend
            console.log('Checking for new announcements...');
        }, 30000); // Check every 30 seconds

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Student dashboard loaded');
            console.log('Gender:', '<?php echo $student['gender']; ?>');
            console.log('Filtered announcements:', <?php echo count($filtered_announcements); ?>);
        });
    </script>
</body>
</html>
