<?php 
require "config/config.php";

if($_COOKIE['remember'] == "admin")
{
    header("Location:" . $baseurl . "ui/user/admin.php");
    exit();
}
header("Location:" . $baseurl . "ui/user/main.php");
exit();
