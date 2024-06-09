<?php
$id = $_POST["food_id"];

require "../connection/connection.php";

$model_rs = Database::search("SELECT * FROM `dining` INNER JOIN `dining_images` ON
`dining_images`.`Food_id` = `dining`.`Food_id`

 WHERE `dining`.`Food_id` = '".$id."' ");
$model_Data = $model_rs->fetch_assoc();

$phpObject = new stdClass();

$phpObject->Food_name = $model_Data["name"];
$phpObject->Food_id = $model_Data["Food_id"];
$phpObject->Food_price = $model_Data["price"];
$phpObject->Food_category = $model_Data["dining_category_dining_category_id"];
$phpObject->Food_type = $model_Data["dining_type_dining_type_id"];
$phpObject->Food_path = $model_Data["path"];

$PhpJsonObject = json_encode($phpObject);
echo($PhpJsonObject);


?>