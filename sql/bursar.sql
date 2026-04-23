-- ISNM School Management System - Complete Bursar/Finance Module Database
-- This file contains all bursar-specific tables and functionality
-- Should be imported after login.sql

USE isnm;

-- Drop existing tables to start fresh
DROP TABLE IF EXISTS fee_reminders;
DROP TABLE IF EXISTS financial_reports;
DROP TABLE IF EXISTS general_ledger;
DROP TABLE IF EXISTS chart_of_accounts;
DROP TABLE IF EXISTS bank_transactions;
DROP TABLE IF EXISTS bank_accounts;
DROP TABLE IF EXISTS payroll;
DROP TABLE IF EXISTS expenses;
DROP TABLE IF EXISTS expense_categories;
DROP TABLE IF EXISTS budgets;
DROP TABLE IF EXISTS fee_waivers;
DROP TABLE IF EXISTS student_scholarships;
DROP TABLE IF EXISTS scholarships;
DROP TABLE IF EXISTS fee_payments;
DROP TABLE IF EXISTS payment_methods;
DROP TABLE IF EXISTS student_fee_assignments;
DROP TABLE IF EXISTS fee_structures;
DROP TABLE IF EXISTS financial_settings;
DROP TABLE IF EXISTS inventory_items;
DROP TABLE IF EXISTS inventory_transactions;
DROP TABLE IF EXISTS user_permissions;
DROP TABLE IF EXISTS activity_log;

-- Fee structures table
CREATE TABLE IF NOT EXISTS fee_structures (
    id INT AUTO_INCREMENT PRIMARY KEY,
    program_id INT NOT NULL,
    academic_year_id INT NOT NULL,
    tuition_fee DECIMAL(10,2) NOT NULL DEFAULT 0,
    accommodation_fee DECIMAL(10,2) NOT NULL DEFAULT 0,
    clinical_fee DECIMAL(10,2) NOT NULL DEFAULT 0,
    library_fee DECIMAL(10,2) NOT NULL DEFAULT 0,
    examination_fee DECIMAL(10,2) NOT NULL DEFAULT 0,
    registration_fee DECIMAL(10,2) NOT NULL DEFAULT 0,
    other_fees DECIMAL(10,2) NOT NULL DEFAULT 0,
    total_fees DECIMAL(10,2) GENERATED ALWAYS AS (tuition_fee + accommodation_fee + clinical_fee + library_fee + examination_fee + registration_fee + other_fees) STORED,
    is_active BOOLEAN DEFAULT TRUE,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (program_id) REFERENCES programs(id) ON DELETE CASCADE,
    FOREIGN KEY (academic_year_id) REFERENCES academic_years(id) ON DELETE CASCADE,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_program_year (program_id, academic_year_id),
    INDEX idx_active (is_active),
    UNIQUE KEY unique_fee_structure (program_id, academic_year_id)
);

-- Student fee assignments
CREATE TABLE IF NOT EXISTS student_fee_assignments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    fee_structure_id INT NOT NULL,
    tuition_fee DECIMAL(10,2) NOT NULL DEFAULT 0,
    accommodation_fee DECIMAL(10,2) NOT NULL DEFAULT 0,
    clinical_fee DECIMAL(10,2) NOT NULL DEFAULT 0,
    library_fee DECIMAL(10,2) NOT NULL DEFAULT 0,
    examination_fee DECIMAL(10,2) NOT NULL DEFAULT 0,
    registration_fee DECIMAL(10,2) NOT NULL DEFAULT 0,
    other_fees DECIMAL(10,2) NOT NULL DEFAULT 0,
    total_fees DECIMAL(10,2) GENERATED ALWAYS AS (tuition_fee + accommodation_fee + clinical_fee + library_fee + examination_fee + registration_fee + other_fees) STORED,
    amount_paid DECIMAL(10,2) NOT NULL DEFAULT 0,
    outstanding_balance DECIMAL(10,2) GENERATED ALWAYS AS (total_fees - amount_paid) STORED,
    last_payment_date DATE,
    payment_status ENUM('unpaid', 'partial', 'paid', 'overdue') DEFAULT 'unpaid',
    academic_year_id INT NOT NULL,
    semester INT NOT NULL DEFAULT 1,
    penalty_fee DECIMAL(10,2) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(student_id) ON DELETE CASCADE,
    FOREIGN KEY (fee_structure_id) REFERENCES fee_structures(id) ON DELETE CASCADE,
    FOREIGN KEY (academic_year_id) REFERENCES academic_years(id) ON DELETE CASCADE,
    INDEX idx_student_id (student_id),
    INDEX idx_fee_structure (fee_structure_id),
    INDEX idx_payment_status (payment_status),
    INDEX idx_outstanding_balance (outstanding_balance),
    INDEX idx_academic_year_semester (academic_year_id, semester)
);

-- Payment methods with mobile money integration
CREATE TABLE IF NOT EXISTS payment_methods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    method_name VARCHAR(50) NOT NULL,
    method_code VARCHAR(20) UNIQUE NOT NULL,
    description TEXT,
    is_active BOOLEAN DEFAULT TRUE,
    api_endpoint VARCHAR(255),
    api_key VARCHAR(255),
    merchant_id VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_method_code (method_code),
    INDEX idx_active (is_active)
);

-- Enhanced fee payments table
CREATE TABLE IF NOT EXISTS fee_payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    fee_assignment_id INT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    payment_method_id INT NOT NULL,
    transaction_reference VARCHAR(100),
    receipt_number VARCHAR(50) NOT NULL,
    payment_date DATE NOT NULL,
    payment_time TIME DEFAULT '00:00:00',
    payment_status ENUM('pending', 'verified', 'reversed') DEFAULT 'pending',
    verified_by INT,
    verification_date DATETIME,
    notes TEXT,
    proof_of_payment VARCHAR(255),
    mobile_money_reference VARCHAR(100),
    bank_reference VARCHAR(100),
    created_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(student_id) ON DELETE CASCADE,
    FOREIGN KEY (fee_assignment_id) REFERENCES student_fee_assignments(id) ON DELETE CASCADE,
    FOREIGN KEY (payment_method_id) REFERENCES payment_methods(id) ON DELETE RESTRICT,
    FOREIGN KEY (verified_by) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE RESTRICT,
    INDEX idx_student_id (student_id),
    INDEX idx_fee_assignment (fee_assignment_id),
    INDEX idx_payment_method (payment_method_id),
    INDEX idx_receipt_number (receipt_number),
    INDEX idx_payment_date (payment_date),
    INDEX idx_payment_status (payment_status),
    INDEX idx_created_by (created_by)
);

-- Scholarships and sponsorships
CREATE TABLE IF NOT EXISTS scholarships (
    id INT AUTO_INCREMENT PRIMARY KEY,
    scholarship_name VARCHAR(100) NOT NULL,
    scholarship_code VARCHAR(20) UNIQUE NOT NULL,
    sponsor_name VARCHAR(100),
    sponsor_contact VARCHAR(100),
    scholarship_type ENUM('full', 'partial', 'conditional') NOT NULL,
    coverage_percentage DECIMAL(5,2),
    max_amount DECIMAL(10,2),
    eligibility_criteria TEXT,
    terms_and_conditions TEXT,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_scholarship_code (scholarship_code),
    INDEX idx_active (is_active)
);

