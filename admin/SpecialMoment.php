<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Special Moment | BlackStone Hotel </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">

</head>

<body>


    <div class="container-fluid">
        <div class="row">

            <div class="col-12 d-flex justify-content-end mt-5">

                <div class="d-flex">

                    <div class="triangle mb-1">
                    </div>
                    <h1 class="text-white text-end  pt-4 pb-4 py-4" style="background-color: #031f53;">Special Moments</h1>
                </div>

            </div>



            <div class="col-12">
                <div class="row">
                    <?php
                   require "../connection/connection.php";

                    $Des_rs = Database::search("SELECT * FROM `special_moment` INNER JOIN `special_moment_image` ON `special_moment_image`.`special_moment_special_moment_id` =  `special_moment`.`special_moment_id` ");
                    $des_num = $Des_rs->num_rows;
                    for ($x = 0; $x < $des_num; $x++) {

                        $des_data = $Des_rs->fetch_assoc();

                        $numberSide = $x % 2;
                        if ($numberSide == 0) {

                    ?>
                            <div class="col-12 mb-5">
                                <div class="row">

                                    <div class="col-4">
                                        <img src="<?php echo $des_data["url"] ?>" class="SpecialMoments_Images">
                                    </div>

                                    <div class="col-8 text-wrap">
                                        <label><?php echo $des_data["description"] ?></label>
                                    </div>
                                </div>


                            </div>

                        <?php

                        } else {
                        ?>
                        <div class="col-12 mb-5">
                                <div class="row ">
                                

                                    <div class="col-8 mt-5">
                                        <p><?php echo $des_data["description"] ?></p>
                                    </div>

                                    <div class="col-4 d-flex justify-align-content-end">
                                        <img src="<?php echo $des_data["url"] ?>" class="SpecialMoments_Images">
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>


                </div>
            </div>

        </div>
    </div>
</body>

</html>