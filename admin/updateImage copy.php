<?php
require "../connection/connection.php";

$Food_id = $_POST["Food_id"];
$Image = $_FILES["ImageFile"];

$product_rs = Database::search("SELECT  * FROM `dining`  INNER JOIN `dining_images` ON
`dining_images`.`Food_id` = `dining`.`Food_id`
WHERE `dining`.`Food_id` = '".$Food_id."' ");
$product_data  = $product_rs->fetch_assoc();
$product_num = $product_rs->num_rows;

$foodName = $product_data["name"];

if($product_num == 1){
   
    unlink($product_data["path"]);
$ImageType = $Image["type"];
echo ($ImageType);
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

    $newImageFileName = "DiningImages//" . $foodName . $new_image_extention;
    move_uploaded_file($Image["tmp_name"], $newImageFileName);


    Database::iud("UPDATE `dining_images` SET `path` = '".$newImageFileName."' WHERE `Food_id` ='".$Food_id."'  ");
    echo("Success"); 
}

} else {
    echo ("Please select a valid Image");
}
