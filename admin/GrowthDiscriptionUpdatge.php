<?php

$id = $_POST["id"];
$textArea = $_POST["textArea"];

require "../connection/connection.php";

$rs = Database::search("SELECT * FROM `growth` WHERE  `growth_id` = '" . $id . "'");
$num = $rs->num_rows;


if ($num == 1) {
    Database::iud("UPDATE  `growth` SET `description` = '" . $textArea . "' WHERE `growth_id` = '" . $id . "' ");
    echo ("Update Success");
} else {
    echo ("Something Wrong Please Try Again Later");
}
