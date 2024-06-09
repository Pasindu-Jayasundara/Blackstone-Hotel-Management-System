<?php

require "../connection/connection.php";
session_start();

if (!empty($_SESSION["admin"])) {

    if (!empty($_POST["msg_Type"])) {

        $msg_type = $_POST["msg_Type"];

        if ($msg_type == 1) { //new msg
            $q = "SELECT * FROM `user_contact` WHERE `user_contact`.`status_status_id`='2' ORDER BY `user_contact`.`send_date_time` DESC";
        } else if ($msg_type == 2) { //all msg
            $q = "SELECT * FROM `user_contact` WHERE `user_contact`.`delete`='2' ORDER BY `user_contact`.`send_date_time` DESC";
        }

        $rs = Database::search($q);

        if ($rs->num_rows > 0) {

            for ($x = 0; $x < $rs->num_rows; $x++) {
                $data = $rs->fetch_assoc();

?>

                <div class="item d-flex align-items-center pb-2 ps-2 pt-2 c" style="cursor:pointer;" onclick="readMsg('<?php echo $data['user_contact_id']; ?>','<?php echo $data['status_status_id']; ?>')">
                    <div class="content ms-2 d">
                        <div class="header text-primary d"><?php echo $data["name"]; ?></div>
                        <span style="font-size: 12px;"><?php echo $data["msg_title"]; ?></span>
                    </div>
                </div>

<?php

            }
        } else {
            // echo ("no messages");
            echo ("1");
        }
    } else {
        // echo ("something went wrong");
        echo ("2");
    }
} else {
    header("Location:index.php");
}

?>