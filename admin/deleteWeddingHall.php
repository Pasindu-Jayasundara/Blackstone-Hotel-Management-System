<?php
require "../connection/connection.php";
$id = $_POST["id"];

$database_rs = Database::search("SELECT  * FROM `wedding_hall` INNER JOIN `wedding_hall_image` ON
`wedding_hall_image`.`wedding_hall_wedding_hall_id` = `wedding_hall`.`wedding_hall_id`
WHERE `wedding_hall_id` = '".$id."'");

$database_data = $database_rs->fetch_assoc();


Database::iud("UPDATE `wedding_hall_image` SET `wedding_hall_image`.`status_status_id`='2' 
WHERE `wedding_hall_wedding_hall_id` = '".$id."'");

if(file_exists($database_data["url"])){
    unlink($database_data["url"]);
}

Database::iud("UPDATE `wedding_hall` SET `wedding_hall`.`status_status_id`='2' 
WHERE `wedding_hall_id` = '".$id."'");

echo("1");



?>