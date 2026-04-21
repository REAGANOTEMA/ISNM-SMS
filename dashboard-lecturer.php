<?php
// Start session
session_start();

// Check if user is logged in and is lecturer
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'lecturer') {
    header('Location: login-portal.php');
    exit();
}

// Mock lecturer data - in production, this would come from database
$lecturer = [
    'id' => 'LEC001',
    'name' => 'Dr. Sarah Johnson',
    'position' => 'Senior Lecturer',
    'email' => 'lecturer@isnm.ac.ug',
    'phone' => '+256 772 514 889',
    'department' => 'Nursing Department',
    'specialization' => 'Medical-Surgical Nursing',
    'join_date' => '2017-08-20'
];

// Mock teaching data for comprehensive dashboard
$teaching_stats = [
    'total_students' => 156,
    'courses_teaching' => 4,
    'classes_today' => 3,
    'assignments_pending' => 23,
    'exams_to_grade' => 45,
    'office_hours_today' => 5,
    'research_projects' => 2,
    'publications' => 8
];

// Mock courses being taught
$courses_teaching = [
    ['code' => 'NUR301', 'name' => 'Medical-Surgical Nursing I', 'level' => 'Year 3', 'students' => 45, 'credits' => 4, 'schedule' => 'Mon/Wed/Fri 9:00-11:00 AM'],
    ['code' => 'NUR302', 'name' => 'Pharmacology for Nurses', 'level' => 'Year 3', 'students' => 38, 'credits' => 3, 'schedule' => 'Tue/Thu 2:00-4:00 PM'],
    ['code' => 'NUR401', 'name' => 'Advanced Nursing Practice', 'level' => 'Year 4', 'students' => 42, 'credits' => 4, 'schedule' => 'Mon/Wed 1:00-3:00 PM'],
    ['code' => 'NUR201', 'name' => 'Fundamentals of Nursing', 'level' => 'Year 2', 'students' => 31, 'credits' => 3, 'schedule' => 'Tue/Thu 9:00-11:00 AM']
];

// Mock student performance
$student_performance = [
    ['student_name' => 'Aisha Nankya', 'course' => 'NUR301', 'current_grade' => 'B+', 'attendance' => 92, 'assignments_completed' => 8, 'status' => 'excellent'],
    ['student_name' => 'David Kato', 'course' => 'NUR301', 'current_grade' => 'B', 'attendance' => 88, 'assignments_completed' => 7, 'status' => 'good'],
    ['student_name' => 'Grace Lutaaya', 'course' => 'NUR302', 'current_grade' => 'A-', 'attendance' => 95, 'assignments_completed' => 9, 'status' => 'excellent'],
    ['student_name' => 'Joseph Mwanga', 'course' => 'NUR401', 'current_grade' => 'B+', 'attendance' => 90, 'assignments_completed' => 8, 'status' => 'good'],
    ['student_name' => 'Sarah Nalwoga', 'course' => 'NUR201', 'current_grade' => 'A', 'attendance' => 98, 'assignments_completed' => 10, 'status' => 'excellent']
];

// Mock assignments and grading
$assignments_grading = [
    ['title' => 'Mid-term Exam - NUR301', 'course' => 'NUR301', 'due_date' => '2024-01-25', 'submissions' => 42, 'graded' => 38, 'urgency' => 'high'],
    ['title' => 'Case Study Analysis - NUR302', 'course' => 'NUR302', 'due_date' => '2024-01-28', 'submissions' => 35, 'graded' => 30, 'urgency' => 'medium'],
    ['title' => 'Clinical Reflection - NUR401', 'course' => 'NUR401', 'due_date' => '2024-01-30', 'submissions' => 40, 'graded' => 25, 'urgency' => 'medium'],
    ['title' => 'Drug Calculation Test - NUR302', 'course' => 'NUR302', 'due_date' => '2024-02-02', 'submissions' => 37, 'graded' = 15, 'urgency' => 'low'],
    ['title' => 'Nursing Care Plan - NUR201', 'course' => 'NUR201', 'due_date' => '2024-02-05', 'submissions' => 28, 'graded' => 10, 'urgency' => 'low']
];

