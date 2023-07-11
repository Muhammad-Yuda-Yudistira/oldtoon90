<?php
function getAllUser()
{
    return query("SELECT * FROM user");
}

function addUser($data)
{
    $username = $data['username'];
    $email = $data['email'];
    $password = $data['password'];
    $picture = $data['picture'];
    $role = $data['role'];

    return addQuery("INSERT INTO user (id, username, email, password, picture, role, created_at) VALUES ('','$username','$email','$password','$picture','$role',NOW())");
}

function getIdUser($email)
{
    return query("SELECT id FROM user WHERE email='$email'");
}