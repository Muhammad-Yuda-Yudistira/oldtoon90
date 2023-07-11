<?php
function login($email, $password)
{
    $allEmail = query("SELECT email FROM user");

    $role = query("SELECT role FROM user WHERE email='$email'");
    if($role == [])
    {
        return false;
    }
    $role = $role[0]['role'];
    
    if($role == 'admin')
    {
        if(isset($_POST['remember']))
        {
            setcookie('remember', 'admin', time() + 60*60*24*7, "/");
            $emailCookie = hash('sha256', $email);
            setcookie('key', $emailCookie, time() + 60*60*24*7, "/");
            setcookie('email', $email, time() + 60*60*24*7, "/");
        }

        $_SESSION['admin'] = $role;
        $_SESSION['email'] = $email;
        
        return $role;
    }

    foreach($allEmail as $e) 
    {
        if($email == $e['email'])
        {
            $key = hash('sha256', $email);

            $_SESSION['login'] = true;
            $_SESSION['key'] = $key;
            $_SESSION['email'] = $email;

            if(isset($_POST['remember']))
            {
                setcookie('remember', true, time() + 60*60*24*7, '/');
                setcookie('login', $_SESSION['login'], time() + 60*60*24*7, '/');
                setcookie('key', $key, time() + 60*60*24*7, '/');
                setcookie('email', $email, time() + 60*60*24*7, '/');
            }

            return $role;
        }
    }
}