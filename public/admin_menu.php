<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Menu | Widget Corp Admin</title>
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
                <ul class="subject-container-p">
                    <li><a href="welcome.php">Main Menu</a></li>
                </ul>      
            </div>
            <div class="main">
                <h1>Manage Admin Users</h1>
                <table style="margin-bottom: 40px;">
                <tr>
                    <th><b>Username</b></th>
                    <th><b>Actions</b></th>
                </tr>
               <?php
                    $heading=mysqli_query($con,"SELECT * from admins");
                    while($headingr=mysqli_fetch_array($heading))
                    {
                        echo"<tr>";
                        echo"<td>".$headingr['username']."</td>";
                        echo"<td><a href=\"edit-user.php?id=".$headingr['id']."\">EDIT </a> <a href=\"delete.php?id=".$headingr['id']."\">DELETE</a></td></tr>";
                    }
                ?>
                </table>
                <a href="add-user.php">Add New Admin</a>
            </div>
        </div>
    </div>
</body>
<script src="../js/index.js"></script>
</html>