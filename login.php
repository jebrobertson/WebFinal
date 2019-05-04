<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Login Page</title>
    <link href="css/general.css" rel="stylesheet""/>
</head>
<body>
<?php include 'navbar.php'; ?>
     <div class="verticalHolder">
        <h1>Login to Square Dodge!</h1>
        <form action="validateLogin.php" method="POST">
            <label for="username">Username: </label> <input type="text" id="username" name="username" maxLength="20"><br>
            <label for="password">Password: </label> <input type="password" id="password" name="password"><br>
            <button type="submit">Login</button>
        </form>
        <a href="register.php">Hey! Are you new here? Click here to register!</a>
     </div>
</body>
</html>
