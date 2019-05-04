<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>LeaderBoard</title>
    <link href="css/general.css" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php'; ?>
    <h1>LeaderBoard</h1>
    <div class="verticalHolder">
    <p>Here is the leaderboard! You can also search by username to find their personal best!</p>
    <form action="" method="GET">
        <label for="search">Username: </label>
        <input type="text" maxLenth="20" id="search" name="search">
        <button type="submit">Search</button>
    </form>
    <table>
    <tr><th>Username</th><th>Time</th></tr>
<?php
    require_once 'dbconnect.php';
    if(isset($_GET['search']) && $_GET['search'] != ""){
        $stmt = $mysqli->prepare("SELECT * FROM scores WHERE username=? ORDER BY score DESC LIMIT 10");
        $stmt->bind_param("s", $_GET['search']);
    }
    else{
        $stmt = $mysqli->prepare("SELECT * FROM scores ORDER BY score DESC LIMIT 10");
    }
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
        echo '<tr><td>'.$row['username'].'</td><td>'.$row['score']."</td>\n";
    }
?>
    </table>
    <div>
</body>
</html>
