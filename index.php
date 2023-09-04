<?php 
session_start();
require "config/config.php";
require "controllers/dbs.php";

if(isset($_COOKIE['remember']) && $_COOKIE['remember'] == true)
{
    $allUser = query("SELECT * FROM user");
    $key = $_COOKIE['key'];
    foreach($allUser as $user)
    {
        if($key == hash('sha256', $user['email'] . $user['password']) || $key == hash('sha256', $user['username'] . $user['password']))
        {
            if($user['role'] == 'admin')
            {
                header("Location:" . $baseurl . "ui/user/admin.php");
                exit();
            }
            $_SESSION['username'] = $user['username'];
            header("Location:" . $baseurl . "ui/user/main.php");
            exit();
        }
    }
}
else
{
    header("Location:" . $baseurl . "ui/user/main.php");
    exit();
}
