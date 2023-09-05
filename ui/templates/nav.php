<nav class="navbar navbar-expand-md bg-body-tertiary fixed-top mynavbar">
  <div class="container">
    <a class="navbar-brand" href="#">Oldtoon90</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Oldtoon90</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-start flex-grow-1 pe-3 mynav-main">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= $baseurl ?>ui/home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="<?= $baseurl ?>ui/user/main.php">Film</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true" href="<?= $baseurl ?>ui/fanart/image.php" >Image</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true" href="<?= $baseurl ?>ui/fanart/komik.php" >Comic</a>
          </li>
        </ul>

        <?php if (!isset($_SESSION['login'])) :?>
          <ul class="navbar-nav ms-auto mynav-sec">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?= $baseurl ?>ui/user/login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= $baseurl ?>ui/user/signup.php">Signup</a>
            </li>
        </ul>
        <?php endif; ?>

        <?php if (isset($_SESSION['login'])) :?>
          <ul class="navbar-nav ms-auto">
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
  </div>
</nav>