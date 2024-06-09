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
                <div class="row d-flex flex-row">

                    <div style="width: 300px; height:200px;" class="col-3 position-relative d-flex justify-content-center align-items-center">
                        <div class="position-absolute top-0 start-0 end-0 bottom-0 d-flex justify-content-center align-items-center" style="background-color: rgba(0, 0, 0, 0.597);">
                            <label for="diimg" id="diimglabel" class="btn fw-bold fs-6 text-white" style="background-color: rgba(0, 0, 0, 0.597);">Add Image</label>
                            <input type="file" class="visually-hidden" id="diimg" onchange="diimgloadtmp();" />
                        </div>
                        <img src="" class="d-none" id="diimgtag" style="width: 300px; height:200px; background-size: cover;">
                    </div>

                    <div class="mb-4 col-7" style="margin-left: -1%;">
                        <form class="row g-3 needs-validation ms-5" novalidate>
                            <span class="d-flex flex-row mb-3">
                                <div class="col-md-4">
                                    <label for="validationCustom01" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="diname" value="" required />
                                </div>
                                <div class="col-md-4 ms-5">
                                    <label for="validationCustom02" class="form-label">Type</label>
                                    <select class="form-select" id="ditype">
                                        <?php

                                        $ft_rs = Database::search("SELECT * FROM `dining_type` WHERE `dining_type`.`status_status_id`='1'");
                                        if ($ft_rs->num_rows > 0) {
                                        ?>
                                            <option value="0" selected>Choose ..</option>
                                            <?php
                                            for ($ft = 0; $ft < $ft_rs->num_rows; $ft++) {
                                                $ft_data = $ft_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $ft_data["dining_type_id"]; ?>"><?php echo $ft_data["dining_type"]; ?></option>
                                        <?php
                                            }
                                        }

                                        ?>
                                    </select>
                                </div>
                            </span>
                            <span class="d-flex flex-row mb-3">
                                <div class="col-md-4">
                                    <label for="validationCustom02" class="form-label">Category</label>
                                    <select class="form-select" id="dicategory">
                                        <?php

                                        $ft_rs = Database::search("SELECT * FROM `dining_category` WHERE `dining_category`.`status_status_id`='1'");
                                        if ($ft_rs->num_rows > 0) {
                                        ?>
                                            <option value="0" selected>Choose ..</option>
                                            <?php
                                            for ($ft = 0; $ft < $ft_rs->num_rows; $ft++) {
                                                $ft_data = $ft_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $ft_data["dining_category_id"]; ?>"><?php echo $ft_data["category"]; ?></option>
                                        <?php
                                            }
                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4 ms-5">
                                    <label for="validationCustom02" class="form-label">Price (Rs.)</label>
                                    <input type="number" min="1" class="form-control" id="diprize" value="" required />
                                </div>
                            </span>
                            <span class="btn btn-success d-grid mt-3 ms-2" style="width: 72%;" onclick="di_add_new();">Add</span>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="manageDiningDiv">

        </div>
    </div>

    <script src="../js/other/update_dining.js"></script>
</body>

</html>