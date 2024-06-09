<?php

session_start();
require "../connection/connection.php";

$acc_rs = Database::search("SELECT * FROM `accommodation` INNER JOIN `accommodation_image` ON `accommodation`.`accommodation_id`=`accommodation_image`.`accommodation_accommodation_id` 
                        WHERE `accommodation`.`status_status_id`='1' AND `accommodation_image`.`status_status_id`='1' ORDER BY RAND()");



$obj = new stdClass();
$arr = array();

$obj->acc_status = "0";


if ($acc_rs->num_rows > 0) {

    for($x=0; $x<3;$x++){

        $acc_data = $acc_rs->fetch_assoc();
        array_push($arr,$acc_data["url"]);

    }

    $obj->acc = $arr;
    $obj->acc_status = "1";

}

echo(json_encode($obj));


?>