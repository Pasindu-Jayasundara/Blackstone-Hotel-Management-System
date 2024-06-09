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

            <div class="col-12 mt-5 text-center fs-1 fw-bold text-decoration-underline">
                <h1>Update Special Moments Page</h1>
            </div>
            <hr>
            <div class="col-12">
                <div class="row">

                    <?php
                    require "../connection/connection.php";
                    $rs = Database::search("SELECT * FROM `special_moment` INNER JOIN `special_moment_image` ON 
                    `special_moment_image`.`special_moment_special_moment_id` = `special_moment`.`special_moment_id` ");
                    $num = $rs->num_rows;

                    for ($x = 0; $x < $num; $x++) {
                        $data = $rs->fetch_assoc();
                    ?>
                        <div class="col-12">
                            <div class="row" style="background-color: grey;">
                                <div class="col-12">
                                    <hr>
                                </div>
                                <div class="col-3">
                                    <img src="<?php echo $data["url"] ?>" style="width: 300px;">
                                </div>

                                <div class="col-2 mt-5">
                                    <input type="file" class="visually-hidden" id="File" onchange="UpdateSpecialMomentImage('<?php echo $data['special_moment_id'] ?>');">
                                    <label for="File" class="btn btn-success fw-bold fs-4">Change Image</label>
                                </div>

                                <div class="col-5">
                                    <textarea name="" id="TextArea" cols="55" rows="7"></textarea>

                                </div>
                                <div class="col-1 d-grid">
                                    <button class="btn btn-dark" onclick="UplocadSpeceialMoment('<?php echo $data['special_moment_id'] ?>');">Upload</button>
                                    <button class="btn btn-danger" onclick="DeleteSpecialMoment('<?php echo $data['special_moment_id'] ?>');">Delete</button>
                                </div>
                                <hr>
                            </div>
                        </div>
                    <?php
                    }


                    ?>

                </div>
            </div>


            <div class="col-12 mt-5">
                <div class="row" style="background-color: #fffafa;">

                    <div class="col-12">
                        <hr>
                        <h1 class=" text-center"> ADD NEW SPECIAL MOMENTS </h1>
                    </div>

                    <div class="col-12 d-flex justify-content-center">
                        <img src="images/1622830_gallery_landskape_mountains_nature_photo_icon.png" id="AddImageTag">
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <input type="file" id="AddSpecialMomentImage" class="visually-hidden" onchange="changeAddImagePic();">
                        <label for="AddSpecialMomentImage" class="btn btn-outline-dark">Upload Image</label>

                    </div>


                    <div class="col-12 d-flex justify-content-center mt-3">
                        <textarea name="" id="SpecialMomentAddTextArea" cols="90" rows="10"></textarea>
                    </div>

                    <div class="col-12 d-flex justify-content-center m-3 ">
                        <label class="btn btn-outline-dark fs-1 fw-bold" onclick="AddNewSpecialMoment();">Upload New Special Moment</label>
                    </div>

                    <div class="col-12">
                        <hr>
                    </div>

                </div>
            </div>




        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>