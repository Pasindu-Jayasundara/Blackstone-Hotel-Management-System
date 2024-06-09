<?php
require "../connection/connection.php";
$id = $_POST["id"];
$file = $_FILES["file"];





$rs = Database::search("SELECT * FROM `wedding_features`  INNER JOIN `wedding_feature_image` ON
`wedding_feature_image`.`wedding_features_wedding_features` = `wedding_features`.`wedding_features`
WHERE `wedding_features` = '" . $id . "' ");
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

        $newImageFileName = "DiningImages//".$id."Wedding".$new_image_extention;
        move_uploaded_file($file["tmp_name"], $newImageFileName);

        Database::iud("UPDATE `wedding_feature_image` SET `url` = '" . $newImageFileName . "' WHERE `wedding_features_wedding_features` = '" . $id . "' ");
        echo("Success");
    }
}
