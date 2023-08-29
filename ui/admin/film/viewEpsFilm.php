<?php session_start() ?>
<?php require __DIR__ . "/../../../config/config.php"; ?>
<?php require __DIR__ . "/../../../controllers/film/filmController.php" ?>
<?php require __DIR__ . "/../../../controllers/film/episodeController.php" ?>

<?php
$title = $_GET['title'];

$film = film($title);
$episodes = filmEpisode($title);

if(isset($_POST['del'])) 
{
    deleteFiles($_POST, $title); 
    delDataEpsFilm($_GET['id']);
}

if(isset($_COOKIE['message']))
{
    $message = 'Data deleted succesfully!';
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

            <?php if(isset($message) and isset($_COOKIE['message'])): ?>
                <span class="alert"><?= $message ?></span>
            <?php endif; ?>

                <table class="list-eps">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Episode</th>
                        <th>Action</th>
                    </tr>

                    <?php 
                    $i = 1;
                    foreach($episodes as $eps):?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $eps['nama'] ?></td>
                            <td><?= $eps['episode'] ?></td>
                            <form action="?title=<?= $title ?>&id=<?= $eps['id'] ?>" method="post">
                                <input type="hidden" name="video" value="<?= $eps['url_video'] ?>">
                                <input type="hidden" name="subtitle" value="<?= $eps['url_subtitle'] ?>">
                                <td>
                                    <button type="submit" class="btn-admin" id="delete" name="del">Delete</button>
                                </td>
                            </form>
                        </tr>
                    <?php 
                    $i++;
                    endforeach ?>

                </table>
            </div>

        </ul>
    </div>
</div>

<?php include __DIR__ . "/../../../ui/templates/footer.php"; ?>