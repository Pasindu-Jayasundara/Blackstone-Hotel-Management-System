<?php
require "../connection/connection.php";
$id = $_POST["id"];

$database_rs = Database::search("SELECT  * FROM `special_moment` INNER JOIN `special_moment_image` ON
`special_moment_image`.`special_moment_special_moment_id` = `special_moment`.`special_moment_id`
WHERE `special_moment_id` = '".$id."'");

$database_data = $database_rs->fetch_assoc();


Database::iud("UPDATE `special_moment_image` SET `special_moment_image`.`status_status_id`='2' 
WHERE `special_moment_special_moment_id` = '".$id."'");

if(file_exists($database_data["url"])){
    unlink($database_data["url"]);
}

Database::iud("UPDATE `special_moment` SET `special_moment`.`status_status_id`='2' 
WHERE `special_moment_id` = '".$id."'");

echo("1");



?>