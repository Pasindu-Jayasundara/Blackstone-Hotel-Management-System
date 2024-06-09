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
    <link rel="icon" href="<?php echo $hotel_data["black_logo_url"]; ?>" />

    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css" />
    <link rel="stylesheet" href="../css/other/home.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="../css/other/loadAnimation.css">
</head>

<body>

   <?php include "../user/loading.php" ?>

    <div class="container-fluid min-vh-100 d-none" id="mainContent">

        <div class="col-12">
            <div class="row">

                <?php include "../user/header.php"; ?>

                <div class="start-animation" style="z-index: 1;"></div>

                <!-- first part -->
                <div class="col-12" id="video">
                    <div class="row">

                        <!-- welcome video -->
                        <video muted autoplay loop class="video p-0 m-0">
                            <source src="<?php echo $hotel_data["video_link"]; ?>" />
                        </video>

                        <!-- info display -->
                        <div class="col-12 mt-5 position-absolute offerDisplay" id="infoDisplay">
                            <div class="row d-flex flex-row ">

                                <!-- book button -->
                                <div class="col-lg-8 col-md-6 d-flex align-items-end" id="bookNowBtnDiv">
                                    <div class="row">
                                        <div class="ms-md-5 mb-5">
                                            <div class="row ">
                                                <div data-aos="fade-in" id="bookNowBtn" class="btn text-white fs-3 fw-bold bookNowDiv d-flex  justify-content-center align-items-center" style="background-color: #002E3D;" onclick="window.location.href='../user/contact_us.php';">
                                                    BOOK NOW
                                                    <i class="bi bi-arrow-right text-white ms-3 d-none d-md-flex"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php


                                $offer_rs = Database::search("SELECT * FROM `offers` INNER JOIN `offer_image` ON `offers`.`offers_id`=`offer_image`.`offers_offers_id` 
                                WHERE `offers`.`status_status_id`='1' AND `offer_image`.`status_status_id`='1'");

                                if ($offer_rs->num_rows > 0) {

                                ?>

                                    <!-- offers -->
                                    <div class="col-lg-4 col-md-6 col-11" id="offercoursel">
                                        <div class="row ms-2 ms-md-0">
                                            <div class="col-12" style="z-index: 3;">
                                                <div class="row offertag position-relative" id="offertag2">
                                                    <img src="../designImages/offertag.png" style="z-index: 2; margin-top: -25%; margin-left: -33%;" id="offertag" />
                                                    <div class="d-none" id="whitebg" style="z-index: 1; margin-top:9%; margin-left: -3%; border-radius: 15px; position: absolute; width: 7vw; height:5vh; background: white; transform: rotate(-43deg);"></div>
                                                    <div class="d-none" id="whitebg3" style="z-index: 1; margin-top:2%; margin-left: -5%; border-radius: 15px; position: absolute; width: 12vw; height:4vh; background: white; transform: rotate(-43deg);"></div>
                                                    <div class="d-none" id="whitebg2" style="z-index: 1; margin-top:6%; margin-left: -2%; border-radius: 15px; position: absolute; width: 20vw; height:3vh; background: white; transform: rotate(-43deg);"></div>
                                                </div>
                                            </div>
                                            <div class="col-12" style="margin-top:-49%;" id="carousel">
                                                <div class="row">
                                                    <div id="carouselExampleControls" class="carousel slide pe-0" data-bs-ride="carousel">
                                                        <div class="carousel-inner" onclick="window.location.href='../user/offers.php';" id="offeractive">
                                                            <?php

                                                            for ($o = 0; $o < $offer_rs->num_rows; $o++) {
                                                                $offer_data = $offer_rs->fetch_assoc();

                                                            ?>

                                                                <div class="carousel-item">
                                                                    <div class="row ps-2 pe-2 pt-2" style="background-color: #002E3D;">
                                                                        <img src="<?php echo $offer_data["url"]; ?>" class="d-block img-fluid w-100 c1" />
                                                                    </div>
                                                                    <div class="row bg-black p-2">
                                                                        <p class="text-white" style="height: 14vh;"><?php echo $offer_data["description"]; ?></p>
                                                                    </div>
                                                                </div>

                                                            <?php

                                                            }

                                                            ?>
                                                        </div>
                                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Previous</span>
                                                        </button>
                                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Next</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                <?php

                                }

                                ?>

                            </div>
                        </div>

                    </div>
                </div>

                <!-- welcome -->
                <div class="col-12" data-aos="fade-in">
                    <div class="row bg-white">

                        <div class="col-12">
                            <div class="row d-flex flex-column justify-content-center">
                                <div class="p-5 d-flex justify-content-center bg-white">
                                    <p class="mt-2 bg-white fs-2 fw-bold" style="z-index: 2; padding-left: 10%; padding-right: 10%;">WELCOME TO <span style="color: #002E3D;"><?php echo $hotel_data["name"]; ?></span></p>
                                </div>
                                <span class="border border-1 border-dark col-12 d-grid" style="z-index: 1;margin-top: -6%;" id="line"></span>
                            </div>
                        </div>

                        <div class="col-12" style="margin-top: 5%;">
                            <div class="row text-center" id="welcometext">
                                <p><?php echo $hotel_data["welcome_text"]; ?></p>
                            </div>
                        </div>

                        <div class="col-12 my-5">
                            <div class="row d-flex justify-content-evenly">

                                <img src="" data-aos="zoom-in-left" style="width:25%;" class="rounded float-start d-none d-md-flex" id="wel1" alt="...">
                                <img src="" data-aos="zoom-in" style="width:25%;" class="rounded mx-auto d-block" id="middleImgWelcome">
                                <img src="" data-aos="zoom-in-right" style="width:25%;" class="rounded float-end  d-none d-md-flex" id="wel2" alt="...">

                            </div>
                        </div>
                    </div>
                </div>

                <!-- accommodation -->
                <div class="col-12 mt-5 pt-5" data-aos="fade-in">
                    <div class="row">

                        <div class="col-12 p-0">
                            <!-- <img id="accbg" src="" style="object-fit: cover; width:100vw;  height: 90vh;" /> -->
                            <img id="" src="../designImages/rm222batch2-mind-03.jpg" style="object-fit: cover; width:100vw;  height: 110vh;" />
                        </div>

                        <div class="position-absolute d-flex justify-content-center mt-5" data-aos="slide-up">
                            <p class="px-5 py-3 fs-1 fw-bold" style="border-radius: 6%; color: #002E3D;">ACCOMMODATION</p>
                        </div>
                        <div class="d-flex position-absolute px-5" style="margin-top: 22%;" id="imgAcc">
                            <img src="" data-aos="zoom-in-left" style="width:25%; height: 40vh;" class="rounded float-start shadowadd d-none d-md-flex" id="leftImg">
                            <img src="" data-aos="zoom-in" class="rounded mx-auto accommodationCenterImg" id="middleImgAcco">
                            <img src="" data-aos="zoom-in-right" style="width:25%; height: 40vh;" class="rounded float-end shadowadd d-none d-md-flex" id="rightImg">
                        </div>

                    </div>
                </div>

                <!-- exploration -->
                <div class="col-12" data-aos="fade-in">
                    <div class="row">

                        <div class="col-12 p-0">
                            <img src="" style="object-fit: cover; width:100vw; height: 88vh;" id="expbgimg">
                        </div>

                        <div class="position-absolute p-0 d-flex justify-content-start mt-5" data-aos="slide-right">
                            <p class="px-5 py-3 fs-3 text-white accommodation">EXPLORATION</p>
                        </div>
                        <div class="d-flex position-absolute p-0 align-items-center justify-content-end" style="margin-top: 20%;" id="explorationDiv">
                            <div style="width: 60vw; background-color:  #002e3d9c;" id="explorationpDiv" class="px-3 ps-5 py-4" data-aos="fade-in">
                                <p class="text-white" id="explorationP"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <?php include "../user/footer.php"; ?>

            </div>
        </div>

    </div>

    

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <script async src="../js/other/loading.js"></script>
    <script async src="../js/other/loadAnimation.js"></script>

    <script src="../js/bootstrap/bootstrap.bundle.js"></script>
    <script async src="../js/other/index.js"></script>

</body>

</html>