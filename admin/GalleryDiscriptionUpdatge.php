<?php

$id = $_POST["id"];
$textArea = $_POST["textArea"];

require "../connection/connection.php";

$rs = Database::search("SELECT * FROM `gallery` WHERE  `gallery_id` = '" . $id . "'");
$num = $rs->num_rows;


if ($num == 1) {
    Database::iud("UPDATE  `gallery` SET `description` = '" . $textArea . "' WHERE `gallery_id` = '" . $id . "' ");
    echo ("Update Success");
} else {
    echo ("Something Wrong Please Try Again Later");
}
