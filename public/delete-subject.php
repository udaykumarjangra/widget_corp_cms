<?php
    include '../connection.php';
    session_start();
    if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }
    $id=$_GET['subject'];
    mysqli_query($con,"DELETE FROM subjects WHERE id=".$id);
    mysqli_query($con,"DELETE FROM pages WHERE subject_id=".$id);
    header("location:manage.php");
?>