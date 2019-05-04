<?php
session_start();
if(!isset($_SESSION['username'], $_POST['score'])){
   echo "User not logged in. no score logged";
   exit(); 
}
require_once 'dbconnect.php';
$stmt = $mysqli->prepare("INSERT INTO scores (username, score) VALUES (?, ?)");
$stmt->bind_param("sd", $_SESSION['username'], $_POST['score']);
$stmt->execute();
echo $mysqli->info;
$stmt->close();
$mysqli->close();
?>
