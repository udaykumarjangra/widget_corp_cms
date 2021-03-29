<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User | Widget Corp Admin</title>
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
                <h1>Add Admin User</h1>
                <?php
                    $username = $usernameErr = $password = $passwordErr = $loginErr= "";
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
                           $final= mysqli_query($con,"INSERT INTO `admins`(`id`, `username`, `hashed_password`) VALUES (NULL,\"".$username."\",\"".$password."\")");
                           if(!$final)
                           {
                               die("Error".mysqli_error($con));
                           }
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

<script src="../js/index.js"></script>
</html>