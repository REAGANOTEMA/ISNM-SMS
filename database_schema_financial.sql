-- ISNM Financial Management System Database Schema
-- Created for comprehensive Bursar Dashboard functionality

-- Create database if not exists
CREATE DATABASE IF NOT EXISTS isnm_financial CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE isnm_financial;

-- 1. STUDENT BILLING & FEES MANAGEMENT

-- Fee Structures Table
CREATE TABLE fee_structures (
    id INT AUTO_INCREMENT PRIMARY KEY,
    program VARCHAR(100) NOT NULL,
    academic_year VARCHAR(20) NOT NULL,
    semester VARCHAR(20) NOT NULL,
    tuition_fee DECIMAL(12,2) NOT NULL,
    accommodation_fee DECIMAL(12,2) DEFAULT 0,
    clinical_fee DECIMAL(12,2) DEFAULT 0,
    library_fee DECIMAL(12,2) DEFAULT 0,
    examination_fee DECIMAL(12,2) DEFAULT 0,
    other_fees DECIMAL(12,2) DEFAULT 0,
    total_fee DECIMAL(12,2) GENERATED ALWAYS AS (tuition_fee + accommodation_fee + clinical_fee + library_fee + examination_fee + other_fees) STORED,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_program_year (program, academic_year),
    INDEX idx_active (is_active)
);

-- Student Fee Assignments Table
CREATE TABLE student_fee_assignments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(20) NOT NULL,
    fee_structure_id INT NOT NULL,
    assigned_date DATE NOT NULL,
    due_date DATE NOT NULL,
    total_amount DECIMAL(12,2) NOT NULL,
    paid_amount DECIMAL(12,2) DEFAULT 0,
    balance_amount DECIMAL(12,2) GENERATED ALWAYS AS (total_amount - paid_amount) STORED,
    status ENUM('pending', 'partial', 'cleared', 'overdue') DEFAULT 'pending',
    penalty_amount DECIMAL(12,2) DEFAULT 0,
    discount_amount DECIMAL(12,2) DEFAULT 0,
    scholarship_amount DECIMAL(12,2) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (fee_structure_id) REFERENCES fee_structures(id),
    INDEX idx_student_id (student_id),
    INDEX idx_status (status),
    INDEX idx_due_date (due_date)
);

-- Scholarships & Sponsorships Table
CREATE TABLE scholarships (
    id INT AUTO_INCREMENT PRIMARY KEY,
    scholarship_name VARCHAR(200) NOT NULL,
    sponsor_name VARCHAR(200) NOT NULL,
    description TEXT,
    coverage_percentage DECIMAL(5,2) DEFAULT 0,
    max_amount DECIMAL(12,2),
    eligibility_criteria TEXT,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Student Scholarships Table
CREATE TABLE student_scholarships (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(20) NOT NULL,
    scholarship_id INT NOT NULL,
    awarded_amount DECIMAL(12,2) NOT NULL,
    academic_year VARCHAR(20) NOT NULL,
    status ENUM('active', 'suspended', 'completed') DEFAULT 'active',
    awarded_date DATE NOT NULL,
    expiry_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (scholarship_id) REFERENCES scholarships(id),
    INDEX idx_student_id (student_id),
    INDEX idx_status (status)
);

-- 2. PAYMENT PROCESSING

-- Payment Methods Table
CREATE TABLE payment_methods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    method_name VARCHAR(50) NOT NULL UNIQUE,
    method_type ENUM('cash', 'bank', 'mobile_money', 'cheque', 'online') NOT NULL,
    provider_name VARCHAR(100),
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Payments Table
CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    payment_id VARCHAR(50) NOT NULL UNIQUE,
    student_id VARCHAR(20) NOT NULL,
    fee_assignment_id INT NOT NULL,
    payment_method_id INT NOT NULL,
    amount DECIMAL(12,2) NOT NULL,
    transaction_reference VARCHAR(100),
    bank_name VARCHAR(100),
    account_number VARCHAR(50),
    mobile_money_provider ENUM('mtn', 'airtel', 'other'),
    mobile_money_number VARCHAR(20),
    cheque_number VARCHAR(50),
    cheque_bank VARCHAR(100),
    payment_date DATETIME NOT NULL,
    status ENUM('pending', 'verified', 'rejected', 'reversed') DEFAULT 'pending',
    verified_by VARCHAR(50),
    verified_at TIMESTAMP NULL,
    rejection_reason TEXT,
    proof_of_payment_url VARCHAR(255),
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (fee_assignment_id) REFERENCES student_fee_assignments(id),
    FOREIGN KEY (payment_method_id) REFERENCES payment_methods(id),
    INDEX idx_payment_id (payment_id),
    INDEX idx_student_id (student_id),
    INDEX idx_status (status),
    INDEX idx_payment_date (payment_date)
);

