<?php
require "../connection/connection.php";
$id = $_POST["id"];

$database_rs = Database::search("SELECT  * FROM `gallery` INNER JOIN `gallery_image` ON
`gallery_image`.`gallery_gallery_id` = `gallery`.`gallery_id`
WHERE `gallery_id` = '".$id."'");

$database_data = $database_rs->fetch_assoc();


Database::iud("UPDATE `gallery_image` SET `gallery_image`.`status_status_id`='2' 
WHERE `gallery_gallery_id` = '".$id."'");

if(file_exists($database_data["url"])){
    unlink($database_data["url"]);
}

Database::iud("UPDATE `gallery` SET `gallery`.`status_status_id`='2' 
WHERE `gallery_id` = '".$id."'");

echo("1");



?>