<?php
session_start();
if(!isset($_SESSION['username'], $_POST['color']))
    exit();
require_once 'dbconnect.php';
$stmt = $mysqli->prepare("UPDATE users SET color=? WHERE username=?");
$stmt->bind_param("ss", $_POST['color'], $_SESSION['username']);
$stmt->execute();
$stmt->close();
$mysqli->close();
?>
