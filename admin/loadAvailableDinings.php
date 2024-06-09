<?php
session_start();
require "../connection/connection.php";

$dining_rs = Database::search("SELECT * FROM `dining` INNER JOIN `dining_images` ON
    `dining_images`.`dining_dining_id` = `dining`.`dining_id` 
    WHERE `dining`.`status_status_id`='1' AND `dining_images`.`status_status_id`='1' ORDER BY `dining_id` DESC");

$dining_num = $dining_rs->num_rows;

if ($dining_num > 0) {
?>
    <p class="mb-4 fw-bold">Manage Dining</p>

<?php
}
for ($x = 0; $x < $dining_num; $x++) {
    $dining_data = $dining_rs->fetch_assoc();
?>
    <div class="col-12 mb-5 border border-0 border-bottom border-primary" style="margin-left: 1.5%;">
        <div class="row my-5">

            <span class="d-flex flex-column col-4">
                <div class="col-3 position-relative d-flex justify-content-center align-items-center" style="width: 300px; height:200px;">
                    <div class="position-absolute top-0 start-0 end-0 bottom-0 d-flex justify-content-center align-items-center" style="background-color: rgba(0, 0, 0, 0.597);">
                        <label for="diUAFile<?php echo $dining_data['dining_id']; ?>" class="btn fw-bold fs-6 text-white" style="background-color: rgba(0, 0, 0, 0.597);">Change Image</label>
                        <input type="file" class="visually-hidden" id="diUAFile<?php echo $dining_data["dining_id"]; ?>" onchange="updateDiningImage(<?php echo $dining_data['dining_id']; ?>);" />
                    </div>
                    <img src="<?php echo $dining_data["path"]; ?>" id="diUAFileImg<?php echo $dining_data["dining_id"]; ?>" style="width: 300px; height:200px; background-size: cover;">
                </div>

            </span>

            <div class="col-8 d-flex flex-column ">
                <span class="d-flex flex-row mb-3">
                    <span class="col-4">
                        <label>Name : </label>
                        <input class="form-control" type="text" value="<?php echo $dining_data["name"]; ?>" id="diUName<?php echo $dining_data['dining_id']; ?>" />
                    </span>
                    <span class="col-4 ms-5">
                        <label>Price (Rs.) : </label>
                        <input class="form-control" type="number" value="<?php echo $dining_data["price"]; ?>" id="diUPrize<?php echo $dining_data['dining_id']; ?>" />
                    </span>
                </span>
                <span class="d-flex flex-row mb-3">
                    <span class="col-4">
                        <label>Type : </label>
                        <select class="form-select" id="diUType<?php echo $dining_data['dining_id']; ?>">
                            <?php
                            $t_rs = Database::search("SELECT * FROM `dining_type` WHERE `dining_type`.`status_status_id`='1'");
                            if ($t_rs->num_rows > 0) {
                                for ($t = 0; $t < $t_rs->num_rows; $t++) {
                                    $t_data = $t_rs->fetch_assoc();
                            ?>
                                    <option value="<?php echo $t_data["dining_type_id"]; ?>" <?php
                                                                                                if ($t_data["dining_type_id"] == $dining_data["dining_type_dining_type_id"]) {
                                                                                                ?> selected <?php
                                                                                                        }
                                                                                                            ?>><?php echo $t_data["dining_type"]; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </span>
                    <span class="col-4 ms-5">
                        <label>Category : </label>
                        <select class="form-select" id="diUCategory<?php echo $dining_data['dining_id']; ?>">
                            <?php
                            $c_rs = Database::search("SELECT * FROM `dining_category` WHERE `dining_category`.`status_status_id`='1'");
                            if ($c_rs->num_rows > 0) {
                                for ($c = 0; $c < $c_rs->num_rows; $c++) {
                                    $c_data = $c_rs->fetch_assoc();
                            ?>
                                    <option value="<?php echo $c_data["dining_category_id"]; ?>" <?php
                                                                                                    if ($c_data["dining_category_id"] == $dining_data["dining_category_dining_category_id"]) {
                                                                                                    ?> selected <?php
                                                                                                            }
                                                                                                                ?>><?php echo $c_data["category"]; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </span>
                </span>
                <div class="col-6 d-flex justify-content-center" style="margin-left: -3%;">
                    <button class="btn btn-warning col-5 d-grid mt-3" onclick="updateDining('<?php echo $dining_data['dining_id']; ?>');">Update</button>
                    <button class="btn btn-danger col-5 d-grid mt-3 ms-3" onclick="deleteDining('<?php echo $dining_data['dining_id']; ?>');">Delete</button>
                </div>
            </div>

        </div>
    </div>
<?php
}

?>