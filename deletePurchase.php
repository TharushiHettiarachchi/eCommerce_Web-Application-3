<?php
require "connection.php";
session_start();

$id = $_GET["id"];
$invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `id` = '".$id."'");
$invoice_num = $invoice_rs->num_rows;
if($invoice_num == 1){
$invoice_data = $invoice_rs->fetch_assoc();
echo("ok");
echo($invoice_data["products_id"]);
Database::iud("INSERT INTO `deleted_purchases`(`id`,`order_id`,`products_id`,`customer_mobile`,`status`,`date`,`total`,`qty`,`fid`) VALUES 
('".$invoice_data["id"]."','".$invoice_data["order_id"]."','".$invoice_data["products_id"]."','".$invoice_data["customer_mobile"]."','".$invoice_data["status"]."','".$invoice_data["date"]."','".$invoice_data["total"]."','".$invoice_data["qty"]."','".$invoice_data["fid"]."')");
Database::iud("DELETE  FROM `invoice` WHERE `id` = '".$id."'");
echo("Success");
}else{
    echo("Something Went Wrong");
}




































?>