<?php
require "../connection/connection.php";
$id = $_POST["id"];

Database::iud("UPDATE `wedding_features` SET `wedding_features`.`status_status_id`='2' 
WHERE `wedding_features_id` = '".$id."'");

echo("1");



?>