-- ============================================================
-- BUSINESS TYPE:
-- ============================================================
-- >>> ACADEMIC TUTORING BUSINESS <<<
-- ============================================================

-- ============================================================
-- SERVICE PROVIDED:
--   The Academic Tutoring Business provides personalized academic
--   tutoring and mentoring sessions for students. Qualified tutors
--   offer targeted instruction in various subjects such as Math,
--   Physics, SAT Prep, and Languages.
-- ============================================================

-- ============================================================
-- ONE-TO-MANY RELATIONSHIP:
--   For ONE TUTOR, he/she can have/teach MANY SESSIONS
--   registered in the database.
--
--   tutors (1) ──────>> sessions (Many)
-- ============================================================

-- Create the database
CREATE DATABASE IF NOT EXISTS academic_tutoring_web_business;
USE academic_tutoring_web_business;

-- ============================================================
-- PARENT TABLE: tutors
-- Stores personal and professional information of tutors
-- ============================================================
CREATE TABLE IF NOT EXISTS tutors (
    tutor_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    phone_number VARCHAR(50),
    specialization VARCHAR(255) NOT NULL,
    hourly_rate DECIMAL(10, 2) NOT NULL,
    date_joined DATE NOT NULL DEFAULT (CURRENT_DATE)
);

-- ============================================================
-- CHILD TABLE: sessions
-- Stores individual tutoring lessons conducted by tutors
-- ONE tutor can teach MANY sessions (One-to-Many)
-- ============================================================
CREATE TABLE IF NOT EXISTS sessions (
    session_id INT AUTO_INCREMENT PRIMARY KEY,
    tutor_id INT NOT NULL,
    session_date DATE NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    subject_taught VARCHAR(200) NOT NULL,
    notes TEXT,
    FOREIGN KEY (tutor_id) REFERENCES tutors(tutor_id) ON DELETE CASCADE
);

-- ============================================================
-- SAMPLE DATA FOR TESTING:
-- ============================================================
-- INSERT INTO tutors (first_name, last_name, email, phone_number, specialization, hourly_rate, date_joined)
-- VALUES 
-- ('John', 'Smith', 'john.smith@example.com', '+1-555-0199', 'Math, Physics, SAT Prep', 45.00, '2024-01-15'),
-- ('Sarah', 'Jenkins', 'sarah.j@example.com', '+1-555-0142', 'Biology, Chemistry, AP Prep', 50.00, '2024-02-01');

-- INSERT INTO sessions (tutor_id, session_date, start_time, end_time, subject_taught, notes)
-- VALUES 
-- (1, '2024-10-20', '14:00:00', '15:30:00', 'Calculus I', 'Reviewed chain rule and trigonometric derivatives. Student understood key concepts.'),
-- (1, '2024-10-22', '16:00:00', '17:00:00', 'SAT Math Prep', 'Completed practice test section 3. Worked on grid-in algebra questions.'),
-- (2, '2024-10-21', '10:00:00', '11:30:00', 'Organic Chemistry', 'Covered reaction mechanisms and resonance structures.');
