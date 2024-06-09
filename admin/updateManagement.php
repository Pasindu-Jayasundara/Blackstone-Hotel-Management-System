<?php

session_start();
require "../connection/connection.php";

if (!empty($_SESSION["admin"])) {

    if (trim($_POST["name"]) != "" && trim($_POST["position"]) != "" && !empty($_POST["position"]) && !empty($_POST["imgUp"]) && !empty($_POST["id"])) {

        $id = $_POST["id"];
        $name = $_POST["name"];
        $position = $_POST["position"];
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

                $newImageFileName = "../management_image//" . $code . $new_image_extention;
                if (move_uploaded_file($file["tmp_name"], $newImageFileName)) {

                    $rs = Database::search("SELECT * FROM `management` INNER JOIN `management_img` ON
                    `management_img`.`management_management_id` = `management`.`management_id`
                    WHERE `management`.`management_id` = '" . $id . "' ");
                    
                    Database::iud("UPDATE `management_img` SET `url` = '" . $newImageFileName . "' 
                    WHERE `management_management_id` = '" . $id . "' ");

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

        $newName = filter_var($name,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $newPosition = filter_var($position,FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        Database::iud("UPDATE `management` SET `management`.`name`='".$newName."',`management`.`position`='".$newPosition."'
        WHERE `management`.`management_id`='".$id."'");

        echo("4");

    } else {
        echo ("1");
    }
} else {
    header("Location:index.php");
}

?>