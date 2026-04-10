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

// Test performance
$score = $_SESSION['last_score'] ?? "N/A";
$percentage = $_SESSION['last_percentage'] ?? "0";
$test_name = $_SESSION['selected_languages'] ?? "General Test";

// =========================
// CREATE RESUME HTML CONTENT (FOR ADMIN VIEW)
// =========================
$resume_content = "
<!DOCTYPE html>
<html>
<head>
<title>Resume</title>
<style>
body { font-family: Arial; padding:20px; line-height:1.6; }
h1 { text-align:center; color:#2563eb; }
.section { margin-top:20px; }
h2 { border-bottom:2px solid #2563eb; }
</style>
</head>
<body>

<h1>$name</h1>
<p style='text-align:center;'>$email | $phone</p>

<div class='section'>
<h2>Education</h2>
<p>$degree - $college (CGPA: $cgpa)</p>
</div>

<div class='section'>
<h2>Skills</h2>
<p>$skills</p>
</div>

<div class='section'>
<h2>Experience</h2>
<p>$experience</p>
</div>

<div class='section'>
<h2>Projects</h2>
<p>$projects</p>
</div>

<div class='section'>
<h2>Test Performance</h2>
<p><b>Test:</b> $test_name</p>
<p><b>Score:</b> $score</p>
<p><b>Percentage:</b> $percentage%</p>
</div>

</body>
</html>
";

// =========================
// SAVE FILE
// =========================
if (!is_dir("uploads/resumes")) {
    mkdir("uploads/resumes", 0777, true);
}

$file_path = "uploads/resumes/resume_" . $user_id . "_" . time() . ".html";

file_put_contents($file_path, $resume_content);

// =========================
// INSERT INTO DATABASE
// =========================
$insert = "INSERT INTO resumes (user_id, file_path) 
           VALUES ('$user_id', '$file_path')";
mysqli_query($conn, $insert);
?>

<!DOCTYPE html>
<html>
<head>
<title>Generated Resume</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

<style>
body {
    font-family:'Poppins',sans-serif;
    background:#eef2ff;
}

.container {
    max-width:800px;
    margin:30px auto;
}

.resume {
    background:white;
    padding:40px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

h1 {
    text-align:center;
    color:#2563eb;
}

.header {
    text-align:center;
    margin-bottom:20px;
    color:#555;
}

.section {
    margin-top:25px;
}

.section h2 {
    border-left:5px solid #2563eb;
    padding-left:10px;
    margin-bottom:10px;
    color:#1e3a8a;
}

.btn {
    display:block;
    margin:20px auto;
    padding:12px 25px;
    background:#2563eb;
    color:white;
    border:none;
    border-radius:25px;
    cursor:pointer;
    transition:0.3s;
}

.btn:hover {
    background:#1e40af;
}
</style>
</head>

<body>

<div class="container">

<div id="resume" class="resume">

<h1><?php echo $name; ?></h1>
<div class="header">
<?php echo $email; ?> | <?php echo $phone; ?>
</div>

<div class="section">
<h2>Education</h2>
<p><?php echo $degree; ?> - <?php echo $college; ?> (CGPA: <?php echo $cgpa; ?>)</p>
</div>

<div class="section">
<h2>Skills</h2>
<p><?php echo $skills; ?></p>
</div>

<div class="section">
<h2>Experience</h2>
<p><?php echo nl2br($experience); ?></p>
</div>

<div class="section">
<h2>Projects</h2>
<p><?php echo nl2br($projects); ?></p>
</div>

<div class="section">
<h2>Test Performance</h2>
<p><b>Test:</b> <?php echo $test_name; ?></p>
<p><b>Score:</b> <?php echo $score; ?></p>
<p><b>Percentage:</b> <?php echo $percentage; ?>%</p>
</div>

</div>

<button class="btn" onclick="downloadPDF()">Download PDF</button>

</div>

<script>
function downloadPDF() {
    const element = document.getElementById("resume");
    html2pdf().from(element).save("Resume.pdf");
}
</script>

</body>
</html>