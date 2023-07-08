<?php 
session_start();

require_once "../../config/config.php";
require_once "../../controllers/dbs.php";
require_once "../../controllers/administration/signupController.php";

if(isset($_SESSION['admin'])) 
{
    header("Location:admin.php");
}

if(isset($_POST['submit'])) 
{
    $data = [
        "username" => $_POST['username'],
        "email" => $_POST['email'],
        "password" => $_POST['password'],
        "password2" => $_POST['password2'],
    ];

    $alert = signup($data);

    if($alert == "success")
    {
        $_SESSION['success'] = $alert;
        header("Location: $baseurl");
        exit();
    }
    
}
?>

<?php require "../templates/header.php" ?>
<?php require "../templates/nav.php" ?>
   
<div class="container-login">

    <div class="login">
        <h2>signup</h2>
        <form action="" method="post" class="box">
            <span>
                <label for="username">Username</label>
                <input type="username" name="username" id="username" required value="<?= isset($_SESSION['username'])? $_SESSION['username'] : ''; ?>">

                <?php if(isset($alert) && $alert == "username"): ?>
                    <span class="alert-input">username has been used!</span>
                <?php endif; ?>
            </span>
            <span>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required value="<?= isset($_SESSION['email'])? $_SESSION['email'] : ''; ?>">

                <?php if(isset($alert) && $alert == "email"): ?>
                    <span class="alert-input">email has been registered!</span>
                <?php endif; ?>
            </span>
            <span>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </span>
            <span>
                <label for="password2">Repeat Password</label>
                <input type="password" name="password2" id="password2" required>

                <?php if(isset($alert) && $alert == "password"): ?>
                    <span class="alert-input">password hasn't matched!</span>
                <?php endif; ?>
            </span>
            <button type="submit" name="submit">signup</button>
        </form>
    </div>
</div>

<?php require "../templates/footer.php" ?>