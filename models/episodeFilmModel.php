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

function insertFileTo($nameFile, $tmpNameFile, $title, $typeFile)
{
    if($typeFile == 'mp4' or $typeFile == 'webm')
    {
        $pathFolderFile = __DIR__ . '/../../dbs-film/' . $title . '/';

        move_uploaded_file($tmpNameFile, $pathFolderFile . $nameFile);

        return $nameFile;
    }
    else if($typeFile == 'vtt' or $typeFile == 'srt')
    {
        $pathFolderFile = __DIR__ . '/../';
        $nameFile = 'videos/' . $nameFile;

        move_uploaded_file($tmpNameFile, $pathFolderFile . $nameFile);

        return $nameFile;
    }
}

function uploadFileTo($nameFile, $tmpNameFile, $title, $typeFile, $oldNameFile)
{
    if($typeFile == 'mp4' or $typeFile == 'webm')
    {
        $pathFolderFile = __DIR__ . '/../../dbs-film/' . $title . '/';

        if(file_exists($pathFolderFile . $oldNameFile))
        {
            unlink($pathFolderFile . $oldNameFile);
        }

        move_uploaded_file($tmpNameFile, $pathFolderFile . $nameFile);

        return $nameFile;
    }
    else if($typeFile == 'vtt' or $typeFile == 'srt')
    {
        $pathFolderFile = __DIR__ . '/../';
        $nameFile = 'videos/' . $nameFile;

        if(file_exists($pathFolderFile . $oldNameFile))
        {
            unlink($pathFolderFile . $oldNameFile);
        }

        move_uploaded_file($tmpNameFile, $pathFolderFile . $nameFile);

        return $nameFile;
    }
}
function putFilmEpisode($data, $files=['noData' => NULL])
{
    global $baseurl; 

    $oldName = $data['old_name'];
    $name = $data['name'];
    $episode = $data['episode'];
    $subtitle = $data['old_subtitle'];
    $video = $data['old_video'];

    var_dump($files);
    echo '<br>';
    echo 'sebelum: ' . $video;
    echo '<br>';
    echo 'sebelum: ' . $subtitle;
    echo '<br>';
    
    if(array_key_exists('nameFileSubtitle', $files) and $files['nameFileSubtitle'] !== NULL)
    {
        $subtitle = $files['nameFileSubtitle'];
    }
    if(array_key_exists('nameFileVideo', $files) and $files['nameFileVideo'] !== NULL)
    {
        $video = $files['nameFileVideo'];
    }

    $result = updateQuery("UPDATE episode_film SET nama='$name', episode=$episode, url_video='$video', url_subtitle='$subtitle', launched_at=NOW() WHERE nama='$oldName'");

    header('Location: ' . $baseurl . 'ui/user/admin.php');
}