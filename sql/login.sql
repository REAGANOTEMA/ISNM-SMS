-- ISNM School Management System - Login and Authentication Database
-- This file contains all login-related tables and functionality
-- Shared across all modules for authentication

-- Create database if not exists
CREATE DATABASE IF NOT EXISTS isnm;
USE isnm;

-- Users table (for all users - staff and students)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20),
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    role ENUM('admin', 'staff', 'student') NOT NULL,
    department VARCHAR(50),
    status ENUM('active', 'inactive', 'suspended') DEFAULT 'active',
    last_login DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_username (username),
    INDEX idx_email (email),
    INDEX idx_role (role),
    INDEX idx_status (status)
);

-- Staff specific information
CREATE TABLE IF NOT EXISTS staff_users (
    staff_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    staff_number VARCHAR(20) UNIQUE NOT NULL,
    position VARCHAR(100),
    department VARCHAR(50),
    employment_date DATE,
    salary DECIMAL(10,2),
    address TEXT,
    emergency_contact VARCHAR(100),
    emergency_phone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_staff_number (staff_number),
    INDEX idx_position (position),
    INDEX idx_department (department)
);

-- Student specific information
CREATE TABLE IF NOT EXISTS students (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    student_number VARCHAR(20) UNIQUE NOT NULL,
    program_id INT,
    year_of_study INT,
    semester INT,
    admission_date DATE,
    date_of_birth DATE,
    gender ENUM('male', 'female'),
    address TEXT,
    guardian_name VARCHAR(100),
    guardian_phone VARCHAR(20),
    guardian_email VARCHAR(100),
    status ENUM('active', 'inactive', 'graduated', 'suspended') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_student_number (student_number),
    INDEX idx_program (program_id),
    INDEX idx_status (status)
);

-- Academic programs
CREATE TABLE IF NOT EXISTS programs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    program_name VARCHAR(100) NOT NULL,
    program_code VARCHAR(20) UNIQUE NOT NULL,
    duration_years INT NOT NULL,
    department VARCHAR(50),
    description TEXT,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_program_code (program_code),
    INDEX idx_department (department),
    INDEX idx_status (status)
);

-- Academic years
CREATE TABLE IF NOT EXISTS academic_years (
    id INT AUTO_INCREMENT PRIMARY KEY,
    year_name VARCHAR(20) UNIQUE NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    status ENUM('active', 'inactive') DEFAULT 'inactive',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_year_name (year_name),
    INDEX idx_status (status)
);

-- User sessions
CREATE TABLE IF NOT EXISTS user_sessions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    session_id VARCHAR(255) UNIQUE NOT NULL,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    expires_at DATETIME NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id),
    INDEX idx_session_id (session_id),
    INDEX idx_expires_at (expires_at)
);

-- Activity log for all user actions
CREATE TABLE IF NOT EXISTS activity_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    action VARCHAR(50) NOT NULL,
    description TEXT,
    module VARCHAR(50),
    ip_address VARCHAR(45),
    user_agent TEXT,
    status ENUM('success', 'failed', 'warning') DEFAULT 'success',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_user_id (user_id),
    INDEX idx_action (action),
    INDEX idx_module (module),
    INDEX idx_created_at (created_at)
);

-- Login attempts tracking
CREATE TABLE IF NOT EXISTS login_attempts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    ip_address VARCHAR(45),
    user_agent TEXT,
    attempt_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    success BOOLEAN DEFAULT FALSE,
    failure_reason VARCHAR(100),
    INDEX idx_username (username),
    INDEX idx_attempt_time (attempt_time),
    INDEX idx_ip_address (ip_address)
);

-- Password reset tokens
CREATE TABLE IF NOT EXISTS password_reset_tokens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    token VARCHAR(255) UNIQUE NOT NULL,
    expires_at DATETIME NOT NULL,
    used BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id),
    INDEX idx_token (token),
    INDEX idx_expires_at (expires_at)
);

-- User roles and permissions
CREATE TABLE IF NOT EXISTS user_roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) UNIQUE NOT NULL,
    description TEXT,
    permissions JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_role_name (role_name)
);

-- User role assignments
CREATE TABLE IF NOT EXISTS user_role_assignments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    role_id INT NOT NULL,
    assigned_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    assigned_by INT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (role_id) REFERENCES user_roles(id) ON DELETE CASCADE,
    FOREIGN KEY (assigned_by) REFERENCES users(id) ON DELETE SET NULL,
    UNIQUE KEY unique_user_role (user_id, role_id),
    INDEX idx_user_id (user_id),
    INDEX idx_role_id (role_id)
);

-- Departments
CREATE TABLE IF NOT EXISTS departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    department_name VARCHAR(100) NOT NULL,
    department_code VARCHAR(20) UNIQUE NOT NULL,
    head_of_department VARCHAR(100),
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_department_code (department_code),
    INDEX idx_department_name (department_name)
);

