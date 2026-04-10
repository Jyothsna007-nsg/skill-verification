<?php
session_start();
include("includes/db.php");

// User must be logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// =========================
// INSERT notifications for user (if not already)
// =========================
$notifications = mysqli_query($conn, "SELECT * FROM notifications");

while ($n = mysqli_fetch_assoc($notifications)) {

    $nid = $n['id'];

    $check = mysqli_query($conn, "SELECT * FROM user_notifications 
                                 WHERE user_id='$user_id' AND notification_id='$nid'");

    if (mysqli_num_rows($check) == 0) {
        mysqli_query($conn, "INSERT INTO user_notifications (user_id, notification_id) 
                             VALUES ('$user_id', '$nid')");
    }
}

// =========================
// FETCH USER NOTIFICATIONS
// =========================
$query = "SELECT n.message, n.created_at, un.is_read, un.id AS uid
          FROM user_notifications un
          JOIN notifications n ON n.id = un.notification_id
          WHERE un.user_id = '$user_id'
          ORDER BY n.created_at DESC";

$result = mysqli_query($conn, $query);

// =========================
// MARK AS READ
// =========================
if (isset($_GET['read'])) {
    $id = $_GET['read'];
    mysqli_query($conn, "UPDATE user_notifications SET is_read=1 WHERE id='$id'");
    header("Location: user_notifications.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>User Notifications</title>

<style>
body {
    font-family: Arial;
    background:#f4f4f4;
}

.container {
    width:80%;
    margin:auto;
    margin-top:30px;
}

.card {
    background:white;
    padding:15px;
    margin:10px 0;
    border-radius:10px;
    box-shadow:0 0 5px gray;
}

.unread {
    border-left:5px solid red;
}

.read {
    border-left:5px solid green;
}

.btn {
    padding:5px 10px;
    background:black;
    color:white;
    text-decoration:none;
}
</style>
</head>

<body>

<div class="container">

<h2>Your Notifications</h2>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<div class="card <?php echo $row['is_read'] ? 'read' : 'unread'; ?>">

    <p><?php echo $row['message']; ?></p>
    <small><?php echo $row['created_at']; ?></small>

    <br><br>

    <?php if (!$row['is_read']) { ?>
        <a href="?read=<?php echo $row['uid']; ?>" class="btn">Mark as Read</a>
    <?php } ?>

</div>

<?php } ?>

</div>

</body>
</html>