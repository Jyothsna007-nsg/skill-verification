<?php
include("db.php");

/* =========================
   GENERATE EXAM QUESTIONS
========================= */
function generateExam($languages = [], $limit_per_lang = 5) {
    global $conn;

    $questions = [];

    foreach ($languages as $lang) {

        // Get random unique questions
        $query = mysqli_query($conn, "
            SELECT * FROM questions 
            WHERE language='$lang'
            ORDER BY RAND()
            LIMIT $limit_per_lang
        ");

        while ($row = mysqli_fetch_assoc($query)) {
            $questions[] = $row;
        }
    }

    // Shuffle all questions
    shuffle($questions);

    // Store in session (IMPORTANT for no repetition)
    $_SESSION['exam_questions'] = $questions;

    return $questions;
}


/* =========================
   GET STORED QUESTIONS
========================= */
function getExamQuestions() {
    return $_SESSION['exam_questions'] ?? [];
}


/* =========================
   EVALUATE EXAM
========================= */
function evaluateExam($user_answers = []) {

    if (!isset($_SESSION['exam_questions'])) {
        return 0;
    }

    $questions = $_SESSION['exam_questions'];
    $score = 0;
    $total = count($questions);

    foreach ($questions as $q) {
        $qid = $q['id'];

        if (isset($user_answers[$qid])) {

            $user_ans = trim(strtolower($user_answers[$qid]));
            $correct_ans = trim(strtolower($q['answer']));

            if ($user_ans === $correct_ans) {
                $score++;
            }
        }
    }

    return [
        'score' => $score,
        'total' => $total
    ];
}


/* =========================
   CLEAR EXAM SESSION
========================= */
function clearExam() {
    unset($_SESSION['exam_questions']);
}
?>