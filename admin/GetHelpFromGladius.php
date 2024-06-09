<?php
session_start();
require "../connection/connection.php";

include "../connection/Exception.php";
include "../connection/OAuth.php";
include "../connection/PHPMailer.php";
include "../connection/POP3.php";
include "../connection/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;

if(!empty($_SESSION["admin"])){

    if(!empty($_POST["from"]) && trim($_POST["from"]) !="" && !empty($_POST["topic"]) && trim($_POST["topic"]) !="" && !empty($_POST["text"]) && trim($_POST["text"]) !=""){
    
        $form = $_POST["from"];
        
        if(filter_var($form,FILTER_VALIDATE_EMAIL)){

            $topic = $_POST["topic"];
            $text = $_POST["text"];

            $hotel_rs = Database::search("SELECT * FROM `hotel` INNER JOIN `hotel_mobile` ON `hotel_mobile`.`hotel_hotel_id`=`hotel`.`hotel_id` 
            INNER JOIN `hotel_address` ON `hotel`.`hotel_address_hotel_address_id`=`hotel_address`.`hotel_address_id` 
            WHERE `hotel`.`status_status_id`='1' AND `hotel_mobile`.`status_status_id`='1' AND `hotel_address`.`status_status_id`='1'");

            $hotel_data = $hotel_rs->fetch_assoc();

            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $hotel_data["email"];
            $mail->Password = $hotel_data["app_password_code"];
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom($hotel_data["email"], 'Email From '.$hotel_data["name"]);
            $mail->addReplyTo($hotel_data["email"], 'Suggestion '.$hotel_data["name"]);
            $mail->addAddress($form);
            $mail->isHTML(true);
            $mail->Subject = $topic;
            $bodyContent = $text;
            $mail->Body    = $bodyContent;

            if(!$mail->send()){
                echo("4");
            }else{
                echo("3");
            }

        }else{
            echo("2");
        }

    }else{
        echo("1");
    }

}

?>