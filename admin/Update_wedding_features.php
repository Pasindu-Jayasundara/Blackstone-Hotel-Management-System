<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>


    <div class="container-fluid">
        <div class="row mb-5">
            <div class="d-flex flex-row">
                <p class="mb-4 fw-bold">Add New</p>

                <span class="col-3 ms-3">
                    <select class="form-control" onchange="changetype();" id="type">
                        <option value="0" selected>Choose ...</option>
                        <option value="1">Wedding Hall</option>
                        <option value="2">Hall Features</option>
                        <option value="3">Food Menues</option>
                    </select>
                </span>
            </div>

            <div class="col-12" style="margin-left: 7%;">
                <div class="row">

                    <div id="weimgdiv" style="width: 300px; height:200px;" class="col-3 position-relative d-flex justify-content-center align-items-center">
                        <div class="position-absolute top-0 start-0 end-0 bottom-0 d-flex justify-content-center align-items-center" style="background-color: rgba(0, 0, 0, 0.597);">
                            <label id="weimglabel" class="btn fw-bold fs-6 text-white" style="background-color: rgba(0, 0, 0, 0.597);" onclick="showSelectImageModel();">Select Image</label>
                            <input type="file" class="visually-hidden" id="weimg" onchange="weimgloadtmp();" />
                        </div>

                        <!--  -->
                        <div class="modal" tabindex="-1" id="weddingHallModel">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Select Hall Images</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closebtn"></button>
                                    </div>
                                    <div class="modal-body d-flex flex-row justify-content-center align-items-center gap-3" id="hallimgbody">
                                        <div style="width: 150px; height:150px; border-width: 1px; border-color: indigo; border-style: dashed;" class="d-flex justify-content-center align-items-center">
                                            <label for="weimg1" id="weimglabel1" class="btn fw-bold fs-6 text-white position-absolute" style="background-color: rgba(0, 0, 0, 0.597);">Add Image</label>
                                            <input type="file" class="visually-hidden" id="weimg1" onchange="weimgloadtmp1();" />
                                            <img src="" class="d-none" id="weimgtag1" style="width: 150px; height:150px; background-size: cover;">
                                        </div>
                                        <div style="width: 150px; height:150px; border-width: 1px; border-color: indigo; border-style: dashed;" class="d-flex justify-content-center align-items-center">
                                            <label for="weimg2" id="weimglabel2" class="btn fw-bold fs-6 text-white position-absolute" style="background-color: rgba(0, 0, 0, 0.597);">Add Image</label>
                                            <input type="file" class="visually-hidden" id="weimg2" onchange="weimgloadtmp2();" />
                                            <img src="" class="d-none" id="weimgtag2" style="width: 150px; height:150px; background-size: cover;">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success" onclick="hallImageSelected();">Complete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  -->

                        <img src="" class="d-none" id="weimgtag" style="width: 300px; height:200px; background-size: cover;">
                    </div>

                    <div class="col-5">
                        <div class="col-md-10">
                            <label for="validationCustom01" class="form-label" id="nametag">Feature</label>
                            <input type="text" class="form-control" id="wename" value="" required />
                        </div>
                        <label for="validationCustom02" class="form-label mt-3" id="desc">Description</label>
                        <textarea class="px-4 py-4" style="resize: none;" id="weinsertText" cols="110" rows="6"></textarea>
                        <button class="btn btn-success col-4 d-grid mt-3" onclick="we_add_new();">Add</button>
                    </div>

                </div>
            </div>
        </div>
        <hr class="bg-danger mt-3" />
        <div class="row mt-3">
            <div class="d-flex flex-row">
                <p class="mb-4 fw-bold">Manage</p>

                <span class="col-3 ms-3">
                    <select class="form-control" onchange="showtype();" id="show">
                        <option value="1" selected>Wedding Hall</option>
                        <option value="2">Hall Features</option>
                        <option value="3">Food Menues</option>
                    </select>
                </span>
            </div>

            <span id="manageWeddingDiv">

            </span>
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

    <script src="../js/other/update_wedding.js"></script>
</body>

</html>