<?php
require "connection.php";
$pname = $_POST["pname"];
$pdescription = $_POST["pdescription"];
$ptype = $_POST["ptype"];
$pprice = $_POST["pprice"];

if (isset($_FILES["pimage"])) {
        
    $pimage = $_FILES["pimage"];

    $allowed_image_extentions = array("image/jpg", "image/jpeg", "image/svg+xml", "image/png");
    $file_ex = $pimage["type"];


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

        $file_name = "pic/". "_" . uniqid() . $new_file_extention;
        move_uploaded_file($pimage["tmp_name"], $file_name);
       
    }
}

Database::iud("INSERT INTO `products`(`product_name`,`price`,`description`,`product_types_id`,`status_id`,`quantity`,`pic`) VALUES ('".$pname."','".$pprice."','".$pdescription."','".$ptype."','1','0','".$file_name."')");
echo("success");
?>