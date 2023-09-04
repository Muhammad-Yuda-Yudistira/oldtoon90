<?php
require __DIR__ . "/../../models/filmModel.php";

function films($title)
{
    $data = getIdFilm($title);
    return $data;
}

function film($title)
{
    $film = getFilm($title);
    $tayangLocal = getTayangLocal($title);
    // cara 1
    // $data = array_merge($film, $tayangLocal);
    // cara 2 
    // $data = $film + $tayangLocal;
    return $film;
}