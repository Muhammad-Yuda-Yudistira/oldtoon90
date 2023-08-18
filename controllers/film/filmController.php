<?php
require __DIR__ . "/../../models/filmModel.php";

function films($title)
{
    $data = getIdFilm($title);
    return $data;
}