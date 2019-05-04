<?php
require_once 'dbconnect.php';
if($_GET['username']){
    $stmt = $mysqli->prepare("SELECT * FROM scores WHERE username=? ORDER BY score DESC LIMIT 10");
    $stmt->bind_param("s", $_GET['username']);
}
else{
    $stmt = $mysqli->prepare("SELECT * FROM scores ORDER BY score DESC LIMIT 10");
}
$stmt->execute();
$result = $stmt->get_result();
$all = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($all);

$stmt->close();
$mysqli->close();
?>
