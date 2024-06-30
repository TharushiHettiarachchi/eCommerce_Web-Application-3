<?php
require "connection.php";
$id = $_GET["id"];
Database::iud("UPDATE `invoice` SET `status` = '3' WHERE `order_id` = '".$id."'");
echo("Success");














?>