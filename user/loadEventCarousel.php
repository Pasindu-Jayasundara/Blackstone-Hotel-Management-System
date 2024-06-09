<?php

session_start();
require "../connection/connection.php";

$rs = Database::search("SELECT * FROM `event` INNER JOIN `event_image` ON `event`.`event_id`=`event_image`.`event_event_id` 
WHERE `event`.`status_status_id`='1' AND `event_image`.`status_status_id`='1' ORDER BY RAND() LIMIT 5");

if ($rs->num_rows > 0) {
    for ($x = 0; $x < $rs->num_rows; $x++) {
        $data = $rs->fetch_assoc();

?>

        <div class="carousel-item p-0">
            <img src="<?php echo $data["url"]; ?>" class="d-block w-100 heightimg1" style="object-fit: cover; object-position: center;" alt="...">
            <div class="bg-dark m-0 w-100 position-absolute d-flex justify-content-center align-items-center" style="bottom: 0px; height:150px;">
                <p class="text-center text-lg-center fw-bold fs-2 text-white " style="font-family: 'Agdasima', sans-serif;"><?php echo $data["description"]; ?></p>
            </div>
        </div>

<?PHP

    }
}

?>