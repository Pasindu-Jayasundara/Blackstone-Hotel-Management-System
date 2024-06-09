<?php
session_start();
require "../connection/connection.php";


$sm_rs = Database::search("SELECT * FROM `special_moment` INNER JOIN `special_moment_image` ON
`special_moment_image`.`special_moment_special_moment_id` = `special_moment`.`special_moment_id` 
WHERE `special_moment`.`status_status_id`='1' AND `special_moment_image`.`status_status_id`='1' ORDER BY `special_moment_id` DESC");
$sm_num = $sm_rs->num_rows;

if ($sm_num > 0) {
?>
    <p class="mb-4 fw-bold">Manage Special Moments</p>

    <?php


    for ($x = 0; $x < $sm_num; $x++) {
        $sm_data = $sm_rs->fetch_assoc();
    ?>
        <div class="col-12 mb-5 border border-0 border-bottom border-primary" style="margin-left: 1.5%;">
            <div class="row my-5">

                <span class="d-flex flex-column col-4">
                    <div class="col-3 position-relative d-flex justify-content-center align-items-center" style="width: 300px; height:200px;">
                        <div class="position-absolute top-0 start-0 end-0 bottom-0 d-flex justify-content-center align-items-center" style="background-color: rgba(0, 0, 0, 0.597);">
                            <label for="smAFile<?php echo $sm_data['special_moment_id']; ?>" class="btn fw-bold fs-6 text-white" style="background-color: rgba(0, 0, 0, 0.597);">Change Image</label>
                            <input type="file" class="visually-hidden" id="smAFile<?php echo $sm_data["special_moment_id"]; ?>" onchange="updateSpecialMomentImage(<?php echo $sm_data['special_moment_id']; ?>);" />
                        </div>
                        <img src="<?php echo $sm_data["url"]; ?>" id="smAFileImg<?php echo $sm_data["special_moment_id"]; ?>" style="width: 300px; height:200px; background-size: cover;">
                    </div>

                    <div class="col-10 d-flex justify-content-center">
                        <button class="btn btn-outline-warning col-5 d-grid mt-3" onclick="updateSpecialMoment('<?php echo $sm_data['special_moment_id']; ?>');">Update</button>
                        <button class="btn btn-outline-danger col-5 d-grid mt-3 ms-3" onclick="deleteSpecialMoment('<?php echo $sm_data['special_moment_id']; ?>');">Delete</button>
                    </div>
                </span>

                <div class="col-8 d-flex flex-column ">
                    <label class="">Description : </label>
                    <textarea class="px-4 py-4" style="resize: none;" id="smTextArea<?php echo $sm_data["special_moment_id"]; ?>" cols="55" rows="7"><?php echo $sm_data["description"]; ?></textarea>
                </div>

            </div>
        </div>
<?php
    }
}
?>