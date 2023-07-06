<?php 
require_once "../controllers/dbs.php";

function getComment()
{
    return query("SELECT user.email, user.picture, user_comment.title_id,user_comment.episode,user_comment.comment, user_comment.created_at FROM user INNER JOIN user_comment ON user.id = user_comment.user_id ORDER BY user_comment.created_at DESC");
}

function addComment($data) 
{
    $user = $data['user'];
    $message = $data['message'];
    $title = $data['title'];
    $eps = $data['eps'];

    $userID = Query("SELECT id FROM user WHERE email='$user'");
    if($userID == "data tidak ada")
    {
        $userID = 10;
    }
    else 
    {
        $userID = $userID[0]['id'];
        $userID = intval($userID);
    }

    $titleID = query("SELECT id FROM film WHERE title='$title'");
    $titleID = $titleID[0]['id'];
    $titleID = intval($titleID);

    $result = addQuery("INSERT INTO user_comment VALUES('',$userID,$titleID,$eps,'$message',CURRENT_TIMESTAMP())");
}