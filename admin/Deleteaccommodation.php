<?php
require "../connection/connection.php";
$id = $_POST["id"];

$database_rs = Database::search("SELECT  * FROM `accommodation` INNER JOIN `accommodation_image` ON
`accommodation_image`.`accommodation_accommodation_id` = `accommodation`.`accommodation_id`
WHERE `accommodation_id` = '".$id."'");

$database_data = $database_rs->fetch_assoc();


Database::iud("UPDATE `accommodation_image` SET `accommodation_image`.`status_status_id`='2' 
WHERE `accommodation_accommodation_id` = '".$id."'");

if(file_exists($database_data["url"])){
    unlink($database_data["url"]);
}

Database::iud("UPDATE `accommodation` SET `accommodation`.`status_status_id`='2' 
WHERE `accommodation_id` = '".$id."'");

echo("1");



?>