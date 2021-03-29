<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Subject | Widget Corp Admin</title>
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
                <h1>Edit Subject</h1>
                <?php
                    $name = $nameErr = $content = $contentErr = "";
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (empty($_POST["name"])) {
                          $nameErr = "Subject name is required";
                        } else {
                          $name = trim($_POST["name"]);
                        }
                        if(empty($nameErr))
                        {   
                            $final= mysqli_query($con,"INSERT into `subjects` (`id`, `menu_name`, `position`, `visible`) VALUES (NULL,\"".$name."\",".$_POST['position'].",".$_POST['visible'].")");
                            if(!$final)
                            {
                                die("ERROR ".mysqli_error($con));
                            }
                            header("location:manage.php");
                        }
                      }
                ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <label for="name">Page Name:</label>
                    <input type="text" id="name" name="name"><span> <?php echo $nameErr;?></span><br><br>
                    <label for="radio">Visibility:</label>
                    <input type="radio" id="yes" name="visible" value="1" checked="checked">
                    <label for="yes">Yes</label>
                    <input type="radio" id="no" name="visible" value="0">
                    <label for="no">No</label><br><br>
                    <label for="position">Position:</position>
                    <select id="position" name="position" style="background-color:white;">
                        <?php
                            $values=mysqli_query($con,"SELECT * from subjects");
                            if($values)
                            {
                            $valuesr=mysqli_num_rows($values);
                            for($i=1; $i<=$valuesr+1; $i++)
                            {
                                echo "<option value=\"$i\">$i</option>";
                            }
                            }
                        ?>
                    
                    </select><br><br>
                    <input class="submit" type="submit" value="Submit" style="margin-right:20px;">
                </form>
            </div>
        </div>
    </div>
</body>
<script src="../js/index.js"></script>
</html>