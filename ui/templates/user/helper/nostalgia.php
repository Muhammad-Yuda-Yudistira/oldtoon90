<?php 
session_start();
require_once "../../../../controllers/dbs.php";


$user = $_SESSION['email'];
$titleFilm = $_SESSION['titleFilm'];
$eps = $_GET['eps'];

$idUser = query("SELECT id FROM user WHERE email='$user'");
$idTitle = query("SELECT id FROM film WHERE title='$titleFilm'");

$userId = $idUser[0]['id'];
$titleId = $idTitle[0]['id'];

$data = [
    'title_id' => $titleId,
    'eps' => $eps,
    'user_id' => $userId,
    'category' => 'nostalgia'
];

$icons = "SELECT * FROM user_video_reaction WHERE user_id='$userId' AND title_id='$titleId' AND episode='$eps'";

$newNostalgiaValue = querySpecial($icons, $data);

echo $newNostalgiaValue;