<?php
session_start();
require "../connection/connection.php";

$galery_rs = Database::search("SELECT * FROM `gallery` INNER JOIN `gallery_image` ON
        `gallery_image`.`gallery_gallery_id` = `gallery`.`gallery_id`  WHERE `gallery`.`status_status_id`='1' 
        AND `gallery_image`.`status_status_id`='1' ORDER BY `gallery`.`gallery_id` DESC");
$galery_num = $galery_rs->num_rows;

if ($galery_num > 0) {
?>

    <p class="mb-4 fw-bold">Manage Galery</p>

    <?php

    for ($x = 0; $x < $galery_num; $x++) {
        $galery_data = $galery_rs->fetch_assoc();
    ?>
        <div class="col-12 mb-5 border border-0 border-bottom border-primary" style="margin-left: 1.5%;">
            <div class="row my-5">

                <span class="d-flex flex-column col-4">
                    <div class="col-3 position-relative d-flex justify-content-center align-items-center" style="width: 300px; height:200px;">
                        <div class="position-absolute top-0 start-0 end-0 bottom-0 d-flex justify-content-center align-items-center" style="background-color: rgba(0, 0, 0, 0.597);">
                            <label for="glAFile<?php echo $galery_data['gallery_id']; ?>" class="btn fw-bold fs-6 text-white" style="background-color: rgba(0, 0, 0, 0.597);">Change Image</label>
                            <input type="file" class="visually-hidden" id="glAFile<?php echo $galery_data["gallery_id"]; ?>" onchange="updateGalleryImage(<?php echo $galery_data['gallery_id']; ?>);" />
                        </div>
                        <img src="<?php echo $galery_data["url"]; ?>" id="glAFileImg<?php echo $galery_data["gallery_id"]; ?>" style="width: 300px; height:200px; background-size: cover;">
                    </div>

                    <div class="col-10 d-flex justify-content-center">
                        <button class="btn btn-outline-warning col-5 d-grid mt-3" onclick="updateGallery('<?php echo $galery_data['gallery_id']; ?>');">Update</button>
                        <button class="btn btn-outline-danger col-5 d-grid mt-3 ms-3" onclick="deleteGallery('<?php echo $galery_data['gallery_id']; ?>');">Delete</button>
                    </div>
                </span>

                <div class="col-8 d-flex flex-column ">
                    <span class="d-flex flex-row justify-content-between mb-3">
                        <span class="col-3">
                            <label>Galery Type : </label>
                            <select class="form-control" id="gltype<?php echo $galery_data['gallery_id']; ?>">
                                <?php
                                $g_type_rs = Database::search("SELECT * FROM `gallery_type` WHERE `gallery_type`.`status_status_id`='1'");
                                if ($g_type_rs->num_rows > 0) {
                                    for ($p = 0; $p < $g_type_rs->num_rows; $p++) {
                                        $g_type_data = $g_type_rs->fetch_assoc();
                                ?>
                                        <option value="<?php echo $g_type_data["gallery_type_id"]; ?>" <?php
                                                                                                        if ($g_type_data["gallery_type_id"] == $galery_data["gallery_type_gallery_type_id"]) {
                                                                                                        ?> selected <?php
                                                                                                            }
                                                                                                                ?>><?php echo $g_type_data["type"]; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </span>
                    </span>
                    <!-- <label for="" class="mt-2">Description :</label> -->
                    <!-- <textarea class="px-4 py-4" style="resize: none;" id="TextArea<?php echo $galery_data["gallery_id"] ?>" cols="55" rows="7"><?php echo $galery_data["description"] ?></textarea> -->
                </div>

            </div>
        </div>
<?php
    }
}
?>