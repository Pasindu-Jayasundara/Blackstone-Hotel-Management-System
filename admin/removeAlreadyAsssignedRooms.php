<?php

session_start();
require "../connection/connection.php";

if(!empty($_POST['registered_guest_has_room_numbers_id'])){

    $id = $_POST['registered_guest_has_room_numbers_id'];

    $guest_rs = Database::search("SELECT * FROM `registered_guest_has_room_numbers` 
    WHERE `registered_guest_has_room_numbers_id` = '".$id."'");
    $guest_data = $guest_rs->fetch_assoc();
    $guest_id = $guest_data['registered_guest_registered_guest_id'];
    $current_room_num_id = $guest_data["room_numbers_room_numbers_id"];

    Database::iud("UPDATE `registered_guest_has_room_numbers` SET `registered_guest_has_room_numbers`.`status_status_id`='2' 
    WHERE `registered_guest_has_room_numbers`.`registered_guest_has_room_numbers_id`='".$id."'");

    Database::iud("UPDATE `room_numbers` SET `room_numbers`.`booked_status`='2' 
    WHERE `room_numbers`.`room_numbers_id`='".$current_room_num_id."'");

    $rest_rs = Database::search("SELECT * FROM `registered_guest_has_room_numbers` WHERE 
    `registered_guest_has_room_numbers`.`registered_guest_registered_guest_id`='".$guest_id."' 
    AND `registered_guest_has_room_numbers`.`status_status_id`='1'");

    if($rest_rs->num_rows==0){ // guest does not still has assigned rooms

        Database::iud("UPDATE `registered_guest` SET `registered_guest`.`room_assigned`='2' 
        WHERE `registered_guest`.`registered_guest_id`='".$guest_id."'");

    }

    echo "1";

}else{
    echo"2";
}

?>