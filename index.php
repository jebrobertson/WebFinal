<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Square Dodge Game!</title>
    <link href="css/general.css" rel="stylesheet"/>
</head>
<body>
<?php include 'navbar.php'; ?>
    <h1>Welcome!</h1>
    <div class="holder">
        <p>
		Welcome to Square Dodge Game! Square Dodge Game is simple yet additive. You are a tiny
		circle and the goal of the game is not get hit. Use the arrow keys to avoid the 
		squares and see how long you last! If you do well enough you can make the leaderboards!
		You need to sign in to play so if you are new here head over to the register page.
		Besides the benifet of playing the game you can also customize you circle color.
        </p>
        <img src="images/logo.png" alt="logo.phg"></img>
    </div>
    <hr>
    <h2>I Challenge You!</h2>
    <div class="holder">
       <p>Here is a sample video of the game. It is also the highest on the leaderboard! I challenge you to beat it</p>
       <iframe width="400" height="300" src="https://www.youtube.com/embed/5p_YjxRMmp8">
       </iframe>
    </div>  
    </div>
    <hr>
    <h2>Gallary</h2>
    <div class="holder">
        <?php
            for($i = 1;$i <= 5; $i++)
                echo '<img src="images/game'.$i.'.png" alt="game'.$i.'" width="680" height="400"></img>'."\n";
        ?>
    </div>
</body>
</html>
