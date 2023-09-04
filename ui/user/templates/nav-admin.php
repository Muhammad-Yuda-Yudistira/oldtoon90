<?php $email = $_SESSION['username'] ?>

<header class="menu-admin">
    <h3><?= $email ?></h3>
    <ul>
        <nav class="nav-menu">
            <h4 class="menu-category">Original</h4>
            <li class="menu-item">
                <a href="<?= $baseurl ?>ui/user/admin.php">Film</a>
            </li>
            <h4 class="menu-category">Fanart</h4>
            <li class="menu-item empty">
                <a href="<?= $baseurl ?>ui/user/contents/image.php">image</a>
            </li>
            <li class="menu-item empty">
                <a href="<?= $baseurl ?>ui/user/contents/comic.php">comic</a>
            </li>
            <h4 class="menu-category">admin</h4>
            <li class="menu-item">
                <a href="<?= $baseurl ?>ui/user/logout.php">Logout</a>
            </li>
        </nav>
    </ul>
</header>