-- Positions
CREATE TABLE IF NOT EXISTS positions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    position_name VARCHAR(100) NOT NULL,
    position_code VARCHAR(20) UNIQUE NOT NULL,
    department_id INT,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (department_id) REFERENCES departments(id) ON DELETE SET NULL,
    INDEX idx_position_code (position_code),
    INDEX idx_department_id (department_id)
);

-- Insert default user roles
INSERT INTO user_roles (role_name, description, permissions) VALUES
('admin', 'System Administrator', '{"all": true}'),
('staff', 'Staff Member', '{"dashboard": true, "profile": true}'),
('student', 'Student', '{"dashboard": true, "profile": true, "fees": true}'),
('director_general', 'Director General', '{"all": true}'),
('director_academics', 'Director Academics', '{"academics": true, "students": true}'),
('director_ict', 'Director ICT', '{"ict": true, "systems": true}'),
('director_finance', 'Director Finance', '{"finance": true, "reports": true}'),
('principal', 'School Principal', '{"all": true}'),
('deputy_principal', 'Deputy Principal', '{"academics": true, "students": true}'),
('school_bursar', 'School Bursar', '{"finance": true, "fees": true, "reports": true}'),
('academic_registrar', 'Academic Registrar', '{"academics": true, "students": true}'),
('hr_manager', 'HR Manager', '{"hr": true, "staff": true}'),
('secretary', 'School Secretary', '{"admin": true, "communications": true}'),
('librarian', 'School Librarian', '{"library": true}'),
('head_nursing', 'Head of Nursing', '{"academics": true, "students": true}'),
('head_midwifery', 'Head of Midwifery', '{"academics": true, "students": true}'),
('senior_lecturer', 'Senior Lecturer', '{"academics": true, "students": true}'),
('lecturer', 'Lecturer', '{"academics": true, "students": true}'),
('matron', 'Matron', '{"students": true, "hostel": true}'),
('lab_technician', 'Lab Technician', '{"lab": true, "equipment": true}'),
('driver', 'Driver', '{"transport": true}'),
('security', 'Security', '{"security": true}'),
('guild_president', 'Guild President', '{"students": true, "leadership": true}'),
('class_rep', 'Class Representative', '{"students": true, "communications": true}')
ON DUPLICATE KEY UPDATE permissions = VALUES(permissions);

-- Insert default departments
INSERT INTO departments (department_name, department_code, head_of_department) VALUES
('Academic Affairs', 'ACAD', 'Director Academics'),
('Finance Department', 'FIN', 'Director Finance'),
('ICT Department', 'ICT', 'Director ICT'),
('Human Resources', 'HR', 'HR Manager'),
('School Administration', 'ADMIN', 'School Principal'),
('Nursing Department', 'NURS', 'Head of Nursing'),
('Midwifery Department', 'MID', 'Head of Midwifery'),
('Library Services', 'LIB', 'School Librarian'),
('Student Affairs', 'STUD', 'Academic Registrar'),
('Support Services', 'SUPP', 'Operations Manager')
ON DUPLICATE KEY UPDATE head_of_department = VALUES(head_of_department);

-- Insert default positions
INSERT INTO positions (position_name, position_code, department_id) VALUES
('Director General', 'DG', 5),
('Director Academics', 'DA', 1),
('Director ICT', 'DICT', 3),
('Director Finance', 'DF', 2),
('School Principal', 'SP', 5),
('Deputy Principal', 'DP', 5),
('School Bursar', 'SB', 2),
('Academic Registrar', 'AR', 9),
('HR Manager', 'HRM', 4),
('School Secretary', 'SS', 5),
('School Librarian', 'SL', 8),
('Head of Nursing', 'HN', 6),
('Head of Midwifery', 'HM', 7),
('Senior Lecturer', 'SLR', 1),
('Lecturer', 'LEC', 1),
('Matron', 'MAT', 9),
('Lab Technician', 'LT', 6),
('Driver', 'DRV', 10),
('Security Officer', 'SEC', 10),
('Guild President', 'GP', 9),
('Class Representative', 'CR', 9)
ON DUPLICATE KEY UPDATE position_name = VALUES(position_name);

-- Insert default academic years
INSERT INTO academic_years (year_name, start_date, end_date, status) VALUES
('2023/2024', '2023-09-01', '2024-08-31', 'active'),
('2024/2025', '2024-09-01', '2025-08-31', 'inactive'),
('2025/2026', '2025-09-01', '2026-08-31', 'inactive')
ON DUPLICATE KEY UPDATE status = VALUES(status);

