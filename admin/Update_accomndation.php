<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>


    <div class="container-fluid">
        <div class="row mb-5">
            <p class="mb-4 fw-bold">Add New</p>
            <div class="col-12" style="margin-left: 7%;">
                <div class="row">

                    <div class="mb-4" style="margin-left: -1%;">
                        <form class="row g-3 needs-validation" novalidate>
                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" value="" required />
                            </div>
                            <div class="col-md-4">
                                <label for="validationCustom02" class="form-label">Size</label>
                                <input type="text" class="form-control" id="size" value="" required />
                            </div>
                            <div class="col-md-3">
                                <label for="validationCustom04" class="form-label">Select Package</label>
                                <select class="form-select" id="package" required>
                                    <option value="0">Select ...</option>
                                    <?php

                                    $r_rs = Database::search("SELECT * FROM `accommodation_package` WHERE `accommodation_package`.`status_status_id`='1'");
                                    for ($i = 0; $i < $r_rs->num_rows; $i++) {
                                        $r_data = $r_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $r_data["accommodation_package_id"]; ?>"><?php echo $r_data["package_name"]; ?></option>
                                    <?php
                                    }

                                    ?>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div style="width: 300px; height:200px;" class="col-3 position-relative d-flex justify-content-center align-items-center">
                        <div class="position-absolute top-0 start-0 end-0 bottom-0 d-flex justify-content-center align-items-center" style="background-color: rgba(0, 0, 0, 0.597);">
                            <label for="img" id="imglabel" class="btn fw-bold fs-6 text-white" style="background-color: rgba(0, 0, 0, 0.597);">Add Image</label>
                            <input type="file" class="visually-hidden" id="img" onchange="accimgloadtmp();" />
                        </div>
                        <img src="" class="d-none" id="imgtag" style="width: 300px; height:200px; background-size: cover;">
                    </div>

                    <div class="col-5">
                        <label for="" class="mt-3">Description</label>
                        <textarea class="px-4 py-4" style="resize: none;" id="insertText" cols="110" rows="6"></textarea>
                        <span class="btn btn-success col-4 d-grid mt-3" onclick="add_new();">Add</span>
                    </div>

                </div>
            </div>
        </div>
        <div class="row" id="manageAccommodationDiv">
            
        </div>
    </div>

    <script src="../js/other/update_accommodation.js"></script>
</body>

</html>