-- Payment Verification Workflow
CREATE TABLE payment_verifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    payment_id INT NOT NULL,
    verifier_id VARCHAR(50) NOT NULL,
    verification_status ENUM('approved', 'rejected', 'requires_review') NOT NULL,
    verification_notes TEXT,
    verified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (payment_id) REFERENCES payments(id),
    INDEX idx_verifier_id (verifier_id),
    INDEX idx_status (verification_status)
);

-- 3. FINANCIAL REPORTS & ANALYTICS

-- Daily Collections Summary
CREATE TABLE daily_collections (
    id INT AUTO_INCREMENT PRIMARY KEY,
    collection_date DATE NOT NULL UNIQUE,
    total_cash DECIMAL(12,2) DEFAULT 0,
    total_bank DECIMAL(12,2) DEFAULT 0,
    total_mobile_money DECIMAL(12,2) DEFAULT 0,
    total_cheque DECIMAL(12,2) DEFAULT 0,
    total_collections DECIMAL(12,2) GENERATED ALWAYS AS (total_cash + total_bank + total_mobile_money + total_cheque) STORED,
    transaction_count INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_collection_date (collection_date)
);

-- Revenue Categories
CREATE TABLE revenue_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Revenue Tracking
CREATE TABLE revenue_tracking (
    id INT AUTO_INCREMENT PRIMARY KEY,
    revenue_category_id INT NOT NULL,
    amount DECIMAL(12,2) NOT NULL,
    transaction_date DATE NOT NULL,
    description TEXT,
    payment_method_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (revenue_category_id) REFERENCES revenue_categories(id),
    FOREIGN KEY (payment_method_id) REFERENCES payment_methods(id),
    INDEX idx_category_date (revenue_category_id, transaction_date)
);

-- 4. BUDGETING & EXPENDITURE MANAGEMENT

-- Budgets Table
CREATE TABLE budgets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    budget_name VARCHAR(200) NOT NULL,
    department VARCHAR(100) NOT NULL,
    budget_type ENUM('annual', 'semester', 'monthly', 'project') NOT NULL,
    fiscal_year VARCHAR(20) NOT NULL,
    total_amount DECIMAL(12,2) NOT NULL,
    allocated_amount DECIMAL(12,2) DEFAULT 0,
    spent_amount DECIMAL(12,2) DEFAULT 0,
    remaining_amount DECIMAL(12,2) GENERATED ALWAYS AS (allocated_amount - spent_amount) STORED,
    utilization_percentage DECIMAL(5,2) GENERATED ALWAYS AS (CASE WHEN allocated_amount > 0 THEN (spent_amount / allocated_amount) * 100 ELSE 0 END) STORED,
    status ENUM('draft', 'approved', 'active', 'closed') DEFAULT 'draft',
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    created_by VARCHAR(50) NOT NULL,
    approved_by VARCHAR(50),
    approved_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_department (department),
    INDEX idx_fiscal_year (fiscal_year),
    INDEX idx_status (status)
);

-- Expense Categories
CREATE TABLE expense_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    budget_impact BOOLEAN DEFAULT TRUE,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Expenses Table
CREATE TABLE expenses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    expense_id VARCHAR(50) NOT NULL UNIQUE,
    budget_id INT,
    expense_category_id INT NOT NULL,
    description TEXT NOT NULL,
    amount DECIMAL(12,2) NOT NULL,
    expense_date DATE NOT NULL,
    vendor_name VARCHAR(200),
    invoice_number VARCHAR(100),
    receipt_number VARCHAR(100),
    payment_method_id INT,
    status ENUM('pending', 'approved', 'rejected', 'paid') DEFAULT 'pending',
    requested_by VARCHAR(50) NOT NULL,
    approved_by VARCHAR(50),
    approved_at TIMESTAMP NULL,
    paid_at TIMESTAMP NULL,
    notes TEXT,
    attachments_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (budget_id) REFERENCES budgets(id),
    FOREIGN KEY (expense_category_id) REFERENCES expense_categories(id),
    FOREIGN KEY (payment_method_id) REFERENCES payment_methods(id),
    INDEX idx_expense_id (expense_id),
    INDEX idx_status (status),
    INDEX idx_expense_date (expense_date),
    INDEX idx_requested_by (requested_by)
);

-- 5. PAYROLL INTEGRATION

