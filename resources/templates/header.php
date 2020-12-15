<header class="header">
    <!--Header that has links to all other pages-->
    <a href="/index.php"><img class="logo" src="/resources/images/logo.svg" alt="logo image"></a>
    <ul class="nav_links">
        <li><a href="/index.php">Home</a></li>
        <li><a href="/about.php">About</a></li>
        <li><a href="/users/profile.php">Profile</a></li>
        <li><a href="/users/login.php">Login</a></li>
        <li><a href="/users/NewProfile.php">Create Profile</a></li>
        <?php if(isset($_SESSION["username"])) {
            echo "<li><a href='/resources/templates/logout.php'>Logout</a></li>";
        } 
        ?>
    </ul>
</header>