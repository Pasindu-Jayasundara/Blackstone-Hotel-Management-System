<?php

session_start();
require "../connection/connection.php";

if(!empty($_SESSION["admin"])){

    $obj = new stdClass();

    if(strlen($_POST["name"]) < 45 && strlen($_POST["txt"]) < 45 && !empty($_POST["txt"]) && trim($_POST["txt"])!='' && !empty($_FILES["img"]) && $_POST["package"]>0 && trim($_POST["name"])!='' && trim($_POST["size"])!=''){

        $name = $_POST["name"];
        $txt = $_POST["txt"];
        $package = $_POST["package"];
        $size = $_POST["size"];
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

            $new_url = "../accommodation_image/".uniqid().$new_extension;

            if(move_uploaded_file($tmp_url,$new_url)){
                
                $new_txt = filter_var($txt,FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                Database::iud("INSERT INTO `accommodation`(`name`,`size`,`description`,`accommodation_package_accommodation_package_id`,`status_status_id`) 
                VALUES('".$name."','".$size."','".$new_txt."','".$package."','1')");

                $ac_id = Database::$db_connection->insert_id;

                Database::iud("INSERT INTO `accommodation_image`(`url`,`accommodation_accommodation_id`,`status_status_id`) 
                VALUES('".$new_url."','".$ac_id."','1')");

                $obj->status ="bg-success";
                $obj->txt = "Accommodation Adding Successful";

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