-- Staff Positions Table
CREATE TABLE staff_positions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    position_name VARCHAR(100) NOT NULL,
    position_level ENUM('junior', 'mid', 'senior', 'management') NOT NULL,
    base_salary_range_min DECIMAL(12,2),
    base_salary_range_max DECIMAL(12,2),
    department VARCHAR(100),
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Staff Table (Extended for Payroll)
CREATE TABLE staff (
    staff_id VARCHAR(20) PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    position_id INT NOT NULL,
    department VARCHAR(100) NOT NULL,
    employment_type ENUM('permanent', 'contract', 'part_time') NOT NULL,
    hire_date DATE NOT NULL,
    base_salary DECIMAL(12,2) NOT NULL,
    bank_account_number VARCHAR(50),
    bank_name VARCHAR(100),
    bank_branch VARCHAR(100),
    tax_number VARCHAR(50),
    nssf_number VARCHAR(50),
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (position_id) REFERENCES staff_positions(id),
    INDEX idx_department (department),
    INDEX idx_active (is_active)
);

-- Allowances Table
CREATE TABLE allowances (
    id INT AUTO_INCREMENT PRIMARY KEY,
    allowance_name VARCHAR(100) NOT NULL,
    allowance_type ENUM('housing', 'transport', 'medical', 'responsibility', 'other') NOT NULL,
    default_amount DECIMAL(12,2),
    is_taxable BOOLEAN DEFAULT TRUE,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Staff Allowances Table
CREATE TABLE staff_allowances (
    id INT AUTO_INCREMENT PRIMARY KEY,
    staff_id VARCHAR(20) NOT NULL,
    allowance_id INT NOT NULL,
    amount DECIMAL(12,2) NOT NULL,
    effective_date DATE NOT NULL,
    end_date DATE,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (staff_id) REFERENCES staff(staff_id),
    FOREIGN KEY (allowance_id) REFERENCES allowances(id),
    INDEX idx_staff_id (staff_id),
    INDEX idx_effective_date (effective_date)
);

-- Deductions Table
CREATE TABLE deductions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    deduction_name VARCHAR(100) NOT NULL,
    deduction_type ENUM('tax', 'nssf', 'loan', 'advance', 'other') NOT NULL,
    default_percentage DECIMAL(5,2),
    default_amount DECIMAL(12,2),
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Staff Deductions Table
CREATE TABLE staff_deductions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    staff_id VARCHAR(20) NOT NULL,
    deduction_id INT NOT NULL,
    amount DECIMAL(12,2) NOT NULL,
    effective_date DATE NOT NULL,
    end_date DATE,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (staff_id) REFERENCES staff(staff_id),
    FOREIGN KEY (deduction_id) REFERENCES deductions(id),
    INDEX idx_staff_id (staff_id),
    INDEX idx_effective_date (effective_date)
);

-- Payroll Periods Table
CREATE TABLE payroll_periods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    period_name VARCHAR(100) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    payment_date DATE NOT NULL,
    status ENUM('draft', 'processing', 'approved', 'paid') DEFAULT 'draft',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_period_dates (start_date, end_date),
    INDEX idx_status (status)
);

-- Payslips Table
CREATE TABLE payslips (
    id INT AUTO_INCREMENT PRIMARY KEY,
    payslip_id VARCHAR(50) NOT NULL UNIQUE,
    staff_id VARCHAR(20) NOT NULL,
    payroll_period_id INT NOT NULL,
    basic_salary DECIMAL(12,2) NOT NULL,
    total_allowances DECIMAL(12,2) DEFAULT 0,
    total_deductions DECIMAL(12,2) DEFAULT 0,
    gross_salary DECIMAL(12,2) GENERATED ALWAYS AS (basic_salary + total_allowances) STORED,
    net_salary DECIMAL(12,2) GENERATED ALWAYS AS (gross_salary - total_deductions) STORED,
    status ENUM('draft', 'approved', 'paid') DEFAULT 'draft',
    generated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    approved_by VARCHAR(50),
    approved_at TIMESTAMP NULL,
    paid_at TIMESTAMP NULL,
    FOREIGN KEY (staff_id) REFERENCES staff(staff_id),
    FOREIGN KEY (payroll_period_id) REFERENCES payroll_periods(id),
    INDEX idx_staff_id (staff_id),
    INDEX idx_payroll_period (payroll_period_id),
    INDEX idx_status (status)
);

-- 6. ACCOUNTS & LEDGER MANAGEMENT

-- Chart of Accounts Table
CREATE TABLE chart_of_accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    account_code VARCHAR(20) NOT NULL UNIQUE,
    account_name VARCHAR(200) NOT NULL,
    account_type ENUM('asset', 'liability', 'equity', 'revenue', 'expense') NOT NULL,
    parent_account_id INT,
    account_level INT DEFAULT 1,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (parent_account_id) REFERENCES chart_of_accounts(id),
    INDEX idx_account_code (account_code),
    INDEX idx_account_type (account_type)
);

