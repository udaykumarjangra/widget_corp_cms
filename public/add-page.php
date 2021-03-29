<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Page | Widget Corp Admin</title>
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
                <h1>Add Page</h1>
                <?php
                    
                    $number=$_GET['subject'];
                    $name = $nameErr = $content = $contentErr = "";
                    if(isset($_GET['subject']))
                    {
                    $_SESSION['edit_id']=$number;
                    }
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (empty($_POST["name"])) {
                          $nameErr = "Page name is required";
                        } else {
                          $name = trim($_POST["name"]);
                        }
                        if (empty($_POST["content-area"])) {
                          $contentErr = "Content is required";
                        } else {
                          $content = trim($_POST["content-area"]);
                        }
                        if(empty($nameErr) && empty($contentErr))
                        {    $final= mysqli_query($con,"INSERT into `pages` (`id`, `subject_id`, `menu_name`, `position`, `visible`, `content`) VALUES (NULL, ".$_SESSION['edit_id'].",\"".$name."\",".$_POST['position'].",".$_POST['visible'].",\"".$content."\")");
                            if(!$final)
                            {
                                die("ERROR ".mysqli_error($con));
                            }
                            header("location:manage.php?subject=".$_SESSION['edit_id']);
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
                            
                            $values=mysqli_query($con,"SELECT * from pages where subject_id=".$_SESSION['edit_id']);
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
                    <label>Content:</label><br>
                    <textarea name="content-area" rows="10" cols="100"></textarea>
                    <span> <?php echo $contentErr;?></span>
                    <br><br>
                    <input class="submit" type="submit" value="Submit" style="margin-right:20px;">
                </form>
            </div>
        </div>
    </div>
</body>
<script src="../js/index.js"></script>
</html>