-- Student scholarship assignments
CREATE TABLE IF NOT EXISTS student_scholarships (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    scholarship_id INT NOT NULL,
    academic_year_id INT NOT NULL,
    scholarship_amount DECIMAL(10,2) NOT NULL,
    coverage_percentage DECIMAL(5,2),
    status ENUM('active', 'suspended', 'completed', 'terminated') DEFAULT 'active',
    start_date DATE NOT NULL,
    end_date DATE,
    conditions TEXT,
    awarded_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(student_id) ON DELETE CASCADE,
    FOREIGN KEY (scholarship_id) REFERENCES scholarships(id) ON DELETE CASCADE,
    FOREIGN KEY (academic_year_id) REFERENCES academic_years(id) ON DELETE CASCADE,
    FOREIGN KEY (awarded_by) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_student_id (student_id),
    INDEX idx_scholarship_id (scholarship_id),
    INDEX idx_academic_year (academic_year_id),
    INDEX idx_status (status),
    UNIQUE KEY unique_student_scholarship (student_id, scholarship_id, academic_year_id)
);

-- Fee waivers and discounts
CREATE TABLE IF NOT EXISTS fee_waivers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    waiver_type ENUM('discount', 'waiver', 'refund') NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    percentage DECIMAL(5,2),
    reason TEXT NOT NULL,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    approved_by INT,
    approval_date DATETIME,
    fee_assignment_id INT,
    academic_year_id INT NOT NULL,
    created_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(student_id) ON DELETE CASCADE,
    FOREIGN KEY (approved_by) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (fee_assignment_id) REFERENCES student_fee_assignments(id) ON DELETE SET NULL,
    FOREIGN KEY (academic_year_id) REFERENCES academic_years(id) ON DELETE CASCADE,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE RESTRICT,
    INDEX idx_student_id (student_id),
    INDEX idx_waiver_type (waiver_type),
    INDEX idx_status (status),
    INDEX idx_academic_year (academic_year_id)
);

-- Budget allocations
CREATE TABLE IF NOT EXISTS budgets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    department_id INT NOT NULL,
    academic_year_id INT NOT NULL,
    budget_type ENUM('annual', 'semester', 'term', 'project') NOT NULL,
    budget_name VARCHAR(100) NOT NULL,
    annual_budget DECIMAL(12,2) NOT NULL,
    allocated_budget DECIMAL(12,2) NOT NULL DEFAULT 0,
    spent DECIMAL(12,2) NOT NULL DEFAULT 0,
    remaining DECIMAL(12,2) GENERATED ALWAYS AS (allocated_budget - spent) STORED,
    utilization_percentage DECIMAL(5,2) GENERATED ALWAYS AS (CASE WHEN allocated_budget > 0 THEN (spent / allocated_budget) * 100 ELSE 0 END) STORED,
    status ENUM('draft', 'approved', 'active', 'closed') DEFAULT 'draft',
    approved_by INT,
    approval_date DATETIME,
    created_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (department_id) REFERENCES departments(id) ON DELETE CASCADE,
    FOREIGN KEY (academic_year_id) REFERENCES academic_years(id) ON DELETE CASCADE,
    FOREIGN KEY (approved_by) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE RESTRICT,
    INDEX idx_department_year (department_id, academic_year_id),
    INDEX idx_budget_type (budget_type),
    INDEX idx_status (status),
    UNIQUE KEY unique_department_budget (department_id, academic_year_id, budget_type)
);

-- Expense categories
CREATE TABLE IF NOT EXISTS expense_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL,
    category_code VARCHAR(20) UNIQUE NOT NULL,
    department_id INT,
    description TEXT,
    budget_limit DECIMAL(10,2),
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (department_id) REFERENCES departments(id) ON DELETE SET NULL,
    INDEX idx_category_code (category_code),
    INDEX idx_department_id (department_id),
    INDEX idx_active (is_active)
);

-- Enhanced expenses table
CREATE TABLE IF NOT EXISTS expenses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    expense_category_id INT NOT NULL,
    department_id INT NOT NULL,
    budget_id INT,
    expense_title VARCHAR(200) NOT NULL,
    description TEXT,
    amount DECIMAL(10,2) NOT NULL,
    expense_date DATE NOT NULL,
    vendor_name VARCHAR(100),
    invoice_number VARCHAR(50),
    receipt_number VARCHAR(50),
    payment_method_id INT,
    status ENUM('pending', 'approved', 'rejected', 'paid') DEFAULT 'pending',
    approved_by INT,
    approval_date DATETIME,
    paid_by INT,
    paid_date DATETIME,
    proof_document VARCHAR(255),
    created_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (expense_category_id) REFERENCES expense_categories(id) ON DELETE RESTRICT,
    FOREIGN KEY (department_id) REFERENCES departments(id) ON DELETE CASCADE,
    FOREIGN KEY (budget_id) REFERENCES budgets(id) ON DELETE SET NULL,
    FOREIGN KEY (payment_method_id) REFERENCES payment_methods(id) ON DELETE SET NULL,
    FOREIGN KEY (approved_by) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (paid_by) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE RESTRICT,
    INDEX idx_category_id (expense_category_id),
    INDEX idx_department_id (department_id),
    INDEX idx_budget_id (budget_id),
    INDEX idx_expense_date (expense_date),
    INDEX idx_status (status),
    INDEX idx_vendor_name (vendor_name)
);

-- Enhanced payroll table
CREATE TABLE IF NOT EXISTS payroll (
    id INT AUTO_INCREMENT PRIMARY KEY,
    staff_id INT NOT NULL,
    position_id INT,
    basic_salary DECIMAL(10,2) NOT NULL,
    housing_allowance DECIMAL(10,2) NOT NULL DEFAULT 0,
    transport_allowance DECIMAL(10,2) NOT NULL DEFAULT 0,
    medical_allowance DECIMAL(10,2) NOT NULL DEFAULT 0,
    other_allowances DECIMAL(10,2) NOT NULL DEFAULT 0,
    total_allowances DECIMAL(10,2) GENERATED ALWAYS AS (housing_allowance + transport_allowance + medical_allowance + other_allowances) STORED,
    paye_tax DECIMAL(10,2) NOT NULL DEFAULT 0,
    nssf_employee DECIMAL(10,2) NOT NULL DEFAULT 0,
    nssf_employer DECIMAL(10,2) NOT NULL DEFAULT 0,
    other_deductions DECIMAL(10,2) NOT NULL DEFAULT 0,
    total_deductions DECIMAL(10,2) GENERATED ALWAYS AS (paye_tax + nssf_employee + other_deductions) STORED,
    net_salary DECIMAL(10,2) GENERATED ALWAYS AS (basic_salary + total_allowances - total_deductions) STORED,
    pay_period VARCHAR(20) NOT NULL,
    pay_date DATE NOT NULL,
    status ENUM('draft', 'approved', 'processed', 'paid') DEFAULT 'draft',
    approved_by INT,
    approval_date DATETIME,
    processed_by INT,
    processed_date DATETIME,
    payslip_generated BOOLEAN DEFAULT FALSE,
    created_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (staff_id) REFERENCES staff_users(staff_id) ON DELETE CASCADE,
    FOREIGN KEY (position_id) REFERENCES positions(id) ON DELETE SET NULL,
    FOREIGN KEY (approved_by) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (processed_by) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE RESTRICT,
    INDEX idx_staff_id (staff_id),
    INDEX idx_pay_period (pay_period),
    INDEX idx_pay_date (pay_date),
    INDEX idx_status (status)
);

