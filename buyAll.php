<?php
session_start();
require "connection.php";
if (isset($_SESSION["u"])) {
    $umail = $_SESSION["u"]["mobile"];

    $array;
    $order_id = uniqid();
    $customer_rs = Database::search("SELECT * FROM `cart` WHERE `customer_mobile` = '" . $umail . "'");
    $customer_num = $customer_rs->num_rows;
    $tot = 0;
    for ($a = 0; $a < $customer_num; $a++) {
        $customer_data = $customer_rs->fetch_assoc();
        Database::iud("INSERT INTO `order`(`order_id`,`products_id`,`qty`) VALUES ('" . $order_id . "','" . $customer_data["products_id"] . "','" . $customer_data["qty"] . "')");
        $product_rs = Database::search("SELECT * FROM `products` WHERE `id` = '" . $customer_data["products_id"] . "'");
        $product_data = $product_rs->fetch_assoc();
        $tot = $tot + ((int)$product_data["price"] * (int)$customer_data["qty"]);
    }
    $city_rs = Database::search("SELECT * FROM `customer_has_address` WHERE `customer_mobile` = '" . $umail . "'");
    $city_num = $city_rs->num_rows;
    if ($city_num == 1) {
        $city_data = $city_rs->fetch_assoc();
        $city_id = $city_data["city_id"];
        $address = $city_data["line1"] . "." . $city_data["line2"];
        $district_rs = Database::search("SELECT * FROM `city` WHERE `id` = '" . $city_id . "'");
        $district_data = $district_rs->fetch_assoc();
        $district_id = $district_data["district_id"];


        $amount = $tot + 300;
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
        $array["item"] = $order_id;
        $array["amount"] = $amount;
        $array["fname"] = $fname;
        $array["lname"] = $lname;
        $array["mobile"] = $mobile;
        $array["addres"] = $address;
        $array["city"] = $city;
        $array["mail"] = $umail;
        $array["hash"] = $hash;

        echo json_encode($array);
    } else {
        echo ("2");
    }
} else {
    echo ("1");
}
?>