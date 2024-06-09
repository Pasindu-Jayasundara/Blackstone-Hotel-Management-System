<?php
session_start();
require "../connection/connection.php";

if (!empty($_SESSION["admin"])) {

    $admin_id = $_POST["admin_id"];
    $status_id = $_POST["status_id"];

    $today = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $today->setTimezone($tz);
    $date = $today->format("Y-m-d H:i:s");

    $pending_admin_rs = Database::search("SELECT * FROM `admin` WHERE `admin`.`status_status_id`='3' AND `admin`.`admin_id`='".$admin_id."'");

    if($pending_admin_rs->num_rows == 1){//pending

        echo("5");

    }else if($pending_admin_rs->num_rows == 0){ //not pending

        if($status_id == 1){//deactivate

                // admin
                Database::iud("UPDATE `admin` SET `admin`.`status_status_id`='2' WHERE `admin`.`admin_id`='".$admin_id."' AND `admin`.`status_status_id`='1'");
    
                // mobile
                Database::iud("UPDATE `admin_mobile` SET `admin_mobile`.`status_status_id`='2' WHERE `admin_mobile`.`admin_admin_id`='".$admin_id."' AND `admin_mobile`.`status_status_id`='1'");
    
                // echo("De-Activation Successful");
                echo("1");
    
    
        }else if($status_id == 2){//activate
    
            // admin
            Database::iud("UPDATE `admin` SET `admin`.`status_status_id`='1' WHERE `admin`.`admin_id`='".$admin_id."' AND `admin`.`status_status_id`='2'");
    
            // mobile
            $mobile_rs = Database::search("SELECT `admin_mobile_id` FROM `admin_mobile` 
            WHERE `admin_mobile`.`admin_admin_id`='".$admin_id."' AND `admin_mobile`.`status_status_id`='2'");
            $mobile_data = $mobile_rs->fetch_assoc();
    
            Database::iud("UPDATE `admin_mobile` SET `admin_mobile`.`status_status_id`='1' 
            WHERE `admin_mobile`.`admin_admin_id`='".$admin_id."' AND `admin_mobile`.`status_status_id`='2'
            AND `admin_mobile`.`admin_mobile_id`='".$mobile_data["admin_mobile_id"]."'");
    
            // echo("Re-Activation Successful");
            echo("3");
    
        }

    }

}else{
    header("Location:index.php");
}

?>