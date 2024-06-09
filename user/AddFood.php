<?php
require "../connection/connection.php";

$foodName = $_POST["foodName"];
$foodPrice = $_POST["foodPrice"];
$category = $_POST["category"];
$DiningType = $_POST["DiningType"];
$food_id = uniqid();
if (isset($_FILES["Image"])) {
    $image = $_FILES["Image"];
    $imageType = $image["type"];

    $allowed_Image_extentions = array("image/jpg", "image/png", "image/jpeg", "image/svg+xml");
    $newImageExtention;
    if (in_array($imageType, $allowed_Image_extentions)) {

        if ($imageType == "image/jpg") {
            $newImageExtention = ".jpg";
        } else if ($imageType == "image/png") {
            $newImageExtention = ".png";
        } else if ($imageType == "image/jpeg") {
            $newImageExtention = ".jpeg";
        } else if ($imageType == "image/svg+xml") {
            $newImageExtention = ".svg";
        }

        $newImageFileName = "../dining_image//" . $foodName . $newImageExtention;
        move_uploaded_file($image["tmp_name"], $newImageFileName);


        Database::iud("INSERT INTO `dining` (`Food_id`,`name`,`price`,`dining_category_dining_category_id`,`dining_type_dining_type_id`,`status_status_id`)
VALUES('".$food_id."','" . $foodName . "','" . $foodPrice . "','" . $category . "','" . $DiningType . "','1')");

        Database::iud("INSERT INTO `dining_images` (`Food_id`,`path`) VALUES ('" . $food_id . "','" . $newImageFileName . "') ");
        echo ("Success");
    } else {
        echo ("Please Select Valid Image File");
    }
} else {
    echo ("Please Select a Image");
}



// echo($imageType);
