<?php 
session_start();
require_once "../../config/config.php";
require_once "../../controllers/dbs.php";

if(isset($_COOKIE['remember']) && $_COOKIE['key'] == hash('sha256', $_SESSION['email']))
{
    $email = $_SESSION['email'];

    $_SESSION['admin'] = "admin";
    $admin = $_SESSION['admin'];
}

$film = query("SELECT * FROM film");
?>

<?php if($_SESSION['admin'] == "admin"): ?>

    <?php 
        require "./../../controllers/film.php";
    ?>

    <?php require "templates/header-admin.php" ?>

    <div class="container-admin">

        <?php require_once "templates/nav-admin.php"; ?>

        <main class="content-admin">
            <h2 class="title-admin">Daftar Film</h2>

            <a href="contents/film.php" class="btn">
                Add film
            </a>

            <table border="1" cellspacing="0" class="list-film">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Film</th>
                    <th>Action</th>
                </tr>
                <?php foreach($film as $f): ?>
                    <tr>
                        <td><?= $f['id'] ?></td>
                        <td><?= $f['title'] ?></td>
                        <td><?= $f['film'] ?></td>
                        <td>
                            <a href="<?= $baseurl ?>ui/user/contents/episode.php?title=<?= $f['title']; ?>" class="btn-admin">Add</a>
                            <a href="#" class="btn-admin" style="text-decoration: red 3px line-through;">Edit</a>
                            <a href="#" class="btn-admin" style="text-decoration: red 3px line-through;">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </main>
    </div>

    <?php require "../templates/footer.php" ?>

<?php else: ?>

    <?php header("Location:login.php"); ?>
    
<?php endif; ?>