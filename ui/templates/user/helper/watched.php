<?php
session_start();
require_once "../../../../controllers/dbs.php";

$titleFilm = $_SESSION['titleFilm'];
$eps = $_GET['eps'];

$idTitle = query("SELECT id FROM film WHERE title='$titleFilm'");
$titleId = $idTitle[0]['id'];

$icons = "SELECT * FROM user_reaction WHERE title_id='$titleId'";
$result = query($icons);
$newWatched = $result[0]['watched'];
$newWatched++;

if(isset($_SESSION['email']))
{
    $user = $_SESSION['email'];
    $idUser = query("SELECT id FROM user WHERE email='$user'");
    $userId = $idUser[0]['id'];
}

// update data ke dbs
$iconInject = "UPDATE user_reaction SET watched='$newWatched' WHERE title_id='$titleId' AND episode=$eps";
$result = updateQuery($iconInject);
if($result > 0)
{
    // ambil record user
    if(isset($_SESSION['email']))
    {      
        $data = query("SELECT watched FROM user_video_reaction WHERE user_id='$userId' AND title_id='$titleId' AND episode=$eps");
        // jika record user belum ada bikin dulu
        if($data == "data tidak ada")
        {
            $result = addQuery("INSERT INTO user_video_reaction (id,user_id,title_id,episode) VALUES('','$userId','$titleId',$eps)");
            if($result > 0) 
            {
                $data = query("SELECT watched FROM user_video_reaction WHERE user_id='$userId' AND title_id='$titleId' AND episode=$eps");
                $watchedUser = $data[0]['watched']; 
                $watchedUser++;
            }
            else
            {
                echo $newWatched++;
            }
        }
        else 
        {
            $watchedUser = $data[0]['watched']; 
            $watchedUser++;
        } 
        // update recod user bersangkutan
        $resultPut = updateQuery("UPDATE user_video_reaction SET watched=$watchedUser WHERE user_id='$userId' AND title_id='$titleId' AND episode=$eps");
        if($resultPut > 0)
        {
            echo $newWatched;
        }
    }
    else
    {
        echo $newWatched;
    }
}
else
{
    echo "Error";
}