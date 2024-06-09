<?php
session_start();
require "../connection/connection.php";


$growth_rs = Database::search("SELECT * FROM `management` INNER JOIN `management_img` ON
    `management`.`management_id` = `management_img`.`management_management_id` WHERE `management`.`status_status_id`='1' 
    AND `management_img`.`status_status_id`='1' ORDER BY `management_id` DESC");
$growth_num = $growth_rs->num_rows;

if ($growth_num > 0) {
?>

    <p class="mb-4 fw-bold">Manage Management</p>

    <?php


    for ($x = 0; $x < $growth_num; $x++) {
        $growth_data = $growth_rs->fetch_assoc();
    ?>
        <div class="col-12 mb-5 border border-0 border-bottom border-primary" style="margin-left: 1.5%;">
            <div class="row my-5">

                <span class="d-flex flex-column col-4">
                    <div class="col-3 position-relative d-flex justify-content-center align-items-center" style="width: 300px; height:200px;">
                        <div class="position-absolute top-0 start-0 end-0 bottom-0 d-flex justify-content-center align-items-center" style="background-color: rgba(0, 0, 0, 0.597);">
                            <label for="maAFile<?php echo $growth_data['management_id']; ?>" class="btn fw-bold fs-6 text-white" style="background-color: rgba(0, 0, 0, 0.597);">Change Image</label>
                            <input type="file" class="visually-hidden" id="maAFile<?php echo $growth_data["management_id"]; ?>" onchange="updateManagementImage(<?php echo $growth_data['management_id']; ?>);" />
                        </div>
                        <img src="<?php echo $growth_data["url"]; ?>" id="maAFileImg<?php echo $accommodation_data["accommodation_id"]; ?>" style="width: 300px; height:200px; background-size: cover;">
                    </div>

                    <div class="col-10 d-flex justify-content-center">
                        <button class="btn btn-outline-warning col-5 d-grid mt-3" onclick="updateManagement('<?php echo $growth_data['management_id']; ?>');">Update</button>
                        <button class="btn btn-outline-danger col-5 d-grid mt-3 ms-3" onclick="deleteManagement('<?php echo $growth_data['management_id']; ?>');">Delete</button>
                    </div>
                </span>

                <div class="col-8 d-flex flex-column ">
                    <span class="d-flex flex-row justify-content-between mb-3">
                        <span class="col-4">
                            <label>Name : </label>
                            <input class="form-control" type="text" id="maName<?php echo $growth_data['management_id']; ?>" value="<?php echo $growth_data["name"]; ?>" />
                        </span>
                    </span>
                    <label>Position : </label>
                    <input class="form-control" type="text" id="maPosition<?php echo $growth_data['management_id']; ?>" value="<?php echo $growth_data["position"]; ?>" />
                </div>

            </div>
        </div>
<?php
    }
}
?>