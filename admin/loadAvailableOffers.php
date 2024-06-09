<?php

session_start();
require "../connection/connection.php";

$offers_rs = Database::search("SELECT * FROM `offers` INNER JOIN `offer_image` ON
            `offer_image`.`offers_offers_id` = `offers`.`offers_id` WHERE `offers`.`status_status_id`='1' 
            AND `offer_image`.`status_status_id`='1' ORDER BY `offers_id` DESC");
$offers_num = $offers_rs->num_rows;

if ($offers_num > 0) {
?>
    <p class="mb-4 fw-bold">Manage Offers</p>

    <?php

    for ($x = 0; $x < $offers_num; $x++) {
        $offers_data = $offers_rs->fetch_assoc();
    ?>
        <div class="col-12 mb-5 border border-0 border-bottom border-primary" style="margin-left: 1.5%;">
            <div class="row my-5">

                <span class="d-flex flex-column col-4">
                    <div class="col-3 position-relative d-flex justify-content-center align-items-center" style="width: 300px; height:200px;">
                        <div class="position-absolute top-0 start-0 end-0 bottom-0 d-flex justify-content-center align-items-center" style="background-color: rgba(0, 0, 0, 0.597);">
                            <label for="ofAFile<?php echo $offers_data['offers_id']; ?>" class="btn fw-bold fs-6 text-white" style="background-color: rgba(0, 0, 0, 0.597);">Change Image</label>
                            <input type="file" class="visually-hidden" id="ofAFile<?php echo $offers_data["offers_id"]; ?>" onchange="updateOfferImage(<?php echo $offers_data['offers_id']; ?>);" />
                        </div>
                        <img src="<?php echo $offers_data["url"]; ?>" id="ofAFileImg<?php echo $offers_data["offers_id"]; ?>" style="width: 300px; height:200px; background-size: cover;">
                    </div>

                    <div class="col-10 d-flex justify-content-center">
                        <button class="btn btn-outline-warning col-5 d-grid mt-3" onclick="updateOffer('<?php echo $offers_data['offers_id']; ?>');">Update</button>
                        <button class="btn btn-outline-danger col-5 d-grid mt-3 ms-3" onclick="deleteOffer('<?php echo $offers_data['offers_id']; ?>');">Delete</button>
                    </div>
                </span>

                <div class="col-8 d-flex flex-column ">
                    <span class="d-flex flex-row justify-content-start mb-3">
                        <span class="col-4">
                            <label>Start Date Time : </label>
                            <input class="form-control" type="datetime-local" id="ofsdt<?php echo $offers_data["offers_id"]; ?>" value="<?php echo $offers_data["start_date_time"]; ?>" />
                        </span>
                        <span class="col-4 ms-3">
                            <label>End Date Time : </label>
                            <input class="form-control" type="datetime-local" id="ofedt<?php echo $offers_data["offers_id"]; ?>" value="<?php echo $offers_data["end_date_time"]; ?>" />
                        </span>
                    </span>
                    <label for="" class="mt-2">Description :</label>
                    <textarea class="px-4 py-4" style="resize: none;" id="ofTextArea<?php echo $offers_data["offers_id"]; ?>" cols="55" rows="7"><?php echo $offers_data["description"]; ?></textarea>
                </div>

            </div>
        </div>
<?php
    }
}
?>