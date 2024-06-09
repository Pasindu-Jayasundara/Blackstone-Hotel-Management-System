<?php

session_start();
require "../connection/connection.php";

if(!empty($_SESSION["admin"])){

    $obj = new stdClass();

    if(!empty($_FILES["img"]) && $_POST["package"]>0 ){

        $package = $_POST["package"];
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

            $new_url = "../gallery_image/".uniqid().$new_extension;

            if(move_uploaded_file($tmp_url,$new_url)){
                
                Database::iud("INSERT INTO `gallery`(`gallery_type_gallery_type_id`,`status_status_id`) 
                VALUES('".$package."','1')");

                $gl_id = Database::$db_connection->insert_id;

                Database::iud("INSERT INTO `gallery_image`(`url`,`gallery_gallery_id`,`status_status_id`) 
                VALUES('".$new_url."','".$gl_id."','1')");

                $obj->status ="bg-success";
                $obj->txt = "Gallery Adding Successful";

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