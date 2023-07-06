<?php 
require_once "dbs.php";

function uploadFanart($file, $folder) 
{
    $formatValid = ["jpg", "jpeg", "jfif", "png", "webp"];

    $fileName = $file['name'];
    $tmpName = $file['tmp_name'];
    $imageSize = $file['size'];
    $error = $file['error'];
    $format = explode('.', $fileName);
    $format = strtolower(end($format));

    if(!in_array($format, $formatValid))
    {
        echo "<script>alert('yang anda upload bukan gambar atau format tidak didukung')</script>";
    }
    if($imageSize > 2000000)
    {
        echo "<script>alert('gambar terlalu besar, batas maksimal 2MB')</script>";
    }
    if($error) 
    {
        echo "<script>alert('terjadi kesalahan')</script>";
    }
    move_uploaded_file($tmpName, "../../../fanart/" . $folder . $fileName);
    return $fileName;
}

function addFanart($data, $file, $folder)
{
    $fileName = uploadFanart($file, $folder);

    $title = htmlspecialchars($data['title']);
    $fanart = htmlspecialchars($data['fanart']);
    $fileName = $fileName;
    return true;

    // // $query = "INSERT INTO fanart_image VALUES(id='', title=$title, fanart=$fanart, image=$imageName)";
    // // echo $query;
    // $query = "INSERT INTO fanart_image('id','title','fanart','image') VALUES('','$title','$fanart','$imageName')";
    // echo $query;
    // // $query = "INSERT INTO fanart_image VALUES(id='', title='$title', fanart='$fanart', image='$imageName')";
    // // echo $query;
    // $result = addQuery($query);
    // var_dump($result);
    // die;
}