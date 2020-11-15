<?php
    //username, title, genre
    //display: title, genre, description
    include 'resources/database/connectToDB.inc';
    include 'resources/templates/session.php';

    $username = $title = $genre = $sql = '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" type="text/css" href="resources/css/master.css">
    <link rel="stylesheet" type="text/css" href="resources/css/search.css">
    
    <title>Search Results</title>
</head>
<body>
    <?php include 'resources/templates/header.php'; ?>
    <h1>Search Results</h1>
    <div id="results">
    </div>
    <?php
        if(isset($_GET['submit'])) {
            $conn = connectDB();
            if(!empty($_GET['username'])) {
                $username = mysqli_real_escape_string($conn, $_GET['username']);
                $sql = "SELECT users.username, stories.title, stories.genre, stories.description FROM users RIGHT OUTER JOIN stories ON users.user_id = stories.user_id WHERE users.username LIKE '%$username%'";
            }
            if(!empty($_GET['title'])) {
                $title = mysqli_real_escape_string($conn, $_GET['title']);
                if(empty($sql)) {
                    $sql = "SELECT users.username, stories.title, stories.genre, stories.description FROM users RIGHT OUTER JOIN stories ON users.user_id = stories.user_id WHERE stories.title LIKE '%$title%'";                
                } else {
                    $sql = $sql." AND stories.title LIKE '%$title%'";
                }
            }
            if(!empty($_GET['genre'])) {
                $genre = mysqli_real_escape_string($conn, $_GET['genre']);
                if(empty($sql)) {
                    $sql = "SELECT users.username, stories.title, stories.genre, stories.description FROM users RIGHT OUTER JOIN stories ON users.user_id = stories.user_id WHERE stories.genre LIKE '%$genre%'";                
                } else {
                    $sql = $sql." AND stories.genre LIKE '%$genre%'";
                }
            }
            if(empty($sql)) {
                echo 'No search without search terms.';
                header('Location: index.php');
            }

            $result = mysqli_query($conn, $sql);
            
            if($result) {
                while($row = mysqli_fetch_array($result)) {
                    extract($row);
                    echo "<div style='border: 5px solid;'>";
                    echo "<form method='GET' action='story.php'>";
                    echo "<input type='hidden' name='username' value=$username>";
                    echo "<input type='hidden' name='title' value=$title>";
                    echo "<button type='submit' name='submit' value='submit'>";
                    echo "<h3>Author: $username</h3>";
                    echo "<h5>Title: $title</h5>";
                    echo "<p>Genre: $genre</p>";
                    echo "<p>Description: $description</p>";
                    echo "</button></form>";
                    echo "</div>";
                }
            } else {
                echo 'Query error' . mysqli_error($conn);
            }

            mysqli_close($conn);
        } else {
            echo "Search error.";
            header('Location: index.php');
        }
    ?>
</body>
</html>