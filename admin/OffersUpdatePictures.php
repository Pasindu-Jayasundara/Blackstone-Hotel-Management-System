<?php
require "../connection/connection.php";
$id = $_POST["id"];
$file = $_FILES["file"];





$rs = Database::search("SELECT * FROM `offers`  INNER JOIN `offer_image` ON
`offer_image`.`offers_offers_id` = `offers`.`offers_id`
WHERE `special_moment_id` = '" . $id . "' ");
$NUM = $rs->num_rows;

if ($NUM == 1) {
    $data = $rs->fetch_assoc();

    unlink($data["url"]);
    $ImageType = $file["type"];

    $allowed_Image_extentions = array("image/jpg", "image/png", "image/jpeg", "image/svg+xml");

    if (in_array($ImageType, $allowed_Image_extentions)) {

        $new_image_extention;
        if ($ImageType == "image/jpg") {
            $new_image_extention = ".jpg";
        } else if ($ImageType == "image/png") {
            $new_image_extention = ".png";
        } else if ($ImageType == "image/jpeg") {
            $new_image_extention = ".jpeg";
        } else if ($ImageType == "image/svg") {
            $new_image_extention = ".svg";
        }

        $newImageFileName = "DiningImages//".$id."Offers".$new_image_extention;
        move_uploaded_file($file["tmp_name"], $newImageFileName);

        Database::iud("UPDATE `offer_image` SET `url` = '" . $newImageFileName . "' WHERE `offers_offers_id` = '" . $id . "' ");
        echo("Success");
    }
}
