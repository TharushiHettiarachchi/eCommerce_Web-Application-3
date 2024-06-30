<?php
require "connection.php";
session_start();
$admin = $_SESSION["ad"];
$msg1 = $_POST["msg1"];
$customer = $_POST["to"];


$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

Database::iud("INSERT INTO `chat` (`sender_mobile`,`reciever_mobile`,`message`,`status`,`date`) VALUES ('".$admin["mobile"]."','".$customer."','".$msg1."','0','".$date."')");
echo("Success");
?>