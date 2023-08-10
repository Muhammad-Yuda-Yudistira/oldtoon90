<?php
require __DIR__ . "/../../../controllers/dbs.php";

function getReply()
{
    $result = query("SELECT * FROM user_comment_reply");
    return $result;
}

function addReply($from, $to, $message)
{
    $result = addQuery("INSERT INTO user_comment_reply VALUES('', $from, $to, '$message', NOW())");

    if($result > 0)
    {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
    else
    {
        echo "query salah!";
    }
}