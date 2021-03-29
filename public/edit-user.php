<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User | Widget Corp Admin</title>
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
                <h1>Edit Admin User</h1>
                <?php
                    
                    $number=$_GET['id'];
                    $username = $usernameErr = $password = $passwordErr = $loginErr= "";
                    if(isset($_GET['id']))
                    {
                    $_SESSION['edit_id']=$number;
                    }
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (empty($_POST["username"])) {
                          $usernameErr = "Username is required";
                        } else {
                          $username = trim($_POST["username"]);
                        }
                        if (empty($_POST["password"])) {
                          $passwordErr = "Password is required";
                        } else {
                          $password = trim($_POST["password"]);
                        }
                        if(empty($usernameErr) && empty($passwordErr))
                        {   
                           $final= mysqli_query($con,"UPDATE `admins` SET `username`=\"".$username."\", `hashed_password`=\"".$password."\" WHERE id=".$_SESSION['edit_id']);
                            header("location:admin_menu.php");
                        }
                      }
                ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username"><span> <?php echo $usernameErr;?></span><br><br>
                    <label for="password">Password:</label>
                    <input type="text" id="password" name="password"><span> <?php echo $passwordErr;?></span><br><br><span> <?php echo $loginErr;?><br>
                    <input class="submit" type="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>
</body>
<?php
$initial=mysqli_query($con,"SELECT * from admins where id=".$_SESSION['edit_id']);
if($initial)
{
$initialr=mysqli_fetch_assoc($initial);
echo"<script>
document.getElementById(\"username\").setAttribute(\"value\",\"".$initialr['username']."\");
</script>";
}
?>
<script src="../js/index.js"></script>
</html>