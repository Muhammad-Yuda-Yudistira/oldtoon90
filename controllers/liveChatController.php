<?php
session_start();

require_once "dbs.php";

if(isset($_POST['submit']))
{
    $username = $_SESSION['email'];
    $message = $_POST['chat'];

    $idUser = query("SELECT id FROM user WHERE email='$username'");
    $idUser = $idUser[0]['id'];

    $result = addQuery("INSERT INTO live_chat VALUES(NULL,$idUser,'$message',NOW())");
    if($result > 0)
    {
        header("location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
    echo "error!";
}