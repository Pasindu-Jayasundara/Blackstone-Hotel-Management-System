<?php

session_start();
require "../connection/connection.php";

$obj = new stdClass();

if(!empty($_POST["id"])){
    $id=$_POST["id"];

$obj->content ='
    <div class="mt-2 fw-bold">Room Type : </br>
    ';


    $assign_room_type_rs = Database::search(" SELECT `room_type`.`room_type_id`,`room_type`.`room_type` FROM `registered_guest_has_room_numbers` 
    INNER JOIN `room_type` ON `room_type`.`room_type_id`=`registered_guest_has_room_numbers`.`room_type_room_type_id`
    WHERE `registered_guest_registered_guest_id`='" . $row["registered_guest_id"] . "' AND `registered_guest_has_room_numbers`.`status_status_id`='1' 
    GROUP BY `room_type`.`room_type_id`");

    for ($z = 0; $z < $assign_room_type_rs->num_rows; $z++) {
        $assign_room_type_data = $assign_room_type_rs->fetch_assoc();

        $room_rumbers_rs = Database::search("SELECT * FROM `registered_guest_has_room_numbers` 
            INNER JOIN `room_numbers` ON `room_numbers`.`room_numbers_id`=`registered_guest_has_room_numbers`.`room_numbers_room_numbers_id`
            WHERE `registered_guest_has_room_numbers`.`registered_guest_registered_guest_id`='" . $id . "' 
            AND `registered_guest_has_room_numbers`.`room_type_room_type_id`='" . $assign_room_type_data["room_type_id"] . "' AND `registered_guest_has_room_numbers`.`status_status_id`='1'");

        $obj->content .= '<span class="text-primary fw-normal ms-5">
        ' . $assign_room_type_data["room_type"] . '</span>&nbsp;&nbsp;&nbsp;&nbsp;';

        for ($a = 0; $a < $room_rumbers_rs->num_rows; $a++) {
            $room_rumbers_data = $room_rumbers_rs->fetch_assoc();

            $obj->content .= '<span class="fw-normal">' . $room_rumbers_data["room_numbers"] . ',</span>';
        }

        $obj->content .= '
        </div>';
    }

    $arr_rs = Database::search("SELECT * FROM `registered_guest` WHERE `registered_guest`.`registered_guest_id`='".$id."' AND `departured`= null");
    $arr_data =$arr_rs->fetch_assoc();

    $obj->arrTime = $arr_data["arrived"];

    echo json_encode($obj);

}
?>