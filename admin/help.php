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
        <title><?php echo $hotel_data["name"]; ?> | Admin - Help</title>

        <link rel="stylesheet" href="../css/bootstrap/bootstrap.css" />
        <link rel="stylesheet" href="../css/sementic/semantic.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />

        <link rel="icon" href="<?php echo $hotel_data["black_logo_url"]; ?>" />

    </head>

    <body>

        <div class="container-fluid d-flex ps-0">

            <?php include "sidebar.php"; ?>

            <div class="col-10 vh-100 d-flex justify-content-center align-items-center" style="overflow-y: scroll; overflow-x: hidden;">
                <div class="row w-75 p-3" style="border-style: dashed; border-color: navy; border-width: 1px;">

                    <div class="row">

                        <div class="col-6 mt-4">
                            <p class="text-dark">To : <span class="ms-4 ps-2">gladiussoftwaresolutions@gmail.com</span></p>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-6 mt-4">
                            <div class="input-group mb-3 d-flex align-items-center">
                                <span>From : </span>
                                <input type="text" class="form-control ms-3" placeholder="From" id="from" value="<?php echo $hotel_data["email"]; ?>">
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-12 mt-2">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Topic" aria-label="Topic" aria-describedby="basic-addon1" id="topic">
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="input-group">
                            <textarea class="form-control" aria-label="With textarea" id="Text" rows="10"></textarea>
                        </div>

                    </div>

                    <div class="col-6 mt-3" style="margin-left: -16%;">

                        <div class="mt-2 text-center" >
                            <span class="btn btn-success text-center col-4"  onclick="HelpSendEmail();">send</span>
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

        <script src="../js/other/help.js"></script>
        <script src="../js/other/toast.js"></script>

    </body>

    </html>

<?php
} else {
    header("Location:index.php");
}
?>