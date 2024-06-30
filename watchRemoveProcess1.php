<?php
require "connection.php";
session_start();
$user = $_SESSION["u"];

$product = $_GET["id2"];
$product_rs = Database::iud("DELETE FROM `recent`WHERE `products_id`='".$product."'AND `customer_mobile`='".$user["mobile"]."' ");
echo("Success");

?>