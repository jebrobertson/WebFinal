<?php session_start(); ?>
 <nav>
        <ul class="navContainer">
            <?php
            if(isset($_SESSION['username'])){
                echo '<li class="greeting"> Hello '.$_SESSION['username'].'</li>';
            ?>
            <li><a href="index.php" >Home</a></li>
            <li><a href="game.php">Play</a> </li>
            <li><a href="editProfile.php">Edit Profile</a> </li>
            <?php
            }
            ?>
            <li><a href="leaderboard.php">Leaderboard</a> </li>
            <?php if(isset($_SESSION['username'])){ ?>
            <li><a href="logout.php">Logout</a> </li>
            <?php
            }
            else{
            ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a> </li>
            <?php } ?>
        </ul>
 </nav>
