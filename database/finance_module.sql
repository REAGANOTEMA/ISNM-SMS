-- ISNM Finance Module (staffs_db)
-- Fee billing, payments, budgets, ledger, payroll, inventory

CREATE TABLE IF NOT EXISTS fin_fee_structures (
    id INT AUTO_INCREMENT PRIMARY KEY,
    program VARCHAR(120) NOT NULL,
    academic_year VARCHAR(20) NOT NULL,
    year_level INT DEFAULT 1,
    semester INT DEFAULT 1,
    tuition_fee DECIMAL(14,2) DEFAULT 0,
    accommodation_fee DECIMAL(14,2) DEFAULT 0,
    clinical_fee DECIMAL(14,2) DEFAULT 0,
    library_fee DECIMAL(14,2) DEFAULT 0,
    examination_fee DECIMAL(14,2) DEFAULT 0,
    registration_fee DECIMAL(14,2) DEFAULT 0,
    other_fees DECIMAL(14,2) DEFAULT 0,
    total_fees DECIMAL(14,2) DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_by INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY uq_program_year (program, academic_year, year_level, semester)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS fin_student_accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(50) NOT NULL,
    student_name VARCHAR(150) NOT NULL,
    phone VARCHAR(30) NULL,
    email VARCHAR(120) NULL,
    program VARCHAR(120) NULL,
    academic_year VARCHAR(20) NULL,
    year_level INT DEFAULT 1,
    semester INT DEFAULT 1,
    fee_structure_id INT NULL,
    tuition_fee DECIMAL(14,2) DEFAULT 0,
    accommodation_fee DECIMAL(14,2) DEFAULT 0,
    clinical_fee DECIMAL(14,2) DEFAULT 0,
    other_fees DECIMAL(14,2) DEFAULT 0,
    total_fees DECIMAL(14,2) DEFAULT 0,
    scholarship_amount DECIMAL(14,2) DEFAULT 0,
    waiver_amount DECIMAL(14,2) DEFAULT 0,
    penalty_amount DECIMAL(14,2) DEFAULT 0,
    amount_paid DECIMAL(14,2) DEFAULT 0,
    balance DECIMAL(14,2) DEFAULT 0,
    status ENUM('unpaid','partial','paid','overdue','cleared') DEFAULT 'unpaid',
    last_payment_date DATE NULL,
    due_date DATE NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uq_student_term (student_id, academic_year, semester),
    INDEX idx_balance (balance),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS fin_invoices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    invoice_no VARCHAR(40) NOT NULL UNIQUE,
    student_account_id INT NOT NULL,
    student_id VARCHAR(50) NOT NULL,
    term_label VARCHAR(40) NOT NULL,
    amount DECIMAL(14,2) NOT NULL,
    amount_paid DECIMAL(14,2) DEFAULT 0,
    due_date DATE NOT NULL,
    status ENUM('draft','issued','partial','paid','cancelled') DEFAULT 'issued',
    issued_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_by INT NULL,
    INDEX idx_student (student_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS fin_payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    receipt_no VARCHAR(40) NOT NULL UNIQUE,
    student_id VARCHAR(50) NOT NULL,
    student_account_id INT NULL,
    invoice_id INT NULL,
    amount DECIMAL(14,2) NOT NULL,
    payment_method ENUM('cash','bank','mobile_money','cheque','online') NOT NULL,
    payment_provider VARCHAR(40) NULL,
    payment_reference VARCHAR(100) NULL,
    bank_name VARCHAR(80) NULL,
    proof_file VARCHAR(255) NULL,
    notes TEXT NULL,
    status ENUM('pending','verified','rejected') DEFAULT 'pending',
    verified_by INT NULL,
    verified_at DATETIME NULL,
    payment_date DATE NOT NULL,
    created_by INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_student (student_id),
    INDEX idx_status (status),
    INDEX idx_date (payment_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS fin_adjustments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(50) NOT NULL,
    adjustment_type ENUM('discount','waiver','refund','penalty') NOT NULL,
    amount DECIMAL(14,2) NOT NULL,
    reason TEXT NULL,
    status ENUM('pending','approved','rejected') DEFAULT 'pending',
    requested_by INT NULL,
    approved_by INT NULL,
    approved_at DATETIME NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_student (student_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS fin_scholarships (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    scholarship_type ENUM('full','partial','fixed','percent') DEFAULT 'partial',
    value_amount DECIMAL(14,2) DEFAULT 0,
    value_percent DECIMAL(5,2) DEFAULT 0,
    criteria TEXT NULL,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS fin_student_scholarships (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(50) NOT NULL,
    scholarship_id INT NOT NULL,
    amount_applied DECIMAL(14,2) DEFAULT 0,
    academic_year VARCHAR(20) NULL,
    assigned_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY uq_stu_sch (student_id, scholarship_id, academic_year)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS fin_penalty_rules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(80) NOT NULL,
    days_after_due INT NOT NULL DEFAULT 30,
    penalty_type ENUM('fixed','percent') DEFAULT 'percent',
    penalty_value DECIMAL(14,2) NOT NULL,
    is_active TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS fin_budgets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fiscal_year VARCHAR(20) NOT NULL,
    department VARCHAR(80) NOT NULL,
    category VARCHAR(80) NOT NULL,
    allocated_amount DECIMAL(14,2) NOT NULL,
    spent_amount DECIMAL(14,2) DEFAULT 0,
    term_label VARCHAR(40) NULL,
    status ENUM('draft','active','closed') DEFAULT 'active',
    created_by INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS fin_expenses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    budget_id INT NULL,
    description VARCHAR(255) NOT NULL,
    category VARCHAR(80) NOT NULL,
    amount DECIMAL(14,2) NOT NULL,
    expense_date DATE NOT NULL,
    department VARCHAR(80) NULL,
    status ENUM('pending','approved','rejected','paid') DEFAULT 'pending',
    requested_by INT NULL,
    approved_by INT NULL,
    approved_at DATETIME NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS fin_chart_accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    account_code VARCHAR(20) NOT NULL UNIQUE,
    account_name VARCHAR(120) NOT NULL,
    account_type ENUM('asset','liability','equity','income','expense') NOT NULL,
    parent_id INT NULL,
    is_active TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS fin_ledger_entries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    entry_date DATE NOT NULL,
    account_id INT NOT NULL,
    description VARCHAR(255) NOT NULL,
    debit DECIMAL(14,2) DEFAULT 0,
    credit DECIMAL(14,2) DEFAULT 0,
    reference_type VARCHAR(40) NULL,
    reference_id INT NULL,
    created_by INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_date (entry_date),
    INDEX idx_account (account_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS fin_payroll_runs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    period_label VARCHAR(40) NOT NULL,
    period_start DATE NOT NULL,
    period_end DATE NOT NULL,
    total_gross DECIMAL(14,2) DEFAULT 0,
    total_net DECIMAL(14,2) DEFAULT 0,
    status ENUM('draft','processed','paid') DEFAULT 'draft',
    created_by INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS fin_payroll_lines (
    id INT AUTO_INCREMENT PRIMARY KEY,
    payroll_run_id INT NOT NULL,
    staff_id INT NOT NULL,
    staff_name VARCHAR(120) NOT NULL,
    basic_salary DECIMAL(14,2) DEFAULT 0,
    allowances DECIMAL(14,2) DEFAULT 0,
    deductions DECIMAL(14,2) DEFAULT 0,
    net_pay DECIMAL(14,2) DEFAULT 0,
    INDEX idx_run (payroll_run_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS fin_assets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    asset_name VARCHAR(150) NOT NULL,
    category VARCHAR(80) NOT NULL,
    purchase_amount DECIMAL(14,2) NOT NULL,
    purchase_date DATE NOT NULL,
    expense_id INT NULL,
    depreciation_rate DECIMAL(5,2) DEFAULT 0,
    current_value DECIMAL(14,2) NULL,
    location VARCHAR(120) NULL,
    status ENUM('active','disposed','maintenance') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS fin_notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(50) NULL,
    channel ENUM('sms','email','system') NOT NULL,
    subject VARCHAR(150) NULL,
    message TEXT NOT NULL,
    status ENUM('queued','sent','failed') DEFAULT 'queued',
    scheduled_at DATETIME NULL,
    sent_at DATETIME NULL,
    created_by INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS fin_activity_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    staff_id INT NULL,
    staff_name VARCHAR(120) NULL,
    action VARCHAR(80) NOT NULL,
    module VARCHAR(40) NOT NULL,
    details TEXT NULL,
    ip_address VARCHAR(45) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_module (module)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS fin_settings (
    setting_key VARCHAR(80) PRIMARY KEY,
    setting_value TEXT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT IGNORE INTO fin_penalty_rules (name, days_after_due, penalty_type, penalty_value) VALUES
('Standard Late Fee', 30, 'percent', 5.00);

INSERT IGNORE INTO fin_chart_accounts (account_code, account_name, account_type) VALUES
('1000', 'Cash & Bank', 'asset'),
('4000', 'Tuition Income', 'income'),
('4010', 'Accommodation Income', 'income'),
('4020', 'Clinical Fees Income', 'income'),
('5000', 'Salaries Expense', 'expense'),
('5100', 'Utilities Expense', 'expense'),
('5200', 'Supplies Expense', 'expense');

INSERT IGNORE INTO fin_settings (setting_key, setting_value) VALUES
('momo_mtn_enabled', '0'),
('momo_airtel_enabled', '0'),
('ura_reporting_enabled', '0'),
('late_fee_block_results', '1'),
('currency', 'UGX');
