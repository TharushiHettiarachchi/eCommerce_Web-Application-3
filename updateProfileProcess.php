<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    $line1 = $_POST["l1"];
    $line2 = $_POST["l2"];
    $province = $_POST["p"];
    $district = $_POST["d"];
    $city = $_POST["c"];
    $pcode = $_POST["pc"];

    if (isset($_FILES["image"])) {
        
        $image = $_FILES["image"];

        $allowed_image_extentions = array("image/jpg", "image/jpeg", "image/svg+xml", "image/png");
        $file_ex = $image["type"];


        if (!in_array($file_ex, $allowed_image_extentions)) {
            echo ("Please a valid image");
        } else {

            $new_file_extention;
            if ($file_ex == "image/jpg") {
                $new_file_extention = ".jpg";
            } else if ($file_ex == "image/jpeg") {
                $new_file_extention = ".jpeg";
            } else if ($file_ex == "image/png") {
                $new_file_extention = ".png";
            } else if ($file_ex == "image/svg+xml") {
                $new_file_extention = ".svg";
            }

            $file_name = "resource/profile_img/" . $_SESSION["u"]["fname"] . "_" . uniqid() . $new_file_extention;
            move_uploaded_file($image["tmp_name"], $file_name);
            $image_rs = Database::search("SELECT * FROM `customer` WHERE `mobile`='" . $_SESSION["u"]["mobile"] . "' ");
            $image_num = $image_rs->num_rows;
            if ($image_num == 1) {
                Database::iud("UPDATE `customer` SET `profile_pic`='" . $file_name . "' WHERE `mobile` = '" . $_SESSION["u"]["mobile"] . "'");
            }
        }
    }

    $address_rs = Database::search("SELECT * FROM `customer_has_address` WHERE `customer_mobile` = '" . $_SESSION["u"]["mobile"] . "'");
    $address_num = $address_rs->num_rows;
    if ($address_num == 1) {
        Database::iud("UPDATE `customer_has_address` SET `line1` = '" . $line1 . "',`line2` = '" . $line2 . "',`city_id` = '" . $city . "', `postal_code` = '" . $pcode . "'WHERE `customer_mobile` = '" . $_SESSION["u"]["mobile"] . "'");
    } else {
        Database::iud("INSERT INTO `customer_has_address` (`line1`,`line2`,`city_id`,`postal_code`,`customer_mobile`) VALUES ('" . $line1 . "','" . $line2 . "','" . $city . "','" . $pcode . "','" . $_SESSION["u"]["mobile"] . "')");
    }
    echo("Profile Successfully Updated");
} else {
    echo ("Please Login First");
}
