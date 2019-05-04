<?php
session_start();
if(!isset($_SESSION['username']))
    exit();
require_once 'dbconnect.php';

$stmt = $mysqli->prepare("SELECT * FROM scores WHERE username=? ORDER BY score DESC LIMIT 10");
$stmt->bind_param("s", $_SESSION['username']);
$stmt->bind_param("sd", $_SESSION['username'], $_POST['score']);
$stmt->execute();
$result = $stmt->get_result();
$all = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($all);

$stmt->close();
$mysqli->close();
?>
