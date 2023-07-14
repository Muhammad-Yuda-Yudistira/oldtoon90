<?php 
require_once "dbs.php";

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

function addFilm($data)
{
    global $baseurl;

    $title = $data['film']['title'];
    $episode = $data['film']['episode'];
    $film = $data['film']['film'];
    $type = $data['film']['type'];
    $aired = $data['film']['aired'];
    $series = $data['film']['series'];
    $franchise = $data['film']['franchise'];
    $authors = $data['film']['authors'];
    $artists = $data['film']['artists'];
    $studios = $data['film']['studios'];
    $cover = $data['film']['cover'];
    $channel = $data['film']['channel'];
    $year = $data['film']['year'];
    $day = $data['film']['day'];

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
    foreach($allFilm as $film)
    {
        if($film['title'] == $title)
        {
            echo "judul film sudah terdaftar! <a href='" . $baseurl . "ui/user/contents/film.php'>Back</a>"; die;
        }
    }

    $resultFilm = addQuery("INSERT INTO film VALUES('','$title',$episode,'$film','$type','$aired',$series,'$franchise','$authors','$artists','$studios','$cover')");

    if($resultFilm > 0)
    {
        $idFilm = query("SELECT id FROM film WHERE title='$title'");
        $idFilm = $idFilm[0]['id'];
    
        $result = addQuery("INSERT INTO tayang_local VALUES('',$idFilm,'$hubChannel',$year,'$hubDay')");
    
        if($result > 0)
        {
            echo "<script>alert('Film berhasil ditambahkan')</script>";
    
            header("Location:" .$baseurl . "ui/user/admin.php");
            exit();
        }
        echo "data tv local gagal di kirim!"; die;
    }
    else 
    {
        echo "data film gagal di kirim!";die;
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

