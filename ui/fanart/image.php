<?php session_start() ?>

<?php require "../../config/config.php"; ?>

<?php require_once "../templates/header.php" ?>
<?php require_once "../templates/nav.php" ?>

<div class="container">
    <section>

        <div class="title">
            <h1 class="main-title">image</h1>
            <p class="sub-title">fanart image</p>
            <?php if(isset($_SESSION['message'])): ?>
                <span class="alert"><?= $_SESSION['message']; ?></span>
            <?php endif; ?>
        </div>
        <div class="content">
            <div class="image">
                <a href="<?= $baseurl ?>ui/fanart/img-detail.php">
                    <img src="<?= $baseurl ?>fanart/images/1.jpg" alt="">
                </a>
            </div>
            <div class="image">
                <a href="<?= $baseurl ?>ui/fanart/img-detail.php">
                    <img src="<?= $baseurl ?>fanart/images/2.jpg" alt="">
                </a>
            </div>
            <div class="image">
                <a href="<?= $baseurl ?>ui/fanart/img-detail.php">
                    <img src="<?= $baseurl ?>fanart/images/3.jpeg" alt="">
                </a>
            </div>
            <div class="image">
                <a href="<?= $baseurl ?>ui/fanart/img-detail.php">
                    <img src="<?= $baseurl ?>fanart/images/4.jpg" alt="">
                </a>
            </div>
            <div class="image">
                <a href="<?= $baseurl ?>ui/fanart/img-detail.php">
                    <img src="<?= $baseurl ?>fanart/images/5.jpg" alt="">
                </a>
            </div>
            <div class="image">
                <a href="<?= $baseurl ?>ui/fanart/img-detail.php">
                    <img src="<?= $baseurl ?>fanart/images/6.jpg" alt="">
                </a>
            </div>
            <div class="image">
                <a href="<?= $baseurl ?>ui/fanart/img-detail.php">
                    <img src="<?= $baseurl ?>fanart/images/7.jfif" alt="">
                </a>
            </div>
            <div class="image">
                <a href="<?= $baseurl ?>ui/fanart/img-detail.php">
                    <img src="<?= $baseurl ?>fanart/images/8.jfif" alt="">
                </a>
            </div>
            
        </div>
    </section>
</div>

<?php require_once "../templates/footer.php" ?>