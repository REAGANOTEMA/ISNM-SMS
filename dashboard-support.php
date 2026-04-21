<?php
// Start session
session_start();

// Check if user is logged in and is support staff
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'support') {
    header('Location: login-portal.php');
    exit();
}

// Mock support staff data - in production, this would come from database
$support_staff = [
    'id' => 'SUP001',
    'name' => 'Ms. Amina Nakato',
    'position' => 'Head Matron',
    'email' => 'support@isnm.ac.ug',
    'phone' => '+256 772 514 889',
    'department' => 'Hostel Management',
    'join_date' => '2019-05-10'
];

// Mock support staff data for comprehensive dashboard
$support_stats = [
    'total_students_in_hostel' => 680,
    'occupied_rooms' => 136,
    'available_rooms' => 14,
    'maintenance_requests' => 23,
    'pending_issues' => 8,
    'meals_served_today' => 1250,
    'security_incidents' => 2,
    'cleaning_schedules' => 45
];

// Mock hostel management data
$hostel_management = [
    ['block' => 'Block A', 'rooms' => 40, 'occupied' => 38, 'available' => 2, 'capacity' => 120, 'current_occupancy' => 114],
    ['block' => 'Block B', 'rooms' => 35, 'occupied' => 35, 'available' => 0, 'capacity' => 105, 'current_occupancy' => 105],
    ['block' => 'Block C', 'rooms' => 30, 'occupied' => 28, 'available' => 2, 'capacity' => 90, 'current_occupancy' => 84],
    ['block' => 'Block D', 'rooms' => 25, 'occupied' => 22, 'available' => 3, 'capacity' => 75, 'current_occupancy' => 66],
    ['block' => 'Block E', 'rooms' => 20, 'occupied' => 13, 'available' => 7, 'capacity' => 60, 'current_occupancy' => 39]
];

// Mock maintenance requests
$maintenance_requests = [
    ['type' => 'plumbing', 'description' => 'Leaking faucet in Room 203', 'block' => 'Block A', 'room' => '203', 'priority' => 'medium', 'status' => 'pending', 'reported_date' => '2024-01-20'],
    ['type' => 'electrical', 'description' => 'Light fixture not working', 'block' => 'Block B', 'room' => '115', 'priority' => 'high', 'status' => 'in_progress', 'reported_date' => '2024-01-19'],
    ['type' => 'furniture', 'description' => 'Broken bed frame', 'block' => 'Block C', 'room' => '208', 'priority' => 'medium', 'status' => 'completed', 'reported_date' => '2024-01-18'],
    ['type' => 'cleaning', 'description' => 'Deep cleaning required', 'block' => 'Block D', 'room' => 'Common Area', 'priority' => 'low', 'status' => 'pending', 'reported_date' => '2024-01-17'],
    ['type' => 'security', 'description' => 'Lock replacement needed', 'block' => 'Block E', 'room' => '102', 'priority' => 'high', 'status' => 'pending', 'reported_date' => '2024-01-16']
];

// Mock meal management
$meal_management = [
    ['meal_type' => 'Breakfast', 'time' => '6:30-8:00 AM', 'students_served' => 420, 'menu' => 'Porridge, Eggs, Bread, Tea', 'status' => 'completed'],
    ['meal_type' => 'Lunch', 'time' => '12:00-2:00 PM', 'students_served' => 450, 'menu' => 'Rice, Beans, Beef, Vegetables', 'status' => 'in_progress'],
    ['meal_type' => 'Dinner', 'time' => '6:30-8:00 PM', 'students_served' => 380, 'menu' => 'Matooke, Chicken, Greens', 'status' => 'scheduled'],
    ['meal_type' => 'Evening Tea', 'time' => '9:00-10:00 PM', 'students_served' => 0, 'menu' => 'Tea, Mandazi', 'status' => 'scheduled']
];

// Mock security reports
$security_reports = [
    ['incident_type' => 'Unauthorized Entry', 'description' => 'Visitor without proper identification', 'location' => 'Main Gate', 'time' => '2024-01-20 10:30 PM', 'status' => 'resolved', 'reported_by' => 'Security Guard A'],
    ['incident_type' => 'Noise Complaint', 'description' => 'Loud music from Block B', 'location' => 'Block B', 'time' => '2024-01-20 11:45 PM', 'status' => 'resolved', 'reported_by' => 'Matron on Duty'],
    ['incident_type' => 'Medical Emergency', 'description' => 'Student feeling unwell', 'location' => 'Block A Room 205', 'time' => '2024-01-19 2:15 AM', 'status' => 'resolved', 'reported_by' => 'Roommate'],
    ['incident_type' => 'Property Damage', 'description' => 'Broken window pane', 'location' => 'Block C Common Area', 'time' => '2024-01-18 8:00 PM', 'status' => 'pending', 'reported_by' => 'Cleaner'],
    ['incident_type' => 'Missing Item', 'description' => 'Student reports missing phone', 'location' => 'Block D Room 112', 'time' => '2024-01-17 9:30 PM', 'status' => 'investigating', 'reported_by' => 'Student']
];

