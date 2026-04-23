<?php
// Error reporting disabled for clean display
error_reporting(0);
ini_set('display_errors', 0);

// Start session if needed
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check authentication and role
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'academic-registrar') {
    header('Location: login.php');
    exit();
}

// Mock data for demonstration
$registrar_info = [
    'username' => $_SESSION['user']['username'],
    'name' => $_SESSION['user']['name'],
    'role' => $_SESSION['user']['role'],
    'login_time' => $_SESSION['user']['login_time']
];

// Mock academic statistics
$academic_stats = [
    'total_students' => 245,
    'new_admissions' => 68,
    'graduating_students' => 52,
    'transcripts_issued' => 124,
    'certificates_issued' => 45,
    'course_registrations' => 892,
    'academic_records' => 1847,
    'pending_registrations' => 15,
    'exam_schedules' => 24,
    'grade_submissions' => 156,
    'appeal_cases' => 8,
    'transcript_requests' => 32
];

// Mock recent registrations
$recent_registrations = [
    ['student_id' => '2024/068', 'name' => 'Alice Johnson', 'program' => 'Nursing', 'date' => '2024-01-22', 'status' => 'completed'],
    ['student_id' => '2024/069', 'name' => 'Bob Smith', 'program' => 'Midwifery', 'date' => '2024-01-22', 'status' => 'pending'],
    ['student_id' => '2024/070', 'name' => 'Carol Davis', 'program' => 'Nursing', 'date' => '2024-01-21', 'status' => 'completed'],
    ['student_id' => '2024/071', 'name' => 'David Wilson', 'program' => 'Midwifery', 'date' => '2024-01-21', 'status' => 'processing']
];

// Mock academic programs
$academic_programs = [
    ['name' => 'Diploma in Nursing', 'duration' => '3 Years', 'students' => 145, 'accredited' => true, 'code' => 'DN001'],
    ['name' => 'Diploma in Midwifery', 'duration' => '3 Years', 'students' => 100, 'accredited' => true, 'code' => 'DM001'],
    ['name' => 'Certificate in Nursing', 'duration' => '2 Years', 'students' => 0, 'accredited' => false, 'code' => 'CN001']
];

