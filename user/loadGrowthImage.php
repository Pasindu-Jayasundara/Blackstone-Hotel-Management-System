<?php

session_start();
require "../connection/connection.php";

$img_rs = Database::search("SELECT * FROM `growth_images` WHERE `growth_images`.`status_status_id`='1'");
if ($img_rs->num_rows == 2) {
    $img_data1 = $img_rs->fetch_assoc();
    $img_data2 = $img_rs->fetch_assoc();
?>
    <div class="d-flex flex-md-row flex-column justify-content-center col-12 align-items-start me-5 gm">
        <div class="me-5 pe-5 img">
            <img src="<?php echo $img_data1["url"]; ?>" width="550vw" height="300vh" class="img" alt="" srcset="">
        </div>
        <div class="img img2">
            <img src="<?php echo $img_data2["url"]; ?>" class="img" width="550vw" height="300vh" alt="" srcset="">
        </div>
    </div>
<?php
}
?>