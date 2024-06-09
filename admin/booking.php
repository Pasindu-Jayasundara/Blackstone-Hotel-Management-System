<?php
session_start();
require "../connection/connection.php";

if (!empty($_SESSION["admin"])) {

    $hotel_rs = Database::search("SELECT * FROM `hotel` INNER JOIN `hotel_mobile` ON `hotel_mobile`.`hotel_hotel_id`=`hotel`.`hotel_id` 
    INNER JOIN `hotel_address` ON `hotel`.`hotel_address_hotel_address_id`=`hotel_address`.`hotel_address_id` 
    WHERE `hotel`.`status_status_id`='1' AND `hotel_mobile`.`status_status_id`='1' AND `hotel_address`.`status_status_id`='1'");

    $hotel_data = $hotel_rs->fetch_assoc();

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $hotel_data["name"]; ?> | Admin - Booking</title>

        <link rel="stylesheet" href="../css/bootstrap/bootstrap.css" />
        <link rel="stylesheet" href="../css/sementic/semantic.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.5.0/components/icon.min.css" integrity="sha512-rTyypI20S663Wq9zrzMSOP1MNPHaYX7+ug5OZ/DTqCDLwRdErCo2W30Hdme3aUzJSvAUap3SmBk0r5j0vRxyGw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="icon" href="<?php echo $hotel_data["black_logo_url"]; ?>" />

    </head>

    <body>

        <div class="container-fluid d-flex ps-0">

            <?php include "sidebar.php"; ?>

            <div class="col-10 vh-100" style="overflow-y: scroll; overflow-x: hidden;">
                <div class="row">

                    <div class="col-12">

                        <!-- search booking -->
                        <div class="row d-flex justify-content-start align-items-center pt-4">
                            <!--  -->
                            <div class="d-flex flex-column justify-content-center align-items-start col-6">
                                <div class="d-flex flex-row justify-content-center align-items-center ms-5">
                                    <span class="fw-bold pt-3">Search Booking</span>
                                    <span class="mt-3 ms-3 d-flex">
                                        <input type="text" class="form-control" placeholder="Reference No" id="refNo" />
                                        <span class="btn btn-success ms-1" onclick="searchBooking();">Search</span>
                                        <span class="btn btn-dark ms-1" onclick="resetBooking2();">Reset</span>
                                    </span>
                                </div>
                            </div>
                            <!--  -->

                            <!-- room availiablity -->
                            <div class="row d-flex justify-content-start align-items-center col-6">
                                <!--  -->
                                <div class="d-flex flex-column justify-content-center align-items-end col-12">
                                    <div class="d-flex flex-row justify-content-center align-items-start ms-5">
                                        <span class="fw-bold pt-4">Room Availiablity</span>
                                        <span class="mt-3 ms-3 d-flex">
                                            <input type="datetime-local" class="form-control" id="dateIn" />
                                            <span class="btn btn-success ms-1" onclick="roomAvailiability();">Search</span>
                                            <span class="btn btn-dark ms-1" onclick="resetAvailibility();">Reset</span>
                                        </span>
                                    </div>
                                </div>
                                <!--  -->
                            </div>

                            <!-- booking display -->
                            <div id="refSpan" class="col-12 mt-4">
                            </div>

                            <!-- room awaliability -->
                            <div class="col-12 mt-4">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="col-8" id="roomAv">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr />

                        <!-- room assigning -->
                        <div class="row d-flex justify-content-start align-items-center pt-4 " id="roomAssigning">
                        </div>

                        <!-- booking time table -->
                        <div class="row d-flex justify-content-start align-items-center">

                            <div class="d-flex flex-column justify-content-center align-items-start col-6 mt-5 pe-2">
                                <div class="d-flex flex-column justify-content-center align-items-start ms-5">
                                    <span class="fw-bold">Today Scheduled Arrival</span>
                                </div>
                            </div>

                            <div class="d-flex flex-column justify-content-center align-items-start col-6 mt-5 ps-2">
                                <div class="d-flex flex-column justify-content-center align-items-start ms-5">
                                    <span class="fw-bold">Today Scheduled Departures</span>
                                </div>
                            </div>

                        </div>

                        <!-- timetable display -->
                        <div class="row d-flex justify-content-start align-items-start">
                            <div id="todayArrival" class="col-6 mt-4" style="overflow-x: scroll;">
                            </div>
                            <div id="todayDeparture" class="col-6 mt-4" style="overflow-x: scroll;">
                            </div>
                        </div>

                        <!-- book now -->
                        <div class="row d-flex justify-content-start align-items-center">

                            <div class="d-flex flex-column justify-content-center align-items-start col-12 mt-5">
                                <div class="d-flex flex-column justify-content-center align-items-start ms-5">
                                    <span class="fw-bold d-flex flex-row justify-content-start align-items-start">Book Now <i class="bi bi-arrow-clockwise ms-3 fs-5" onclick="restBookNow();"></i></span>
                                    <span class="ms-5 mt-3 d-flex gap-3">
                                        <span class="d-flex flex-column">
                                            <span class="text-nowrap">NIC</span>
                                            <input type="text" class="form-control" placeholder="NIC" id="bnnic" />
                                        </span>
                                        <span class="d-flex flex-column">
                                            <span class="text-nowrap">Name</span>
                                            <input type="text" class="form-control" placeholder="Name" id="bnname" />
                                        </span>
                                        <span class="d-flex flex-column">
                                            <span class="text-nowrap">Email</span>
                                            <input type="email" class="form-control" placeholder="Email Address" id="bnemail" />
                                        </span>
                                        <span class="d-flex flex-column">
                                            <span class="text-nowrap">Mobile</span>
                                            <input type="tel" class="form-control" placeholder="Contact" id="bnmobile" />
                                        </span>
                                        <span class="d-flex flex-column">
                                            <span class="text-nowrap">Room Type</span>

                                            <Select class="form-select" id="bnroomtype">
                                                <option value="0">Choose ...</option>
                                                <?php
                                                $rs = Database::search("SELECT * FROM `room_type` WHERE `status_status_id` ='1'");
                                                for ($i = 0; $i < $rs->num_rows; $i++) {
                                                    $data = $rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $data["room_type_id"]; ?>"><?php echo $data["room_type"]; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </Select>

                                        </span>
                                        <span class="d-flex flex-column">
                                            <span class="text-nowrap">Meal Plan</span>

                                            <Select class="form-select" id="bnmealplan">
                                                <option value="0">Choose ...</option>
                                                <?php
                                                $mrs = Database::search("SELECT * FROM `meal_plan` WHERE `status_status_id` ='1'");
                                                for ($x = 0; $x < $mrs->num_rows; $x++) {
                                                    $mdata = $mrs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $mdata["meal_plan_id"]; ?>"><?php echo $mdata["meal_plan"]; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </Select>

                                        </span>
                                    </span>

                                    <span class="ms-5 mt-3 d-flex gap-3 me-2">
                                        <span class="d-flex flex-column">
                                            <span class="text-nowrap">Arrival Date Time</span>
                                            <input type="datetime-local" class="form-control" placeholder="Arrival" value="<?php echo date('Y-m-d H:i:s'); ?>" id="bnarr" />
                                        </span>
                                        <span class="d-flex flex-column">
                                            <span class="text-nowrap">Departure Date</span>
                                            <input type="datetime-local" class="form-control" placeholder="Departure" id="bndep" />
                                        </span>
                                        <span class="d-flex justify-content-center align-items-end">
                                            <span class="btn btn-success ms-1" onclick="bookNow();">Book Now</span>
                                        </span>
                                    </span>
                                </div>
                            </div>

                        </div>


                        <!-- add new -->
                        <div class="row d-flex justify-content-start align-items-center mb-5">
                            <!--  -->
                            <div class="d-flex flex-column justify-content-center align-items-start col-12 mt-5">
                                <div class="d-flex flex-column justify-content-center align-items-start ms-5">
                                    <span class="fw-bold d-flex flex-row justify-content-start align-items-start">Send New Booking Form <i class="bi bi-arrow-clockwise ms-3 fs-5" onclick="resetBooking();"></i></span>
                                    <span class="ms-5 mt-3 d-flex gap-3">
                                        <span class="d-flex flex-column">
                                            <span class="text-nowrap">NIC</span>
                                            <input type="text" class="form-control" placeholder="NIC" id="nic" />
                                        </span>
                                        <span class="d-flex flex-column">
                                            <span class="text-nowrap">Name</span>
                                            <input type="text" class="form-control" placeholder="Name" id="name" />
                                        </span>
                                        <span class="d-flex flex-column">
                                            <span class="text-nowrap">Email</span>
                                            <input type="email" class="form-control" placeholder="Email Address" id="email" />
                                        </span>
                                        <span class="d-flex flex-column">
                                            <span class="text-nowrap">Arrival Date</span>
                                            <input type="date" class="form-control" placeholder="Arrival" id="arr" />
                                        </span>
                                        <span class="d-flex flex-column">
                                            <span class="text-nowrap">Departure Date</span>
                                            <input type="date" class="form-control" placeholder="Departure" id="de" />
                                        </span>
                                        <span class="d-flex justify-content-center align-items-end ms-1 mt-4">
                                            <span class="btn btn-success ms-1" onclick="sendForm();">Send Form</span>
                                        </span>
                                    </span>

                                </div>

                            </div>
                            <!--  -->
                        </div>


                    </div>


                </div>
            </div>

        </div>

        <!-- notification -->
        <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 7;">
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

        <script src="../js/other/booking.js"></script>
        <script src="../js/other/toast.js"></script>
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->


    </body>

    </html>

<?php
} else {
    header("Location:index.php");
}
?>