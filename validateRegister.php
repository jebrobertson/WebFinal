<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Validate Login</title>
    <link href="css/general.css" rel="stylesheet">
</head>
<body>
<?php
   include 'navbar.php';
   if(!isset($_POST['username'], $_POST['password'])){
       ?>
       <h3>Error!</h3>
       <p>Username and password not set. Use <a href="register.php">this page</a> to register</p>
       <?php
   }
   else{
       require_once 'dbconnect.php';
       $query = sprintf("SELECT password FROM users WHERE username='%s' ", mysql_real_escape_string($_POST['username']));   
       $result = $mysqli->query($query);
       if(!$result) {
           die("Invalid query " . mysql_error() . "\nWhole query" . $query);
       }
       if($result->num_rows > 0){
           echo '<h3>Error!</h3>';
           echo '<p>Username already in use. Use <a href="register.php">this page</a> to try again</p>';
       }
       else{
           $result->close();
           $username = $mysqli->real_escape_string($_POST['username']);
           $hash = password_hash($_POST['password'], PASSWORD_DEFAULT); 
           $query = "INSERT INTO users (username, password) VALUES ('$username', '$hash')";
           if($result = $mysqli->query($query)){
               echo '<h3>Success!</h3>';
               echo '<p>Congrats! Use <a href="login.php">this page</a> to login in!</p>';
           }
           else {
               echo '<h3>Error!</h3>';
               echo '<p>Failed to register. Use <a href="register.php">this page</a> to try again</p>';
           }
       }

       $mysqli->close();
   }
?>
</body>
</html>
