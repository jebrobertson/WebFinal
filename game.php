<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Square Dodge Game!</title>
    <link href="css/game.css" rel="stylesheet"/>
    <link href="css/general.css" rel="stylesheet" />
    <script src="js/SquareDodgeGame.js"></script>
</head>
<body onload="startGame()">
<?php
include 'navbar.php';
session_start();
if(!isset($_SESSION['username'])){
   echo "<h1>Login Please</h1>";
   echo "<p>To play the game you must login in</p>";
   echo '<a href="login.php">Click here to login</a>';
}
else{
?>

    <h1>Square Dodge Game</h1>
    <div class="holder">
        <div class="tableDiv verticalHolder">
            <h3>High Scores</h3>
            <table id="leaders"></table>
	</div>
        <canvas id="gameCanvas" width="1000" height="800" ></canvas>
        <div class="tableDiv verticalHolder">
            <h3>Personal Bests</h3>
            <table id="personalBest"></table>
        </div>
    </div>
    <div class="holder">
        <button type="button" onclick="pauseGame()" id="pauseStart">Pause</button>
        <button type="button" onclick="resetGame()" id="reset">Reset</button>
    </div>
<?php
}
?>
</body>
</html>
