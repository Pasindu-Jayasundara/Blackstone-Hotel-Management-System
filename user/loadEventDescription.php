<?php

session_start();
require "../connection/connection.php";

$rs = Database::search("SELECT `description` FROM `event` WHERE `event`.`status_status_id`='1' ORDER BY RAND() LIMIT 1");

if ($rs->num_rows > 0) {
    for ($x = 0; $x < $rs->num_rows; $x++) {
        $data = $rs->fetch_assoc();
?>

        <p class="text-center text-justify fw-semibold fs-6"><?php echo $data["description"]; ?></p>

<?PHP
    }
}

?>