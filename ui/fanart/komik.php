<?php session_start() ?>

<?php require "../../config/config.php"; ?>

<?php $nameMenu = 'Comic'; ?>

<?php include '../templates/header.php' ?>
<?php include '../templates/nav.php' ?>

<div class="container">
    <div class="title">
        <h1 class="main-title">strip comic</h1>
        <p class="sub-title">comics fanart</p>

        <?php if(isset($_SESSION['message'])): ?>
            <span class="alert"><?= $_SESSION['message'] ?></span>
        <?php endif ?>
        
    </div>

    <div class="content">
        <div class="comic">
            <img src="http://localhost/2023/mei/kids90/fanart/comics/1.webp" alt="">
        </div>
    </div>

    <?php require_once "../templates/user/reaction-icon-fanart.php" ?>
    
    <?php require_once "../templates/user/comments.php" ?>
    
</div>

<?php require_once '../templates/footer.php' ?>