// Mock exam schedules
$exam_schedules = [
    ['course' => 'Anatomy & Physiology', 'date' => '2024-02-01', 'students' => 68, 'venue' => 'Exam Hall A'],
    ['course' => 'Pharmacology', 'date' => '2024-02-03', 'students' => 45, 'venue' => 'Exam Hall B'],
    ['course' => 'Nursing Practice', 'date' => '2024-02-05', 'students' => 52, 'venue' => 'Skills Lab'],
    ['course' => 'Midwifery Skills', 'date' => '2024-02-07', 'students' => 38, 'venue' => 'Skills Lab']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Registrar Dashboard - ISNM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #7c3aed 0%, #5b21b6 100%);
            min-height: 100vh;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 2rem;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .main-content {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 1rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #6b7280;
            font-size: 0.9rem;
        }

        .content-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .table th,
        .table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        .table th {
            background: #f9fafb;
            font-weight: 600;
            color: #1a1a1a;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #7c3aed 0%, #5b21b6 100%);
            color: white;
        }

        .btn-success {
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
            color: white;
        }

        .btn-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .welcome-text {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
        }

        .subtitle {
            color: #6b7280;
            margin-bottom: 1rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #7c3aed 0%, #5b21b6 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .nav-link {
            display: block;
            padding: 0.75rem;
            color: #6b7280;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background: rgba(124, 58, 237, 0.1);
            color: #7c3aed;
        }

        .nav-link.active {
            background: linear-gradient(135deg, #7c3aed 0%, #5b21b6 100%);
            color: white;
        }

        .section-content {
            display: none;
        }

        .section-content.active {
            display: block;
        }

        .status-completed { color: #059669; font-weight: 600; }
        .status-pending { color: #f59e0b; font-weight: 600; }
        .status-processing { color: #2563eb; font-weight: 600; }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .alert-warning {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fbbf24;
        }

        .alert-info {
            background: #dbeafe;
            color: #1e40af;
            border: 1px solid #60a5fa;
        }

        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-info {
            background: #dbeafe;
            color: #1e40af;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <div class="user-info">
                <div class="user-avatar">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div>
                    <div style="font-weight: 600;"><?php echo htmlspecialchars($registrar_info['name']); ?></div>
                    <div style="color: #6b7280; font-size: 0.9rem;">Academic Registrar</div>
                </div>
            </div>
            
            <nav style="margin-top: 2rem;">
                <a href="#" class="nav-link active" data-section="dashboard">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="#" class="nav-link" data-section="registration">
                    <i class="fas fa-user-plus"></i> Student Registration
                </a>
                <a href="#" class="nav-link" data-section="records">
                    <i class="fas fa-folder"></i> Academic Records
                </a>
                <a href="#" class="nav-link" data-section="exams">
                    <i class="fas fa-clipboard-check"></i> Examination Management
                </a>
                <a href="#" class="nav-link" data-section="transcripts">
                    <i class="fas fa-file-alt"></i> Transcripts & Certificates
                </a>
                <a href="#" class="nav-link" data-section="programs">
                    <i class="fas fa-graduation-cap"></i> Academic Programs
                </a>
                <a href="#" class="nav-link" data-section="reports">
                    <i class="fas fa-chart-line"></i> Academic Reports
                </a>
                <a href="#" class="nav-link" data-section="settings">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <a href="login.php?logout=1" style="display: block; padding: 0.75rem; color: #dc2626; text-decoration: none; border-radius: 8px; margin-top: 2rem;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </nav>
        </div>

        <div class="main-content">
            <!-- Dashboard Section -->
            <div id="dashboard" class="section-content active">
                <div class="header">
                    <div class="welcome-text">Academic Registrar Dashboard</div>
                    <div class="subtitle">Student Records & Academic Administration</div>
                    <div style="color: #6b7280; font-size: 0.9rem; margin-top: 0.5rem;">
                        Last login: <?php echo date('d M Y, h:i A', strtotime($registrar_info['login_time'])); ?>
                    </div>
                </div>

                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <div>
                        <strong>Pending Actions:</strong> <?php echo $academic_stats['pending_registrations']; ?> student registrations awaiting approval
                    </div>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #7c3aed 0%, #5b21b6 100%);">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-value"><?php echo number_format($academic_stats['total_students']); ?></div>
                        <div class="stat-label">Total Students</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="stat-value"><?php echo $academic_stats['new_admissions']; ?></div>
                        <div class="stat-label">New Admissions</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #2563eb 0%, #667eea 100%);">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="stat-value"><?php echo $academic_stats['transcripts_issued']; ?></div>
                        <div class="stat-label">Transcripts Issued</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);">
                            <i class="fas fa-award"></i>
                        </div>
                        <div class="stat-value"><?php echo $academic_stats['certificates_issued']; ?></div>
                        <div class="stat-label">Certificates Issued</div>
                    </div>
                </div>

                <div class="content-card">
                    <h3 style="margin-bottom: 1rem;">Recent Student Registrations</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Program</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recent_registrations as $registration): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($registration['student_id']); ?></td>
                                <td><?php echo htmlspecialchars($registration['name']); ?></td>
                                <td><?php echo htmlspecialchars($registration['program']); ?></td>
                                <td><?php echo date('d M Y', strtotime($registration['date'])); ?></td>
                                <td><span class="status-<?php echo $registration['status']; ?>"><?php echo ucfirst($registration['status']); ?></span></td>
                                <td>
                                    <?php if ($registration['status'] === 'pending'): ?>
                                        <button class="btn btn-primary" style="padding: 0.5rem; font-size: 0.9rem;">Review</button>
                                    <?php else: ?>
                                        <button class="btn btn-success" style="padding: 0.5rem; font-size: 0.9rem;">View</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="content-card">
                    <h3 style="margin-bottom: 1rem;">Quick Actions</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                        <button class="btn btn-primary">
                            <i class="fas fa-user-plus"></i> New Registration
                        </button>
                        <button class="btn btn-success">
                            <i class="fas fa-file-alt"></i> Issue Transcript
                        </button>
                        <button class="btn btn-warning">
                            <i class="fas fa-award"></i> Generate Certificate
                        </button>
                        <button class="btn" style="background: #6b7280; color: white;">
                            <i class="fas fa-calendar"></i> Schedule Exam
                        </button>
                    </div>
                </div>
            </div>

            <!-- Student Registration Section -->
            <div id="registration" class="section-content">
                <div class="header">
                    <div class="welcome-text">Student Registration</div>
                    <div class="subtitle">Manage student admissions and registrations</div>
                </div>

                <div class="content-card">
                    <h3>Registration Overview</h3>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="stat-value"><?php echo $academic_stats['new_admissions']; ?></div>
                            <div class="stat-label">New Admissions</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stat-value"><?php echo $academic_stats['pending_registrations']; ?></div>
                            <div class="stat-label">Pending Approval</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #2563eb 0%, #667eea 100%);">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="stat-value"><?php echo $academic_stats['course_registrations']; ?></div>
                            <div class="stat-label">Course Registrations</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #7c3aed 0%, #5b21b6 100%);">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="stat-value"><?php echo $academic_stats['graduating_students']; ?></div>
                            <div class="stat-label">Graduating Students</div>
                        </div>
                    </div>
                </div>

                <div class="content-card">
                    <h3>Registration Actions</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                        <button class="btn btn-primary">
                            <i class="fas fa-user-plus"></i> New Student
                        </button>
                        <button class="btn btn-success">
                            <i class="fas fa-book"></i> Course Registration
                        </button>
                        <button class="btn btn-warning">
                            <i class="fas fa-exchange-alt"></i> Transfer Student
                        </button>
                        <button class="btn" style="background: #6b7280; color: white;">
                            <i class="fas fa-download"></i> Export List
                        </button>
                    </div>
                </div>
            </div>

            <!-- Academic Records Section -->
            <div id="records" class="section-content">
                <div class="header">
                    <div class="welcome-text">Academic Records</div>
                    <div class="subtitle">Manage student academic files and records</div>
                </div>

                <div class="content-card">
                    <h3>Records Management</h3>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        <div>
                            <strong>Total Records:</strong> <?php echo number_format($academic_stats['academic_records']); ?> student academic files maintained
                        </div>
                    </div>

                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
                                <i class="fas fa-folder"></i>
                            </div>
                            <div class="stat-value"><?php echo number_format($academic_stats['academic_records']); ?></div>
                            <div class="stat-label">Total Records</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #2563eb 0%, #667eea 100%);">
                                <i class="fas fa-upload"></i>
                            </div>
                            <div class="stat-value">45</div>
                            <div class="stat-label">New Uploads</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);">
                                <i class="fas fa-edit"></i>
                            </div>
                            <div class="stat-value">12</div>
                            <div class="stat-label">Updates Today</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #7c3aed 0%, #5b21b6 100%);">
                                <i class="fas fa-search"></i>
                            </div>
                            <div class="stat-value">156</div>
                            <div class="stat-label">Searches Today</div>
                        </div>
                    </div>
                </div>

                <div class="content-card">
                    <h3>Records Actions</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                        <button class="btn btn-primary">
                            <i class="fas fa-upload"></i> Upload Document
                        </button>
                        <button class="btn btn-success">
                            <i class="fas fa-search"></i> Search Records
                        </button>
                        <button class="btn btn-warning">
                            <i class="fas fa-edit"></i> Update Record
                        </button>
                        <button class="btn" style="background: #6b7280; color: white;">
                            <i class="fas fa-archive"></i> Archive
                        </button>
                    </div>
                </div>
            </div>

            <!-- Examination Management Section -->
            <div id="exams" class="section-content">
                <div class="header">
                    <div class="welcome-text">Examination Management</div>
                    <div class="subtitle">Schedule and manage academic examinations</div>
                </div>

                <div class="content-card">
                    <h3>Upcoming Examinations</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Course</th>
                                <th>Date</th>
                                <th>Students</th>
                                <th>Venue</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($exam_schedules as $exam): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($exam['course']); ?></td>
                                <td><?php echo date('d M Y', strtotime($exam['date'])); ?></td>
                                <td><?php echo number_format($exam['students']); ?></td>
                                <td><?php echo htmlspecialchars($exam['venue']); ?></td>
                                <td><span class="badge badge-info">Scheduled</span></td>
                                <td>
                                    <button class="btn btn-primary" style="padding: 0.5rem; font-size: 0.9rem;">Manage</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="content-card">
                    <h3>Exam Statistics</h3>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
                                <i class="fas fa-calendar"></i>
                            </div>
                            <div class="stat-value"><?php echo $academic_stats['exam_schedules']; ?></div>
                            <div class="stat-label">Scheduled Exams</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #2563eb 0%, #667eea 100%);">
                                <i class="fas fa-clipboard-check"></i>
                            </div>
                            <div class="stat-value"><?php echo $academic_stats['grade_submissions']; ?></div>
                            <div class="stat-label">Grade Submissions</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);">
                                <i class="fas fa-gavel"></i>
                            </div>
                            <div class="stat-value"><?php echo $academic_stats['appeal_cases']; ?></div>
                            <div class="stat-label">Appeal Cases</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #7c3aed 0%, #5b21b6 100%);">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="stat-value">92%</div>
                            <div class="stat-label">Pass Rate</div>
                        </div>
                    </div>
                </div>

                <div class="content-card">
                    <h3>Exam Actions</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                        <button class="btn btn-primary">
                            <i class="fas fa-plus"></i> Schedule Exam
                        </button>
                        <button class="btn btn-success">
                            <i class="fas fa-clipboard-check"></i> Grade Entry
                        </button>
                        <button class="btn btn-warning">
                            <i class="fas fa-chart-bar"></i> Results Analysis
                        </button>
                        <button class="btn" style="background: #6b7280; color: white;">
                            <i class="fas fa-download"></i> Export Results
                        </button>
                    </div>
                </div>
            </div>

            <!-- Transcripts Section -->
            <div id="transcripts" class="section-content">
                <div class="header">
                    <div class="welcome-text">Transcripts & Certificates</div>
                    <div class="subtitle">Generate and manage academic documents</div>
                </div>

                <div class="content-card">
                    <h3>Document Statistics</h3>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="stat-value"><?php echo $academic_stats['transcripts_issued']; ?></div>
                            <div class="stat-label">Transcripts Issued</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #2563eb 0%, #667eea 100%);">
                                <i class="fas fa-award"></i>
                            </div>
                            <div class="stat-value"><?php echo $academic_stats['certificates_issued']; ?></div>
                            <div class="stat-label">Certificates Issued</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stat-value"><?php echo $academic_stats['transcript_requests']; ?></div>
                            <div class="stat-label">Pending Requests</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #7c3aed 0%, #5b21b6 100%);">
                                <i class="fas fa-print"></i>
                            </div>
                            <div class="stat-value">28</div>
                            <div class="stat-label">Printed Today</div>
                        </div>
                    </div>
                </div>

                <div class="content-card">
                    <h3>Document Actions</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                        <button class="btn btn-primary">
                            <i class="fas fa-file-alt"></i> Generate Transcript
                        </button>
                        <button class="btn btn-success">
                            <i class="fas fa-award"></i> Issue Certificate
                        </button>
                        <button class="btn btn-warning">
                            <i class="fas fa-stamp"></i> Verify Document
                        </button>
                        <button class="btn" style="background: #6b7280; color: white;">
                            <i class="fas fa-download"></i> Download Template
                        </button>
                    </div>
                </div>
            </div>

            <!-- Academic Programs Section -->
            <div id="programs" class="section-content">
                <div class="header">
                    <div class="welcome-text">Academic Programs</div>
                    <div class="subtitle">Manage academic programs and curriculum</div>
                </div>

                <div class="content-card">
                    <h3>Active Programs</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Program Name</th>
                                <th>Duration</th>
                                <th>Students</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($academic_programs as $program): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($program['name']); ?></td>
                                <td><?php echo htmlspecialchars($program['duration']); ?></td>
                                <td><?php echo number_format($program['students']); ?></td>
                                <td>
                                    <?php if ($program['accredited']): ?>
                                        <span class="badge badge-success">Accredited</span>
                                    <?php else: ?>
                                        <span class="badge badge-warning">Pending</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button class="btn btn-primary" style="padding: 0.5rem; font-size: 0.9rem;">Manage</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="content-card">
                    <h3>Program Actions</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                        <button class="btn btn-primary">
                            <i class="fas fa-plus"></i> New Program
                        </button>
                        <button class="btn btn-success">
                            <i class="fas fa-book"></i> Update Curriculum
                        </button>
                        <button class="btn btn-warning">
                            <i class="fas fa-award"></i> Accreditation
                        </button>
                        <button class="btn" style="background: #6b7280; color: white;">
                            <i class="fas fa-chart-line"></i> Program Review
                        </button>
                    </div>
                </div>
            </div>

            <!-- Reports Section -->
            <div id="reports" class="section-content">
                <div class="header">
                    <div class="welcome-text">Academic Reports</div>
                    <div class="subtitle">Generate comprehensive academic reports</div>
                </div>

                <div class="content-card">
                    <h3>Available Reports</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
                        <button class="btn btn-primary">
                            <i class="fas fa-users"></i> Student Enrollment
                        </button>
                        <button class="btn btn-success">
                            <i class="fas fa-chart-line"></i> Academic Performance
                        </button>
                        <button class="btn btn-warning">
                            <i class="fas fa-graduation-cap"></i> Graduation Report
                        </button>
                        <button class="btn" style="background: #6b7280; color: white;">
                            <i class="fas fa-calendar"></i> Academic Calendar
                        </button>
                        <button class="btn" style="background: #10b981; color: white;">
                            <i class="fas fa-clipboard-check"></i> Examination Results
                        </button>
                        <button class="btn" style="background: #8b5cf6; color: white;">
                            <i class="fas fa-file-alt"></i> Transcript Summary
                        </button>
                    </div>
                </div>
            </div>

            <!-- Settings Section -->
            <div id="settings" class="section-content">
                <div class="header">
                    <div class="welcome-text">Registrar Settings</div>
                    <div class="subtitle">Configure academic registry preferences</div>
                </div>

                <div class="content-card">
                    <h3>System Configuration</h3>
                    <form>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
                            <div>
                                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Academic Year</label>
                                <select style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px;">
                                    <option>2023/2024</option>
                                    <option>2024/2025</option>
                                </select>
                            </div>
                            <div>
                                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Semester</label>
                                <select style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px;">
                                    <option>Semester 1</option>
                                    <option>Semester 2</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Settings
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Navigation functionality
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all links and sections
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                document.querySelectorAll('.section-content').forEach(s => s.classList.remove('active'));
                
                // Add active class to clicked link
                this.classList.add('active');
                
                // Show corresponding section
                const sectionId = this.getAttribute('data-section');
                const section = document.getElementById(sectionId);
                if (section) {
                    section.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>
?>
