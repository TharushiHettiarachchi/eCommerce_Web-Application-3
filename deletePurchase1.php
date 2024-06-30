<?php
require "connection.php";
session_start();

$mobile = $_GET["mobile"];
$invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `customer_mobile` = '".$mobile."'");
$invoice_num = $invoice_rs->num_rows;
if($invoice_num > 0){

for($a=0; $a<$invoice_num; $a++){

    $invoice_data = $invoice_rs->fetch_assoc();
    if($invoice_data["status"] == 3){
        Database::iud("INSERT INTO `deleted_purchases`(`id`,`order_id`,`product_id`,`customer_mobile`,`status`,`date`,`total`,`qty`,`fid`) VALUES 
        ('".$invoice_data["id"]."','".$invoice_data["order_id"]."','".$invoice_data["product_id"]."','".$invoice_data["customer_mobile"]."','".$invoice_data["status"]."','".$invoice_data["date"]."','".$invoice_data["total"]."','".$invoice_data["qty"]."','".$invoice_data["fid"]."')");
        Database::iud("DELETE  FROM `invoice` WHERE `id` = '".$invoice_data["id"]."'");
    }
   
    



}

echo("Success");
}else{
    echo("Something Went Wrong");
}
