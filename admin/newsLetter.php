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

    if(!empty($_POST["title"])){
     
        if(!empty($_POST["text"])){
            $hotel_rs = Database::search("SELECT * FROM `hotel` INNER JOIN `hotel_mobile` ON `hotel_mobile`.`hotel_hotel_id`=`hotel`.`hotel_id` 
            INNER JOIN `hotel_address` ON `hotel`.`hotel_address_hotel_address_id`=`hotel_address`.`hotel_address_id` 
            WHERE `hotel`.`status_status_id`='1' AND `hotel_mobile`.`status_status_id`='1' AND `hotel_address`.`status_status_id`='1'");

            $hotel_data = $hotel_rs->fetch_assoc();

            $text = $_POST["text"];
            $title = $_POST["title"];

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $hotel_data["email"];
            $mail->Password = $hotel_data["app_password_code"];;
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom($hotel_data["email"], "'".$hotel_data["name"]."' - NEWSLETTER");
            $mail->addReplyTo($hotel_data["email"], "'".$hotel_data["name"]."' - NEWSLETTER");
            $mail->isHTML(true);
            $mail->Subject = $title;
            $bodyContent = $text;
            

            $success = 0;
            $faild = 0;

            $ne_rs = Database::search("SELECT * FROM `news_letter` WHERE `news_letter`.`status_status_id`='1'");
            if($ne_rs->num_rows>0){
                for($x = 0; $x<$ne_rs->num_rows;$x++){
                    $ne_data = $ne_rs->fetch_assoc();

                    $mail->addAddress($ne_data["email"]);
                    $mail->Body = $bodyContent;

                                
                    if ($mail->send()) {
                        // echo(" Emailed Successfully");
                        $success = $success+1;

                    } else {
                        // echo(" Email Process Faild");
                        $faild = $faild+1;
                    }

                }

                Database::iud("INSERT INTO `news_letter_msg`(`msg`,`admin_admin_id`,`date_time`,`title`) 
                VALUES('".$text."','".$_SESSION["admin"]["admin_id"]."','".date("Y-m-d H:i:s")."','".$title."')");

                $obj = new stdClass();
                $obj->success = $success;
                $obj->faild = $faild;

                echo json_encode($obj);

            }else{
                // echo"you dont have any subscribers";
                echo("1");
            }

        }else{
            // echo("Please Insert Reply Msg");
            echo("2");
        }
        
    }else{
        // echo("insert title");
        echo("3");
    }

}else{
    header("Location:index.php");
}

?>