<?php
session_start();

// If already logged in, go to dashboard
if (isset($_SESSION['admin'])) {
    header("Location: admin_dashboard.php");
    exit();
}

if (isset($_POST['admin_login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fixed Admin Credentials
    if ($username === "admin" && $password === "admin123") {
        $_SESSION['admin'] = true;

        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = "Invalid Admin Credentials!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body { font-family: Arial; background:#f4f4f4; }
        .box {
            width: 350px;
            margin: 80px auto;
            padding: 25px;
            background: white;
            box-shadow: 0 0 10px gray;
            border-radius: 10px;
            text-align: center;
        }
        input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
        }
        .btn {
            padding: 10px 20px;
            background: black;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Admin Login</h2>

    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Enter Username" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit" name="admin_login" class="btn">Login</button>
    </form>

</div>

</body>
</html>