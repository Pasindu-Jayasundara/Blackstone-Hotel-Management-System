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
                                <label for="validationCustom01" class="form-label">Start Date Time</label>
                                <input type="datetime-local" class="form-control" id="ofSdt" value="" required />
                            </div>
                            <div class="col-md-4">
                                <label for="validationCustom02" class="form-label">End Date Time</label>
                                <input type="datetime-local" class="form-control" id="ofedt" value="" required />
                            </div>
                        </form>
                    </div>
                    <div style="width: 300px; height:200px;" class="col-3 position-relative d-flex justify-content-center align-items-center">
                        <div class="position-absolute top-0 start-0 end-0 bottom-0 d-flex justify-content-center align-items-center" style="background-color: rgba(0, 0, 0, 0.597);">
                            <label for="ofimg" id="imglabel" class="btn fw-bold fs-6 text-white" style="background-color: rgba(0, 0, 0, 0.597);">Add Image</label>
                            <input type="file" class="visually-hidden" id="ofimg" onchange="ofimgloadtmp();" />
                        </div>
                        <img src="" class="d-none" id="ofimgtag" style="width: 300px; height:200px; background-size: cover;">
                    </div>

                    <div class="col-5">
                        <label for="">Description</label>
                        <textarea class="px-4 py-4" style="resize: none;" id="ofinsertText" cols="110" rows="6"></textarea>
                        <button class="btn btn-success col-4 d-grid mt-3" onclick="of_add_new();">Add</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="row" id="manageOfferDiv">

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

    <script src="../js/other/update_offers.js"></script>
</body>

</html>