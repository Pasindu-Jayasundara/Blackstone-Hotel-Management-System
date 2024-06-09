<?php

$id = $_POST["id"];
$textArea = $_POST["textArea"];

require "../connection/connection.php";

$rs = Database::search("SELECT * FROM `special_moment` WHERE  `special_moment_id` = '" . $id . "'");
$num = $rs->num_rows;


if ($num == 1) {
    Database::iud("UPDATE  `special_moment` SET `description` = '" . $textArea . "' WHERE `special_moment_id` = '" . $id . "' ");
    echo ("Update Success");
} else {
    echo ("Something Wrong Please Try Again Later");
}
