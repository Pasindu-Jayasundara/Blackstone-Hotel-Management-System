<?php

require "../connection/connection.php";
session_start();

if (!empty($_SESSION["admin"])) {

    if (!empty($_POST["app_password"]) && trim($_POST["map_link"])!='' && trim($_POST["fb_link"])!='' && !empty(ltrim($_POST["name"])) && !empty(ltrim($_POST["email"])) && !empty(ltrim($_POST["mobile"])) && !empty(ltrim($_POST["line_1"])) && !empty(ltrim($_POST["line_2"]))) {

        if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {

            if (($_SESSION["s_email"] === $_POST["email"] && $_SESSION["s_password"] === $_POST["app_password"]) || ($_SESSION["s_email"] != $_POST["email"] && $_SESSION["s_password"] != $_POST["app_password"])) {

                if (strlen($_POST["mobile"]) == 10) {

                    if (preg_match("/[07][1,2,4,5,6,7,8][0-9]/", $_POST["mobile"])) {

                        $app_password = $_POST["app_password"];

                        if ($_POST["b_img"] == 2) { //black img
                            $type = $_FILES["b_logo"]["type"];


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

                                $url = "../designImages/" . uniqid() . $new_type;
                                if (move_uploaded_file($_FILES["b_logo"]["tmp_name"], $url)) {

                                    Database::iud("UPDATE `hotel` SET `fb_link`='".$_POST["fb_link"]."',`map_link`='".$_POST["map_link"]."',`name`='" . $_POST["name"] . "',`email`='" . $_POST["email"] . "',`black_logo_url`='" . $url . "',`app_password_code`='" . $app_password . "' ");

                                    Database::iud("UPDATE `hotel_mobile` SET `mobile`='".$_POST["mobile"]."'");

                                    Database::iud("UPDATE `hotel_address` SET `line_1`='".$_POST["line_1"]."',`line_2`='".$_POST["line_2"]."'"); 


                                    // echo("Update Process Success");
                                    echo ("1");
                                } else {
                                    // echo("Logo Uploading Faild");
                                    echo ("2");
                                }
                            } else {
                                // echo('Invalid Logo File Format');
                                echo ('3');
                            }
                        } else if ($_POST["b_img"] == 1) {

                            Database::iud("UPDATE `hotel` SET `fb_link`='".$_POST["fb_link"]."',`map_link`='".$_POST["map_link"]."',
                            `name`='" . $_POST["name"] . "',`email`='" . $_POST["email"] . "',`app_password_code`='" . $app_password . "' ");

                            Database::iud("UPDATE `hotel_mobile` SET `mobile`='".$_POST["mobile"]."'");

                            Database::iud("UPDATE `hotel_address` SET `line_1`='".$_POST["line_1"]."',`line_2`='".$_POST["line_2"]."'"); 

                            // echo("Update Process Success");
                            echo ("1");
                        }

                        if ($_POST["w_img"] == 1) {

                            Database::iud("UPDATE `hotel` SET `fb_link`='".$_POST["fb_link"]."',`map_link`='".$_POST["map_link"]."',
                            `name`='" . $_POST["name"] . "',`email`='" . $_POST["email"] . "',`app_password_code`='" . $app_password . "' ");

                            Database::iud("UPDATE `hotel_mobile` SET `mobile`='".$_POST["mobile"]."'");

                            Database::iud("UPDATE `hotel_address` SET `line_1`='".$_POST["line_1"]."',`line_2`='".$_POST["line_2"]."'"); 

                            // echo("Update Process Success");
                            echo ("1");
                        }else if ($_POST["w_img"] == 2) { //white img
                            $type = $_FILES["w_logo"]["type"];


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

                                $url = "../designImages/" . uniqid() . $new_type;
                                if (move_uploaded_file($_FILES["w_logo"]["tmp_name"], $url)) {

                                    Database::iud("UPDATE `hotel` SET `fb_link`='".$_POST["fb_link"]."',`map_link`='".$_POST["map_link"]."',`name`='" . $_POST["name"] . "',`email`='" . $_POST["email"] . "',`logo_url`='" . $url . "',`app_password_code`='" . $app_password . "' ");

                                    Database::iud("UPDATE `hotel_mobile` SET `mobile`='".$_POST["mobile"]."'");

                                    Database::iud("UPDATE `hotel_address` SET `line_1`='".$_POST["line_1"]."',`line_2`='".$_POST["line_2"]."'"); 


                                    // echo("Update Process Success");
                                    echo ("1");
                                } else {
                                    // echo("Logo Uploading Faild");
                                    echo ("2");
                                }
                            } else {
                                // echo('Invalid Logo File Format');
                                echo ('3');
                            }
                        } 

                    } else {
                        // echo("In-valid Mobile Number");
                        echo ("4");
                    }
                } else {
                    // echo("Mobile Number Limit is 10"); 
                    echo ("5");
                }
            } else {
                echo ("8");
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
?>