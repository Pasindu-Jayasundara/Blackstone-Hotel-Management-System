<?php

session_start();
require "../connection/connection.php";

if (!empty($_SESSION["admin"])) {

    if (trim($_POST["description"]) != "" && !empty($_POST["imgUp"]) && !empty($_POST["id"])) {

        $id = $_POST["id"];
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

                $newImageFileName = "../special_moments_image//" . $code . $new_image_extention;
                if (move_uploaded_file($file["tmp_name"], $newImageFileName)) {

                    $rs = Database::search("SELECT * FROM `special_moment` INNER JOIN `special_moment_image` ON
                    `special_moment_image`.`special_moment_special_moment_id` = `special_moment`.`special_moment_id`
                    WHERE `special_moment`.`special_moment_id` = '" . $id . "' ");

                    Database::iud("UPDATE `special_moment_image` SET `url` = '" . $newImageFileName . "' 
                    WHERE `special_moment_special_moment_id` = '" . $id . "' ");

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

        Database::iud("UPDATE `special_moment` SET `special_moment`.`description`='".$newDescription."' WHERE `special_moment`.`special_moment_id`='".$id."'");

        echo("4");

    } else {
        echo ("1");
    }
} else {
    header("Location:index.php");
}

?>