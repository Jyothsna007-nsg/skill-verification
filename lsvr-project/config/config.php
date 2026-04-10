<?php
// =========================
// APP BASIC SETTINGS
// =========================
define('APP_NAME', 'LSVR Project');
define('BASE_URL', 'http://localhost/lsvr-project/'); // change if needed

// =========================
// DATABASE SETTINGS
// =========================
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'lsvr');

// =========================
// EXAM SETTINGS
// =========================
define('EXAM_TIME', 600); // in seconds (10 mins)
define('QUESTIONS_PER_LANG', 5);

// =========================
// FILE PATHS
// =========================
define('UPLOAD_PATH', __DIR__ . '/../uploads/');
define('RESUME_PATH', BASE_URL . 'uploads/');
define('CERTIFICATE_PATH', BASE_URL . 'uploads/');

// =========================
// ADMIN SETTINGS
// =========================
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', 'admin123');

// =========================
// SECURITY SETTINGS
// =========================
define('SESSION_TIMEOUT', 1800); // 30 minutes

// =========================
// ERROR REPORTING (DEV MODE)
// =========================
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>