// Mock class schedule
$class_schedule = [
    ['time' => '9:00-11:00 AM', 'course' => 'NUR301', 'room' => 'Lecture Hall A', 'topic' => 'Cardiovascular Assessment', 'type' => 'lecture'],
    ['time' => '11:30 AM-1:00 PM', 'course' => 'Office Hours', 'room' => 'Office 201', 'topic' => 'Student Consultation', 'type' => 'office'],
    ['time' => '2:00-4:00 PM', 'course' => 'NUR302', 'room' => 'Lab Room B', 'topic' => 'Drug Administration', 'type' => 'lab'],
    ['time' => '4:30-6:00 PM', 'course' => 'NUR401', 'room' => 'Seminar Room C', 'topic' => 'Critical Care Nursing', 'type' => 'seminar']
];

// Mock research activities
$research_activities = [
    ['title' => 'Impact of Simulation Training on Nursing Skills', 'status' => 'in_progress', 'funding' => 'UGX 5,000,000', 'collaborators' => 3, 'deadline' => '2024-06-30'],
    ['title' => 'Patient Satisfaction in Emergency Care', 'status' => 'data_collection', 'funding' => 'UGX 3,500,000', 'collaborators' => 2, 'deadline' => '2024-04-30'],
    ['title' => 'Mental Health Support for Nursing Students', 'status' => 'proposal', 'funding' => 'UGX 2,000,000', 'collaborators' => 4, 'deadline' => '2024-03-31']
];

