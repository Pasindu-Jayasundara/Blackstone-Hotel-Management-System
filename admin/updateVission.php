<?php
session_start();
require "../connection/connection.php";

if(!empty($_SESSION["admin"])){

    if(!empty($_POST["txt"]) && trim($_POST["txt"]) != ""){

        $txt = $_POST["txt"];
        $new_txt = filter_var($txt,FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        Database::iud("UPDATE `purpose` SET `purpose`.`vission` = '".$new_txt."' WHERE `purpose`.`status_status_id`='1'");

        echo("2");

    }else{
        echo("1");
    }

}else{
    header("Location:index.php");
}

?>