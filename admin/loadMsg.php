<?php

session_start();
require "../connection/connection.php";

if (!empty($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {

    $rs = Database::search("SELECT * FROM `user_contact` WHERE `user_contact`.`email`='" . $_POST["email"] . "' AND `user_contact`.`delete`='2'");

    $obj = new stdClass();

    if($rs->num_rows > 0){
        $obj->status = 1;
        $obj->content = '
            <table class="ui definition table d-none" id="msgTable">
                <thead>
                    <tr>
                        <th></th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Msg Title</th>
                        <th>Take Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>';

        $counter = 1; // Initialize a counter variable

        // Loop through the result set and add rows dynamically
        while($row = $rs->fetch_assoc()) {
            $email = $row['email'];
            $name = $row['name'];
            $msgTitle = $row['msg_title'];
            $msg = $row["msg"];
            $id = $row["user_contact_id"];

            $obj->content .= '
                <tr id="tr'.$id.'">
                    <td>' . $counter . '</td>
                    <td>' . $email . '</td>
                    <td>' . $name . '</td>
                    <td>' . $msgTitle . '</td>
                    <td>
                        <select class="form-select" onchange="takeAction(\''.$id.'\',\''.$email.'\');" id="select'.$id.'">
                            <option value="0">Choose Action</option>
                            <option value="1">Send Registration Form</option>
                            <option value="2" class="bg-danger text-white">Delete</option>
                        </select>
                    </td>
                    <td>
                        <span class="btn btn-success" onclick="viewM('.$id.');" id="view'.$id.'">View</span>
                    </td>
                </tr>
                <tr class="d-none" id="msgTr'.$id.'">
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
    
                        <div class="mt-4 text-primary">Message :</div>
                        <div class="mt-3">'.$msg.'</div>
            ';

            $reply_rs = Database::search("SELECT * FROM `reply` WHERE `reply`.`user_contact_user_contact_id`='".$id."'");
            if($reply_rs->num_rows > 0){
                $obj->content .='
                        <div class="mt-4 text-primary text-end">: Reply</div>
                ';

                while($relply_row = $reply_rs->fetch_assoc()){
                    $obj->content .='
                        <div class="mt-3 text-end">'.$relply_row["reply_msg"].'</div>
                    ';
                }
            }
            $obj->content .='
                    </td>
                    <td></td>
                </tr>';
                
            $counter++; // Increment the counter for each row
        }

        $obj->content .= '
                </tbody>
            </table>';
    }else{
        $obj->status = 2;
    }

    echo json_encode($obj);
}
