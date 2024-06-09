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
        <title>Message | <?php echo $hotel_data["name"]; ?></title>

        <link rel="stylesheet" href="../css/bootstrap/bootstrap.css" />
        <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css" />
        <link rel="stylesheet" href="../css/sementic/semantic.css">
        <link rel="stylesheet" href="../css/other/message.css" />

        <link rel="icon" href="<?php echo $hotel_data["black_logo_url"]; ?>" />
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />


    </head>

    <body>

        <div class="container-fluid d-flex ps-0">

            <?php include "sidebar.php"; ?>

            <div class="col-10 vh-100" style="overflow-y: scroll; overflow-x: hidden;">
                <div class="row">
                    <!-- search user -->

                    <div class="accordion mt-4 mb-5" id="accordionExample">

                        <div class="d-flex justify-content-end">
                            <!--  -->
                            <div style="top: -5%; left:-19%;" class="offset-4 d-flex flex-column justify-content-center align-items-start col-12 mt-5 position-absolute">
                                <div class="d-flex flex-row justify-content-center align-items-center ms-5">
                                    <span class="fw-bold me-3">Search Message</span>
                                    <span class="mt-3 d-flex">
                                        <input type="email" class="form-control" placeholder="Sender Email Address" id="msgEmail" />
                                        <span class="btn btn-primary ms-1" onclick="searchMessage();">Search</span>
                                        <i class="bi bi-arrow-clockwise ms-3 fs-3" onclick="reset();"></i>
                                    </span>
                                </div>
                            </div>
                            <!--  -->
                            <div class="btn btn-primary me-3 col-2 d-block" data-bs-toggle="modal" data-bs-target="#newsletter">NewsLetter</div>
                        </div>

                        <div class="accordion-item">
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <!-- serch display -->
                            <div id="msgSpan" class="col-12 mt-4">
                                </div>
                                <div class="accordion-body d-flex ">
                                    <!-- msg display -->
                                    <div id="msgDisplay" class="accordion-body w-75 border-box border border-5 b1 d-flex flex-column justify-content-between">
                                    </div>

                                    <!-- all -->
                                    <div class="accordion-body w-25 b2">
                                        <div style="height: 90%;">

                                            <div class="ui relaxed divided list" id="msgList">
                                            </div>

                                        </div>
                                        <hr />
                                        <div class="d-flex gap-3 justify-content-center" style="margin-bottom: 50px;">
                                            <span class="btn btn-outline-primary col-5" id="newMsgBtn" onclick="newOld('1');">NEW</span>
                                            <span class="btn btn-dark col-5" id="allMsgBth" onclick="newOld('2');">ALL</span>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <!-- news letter -->
                <div class="modal fade" id="newsletter" tabindex="-1" aria-labelledby="newsletterModalLabel" data-bs-backdrop="static" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-flex justify-content-between align-items-baseline">
                                <h1 class="modal-title fs-5" id="newsletterModalLabel">New message</h1>
                                <p id="st" class="text-success d-none">Sending ...</p>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cb1"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                        <label class="col-form-label">Title:</label>
                                        <input type="text" class="form-control" id="title">
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Message:</label>
                                        <textarea class="form-control" id="message-text"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cb2">Close</button>
                                <button type="button" class="btn btn-primary" onclick="newsletter();" id="newssend">Send message</button>
                            </div>
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

            </div>

        </div>

        <script src="../js/other/message.js"></script>
    </body>

    </html>

<?php
} else {
    header("Location:index.php");
}
?>