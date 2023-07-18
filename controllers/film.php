<?php 
require_once __DIR__ . "/dbs.php";

function uploadFilm($data)
{
    global $baseurl;

    $tmpName = $data['tmp_name'];
    $fileName = $data['name'];
    $ekstensi = explode('.', $fileName);

    $panjangString = 10;
    $karakter = $fileName;
    $randomString = substr(str_shuffle($karakter), 0, $panjangString);
    $newFileName = $randomString . "." . end($ekstensi);

    move_uploaded_file($tmpName, "../../../images/covers/" . $newFileName);

    return $newFileName;
}

function updateCoverFilm($data, $existingCover)
{
    $tmpName = $data['tmp_name'];
    $fileName = $data['name'];
    $ekstensi = explode('.', $fileName);

    if(!empty($fileName))
    {
        $panjangString = 10;
        $karakter = $fileName;
        $randomString = substr(str_shuffle($karakter), 0, $panjangString);
        $newFileName = $randomString . "." . end($ekstensi);

        $targetDirectory = "../../../images/covers/";
        $targetFile = $targetDirectory . $newFileName;

        $allCover = glob($targetDirectory . '*');
        foreach($allCover as $file)
        {
            if($file == $targetDirectory . $existingCover)
            {
                unlink($file);
            }
        }

    move_uploaded_file($tmpName, $targetFile);
    }
    else
    {
        $newFileName = $existingCover;
    }

    return $newFileName;
}

function uploadEpisode($title, $data)
{
    $nameVideo = $data['video']['name'];
    $tmpNameVideo = $data['video']['tmp_name'];

    $nameSubtitle = $data['subtitle']['name'];
    $tmpNameSubtitle = $data['subtitle']['tmp_name'];

    move_uploaded_file($tmpNameVideo, '../../../../dbs-film/' . $title . "/" . $nameVideo);
    move_uploaded_file($tmpNameSubtitle, '../../../videos/' . $nameSubtitle);

    $names = [
        "nameVideo" => $nameVideo,
        "nameSubtitle" => $nameSubtitle,
    ];

    return $names;
}

function addFilm($data, $fileName)
{
    global $baseurl;

    $title = $data['title'];
    $episode = $data['episode'];
    $film = $data['film'];
    $tipe = $data['tipe'];
    $aired = $data['aired'];
    $series = $data['series'];
    $franchise = $data['franchise'];
    $authors = $data['authors'];
    $artists = $data['artists'];
    $studios = $data['studios'];
    $cover = $fileName;
    $channel = $data['channel'];
    $year = $data['year'];
    $day = $data['day'];
    $hubChannel = "";
    $hubDay = "";

    foreach($channel as $c)
    {
        $hubChannel .= $c . ",";
    }
    foreach($day as $d)
    {
        $hubDay .= $d . ",";
    }

    $hubChannel = rtrim($hubChannel, ",");
    $hubDay = rtrim($hubDay, ",");
    $year = intval($year);

    $cover = "images/covers/" . $cover; 

    $allFilm = query("SELECT * FROM film");
    foreach($allFilm as $filmItem)
    {
        if($filmItem['title'] == $title)
        {
            return 1;
        }
    }

    $resultFilm = addQuery("INSERT INTO film VALUES('','$title',$episode,'$film','$tipe','$aired',$series,'$franchise','$authors','$artists','$studios','$cover')");

    if($resultFilm > 0)
    {
        $idFilm = query("SELECT id FROM film WHERE title='$title'");
        $idFilm = $idFilm[0]['id'];
    
        $result = addQuery("INSERT INTO tayang_local VALUES('',$idFilm,'$hubChannel',$year,'$hubDay')");
    
        if($result > 0)
        {
            return 4;
        }
        return 3;
    }
    else 
    {
        return 2;
    }
}

function updateFilm($data, $fileName, $titleDBS)
{
    global $baseurl;

    $title = $data['title'];
    $episode = $data['episode'];
    $film = $data['film'];
    $type = $data['type'];
    $aired = $data['aired'];
    $series = $data['series'];
    $franchise = $data['franchise'];
    $authors = $data['authors'];
    $artists = $data['artists'];
    $studios = $data['studios'];
    $cover = $fileName;
    $channel = $data['channel'];
    $year = $data['year'];
    $day = $data['day'];

    // $year = intval($year);
    $hubChannel = "";
    $hubDay = "";

    foreach($channel as $c)
    {
        $hubChannel .= $c . ",";
    }
    foreach($day as $d)
    {
        $hubDay .= $d . ",";
    }

    $hubChannel = rtrim($hubChannel, ",");
    $hubDay = rtrim($hubDay, ",");

    $cover = "images/covers/" . $cover; 

    $resultFilm = updateQuery("UPDATE film SET title='$title', episode=$episode, film='$film', tipe='$type',aired='$aired', series=$series, franchise='$franchise', authors='$authors', artists='$artists',studios='$studios', cover='$cover' WHERE title='$titleDBS'");

    if($resultFilm !== false)
    {
        $idFilm = query("SELECT id FROM film WHERE title='$titleDBS'");
        $idFilm = $idFilm[0]['id'];
        $idfilm = intval($idFilm);
        
        $result = updateQuery("UPDATE tayang_local SET title_id=$idFilm, channel='$hubChannel', tahun=$year,hari='$hubDay' WHERE title_id=$idFilm");
    
        if($result !== false)
        {
            echo "<script>alert('Film berhasil diupdate')</script>";
    
            header("Location:" .$baseurl . "ui/user/admin.php");
            exit();
        }
        echo "data tv local gagal di update! query salah"; die;
    }
    else 
    {
        echo "data film gagal di update! query salah";die;
    }

}
function addEpisode($fileName, $title, $epsData)
{
    global $baseurl, $videoServerUrl;

    $name = $epsData['name'];
    $episode = $epsData['episode'];
    
    $idFilm = query("SELECT id FROM film WHERE title='$title'");
    $idfilm = $idFilm[0]['id'];
    $idFilm = intval($idFilm);

    $pathVideo = $fileName['nameVideo'];
    $pathSubtitle = $fileName['nameSubtitle'];

    $alert = updateQuery("INSERT INTO episode_film VALUES('',$idFilm,'$name',$episode,'$pathVideo','$pathSubtitle',CURRENT_TIMESTAMP())");
}

