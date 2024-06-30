<?php
require "connection.php";
session_start();
$user = $_SESSION["u"];

$com = $_POST["comment2"];
$rate = $_POST["val"];
$pid = $_POST["id"];
$id1 = $_POST["id1"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");


Database::iud("INSERT INTO `feedback` (`customer_mobile`,`feedback`,`products_id`,`date`,`status`) VALUES ('" . $user["mobile"] . "','" . $com . "','" . $pid . "','" . $date . "','" . $rate . "')");


Database::iud("UPDATE `order` SET `fid` = '1' WHERE `order_id`='" . $id1 . "' AND `products_id` = '" . $pid . "' ");





echo ("Success");
