<nav class="nav-main">
    <ul>
        <div class="logo">
            <a href="<?= $baseurl ?>ui/home.php">
                <li>Home</li>
            </a>
        </div>
        <div class="menu">
            <a href="<?= $baseurl ?>ui/user/main.php">
                <li>Film</li>
            </a>
            <a href="<?= $baseurl ?>ui/fanart/image.php">
                <li>Image</li>
            </a>
            <a href="<?= $baseurl ?>ui/fanart/komik.php">
                <li>Komik</li>
            </a>
        </div>
        <div class="daftar">
            <?php if(!isset($_SESSION['login'])): ?>
                <a href="<?= $baseurl ?>ui/user/login.php">
                    <li>Login</li>
                </a>
                <a href="<?= $baseurl ?>ui/user/signup.php">
                    <li>Sign Up</li>
                </a>
            <?php endif; ?>

            <?php if(isset($_SESSION['login'])): ?>

                <a href="<?= $baseurl ?>ui/user/logout.php">
                    <li>logout</li>
                </a>

                <a href="" class="box-profile">
                    <li class="profile">
                        <img src="<?= $baseurl ?>users/blank-profile.webp">
                    </li>
                </a>

            <?php endif; ?>

        </div>
    </ul>
</nav>