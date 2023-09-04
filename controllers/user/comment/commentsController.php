<?php
require __DIR__ . "/../../../models/user/comment/commentsModel.php";

function getCommentsPagination()
{
    $commentsPerPage = 3;

    if (isset($_GET['currentComment'])) {
        $currentComment = $_GET['currentComment'];
    } else {
        $currentComment = 1;
    }

    $totalRows = getTotalRows();

    $totalPages = $totalRows / $commentsPerPage;
    $totalPages = ceil($totalPages);
    $offset = ($currentComment - 1) * $commentsPerPage;

    $comments = getComments($commentsPerPage, $offset);

    $result = [
        'comments' => $comments,
        'totalPages' => $totalPages,
        'currentComment' => $currentComment,
    ]; 

    return $result;
}