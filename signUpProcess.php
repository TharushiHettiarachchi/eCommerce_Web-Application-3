<?php
require "connection.php";
$f1 = $_POST["f1"];
$l = $_POST["l"];
$m = $_POST["m"];
$e = $_POST["e"];
$p = $_POST["p"];
$g = $_POST["g"];

if(empty($f1)){
    echo("Please enter your First Name!!!");
}else if(strlen($f1)>50){
    echo("First Name must have less than 50 characters!");
} else if(empty($l)){
    echo("Please enter your Last Name!!!");
}else if(strlen($l)>50){
    echo("Last Name must have less than 50 characters!");
} else if(empty($e)){
    echo("Please enter your Email!!!");
}else if(strlen($e)>= 100){
    echo("Email must have less than 100 characters!");
} else if(!filter_var($e,FILTER_VALIDATE_EMAIL)){
echo("Invalid Email !!");
} else if(empty($p)){
    echo("Please enter your Password!!!");
} else if(strlen($p)<5 || strlen($p)>20){
    echo("Password must be between 5 and 20 characters!");
}else if(empty($m)){
    echo("Please enter your Mobile Number!!!");
} else if(strlen($m)>10){
    echo("Mobile must have 10 Characters !!");
} else if(!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/",$m)){
echo("Invalid Mobile Number !!");
} else{
    
    $rs = Database::search("SELECT *FROM `customer` WHERE `mobile`='".$m."'");
    $n = $rs->num_rows;

    if($n>0){
        echo("User with a same Email or Mobile Number already exists");
    } else{
      $d =  new DateTime();
     $tz =  new DateTimeZone("Asia/Colombo");
     $d->setTimezone($tz);
     $date = $d->format("Y-m-d H:i:s");

Database::iud("INSERT INTO `customer`(`fname`,`lname`,`email`,`mobile`,`password`,`gender_id`,`joined_date`,`status`)
VALUES ('".$f1."','".$l."','".$e."','".$m."','".$p."','".$g."','".$date."','1')");
echo("Success");


    }
}




?>