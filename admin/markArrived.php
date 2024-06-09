<?php

session_start();
require "../connection/connection.php";

if(!empty($_POST["id"]) && count(json_decode($_POST["arr"]))>0){

    $arr = json_decode($_POST["arr"]);

    Database::iud("UPDATE `registered_guest` SET `arrived`='".date("Y-m-d H:i:s")."',`arrivedStatus`='1' WHERE `registered_guest_id`='".$_POST["id"]."'");

/*   

[ {typeName:"AC",typeId:1,roomName:"2",roomId:1}, {typeName:"AC",typeId:1,roomName:"2",roomId:1} ]

*/
    for($x=0;$x<count($arr);$x++){
        $obj = $arr[$x];

        Database::iud("UPDATE `room_numbers` SET `room_numbers`.`booked_status`='1' WHERE `booked_status`='2' AND `room_type_room_type_id`='".$obj->typeId."' 
        AND `room_numbers_id`='".$obj->roomId."'");

        Database::iud("INSERT INTO `registered_guest_has_room_numbers`(`registered_guest_registered_guest_id`,`room_numbers_room_numbers_id`,`room_type_room_type_id`) 
        VALUES('".$_POST["id"]."','".$obj->roomId."','".$obj->typeId."')");
    }

    echo("1");
}else{
    echo("2");
}

?>