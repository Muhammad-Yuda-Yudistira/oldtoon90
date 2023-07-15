<?php
require "../dbs.php";

function deleteFilm($title)
{
    $idFilm = query("SELECT id FROM film WHERE title='$title'");
    $result = query("DELETE FROM tayang_local WHERE title_id=$idFilm");
    if($result > 0)
    {
        $result = query("DELETE FROM film WHERE title='$title'");
        if($result > 0)
        {

        }
        else
        {
            echo "Error deleting film from database.";
        }
    }
    else
    {
        echo "Error deleting tayang local from database.";
    }
}