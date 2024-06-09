<?php

$id = $_POST["id"];
$textArea = $_POST["textArea"];

require "../connection/connection.php";

$rs = Database::search("SELECT * FROM `exploration` WHERE  `exploration_id` = '" . $id . "'");
$num = $rs->num_rows;


if ($num == 1) {
    Database::iud("UPDATE  `exploration` SET `description` = '" . $textArea . "' WHERE `exploration_id` = '" . $id . "' ");
    echo ("Update Success");
} else {
    echo ("Something Wrong Please Try Again Later");
}
