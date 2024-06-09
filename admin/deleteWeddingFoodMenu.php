<?php
require "../connection/connection.php";
$id = $_POST["id"];

$database_rs = Database::search("SELECT  * FROM `wedding_food_menu` INNER JOIN `wedding_food_menu_image` ON
`wedding_food_menu_image`.`wedding_food_menu_wedding_food_menu_id` = `wedding_food_menu`.`wedding_food_menu_id`
WHERE `wedding_food_menu_id` = '".$id."'");

$database_data = $database_rs->fetch_assoc();


Database::iud("UPDATE `wedding_food_menu_image` SET `wedding_food_menu_image`.`status_status_id`='2' 
WHERE `wedding_food_menu_wedding_food_menu_id` = '".$id."'");

if(file_exists($database_data["url"])){
    unlink($database_data["url"]);
}

Database::iud("UPDATE `wedding_food_menu` SET `wedding_food_menu`.`status_status_id`='2' 
WHERE `wedding_food_menu_id` = '".$id."'");

echo("1");



?>