<?php
require __DIR__ . "/../../models/filmModel.php";

$title = $_GET['title'];
$result = deleteFilm($title);

if($result)
{
    $cover = deleteCover($title);
    $targetFile = '../../' . $cover;
    if(unlink($targetFile))
    {
        $backUrl = $_SERVER['HTTP_REFERER'];
        header("Location:$backUrl");
        exit();
    }
    else
    {
        echo "cover gagal dihapus!";
    }
}
else
{
    echo "data film tidak terhapus!";
}