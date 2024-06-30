<?php
session_start();
require "connection.php";
$vcode = $_GET["vcode"];

$admin_rs = Database::search("SELECT * FROM `admin` WHERE `verification_code` = '".$vcode."'");
$admin_num = $admin_rs->num_rows;
if($admin_num == 1){
    $admin_data = $admin_rs->fetch_assoc();
    $_SESSION["ad"] = $admin_data;
    echo("Done");
}























?>