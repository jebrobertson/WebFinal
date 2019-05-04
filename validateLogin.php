<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Validate Login</title>
    <link href="css/general.css" rel="stylesheet">
</head>
<body>
<?php
   
   if(!isset($_POST['username'], $_POST['password'])){
       include 'navbar.php';
       ?>
       <h3>Error!</h3>
       <p>Username and password not set. Use <a href="login.php">this page</a> to log in</p>
       <?php
   }
   else{
       require_once 'dbconnect.php';
       $query = sprintf("SELECT password FROM users WHERE username='%s' ", mysql_real_escape_string($_POST['username']));   
       //echo $query; 
       $result = $mysqli->query($query);
       if(!$result) {
           die("Invalid query " . mysql_error() . "\nWhole query" . $query);
       }
       while($row = $result->fetch_assoc()){
            $pass = $row['password'];
            if(password_verify($_POST['password'], $pass)){
                session_start();
                $_SESSION["username"] = $_POST['username'];
                $mysqli->close();
                include 'navbar.php';
                echo '<p>Success you are now logged in</p>'; 
            } else {
                $mysqli->close();
                include 'navbar.php';
                echo '<p>Incorrect Username and Password pair. Use <a href="login.php">this page</a> to log in</p>';
            }
       }
       if($result->num_rows == 0)
           echo '<p>Incorrect Username and Password pair. Use <a href="login.php">this page</a> to log in</p>';
       $result->close();
       $mysqli->close();
   }
?>
</body>
</html>
