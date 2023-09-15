<?php 
session_start();
date_default_timezone_set('Asia/Jakarta');

require "../../config/config.php";
require "../../controllers/film.php";

$nameMenu = 'Film';

$film = file_get_contents("../../data/film.json");
$film = json_decode($film, true);
$data = query("SELECT * FROM film");

$page = 1;
$totalPages = 1;

if(isset($_COOKIE['remember'])) 
{
    $allUser = query("SELECT * FROM user");

    foreach($allUser as $user)
    {
        $key = hash('sha256', $user['email'] . $user['password']);
        $key2 = hash('sha256', $user['username'] . $user['password']);

        if($key == $_COOKIE['key'] || $key2 == $_COOKIE['key'])
        {
            $_SESSION['login'] = true;
            $_SESSION['role'] = $user['role'];
            $_SESSION['key'] = $_COOKIE['key'];
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
        }

    }
}
?>

<?php include "../templates/header.php" ?>
<?php include "../templates/nav.php" ?>

  <div id="film" class="film">
    <div class="container mycontainer">
      <div class="row text-center">
        <div class="col">
          <h1>Daftar Film</h1>
        </div>
      </div>
      <div class="row justify-content-end">
        <div class="col">
          <ul>
          <?php foreach($data as $d): ?>
          <div class="row">
            <div class="col-md-3">
                      
              <?php $id = $d['id'] ?>
              <?php $localInfo = query("SELECT * FROM tayang_local WHERE title_id=$id"); ?>
  
              <li>
                <a href="<?= $baseurl; ?>ui/detail.php?id=<?= $id ?>">
                  <div class="card" style="width: 18rem;">
                    <img src="<?= $baseurl . $d['cover'] ?>" class="card-img-top" alt="<?= $baseurl . $d['title'] ?>">
                    <div class="card-img-overlay">
                    <p class="card-text"><small><?= $d['episode'] ?></small></p>
                  </div>
                    <div class="card-body">
                        <p class="card-text"><?= $d['title'] ?></p>
                        <p class="card-text"><?= $localInfo[0]['channel'] ?></p>
                        <p class="card-text"><?= $localInfo[0]['tahun'] ?></p>
                    </div>
                  </div>
                </a>
              </li>
    
            </div>
          </div>
          <?php endforeach; ?>
          </ul>
        </div>
      </div>

      <div class="content" style="width: 80vw;">

          <div class="title">
              <h1>Daftar Film</h1>
          </div>
          
          <div class="box-film">

              <?php foreach($data as $d): ?>
                  
                  <?php $id = $d['id'] ?>
                  <?php $localInfo = query("SELECT * FROM tayang_local WHERE title_id=$id"); ?>

                  <a href="<?= $baseurl; ?>ui/detail.php?id=<?= $id ?>">
                      <div class="card">
                          <div class="img">
                              <img src="<?= $baseurl . $d['cover'] ?>">
                          </div>
                          <ul class="card-fill">
                              <li><span class="list-title">Judul:</span> <?= $d['title'] ?></li>
                              <li><span class="list-title">Episode:</span> <?= $d['episode'] ?></li>
                              <li><span class="list-title">Channel:</span> 
                                  <?= $localInfo[0]['channel'] ?>,
                              </li>
                              <li><span class="list-title">Tahun:</span> 
                                  <?= $localInfo[0]['tahun'] ?>,
                              </li>
                          </ul>
                      </div>
                  </a>

              <?php endforeach; ?>
          </div>
          <div class="pagination">

              <?php if($totalPages > 1): ?>
                  <a href="">
                      <span>&laquo;</span>
                  </a>
              
                  <?php 
                  if(isset($_GET['page']))
                  {
                      $activePage = $_GET['page'];
                  }
                  else
                  {
                      $activePage = 1;
                  }
                  ?>
                  <?php for($i = 0; $i < $totalPages; $i++): ?>
                      
                      <a href="<?= $baseurl; ?>ui/user/main.php?page=<?= $page ?>" style="font-weight: <?= $page == $activePage ? 'bold' : ''; ?>">
                          <span class="page"><?= $page ?></span>
                      </a>
                      
                      <?php $page++; ?>
                  <?php endfor; ?>

                  <a href="">
                      <span>&raquo;</span>
                  </a>
              <?php endif ?>
              
          </div>
      </div>

      <?php require_once '../components/sidebar.php'; ?>

    </div>
  </div>

    <?php require '../templates/footer.php'; ?>