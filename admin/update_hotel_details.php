<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php
            $hotel_rs = Database::search("SELECT * FROM `hotel` 
            INNER JOIN `hotel_address` ON `hotel`.`hotel_address_hotel_address_id`=`hotel_address`.`hotel_address_id` WHERE `hotel`.`status_status_id`='1' AND `hotel_address`.`status_status_id`='1'");
            if ($hotel_rs->num_rows == 1) {

                $hotel_data = $hotel_rs->fetch_assoc();

            ?>

                <!-- form -->
                <form class="row g-3 needs-validation" novalidate>
                    <div class="col-md-4">
                        <label class="form-label">Hotel Name</label>
                        <input type="text" class="form-control" value="<?php echo $hotel_data["name"]; ?>" id="s_name" required />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Email Address</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">@</span>
                            <input type="text" class="form-control" value="<?php echo $hotel_data["email"]; ?>" id="s_email" required />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">App Password</label>
                        <input type="tel" class="form-control" value="<?php echo $hotel_data["app_password_code"]; ?>" id="s_app_password" required />
                    </div>
                    <?php
                    $_SESSION["s_email"] = $hotel_data["email"];
                    $_SESSION["s_password"] = $hotel_data["app_password_code"];
                    ?>
                    <div class="col-md-4">
                        <label class="form-label">Mobile</label>
                        <?php
                        $m_rs = Database::search("SELECT * FROM `hotel_mobile` WHERE `hotel_mobile`.`status_status_id`='1'");
                        $m_data = $m_rs->fetch_assoc();
                        ?>
                        <input type="tel" class="form-control" value="<?php echo $m_data["mobile"]; ?>" id="s_mobile" required />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Address Line 1</label>
                        <input type="text" class="form-control" value="<?php echo $hotel_data["line_1"]; ?>" id="s_line_1" required />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Address Line 2</label>
                        <input type="text" class="form-control" value="<?php echo $hotel_data["line_2"]; ?>" id="s_line_2" required />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Map Url</label>
                        <textarea type="text" class="form-control overflow-scroll" id="map_link"><?php echo filter_var($hotel_data["map_link"],FILTER_SANITIZE_URL); ?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Fb Link</label>
                        <textarea type="text" class="form-control overflow-scroll" id="fb_link"><?php echo filter_var($hotel_data["fb_link"],FILTER_SANITIZE_URL); ?></textarea>
                    </div>

                    <div class="col-12 d-flex">
                        <span class="col-6">
                            <label class="form-label">White Logo</label>
                            <div class="col-12">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-5 d-flex justify-content-center">
                                        <div class="row">
                                            <div class="ui small image">
                                                <image id="nowlogoW" src="<?php echo $hotel_data["logo_url"]; ?>" style="width:150px; aspect-ratio: 1/1;" />
                                            </div>
                                            <i class="bi bi-arrow-repeat fs-2 fw-bold" id="re1"></i>
                                            <input type="file" id="logonewW" onchange="loadWhiteLogo();" hidden />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </span>
                        <span class="col-6">
                            <label class="form-label">Black Logo</label>
                            <div class="col-6">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-5 d-flex justify-content-center">
                                        <div class="row">
                                            <div class="ui small image">
                                                <image id="nowlogoB" src="<?php echo $hotel_data["black_logo_url"]; ?>" style="width:150px; aspect-ratio: 1/1;" />
                                            </div>
                                            <i class="bi bi-arrow-repeat fs-2 fw-bold" id="re2"></i>
                                            <input type="file" id="logonewB" onchange="loadBlackLogo();" hidden />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </div>
                    <div class="col-12">
                        <span class="btn btn-primary" onclick="updateHotelDetails();">Save Changes</span>
                    </div>
                </form>
                <!-- form -->

            <?php

            } else {
                // echo ("Something Went Wrong");
            ?>
                <p class="text-danger text-center col-12">Something Went Wrong</p>
            <?php
            }
            ?>


        </div>
    </div>

    <!-- notification -->
    <!-- <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 500;">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-secondary text-white" id="headerColor">

                <strong class="me-auto">Message</strong>
                <small id="time"></small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="msg">

            </div>
        </div>
    </div> -->

    <script src="../js/other/update_hotel_details.js"></script>
</body>

</html>