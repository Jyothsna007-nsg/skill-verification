-- =========================
-- DATABASE
-- =========================
CREATE DATABASE IF NOT EXISTS lsvr;
USE lsvr;

-- =========================
-- USERS TABLE
-- =========================
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),

    -- Extra profile fields
    phone VARCHAR(20),
    skills TEXT,
    education VARCHAR(255),
    experience TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- ADMIN TABLE (OPTIONAL)
-- =========================
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(100)
);

INSERT INTO admin (username, password) VALUES ('admin', 'admin123');

-- =========================
-- QUESTIONS TABLE
-- =========================
CREATE TABLE questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    language VARCHAR(50),
    level VARCHAR(20),        -- easy, medium, hard
    type VARCHAR(20),         -- mcq, coding, aptitude

    question TEXT,
    option1 TEXT,
    option2 TEXT,
    option3 TEXT,
    option4 TEXT,
    answer VARCHAR(255),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- EXAMS TABLE (TRACK ATTEMPTS)
-- =========================
CREATE TABLE exams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    languages VARCHAR(255),
    total_questions INT,

    start_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    end_time TIMESTAMP NULL,

    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- =========================
-- RESULTS TABLE
-- =========================
CREATE TABLE results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    exam_id INT,

    score INT,
    total_questions INT,
    percentage FLOAT,
    languages VARCHAR(255),

    exam_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (exam_id) REFERENCES exams(id) ON DELETE CASCADE
);

-- =========================
-- ANSWERS TABLE (DETAILED)
-- =========================
CREATE TABLE answers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    exam_id INT,
    question_id INT,
    user_answer TEXT,
    correct_answer TEXT,
    is_correct BOOLEAN,

    FOREIGN KEY (exam_id) REFERENCES exams(id) ON DELETE CASCADE,
    FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE
);

-- =========================
-- NOTIFICATIONS TABLE
-- =========================
CREATE TABLE notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- USER NOTIFICATIONS (TRACK READ STATUS)
-- =========================
CREATE TABLE user_notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    notification_id INT,
    is_read BOOLEAN DEFAULT FALSE,

    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (notification_id) REFERENCES notifications(id) ON DELETE CASCADE
);

-- =========================
-- RESUMES TABLE
-- =========================
CREATE TABLE resumes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    file_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- =========================
-- CERTIFICATES TABLE
-- =========================
CREATE TABLE certificates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    file_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- =========================
-- INDEXES (PERFORMANCE)
-- =========================
CREATE INDEX idx_user_id ON results(user_id);
CREATE INDEX idx_exam_id ON answers(exam_id);
CREATE INDEX idx_language ON questions(language);

-- =========================
-- SAMPLE DATA (OPTIONAL)
-- =========================
INSERT INTO users (name, email, password) 
VALUES ('Test User', 'test@example.com', '1234');

INSERT INTO notifications (message) 
VALUES ('Welcome to LSVR Platform!'), 
       ('New exam available!');