// Mock announcements and notices
$announcements = [
    ['title' => 'Faculty Meeting - Curriculum Review', 'date' => '2024-01-25', 'sender' => 'Academic Registrar', 'priority' => 'high'],
    ['title' => 'Research Grant Application Deadline', 'date' => '2024-01-28', 'sender' => 'Research Office', 'priority' => 'medium'],
    ['title' => 'Professional Development Workshop', 'date' => '2024-01-30', 'sender' => 'HR Department', 'priority' => 'low'],
    ['title' => 'Student Academic Advising Schedule', 'date' => '2024-02-01', 'sender' => 'Student Affairs', 'priority' => 'medium']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Dashboard - ISNM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        :root {
            /* Lecturer Color Palette */
            --primary-dark: #1e3a8a;
            --accent-blue: #3b82f6;
            --accent-indigo: #6366f1;
            --accent-purple: #8b5cf6;
            --success-green: #22c55e;
            --warning-amber: #f59e0b;
            --danger-red: #ef4444;
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
            
            /* Lecturer Gradients */
            --gradient-academic: linear-gradient(135deg, var(--primary-dark) 0%, var(--accent-indigo) 50%, var(--accent-purple) 100%);
            --gradient-primary: linear-gradient(135deg, var(--primary-dark) 0%, var(--accent-blue) 100%);
            --gradient-indigo: linear-gradient(135deg, var(--accent-indigo) 0%, #4f46e5 100%);
            --gradient-purple: linear-gradient(135deg, var(--accent-purple) 0%, #7c3aed 100%);
            --gradient-success: linear-gradient(135deg, var(--success-green) 0%, #16a34a 100%);
            --gradient-warning: linear-gradient(135deg, var(--warning-amber) 0%, #d97706 100%);
            --gradient-danger: linear-gradient(135deg, var(--danger-red) 0%, #dc2626 100%);
            
            /* Shadows */
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.07);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px rgba(0, 0, 0, 0.1);
            --shadow-2xl: 0 25px 50px rgba(0, 0, 0, 0.25);
            --shadow-academic: 0 8px 16px rgba(99, 102, 241, 0.3);
            
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
            background: linear-gradient(135deg, var(--gray-50) 0%, var(--white) 100%);
            color: var(--gray-900);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        .dashboard {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar Navigation */
        .sidebar {
            width: 280px;
            background: var(--white);
            box-shadow: var(--shadow-xl);
            border-right: 1px solid var(--gray-200);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
        }
        
        .sidebar-header {
            padding: var(--space-6);
            background: var(--gradient-academic);
            color: var(--white);
            border-bottom: 2px solid var(--accent-purple);
        }
        
        .school-logo {
            width: 60px;
            height: 60px;
            border-radius: var(--radius-full);
            margin: 0 auto var(--space-4);
            background: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--primary-dark);
            box-shadow: var(--shadow-lg);
            border: 2px solid var(--accent-purple);
        }
        
        .user-info {
            text-align: center;
        }
        
        .user-name {
            font-size: var(--text-lg);
            font-weight: 700;
            margin-bottom: var(--space-1);
        }
        
        .user-position {
            font-size: var(--text-sm);
            opacity: 0.9;
            margin-bottom: var(--space-2);
        }
        
        .user-email {
            font-size: var(--text-xs);
            opacity: 0.8;
        }
        
        .nav-menu {
            list-style: none;
            padding: var(--space-4) 0;
        }
        
        .nav-item {
            margin-bottom: var(--space-1);
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            padding: var(--space-3) var(--space-6);
            color: var(--gray-700);
            text-decoration: none;
            transition: all var(--transition-normal);
            border-left: 3px solid transparent;
            font-weight: 500;
        }
        
        .nav-link:hover {
            background: var(--gray-50);
            color: var(--accent-blue);
            border-left-color: var(--accent-blue);
        }
        
        .nav-link.active {
            background: rgba(59, 130, 246, 0.1);
            color: var(--accent-blue);
            border-left-color: var(--accent-blue);
        }
        
        .nav-link i {
            width: 20px;
            text-align: center;
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: var(--space-8);
            min-height: 100vh;
        }
        
        /* Header */
        .header {
            background: var(--white);
            border-radius: var(--radius-2xl);
            padding: var(--space-8);
            box-shadow: var(--shadow-lg);
            margin-bottom: var(--space-8);
            border: 1px solid var(--gray-200);
        }
        
        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--space-4);
        }
        
        .header-title {
            font-size: var(--text-3xl);
            font-weight: 800;
            color: var(--primary-dark);
            margin-bottom: var(--space-2);
        }
        
        .header-subtitle {
            color: var(--gray-600);
            font-size: var(--text-lg);
        }
        
        .header-actions {
            display: flex;
            gap: var(--space-3);
        }
        
        .btn {
            padding: var(--space-3) var(--space-6);
            border-radius: var(--radius-lg);
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: var(--space-2);
            transition: all var(--transition-normal);
            border: none;
            cursor: pointer;
            font-size: var(--text-sm);
        }
        
        .btn-primary {
            background: var(--gradient-primary);
            color: var(--white);
            box-shadow: var(--shadow-md);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }
        
        .btn-secondary {
            background: var(--gray-100);
            color: var(--gray-700);
            border: 1px solid var(--gray-200);
        }
        
        .btn-secondary:hover {
            background: var(--gray-200);
        }
        
        .btn-indigo {
            background: var(--gradient-indigo);
            color: var(--white);
            box-shadow: var(--shadow-academic);
        }
        
        .btn-indigo:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-xl);
        }
        
        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: var(--space-6);
            margin-bottom: var(--space-8);
        }
        
        .stat-card {
            background: var(--white);
            border-radius: var(--radius-2xl);
            padding: var(--space-6);
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--gray-200);
            transition: all var(--transition-normal);
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }
        
        .stat-card.indigo::before {
            background: var(--gradient-indigo);
        }
        
        .stat-card.purple::before {
            background: var(--gradient-purple);
        }
        
        .stat-card.success::before {
            background: var(--gradient-success);
        }
        
        .stat-card.warning::before {
            background: var(--gradient-warning);
        }
        
        .stat-card.danger::before {
            background: var(--gradient-danger);
        }
        
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-xl);
        }
        
        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--space-4);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: var(--radius-xl);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--white);
            background: var(--gradient-primary);
            box-shadow: var(--shadow-md);
        }
        
        .stat-icon.indigo {
            background: var(--gradient-indigo);
        }
        
        .stat-icon.purple {
            background: var(--gradient-purple);
        }
        
        .stat-icon.success {
            background: var(--gradient-success);
        }
        
        .stat-icon.warning {
            background: var(--gradient-warning);
        }
        
        .stat-icon.danger {
            background: var(--gradient-danger);
        }
        
        .stat-value {
            font-size: var(--text-4xl);
            font-weight: 800;
            color: var(--primary-dark);
            margin-bottom: var(--space-2);
        }
        
        .stat-label {
            color: var(--gray-600);
            font-size: var(--text-sm);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        .stat-change {
            display: inline-flex;
            align-items: center;
            gap: var(--space-1);
            padding: var(--space-1) var(--space-2);
            border-radius: var(--radius-full);
            font-size: var(--text-xs);
            font-weight: 600;
        }
        
        .stat-change.positive {
            background: rgba(34, 197, 94, 0.1);
            color: var(--success-green);
        }
        
        .stat-change.negative {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-red);
        }
        
        /* Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: var(--space-8);
            margin-bottom: var(--space-8);
        }
        
        .card {
            background: var(--white);
            border-radius: var(--radius-2xl);
            padding: var(--space-6);
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--gray-200);
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--space-6);
            padding-bottom: var(--space-4);
            border-bottom: 1px solid var(--gray-200);
        }
        
        .card-title {
            font-size: var(--text-xl);
            font-weight: 700;
            color: var(--primary-dark);
            display: flex;
            align-items: center;
            gap: var(--space-3);
        }
        
        .card-title i {
            color: var(--accent-purple);
        }
        
        /* Tables */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: var(--space-4);
        }
        
        .table th,
        .table td {
            padding: var(--space-3);
            text-align: left;
            border-bottom: 1px solid var(--gray-100);
        }
        
        .table th {
            font-weight: 600;
            color: var(--gray-700);
            background: var(--gray-50);
        }
        
        .table tbody tr:hover {
            background: var(--gray-50);
        }
        
        /* Lists */
        .list {
            list-style: none;
        }
        
        .list-item {
            padding: var(--space-4) 0;
            border-bottom: 1px solid var(--gray-100);
            transition: all var(--transition-fast);
        }
        
        .list-item:last-child {
            border-bottom: none;
        }
        
        .list-item:hover {
            background: var(--gray-50);
            margin: 0 calc(-1 * var(--space-6));
            padding: var(--space-4) var(--space-6);
            border-radius: var(--radius-lg);
        }
        
        .list-item-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--space-2);
        }
        
        .list-item-title {
            font-weight: 600;
            color: var(--primary-dark);
        }
        
        .list-item-meta {
            display: flex;
            gap: var(--space-3);
            align-items: center;
        }
        
        .list-item-date {
            font-size: var(--text-xs);
            color: var(--gray-500);
        }
        
        .list-item-status {
            padding: var(--space-1) var(--space-3);
            border-radius: var(--radius-full);
            font-size: var(--text-xs);
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .list-item-status.excellent {
            background: rgba(34, 197, 94, 0.1);
            color: var(--success-green);
        }
        
        .list-item-status.good {
            background: rgba(59, 130, 246, 0.1);
            color: var(--accent-blue);
        }
        
        .list-item-status.in_progress {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning-amber);
        }
        
        .list-item-status.data_collection {
            background: rgba(99, 102, 241, 0.1);
            color: var(--accent-indigo);
        }
        
        .list-item-status.proposal {
            background: rgba(139, 92, 246, 0.1);
            color: var(--accent-purple);
        }
        
        .list-item-description {
            color: var(--gray-600);
            font-size: var(--text-sm);
        }
        
        .urgency-badge {
            padding: var(--space-1) var(--space-2);
            border-radius: var(--radius-full);
            font-size: var(--text-xs);
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .urgency-badge.high {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-red);
        }
        
        .urgency-badge.medium {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning-amber);
        }
        
        .urgency-badge.low {
            background: rgba(34, 197, 94, 0.1);
            color: var(--success-green);
        }
        
        .priority-badge {
            padding: var(--space-1) var(--space-2);
            border-radius: var(--radius-full);
            font-size: var(--text-xs);
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .priority-badge.high {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-red);
        }
        
        .priority-badge.medium {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning-amber);
        }
        
        .priority-badge.low {
            background: rgba(34, 197, 94, 0.1);
            color: var(--success-green);
        }
        
        /* Responsive Design */
        @media (max-width: 1200px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            
            .main-content {
                margin-left: 0;
                padding: var(--space-4);
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .header-top {
                flex-direction: column;
                gap: var(--space-4);
                align-items: flex-start;
            }
        }
        
        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .stat-card, .card {
            animation: fadeIn 0.6s ease-out;
        }
        
        .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.3s; }
        .stat-card:nth-child(4) { animation-delay: 0.4s; }
        .card:nth-child(1) { animation-delay: 0.5s; }
        .card:nth-child(2) { animation-delay: 0.6s; }
    </style>
