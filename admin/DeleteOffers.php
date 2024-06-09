<?php
require "../connection/connection.php";
$id = $_POST["id"];

$database_rs = Database::search("SELECT  * FROM `offers` INNER JOIN `offer_image` ON
`offer_image`.`offers_offers_id` = `offers`.`offers_id`
WHERE `offers`.`offers_id` = '".$id."'");

$database_data = $database_rs->fetch_assoc();


Database::iud("UPDATE `offer_image` SET `offer_image`.`status_status_id`='2' 
WHERE `offers_offers_id` = '".$id."'");

if(file_exists($database_data["url"])){
    unlink($database_data["url"]);
}

Database::iud("UPDATE `offers` SET `offers`.`status_status_id`='2' 
WHERE `offers_id` = '".$id."'");

echo("1");



?>