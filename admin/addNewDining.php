<?php

session_start();
require "../connection/connection.php";

if(!empty($_SESSION["admin"])){

    $obj = new stdClass();

    if(strlen($_POST["name"]) < 45 && !empty($_FILES["img"]) && $_POST["prize"]>0 && $_POST["type"]>0 && $_POST["category"]>0 && trim($_POST["name"])!='' ){

        $name = $_POST["name"];
        $type = $_POST["type"];
        $category = $_POST["category"];
        $prize = $_POST["prize"];
        $img = $_FILES["img"];

        $img_type = $img["type"];
        $valid_extension = ["image/jpeg","image/png","image/jpg"];
        if(in_array($img_type,$valid_extension)){

            $tmp_url = $img["tmp_name"];

            if($img_type == "image/jpeg"){
                $new_extension = ".jpeg";
            }else if($img_type == "image/png"){
                $new_extension = ".png";
            }else if($img_type == "image/jpg"){
                $new_extension = ".jpg";
            }

            $new_url = "../dining_image/".uniqid().$new_extension;

            if(move_uploaded_file($tmp_url,$new_url)){
                
                $new_name = filter_var($name,FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $date = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $newDate = $date->setTimezone($tz);
                $today = $newDate->format("Y-m-d H:i:s");

                
                Database::iud("INSERT INTO `dining`(`name`,`price`,`dining_category_dining_category_id`,`dining_type_dining_type_id`,`status_status_id`,`added_date_time`) 
                VALUES('".$new_name."','".$prize."','".$category."','".$type."','1','".$today."')");

                $di_id = Database::$db_connection->insert_id;

                Database::iud("INSERT INTO `dining_images`(`path`,`dining_dining_id`,`status_status_id`) 
                VALUES('".$new_url."','".$di_id."','1')");

                $obj->status ="bg-success";
                $obj->txt = "Dining Adding Successful";

            }else{
                $obj->status ="bg-danger";
                $obj->txt = "Image Uploading Faild";
            }

        }else{
            $obj->status ="bg-warning";
            $obj->txt = "Invalid Image Format";
        }

    }else{

        $obj->status = "bg-warning";
        $obj->txt = "Fill The Details";

    }

    echo json_encode($obj);

}else{
    header("Location:index.php");
}

?>