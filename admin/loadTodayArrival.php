<?php

session_start();
require "../connection/connection.php";

$rs = Database::search("SELECT * FROM `registered_guest` 
    WHERE `registered_guest`.`arrival_date_time` LIKE '" . date("Y-m-d") . "%' AND `registered_guest`.`status_status_id`='1'");

$obj = new stdClass();

if ($rs->num_rows > 0) {
    $obj->status = 1;
    $obj->content = '
            <table class="ui definition table d-none" id="todayArrivalTable">
                <thead>
                    <tr>
                        <th></th>
                        <th>NIC</th>
                        <th>Name</th>
                        <th>Ref No</th>
                        <th>Arrived</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>';

    $counter = 1; // Initialize a counter variable

    // Loop through the result set and add rows dynamically
    while ($row = $rs->fetch_assoc()) {

        $surRs = Database::search("SELECT * FROM `surname` WHERE `surname`.`status_status_id`='1' AND `surname`.`surname_id`='" . $row["surname_surname_id"] . "'");
        $surData = $surRs->fetch_assoc();

        $country_rs = Database::search("SELECT * FROM `country` WHERE `country`.`country_id`='" . $row["country_country_id"] . "' AND `country`.`status_status_id`='1'");
        $country_data = $country_rs->fetch_assoc();

        $nationality_rs = Database::search("SELECT * FROM `nationality` WHERE `nationality`.`nationality_id`='" . $row["nationality_nationality_id"] . "' AND `nationality`.`status_status_id`='1'");
        $nationality_data = $nationality_rs->fetch_assoc();

        $religion_rs = Database::search("SELECT * FROM `religion` WHERE `religion`.`religion_id`='" . $row["religion_religion_id"] . "' AND `religion`.`status_status_id`='1'");
        $religion_data = $religion_rs->fetch_assoc();

        $meal_rs = Database::search("SELECT * FROM `meal_plan` 
            INNER JOIN `registered_guest_has_meal_plan` ON `registered_guest_has_meal_plan`.`meal_plan_meal_plan_id`=`meal_plan`.`meal_plan_id`
            WHERE `registered_guest_has_meal_plan`.`registered_guest_registered_guest_id`='" . $row["registered_guest_id"] . "' AND `registered_guest_has_meal_plan`.`status_status_id`='1'
            AND `meal_plan`.`status_status_id`='1'");
        $meal_data = $meal_rs->fetch_assoc();

        $room_rs = Database::search("SELECT * FROM `room_type` 
        INNER JOIN `registered_guest_has_room_type` ON `registered_guest_has_room_type`.`room_type_room_type_id`=`room_type`.`room_type_id`
        WHERE `registered_guest_has_room_type`.`registered_guest_registered_guest_id`='" . $row["registered_guest_id"] . "' 
        AND `registered_guest_has_room_type`.`status_status_id`='1' AND `room_type`.`status_status_id`='1'");

        $email = $row['email'];
        $name = $surData["surname"] . " " . $row['f_name'] . " " . $row['l_name'];
        $refNo = $row['ref_number'];
        $mobile = $row["mobile"];
        $id = $row["registered_guest_id"];

        $obj->content .= '
                <tr id="tr' . $id . '" class="positive">
                    <td>' . $counter . '</td>
                    <td>' . $row["nic"] . '</td>
                    <td>' . $name . '</td>
                    <td>' . $refNo . '</td>
                    <td class="center aligned" id="artd' . $id . '">';

        if ($row["arrived"] == null) {
            $obj->content .= '
                                <div class="ui small button text-nowrap" onclick="arrived(\'' . $id . '\')";>
                                    Not Yet 
                                </div>
                            ';
        } else {
            $obj->content .= '
                                <i class="large green checkmark icon"></i>
                            ';
        }
        $obj->content .= '
                    </td>
                    <td>
                        <span class="btn btn-success" onclick="viewAr(' . $id . ');" id="viewAr' . $id . '">View</span>
                    </td>
                </tr>
                <tr class="d-none" id="arTr' . $id . '">
                    <td></td>
                    <td colspan="4">
                        <div class="d-flex flex-column justify-content-center align-items-end">
                            <div class="d-flex flex-column text-danger">
                                ' . $name . '
                            </div>
                            <div class="text-danger">
                                ' . $email . '
                            </div>
                        </div>
    
                        <div class="mt-2 fw-bold">Mobile : <span class="text-primary fw-normal">' . $mobile . '</span></div>
                        <div class="mt-2 fw-bold">Email : <span class="text-primary fw-normal">' . $email . '</span></div>
                        <div class="mt-2 fw-bold">Pssport : <span class="text-primary fw-normal">' . $row["passport"] . '</span></div>
                        <div class="mt-2 fw-bold">Address : <span class="text-primary fw-normal">' . $row["line_1"] . ' ' . $row["line_2"] . '</span></div>
                        <div class="mt-2 fw-bold">Adult Count : <span class="text-primary fw-normal">' . $row["adult_count"] . '</span></div>
                        <div class="mt-2 fw-bold">Child Count : <span class="text-primary fw-normal">' . $row["child_count"] . '</span></div>
                        <div class="mt-2 fw-bold">Arrival Date Time : <span class="text-primary fw-normal">' . $row["arrival_date_time"] . '</span></div>
                        <div class="mt-2 fw-bold">Departure Date Time : <span class="text-primary fw-normal">' . $row["depature_date_time"] . '</span></div>
                        <div class="mt-2 fw-bold">Travel Agent : <span class="text-primary fw-normal">' . $row["travel_agent"] . '</span></div>
                        <span id="art' . $id . '"><div class="mt-2 fw-bold">Room Type : </br>
                        ';

        if ($row["departured"] == null) {
            $statusR = 1;
        } else {
            $statusR = 2;
        }
        $assign_room_type_rs = Database::search(" SELECT `room_type`.`room_type_id`,`room_type`.`room_type` FROM `registered_guest_has_room_numbers` 
        INNER JOIN `room_type` ON `room_type`.`room_type_id`=`registered_guest_has_room_numbers`.`room_type_room_type_id`
        WHERE `registered_guest_registered_guest_id`='" . $row["registered_guest_id"] . "' AND `registered_guest_has_room_numbers`.`status_status_id`='" . $statusR . "' 
        GROUP BY `room_type`.`room_type_id`");

        for ($z = 0; $z < $assign_room_type_rs->num_rows; $z++) {
            $assign_room_type_data = $assign_room_type_rs->fetch_assoc();

            $room_rumbers_rs = Database::search("SELECT * FROM `registered_guest_has_room_numbers` 
                            INNER JOIN `room_numbers` ON `room_numbers`.`room_numbers_id`=`registered_guest_has_room_numbers`.`room_numbers_room_numbers_id`
                            WHERE `registered_guest_has_room_numbers`.`registered_guest_registered_guest_id`='" . $id . "' 
                            AND `registered_guest_has_room_numbers`.`room_type_room_type_id`='" . $assign_room_type_data["room_type_id"] . "' AND `registered_guest_has_room_numbers`.`status_status_id`='" . $statusR . "' ");

            $obj->content .= '<span class="text-primary fw-normal ms-5">
                        ' . $assign_room_type_data["room_type"] . '</span>&nbsp;&nbsp;&nbsp;&nbsp;';

            for ($a = 0; $a < $room_rumbers_rs->num_rows; $a++) {
                $room_rumbers_data = $room_rumbers_rs->fetch_assoc();

                $obj->content .= '<span class="fw-normal">' . $room_rumbers_data["room_numbers"] . ',</span>';
            }

            $obj->content .= '
                        </div>';
        }

        $obj->content .= '
                        </span>
                        <div class="mt-2 fw-bold">Meal Plan : <span class="text-primary fw-normal">' . $meal_data["meal_plan"] . '</span></div>
                        <div class="mt-2 fw-bold">Arrived At : <span class="text-primary fw-normal" id="arrT' . $id . '">' . $row["arrived"] . '</span></div>
                        <div class="mt-2 fw-bold">Departured At : <span class="text-primary fw-normal" id="ardT' . $id . '">' . $row["departured"] . '</span></div>
                    </td>
                    <td></td>
                </tr>
                ';
        if ($room_rs->num_rows > 0) {
            $obj->content .= '
                        <!-- room asign model -->
                        <div class="modal" tabindex="-1" id="roomAssignModel' . $id . '">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Assign Rooms</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body d-flex flex-column">
                                        <div class="d-flex flex-row">
                                            <div class="d-flex flex-column me-3">
                                                <span class="text-nowrap">Room Type</span>
                                                <select class="form-select" onchange="roomNumber(value,' . $id . ')" id="rtype' . $id . '">';

            $room_data = $room_rs->fetch_assoc();

            $mrt_rs = Database::search("SELECT * FROM `room_type` WHERE `room_type`.`status_status_id`='1'");
            for ($x = 0; $x < $mrt_rs->num_rows; $x++) {
                $mrt_data = $mrt_rs->fetch_assoc();

                $obj->content .= '
                                                    <option value="' . $mrt_data["room_type_id"] . '" ';
                if (!empty($room_data["room_type_id"])) {
                    if ($mrt_data["room_type_id"] == $room_data["room_type_id"]) {
                        $obj->content .= 'selected';
                    }
                }
                $obj->content .= '>' . $mrt_data["room_type"] . '</option>
                                                    ';
            }

            $obj->content .= '
                                                </select>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="text-nowrap">Room Number</span>
                    
                                                <div class="d-flex flex-row gap-3">
                                                    <span>
                                                        <select class="form-select" id="rn' . $id . '">
                                                            <option value="0">Choose Room</option>
                                                        ';

            $rn_rs = Database::search("SELECT * FROM `room_numbers` WHERE `room_numbers`.`room_type_room_type_id`='" . $room_data["room_type_id"] . "' AND `status_status_id`='1' AND `booked_status`='2'");

            for ($y = 0; $y < $rn_rs->num_rows; $y++) {
                $rn_data = $rn_rs->fetch_assoc();

                $obj->content .= '
                                                            <option value="' . $rn_data["room_numbers_id"] . '">' . $rn_data["room_numbers"] . '</option>
                                                            ';
            }
            $obj->content .= '
                                                        </select>
                                                    </span>
                                                    <i class="bi bi-plus text-success fs-3" onclick="addToOb(\'' . $id . '\');"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                        <p class="fw-bold mt-4">Selected Rooms :</p>
                                        <div class="ms-5 mt-1">
                                        ';

                                        $already_rs = Database::search("SELECT * FROM `registered_guest` WHERE `registered_guest`.`room_assigned`='1' 
                                        AND `registered_guest`.`registered_guest_id`='". $id. "'");
                                        if($already_rs->num_rows > 0){ // room assigned alreay 

                                            $all_rghrn_rs = Database::search("SELECT * FROM `registered_guest_has_room_numbers` 
                                            INNER JOIN `room_numbers` ON `room_numbers`.`room_numbers_id`=`registered_guest_has_room_numbers`.`room_numbers_room_numbers_id`
                                            WHERE `registered_guest_has_room_numbers`.`registered_guest_registered_guest_id`='". $id. "' AND `registered_guest_has_room_numbers`.`status_status_id`='1'");

                                            $obj->content .='
                                            <span class="fw-bold text-success">Already Assigned :</span>
                                            <ul class="mt-2">
                                            ';
                                            for($h=0;$h<$all_rghrn_rs->num_rows;$h++){
                                                $all_rghrn_data = $all_rghrn_rs->fetch_assoc();
                                            
                                                $obj->content .='
                                                    <li id="alasul'.$all_rghrn_data["registered_guest_has_room_numbers_id"].'">\''. $all_rghrn_data["room_numbers"].'\' <span class="ms-5 ps-5"><i class="bi bi-trash text-danger" onclick="deleteAlreadyAssigned(\''.$all_rghrn_data["registered_guest_has_room_numbers_id"].'\');"></i></span></li>
                                                ';
                                            }
                                            $obj->content .='
                                            </ul>
                                            ';

                                        }

            $obj->content .='
                                        </div>
                                        <div>
                                            <span class="fw-bold ms-5 text-primary">Newly Assigned :</span>
                                            <div class="ms-5 ps-3 mt-1" id="arrayCD' . $id . '">
                                            </div>  
                                        </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" onclick="resetModel(\'' . $id . '\')">Reset</button>
                                        <button type="button" class="btn btn-success" onclick="markArrived(\'' . $id . '\')">Proceed</button>
                                    </div>
                                </div>
                            </div>
                        </div>
             
                        ';
        }
        $counter++; // Increment the counter for each row

    }

    $obj->content .= '
                </tbody>
            </table>';
} else {
    $obj->status = 2;
}

echo json_encode($obj);
