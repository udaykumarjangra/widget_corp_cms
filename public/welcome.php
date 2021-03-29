<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | Widget Corp Admin</title>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
<?php
    include '../connection.php';
    session_start();
    if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
        header("location: login.php?error=1");
        exit;
    }
?>
    <div class="header">
        <p class="logo">
            Widget Corp Admin
        </p>
    </div>
    <div class="container">
        <div class="row">
            <div class="sidemenu">
                     
            </div>
            <div class="main">
               <h1>Admin Panel</h1>
               <p>Welcome <?php echo $_SESSION["username"];?><br>
                Choose Option:</p>
                <ul class="welcome"> 
                    <li><a href="manage.php">Manage Website Content</a></li>
                    <li><a href="admin_menu.php">Manage Admin Users</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</body>
<script src="../js/index.js"></script>
</html>