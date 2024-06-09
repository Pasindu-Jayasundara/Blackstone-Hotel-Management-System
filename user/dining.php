<?php

session_start();
require "../connection/connection.php";

$hotel_rs = Database::search("SELECT * FROM `hotel` WHERE `hotel`.`status_status_id`='1'");
$hotel_data = $hotel_rs->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dining | <?php echo $hotel_data["name"]; ?></title>

    <link rel="stylesheet" href="../css/other/dining.css">
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link rel="icon" href="<?php echo $hotel_data["black_logo_url"]; ?>" />

</head>

<body>

<?php include "../user/loading.php"; ?>

    <div class="container-fluid bg-black text-white d-none" id="mainContent">
        <div class="row">

            <?php include "../user/header.php"; ?>

            <div class="col-12 mt-4" id="video">
                <div class="row min-vh-100">

                    <div class="col-12 col-md-2 ps-3 mt-2 mb-5">
                        <div class="row">

                            <div class="list-group" style="z-index: 2; ">
                                <span class="list-group-item list-group-item-action  bg-dark text-white" id="1" onclick="type(1);">Breakfast</span>
                                <span class="list-group-item list-group-item-action  bg-dark text-white" id="2" onclick="type(2);">Lunch</span>
                                <span class="list-group-item list-group-item-action  bg-dark text-white" id="3" onclick="type(3);">Dinner</span>
                                <span class="list-group-item list-group-item-action  bg-dark text-white" id="4" onclick="type(4);">Drinks</span>
                            </div>

                        </div>
                    </div>

                    <div class="col-12 col-md-10">

                        <div class="row mb-4 d-flex flex-column flex-md-row align-items-center" style="gap: 15px;" id="foodContainer">

                            <?php
                            $dr_rs = Database::search("SELECT * FROM `dining` WHERE `dining_type_dining_type_id`='2' AND `dining`.`status_status_id`='1' ORDER BY RAND() LIMIT 6");
                            if ($dr_rs->num_rows > 0) {
                            ?>
                                <label>Drinks</label>
                                <?php
                                for ($d = 0; $d < $dr_rs->num_rows; $d++) {
                                    $dr_data = $dr_rs->fetch_assoc();

                                    $dr_img_rs = Database::search("SELECT * FROM `dining_images` WHERE `dining_images`.`dining_dining_id`='" . $dr_data["dining_id"] . "' 
                                    AND `dining_images`.`status_status_id`='1'");

                                    $dr_img_data = $dr_img_rs->fetch_assoc();
                                ?>

                                    <div class="fcard p-1 text-white position-relative" data-content="Rs. <?php echo $dr_data["price"]; ?>" style="width:200px; height:250px;">
                                        <img src="<?php echo $dr_img_data["path"]; ?>" class="p-0 m-0" style="width:100%; height:100%; object-fit: cover; border-radius: 14px;" />
                                        <div class="position-absolute text-white bg-black py-2 text-center" style="font-size: 18px; bottom:4px; width: 96%; border-bottom-right-radius: inherit; border-bottom-left-radius:inherit;"><?php echo $dr_data["name"]; ?></div>
                                    </div>
                            <?php
                                }
                            }
                            ?>

                            <?php
                            $b_rs = Database::search("SELECT * FROM `dining` WHERE `dining`.`dining_category_dining_category_id`='1' AND `dining`.`status_status_id`='1'
                            AND `dining`.`dining_type_dining_type_id`='1' ORDER BY RAND() LIMIT 6");

                            if ($b_rs->num_rows > 0) {
                            ?>
                                <label>Breakfast</label>
                                <?php

                                for ($b = 0; $b < $b_rs->num_rows; $b++) {
                                    $b_data = $b_rs->fetch_assoc();

                                    $b_img_rs = Database::search("SELECT * FROM `dining_images` WHERE `dining_images`.`dining_dining_id`='" . $b_data["dining_id"] . "' 
                                    AND `dining_images`.`status_status_id`='1'");

                                    $b_img_data = $b_img_rs->fetch_assoc();

                                ?>
                                    <div class="fcard p-1 text-white position-relative" data-content="Rs. <?php echo $b_data["price"]; ?>" style="width:200px; height:250px;">
                                        <img src="<?php echo $b_img_data["path"]; ?>" class="p-0 m-0" style="width:100%; height:100%; object-fit: cover; border-radius: 14px;" />
                                        <div class="position-absolute text-white bg-black py-2 text-center" style="font-size: 18px;  bottom:4px; width: 96%; border-bottom-right-radius: inherit; border-bottom-left-radius:inherit;"><?php echo $b_data["name"]; ?></div>
                                    </div>
                            <?php
                                }
                            }
                            ?>

                            <?php
                            $l_rs = Database::search("SELECT * FROM `dining` WHERE `dining`.`dining_category_dining_category_id`='2' AND `dining`.`status_status_id`='1'
                            AND `dining`.`dining_type_dining_type_id`='1' ORDER BY RAND() LIMIT 6");

                            if ($l_rs->num_rows > 0) {
                            ?>
                                <label>Lunch</label>
                                <?php

                                for ($l = 0; $l < $l_rs->num_rows; $l++) {
                                    $l_data = $l_rs->fetch_assoc();

                                    $l_img_rs = Database::search("SELECT * FROM `dining_images` WHERE `dining_images`.`dining_dining_id`='" . $l_data["dining_id"] . "' 
                                    AND `dining_images`.`status_status_id`='1'");

                                    $l_img_data = $l_img_rs->fetch_assoc();

                                ?>
                                    <div class="fcard p-1 text-white position-relative" data-content="Rs. <?php echo $l_data["price"]; ?>" style="width:200px; height:250px;">
                                        <img src="<?php echo $l_img_data["path"]; ?>" class="p-0 m-0" style="width:100%; height:100%; object-fit: cover; border-radius: 14px;" />
                                        <div class="position-absolute text-white bg-black py-2 text-center" style="font-size: 18px;  bottom:4px; width: 96%; border-bottom-right-radius: inherit; border-bottom-left-radius:inherit;"><?php echo $l_data["name"]; ?></div>
                                    </div>
                            <?php
                                }
                            }
                            ?>

                            <?php
                            $n_rs = Database::search("SELECT * FROM `dining` WHERE `dining`.`dining_category_dining_category_id`='3' AND `dining`.`status_status_id`='1'
                            AND `dining`.`dining_type_dining_type_id`='1' ORDER BY RAND() LIMIT 6");

                            if ($n_rs->num_rows > 0) {
                            ?>
                                <label>Dinner</label>
                                <?php

                                for ($n = 0; $n < $n_rs->num_rows; $n++) {
                                    $n_data = $n_rs->fetch_assoc();

                                    $n_img_rs = Database::search("SELECT * FROM `dining_images` WHERE `dining_images`.`dining_dining_id`='" . $n_data["dining_id"] . "' 
                                    AND `dining_images`.`status_status_id`='1'");

                                    $n_img_data = $n_img_rs->fetch_assoc();

                                ?>
                                    <div class="fcard p-1 text-white position-relative" data-content="Rs. <?php echo $n_data["price"]; ?>" style="width:200px; height:250px;">
                                        <img src="<?php echo $n_img_data["path"]; ?>" class="p-0 m-0" style="width:100%; height:100%; object-fit: cover; border-radius: 14px;" />
                                        <div class="position-absolute text-white bg-black py-2 text-center" style="font-size: 18px;  bottom:4px; width: 96%; border-bottom-right-radius: inherit; border-bottom-left-radius:inherit;"><?php echo $n_data["name"]; ?></div>
                                    </div>
                            <?php
                                }
                            }
                            ?>

                        </div>
                    </div>

                </div>
            </div>

            <?php include "../user/footer.php"; ?>

        </div>
    </div>
    <script async src="../js/other/loading.js"></script>
    <script src="../js/other/dining.js"></script>
    <script src="../js/bootstrap/bootstrap.bundle.js"></script>

</body>

</html>