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

<div class="container">
    <h3 class="title" style="margin-top: 50px;">credit</h3>
    <dl class="credit-list" style="color:#222">
        <dt style="font-weight:bold">muhammad yuda yudistira</dt>
        <dd>as <span style="color:#555">fullstack developer</span></dd>
    </dl>
</div>

<?php require "../templates/footer.php" ?>