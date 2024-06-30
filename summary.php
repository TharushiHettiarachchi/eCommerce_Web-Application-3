<?php
session_start();
$user = $_SESSION["u"];
require "connection.php";
$product = $_POST["id3"];
$qty = $_POST["q"];
$cartu_rs = Database::iud("UPDATE `cart` SET `qty` = '".$qty."' WHERE `products_id` = '".$product."'");
$cart_rs = Database::search("SELECT * FROM `cart` WHERE `customer_mobile` = '".$user["mobile"]."'");
$cart_num = $cart_rs->num_rows;
$items = 0;
for($x = 0; $x < $cart_num; $x++){
    $cart_data = $cart_rs->fetch_assoc();
$items = $items + $cart_data["qty"];
}
echo("Items(".$items.")");
?>