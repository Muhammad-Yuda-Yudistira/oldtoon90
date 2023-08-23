<?php
require __DIR__ . "/../config/config.php";

use PHPUnit\Runner\Filter\NameFilterIterator;

function getFilmEpisode($titleId)
{
    return query(
        "SELECT * FROM episode_film
        WHERE title_id='$titleId'"
        );
}
function uploadFileTo($nameFile, $tmpNameFile, $title, $typeFile, $oldNameFile)
{
    global $baseurl;
    if($typeFile == 'mp4' or $typeFile == 'webm')
    {
        $pathFolderFile = __DIR__ . '/../../dbs-film/' . $title . '/';

        if(file_exists($pathFolderFile . $oldNameFile))
        {
            unlink($pathFolderFile . $oldNameFile);
        }

        move_uploaded_file($tmpNameFile, $pathFolderFile . $nameFile);
    }
    else if($typeFile == 'vtt' or $typeFile == 'srt')
    {
        $pathFolderFile = __DIR__ . '/../videos/';

        if(file_exists($pathFolderFile . $oldNameFile))
        {
            unlink($pathFolderFile . $oldNameFile);
        }

        move_uploaded_file($tmpNameFile, $pathFolderFile . $nameFile);
    }
}
function putFilmEpisode($data)
{
    $oldName = $data['old_name'];
    $name = $data['name'];
    $episode = $data['episode'];
    $video = $data['video'];
    $subtitle = 'videos/' . $data['subtitle'];

    $result = updateQuery("UPDATE episode_film SET nama='$name', episode=$episode, url_video='$video', url_subtitle='$subtitle', launched_at=NOW() WHERE name='$oldName'");
    var_dump($result); die;

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}