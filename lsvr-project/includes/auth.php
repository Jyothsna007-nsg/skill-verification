<?php
// Start session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* =========================
   USER AUTH FUNCTIONS
========================= */

// Check if user is logged in
function checkUser() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
}

// Get logged-in user ID
function getUserId() {
    return $_SESSION['user_id'] ?? null;
}

// Get logged-in user name
function getUserName() {
    return $_SESSION['user_name'] ?? null;
}


/* =========================
   ADMIN AUTH FUNCTIONS
========================= */

// Check if admin is logged in
function checkAdmin() {
    if (!isset($_SESSION['admin'])) {
        header("Location: admin_login.php");
        exit();
    }
}

// Check if already logged in (prevent re-login)
function alreadyLoggedIn() {
    if (isset($_SESSION['user_id'])) {
        header("Location: dashboard.php");
        exit();
    }

    if (isset($_SESSION['admin'])) {
        header("Location: admin/admin_dashboard.php");
        exit();
    }
}


/* =========================
   LOGOUT FUNCTION
========================= */

function logout() {
    $_SESSION = [];
    session_destroy();
    header("Location: index.php");
    exit();
}
?>