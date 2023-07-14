<?php 
session_start();
require "../../../config/config.php";
require "../../../controllers/film.php";

if(isset($_COOKIE['remember']))
{
    $_SESSION['admin'] = "admin";
}

$title = $_GET['title'];
$film = query("SELECT * FROM film WHERE title='$title'");
$film = $film[0];

$titleID = $film['id'];
$tayangLocal = query("SELECT * FROM tayang_local WHERE title_id=$titleID");
$tayangLocal = $tayangLocal[0];

$channels = explode(',', $tayangLocal['channel']);
$days = explode(',', $tayangLocal['hari']);
 
if(isset($_POST['add']))
{
    $fileName = uploadFilm($_FILES['cover']);

    $data['film'] = [
        "title" => $_POST['title'],
        "episode" => $_POST['episode'],
        "film" => $_POST['film'],
        "type" => $_POST['type'],
        "aired" => $_POST['aired'],
        "series" => $_POST['series'],
        "franchise" => $_POST['franchise'],
        "authors" => $_POST['authors'],
        "artists" => $_POST['artists'],
        "studios" => $_POST['studios'],
        "cover" => $fileName,
        "channel" => $_POST['channel'],
        "year" => $_POST['year'],
        "day" => $_POST['day']
    ];
    
    addFilm($data);

}
?>

<?php if($_SESSION['admin'] == "admin"): ?>
    <?php require "../templates/header-admin.php" ?>

    <div class="container-admin">

        <?php require_once "../templates/nav-admin.php"; ?>

        <main class="content-admin">
            <h2 class="title-admin">Edit film</h2>

            <ul class="add-film-form">
                <form action="" method="post" enctype="multipart/form-data">
                    <li>
                        <label for="title">title :</label>
                        <input type="text" name="title" id="title" value="<?= $film['title'] ?>">
                    </li>
                    <li>
                        <label for="episode">jumlah episode :</label>
                        <input type="number" name="episode" id="episode" value="<?= $film['episode'] ?>">
                    </li>
                    <fieldset class="group-input-film">
                        <legend>Jenis film :</legend>
                        <li class="radio-input">
                            <input type="radio" name="film" id="serial" value="serial" <?= $film['film'] == 'serial' ? 'checked' : '' ?>>
                            <label for="serial">serial</label>
    
                            <input type="radio" name="film" id="movie" value="movie" <?= $film['film'] == 'movie' ? 'checked' : '' ?>>
                            <label for="movie">movie</label>
                        </li>
                    </fieldset>
                    <fieldset class="group-input-film">
                        <legend>type film :</legend>
                        <li class="radio-input">
                            <input type="radio" name="type" id="cartoon" value="cartoon" <?= $film['type'] == 'cartoon' ? 'checked' : '' ?>>
                            <label for="cartoon">cartoon</label>
    
                            <input type="radio" name="type" id="anime" value="anime" <?= $film['type'] == 'anime' ? 'checked' : '' ?>>
                            <label for="anime">anime</label>
    
                            <input type="radio" name="type" id="real" value="real" <?= $film['type'] == 'real' ? 'checked' : '' ?>>
                            <label for="real">real</label>
                        </li>
                    </fieldset>
                    <li>
                        <label for="aired">aired :</label>
                        <input type="month" name="aired" id="aired">
                    </li>
                    <li>
                        <label for="series">series :</label>
                        <input type="number" name="series" id="series" value="<?= $film['series'] ?>">
                    </li>
                    <li>
                        <label for="franchise">franchise :</label>
                        <input type="text" name="franchise" id="franchise" value="<?= $film['franchise'] ?>">
                    </li>
                    <li>
                        <label for="authors">authors :</label>
                        <input type="text" name="authors" id="authors" value="<?= $film['authors'] ?>">
                    </li>
                    <li>
                        <label for="artists">artists :</label>
                        <input type="text" name="artists" id="artists" value="<?= $film['artists'] ?>">
                    </li>
                    <li>
                        <img src="" alt="" width="100" height="50">
                        <label for="studios">studios :</label>
                        <input type="text" name="studios" id="studios" value="<?= $film['studios'] ?>">
                    </li>
                    <li>
                        <label for="cover">cover :</label>
                        <input type="file" name="cover" id="cover" accept=".jpg, .jpeg, .jfif, webp">
                    </li>
                    <fieldset class="group-input-film">
                        <legend>channel local :</legend>
                        <li class="checkbox-input">
                            <input type="checkbox" name="channel[]" id="tpi" value="tpi" <?= in_array('tpi', $channels) ? 'checked' : ''; ?>>
                            <label for="tpi">tpi</label>
    
                            <input type="checkbox" name="channel[]" id="indosiar" value="indosiar" <?= in_array('indosiar', $channels) ? 'checked' : ''; ?>>
                            <label for="indosiar">indosiar</label>
    
                            <input type="checkbox" name="channel[]" id="antv" value="antv" <?= in_array('antv', $channels) ? 'checked' : ''; ?>>
                            <label for="antv">antv</label>
    
                            <input type="checkbox" name="channel[]" id="rcti" value="rcti" <?= in_array('rcti', $channels) ? 'checked' : ''; ?>>
                            <label for="rcti">rcti</label>
    
                            <input type="checkbox" name="channel[]" id="sctv" value="sctv" <?= in_array('sctv', $channels) ? 'checked' : ''; ?>>
                            <label for="sctv">sctv</label>
    
                            <input type="checkbox" name="channel[]" id="trans7" value="trans7" <?= in_array('trans7', $channels) ? 'checked' : ''; ?>>
                            <label for="trans7">trans7</label>
                        </li>
                    </fieldset>
                    <li>
                        <label for="year">year :</label>
                        <input type="number" name="year" id="year" maxlength="4" value="1945">
                    </li>
                    <fieldset class="group-input-film">
                        <legend>hari tayang di channel local :</legend>
                        <li class="checkbox-input">
                            <input type="checkbox" name="day[]" id="senin" value="senin" <?= in_array('senin', $days) ? 'checked' : ''; ?>>
                            <label for="senin">senin</label>
    
                            <input type="checkbox" name="day[]" id="selasa" value="selasa" <?= in_array('selasa', $days) ? 'checked' : ''; ?>>
                            <label for="selasa">selasa</label>
    
                            <input type="checkbox" name="day[]" id="rabu" value="rabu" <?= in_array('rabu', $days) ? 'checked' : ''; ?>>
                            <label for="rabu">rabu</label>
    
                            <input type="checkbox" name="day[]" id="kamis" value="kamis" <?= in_array('kamis', $days) ? 'checked' : ''; ?>>
                            <label for="kamis">kamis</label>
    
                            <input type="checkbox" name="day[]" id="jumat" value="jumat" <?= in_array('jumat', $days) ? 'checked' : ''; ?>>
                            <label for="jumat">jumat</label>
    
                            <input type="checkbox" name="day[]" id="sabtu" value="sabtu" <?= in_array('sabtu', $days) ? 'checked' : ''; ?>>
                            <label for="sabtu">sabtu</label>
    
                            <input type="checkbox" name="day[]" id="minggu" value="minggu" <?= in_array('minggu', $days) ? 'checked' : ''; ?>>
                            <label for="minggu">minggu</label>
                        </li>
                    </fieldset>
                    <button type="submit" name="add" class="film-button">add film</button>
                </form>
            </ul>
            
        </main>
    </div>

    <?php require "../../templates/footer.php" ?>

<?php else: ?>

    <?php header("Location: $baseurl/ui/user/login.php"); ?>
    
<?php endif; ?>