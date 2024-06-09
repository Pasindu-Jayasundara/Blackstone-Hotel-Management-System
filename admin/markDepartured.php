<?php

session_start();
require "../connection/connection.php";

if(!empty($_POST["id"])){

    $id=$_POST["id"];

    Database::iud("UPDATE `registered_guest` SET `departured`='".date("Y-m-d H:i:s")."' WHERE `registered_guest_id`='".$_POST["id"]."'");

    $rs = Database::search("SELECT * FROM `registered_guest_has_room_numbers` WHERE `registered_guest_registered_guest_id`='".$_POST["id"]."' 
    AND `registered_guest_has_room_numbers`.`status_status_id`='1'");

    for($x=0;$x<$rs->num_rows;$x++){
        $data = $rs->fetch_assoc();

        Database::iud("UPDATE `room_numbers` SET `booked_status`='2' WHERE `room_numbers`.`booked_status`='1' 
        AND `room_numbers`.`room_type_room_type_id`='".$data["room_type_room_type_id"]."' AND `room_numbers`.`room_numbers_id`='".$data["room_numbers_room_numbers_id"]."'");

    }

    Database::iud("UPDATE `registered_guest_has_room_type` SET `status_status_id`='2' WHERE `registered_guest_registered_guest_id`='".$_POST["id"]."' ");

    Database::iud("UPDATE `registered_guest_has_room_numbers` SET `status_status_id`='2' WHERE `status_status_id`='1' AND `registered_guest_registered_guest_id`='".$_POST["id"]."'");

    $de_rs = Database::search("SELECT * FROM `registered_guest` WHERE `registered_guest`.`registered_guest_id`='".$id."' AND `departured`<= '".date("Y-m-d")."'");
    $de_data =$de_rs->fetch_assoc();

    echo($de_data["departured"]);

}else{
    echo("2");
}

?>