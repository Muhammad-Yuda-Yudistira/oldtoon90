<?php
require __DIR__ . "/../controllers/dbs.php";

function getIdFilm($title)
{
    $idFilm = query("SELECT id FROM film WHERE title='$title'");
    return $idFilm[0]['id'];
}

function getFilm($title)
{
    $film = query(
        "SELECT film.*, tayang_local.channel, tayang_local.tahun, tayang_local.hari, COUNT(episode_film.episode) AS jumlah_episode
        FROM film 
        JOIN tayang_local ON film.id = tayang_local.title_id 
        JOIN episode_film ON film.id = episode_film.title_id 
        WHERE film.title='$title'"
    ); 
    return $film[0];
}

// deprecated
function getTayangLocal($title)
{
    $titleId = getIdFilm($title);
    $tayangLocal = query("SELECT * FROM tayang_local WHERE title_id=$titleId");
    return $tayangLocal;
}

function deleteFilm($title)
{
    global $conn;
    $stmt = $conn->prepare("SELECT id FROM film WHERE title = ?");
    $stmt->bind_param("s", $title);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $idFilm = $row['id'];

    $stmt = $conn->prepare("DELETE FROM tayang_local WHERE title_id = ?");
    $stmt->bind_param("i", $idFilm);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $stmt = $conn->prepare("DELETE FROM episode_film WHERE title_id = ?");
        $stmt->bind_param("i", $idFilm);
        $stmt->execute();

        $stmt = $conn->prepare("DELETE FROM user_comment WHERE title_id = ?");
        $stmt->bind_param("i", $idFilm);
        $stmt->execute();

        $stmt = $conn->prepare("DELETE FROM user_reaction WHERE title_id = ?");
        $stmt->bind_param("i", $idFilm);
        $stmt->execute();

        $stmt = $conn->prepare("DELETE FROM film WHERE id = ?");
        $stmt->bind_param("i", $idFilm);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            echo "Error deleting film from database!";
        }
    } else {
        echo "Error deleting tayang local from database!";
    }

    $stmt->close();
    $conn->close();
}

function deleteCover($title)
{
    global $conn;

    $stmt = $conn->prepare("SELECT cover FROM film WHERE title = ?");
    $stmt->bind_param("s", $title);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $cover = $row['cover'];

    $stmt->close();
    $conn->close();

    return $cover;
}
