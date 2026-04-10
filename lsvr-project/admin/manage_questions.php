<?php
session_start();

// Admin Protection
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

include("../includes/db.php");

// ADD QUESTION
if (isset($_POST['add_question'])) {
    $language = $_POST['language'];
    $question = $_POST['question'];
    $opt1 = $_POST['opt1'];
    $opt2 = $_POST['opt2'];
    $opt3 = $_POST['opt3'];
    $opt4 = $_POST['opt4'];
    $answer = $_POST['answer'];

    mysqli_query($conn, "INSERT INTO questions 
    (language, question, option1, option2, option3, option4, answer)
    VALUES ('$language', '$question', '$opt1', '$opt2', '$opt3', '$opt4', '$answer')");
}

// DELETE QUESTION
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM questions WHERE id='$id'");
    header("Location: manage_questions.php");
    exit();
}

// UPDATE QUESTION
if (isset($_POST['update_question'])) {
    $id = $_POST['id'];
    $language = $_POST['language'];
    $question = $_POST['question'];
    $opt1 = $_POST['opt1'];
    $opt2 = $_POST['opt2'];
    $opt3 = $_POST['opt3'];
    $opt4 = $_POST['opt4'];
    $answer = $_POST['answer'];

    mysqli_query($conn, "UPDATE questions SET 
        language='$language',
        question='$question',
        option1='$opt1',
        option2='$opt2',
        option3='$opt3',
        option4='$opt4',
        answer='$answer'
        WHERE id='$id'");

    header("Location: manage_questions.php");
    exit();
}

// FETCH QUESTIONS
$questions = mysqli_query($conn, "SELECT * FROM questions ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Questions</title>

    <style>
        body { font-family: Arial; background:#f4f4f4; }

        .container {
            width: 95%;
            margin: auto;
            margin-top: 30px;
        }

        h2 { text-align: center; }

        .form-box {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
        }

        input, textarea, select {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
        }

        .btn {
            padding: 8px 15px;
            border: none;
            cursor: pointer;
            color: white;
        }

        .add { background: green; }
        .update { background: orange; }
        .delete { background: red; }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th { background: #333; color: white; }

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

    <a href="admin_dashboard.php" class="back">⬅ Back</a>

    <h2>Manage Questions</h2>

    <!-- ADD QUESTION -->
    <div class="form-box">
        <h3>Add Question</h3>
        <form method="POST">
            <select name="language" required>
                <option value="">Select Language</option>
                <option>Python</option>
                <option>Java</option>
                <option>C</option>
                <option>C++</option>
                <option>JavaScript</option>
                <option>SQL</option>
                <option>HTML</option>
            </select>

            <textarea name="question" placeholder="Enter Question" required></textarea>

            <input type="text" name="opt1" placeholder="Option 1" required>
            <input type="text" name="opt2" placeholder="Option 2" required>
            <input type="text" name="opt3" placeholder="Option 3" required>
            <input type="text" name="opt4" placeholder="Option 4" required>

            <input type="text" name="answer" placeholder="Correct Answer" required>

            <button type="submit" name="add_question" class="btn add">Add Question</button>
        </form>
    </div>

    <!-- QUESTIONS TABLE -->
    <table>
        <tr>
            <th>ID</th>
            <th>Language</th>
            <th>Question</th>
            <th>Options</th>
            <th>Answer</th>
            <th>Actions</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($questions)) { ?>

        <tr>
            <form method="POST">
                <td><?php echo $row['id']; ?></td>

                <td>
                    <input type="text" name="language" value="<?php echo $row['language']; ?>">
                </td>

                <td>
                    <textarea name="question"><?php echo $row['question']; ?></textarea>
                </td>

                <td>
                    <input type="text" name="opt1" value="<?php echo $row['option1']; ?>"><br>
                    <input type="text" name="opt2" value="<?php echo $row['option2']; ?>"><br>
                    <input type="text" name="opt3" value="<?php echo $row['option3']; ?>"><br>
                    <input type="text" name="opt4" value="<?php echo $row['option4']; ?>">
                </td>

                <td>
                    <input type="text" name="answer" value="<?php echo $row['answer']; ?>">
                </td>

                <td>
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                    <button type="submit" name="update_question" class="btn update">Update</button>

                    <a href="manage_questions.php?delete=<?php echo $row['id']; ?>" 
                       onclick="return confirm('Delete this question?')">
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