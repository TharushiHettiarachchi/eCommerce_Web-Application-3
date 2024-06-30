<?php
require "connection.php";
session_start();
$user = $_SESSION["u"];
$product = $_GET["id1"];
 
$product_rs = Database::iud("INSERT INTO `cart` (`customer_mobile`,`products_id`,`qty`) VALUES ('".$user["mobile"]."','".$product."','1')");

?>