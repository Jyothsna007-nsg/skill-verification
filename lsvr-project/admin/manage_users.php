<?php
session_start();

// Admin सुरक्षा
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

include("../includes/db.php");

// DELETE USER
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM users WHERE id='$id'");
    header("Location: manage_users.php");
    exit();
}

// UPDATE USER
if (isset($_POST['update_user'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    mysqli_query($conn, "UPDATE users SET name='$name', email='$email' WHERE id='$id'");
    header("Location: manage_users.php");
    exit();
}

// FETCH USERS
$users = mysqli_query($conn, "SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
        }

        .container {
            width: 90%;
            margin: auto;
            margin-top: 40px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background: #333;
            color: white;
        }

        .btn {
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }

        .edit {
            background: orange;
            color: white;
        }

        .delete {
            background: red;
            color: white;
        }

        .update {
            background: green;
            color: white;
        }

        input {
            padding: 5px;
            width: 90%;
        }

        .top-bar {
            margin-bottom: 20px;
        }

        .back {
            padding: 10px;
            background: black;
            color: white;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="top-bar">
        <a href="admin_dashboard.php" class="back">⬅ Back to Dashboard</a>
    </div>

    <h2>Manage Users</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($users)) { ?>

        <tr>
            <form method="POST">
                <td><?php echo $row['id']; ?></td>

                <td>
                    <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
                </td>

                <td>
                    <input type="email" name="email" value="<?php echo $row['email']; ?>" required>
                </td>

                <td>
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                    <button type="submit" name="update_user" class="btn update">Update</button>

                    <a href="manage_users.php?delete=<?php echo $row['id']; ?>" 
                       onclick="return confirm('Are you sure?')">
                        <button type="button" class="btn delete">Delete</button>
                    </a>
                </td>
            </form>
        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>