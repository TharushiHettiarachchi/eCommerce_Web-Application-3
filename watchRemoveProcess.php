<?php
require "connection.php";
session_start();
$user = $_SESSION["u"];

$product = $_GET["id2"];
Database::iud("INSERT INTO `recent` (`customer_mobile`,`products_id`) VALUES ('0766365130','".$product."')");
$product_rs = Database::iud("DELETE FROM `watchlist`WHERE `products_id`='".$product."'AND `customer_mobile`='".$user["mobile"]."' ");
echo("Success");

?>