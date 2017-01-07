<?php
include('helper.php');

$date=$_POST['date'];
$time=$_POST['time'];
$room_id=$_POST['room_id'];
$name=$_POST['name'];
$res=SendMessage($date,$time,$name,$room_id);
print_r($res);
?>
