<?php

session_start();

if (!empty($_SESSION["admin"])) {

    require "../connection/connection.php";

    $hotel_rs = Database::search("SELECT * FROM `hotel` INNER JOIN `hotel_mobile` ON `hotel_mobile`.`hotel_hotel_id`=`hotel`.`hotel_id` 
    INNER JOIN `hotel_address` ON `hotel`.`hotel_address_hotel_address_id`=`hotel_address`.`hotel_address_id` 
    WHERE `hotel`.`status_status_id`='1' AND `hotel_mobile`.`status_status_id`='1' AND `hotel_address`.`status_status_id`='1'");

    $hotel_data = $hotel_rs->fetch_assoc();

    $monthName = date("F");

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard | <?php echo $hotel_data["name"]; ?></title>

        <link rel="stylesheet" href="../css/bootstrap/bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <link rel="stylesheet" href="../css/sementic/semantic.css">
        <link rel="stylesheet" href="../css/other/dashboard.css">

        <link rel="icon" href="<?php echo $hotel_data["black_logo_url"]; ?>" />
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />


        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    </head>

    <body>
        
        <div class="container-fluid d-flex vh-100" style="z-index: 2;">
            <div class="row">

                <?php include "../admin/sidebar.php"; ?>

            </div>
            <div style="overflow-y:scroll; overflow-x: hidden;">
                <div class="row mb-5">

                    <?php include "../admin/header.php"; ?>

                    <div class="col-12">
                        <div class="row">

                            <!--  -->
                            <div class="d-flex flex-row justify-content-evenly gap-5" id="sc">
                                <!--  -->
                                <div class="d-flex flex-column justify-content-center align-items-end col-12 mt-5" id="scFD">
                                    <div class="d-flex flex-column justify-content-center align-items-start ms-5">
                                        <span class="fw-bold">Search Message</span>
                                        <span class="ms-5 mt-3 d-flex">
                                            <input type="email" class="form-control" placeholder="Sender Email Address" id="msgEmail" />
                                            <span class="btn btn-primary ms-1" onclick="searchMessage();">Search</span>
                                            <i class="bi bi-arrow-clockwise ms-3 fs-3" onclick="reset();"></i>
                                        </span>
                                    </div>

                                    <div id="msgSpan" class="col-12 mt-4">

                                    </div>
                                </div>
                                <!--  -->
                                <!--  -->

                                <!--  -->
                                <!--  -->
                                <div class="d-flex flex-column justify-content-center align-items-start col-12 mt-5">
                                    <div class="d-flex flex-column justify-content-center align-items-start ms-5">
                                        <span class="fw-bold">Search Booking</span>
                                        <span class="ms-5 mt-3 d-flex">
                                            <input type="text" class="form-control" placeholder="Reference No" id="refNo" />
                                            <span class="btn btn-primary ms-1" onclick="searchBooking();">Search</span>
                                            <i class="bi bi-arrow-clockwise ms-3 fs-3" onclick="resetBooking();"></i>
                                        </span>
                                    </div>

                                    <div id="refSpan" class="col-12 mt-4">

                                    </div>
                                </div>
                                <!--  -->
                            </div>
                            <!--  -->

                            <div class="d-flex ms-5">
                                <p class="fw-bold" style="margin-top: 4%; margin-bottom: 0%; z-index: 5;"><?php echo $hotel_data["name"]; ?> Performance</p>
                                <div class="col-md-2 ms-4" style="margin-top: 3.5%; margin-bottom: 0%; z-index: 5;">
                                    <?php
                                    $available_year_rs = Database::search("SELECT * FROM `summary_year`");
                                    if ($available_year_rs->num_rows > 0) {

                                    ?>
                                        <select class="form-select" id="selectYear" required onchange="loadChardData();">
                                            <?php

                                            $this_year = date("Y");

                                            for ($x = 0; $x < $available_year_rs->num_rows; $x++) {
                                                $available_year_data = $available_year_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $available_year_data["summary_year"]; ?>" <?php
                                                                                                                    if ($this_year == $available_year_data["summary_year"]) {
                                                                                                                    ?> selected <?php
                                                                                                                            }
                                                                                                                                ?>><?php echo $available_year_data["summary_year"]; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="d-flex justify-content-evenly">

                                <!-- chart -->
                                <div id="curve_chart" style="width: 900px; height: 500px; margin-left: -10%; z-index: 1;"></div>

                                <?php

                                $msg_rs = Database::search("SELECT * FROM `user_contact` WHERE `user_contact`.`status_status_id`='2' ORDER BY `send_date_time` DESC");
                                if ($msg_rs->num_rows > 0) {

                                ?>
                                    <!-- mesage -->
                                    <div style="margin-top: 5%; margin-left: -11%; z-index: 2;" onclick="window.location.href='message.php';">
                                        <div class="bg-white border border-2 border-dark p-4 rounded-3">

                                            <p class="fs-4 d-flex justify-content-between fw-bold mb-4 msg">New Messages <span><i class="bi bi-three-dots text-primary"></i></span></p>
                                            <div class="ui relaxed divided list mt-5 dashboardMessage">

                                                <?php

                                                for ($x = 0; $x < $msg_rs->num_rows; $x++) {
                                                    $msg_data = $msg_rs->fetch_assoc();

                                                ?>
                                                    <div class="item d-flex">
                                                        <img src="../designImages/du.png" width="28" height="28" alt="">
                                                        <div class="content ms-3">
                                                            <a class="fw-bold text-black"><?php echo $msg_data["name"]; ?></a>
                                                            <div style="font-size: 12px;"><?php echo $msg_data["send_date_time"]; ?></div>
                                                        </div>
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

                            <p class="fw-bold ms-5" style="margin-top: 4%; margin-bottom: 0%; z-index: 5;"><?php echo $hotel_data["name"]; ?> Performance At :&nbsp;&nbsp;&nbsp; <span class="fw-normal"><?php echo $monthName . " / " . $this_year; ?></span></p>

                            <div class="d-flex justify-content-evenly mt-5 pt-4">

                                <?php

                                $this_year_month = date("Y-m");

                                $this_month_offer_rs = Database::search("SELECT COUNT(*) AS `tcount` FROM `offers` WHERE `offers`.`start_date_time` LIKE '" . $this_year_month . "%'");
                                $this_month_offer_data = $this_month_offer_rs->fetch_assoc();


                                $last_month = date("Y-m", strtotime("last month"));

                                $last_month_offer_rs = Database::search("SELECT COUNT(*) AS `lcount` FROM `offers` WHERE `offers`.`start_date_time` LIKE '" . $last_month . "%'");
                                $last_month_offer_data = $last_month_offer_rs->fetch_assoc();

                                if ($last_month_offer_data["lcount"] == 0) {
                                    $offer_percentage_change = 0;
                                } else {
                                    $offer_percentage_change = ($this_month_offer_data["tcount"] - $last_month_offer_data["lcount"]) / $last_month_offer_data["lcount"] * 100;
                                }


                                ?>

                                <div class="bg-black rounded text-white p-4" style="width: 20%;">
                                    <p class="fw-bold fs-5">This Month Offers</p>
                                    <p class="fs-3 pt-4"><?php echo $this_month_offer_data["tcount"]; ?></p>
                                    <p style="margin-top: -5%; font-size: 13px;"><?php
                                                                                    if ($offer_percentage_change > 0) {
                                                                                    ?>
                                            <i class="bi bi-graph-up-arrow me-3 fs-5"></i>Up to <?php echo $offer_percentage_change; ?>% from last month
                                    </p>
                                <?php
                                                                                    } else if ($offer_percentage_change < 0) {
                                ?>
                                    <i class="bi bi-graph-down-arrow me-3 fs-5"></i>Down to <?php echo $offer_percentage_change; ?>% from last month</p>
                                <?php
                                                                                    } else if ($offer_percentage_change == 0) {
                                ?>
                                    same as the last month
                                <?php
                                                                                    }
                                ?>
                                </div>

                                <?php


                                $this_month_meal_rs = Database::search("SELECT COUNT(*) AS `mtcount` FROM `dining` WHERE `dining`.`added_date_time` LIKE '" . $this_year_month . "%'");
                                $this_month_meal_data = $this_month_meal_rs->fetch_assoc();


                                $last_month_meal_rs = Database::search("SELECT COUNT(*) AS `mlcount` FROM `dining` WHERE `dining`.`added_date_time` LIKE '" . $last_month . "%'");
                                $last_month_meal_data = $last_month_meal_rs->fetch_assoc();

                                if ($last_month_meal_data["mlcount"] == 0) {
                                    $meal_percentage_change = 0;
                                } else {
                                    $meal_percentage_change = ($this_month_meal_data["mtcount"] - $last_month_meal_data["mlcount"]) / $last_month_meal_data["mlcount"] * 100;
                                }


                                ?>

                                <div class="bg-black rounded text-white p-4" style="width: 20%;">
                                    <p class="fw-bold fs-5">Total Meals</p>
                                    <p class="fs-3 pt-4"><?php echo $this_month_meal_data["mtcount"]; ?></p>
                                    <p style="margin-top: -5%; font-size: 13px;"><?php
                                                                                    if ($meal_percentage_change > 0) {
                                                                                    ?>
                                            <i class="bi bi-graph-up-arrow me-3 fs-5"></i>Up to <?php echo $meal_percentage_change; ?>% from last month
                                    </p>
                                <?php
                                                                                    } else if ($meal_percentage_change < 0) {
                                ?>
                                    <i class="bi bi-graph-down-arrow me-3 fs-5"></i>Down to <?php echo $meal_percentage_change; ?>% from last month</p>
                                <?php
                                                                                    } else if ($meal_percentage_change == 0) {
                                ?>
                                    same as the last month
                                <?php
                                                                                    }
                                ?> </p>
                                </div>

                                <?php


                                $this_month_booking_rs = Database::search("SELECT COUNT(*) AS `btcount` FROM `registered_guest` WHERE `registered_guest`.`registered_date_time` LIKE '" . $this_year_month . "%'");
                                $this_month_booking_data = $this_month_booking_rs->fetch_assoc();


                                $last_month_booking_rs = Database::search("SELECT COUNT(*) AS `blcount` FROM `registered_guest` WHERE `registered_guest`.`registered_date_time` LIKE '" . $last_month . "%'");
                                $last_month_booking_data = $last_month_booking_rs->fetch_assoc();

                                if ($last_month_booking_data["blcount"] == 0) {
                                    $booking_percentage_change = 0;
                                } else {
                                    $booking_percentage_change = ($this_month_booking_data["btcount"] - $last_month_booking_data["blcount"]) / $last_month_booking_data["blcount"] * 100;
                                }


                                ?>

                                <div class="bg-black rounded text-white p-4" style="width: 20%;">
                                    <p class="fw-bold fs-5">Total Bookings</p>
                                    <p class="fs-3 pt-4"><?php echo $this_month_booking_data["btcount"]; ?></p>
                                    <p style="margin-top: -5%; font-size: 13px;"><?php
                                                                                    if ($booking_percentage_change > 0) {
                                                                                    ?>
                                            <i class="bi bi-graph-up-arrow me-3 fs-5"></i>Up to <?php echo $booking_percentage_change; ?>% from last month
                                    </p>
                                <?php
                                                                                    } else if ($booking_percentage_change < 0) {
                                ?>
                                    <i class="bi bi-graph-down-arrow me-3 fs-5"></i>Down to <?php echo $booking_percentage_change; ?>% from last month</p>
                                <?php
                                                                                    } else if ($booking_percentage_change == 0) {
                                ?>
                                    same as the last month
                                <?php
                                                                                    }
                                ?></p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>

        <!-- notification -->
        <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 20;">
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

        <script>
            var como = new bootstrap.Modal(document.getElementById("comoid"));
            como.show();
        </script>
        <script src="../js/other/dashboard.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location:index.php");
}
?>