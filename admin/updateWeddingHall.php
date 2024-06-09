<?php

session_start();
require "../connection/connection.php";

if (!empty($_SESSION["admin"])) {

    if (trim($_POST["name"]) != "" && trim($_POST["description"]) != "" && !empty($_POST["imgUp"]) && !empty($_POST["id"]) && !empty($_POST["img_id"])) {

        $id = $_POST["id"];
        $img_id = $_POST["img_id"];
        $name = $_POST["name"];
        $description = $_POST["description"];
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

                $newImageFileName = "../wedding_hall_image//" . $code . $new_image_extention;
                if (move_uploaded_file($file["tmp_name"], $newImageFileName)) {

                    $rs = Database::search("SELECT * FROM `wedding_hall` INNER JOIN `wedding_hall_image` ON
                    `wedding_hall_image`.`wedding_hall_wedding_hall_id` = `wedding_hall`.`wedding_hall_id`
                    WHERE `wedding_hall`.`wedding_hall_id` = '" . $id . "'");

                    Database::iud("UPDATE `wedding_hall_image` SET `url` = '" . $newImageFileName . "' 
                    WHERE `wedding_hall_wedding_hall_id` = '" . $id . "'  AND `wedding_hall_image_id`='".$img_id."'");

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

        $newDescription = filter_var($description,FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        Database::iud("UPDATE `wedding_hall` SET `wedding_hall`.`name`='".$name."',`wedding_hall`.`description`='".$newDescription."'
        WHERE `wedding_hall`.`wedding_hall_id`='".$id."'");

        echo("4");

    } else {
        echo ("1");
    }
} else {
    header("Location:index.php");
}

?>