-- Insert default programs
INSERT INTO programs (program_name, program_code, duration_years, department, description) VALUES
('Diploma in Nursing', 'DN', 3, 'Nursing Department', '3-year diploma program in nursing'),
('Diploma in Midwifery', 'DM', 3, 'Midwifery Department', '3-year diploma program in midwifery'),
('Certificate in Nursing', 'CN', 2, 'Nursing Department', '2-year certificate program in nursing'),
('Certificate in Midwifery', 'CM', 2, 'Midwifery Department', '2-year certificate program in midwifery'),
('Short Course in Basic Nursing', 'SBN', 6, 'Nursing Department', '6-month short course in basic nursing'),
('Short Course in Basic Midwifery', 'SBM', 6, 'Midwifery Department', '6-month short course in basic midwifery')
ON DUPLICATE KEY UPDATE description = VALUES(description);

-- Create default admin user (password: admin123)
INSERT INTO users (username, password, email, phone, first_name, last_name, role, department, status) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@isnm.ac.ug', '+256123456789', 'System', 'Administrator', 'admin', 'school-bursar', 'active')
ON DUPLICATE KEY UPDATE password = VALUES(password);

-- Create sample staff users
INSERT INTO users (username, password, email, phone, first_name, last_name, role, department, status) VALUES
('bursar', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'bursar@isnm.ac.ug', '+256772514889', 'Sarah', 'Johnson', 'staff', 'school-bursar', 'active'),
('principal', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'principal@isnm.ac.ug', '+256730314979', 'John', 'Smith', 'staff', 'school-administration', 'active'),
('registrar', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'registrar@isnm.ac.ug', '+256755555555', 'Mary', 'Williams', 'staff', 'academic-affairs', 'active')
ON DUPLICATE KEY UPDATE password = VALUES(password);

