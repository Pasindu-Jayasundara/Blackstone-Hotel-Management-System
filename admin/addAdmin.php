<?php

session_start();
require "../connection/connection.php";

if(!empty($_SESSION["admin"])){

    $f_name = $_POST["first_name"];
    $l_name = $_POST["last_name"];
    $email = $_POST["email_address"];
    $mobile = $_POST["mobile_no"];

    if(!empty($f_name) && !empty($l_name) && !empty($email) && !empty($mobile)){

        if(filter_var($email,FILTER_VALIDATE_EMAIL)){

            if(strlen($mobile) == 10){

                $pattern = "/07[0,1,2,4,5,6,7,8][0-9]/";
                if(preg_match($pattern,$mobile)){
                    
                    $rs = Database::search("SELECT * FROM `admin` 
                    WHERE `admin`.`status_status_id`='1' AND `admin`.`email`='".$email."'");

                    if($rs->num_rows == 0){

                        $password = uniqid();

                        $today = new DateTime();
                        $tz = new DateTimeZone("Asia/Colombo");
                        $today->setTimezone($tz);
                        $date = $today->format("Y-m-d H:i:s");

                        Database::iud("INSERT INTO `admin`(`f_name`,`l_name`,`password`,`status_status_id`,`email`,`url`) 
                        VALUES('".$f_name."','".$l_name."','".$password."','1','".$email."','../designImages/admin.png')");

                        $admin_id = Database::$db_connection->insert_id;

                        Database::iud("INSERT INTO `admin_mobile`(`mobile`,`status_status_id`,`admin_admin_id`) 
                        VALUES('".$mobile."','1','".$admin_id."')");

                        $obj = new stdClass();
                        $obj->password = $password;
                        $obj->username = $email;
                        
                        $_SESSION["credential"] = json_encode($obj);

                        echo("1");

                    }else{
                        // echo("Admin Already Exists");
                        echo("2");
                    }

                }

            }

        }else{
            // echo("Invalid Email Address");
            echo("3");
        }

    }else{
        // echo("Fill The Details");
        echo("4");
    }

}else{
    header("Location:index.php");
}
?>