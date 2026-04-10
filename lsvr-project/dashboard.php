<?php
session_start();
include("includes/db.php");

$user_id = $_SESSION['user_id'] ?? 0;

// Total Tests Taken
$testsQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM results WHERE user_id='$user_id'");
$testsData = mysqli_fetch_assoc($testsQuery);
$totalTests = $testsData['total'] ?? 0;

// Average Score
$avgQuery = mysqli_query($conn, "SELECT AVG(percentage) as avg_score FROM results WHERE user_id='$user_id'");
$avgData = mysqli_fetch_assoc($avgQuery);
$avgScore = round($avgData['avg_score'] ?? 0);

// Skills (from users table)
$userQuery = mysqli_query($conn, "SELECT skills FROM users WHERE id='$user_id'");
$userData = mysqli_fetch_assoc($userQuery);
$skills = $userData['skills'] ?? "Not Added";

// Rank (based on highest score)
$rankQuery = mysqli_query($conn, "
    SELECT user_id, MAX(percentage) as max_score
    FROM results
    GROUP BY user_id
    ORDER BY max_score DESC
");

$rank = 1;
$userRank = "-";

while ($row = mysqli_fetch_assoc($rankQuery)) {
    if ($row['user_id'] == $user_id) {
        $userRank = "#" . $rank;
        break;
    }
    $rank++;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    display: flex;
    background: #f1f5f9;
}

/* SIDEBAR */
.sidebar {
    width: 250px;
    height: 100vh;
    background: #0f172a;
    color: white;
    padding: 20px;
    position: fixed;
}

.sidebar h2 {
    text-align: center;
    margin-bottom: 30px;
}

.sidebar ul {
    list-style: none;
}

.sidebar ul li {
    padding: 12px;
    margin: 10px 0;
    border-radius: 8px;
    transition: 0.3s;
}

.sidebar ul li:hover {
    background: #1e293b;
    cursor: pointer;
}

.sidebar a {
    color: white;
    text-decoration: none;
    display: block;
}

/* MAIN */
.main {
    margin-left: 250px;
    padding: 30px;
    width: 100%;
}

/* HEADER */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header h1 {
    font-size: 26px;
}

/* CARDS */
.cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    margin-top: 30px;
}

.card {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0px 5px 15px rgba(0,0,0,0.1);
    transition: 0.3s;
}

.card:hover {
    transform: translateY(-8px);
}

.card h3 {
    margin-bottom: 10px;
}

/* SECTION */
.section {
    margin-top: 40px;
}

.section h2 {
    margin-bottom: 20px;
}

/* BUTTON */
.btn {
    padding: 10px 20px;
    border: none;
    background: #2563eb;
    color: white;
    border-radius: 20px;
    cursor: pointer;
    transition: 0.3s;
}

.btn:hover {
    background: #1e40af;
}

/* ANIMATION */
.fade-in {
    opacity: 0;
    transform: translateY(20px);
    transition: 0.8s;
}

.fade-in.show {
    opacity: 1;
    transform: translateY(0);
}
</style>

</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>LSVR</h2>
    <ul>
        <li><a href="#">Dashboard</a></li>
        <li><a href="exam.php">Take Test</a></li>
        <li><a href="result.php">Results</a></li>
        <li><a href="resume.php">Resume</a></li>
<li>
<a href="user_notifications.php">
Notifications 
<?php
include("includes/db.php");
$count = mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM user_notifications 
 WHERE user_id='".$_SESSION['user_id']."' AND is_read=0"));

if($count > 0) echo "($count)";
?>
</a>
</li>        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>

<!-- MAIN CONTENT -->
<div class="main">

    <!-- HEADER -->
    <div class="header fade-in">
        <h1>Welcome, <?php echo $_SESSION['user_name'] ?? 'User'; ?> 👋</h1>
        <button class="btn" onclick="startTest()">Start Test</button>
    </div>

    <!-- CARDS -->
    <div class="cards">

        <div class="card fade-in">
            <h3>Tests Taken</h3>
            <p><?php echo $totalTests; ?></p>
        </div>

        <div class="card fade-in">
            <h3>Average Score</h3>
            <p><?php echo $avgScore; ?>%</p>
        </div>

        <div class="card fade-in">
            <h3>Skills</h3>
           <p><?php echo $skills; ?></p>
        </div>

        <div class="card fade-in">
            <h3>Rank</h3>
           <p><?php echo $userRank; ?></p>
        </div>

    </div>

    <!-- SECTION -->
    <div class="section fade-in">
        <h2>Quick Actions</h2>
        <button class="btn" onclick="goTo('exam.php')">Take New Test</button>
        <button class="btn" onclick="goTo('resume.php')">Generate Resume</button>
    </div>

</div>

<!-- JAVASCRIPT -->
<script>

// Fade animation
const elements = document.querySelectorAll('.fade-in');

function showOnScroll() {
    const trigger = window.innerHeight * 0.85;

    elements.forEach(el => {
        const top = el.getBoundingClientRect().top;

        if (top < trigger) {
            el.classList.add('show');
        }
    });
}

window.addEventListener('scroll', showOnScroll);
showOnScroll();

// Navigation functions
function goTo(page) {
    window.location.href = page;
}

function startTest() {
    window.location.href = "exam.php";
}

// Hover effect
document.querySelectorAll('.card').forEach(card => {
    card.addEventListener('mouseover', () => {
        card.style.background = '#e0f2fe';
    });

    card.addEventListener('mouseout', () => {
        card.style.background = 'white';
    });
});

</script>

</body>
</html>