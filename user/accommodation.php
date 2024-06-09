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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Accommodation | <?php echo $hotel_data["name"]; ?></title>

    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../css/other/accommodation.css" />
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css" />

    <link rel="icon" href="<?php echo $hotel_data["black_logo_url"]; ?>" />

</head>

<body class="body">

    <?php include "../user/loading.php"; ?>

    <span class="d-none" id="mainContent">
        
        <?php include "../user/header.php"; ?>

        <div class="row d-none d-lg-block">
            <div class="col-12 d-none d-lg-block ">
                <div>
                    <img src="../designImages/interior-design-simple-style-bed.png" style="width: 100vw; height: 80vh;" alt="" srcset="">
                </div>

                <div class="centered text-center">
                    <div class="mt-3" style="color: black; text-shadow: -5px -1px 0 white, 1px -1px 0 white, -1px 1px 0 white, 1px 1px 0 white;">Book Your Stay</div>
                    <div><button type="button" class="btn btn-dark btn-lg" style="background-color: #002E3D;" onclick="window.location.href='../user/contact_us.php';">BOOK NOW</button></div>
                </div>
            </div>
        </div>

        <!-- <div class="col-12 Border" style="top: -50;"></div> -->

        <div class="row col-12 justify-content-center mt-4">

            <?php

            $package_rs = Database::search("SELECT * FROM `accommodation` WHERE `accommodation_id` AND `status_status_id`='1'");
            $package_num = $package_rs->num_rows;

            for ($z = 0; $z < $package_num; $z++) {
                $package_data = $package_rs->fetch_assoc();

            ?>

                <div class="card text-center mx-3" style="width: 17rem;">
                    <?php

                    $image_rs = Database::search("SELECT * FROM `accommodation_image` WHERE `accommodation_accommodation_id`='" . $package_data["accommodation_id"] . "'");
                    $image_data = $image_rs->fetch_assoc();

                    ?>
                    <img src="<?php echo $image_data["url"]; ?>" class="mt-2 img-thumb" alt="Images">
                    <div class="card-body">
                        <div class="card-footer" style="background-color: #B55C5C;">
                            <a class="text-decoration-none fw-bold text-dark fs-5"><?php echo $package_data["name"]; ?></a>
                        </div>
                        <div class="heart"></div>


                        <div class="text-center text-danger"><?php echo $package_data["size"]; ?></div>
                        <div class="mb-3"><?php echo $package_data["description"]; ?></div>

                        <div class="card-footer" style="background-color: #000000;">
                            <button class="text-decoration-none fw-bold text-white booknow_btn fs-5" onclick="document.getElementById('id01').style.display='block'" id="modal-btn">Book Now</button>
                        </div>
                    </div>

                </div>

            <?php

            }

            ?>

            <!-- The Modal -->
            <div id="id01" class="modal">
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>

                <!-- Modal Content -->
                <form class="modal-content animate" action="submit_form.php" method="post">

                    <div class="mx-3 mt-3 mb-3 row ">
                        <form class="row g-3">
                            <div class="col-md-6">
                                <label for="inputfname" class="form-label">First Name</label>
                                <input type="text" class="form-control" name="fname" required>
                            </div>
                            <div class="col-md-6">
                                <label for="inputlname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="lname" required>
                            </div>
                            <div class="col-md-6">
                                <label for="inputmobile" class="form-label">Mobile Number</label>
                                <input type="number" class="form-control" name="mobile" required>
                            </div>
                            <div class="col-md-6">
                                <label for="inputmobile" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>

                            <div class="col-md-6">
                                <label for="inputroomType" class="form-label">Select Room Type</label>
                                <select class="form-select fs-4" name="type" aria-label="Default select example" required>
                                    <option value="0">Select Room Type</option>
                                    <?php

                                    $package_rs = Database::search("SELECT * FROM `accommodation` WHERE `accommodation_id` AND 
                                `status_status_id`='1'");
                                    $package_num = $package_rs->num_rows;

                                    for ($z = 0; $z < $package_num; $z++) {
                                        $package_data = $package_rs->fetch_assoc();

                                    ?>

                                        <option value="<?php echo $package_data["accommodation_id"]; ?>"><?php echo $package_data["name"]; ?></option>

                                    <?php
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="col-md-12 mt-3">
                                <button type="submit" class="btn btn-primary">Send Request</button>
                            </div>
                        </form>
                    </div>

                    <div class="text-center">
                        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn btn btn-danger">Cancel</button>
                    </div>
                </form>
            </div>

        </div>

        <?php include "../user/footer.php"; ?>

    </span>

    <script src="../js/other/loading.js"></script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- Custom JS -->
    <script src="../js/other/accommodation.js"></script>

</body>

</html>