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

                    <div style="width: 300px; height:200px;" class="col-3 position-relative d-flex justify-content-center align-items-center">
                        <div class="position-absolute top-0 start-0 end-0 bottom-0 d-flex justify-content-center align-items-center" style="background-color: rgba(0, 0, 0, 0.597);">
                            <label for="expimg" id="expimglabel" class="btn fw-bold fs-6 text-white" style="background-color: rgba(0, 0, 0, 0.597);">Add Image</label>
                            <input type="file" class="visually-hidden" id="expimg" onchange="expimgloadtmp();" />
                        </div>
                        <img src="" class="d-none" id="expimgtag" style="width: 300px; height:200px; background-size: cover;">
                    </div>

                    <div class="col-5">
                        <div class="col-md-10">
                            <label for="validationCustom01" class="form-label">Place Name</label>
                            <input type="text" class="form-control" id="expname" value="" required />
                        </div>
                        <label for="validationCustom02" class="form-label mt-3">Description</label>
                        <textarea class="px-4 py-4" style="resize: none;" id="expinsertText" cols="110" rows="6"></textarea>
                        <button class="btn btn-success col-4 d-grid mt-3" onclick="exp_add_new();">Add</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="row" id="manageExplorationDiv">

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

    <script src="../js/other/update_exploration.js"></script>
</body>

</html>