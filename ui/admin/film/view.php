<?php session_start() ?>
<?php require __DIR__ . "/../../../config/config.php"; ?>
<?php require __DIR__ . "/../../../controllers/film/filmController.php" ?>

<?php
$film = film($_GET['title']);
?>



<?php include __DIR__ . "/../../../ui/user/templates/header-admin.php"; ?>
<?php include __DIR__ . "/../../../ui/user/templates/nav-admin.php"; ?>

<div class="container-admin middle-box">
    <div class="content-admin">
        <ul class="film-status">
            <li><img src="<?= $baseurl . $film['cover'] ?>" alt=""></li><hr>
            <li><span>title: </span><?= $film['title'] ?></li><hr>
            <li><span>episodes: </span><?= $film['jumlah_episode'] ?> / <?= $film['episode'] ?></li><hr>
            <li><span>film: </span><?= $film['film'] ?></li><hr>
            <li><span>type: </span><?= $film['tipe'] ?></li><hr>
            <li><span>aired: </span><?= $film['aired'] ?></li><hr>
            <li><span>series: </span><?= $film['series'] ?></li><hr>
            <li><span>franchise: </span><?= $film['franchise'] ?></li><hr>
            <li><span>authors: </span><?= $film['authors'] ?></li><hr>
            <li><span>artists: </span><?= $film['artists'] ?></li><hr>
            <li><span>studios: </span><?= $film['studios'] ?></li><hr class="end-line">
            <li><span>channel: </span><?= $film['channel'] ?></li><hr>
            <li><span>tahun: </span><?= $film['tahun'] ?></li><hr>
            <li><span>hari: </span><?= $film['hari'] ?></li><hr>
        </ul>
    </div>
</div>

<?php include __DIR__ . "/../../../ui/templates/footer.php"; ?>