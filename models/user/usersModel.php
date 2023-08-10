<?php
require __DIR__ . "/../../controllers/dbs.php";

function getAllUser()
{
    // $result = query("SELECT * FROM user");

    // if($result > 0)
    // {
    //     return $result;
    // }
    // else 
    // {
    //     echo "Query salah!";
    // }

    $result = query("SELECT COUNT(*) AS total FROM user");
    var_dump($result); die;
}