<?php
session_start();

require "../../config/config.php";

$_SESSION = [];
session_unset();
session_destroy();

setcookie('remember', '', time() - 3600, '/');
setcookie('email', '', time() - 3600, '/');

setcookie('key', '', time() - 3600, '/');
setcookie('login', '', time() - 3600, '/');

header("Location: $baseurl");