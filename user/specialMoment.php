<?php

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
    <title>Special Moment | <?php echo $hotel_data["name"]; ?> </title>
    <link rel="stylesheet" href="../css/other/specialMoments.css">
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css">
    <link rel="icon" href="<?php echo $hotel_data["black_logo_url"]; ?>">

</head>

<body>


    <div class="container-fluid">
        <div class="row">

        <?php include "../user/header.php"; ?>

            <div class="col-12 d-flex justify-content-end mt-5">

                <div class="d-flex mb-5 c">
                    <div class="triangle mb-1"></div>
                    <h1 class="text-white text-end  pt-4 pb-4 py-4 name">Special Moments</h1>
                </div>

            </div>

            <div class="col-12">
                <div class="row">
                    <?php

                    $Des_rs = Database::search("SELECT * FROM `special_moment` INNER JOIN `special_moment_image` ON `special_moment_image`.`special_moment_special_moment_id` =  `special_moment`.`special_moment_id` 
                    WHERE `special_moment`.`status_status_id`='1' AND `special_moment_image`.`status_status_id`='1' ORDER BY RAND() LIMIT 6");
                    $des_num = $Des_rs->num_rows;
                    for ($x = 0; $x < $des_num; $x++) {

                        $des_data = $Des_rs->fetch_assoc();

                        $numberSide = $x % 2;
                        if ($numberSide == 0) {

                    ?>
                            <div class="col-12 mb-5">
                                <div class="d-flex flex-md-row flex-column justify-content-center">

                                    <div class="col-md-4 col-12 d-flex justify-content-center">
                                        <img src="<?php echo $des_data["url"]; ?>" class="SpecialMoments_Images">
                                    </div>

                                    <div class="col-md-8 col-12 text-wrap mt-3 d-flex justify-content-center">
                                        <label><?php echo $des_data["description"] ?></label>
                                    </div>

                                </div>
                            </div>

                        <?php

                        } else {
                        ?>
                        <div class="col-12 mb-5">
                                <div class="d-flex flex-md-row flex-column justify-content-center">

                                    <div class="col-md-8 col-12 text-wrap mt-3 d-none d-md-flex justify-content-center">
                                        <p><?php echo $des_data["description"] ?></p>
                                    </div>

                                    <div class="col-md-4 col-12 d-flex justify-content-center">
                                        <img src="<?php echo $des_data["url"] ?>" class="SpecialMoments_Images">
                                    </div>

                                    <div class="col-md-8 col-12 text-wrap mt-3 d-flex d-md-none justify-content-center">
                                        <p><?php echo $des_data["description"] ?></p>
                                    </div>

                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>

                </div>
            </div>

            <?php include "../user/footer.php"; ?>
        </div>
    </div>
</body>

</html>