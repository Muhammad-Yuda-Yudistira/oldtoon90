<nav class="navbar navbar-expand-lg bg-danger">
  <div class="container justify-content-between">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= $baseurl ?>ui/home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= $baseurl ?>ui/user/main.php">Film</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true" href="<?= $baseurl ?>ui/fanart/image.php" >Image</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true" href="<?= $baseurl ?>ui/fanart/comic.php" >Comic</a>
        </li>
      </ul>
    </div>

    <div class="collapse navbar-collapse" id="navbarNav">
        <?php if (!isset($_SESSION['login'])) :?>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?= $baseurl ?>ui/user/login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= $baseurl ?>ui/user/signup.php">Signup</a>
            </li>
        </ul>
        <?php endif; ?>

        <?php if (isset($_SESSION['login'])) :?>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?= $baseurl ?>ui/user/logout.php">Logout</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= $baseurl ?>ui/user/signup.php">
                <img src="<?= $baseurl ?>images/users/blank-profile.webp" title="<?= $_SESSION['username'] ?>" class="img-fluid img-thumbnail rounded-circle" width="30">
              </a>
            </li>
        </ul>
        <?php endif; ?>
    </div>
  </div>
</nav>
