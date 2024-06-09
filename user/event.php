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
    <title>Events | <?php echo $hotel_data["name"]; ?></title>

    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css" />
    <link rel="stylesheet" href="../css/other/event.css" />
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
                        <div class="col-12 p-0">

                            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner" id="eventCarousel">
                                </div>
                            </div>

                        </div>
                        <div class="col-12 mt-5 d-flex justify-content-center align-items-center">
                            <span style="max-width: 600px;" id="eventDescriptions">
                            </span>
                        </div>
                        <span id="eventContent" class="mb-5">
                        </span>
                    </div>

                </div>

                <?php include "../user/footer.php"; ?>

            </div>
        </div>
    </span>

    <script src="../js/other/loading.js"></script>
    <script src="../js/other/event.js"></script>
    <script src="../js/bootstrap/bootstrap.bundle.js"></script>

</body>

</html>