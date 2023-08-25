<?php
require __DIR__ . "/../../models/episodeFilmModel.php";

// main fuctional
function filmEpisode($title)
{
    $titleId = films($title);
    return getFilmEpisode($titleId);
}


function updateFile($data, $title, $oldNameFiles)
{
    $nameFileSubtitle = uploadFile($data['subtitle'], $title, $oldNameFiles);
    $nameFileVideo = uploadFile($data['video'], $title, $oldNameFiles);

    return [
        'nameFileSubtitle' => $nameFileSubtitle,
        'nameFileVideo' => $nameFileVideo
    ];
}

function insertDataEps($data, $fileNames, $title)
{
    insertEpsToDbs($data, $fileNames, $title);
}

function updateEpsFilm($data, $files)
{
    if($files['nameFileSubtitle'] and $files['nameFileVideo'])
    {
        putFilmEpisode($data, $files);
    }
    elseif($files['nameFileSubtitle'] or $files['nameFileVideo'])
    {
        putFilmEpisode($data, $files);
    }
    else
    {
        putFilmEpisode($data);
    }
}

function insertEpisode($files, $title)
{
    $nameFileSubtitle = insertFile($files['subtitle'], $title);
    $nameFileVideo = insertFile($files['video'], $title);

    return [
        'nameFileSubtitle' => $nameFileSubtitle,
        'nameFileVideo' => $nameFileVideo
    ];
}

function deleteFiles($data, $title)
{
    delEpisodeFilm($data['url_video'], 'video', $title);
    delEpisodeFilm($data['url_subtitle'], 'subtitle');
}



// second functional
function insertFile($file, $title)
{
    if($file['error'] !== 4)
    {
        $nameFile = $file['name'];
        $typeFile = $file['type'];
        $sizeFile = $file['size'];
        $tmpNameFile = $file['tmp_name'];
        
        // video
        $supportFileVideo = ['video/mp4', 'video/webm'];
        $maxSizeVideo = 1024 * 1024 * 1024;
        // subtitle
        $supportFileSubtitle = ['application/octet-stream'];
        $maxSizeSubtitle = 2 * 1024 * 1024;

        if(in_array($typeFile, $supportFileVideo))
        {
            if($sizeFile <= $maxSizeVideo)
            {
                $typeFile = explode('/', $typeFile);
                $typeFile = end($typeFile); 

                $random = random_bytes(9);
                $strRandom = bin2hex($random);
                $nameFile = time() . '_' . $strRandom . '.' . $typeFile;
    
                $nameFile = insertFileTo($nameFile, $tmpNameFile, $title, $typeFile);

                return $nameFile;
            }
        }
        if(in_array($typeFile, $supportFileSubtitle))
        {
            if($sizeFile <= $maxSizeSubtitle)
            {
                $typeFile = 'vtt';

                $random = random_bytes(9);
                $strRandom = bin2hex($random);
                $nameFile = time() . '_' . $strRandom . '.' . $typeFile;
    
                $nameFile = insertFileTo($nameFile, $tmpNameFile, $title, $typeFile);

                return $nameFile; 
            }
        }
    }
}

function addFiles($files, $title)
{
    if($files['video']['error'] == 0)
    {
        $nameVideo = $files['video']['name'];
        $tmpNameVideo = $files['video']['tmp_name'];
        $typeVideo = $files['video']['type'];
        $sizeVideo = $files['video']['size'];

        $supportTypeVideo = array('video/mp4', 'video/webm');
        $maxSizeVideo = 1024 * 1024 * 1024;

        if(in_array($typeVideo, $supportTypeVideo))
        {

        }
    }
    if($files['subtitle']['error'] == 0)
    {
        $nameSubtitle = $files['subtitle']['name'];
        $tmpNameSubtitle = $files['subtitle']['tmp_name'];
        $typeSubtitle = $files['subtitle']['type'];
        $sizeSubtitle = $files['subtitle']['size'];
        
        $supportTypeSubtitle = array('application/octet-stream');
        $maxSizeSubtitle = 2 * 1024 * 1024;
    }


}

function uploadFile($data, $title, $oldNameFiles)
{
    if($data['error'] !== 4)
    {
        $nameFile = $data['name'];
        $typeFile = $data['type'];
        $sizeFile = $data['size'];
        $tmpNameFile = $data['tmp_name'];
        
        // video
        $supportFileVideo = ['mp4', 'webm'];
        $maxSizeVideo = 1024 * 1024 * 1024;
        // subtitle
        $supportFileSubtitle = ['octet-stream'];
        $maxSizeSubtitle = 2 * 1024 * 1024;

        $typeFile = explode('/', $typeFile);
        $typeFile = end($typeFile); 

        if(in_array($typeFile, $supportFileVideo))
        {
            if($sizeFile <= $maxSizeVideo)
            {
                $oldNameFile = $oldNameFiles['oldVideo'];

                $random = random_bytes(16);
                $strRandom = bin2hex($random);
                $nameFile = time() . '_' . $strRandom . '.' . $typeFile;
    
                $nameFile = uploadFileTo($nameFile, $tmpNameFile, $title, $typeFile, $oldNameFile);

                return $nameFile;
            }
        }
        if(in_array($typeFile, $supportFileSubtitle))
        {
            if($sizeFile <= $maxSizeSubtitle)
            {
                $typeFile = 'vtt';
                $oldNameFile = $oldNameFiles['oldSubtitle'];

                $random = random_bytes(16);
                $strRandom = bin2hex($random);
                $nameFile = time() . '_' . $strRandom . '.' . $typeFile;
    
                $nameFile = uploadFileTo($nameFile, $tmpNameFile, $title, $typeFile, $oldNameFile);

                return $nameFile; 
            }
        }
    }
}