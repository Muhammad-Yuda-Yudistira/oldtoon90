<?php require "../../config/config.php"; ?>

<?php require_once "../templates/header.php" ?>
<?php require_once "../templates/nav.php" ?>

<div class="container">
    <section>
        <h2 class="title">
            judul image
        </h2>

        <div class="content content-image">
            <div class="image-detail">
                <img src="https://source.unsplash.com/random/400x200" alt="" class="img-fluid">
            </div>

            <?php require_once "../templates/user/reaction-icon-fanart.php" ?>

        </div>
    </section>

    <?php require_once "../templates/user/comments.php" ?>
    
</div>

<?php require_once "../templates/footer.php" ?>