// Mock cleaning schedules
$cleaning_schedules = [
    ['area' => 'Block A Common Areas', 'frequency' => 'Daily', 'last_cleaned' => '2024-01-20 8:00 AM', 'next_due' => '2024-01-21 8:00 AM', 'assigned_to' => 'Cleaner Team A', 'status' => 'completed'],
    ['area' => 'Block B Bathrooms', 'frequency' => 'Twice Daily', 'last_cleaned' => '2024-01-20 2:00 PM', 'next_due' => '2024-01-20 6:00 PM', 'assigned_to' => 'Cleaner Team B', 'status' => 'in_progress'],
    ['area' => 'Block C Kitchen', 'frequency' => 'After Every Meal', 'last_cleaned' => '2024-01-20 2:30 PM', 'next_due' => '2024-01-20 7:30 PM', 'assigned_to' => 'Kitchen Staff', 'status' => 'pending'],
    ['area' => 'Block D Laundry Room', 'frequency' => 'Daily', 'last_cleaned' => '2024-01-20 7:00 AM', 'next_due' => '2024-01-21 7:00 AM', 'assigned_to' => 'Cleaner Team C', 'status' => 'completed'],
    ['area' => 'Block E Study Hall', 'frequency' => 'Weekly', 'last_cleaned' => '2024-01-15 10:00 AM', 'next_due' => '2024-01-22 10:00 AM', 'assigned_to' => 'Cleaner Team A', 'status' => 'overdue']
];

// Mock inventory management
$inventory_management = [
    ['item' => 'Cleaning Supplies', 'category' => 'Cleaning', 'current_stock' => 85, 'minimum_required' => 50, 'unit' => 'liters', 'status' => 'adequate'],
    ['item' => 'Bed Sheets', 'category' => 'Linens', 'current_stock' => 120, 'minimum_required' => 150, 'unit' => 'pieces', 'status' => 'low'],
    ['item' => 'Food Items', 'category' => 'Kitchen', 'current_stock' => 450, 'minimum_required' => 300, 'unit' => 'kg', 'status' => 'adequate'],
    ['item' => 'Toilet Paper', 'category' => 'Cleaning', 'current_stock' => 200, 'minimum_required' => 250, 'unit' => 'rolls', 'status' => 'low'],
    ['item' => 'Light Bulbs', 'category' => 'Electrical', 'current_stock' => 45, 'minimum_required' => 30, 'unit' => 'pieces', 'status' => 'adequate']
];

