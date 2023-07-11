<?php
require __DIR__ . "/../../models/signupModel.php";

function signup($data)
{
    global $conn, $baseurl;

    $username = htmlspecialchars($data['username']);
    $email = strtolower(htmlspecialchars($data['email']));
    $password = hash('sha256', $data['password']);
    $password2 = hash('sha256', $data['password2']);

    $users = getAllUser();

    if($password !== $password2)
    {
        $_SESSION['email'] = '';
        $_SESSION['username'] = '';

        $_SESSION['email'] = $email;
        $_SESSION['username'] = $username;

        $alert = "password";

        return $alert;
    }

    foreach($users as $user)
    {
        if($email == $user['email'])
        {
            $_SESSION['email'] = '';
            $_SESSION['username'] = '';
    
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $username;


            $alert = "email";

            return $alert;
        }
        if($username == $user['username'])
        {
            $_SESSION['email'] = '';
            $_SESSION['username'] = '';
    
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $username;

            $alert = "username";

            return $alert;
        }
    }

    $picture = 'images/users/blank-profile.webp';
    $role = 'user';

    $data = 
    [
        'username' => $username,
        'email' => $email,
        'password' => $password,
        'picture' => $picture,
        'role' => $role
    ];

    $result = addUser($data);
                
    if($result < 0)
    {
        return mysqli_error($conn);
    }
    else 
    {
        $key = hash('sha256', $email);
        $id = getIdUser($email);

        $id = $id[0]['id'];
        
        $_SESSION['login'] = true;
        $_SESSION['key'] = $key;
        $_SESSION['id'] = $id;
        
        $alert = "success";

        return $alert;
    }
}