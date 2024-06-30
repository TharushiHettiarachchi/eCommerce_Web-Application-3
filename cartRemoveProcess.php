<?php
require "connection.php";
$product = $_GET["id2"];
 
$product_rs = Database::iud("DELETE FROM `cart`WHERE `products_id`='".$product."' ");
echo("Success");

?>