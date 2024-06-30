<?php

require "connection.php";
session_start();
$user = $_SESSION["u"];
Database::iud("DELETE  FROM `cart` WHERE `customer_mobile` = '".$user["mobile"]."'");
echo("Success");
?>