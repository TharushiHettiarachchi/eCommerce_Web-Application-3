<?php

session_start();
require "connection.php";

if(isset($_SESSION["u"])){
    $o_id = $_POST["o"]; 
    $p_id = $_POST["i"];
    $mail = $_POST["m"];
    $amount = $_POST["a"];
    $qty = $_POST["q"];

$product_rs = Database::search("SELECT * FROM `products` WHERE `id` = '".$p_id."'");
$product_data = $product_rs->fetch_assoc();

$current_qty = $product_data["quantity"];
$new_qty = $current_qty - $qty;

Database::iud("UPDATE `products` SET `quantity` = '".$new_qty."' WHERE `id` = '".$p_id."' ");

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

Database::iud("INSERT INTO `invoice` (`order_id`,`date`,`total`,`qty`,`status`,`products_id`,`customer_mobile`) VALUES ('".$o_id."','".$date."','".$amount."','".$qty."','0','".$p_id."','".$mail."')");
echo("1");




}


?>