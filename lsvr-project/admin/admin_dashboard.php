<?php
session_start();

// सुरक्षा (Admin Protection)
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

include("../includes/db.php");

// Fetch counts
$users = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users"));
$results = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM results"));
$questions = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM questions"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>

    <style>
        body {
            font-family: Arial;
            margin: 0;
            background: #f4f4f4;
        }

        .header {
            background: #222;
            color: white;
            padding: 15px;
            text-align: center;
        }

        .container {
            display: flex;
        }

        .sidebar {
            width: 220px;
            background: #333;
            height: 100vh;
            padding-top: 20px;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 12px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: #575757;
        }

        .main {
            flex: 1;
            padding: 20px;
        }

        .cards {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .card {
            background: white;
            padding: 20px;
            width: 200px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 0 10px gray;
        }

        .card h3 {
            margin: 10px 0;
        }

        .logout {
            background: red;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            margin-top: 20px;
            width: 100%;
        }
    </style>
</head>

<body>

<div class="header">
    <h2>Admin Dashboard</h2>
</div>

<div class="container">

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="manage_users.php">Manage Users</a>
        <a href="manage_questions.php">Manage Questions</a>
        <a href="view_results.php">View Results</a>
        <a href="send_notifications.php">Send Notifications</a>
        <a href="view_resumes.php">View Resumes</a>

        <form action="../logout.php" method="POST">
            <button class="logout">Logout</button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="main">
        <h2>Welcome Admin 👋</h2>

        <div class="cards">

            <div class="card">
                <h3>Total Users</h3>
                <p><?php echo $users; ?></p>
            </div>

            <div class="card">
                <h3>Total Results</h3>
                <p><?php echo $results; ?></p>
            </div>

            <div class="card">
                <h3>Total Questions</h3>
                <p><?php echo $questions; ?></p>
            </div>

        </div>

        <br><br>

        <h3>Quick Actions</h3>
        

        <div class="cards">
            <div class="card">
                <a href="manage_users.php">👥 Manage Users</a>
            </div>

            <div class="card">
                <a href="manage_questions.php">❓ Add Questions</a>
            </div>

            <div class="card">
                <a href="view_results.php">📊 View Results</a>
            </div>

            <div class="card">
                <a href="send_notifications.php">🔔 Notifications</a>
            </div>
        </div>

    </div>

</div>

</body>
</html>