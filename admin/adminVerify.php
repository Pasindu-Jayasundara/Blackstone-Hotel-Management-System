<?php
session_start();
require "../connection/connection.php";

require "../connection/SMTP.php";
require "../connection/PHPMailer.php";
require "../connection/Exception.php";
require "../connection/OAuth.php";
require "../connection/POP3.php";

use PHPMailer\PHPMailer\PHPMailer;

if(!empty($_SESSION["admin"])){

    $rs = Database::search("SELECT * FROM `admin`  
    WHERE `admin`.`admin_id`='".$_SESSION["admin"]["admin_id"]."' AND `admin`.`status_status_id`='1'");

    $num = $rs->num_rows;

    if($num == 1){

        $shop_rs = Database::search("SELECT * FROM `hotel`");
        $shop_data = $shop_rs->fetch_assoc();

        $data = $rs->fetch_assoc();

        $tmp_code = uniqid();

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $shop_data["email"];
        $mail->Password = $shop_data["app_password_code"];
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom($shop_data["email"], "'".$shop_data["name"]."' Forgot Password Email Verification");
        $mail->addReplyTo($shop_data["email"], 'Forgot Password');
        $mail->addAddress($data["email"]);
        $mail->isHTML(true);
        $mail->Subject = "'".$shop_data["name"]."' Forgot Password Email Verification";
        $bodyContent = "Your Verification Password is : '".$tmp_code."'";
        $mail->Body    = $bodyContent;

        if($mail->send()){
            Database::iud("UPDATE `admin` SET `admin`.`password`='".$tmp_code."' WHERE `admin`.`admin_id`='".$_SESSION["admin"]["admin_id"]."' 
            AND `admin`.`status_status_id`='1'");

            echo("1");

        }else{
            echo("2");
        }

    }else{
        echo("3");
        // couldnt find the email
    }

}else{
    header("Location:index.php");
}

?>