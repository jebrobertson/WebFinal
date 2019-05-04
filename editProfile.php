<?php
session_start();
?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Edit Profile</title>
    <link href="css/general.css" rel="stylesheet"/>
    <link href="css/colorPicker.css" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script
  src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
  integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
  crossorigin="anonymous"></script>
    <script src="js/colorPicker.js"></script>
</head>
<body>
<?php
include 'navbar.php';
if(isset($_SESSION['username'])){
?>
    
    <h1>Choose your Circle Color</h1>
    <p class="middle">Drag a square from below to your color to change it! Or use the color picker below.</p>
    <div class="holder">
    <p>Current Color</p>
    <?php
    require_once 'dbconnect.php';
    $stmt = $mysqli->prepare("SELECT color FROM users WHERE username=?");
    $stmt->bind_param("s", $_SESSION['username']);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc())
        $color = $row['color'];
    if($color == "NULL" || $color=="")
        $color = "#0000FF";
    echo '<div id="chosenColor" class="colorBlock" style="background-color: '.$color.';"></div>';
    ?>
    </div>
    <div class="holder">
    <?php
       for($i = 0; $i < 64; $i++)
           echo '<div class="colorBlock"></div>';
    ?>
    </div>
    <div class="holder">
        <input type="color" id="manualColor">
        <button type="button" id="submitColor" onclick="updateColorFromPicker()">Submit Manual Picker Color!</button>
    </div>
    
<?php
}
else{
?>
    <h2>Please Log in</h2>
    <p>This page edits profiles and only matters if you are logged in</p>
    <a href="login.php">Click Here to log in</a>

<?php
}
?>
</body>
</html>
