<?php
require "../connection/connection.php";
$id = $_POST["id"];

$database_rs = Database::search("SELECT  * FROM `event` INNER JOIN `event_image` ON
`event_image`.`event_event_id` = `event`.`event_id`
WHERE `event`.`event_id` = '".$id."'");

$database_data = $database_rs->fetch_assoc();

Database::iud("UPDATE `event_image` SET `event_image`.`status_status_id`='2' 
WHERE `event_image`.`event_event_id` = '".$id."'");

if(file_exists($database_data["url"])){
    unlink($database_data["url"]);
}

Database::iud("UPDATE `event` SET `event`.`status_status_id`='2' WHERE `event_id` = '".$id."'");

echo("1");



?>