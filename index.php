<?php
    //Home page where user can search for content
    
    include 'resources/templates/session.php';
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" type="text/css" href="resources/css/master.css">
        <link rel="stylesheet" type="text/css" href="resources/css/index.css">

        <title>Regale</title>
    </head>
    
    <body>
        <?php include 'resources/templates/header.php'; ?>
        <div class="content">
            <img src="resources/images/Regale Mascot.jpeg" id="logo" alt="Derlin the Wizard">
            <h1>Regale</h1>
            <p id="subTitle">Let us whisk you away to another realm through a wonderous tale</p>
            <section>
                <!--Search form-->
                <form method="GET" action="search.php" autocomplete="on" class="login">
                    <label for="username">What author are you looking for:</label>
                    <input type="text" id="username" name="username">
                    <p></p>
                    <label for="title">What title are you looking for:  </label>
                    <input type="text" id="title" name="title">
                    <p></p>
                    <label for="genre">What genre are you looking for: </label>
                    <input type="text" id="genre" name="genre" list="genres">
                        <datalist id="genres">
                        <option value="Action"></option>
                            <option value="Adventure"></option>
                            <option value="Romance"></option>
                            <option value="Horror"></option>
                            <option value="Sci-Fi"></option>
                            <option value="Mystery"></option>
                            <option value="Other"></option>
                        </datalist>
                    <p></p>
                    <input type="submit" name="submit" value="Let's Go ------->">
                </form>
            </section>
        </div>
    </body>
</html>
