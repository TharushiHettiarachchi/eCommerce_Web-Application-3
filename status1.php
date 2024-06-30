<?php
require "connection.php";
$id = $_GET["id"];
Database::iud("UPDATE `invoice` SET `status` = '1' WHERE `id` = '".$id."'");
echo("Success");

?>