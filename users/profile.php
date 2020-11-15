<?php 
    include '../resources/database/connectToDB.inc';
    include '../resources/templates/session.php';
    if(!isset($_SESSION['username'])) {
        echo "Login Failed.";
        header('Location: login.php');
    }

    $username = htmlspecialchars($_SESSION['username']);
    $title = '';
    $errors = array('title'=>'');

    if(isset($_POST['delete'])) {
        if(empty($_POST['title'])) {
            $errors['title'] = 'A title is required';
        } else {
            $title = $_POST['title'];
        }

        if(array_filter($errors)) {
            echo 'errors in the form';
        } else {
            $conn = connectDB();
            $username = $_SESSION['username'];
            $title = mysqli_real_escape_string($conn, $title);
            $sql = "DELETE FROM stories WHERE user_id = (SELECT user_id FROM users WHERE username='$username') AND title='$title'";

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

    <link rel="stylesheet" type="text/css" href="../resources/css/master.css">

    <title><?php echo $username; ?>'s Profile</title>
</head>
<body style="padding-left: 10%; padding-right: 10%">

    <?php include '../resources/templates/header.php'; ?>

    <h1>Welcome <?php echo $username; ?></h1>

    <div>
        <h2><a href="StoryCreator.php">Create Story</a></h2>
    </div>

    <div style="text-align: left">
        <h2 style="border-bottom: 5px solid;">All Stories</h2>
        <?php 
            $conn = connectDB();
            $sql = "SELECT title, genre, description, content, date_created FROM stories WHERE user_id = (SELECT user_id FROM users WHERE username='$username') ORDER BY date_created DESC";
            $result = mysqli_query($conn, $sql);

            if($result) {
                while($row = mysqli_fetch_array($result)) {
                    extract($row);
                    echo "<div style='border-bottom: 5px solid;'>";
                    echo "<h4>Title: $title</h4>";
                    echo "<p>Genre: $genre</p>";
                    echo "<p>Description: $description</p>";
                    echo "<p>Content: $content</p>";
                    echo "</div>";
                }
            } else {
                echo 'Login error. '.mysqli_error($conn);
            }
            mysqli_close($conn);
        ?>
    </div>
    <div>
        <h2>Update Story<h2>
        <form method="GET" action="StoryUpdater.php">
            <label for="title">Title: </label>
            <input type="text" id="title" name="title">
            <input type="submit" name="update" value="Update">            
        </form>
    </div>
    <div>
        <h2>Delete Story</h2>
        <form method="POST" action="profile.php">
            <label for="title">Title: </label>
            <input type="text" id="title" name="title">
            <input type="submit" name="delete" value="Delete">
        </form>
    </div>
</body>
</html>