-- General Ledger Table
CREATE TABLE general_ledger (
    id INT AUTO_INCREMENT PRIMARY KEY,
    transaction_id VARCHAR(50) NOT NULL,
    account_id INT NOT NULL,
    transaction_date DATE NOT NULL,
    description TEXT NOT NULL,
    reference_number VARCHAR(100),
    debit_amount DECIMAL(12,2) DEFAULT 0,
    credit_amount DECIMAL(12,2) DEFAULT 0,
    balance DECIMAL(12,2) GENERATED ALWAYS AS (debit_amount - credit_amount) STORED,
    created_by VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (account_id) REFERENCES chart_of_accounts(id),
    INDEX idx_transaction_id (transaction_id),
    INDEX idx_account_date (account_id, transaction_date),
    INDEX idx_transaction_date (transaction_date)
);

-- Trial Balance Table
CREATE TABLE trial_balance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    period_start_date DATE NOT NULL,
    period_end_date DATE NOT NULL,
    account_id INT NOT NULL,
    opening_balance DECIMAL(12,2) DEFAULT 0,
    total_debits DECIMAL(12,2) DEFAULT 0,
    total_credits DECIMAL(12,2) DEFAULT 0,
    closing_balance DECIMAL(12,2) GENERATED ALWAYS AS (opening_balance + total_debits - total_credits) STORED,
    generated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (account_id) REFERENCES chart_of_accounts(id),
    INDEX idx_period_dates (period_start_date, period_end_date),
    INDEX idx_account_id (account_id)
);

-- Bank Accounts Table
CREATE TABLE bank_accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    account_name VARCHAR(200) NOT NULL,
    bank_name VARCHAR(100) NOT NULL,
    account_number VARCHAR(50) NOT NULL UNIQUE,
    account_type ENUM('current', 'savings', 'fixed') NOT NULL,
    opening_balance DECIMAL(12,2) DEFAULT 0,
    current_balance DECIMAL(12,2) DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_bank_name (bank_name),
    INDEX idx_account_number (account_number)
);

-- Bank Reconciliation Table
CREATE TABLE bank_reconciliation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    bank_account_id INT NOT NULL,
    reconciliation_date DATE NOT NULL,
    bank_statement_balance DECIMAL(12,2) NOT NULL,
    book_balance DECIMAL(12,2) NOT NULL,
    reconciled_balance DECIMAL(12,2) NOT NULL,
    difference DECIMAL(12,2) GENERATED ALWAYS AS (bank_statement_balance - book_balance) STORED,
    status ENUM('pending', 'reconciled', 'discrepancy') DEFAULT 'pending',
    reconciled_by VARCHAR(50),
    reconciled_at TIMESTAMP NULL,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (bank_account_id) REFERENCES bank_accounts(id),
    INDEX idx_reconciliation_date (reconciliation_date),
    INDEX idx_status (status)
);

-- 7. INVENTORY & ASSET FINANCIAL TRACKING

-- Asset Categories Table
CREATE TABLE asset_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL,
    depreciation_method ENUM('straight_line', 'reducing_balance', 'sum_of_years') DEFAULT 'straight_line',
    useful_life_years INT DEFAULT 5,
    salvage_value_percentage DECIMAL(5,2) DEFAULT 10,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Assets Table
CREATE TABLE assets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    asset_tag VARCHAR(50) NOT NULL UNIQUE,
    asset_name VARCHAR(200) NOT NULL,
    asset_category_id INT NOT NULL,
    description TEXT,
    purchase_date DATE NOT NULL,
    purchase_cost DECIMAL(12,2) NOT NULL,
    current_value DECIMAL(12,2) GENERATED ALWAYS AS (purchase_cost) STORED,
    accumulated_depreciation DECIMAL(12,2) DEFAULT 0,
    net_book_value DECIMAL(12,2) GENERATED ALWAYS AS (purchase_cost - accumulated_depreciation) STORED,
    location VARCHAR(100),
    assigned_to VARCHAR(100),
    status ENUM('active', 'inactive', 'disposed', 'written_off') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (asset_category_id) REFERENCES asset_categories(id),
    INDEX idx_asset_tag (asset_tag),
    INDEX idx_status (status),
    INDEX idx_purchase_date (purchase_date)
);