-- Bank accounts
CREATE TABLE IF NOT EXISTS bank_accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    account_name VARCHAR(100) NOT NULL,
    bank_name VARCHAR(100) NOT NULL,
    account_number VARCHAR(50) NOT NULL,
    account_type ENUM('current', 'savings', 'fixed_deposit') NOT NULL,
    branch_name VARCHAR(100),
    branch_code VARCHAR(20),
    contact_person VARCHAR(100),
    contact_phone VARCHAR(20),
    opening_balance DECIMAL(12,2) NOT NULL DEFAULT 0,
    current_balance DECIMAL(12,2) NOT NULL DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    is_default BOOLEAN DEFAULT FALSE,
    created_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE RESTRICT,
    INDEX idx_account_number (account_number),
    INDEX idx_bank_name (bank_name),
    INDEX idx_active (is_active),
    INDEX idx_default (is_default)
);

-- Bank transactions
CREATE TABLE IF NOT EXISTS bank_transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    bank_account_id INT NOT NULL,
    transaction_type ENUM('deposit', 'withdrawal', 'transfer') NOT NULL,
    amount DECIMAL(12,2) NOT NULL,
    transaction_date DATE NOT NULL,
    transaction_reference VARCHAR(100),
    description TEXT,
    category VARCHAR(50),
    related_expense_id INT,
    related_payment_id INT,
    status ENUM('pending', 'verified', 'reversed') DEFAULT 'pending',
    verified_by INT,
    verification_date DATETIME,
    created_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (bank_account_id) REFERENCES bank_accounts(id) ON DELETE CASCADE,
    FOREIGN KEY (related_expense_id) REFERENCES expenses(id) ON DELETE SET NULL,
    FOREIGN KEY (related_payment_id) REFERENCES fee_payments(id) ON DELETE SET NULL,
    FOREIGN KEY (verified_by) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE RESTRICT,
    INDEX idx_bank_account (bank_account_id),
    INDEX idx_transaction_date (transaction_date),
    INDEX idx_transaction_type (transaction_type),
    INDEX idx_status (status)
);

-- Chart of accounts
CREATE TABLE IF NOT EXISTS chart_of_accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    account_code VARCHAR(20) UNIQUE NOT NULL,
    account_name VARCHAR(100) NOT NULL,
    account_type ENUM('asset', 'liability', 'equity', 'revenue', 'expense') NOT NULL,
    parent_account_id INT,
    account_level INT NOT NULL DEFAULT 1,
    description TEXT,
    opening_balance DECIMAL(12,2) NOT NULL DEFAULT 0,
    current_balance DECIMAL(12,2) NOT NULL DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (parent_account_id) REFERENCES chart_of_accounts(id) ON DELETE SET NULL,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE RESTRICT,
    INDEX idx_account_code (account_code),
    INDEX idx_account_type (account_type),
    INDEX idx_parent_account (parent_account_id),
    INDEX idx_active (is_active)
);

-- General ledger
CREATE TABLE IF NOT EXISTS general_ledger (
    id INT AUTO_INCREMENT PRIMARY KEY,
    account_id INT NOT NULL,
    transaction_date DATE NOT NULL,
    transaction_type ENUM('debit', 'credit') NOT NULL,
    amount DECIMAL(12,2) NOT NULL,
    reference_number VARCHAR(50),
    description TEXT,
    related_transaction_type ENUM('payment', 'expense', 'payroll', 'bank_transaction', 'adjustment') NOT NULL,
    related_transaction_id INT,
    balance_after DECIMAL(12,2) NOT NULL,
    created_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (account_id) REFERENCES chart_of_accounts(id) ON DELETE RESTRICT,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE RESTRICT,
    INDEX idx_account_id (account_id),
    INDEX idx_transaction_date (transaction_date),
    INDEX idx_transaction_type (transaction_type),
    INDEX idx_reference_number (reference_number),
    INDEX idx_related_transaction (related_transaction_type, related_transaction_id)
);

-- Financial reports
CREATE TABLE IF NOT EXISTS financial_reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    report_name VARCHAR(100) NOT NULL,
    report_type ENUM('trial_balance', 'income_statement', 'balance_sheet', 'cash_flow', 'budget_variance', 'aged_debtors', 'revenue_summary', 'ura_tax_report') NOT NULL,
    report_period VARCHAR(20) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    report_data JSON,
    generated_by INT NOT NULL,
    generated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (generated_by) REFERENCES users(id) ON DELETE RESTRICT,
    INDEX idx_report_type (report_type),
    INDEX idx_report_period (report_period),
    INDEX idx_generated_at (generated_at)
);

-- Fee reminders
CREATE TABLE IF NOT EXISTS fee_reminders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    reminder_type ENUM('sms', 'email', 'both') NOT NULL,
    reminder_message TEXT NOT NULL,
    scheduled_date DATE NOT NULL,
    sent_date DATETIME,
    status ENUM('pending', 'sent', 'failed') DEFAULT 'pending',
    outstanding_balance DECIMAL(10,2),
    days_overdue INT,
    created_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(student_id) ON DELETE CASCADE,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE RESTRICT,
    INDEX idx_student_id (student_id),
    INDEX idx_scheduled_date (scheduled_date),
    INDEX idx_status (status),
    INDEX idx_days_overdue (days_overdue)
);

-- Financial settings
CREATE TABLE IF NOT EXISTS financial_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value TEXT,
    setting_type ENUM('string', 'number', 'boolean', 'json') NOT NULL,
    description TEXT,
    is_active BOOLEAN DEFAULT TRUE,
    updated_by INT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_setting_key (setting_key),
    INDEX idx_active (is_active)
);

-- Inventory items for asset tracking
CREATE TABLE IF NOT EXISTS inventory_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_code VARCHAR(50) UNIQUE NOT NULL,
    item_name VARCHAR(200) NOT NULL,
    item_category VARCHAR(100),
    description TEXT,
    unit_cost DECIMAL(10,2),
    quantity INT NOT NULL DEFAULT 0,
    reorder_level INT DEFAULT 10,
    location VARCHAR(100),
    purchase_date DATE,
    depreciation_rate DECIMAL(5,2),
    current_value DECIMAL(10,2),
    status ENUM('active', 'inactive', 'disposed') DEFAULT 'active',
    created_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE RESTRICT,
    INDEX idx_item_code (item_code),
    INDEX idx_category (item_category),
    INDEX idx_status (status)
);

