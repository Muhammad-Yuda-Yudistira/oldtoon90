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
                    <th>No</th>
                    <th>Title</th>
                    <th>Film</th>
                    <th>Film Action</th>
                    <th>Episode Action</th>
                </tr>
                <?php $i = 1; ?>
                <?php foreach($film as $f): ?>
                    <tr>
                        <th><?= $i++ ?></th>
                        <td>
                            <a href="<?= $baseurl . 'ui\admin\film\view.php?title=' . $f['title'] ?>"><?= $f['title'] ?></a>
                        </td>
                        <td><?= $f['film'] ?></td>
                        <td>
                            <a href="<?= $baseurl ?>ui/user/contents/update-film.php?title=<?= $f['title']; ?>" class="btn-admin" id="edit" style="">Edit</a>
                            <a href="<?= $baseurl ?>controllers/film/delete-film.php?title=<?= $f['title']; ?>" class="btn-admin" id="delete" onclick="return confirm('Anda yakin ingin menghapus film ini?')">Delete</a>
                        </td>
                        <td>
                            <a href="<?= $baseurl ?>ui/admin/film/addEpsFilm.php?title=<?= $f['title']; ?>" class="btn-admin" id="add">Add</a>
                            <a href="<?= $baseurl ?>ui\admin\film\edit.php?title=<?= $f['title']; ?>" class="btn-admin" id="edit">Edit</a>
                            <a href="<?= $baseurl ?>ui\admin\film\delete.php?title=<?= $f['title']; ?>" class="btn-admin" id="delete">Delete</a>
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