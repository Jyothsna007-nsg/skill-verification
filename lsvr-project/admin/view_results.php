<?php
session_start();

// Admin Protection
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

include("../includes/db.php");

// Fetch results with user details
$query = "SELECT users.name, users.email, results.* 
          FROM results 
          JOIN users ON users.id = results.user_id
          ORDER BY results.id DESC";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Results</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
        }

        .container {
            width: 95%;
            margin: auto;
            margin-top: 30px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background: #333;
            color: white;
        }

        .back {
            padding: 10px;
            background: black;
            color: white;
            text-decoration: none;
        }

        .top-bar {
            margin-bottom: 20px;
        }

        .highlight {
            font-weight: bold;
            color: green;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="top-bar">
        <a href="admin_dashboard.php" class="back">⬅ Back to Dashboard</a>
    </div>

    <h2>All Exam Results</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Languages</th>
            <th>Score</th>
            <th>Percentage</th>
            <th>Date</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)) { 
        
        ?>

        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['languages']; ?></td>

            <td class="highlight">
                <?php echo $row['score'] . " / " . $row['total_questions']; ?>
            </td>

            <td>
               <?php echo $row['percentage']; ?>%
            </td>

            <td>
                <?php echo $row['exam_date']; ?>
            </td>
        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>