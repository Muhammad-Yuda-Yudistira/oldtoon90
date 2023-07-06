<?php 
session_start();
require "../../../config/config.php";
require "../../../controllers/film.php";

if(isset($_COOKIE['remember']))
{
    $email = $_SESSION['email'];
    $_SESSION['admin'] = "admin";
}
 
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
            <h2 class="title-admin">Tambah film baru</h2>

            <ul class="add-film-form">
                <form action="" method="post" enctype="multipart/form-data">
                    <li>
                        <label for="title">title :</label>
                        <input type="text" name="title" id="title">
                    </li>
                    <li>
                        <label for="episode">jumlah episode :</label>
                        <input type="number" name="episode" id="episode">
                    </li>
                    <li class="radio-input">
                        <input type="radio" name="film" id="serial" value="serial">
                        <label for="serial">serial</label>

                        <input type="radio" name="film" id="movie" value="movie">
                        <label for="movie">movie</label>
                    </li>
                    <li class="radio-input">
                        <input type="radio" name="type" id="cartoon" value="cartoon">
                        <label for="cartoon">cartoon</label>

                        <input type="radio" name="type" id="anime" value="anime">
                        <label for="anime">anime</label>

                        <input type="radio" name="type" id="real" value="real">
                        <label for="real">real</label>
                    </li>
                    <li>
                        <label for="aired">aired :</label>
                        <input type="month" name="aired" id="aired">
                    </li>
                    <li>
                        <label for="series">series :</label>
                        <input type="number" name="series" id="series">
                    </li>
                    <li>
                        <label for="franchise">franchise :</label>
                        <input type="text" name="franchise" id="franchise">
                    </li>
                    <li>
                        <label for="authors">authors :</label>
                        <input type="text" name="authors" id="authors">
                    </li>
                    <li>
                        <label for="artists">artists :</label>
                        <input type="text" name="artists" id="artists">
                    </li>
                    <li>
                        <label for="studios">studios :</label>
                        <input type="text" name="studios" id="studios">
                    </li>
                    <li>
                        <label for="cover">cover :</label>
                        <input type="file" name="cover" id="cover" accept=".jpg, .jpeg, .jfif, webp">
                    </li>
                    <li class="checkbox-input">
                        <input type="checkbox" name="channel[]" id="tpi" value="tpi">
                        <label for="tpi">tpi</label>

                        <input type="checkbox" name="channel[]" id="indosiar" value="indosiar">
                        <label for="indosiar">indosiar</label>

                        <input type="checkbox" name="channel[]" id="antv" value="antv">
                        <label for="antv">antv</label>

                        <input type="checkbox" name="channel[]" id="rcti" value="rcti">
                        <label for="rcti">rcti</label>

                        <input type="checkbox" name="channel[]" id="sctv" value="sctv">
                        <label for="sctv">sctv</label>

                        <input type="checkbox" name="channel[]" id="trans7" value="trans7">
                        <label for="trans7">trans7</label>
                    </li>
                    <li>
                        <label for="year">year :</label>
                        <input type="number" name="year" id="year" maxlength="4" value="1945">
                    </li>
                    <li class="checkbox-input">
                        <input type="checkbox" name="day[]" id="senin" value="senin">
                        <label for="senin">senin</label>

                        <input type="checkbox" name="day[]" id="selasa" value="selasa">
                        <label for="selasa">selasa</label>

                        <input type="checkbox" name="day[]" id="rabu" value="rabu">
                        <label for="rabu">rabu</label>

                        <input type="checkbox" name="day[]" id="kamis" value="kamis">
                        <label for="kamis">kamis</label>

                        <input type="checkbox" name="day[]" id="jumat" value="jumat">
                        <label for="jumat">jumat</label>

                        <input type="checkbox" name="day[]" id="sabtu" value="sabtu">
                        <label for="sabtu">sabtu</label>

                        <input type="checkbox" name="day[]" id="minggu" value="minggu">
                        <label for="minggu">minggu</label>
                    </li>
                    <button type="submit" name="add">add film</button>
                </form>
            </ul>
            
        </main>
    </div>

    <?php require "../../templates/footer.php" ?>

<?php else: ?>

    <?php header("Location: $baseurl/ui/user/login.php"); ?>
    
<?php endif; ?>