-- Asset Depreciation Table
CREATE TABLE asset_depreciation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    asset_id INT NOT NULL,
    depreciation_date DATE NOT NULL,
    depreciation_amount DECIMAL(12,2) NOT NULL,
    accumulated_depreciation DECIMAL(12,2) NOT NULL,
    net_book_value DECIMAL(12,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (asset_id) REFERENCES assets(id),
    INDEX idx_asset_date (asset_id, depreciation_date)
);

-- 8. COMMUNICATION TOOLS

-- SMS Templates Table
CREATE TABLE sms_templates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    template_name VARCHAR(100) NOT NULL,
    template_type ENUM('fee_reminder', 'payment_confirmation', 'overdue_notice', 'general') NOT NULL,
    message_content TEXT NOT NULL,
    variables JSON,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- SMS Logs Table
CREATE TABLE sms_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    recipient_phone VARCHAR(20) NOT NULL,
    template_id INT,
    message_content TEXT NOT NULL,
    message_type ENUM('fee_reminder', 'payment_confirmation', 'overdue_notice', 'general') NOT NULL,
    status ENUM('pending', 'sent', 'delivered', 'failed') DEFAULT 'pending',
    sent_at TIMESTAMP NULL,
    delivered_at TIMESTAMP NULL,
    error_message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (template_id) REFERENCES sms_templates(id),
    INDEX idx_recipient_phone (recipient_phone),
    INDEX idx_status (status),
    INDEX idx_message_type (message_type)
);

-- Email Templates Table
CREATE TABLE email_templates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    template_name VARCHAR(100) NOT NULL,
    template_type ENUM('fee_reminder', 'payment_confirmation', 'overdue_notice', 'statement', 'general') NOT NULL,
    subject VARCHAR(200) NOT NULL,
    html_content TEXT NOT NULL,
    text_content TEXT,
    variables JSON,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Email Logs Table
CREATE TABLE email_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    recipient_email VARCHAR(255) NOT NULL,
    template_id INT,
    subject VARCHAR(200) NOT NULL,
    message_type ENUM('fee_reminder', 'payment_confirmation', 'overdue_notice', 'statement', 'general') NOT NULL,
    status ENUM('pending', 'sent', 'delivered', 'failed', 'bounced') DEFAULT 'pending',
    sent_at TIMESTAMP NULL,
    delivered_at TIMESTAMP NULL,
    error_message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (template_id) REFERENCES email_templates(id),
    INDEX idx_recipient_email (recipient_email),
    INDEX idx_status (status),
    INDEX idx_message_type (message_type)
);

-- 9. USER ROLES & ACCESS CONTROL

-- Financial User Roles Table
CREATE TABLE financial_user_roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(100) NOT NULL UNIQUE,
    role_description TEXT,
    permissions JSON,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Financial Users Table
CREATE TABLE financial_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(50) NOT NULL UNIQUE,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    full_name VARCHAR(200) NOT NULL,
    role_id INT NOT NULL,
    department VARCHAR(100),
    is_active BOOLEAN DEFAULT TRUE,
    last_login TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES financial_user_roles(id),
    INDEX idx_username (username),
    INDEX idx_email (email),
    INDEX idx_active (is_active)
);

-- Activity Logs Table
CREATE TABLE activity_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(50) NOT NULL,
    action VARCHAR(100) NOT NULL,
    module VARCHAR(50) NOT NULL,
    record_id VARCHAR(50),
    old_values JSON,
    new_values JSON,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_user_id (user_id),
    INDEX idx_action (action),
    INDEX idx_module (module),
    INDEX idx_created_at (created_at)
);

-- 10. STUDENT FINANCIAL SELF-SERVICE

-- Student Financial Portal Access Table
CREATE TABLE student_portal_access (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(20) NOT NULL UNIQUE,
    portal_username VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    last_login TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_student_id (student_id),
    INDEX idx_portal_username (portal_username),
    INDEX idx_active (is_active)
);

-- Online Payment Sessions Table
CREATE TABLE online_payment_sessions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    session_id VARCHAR(100) NOT NULL UNIQUE,
    student_id VARCHAR(20) NOT NULL,
    amount DECIMAL(12,2) NOT NULL,
    payment_method ENUM('mobile_money', 'bank_card', 'bank_transfer') NOT NULL,
    provider_reference VARCHAR(100),
    status ENUM('initiated', 'processing', 'completed', 'failed', 'cancelled') DEFAULT 'initiated',
    initiated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    completed_at TIMESTAMP NULL,
    failure_reason TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_session_id (session_id),
    INDEX idx_student_id (student_id),
    INDEX idx_status (status)
);

-- 11. INTEGRATION TABLES

