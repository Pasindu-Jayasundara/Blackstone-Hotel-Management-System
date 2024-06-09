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
    <title>About Us | <?php echo $hotel_data["name"]; ?></title>

    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css" />
    <link rel="stylesheet" href="../css/other/aboutUs.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="icon" href="<?php echo $hotel_data["black_logo_url"]; ?>" />
    <link rel="stylesheet" href="../css/sementic/semantic.css" />

</head>

<body>

    <?php include "../user/loading.php"; ?>

    <span id="mainContent" class="d-none">
        <div class="container-fluid min-vh-100" id="overflow">
            <div class="row">

                <?php include "../user/header.php"; ?>

                <div class="col-12" id="video">
                    <div class="row">

                        <!-- vission mission -->
                        <?php
                        $rs = Database::search("SELECT * FROM `purpose` WHERE `purpose`.`status_status_id`='1'");
                        if ($rs->num_rows == 1) {
                            $data = $rs->fetch_assoc();
                        ?>
                            <div class="d-flex flex-column justify-content-center align-items-center mt-5 position-relative">
                                <div class="d-flex justify-content-center align-items-start">
                                    <h2 class="text-uppercase px-5 py-2 rounded-2 title">about us</h2>
                                </div>
                                <div class="d-flex flex-md-row flex-column justify-content-center align-items-center w-75 gap-5 mt-5 pt-3">
                                    <div class="d-flex justify-content-center align-items-center flex-column position-relative m1 me-4 pe-4">
                                        <div class="text-uppercase d-flex justify-content-center align-items-center sm1">our vision</div>
                                        <div class="bg1 d-flex justify-content-center align-items-center">
                                            <p class="w-75 text-center text-wrap fw-bold fs-6" style="width:inherit">
                                                <?php echo $data["vission"]; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center flex-column ms-5 m2 ms-4 ps-4">
                                        <div class="text-uppercase d-flex justify-content-center align-items-center sm1">our mission</div>
                                        <div class="bg1 d-flex justify-content-center align-items-center">
                                            <p class="w-75 text-center text-wrap fw-bold fs-6" style="width:inherit">
                                                <?php echo $data["mission"]; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="position-absolute col-12 d-flex flex-column flex-md-row justify-content-between p-0 m-0 dm">
                                    <img src="../designImages/mission.png" width="580vw" class="v v1" alt="">
                                    <img src="../designImages/vission.png" width="580vw" class="v v2">
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                        <!-- growth -->
                        <?php
                        $grs = Database::search("SELECT * FROM `growth` WHERE `growth`.`status_status_id`='1'");
                        if ($grs->num_rows > 0) {
                            $gdata = $grs->fetch_assoc();
                        ?>
                            <div class="d-flex flex-column justify-content-center align-items-start mt-5 ms-0 ps-0 mt-5 pt-5">
                                <div class="d-flex justify-content-center align-items-start ms-0 ps-0">
                                    <h2 class="text-uppercase px-5 py-2 title" style="border-top-right-radius: 50px; border-bottom-right-radius: 50px;">our growth</h2>
                                </div>
                                <div class="d-flex flex-column justify-content-center align-items-center mt-4">
                                    <div class="d-flex flex-row justify-content-center align-items-center rounded-2 second" style="z-index: 10;">
                                        <p class="text-center text-wrap pt-3 px-4 pb-3 fw-bold"><?php echo $gdata["description"]; ?></p>
                                    </div>
                                    <span id="gic"></span>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                        <!-- management -->
                        <?php
                        $mrs = Database::search("SELECT * FROM `management` INNER JOIN `management_img` ON `management`.`management_id`=`management_img`.`management_img_id`
                        WHERE `management`.`status_status_id`='1' AND `management_img`.`status_status_id`='1'");
                        if ($mrs->num_rows > 0) {
                        ?>
                            <div class="d-flex flex-column justify-content-center align-items-center ms-0 ps-0" style="margin-top: 20vh; margin-bottom: 20vh;">
                                <div class="d-flex justify-content-center align-items-start me-0 pe-0">
                                    <h2 class="text-uppercase px-5 py-2 title" style="border:15px">our management</h2>
                                </div>
                                <div class="d-flex flex-column justify-content-center align-items-center col-12 mt-5 pt-5">
                                    <div class="row row-cols-1 row-cols-md-5 g-4 col-12 d-flex justify-content-center ps-5">
                                        <?php
                                        for ($x = 0; $x < $mrs->num_rows; $x++) {
                                            $mdata = $mrs->fetch_assoc();

                                        ?>
                                            <div class="col d-flex justify-content-center flex-column align-items-center">
                                                <img src="<?php echo $mdata["url"]; ?>" style="border:7px #002E3D solid; border-radius: 50%; background-position: center; background-repeat: no-repeat; background-size: cover;" width="200vw" height="200vh">
                                                <p class="text-center mt-3 fs-5">
                                                    <span><?php echo $mdata["name"]; ?></span><br />
                                                    <span><?php echo $mdata["position"]; ?></span>
                                                </p>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <?php include "../user/footer.php"; ?>

            </div>
        </div>
    </span>

    <script src="../js/other/loading.js"></script>
    <script src="../js/other/aboutus.js"></script>

</body>

</html>