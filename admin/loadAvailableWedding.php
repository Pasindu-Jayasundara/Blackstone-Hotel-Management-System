<?php
session_start();
require "../connection/connection.php";

if (!empty($_POST["type"])) {

    $type = $_POST["type"];

    if ($type == 1) { // hall

        $rs = Database::search("SELECT * FROM `wedding_hall` INNER JOIN `wedding_hall_image` ON
        `wedding_hall_image`.`wedding_hall_wedding_hall_id` = `wedding_hall`.`wedding_hall_id` WHERE `wedding_hall`.`status_status_id`='1' 
        AND `wedding_hall_image`.`status_status_id`='1' ORDER BY `wedding_hall_id` DESC");
    } else if ($type == 2) { // feature

        $rs = Database::search("SELECT * FROM `wedding_features` WHERE `wedding_features`.`status_status_id`='1' 
        ORDER BY `wedding_features_id` DESC");
    } else if ($type == 3) { // menu

        $rs = Database::search("SELECT * FROM `wedding_food_menu` INNER JOIN `wedding_food_menu_image` ON
        `wedding_food_menu_image`.`wedding_food_menu_wedding_food_menu_id` = `wedding_food_menu`.`wedding_food_menu_id` WHERE `wedding_food_menu`.`status_status_id`='1' 
        AND `wedding_food_menu_image`.`status_status_id`='1' ORDER BY `wedding_food_menu_id` DESC");
    }

    $num = $rs->num_rows;

    if ($type == 2) {
?>
        <ul class="form-control ms-4">
            <?php
        }

        for ($x = 0; $x < $num; $x++) {
            $data = $rs->fetch_assoc();

            if ($type == 1) {
            ?>
                <div class="col-12 mb-5 border border-0 border-bottom border-primary" style="margin-left: 1.5%;">
                    <div class="row my-5">

                        <span class="d-flex flex-column col-4">
                            <div class="col-3 position-relative d-flex justify-content-center align-items-center" style="width: 300px; height:200px;">
                                <div class="position-absolute top-0 start-0 end-0 bottom-0 d-flex justify-content-center align-items-center" style="background-color: rgba(0, 0, 0, 0.597);">
                                    <label for="whAFile<?php echo $data['wedding_hall_id']; echo $data['wedding_hall_image_id']; ?>" class="btn fw-bold fs-6 text-white" style="background-color: rgba(0, 0, 0, 0.597);">Change Image</label>
                                    <input type="file" class="visually-hidden" id="whAFile<?php echo $data["wedding_hall_id"]; echo $data['wedding_hall_image_id'];?>" onchange="updateWeddingHallImage('<?php echo $data['wedding_hall_id']; ?>','<?php echo $data['wedding_hall_image_id']; ?>');" />
                                </div>
                                <img src="<?php echo $data["url"]; ?>" id="whAFileImg<?php echo $data["wedding_hall_id"]; echo $data['wedding_hall_image_id'];?>" style="width: 300px; height:200px; background-size: cover;">
                            </div>

                            <div class="col-10 d-flex justify-content-center">
                                <button class="btn btn-outline-warning col-5 d-grid mt-3" onclick="updateWeddingHall('<?php echo $data['wedding_hall_id']; ?>','<?php echo $data['wedding_hall_image_id']; ?>');">Update</button>
                                <button class="btn btn-outline-danger col-5 d-grid mt-3 ms-3" onclick="deleteWeddingHall('<?php echo $data['wedding_hall_id']; ?>','<?php echo $data['wedding_hall_image_id']; ?>');">Delete</button>
                            </div>
                        </span>

                        <div class="col-8 d-flex flex-column ">
                            <span class="d-flex flex-row justify-content-between mb-3">
                                <span class="col-4">
                                    <label>Wedding Hall Name : </label>
                                    <input class="form-control" type="text" id="whname<?php echo $data["wedding_hall_id"]; ?>" value="<?php echo $data["name"]; ?>" />
                                </span>
                            </span>
                            <label class="mt-2">Description : </label>
                            <textarea class="px-4 py-4" style="resize: none;" id="whTextArea<?php echo $data["wedding_hall_id"]; ?>" cols="55" rows="7"><?php echo $data["description"]; ?></textarea>
                        </div>

                    </div>
                </div>
            <?php
            } else if ($type == 2) {

            ?>

                <li class="d-flex flex-row justify-content-between col-5"><?php echo $data["feature"]; ?><i class="bi bi-trash-fill fs-5 text-danger" onclick="deleteWeddingFeature('<?php echo $data['wedding_features_id']; ?>');"></i></li>

            <?php

            } else if ($type == 3) {
            ?>
                <div class="col-12 mb-5 border border-0 border-bottom border-primary" style="margin-left: 1.5%;">
                    <div class="row my-5">

                        <span class="d-flex flex-column col-4">
                            <div class="col-3 position-relative d-flex justify-content-center align-items-center" style="width: 300px; height:200px;">
                                <div class="position-absolute top-0 start-0 end-0 bottom-0 d-flex justify-content-center align-items-center" style="background-color: rgba(0, 0, 0, 0.597);">
                                    <label for="wfmAFile<?php echo $data['wedding_food_menu_id']; ?>" class="btn fw-bold fs-6 text-white" style="background-color: rgba(0, 0, 0, 0.597);">Change Image</label>
                                    <input type="file" class="visually-hidden" id="wfmAFile<?php echo $data["wedding_food_menu_id"]; ?>" onchange="updateWeddingFoodMenuImage(<?php echo $data['wedding_food_menu_id']; ?>);" />
                                </div>
                                <img src="<?php echo $data["url"]; ?>" id="wfmAFileImg<?php echo $data["wedding_food_menu_id"]; ?>" style="width: 300px; height:200px; background-size: cover;">
                            </div>

                            <div class="col-10 d-flex justify-content-center">
                                <button class="btn btn-outline-warning col-5 d-grid mt-3" onclick="updateWeddingFoodMenu('<?php echo $data['wedding_food_menu_id']; ?>');">Update</button>
                                <button class="btn btn-outline-danger col-5 d-grid mt-3 ms-3" onclick="deleteWeddingFoodMenu('<?php echo $data['wedding_food_menu_id']; ?>');">Delete</button>
                            </div>
                        </span>

                        <div class="col-8 d-flex flex-column ">
                            <span class="d-flex flex-row justify-content-between mb-3">
                                <span class="col-4">
                                    <label>Food Menu Name : </label>
                                    <input class="form-control" type="text" id="wfmname<?php echo $data["wedding_food_menu_id"]; ?>" value="<?php echo $data["name"]; ?>" />
                                </span>
                            </span>
                            <label class="mt-2">Description : </label>
                            <textarea class="px-4 py-4" style="resize: none;" id="wfmTextArea<?php echo $data["wedding_food_menu_id"]; ?>" cols="55" rows="7"><?php echo $data["food_menu_description"]; ?></textarea>
                        </div>

                    </div>
                </div>
            <?php
            }
        }

        if ($type == 2) {
            ?>
        </ul>
<?php
        }
    }
?>