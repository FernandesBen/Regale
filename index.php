<?php
    include 'resources/templates/session.php';
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css2?family=MedievalSharp&display=swap" rel="stylesheet">
        <title>Regale</title>
        <style type="text/css">
            body {
                text-align: center;
                font-family: 'MedievalSharp', cursive;
            }
            
            #logo {
                height:300px;
                width:600px;
                margin-left:75px;
            }
            
            body h1{
                box-sizing:border-box;
                width: 80%;
                color:brown;
                font-size:50px;
                border-style:double;
                border-color:brown;
                margin-left:130px;
                padding: 20px
            }
            
            #subTitle{
                font-size:35px;
                color:chocolate;
            }
            
            section{
                font-size:20px;
                color:crimson
            }
            
            body aside {
                text-align: right;
                margin-top: 20px;
                margin-right: 30px;
            }

        </style>
    </head>
    
    <body>
        <?php include 'resources/templates/header.php'; ?>
        <img src="resources/images/Regale Mascot.jpeg" id="logo" alt="Derlin the Wizard">
        <h1>Regale</h1>
        <p id="subTitle">Let us whisk you away to another realm through a wonderous tale</p>
        <section>
            <form method="GET" action="search.php" autocomplete="on">
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
    </body>
</html>
