<?php 
require_once "connection.php";


function query($query)
{
    global $conn;
    $data = mysqli_query($conn, $query);

    $rows = [];

    if(mysqli_num_rows($data) == 0)
    {
        return $rows;
    }
    else 
    {
        while($row =  mysqli_fetch_assoc($data)) 
        {
            $rows[] = $row;
        }
    }

    return $rows;
}

function addQuery($query)
{
    global $conn;
    mysqli_query($conn, $query);
    $reaksi = mysqli_affected_rows($conn);
    return $reaksi;
}

function updateQuery($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $alert = mysqli_affected_rows($conn);
    return $alert;
}

function deleteQuery($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $alert = mysqli_affected_rows($conn);
    return $alert;
}


function querySpecial($query, $needData)
{
    global $conn;
    $data = mysqli_query($conn, $query);

    $userId = $needData['user_id'];
    $titleId = $needData['title_id'];
    $eps = $needData['eps'];
    $category = $needData['category'];

    if(mysqli_num_rows($data) == 0)
    {
        // insert jika belum ada
        if($category == 'liked')
        {
        $liked = true;

        $alert = addQuery("INSERT INTO user_video_reaction (id,user_id,title_id,episode,liked) 
                    VALUES('', '$userId', '$titleId', $eps, $liked)");
        }
        else if($category == 'nostalgia')
        {
        $nostalgia = true;

        $alert = addQuery("INSERT INTO user_video_reaction (id,user_id,title_id,episode,nostalgia) 
                    VALUES('', '$userId', '$titleId', $eps, $nostalgia)");
        }

        if($alert > 0)
        {
            // update ke title general
            $allData = query("SELECT * FROM user_reaction WHERE title_id='$titleId' AND episode=$eps");

            if($category == 'liked')
            {
                $addLike = $allData[0]['liked'];
                $addLike++;
                addQuery("UPDATE user_reaction SET liked=$addLike WHERE title_id='$titleId' AND episode=$eps");
                return $addLike;
            }
            elseif($category == 'nostalgia')
            {
                $addNostalgia = $allData[0]['nostalgia'];
                $addNostalgia++;
                addQuery("UPDATE user_reaction SET nostalgia=$addNostalgia WHERE title_id='$titleId' AND episode=$eps");
                return $addNostalgia;
            }

        }
    }
    else 
    {
        // ambil data user dan general title
        $userData = query("SELECT * FROM user_video_reaction WHERE user_id='$userId' AND title_id='$titleId' AND episode=$eps");
        $generalReaction = query("SELECT * FROM user_reaction WHERE title_id='$titleId' AND episode=$eps");

        $watched = $userData[0]['watched'];
        $liked = $userData[0]['liked'];
        $nostalgia = $userData[0]['nostalgia'];

        $watchedGeneral = $generalReaction[0]['watched'];
        $likedGeneral = $generalReaction[0]['liked'];
        $nostalgiaGeneral = $generalReaction[0]['nostalgia'];

        if($category == 'liked')
        {
            if($liked == 1)
            {
                $liked = false;
            }
            else 
            {
                $liked = true;
            }
        }
        else if($category == 'nostalgia')
        {
            if($nostalgia == 1)
            {
                $nostalgia = false;
            }
            else 
            {
                $nostalgia = true;
            }
        }
      
        // update nilai user dan update nilai pada general title
        updateQuery("UPDATE user_video_reaction SET watched=$watched, liked='$liked', nostalgia='$nostalgia' WHERE user_id='$userId' AND title_id='$titleId' AND episode=$eps");

        if($category == 'liked')
        {
            if($liked == 1) 
            {
                $likedGeneral++;
    
                updateQuery("UPDATE user_reaction SET watched=$watchedGeneral, liked=$likedGeneral, nostalgia=$nostalgiaGeneral WHERE title_id='$titleId' AND episode=$eps");
                echo $likedGeneral;
            }
            else 
            {
                $likedGeneral--;
    
                updateQuery("UPDATE user_reaction SET watched=$watchedGeneral, liked=$likedGeneral, nostalgia=$nostalgiaGeneral WHERE title_id='$titleId' AND episode=$eps");
                echo $likedGeneral;
            }
        }
        else if($category == 'nostalgia')
        {
            if($nostalgia) 
            {
                $nostalgiaGeneral++;
    
                updateQuery("UPDATE user_reaction SET watched=$watchedGeneral, liked=$likedGeneral, nostalgia=$nostalgiaGeneral WHERE title_id='$titleId' AND episode=$eps");
                echo $nostalgiaGeneral;
            }
            else 
            {
                $nostalgiaGeneral--;
    
                updateQuery("UPDATE user_reaction SET watched=$watchedGeneral, liked=$likedGeneral, nostalgia=$nostalgiaGeneral WHERE title_id='$titleId' AND episode=$eps");
                echo $nostalgiaGeneral;
            }
        }
    }
}
