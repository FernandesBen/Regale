<?php
    //Create profile - new user can create profile
    
    include('../resources/database/connectToDB.inc');
    include('../resources/templates/session.php');

    $username = $password = $email = $description = '';
    $errors = array('username'=>'','password'=>'','email'=>'','description'=>'');

    //Set new profile credentials. Redirects to profile page if successful or back to login if unsuccessful
    if(isset($_POST['submit'])) {
        //check input data
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

        //query to add credentials to user database
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

    <link rel="stylesheet" type="text/css" href="../resources/css/login.css"> 
    <link rel="stylesheet" type="text/css" href="../resources/css/master.css">

    <title>Create a new profile</title>
</head>
<body>
    <?php include '../resources/templates/header.php'; ?>
    <div class="content">
        <!--Create new profile form-->
        <form method="POST" action="NewProfile.php" class="login">
            <h1>Create a New User</h1>
            <label for="username">Username: </label>
            <input type="text" id="username" name="username">
            <br>
            <label for="password">Password: </label>
            <input type="password" id="password" name="password">
            <br>
            <label for="email">Email: </label>
            <input type="text" id="email" name="email">
            <br>
            <label for="description">Description: </label>
            <input type="text" id="description" name="description">
            <br>
            <input type="submit" name="submit" value="submit">
        </form>
    </div>
</body>
</html>