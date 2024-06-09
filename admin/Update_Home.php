<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>


    <div class="container-fluid">
        <div class="row mb-1">

            <div class="col-12" style="margin-left: 7%;">
                <div class="row">

                    <?php


                    $r_rs = Database::search("SELECT * FROM `hotel` WHERE `hotel_id` = '1' ");
                    $r_data = $r_rs->fetch_assoc();

                    ?>

                    <div class="mb-4" style="margin-left: -9%;">
                        <form class="row g-3 needs-validation" novalidate>
                            <div class="col-md-11">
                                <label for="validationCustom01" class="form-label fw-bold">Update Text</label>
                                <input type="text" class="form-control ms-3" id="welcomeText" value="<?php echo $r_data["welcome_text"] ?>" required />
                                <label class="btn btn-success mt-3 ms-3" onclick="ChangeHomeText('<?php echo $r_data['hotel_id'] ?>');">Upload Text</label>
                            </div>
                        </form>
                    </div>

                    <label for="validationCustom01" class="form-label fw-bold mt-5" style="margin-left: -9%;">Update Video</label>
                    <video class="mt-5" width="320" height="240" controls style="margin-left: -9%;">
                        <source src="<?php echo $r_data["video_link"] ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>

                    <label class="btn btn-success mt-2" style="margin-left: -9%;" for="Video">Change Video</label>
                    <input type="file" class="visually-hidden" id="Video" onchange="changeViedo();" accept="video/mp4">

                </div>
            </div>
        </div>
    </div>

    <script src="../js/other/update.js"></script>
</body>

</html>