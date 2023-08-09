<?php 
session_start() ;

require_once "../config/config.php";
require_once "../controllers/dbs.php";


$title = $_GET['title'];
$eps = $_GET['eps'];

$film = query("SELECT * FROM film WHERE title='$title'");
$film = $film[0];
$cover = $film['cover'];
$idFilm = $film['id'];

$epsFilm = query("SELECT * FROM episode_film WHERE title_id=$idFilm AND episode=$eps");
$epsFilm = $epsFilm[0];
$episode = $epsFilm['episode'];
$urlVideo = $epsFilm['url_video'];
$urlSubtitle = $epsFilm['url_subtitle'];
?>

<?php require 'templates/header.php' ?>
<?php require 'templates/nav.php' ?>


<div class="container-stream">
    <h2 class="title">Livestreaming</h2>
    <p class="sub-title"><?= $title ?>, episode <?= $episode ?></p>

    <?php if($useIndieServer): ?>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/qsfISQIZt9A" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    <?php else: ?>
        <video src="<?= $videoServerUrl . $title . "/" . $urlVideo ?>" type="video/mp4" class="streaming" controls poster="<?= $baseurl . $cover ?>">
            <track src="<?= $baseurl . $urlSubtitle; ?>" default />
        </video>
    <?php endif; ?>

    <?php require_once "templates/user/reaction-icon.php" ?>

    <div class="button-download">
        <div class="button">
            <a href="https://drive.google.com/file/d/1lP2KXRlgnlxqEH4yNVr-e3rhpPQBbj_G/view?usp=drive_link" download="<?= $title ?> episode <?= $eps ?>">Download</a>
        </div>
        <div class="button">
            <a href="<?= $baseurl . $urlSubtitle; ?>" download="<?= $title ?> episode <?= $eps ?>">Subtitle</a>
        </div>
    </div>

    <?php require_once "templates/user/comments.php" ?>

</div>

<?php require 'templates/footer.php' ?>