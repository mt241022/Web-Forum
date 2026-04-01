<?php
require_once('config.inc.php');
require_once(__DIR__ . '/classes/ForumDB.class.php');
require_once(__DIR__ . '/classes/Auth.class.php');
session_start();

$Auth = new Auth();

if(isset($_POST['Logout'])) {
    $_SESSION['darfrein'] = false;
    session_unset();
    header('Location: index.php');
    exit;
}

if(isset($_POST['Login'])){
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if($Auth->checkLogin($username, $password)){
        $_SESSION['darfrein'] = true;
        $_SESSION['name'] = $username;
        $_SESSION['is_admin'] = ($username === "Admin");
        header('Location: forum.php');
    } else {
        $_SESSION['darfrein'] = false;
        header('Location: index.php?error=1');
    }
    exit;
}

if(isset($_POST['Register'])){
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if($Auth->registrieren($username, $password)){
        header('Location: index.php?success=1');
    } else {
        header('Location: index.php?error=userexists');
    }
    exit;
}
