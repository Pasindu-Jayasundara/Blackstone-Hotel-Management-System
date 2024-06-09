<?php

session_start();
require "../connection/connection.php";

$hotel_rs = Database::search("SELECT * FROM `hotel` WHERE `hotel`.`status_status_id`='1'");
$hotel_data = $hotel_rs->fetch_assoc();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us | <?php echo $hotel_data["name"]; ?></title>

    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css" />
    <link rel="stylesheet" href="../css/other/contactUs.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="icon" href="<?php echo $hotel_data["black_logo_url"]; ?>" />
</head>

<body>

    <?php include "../user/loading.php"; ?>

    <span id="mainContent" class="d-none">
        <div class="container-fluid min-vh-100" id="overflow">
            <div class="row">

                <?php include "../user/header.php"; ?>

                <div class="col-12" id="video">
                    <div class="row">

                        <div class="d-flex flex-row justify-content-center align-items-center" style="background-image: url('../designImages/contact.webp'); background-repeat: no-repeat; background-position-x: right;">
                            <div class="b1 d-flex flex-row justify-content-center align-items-center">CONTACT US</div>
                        </div>

                        <div class="mb-5 pb-5 mt-4 d-flex flex-column flex-md-row justify-content-center align-items-center gap-4">
                            <div class="me-5 pe-5 bn1">
                                <p class="h41">Name</p>
                                <input type="text" class="Name" id="name">
                                <p class="h41">Your Email Address</p>
                                <input type="text" class="Name" id="email">
                                <p class="h41">Message Title</p>
                                <input type="text" class="Name" id="messageTitel">
                                <p class="h41">Message </p>
                                <textarea type="text" rows="5" cols="46" class="textField" id="message"></textarea>
                                <div class="btn text-white col-5 d-grid mt-5" style="background-color: rgba(11, 20, 70, 0.945);" onclick="sendMessage();">Send Message</div>
                            </div>
                            <div class="bn">
                                <h4 class="fw-bold"><?php echo $hotel_data["name"]; ?> Hotel</h4>
                                <div class="ms-5 mt-4">
                                    <div class="d-flex flex-row gap-4">
                                        <p class="fw-bold t">Email : &nbsp;&nbsp;&nbsp;</p>
                                        <p class=""><?php echo $hotel_data["email"]; ?></p>
                                    </div>
                                    <?php
                                    $rs = Database::search("SELECT * FROM `hotel_mobile` WHERE `hotel_mobile`.`status_status_id`='1'");
                                    if ($rs->num_rows > 0) {
                                    ?>
                                        <div class="d-flex flex-row gap-4">
                                            <p class="fw-bold t">Contact :</p>
                                            <div>
                                                <?php
                                                for ($x = 0; $x < $rs->num_rows; $x++) {
                                                    $m_data = $rs->fetch_assoc();
                                                ?>

                                                    <p class=""><?php echo $m_data["mobile"]; ?></p>

                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    $ars = Database::search("SELECT * FROM `hotel_address` WHERE `hotel_address`.`status_status_id`='1'");
                                    if ($ars->num_rows > 0) {
                                    ?>
                                        <div class="d-flex flex-row gap-4">
                                            <p class="fw-bold t">Address :</p>
                                            <div>
                                                <?php
                                                for ($y = 0; $y < $ars->num_rows; $y++) {
                                                    $a_data = $ars->fetch_assoc();
                                                ?>

                                                    <p class="add text-wrap"><?php echo $a_data["line_1"] . " " . $a_data["line_2"]; ?></p>

                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    <?php
                                    }

                                    if ($hotel_data["map_link"] != null) {
                                    ?>
                                        <div>
                                            <p class="fw-bold t">Location :</p>
                                            <div>
                                                <?php echo $hotel_data["map_link"]; ?>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <?php include "../user/footer.php"; ?>

            </div>
        </div>

        <?php include_once "../user/userError.php"; ?>

        <!-- notification -->
        <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 50;">
            <div id="liveToastA" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-secondary text-white" id="headerColorA">

                    <strong class="me-auto">Message</strong>
                    <small id="timeA"></small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" id="msgA">
                </div>
            </div>
        </div>

    </span>

    <script src="../js/other/loading.js"></script>
    <script src="../js/other/contactUs.js"></script>
    <script src="../js/bootstrap/bootstrap.bundle.js"></script>
    <script src="../js/other/toast.js"></script>

</body>

</html>