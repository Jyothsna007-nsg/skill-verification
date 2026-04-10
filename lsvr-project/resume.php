<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Resume Builder</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
body {
    font-family:'Poppins',sans-serif;
    background:#f1f5f9;
}

.container {
    max-width:800px;
    margin:30px auto;
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

h2 { margin-bottom:20px; }

input, textarea {
    width:100%;
    padding:10px;
    margin:10px 0;
    border-radius:8px;
    border:1px solid #ccc;
}

button {
    padding:10px 20px;
    background:#2563eb;
    color:white;
    border:none;
    border-radius:20px;
    cursor:pointer;
}
</style>
</head>

<body>

<div class="container">
    <h2>Resume Details</h2>

    <form action="generate_resume.php" method="POST">

        <h3>Personal Details</h3>
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone" placeholder="Phone" required>

        <h3>Academic Details</h3>
        <input type="text" name="degree" placeholder="Degree">
        <input type="text" name="college" placeholder="College">
        <input type="text" name="cgpa" placeholder="CGPA">

        <h3>Skills</h3>
        <input type="text" name="skills" placeholder="e.g. Python, Java, SQL">

        <h3>Experience</h3>
        <textarea name="experience" placeholder="Your experience..."></textarea>

        <h3>Projects</h3>
        <textarea name="projects" placeholder="Your projects..."></textarea>

        <br>
        <button type="submit">Generate Resume</button>

    </form>
</div>

</body>
</html>