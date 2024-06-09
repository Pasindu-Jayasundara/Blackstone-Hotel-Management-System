<?php
session_start();
require "../connection/connection.php";

$gr_img_rs = Database::search("SELECT * FROM `growth_images` WHERE `growth_images`.`status_status_id`='1' ORDER BY `growth_images_id` DESC");

for ($gi = 0; $gi < $gr_img_rs->num_rows; $gi++) {
    $gr_img_data = $gr_img_rs->fetch_assoc();

?>
    <div class="col" style="width: 222px;">
        <div class="card h-100">
            <img src="<?php echo $gr_img_data["url"]; ?>" class="card-img-top" style="width: 200px; height: 200px; object-fit: cover; object-position: center;" alt="...">
            <div class="card-body d-flex justify-content-center align-items-center bg-black">
                <span class="btn btn-danger" onclick="deleteGrowthImage('<?php echo $gr_img_data['growth_images_id']; ?>');">Delete</span>
            </div>
        </div>
    </div>
<?php

}
?>