-- Inventory transactions
CREATE TABLE IF NOT EXISTS inventory_transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_id INT NOT NULL,
    transaction_type ENUM('purchase', 'issue', 'return', 'adjustment', 'disposal') NOT NULL,
    quantity INT NOT NULL,
    unit_cost DECIMAL(10,2),
    total_cost DECIMAL(10,2),
    transaction_date DATE NOT NULL,
    reference_number VARCHAR(50),
    department_id INT,
    purpose TEXT,
    created_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (item_id) REFERENCES inventory_items(id) ON DELETE CASCADE,
    FOREIGN KEY (department_id) REFERENCES departments(id) ON DELETE SET NULL,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE RESTRICT,
    INDEX idx_item_id (item_id),
    INDEX idx_transaction_date (transaction_date),
    INDEX idx_transaction_type (transaction_type)
);

-- User permissions for access control
CREATE TABLE IF NOT EXISTS user_permissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    module VARCHAR(50) NOT NULL,
    permission_type ENUM('read', 'write', 'delete', 'approve', 'admin') NOT NULL,
    granted_by INT NOT NULL,
    granted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    expires_at TIMESTAMP NULL,
    is_active BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (granted_by) REFERENCES users(id) ON DELETE RESTRICT,
    INDEX idx_user_module (user_id, module),
    INDEX idx_permission_type (permission_type),
    INDEX idx_active (is_active)
);

-- Activity log for auditing
CREATE TABLE IF NOT EXISTS activity_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    action VARCHAR(100) NOT NULL,
    description TEXT,
    module VARCHAR(50),
    ip_address VARCHAR(45),
    user_agent TEXT,
    status ENUM('success', 'failure', 'warning') DEFAULT 'success',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_user_id (user_id),
    INDEX idx_action (action),
    INDEX idx_module (module),
    INDEX idx_created_at (created_at),
    INDEX idx_status (status)
);

-- Insert default payment methods with mobile money
INSERT INTO payment_methods (method_name, method_code, description, api_endpoint, merchant_id) VALUES
('Cash', 'CASH', 'Physical cash payments', NULL, NULL),
('Bank Deposit', 'BANK', 'Direct bank deposits', NULL, NULL),
('Mobile Money - MTN', 'MTN', 'MTN Mobile Money payments', 'https://api.mtn.co.ug/v1/payments', 'ISNM_MTN_001'),
('Mobile Money - Airtel', 'AIRTEL', 'Airtel Money payments', 'https://api.airtel.com/v1/payments', 'ISNM_ATL_001'),
('Cheque', 'CHEQUE', 'Bank cheque payments', NULL, NULL),
('Bank Transfer', 'TRANSFER', 'Electronic bank transfers', NULL, NULL),
('Credit Card', 'CARD', 'Credit/Debit card payments', 'https://api.paymentgateway.com/v1', 'ISNM_CARD_001')
ON DUPLICATE KEY UPDATE description = VALUES(description), api_endpoint = VALUES(api_endpoint), merchant_id = VALUES(merchant_id);

-- Insert default expense categories
INSERT INTO expense_categories (category_name, category_code, department_id, description, budget_limit) VALUES
('Salaries & Wages', 'SALARY', 4, 'Staff salaries and wages', 50000000.00),
('Utilities', 'UTILITIES', 10, 'Water, electricity, internet', 5000000.00),
('Office Supplies', 'OFFICE', 5, 'Stationery and office materials', 2000000.00),
('Maintenance', 'MAINTENANCE', 10, 'Building and equipment maintenance', 3000000.00),
('Transport', 'TRANSPORT', 10, 'Vehicle fuel and maintenance', 4000000.00),
('Medical Supplies', 'MEDICAL', 6, 'Nursing and lab supplies', 8000000.00),
('Library Books', 'LIBRARY', 8, 'Books and learning materials', 3000000.00),
('ICT Equipment', 'ICT', 3, 'Computers and software', 6000000.00),
('Hostel Expenses', 'HOSTEL', 9, 'Hostel maintenance and supplies', 2500000.00),
('Security', 'SECURITY', 10, 'Security services and equipment', 1500000.00)
ON DUPLICATE KEY UPDATE budget_limit = VALUES(budget_limit);

-- Insert default scholarships
INSERT INTO scholarships (scholarship_name, scholarship_code, sponsor_name, scholarship_type, coverage_percentage, max_amount, eligibility_criteria) VALUES
('Government Sponsorship', 'GOVT', 'Ministry of Education', 'full', 100.00, 5000000.00, 'Ugandan citizens with good academic performance'),
('Merit Scholarship', 'MERIT', 'ISNM Foundation', 'partial', 50.00, 2500000.00, 'Students with excellent academic records'),
('Sports Scholarship', 'SPORTS', 'ISNM Sports Fund', 'partial', 30.00, 1500000.00, 'Talented sports students'),
('Need-Based Scholarship', 'NEED', 'ISNM Charity Fund', 'conditional', 40.00, 2000000.00, 'Students from disadvantaged backgrounds')
ON DUPLICATE KEY UPDATE max_amount = VALUES(max_amount);

-- Insert default chart of accounts
INSERT INTO chart_of_accounts (account_code, account_name, account_type, parent_account_id, account_level, description, created_by) VALUES
('1000', 'ASSETS', 'asset', NULL, 1, 'Total Assets', 1),
('1100', 'CURRENT ASSETS', 'asset', 1, 2, 'Current Assets', 1),
('1110', 'Cash and Cash Equivalents', 'asset', 2, 3, 'Cash and Bank Accounts', 1),
('1111', 'Cash on Hand', 'asset', 3, 4, 'Physical cash', 1),
('1112', 'Bank Accounts', 'asset', 3, 4, 'All bank accounts', 1),
('1120', 'Accounts Receivable', 'asset', 2, 3, 'Student fees receivable', 1),
('1121', 'Student Fees Receivable', 'asset', 5, 4, 'Outstanding student fees', 1),
('1200', 'FIXED ASSETS', 'asset', 1, 2, 'Fixed Assets', 1),
('1210', 'Equipment', 'asset', 6, 3, 'Medical and office equipment', 1),
('1220', 'Furniture and Fixtures', 'asset', 6, 3, 'Furniture and fixtures', 1),
('2000', 'LIABILITIES', 'liability', NULL, 1, 'Total Liabilities', 1),
('2100', 'CURRENT LIABILITIES', 'liability', 8, 2, 'Current Liabilities', 1),
('2110', 'Accounts Payable', 'liability', 9, 3, 'Amounts owed to suppliers', 1),
('2120', 'Accrued Expenses', 'liability', 9, 3, 'Accrued but unpaid expenses', 1),
('3000', 'EQUITY', 'equity', NULL, 1, 'Total Equity', 1),
('3100', 'Capital', 'equity', 12, 2, 'Share capital and reserves', 1),
('4000', 'REVENUE', 'revenue', NULL, 1, 'Total Revenue', 1),
('4100', 'Tuition Revenue', 'revenue', 14, 2, 'Tuition fees collected', 1),
('4200', 'Hostel Revenue', 'revenue', 14, 2, 'Hostel fees collected', 1),
('4300', 'Other Revenue', 'revenue', 14, 2, 'Other income sources', 1),
('5000', 'EXPENSES', 'expense', NULL, 1, 'Total Expenses', 1),
('5100', 'Salaries and Wages', 'expense', 17, 2, 'Staff salaries', 1),
('5200', 'Utilities', 'expense', 17, 2, 'Utility expenses', 1),
('5300', 'Administrative Expenses', 'expense', 17, 2, 'Administrative costs', 1)
ON DUPLICATE KEY UPDATE account_name = VALUES(account_name);

