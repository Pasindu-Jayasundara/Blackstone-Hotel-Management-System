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
    <title>Gallery | <?php echo $hotel_data["name"]; ?></title>

    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css" />
    <link rel="stylesheet" href="../css/other/gallery.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="icon" href="<?php echo $hotel_data["black_logo_url"]; ?>" />


    <link rel="stylesheet" href="../css/other/carousel.css" />
    <script src="../js/other/carousel.js"></script>
</head>

<body class="vw-100" style="overflow-x: hidden;">

    <?php include "../user/loading.php"; ?>

    <span id="mainContent" class="d-none">
        <div class="container-fluid min-vh-100" id="overflow">
            <div class="row">

                <?php include "../user/header.php"; ?>

                <div class="col-12" id="video">

                    <!-- wedding -->
                    <div id="wedding" class="row vh-100 d-flex justify-content-center align-items-center position-relative d-none" style=" z-index:-5; background-image:url(''); object-fit: cover; object-position: center; background-size: cover; background-repeat: no-repeat; background-position: center;">
                        <span style="top: 0; left: 0; right: 0; bottom: 0; background-color: black; position: absolute; opacity:.5; "></span>
                        <div class="position-absolute bg-black text-white fs-2 px-4 py-2" style="z-index: 5; font-family: 'Dancing Script', cursive; width:fit-content; top: 10%; left:0; border-top-right-radius: 30px; border-bottom-right-radius:30px;">Wedding</div>
                        <div class="w-75 h-50 weddingdivClass">

                            <!-- 1 -->
                            <div style="flex-grow: 1;" class="d-flex align-items-center">
                                <div class="w-100 h-50">
                                    <svg width="180%" height="100%" viewBox="0 0 750 600" preserveAspectRatio="xMidYMid slice">
                                        <defs>
                                            <clipPath id="shape3">
                                                <path d="M 200 200 L 350 200 L 400 300 L 350 400 L 200 400 L 150 300 Z" />
                                            </clipPath>
                                        </defs>

                                        <image id="img1" xlink:href="" width="100%" height="100%" clip-path="url(#shape3)" />
                                    </svg>
                                </div>
                            </div>

                            <!-- 2 -->
                            <div style="flex-grow: 1;" class="d-flex flex-column gap-4">
                                <div class="w-100 h-50 position-relative d-flex justify-content-center">
                                    <svg width="450%" height="150%" style="position:absolute; margin-left: 100%; margin-top: -28%;" viewBox="0 0 750 600" preserveAspectRatio="xMidYMid slice">
                                        <defs>
                                            <clipPath id="shape3">
                                                <path d="M 200 200 L 350 200 L 400 300 L 350 400 L 200 400 L 150 300 Z" />
                                            </clipPath>
                                        </defs>

                                        <image id="img2" xlink:href="" width="100%" height="100%" clip-path="url(#shape3)" />
                                    </svg>
                                </div>
                                <div class="w-100 h-50 position-relative d-flex justify-content-center">
                                    <svg width="450%" height="150%" style="position:absolute; margin-left: 100%; margin-top: -28%;" viewBox="0 0 750 600" preserveAspectRatio="xMidYMid slice">
                                        <defs>
                                            <clipPath id="shape3">
                                                <path d="M 200 200 L 350 200 L 400 300 L 350 400 L 200 400 L 150 300 Z" />
                                            </clipPath>
                                        </defs>

                                        <image id="img3" xlink:href="" width="100%" height="100%" clip-path="url(#shape3)" />
                                    </svg>
                                </div>
                            </div>

                            <!-- 3 -->
                            <div style="flex-grow: 2;" class="position-relative">
                                <svg width="300%" height="300%" style="position: absolute; margin-left: -23.5%; margin-top: -117.5%;" viewBox="0 0 750 600" preserveAspectRatio="xMidYMid slice">
                                    <defs>
                                        <clipPath id="shape3">
                                            <path d="M 200 200 L 350 200 L 400 300 L 350 400 L 200 400 L 150 300 Z" />
                                        </clipPath>
                                    </defs>

                                    <image id="img4" xlink:href="" width="100%" height="100%" clip-path="url(#shape3)" />
                                </svg>
                            </div>

                            <!-- 4 -->
                            <div style="flex-grow: 1;" class="d-flex flex-column gap-4">
                                <div class="w-100 h-50 position-relative d-flex justify-content-center">
                                    <svg width="450%" height="150%" style="position:absolute; margin-left: 285%; margin-top: -28%;" viewBox="0 0 750 600" preserveAspectRatio="xMidYMid slice">
                                        <defs>
                                            <clipPath id="shape3">
                                                <path d="M 200 200 L 350 200 L 400 300 L 350 400 L 200 400 L 150 300 Z" />
                                            </clipPath>
                                        </defs>

                                        <image id="img5" xlink:href="" width="100%" height="100%" clip-path="url(#shape3)" />
                                    </svg>
                                </div>
                                <div class="w-100 h-50 position-relative d-flex justify-content-center">
                                    <svg width="450%" height="150%" style="position:absolute; margin-left: 285%; margin-top: -28%;" viewBox="0 0 750 600" preserveAspectRatio="xMidYMid slice">
                                        <defs>
                                            <clipPath id="shape3">
                                                <path d="M 200 200 L 350 200 L 400 300 L 350 400 L 200 400 L 150 300 Z" />
                                            </clipPath>
                                        </defs>

                                        <image id="img6" xlink:href="" width="100%" height="100%" clip-path="url(#shape3)" />
                                    </svg>
                                </div>
                            </div>

                            <!-- 5 -->
                            <div style="flex-grow: 1;" class="d-flex align-items-center position-relative">
                                <div class="w-100 h-50">
                                    <svg width="450%" height="150%" style="position:absolute; margin-top:-118%; margin-left: -7%;" viewBox="0 0 750 600" preserveAspectRatio="xMidYMid slice">
                                        <defs>
                                            <clipPath id="shape3">
                                                <path d="M 200 200 L 350 200 L 400 300 L 350 400 L 200 400 L 150 300 Z" />
                                            </clipPath>
                                        </defs>

                                        <image id="img7" xlink:href="" width="100%" height="100%" clip-path="url(#shape3)" />
                                    </svg>
                                </div>
                            </div>

                        </div>


                        <!-- carousel -->
                        <div class="weddingMedium">
                            <div id="wrapper_bu">
                                <div id="bu1">
                                    <img id="bu1Img" src="" style="width: 100%; height: 100%; object-fit: cover; object-position: center; background-repeat: no-repeat;" />
                                </div>
                                <div id="bu2">
                                    <img id="bu2Img" src="" style="width: 100%; height: 100%; object-fit: cover; object-position: center; background-repeat: no-repeat;" />
                                </div>
                                <div id="bu3">
                                    <img id="bu3Img" src="" style="width: 100%; height: 100%; object-fit: cover; object-position: center; background-repeat: no-repeat;" />
                                </div>
                                <div id="bu4">
                                    <img id="bu4Img" src="" style="width: 100%; height: 100%; object-fit: cover; object-position: center; background-repeat: no-repeat;" />
                                </div>
                                <div id="bu5">
                                    <img id="bu5Img" src="" style="width: 100%; height: 100%; object-fit: cover; object-position: center; background-repeat: no-repeat;" />
                                </div>
                                <div id="bu6">
                                    <img id="bu6Img" src="" style="width: 100%; height: 100%; object-fit: cover; object-position: center; background-repeat: no-repeat;" />
                                </div>
                                <div id="bu7">
                                    <img id="bu7Img" src="" style="width: 100%; height: 100%; object-fit: cover; object-position: center; background-repeat: no-repeat;" />
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- event -->
                    <div id="event" class="row vh-100 d-flex justify-content-center align-items-center position-relative d-none" style="background-image: url(''); object-fit: cover; object-position: center; background-size: cover; background-repeat: no-repeat; background-position: center;">
                        <div class="position-absolute bg-black text-white fs-2 px-4 py-2 ps-5" style="z-index: 5; font-family: 'Dancing Script', cursive; width:fit-content; min-width: 10%; top: 10%; right:0; border-top-left-radius: 30px; border-bottom-left-radius:30px;">Event</div>
                        <div class="w-75 mt-5 px-4 pt-3 pb-3" style="overflow: scroll; height: 85%; backdrop-filter: blur(17px) saturate(186%); -webkit-backdrop-filter: blur(17px) saturate(186%); background-color: rgba(0, 0, 0, 0.09); border-radius: 12px; border: 1px solid rgba(209, 213, 219, 0.3);">

                            <div class="row row-cols-1 row-cols-md-3 g-4">
                                <div class="col">
                                    <div class="card" style="max-width: 350px; max-height: 270px;">
                                        <img id="eImg1" src="" style="max-width: 350px; max-height: 270px; object-fit: cover; object-position: center;" class="card-img-top" alt="...">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card" style="max-width: 350px; max-height: 270px;">
                                        <img id="eImg2" src="" style="max-width: 350px; max-height: 270px; object-fit: cover; object-position: center;" class="card-img-top" alt="...">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card" style="max-width: 350px; max-height: 270px;">
                                        <img id="eImg3" src="" style="max-width: 350px; max-height: 270px; object-fit: cover; object-position: center;" class="card-img-top" alt="...">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card" style="max-width: 350px; max-height: 270px;">
                                        <img id="eImg4" src="" style="max-width: 350px; max-height: 270px; object-fit: cover; object-position: center;" class="card-img-top" alt="...">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card" style="max-width: 350px; max-height: 270px;">
                                        <img id="eImg5" src="" style="max-width: 350px; max-height: 270px; object-fit: cover; object-position: center;" class="card-img-top" alt="...">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card" style="max-width: 350px; max-height: 270px;">
                                        <img id="eImg6" src="" style="max-width: 350px; max-height: 270px; object-fit: cover; object-position: center;" class="card-img-top" alt="...">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- accommodation -->
                    <div id="accommodation" class="row vh-100 d-flex justify-content-center align-items-center position-relative d-none" style="background-image: url(''); object-fit: cover; object-position: center; background-size: cover; background-repeat: no-repeat; background-position: center;">
                        <span style="top: 0; left: 0; right: 0; bottom: 0; background-color: black; position: absolute; opacity:.5; "></span>
                        <div class="position-absolute bg-black text-white fs-2 px-4 py-2" style="z-index: 6; font-family: 'Dancing Script', cursive; width:fit-content; top: 10%; left:0; border-top-right-radius: 30px; border-bottom-right-radius:30px;">Accommodation</div>
                        <div class="w-75 h-50 d-flex flex-row gap-3 justify-content-center align-items-center" style="z-index: 5; overflow: scroll;">

                            <div class="d-flex flex-column justify-content-center align-items-center gap-3">
                                <img id="aImg1" src="" class="border border-dark border-5 rounded" style="width: 250px; height: 180px; object-fit: cover; object-position: center;" alt="">
                                <img id="aImg2" src="" class="border border-dark border-5 rounded" style="width: 250px; height: 180px; object-fit: cover; object-position: center;" alt="">
                            </div>

                            <div class="d-flex flex-column justify-content-center align-items-center gap-3">
                                <img id="aImg3" src="" class="border border-dark border-5 rounded" style="width: 250px; height: 180px; object-fit: cover; object-position: center;" alt="">
                                <img id="aImg4" src="" class="border border-dark border-5 rounded" style="width: 250px; height: 180px; object-fit: cover; object-position: center;" alt="">
                                <img id="aImg5" src="" class="border border-dark border-5 rounded" style="width: 250px; height: 180px; object-fit: cover; object-position: center;" alt="">
                            </div>

                            <div class="d-flex flex-column justify-content-center align-items-center gap-3">
                                <img id="aImg6" src="" class="border border-dark border-5 rounded" style="width: 250px; height: 180px; object-fit: cover; object-position: center;" alt="">
                                <img id="aImg7" src="" class="border border-dark border-5 rounded" style="width: 250px; height: 180px; object-fit: cover; object-position: center;" alt="">
                            </div>

                        </div>
                    </div>

                    <!-- dining -->
                    <div id="dining" class="row vh-100 d-flex justify-content-center align-items-center position-relative d-none" style="background-image: url(''); object-fit: cover; object-position: center; background-size: cover; background-repeat: no-repeat; background-position: center;">
                        <div class="position-absolute bg-black text-white fs-2 px-4 py-2 ps-5" style="z-index: 5; font-family: 'Dancing Script', cursive; width:fit-content; min-width: 10%; top: 10%; right:0; border-top-left-radius: 30px; border-bottom-left-radius:30px;">Dining</div>
                        <div class="mt-5 p-4 d-flex flex-column justify-content-center align-items-center gap-3" style="overflow: scroll; height: 85%; width:65%; backdrop-filter: blur(17px) saturate(186%); -webkit-backdrop-filter: blur(17px) saturate(186%); background-color: rgba(0, 0, 0, 0.09); border-radius: 12px; border: 1px solid rgba(209, 213, 219, 0.3);">

                            <div class="d-flex flex-row justify-content-center align-items-center gap-3" >
                                <img id="dImg1" src="" class="rounded" style="width: 300px; height: 180px; object-fit: cover; object-position: center;" alt="">
                                <img id="dImg2" src="" class="rounded" style="width: 300px; height: 180px; object-fit: cover; object-position: center;" alt="">
                                <img id="dImg3" src="" class="rounded" style="width: 300px; height: 180px; object-fit: cover; object-position: center;" alt="">
                            </div>

                            <div class="d-flex flex-row justify-content-center align-items-center gap-3">
                                <img id="dImg4" src="" class="rounded" style="width: 460px; height: 180px; object-fit: cover; object-position: center;" alt="">
                                <img id="dImg5" src="" class="rounded" style="width: 460px; height: 180px; object-fit: cover; object-position: center;" alt="">
                            </div>

                            <div class="d-flex flex-row justify-content-center align-items-center gap-3">
                                <img id="dImg6" src="" class="rounded" style="width: 300px; height: 180px; object-fit: cover; object-position: center;" alt="">
                                <img id="dImg7" src="" class="rounded" style="width: 300px; height: 180px; object-fit: cover; object-position: center;" alt="">
                                <img id="dImg8" src="" class="rounded" style="width: 300px; height: 180px; object-fit: cover; object-position: center;" alt="">
                            </div>

                        </div>
                    </div>

                    <!-- exploration -->
                    <div id="exploration" class="row vh-100 d-flex justify-content-center align-items-center position-relative d-none" style="background-image: url(''); object-fit: cover; object-position: center; background-size: cover; background-repeat: no-repeat; background-position: center;">
                        <div class="position-absolute bg-black text-white fs-2 px-4 py-2" style="font-family: 'Dancing Script', cursive; width:fit-content; top: 9%; left:0; border-top-right-radius: 30px; border-bottom-right-radius:30px;">Exploration</div>
                        <div class="mt-5 p-4 d-flex flex-column justify-content-center align-items-center gap-3" style="overflow: scroll; height: 70%; width:82%; backdrop-filter: blur(17px) saturate(186%); -webkit-backdrop-filter: blur(17px) saturate(186%); background-color: rgba(0, 0, 0, 0.09); border-radius: 12px; border: 1px solid rgba(209, 213, 219, 0.3);">

                            <div class="d-none d-lg-flex flex-row justify-content-center align-items-center gap-3">
                                <img id="eImg1" src="" class="rounded border border-5 border-dark" style="width: 290px; height: 210px; object-fit: cover; object-position: center;" alt="">
                                <img id="eImg2" src="" class="rounded border border-5 border-dark" style="width: 290px; height: 210px; object-fit: cover; object-position: center;" alt="">
                                <img id="eImg3" src="" class="rounded border border-5 border-dark" style="width: 290px; height: 210px; object-fit: cover; object-position: center;" alt="">
                                <img id="eImg4" src="" class="rounded border border-5 border-dark" style="width: 290px; height: 210px; object-fit: cover; object-position: center;" alt="">
                            </div>

                            <div class="d-none d-lg-flex flex-row justify-content-center align-items-center gap-3">
                                <img id="eImg5" src="" class="rounded border border-5 border-dark" style="width: 290px; height: 210px; object-fit: cover; object-position: center;" alt="">
                                <img id="eImg6" src="" class="rounded border border-5 border-dark" style="width: 290px; height: 210px; object-fit: cover; object-position: center;" alt="">
                                <img id="eImg7" src="" class="rounded border border-5 border-dark" style="width: 290px; height: 210px; object-fit: cover; object-position: center;" alt="">
                            </div>

                            <div class="d-flex d-lg-none flex-row justify-content-center align-items-center gap-3">
                                <img id="eImg1" src="" class="rounded border border-5 border-dark" style="width: 150px; height: 150px; object-fit: cover; object-position: center;" alt="">
                                <img id="eImg2" src="" class="rounded border border-5 border-dark" style="width: 150px; height: 150px; object-fit: cover; object-position: center;" alt="">
                                <img id="eImg3" src="" class="rounded border border-5 border-dark" style="width: 150px; height: 150px; object-fit: cover; object-position: center;" alt="">
                            </div>
                            <div class="d-flex d-lg-none flex-row justify-content-center align-items-center gap-3">
                                <img id="eImg1" src="" class="rounded border border-5 border-dark" style="width: 150px; height: 150px; object-fit: cover; object-position: center;" alt="">
                                <img id="eImg2" src="" class="rounded border border-5 border-dark" style="width: 150px; height: 150px; object-fit: cover; object-position: center;" alt="">
                                <img id="eImg3" src="" class="rounded border border-5 border-dark" style="width: 150px; height: 150px; object-fit: cover; object-position: center;" alt="">
                            </div>

                        </div>
                    </div>

                </div>

                <?php include "../user/footer.php"; ?>

            </div>
        </div>
    </span>

    <script src="../js/other/loading.js"></script>
    <script src="../js/other/gallery.js"></script>
    <script src="../js/bootstrap/bootstrap.bundle.min.js"></script>

</body>

</html>