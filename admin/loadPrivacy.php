<?php

session_start();
require "../connection/connection.php";

if(!empty($_SESSION["admin"])){

    $rs = Database::search("SELECT * FROM `privacy_policy` WHERE `privacy_policy`.`status_status_id`='1'");
    
    $obj = new stdClass();
    if($rs->num_rows > 0){
        $data = $rs->fetch_assoc();
        $obj->txt = $data["privacy_policy"];
        $obj->status = "1";
    }else{
        $obj->txt = "";
        $obj->status = "2";
    }

    echo json_encode($obj);
}else{
    header("Location:index.php");
}

?>