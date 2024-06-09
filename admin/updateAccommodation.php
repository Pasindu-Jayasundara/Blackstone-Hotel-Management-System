<?php

session_start();
require "../connection/connection.php";

if (!empty($_SESSION["admin"])) {

    if (trim($_POST["name"]) != "" && trim($_POST["size"]) != "" && trim($_POST["description"]) != "" && !empty($_POST["package"]) && !empty($_POST["imgUp"]) && !empty($_POST["id"])) {

        $id = $_POST["id"];
        $name = $_POST["name"];
        $size = $_POST["size"];
        $package = $_POST["package"];
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

                $newImageFileName = "../accommodation_image//" . $code . $new_image_extention;
                if (move_uploaded_file($file["tmp_name"], $newImageFileName)) {

                    $rs = Database::search("SELECT * FROM `accommodation` INNER JOIN `accommodation_image` ON
                    `accommodation_image`.`accommodation_accommodation_id` = `accommodation`.`accommodation_id`
                    WHERE `accommodation`.`accommodation_id` = '" . $id . "' ");

                    Database::iud("UPDATE `accommodation_image` SET `url` = '" . $newImageFileName . "' 
                    WHERE `accommodation_accommodation_id` = '" . $id . "' ");

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

        Database::iud("UPDATE `accommodation` SET `accommodation`.`name`='".$name."',`accommodation`.`size`='".$size."',`accommodation`.`description`='".$newDescription."',
        `accommodation`.`accommodation_package_accommodation_package_id`='".$package."' WHERE `accommodation`.`accommodation_id`='".$id."'");

        echo("4");

    } else {
        echo ("1");
    }
} else {
    header("Location:index.php");
}

?>