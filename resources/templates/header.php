<header>
    <ul>
        <li><a href="http://localhost:80/regale/index.php">Home</a></li>
        <li><a href="http://localhost:80/regale/about.php">About</a></li>
        <li><a href="http://localhost:80/regale/users/profile.php">Profile</a></li>
        <li><a href="http://localhost:80/regale/users/login.php">Login</a></li>
        <li><a href="http://localhost:80/regale/users/NewProfile.php">Create Profile</a></li>
        <?php if(isset($_SESSION["username"])) {
            echo "<li><a href='http://localhost:80/regale/resources/templates/logout.php'>Logout</a></li>";
        } 
        ?>
    </ul>
</header>