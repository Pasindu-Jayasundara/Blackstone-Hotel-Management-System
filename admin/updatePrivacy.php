<?php

session_start();
require "../connection/connection.php";

if(!empty($_SESSION["admin"])){

    if(!empty($_POST["txt"]) && trim($_POST["txt"]) !="" && !empty($_POST["s"])){

        $txt = filter_var($_POST["txt"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if($_POST["s"] == 1){
            Database::iud("INSERT INTO `privacy_policy`(`privacy_policy`,`hotel_hotel_id`,`status_status_id`) 
            VALUES('".$txt."','1','1')");
            echo("3");
        }else if($_POST["s"] == 2){
            Database::iud("UPDATE `privacy_policy` SET `privacy_policy`.`privacy_policy`='".$txt."' WHERE `privacy_policy`.`status_status_id`='1'");
            echo("2");
        }
        
    }else{
        echo("1");
    }
}else{
    header("Location:index.php");
}

?>