-- Create sample student users
INSERT INTO users (username, password, email, phone, first_name, last_name, role, department, status) VALUES
('student001', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student001@isnm.ac.ug', '+256711111111', 'James', 'Mukasa', 'student', 'academic-affairs', 'active'),
('student002', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student002@isnm.ac.ug', '+256722222222', 'Grace', 'Nakato', 'student', 'academic-affairs', 'active')
ON DUPLICATE KEY UPDATE password = VALUES(password);

-- Insert staff user details
INSERT INTO staff_users (user_id, staff_number, position, department, employment_date, salary, address, emergency_contact, emergency_phone) VALUES
(2, 'STF001', 'School Bursar', 'Finance Department', '2020-01-15', 2500000.00, 'Plot 123 Iganga Town', 'Dr. Johnson Smith', '+256733333333'),
(3, 'STF002', 'School Principal', 'School Administration', '2019-08-01', 3500000.00, 'Plot 456 Iganga Town', 'Mrs. Jane Smith', '+256744444444'),
(4, 'STF003', 'Academic Registrar', 'Academic Affairs', '2021-03-20', 2800000.00, 'Plot 789 Iganga Town', 'Mr. Robert Brown', '+256755555555')
ON DUPLICATE KEY UPDATE position = VALUES(position);

-- Insert student details
INSERT INTO students (user_id, student_number, program_id, year_of_study, semester, admission_date, date_of_birth, gender, address, guardian_name, guardian_phone, guardian_email, status) VALUES
(5, 'STU001', 1, 2, 1, '2023-09-01', '2000-05-15', 'male', 'Plot 100 Kampala Road', 'Mr. Peter Mukasa', '+256766666666', 'peter.mukasa@email.com', 'active'),
(6, 'STU002', 2, 1, 1, '2024-09-01', '2001-08-20', 'female', 'Plot 200 Jinja Road', 'Mrs. Susan Nakato', '+256777777777', 'susan.nakato@email.com', 'active')
ON DUPLICATE KEY UPDATE year_of_study = VALUES(year_of_study);

-- Create indexes for better performance
CREATE INDEX idx_users_composite ON users(role, status, department);
CREATE INDEX idx_activity_log_composite ON activity_log(user_id, created_at);
CREATE INDEX idx_login_attempts_composite ON login_attempts(username, attempt_time);
CREATE INDEX idx_students_composite ON students(status, program_id);

-- Create view for active users
CREATE VIEW active_users AS
SELECT u.*, su.staff_number, su.position, s.student_number, p.program_name
FROM users u
LEFT JOIN staff_users su ON u.id = su.user_id
LEFT JOIN students s ON u.id = s.user_id
LEFT JOIN programs p ON s.program_id = p.id
WHERE u.status = 'active';

-- Create view for user activity summary
CREATE VIEW user_activity_summary AS
SELECT 
    u.id,
    u.username,
    u.first_name,
    u.last_name,
    u.role,
    COUNT(al.id) as total_activities,
    MAX(al.created_at) as last_activity,
    COUNT(CASE WHEN al.status = 'failed' THEN 1 END) as failed_activities
FROM users u
LEFT JOIN activity_log al ON u.id = al.user_id
GROUP BY u.id, u.username, u.first_name, u.last_name, u.role;

-- Triggers for automatic logging
DELIMITER //

CREATE TRIGGER log_user_login 
AFTER INSERT ON user_sessions
FOR EACH ROW
BEGIN
    INSERT INTO activity_log (user_id, action, description, module, ip_address, user_agent, status)
    VALUES (NEW.user_id, 'LOGIN', 'User logged in', 'authentication', NEW.ip_address, NEW.user_agent, 'success');
END//

CREATE TRIGGER log_user_logout 
AFTER UPDATE ON user_sessions
FOR EACH ROW
BEGIN
    IF NEW.is_active = FALSE AND OLD.is_active = TRUE THEN
        INSERT INTO activity_log (user_id, action, description, module, status)
        VALUES (NEW.user_id, 'LOGOUT', 'User logged out', 'authentication', 'success');
    END IF;
END//

CREATE TRIGGER track_failed_login 
AFTER INSERT ON login_attempts
FOR EACH ROW
BEGIN
    IF NEW.success = FALSE THEN
        INSERT INTO activity_log (user_id, action, description, module, ip_address, user_agent, status)
        VALUES (NULL, 'LOGIN_FAILED', CONCAT('Failed login attempt: ', NEW.failure_reason), 'authentication', NEW.ip_address, NEW.user_agent, 'failed');
    END IF;
END//

DELIMITER ;

-- Stored procedures for user management
DELIMITER //

CREATE PROCEDURE authenticate_user(IN p_username VARCHAR(50), IN p_password VARCHAR(255))
BEGIN
    DECLARE user_id INT;
    DECLARE user_role VARCHAR(50);
    DECLARE user_status VARCHAR(20);
    DECLARE hashed_password VARCHAR(255);
    
    -- Get user details
    SELECT id, role, status, password INTO user_id, user_role, user_status, hashed_password
    FROM users
    WHERE username = p_username AND status = 'active';
    
    -- Verify password and return result
    IF user_id IS NOT NULL AND hashed_password = p_password THEN
        SELECT 
            u.id,
            u.username,
            u.first_name,
            u.last_name,
            u.email,
            u.phone,
            u.role,
            u.department,
            su.staff_number,
            su.position,
            s.student_number,
            p.program_name
        FROM users u
        LEFT JOIN staff_users su ON u.id = su.user_id
        LEFT JOIN students s ON u.id = s.user_id
        LEFT JOIN programs p ON s.program_id = p.id
        WHERE u.id = user_id;
        
        -- Log successful login
        INSERT INTO login_attempts (username, ip_address, user_agent, success)
        VALUES (p_username, '', '', TRUE);
    ELSE
        SELECT NULL AS id, NULL AS username, NULL AS first_name, NULL AS last_name, 
               NULL AS email, NULL AS phone, NULL AS role, NULL AS department,
               NULL AS staff_number, NULL AS position, NULL AS student_number, NULL AS program_name;
        
        -- Log failed login
        INSERT INTO login_attempts (username, ip_address, user_agent, success, failure_reason)
        VALUES (p_username, '', '', FALSE, 'Invalid credentials');
    END IF;
END//

CREATE PROCEDURE create_user_session(
    IN p_user_id INT,
    IN p_session_id VARCHAR(255),
    IN p_ip_address VARCHAR(45),
    IN p_user_agent TEXT
)
BEGIN
    INSERT INTO user_sessions (user_id, session_id, ip_address, user_agent, expires_at)
    VALUES (p_user_id, p_session_id, p_ip_address, p_user_agent, DATE_ADD(NOW(), INTERVAL 1 HOUR));
    
    SELECT LAST_INSERT_ID() AS session_id;
END//

CREATE PROCEDURE cleanup_expired_sessions()
BEGIN
    DELETE FROM user_sessions WHERE expires_at < NOW();
    DELETE FROM password_reset_tokens WHERE expires_at < NOW();
END//

DELIMITER ;

-- Create event to clean up expired sessions
CREATE EVENT IF NOT EXISTS cleanup_sessions
ON SCHEDULE EVERY 1 HOUR
DO CALL cleanup_expired_sessions();

-- Enable event scheduler
SET GLOBAL event_scheduler = ON;

-- Final comments
-- This login.sql file provides complete authentication infrastructure
-- It includes:
-- 1. User management (staff and students)
-- 2. Role-based access control
-- 3. Session management
-- 4. Activity logging
-- 5. Password reset functionality
-- 6. Login attempt tracking
-- 7. Automatic cleanup procedures
-- 8. Views for reporting
-- 9. Stored procedures for common operations

-- All other modules should include this file first
-- Use: SOURCE sql/login.sql;
