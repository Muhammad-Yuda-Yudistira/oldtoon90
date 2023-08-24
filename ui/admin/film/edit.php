<?php session_start() ?>
<?php require __DIR__ . "/../../../config/config.php"; ?>
<?php require __DIR__ . "/../../../controllers/film/filmController.php" ?>
<?php require __DIR__ . "/../../../controllers/film/episodeController.php" ?>

<?php
$title = $_GET['title'];

$film = film($title);
$episodes = filmEpisode($title);

if(isset($_POST['update'])) 
{
    $oldNameFiles = [
        'oldVideo' => $_POST['old_video'],
        'oldSubtitle' => $_POST['old_subtitle']
    ];

    $nameFiles = updateFile($_FILES, $_GET['title'], $oldNameFiles);
    updateEpsFilm($_POST, $nameFiles);
}
?>



<?php include __DIR__ . "/../../../ui/user/templates/header-admin.php"; ?>
<?php include __DIR__ . "/../../../ui/user/templates/nav-admin.php"; ?>

<div class="container-admin">
    <div class="content-admin edit-container">
        <ul class="film-status edit-status">
            <div class="box-general">
                <li class="head-title"><?= $film['title'] ?> (<?= $film['aired'] ?>)<hr></li>
                <li><img src="<?= $baseurl . $film['cover'] ?>" alt=""></li>
                <img src="<?= $baseurl ?>images/Splash.png" alt="Spalsh 3D" width="400">
            </div>

            <div class="box-specific">
                <?php foreach($episodes as $eps): ?>
                    <form action="" method="post" enctype="multipart/form-data" class="status-eps">
                        <li>
                            <input type="hidden" value="<?= $eps['nama'] ?>" name="old_name">
                        </li>
                        <li>
                            <label for="name">Name: </label>
                            <input type="text" value="<?= $eps['nama'] ?>" name="name">
                        </li>
                        <li>
                            <label for="episode">Episode: </label>
                            <input type="text" value="<?= $eps['episode'] ?>" name="episode">
                        </li>
                        <li>
                            <label for="video">Video: </label>
                            <input type="file" name="video" id="video" accept=".mp4, .webm">

                            <input type="hidden" name="old_video" value="<?= $eps['url_video'] ?>" id="video">
                            <p>Existing Video: <?= $eps['url_video'] ?></p>
                        </li>
                        <li>
                            <label for="subtitle">Subtitle: </label>
                            <input type="file" name="subtitle" id="subtitle" accept=".vtt, .srt">

                            <input type="hidden" name="old_subtitle" value="<?= $eps['url_subtitle'] ?>" id="subtitle">
                            <p>Existing subtitle: <?= $eps['url_subtitle'] ?></p>
                        </li>
                        <li>
                            <p class="date"><?= $eps['launched_at'] ?></p>
                        </li>
                        <button type="submit" name="update" class="btn-eps">Update</button>
                        <hr>
                    </form>
                    <?php endforeach ?>
            </div>

        </ul>
    </div>
</div>

<?php include __DIR__ . "/../../../ui/templates/footer.php"; ?>