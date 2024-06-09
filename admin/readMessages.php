<?php

require "../connection/connection.php";
session_start();

if (!empty($_SESSION["admin"])) {

    if (!empty($_POST["msg_id"]) && !empty($_POST["msg_status_id"])) {

        $msg_id = $_POST["msg_id"];
        $msg_status_id = $_POST["msg_status_id"];

        $rs = Database::search("SELECT * FROM `user_contact` WHERE `user_contact`.`user_contact_id`='" . $msg_id . "' 
        AND `user_contact`.`status_status_id`='" . $msg_status_id . "'");

        if ($rs->num_rows == 1) {
            $data = $rs->fetch_assoc();

            $date_time = strtotime($data["send_date_time"]);
            $date = date("Y-m-d");
            $time = date("H:i");



            if ($msg_status_id == 2) {
                Database::iud("UPDATE `user_contact` SET `user_contact`.`status_status_id`='1' 
                    WHERE `user_contact`.`status_status_id`='" . $msg_status_id . "' AND `user_contact`.`user_contact_id`='" . $msg_id . "'");

                    $_SESSION["clicked_msg_id"] = $data["user_contact_id"];
            }

?>

            <div class="mb-5">
                <p><span class="fw-bold">From :</span> <?php echo $data["email"]; ?></p>
                <p class="fw-bold" style="margin-top: -8px; ">On : <span class="fw-normal" style="font-size: 13px;"><?php echo $date; ?></span> At : <span class="fw-normal" style="font-size: 13px;"><?php echo $time; ?></span></p>
            </div>

            <span style="overflow-y: scroll; max-height: 80vh;">
                <div>
                    <span class="fw-bold">Message Title:</span>
                    <span class="ms-5"><?php echo $data["msg_title"]; ?></span>
                    <p class="fw-bold mb-3">Message :</p>
                    <p class="ms-5"><?php echo $data["msg"]; ?></p>
                </div>
                <?php
                $reply_rs = Database::search("SELECT * FROM `reply` WHERE `reply`.`user_contact_user_contact_id`='" . $data["user_contact_id"] . "'");
                if ($reply_rs->num_rows > 0) {
                    for ($re = 0; $re < $reply_rs->num_rows; $re++) {
                        $reply_data = $reply_rs->fetch_assoc();
                ?>
                        <div class="d-flex flex-column align-items-end mt-5">
                            <span class="fw-bold">Reply :&nbsp;&nbsp;&nbsp; <small class="text-muted" style="font-size: xx-small;"><?php echo $reply_data["date_time"]; ?></small> </span>
                            <p class="ms-5"><?php echo $reply_data["reply_msg"]; ?></p>
                        </div>
                <?php
                    }
                }
                ?>
            </span>
            <div class="d-flex mt-4">
                <div class="bg-dark p-2 col-10 rounded" id="darkbg<?php echo $data['email']; ?>">
                    <textarea rows="1" class="bg-secondary text-white border-none form-control" id="replyText"></textarea>
                </div>
                <div class="d-flex bg-dark rounded btn justify-content-center align-items-center ms-2 col-2" onclick="sendEmail('<?php echo $data['email']; ?>');">
                    <p class="text-white"><i class="bi bi-send me-2"></i> Send Email</p>
                </div>
            </div>

<?php

        } else {
            // echo ("Couldn't Find The Message");
            echo ("2");
        }
    } else {
        // echo ("Something Went Wrong");
        echo ("3");
    }
} else {
    header("Location:index.php");
}

?>