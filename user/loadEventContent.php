<?php

session_start();
require "../connection/connection.php";

$rs = Database::search("SELECT * FROM `event` INNER JOIN `event_image` ON `event`.`event_id`=`event_image`.`event_image_id`
WHERE `event`.`status_status_id`='1' AND `event_image`.`status_status_id`='1' ORDER BY RAND() LIMIT 5");

if ($rs->num_rows > 0) {

    $side = 0; // image left

    for ($x = 0; $x < $rs->num_rows; $x++) {
        $data = $rs->fetch_assoc();

        if ($side == 0) { //image left
            $side = 1;
?>
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row mt-5 ">
                    <div class="col-12 d-md-none mt-5 d-flex flex-column justify-content-center align-items-center">
                        <p class="text-uppercase fw-bold fs-4 text-start"><?php echo $data["feature"]; ?></p>
                        <p class="text-start"><?php echo $data["description"]; ?></p>
                    </div>
                    <div class="col-md-6 col-9 ps-3 mt-4">
                        <img src="<?php echo $data["url"]; ?>" class="img-thumbnail img4 ms-5" style="height: 350px; object-fit: cover; object-position: center;" alt="..." />
                    </div>
                    <div class="col-6">
                        <div class="d-none d-md-flex flex-row">
                            <div class="col-md-2">
                                <div class="verticalline1"></div>
                            </div>
                            <div class="col-md-8  mt-5">
                                <p class="text-uppercase fw-bold fs-4 text-start"><?php echo $data["feature"]; ?></p>
                                <p class="text-start"><?php echo $data["description"]; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        } else if ($side == 1) { //image right
            $side = 0;
        ?>
            <div class="col-12 pt-5">
                <div class="d-flex flex-column flex-md-row">
                    <div class="col-md-4 col-12 offset-md-2 mt-5">
                        <p class="text-uppercase fw-bold fs-4 text-md-end text-center text-lg-end"><?php echo $data["feature"]; ?></p>
                        <p class="text-md-end text-center"><?php echo $data["description"]; ?></p>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="row justify-content-center">
                            <div class="col-2 d-none d-md-block">
                                <div class="verticalline2 "></div>
                            </div>
                            <div class="col-md-8 col-8">
                                <img src="<?php echo $data["url"]; ?>" class="img-thumbnail img5" style="height: 350px; object-fit: cover; object-position: center;" alt="..." />
                            </div>
                        </div>

                    </div>
                </div>
            </div>
<?php
        }
    }
}

?>