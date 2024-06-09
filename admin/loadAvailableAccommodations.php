<?php
session_start();
require "../connection/connection.php";

$accommodation_rs = Database::search("SELECT * FROM `accommodation` INNER JOIN `accommodation_image` ON
    `accommodation_image`.`accommodation_accommodation_id` = `accommodation`.`accommodation_id` 
    WHERE `accommodation`.`status_status_id`='1' AND `accommodation_image`.`status_status_id`='1' ORDER BY `accommodation_id` DESC");

$accommodation_NUM = $accommodation_rs->num_rows;

if ($accommodation_NUM > 0) {
?>
    <p class="mb-4 fw-bold">Manage Accommodations</p>

<?php
}
for ($x = 0; $x < $accommodation_NUM; $x++) {
    $accommodation_data = $accommodation_rs->fetch_assoc();
?>
    <div class="col-12 mb-5 border border-0 border-bottom border-primary" style="margin-left: 1.5%;">
        <div class="row my-5">

            <span class="d-flex flex-column col-4">
                <div class="col-3 position-relative d-flex justify-content-center align-items-center" style="width: 300px; height:200px;">
                    <div class="position-absolute top-0 start-0 end-0 bottom-0 d-flex justify-content-center align-items-center" style="background-color: rgba(0, 0, 0, 0.597);">
                        <label for="AFile<?php echo $accommodation_data['accommodation_id']; ?>" class="btn fw-bold fs-6 text-white" style="background-color: rgba(0, 0, 0, 0.597);">Change Image</label>
                        <input type="file" class="visually-hidden" id="AFile<?php echo $accommodation_data["accommodation_id"]; ?>" onchange="UpdateaccommodationImage(<?php echo $accommodation_data['accommodation_id']; ?>);" />
                    </div>
                    <img src="<?php echo $accommodation_data["url"]; ?>" id="AFileImg<?php echo $accommodation_data["accommodation_id"]; ?>" style="width: 300px; height:200px; background-size: cover;">
                </div>

                <div class="col-10 d-flex justify-content-center">
                    <button class="btn btn-outline-warning col-5 d-grid mt-3" onclick="Uplocadaccommodation('<?php echo $accommodation_data['accommodation_id']; ?>');">Update</button>
                    <button class="btn btn-outline-danger col-5 d-grid mt-3 ms-3" onclick="Deleteaccommodation('<?php echo $accommodation_data['accommodation_id']; ?>');">Delete</button>
                </div>
            </span>

            <div class="col-8 d-flex flex-column ">
                <span class="d-flex flex-row justify-content-between mb-3">
                    <span class="col-4">
                        <label>Name : </label>
                        <input class="form-control" type="text" value="<?php echo $accommodation_data["name"]; ?>" id="mName<?php echo $accommodation_data['accommodation_id']; ?>" />
                    </span>
                    <span class="col-4">
                        <label>Size : </label>
                        <input class="form-control" type="text" value="<?php echo $accommodation_data["size"]; ?>" id="mSize<?php echo $accommodation_data['accommodation_id']; ?>" />
                    </span>
                    <span class="col-3">
                        <label>Package : </label>
                        <select class="form-control" id="mPackage<?php echo $accommodation_data['accommodation_id']; ?>">
                            <?php
                            $acc_pkg_rs = Database::search("SELECT * FROM `accommodation_package` WHERE `accommodation_package`.`status_status_id`='1'");
                            if ($acc_pkg_rs->num_rows > 0) {
                                for ($p = 0; $p < $acc_pkg_rs->num_rows; $p++) {
                                    $acc_pkg_data = $acc_pkg_rs->fetch_assoc();
                            ?>
                                    <option value="<?php echo $acc_pkg_data["accommodation_package_id"]; ?>" <?php
                                                                                                                if ($acc_pkg_data["accommodation_package_id"] == $accommodation_data["accommodation_package_accommodation_package_id"]) {
                                                                                                                ?> selected <?php
                                                                                                                        }
                                                                                                                            ?>><?php echo $acc_pkg_data["package_name"]; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </span>
                </span>
                <label for="" class="mt-2">Description :</label>
                <textarea class="px-4 py-4" style="resize: none;" id="TextArea<?php echo $accommodation_data["accommodation_id"]; ?>" cols="55" rows="7"><?php echo $accommodation_data["description"]; ?></textarea>
            </div>

        </div>
    </div>
<?php
}

?>