<?php

session_start();
require "../connection/connection.php";

$rs = Database::search("SELECT * FROM `registered_guest` WHERE `registered_guest`.`room_assigned`='2' 
AND `registered_guest`.`status_status_id`='1' ORDER BY `registered_guest_id` ASC");

if ($rs->num_rows > 0) {
?>
  <div class="d-flex flex-column justify-content-center align-items-start col-12">
    <span class="fw-bold pt-3 text-danger ms-5">Room Assigning Required</span>
    <div class="d-flex flex-column justify-content-center align-items-center ms-3 col-12">
      <span class="mt-3 ms-3 d-flex col-11">
        <table class="ui compact celled definition table">
          <thead>
            <tr>
              <th></th>
              <th>Name</th>
              <th>Registration Date</th>
              <th>E-mail</th>
              <th>Mobile</th>
              <th>Rooms</th>
            </tr>
          </thead>
          <tbody>
            <?php
            for ($x = 0; $x < $rs->num_rows; $x++) {
              $row = $rs->fetch_assoc();

              $id = $row["registered_guest_id"];

              $surname_rs = Database::search("SELECT * FROM `surname` WHERE `surname_id` = '" . $row["surname_surname_id"] . "'");
              $surname_data = $surname_rs->fetch_assoc();

            ?>
              <tr>
                <td class="collapsing">
                  <?php echo $x + 1; ?>
                </td>
                <td><?php echo $surname_data["surname"] . " " . $row["f_name"] . " " . $row["l_name"]; ?></td>
                <td><?php echo $row["registered_date_time"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["mobile"]; ?></td>
                <td class="d-flex justify-content-center align-items-center" id="assStatus<?php echo $id; ?>">
                  <div class="ui small button text-nowrap" onclick="showAssignModel(<?php echo $id; ?>);">
                    Not Assigned
                  </div>
                </td>
              </tr>

              <!-- room asign model -->
              <div class="modal" tabindex="-1" id="assRoomAssignModel<?php echo $id; ?>">
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
                          <select class="form-select" onchange="assRoomNumber(value,<?php echo $id; ?>)" id="roomtype<?php echo $id; ?>">';

                            <?php

                            $room_type_rs = Database::search("SELECT * FROM `room_type` WHERE `room_type`.`status_status_id`='1'");
                            $start_room_type;

                            for ($y = 0; $y < $room_type_rs->num_rows; $y++) {
                              $room_type_data = $room_type_rs->fetch_assoc();

                              $rghrty_rs = Database::search("SELECT * FROM `registered_guest_has_room_type` 
                              WHERE `registered_guest_registered_guest_id`='" . $id . "' AND `status_status_id`='1'");

                              $rghrty_data = $rghrty_rs->fetch_assoc();

                            ?>
                              <option value="<?php echo $room_type_data["room_type_id"]; ?>" <?php
                                                                                              if ($room_type_data["room_type_id"] == $rghrty_data["room_type_room_type_id"]) {
                                                                                                echo "selected";
                                                                                                $start_room_type = $room_type_data["room_type_id"];
                                                                                              }
                                                                                              ?>><?php echo $room_type_data["room_type"]; ?></option>
                            <?php
                            }
                            ?>

                          </select>
                        </div>
                        <div class="d-flex flex-column">
                          <span class="text-nowrap">Room Number</span>

                          <div class="d-flex flex-row gap-3">
                            <span>
                              <select class="form-select" id="roomNumber<?php echo $id; ?>">
                                <option value="0">Choose Room</option>

                                <?php

                                $rn_rs = Database::search("SELECT * FROM `room_numbers` 
                                WHERE `room_numbers`.`room_type_room_type_id`='" . $start_room_type . "' 
                                AND `status_status_id`='1' AND `booked_status`='2'");

                                for ($y = 0; $y < $rn_rs->num_rows; $y++) {
                                  $rn_data = $rn_rs->fetch_assoc();

                                ?>
                                  <option value="<?php echo $rn_data["room_numbers_id"]; ?>"><?php echo $rn_data["room_numbers"]; ?></option>
                                <?php

                                }

                                ?>

                              </select>
                            </span>
                            <i class="bi bi-plus text-success fs-3" onclick="addToRoomAssOb(<?php echo $id; ?>);"></i>
                          </div>
                        </div>
                      </div>
                      <div class="d-flex flex-column">
                        <p class="fw-bold mt-4">Selected Rooms :</p>
                        <div class="ms-5 mt-1" id="selectedroomDisplay<?php echo $id; ?>"></div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" onclick="resetAssModel(<?php echo $id; ?>)">Reset</button>
                      <button type="button" class="btn btn-success" onclick="markAssArrived(<?php echo $id; ?>)">Proceed</button>
                    </div>
                  </div>
                </div>
              </div>

            <?php
            }
            ?>
          </tbody>
        </table>
      </span>
    </div>
  </div>
<?php
}
?>