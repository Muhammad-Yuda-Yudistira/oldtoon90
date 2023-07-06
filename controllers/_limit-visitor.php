<?php
session_start();

$visitTimeLimit = 60 * 60 * 3;
$visitTimeStart = time();

$_SESSION['last_visit_time'] = $visitTimeStart;