<?php

session_start();
require_once('config.inc.php');

if($_SESSION['darfrein'] != true){
    header('Location: index.php?error=2');
    exit();
}

$forum = new ForumDB();

if(!isset($_GET['threadID'])){
    header('Location: index.php');
    exit();
}

$threadID = $_GET['threadID'];
$threads = $forum->getThreads();
$thread = null;

foreach($threads as $t) {
    if ($t['threadID'] == $threadID) {
        $thread = $t;
    }
}

$messages = $forum->getMessages($threadID);

if(isset($_POST ['new_message']) && !empty($_POST['message'])){
    $forum->addMessage($threadID, $_SESSION['name'], $_POST['message']);
    header('Location: thread.php?threadID='.$threadID);
    exit();
}

if (isset($_POST['delete_id']) && !empty($_SESSION['is_admin']) && $_SESSION['is_admin'] === true) {
    $forum->deleteMessage($_POST['delete_id']);
    header('Location: thread.php?threadID=' . $threadID);
    exit();
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title><?=$thread['name']?> – Forum</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="thread-header">
<a class="zuruecklink" href="forum.php">Zurück zu allen Themen</a>

<form action="action.php" method="POST" class="logout-button">
    <input type ="submit" name="Logout" value="Logout">
</form>

<h2 style="text-align: center; margin-top: 50px; margin-bottom: 100px;"><?=$thread['name']?></h2>
</div>

<div class="message-container">
<?php foreach($messages as $m):?>
    <p class="semibold-text" style="margin-top: 20px; margin-bottom:0px;">
        <?=$m['name']?> – <?=$m['date']?><br>
    </p>
    <p style="margin-bottom: 20px;">
        <?=strip_tags($m['message'])?>
    </p>

    <?php if (!empty($_SESSION['is_admin']) && $_SESSION['is_admin'] === true): ?>
        <form method="POST" action="thread.php?threadID=<?=$threadID?>">
            <input type="hidden" name="delete_id" value="<?=$m['messageID']?>">
            <input type="submit" value="Löschen" class="delete-btn" style="margin-bottom: 20px;">
        </form>
    <?php endif; ?>

    <hr>
<?php endforeach; ?>
</div>

<form method="POST" class="new-message">
    <input type="text" name="message" placeholder="Neue Nachricht" rquired>
    <input type="submit" name="new_message" value="Posten">
</form>

</body>
</html>