<?php

session_start();
require "../connection/connection.php";

if (
    !empty($_POST["nic"]) && !empty($_POST["name"]) && !empty($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)
    && !empty($_POST["arr"]) && !empty($_POST["de"]) && !empty($_POST["roomtype"]) && $_POST["roomtype"] > 0 && !empty($_POST["mealplan"])
    && $_POST["mealplan"] > 0 && !empty($_POST["mobile"])
) {
    $nic = $_POST['nic'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $arr = $_POST["arr"];
    $de = $_POST["de"];
    $rt = $_POST["roomtype"];
    $mp = $_POST["mealplan"];
    $mobile = $_POST["mobile"];

    $_SESSION["ref"]=uniqid();
    $_SESSION["b_email"]=$email;

    Database::iud("INSERT INTO `registered_guest`(`nic`, `f_name`, `email`,`mobile`, `arrival_date_time`, `depature_date_time`, `ref_number`) 
    VALUES ('".$nic."', '".$name."', '".$email."','".$mobile."' ,'".$arr."', '".$de."','".$_SESSION["ref"]."' )");

    $id = Database::$db_connection->insert_id;

    Database::iud("INSERT INTO `registered_guest_has_room_type`(`registered_guest_registered_guest_id`, `room_type_room_type_id`) 
    VALUES ('".$id."', '".$rt."')");

    Database::iud("INSERT INTO `registered_guest_has_meal_plan`(`registered_guest_registered_guest_id`, `meal_plan_meal_plan_id`) 
    VALUES ('".$id."', '".$mp."')");
    
    echo "1";
} else {
    echo ("2");
}
?>