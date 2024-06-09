<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <div class="container-fluid">

        <!-- v & m -->
        <div class="row mb-5 d-flex flex-row">
            <?php
            $vm_rs = Database::search("SELECT * FROM `purpose` WHERE `purpose`.`status_status_id`='1'");
            if ($vm_rs->num_rows == 1) {
                $vm_data = $vm_rs->fetch_assoc();
            }
            ?>
            <span class="col-6">
                <p class="mb-4 fw-bold">Vission</p>
                <div class="col-12" style="margin-left: 7%;">
                    <div class="row" id="vission" contenteditable="true" style="padding: 5px; width: 85%; border-radius: 5px; border-color: skyblue; border-width: 1px; border-style: dashed;">
                        <?php
                        if ($vm_rs->num_rows == 1) {
                            echo $vm_data["vission"];
                        }
                        ?>
                    </div>
                </div>
                <span class="btn btn-success mt-2" style="margin-left: 5%;" onclick="updateVission();">Update</span>
            </span>
            <span class="col-6">
                <p class="mb-4 fw-bold">Mission</p>
                <div class="col-12" style="margin-left: 7%;">
                    <div class="row" id="mission" contenteditable="true" style="padding: 5px; width: 85%; border-radius: 5px; border-color: skyblue; border-width: 1px; border-style: dashed;">
                        <?php
                        if ($vm_rs->num_rows == 1) {
                            echo $vm_data["mission"];
                        }
                        ?>
                    </div>
                </div>
                <span class="btn btn-success mt-2" style="margin-left: 5%;" onclick="updateMission();">Update</span>
            </span>
        </div>
        <hr class="bg-danger" />

        <!-- growth -->
        <div class="row mb-5 mt-5">
            <?php
            $vm_rs = Database::search("SELECT * FROM `purpose` WHERE `purpose`.`status_status_id`='1'");
            if ($vm_rs->num_rows == 1) {
                $vm_data = $vm_rs->fetch_assoc();
            }
            ?>
            <span class="col-12">
                <p class="mb-4 fw-bold">Our Growth</p>
                <div class="col-12 d-flex flex-row" style="margin-left: 3.5%;">
                    <div class="row" id="growth" contenteditable="true" style="padding: 5px; width: 85%; border-radius: 5px; border-color: skyblue; border-width: 1px; border-style: dashed;">
                        <?php
                        $grt_rs = Database::search("SELECT * FROM `growth` WHERE `growth`.`status_status_id`='1'");
                        if ($grt_rs->num_rows == 1) {
                            $grt_data = $grt_rs->fetch_assoc();
                            echo $grt_data["description"];
                        }
                        ?>
                    </div>
                    <span class="btn btn-success" style="margin-left: 2.5%;" onclick="updateGrowth();">Update</span>
                </div>
            </span>

            <div class="col-4 mt-5">
                <label for="ngi" class="btn btn-warning">Add New Image</label>
                <input type="file" id="ngi" hidden onchange="newGrowthImage();"/>
            </div>

            <div class="row row-cols-1 row-cols-md-6 g-4" id="growthImageDiv">

            </div>
        </div>
        <hr class="bg-danger" />

        <!-- management -->
        <div class="row mb-5 mt-5">
            <p class="mb-4 fw-bold">Add New Management</p>
            <div class="col-12" style="margin-left: 7%;">
                <div class="row">

                    <div style="width: 300px; height:200px;" class="col-3 position-relative d-flex justify-content-center align-items-center">
                        <div class="position-absolute top-0 start-0 end-0 bottom-0 d-flex justify-content-center align-items-center" style="background-color: rgba(0, 0, 0, 0.597);">
                            <label for="grimg" id="grimglabel" class="btn fw-bold fs-6 text-white" style="background-color: rgba(0, 0, 0, 0.597);">Add Image</label>
                            <input type="file" class="visually-hidden" id="grimg" onchange="grimgloadtmp();" />
                        </div>
                        <img src="" class="d-none" id="grimgtag" style="width: 300px; height:200px; background-size: cover;">
                    </div>

                    <div class="col-5">
                        <div class="col-md-10">
                            <label for="validationCustom01" class="form-label">Name</label>
                            <input type="text" class="form-control" id="grname" required />
                            <label for="validationCustom01" class="form-label mt-3">Position</label>
                            <input type="text" class="form-control" id="grposition" required />
                        </div>

                        <button class="btn btn-success col-4 d-grid mt-3" onclick="gr_add_new();">Add</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="row" id="manageManagementDiv">

        </div>
    </div>

    <!-- notification -->
    <!-- <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 500;">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-secondary text-white" id="headerColor">

                <strong class="me-auto">Message</strong>
                <small id="time"></small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="msg">

            </div>
        </div>
    </div> -->

    <script src="../js/other/update_growth.js"></script>
</body>

</html>