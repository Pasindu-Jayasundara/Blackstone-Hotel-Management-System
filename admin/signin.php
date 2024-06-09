<?php

session_start();
require "../connection/connection.php";

if(!empty($_POST["email"]) && trim($_POST["email"] != '' && !empty($_POST["password"]) && trim($_POST["password"]) != '')){

    if(filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){

        $email = $_POST["email"];
        $password = $_POST["password"];

        $rs = Database::search("SELECT `admin`.`admin_id` AS `admin_id`,
        `admin`.`f_name` AS `f_name`,
        `admin`.`l_name` AS `l_name`,
        `admin`.`email` AS `email`,
        `admin`.`password` AS `password`,
        `admin`.`status_status_id` AS `admin_status_id`,
        `admin`.`url` AS `url`,
        `admin`.`tmp_code` AS `tmp_code`,
        `admin_mobile`.`admin_mobile_id` AS `admin_mobile_id`,
        `admin_mobile`.`mobile` AS `mobile`,
        `admin_mobile`.`admin_admin_id` AS `admin_admin_id`,
        `admin_mobile`.`status_status_id` AS `admin_mobile_status_id`

        FROM `admin` INNER JOIN `admin_mobile` ON `admin`.`admin_id`=`admin_mobile`.`admin_admin_id` 
        WHERE `admin`.`email`='".$email."' AND `admin`.`password`='".$password."'");

        if($rs->num_rows == 1){

            $data = $rs->fetch_assoc();

            if($data["admin_status_id"] == 1){//active

                $_SESSION["admin"] = $data;
                $_SESSION["login"] = "1";

                echo("1");

            }else if($data["admin_status_id"] == 2){//deactive

                echo("2");

            }

        }else{
            // echo("Invalid Details");
            echo("4");
        }

    }else{
        // echo("Incorrect Email Format");
        echo("5");
    }

}else{
    // echo("Provide Nessasary Details");
    echo("6");
}

?>