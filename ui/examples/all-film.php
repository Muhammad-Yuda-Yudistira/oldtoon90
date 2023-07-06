<?php 
require_once "../../controllers/dbs.php";
require "../../config/config.php";

$apikey = "378b9493a5a17565ce43760046710356";
$year = 1997;
$url = "https://api.themoviedb.org/3/discover/tv?api_key=" . $apikey . "&first_air_date_year=" . $year;

if(isset($_GET['page']))
{
    $url = $url . "&page=" . $_GET['page'];
}

$result = file_get_contents($url);
?>

<?php if($result === false): ?>
    <?= "gagal mengambil data api."; exit(); ?>
<?php else: ?>
    <?php  
    $data = json_decode($result, true);
    $totalPages = $data['total_pages'];
    $page = $data['page'];
    $activePage = $data['page'];
    $data = $data['results']; 
    ?>

    <?php require "../templates/header.php" ?>
    <?php require "../templates/nav.php" ?>

    <div class="container">
        
        <div class="content" style="width: 80vw;">

            <div class="title">
                <h1>Daftar Film</h1>
            </div>

            <div class="box-film">

                <?php foreach($data as $film): ?>
                    <a href="http://localhost/2023/mei/kids90/ui/detail.php?id=<?= $film['id'] ?>">
                        <div class="card">
                            <div class="img">
                                <img src="https://image.tmdb.org/t/p/w400/<?= $film['poster_path'] ?>">
                            </div>
                            <ul class="card-fill">
                                <li><span class="list-title">Judul:</span> <?= $film['name'] ?></li>
                                <li><span class="list-title">Episode:</span>20</li>
                                <li><span class="list-title">Channel:</span> 
                                    tpi, antv
                                </li>
                                <li><span class="list-title">Tahun:</span> 
                                    <?= $film['first_air_date'] ?>
                                </li>
                            </ul>
                        </div>
                    </a>
                <?php endforeach; ?>

                <div class="pagination">
    
                    <a href="http://localhost/2023/mei/kids90/ui/examples/all-film.php?page=<?= $_GET['page'] - 1 ?>">
                        <span>&laquo;</span>
                    </a>
                    
                    <?php $page = 1 ?>
                    <?php for($i = 0; $i <= $totalPages; $i++): ?>
                        
                        <a href="http://localhost/2023/mei/kids90/ui/examples/all-film.php?page=<?= $page ?>" style="font-weight: <?= $page == $activePage ? 'bold' : ''; ?>">
                            <span class="page"><?= $page ?></span>
                        </a>
                        
                        <?php $page++; ?>
                    <?php endfor; ?>
    
                    <a href="http://localhost/2023/mei/kids90/ui/examples/all-film.php?page=<?= $_GET['page'] + 1 ?>">
                        <span>&raquo;</span>
                    </a>
                    
                </div>
            </div>
        </div>
        <?php require_once '../components/sidebar.php'; ?>

    </div>

    <?php require '../templates/footer.php'; ?>

<?php endif ?>