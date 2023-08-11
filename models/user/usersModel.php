<?php
require __DIR__ . "/../../controllers/dbs.php";

function getUsers()
{
    $users = query("SELECT * FROM user");
    if($users > 0)
    {
        return $users;
    }
    else 
    {
        echo "query get users salah!";
    }
}