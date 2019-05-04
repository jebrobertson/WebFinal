<?php
$username="root";
$password="?12FbBbBb";
$database="gamebase";
$address="localhost";
$mysqli = new mysqli($address, $username, $password, $database);
if( $mysqli->connect_errno > 0){
   echo "Failed to connect to the database" . $mysqli->connect_error();
}
?>
