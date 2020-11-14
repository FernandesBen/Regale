<?php
    include 'resources/templates/session.php';
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css2?family=MedievalSharp&display=swap" rel="stylesheet">
        <title>Regale About Us</title>
        <style type="text/css">
            body {
                text-align: center;
                font-family: 'MedievalSharp', cursive;
            }
            
            #creators {
                height: 400px;
                width: 300px;
                margin-bottom: 20px;
            }
            
            body h1 {
                font-size:70px;
            }
            
            body p {
                text-align: left;
                font-size: 20px;
            }
            
            #toContact {
                text-align: left;
                font-size: 20px;
                margin-bottom: 30px;
            }
            
            body a {
                font-size: 20px;
            }
        </style>
    </head>
    
    <body>
        <?php include 'resources/templates/header.php'; ?>
        <h1>About Us</h1>
        <img src="resources/images/Creators.jpg" id="creators" alt="The magnficient portrait of the creators of this fine website">
        <p>Regale is a website that revolves around literature and stories. We call upon literature enthusiasts and writing fanatics to our humble abode. Search and browse for your next favorite story. Write and submit stories to post on our website. Let your creativity and love for stories take the reigns.</p>
        <div id="toContact">Contact Us: 
            <details>
                <summary>Ben Fernandes</summary>
                <ul>
                    <li>Email: </li>
                    <li>Phone Number: </li>
                </ul>
            </details>
            <details>
                <summary>Julius Quilarto</summary>
                <ul>
                    <li>Email: juliusquilarto@gmail.com</li>
                    <li>Phone Number: 630-740-7029</li>
                </ul>
            </details>
        </div>
    </body>
</html>