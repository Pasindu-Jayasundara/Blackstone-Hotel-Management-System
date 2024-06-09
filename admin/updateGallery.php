<?php

session_start();
require "../connection/connection.php";

if (!empty($_SESSION["admin"])) {

    if (!empty($_POST["package"]) && !empty($_POST["imgUp"]) && !empty($_POST["id"])) {

        $id = $_POST["id"];
        $package = $_POST["package"];
        $imgStatus = $_POST["imgUp"];

        if ($imgStatus == "1") {

            $file = $_FILES["file"];
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

                $newImageFileName = "../gallery_image//" . $code . $new_image_extention;
                if (move_uploaded_file($file["tmp_name"], $newImageFileName)) {

                    $rs = Database::search("SELECT * FROM `gallery`  INNER JOIN `gallery_image` ON
                    `gallery_image`.`gallery_gallery_id` = `gallery`.`gallery_id`
                    WHERE `gallery`.`gallery_id` = '" . $id . "' ");
                    
                    Database::iud("UPDATE `gallery_image` SET `url` = '" . $newImageFileName . "' 
                    WHERE `gallery_gallery_id` = '" . $id . "' ");

                    if($rs->num_rows == 1){
                        $data = $rs->fetch_assoc();
                        unlink($data["url"]);
                    }

                    echo ("3");

                } else {
                    echo ("2");
                }
            }
        }

        Database::iud("UPDATE `gallery` SET `gallery`.`gallery_type_gallery_type_id`='".$package."' WHERE `gallery`.`gallery_id`='".$id."'");

        echo("4");

    } else {
        echo ("1");
    }
} else {
    header("Location:index.php");
}

?>