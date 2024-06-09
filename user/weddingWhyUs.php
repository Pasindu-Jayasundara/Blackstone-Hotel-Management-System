<?php

session_start();
require "../connection/connection.php";
                
$wed_fea_rs = Database::search("SELECT * FROM `wedding_features` WHERE `wedding_features`.`status_status_id`='1' ORDER BY RAND() LIMIT 7");

$wed_hall_img_rs = Database::search("SELECT * FROM `wedding_hall_image` WHERE `wedding_hall_image`.`status_status_id`='1' ORDER BY RAND() LIMIT 1");


$hall_arr = array();


if($wed_fea_rs->num_rows > 0){

    for($x = 0; $x < $wed_fea_rs->num_rows; $x++){
        $wed_fea_data = $wed_fea_rs->fetch_assoc();

        array_push($hall_arr,$wed_fea_data["feature"]);

    }

    $wed_hall_img_data = $wed_hall_img_rs->fetch_assoc();
    array_push($hall_arr,$wed_hall_img_data["url"]);

    echo json_encode($hall_arr);

}

?>
