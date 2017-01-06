<?php
include('helper.php');

print_r($_POST);
die();
$message=$_POST['message'];
$room_id=$_POST['room_id'];
SendMessage($message,$room_id);

?>
