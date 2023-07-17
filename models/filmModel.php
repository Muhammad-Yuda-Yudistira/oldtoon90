<?php
require __DIR__ . "/../controllers/dbs.php";

function deleteFilm($title)
{
    $idFilm = query("SELECT id FROM film WHERE title='$title'");
    $idFilm = $idFilm[0]['id'];

    $result = deleteQuery("DELETE FROM tayang_local WHERE title_id=$idFilm");
    
    if($result > 0)
    {
        deleteQuery("DELETE FROM episode_film WHERE title_id=$idFilm");
        deleteQuery("DELETE FROM user_comment WHERE title_id=$idFilm");
        deleteQuery("DELETE FROM user_reaction WHERE title_id=$idFilm");

        $result = deleteQuery("DELETE FROM film WHERE id=$idFilm");
        if($result > 0)
        {
            return true;
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