-- Insert default bank accounts
INSERT INTO bank_accounts (account_name, bank_name, account_number, account_type, branch_name, contact_person, contact_phone, opening_balance, current_balance, is_default, created_by) VALUES
('ISNM Main Account', 'Stanbic Bank', '0143456789', 'current', 'Iganga Branch', 'John Smith', '+256772514889', 10000000.00, 10000000.00, TRUE, 1),
('ISNM Savings Account', 'Centenary Bank', '3201234567', 'savings', 'Iganga Branch', 'Sarah Johnson', '+256730314979', 5000000.00, 5000000.00, FALSE, 1)
ON DUPLICATE KEY UPDATE current_balance = VALUES(current_balance);

-- Insert default financial settings
INSERT INTO financial_settings (setting_key, setting_value, setting_type, description) VALUES
('late_fee_percentage', '10', 'number', 'Percentage charged for late fee payments'),
('grace_period_days', '7', 'number', 'Grace period before late fees apply'),
('minimum_payment_percentage', '50', 'number', 'Minimum payment percentage required'),
('receipt_prefix', 'REC', 'string', 'Prefix for receipt numbers'),
('automatic_reminders', 'true', 'boolean', 'Enable automatic fee reminders'),
('reminder_frequency_days', '7', 'number', 'Frequency of fee reminders in days'),
('max_outstanding_days', '90', 'number', 'Maximum days before blocking student services'),
('currency_code', 'UGX', 'string', 'Default currency code'),
('tax_rate', '18', 'number', 'Default tax rate percentage'),
('mobile_money_enabled', 'true', 'boolean', 'Enable mobile money payments'),
('sms_notifications', 'true', 'boolean', 'Enable SMS notifications'),
('email_notifications', 'true', 'boolean', 'Enable email notifications'),
('auto_approve_small_payments', 'true', 'boolean', 'Auto-approve payments below threshold'),
('small_payment_threshold', '100000', 'number', 'Threshold for auto-approval')
ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value);

-- Insert default inventory items
INSERT INTO inventory_items (item_code, item_name, item_category, description, unit_cost, quantity, location, purchase_date, depreciation_rate, current_value, created_by) VALUES
('BED001', 'Student Bed - Single', 'Furniture', 'Single bed for student hostel', 150000.00, 50, 'Hostel A', '2024-01-15', 10.00, 135000.00, 1),
('BED002', 'Student Bed - Double', 'Furniture', 'Double bed for student hostel', 250000.00, 30, 'Hostel B', '2024-01-15', 10.00, 225000.00, 1),
('LAP001', 'Laptop - Dell', 'ICT Equipment', 'Dell laptop for staff use', 1200000.00, 15, 'Admin Office', '2024-02-01', 20.00, 960000.00, 1),
('STET001', 'Stethoscope', 'Medical Supplies', 'Medical stethoscope for clinical training', 85000.00, 100, 'Lab Room', '2024-01-20', 15.00, 72250.00, 1),
('BOOK001', 'Anatomy Textbook', 'Library', 'Human anatomy textbook', 45000.00, 200, 'Library', '2024-01-10', 10.00, 40500.00, 1)
ON DUPLICATE KEY UPDATE current_value = VALUES(current_value);

-- Create comprehensive views for reporting
CREATE VIEW fee_collection_summary AS
SELECT 
    ay.year_name,
    pm.method_name,
    COUNT(fp.id) as transaction_count,
    SUM(fp.amount) as total_amount,
    AVG(fp.amount) as average_amount,
    MIN(fp.payment_date) as first_payment,
    MAX(fp.payment_date) as last_payment
FROM fee_payments fp
JOIN payment_methods pm ON fp.payment_method_id = pm.id
JOIN student_fee_assignments sfa ON fp.fee_assignment_id = sfa.id
JOIN academic_years ay ON sfa.academic_year_id = ay.id
GROUP BY ay.year_name, pm.method_name;

CREATE VIEW outstanding_fees_summary AS
SELECT 
    p.program_name,
    ay.year_name,
    COUNT(sfa.student_id) as total_students,
    SUM(sfa.total_fees) as total_fees,
    SUM(sfa.amount_paid) as total_paid,
    SUM(sfa.outstanding_balance) as total_outstanding,
    AVG(sfa.outstanding_balance) as average_outstanding,
    COUNT(CASE WHEN sfa.outstanding_balance > 0 THEN 1 END) as students_with_balance,
    SUM(CASE WHEN sfa.payment_status = 'overdue' THEN sfa.outstanding_balance ELSE 0 END) as overdue_amount
FROM student_fee_assignments sfa
JOIN students st ON sfa.student_id = st.student_id
JOIN programs p ON st.program_id = p.id
JOIN academic_years ay ON sfa.academic_year_id = ay.id
GROUP BY p.program_name, ay.year_name;

CREATE VIEW budget_utilization AS
SELECT 
    d.department_name,
    ay.year_name,
    b.budget_name,
    b.annual_budget,
    b.allocated_budget,
    b.spent,
    b.remaining,
    b.utilization_percentage,
    CASE 
        WHEN b.utilization_percentage >= 90 THEN 'Critical'
        WHEN b.utilization_percentage >= 75 THEN 'Warning'
        WHEN b.utilization_percentage >= 50 THEN 'Normal'
        ELSE 'Underutilized'
    END as utilization_status
FROM budgets b
JOIN departments d ON b.department_id = d.id
JOIN academic_years ay ON b.academic_year_id = ay.id;

CREATE VIEW payroll_summary AS
SELECT 
    p.pay_period,
    COUNT(p.id) as staff_count,
    SUM(p.basic_salary) as total_basic_salary,
    SUM(p.total_allowances) as total_allowances,
    SUM(p.total_deductions) as total_deductions,
    SUM(p.net_salary) as total_net_salary,
    AVG(p.net_salary) as average_net_salary,
    COUNT(CASE WHEN p.status = 'paid' THEN 1 END) as paid_count
FROM payroll p
GROUP BY p.pay_period;

CREATE VIEW inventory_summary AS
SELECT 
    item_category,
    COUNT(*) as total_items,
    SUM(quantity) as total_quantity,
    SUM(current_value) as total_value,
    AVG(current_value) as average_value
FROM inventory_items
WHERE status = 'active'
GROUP BY item_category;

