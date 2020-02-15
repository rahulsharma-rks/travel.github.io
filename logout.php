<?php
    session_start();
    session_destroy();
    unset($_SESSION['username']);
    $_SESSION['message']="You Are Now Logged Out!";
    header("location:login.php");
?>