<?php
require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;


if (isset($_POST["email"])) {
    $email = $_POST["email"];
    $code = $_POST["code"];

    $user_rs = Database::search("SELECT * FROM `admin` WHERE `email` = '" . $email . "' ");
    $user_num = $user_rs->num_rows;

    if ($user_num == 1) {
        Database::iud("UPDATE `admin` SET `verification_code` = '" . $code . "' WHERE `email` = '" . $email . "'");
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
        $mail->Subject = 'Sooper Vegan Admin Verification Code';
        $bodyContent = '<h1 style="color:green">Your verification Code is ' . $code . '</h1>';

        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo ("Verification code sending failed");
        } else {
            
            echo ("Success");
        }
    } else {
        echo ("Invalid Email address");
    }
}
