<?php
session_start();
include("includes/db.php");

// =========================
// VALIDATION
// =========================
if (!isset($_SESSION['exam_questions']) || empty($_SESSION['exam_questions'])) {
    die("No exam data found. Please take the test again.");
}

// Get questions
$questions = $_SESSION['exam_questions'];

// Get user answers safely
$userAnswers = [];
if (isset($_POST['answers_json']) && !empty($_POST['answers_json'])) {
    $decoded = json_decode($_POST['answers_json'], true);
    if (is_array($decoded)) {
        $userAnswers = $decoded;
    }
}

$score = 0;
$total = count($questions);
$percentage = ($total > 0) ? round(($score / $total) * 100) : 0;

// =========================
// SCORE CALCULATION
// =========================
foreach ($questions as $index => $q) {

    $correctAnswer = isset($q['answer']) ? trim($q['answer']) : '';
    $userAnswer = isset($userAnswers[$index]) ? trim($userAnswers[$index]) : '';

    if ($userAnswer !== '' && $correctAnswer !== '' && $userAnswer === $correctAnswer) {
        $score++;
    }
}

// Percentage
$percentage = ($total > 0) ? round(($score / $total) * 100) : 0;
// =========================
// SAVE EXAM + RESULT TO DATABASE
// =========================
$user_id = $_SESSION['user_id'] ?? 0;
$languages = $_SESSION['selected_languages'] ?? '';

if ($user_id > 0) {

    // Insert into exams table
    $examQuery = "INSERT INTO exams (user_id, languages, total_questions)
                  VALUES ('$user_id', '$languages', '$total')";
    mysqli_query($conn, $examQuery);

    // Get exam id
    $exam_id = mysqli_insert_id($conn);

    // Insert into results table
    $resultQuery = "INSERT INTO results 
        (user_id, exam_id, score, total_questions, percentage, languages)
        VALUES 
        ('$user_id', '$exam_id', '$score', '$total', '$percentage', '$languages')";

    mysqli_query($conn, $resultQuery);
}
$_SESSION['last_score'] = $score . " / " . $total;
$_SESSION['last_percentage'] = $percentage;
?>

<!DOCTYPE html>
<html>
<head>
<title>Result</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
body {
    font-family:'Poppins',sans-serif;
    background: linear-gradient(to right, #1e3a8a, #2563eb);
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    color:white;
}

/* RESULT BOX */
.result-box {
    background:white;
    color:black;
    padding:40px;
    border-radius:20px;
    text-align:center;
    width:350px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
    animation: fadeIn 0.8s ease-in-out;
}

@keyframes fadeIn {
    from { opacity:0; transform:translateY(20px); }
    to { opacity:1; transform:translateY(0); }
}

h1 {
    margin-bottom:20px;
}

.score {
    font-size:40px;
    margin:20px 0;
    color:#2563eb;
}

/* CIRCLE */
.progress-circle {
    width:120px;
    height:120px;
    border-radius:50%;
    background: conic-gradient(#2563eb <?php echo $percentage; ?>%, #ddd 0%);
    display:flex;
    justify-content:center;
    align-items:center;
    margin:20px auto;
}

.progress-circle span {
    font-size:20px;
    font-weight:bold;
}

/* BUTTON */
.btn {
    margin-top:20px;
    padding:10px 20px;
    background:#2563eb;
    color:white;
    border:none;
    border-radius:20px;
    cursor:pointer;
    transition:0.3s;
}

.btn:hover {
    background:#1e40af;
}
</style>

</head>

<body>

<div class="result-box">
    <h1>Exam Result</h1>

    <div class="progress-circle">
        <span><?php echo $percentage; ?>%</span>
    </div>

    <div class="score">
        <?php echo $score . " / " . $total; ?>
    </div>

    <p>
        <?php
        if ($percentage >= 80) echo "Excellent Performance 🎉";
        elseif ($percentage >= 50) echo "Good Job 👍";
        else echo "Needs Improvement 💡";
        ?>
    </p>

    <button class="btn" onclick="window.location.href='dashboard.php'">
        Back to Dashboard
    </button>
</div>

</body>
</html>