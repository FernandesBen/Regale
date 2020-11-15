<?php
    include('../resources/database/connectToDB.inc');
    include('../resources/templates/session.php');
    $username = $password = '';
    $errors = array('username'=> '', 'password' => '');

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

        if(array_filter($errors)) {
            echo 'errors in the form';
        } else {
            $conn = connectDB();
            $username = mysqli_real_escape_string($conn, $username);
            $password = mysqli_real_escape_string($conn, $password);
            
            $sql = "SELECT username, user_password FROM users WHERE username='$username' AND user_password='$password'";

            if(mysqli_query($conn, $sql)) {
                $_SESSION['username']=$username;
                header('Location: profile.php');
            } else {
                echo 'Login error. '.mysqli_error($conn);
            }
            mysqli_close($conn);
        }
    }
//shakespeare
//Romeo&Juliet1
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="../resources/css/master.css">

    <title>Login</title>
</head>
<body style="text-align: center;">
    <?php include '../resources/templates/header.php'; ?>
    <h1>Log In</h1>
    <form method="POST" action="login.php">
        <label for="username">Username: </label>
        <input type="text" id="username" name="username">
        <br>
        <label for="password">Password: </label>
        <input type="text" id="password" name="password">
        <br>
        <input type="submit" name="submit" value="submit">
    </form>
    <button onclick="location.href='NewProfile.php'">Create a New Account</button>
</body>
</html>
