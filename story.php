<?php 
    //Story page - displays an individual story and comments

    include 'resources/database/connectToDB.inc';
    include 'resources/templates/session.php';

    //Query database for story and comments
    $title = $genre = $description = $content = $username = $date_created = '';
    if(isset($_GET['submit'])) {
        //query for story
        $conn = connectDB();
        $username = $_GET['username'];
        $title = $_GET['title'];
        $sql = "SELECT story_id, genre, description, content, date_created FROM stories WHERE user_id = (SELECT user_id FROM users WHERE username='$username') AND title='$title'";
        $result = mysqli_query($conn, $sql);
        if($result) {
            $result = mysqli_fetch_array($result);
            $genre = $result['genre'];
            $description = $result['description'];
            $content = $result['content'];
            $date_created = $result['date_created'];
            $story_id = $result['story_id'];
        } else {
            echo 'Database error. '.mysqli_error($conn);
        }

        //adds comment to comments table
        if(isset($story_id) and isset($_GET['commentTitle']) ) {
            $nameofuser = $_SESSION['username'];
            $commentTitle = mysqli_real_escape_string($conn, $_GET['commentTitle']);
            $theComment = mysqli_real_escape_string($conn, $_GET['theComment']);
            $sql = "INSERT INTO comments(story_id, username, title, content) VALUES ('$story_id', '$nameofuser', '$commentTitle', '$theComment')";
            mysqli_query($conn, $sql);            
            unset($_GET['commentTitle'],$_GET['theComment']);
        }

        //query to grab all comments for story
        if(isset($story_id)) {
            $sql = "SELECT username, title, content FROM comments WHERE story_id='$story_id'";
            $commentResult = mysqli_query($conn, $sql);
        } else {
            echo "Sorry, could not find story comments.";
        }

        mysqli_close($conn);
    } else {
        //header('Location: index.php');
        echo "Submit error";
    }

?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" type="text/css" href="resources/css/master.css">
        <link rel="stylesheet" type="text/css" href="resources/css/story.css">
        <title><?php echo $title; ?></title>

        <script type="text/javascript">
            //Redirect to google to search more information about the user
            function goToGoogle(){
                var google = "https://www.google.com/webhp?hl=en&sa=X&ved=0ahUKEwi8k8PM4rLsAhVUOs0KHcpRDWgQPAgI";
                location.href = google;
            }
            
            window.addEventListener("load",start,false);
        </script>
    </head>
    <body>
        <?php include 'resources/templates/header.php';?>
        <div class="content">
            <!--Layout story-->
            <div class="introStuff">
                <h1 id="title"><?php echo $title; ?> </h1>
                <h2 id="authorLine" onclick="goToGoogle()" style="margin-bottom: 20px;"><?php echo $username; ?></h2>
                <div id="additionalInfo" style="margin-bottom: 20px; text-align: center;">
                    <span class="info">Genre: <span id="theGenre"></span><?php echo $genre; ?></span>
                    <span class="info">Date Created: <span id="theDate"><?php echo $date_created; ?></span></span>
                </div>
            </div>
            <div id="theStory">
                <h2>Description</h2>
                <p>
                    <?php echo $description; ?>
                </p>
            </div>
            <div id="theStory">
                <h2>Content</h2>
                <p>
                    <?php echo $content; ?>
                </p>
            </div>

            <!--Layout comments-->
            <div id="theStory">
                <h2>Comments</h2>
                <?php 
                    //Form to add new comment
                    if(isset($_SESSION['username'])){
                        echo "<form method='GET' action='story.php' style='margin-top: 20px;'>";
                        echo "<table style='margin-left: auto; margin-right: auto;'>";
                        echo "<colgroup><col span='1' style='width: 200px; text-align: right;'><col span='1' style='width: 200px;'</colgroup>";
                        echo "<input type='hidden' name='username' value='".$username."'>";
                        echo "<input type='hidden' name='title' value='".$title."'>";
                        echo "<tr><td><label for='commentTitle'>Insert Title: </label></td>";
                        echo "<td><input type='text' name='commentTitle'></td></tr>";
                        echo "<tr><td><label for='theComment'>Insert Comment: </label></td>";
                        echo "<td><textarea name='theComment' rows=4 width=50></textarea></td></tr></table>"; 
                        echo "<input type='submit' name='submit' value='Submit Comment'>"; 
                        echo "</form>"; 
                    } else { 
                        echo "<p>Sign in in order to make a comment</p>"; 
                    }
                ?> 
            </div>
            <div class="allcomments">
                <?php
                    //Display comments
                    if(isset($commentResult)) {
                        while($row = mysqli_fetch_array($commentResult)) {
                            echo "<div style='border: 2px solid brown; border-radius: 25px; margin-bottom: 20px; padding: 10px 10px;'><h4 style='text-align: left;'>".$row['username']."</h4>";
                            echo "<h6 style='text-align: left;'>".$row['title']."</h6>";
                            echo "<p style='text-align: left;'>".$row['content']."</p></div>";
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>
