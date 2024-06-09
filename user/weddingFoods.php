<?php

session_start();
require "../connection/connection.php";

$food_rs = Database::search("SELECT * FROM `wedding_food_menu` WHERE `wedding_food_menu`.`status_status_id`='1' ORDER BY RAND() LIMIT 4");

if($food_rs->num_rows > 0){

    $arr = array();

    for($x = 0; $x < $food_rs->num_rows; $x++){
        $food_data = $food_rs->fetch_assoc();

        $img_rs = Database::search("SELECT * FROM `wedding_food_menu_image` WHERE `wedding_food_menu_image`.`status_status_id`='1' 
        AND `wedding_food_menu_image`.`wedding_food_menu_wedding_food_menu_id`='".$food_data["wedding_food_menu_id"]."' LIMIT 1");


        $obj = new stdClass();
        $obj->food_name = $food_data["name"];
        $obj->food_des = $food_data["food_menu_description"];



        $img_data = $img_rs->fetch_assoc();
        $obj->img = $img_data["url"];

        array_push($arr,$obj);

    }

    echo json_encode($arr);

}

?>