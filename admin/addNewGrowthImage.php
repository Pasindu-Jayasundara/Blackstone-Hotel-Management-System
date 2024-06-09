<?php
session_start();
require "../connection/connection.php";

if (!empty($_SESSION["admin"])) {

    if (sizeof($_FILES["img"]) == 6) {

        $file = $_FILES["img"];
        $imageType = $file["type"];
        $allowed_Image_extentions = array("image/jpg", "image/png", "image/jpeg", "image/svg+xml");

        if (in_array($imageType, $allowed_Image_extentions)) {

            $new_image_extention;
            if ($imageType == "image/jpg") {
                $new_image_extention = ".jpg";
            } else if ($imageType == "image/png") {
                $new_image_extention = ".png";
            } else if ($imageType == "image/jpeg") {
                $new_image_extention = ".jpeg";
            } else if ($imageType == "image/svg") {
                $new_image_extention = ".svg";
            }

            $code = uniqid();

            $newImageFileName = "../growth_image//" . $code . $new_image_extention;
            if (move_uploaded_file($file["tmp_name"], $newImageFileName)) {

                Database::iud("INSERT INTO `growth_images`(`url`,`growth_growth_id`,`status_status_id`) 
                VALUES('" . $newImageFileName . "','1','1')"); 

                echo ("3");
            } else {
                echo ("2");
            }

        }else{
            echo("4");
        }

    } else {
        echo ("1");
    }
} else {
    header("Location:index.php");
}
?>