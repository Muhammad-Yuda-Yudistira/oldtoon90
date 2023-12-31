<?php 
session_start();
require_once "../../config/config.php";
require_once "../../controllers/dbs.php";

if(isset($_COOKIE['remember']))
{
    $allUser = query("SELECT * FROM user");
    foreach($allUser as $user)
    {
        $key = hash('sha256', $user['email'] . $user['password']);
        $key2 = hash('sha256', $user['username'] . $user['password']);

        if($_COOKIE['key'] == $key || $_COOKIE['key'] == $key2)
        {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = 'admin';
        }
    }
}

$film = query("SELECT * FROM film");
?>

<?php if($_SESSION['role'] == "admin"): ?>

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