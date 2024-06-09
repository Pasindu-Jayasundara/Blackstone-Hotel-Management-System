<?php
session_start();
require "../connection/connection.php";

if (!empty($_SESSION["admin"])) {

    $num = 0;

    if (!empty($_POST["invoice_id"]) && (preg_match('/[A-Za-z]/', $_POST["invoice_id"]) || preg_match('/[A-Za-z0-9]/', $_POST["invoice_id"]) || preg_match('/[0-9]/', $_POST["invoice_id"]))) {
        $invoice_id = $_POST["invoice_id"];

        $rs = Database::search("SELECT *
        FROM `registered_guest`
        WHERE `registered_guest`.`ref_number`='" . $invoice_id . "' AND `registered_guest`.`status_status_id`='1'");

        if ($rs->num_rows == 1) {
            $num = 1;
        } else {
?>
            <p style="color:red; text-align:center; margin-top:10px; margin: bottom 10px; ">Couldn't Find The Booking</p>
        <?php
        }
    } else {
        ?>
        <p style="color:red; text-align:center; margin-top:10px; margin: bottom 10px; ">Please Insert Booking Id !</p>
    <?php
    }


    if ($num == 1) { //data availiable

    ?>

        <table class=" table">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php

                for ($x = 0; $x < $rs->num_rows; $x++) {
                    $data = $rs->fetch_assoc();

                ?>

                    <tr>
                        <td>Ref Number</td>
                        <td>:</td>
                        <td><?php echo ($data["ref_number"]); ?></td>
                    </tr>
                    <?php
                    $sur_rs = Database::search("SELECT * FROM `surname` WHERE `surname`.`surname_id`='" . $data["surname_surname_id"] . "'");
                    $sur_data = $sur_rs->fetch_assoc();
                    ?>
                    <tr>
                        <td>Full Name</td>
                        <td>:</td>
                        <td><?php echo ($sur_data["surname"] . ". " . $data["f_name"] . " " . $data["l_name"]); ?></td>
                    </tr>
                    <tr>
                        <td>NIC</td>
                        <td>:</td>
                        <td><?php echo ($data["nic"]); ?></td>
                    </tr>
                    <tr>
                        <td>Passport</td>
                        <td>:</td>
                        <td><?php echo ($data["passport"]); ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><?php echo ($data["email"]); ?></td>
                    </tr>
                    <tr>
                        <td>Mobile No</td>
                        <td>:</td>
                        <td><?php echo ($data["mobile"]); ?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td><?php echo ($data["line_1"] . " " . $data["line_2"]); ?></td>
                    </tr>
                    <?php
                    $cun_rs = Database::search("SELECT * FROM `country` WHERE `country`.`country_id`='" . $data["country_country_id"] . "'");
                    $cun_data = $cun_rs->fetch_assoc();
                    ?>
                    <tr>
                        <td>Country</td>
                        <td>:</td>
                        <td><?php echo ($cun_data["country"]); ?></td>
                    </tr>
                    <tr>
                        <td>Adult Count</td>
                        <td>:</td>
                        <td><?php echo ($data["adult_count"]); ?></td>
                    </tr>
                    <tr>
                        <td>Child Count</td>
                        <td>:</td>
                        <td><?php echo ($data["child_count"]); ?></td>
                    </tr>
                    <tr>
                        <td>Arrival</td>
                        <td>:</td>
                        <td><?php echo ($data["arrival_date_time"]); ?></td>
                    </tr>
                    <tr>
                        <td>Depature</td>
                        <td>:</td>
                        <td><?php echo ($data["depature_date_time"]); ?></td>
                    </tr>
                    <tr>
                        <td>Travel Agent</td>
                        <td>:</td>
                        <td><?php echo ($data["travel_agent"]); ?></td>
                    </tr>
                    <?php
                    $na_rs = Database::search("SELECT * FROM `nationality` WHERE `nationality`.`nationality_id`='" . $data["nationality_nationality_id"] . "'");
                    $na_data = $na_rs->fetch_assoc();
                    ?>
                    <tr>
                        <td>Nationality</td>
                        <td>:</td>
                        <td><?php echo ($na_data["nationality"]); ?></td>
                    </tr>
                    <?php
                    $rel_rs = Database::search("SELECT * FROM `religion` WHERE `religion`.`religion_id`='" . $data["religion_religion_id"] . "'");
                    $rel_data = $rel_rs->fetch_assoc();
                    ?>
                    <tr>
                        <td>Religion</td>
                        <td>:</td>
                        <td><?php echo ($rel_data["religion"]); ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php
                    $rt_rs = Database::search("SELECT * FROM `room_type` 
                    INNER JOIN `registered_guest_has_room_type` ON `registered_guest_has_room_type`.`room_type_room_type_id`=`room_type`.`room_type_id`
                    INNER JOIN `registered_guest` ON `registered_guest`.`registered_guest_id`=`registered_guest_has_room_type`.`registered_guest_registered_guest_id`
                    WHERE `registered_guest`.`registered_guest_id`='" . $data["registered_guest_id"] . "'");
                    ?>
                    <tr>
                        <td>Room Type</td>
                        <td>:</td>
                        <td>
                            <ul>
                                <?php
                                for ($rt = 0; $rt < $rt_rs->num_rows; $rt++) {
                                    $rt_data = $rt_rs->fetch_assoc();
                                ?>
                                    <li><?php echo $rt_data["room_type"]; ?></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </td>
                    </tr>
                    <?php
                    $mp_rs = Database::search("SELECT * FROM `meal_plan` 
                    INNER JOIN `registered_guest_has_meal_plan` ON `registered_guest_has_meal_plan`.`meal_plan_meal_plan_id`=`meal_plan`.`meal_plan_id`
                    INNER JOIN `registered_guest` ON `registered_guest`.`registered_guest_id`=`registered_guest_has_meal_plan`.`registered_guest_registered_guest_id`
                    WHERE `registered_guest`.`registered_guest_id`='" . $data["registered_guest_id"] . "'");
                    ?>
                    <tr>
                        <td>Meal Plan</td>
                        <td>:</td>
                        <td>
                            <ul>
                                <?php
                                for ($mp = 0; $mp < $mp_rs->num_rows; $mp++) {
                                    $mp_data = $mp_rs->fetch_assoc();
                                ?>
                                    <li><?php echo $mp_data["meal_plan"]; ?></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </td>
                    </tr>

                <?php
                }

                ?>
            </tbody>
        </table>

<?php

    }
} else {
    header("Location:index.php");
}
?>