<?php

$hotel_rs = Database::search("SELECT * FROM `hotel` WHERE `hotel`.`status_status_id`='1'");

$hotel_data = $hotel_rs->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>footer</title>
    <link href="../css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />

</head>

<body>
    <div class="container-fluid" style="z-index: 200;">
        <div class="col-12">
            <div class="row text-white" style="background-color: #002E3D;">

                <footer class="py-5 border-top mt-3 border-5">
                    <div class="row">
                        <div class="col-md-5 mb-3 ms-3" id="news">
                            <form>
                                <h5>NEWSLETTER</h5>
                                <p style="font-size: small;">Receive our latest offers, editor's picks and updates
                                    direct to your inbox.</p>
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" style="z-index: 5;" placeholder="Enter your email address" id="n_email" />
                                    <button class="btn btn-primary col-2" type="button" onclick="addToNewsletter();"><i class="bi bi-newspaper fs-4"></i></button>
                                </div>
                            </form>
                        </div>
                        <hr class="d-flex d-md-none" />
                        <div class="col-6 col-md-3 offset-1 mb-3">
                            <h5><?php echo $hotel_data["name"]; ?></h5>
                            <ul class="nav flex-column">
                                <li class="nav-item mt-2"><a href="../user/aboutUs.php" class="nav-link p-0 text-white" style="font-size: small;">About Us</a></li>
                                <li class="nav-item"><a href="../user/contact_us.php" class="nav-link p-0 text-white" style="font-size: small;">Contact Us</a></li>
                                <li class="nav-item"><a href="../user/specialMoment.php" class="nav-link p-0 text-white" style="font-size: small;">Special Moments</a></li>
                            </ul>
                        </div>
                        <hr class="d-flex d-md-none" />
                        <div class="col-6 col-md-2 mb-1">
                            <ul class="nav flex-column">
                                <?php
                                if (!empty($hotel_data["fb_link"])) {
                                ?>
                                    <li class="nav-item mb-2 d-flex">
                                        <img src="../designImages//facebook.svg" width="25" alt="">
                                        <a href="<?php echo $hotel_data["fb_link"]; ?>" class="nav-link p-0 text-white ms-2" style="font-size: 12px;">Blackstone
                                            by Ruhunu Bakers</a>
                                    </li>
                                <?php
                                }
                                ?>

                                <li class="nav-item mb-2 d-flex">
                                    <i class="bi bi-envelope-at fs-5"></i>
                                    <a href="#" class="nav-link p-0 text-white ms-2" style="font-size: 12px;"><?php echo $hotel_data["email"]; ?>
                                    </a>
                                </li>
                                <li class="nav-item mb-2 d-flex">
                                    <i class="bi bi-telephone fs-5"></i>
                                    <a href="#" class="nav-link p-0 text-white ms-2" style="font-size: 12px;">
                                        <?php
                                        $mobile_rs = Database::search("SELECT * FROM `hotel_mobile` WHERE `hotel_mobile`.`hotel_hotel_id`='" . $hotel_data["hotel_id"] . "' 
                                        AND `hotel_mobile`.`status_status_id`='1'");

                                        for ($x = 0; $x < $mobile_rs->num_rows; $x++) {
                                            $mobile_data = $mobile_rs->fetch_assoc();

                                            echo $mobile_data["mobile"];
                                        ?>
                                            <br />
                                        <?php
                                        }
                                        ?>
                                    </a>
                                </li>
                                <li class="nav-item mb-2 d-flex">
                                    <i class="bi bi-geo-alt fs-5"></i>
                                    <a href="#" class="nav-link p-0 text-white ms-2" style="font-size: 12px;">
                                        <?php
                                        $add_rs = Database::search("SELECT * FROM `hotel_address` INNER JOIN `hotel` 
                                        ON `hotel`.`hotel_address_hotel_address_id`=`hotel_address`.`hotel_address_id` WHERE `hotel_address`.`status_status_id`='1' 
                                        AND `hotel`.`hotel_id`='" . $hotel_data["hotel_id"] . "'");

                                        for ($y = 0; $y < $add_rs->num_rows; $y++) {
                                            $add_data = $add_rs->fetch_assoc();
                                            echo $add_data["line_1"] . " " . $add_data["line_2"];
                                        ?>
                                            <br />
                                        <?php
                                        }
                                        ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <hr class="d-flex d-md-none" />

                        <p style="font-size: 12px;" class="text-center mt-5 mb-0">Copyright &copy; 2023 <?php echo $hotel_data["name"]; ?> All Rights
                            Reserved | Developed By Gladius Software Solutions</p>

                    </div>
                </footer>

            </div>
        </div>
    </div>

    <!-- notification -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-secondary text-white" id="headerColor">

                <strong class="me-auto">Message</strong>
                <small id="time"></small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="msg">

            </div>
        </div>
    </div>

    <script src="../js/other/footer.js"></script>

</body>

</html>