-- Academic-Financial Integration Table
CREATE TABLE academic_financial_integration (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(20) NOT NULL,
    academic_year VARCHAR(20) NOT NULL,
    semester VARCHAR(20) NOT NULL,
    program VARCHAR(100) NOT NULL,
    year_of_study INT NOT NULL,
    registration_status ENUM('registered', 'deferred', 'withdrawn', 'suspended') NOT NULL,
    results_block_status ENUM('clear', 'blocked') DEFAULT 'clear',
    fee_clearance_status ENUM('cleared', 'partial', 'uncleared') DEFAULT 'uncleared',
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_student_id (student_id),
    INDEX idx_academic_year (academic_year),
    INDEX idx_registration_status (registration_status),
    INDEX idx_fee_clearance (fee_clearance_status)
);

-- Hostel-Financial Integration Table
CREATE TABLE hostel_financial_integration (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(20) NOT NULL,
    hostel_block VARCHAR(50) NOT NULL,
    room_number VARCHAR(20) NOT NULL,
    academic_year VARCHAR(20) NOT NULL,
    semester VARCHAR(20) NOT NULL,
    accommodation_fee DECIMAL(12,2) NOT NULL,
    payment_status ENUM('paid', 'partial', 'unpaid') DEFAULT 'unpaid',
    allocation_date DATE NOT NULL,
    checkout_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_student_id (student_id),
    INDEX idx_hostel_block (hostel_block),
    INDEX idx_payment_status (payment_status)
);

-- Library-Financial Integration Table
CREATE TABLE library_financial_integration (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(20) NOT NULL,
    fine_amount DECIMAL(12,2) NOT NULL,
    fine_reason TEXT NOT NULL,
    fine_date DATE NOT NULL,
    status ENUM('pending', 'paid', 'waived') DEFAULT 'pending',
    paid_amount DECIMAL(12,2) DEFAULT 0,
    paid_date DATE,
    payment_reference VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_student_id (student_id),
    INDEX idx_status (status),
    INDEX idx_fine_date (fine_date)
);

-- Insert initial data

-- Payment Methods
INSERT INTO payment_methods (method_name, method_type, provider_name) VALUES
('Cash', 'cash', NULL),
('Bank Deposit', 'bank', NULL),
('MTN Mobile Money', 'mobile_money', 'MTN Uganda'),
('Airtel Money', 'mobile_money', 'Airtel Uganda'),
('Cheque', 'cheque', NULL),
('Bank Transfer', 'bank', NULL);

-- Revenue Categories
INSERT INTO revenue_categories (category_name, description) VALUES
('Tuition Fees', 'Income from student tuition payments'),
('Accommodation Fees', 'Income from hostel accommodation'),
('Clinical Fees', 'Income from clinical training fees'),
('Library Fees', 'Income from library services'),
('Examination Fees', 'Income from examination charges'),
('Other Fees', 'Miscellaneous income sources');

-- Expense Categories
INSERT INTO expense_categories (category_name, description, budget_impact) VALUES
('Salaries & Wages', 'Staff salary payments', TRUE),
('Utilities', 'Water, electricity, internet bills', TRUE),
('Office Supplies', 'Stationery and office consumables', TRUE),
('Maintenance', 'Building and equipment maintenance', TRUE),
('Travel & Transport', 'Official travel expenses', TRUE),
('Training & Development', 'Staff training programs', TRUE),
('Marketing & Promotion', 'Institutional marketing activities', TRUE),
('Professional Fees', 'Consultant and professional service fees', TRUE);

-- Chart of Accounts (Basic Structure)
INSERT INTO chart_of_accounts (account_code, account_name, account_type, account_level) VALUES
('1000', 'ASSETS', 'asset', 1),
('1100', 'CURRENT ASSETS', 'asset', 2),
('1110', 'Cash Account', 'asset', 3),
('1120', 'Bank Account - Stanbic', 'asset', 3),
('1130', 'Accounts Receivable', 'asset', 3),
('1200', 'FIXED ASSETS', 'asset', 2),
('1210', 'Furniture & Equipment', 'asset', 3),
('1220', 'Computer Equipment', 'asset', 3),
('2000', 'LIABILITIES', 'liability', 1),
('2100', 'CURRENT LIABILITIES', 'liability', 2),
('2110', 'Accounts Payable', 'liability', 3),
('2120', 'Accrued Expenses', 'liability', 3),
('3000', 'EQUITY', 'equity', 1),
('3100', 'Retained Earnings', 'equity', 2),
('4000', 'REVENUE', 'revenue', 1),
('4100', 'Tuition Income', 'revenue', 2),
('4200', 'Hostel Income', 'revenue', 2),
('5000', 'EXPENSES', 'expense', 1),
('5100', 'Salaries & Wages', 'expense', 2),
('5200', 'Utilities', 'expense', 2);

