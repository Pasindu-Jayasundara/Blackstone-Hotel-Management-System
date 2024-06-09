<?php

session_start();
require "../connection/connection.php";

require "../connection/SMTP.php";
require "../connection/PHPMailer.php";
require "../connection/Exception.php";
require "../connection/OAuth.php";
require "../connection/POP3.php";

use PHPMailer\PHPMailer\PHPMailer;

if(trim($_POST["name"])!="" && trim($_POST["email"])!="" && filter_var($_POST["email"],FILTER_SANITIZE_EMAIL) && trim($_POST["msg"]) !="" && trim($_POST["title"])!=""){

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
    $mail->setFrom($shop_data["email"], 'Message');
    $mail->addReplyTo($shop_data["email"], 'Message');
    $mail->addAddress($_POST["email"]);
    $mail->isHTML(true);
    $mail->Subject = $_POST["title"];
    $bodyContent = "Your Message Sent -> '".$_POST["msg"]."'";
    $mail->Body = $bodyContent;


    if ($mail->send()) {
        // echo("Credentials Emailed Successfully");

        Database::iud("INSERT INTO `user_contact`(`name`,`email`,`msg_title`,`msg`) VALUES('".$_POST["name"]."','".$_POST["email"]."','".$_POST["title"]."','". filter_var($_POST["msg"],FILTER_SANITIZE_FULL_SPECIAL_CHARS) ."')");

        echo("1");
    } else {
        // echo("Credentials Email Process Faild");
        echo("2");
    }

}else{
    echo("3");
}
?>