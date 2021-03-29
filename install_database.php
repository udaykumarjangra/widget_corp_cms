<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "";
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "CREATE DATABASE widget_corp";
	if ($conn->query($sql) === TRUE) {
	    echo "Database created successfully";
	} else {
	    echo "Error creating database: " . $conn->error;
	}

	echo "<br>";

	$dbname = "widget_corp";
    
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "CREATE TABLE IF NOT EXISTS `admins` (
  		`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  		`username` TEXT DEFAULT NULL,
  		`hashed_password` TEXT DEFAULT NULL,
  		PRIMARY KEY(id)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1";

	if ($conn->query($sql) === TRUE) {
	    echo "Table admins created successfully<br>";
	} else {
	    echo "Error creating table: " . $conn->error;
	}

	$sql = "CREATE TABLE IF NOT EXISTS `pages` (
 		
  		`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  		`subject_id` int(11) unsigned NOT NULL,
  		`menu_name` TEXT DEFAULT NULL,
  		`position` int(11) unsigned NOT NULL,
  		`visible` int(11) unsigned NOT NULL,
        `content` longtext NOT NULL,
		PRIMARY KEY(id)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1";

	if ($conn->query($sql) === TRUE) {
	    echo "Table pages created successfully<br>";
	} else {
	    echo "Error creating table: " . $conn->error;
    }
    
    $sql = "CREATE TABLE IF NOT EXISTS `subjects` (
 		
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `menu_name` TEXT DEFAULT NULL,
        `position` int(11) unsigned NOT NULL,
        `visible` int(11) unsigned NOT NULL,
      PRIMARY KEY(id)
      ) ENGINE=MyISAM  DEFAULT CHARSET=latin1";

  if ($conn->query($sql) === TRUE) {
      echo "Table subjects created successfully<br>";
  } else {
      echo "Error creating table: " . $conn->error;
  }
    $sql="INSERT INTO `admins` (`id`, `username`, `hashed_password`) VALUES (NULL,\"admin\",\"admin\")";
    if($conn->query($sql)===TRUE)
    {
        echo "Admin created<br>";
    }
    else{
        echo "Error Creating admin".mysqli_error($conn);
    }
	$conn->close();
?>