</head>
<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="school-logo">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <div class="user-info">
                    <div class="user-name"><?php echo htmlspecialchars($lecturer['name']); ?></div>
                    <div class="user-position"><?php echo htmlspecialchars($lecturer['position']); ?></div>
                    <div class="user-email"><?php echo htmlspecialchars($lecturer['email']); ?></div>
                </div>
            </div>
            
            <nav>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Lecturer Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-book"></i>
                            <span>My Courses</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-users"></i>
                            <span>Student Performance</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-clipboard-check"></i>
                            <span>Assignments & Grading</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-calendar"></i>
                            <span>Class Schedule</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-microscope"></i>
                            <span>Research Activities</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-bullhorn"></i>
                            <span>Announcements</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-chart-line"></i>
                            <span>Performance Reports</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-cog"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="login-portal.php" class="nav-link" style="color: var(--danger-red);">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>
        
        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="header-top">
                    <div>
                        <h1 class="header-title">Academic Dashboard</h1>
                        <p class="header-subtitle">Teaching, Research & Student Mentorship</p>
                    </div>
                    <div class="header-actions">
                        <button class="btn btn-secondary">
                            <i class="fas fa-download"></i>
                            Export Report
                        </button>
                        <button class="btn btn-indigo">
                            <i class="fas fa-calendar-plus"></i>
                            Schedule Office Hours
                        </button>
                    </div>
                </div>
            </header>
            
            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card indigo">
                    <div class="stat-header">
                        <div class="stat-icon indigo">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i>
                            8%
                        </div>
                    </div>
                    <div class="stat-value"><?php echo number_format($teaching_stats['total_students']); ?></div>
                    <div class="stat-label">Total Students</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i>
                            2
                        </div>
                    </div>
                    <div class="stat-value"><?php echo $teaching_stats['courses_teaching']; ?></div>
                    <div class="stat-label">Courses Teaching</div>
                </div>
                
                <div class="stat-card purple">
                    <div class="stat-header">
                        <div class="stat-icon purple">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <div class="stat-change negative">
                            <i class="fas fa-arrow-down"></i>
                            12%
                        </div>
                    </div>
                    <div class="stat-value"><?php echo $teaching_stats['assignments_pending']; ?></div>
                    <div class="stat-label">Assignments to Grade</div>
                </div>
                
                <div class="stat-card success">
                    <div class="stat-header">
                        <div class="stat-icon success">
                            <i class="fas fa-microscope"></i>
                        </div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i>
                            1
                        </div>
                    </div>
                    <div class="stat-value"><?php echo $teaching_stats['research_projects']; ?></div>
                    <div class="stat-label">Research Projects</div>
                </div>
            </div>
            
            <!-- Content Grid -->
            <div class="content-grid">
                <!-- Courses Teaching Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-book"></i>
                            Courses Teaching
                        </h2>
                        <button class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Add Course
                        </button>
                    </div>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Course Code</th>
                                <th>Course Name</th>
                                <th>Students</th>
                                <th>Credits</th>
                                <th>Schedule</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($courses_teaching as $course): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($course['code']); ?></td>
                                    <td><?php echo htmlspecialchars($course['name']); ?></td>
                                    <td><?php echo $course['students']; ?></td>
                                    <td><?php echo $course['credits']; ?></td>
                                    <td><?php echo htmlspecialchars($course['schedule']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Student Performance Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-users"></i>
                            Student Performance
                        </h2>
                        <button class="btn btn-indigo">
                            <i class="fas fa-chart-line"></i>
                            View All
                        </button>
                    </div>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Course</th>
                                <th>Grade</th>
                                <th>Attendance</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($student_performance as $student): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($student['student_name']); ?></td>
                                    <td><?php echo htmlspecialchars($student['course']); ?></td>
                                    <td><?php echo htmlspecialchars($student['current_grade']); ?></td>
                                    <td><?php echo $student['attendance']; ?>%</td>
                                    <td>
                                        <span class="list-item-status <?php echo $student['status']; ?>">
                                            <?php echo htmlspecialchars(ucfirst($student['status'])); ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Assignments & Grading Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-clipboard-check"></i>
                            Assignments & Grading
                        </h2>
                        <button class="btn btn-primary">
                            <i class="fas fa-rocket"></i>
                            Grade All
                        </button>
                    </div>
                    
                    <ul class="list">
                        <?php foreach ($assignments_grading as $assignment): ?>
                            <li class="list-item">
                                <div class="list-item-header">
                                    <div class="list-item-title"><?php echo htmlspecialchars($assignment['title']); ?></div>
                                    <div class="urgency-badge <?php echo htmlspecialchars($assignment['urgency']); ?>">
                                        <?php echo htmlspecialchars(ucfirst($assignment['urgency'])); ?>
                                    </div>
                                </div>
                                <div class="list-item-description">
                                    Course: <?php echo htmlspecialchars($assignment['course']); ?> | Due: <?php echo htmlspecialchars($assignment['due_date']); ?>
                                    <br>Submissions: <?php echo $assignment['graded']; ?>/<?php echo $assignment['submissions']; ?> graded
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                
                <!-- Research Activities Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-microscope"></i>
                            Research Activities
                        </h2>
                        <button class="btn btn-indigo">
                            <i class="fas fa-plus"></i>
                            New Project
                        </button>
                    </div>
                    
                    <ul class="list">
                        <?php foreach ($research_activities as $research): ?>
                            <li class="list-item">
                                <div class="list-item-header">
                                    <div class="list-item-title"><?php echo htmlspecialchars($research['title']); ?></div>
                                    <div class="list-item-status <?php echo str_replace('_', '', $research['status']); ?>">
                                        <?php echo htmlspecialchars(ucwords(str_replace('_', ' ', $research['status']))); ?>
                                    </div>
                                </div>
                                <div class="list-item-description">
                                    Funding: <?php echo htmlspecialchars($research['funding']); ?> | Collaborators: <?php echo $research['collaborators']; ?>
                                    <br>Deadline: <?php echo htmlspecialchars($research['deadline']); ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </main>
    </div>
    
    <script>
        // Add interactive functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Handle navigation clicks
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', function(e) {
                    if (this.getAttribute('href') === '#') {
                        e.preventDefault();
                    }
                    
                    // Remove active class from all links
                    document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                    
                    // Add active class to clicked link
                    this.classList.add('active');
                });
            });
            
            // Handle button clicks with visual feedback
            document.querySelectorAll('.btn').forEach(button => {
                button.addEventListener('click', function() {
                    // Add ripple effect
                    const ripple = document.createElement('span');
                    ripple.style.position = 'absolute';
                    ripple.style.borderRadius = '50%';
                    ripple.style.background = 'rgba(255,255,255,0.5)';
                    ripple.style.width = ripple.style.height = '40px';
                    ripple.style.marginLeft = '-20px';
                    ripple.style.marginTop = '-20px';
                    ripple.style.animation = 'ripple 0.6s';
                    ripple.style.pointerEvents = 'none';
                    
                    this.style.position = 'relative';
                    this.style.overflow = 'hidden';
                    this.appendChild(ripple);
                    
                    setTimeout(() => ripple.remove(), 600);
                });
            });
        });
        
        // Add ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
