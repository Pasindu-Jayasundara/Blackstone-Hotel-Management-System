<?php

session_start();
require "../connection/connection.php";

if(!empty($_POST["email"]) && filter_var($_POST["email"],FILTER_VALIDATE_EMAIL) && !empty($_POST["id"])){
    $email = $_POST["email"];
    $id = $_POST["id"];

    Database ::iud("UPDATE `user_contact` SET `user_contact`.`delete`='1' WHERE `user_contact`.`email`='".$email."' 
    AND `user_contact`.`user_contact_id`='".$id."' AND `user_contact`.`delete`='2'");

    echo("1");

}

?>