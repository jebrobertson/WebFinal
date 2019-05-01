<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Square Dodge Game!</title>
    <link href="css/game.css" rel="stylesheet"/>
    <link href="css/general.css" rel="stylesheet" />
</head>
<body>
    <h1>Square Dodge Game</h1>
    <div class="holder">
        <canvas id="gameCanvas" width="1000" height="800" ></canvas>
    </div>
    <div class="holder">
        <button type="button" onclick="pauseGame()" id="pauseStart">Pause</button>
        <button type="button" onclick="resetGame()" id="reset">Reset</button>
    </div>
    <script src="js/SquareDodgeGame.js"></script>
</body>
</html>
