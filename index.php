<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Widget Corp</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>

    <div class="header">
        <p class="logo">
            Widget Corp
        </p>
    </div>
    <div class="container">
        <div class="row">
            <div class="sidemenu">
            <?php
                include 'connection.php';
              
                $subect=1;
                $query=mysqli_query($con,"SELECT * from subjects ORDER BY position");
                while($row=mysqli_fetch_array($query))
                {
                    if($row['visible']==1)
                    {
                        echo "<button class=\"subject\">".$row['menu_name']."</button>";
                        $query2=mysqli_query($con,"SELECT * from pages where subject_id=\"".$row['id']."\" ORDER BY position" );
                        echo"<ul class=\"subject-container\">";
                        while($row2=mysqli_fetch_array($query2))
                        {
                            if($row2['visible']==1)
                            {
                            echo"<li><a href=?page=".$row2['id'].">".$row2['menu_name']."</a></li>";
                            }
                        }
                        echo"</ul>";
                    }
                }
            ?>
                     
            </div>
            <div class="main">
               <?php 
                    if(!isset($_GET['page']))
                    {
                        $p=1;
                    }
                    else{
                        $p=$_GET['page'];
                    }
                    $heading=mysqli_query($con,"SELECT * from pages where id=".$p);
                    $hrow=mysqli_fetch_array($heading);
                    echo"<h1>".$hrow['menu_name']."</h1>";
                echo "<p>".$hrow['content']."</p>";
                ?>
            </div>
        </div>
    </div>
</body>
<script src="js/index.js"></script>
</html>