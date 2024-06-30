<?php
require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";
use PHPMailer\PHPMailer\PHPMailer;


if(isset( $_GET["e"])){
    $email = $_GET["e"];

$rs = Database::search("SELECT * FROM `customer` WHERE `email`='".$email."'");
$n=$rs->num_rows;

if($n=1){

$code = uniqid();

Database::iud("UPDATE `customer` SET`verification_code`='".$code."'WHERE `email`='".$email."'");

$mail = new PHPMailer;
$mail->IsSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'tharushihettiarachchi12@gmail.com';
$mail->Password = 'fghebuxtnkpydnru';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->setFrom('tharushihettiarachchi12@gmail.com', 'Reset Password');
$mail->addReplyTo('tharushihettiarachchi12@gmail.com', 'Reset Password');
$mail->addAddress($email);
$mail->isHTML(true);
$mail->Subject = 'Sooper Password Verification Code';
$bodyContent =
'<h1 style="color:green">Your verification Code is '.$code.'. </h1><h4>Please Use this code to login. You can get your password from the profile.</h4>'
;

$mail->Body    = $bodyContent;

if(!$mail->send()){
echo("Verification code sending failed");
}else{
    echo("Verification code has been sent to your Email. Please use that code as the password to login");
}

} else{
    echo("Invalid Email address");
}

}


?>