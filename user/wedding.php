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
    <title>Weddings | <?php echo $hotel_data["name"]; ?></title>

    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/other/wedding.css" />
    <link rel="icon" href="<?php echo $hotel_data["black_logo_url"]; ?>" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="../css/other/loadAnimation.css" />

</head>

<body>

    <?php include "../user/loading.php"; ?>

    <span id="mainContent" class="d-none">
        <div class="container-fluid min-vh-100" id="overflow">
            <div class="row">

                <?php include "../user/header.php"; ?>

                <div class="start-animation" style="z-index: 1;"></div>

                <div class="col-12" id="video">
                    <div class="row">

                        <div class="col-12 col-lg-12 col-md-12 d-flex justify-content-center p-0">
                            <img src="../wedding_images/pic1.jpg" class="img1" id="img1" style="width: 100vw; height: 85vh; object-fit: cover;">
                        </div>
                        <div class="col-12 col-lg-12 col-md-12 mt-3 d-flex flex-md-row flex-column justify-content-between align-text-top">
                            <div>
                                <span style="font-family: GreatVibe; font-size: 50px;">Weddings</span><br />
                                <span class="ms-3 fs-6 d-none" style="font-family: Montserrat;" id="hallName"></span>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 col-md-6 d-flex flex-column justify-content-center align-items-end">
                                <!-- <span class="border border-1 border-dark py-1 px-2 mb-2 btn1">CHECK IN <i class="bi bi-calendar-fill"></i></span> -->
                                <span class="border border-1 border-dark py-1 px-2 btn1" onclick="window.location.href='../user/contact_us.php';">CONTACT US</span>
                            </div>
                        </div>

                        <!-- introduction -->
                        <div class="col-12 col-lg-12 col-md-12 mt-5 mb-5 d-none" style="padding-left: 8%;" id="introfDiv">
                            <div class="row ">

                                <div class="col-6 col-lg-6 col-md-6 d-flex position-relative" id="hallimg">
                                    <div style="z-index: 1;">
                                        <img src="" data-aos="fade-in" class="p1" id="introimg1" />
                                    </div>
                                    <div class="position-absolute" style="margin-left: 40%; margin-top: 20%; z-index: 2;">
                                        <img src="" data-aos="fade-in" class="p1" id="introimg2" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <p class="text-center fs-5 para1" style="margin-top: 12%;" id="introP" data-aos="fade-in"></p>
                                </div>

                            </div>
                        </div>

                        <!-- why us -->
                        <div class="col-12 col-lg-12 mb-5 " style="padding-left: 8%; margin-top: 6%;">
                            <div class="row">

                                <div class="col-12 col-lg-12 mt-5" style="margin-left: -7%;">
                                    <span class="fw-bold fs-3" data-aos="fade-in">WHY US...</span>
                                </div>


                                <ul class="ms-5 mt-5 fs-5 d-grid d-md-none">
                                    <li class="text-primary" id="scard1p" data-aos="fade-in"></li>
                                    <li class="text-primary" id="scard2p" data-aos="fade-in">g</li>
                                    <li class="text-primary" id="scard3p" data-aos="fade-in"></li>
                                    <li class="text-primary" id="scard4p" data-aos="fade-in"></li>
                                    <li class="text-primary" id="scard5p" data-aos="fade-in"></li>
                                    <li class="text-primary" id="scard6p" data-aos="fade-in"></li>
                                </ul>

                                <div class="col-12 col-lg-12 mt-5" id="cards">
                                    <div class="row position-relative d-flex align-items-center">

                                        <div style="position: relative;">
                                            <div class="whyus" style="width: 84vw;">
                                                <img id="whybgimg" src="" style="width: 84vw; height: 35vh; background-position: center; object-fit: cover;">
                                            </div>
                                        </div>

                                        <!-- cards -->
                                        <div id="whyc" class="row row-cols-1 g-4 row-cols-md-3 d-md-flex justify-content-between position-absolute" style="width: 84vw;height: 35vh; overflow-y: scroll; margin-left: 0.8%; margin-top: 1.5%;">

                                            <div id="whycfd" data-aos="fade-in" class="col d-flex justify-content-center align-items-center position-relative" style="width: 13vw; height: 25vh; background-color: rgba(0, 0, 0, 0.359)">
                                                <img src="../designImages/outlineFlower.png" style="width: 10vw; height: 15vh; background-position: center; object-fit: contain;">
                                                <p class="position-absolute fs-5  mt-2 text-white text-center" id="card1p"></p>
                                            </div>

                                            <div data-aos="fade-in" class="col d-flex justify-content-center align-items-center position-relative" style="width: 13vw; height: 25vh; background-color: rgba(0, 0, 0, 0.359);">
                                                <img src="../designImages/outlineFlower.png" style="width: 10vw; height: 15vh; background-position: center; object-fit: contain;">
                                                <p class="position-absolute fs-5  mt-2 text-white text-center" id="card2p"></p>
                                            </div>
                                            <div data-aos="fade-in" class="col d-flex justify-content-center align-items-center position-relative" style="width: 13vw; height: 25vh; background-color: rgba(0, 0, 0, 0.359);">
                                                <img src="../designImages/outlineFlower.png" style="width: 10vw; height: 15vh; background-position: center; object-fit: contain;">
                                                <p class="position-absolute fs-5  mt-2 text-white text-center" id="card3p"></p>
                                            </div>
                                            <div data-aos="fade-in" class="col d-flex justify-content-center align-items-center position-relative" style="width: 13vw; height: 25vh; background-color: rgba(0, 0, 0, 0.359);">
                                                <img src="../designImages/outlineFlower.png" style="width: 10vw; height: 15vh; background-position: center; object-fit: contain;">
                                                <p class="position-absolute fs-5  mt-2 text-white text-center" id="card4p"></p>
                                            </div>
                                            <div data-aos="fade-in" class="col d-flex justify-content-center align-items-center position-relative" style="width: 13vw; height: 25vh; background-color: rgba(0, 0, 0, 0.359);">
                                                <img src="../designImages/outlineFlower.png" style="width: 10vw; height: 15vh; background-position: center; object-fit: contain;">
                                                <p class="position-absolute fs-5  mt-2 text-white text-center" id="card5p"></p>
                                            </div>
                                            <div data-aos="fade-in" class="col d-flex justify-content-center align-items-center position-relative" style="width: 13vw; height: 25vh; background-color: rgba(0, 0, 0, 0.359);">
                                                <img src="../designImages/outlineFlower.png" style="width: 10vw; height: 15vh; background-position: center; object-fit: contain;">
                                                <p class="position-absolute fs-5  mt-2 text-white text-center" id="card6p"></p>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>


                        <!-- food menu -->
                        <div class="col-12 col-lg-12 mt-5">
                            <div class="row">
                                <div class="col-12 col-lg-12 ">
                                    <span class="fw-bold fs-3 ms-3" data-aos="fade-in" id="fmt">FOOD MENUS</span>
                                </div>

                                <div class="col-12 mt-3 ">
                                    <div class="row d-flex" id="food">

                                        <div class="col-12 col-lg-3">
                                            <p data-aos="fade-in" class="text-center fs-5 ms-5" id="foodtext" style="font-family: Lustria;"></p>
                                        </div>

                                        <div class="col-9 col-md-12 col-lg-9">
                                            <div id="foodcd" class="row g-4 d-flex flex-row justify-content-between align-items-center mx-5 px-5" style="width: 70vw;height: 36vh; overflow-x: scroll; margin-top: .04%;">

                                                <div data-aos="fade-in" class="col p-0 position-relative d-none" id="foodimgdiv">
                                                    <img src="" id="img" style="z-index: 1;width: 12vw; height: 30vh; background-position: center; object-fit: cover;" />
                                                    <p class="bg-black position-absolute text-center text-white" id="imgp" style="width: 14vw; margin-left: -6%; margin-top: -20%; z-index: 2;"></p>
                                                </div>

                                                <div data-aos="fade-in" class="col p-0 position-relative d-none " id="foodimgdiv2">
                                                    <img src="" id="img2" style="width: 12vw; height: 30vh; background-position: center; object-fit: cover;" />
                                                    <p class="bg-black position-absolute text-center text-white" id="imgp2" style="width: 14vw; margin-left: -6%; margin-top: -20%; z-index: 2;"></p>
                                                </div>

                                                <div data-aos="fade-in" class="col p-0 position-relative d-none" id="foodimgdiv3">
                                                    <img src="" id="img3" style="width: 12vw; height: 30vh; background-position: center; object-fit: cover;" />
                                                    <p class="bg-black position-absolute text-center text-white" id="imgp3" style="width: 14vw; margin-left: -6%; margin-top: -20%; z-index: 2;"></p>
                                                </div>

                                                <div data-aos="fade-in" class="col p-0 position-relative d-none" id="foodimgdiv4">
                                                    <img src="" id="img4" style="width: 12vw; height: 30vh; background-position: center; object-fit: cover;" />
                                                    <p class="bg-black position-absolute text-center text-white" id="imgp4" style="width: 14vw; margin-left: -6%; margin-top: -20%; z-index: 2;"></p>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- gallery -->
                        <div class="col-12 col-lg-12 mb-3" id="galeryContainer">
                            <div class="row">

                                <div class="col-12 col-lg-12 mt-5">
                                    <span class="fw-bold fs-3 ms-3" data-aos="fade-in">GALLERY</span>
                                </div>

                                <div class="col-12 d-none d-md-flex">
                                    <div class="row">

                                        <!-- first line -->
                                        <div class="col-12" style="padding-left: 1%;">
                                            <div class="row d-flex justify-content-center flex-row" style="padding-left: 6%; width:99vw">

                                                <div data-aos="fade-in" class="p-0" style="width: 350px; height: 350px;" id="galdiv1">
                                                    <svg width="180%" height="100%" style="margin-left: -50%;" viewBox="0 0 800 600" preserveAspectRatio="xMidYMid slice">
                                                        <defs>
                                                            <clipPath id="shape1">
                                                                <path d="M 400 450 C 300 450 300 350 200 350 L 200 200 C 300 200 300 100 400 100 C 500 100 500 200 600 200 L 600 350 C 500 350 500 450 400 450 " />
                                                            </clipPath>
                                                        </defs>

                                                        <image id="svgImgF1" xlink:href="" width="100%" height="100%" clip-path="url(#shape1)" />
                                                    </svg>
                                                </div>
                                                <div data-aos="fade-in" class="p-0" style="width: 350px; height: 350px;" id="galdiv2">
                                                    <svg width="180%" height="100%" style="margin-left: -58%;" viewBox="0 0 800 600" preserveAspectRatio="xMidYMid slice">
                                                        <defs>
                                                            <clipPath id="shape2">
                                                                <path d="M 400 450 C 300 450 300 350 200 350 L 200 200 C 300 200 300 100 400 100 C 500 100 500 200 600 200 L 600 350 C 500 350 500 450 400 450 " />
                                                            </clipPath>
                                                        </defs>

                                                        <image id="svgImgF2" xlink:href="" width="100%" height="100%" clip-path="url(#shape2)" />
                                                    </svg>
                                                </div>
                                                <div data-aos="fade-in" class="p-0" style="width: 350px; height: 350px;" id="galdiv3">
                                                    <svg width="180%" height="100%" style="margin-left: -66%;" viewBox="0 0 800 600" preserveAspectRatio="xMidYMid slice">
                                                        <defs>
                                                            <clipPath id="shape3">
                                                                <path d="M 400 450 C 300 450 300 350 200 350 L 200 200 C 300 200 300 100 400 100 C 500 100 500 200 600 200 L 600 350 C 500 350 500 450 400 450 " />
                                                            </clipPath>
                                                        </defs>

                                                        <image id="svgImgF3" xlink:href="" width="100%" height="100%" clip-path="url(#shape3)" />
                                                    </svg>
                                                </div>
                                                <div data-aos="fade-in" class="p-0 m-0 " style="width: 350px; height: 350px; " id="galdiv4">
                                                    <svg width="180%" height="100%" style="margin-left: -74%;" viewBox="0 0 800 600" preserveAspectRatio="xMidYMid slice">
                                                        <defs>
                                                            <clipPath id="shape4">
                                                                <path d="M 400 450 C 300 450 300 350 200 350 L 200 200 C 300 200 300 100 400 100 C 500 100 500 200 600 200 L 600 350 C 500 350 500 450 400 450 " />
                                                            </clipPath>
                                                        </defs>

                                                        <image id="svgImgF4" xlink:href="" width="100%" height="100%" clip-path="url(#shape4)" />
                                                    </svg>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- second line -->
                                        <div class="col-12" style="margin-top: -8.5%;">
                                            <div class="row d-flex justify-content-center flex-row" style="padding-left: 3.5%;" id="galscovediv">

                                                <div data-aos="fade-in" class="p-0" id="secsvgdiv1" style="width: 350px; height: 350px;">
                                                    <svg width="180%" height="100%" style="margin-left: -50%;" viewBox="0 0 800 600" preserveAspectRatio="xMidYMid slice">
                                                        <defs>
                                                            <clipPath id="shape5">
                                                                <path d="M 400 450 C 300 450 300 350 200 350 L 200 200 C 300 200 300 100 400 100 C 500 100 500 200 600 200 L 600 350 C 500 350 500 450 400 450 " />
                                                            </clipPath>
                                                        </defs>

                                                        <image id="svgImgS1" xlink:href="" width="100%" height="100%" clip-path="url(#shape5)" />
                                                    </svg>
                                                </div>
                                                <div data-aos="fade-in" class="p-0" id="secsvgdiv2" style="width: 350px; height: 350px;">
                                                    <svg width="180%" height="100%" style="margin-left: -58%;" viewBox="0 0 800 600" preserveAspectRatio="xMidYMid slice">
                                                        <defs>
                                                            <clipPath id="shape6">
                                                                <path d="M 400 450 C 300 450 300 350 200 350 L 200 200 C 300 200 300 100 400 100 C 500 100 500 200 600 200 L 600 350 C 500 350 500 450 400 450 " />
                                                            </clipPath>
                                                        </defs>

                                                        <image id="svgImgS2" xlink:href="" width="100%" height="100%" clip-path="url(#shape6)" />
                                                    </svg>
                                                </div>
                                                <div data-aos="fade-in" class="p-0" id="secsvgdiv3" style="width: 350px; height: 350px;">
                                                    <svg width="180%" height="100%" style="margin-left: -66%;" viewBox="0 0 800 600" preserveAspectRatio="xMidYMid slice">
                                                        <defs>
                                                            <clipPath id="shape7">
                                                                <path d="M 400 450 C 300 450 300 350 200 350 L 200 200 C 300 200 300 100 400 100 C 500 100 500 200 600 200 L 600 350 C 500 350 500 450 400 450 " />
                                                            </clipPath>
                                                        </defs>

                                                        <image id="svgImgS3" xlink:href="" width="100%" height="100%" clip-path="url(#shape7)" />
                                                    </svg>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <img src="" id="smallGallery" class="rounded d-block d-md-none" alt="...">

                            </div>
                        </div>

                    </div>
                </div>

                <?php include "../user/footer.php"; ?>

            </div>
        </div>
    </span>

    <script src="../js/other/loading.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="../js/other/wedding.js"></script>
    <script src="../js/other/loadAnimation.js"></script>
</body>

</html>