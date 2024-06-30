<?php
require "connection.php";
session_start();
if(isset($_SESSION["u"])){
$msg = $_POST["messg"];
$user = $_SESSION["u"]["mobile"];


$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");


Database::iud("INSERT INTO `chat`(`sender_mobile`,`reciever_mobile`,`message`,`status`,`date`) VALUES ('".$user."','0712301748','".$msg."','1','".$date."')");
echo("Success");
















}else{
    echo("Please Sign In");
}


























?>