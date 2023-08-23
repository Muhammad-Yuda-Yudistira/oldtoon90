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
    uploadFile($data['subtitle'], $title, $oldNameFiles);
    uploadFile($data['video'], $title, $oldNameFiles);
}

function updateEpsFilm($data)
{
    putFilmEpisode($data);
}



// second functional
function uploadFile($data, $title, $oldNameFiles)
{
    if(!$data['error'])
    {
        $nameFile = $data['name'];
        $typeFile = $data['type'];
        $sizeFile = $data['size'];
        $tmpNameFile = $data['tmp_name'];
        
        // video
        $supportFileVideo = ['mp4', 'webm'];
        $maxSizeSubtitle = 2 * 1024 * 1024;
        // subtitle
        $supportFileSubtitle = ['octet-stream'];
        $maxSizeVideo = 1024 * 1024 * 1024;

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
    
                uploadFileTo($nameFile, $tmpNameFile, $title, $typeFile, $oldNameFile);
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
    
                uploadFileTo($nameFile, $tmpNameFile, $title, $typeFile, $oldNameFile);
            }
        }
    }
}