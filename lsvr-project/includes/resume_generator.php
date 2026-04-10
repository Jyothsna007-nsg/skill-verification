<?php
session_start();
include("db.php");

// Check user
if (!isset($_POST['user_id'])) {
    die("Invalid Request");
}

$user_id = $_POST['user_id'];

// FETCH USER DETAILS
$user_query = mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id'");
$user = mysqli_fetch_assoc($user_query);

// FETCH LATEST RESULT
$result_query = mysqli_query($conn, "
    SELECT * FROM results 
    WHERE user_id='$user_id' 
    ORDER BY id DESC LIMIT 1
");
$result = mysqli_fetch_assoc($result_query);

if (!$user || !$result) {
    die("Data not found");
}

// DATA
$name = $user['name'];
$email = $user['email'];
$score = $result['score'];
$total = $result['total_questions'];
$languages = $result['languages'];
$percentage = round(($score / $total) * 100, 2);

// CREATE RESUME CONTENT
$resume = "
<html>
<head>
    <title>Resume - $name</title>
    <style>
        body { font-family: Arial; padding: 30px; }
        h1 { color: #333; }
        .section { margin-top: 20px; }
    </style>
</head>
<body>

<h1>$name</h1>
<p><strong>Email:</strong> $email</p>

<div class='section'>
    <h2>Skills</h2>
    <p>$languages</p>
</div>

<div class='section'>
    <h2>Exam Performance</h2>
    <p>Score: $score / $total</p>
    <p>Percentage: $percentage%</p>
</div>

<div class='section'>
    <h2>Summary</h2>
    <p>Motivated candidate with strong knowledge in $languages. 
    Demonstrated performance through technical assessment.</p>
</div>

</body>
</html>
";

// SAVE FILE
$filename = "resume_" . $user_id . "_" . time() . ".html";
$file_path = "../uploads/" . $filename;

file_put_contents($file_path, $resume);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Resume Generated</title>
    <style>
        body { font-family: Arial; text-align: center; margin-top: 50px; }
        .btn {
            padding: 10px 20px;
            background: green;
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>

<h2>✅ Resume Generated Successfully!</h2>

<a href="<?php echo $file_path; ?>" download class="btn">
    Download Resume
</a>

<br><br>

<a href="../dashboard.php">⬅ Back to Dashboard</a>

</body>
</html>