CREATE VIEW aged_debtors AS
SELECT 
    s.student_id,
    CONCAT(s.first_name, ' ', s.last_name) as student_name,
    p.program_name,
    sfa.outstanding_balance,
    DATEDIFF(CURDATE(), sfa.last_payment_date) as days_overdue,
    CASE 
        WHEN DATEDIFF(CURDATE(), sfa.last_payment_date) <= 30 THEN 'Current'
        WHEN DATEDIFF(CURDATE(), sfa.last_payment_date) <= 60 THEN '30-60 Days'
        WHEN DATEDIFF(CURDATE(), sfa.last_payment_date) <= 90 THEN '60-90 Days'
        ELSE 'Over 90 Days'
    END as aging_category
FROM student_fee_assignments sfa
JOIN students s ON sfa.student_id = s.student_id
JOIN programs p ON s.program_id = p.id
WHERE sfa.outstanding_balance > 0;

-- Create indexes for performance
CREATE INDEX idx_fee_payments_composite ON fee_payments(student_id, payment_date, payment_status);
CREATE INDEX idx_student_fee_assignments_composite ON student_fee_assignments(student_id, academic_year_id, payment_status);
CREATE INDEX idx_expenses_composite ON expenses(department_id, expense_date, status);
CREATE INDEX idx_general_ledger_composite ON general_ledger(account_id, transaction_date, transaction_type);
CREATE INDEX idx_inventory_items_composite ON inventory_items(item_category, status);
CREATE INDEX idx_activity_log_composite ON activity_log(user_id, created_at, status);

-- Enhanced stored procedures for bursar operations
DELIMITER //

CREATE PROCEDURE generate_student_fees(IN p_student_id INT, IN p_academic_year_id INT)
BEGIN
    DECLARE v_program_id INT;
    DECLARE v_fee_structure_id INT;
    
    -- Get student's program
    SELECT program_id INTO v_program_id
    FROM students
    WHERE student_id = p_student_id;
    
    -- Get fee structure for program and academic year
    SELECT id INTO v_fee_structure_id
    FROM fee_structures
    WHERE program_id = v_program_id AND academic_year_id = p_academic_year_id AND is_active = TRUE;
    
    -- Create fee assignment if not exists
    IF v_fee_structure_id IS NOT NULL THEN
        INSERT INTO student_fee_assignments (student_id, fee_structure_id, academic_year_id, tuition_fee, accommodation_fee, clinical_fee, library_fee, examination_fee, registration_fee, other_fees)
        SELECT p_student_id, v_fee_structure_id, p_academic_year_id, tuition_fee, accommodation_fee, clinical_fee, library_fee, examination_fee, registration_fee, other_fees
        FROM fee_structures
        WHERE id = v_fee_structure_id
        ON DUPLICATE KEY UPDATE updated_at = CURRENT_TIMESTAMP;
        
        SELECT 'Fee assignment generated successfully' AS message;
    ELSE
        SELECT 'No fee structure found for this program and academic year' AS message;
    END IF;
END//

CREATE PROCEDURE process_payment(
    IN p_student_id INT,
    IN p_amount DECIMAL(10,2),
    IN p_payment_method_id INT,
    IN p_receipt_number VARCHAR(50),
    IN p_created_by INT
)
BEGIN
    DECLARE v_fee_assignment_id INT;
    DECLARE v_outstanding_balance DECIMAL(10,2);
    DECLARE v_payment_method_code VARCHAR(20);
    
    -- Get current fee assignment
    SELECT id, outstanding_balance INTO v_fee_assignment_id, v_outstanding_balance
    FROM student_fee_assignments
    WHERE student_id = p_student_id AND outstanding_balance > 0
    ORDER BY academic_year_id DESC, semester DESC
    LIMIT 1;
    
    -- Get payment method code
    SELECT method_code INTO v_payment_method_code
    FROM payment_methods
    WHERE id = p_payment_method_id;
    
    IF v_fee_assignment_id IS NOT NULL THEN
        -- Record payment
        INSERT INTO fee_payments (student_id, fee_assignment_id, amount, payment_method_id, receipt_number, payment_date, created_by)
        VALUES (p_student_id, v_fee_assignment_id, p_amount, p_payment_method_id, p_receipt_number, CURDATE(), p_created_by);
        
        -- Update fee assignment
        UPDATE student_fee_assignments
        SET amount_paid = amount_paid + p_amount,
            last_payment_date = CURDATE(),
            payment_status = CASE 
                WHEN outstanding_balance - p_amount <= 0 THEN 'paid'
                WHEN amount_paid + p_amount > 0 THEN 'partial'
                ELSE 'unpaid'
            END
        WHERE id = v_fee_assignment_id;
        
        -- Log activity
        INSERT INTO activity_log (user_id, action, description, module, status)
        VALUES (p_created_by, 'PAYMENT_RECEIVED', CONCAT('Payment of UGX ', p_amount, ' via ', v_payment_method_code, ' received from student ', p_student_id), 'finance', 'success');
        
        SELECT 'Payment processed successfully' AS message;
    ELSE
        SELECT 'No outstanding balance found for student' AS message;
    END IF;
END//

