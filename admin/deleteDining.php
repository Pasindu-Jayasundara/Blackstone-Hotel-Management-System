<?php
require "../connection/connection.php";
$id = $_POST["id"];

$database_rs = Database::search("SELECT  * FROM `dining` INNER JOIN `dining_images` ON
`dining_images`.`dining_dining_id` = `dining`.`dining_id`
WHERE `dining_id` = '".$id."'");

$database_data = $database_rs->fetch_assoc();


Database::iud("UPDATE `dining_images` SET `dining_images`.`status_status_id`='2' 
WHERE `dining_dining_id` = '".$id."'");

if(file_exists($database_data["url"])){
    unlink($database_data["url"]);
}

Database::iud("UPDATE `dining` SET `dining`.`status_status_id`='2' 
WHERE `dining_id` = '".$id."'");

echo("1");



?>