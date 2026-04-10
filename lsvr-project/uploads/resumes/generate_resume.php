<?php
session_start();
include("includes/db.php");

// Get user id
$user_id = $_SESSION['user_id'] ?? 0;

if ($user_id == 0) {
    die("User not logged in");
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$degree = $_POST['degree'];
$college = $_POST['college'];
$cgpa = $_POST['cgpa'];

$skills = $_POST['skills'];
$experience = $_POST['experience'];
$projects = $_POST['projects'];

// Get test score from session
$score = $_SESSION['last_score'] ?? "N/A";
$percentage = $_SESSION['last_percentage'] ?? 0;

// =========================
// CREATE RESUME HTML
// =========================
$resume_content = "
<!DOCTYPE html>
<html>
<head>
<title>Resume</title>
<style>
body { font-family: Arial; padding:20px; }
h2 { color:#2563eb; }
.section { margin-top:20px; }
</style>
</head>
<body>

<h2>$name</h2>
<p><b>Email:</b> $email</p>
<p><b>Phone:</b> $phone</p>

<div class='section'>
<h3>Academic Details</h3>
<p>$degree - $college (CGPA: $cgpa)</p>
</div>

<div class='section'>
<h3>Skills</h3>
<p>$skills</p>
</div>

<div class='section'>
<h3>Experience</h3>
<p>$experience</p>
</div>

<div class='section'>
<h3>Projects</h3>
<p>$projects</p>
</div>

<div class='section'>
<h3>Test Performance</h3>
<p>Score: $score</p>
<p>Percentage: $percentage%</p>
</div>

</body>
</html>
";

// =========================
// SAVE FILE
// =========================

// Create folder if not exists
if (!is_dir("uploads/resumes")) {
    mkdir("uploads/resumes", 0777, true);
}

// File path
$file_path = "uploads/resumes/resume_" . $user_id . "_" . time() . ".html";

// Save file
file_put_contents($file_path, $resume_content);
// =========================
// INSERT INTO DATABASE (VERY IMPORTANT)
// =========================
$user_id = $_SESSION['user_id'] ?? 0;

if ($user_id > 0) {

    $insert = "INSERT INTO resumes (user_id, file_path) 
               VALUES ('$user_id', '$file_path')";

if(mysqli_query($conn, $insert)){
    echo "Resume saved in DB";
} else {
    echo mysqli_error($conn);
}
exit();}

// =========================
// SAVE IN DATABASE
// =========================
$query = "INSERT INTO resumes (user_id, file_path) 
          VALUES ('$user_id', '$file_path')";

mysqli_query($conn, $query);

// =========================
// REDIRECT TO VIEW
// =========================
header("Location: $file_path");
exit();
?>