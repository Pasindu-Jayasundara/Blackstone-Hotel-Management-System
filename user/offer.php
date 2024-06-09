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
    <title>Home | <?php echo $hotel_data["name"]; ?></title>
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css" />
    <link rel="stylesheet" href="../css/other/home.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
    <link rel="icon" href="<?php echo $hotel_data["black_logo_url"]; ?>" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="../css/other/loadAnimation.css" />
</head>

<body>

    <?php include "../user/loading.php"; ?>

    <div class="container-fluid  min-vh-100 d-none" id="mainContent">

        <div class="col-12">
            <div class="row">

                <?php include "../user/header.php"; ?>

                <div class="start-animation" style="z-index: 1;"></div>

                <div class="row row-cols-1 row-cols-md-4 g-4 ps-5" style="gap: 15px; min-height: 85vh;" id="con">

                    <?php

                    $offer_rs = Database::search("SELECT * FROM `offers` INNER JOIN `offer_image` ON `offers`.`offers_id`=`offer_image`.`offers_offers_id` 
                    WHERE `offers`.`status_status_id`='1' AND `offer_image`.`status_status_id`='1' ");
                    if ($offer_rs->num_rows > 0) {

                        for ($x = 0; $x < $offer_rs->num_rows; $x++) {

                            $offer_data = $offer_rs->fetch_assoc();

                    ?>
                            <div class="col" style="width: 23.28vw;">
                                <div class="card mb-3" style="max-width: 540px;">
                                    <div class="row g-0">

                                        <div class="col-md-12 position-relative">
                                            <img src="../designImages/offertag.png" style="z-index: 2; margin-top: -36%; margin-left: -36%; object-fit: cover; width: 100vw; height: 50vh;" class="img-fluid rounded-start position-absolute" alt="...">
                                            <div class="d-none d-lg-flex position-absolute img-fluid" style="z-index: 1; margin-top: 2%; margin-left: -10%; object-fit: cover; width: 8vw; border-radius: 15px; height: 5vh; background-color: white; transform: rotate(-40deg);"></div>
                                            <div class="d-flex d-md-none position-absolute img-fluid" style="z-index: 1; margin-top: 3%; margin-left: -11%; object-fit: cover; width: 35vw; border-radius: 15px; height: 5vh; background-color: white; transform: rotate(-40deg);"></div>
                                            <div class="d-none d-md-flex d-lg-none position-absolute img-fluid" style="z-index: 1; margin-top: 3.5%; margin-left: -11%; object-fit: cover; width:10vw; border-radius: 15px; height: 5vh; background-color: white; transform: rotate(-40deg);"></div>
                                            <img src="<?php echo $offer_data["url"]; ?>" style="object-fit: cover; width: 100vw; height: 50vh; background-size: cover;" class="img-fluid rounded-start" alt="...">
                                            <div class="col-md-8">
                                                <div class="card-body position-absolute top-0" style="right: 0; left: 40%; bottom: 0; background-color: hsla(0, 4%, 11%, 0.655);">
                                                    <p class="card-text text-white text-center"><?php echo $offer_data["description"]; ?></p>
                                                    <span class="d-flex flex-column justify-content-start mt-4">
                                                        <span class="card-text text-warning">From :<small class="text-info">&nbsp;&nbsp;&nbsp;<?php echo date("Y-m-d", strtotime($offer_data["start_date_time"])); ?></small></span>
                                                        <span class="card-text text-warning">To :<small class="text-info">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date("Y-m-d", strtotime($offer_data["end_date_time"])); ?></small></span>
                                                    </span>
                                                    <div class="d-flex justify-content-center mt-5">
                                                        <span class="btn btn-primary">Book Now</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                    <?php

                        }
                    }

                    ?>

                </div>

                <?php include "../user/footer.php"; ?>

            </div>
        </div>

    </div>

    <script src="../js/other/loading.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <script async src="../js/other/offer.js"></script>
    <script async src="../js/other/loadAnimation.js"></script>

    <script src="../js/bootstrap/bootstrap.bundle.js"></script>
</body>

</html>