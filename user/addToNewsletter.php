<?php

require "../connection/connection.php";

require "../connection/SMTP.php";
require "../connection/PHPMailer.php";
require "../connection/Exception.php";
require "../connection/OAuth.php";
require "../connection/POP3.php";

use PHPMailer\PHPMailer\PHPMailer;

if(!empty($_POST["email"])){

    if(filter_var($_POST["email"],FILTER_VALIDATE_EMAIL) && strlen($_POST["email"])<100){

        $email = $_POST["email"];

        Database::iud("INSERT INTO `news_letter`(`email`,`status_status_id`) 
        VALUES('".$email."','1')");

        $hotel_rs = Database::search("SELECT * FROM `hotel` INNER JOIN `hotel_mobile` ON `hotel_mobile`.`hotel_hotel_id`=`hotel`.`hotel_id` 
        INNER JOIN `hotel_address` ON `hotel`.`hotel_address_hotel_address_id`=`hotel_address`.`hotel_address_id` 
        WHERE `hotel`.`status_status_id`='1' AND `hotel_mobile`.`status_status_id`='1' AND `hotel_address`.`status_status_id`='1'");

        $hotel_data = $hotel_rs->fetch_assoc();

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $hotel_data["email"];
        $mail->Password = $hotel_data["app_password_code"];;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom($hotel_data["email"], "'".$hotel_data["name"]."' - NEWSLETTER REGISTRATION");
        $mail->addReplyTo($hotel_data["email"], "'".$hotel_data["name"]."' - NEWSLETTER TRGISTRATION");
        $mail->isHTML(true);
        $mail->Subject = "NEWSLETTER REGISTRATION";
        $bodyContent = "You Have Successfuly Registered With '".$hotel_data["name"]."' NEWSLETTER";
        $mail->addAddress($email);
        $mail->Body = $bodyContent;

        if ($mail->send()) {
            // echo(" Emailed Successfully");
            echo("3");
        } else {
            // echo(" Email Process Faild");
            echo("2");
        }

    }else{
        echo("4");
    }

}else{
    echo("1");
}

?>