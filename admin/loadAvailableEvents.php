<?php
session_start();
require "../connection/connection.php";


$event_rs = Database::search("SELECT * FROM `event` INNER JOIN `event_image` ON
    `event_image`.`event_event_id` = `event`.`event_id` 
    WHERE `event`.`status_status_id`='1' AND `event`.`status_status_id`='1' ORDER BY `event_id` DESC");

$event_num = $event_rs->num_rows;

if ($event_num > 0) {
?>

    <p class="mb-4 fw-bold">Manage Events</p>

<?php
}
for ($x = 0; $x < $event_num; $x++) {
    $event_data = $event_rs->fetch_assoc();
?>
    <div class="col-12 mb-5 border border-0 border-bottom border-primary" style="margin-left: 1.5%;">
        <div class="row my-5">

            <span class="d-flex flex-column col-4">
                <div class="col-3 position-relative d-flex justify-content-center align-items-center" style="width: 300px; height:200px;">
                    <div class="position-absolute top-0 start-0 end-0 bottom-0 d-flex justify-content-center align-items-center" style="background-color: rgba(0, 0, 0, 0.597);">
                        <label for="evAFile<?php echo $event_data['event_id']; ?>" class="btn fw-bold fs-6 text-white" style="background-color: rgba(0, 0, 0, 0.597);">Change Image</label>
                        <input type="file" class="visually-hidden" id="evAFile<?php echo $event_data["event_id"]; ?>" onchange="UpdateEventImage(<?php echo $event_data['event_id']; ?>);" />
                    </div>
                    <img src="<?php echo $event_data["url"]; ?>" id="evAFileImg<?php echo $event_data["event_id"]; ?>" style="width: 300px; height:200px; background-size: cover;">
                </div>

                <div class="col-10 d-flex justify-content-center">
                    <button class="btn btn-outline-warning col-5 d-grid mt-3" onclick="updateEvent('<?php echo $event_data['event_id']; ?>');">Update</button>
                    <button class="btn btn-outline-danger col-5 d-grid mt-3 ms-3" onclick="deleteEvent('<?php echo $event_data['event_id']; ?>');">Delete</button>
                </div>
            </span>

            <div class="col-8 d-flex flex-column ">
                <span class="d-flex flex-row justify-content-between mb-3">
                    <span class="col-4">
                        <label>Feature : </label>
                        <input class="form-control" type="text" value="<?php echo $event_data["feature"]; ?>" id="eFeature<?php echo $event_data['event_id'] ?>"/>
                    </span>
                </span>
                <label class="mt-2">Description : </label>
                <textarea class="px-4 py-4" style="resize: none;" id="evTextArea<?php echo $event_data["event_id"]; ?>" cols="55" rows="7"><?php echo $event_data["description"] ?></textarea>
            </div>

        </div>
    </div>
<?php
}

?>