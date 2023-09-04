<?php 
session_start();

require "../config/config.php";
require "../controllers/film.php";
require_once "../controllers/dbs.php";

if(isset($_COOKIE['email']))
{
    $email = $_COOKIE['email'];
}

$data = file_get_contents("../data/film.json");
$film = json_decode($data, true);
$film = $film['film'];

$id = $_GET['id'];
?>

<?php $data = query("SELECT * FROM film WHERE id=$id");?>

<?php require_once 'templates/header.php' ?>
<?php require_once 'templates/nav.php' ?>


<?php foreach($data as $d): ?>
    <?php if($d['id'] == $id): ?>
        <div class="container-detail">
            <div class="content-detail">
                <div class="image">
                    <img src="<?= $baseurl . $d['cover'] ?>" alt="<?= $d['title'] ?>">
                </div>
                <div class="detail">
                    <ul>
                        <li><span class="list-detail">Title:</span> <?= $d['title'] ?></li>
                        <li><span class="list-detail">Episode:</span> <?= $d['episode'] ?></li>
                        <li><span class="list-detail">Film:</span> <?= $d['film'] ?></li>
                        <li><span class="list-detail">Type:</span> <?= $d['tipe'] ?></li>
                        <li><span class="list-detail">Aired:</span> <?= $d['aired'] ?></li>
                        <li><span class="list-detail">Series:</span> <?= $d['series'] ?></li>
                        <li><span class="list-detail">Franchise:</span> <?= $d['franchise'] ?></li>
                        <li><span class="list-detail">Created by:</span><br>
                            story: <?=$d['authors']; ?>.<br>
                            art: <?=$d['artists']; ?>.
                        </li>
                        <li><span class="list-detail">Studios:</span> <?= $d['studios'] ?></li>

                        <?php foreach($film as $f): ?>
                            <li><span class="list-detail">Seasonal:</span> <?= $f['general']['seasonal'] ?></li>
                            <li><span class="list-detail">Channel:</span> 
                                <?php foreach($f['special-indonesian']['channel'] as $channel): ?>
                                    <?= $channel ?>,
                                <?php endforeach; ?>
                            </li>
                            <li><span class="list-detail">Tahun:</span> 
                                <?php foreach($f['special-indonesian']['year'] as $year): ?>
                                    <?= $year ?>,
                                <?php endforeach; ?>
                            </li>
                            <li><span class="list-detail">Hari Tayang:</span> 
                                <?php foreach($f['special-indonesian']['day'] as $day): ?>
                                    <?= $day ?>,
                                <?php endforeach; ?>
                            </li>

                        <?php endforeach; ?>

                    </ul>
                </div>
                <div class="keterangan">
                    <h3>Keterangan</h3>

                </div>
            </div> <!-- end content -->
            <div class="episode">
                <ul>
                    <?php $title_id = $d['id'] ?>
                    <?php $eps = query("SELECT episode FROM episode_film WHERE title_id=$id"); ?>

                    <?php for ($i = 1; $i <= $d['episode']; $i++): ?>
                        <?php $episodeExists = false; ?>

                        <?php foreach ($eps as $e): ?>
                            <?php if ($e['episode'] == $i): ?>
                                <?php $episodeExists = true; ?>
                                <a href="<?= $baseurl ?>ui/stream.php?title=<?= $d['title'] ?>&eps=<?= $i ?>">
                                    <li>episode <?= $i ?></li>
                                </a>
                            <?php endif ?>
                        <?php endforeach ?>

                        <?php if (!$episodeExists): ?>
                            <a href="#" style="cursor: default;">
                                <li>episode <?= $i ?>
                                    <p class="ket-eps">Belum diupload</p>
                                </li>
                            </a>
                        <?php endif ?>

                    <?php endfor ?>
                </ul>
            </div>
        </div> <!-- end container -->
    <?php endif ?>
<?php endforeach; ?>


<?php require_once 'templates/footer.php' ?>