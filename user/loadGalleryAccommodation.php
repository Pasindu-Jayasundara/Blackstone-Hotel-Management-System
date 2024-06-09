<?php

session_start();
require "../connection/connection.php";

$rs = Database::search("SELECT `url` FROM `gallery_image` INNER JOIN `gallery` ON `gallery`.`gallery_id`=`gallery_image`.`gallery_gallery_id`
WHERE `gallery_image`.`status_status_id`='1' AND `gallery`.`status_status_id`='1' AND `gallery`.`gallery_type_gallery_type_id`='1' ORDER BY RAND() LIMIT 8"); // 1=>accommodation

$obj = new stdClass();

if($rs->num_rows>0 && $rs->num_rows==8){
    $obj->status = 1;

    $arr = array();

    for($x=0;$x<$rs->num_rows;$x++){
        $data = $rs->fetch_assoc();
        array_push($arr,$data["url"]);
    }

    $obj->arr = $arr;
}else{
    $obj->status = 2;
}

echo json_encode($obj);

?>