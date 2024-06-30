<?php
session_start();
require "connection.php";

$e1 = $_POST["e1"];
$p1 = $_POST["p1"];
$check = $_POST["c1"];

if(empty($e1)){
    echo("Please enter your Email!!!");
}else if(strlen($e1)>= 100){
    echo("Email must have less than 100 characters");
} else if(!filter_var($e1,FILTER_VALIDATE_EMAIL)){
echo("Invalid Email !!");
} else if(empty($p1)){
    echo("Please enter your Password!!!");
} else if(strlen($p1)<5 || strlen($p1)>20){
    echo("Password must have between 5 to 20 Characters");
} else{

$rs = Database::search("SELECT * FROM `customer` WHERE `email`='".$e1."' AND `password`='".$p1."' OR `email`='".$e1."' AND `verification_code`='".$p1."' ");
$n = $rs->num_rows;
if($n==1){
    echo("Success");
 $d = $rs->fetch_assoc();
 $_SESSION["u"]=$d;

 if($check=="1"){
    setcookie("email",$e1,time()+(60*60*24*365));
    setcookie("password",$p1,time()+(60*60*24*365));
 }else{

    setcookie("email","","-1");
    setcookie("password","","-1");
 }
 


} else{
    echo("Invalid Username or Password");
}

}
?>