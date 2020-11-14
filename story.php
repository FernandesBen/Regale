<?php 
    include 'resources/database/connectToDB.inc';
    include 'resources/templates/session.php';

    $title = $genre = $description = $content = $username = $date_created = '';
    if(isset($_GET['submit'])) {
        $conn = connectDB();
        $username = $_GET['username'];
        $title = $_GET['title'];
        $sql = "SELECT genre, description, content, date_created FROM stories WHERE user_id = (SELECT user_id FROM users WHERE username='$username') AND title='$title'";
        $result = mysqli_query($conn, $sql);
        if($result) {
            $result = mysqli_fetch_array($result);
            $genre = $result['genre'];
            $description = $result['description'];
            $content = $result['content'];
            $date_created = $result['date_created'];
        } else {
            echo 'Database error. '.mysqli_error($conn);
        }
    } else {
        echo "Submit error";
        header('Location: search.php');
    }

?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Story Template</title>
        <style type="text/css">
            .info {
                margin-right: 40px;
            }
            
            .introStuff{
                text-align: center;
            }
            
            #theStory {
                font-size: 20px;
                margin-left: 40px;
                margin-right: 40px;
                margin-bottom: 50px;
            }

            #theStory h2 {
                border-bottom: 1px solid black;
            }
            
            #title{
                font-size: 50px;
                margin-left: 25px;
            }
            
            #additionalInfo{
                font-size: 18px;
            }
            
            #authorLine:hover {
                color: grey!important;
            }
        </style>
        <script type="text/javascript">
            
            function goToGoogle(){
                var google = "https://www.google.com/webhp?hl=en&sa=X&ved=0ahUKEwi8k8PM4rLsAhVUOs0KHcpRDWgQPAgI";
                location.href = google;
            }
            
            window.addEventListener("load",start,false);
        </script>
    </head>
    <body>
        <?php include 'resources/templates/header.php'; ?>
        <div class="introStuff">
            <h1 id="title"><?php echo $title; ?> </h1>
            <h2 id="authorLine" onclick="goToGoogle()"><?php echo $username; ?></h2>
            <div id="additionalInfo">
                <span class="info">Genre: <span id="theGenre"></span><?php echo $genre; ?></span>
                <span class="info">Date Created: <span id="theDate"><?php echo $date_created; ?></span></span>
            </div>
        </div>
        <div id="theStory">
            <h2>Description</h2>
            <?php echo $description; ?>
        </div>
        <div id="theStory">
            <h2>Content</h2>
            <?php echo $content; ?>
        </div>
        
    </body>
</html>
