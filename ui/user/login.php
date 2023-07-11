<?php 
session_start(); 

require "../../config/config.php";
require_once "../../controllers/dbs.php";
require_once "../../controllers/administration/loginController.php";


if(isset($_SESSION['admin'])) 
{
    header("Location:admin.php");
}

if(isset($_POST['submit'])) 
{
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $result = login($email, $password);

    if($result == "admin")
    {
        header("Location:admin.php");
        exit;
    }
    else if($result == "user")
    {
        header("Location:main.php");
        die;
    }
    else
    {
        $gagal = true;
        $alert = "email haven't signup, please signup!";
    }
}
?>

<?php require "../templates/header.php" ?>
<?php require "../templates/nav.php" ?>
   
<div class="container-login">
    
    <?php if(isset($gagal)): ?>
        <span style="color:red"><?= $alert ?></span>
    <?php endif; ?>

    <div class="login">
        <h2>Login</h2>
        <form action="" method="post" class="box">
            <span>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required value="<?= isset($email)? $email : ''; ?>">
            </span>
            <span>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </span>
            <span class="remember">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me</label>
            </span>
            <button type="submit" name="submit">Login</button>
        </form>
    </div>

    <div class="demo">
        <a href="<?= $baseurl ?>ui/examples/all-film.php?page=1">demo</a>
    </div>
</div>

<?php require "../templates/footer.php" ?>