<?php 
session_start();

require "../../config/config.php";

if(isset($_COOKIE['email']))
{
    $email = $_COOKIE['email'];
}
?>

<?php require "../templates/header.php" ?>
<?php require "../templates/nav.php" ?>
   
<div class="container-login">

    <div class="login">
        <h2>Donasi</h2>
        <form action="http://localhost/2023/mei/kids90/controllers/support.php" method="post" class="box">
            <span>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required value="<?= isset($email) ? $email : '' ?>">
            </span>
            <span>
                <label for="nominal">Nominal (Rupiah)</label>
                <input type="number" name="nominal" id="nominal" required>
            </span>
            <span>
                <label for="name">Atas Nama</label>
                <input type="text" name="name" id="name" required>
            </span>
            <button type="submit" name="submit">Send</button>
        </form>
    </div>
</div>

<?php require "../templates/footer.php" ?>