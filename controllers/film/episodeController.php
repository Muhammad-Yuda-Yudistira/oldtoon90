<?php
require __DIR__ . "/../../models/episodeFilmModel.php";

function filmEpisode($title)
{
    $titleId = films($title);
    return getFilmEpisode($titleId);
}

function updateFilesFilm($data)
{
    putFileVideo($data['video']);
    putFileSubtitle($data['subtitle']);
}

function updateEpsFilm($data)
{
    putFilmEpisode($data);
}