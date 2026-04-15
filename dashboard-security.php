<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'support') {
    header('Location: login-portal.php');
    exit();
}
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Department Dashboard - ISNM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary: #ea580c; --secondary: #f97316; --accent: #fb923c;
            --success: #10b981; --warning: #f59e0b; --danger: #ef4444;
            --white: #ffffff; --gray-50: #f9fafb; --gray-100: #f3f4f6;
            --gray-200: #e5e7eb; --gray-300: #d1d5db; --gray-600: #4b5563;
            --gray-700: #374151; --gray-800: #1f2937; --gray-900: #111827;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1);
        }
        body { font-family: 'Inter', 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background: var(--gray-50); color: var(--gray-900); }
        .dashboard { display: flex; min-height: 100vh; }
        .sidebar { width: 280px; background: var(--white); box-shadow: var(--shadow-lg); }
        .sidebar-header { padding: 2rem; border-bottom: 1px solid var(--gray-200); text-align: center; }
        .school-logo { width: 60px; height: 60px; border-radius: 50%; margin-bottom: 1rem; box-shadow: var(--shadow-md); border: 2px solid var(--primary); }
        .user-info { display: flex; align-items: center; gap: 1rem; }
        .user-avatar { width: 48px; height: 48px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem; }
        .user-details h3 { font-size: 1.1rem; font-weight: 600; margin-bottom: 0.25rem; }
        .user-details p { font-size: 0.875rem; color: var(--gray-600); }
        .nav-menu { list-style: none; padding: 1rem 0; }
        .nav-item { margin-bottom: 0.25rem; }
        .nav-link { display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 2rem; color: var(--gray-700); text-decoration: none; transition: all 0.2s; border-left: 3px solid transparent; }
        .nav-link:hover, .nav-link.active { background: var(--gray-50); color: var(--primary); border-left-color: var(--primary); }
        .main-content { flex: 1; padding: 2rem; }
        .header { background: var(--white); border-radius: 12px; padding: 2rem; box-shadow: var(--shadow-md); margin-bottom: 2rem; }
        .header h1 { font-size: 2rem; font-weight: 700; margin-bottom: 0.5rem; }
        .header p { color: var(--gray-600); }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
        .stat-card { background: var(--white); border-radius: 12px; padding: 1.5rem; box-shadow: var(--shadow-md); transition: transform 0.2s; }
        .stat-card:hover { transform: translateY(-2px); }
        .stat-icon { width: 48px; height: 48px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; margin-bottom: 1rem; }
        .stat-icon.orange { background: rgba(234, 88, 12, 0.1); color: var(--primary); }
        .stat-icon.green { background: rgba(16, 185, 129, 0.1); color: var(--success); }
        .stat-icon.blue { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
        .stat-icon.red { background: rgba(239, 68, 68, 0.1); color: var(--danger); }
        .stat-value { font-size: 2rem; font-weight: 700; margin-bottom: 0.25rem; }
        .stat-label { color: var(--gray-600); font-size: 0.875rem; }
        .content-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; margin-bottom: 2rem; }
        .card { background: var(--white); border-radius: 12px; padding: 1.5rem; box-shadow: var(--shadow-md); }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        .card-title { font-size: 1.25rem; font-weight: 600; }
        .btn { padding: 0.5rem 1rem; border-radius: 8px; font-weight: 500; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s; border: none; cursor: pointer; }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--secondary); }
        .btn-secondary { background: var(--gray-200); color: var(--gray-700); }
        .btn-secondary:hover { background: var(--gray-300); }
        .incident-list { list-style: none; }
        .incident-item { background: var(--gray-50); border-radius: 8px; padding: 1rem; margin-bottom: 1rem; border-left: 4px solid var(--primary); }
        .incident-id { font-weight: 600; color: var(--primary); margin-bottom: 0.25rem; }
        .incident-title { font-weight: 500; margin-bottom: 0.25rem; }
        .incident-meta { font-size: 0.875rem; color: var(--gray-600); }
        .patrol-list { list-style: none; }
        .patrol-item { display: flex; align-items: center; gap: 1rem; padding: 1rem 0; border-bottom: 1px solid var(--gray-100); }
        .patrol-item:last-child { border-bottom: none; }
        .patrol-icon { width: 40px; height: 40px; border-radius: 50%; background: var(--gray-200); display: flex; align-items: center; justify-content: center; color: var(--gray-600); }
        .patrol-info { flex: 1; }
        .patrol-name { font-weight: 500; margin-bottom: 0.25rem; }
        .patrol-time { font-size: 0.875rem; color: var(--gray-600); }
        .patrol-status { padding: 0.25rem 0.75rem; border-radius: 12px; font-size: 0.75rem; font-weight: 500; }
        .status-active { background: rgba(16, 185, 129, 0.1); color: var(--success); }
        .status-scheduled { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
        .footer { background: var(--gray-900); color: white; padding: 3rem 2rem 2rem; text-align: center; margin-top: 4rem; }
        .footer-title { font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem; }
        .footer-subtitle { margin-bottom: 2rem; opacity: 0.9; }
        .contact-buttons { display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap; }
        .whatsapp-btn { padding: 1rem 2rem; background: #25d366; color: white; text-decoration: none; border-radius: 8px; font-weight: 500; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s; }
        .whatsapp-btn:hover { background: #128c7e; transform: translateY(-1px); }
        @media (max-width: 768px) { .dashboard { flex-direction: column; } .sidebar { width: 100%; } .content-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <div class="dashboard">
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="user-info">
                    <div class="user-avatar"><i class="fas fa-shield-alt"></i></div>
                    <div class="user-details">
                        <h3><?php echo htmlspecialchars($user['username']); ?></h3>
                        <p>Security Officer</p>
                    </div>
                </div>
            </div>
            <nav>
                <ul class="nav-menu">
                    <li class="nav-item"><a href="#" class="nav-link active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-user-graduate"></i> Student Registration</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-chalkboard-teacher"></i> Teacher Registration</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-users"></i> Support Staff Registration</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-video"></i> Camera Monitoring</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-clipboard-list"></i> Requisition Portal</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-user-tie"></i> HR Communication</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-clipboard-list"></i> Reports</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-cog"></i> Settings</a></li>
                    <li class="nav-item"><a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <div class="header">
                <h1>Security Department Dashboard</h1>
                <p>Welcome back, <?php echo htmlspecialchars($user['username']); ?>. Monitor campus security and safety.</p>
            </div>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon orange"><i class="fas fa-user-graduate"></i></div>
                    <div class="stat-value">1,247</div>
                    <div class="stat-label">Students Registered</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon green"><i class="fas fa-chalkboard-teacher"></i></div>
                    <div class="stat-value">89</div>
                    <div class="stat-label">Teachers Registered</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon yellow"><i class="fas fa-users"></i></div>
                    <div class="stat-value">156</div>
                    <div class="stat-label">Support Staff Registered</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon red"><i class="fas fa-video"></i></div>
                    <div class="stat-value">24</div>
                    <div class="stat-label">Active Cameras</div>
                </div>
            </div>
            <div class="content-grid">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Student Registration</h2>
                        <a href="#" class="btn btn-primary" onclick="showStudentForm()"><i class="fas fa-plus"></i> Register Student</a>
                    </div>
                    <form id="studentForm" style="display: none;">
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Full Name *</label>
                                <input type="text" class="form-input" name="student_name" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Sex *</label>
                                <select class="form-select" name="sex" required>
                                    <option value="">Select Sex</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Date of Birth *</label>
                                <input type="date" class="form-input" name="date_of_birth" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Mobile Number *</label>
                                <input type="tel" class="form-input" name="mobile_number" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">ID Number (Leave blank if new)</label>
                                <input type="text" class="form-input" name="id_number" placeholder="Optional for new students">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Registration Type *</label>
                                <select class="form-select" name="registration_type" required>
                                    <option value="">Select Type</option>
                                    <option value="coming">Coming</option>
                                    <option value="leaving">Leaving</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Address</label>
                            <textarea class="form-textarea" name="address" placeholder="Student Address"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Register Student</button>
                    </form>
                    <ul class="register-list">
                        <li class="register-item">
                            <div class="register-icon"><i class="fas fa-user-graduate"></i></div>
                            <div class="register-info">
                                <div class="register-name">Jane Nakato</div>
                                <div class="register-details">Set A-12 | Female | 0775123456</div>
                                <div class="register-time">Coming - <?php echo date('Y-m-d H:i:s'); ?></div>
                            </div>
                        </li>
                        <li class="register-item">
                            <div class="register-icon"><i class="fas fa-user-graduate"></i></div>
                            <div class="register-info">
                                <div class="register-name">John Mukasa</div>
                                <div class="register-details">Set B-08 | Male | 0756987452</div>
                                <div class="register-time">Leaving - <?php echo date('Y-m-d H:i:s'); ?></div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Patrol Schedule</h2>
                        <a href="#" class="btn btn-secondary">All Patrols</a>
                    </div>
                    <form id="teacherForm" style="display: none;">
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Full Name *</label>
                                <input type="text" class="form-input" name="teacher_name" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Mobile Number *</label>
                                <input type="tel" class="form-input" name="mobile_number" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Email *</label>
                                <input type="email" class="form-input" name="email" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Department *</label>
                                <select class="form-select" name="department" required>
                                    <option value="">Select Department</option>
                                    <option value="academic">Academic</option>
                                    <option value="nursing">Nursing</option>
                                    <option value="midwifery">Midwifery</option>
                                    <option value="administration">Administration</option>
                                    <option value="support">Support</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Status *</label>
                                <select class="form-select" name="status" required>
                                    <option value="">Select Status</option>
                                    <option value="reporting">Reporting</option>
                                    <option value="exiting">Exiting</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Date & Time *</label>
                                <input type="datetime-local" class="form-input" name="datetime" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Register Teacher</button>
                    </form>
                    <ul class="register-list">
                        <li class="register-item">
                            <div class="register-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                            <div class="register-info">
                                <div class="register-name">Dr. Sarah Nalwoga</div>
                                <div class="register-details">Nursing Dept | 0775123456 | sarah@isnm.ac.ug</div>
                                <div class="register-time">Reporting - <?php echo date('Y-m-d H:i:s'); ?></div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Support Staff Registration</h2>
                        <a href="#" class="btn btn-primary" onclick="showSupportForm()"><i class="fas fa-plus"></i> Register Staff</a>
                    </div>
                    <form id="supportForm" style="display: none;">
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Full Name *</label>
                                <input type="text" class="form-input" name="staff_name" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email *</label>
                                <input type="email" class="form-input" name="email" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Mobile Number *</label>
                                <input type="tel" class="form-input" name="mobile_number" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Date & Time *</label>
                                <input type="datetime-local" class="form-input" name="datetime" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Register Support Staff</button>
                    </form>
                    <ul class="register-list">
                        <li class="register-item">
                            <div class="register-icon"><i class="fas fa-users"></i></div>
                            <div class="register-info">
                                <div class="register-name">Michael Ssewanyana</div>
                                <div class="register-details">0756987452 | michael@isnm.ac.ug</div>
                                <div class="register-time"><?php echo date('Y-m-d H:i:s'); ?></div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Camera Monitoring System</h2>
                        <a href="#" class="btn btn-secondary"><i class="fas fa-sync"></i> Refresh</a>
                    </div>
                    <div class="camera-grid">
                        <div class="camera-item">
                            <div class="camera-name">Main Gate Camera</div>
                            <div class="camera-status online"><i class="fas fa-circle"></i> Online</div>
                        </div>
                        <div class="camera-item">
                            <div class="camera-name">Library Camera</div>
                            <div class="camera-status online"><i class="fas fa-circle"></i> Online</div>
                        </div>
                        <div class="camera-item">
                            <div class="camera-name">Hostel Area Camera</div>
                            <div class="camera-status offline"><i class="fas fa-circle"></i> Offline</div>
                        </div>
                        <div class="camera-item">
                            <div class="camera-name">Laboratory Camera</div>
                            <div class="camera-status online"><i class="fas fa-circle"></i> Online</div>
                        </div>
                        <div class="camera-item">
                            <div class="camera-name">Dining Hall Camera</div>
                            <div class="camera-status online"><i class="fas fa-circle"></i> Online</div>
                        </div>
                        <div class="camera-item">
                            <div class="camera-name">Parking Area Camera</div>
                            <div class="camera-status offline"><i class="fas fa-circle"></i> Offline</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Requisition Portal</h2>
                    <a href="#" class="btn btn-primary" onclick="showRequisitionForm()"><i class="fas fa-plus"></i> New Requisition</a>
                </div>
                <form id="requisitionForm" style="display: none;">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Item Required *</label>
                            <input type="text" class="form-input" name="item_name" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Quantity *</label>
                            <input type="number" class="form-input" name="quantity" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Priority *</label>
                            <select class="form-select" name="priority" required>
                                <option value="">Select Priority</option>
                                <option value="urgent">Urgent</option>
                                <option value="high">High</option>
                                <option value="medium">Medium</option>
                                <option value="low">Low</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Purpose *</label>
                            <input type="text" class="form-input" name="purpose" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Justification</label>
                        <textarea class="form-textarea" name="justification" placeholder="Explain why this item is needed"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Submit Requisition</button>
                </form>
                <ul class="requisition-list">
                    <li class="requisition-item">
                        <div class="requisition-title">Security Uniforms</div>
                        <div class="requisition-details">Quantity: 5 | Priority: High | Purpose: Staff Uniforms</div>
                        <div class="requisition-status sent">Sent to HR</div>
                    </li>
                    <li class="requisition-item">
                        <div class="requisition-title">Flashlights</div>
                        <div class="requisition-details">Quantity: 10 | Priority: Medium | Purpose: Night Patrol</div>
                        <div class="requisition-status pending">Pending Approval</div>
                    </li>
                    <li class="requisition-item">
                        <div class="requisition-title">Radio Communication Set</div>
                        <div class="requisition-details">Quantity: 2 | Priority: Urgent | Purpose: Emergency Communication</div>
                        <div class="requisition-status approved">Approved</div>
                    </li>
                </ul>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">HR Communication</h2>
                    <a href="#" class="btn btn-primary" onclick="showHRForm()"><i class="fas fa-envelope"></i> Send to HR</a>
                </div>
                <form id="hrForm" style="display: none;">
                    <div class="form-group">
                        <label class="form-label">Subject *</label>
                        <input type="text" class="form-input" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Message *</label>
                        <textarea class="form-textarea" name="message" required placeholder="Enter your message to HR department"></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Priority *</label>
                            <select class="form-select" name="priority" required>
                                <option value="">Select Priority</option>
                                <option value="urgent">Urgent</option>
                                <option value="high">High</option>
                                <option value="normal">Normal</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Category *</label>
                            <select class="form-select" name="category" required>
                                <option value="">Select Category</option>
                                <option value="staffing">Staffing Issues</option>
                                <option value="equipment">Equipment Request</option>
                                <option value="training">Training Needs</option>
                                <option value="policy">Policy Clarification</option>
                                <option value="emergency">Emergency</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Send to HR</button>
                </form>
                <div style="display: flex; flex-wrap: wrap; gap: 1rem;">
                    <a href="#" class="btn btn-secondary"><i class="fas fa-file-pdf"></i> Generate Report</a>
                    <a href="#" class="btn btn-secondary"><i class="fas fa-chart-bar"></i> View Analytics</a>
                    <a href="#" class="btn btn-secondary"><i class="fas fa-bell"></i> Emergency Alert</a>
                    <a href="#" class="btn btn-secondary"><i class="fas fa-phone"></i> Contact HR Direct</a>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Security Operations</h2>
                </div>
                <div style="display: flex; flex-wrap: wrap; gap: 1rem;">
                    <a href="#" class="btn btn-primary"><i class="fas fa-plus"></i> Report Incident</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-route"></i> Schedule Patrol</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-camera"></i> View Cameras</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-id-card"></i> Manage Access</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-file-alt"></i> Generate Report</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-phone"></i> Emergency Contact</a>
                </div>
            </div>
        </main>
    </div>
    <</body>
</html>
