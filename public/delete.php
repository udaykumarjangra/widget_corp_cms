<?php
    include '../connection.php';
    session_start();
    if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }
    $id=$_GET['id'];
    mysqli_query($con,"DELETE FROM admins WHERE id=".$id);
    header("location:admin_menu.php");
?>