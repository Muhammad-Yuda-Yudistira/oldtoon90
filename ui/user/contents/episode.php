<?php 
session_start();
require "../../../config/config.php";
require "../../../controllers/dbs.php";
require "../../../controllers/film.php";

$admin = $_SESSION['admin'];
$email = $_SESSION['email'];

$title = $_GET['title'];


$film = query("SELECT id, title, episode FROM film WHERE title='$title'");
$titleId = $film[0]['id'];
$eps = query("SELECT episode FROM episode_film WHERE title_id=$titleId");
// foreach($eps as $e)
// {
//     var_dump($e);
// }
// die;
?>

<?php if($admin == "admin"): ?>

<?php 
if(isset($_POST["upload"]))
{
    $data = $_FILES;
    $epsData = [
        'name' => $_POST["name"],
        'episode' => $_POST["episode"]
    ];

    $fileName = uploadEpisode($title, $data);
    addEpisode($fileName, $title, $epsData);
}
?>

<?php if(isset($_GET['title'])): ?>
    <?php require_once "../templates/header-admin.php"; ?>

    <?php require_once "../templates/nav-admin.php"; ?>

        <?php if($film[0]['title'] == $_GET['title']): ?>

            <main class="content-admin upload">
                <h2 class="title-admin"><?= $film[0]['title'] ?></h2>
                <hr>
                <form action="" method="post" enctype="multipart/form-data">
                    <ul class="episode-input">
                        <li>
                            <input type="hidden" name="titleID" value="title id">
                        </li>
                        <li>
                            <label for="name">name :</label><br>
                            <input type="text" name="name" id="name" required>
                        </li>
                        <li>
                            <label for="episode">Episode :</label><br>
                            <select name="episode" id="episode" required>

                            <?php for($i=1; $i <= $film[0]['episode']; $i++): ?>

                                <?php $episodeFound = false; ?>
                                <?php foreach($eps as $e): ?>

                                    <?php if($e['episode'] == $i): ?>
                                        <?php $episodeFound = true; ?>
                                        <?php break; ?>
                                    <?php endif; ?>

                                <?php endforeach; ?>
                                <?php if(!$episodeFound): ?>
                                    <option value="<?= $i ?>">episode <?= $i ?></option>
                                <?php endif; ?>

                            <?php endfor; ?>


                            </select>
                        </li>
                        <li>
                            <label for="video">Video :</label><br>
                            <input type="file" name="video" id="video" accept=".mp4, .webm" required><br>
                            <span class="ket">Support of Format: mp4, webm</span><br>
                        </li>
                        <li>
                            <label for="subtitle">Subtitle :</label><br>
                            <input type="file" name="subtitle" id="subtitle" accept=".vtt, .srt"><br>
                            <span class="ket">Support of Format: vtt</span><br>
                        </li>
                        <button type="submit" name="upload">Upload</button>
                    </ul>
                </form>
            </main>
        
        <?php endif; ?>

    <?php require_once "../../templates/footer.php"; ?>
<?php endif; ?>

<?php else: ?>

    <?php header("Location:http://localhost/2023/mei/kids90/ui/user/login.php"); ?>

<?php endif; ?> //end session