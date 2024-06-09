<?php

session_start();
require "../connection/connection.php";

if (!empty($_POST["date"])) {

    $date = $_POST["date"];
    $datetime = DateTime::createFromFormat("Y-m-d\TH:i", $date);
    $output_date = $datetime->format("Y-m-d H:i:s");

    // already booked
    // not booked

    $room_type_rs = Database::search("SELECT * FROM `room_type` WHERE `status_status_id`='1'");
    if ($room_type_rs->num_rows > 0) {

?>

        <table class="ui celled structured table">
            <thead>
                <tr>
                    <th>Room Type</th>
                    <th>Room Number</th>
                    <th>Availiability</th>
                    <th>Ref</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($x = 0; $x < $room_type_rs->num_rows; $x++) {
                    $room_type_data = $room_type_rs->fetch_assoc();

                    $rs = Database::search("SELECT * FROM `room_numbers` WHERE `room_numbers`.`room_type_room_type_id` = '" . $room_type_data["room_type_id"] . "'");
                    $rows = $rs->num_rows;

                    $first_row = $rs->fetch_assoc();
                    $room_type = $room_type_data["room_type"];
                    $first_room_num_id = $first_row["room_numbers_id"];

                    //check if the room is already booked
                    $av_rs = Database::search("SELECT * FROM `registered_guest` INNER JOIN `registered_guest_has_room_numbers` 
                    ON `registered_guest`.`registered_guest_id` = `registered_guest_has_room_numbers`.`registered_guest_registered_guest_id`
                    WHERE `registered_guest`.`depature_date_time`>'" . $output_date . "' 
                    AND `registered_guest_has_room_numbers`.`room_numbers_room_numbers_id` = '" . $first_room_num_id . "' 
                    AND `registered_guest_has_room_numbers`.`status_status_id` ='1' ");

                    if ($av_rs->num_rows == 1) { //booked
                        $cls = "error";
                    } else if ($av_rs->num_rows == 0) {
                        $cls = "positive";
                    }
                ?>
                    <tr>
                        <td rowspan="<?php echo $rows; ?>"><?php echo $room_type; ?></td>
                        <td class="<?php echo $cls; ?>"><?php echo $first_row["room_numbers"]; ?></td>
                        <td class="<?php echo $cls; ?> center aligned">
                            <?php

                            if ($av_rs->num_rows == 1) { //booked
                            ?>
                                <i class="large red close icon"></i>
                            <?php
                            } else if ($av_rs->num_rows == 0) {
                            ?>
                                <i class="large green checkmark icon"></i>
                            <?php
                            }

                            ?>

                        </td>
                        <td class="<?php echo $cls; ?> right aligned">
                            <?php
                            if ($av_rs->num_rows == 1) {
                                $av_data = $av_rs->fetch_assoc();
                                echo $av_data["ref_number"];
                            } else {
                                echo "not-found";
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                    if ($rows > 0) {
                        for ($i = 0; $i < $rows - 1; $i++) {
                            $rest_row = $rs->fetch_assoc();

                            $av2_rs = Database::search("SELECT * FROM `registered_guest` INNER JOIN `registered_guest_has_room_numbers` 
                                    ON `registered_guest`.`registered_guest_id` = `registered_guest_has_room_numbers`.`registered_guest_registered_guest_id`
                                    WHERE `registered_guest`.`depature_date_time`>'" . $output_date . "' 
                                    AND `registered_guest_has_room_numbers`.`room_numbers_room_numbers_id` = '" . $rest_row["room_numbers_id"] . "' 
                                    AND `registered_guest_has_room_numbers`.`status_status_id` ='1' ");

                            if ($av2_rs->num_rows == 1) { //booked
                                $cls2 = "error";
                            } else if ($av2_rs->num_rows == 0) {
                                $cls2 = "positive";
                            }
                    ?>
                            <!-- has more than one room number for that room type -->
                            <tr class="<?php echo $cls2; ?>">
                                <td><?php echo $rest_row["room_numbers"]; ?></td>
                                <td class="center aligned">
                                    <?php


                                    if ($av2_rs->num_rows == 1) { //booked
                                    ?>
                                        <i class="large red close icon"></i>
                                    <?php
                                    } else if ($av2_rs->num_rows == 0) {
                                    ?>
                                        <i class="large green checkmark icon"></i>
                                    <?php
                                    }

                                    ?>
                                </td>
                                <td class="right aligned">
                                    <?php
                                    if ($av2_rs->num_rows == 1) {
                                        $av2_data = $av2_rs->fetch_assoc();
                                        echo $av2_data["ref_number"];
                                    } else {
                                        echo "not-found";
                                    }
                                    ?>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>


                <?php
                }
                ?>
            </tbody>
        </table>

<?php

    }
} else {
    echo "2";
}

?>