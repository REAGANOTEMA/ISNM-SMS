<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
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
    <title>Accounts Department Dashboard - ISNM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
                :root {
            /* Dark and Creamy Yellow Color Palette */
            --primary-dark: #1a1a1a;
            --creamy-yellow: #FFF8DC;
            --accent-gold: #FFD700;
            --secondary-dark: #2d2d2d;
            --light-cream: #FAF0E6;
            --dark-accent: #B8860B;
            --white: #FFFFFF;
            --gray-light: #F5F5F5;
            --gray-medium: #D3D3D3;
            --gray-dark: #696969;
            
            /* Gradients */
            --gradient-hero: linear-gradient(135deg, var(--primary-dark) 0%, var(--secondary-dark) 50%, var(--accent-gold) 100%);
            --gradient-primary: linear-gradient(135deg, var(--primary-dark) 0%, var(--accent-gold) 100%);
            --gradient-luxury: linear-gradient(135deg, var(--accent-gold) 0%, var(--creamy-yellow) 100%);
            --gradient-clean: linear-gradient(135deg, var(--light-cream) 0%, var(--white) 100%);
            
            /* Shadows */
            --shadow-sm: 0 2px 4px rgba(26, 26, 26, 0.1);
            --shadow-md: 0 4px 8px rgba(26, 26, 26, 0.15);
            --shadow-lg: 0 8px 16px rgba(26, 26, 26, 0.2);
            --shadow-xl: 0 20px 40px rgba(26, 26, 26, 0.25);
            --shadow-neon: 0 0 20px rgba(255, 215, 0, 0.3);
            
            /* Borders */
            --border-light: var(--gray-medium);
            --border-medium: var(--gray-dark);
            --border-dark: var(--primary-dark);
        }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background: var(--gray-50); color: var(--gray-900); }
        .dashboard { display: flex; min-height: 100vh; }
        .sidebar { width: 280px; background: var(--white); box-shadow: var(--shadow-lg); }
        .sidebar-header { padding: 2rem; border-bottom: 1px solid var(--gray-200); }
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
        .stat-icon.blue { background: rgba(30, 58, 138, 0.1); color: var(--primary); }
        .stat-icon.green { background: rgba(16, 185, 129, 0.1); color: var(--success); }
        .stat-icon.yellow { background: rgba(245, 158, 11, 0.1); color: var(--warning); }
        .stat-icon.red { background: rgba(239, 68, 68, 0.1); color: var(--danger); }
        .stat-value { font-size: 2rem; font-weight: 700; margin-bottom: 0.25rem; }
        .stat-label { color: var(--gray-600); font-size: 0.875rem; }
        .content-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 2rem; margin-bottom: 2rem; }
        .card { background: var(--white); border-radius: 12px; padding: 1.5rem; box-shadow: var(--shadow-md); }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        .card-title { font-size: 1.25rem; font-weight: 600; }
        .btn { padding: 0.5rem 1rem; border-radius: 8px; font-weight: 500; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s; border: none; cursor: pointer; }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--secondary); }
        .btn-secondary { background: var(--gray-200); color: var(--gray-700); }
        .btn-secondary:hover { background: var(--gray-300); }
        .fee-list { list-style: none; max-height: 400px; overflow-y: auto; }
        .fee-item { background: var(--gray-50); border-radius: 8px; padding: 1rem; margin-bottom: 1rem; border-left: 4px solid var(--primary); }
        .fee-student { font-weight: 600; color: var(--primary); margin-bottom: 0.25rem; }
        .fee-amount { font-weight: 500; margin-bottom: 0.25rem; }
        .fee-meta { font-size: 0.875rem; color: var(--gray-600); }
        .payment-list { list-style: none; max-height: 400px; overflow-y: auto; }
        .payment-item { display: flex; align-items: center; gap: 1rem; padding: 1rem 0; border-bottom: 1px solid var(--gray-100); }
        .payment-item:last-child { border-bottom: none; }
        .payment-icon { width: 40px; height: 40px; border-radius: 50%; background: var(--gray-200); display: flex; align-items: center; justify-content: center; color: var(--gray-600); }
        .payment-info { flex: 1; }
        .payment-method { font-weight: 500; margin-bottom: 0.25rem; }
        .payment-amount { font-size: 0.875rem; color: var(--gray-600); }
        .payment-status { padding: 0.25rem 0.75rem; border-radius: 12px; font-size: 0.75rem; font-weight: 500; }
        .status-paid { background: rgba(16, 185, 129, 0.1); color: var(--success); }
        .status-pending { background: rgba(245, 158, 11, 0.1); color: var(--warning); }
        .status-overdue { background: rgba(239, 68, 68, 0.1); color: var(--danger); }
        .expense-list { list-style: none; max-height: 400px; overflow-y: auto; }
        .expense-item { background: var(--gray-50); border-radius: 8px; padding: 1rem; margin-bottom: 1rem; border-left: 4px solid var(--warning); }
        .expense-category { font-weight: 600; color: var(--warning); margin-bottom: 0.25rem; }
        .expense-amount { font-weight: 500; margin-bottom: 0.25rem; }
        .expense-meta { font-size: 0.875rem; color: var(--gray-600); }
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
                    <div class="user-avatar"><i class="fas fa-calculator"></i></div>
                    <div class="user-details">
                        <h3><?php echo htmlspecialchars($user['username']); ?></h3>
                        <p>Accounts Officer</p>
                    </div>
                </div>
            </div>
            <nav>
                <ul class="nav-menu">
                    <li class="nav-item"><a href="#" class="nav-link active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-users"></i> Student Fee Records</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-money-bill-wave"></i> Payments Dashboard</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-receipt"></i> Receipts & Invoices</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-exclamation-circle"></i> Outstanding Balances</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-chart-pie"></i> Expense Management</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-file-invoice-dollar"></i> Financial Reports</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-user-friends"></i> Parent/Student Accounts</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-cog"></i> Settings</a></li>
                    <li class="nav-item"><a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <div class="header">
                <h1>Accounts Department Dashboard</h1>
                <p>Welcome back, <?php echo htmlspecialchars($user['username']); ?>. Manage financial operations and student accounts.</p>
            </div>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon blue"><i class="fas fa-money-bill-wave"></i></div>
                    <div class="stat-value">UGX 45.2M</div>
                    <div class="stat-label">Total Revenue This Month</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon green"><i class="fas fa-users"></i></div>
                    <div class="stat-value">856</div>
                    <div class="stat-label">Active Student Accounts</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon yellow"><i class="fas fa-exclamation-circle"></i></div>
                    <div class="stat-value">UGX 12.8M</div>
                    <div class="stat-label">Outstanding Balances</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon red"><i class="fas fa-chart-pie"></i></div>
                    <div class="stat-value">UGX 8.5M</div>
                    <div class="stat-label">Monthly Expenses</div>
                </div>
            </div>
            <div class="content-grid">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Recent Student Fee Records</h2>
                        <a href="#" class="btn btn-secondary">View All</a>
                    </div>
                    <ul class="fee-list">
                        <li class="fee-item">
                            <div class="fee-student">Jane Doe - STU2024001</div>
                            <div class="fee-amount">UGX 1,250,000 / 1,500,000 Paid</div>
                            <div class="fee-meta">Balance: UGX 250,000 - Last Payment: 3 days ago</div>
                        </li>
                        <li class="fee-item">
                            <div class="fee-student">John Smith - STU2024002</div>
                            <div class="fee-amount">UGX 1,500,000 / 1,500,000 Paid</div>
                            <div class="fee-meta">Balance: UGX 0 - Status: Fully Paid</div>
                        </li>
                        <li class="fee-item">
                            <div class="fee-student">Alice Brown - STU2024003</div>
                            <div class="fee-amount">UGX 800,000 / 1,500,000 Paid</div>
                            <div class="fee-meta">Balance: UGX 700,000 - Last Payment: 2 weeks ago</div>
                        </li>
                        <li class="fee-item">
                            <div class="fee-student">Robert Wilson - STU2024004</div>
                            <div class="fee-amount">UGX 0 / 1,500,000 Paid</div>
                            <div class="fee-meta">Balance: UGX 1,500,000 - Status: Overdue</div>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Payment Methods Breakdown</h2>
                        <a href="#" class="btn btn-secondary">View Details</a>
                    </div>
                    <ul class="payment-list">
                        <li class="payment-item">
                            <div class="payment-icon"><i class="fas fa-mobile-alt"></i></div>
                            <div class="payment-info">
                                <div class="payment-method">Mobile Money</div>
                                <div class="payment-amount">UGX 28.5M - 63% of total</div>
                            </div>
                            <div class="payment-status status-paid">Active</div>
                        </li>
                        <li class="payment-item">
                            <div class="payment-icon"><i class="fas fa-university"></i></div>
                            <div class="payment-info">
                                <div class="payment-method">Bank Transfer</div>
                                <div class="payment-amount">UGX 12.8M - 28% of total</div>
                            </div>
                            <div class="payment-status status-paid">Active</div>
                        </li>
                        <li class="payment-item">
                            <div class="payment-icon"><i class="fas fa-money-bill"></i></div>
                            <div class="payment-info">
                                <div class="payment-method">Cash</div>
                                <div class="payment-amount">UGX 3.9M - 9% of total</div>
                            </div>
                            <div class="payment-status status-paid">Active</div>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Recent Expenses</h2>
                        <a href="#" class="btn btn-secondary">View All</a>
                    </div>
                    <ul class="expense-list">
                        <li class="expense-item">
                            <div class="expense-category">Staff Salaries</div>
                            <div class="expense-amount">UGX 5,200,000</div>
                            <div class="expense-meta">Monthly payroll - 45 staff members</div>
                        </li>
                        <li class="expense-item">
                            <div class="expense-category">Utilities</div>
                            <div class="expense-amount">UGX 1,850,000</div>
                            <div class="expense-meta">Electricity, Water, Internet</div>
                        </li>
                        <li class="expense-item">
                            <div class="expense-category">Supplies & Materials</div>
                            <div class="expense-amount">UGX 980,000</div>
                            <div class="expense-meta">Laboratory equipment, Books, Stationery</div>
                        </li>
                        <li class="expense-item">
                            <div class="expense-category">Maintenance</div>
                            <div class="expense-amount">UGX 470,000</div>
                            <div class="expense-meta">Building repairs, Equipment service</div>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Fee Structure Overview</h2>
                        <a href="#" class="btn btn-secondary">Full Details</a>
                    </div>
                    <ul class="payment-list">
                        <li class="payment-item">
                            <div class="payment-icon"><i class="fas fa-graduation-cap"></i></div>
                            <div class="payment-info">
                                <div class="payment-method">Tuition Fees</div>
                                <div class="payment-amount">UGX 900,000 per semester</div>
                            </div>
                            <div class="payment-status status-paid">Standard</div>
                        </li>
                        <li class="payment-item">
                            <div class="payment-icon"><i class="fas fa-building"></i></div>
                            <div class="payment-info">
                                <div class="payment-method">Development Fund</div>
                                <div class="payment-amount">UGX 300,000 per year</div>
                            </div>
                            <div class="payment-status status-paid">Required</div>
                        </li>
                        <li class="payment-item">
                            <div class="payment-icon"><i class="fas fa-utensils"></i></div>
                            <div class="payment-info">
                                <div class="payment-method">Meal Plan</div>
                                <div class="payment-amount">UGX 300,000 per semester</div>
                            </div>
                            <div class="payment-status status-pending">Optional</div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Financial Operations</h2>
                </div>
                <div style="display: flex; flex-wrap: wrap; gap: 1rem;">
                    <a href="#" class="btn btn-primary"><i class="fas fa-plus"></i> Record Payment</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-receipt"></i> Generate Receipt</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-file-invoice"></i> Create Invoice</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-chart-line"></i> Financial Report</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-users"></i> Student Statements</a>
                    <a href="#" class="btn btn-primary"><i class="fas fa-download"></i> Export Data</a>
                </div>
            </div>
        </main>
    </div>
    <footer class="footer">
        <div class="footer-title">Designed and Developed by Reagan Otema</div>
        <div class="footer-subtitle">For system errors, contact via WhatsApp</div>
        <div class="contact-buttons">
            <a href="https://wa.me/256772514889" target="_blank" class="whatsapp-btn">
                <i class="fab fa-whatsapp"></i> MTN WhatsApp: +256772514889
            </a>
            <a href="https://wa.me/256730314979" target="_blank" class="whatsapp-btn">
                <i class="fab fa-whatsapp"></i> Airtel WhatsApp: +256730314979
            </a>
        </div>
    </footer>
</body>
</html>


