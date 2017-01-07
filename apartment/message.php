<?php
include('helper.php');

$date=$_POST['date'];
$time=$_POST['time'];
$room_id=$_POST['room_id'];
$res=SendMessage($date,$time,$room_id);
print_r($res);
?>
