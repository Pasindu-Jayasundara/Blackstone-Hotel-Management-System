<?php
require "../connection/connection.php";
$id = $_POST["id"];

$database_rs = Database::search("SELECT  * FROM `exploration` INNER JOIN `exploration_image` ON
`exploration_image`.`exploration_exploration_id` = `exploration`.`exploration_id`
WHERE `exploration_id` = '".$id."'");

$database_data = $database_rs->fetch_assoc();


Database::iud("UPDATE `exploration_image` SET `exploration_image`.`status_status_id`='2' 
WHERE `exploration_exploration_id` = '".$id."'");

if(file_exists($database_data["url"])){
    unlink($database_data["url"]);
}

Database::iud("UPDATE `exploration` SET `exploration`.`status_status_id`='2' 
WHERE `exploration_id` = '".$id."'");

echo("1");



?>