<?php
include("includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $phone = $_POST['phone'];

    $degree = $_POST['degree'];
    $college = $_POST['college'];
    $cgpa = $_POST['cgpa'];

    $skills = $_POST['skills'];

    $query = "INSERT INTO users (name,email,password,phone,degree,college,cgpa,skills)
              VALUES ('$name','$email','$password','$phone','$degree','$college','$cgpa','$skills')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Registered Successfully'); window.location='login.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
body {
    font-family:'Poppins',sans-serif;
    background: linear-gradient(to right, #1e3a8a, #2563eb);
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
}

/* CONTAINER */
.container {
    background:white;
    padding:30px;
    border-radius:15px;
    width:400px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

/* TITLE */
h2 {
    text-align:center;
    margin-bottom:20px;
}

/* INPUT */
.input-box {
    position:relative;
    margin:15px 0;
}

.input-box input {
    width:100%;
    padding:10px;
    border:1px solid #ccc;
    border-radius:8px;
    outline:none;
}

.input-box label {
    position:absolute;
    top:50%;
    left:10px;
    transform:translateY(-50%);
    background:white;
    padding:0 5px;
    color:#888;
    transition:0.3s;
    pointer-events:none;
}

/* FLOAT LABEL */
.input-box input:focus + label,
.input-box input:valid + label {
    top:-8px;
    font-size:12px;
    color:#2563eb;
}

/* BUTTON */
button {
    width:100%;
    padding:10px;
    border:none;
    border-radius:20px;
    background:#2563eb;
    color:white;
    cursor:pointer;
    margin-top:15px;
    transition:0.3s;
}

button:hover {
    background:#1e40af;
}

/* SECTION TITLE */
.section-title {
    margin-top:15px;
    font-weight:bold;
    color:#2563eb;
}
</style>

</head>

<body>

<div class="container">

<h2>Create Account</h2>

<form method="POST">

    <div class="section-title">Personal Details</div>

    <div class="input-box">
        <input type="text" name="name" required>
        <label>Full Name</label>
    </div>

    <div class="input-box">
        <input type="email" name="email" required>
        <label>Email</label>
    </div>

    <div class="input-box">
        <input type="password" name="password" required>
        <label>Password</label>
    </div>

    <div class="input-box">
        <input type="text" name="phone" required>
        <label>Phone</label>
    </div>

    <div class="section-title">Academic Details</div>

    <div class="input-box">
        <input type="text" name="degree">
        <label>Degree</label>
    </div>

    <div class="input-box">
        <input type="text" name="college">
        <label>College</label>
    </div>

    <div class="input-box">
        <input type="text" name="cgpa">
        <label>CGPA</label>
    </div>

    <div class="section-title">Skills</div>

    <div class="input-box">
        <input type="text" name="skills">
        <label>Skills (e.g. Python, Java)</label>
    </div>

    <button type="submit">Register</button>

</form>

</div>

</body>
</html>