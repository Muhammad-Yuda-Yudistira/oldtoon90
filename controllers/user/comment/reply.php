<?php
require "./../../../models/user/comment/replyModel.php";

if(isset($_POST['balas']))
{
    $from = $_POST['from'];
    $to = $_POST['to'];
    $message = $_POST['message'];
    addReply($from, $to, $message);
}
?>