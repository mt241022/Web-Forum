<?php

session_start();
require_once('config.inc.php');

if($_SESSION['darfrein'] != true){
    header('Location: index.php?error=2');
    exit();
}

$forum = new ForumDB();

if(isset($_POST['new_thread']) && !empty($_POST['thread_name'])){
    $forum->addThread($_POST['thread_name']);
}
$threads = $forum->getThreads();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forum</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="forum-header">
<form action="action.php" method="POST" class="logout-button">
    <input type ="submit" name="Logout" value="Logout">
</form>

<h1 style="text-align: center">Willkommen im Forum</h1>

<p style="text-align:center">Hallo <?= $_SESSION['name']?></p>

<form method="POST" style="text-align: center; margin-bottom: 50px;">
    <input type="text" name="thread_name" placeholder="neues Thema anlegen"/>
    <input type="submit" name="new_thread" value="Posten"/>
</form>
</div>

<div class="thread-container">
<?php foreach($threads as $t):?>
    <h3>
        <a href="thread.php?threadID=<?= $t['threadID']?>">
            <?=strip_tags($t['name'])?>
        </a>
    </h3>
    <hr>
<?php endforeach; ?>
</div>

</body>
</html>
