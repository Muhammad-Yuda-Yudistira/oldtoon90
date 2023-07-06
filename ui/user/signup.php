<?php 
session_start();

require_once "../../config/config.php";
require_once "../../controllers/dbs.php";

$users = query("SELECT * FROM user");

if(isset($_SESSION['admin'])) 
{
    header("Location:admin.php");
}

if(isset($_POST['submit'])) 
{
    $username = $_POST['username'];
    $email = strtolower(htmlspecialchars($_POST['email']));
    $password = hash('sha256', $_POST['password']);
    $password2 = hash('sha256', $_POST['password2']);


    if($password !== $password2)
    {
        $_SESSION['email'] = '';
        $_SESSION['username'] = '';

        $_SESSION['email'] = $email;
        $_SESSION['username'] = $username;

        $messagePasswordError = "password hasn\'t matched!";

        echo "<script>
                alert('" . $messagePasswordError . "')
                window.location.href = '" . $baseurl . "ui/user/signup.php'
            </script>";

        die;
    }
    foreach($users as $user)
    {
        if($email == $user['email'])
        {
            $_SESSION['email'] = '';
            $_SESSION['username'] = '';
    
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $username;


            $messageEmailError = "email has been registered!";

            echo "<script>
                    alert('" . $messageEmailError . "')
                    window.location.href = '" . $baseurl . "ui/user/signup.php'
                </script>";

            die;
        }
        if($username == $user['username'])
        {
            $_SESSION['email'] = '';
            $_SESSION['username'] = '';
    
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $username;

            $messageUsernameError = "username has been used!";

            echo "<script>
                    alert('" . $messageUsernameError . "')
                    window.location.href = '" . $baseurl . "ui/user/signup.php'
                </script>";

            die;
        }
    }

    $picture = $baseurl . 'users/blank-profile.webp';
    $role = 'user';
    $result = addQuery("INSERT INTO user (id, username, email, password, picture, role, created_at) VALUES ('','$username','$email','$password','$picture','$role',NOW())");
    
                
    if($result < 0)
    {
        echo mysqli_error($conn);
    }
    else 
    {
        $key = hash('sha256', $email);

        $id = query("SELECT id FROM user WHERE email='$email'");
        $id = $id[0]['id'];
        
        $_SESSION['login'] = true;
        $_SESSION['key'] = $key;
        $_SESSION['id'] = $id;
        

        echo "<script>
                alert('signup has succesed!')
                window.location.href = '" . $baseurl . "'
            </script>";
        die;
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
            </span>
            <span>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required value="<?= isset($_SESSION['email'])? $_SESSION['email'] : ''; ?>">
            </span>
            <span>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </span>
            <span>
                <label for="password2">Repeat Password</label>
                <input type="password" name="password2" id="password2" required>
            </span>
            <button type="submit" name="submit">signup</button>
        </form>
    </div>
</div>

<?php require "../templates/footer.php" ?>