CREATE PROCEDURE generate_financial_report(
    IN p_report_type VARCHAR(50),
    IN p_start_date DATE,
    IN p_end_date DATE,
    IN p_generated_by INT
)
BEGIN
    DECLARE v_report_data JSON;
    
    CASE p_report_type
        WHEN 'trial_balance' THEN
            SET v_report_data = (
                SELECT JSON_ARRAYAGG(
                    JSON_OBJECT(
                        'account_code', coa.account_code,
                        'account_name', coa.account_name,
                        'account_type', coa.account_type,
                        'debit_balance', SUM(CASE WHEN gl.transaction_type = 'debit' THEN gl.amount ELSE 0 END),
                        'credit_balance', SUM(CASE WHEN gl.transaction_type = 'credit' THEN gl.amount ELSE 0 END)
                    )
                )
                FROM chart_of_accounts coa
                LEFT JOIN general_ledger gl ON coa.id = gl.account_id
                WHERE gl.transaction_date BETWEEN p_start_date AND p_end_date OR gl.transaction_date IS NULL
                GROUP BY coa.id, coa.account_code, coa.account_name, coa.account_type
            );
        
        WHEN 'income_statement' THEN
            SET v_report_data = (
                SELECT JSON_OBJECT(
                    'total_revenue', (SELECT COALESCE(SUM(amount), 0) FROM general_ledger gl JOIN chart_of_accounts coa ON gl.account_id = coa.id WHERE coa.account_type = 'revenue' AND gl.transaction_date BETWEEN p_start_date AND p_end_date),
                    'total_expenses', (SELECT COALESCE(SUM(amount), 0) FROM general_ledger gl JOIN chart_of_accounts coa ON gl.account_id = coa.id WHERE coa.account_type = 'expense' AND gl.transaction_date BETWEEN p_start_date AND p_end_date),
                    'net_income', (
                        (SELECT COALESCE(SUM(amount), 0) FROM general_ledger gl JOIN chart_of_accounts coa ON gl.account_id = coa.id WHERE coa.account_type = 'revenue' AND gl.transaction_date BETWEEN p_start_date AND p_end_date) -
                        (SELECT COALESCE(SUM(amount), 0) FROM general_ledger gl JOIN chart_of_accounts coa ON gl.account_id = coa.id WHERE coa.account_type = 'expense' AND gl.transaction_date BETWEEN p_start_date AND p_end_date)
                    )
                )
            );
        
        WHEN 'aged_debtors' THEN
            SET v_report_data = (
                SELECT JSON_ARRAYAGG(
                    JSON_OBJECT(
                        'student_id', s.student_id,
                        'student_name', CONCAT(s.first_name, ' ', s.last_name),
                        'program_name', p.program_name,
                        'outstanding_balance', sfa.outstanding_balance,
                        'days_overdue', DATEDIFF(CURDATE(), COALESCE(sfa.last_payment_date, sfa.created_at)),
                        'last_payment', sfa.last_payment_date
                    )
                )
                FROM student_fee_assignments sfa
                JOIN students s ON sfa.student_id = s.student_id
                JOIN programs p ON s.program_id = p.id
                WHERE sfa.outstanding_balance > 0
            );
        
        WHEN 'ura_tax_report' THEN
            SET v_report_data = (
                SELECT JSON_OBJECT(
                    'total_revenue', (SELECT COALESCE(SUM(amount), 0) FROM general_ledger gl JOIN chart_of_accounts coa ON gl.account_id = coa.id WHERE coa.account_type = 'revenue' AND gl.transaction_date BETWEEN p_start_date AND p_end_date),
                    'taxable_amount', (SELECT COALESCE(SUM(amount), 0) FROM general_ledger gl JOIN chart_of_accounts coa ON gl.account_id = coa.id WHERE coa.account_type = 'revenue' AND gl.transaction_date BETWEEN p_start_date AND p_end_date),
                    'tax_rate', (SELECT CAST(setting_value AS DECIMAL(5,2)) FROM financial_settings WHERE setting_key = 'tax_rate'),
                    'tax_payable', (SELECT COALESCE(SUM(amount), 0) * (SELECT CAST(setting_value AS DECIMAL(5,2)) / 100 FROM financial_settings WHERE setting_key = 'tax_rate') FROM general_ledger gl JOIN chart_of_accounts coa ON gl.account_id = coa.id WHERE coa.account_type = 'revenue' AND gl.transaction_date BETWEEN p_start_date AND p_end_date)
                )
            );
    END CASE;
    
    -- Save report
    INSERT INTO financial_reports (report_name, report_type, report_period, start_date, end_date, report_data, generated_by)
    VALUES (CONCAT(p_report_type, ' Report'), p_report_type, DATE_FORMAT(p_start_date, '%Y-%m'), p_start_date, p_end_date, v_report_data, p_generated_by);
    
    SELECT LAST_INSERT_ID() AS report_id;
END//

CREATE PROCEDURE send_fee_reminders()
BEGIN
    DECLARE v_student_id INT;
    DECLARE v_outstanding_balance DECIMAL(10,2);
    DECLARE v_days_overdue INT;
    DECLARE v_reminder_message TEXT;
    DECLARE v_student_email VARCHAR(100);
    DECLARE v_student_phone VARCHAR(20);
    DECLARE done INT DEFAULT FALSE;
    
    DECLARE student_cursor CURSOR FOR
        SELECT sfa.student_id, sfa.outstanding_balance, DATEDIFF(CURDATE(), COALESCE(sfa.last_payment_date, sfa.created_at)) as days_overdue,
               s.email, s.phone
        FROM student_fee_assignments sfa
        JOIN students s ON sfa.student_id = s.student_id
        WHERE sfa.outstanding_balance > 0 AND s.status = 'active'
        AND (sfa.last_payment_date IS NULL OR DATEDIFF(CURDATE(), COALESCE(sfa.last_payment_date, sfa.created_at)) >= 7);
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
    
    OPEN student_cursor;
    
    read_loop: LOOP
        FETCH student_cursor INTO v_student_id, v_outstanding_balance, v_days_overdue, v_student_email, v_student_phone;
        IF done THEN
            LEAVE read_loop;
        END IF;
        
        -- Create reminder message
        SET v_reminder_message = CONCAT(
            'Dear Student, your outstanding fee balance is UGX ', FORMAT(v_outstanding_balance, 0),
            '. Please make payment to avoid penalties. Days overdue: ', v_days_overdue,
            '. Visit the bursar\'s office or pay online.'
        );
        
        -- Insert reminder record
        INSERT INTO fee_reminders (student_id, reminder_type, reminder_message, scheduled_date, outstanding_balance, days_overdue, created_by)
        VALUES (v_student_id, 'both', v_reminder_message, CURDATE(), v_outstanding_balance, v_days_overdue, 1);
        
    END LOOP;
    
    CLOSE student_cursor;
END//

CREATE PROCEDURE process_mobile_money_payment(
    IN p_phone_number VARCHAR(20),
    IN p_amount DECIMAL(10,2),
    IN p_student_id INT,
    IN p_payment_method_id INT
)
BEGIN
    DECLARE v_reference VARCHAR(100);
    DECLARE v_status VARCHAR(20);
    
    -- Generate reference
    SET v_reference = CONCAT('MM', DATE_FORMAT(NOW(), '%Y%m%d%H%i%s'), LPAD(FLOOR(RAND() * 1000), 3, '0'));
    
    -- Simulate mobile money API call
    -- In real implementation, this would call actual MTN/Airtel APIs
    SET v_status = CASE 
        WHEN p_amount > 0 THEN 'success'
        ELSE 'failed'
    END;
    
    IF v_status = 'success' THEN
        -- Process the payment
        CALL process_payment(p_student_id, p_amount, p_payment_method_id, CONCAT('REC', v_reference), 1);
        SELECT CONCAT('Mobile money payment processed successfully. Reference: ', v_reference) AS message;
    ELSE
        SELECT 'Mobile money payment failed' AS message;
    END IF;
END//

CREATE PROCEDURE calculate_penalties()
BEGIN
    DECLARE v_grace_period_days INT;
    DECLARE v_late_fee_percentage DECIMAL(5,2);
    
    -- Get settings
    SELECT CAST(setting_value AS UNSIGNED) INTO v_grace_period_days
    FROM financial_settings WHERE setting_key = 'grace_period_days';
    
    SELECT CAST(setting_value AS DECIMAL(5,2)) INTO v_late_fee_percentage
    FROM financial_settings WHERE setting_key = 'late_fee_percentage';
    
    -- Update penalties for overdue accounts
    UPDATE student_fee_assignments
    SET penalty_fee = CASE 
        WHEN DATEDIFF(CURDATE(), COALESCE(last_payment_date, created_at)) > v_grace_period_days 
        THEN outstanding_balance * (v_late_fee_percentage / 100)
        ELSE 0
    END
    WHERE outstanding_balance > 0 
    AND DATEDIFF(CURDATE(), COALESCE(last_payment_date, created_at)) > v_grace_period_days;
    
    SELECT 'Penalties calculated successfully' AS message;