// Mock staff on duty
$staff_on_duty = [
    ['name' => 'Ms. Amina Nakato', 'position' => 'Head Matron', 'shift' => 'Day', 'start_time' => '7:00 AM', 'end_time' => '7:00 PM', 'contact' => '+256 772 514 889'],
    ['name' => 'Mr. David Kato', 'position' => 'Security Guard', 'shift' => 'Night', 'start_time' => '7:00 PM', 'end_time' => '7:00 AM', 'contact' => '+256 772 514 890'],
    ['name' => 'Ms. Grace Lutaaya', 'position' => 'Cleaner', 'shift' => 'Day', 'start_time' => '6:00 AM', 'end_time' => '2:00 PM', 'contact' => '+256 772 514 891'],
    ['name' => 'Mr. Joseph Mwanga', 'position' => 'Cook', 'shift' => 'Day', 'start_time' => '5:00 AM', 'end_time' => '2:00 PM', 'contact' => '+256 772 514 892'],
    ['name' => 'Ms. Sarah Nalwoga', 'position' => 'Warden', 'shift' => 'Night', 'start_time' => '6:00 PM', 'end_time' => '6:00 AM', 'contact' => '+256 772 514 893']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Staff Dashboard - ISNM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        :root {
            /* Support Staff Color Palette */
            --primary-dark: #1e293b;
            --accent-green: #10b981;
            --accent-teal: #14b8a6;
            --accent-emerald: #059669;
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
            
            /* Support Staff Gradients */
            --gradient-support: linear-gradient(135deg, var(--primary-dark) 0%, var(--accent-green) 50%, var(--accent-teal) 100%);
            --gradient-primary: linear-gradient(135deg, var(--primary-dark) 0%, var(--accent-green) 100%);
            --gradient-teal: linear-gradient(135deg, var(--accent-teal) 0%, #0d9488 100%);
            --gradient-emerald: linear-gradient(135deg, var(--accent-emerald) 0%, #047857 100%);
            --gradient-success: linear-gradient(135deg, var(--success-green) 0%, #16a34a 100%);
            --gradient-warning: linear-gradient(135deg, var(--warning-amber) 0%, #d97706 100%);
            --gradient-danger: linear-gradient(135deg, var(--danger-red) 0%, #dc2626 100%);
            
            /* Shadows */
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.07);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px rgba(0, 0, 0, 0.1);
            --shadow-2xl: 0 25px 50px rgba(0, 0, 0, 0.25);
            --shadow-support: 0 8px 16px rgba(16, 185, 129, 0.3);
            
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
            background: var(--gradient-support);
            color: var(--white);
            border-bottom: 2px solid var(--accent-teal);
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
            border: 2px solid var(--accent-teal);
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
            color: var(--accent-green);
            border-left-color: var(--accent-green);
        }
        
        .nav-link.active {
            background: rgba(16, 185, 129, 0.1);
            color: var(--accent-green);
            border-left-color: var(--accent-green);
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
        
        .btn-teal {
            background: var(--gradient-teal);
            color: var(--white);
            box-shadow: var(--shadow-support);
        }
        
        .btn-teal:hover {
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
        
        .stat-card.teal::before {
            background: var(--gradient-teal);
        }
        
        .stat-card.emerald::before {
            background: var(--gradient-emerald);
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
        
        .stat-icon.teal {
            background: var(--gradient-teal);
        }
        
        .stat-icon.emerald {
            background: var(--gradient-emerald);
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
            color: var(--accent-teal);
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
        
        .list-item-status.pending {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning-amber);
        }
        
        .list-item-status.in_progress {
            background: rgba(59, 130, 246, 0.1);
            color: var(--accent-blue);
        }
        
        .list-item-status.completed {
            background: rgba(34, 197, 94, 0.1);
            color: var(--success-green);
        }
        
        .list-item-status.resolved {
            background: rgba(34, 197, 94, 0.1);
            color: var(--success-green);
        }
        
        .list-item-status.investigating {
            background: rgba(139, 92, 246, 0.1);
            color: var(--accent-purple);
        }
        
        .list-item-status.adequate {
            background: rgba(34, 197, 94, 0.1);
            color: var(--success-green);
        }
        
        .list-item-status.low {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning-amber);
        }
        
        .list-item-status.overdue {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-red);
        }
        
        .list-item-description {
            color: var(--gray-600);
            font-size: var(--text-sm);
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
                    <i class="fas fa-tools"></i>
                </div>
                <div class="user-info">
                    <div class="user-name"><?php echo htmlspecialchars($support_staff['name']); ?></div>
                    <div class="user-position"><?php echo htmlspecialchars($support_staff['position']); ?></div>
                    <div class="user-email"><?php echo htmlspecialchars($support_staff['email']); ?></div>
                </div>
            </div>
            
            <nav>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Support Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-bed"></i>
                            <span>Hostel Management</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-wrench"></i>
                            <span>Maintenance Requests</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-utensils"></i>
                            <span>Meal Management</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-shield-alt"></i>
                            <span>Security Reports</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-broom"></i>
                            <span>Cleaning Schedules</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-boxes"></i>
                            <span>Inventory Management</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-users"></i>
                            <span>Staff on Duty</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-chart-bar"></i>
                            <span>Reports</span>
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
                        <h1 class="header-title">Support Services Dashboard</h1>
                        <p class="header-subtitle">Hostel Management & Facility Operations</p>
                    </div>
                    <div class="header-actions">
                        <button class="btn btn-secondary">
                            <i class="fas fa-download"></i>
                            Export Report
                        </button>
                        <button class="btn btn-teal">
                            <i class="fas fa-calendar-plus"></i>
                            Schedule Inspection
                        </button>
                    </div>
                </div>
            </header>
            
            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card teal">
                    <div class="stat-header">
                        <div class="stat-icon teal">
                            <i class="fas fa-bed"></i>
                        </div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i>
                            5%
                        </div>
                    </div>
                    <div class="stat-value"><?php echo number_format($support_stats['total_students_in_hostel']); ?></div>
                    <div class="stat-label">Students in Hostel</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-door-open"></i>
                        </div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i>
                            2
                        </div>
                    </div>
                    <div class="stat-value"><?php echo $support_stats['available_rooms']; ?></div>
                    <div class="stat-label">Available Rooms</div>
                </div>
                
                <div class="stat-card emerald">
                    <div class="stat-header">
                        <div class="stat-icon emerald">
                            <i class="fas fa-wrench"></i>
                        </div>
                        <div class="stat-change negative">
                            <i class="fas fa-arrow-down"></i>
                            15%
                        </div>
                    </div>
                    <div class="stat-value"><?php echo $support_stats['maintenance_requests']; ?></div>
                    <div class="stat-label">Maintenance Requests</div>
                </div>
                
                <div class="stat-card success">
                    <div class="stat-header">
                        <div class="stat-icon success">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i>
                            8%
                        </div>
                    </div>
                    <div class="stat-value"><?php echo number_format($support_stats['meals_served_today']); ?></div>
                    <div class="stat-label">Meals Served Today</div>
                </div>
            </div>
            
            <!-- Content Grid -->
            <div class="content-grid">
                <!-- Hostel Management Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-bed"></i>
                            Hostel Management
                        </h2>
                        <button class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Assign Room
                        </button>
                    </div>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Block</th>
                                <th>Total Rooms</th>
                                <th>Occupied</th>
                                <th>Available</th>
                                <th>Occupancy Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($hostel_management as $block): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($block['block']); ?></td>
                                    <td><?php echo $block['rooms']; ?></td>
                                    <td><?php echo $block['occupied']; ?></td>
                                    <td><?php echo $block['available']; ?></td>
                                    <td><?php echo round(($block['current_occupancy'] / $block['capacity']) * 100, 1); ?>%</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Maintenance Requests Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-wrench"></i>
                            Maintenance Requests
                        </h2>
                        <button class="btn btn-teal">
                            <i class="fas fa-plus"></i>
                            New Request
                        </button>
                    </div>
                    
                    <ul class="list">
                        <?php foreach ($maintenance_requests as $request): ?>
                            <li class="list-item">
                                <div class="list-item-header">
                                    <div class="list-item-title"><?php echo htmlspecialchars($request['description']); ?></div>
                                    <div class="priority-badge <?php echo htmlspecialchars($request['priority']); ?>">
                                        <?php echo htmlspecialchars(ucfirst($request['priority'])); ?>
                                    </div>
                                </div>
                                <div class="list-item-description">
                                    <?php echo htmlspecialchars(ucfirst($request['type'])); ?> - <?php echo htmlspecialchars($request['block']); ?> <?php echo htmlspecialchars($request['room']); ?>
                                    <br>Reported: <?php echo htmlspecialchars($request['reported_date']); ?> | Status: 
                                    <span class="list-item-status <?php echo str_replace('_', '', $request['status']); ?>">
                                        <?php echo htmlspecialchars(ucwords(str_replace('_', ' ', $request['status']))); ?>
                                    </span>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                
                <!-- Meal Management Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-utensils"></i>
                            Meal Management
                        </h2>
                        <button class="btn btn-primary">
                            <i class="fas fa-edit"></i>
                            Update Menu
                        </button>
                    </div>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Meal</th>
                                <th>Time</th>
                                <th>Served</th>
                                <th>Menu</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($meal_management as $meal): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($meal['meal_type']); ?></td>
                                    <td><?php echo htmlspecialchars($meal['time']); ?></td>
                                    <td><?php echo $meal['students_served']; ?></td>
                                    <td><?php echo htmlspecialchars($meal['menu']); ?></td>
                                    <td>
                                        <span class="list-item-status <?php echo str_replace('_', '', $meal['status']); ?>">
                                            <?php echo htmlspecialchars(ucwords(str_replace('_', ' ', $meal['status']))); ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Security Reports Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-shield-alt"></i>
                            Security Reports
                        </h2>
                        <button class="btn btn-teal">
                            <i class="fas fa-exclamation-triangle"></i>
                            Report Incident
                        </button>
                    </div>
                    
                    <ul class="list">
                        <?php foreach ($security_reports as $incident): ?>
                            <li class="list-item">
                                <div class="list-item-header">
                                    <div class="list-item-title"><?php echo htmlspecialchars($incident['incident_type']); ?></div>
                                    <div class="list-item-status <?php echo str_replace('_', '', $incident['status']); ?>">
                                        <?php echo htmlspecialchars(ucwords(str_replace('_', ' ', $incident['status']))); ?>
                                    </div>
                                </div>
                                <div class="list-item-description">
                                    <?php echo htmlspecialchars($incident['description']); ?>
                                    <br>Location: <?php echo htmlspecialchars($incident['location']); ?> | Time: <?php echo htmlspecialchars($incident['time']); ?>
                                    <br>Reported by: <?php echo htmlspecialchars($incident['reported_by']); ?>
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
