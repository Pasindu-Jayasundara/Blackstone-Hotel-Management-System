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

    if(!empty($_POST["email"])){
     
        if(!empty($_POST["replyMsg"])){
            $hotel_rs = Database::search("SELECT * FROM `hotel` INNER JOIN `hotel_mobile` ON `hotel_mobile`.`hotel_hotel_id`=`hotel`.`hotel_id` 
            INNER JOIN `hotel_address` ON `hotel`.`hotel_address_hotel_address_id`=`hotel_address`.`hotel_address_id` 
            WHERE `hotel`.`status_status_id`='1' AND `hotel_mobile`.`status_status_id`='1' AND `hotel_address`.`status_status_id`='1'");

            $hotel_data = $hotel_rs->fetch_assoc();

            $email = $_POST["email"];
            $replyMsg = $_POST["replyMsg"];
            
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $hotel_data["email"];
            $mail->Password = $hotel_data["app_password_code"];;
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom($hotel_data["email"], "'".$hotel_data["name"]."' - Reply For Your Message");
            $mail->addReplyTo($hotel_data["email"], "'".$hotel_data["name"]."' - Reply For Your Message");
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Reply For Your Message';
            $bodyContent = $replyMsg;
            $mail->Body = $bodyContent;
            
            
            if ($mail->send()) {
                // echo(" Emailed Successfully");

                Database::iud("INSERT INTO `reply`(`reply_msg`,`user_contact_user_contact_id`,`date_time`) 
                VALUES('".$replyMsg."','".$_SESSION["clicked_msg_id"]."','".date("Y-m-d H:i:s")."')");

                echo("1");
            } else {
                // echo(" Email Process Faild");
                echo("2");
            }

        }else{
            // echo("Please Insert Reply Msg");
            echo("3");
        }
        
    }else{
        // echo("Something Went Wrong");
        echo("4");
    }

}else{
    header("Location:index.php");
}

?>