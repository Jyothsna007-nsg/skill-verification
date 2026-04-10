<?php
session_start();

// Admin Protection
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

include("../includes/db.php");

// SEND NOTIFICATION
if (isset($_POST['send'])) {
    $message = $_POST['message'];

    if (!empty($message)) {
        // Insert notification
        mysqli_query($conn, "INSERT INTO notifications (message) VALUES ('$message')");
        $success = "Notification sent successfully!";
    } else {
        $error = "Message cannot be empty!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Send Notifications</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
        }

        .container {
            width: 50%;
            margin: auto;
            margin-top: 50px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px gray;
            text-align: center;
        }

        textarea {
            width: 100%;
            height: 120px;
            padding: 10px;
        }

        .btn {
            padding: 10px 20px;
            background: green;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }

        .back {
            display: inline-block;
            margin-bottom: 15px;
            background: black;
            color: white;
            padding: 8px;
            text-decoration: none;
        }

        .msg {
            margin-top: 10px;
        }
    </style>
</head>

<body>

<div class="container">

    <a href="admin_dashboard.php" class="back">⬅ Back</a>

    <h2>Send Notification</h2>

    <?php if(isset($success)) echo "<p class='msg' style='color:green;'>$success</p>"; ?>
    <?php if(isset($error)) echo "<p class='msg' style='color:red;'>$error</p>"; ?>

    <form method="POST">
        <textarea name="message" placeholder="Enter notification message..."></textarea>
        <button type="submit" name="send" class="btn">Send Notification</button>
    </form>

</div>

</body>
</html>