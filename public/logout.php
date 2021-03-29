<?php
    session_start();
    $_SESSION = array();
    session_destroy();
    header("location: login.php?error=2");
    exit;
?>