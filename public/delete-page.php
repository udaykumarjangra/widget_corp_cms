<?php
    include '../connection.php';
    session_start();
    if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }
    $id=$_GET['page'];
    mysqli_query($con,"DELETE FROM pages WHERE id=".$id);
    header("location:manage.php");
?>