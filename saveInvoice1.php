<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    $user = $_SESSION["u"];
    $o_id = $_POST["o"];

    $mail = $_POST["m"];
    $amount = $_POST["a"];
    $totQty = 0;

    $customer_rs = Database::search("SELECT * FROM `order` WHERE `order_id` = '" . $o_id . "'");
    $customer_num = $customer_rs->num_rows;
    for ($a = 0; $a < $customer_num; $a++) {
        $customer_data = $customer_rs->fetch_assoc();
        $product_rs1 = Database::search("SELECT * FROM `products` WHERE `id` = '" . $customer_data["products_id"] . "'");
        $product_data1 = $product_rs1->fetch_assoc();
        $totQty = $totQty + (int)$customer_data["qty"];
        $current_qty = $product_data1["quantity"];
        $new_qty = $current_qty - $customer_data["qty"];

        Database::iud("UPDATE `products` SET `quantity` = '" . $new_qty . "' WHERE `id` = '" . $customer_data["products_id"] . "' ");
    }




    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `invoice` (`order_id`,`date`,`total`,`qty`,`status`,`customer_mobile`) VALUES ('" . $o_id . "','" . $date . "','" . $amount . "','" . $totQty . "','0','" . $mail . "')");
    Database::iud("DELETE FROM `cart` WHERE `customer_mobile` = '" . $user["mobile"] . "'");
    echo ("1");
}
