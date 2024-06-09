<?php

$id = $_POST["id"];
$textArea = $_POST["textArea"];

require "../connection/connection.php";

$rs = Database::search("SELECT * FROM `event` WHERE  `event_id` = '" . $id . "'");
$num = $rs->num_rows;


if ($num == 1) {
    Database::iud("UPDATE  `event` SET `description` = '" . $textArea . "' WHERE `event_id` = '" . $id . "' ");
    echo ("Update Success");
} else {
    echo ("Something Wrong Please Try Again Later");
}
