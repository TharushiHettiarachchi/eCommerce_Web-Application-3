<?php

session_start();
require "connection.php";

if(isset($_SESSION["u"])){
    $pid = $_GET["id"];
    $qty = $_GET["qty"];
    $umail = $_SESSION["u"]["mobile"];

    $array;
    $order_id = uniqid();

    $product_rs = Database::search("SELECT * FROM `products` WHERE `id` = '".$pid."'");
    $product_data = $product_rs->fetch_assoc();
    $city_rs = Database::search("SELECT * FROM `customer_has_address` WHERE `customer_mobile` = '".$umail."'");
    $city_num = $city_rs->num_rows;
    if($city_num == 1){
         $city_data = $city_rs->fetch_assoc();
         $city_id = $city_data["city_id"];
         $address = $city_data["line1"].".".$city_data["line2"];
         $district_rs = Database::search("SELECT * FROM `city` WHERE `id` = '".$city_id."'");
         $district_data = $district_rs->fetch_assoc();
         $district_id = $district_data["district_id"];
        
         $item = $product_data["product_name"];
         $amount = ((int)$product_data["price"] * (int)$qty) + 300;
    $fname = $_SESSION["u"]["fname"];
    $lname = $_SESSION["u"]["lname"];
    $mobile = $_SESSION["u"]["mobile"];
    $user_address = $address;
    $city = $district_data["name"];
    $merchant_id = "1221108";
    $currency="LKR";
    $merchant_secret = "MjgxODI2MzYzMTE5NzUzMTg1MzkxMDMyNzk4NjE2MzAwMDAzMTEwMQ==";
    $hash = strtoupper(
      md5(
          $merchant_id . 
          $order_id . 
          number_format($amount, 2, '.', '') . 
          $currency .  
          strtoupper(md5($merchant_secret)) 
      ) 
  );


    $array["id"] = $order_id;
    $array["item"] = $item;
    $array["amount"] = $amount;
    $array["fname"] = $fname;
    $array["lname"] = $lname;
    $array["mobile"] = $mobile;
    $array["addres"] = $address;
    $array["city"] = $city;
    $array["mail"] = $umail;
    $array["hash"] = $hash;

    echo json_encode($array);
    
    
    
    
    
        }else{
        echo("2");
    }
 } else{
   echo("1"); 
 }

?>