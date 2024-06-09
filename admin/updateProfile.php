<?php

require "../connection/connection.php";
session_start();

if (!empty($_SESSION["admin"])) {

    if (!empty(ltrim($_POST["f_name"])) && !empty(ltrim($_POST["l_name"])) && !empty(ltrim($_POST["email"])) && !empty(ltrim($_POST["mobile"]))) {

        if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {

            if (strlen($_POST["mobile"]) == 10) {

                if (preg_match("/[07][1,2,4,5,6,7,8][0-9]/", $_POST["mobile"])) {

                    if ($_POST["img"] == 2) {
                        $type = $_FILES["profile"]["type"];


                        $valid = ['image/png', 'image/jpg', 'image/jpeg'];

                        if (in_array($type, $valid)) {

                            $new_type;
                            if ($type == 'image/png') {
                                $new_type = '.png';
                            } else if ($type == 'imnage/jpg') {
                                $new_type = '.jpg';
                            } else if ($type == 'image/jpeg') {
                                $new_type = '.jpeg';
                            }

                            $url = "../admin_profile_image/" . uniqid() . $new_type;
                            if (move_uploaded_file($_FILES["profile"]["tmp_name"], $url)) {

                                if($_SESSION["admin"]["url"] != "../designImages/admin.png"){

                                    if(file_exists($_SESSION["admin"]["url"])){
                                        unlink($_SESSION["admin"]["url"]);
                                    }

                                }

                                Database::iud("UPDATE `admin` SET `f_name`='" . $_POST["f_name"] . "',`l_name`='" . $_POST["l_name"] . "',`email`='".$_POST["email"]."',`url`='".$url."' 
                                WHERE `admin`.`admin_id`='" . $_SESSION["admin"]["admin_id"] . "'");

                                Database::iud("UPDATE `admin_mobile` SET `admin_mobile`.`mobile`='" . $_POST["mobile"] . "' 
                                WHERE `admin_mobile`.`admin_admin_id`='" . $_SESSION["admin"]["admin_id"] . "' AND `admin_mobile`.`status_status_id`='1' ");


                                // echo("Update Process Success");
                                echo ("1");
                            } else {
                                // echo("img Uploading Faild");
                                echo ("2");
                            }
                        } else {
                            // echo('Invalid img File Format');
                            echo ('3');
                        }
                    } else if ($_POST["img"] == 1) {

                        Database::iud("UPDATE `admin` SET `f_name`='" . $_POST["f_name"] . "',`l_name`='" . $_POST["l_name"] . "',`email`='".$_POST["email"]."' 
                        WHERE `admin`.`admin_id`='" . $_SESSION["admin"]["admin_id"] . "'");

                        Database::iud("UPDATE `admin_mobile` SET `admin_mobile`.`mobile`='" . $_POST["mobile"] . "' 
                        WHERE `admin_mobile`.`admin_admin_id`='" . $_SESSION["admin"]["admin_id"] . "' AND `admin_mobile`.`status_status_id`='1' ");


                        // echo("Update Process Success");
                        echo ("1");
                    }


                    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `admin`.`admin_id`='" . $_SESSION["admin"]["admin_id"] . "' 
                    AND `admin`.`status_status_id`='1'");

                    $admin_data = $admin_rs->fetch_assoc();

                    $_SESSION["admin"] = $admin_data;
                } else {
                    // echo("In-valid Mobile Number");
                    echo ("4");
                }
            } else {
                // echo("Mobile Number Limit is 10");
                echo ("5");
            }
        } else {
            // echo("In-valid Email Address");
            echo ("6");
        }
    } else {
        // echo("Fill The Details");
        echo ("7");
    }
} else {
    header("Location:index.php");
}
