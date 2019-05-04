<?php
session_start();
if(!isset($_SESSION['username'])){
    exit();
}
require_once "dbconnect.php";
$stmt = $mysqli->prepare("SELECT color FROM users WHERE username=?");
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$all = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode($all);
$stmt->close();
$mysqli->close()
?>
