<?php

session_start();
require "../connection/connection.php";

if (!empty($_SESSION["admin"])) {

    if (trim($_POST["name"]) != "" && trim($_POST["description"]) != "" && !empty($_POST["imgUp"]) && !empty($_POST["id"])) {

        $id = $_POST["id"];
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

                $newImageFileName = "../wedding_food_menu_image//" . $code . $new_image_extention;
                if (move_uploaded_file($file["tmp_name"], $newImageFileName)) {

                    $rs = Database::search("SELECT * FROM `wedding_food_menu` INNER JOIN `wedding_food_menu_image` ON
                    `wedding_food_menu_image`.`wedding_food_menu_wedding_food_menu_id` = `wedding_food_menu`.`wedding_food_menu_id`
                    WHERE `wedding_food_menu`.`wedding_food_menu_id` = '" . $id . "' ");

                    Database::iud("UPDATE `wedding_food_menu_image` SET `url` = '" . $newImageFileName . "' 
                    WHERE `wedding_food_menu_wedding_food_menu_id` = '" . $id . "' ");

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

        Database::iud("UPDATE `wedding_food_menu` SET `wedding_food_menu`.`name`='".$name."',`wedding_food_menu`.`food_menu_description`='".$newDescription."'
        WHERE `wedding_food_menu`.`wedding_food_menu_id`='".$id."'");

        echo("4");

    } else {
        echo ("1");
    }
} else {
    header("Location:index.php");
}

?>