-- Financial User Roles
INSERT INTO financial_user_roles (role_name, role_description, permissions) VALUES
('Bursar', 'Chief financial officer with full access', '["all"]'),
('Accounts Assistant', 'Supports with payment processing and basic accounting', '["payments.read", "payments.create", "reports.read", "students.read"]'),
('Auditor', 'Read-only access for audit purposes', '["reports.read", "transactions.read", "logs.read"]'),
('Finance Officer', 'Mid-level financial management', '["payments.*", "budgets.read", "expenses.read", "reports.*"]');

-- SMS Templates
INSERT INTO sms_templates (template_name, template_type, message_content, variables) VALUES
('Fee Reminder', 'fee_reminder', 'Dear {student_name}, this is a reminder that your fee balance of UGX {balance} is due on {due_date}. Please make payment to avoid late fees. Thank you.', '["student_name", "balance", "due_date"]'),
('Payment Confirmation', 'payment_confirmation', 'Dear {student_name}, we have received your payment of UGX {amount} via {payment_method}. Receipt: {receipt_id}. Thank you.', '["student_name", "amount", "payment_method", "receipt_id"]'),
('Overdue Notice', 'overdue_notice', 'Dear {student_name}, your fee balance of UGX {balance} is overdue by {overdue_days} days. Please pay immediately to avoid service interruption.', '["student_name", "balance", "overdue_days"]');

-- Email Templates
INSERT INTO email_templates (template_name, template_type, subject, html_content, variables) VALUES
('Monthly Statement', 'statement', 'Monthly Fee Statement - {month} {year}', '<h3>Fee Statement for {student_name}</h3><p>Period: {month} {year}</p><p>Total Fees: UGX {total_fees}</p><p>Paid: UGX {paid_amount}</p><p>Balance: UGX {balance}</p>', '["student_name", "month", "year", "total_fees", "paid_amount", "balance"]');

-- Create indexes for performance optimization
CREATE INDEX idx_student_fee_assignments_composite ON student_fee_assignments(student_id, status, due_date);
CREATE INDEX idx_payments_composite ON payments(student_id, status, payment_date);
CREATE INDEX idx_expenses_composite ON expenses(department, status, expense_date);
CREATE INDEX idx_general_ledger_composite ON general_ledger(account_id, transaction_date, transaction_id);
CREATE INDEX idx_activity_logs_composite ON activity_logs(user_id, created_at, action);

-- Create views for common queries
CREATE VIEW student_fee_summary AS
SELECT 
    s.student_id,
    s.first_name,
    s.last_name,
    s.program,
    sfa.total_amount,
    sfa.paid_amount,
    sfa.balance_amount,
    sfa.status,
    sfa.due_date
FROM students s
JOIN student_fee_assignments sfa ON s.student_id = sfa.student_id
WHERE sfa.status != 'cleared';

CREATE VIEW monthly_revenue_summary AS
SELECT 
    DATE_FORMAT(payment_date, '%Y-%m') as month,
    payment_method,
    SUM(amount) as total_amount,
    COUNT(*) as transaction_count
FROM payments 
WHERE status = 'verified'
GROUP BY DATE_FORMAT(payment_date, '%Y-%m'), payment_method;

CREATE VIEW budget_utilization AS
SELECT 
    department,
    fiscal_year,
    total_amount,
    spent_amount,
    remaining_amount,
    utilization_percentage,
    status
FROM budgets
WHERE status = 'active';

-- Create stored procedures for common operations
DELIMITER //

-- Procedure for processing payments
CREATE PROCEDURE ProcessPayment(
    IN p_student_id VARCHAR(20),
    IN p_amount DECIMAL(12,2),
    IN p_payment_method INT,
    IN p_transaction_ref VARCHAR(100),
    IN p_user_id VARCHAR(50)
)
BEGIN
    DECLARE v_fee_assignment_id INT;
    DECLARE v_remaining_balance DECIMAL(12,2);
    
    -- Find the most recent fee assignment for the student
    SELECT id, balance_amount INTO v_fee_assignment_id, v_remaining_balance
    FROM student_fee_assignments 
    WHERE student_id = p_student_id AND status IN ('pending', 'partial')
    ORDER BY due_date DESC LIMIT 1;
    
    IF v_fee_assignment_id IS NOT NULL THEN
        -- Update the fee assignment
        UPDATE student_fee_assignments 
        SET paid_amount = paid_amount + p_amount,
            balance_amount = balance_amount - p_amount,
            status = CASE WHEN balance_amount - p_amount <= 0 THEN 'cleared' ELSE 'partial' END,
            updated_at = NOW()
        WHERE id = v_fee_assignment_id;
        
        -- Insert payment record
        INSERT INTO payments (
            payment_id, student_id, fee_assignment_id, payment_method_id, 
            amount, transaction_reference, payment_date, status, created_at
        ) VALUES (
            CONCAT('PAY', DATE_FORMAT(NOW(), '%Y%m%d'), LPAD(CONNECTION_ID(), 6, '0')),
            p_student_id, v_fee_assignment_id, p_payment_method,
            p_amount, p_transaction_ref, NOW(), 'pending', NOW()
        );
        
        -- Log the activity
        INSERT INTO activity_logs (user_id, action, module, record_id, new_values, created_at)
        VALUES (p_user_id, 'CREATE', 'payment', p_student_id, 
                JSON_OBJECT('amount', p_amount, 'method', p_payment_method), NOW());
    END IF;
