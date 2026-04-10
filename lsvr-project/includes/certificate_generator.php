<?php
session_start();
include("db.php");

// Validate request
if (!isset($_POST['user_id'])) {
    die("Invalid Request");
}

$user_id = $_POST['user_id'];

// FETCH USER
$user_query = mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id'");
$user = mysqli_fetch_assoc($user_query);

// FETCH RESULT
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
$score = $result['score'];
$total = $result['total_questions'];
$languages = $result['languages'];
$percentage = round(($score / $total) * 100, 2);
$date = date("d M Y");

// CERTIFICATE CONTENT
$certificate = "
<html>
<head>
    <title>Certificate - $name</title>
    <style>
        body {
            text-align: center;
            font-family: Georgia;
            padding: 50px;
            border: 10px solid #000;
        }
        h1 {
            font-size: 40px;
            margin-bottom: 20px;
        }
        h2 {
            margin: 10px 0;
        }
        .content {
            margin-top: 30px;
            font-size: 18px;
        }
    </style>
</head>
<body>

<h1>Certificate of Achievement</h1>

<h2>This is to certify that</h2>

<h1>$name</h1>

<div class='content'>
    has successfully completed the technical assessment in <strong>$languages</strong><br><br>

    Score: <strong>$score / $total</strong><br>
    Percentage: <strong>$percentage%</strong><br><br>

    Awarded on: $date
</div>

</body>
</html>
";

// SAVE FILE
$filename = "certificate_" . $user_id . "_" . time() . ".html";
$file_path = "../uploads/" . $filename;

file_put_contents($file_path, $certificate);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Certificate Generated</title>
    <style>
        body { font-family: Arial; text-align: center; margin-top: 50px; }
        .btn {
            padding: 10px 20px;
            background: blue;
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>

<h2>🎉 Certificate Generated Successfully!</h2>

<a href="<?php echo $file_path; ?>" download class="btn">
    Download Certificate
</a>

<br><br>

<a href="../dashboard.php">⬅ Back to Dashboard</a>

</body>
</html>