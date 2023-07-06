<?php

$data = query("SELECT * FROM next_film_uploaded");
$livechat = query("SELECT * FROM live_chat");

if(isset($_SESSION['email']))
{
    $email = $_SESSION['email'];
    $id = query("SELECT id FROM user WHERE email='$email'");
    $id = $id[0]['id'];
    $userVoting = query("SELECT user_id, voted FROM user_voting WHERE user_id=$id");
    if($userVoting !== "data tidak ada")
    {
        $userId = $userVoting[0]['user_id'];
        $userVoted = $userVoting[0]['voted'];
    }
}

?>

<div class="sidebar">
    <div class="box-sidebar box-1">
        <h4>voting next film!</h4>
        <form action="<?= $baseurl ?>controllers/voteFilmControllers.php" method="post">
            <ul class="list-next-film" style="list-style: none; text-align:start; padding: 0 40px;">
                <?php foreach($data as $film): ?>
                <li>
                    <label for="<?= $film['title'] ?>">
                        <input type="radio" id="<?= $film['title'] ?>" name="title" value="<?= $film['title'] ?>"> <?= $film['title'] ?>
                    </label>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php if(!isset($userVoted) && isset($_SESSION['email'])): ?>
                <input type="submit" value="vote" name="vote" style="width: 100px; height: 20px; color:#333;">
            <?php elseif(isset($userVoted) && isset($_SESSION['email']) && $userId): ?>
                <span style="background-color: green; padding: 2px;">thanks you for your voting!</span>
            <?php else: ?>
                <span style="background-color: red; padding: 2px;">login for voting!</span>
            <?php endif ?>
        </form>
        <div class="result-voting">
            <h4>result</h4>
            <ul>
                <?php foreach($data as $film): ?>
                    <li style="padding-bottom: 5px;">
                        <p><?= $film['title'] ?> : <?= $film['voted'] ?> suara.</p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="box-sidebar box-2">
        <h4>live chat</h4>
        <div class="papan-chat" style="background-color: #ddd; color:#333">

            <?php foreach($livechat as $chat): ?>
                <?php $userId = $chat['user_id']; ?>
                <?php $username = query("SELECT email FROM user WHERE id=$userId"); ?>

                <div class="user">
                    <span class="username"><?= $username[0]['email'] ?></span>
                    <p class="chatting"><?= $chat['message'] ?></p>
                </div>

            <?php endforeach; ?>

        </div>
        <form action="<?= $baseurl ?>controllers/liveChatController.php" method="post">
            <label for="user-chat">
                <?= isset($email) ? $email : 'anonymous' ?>
                <input type="text" name="chat" id="chat-user">
                <button type="submit" name="submit">kirim!</button>
            </label>
        </form>
    </div>
</div>