<?php

session_start();
require "../connection/connection.php";

if (!empty($_SESSION["admin"])) {

    if (trim($_POST["name"]) != "" && !empty($_POST["price"]) && $_POST["price"] > 0 && $_POST["type"]>0 && $_POST["category"]>0 && !empty($_POST["imgUp"]) && !empty($_POST["id"])) {

        $id = $_POST["id"];
        $name = $_POST["name"];
        $price = $_POST["price"];
        $type = $_POST["type"];
        $category = $_POST["category"];
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

                $newImageFileName = "../dining_image//" . $code . $new_image_extention;
                if (move_uploaded_file($file["tmp_name"], $newImageFileName)) {

                    $rs = Database::search("SELECT * FROM `dining` INNER JOIN `dining_images` ON
                    `dining_images`.`dining_dining_id` = `dining`.`dining_id`
                    WHERE `dining`.`dining_id` = '" . $id . "' ");

                    Database::iud("UPDATE `dining_images` SET `path` = '" . $newImageFileName . "' 
                    WHERE `dining_dining_id` = '" . $id . "' ");

                    if($rs->num_rows == 1){
                        $data = $rs->fetch_assoc();
                        unlink($data["path"]);
                    }

                    echo ("3");

                } else {
                    echo ("2");
                }
            }
        }

        Database::iud("UPDATE `dining` SET `dining`.`name`='".$name."',`dining`.`price`='".$price."',`dining`.`dining_category_dining_category_id`='".$category."',
        `dining`.`dining_type_dining_type_id`='".$type."' WHERE `dining`.`dining_id`='".$id."'");

        echo("4");

    } else {
        echo ("1");
    }
} else {
    header("Location:index.php");
}

?>