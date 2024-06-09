<?php

session_start();
require "../connection/connection.php";

if(!empty($_POST["value"])){
    $rs = Database::search("SELECT * FROM `room_numbers` WHERE `room_numbers`.`room_type_room_type_id`='".$_POST["value"]."' AND `status_status_id`='1' AND `booked_status`='2'");

    $obj = new stdClass();

    $obj->content='<option value="0">Choose Room</option>';
    for($x=0;$x<$rs->num_rows;$x++){
        $data = $rs->fetch_assoc();

        $obj->content .= '
            <option value="'.$data["room_numbers_id"].'">'.$data["room_numbers"].'</option>
        ';

    }

    echo json_encode($obj);

}

?>