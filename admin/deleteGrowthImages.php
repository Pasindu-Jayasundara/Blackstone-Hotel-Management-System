<?php
session_start();
require "../connection/connection.php";

if(!empty($_SESSION["admin"])){

    if(!empty($_POST["imgId"])){

        $id = $_POST["imgId"];

        $rs = Database::search("SELECT * FROM `growth_images` 
        WHERE `growth_images`.`growth_images_id`='".$id."' AND `growth_images`.`status_status_id`='1'");
        $data = $rs->fetch_assoc();

        if(file_exists($data["url"])){
            unlink($data["url"]);
        }

        Database::iud("UPDATE `growth_images` SET `growth_images`.`status_status_id` = '2' WHERE `growth_images`.`growth_images_id`='".$id."'");

        echo("2");

    }else{
        echo("1");
    }

}else{
    header("Location:index.php");
}

?>