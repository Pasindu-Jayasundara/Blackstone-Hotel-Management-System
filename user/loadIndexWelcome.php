<?php

session_start();
require "../connection/connection.php";

$dining_rs = Database::search("SELECT * FROM `dining` INNER JOIN `dining_images` ON `dining`.`dining_id`=`dining_images`.`dining_dining_id` 
                        WHERE `dining`.`status_status_id`='1' AND `dining_images`.`status_status_id`='1' ORDER BY RAND()");

$acc_rs = Database::search("SELECT * FROM `accommodation` INNER JOIN `accommodation_image` ON `accommodation`.`accommodation_id`=`accommodation_image`.`accommodation_accommodation_id` 
                        WHERE `accommodation`.`status_status_id`='1' AND `accommodation_image`.`status_status_id`='1' ORDER BY RAND()");

$exp_rs = Database::search("SELECT * FROM `exploration` INNER JOIN `exploration_image` ON `exploration`.`exploration_id`=`exploration_image`.`exploration_exploration_id` 
                        WHERE `exploration`.`status_status_id`='1' AND `exploration_image`.`status_status_id`='1' ORDER BY RAND()");



$obj = new stdClass();

$obj->dining_status = "0";
$obj->acc_status = "0";
$obj->exp_status = "0";

if ($dining_rs->num_rows > 0) {

    $dining_data = $dining_rs->fetch_assoc();

    $obj->dining = $dining_data;
    $obj->dining_status = "1";
}

if ($acc_rs->num_rows > 0) {

    $acc_data = $acc_rs->fetch_assoc();

    $obj->acc = $acc_data;
    $obj->acc_status = "1";

}

if ($exp_rs->num_rows > 0) {

    $exp_data = $exp_rs->fetch_assoc();

    $obj->exp = $exp_data;
    $obj->exp_status = "1";
}

echo(json_encode($obj));


?>