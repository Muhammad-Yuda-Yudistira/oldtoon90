<?php
require __DIR__ . "/../../../controllers/dbs.php";

function getTotalRows()
{
    $totalRows = query("SELECT COUNT(*) AS total FROM user_comment");

    if($totalRows > 0)
    {
        $totalRows = $totalRows[0]['total'];
        return $totalRows;
    }
    else 
    {
        echo "Query untuk total rows salah!";
    }
}

function getComments($items, $offset)
{
    $comments = paginate("SELECT * FROM user_comment LIMIT $items OFFSET $offset");

    if($comments > 0)
    {
        return $comments;
    }
    else
    {
        echo "Query untuk get comments salah!";
    }
}