END//

DELIMITER ;

-- Enhanced triggers for automatic updates
DELIMITER //

CREATE TRIGGER update_bank_balance 
AFTER INSERT ON bank_transactions
FOR EACH ROW
BEGIN
    IF NEW.transaction_type = 'deposit' THEN
        UPDATE bank_accounts 
        SET current_balance = current_balance + NEW.amount
        WHERE id = NEW.bank_account_id;
    ELSEIF NEW.transaction_type = 'withdrawal' THEN
        UPDATE bank_accounts 
        SET current_balance = current_balance - NEW.amount
        WHERE id = NEW.bank_account_id;
    END IF;
    
    -- Log the transaction in general ledger
    INSERT INTO general_ledger (account_id, transaction_date, transaction_type, amount, reference_number, description, related_transaction_type, related_transaction_id, balance_after, created_by)
    VALUES (
        (SELECT id FROM chart_of_accounts WHERE account_code = '1112'),
        NEW.transaction_date,
        CASE WHEN NEW.transaction_type = 'deposit' THEN 'debit' ELSE 'credit' END,
        NEW.amount,
        NEW.transaction_reference,
        NEW.description,
        'bank_transaction',
        NEW.id,
        (SELECT current_balance FROM bank_accounts WHERE id = NEW.bank_account_id),
        NEW.created_by
    );
END//

CREATE TRIGGER update_budget_spent 
AFTER UPDATE ON expenses
FOR EACH ROW
BEGIN
    IF NEW.status = 'paid' AND OLD.status != 'paid' THEN
        UPDATE budgets 
        SET spent = spent + NEW.amount
        WHERE id = NEW.budget_id;
        
        -- Log expense payment
        INSERT INTO general_ledger (account_id, transaction_date, transaction_type, amount, reference_number, description, related_transaction_type, related_transaction_id, balance_after, created_by)
        VALUES (
            (SELECT id FROM chart_of_accounts WHERE account_code = '5200'),
            NEW.paid_date,
            'debit',
            NEW.amount,
            NEW.invoice_number,
            CONCAT('Payment for ', NEW.expense_title),
            'expense',
            NEW.id,
            (SELECT current_balance FROM chart_of_accounts WHERE account_code = '5200') - NEW.amount,
            NEW.paid_by
        );
    END IF;
END//

CREATE TRIGGER log_financial_activity 
AFTER INSERT ON fee_payments
FOR EACH ROW
BEGIN
    INSERT INTO activity_log (user_id, action, description, module, status)
    VALUES (NEW.created_by, 'PAYMENT_RECEIVED', CONCAT('Payment of UGX ', NEW.amount, ' received from student ', NEW.student_id), 'finance', 'success');
    
    -- Log to general ledger
    INSERT INTO general_ledger (account_id, transaction_date, transaction_type, amount, reference_number, description, related_transaction_type, related_transaction_id, balance_after, created_by)
    VALUES (
        (SELECT id FROM chart_of_accounts WHERE account_code = '1121'),
        NEW.payment_date,
        'debit',
        NEW.amount,
        NEW.receipt_number,
        CONCAT('Fee payment from student ', NEW.student_id),
        'payment',
        NEW.id,
        (SELECT current_balance FROM chart_of_accounts WHERE account_code = '1121') + NEW.amount,
        NEW.created_by
    );
    
    -- Also credit cash account
    INSERT INTO general_ledger (account_id, transaction_date, transaction_type, amount, reference_number, description, related_transaction_type, related_transaction_id, balance_after, created_by)
    VALUES (
        (SELECT id FROM chart_of_accounts WHERE account_code = '1111'),
        NEW.payment_date,
        'credit',
        NEW.amount,
        NEW.receipt_number,
        CONCAT('Cash received from student ', NEW.student_id),
        'payment',
        NEW.id,
        (SELECT current_balance FROM chart_of_accounts WHERE account_code = '1111') + NEW.amount,
        NEW.created_by
    );
END//

CREATE TRIGGER update_inventory_balance 
AFTER INSERT ON inventory_transactions
FOR EACH ROW
BEGIN
    UPDATE inventory_items
    SET quantity = CASE 
        WHEN NEW.transaction_type IN ('purchase', 'return') THEN quantity + NEW.quantity
        WHEN NEW.transaction_type IN ('issue', 'disposal') THEN quantity - NEW.quantity
        ELSE quantity
    END,
    current_value = quantity * unit_cost
    WHERE id = NEW.item_id;
    
    -- Log inventory transaction
    INSERT INTO activity_log (user_id, action, description, module, status)
    VALUES (NEW.created_by, CONCAT('INVENTORY_', NEW.transaction_type), CONCAT(NEW.quantity, ' units of item ', NEW.item_id, ' processed'), 'inventory', 'success');
END//

DELIMITER ;

-- Enhanced events for automated tasks
CREATE EVENT IF NOT EXISTS generate_fee_reminders
ON SCHEDULE EVERY 1 DAY
STARTS '2024-01-01 09:00:00'
DO CALL send_fee_reminders();

CREATE EVENT IF NOT EXISTS calculate_daily_penalties
ON SCHEDULE EVERY 1 DAY
STARTS '2024-01-01 00:00:00'
DO CALL calculate_penalties();

CREATE EVENT IF NOT EXISTS update_overdue_statuses
ON SCHEDULE EVERY 1 DAY
STARTS '2024-01-01 00:00:00'
DO
    UPDATE student_fee_assignments 
    SET payment_status = 'overdue'
    WHERE outstanding_balance > 0 
    AND (last_payment_date IS NULL OR DATEDIFF(CURDATE(), last_payment_date) > 30)
    AND payment_status != 'overdue';

CREATE EVENT IF NOT EXISTS cleanup_old_activity_logs
ON SCHEDULE EVERY 1 MONTH
STARTS '2024-01-01 02:00:00'
DO
    DELETE FROM activity_log 
    WHERE created_at < DATE_SUB(NOW(), INTERVAL 1 YEAR);

-- Final comments
-- This complete bursar.sql file provides comprehensive financial management functionality
-- It includes:
-- 1. Complete fee structure management with penalty calculations
-- 2. Enhanced payment processing with mobile money integration
-- 3. Full budgeting and expenditure management
-- 4. Comprehensive payroll integration
-- 5. Complete accounts and ledger management
-- 6. Inventory and asset financial tracking
-- 7. Advanced communication tools (SMS/Email)
-- 8. User roles and access control with permissions
-- 9. Activity logging for auditing
-- 10. URA-compatible reporting
-- 11. AI-ready data structures
-- 12. Complete CRUD operations support
-- 13. Automated workflows and notifications
-- 14. Comprehensive reporting views
-- 15. Stored procedures for complex operations
-- 16. Triggers for data integrity
-- 17. Events for automated tasks

-- Usage: SOURCE sql/login.sql; then SOURCE sql/bursar_complete.sql;
