<?php
session_start();
require "../connection/connection.php";

if (!empty($_SESSION["admin"])) {

    $hotel_rs = Database::search("SELECT * FROM `hotel` INNER JOIN `hotel_mobile` ON `hotel_mobile`.`hotel_hotel_id`=`hotel`.`hotel_id` 
    INNER JOIN `hotel_address` ON `hotel`.`hotel_address_hotel_address_id`=`hotel_address`.`hotel_address_id` 
    WHERE `hotel`.`status_status_id`='1' AND `hotel_mobile`.`status_status_id`='1' AND `hotel_address`.`status_status_id`='1'");

    $hotel_data = $hotel_rs->fetch_assoc();

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $hotel_data["name"]; ?> | Admin - Settings</title>

        <link rel="stylesheet" href="../css/bootstrap/bootstrap.css" />
        <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css" />
        <link rel="stylesheet" href="../css/other/sidebars.css" />
        <link rel="stylesheet" href="../css/sementic/semantic.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="../css/other/settings.css" />

        <link rel="icon" href="<?php echo $hotel_data["black_logo_url"]; ?>" />

    </head>

    <body>

        <div class="container-fluid d-flex ps-0">

            <?php include "sidebar.php"; ?>

            <div class="col-10 vh-100" style="overflow-y: scroll; overflow-x: hidden;">
                <div class="row">

                    <!-- update profile details -->
                    <div class="accordion mt-3" style="z-index: 5;" id="accordionExample5">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne5">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne5" aria-expanded="true" aria-controls="collapseOne5">
                                    Profile & Security Details
                                </button>
                            </h2>
                            <div id="collapseOne5" class="accordion-collapse" aria-labelledby="headingOne5" data-bs-parent="#accordionExample5">
                                <p class="ms-3 fw-bold mt-3">Profile Details</p>
                                <div class="accordion-body d-flex justify-content-center align-items-center">
                                    <?php
                                    $admin_img_rs = Database::search("SELECT * FROM `admin` WHERE `admin`.`status_status_id`='1' 
                                    AND `admin`.`admin_id`='" . $_SESSION["admin"]["admin_id"] . "'");

                                    if ($admin_img_rs->num_rows == 1) {
                                        $admin_img_data = $admin_img_rs->fetch_assoc();
                                        $admin_img_url = $admin_img_data["url"];
                                    } else {
                                        $admin_img_url = "../designImages/admin.png";
                                    }

                                    $admin_email_rs = Database::search("SELECT * FROM `admin` WHERE `admin`.`status_status_id`='1' 
                                    AND `admin`.`admin_id`='" . $_SESSION["admin"]["admin_id"] . "'");

                                    $admin_email_data = $admin_email_rs->fetch_assoc();



                                    $admin_mobile_rs = Database::search("SELECT * FROM `admin_mobile` WHERE `admin_mobile`.`status_status_id`='1' 
                                    AND `admin_mobile`.`admin_admin_id`='" . $_SESSION["admin"]["admin_id"] . "'");

                                    $admin_mobile_data = $admin_mobile_rs->fetch_assoc();

                                    ?>
                                    <div class="d-flex  align-items-center">
                                        <div id="pnewimg" class="border border-2 border-primary d-flex align-items-end justify-content-center" style="border-radius: 175px; width: 350px; aspect-ratio: 1/1; background-image: url('<?php echo $admin_img_url; ?>'); background-repeat: no-repeat; background-size: cover; background-position: center;">
                                            <label for="pimg" class="btn btn-primary text-white" style="margin-bottom: 30px;">Upload Profile Image</label>
                                            <input type="file" id="pimg" onchange="loadprofileimg();" hidden />
                                        </div>
                                        <div class="w-100 ms-5">
                                            <div class="gap-3">
                                                <div class="d-flex gap-4">
                                                    <div style="width:80%">
                                                        <label class="form-label">First Name</label>
                                                        <input type="text" class="form-control" id="fproname" value="<?php echo $_SESSION["admin"]["f_name"]; ?>" />
                                                    </div>
                                                    <div style="width:80%">
                                                        <label class="form-label">Last Name</label>
                                                        <input type="text" class="form-control" id="lproname" value="<?php echo $_SESSION["admin"]["l_name"]; ?>" />
                                                    </div>
                                                </div>
                                                <div class="d-flex gap-4 mt-3">
                                                    <div style="width:80%">
                                                        <label class="form-label">Email</label>
                                                        <input type="email" class="form-control" id="prneemail" value="<?php echo $admin_email_data["email"]; ?>" />
                                                    </div>
                                                    <div style="width:80%">
                                                        <label class="form-label">Mobile</label>
                                                        <input type="tel" class="form-control" id="pronemo" value="<?php echo $admin_mobile_data["mobile"]; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 d-flex justify-content-end">
                                                <span class="btn btn-warning" onclick="updateProfile();">Save Changes</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div id="collapseOne5" class="accordion-collapse" aria-labelledby="headingOne5" data-bs-parent="#accordionExample5">
                                <hr />
                                <p class="ms-3 fw-bold mt-3">Security Details</p>
                                <div class="accordion-body ">
                                    <div class="ms-4 d-flex flex-column">
                                        <p class="">Change Password</p>
                                        <div class="d-flex flex-row gap-3 col-10">
                                            <input type="password" placeholder="Old Password" class="form-control" id="oldPassword" />
                                            <input type="password" placeholder="New Password" class="form-control" id="newPassword" />
                                            <input type="password" placeholder="Re-Type New Password" class="form-control" id="reNewPassword" />
                                            <span class="btn btn-success d-grid" onclick="updatePassword();">Update</span>
                                        </div>
                                        <p class="mt-5">Forgot Password</p>
                                        <div class="col-2">
                                            <span class="btn btn-warning d-grid" onclick="verifyMe();">Verify Me</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>

        </div>

        <!-- notification -->
        <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 7;">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-secondary text-white" id="headerColor">

                    <strong class="me-auto">Message</strong>
                    <small id="time"></small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" id="msg">

                </div>
            </div>
        </div>

        <script src="../js/other/settings.js"></script>

    </body>

    </html>

<?php
} else {
    header("Location:index.php");
}
?>