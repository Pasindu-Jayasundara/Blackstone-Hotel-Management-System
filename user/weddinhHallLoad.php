<?php

session_start();
require "../connection/connection.php";
                
$wed_hall_rs = Database::search("SELECT * FROM `wedding_hall` WHERE `wedding_hall`.`status_status_id`='1' ORDER BY RAND()");


$hall_arr = array();


if($wed_hall_rs->num_rows > 0){

    for($x = 0; $x < $wed_hall_rs->num_rows; $x++){

        $wed_hall_data = $wed_hall_rs->fetch_assoc();

        $wed_hall_img_rs = Database::search("SELECT * FROM `wedding_hall_image` WHERE `wedding_hall_image`.`status_status_id`='1' 
        AND `wedding_hall_image`.`wedding_hall_wedding_hall_id`='".$wed_hall_data["wedding_hall_id"]."' ORDER BY RAND() LIMIT 2");

        if($wed_hall_img_rs->num_rows == 2){

            $obj = new stdClass();
            $obj->hall_name = $wed_hall_data["name"];
            $obj->hall_des = $wed_hall_data["description"];

            $arr = array();


            for($y = 0; $y < $wed_hall_img_rs->num_rows; $y++){

                $wed_hall_img_data = $wed_hall_img_rs->fetch_assoc();                
                array_push($arr,$wed_hall_img_data["url"]);
                
            }
            
            $obj->hall_img = $arr;

            array_push($hall_arr,$obj);

        }

    }


    echo json_encode($hall_arr);

}

?>
