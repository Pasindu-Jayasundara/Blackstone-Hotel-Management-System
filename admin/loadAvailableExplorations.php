<?php
session_start();
require "../connection/connection.php";


$exp_rs = Database::search("SELECT * FROM `exploration` INNER JOIN `exploration_image` ON
            `exploration_image`.`exploration_exploration_id` = `exploration`.`exploration_id` 
            WHERE `exploration`.`status_status_id`='1' AND `exploration_image`.`status_status_id`='1' 
            ORDER BY `exploration`.`exploration_id` DESC");

$exp_num = $exp_rs->num_rows;

if ($exp_num > 0) {
?>

    <p class="mb-4 fw-bold">Manage Exploration</p>

    <?php

    for ($x = 0; $x < $exp_num; $x++) {
        $exp_data = $exp_rs->fetch_assoc();
    ?>
        <div class="col-12 mb-5 border border-0 border-bottom border-primary" style="margin-left: 1.5%;">
            <div class="row my-5">

                <span class="d-flex flex-column col-4">
                    <div class="col-3 position-relative d-flex justify-content-center align-items-center" style="width: 300px; height:200px;">
                        <div class="position-absolute top-0 start-0 end-0 bottom-0 d-flex justify-content-center align-items-center" style="background-color: rgba(0, 0, 0, 0.597);">
                            <label for="expAFile<?php echo $exp_data['exploration_id'] ?>" class="btn fw-bold fs-6 text-white" style="background-color: rgba(0, 0, 0, 0.597);">Change Image</label>
                            <input type="file" class="visually-hidden" id="expAFile<?php echo $exp_data["exploration_id"]; ?>" onchange="updateExplorationImage(<?php echo $exp_data['exploration_id']; ?>);" />
                        </div>
                        <img src="<?php echo $exp_data["url"]; ?>" id="expAFileImg<?php echo $exp_data["exploration_id"]; ?>" style="width: 300px; height:200px; background-size: cover;">
                    </div>

                    <div class="col-10 d-flex justify-content-center">
                        <button class="btn btn-outline-warning col-5 d-grid mt-3" onclick="updateExploration('<?php echo $exp_data['exploration_id']; ?>');">Update</button>
                        <button class="btn btn-outline-danger col-5 d-grid mt-3 ms-3" onclick="deleteExploration('<?php echo $exp_data['exploration_id']; ?>');">Delete</button>
                    </div>
                </span>

                <div class="col-8 d-flex flex-column ">
                    <span class="d-flex flex-row justify-content-between mb-3">
                        <span class="col-4">
                            <label>Place Name : </label>
                            <input class="form-control" type="text" value="<?php echo $exp_data["place_name"]; ?>" id="expName<?php echo $exp_data['exploration_id']; ?>"/>
                        </span>
                    </span>
                    <label class="mt-2">Description : </label>
                    <textarea class="px-4 py-4" style="resize: none;" id="expTextArea<?php echo $exp_data["exploration_id"]; ?>" cols="55" rows="7"><?php echo $exp_data["description"]; ?></textarea>
                </div>

            </div>
        </div>
<?php
    }
}

?>