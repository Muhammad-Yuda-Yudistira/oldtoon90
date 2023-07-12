<?php
function getAllUser()
{
    return query("SELECT username, email, password FROM user");
}

function getUser($emailOrUsername)
{
    return query("SELECT * FROM user WHERE email='$emailOrUsername' OR username='$emailOrUsername'");
}