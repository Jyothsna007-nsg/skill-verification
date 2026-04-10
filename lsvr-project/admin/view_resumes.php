<?php
session_start();

// Admin Protection
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

include("../includes/db.php");

// Fetch resumes with user details
$query = "SELECT users.name, users.email, resumes.* 
          FROM resumes 
          JOIN users ON users.id = resumes.user_id
          ORDER BY resumes.created_at DESC";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Resumes</title>

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

        .btn {
            padding: 5px 10px;
            background: green;
            color: white;
            text-decoration: none;
            border-radius: 5px;
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
    </style>
</head>

<body>

<div class="container">

    <div class="top-bar">
        <a href="admin_dashboard.php" class="back">⬅ Back to Dashboard</a>
    </div>

    <h2>All User Resumes</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Resume</th>
            <th>Date</th>
        </tr>

        <?php if(mysqli_num_rows($result) > 0) { 
            while($row = mysqli_fetch_assoc($result)) { ?>
        
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>

            <td>
                <a href="../<?php echo $row['file_path']; ?>" target="_blank" class="btn">
                    View Resume
                </a>
            </td>

            <td><?php echo $row['created_at']; ?></td>
        </tr>

        <?php } } else { ?>

        <tr>
            <td colspan="5">No resumes found</td>
        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>