END //

-- Procedure for budget utilization report
CREATE PROCEDURE GenerateBudgetUtilizationReport(
    IN p_fiscal_year VARCHAR(20)
)
BEGIN
    SELECT 
        b.department,
        b.total_amount as budgeted_amount,
        COALESCE(SUM(e.amount), 0) as actual_spent,
        b.total_amount - COALESCE(SUM(e.amount), 0) as remaining,
        CASE 
            WHEN b.total_amount > 0 
            THEN (COALESCE(SUM(e.amount), 0) / b.total_amount) * 100 
            ELSE 0 
        END as utilization_percentage
    FROM budgets b
    LEFT JOIN expenses e ON b.id = e.budget_id AND e.status = 'paid'
    WHERE b.fiscal_year = p_fiscal_year AND b.status = 'active'
    GROUP BY b.id, b.department, b.total_amount
    ORDER BY utilization_percentage DESC;
END //

DELIMITER ;

-- Create triggers for data integrity

-- Trigger to update daily collections
DELIMITER //
CREATE TRIGGER update_daily_collections
AFTER INSERT ON payments
FOR EACH ROW
BEGIN
    IF NEW.status = 'verified' THEN
        INSERT INTO daily_collections (collection_date, total_cash, total_bank, total_mobile_money, total_cheque, transaction_count)
        VALUES (
            DATE(NEW.payment_date),
            CASE WHEN pm.method_type = 'cash' THEN NEW.amount ELSE 0 END,
            CASE WHEN pm.method_type = 'bank' THEN NEW.amount ELSE 0 END,
            CASE WHEN pm.method_type = 'mobile_money' THEN NEW.amount ELSE 0 END,
            CASE WHEN pm.method_type = 'cheque' THEN NEW.amount ELSE 0 END,
            1
        )
        ON DUPLICATE KEY UPDATE
            total_cash = total_cash + CASE WHEN pm.method_type = 'cash' THEN NEW.amount ELSE 0 END,
            total_bank = total_bank + CASE WHEN pm.method_type = 'bank' THEN NEW.amount ELSE 0 END,
            total_mobile_money = total_mobile_money + CASE WHEN pm.method_type = 'mobile_money' THEN NEW.amount ELSE 0 END,
            total_cheque = total_cheque + CASE WHEN pm.method_type = 'cheque' THEN NEW.amount ELSE 0 END,
            transaction_count = transaction_count + 1
        FROM payment_methods pm WHERE pm.id = NEW.payment_method_id;
    END IF;
END //
DELIMITER ;

-- Trigger to update budget spent amount
DELIMITER //
CREATE TRIGGER update_budget_spent
AFTER UPDATE ON expenses
FOR EACH ROW
BEGIN
    IF NEW.status = 'paid' AND OLD.status != 'paid' THEN
        UPDATE budgets 
        SET spent_amount = spent_amount + NEW.amount,
            updated_at = NOW()
        WHERE id = NEW.budget_id;
    END IF;
END //
DELIMITER ;

-- Trigger for activity logging
DELIMITER //
CREATE TRIGGER log_payment_changes
AFTER UPDATE ON payments
FOR EACH ROW
BEGIN
    IF NEW.status != OLD.status THEN
        INSERT INTO activity_logs (user_id, action, module, record_id, old_values, new_values, created_at)
        VALUES (
            COALESCE(NEW.verified_by, 'system'),
            'UPDATE',
            'payment',
            NEW.payment_id,
            JSON_OBJECT('status', OLD.status),
            JSON_OBJECT('status', NEW.status),
            NOW()
        );
    END IF;
END //
DELIMITER ;

-- Final setup complete
SELECT 'Financial Management System Database Schema Created Successfully!' as status;
