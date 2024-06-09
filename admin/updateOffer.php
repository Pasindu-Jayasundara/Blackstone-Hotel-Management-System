<?php

session_start();
require "../connection/connection.php";

if (!empty($_SESSION["admin"])) {

    if (trim($_POST["description"]) != "" && !empty($_POST["ofsdt"]) && !empty($_POST["ofedt"]) && !empty($_POST["imgUp"]) && !empty($_POST["id"])) {

        $id = $_POST["id"];
        $ofsdt = $_POST["ofsdt"];
        $ofedt = $_POST["ofedt"];
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

                $newImageFileName = "../offer_img//" . $code . $new_image_extention;
                if (move_uploaded_file($file["tmp_name"], $newImageFileName)) {

                    $rs = Database::search("SELECT * FROM `offers` INNER JOIN `offer_image` ON
                    `offer_image`.`offers_offers_id` = `offers`.`offers_id`
                    WHERE `offers`.`offers_id` = '" . $id . "' ");
                    
                    Database::iud("UPDATE `offer_image` SET `url` = '" . $newImageFileName . "' 
                    WHERE `offers_offers_id` = '" . $id . "' ");

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

        Database::iud("UPDATE `offers` SET `offers`.`start_date_time`='".$ofsdt."',`offers`.`end_date_time`='".$ofedt."',`offers`.`description`='".$newDescription."'
        WHERE `offers`.`offers_id`='".$id."'");

        echo("4");

    } else {
        echo ("1");
    }
} else {
    header("Location:index.php");
}

?>