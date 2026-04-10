<?php
// Start session (optional but useful globally)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database credentials
$host = "localhost";
$user = "root";        // default XAMPP user
$pass = "";            // default password (empty in XAMPP)
$db   = "lsvr";        // your database name

// Create connection
$conn = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

// Set charset (important for proper data handling)
mysqli_set_charset($conn, "utf8mb4");
?>