<?php
    include 'session.php';
    session_unset();
    session_destroy();
    header('Location: http://localhost:80/regale/index.php');
?>