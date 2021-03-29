<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Content | Widget Corp Admin</title>
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
            <?php
                include '../connection.php';
                $query=mysqli_query($con,"SELECT * from subjects ORDER BY position");
                while($row=mysqli_fetch_array($query))
                {
                   echo "<button class=\"subject\"><a href=\"?subject=".$row['id']."\">".$row['menu_name']."</a></button>";
                    $query2=mysqli_query($con,"SELECT * from pages where subject_id=\"".$row['id']."\" ORDER BY position" );
                    echo"<ul class=\"subject-container-p\">";
                    while($row2=mysqli_fetch_array($query2))
                        {
                            echo"<li><a href=\"?page=".$row2['id']."\">".$row2['menu_name']."</a></li>";   
                        }
                    echo"</ul>";
                
                }
            ?>
            <ul class="subject-container-p" style="list-style-type:none;">
                    <li><a href="add-subject.php">+ Add a Subject</a></li>
                </ul> 
                     
            </div>
            <div class="main">
               <?php 
                    if(!isset($_GET['page']) && !isset($_GET['subject']))
                    {
                        echo"<h1>Select Any Subject or Page to Continue</h1>";
                    }
                    if(isset($_GET['subject']))
                    {   $p=$_GET['subject'];
                        echo"<h1>Manage Subject</h1>";
                        $heading=mysqli_query($con,"SELECT * from subjects where id=".$p);
                        $hrow=mysqli_fetch_array($heading);
                        echo"<p>Menu Name:".$hrow['menu_name']."<br>";
                        echo "Position:".$hrow['position']."<br>";
                        echo"Visible: ";
                        if($hrow['visible']==0)
                        {
                            echo"No";
                        }
                        else{
                            echo"Yes";
                        }
                        echo"</p><hr>";
                        echo"<h1>Pages in this Subject</h1>";
                        $pages=mysqli_query($con,"SELECT * from pages where subject_id=".$p);
                        echo"<ul class=\"welcome\">";
                        while($pagesrow=mysqli_fetch_array($pages))
                        {
                            echo"<li><a href=\"?page=".$pagesrow['id']."\">".$pagesrow['menu_name']."</a></li>";   
                        }
                        echo"</ul>";
                        echo"<a href=\"edits.php?subject=".$p."\">Edit Subject</a>    ";
                        echo"<a href=\"add-page.php?subject=".$p."\">Add Page</a>";
                    }
                    if(isset($_GET['page'])){
                        $p=$_GET['page'];
                        $heading=mysqli_query($con,"SELECT * from pages where id=".$p);
                        $hrow=mysqli_fetch_array($heading);
                        echo"<h1>Manage Page</h1>";
                        echo"<p>Menu Name:".$hrow['menu_name']."<br>";
                        echo "Position:".$hrow['position']."<br>";
                        echo"Visible: ";
                        if($hrow['visible']==0)
                        {
                            echo"No";
                        }
                        else{
                            echo"Yes";
                        }
                        echo"<br>Content: ".$hrow['content'];
                        echo"</p><hr>";
                        echo"<a href=\"edit.php?page=".$p."\">Edit Page</a>";
                    }
                    
                ?>
            </div>
        </div>
    </div>
</body>
</html>