<?php
require "../connection/connection.php";
$id = $_POST["id"];

$database_rs = Database::search("SELECT  * FROM `management` INNER JOIN `management_img` ON
`management_img`.`management_management_id` = `management`.`management_id`
WHERE `management_id` = '".$id."'");

$database_data = $database_rs->fetch_assoc();


Database::iud("UPDATE `management_img` SET `management_img`.`status_status_id`='2' 
WHERE `management_management_id` = '".$id."'");

if(file_exists($database_data["url"])){
    unlink($database_data["url"]);
}

Database::iud("UPDATE `management` SET `management`.`status_status_id`='2' 
WHERE `management_id` = '".$id."'");

echo("1");



?>