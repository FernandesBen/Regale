<?php
    include('../resources/database/connectToDB.inc');
    include('../resources/templates/session.php');

    $username = $password = $email = $description = '';
    $errors = array('username'=>'','password'=>'','email'=>'','description'=>'');

    if(isset($_POST['submit'])) {
        if(empty($_POST['username'])) {
            $errors['username'] = 'A username is required';
        } else {
            $username = $_POST['username'];
        }

        if(empty($_POST['password'])) {
            $errors['password'] = 'A password is required';
        } else {
            $password = $_POST['password'];
        }

        if(empty($_POST['email'])) {
            $errors['email'] = 'An email is required';
        } else {
            $email = $_POST['email'];
        }

        if(empty($_POST['description'])) {
            $errors['description'] = 'A description is required';
        } else {
            $description = $_POST['description'];
        }


        if(array_filter($errors)) {
            echo 'errors in the form';
        } else {
            $conn = connectDB();
            $username = mysqli_real_escape_string($conn, $username);
            $password = mysqli_real_escape_string($conn, $password);
            $email = mysqli_real_escape_string($conn, $email);
            $description = mysqli_real_escape_string($conn, $description);

            $sql = "INSERT INTO users(username, user_password, email, description, date_joined) 
            VALUES ('$username','$password','$email','$description',NOW())";

            if(mysqli_query($conn, $sql)) {
                $_SESSION['username']=$username;
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
    <title>Create a new profile</title>
</head>
<body style="text-align: center;">
    <h1>Create a New User</h1>
    <form method="POST" action="newuser.php">
        <label for="username">Username: </label>
        <input type="text" id="username" name="username">
        <br>
        <label for="password">Password: </label>
        <input type="text" id="password" name="password">
        <br>
        <label for="email">Email: </label>
        <input type="text" id="email" name="email">
        <br>
        <label for="description">Description: </label>
        <input type="text" id="description" name="description">
        <br>
        <input type="submit" name="submit" value="submit">
    </form>
</body>
</html>