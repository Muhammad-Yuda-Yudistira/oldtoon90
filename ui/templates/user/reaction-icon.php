<?php
require_once "../controllers/dbs.php";

if(isset($_SESSION['email']))
{
    $email = $_SESSION['email'];
}
$eps = $_GET['eps'];
$title = $_GET['title'];
$_SESSION['titleFilm'] = $title;

$idTitle = query("SELECT id FROM film WHERE title='$title'");
$titleId = $idTitle[0]['id'];

$iconValue = query("SELECT * FROM user_reaction WHERE title_id='$titleId' AND episode=$eps");
if($iconValue == "data tidak ada")
{
    $result = addQuery("INSERT INTO user_reaction VALUES('','$titleId',$eps,'','','')");
    $iconValue = query("SELECT * FROM user_reaction WHERE title='$titleId' AND episode=$eps");
}
$iconValue = $iconValue[0];

$titleId = $iconValue['title_id'];
$watched = $iconValue['watched'];
$like = $iconValue['liked'];
$nostalgia = $iconValue['nostalgia'];



if(isset($_SESSION['email']))
{
    $user = $_SESSION['email'];
    $idUser = query("SELECT id FROM user WHERE email='$email'");
    $userId = $idUser[0]['id'];

    $user_icons = query("SELECT * FROM user_video_reaction WHERE user_id='$userId' AND title_id='$titleId' AND episode='$eps'");

    if($user_icons !== "data tidak ada")
    {
        $user_icons = $user_icons[0];
        
        $user_watched = $user_icons['watched'];
        $user_liked = $user_icons['liked'];
        $user_nostalgia = $user_icons['nostalgia'];
    }
}
?>


    <div class="reaction">
        <div class="icon-reaction">
            <!-- <img id="icon-non-click" src="http://localhost/2023/mei/kids90/theme/icons/monitor-svgrepo-com.svg" title="watching"> -->
            <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" id="watched" title="watching" data-user="<?= isset($email) ? true : false; ?>" data-user="<?= $user ?>" data-eps="<?= $eps ?>" data-watched="<?= $user_watched ?>">
                <path d="M9 12v2h6v2H1v-2h6v-2H0V0h16v12H9zM2 2v8h12V2H2z" fill-rule="evenodd"/>
            </svg>
            <div class="angka nilai"><?= $watched ?></div>
        </div>
        <div class="icon-reaction">
            <!-- <img src="http://localhost/2023/mei/kids90/theme/icons/thumbup-svgrepo-com.svg" title="like" id="like" data-hasLike="false"> -->
            <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" title="like" id="like" data-user="<?= isset($email) ? true : false; ?>" data-has-like="<?= $user_liked; ?>" data-eps="<?= $eps ?>">
                <path d="M4 16H0V6h4V0h6v4h6v12H4zM6 2v12h8v-1h-2v-2h2v-1h-2V8h2V6H8V2H6zM2 8v6h2V8H2z" fill-rule="evenodd"/>
            </svg>
            <div class="angka skor"><?= $like ?></div>
        </div>
        <div class="icon-reaction">
            <!-- <img src="http://localhost/2023/mei/kids90/theme/icons/anchor-svgrepo-com.svg" title="nostalgia" id="nostalgia" data-hasNostalgia="false"> -->
            <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" id="nostalgia" data-user="<?= isset($email) ? true : false; ?>" data-has-nostalgia="<?= $user_nostalgia; ?>" title="nostalgia" data-eps="<?= $eps ?>">
                <path d="M7 5.829A3.004 3.004 0 0 1 5 3c0-1.657 1.347-3 3-3 1.657 0 3 1.347 3 3a3.003 3.003 0 0 1-2 2.829v8.088A6.016 6.016 0 0 0 13.658 10H13V8h3v2h-.253A8.017 8.017 0 0 1 9 15.938V16H7v-.062A8.016 8.016 0 0 1 .253 10H0V8h3v2h-.658A6.015 6.015 0 0 0 7 13.917V5.829zM7 2v2h2V2H7z" fill-rule="evenodd"/>
            </svg>
            <div class="angka skor"><?= $nostalgia ?></div>
        </div>
    </div>

    <?php 
    $reactionQuery = "UPDATE user_reaction
                        SET watched='$watched', like='$like', nostalgia='$nostalgia'
                        WHERE title='$titleId' AND episode='$eps'
                    ";
    addQuery($reactionQuery);
    ?>
