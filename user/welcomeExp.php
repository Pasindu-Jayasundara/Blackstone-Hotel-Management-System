<?php

session_start();
require "../connection/connection.php";

$exp_rs = Database::search("SELECT * FROM `exploration` INNER JOIN `exploration_image` ON `exploration`.`exploration_id`=`exploration_image`.`exploration_exploration_id` 
                        WHERE `exploration`.`status_status_id`='1' AND `exploration_image`.`status_status_id`='1' ORDER BY RAND()");



$obj = new stdClass();

$obj->exp_status = "0";


if ($exp_rs->num_rows > 0) {

    $exp_data = $exp_rs->fetch_assoc();

    $obj->exp = $exp_data;
    $obj->exp_status = "1";
}

echo(json_encode($obj));


?>