<?php
require_once('config.inc.php');
?>

<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forum</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="startseite">

<h1 style="text-align: center; margin-top: 100px; margin-bottom: 30px">Das ist ein Forum</h1>

<?php

//echo $_SESSION['name'];

if (isset($_GET['error']) && $_GET['error'] == 1) {
    echo "<p style='color: black; text-align:center;'>Username oder Passwort ist falsch.</p>";
}

if (isset($_GET['error']) && $_GET['error'] == 2) {
    echo "<p style='color: black; text-align:center;'>Kein Zugriff auf diese Seite</p>";
}

if(isset($_GET['error']) && $_GET['error'] == 'userexists'){
    echo "<p style='color: black; text-align:center;'>Username existiert bereits!</p>";
}


?>

<div class="login-container">
<div class="login-box">
<h3 style="margin-top:20px; margin-bottom: 20px; font-size: 1.5em;">Login</h3>

<form action="action.php" method="POST">

    <input type="text" name="username" placeholder="Username"><br>
    <input type="text" name="password" placeholder="Passwort"><br>
    <input type="submit" value="Login" name="Login" style="margin-top:10px; margin-bottom:20px;">

</form>
</div>

<div class="register-box">
<h3 style="margin-top: 20px; margin-bottom: 20px; font-size: 1.5em;">Registrieren</h3>

<form action="action.php" method="POST" enctype="multipart/form-data">

    <input type="text" name="username" placeholder="Username"><br>
    <input type="text" name="password" placeholder="Passwort"><br>
    <input type="submit" value="Registrieren" name="Register" style="margin-top:10px; margin-bottom:20px;">

</form>
</div>
</div>

</body>
</html>
