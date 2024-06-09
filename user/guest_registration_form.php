<?php

session_start();
require "../connection/connection.php";

$hotel_rs = Database::search("SELECT * FROM `hotel` WHERE `hotel`.`status_status_id`='1'");
$hotel_data = $hotel_rs->fetch_assoc();

$encryptionKey = "Pasindu328@Bhathiya";
$iv = "Pasindu328@Bhath";

$encryptedValue = $_GET["jobj"];
$decryptedData = openssl_decrypt($encryptedValue, 'AES-256-CBC', $encryptionKey, 0, $iv);

if ($decryptedData === false) {
    die('Something Went Wrong');
} else {
    $obj = json_decode($decryptedData);

    $email = $obj->email;
    $name = explode(" ", $obj->name);
    $nicStatus = $obj->nicStatus;
    if ($nicStatus == 1) {
        $nic = $obj->nic;
    }
    $arrStatus = $obj->arrStatus;
    if ($arrStatus == 1) {
        $arr = $obj->arr;
    }
    $deStatus = $obj->deStatus;
    if ($deStatus == 1) {
        $de = $obj->de;
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book Now | <?php echo $hotel_data["name"]; ?></title>

    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css" />
    <link rel="stylesheet" href="../css/other/guestRegistrationForm.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="icon" href="<?php echo $hotel_data["black_logo_url"]; ?>" />
</head>

<body>

    <?php include "../user/loading.php"; ?>

    <span id="mainContent" class="d-none">
        <div class="container-fluid min-vh-100" id="overflow">
            <div class="row">

                <?php include "../user/header.php"; ?>

                <div class="col-12" id="video">
                    <div class="row d-flex justify-content-center" style="background-image: url('../designImages/wallpaperflare.com_wallpaper.jpg'); object-position: center; object-fit: cover; background-repeat: repeat-y;background-size: cover;">

                        <div class="d-flex flex-row justify-content-center align-items-center">
                            <div class="b1 d-flex flex-row justify-content-center align-items-center">guest registration form</div>
                        </div>

                        <div class="col-12 mt-5 pt-5">
                            <div class="row">
                                <div class="d-flex flex-column flex-md-row justify-content-around align-items-md-center align-items-start py-2 glass">
                                    <div class="d-flex flex-1 flex-row justify-content-between align-items-center gap-4 fs-5">
                                        <span class="fw-bold date">Date :</span>
                                        <span class="date" aria-disabled="true"><?php echo date("Y-m-d"); ?></span>
                                    </div>
                                    <div class="d-flex flex-1 flex-row justify-content-between align-items-center gap-4 fs-5">
                                        <span class="fw-bold date">Room No :</span>
                                        <span class="date" aria-disabled="true">Processing ...</span>
                                    </div>
                                    <div class="d-flex flex-1 flex-row justify-content-between align-items-center gap-4 fs-5">
                                        <span class="fw-bold date">Reference No :</span>
                                        <span class="date" aria-disabled="true" id="refNo"><?php echo uniqid(); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-9 mt-4 mb-5 pb-5">
                            <div class="d-flex flex-column justify-content-center align-items-center py-5 gap-4 glass" style=" border-radius: 20px;">

                                <!-- 1 -->
                                <div class="d-flex flex-md-row flex-column justify-content-between align-items-center col-11">
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <span class="me-3 fw-bold surname">Surname :</span>
                                        <span class="d-flex flex-row position-relative surnameSelect">
                                            <select class="selctTag" id="surname">
                                                <option value="0">Choose</option>
                                                <?php
                                                $s_rs = Database::search("SELECT * FROM `surname` WHERE `surname`.`status_status_id`='1'");
                                                for ($s = 0; $s < $s_rs->num_rows; $s++) {
                                                    $s_data = $s_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $s_data["surname_id"]; ?>"><?php echo $s_data["surname"]; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <div class="downArrow d-flex justify-content-center align-items-center px-2 position-absolute">
                                                <i class="bi bi-chevron-down downicon fw-bold"></i>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <span class="me-3 fw-bold">First Name :</span>
                                        <span class="d-flex flex-row position-relative">
                                            <input type="text" class="input" value="<?php echo $name[0]; ?>" disabled  id="fname"/>
                                        </span>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <span class="me-3 fw-bold">Last Name :</span>
                                        <span class="d-flex flex-row position-relative">
                                            <input type="text" class="input" value="<?php echo end($name); ?>" disabled id="lname"/>
                                        </span>
                                    </div>
                                </div>

                                <!-- 2 -->
                                <div class="d-flex flex-md-row flex-column justify-content-between align-items-center col-11">
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <span class="me-3 fw-bold">Mobile :</span>
                                        <span class="d-flex flex-row position-relative ms-3">
                                            <input type="tel" class="input mobile" id="mobile"/>
                                        </span>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between align-items-center second">
                                        <span class="fw-bold nic text-nowrap">NIC :</span>
                                        <span class="d-flex flex-row position-relative" style="margin-right: -13%;">
                                            <input type="text" class="input secondSpan" value="<?php
                                                                                                if ($nicStatus == 1) {
                                                                                                    echo $nic;
                                                                                                }
                                                                                                ?>" <?php
                                                                                                    if ($nicStatus == 1) {
                                                                                                    ?> disabled <?php
                                                                                                            }
                                                                                                                ?>  id="nic"/>
                                        </span>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <span class="me-3 fw-bold pass">Passport :</span>
                                        <span class="d-flex flex-row position-relative">
                                            <input type="text" class="input" id="passport"/>
                                        </span>
                                    </div>
                                </div>

                                <!-- 3 -->
                                <div class="d-flex flex-md-row flex-column justify-content-start align-items-center col-11">
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <span class="me-3 fw-bold" style="width: 50px;">Email :</span>
                                        <span class="d-flex flex-row position-relative ms-4 ps-1">
                                            <input type="text" class="input" value="<?php echo $email; ?>" disabled id="email"/>
                                        </span>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <span class="me-3 fw-bold text-nowrap add">Address :</span>
                                        <span class="d-flex flex-row position-relative">
                                            <input type="text" class="input inputAddress" id="address"/>
                                        </span>
                                    </div>
                                </div>

                                <!-- 4 -->
                                <div class="d-flex flex-md-row flex-column justify-content-start align-items-center col-11">
                                    <div class="d-flex flex-md-row flex-column justify-content-between align-items-md-center align-items-start">
                                        <span class="me-3 fw-bold text-nowrap pa">Number Of Pax (Adults) :</span>
                                        <span class="d-flex flex-row position-relative pa">
                                            <input type="number" class="input" min="1" style="width: 273.25px;" id="nopa"/>
                                        </span>
                                    </div>
                                    <div class="d-flex flex-md-row flex-column justify-content-between align-items-md-center align-items-start">
                                        <span class="me-3 fw-bold ps-5 text-nowrap pc">Number Of Pax (Cild) :</span>
                                        <span class="d-flex flex-row position-relative pc2">
                                            <input type="number" class="input" min="0" style="width: 273.25px;" id="nopc"/>
                                        </span>
                                    </div>
                                </div>

                                <!-- 5 -->
                                <div class="d-flex flex-md-row flex-column justify-content-between align-items-md-center align-items-start col-11">
                                    <div class="d-flex flex-row justify-content-between align-items-md-center align-items-start">
                                        <span class="me-3 fw-bold text-nowrap">Country :</span>&nbsp;&nbsp;
                                        <span class="d-flex flex-row position-relative cou">
                                            <select class="selctTag" id="country">
                                                <option value="0">Choose</option>
                                                <?php
                                                $c_rs = Database::search("SELECT * FROM `country` WHERE `country`.`status_status_id`='1'");
                                                for ($c = 0; $c < $c_rs->num_rows; $c++) {
                                                    $c_data = $c_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $c_data["country_id"]; ?>"><?php echo $c_data["country"]; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <div class="downArrow d-flex justify-content-center align-items-center px-2 position-absolute">
                                                <i class="bi bi-chevron-down downicon fw-bold"></i>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between align-items-center na">
                                        <span class="me-3 fw-bold">Nationality :</span>
                                        <span class="d-flex flex-row position-relative" >
                                            <select class="selctTag" id="nationality">
                                                <option value="0">Choose</option>
                                                <?php
                                                $n_rs = Database::search("SELECT * FROM `nationality` WHERE `nationality`.`status_status_id`='1'");
                                                for ($n = 0; $n < $n_rs->num_rows; $n++) {
                                                    $n_data = $n_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $n_data["nationality_id"]; ?>"><?php echo $n_data["nationality"]; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <div class="downArrow d-flex justify-content-center align-items-center px-2 position-absolute">
                                                <i class="bi bi-chevron-down downicon fw-bold"></i>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between align-items-center na">
                                        <span class="me-3 fw-bold text-nowrap">Religion :</span>
                                        <span class="d-flex flex-row position-relative rel" >
                                            <select class="selctTag" id="religion">
                                                <option value="0">Choose</option>
                                                <?php
                                                $r_rs = Database::search("SELECT * FROM `religion` WHERE `religion`.`status_status_id`='1'");
                                                for ($r = 0; $r < $r_rs->num_rows; $r++) {
                                                    $r_data = $r_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $r_data["religion_id"]; ?>"><?php echo $r_data["religion"]; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <div class="downArrow d-flex justify-content-center align-items-center px-2 position-absolute">
                                                <i class="bi bi-chevron-down downicon fw-bold"></i>
                                            </div>
                                        </span>
                                    </div>
                                </div>

                                <!-- 6 -->
                                <div class="d-flex flex-md-row flex-column justify-content-start align-items-center col-9">
                                    <div class="d-flex flex-md-row flex-column justify-content-between align-items-md-center align-items-start ad">
                                        <span class="me-3 fw-bold text-nowrap">Arrival Date & Time :</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="d-flex flex-row position-relative di">
                                            <input type="date" class="input" value="<?php
                                                                                    if ($arrStatus == 1) {
                                                                                        echo date($arr);
                                                                                    }
                                                                                    ?>" <?php
                                                                                        if ($arrStatus == 1) {
                                                                                        ?> disabled <?php
                                                                                                }
                                                                                                    ?> id="arr"/>
                                        </span>
                                    </div>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="d-flex flex-md-row flex-column justify-content-between align-items-md-center align-items-start ad">
                                        <span class="me-3 fw-bold text-nowrap">Depature Date & Time :</span>
                                        <span class="d-flex flex-row position-relative">
                                            <input type="date" class="input" value="<?php
                                                                                    if ($deStatus == 1) {
                                                                                        echo date($de);
                                                                                    }
                                                                                    ?>" <?php
                                                                                        if ($deStatus == 1) {
                                                                                        ?> disabled <?php
                                                                                        }
                                                            ?> id="de"/>
                                        </span>
                                    </div>
                                </div>

                                <!-- 7 -->
                                <div class="d-flex flex-md-row flex-column justify-content-between align-items-center col-11">
                                    <div class="d-flex flex-md-row flex-column roo">
                                        <div class="d-flex flex-md-row flex-column justify-content-between align-items-md-center align-items-start">
                                            <span class="me-3 fw-bold text-nowrap">Room Type :</span>
                                            <span class="d-flex flex-row position-relative roo1">
                                                <select class="selctTag" id="rt">
                                                    <option value="0">Choose</option>
                                                    <?php
                                                    $rt_rs = Database::search("SELECT * FROM `room_type` WHERE `room_type`.`status_status_id`='1'");
                                                    for ($rt = 0; $rt < $r_rs->num_rows; $rt++) {
                                                        $rt_data = $rt_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $rt_data["room_type_id"]; ?>"><?php echo $rt_data["room_type"]; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <div class="downArrow d-flex justify-content-center align-items-center px-2 position-absolute">
                                                    <i class="bi bi-chevron-down downicon fw-bold"></i>
                                                </div>
                                            </span>
                                        </div>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <div class="d-flex flex-row justify-content-between align-items-center roo2 d-none">
                                            <span class="d-flex flex-row position-relative">
                                                <select class="selctTag">
                                                    <option value="">bbbbbbbbbbbb</option>
                                                    <option value="">nnnnnnnnn</option>
                                                    <option value="">n</option>
                                                    <option value=""></option>
                                                </select>
                                                <div class="downArrow d-flex justify-content-center align-items-center px-2 position-absolute">
                                                    <i class="bi bi-chevron-down downicon fw-bold"></i>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between align-items-center mp">
                                        <span class="me-3 fw-bold">Meal Plan :</span>
                                        <span class="d-flex flex-row position-relative">
                                            <select class="selctTag" id="mp">
                                                <option value="0">Choose</option>
                                                <?php
                                                $m_rs = Database::search("SELECT * FROM `meal_plan` WHERE `meal_plan`.`status_status_id`='1'");
                                                for ($m = 0; $m < $r_rs->num_rows; $m++) {
                                                    $m_data = $m_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $m_data["meal_plan_id"]; ?>"><?php echo $m_data["meal_plan"]; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <div class="downArrow d-flex justify-content-center align-items-center px-2 position-absolute">
                                                <i class="bi bi-chevron-down downicon fw-bold"></i>
                                            </div>
                                        </span>
                                    </div>
                                </div>

                                <!-- 8 -->
                                <div class="d-flex flex-md-row flex-column justify-content-between align-items-center col-11 tr">
                                    <div class="d-flex flex-md-row flex-column justify-content-between align-items-md-center align-items-start">
                                        <span class="me-3 fw-bold text-nowrap">Travel Agent :</span>
                                        <span class="d-flex flex-row position-relative">
                                            <input type="text" class="input" id="ta"/>
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12" style="margin-bottom: 5%;">
                            <div class="row d-flex flex-row justify-content-center align-items-center">
                                <span class="col-4 d-block bg-success text-uppercase d-flex justify-content-center align-items-center rounded fs-4 fw-bold text-white py-2" style="cursor: pointer;" onclick="book();">book now</span>
                            </div>
                        </div>

                    </div>
                </div>

                <?php include "../user/footer.php"; ?>

            </div>
        </div>

        <?php include_once "../user/userError.php"; ?>

        <!-- notification -->
        <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 50;">
            <div id="liveToastA" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-secondary text-white" id="headerColorA">

                    <strong class="me-auto">Message</strong>
                    <small id="timeA"></small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" id="msgA">
                </div>
            </div>
        </div>

    </span>

    <script src="../js/other/loading.js"></script>
    <script src="../js/other/guestRegistrationForm.js"></script>
    <script src="../js/bootstrap/bootstrap.bundle.js"></script>
    <script src="../js/other/toast.js"></script>

</body>

</html>