`<?php

    require "../connection/connection.php";

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
    <title>Admin Log in | <?php echo $hotel_data["name"]; ?></title>

    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css" />

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
    <link rel="icon" href="<?php echo $hotel_data["black_logo_url"]; ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

</head>

<body style="overflow-y: hidden; max-height: 100vh;">
    <div class="container-fluid">
        <div class="row">

            <?php require_once "../admin/loading.php" ?>

            <div class="col-12 d-none" id="mainContent">
                <div class="row d-flex flex-row vh-100 overflow-hidden">

                    <!-- images -->
                    <div class="col-6" style="z-index: 2;">
                        <div class="row d-flex flex-column justify-content-between " style="overflow-y: hidden;">

                            <!-- logo -->
                            <div class="col-12">
                                <div class="row">

                                    <img src="<?php echo $hotel_data["black_logo_url"]; ?>" style="width:20vw;" />

                                </div>
                            </div>

                            <!-- img -->
                            <div class="col-12">
                                <div class="row">

                                    <img src="../designImages/adminLoginIllustrator.png" style="width: 85%; margin-top: -1%;" />

                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- form -->
                    <div class="col-6 animate__animated animate__fadeIn" style="z-index: 2;">
                        <div class="row d-flex flex-column justify-content-start ps-5">

                            <div class="col-8 mb-4" style="margin-top: 20%;">
                                <p class="fw-bold text-center" style="font-size: 30px;">Welcome To Admin Login</p>
                            </div>
                            <div class="col-8 mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" />
                            </div>
                            <div class="col-8">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" />
                            </div>
                            <div class="d-flex justify-content-between mt-3 mb-5 col-8">
                                <span style="cursor: pointer;" onclick="showPassword();">Show Password</span>
                                <span style="cursor: pointer;" onclick="forgotPasswordModel();">Forgot Password</span>
                            </div>
                            <div class="d-flex justify-content-center col-8" style="z-index: 2;">
                                <span class="btn btn-dark col-8 d-grid" onclick="signIn();">Sign In</span>
                            </div>

                        </div>
                    </div>

                    <svg id="wave" style="z-index: 1; transform:rotate(0deg); transition: 0.3s; margin-top: -40%; padding: 0; z-index: 1;" viewBox="0 0 1440 490" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0">
                                <stop stop-color="rgba(189.281, 203.075, 250.816, 1)" offset="0%"></stop>
                                <stop stop-color="rgba(255, 255, 255, 0)" offset="100%"></stop>
                            </linearGradient>
                        </defs>
                        <path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)" d="M0,441L60,375.7C120,310,240,180,360,179.7C480,180,600,310,720,367.5C840,425,960,408,1080,351.2C1200,294,1320,196,1440,138.8C1560,82,1680,65,1800,106.2C1920,147,2040,245,2160,269.5C2280,294,2400,245,2520,196C2640,147,2760,98,2880,65.3C3000,33,3120,16,3240,81.7C3360,147,3480,294,3600,351.2C3720,408,3840,376,3960,351.2C4080,327,4200,310,4320,310.3C4440,310,4560,327,4680,351.2C4800,376,4920,408,5040,424.7C5160,441,5280,441,5400,400.2C5520,359,5640,278,5760,261.3C5880,245,6000,294,6120,277.7C6240,261,6360,180,6480,187.8C6600,196,6720,294,6840,343C6960,392,7080,392,7200,359.3C7320,327,7440,261,7560,196C7680,131,7800,65,7920,32.7C8040,0,8160,0,8280,65.3C8400,131,8520,261,8580,326.7L8640,392L8640,490L8580,490C8520,490,8400,490,8280,490C8160,490,8040,490,7920,490C7800,490,7680,490,7560,490C7440,490,7320,490,7200,490C7080,490,6960,490,6840,490C6720,490,6600,490,6480,490C6360,490,6240,490,6120,490C6000,490,5880,490,5760,490C5640,490,5520,490,5400,490C5280,490,5160,490,5040,490C4920,490,4800,490,4680,490C4560,490,4440,490,4320,490C4200,490,4080,490,3960,490C3840,490,3720,490,3600,490C3480,490,3360,490,3240,490C3120,490,3000,490,2880,490C2760,490,2640,490,2520,490C2400,490,2280,490,2160,490C2040,490,1920,490,1800,490C1680,490,1560,490,1440,490C1320,490,1200,490,1080,490C960,490,840,490,720,490C600,490,480,490,360,490C240,490,120,490,60,490L0,490Z"></path>
                    </svg>

                </div>

            </div>



            <!-- deactive warning modal -->
            <div class="modal fade" id="deactive" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content bg-dark">
                        <div class="modal-body d-flex flex-column justify-content-center align-items-center">
                            <i class="bi bi-exclamation-triangle text-warning" style="font-size: 60px;"></i>
                            <p class="text-warning mt-4 fs-4">Your Account Have Been De-Activated</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- mobile modal -->
            <!-- <div class="modal fade" id="mobileModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-warning">
                            <h1 class="modal-title fs-5 text-white" id="staticBackdropLabel">Complete Profile Setup</h1>
                        </div>
                        <div class="modal-body bg-black">

                            <form class="row g-3">

                                <div class="col-12">
                                    <label for="inputAddress" class="form-label text-white">Mobile Number</label>
                                    <input type="tel" class="form-control bg-dark text-white" id="inputLine1" placeholder="070000000000">
                                </div>

                            </form>

                        </div>
                        <div class="modal-footer bg-black d-flex justify-content-center">
                            <span type="button" class="btn btn-success" onclick="updateAddress();">Complete</span>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- notification -->
            <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 50;">
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


        </div>

        <!-- warning modal -->
        <div class="modal fade" id="warning" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content bg-dark">
                    <div class="modal-body d-flex flex-column justify-content-center align-items-center">
                        <i class="bi bi-exclamation-triangle text-warning" style="font-size: 60px;"></i>
                        <p class="text-warning mt-4 fs-4">You Are Currently Logged In as a Admin</p>
                        <div class="col-10 gap-2 d-flex mt-5 justify-content-center">
                            <button type="button" class="btn btn-outline-success col-4 d-grid" data-bs-dismiss="modal" onclick="window.location.href='dashboard.php';">Stay Login</button>
                            <button type="button" class="btn btn-outline-danger col-4 d-grid" onclick="logOut();">Log Out</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- forgot passsword email Modal -->
        <div class="modal fade" id="forgotPasswordEmailModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content rounded-4 shadow">
                    <div class="modal-header p-5 pb-4 border-bottom-0">
                        <h1 class="fw-bold mb-0 fs-3 text-black">Current Email Address</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body p-5 pt-0">
                        <form class="">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control rounded-3" id="forgot_password_email" />
                                <label class="text-black">Your Email Address</label>
                            </div>
                            <span class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" onclick="verifyForgotPasswordEmail();">Verify</span>
                            <hr class="my-4">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- forgot passsword email verification Modal -->
        <div class="modal fade" id="forgotPasswordEmailVerificationModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content rounded-4 shadow">
                    <div class="modal-header p-5 pb-4 border-bottom-0">
                        <h1 class="fw-bold mb-0 fs-2 text-black">Verify Email Address</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body p-5 pt-0">
                        <form class="">
                            <small>Email code Will be sent to your email address</small>
                            <br />
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control rounded-3" id="forgotPasswordEmailVerificationCode" />
                                <label class="text-dark">Email Verification Code</label>
                            </div>
                            <span class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" onclick="forgotPasswordEmailVerfication();">Verify</span>
                            <hr class="my-4">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- new password Modal -->
        <div class="modal fade" id="newPasswordModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content rounded-4 shadow">
                    <div class="modal-header p-5 pb-4 border-bottom-0">
                        <h1 class="fw-bold mb-0 fs-2 text-black">Reset Password</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body p-5 pt-0">
                        <form class="">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control rounded-3" id="forgotPasswordNewPassword" />
                                <label class="text-dark">Enter Your New Password</label>
                            </div>
                            <span class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" onclick="updateForgotPassword();">Update Password</span>
                            <hr class="my-4">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- loading -->
        <div class="modal" tabindex="-1" id="comoid">
            <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down d-flex justify-content-center">
                <img src="../designImages/Spinner-1s-800px.gif" style="width: 150px; aspect-ratio: 1/1;" />
            </div>
        </div>

    </div>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <script src="../js/other/loading.js"></script>
    <script src="../js/bootstrap/bootstrap.bundle.js"></script>
    <script src="../js/other/signin.js"></script>
</body>

</html>