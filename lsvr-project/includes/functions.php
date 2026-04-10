<?php
include("db.php");

/* =========================
   SAFE INPUT FUNCTION
========================= */
function cleanInput($data) {
    global $conn;
    return mysqli_real_escape_string($conn, trim($data));
}

/* =========================
   REDIRECT FUNCTION
========================= */
function redirect($page) {
    header("Location: $page");
    exit();
}

/* =========================
   GET USER DETAILS
========================= */
function getUser($user_id) {
    global $conn;

    $query = mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id'");
    return mysqli_fetch_assoc($query);
}

/* =========================
   CALCULATE PERCENTAGE
========================= */
function calculatePercentage($score, $total) {
    if ($total == 0) return 0;
    return round(($score / $total) * 100, 2);
}

/* =========================
   GET RANDOM QUESTIONS
========================= */
function getRandomQuestions($language, $limit = 10) {
    global $conn;

    $query = mysqli_query($conn, "
        SELECT * FROM questions 
        WHERE language='$language' 
        ORDER BY RAND() 
        LIMIT $limit
    ");

    $questions = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $questions[] = $row;
    }

    return $questions;
}

/* =========================
   GET MULTIPLE LANG QUESTIONS
========================= */
function getMultiLangQuestions($languages = [], $limit_per_lang = 5) {
    $all_questions = [];

    foreach ($languages as $lang) {
        $qs = getRandomQuestions($lang, $limit_per_lang);
        $all_questions = array_merge($all_questions, $qs);
    }

    shuffle($all_questions); // mix questions
    return $all_questions;
}

/* =========================
   SAVE RESULT
========================= */
function saveResult($user_id, $score, $total, $languages) {
    global $conn;

    $languages = implode(",", $languages);

    mysqli_query($conn, "
        INSERT INTO results (user_id, score, total_questions, languages)
        VALUES ('$user_id', '$score', '$total', '$languages')
    ");
}

/* =========================
   GET LATEST RESULT
========================= */
function getLatestResult($user_id) {
    global $conn;

    $query = mysqli_query($conn, "
        SELECT * FROM results 
        WHERE user_id='$user_id' 
        ORDER BY id DESC LIMIT 1
    ");

    return mysqli_fetch_assoc($query);
}

/* =========================
   GET NOTIFICATIONS
========================= */
function getNotifications($limit = 5) {
    global $conn;

    $query = mysqli_query($conn, "
        SELECT * FROM notifications 
        ORDER BY id DESC 
        LIMIT $limit
    ");

    $notes = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $notes[] = $row;
    }

    return $notes;
}

?>