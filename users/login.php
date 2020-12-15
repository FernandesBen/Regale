<?php
    //Login page - enter username and password to get into profile

    include('../resources/database/connectToDB.inc');
    include('../resources/templates/session.php');
    $username = $password = '';
    $errors = array('username'=> '', 'password' => '');

    //Gets login credentials. Redirects to profile page if successful or back to login page if unsuccessful.
    if(isset($_POST['submit'])) {
        //check if input data
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

        //query to check if valid credentials
        if(array_filter($errors)) {
            echo 'errors in the form';
        } else {
            $conn = connectDB();
            $username = mysqli_real_escape_string($conn, $username);
            $password = mysqli_real_escape_string($conn, $password);
            
            $sql = "SELECT username, user_password FROM users WHERE username='$username' AND user_password='$password'";

            //check if login successful
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
    <link rel="stylesheet" type="text/css" href="../resources/css/login.css"> 
    <link rel="stylesheet" type="text/css" href="../resources/css/master.css">

    <title>Login</title>
</head>
<body style="text-align: center;">
    <?php include '../resources/templates/header.php'; ?>
    <div class="content">
    <!--Login Form-->
    <form method="POST" action="login.php" class="login">
        <h1>Log In</h1>

        <input type="text" id="username" name="username" placeholder="Username">
        <br>
        <input type="password" id="password" name="password" placeholder="Password">
        <br>
        <input type="submit" name="submit" value="submit">

        <button onclick="location.href='NewProfile.php'">Create a New Account</button>
    </form>
    </div>
</body>
</html>
