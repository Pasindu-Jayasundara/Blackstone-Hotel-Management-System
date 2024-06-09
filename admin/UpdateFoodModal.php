<?php 
require "../connection/connection.php";
$name = $_POST["updateName"];
$price = $_POST["updateprice"];
$category = $_POST["UpdateCategory"];
$type = $_POST["updateType"];
$food_id = $_POST["Food_id"];


Database::iud("UPDATE dining
SET `name` = '".$name."', `price` = '".$price."',`dining_category_dining_category_id` = '".$category."',`dining_type_dining_type_id` = '".$type."'
WHERE `Food_id` = '".$food_id."' ");

echo("Upload Success");

// echo($name." ".$price." ".$category." ".$type." ".$food_id);
