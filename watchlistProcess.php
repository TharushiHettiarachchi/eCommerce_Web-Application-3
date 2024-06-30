<?php
session_start();
$user = $_SESSION["u"];
require "connection.php";
$product = $_GET["id1"];
 
$product_rs = Database::iud("INSERT INTO `watchlist` (`customer_mobile`,`products_id`) VALUES ('".$user["mobile"]."','".$product."')");

?>