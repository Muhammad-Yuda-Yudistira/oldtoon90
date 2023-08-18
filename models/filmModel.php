<?php
require __DIR__ . "/../controllers/dbs.php";

function getIdFilm($title)
{
    $idFilm = query("SELECT id FROM film WHERE title='$title'");
    return $idFilm[0]['id'];
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
