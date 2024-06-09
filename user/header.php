<?php
// require "../connection/connection.php";

$hotel_rs = Database::search("SELECT * FROM `hotel` WHERE `hotel`.`status_status_id`='1'");
$hotel_data = $hotel_rs->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>header</title>
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/other/header.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="icon" href="../designImages/badgeWhite.png">

</head>

<body>
    <div class="container-fluid sticky-top" data-aos="fade-in" style="background-color:  #002E3D;" id="bgcolor">
        <div class="col-12">
            <div class="row">

                <header class="d-flex d-md-flex flex-md-wrap justify-content-md-center d-lg-flex flex-lg-wrap justify-content-lg-center py-3">

                    <!-- large screen md -->
                    <a href="../user/index.php" class="d-none d-md-flex d-lg-flex align-items-lg-center mb-lg-3 mb-lg-1 mb-md-1 me-lg-auto me-md-auto text-dark text-decoration-none blackStoneLogo">
                        <img src="<?php echo $hotel_data["logo_url"]; ?>" class="blackstoneImg" style="z-index: 1;" width="16%"  alt="">
                    </a>

                    <!-- large li -->
                    <ul class="nav nav-pills d-none d-md-flex">
                        <li class="nav-item">
                            <a href="../user/accommodation.php" class="nav-link text-white ">ACCOMMODATION</a>
                            <div class="currentPage d-none" id="page1"></div>
                        </li>
                        <li class="nav-item">
                            <a href="../user/dining.php" class="nav-link text-white">DINING</a>
                            <div class="currentPage d-none" id="page2"></div>
                        </li>
                        <li class="nav-item">
                            <a href="../user/wedding.php" class="nav-link text-white">WEDDINGS</a>
                            <div class="currentPage d-none" id="page3"></div>
                        </li>
                        <li class="nav-item">
                            <a href="../user/event.php" class="nav-link text-white">EVENTS</a>
                            <div class="currentPage d-none" id="page4"></div>
                        </li>
                        <li class="nav-item">
                            <a href="../user/offer.php" class="nav-link text-white">OFFERS</a>
                            <div class="currentPage d-none" id="page5"></div>
                        </li>
                        <li class="nav-item">
                            <a href="../user/gallery.php" class="nav-link text-white">GALLERY</a>
                            <div class="currentPage d-none" id="page6"></div>
                        </li>
                    </ul>

                    <!-- small -->
                    <a href="../user/index.php" class="d-flex d-md-none align-items-lg-center mb-lg-3 mb-lg-1 mb-md-1 me-lg-auto me-md-auto text-dark text-decoration-none bg-danger blackStoneLogo" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                        <img src="<?php echo $hotel_data["logo_url"]; ?>" style="position: absolute; margin-top: -5%;" width="25%" alt="">
                    </a>

                    <!-- small li -->
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                        <div class="pb-4 offcanvas-header bg-black border border-0 border-bottom border-1 border-warning">
                            <span class="offcanvas-title  blackStoneLogo pb-4" id="offcanvasExampleLabel">
                                <img src="<?php echo $hotel_data["logo_url"]; ?>" id="smalllogo" style="position: absolute; margin-top: -5%;" width="35%" alt="">
                            </span>
                            <button type="button" class="btn-close text-reset bg-secondary" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body bg-black">

                            <ul class="nav nav-pills d-block">
                                <li class="nav-item">
                                    <a href="../user/accommodation.php" class="nav-link text-white " style="font-size: 12px;">ACCOMMODATION</a>
                                    <div class="currentPage d-none" id="spage1"></div>
                                </li>
                                <li class="nav-item">
                                    <a href="../user/dining.php" class="nav-link text-white " style="font-size: 12px;">DINING</a>
                                    <div class="currentPage d-none" id="spage2"></div>
                                </li>
                                <li class="nav-item">
                                    <a href="../user/wedding.php" class="nav-link text-white " style="font-size: 12px;">WEDDINGS</a>
                                    <div class="currentPage d-none" id="spage3"></div>
                                </li>
                                <li class="nav-item">
                                    <a href="../user/event.php" class="nav-link text-white" style="font-size: 12px;">EVENTS</a>
                                    <div class="currentPage d-none" id="spage4"></div>
                                </li>
                                <li class="nav-item">
                                    <a href="../user/offer.php" class="nav-link text-white" style="font-size: 12px;">OFFERS</a>
                                    <div class="currentPage d-none" id="spage5"></div>
                                </li>
                                <li class="nav-item">
                                    <a href="../user/gallery.php" class="nav-link text-white" style="font-size: 12px;">GALLERY</a>
                                    <div class="currentPage d-none" id="spage6"></div>
                                </li>
                            </ul>

                        </div>
                    </div>

                </header>

            </div>
        </div>
    </div>

    <script src="../js/other/header.js"></script>
</body>

</html>