<?php

session_start();
require "../connection/connection.php";

if (!empty($_SESSION["admin"])) {

    $obj = new stdClass();

    if (strlen($_POST["name"]) < 45  && trim($_POST["name"]) != '' && !empty($_POST["type"]) && $_POST["type"] > 0) {

        $old_name = $_POST["name"];
        $name = filter_var($old_name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($_POST["type"] == 3) { // food

            if (!empty($_FILES["img"])) {

                $img = $_FILES["img"];

                $img_type = $img["type"];
                $valid_extension = ["image/jpeg", "image/png", "image/jpg"];
                if (in_array($img_type, $valid_extension)) {

                    $tmp_url = $img["tmp_name"];

                    if ($img_type == "image/jpeg") {
                        $new_extension = ".jpeg";
                    } else if ($img_type == "image/png") {
                        $new_extension = ".png";
                    } else if ($img_type == "image/jpg") {
                        $new_extension = ".jpg";
                    }

                    if($_POST["type"] == 3){
                        $fileName = "wedding_food_menu_image";
                    }

                    $new_url = "../".$fileName."/" . uniqid() . $new_extension;

                    if (move_uploaded_file($tmp_url, $new_url)) {

                        if ($_POST["type"] == "3") { // menu

                            $txt = $_POST["txt"];
                            $new_txt = filter_var($txt, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                            Database::iud("INSERT INTO `wedding_food_menu`(`name`,`food_menu_description`,`status_status_id`) 
                            VALUES('" . $name . "','" . $new_txt . "','1')");

                            $wfm_id = Database::$db_connection->insert_id;

                            Database::iud("INSERT INTO `wedding_food_menu_image`(`url`,`wedding_food_menu_wedding_food_menu_id`,`status_status_id`) 
                            VALUES('" . $new_url . "','" . $wfm_id . "','1')");


                            $obj->status = "bg-success";
                            $obj->txt = "Wedding Food Menu Adding Successful";
                        }
                    } else {
                        $obj->status = "bg-danger";
                        $obj->txt = "Image Uploading Faild";
                    }
                } else {
                    $obj->status = "bg-warning";
                    $obj->txt = "Invalid Image Format";
                }
            }

        }else if($_POST["type"] == 1){ // hall

            if (!empty($_FILES["img1"]) && !empty($_FILES["img2"]) && !empty($_POST["txt"]) && trim($_POST["txt"]) != '') {

                $img1 = $_FILES["img1"];
                $img2 = $_FILES["img2"];

                $img1_type = $img1["type"];
                $img2_type = $img2["type"];

                $valid_extension = ["image/jpeg", "image/png", "image/jpg"];
                if (in_array($img1_type, $valid_extension) && in_array($img2_type, $valid_extension)) {

                    $tmp1_url = $img1["tmp_name"];
                    $tmp2_url = $img2["tmp_name"];

                    if ($img1_type == "image/jpeg") {
                        $new1_extension = ".jpeg";
                    } else if ($img1_type == "image/png") {
                        $new1_extension = ".png";
                    } else if ($img1_type == "image/jpg") {
                        $new1_extension = ".jpg";
                    }

                    if ($img2_type == "image/jpeg") {
                        $new2_extension = ".jpeg";
                    } else if ($img2_type == "image/png") {
                        $new2_extension = ".png";
                    } else if ($img2_type == "image/jpg") {
                        $new2_extension = ".jpg";
                    }

                    if($_POST["type"] == 1){
                        $fileName = "wedding_hall_image";
                    }

                    $new1_url = "../".$fileName."/" . uniqid() . $new1_extension;
                    $new2_url = "../".$fileName."/" . uniqid() . $new2_extension;

                    if (move_uploaded_file($tmp1_url, $new1_url) && move_uploaded_file($tmp2_url, $new2_url)) {


                        if ($_POST["type"] == "1") { // hall

                            if (!empty($_POST["txt"]) && trim($_POST["txt"]) != '') {

                                $txt = $_POST["txt"];
                                $new_txt = filter_var($txt, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                                Database::iud("INSERT INTO `wedding_hall`(`name`,`description`,`status_status_id`) 
                                VALUES('" . $name . "','" . $new_txt . "','1')");

                                $wh_id = Database::$db_connection->insert_id;

                                Database::iud("INSERT INTO `wedding_hall_image`(`url`,`wedding_hall_wedding_hall_id`,`status_status_id`) 
                                VALUES('" . $new1_url . "','" . $wh_id . "','1')");

                                Database::iud("INSERT INTO `wedding_hall_image`(`url`,`wedding_hall_wedding_hall_id`,`status_status_id`) 
                                VALUES('" . $new2_url . "','" . $wh_id . "','1')");

                                $obj->status = "bg-success";
                                $obj->txt = "Wedding Hall Adding Successful";
                            } else {
                                $obj->status = "bg-danger";
                                $obj->txt = "Provide Necessary Details";
                            }
                        } 
                    } else {
                        $obj->status = "bg-danger";
                        $obj->txt = "Image Uploading Faild";
                    }
                } else {
                    $obj->status = "bg-warning";
                    $obj->txt = "Invalid Image Format";
                }
            }else{
                $obj->status = "bg-warning";
                $obj->txt = "Select 2 Images";
            }

        }else if ($_POST["type"] == 2) { // feature

            Database::iud("INSERT INTO `wedding_features`(`feature`,`status_status_id`) 
            VALUES('" . $name . "','1')");

            $obj->status = "bg-success";
            $obj->txt = "Wedding Feature Adding Successful";
        }
    } else {

        $obj->status = "bg-warning";
        $obj->txt = "Fill The Details";
    }

    echo json_encode($obj);
} else {
    header("Location:index.php");
}
?>