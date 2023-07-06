<?php
session_start();

require_once "dbs.php";

$title = $_POST['title'];
$user = $_SESSION['email'];

if(isset($_POST['vote']))
{
    $nextFilm = query("SELECT id, voted FROM next_film_uploaded WHERE title='$title'");
    $titleId = $nextFilm[0]['id'];
    $voted = $nextFilm[0]['voted'];
    $voted++;
   

    $userId = query("SELECT id FROM user WHERE email='$user'");
    $userId = $userId[0]['id'];

    $resultUser = addQuery("INSERT INTO user_voting VALUES(NULL,$userId,$titleId,true,NOW())");

    if($resultUser > 0)
    {
        $resultFilm = updateQuery("UPDATE next_film_uploaded SET voted=$voted WHERE title='$title'");

        if($resultFilm > 0)
        {
            header("location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }
        else 
        {
            echo "updated voting of film is failed!";
            exit;
        }
    }
    else
    {
        header("location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
}