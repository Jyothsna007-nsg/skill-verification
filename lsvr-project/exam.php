<?php
session_start();
include("includes/auth.php");
include("includes/db.php");

// =========================
// STEP 1: LANGUAGE SELECTION
// =========================
if (!isset($_POST['languages'])) {
?>
<!DOCTYPE html>
<html>
<head>
<title>Select Languages</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(to right, #1e3a8a, #2563eb);
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    color:white;
}

.form-box {
    background: white;
    color:black;
    padding:30px;
    border-radius:15px;
    width:350px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

h2 { text-align:center; margin-bottom:20px; }

label { display:block; margin:10px 0; }

button {
    width:100%;
    padding:10px;
    border:none;
    border-radius:20px;
    background:#2563eb;
    color:white;
    cursor:pointer;
}
</style>
</head>

<body>

<div class="form-box">
    <h2>Select Languages</h2>

    <form method="POST">
        <label><input type="checkbox" name="languages[]" value="Python"> Python</label>
        <label><input type="checkbox" name="languages[]" value="Java"> Java</label>
        <label><input type="checkbox" name="languages[]" value="C"> C</label>
        <label><input type="checkbox" name="languages[]" value="C++"> C++</label>
        <label><input type="checkbox" name="languages[]" value="JavaScript"> JavaScript</label>
        <label><input type="checkbox" name="languages[]" value="SQL"> SQL</label>
        <label><input type="checkbox" name="languages[]" value="HTML"> HTML</label>

        <br>
        <button type="submit">Start Exam</button>
    </form>
</div>

</body>
</html>
<?php
exit();
}

// =========================
// STEP 2: LOAD QUESTIONS
// =========================
$allQuestions = json_decode(file_get_contents("data/questions.json"), true);
$selectedLanguages = $_POST['languages'];

if (empty($selectedLanguages)) {
    die("Please select at least one language.");
}

// =========================
// STEP 3: GENERATE QUESTIONS
// =========================
$examQuestions = [];

foreach ($selectedLanguages as $lang) {
    if (isset($allQuestions[$lang])) {
        $questions = $allQuestions[$lang];
        shuffle($questions);
        $examQuestions = array_merge($examQuestions, array_slice($questions, 0, 5));
    }
}

shuffle($examQuestions);

// =========================
// STORE SESSION DATA (IMPORTANT)
// =========================
$_SESSION['exam_questions'] = $examQuestions;

// ✅ THIS IS VERY IMPORTANT FOR RESUME
$_SESSION['selected_languages'] = implode(", ", $selectedLanguages);

// OPTIONAL: exam start time
$_SESSION['exam_start_time'] = date("Y-m-d H:i:s");

?>

<!DOCTYPE html>
<html>
<head>
<title>Exam</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
body {
    font-family:'Poppins',sans-serif;
    background:#f1f5f9;
}

/* HEADER */
.header {
    background:#0f172a;
    color:white;
    padding:15px 30px;
    display:flex;
    justify-content:space-between;
}

/* CONTAINER */
.container {
    max-width:800px;
    margin:30px auto;
}

/* PROGRESS */
.progress-bar {
    height:8px;
    background:#ddd;
    border-radius:10px;
    margin-bottom:20px;
}

.progress {
    height:100%;
    width:0%;
    background:#2563eb;
}

/* QUESTION */
.question-box {
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

/* OPTIONS */
.option {
    padding:10px;
    margin:10px 0;
    background:#f8fafc;
    border-radius:10px;
    cursor:pointer;
}

.option:hover { background:#e0f2fe; }

.option.selected {
    border:2px solid #2563eb;
    background:#dbeafe;
}

/* BUTTONS */
.buttons {
    margin-top:20px;
    display:flex;
    justify-content:space-between;
}

button {
    padding:10px 20px;
    border:none;
    border-radius:20px;
    background:#2563eb;
    color:white;
    cursor:pointer;
}
</style>

</head>

<body>

<div class="header">
    <h3>LSVR Exam (<?php echo $_SESSION['selected_languages']; ?>)</h3>
    <div id="timer">10:00</div>
</div>

<div class="container">

<div class="progress-bar">
    <div class="progress" id="progress"></div>
</div>

<form id="examForm" method="POST" action="result.php">

<input type="hidden" name="answers_json" id="answers_json">

<div class="question-box">
    <div id="question"></div>
    <div id="options"></div>
</div>

<div class="buttons">
    <button type="button" onclick="prevQ()">Prev</button>
    <button type="button" onclick="nextQ()">Next</button>
    <button type="button" onclick="submitExam()">Submit</button>
</div>

</form>
</div>

<script>
const questions = <?php echo json_encode($examQuestions); ?>;

let current = 0;
let answers = {};

// Load Question
function loadQ() {
    let q = questions[current];
    document.getElementById("question").innerHTML =
        "<b>Q" + (current+1) + ":</b> " + q.question;

    let html = "";
    q.options.forEach(opt => {
        let selected = answers[current] === opt ? "selected" : "";
        html += `<div class="option ${selected}" onclick="selectAns('${opt}')">${opt}</div>`;
    });

    document.getElementById("options").innerHTML = html;
    updateProgress();
}

// Select Answer
function selectAns(opt) {
    answers[current] = opt;
    loadQ();
}

// Navigation
function nextQ() {
    if (current < questions.length - 1) {
        current++;
        loadQ();
    }
}

function prevQ() {
    if (current > 0) {
        current--;
        loadQ();
    }
}

// Progress
function updateProgress() {
    let percent = ((current+1)/questions.length)*100;
    document.getElementById("progress").style.width = percent + "%";
}

// TIMER
let time = 600;
let timer = setInterval(() => {
    time--;
    let m = Math.floor(time/60);
    let s = time%60;

    document.getElementById("timer").innerText =
        m + ":" + (s<10?"0":"") + s;

    if(time <= 0){
        clearInterval(timer);
        alert("Time Up!");
        submitExam();
    }
},1000);

// Submit safely
function submitExam() {

    if(Object.keys(answers).length === 0){
        alert("Please answer at least one question!");
        return;
    }

    document.getElementById("answers_json").value = JSON.stringify(answers);
    document.getElementById("examForm").submit();
}

// Initial load
loadQ();
</script>

</body>
</html>