<?php

session_start();
require "../connection/connection.php";

require "../connection/SMTP.php";
require "../connection/PHPMailer.php";
require "../connection/Exception.php";
require "../connection/OAuth.php";
require "../connection/POP3.php";

use PHPMailer\PHPMailer\PHPMailer;

$credential_obj = $_SESSION["credential"];
$obj = json_decode($credential_obj);

$password = $obj->password;
$email = $obj->username;

$shop_rs = Database::search("SELECT * FROM `hotel`");
$shop_data = $shop_rs->fetch_assoc();

$mail = new PHPMailer;
$mail->IsSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = $shop_data["email"];
$mail->Password = $shop_data["app_password_code"];
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->setFrom($shop_data["email"], 'Admin Invitation');
$mail->addReplyTo($shop_data["email"], 'Reset Password');
$mail->addAddress($email);
$mail->isHTML(true);
$mail->Subject = 'Admin Username And Password';
$bodyContent = "Your Username is:" . $email . " </br> Your Password is:" . $password;
$mail->Body = $bodyContent;


if ($mail->send()) {
    // echo("Credentials Emailed Successfully");
    echo("1");
} else {
    // echo("Credentials Email Process Faild");
    echo("2");
}

unset($_SESSION["credential"]);

?>