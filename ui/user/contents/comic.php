<?php 
session_start();
// $email = $_SESSION['email'];
$admin = $_SESSION['admin'];
?>

<?php require_once "../../../controllers/fanart.php"; ?>

<?php 
if(isset($_POST['upload']))
{
    $folder = 'comics/';
    $alert = addFanart($_POST, $_FILES['comic'], $folder);
    if($alert)
    {
        $_SESSION['message'] = "berhasil diupload!";
        header("Location:http://localhost/2023/mei/kids90/ui/fanart/komik.php");
    }
}
?>

<?php if($admin): ?>

    <?php require_once "../templates/header-admin.php" ?>

    <?php require_once "../templates/nav-admin.php" ?>

    <div class="content-admin upload">
        <h2 class="title">upload strip komik baru</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <ul class="list-form">
                <li>
                    <label for="title">title : </label>
                    <input type="text" name="title" id="title">
                    <span class="ket">describe your comic</span>
                </li>
                <li>
                    <label for="fanart">fanart :</label>
                    <input type="text" name="fanart" id="fanart">
                    <span class="ket">what's fanart you had drew? explain: naruto, ironman</span>
                </li>
                <li>
                    <label for="comic">comic : </label>
                    <input type="file" name="comic" id="comic">
                    <span class="ket">your comic!</span>
                </li>
                <input type="submit" value="upload" name="upload">
            </ul>
        </form>
    </div>

    <?php require_once "../../templates/footer.php" ?>

<?php else: ?>

    <?php header("Location:http://localhost/2023/mei/kids90/ui/user/login.php"); ?>

<?php endif; ?>