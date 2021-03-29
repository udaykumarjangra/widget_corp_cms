<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Widget Corp Admin</title>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
    
    <?php
    include '../connection.php';
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: welcome.php");
        exit;
    }
    $username = $usernameErr = $password = $passwordErr = $loginErr= "";
    if(isset($_GET['id']))
    {
        if($_GET['error']==1)
            {
                $loginErr="You've to login first";
            }
            if($_GET['error']==2)
            {
                $loginErr="You've Successfully Logged out";
            }
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
            $login=mysqli_query($con,"SELECT * from admins where username=\"".$username."\"");
            if(mysqli_num_rows($login)==1)
            {
                $loginr=mysqli_fetch_assoc($login);
                if($loginr["hashed_password"]==$password)
                {
                    session_start();
                    $_SESSION["loggedin"] = true;
                    $_SESSION["username"] = $username;
                    header("location: welcome.php");
                }
                else{
                    $loginErr="Username or/and Password is wrong";
                }
            }
            else
            {
                $loginErr="Wrong Username";
            }

        }
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
              <h1>Admin Login</h1> 
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