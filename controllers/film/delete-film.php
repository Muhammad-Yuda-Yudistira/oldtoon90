<?php
require __DIR__ . "/../../models/filmModel.php";

$title = $_GET['title'];
$result = deleteFilm($title);

if($result)
{
    $backUrl = $_SERVER['HTTP_REFERER'];
    header("Location:$backUrl");
}
else
{
    echo "ada yang salah!";
}