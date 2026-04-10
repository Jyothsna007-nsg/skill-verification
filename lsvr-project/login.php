<?php
session_start();
include("includes/db.php");

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid Credentials!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
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
            background: blue;
            color: white;
            border: none;
            cursor: pointer;
        }
        .admin-btn {
            background: black;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>User Login</h2>

    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Enter Email" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit" name="login" class="btn">Login</button>
    </form>

    <!-- Admin Login Button -->
    <a href="admin/admin_login.php">
        <button class="btn admin-btn">Admin Login</button>
    </a>
</div>

</body>
</html>