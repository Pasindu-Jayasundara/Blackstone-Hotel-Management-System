<?php


session_start();
require "../connection/connection.php";

$galery_rs = Database::search("SELECT * FROM `gallery` WHERE `gallery`.`status_status_id`='1'
AND `gallery`.`gallery_type_gallery_type_id`='2' ORDER BY RAND() LIMIT 1");

if($galery_rs->num_rows > 0){

    $arr = array();

    for($x=0;$x<$galery_rs->num_rows;$x++){

        $galery_data = $galery_rs->fetch_assoc();

        $img_rs = Database::search("SELECT * FROM `gallery_image` WHERE `gallery_image`.`status_status_id`='1' 
        AND `gallery_image`.`gallery_gallery_id`='".$galery_data["gallery_id"]."' ORDER BY RAND() LIMIT 1");

        $img_data = $img_rs->fetch_assoc();

        array_push($arr,$img_data["url"]);

    }

    echo json_encode($arr);

}


?>