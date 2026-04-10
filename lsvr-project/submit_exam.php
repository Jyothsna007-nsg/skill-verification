<?php
session_start();
include("includes/db.php");
include("includes/auth.php");

// Check if exam session exists
if (!isset($_SESSION['exam_questions'])) {
    die("No exam data found.");
}

$questions = $_SESSION['exam_questions'];
$userAnswers = isset($_POST['answers']) ? $_POST['answers'] : [];

$score = 0;
$total = count($questions);

// Evaluate answers
foreach ($questions as $index => $q) {
    $correctAnswer = $q['answer'];

    if (isset($userAnswers[$index]) && $userAnswers[$index] == $correctAnswer) {
        $score++;
    }
}

// Calculate percentage
$percentage = ($total > 0) ? round(($score / $total) * 100) : 0;

// Get user ID (from session)
$user_id = $_SESSION['user_id'];

// Store result in database
$query = "INSERT INTO results (user_id, score, total_questions, percentage, created_at)
          VALUES ('$user_id', '$score', '$total', '$percentage', NOW())";

mysqli_query($conn, $query);

// Store result in session (for result page)
$_SESSION['result'] = [
    'score' => $score,
    'total' => $total,
    'percentage' => $percentage
];

// Clear exam questions to prevent reuse
unset($_SESSION['exam_questions']);

// ✅ REDIRECT TO RESULT PAGE (IMPORTANT FIX)
header("Location: result.php");
exit();
?>