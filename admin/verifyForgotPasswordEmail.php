<?php
session_start();
require "../connection/connection.php";

require "../connection/SMTP.php";
require "../connection/PHPMailer.php";
require "../connection/Exception.php";
require "../connection/OAuth.php";
require "../connection/POP3.php";

use PHPMailer\PHPMailer\PHPMailer;

if(!empty($_POST["forgot_password_email"])){

    $rs = Database::search("SELECT * FROM `admin` 
    WHERE `admin`.`email`='".$_POST["forgot_password_email"]."' AND `admin`.`status_status_id`='1'");

    $num = $rs->num_rows;

    if($num == 1){

        $hotel_rs = Database::search("SELECT * FROM `hotel` INNER JOIN `hotel_mobile` ON `hotel_mobile`.`hotel_hotel_id`=`hotel`.`hotel_id` 
        INNER JOIN `hotel_address` ON `hotel`.`hotel_address_hotel_address_id`=`hotel_address`.`hotel_address_id` 
        WHERE `hotel`.`status_status_id`='1' AND `hotel_mobile`.`status_status_id`='1' AND `hotel_address`.`status_status_id`='1'");

        $hotel_data = $hotel_rs->fetch_assoc();

        $data = $rs->fetch_assoc();

        $tmp_code = uniqid();

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $hotel_data["email"];
        $mail->Password = $hotel_data["app_password_code"];;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom($hotel_data["email"], " '".$hotel_data["name"]."' Forgot Password Email Verification");
        $mail->addReplyTo($hotel_data["email"], 'Reset Password');
        $mail->addAddress($_POST["forgot_password_email"]);
        $mail->isHTML(true);
        $mail->Subject = "'".$hotel_data["name"]."' Forgot Password Email Verification";
        $bodyContent = "Your Verification Code is : '".$tmp_code."'";
        $mail->Body    = $bodyContent;

        if($mail->send()){
            Database::iud("UPDATE `admin` SET `admin`.`tmp_code`='".$tmp_code."' WHERE `admin`.`admin_id`='".$data["admin_id"]."'");
            $_SESSION["id"] = $data["admin_id"];
            echo("5");

        }else{
            echo("2");
        }

    }else{
        echo("1");
    }

}else{
    echo("3");
}

?>