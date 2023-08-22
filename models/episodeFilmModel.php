<?php
function getFilmEpisode($titleId)
{
    return query(
        "SELECT * FROM episode_film
        WHERE title_id='$titleId'"
        );
}

function putFileVideo($data)
{
    var_dump($data); die;
}
function putFilmEpisode($data)
{
    var_dump($data); die;
    $oldName = $data['old_name'];
    $name = $data['name'];
    $episode = $data['episode'];
    $video = $data['video'];
    $subtitle = 'videos/' . $data['subtitle'];

    $result = updateQuery("UPDATE episode_film SET nama='$name', episode=$episode, url_video='$video', url_subtitle='$subtitle', launched_at=NOW() WHERE name='$oldName'");
    var_dump($result); die;

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}