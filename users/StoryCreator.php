<?php 
    include '../resources/database/connectToDB.inc';
    include '../resources/templates/session.php';
    if(!isset($_SESSION['username'])) {
        echo "Login Failed.";
        header('Location: login.php');
    }

    $title = $genre = $description = $content ='';
    $errors = array('title'=>'', 'genre'=>'','description'=>'','content'=>'');

    if(isset($_POST['submit'])) {
        if(empty($_POST['title'])) {
            $errors['title'] = 'A title is required';
        } else {
            $title = $_POST['title'];
        }

        if(empty($_POST['genre'])) {
            $errors['genre'] = 'A genre is required';
        } else {
            $genre = $_POST['genre'];
        }

        if(empty($_POST['description'])) {
            $errors['description'] = 'A description is required';
        } else {
            $description = $_POST['description'];
        }

        if(empty($_POST['content'])) {
            $errors['content'] = 'Content is required';
        } else {
            $content = $_POST['content'];
        }

        if(array_filter($errors)) {
            echo 'errors in the form';
        } else {
            $conn = connectDB();
            $username = $_SESSION['username'];
            $title = mysqli_real_escape_string($conn, $title);
            $genre = mysqli_real_escape_string($conn, $genre);
            $description = mysqli_real_escape_string($conn, $description);
            $content = mysqli_real_escape_string($conn, $content);

            $sql = "INSERT INTO stories(user_id, title, genre, description, content, date_created) VALUES ((SELECT user_id FROM users WHERE username='$username'), '$title','$genre','$description','$content', NOW())";

            if(mysqli_query($conn, $sql)) {
                header('Location: profile.php');
            } else {
                echo 'Login error. '.mysqli_error($conn);
            }
            mysqli_close($conn);
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Story Creator</title>
</head>
<body style="text-align: center;">
    <?php include '../resources/templates/header.php'; ?>
    <h1>Story Creator</h1>
    <form method="POST" action="StoryCreator.php">
        <table style="margin-left: auto; margin-right: auto;">
            <tr>
                <td>Title</td>
                <td><input id="title" class="inputBox" name="title" type="text"></td>
            </tr>
            <tr>
                <td>Genre</td>
                <td>
                    <input id="genre" class="inputBox" name="genre" list="genres" type="text">
                    <datalist id="genres">
                    <option value="Action"></option>
                            <option value="Adventure"></option>
                            <option value="Romance"></option>
                            <option value="Horror"></option>
                            <option value="Sci-Fi"></option>
                            <option value="Mystery"></option>
                            <option value="Other"></option>
                    </datalist>
                </td>
            </tr>
            <tr>
                <td>Description</td>
                <td><textarea id="description" class="inputBox" name="description" rows="5" cols="100"></textarea></td>
            </tr>
            <tr>
                <td>Story</td>
                <td><textarea id="content" class="inputBox" name="content" rows="40" cols="100"></textarea></td>
            </tr>
        </table>
        <input type="submit" name="submit" value="submit">
    </form>
</body>
</html>