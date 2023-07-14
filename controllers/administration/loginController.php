<?php
require __DIR__ . "/../../models/loginModel.php";

function login($emailOrUsername, $password)
{
    $allUser = getAllUser();
    $user = getUser($emailOrUsername);

    $password = hash('sha256', $password);

    if($user == [])
    {
        return false;
    }
    foreach($user as $u)
    {
        foreach($allUser as $userDbs) 
        {
            if($emailOrUsername == $userDbs['email'] || $emailOrUsername == $userDbs['username'])
            {
                if($password == $userDbs['password'])
                {
                    if($u['role'] == 'admin')
                    {
                        if(isset($_POST['remember']))
                        {
                            setcookie('remember', true, time() + 60*60*24*7, "/");
                            setcookie('key', hash('sha256', $emailOrUsername . $password), time() + 60*60*24*7, '/');
                        }
                
                        $_SESSION['role'] = $u['role'];
                        $_SESSION['id'] = $u['id'];
                        $_SESSION['key'] = hash('sha256', $emailOrUsername . $password);

                        $_SESSION['login'] = true;

                        $_SESSION['username'] = $userDbs['username'];

                        return $u['role'];
                    }

                    if(isset($_POST['remember']))
                    {
                        setcookie('remember', true, time() + 60*60*24*7, '/');
                        setcookie('key', hash('sha256', $emailOrUsername . $password), time() + 60*60*24*7, '/');
                    }

                    $_SESSION['role'] = $u['role'];
                    $_SESSION['id'] = $u['id'];
                    $_SESSION['key'] = hash('sha256', $emailOrUsername . $password);
                    $_SESSION['login'] = true;
                    $_SESSION['username'] = $userDbs['username'];
        
                    return $u['role'];
                }
                else
                {
                    return false;
                }
            }
        }
        return false;
    }
}