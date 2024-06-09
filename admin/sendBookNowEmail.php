<?php

session_start();
require "../connection/connection.php";

require "../connection/SMTP.php";
require "../connection/PHPMailer.php";
require "../connection/Exception.php";
require "../connection/OAuth.php";
require "../connection/POP3.php";

use PHPMailer\PHPMailer\PHPMailer;

$ref = $_SESSION["ref"];

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
$mail->setFrom($shop_data["email"], 'Booking Confirmation');
$mail->addReplyTo($shop_data["email"], 'Booking Confirmation');
$mail->addAddress($_SESSION["b_email"]);
$mail->isHTML(true);
$mail->Subject = 'Booking Confirmation';
$bodyContent = "Your Reference Number is:'" . $ref . "'";
$mail->Body = $bodyContent;


if ($mail->send()) {
    // echo("Credentials Emailed Successfully");
    echo("1");
} else {
    // echo("Credentials Email Process Faild");
    echo($_SESSION["ref"]);
}

unset($_SESSION["ref"]);
unset($_SESSION["b_email"]);

?>