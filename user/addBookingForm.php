<?php

session_start();
require "../connection/connection.php";

if (
    !empty($_POST["refNo"]) 
    && !empty($_POST["email"]) 
    && !empty($_POST["nic"]) 
    && !empty($_POST["fname"]) 
    && !empty($_POST["lname"]) 
    && !empty($_POST["surname"])
    && !empty($_POST["mobile"]) 
    && !empty($_POST["nopa"]) 
    && !empty($_POST["arr"]) 
    && !empty($_POST["de"])
    && !empty($_POST["rt"]) 
    && !empty($_POST["mp"]) 
    && trim($_POST["refNo"]) != "" 
    && trim($_POST["email"]) != "" 
    && filter_var(
        $_POST["email"],
        FILTER_VALIDATE_EMAIL
    )
    && trim($_POST["nic"]) != "" 
    && trim($_POST["fname"]) != "" 
    && trim($_POST["lname"]) != "" 
    && $_POST["surname"] != 0 
    && trim($_POST["mobile"]) != "" 
    && $_POST["nopa"] > 0
    && $_POST["nopc"] >= 0 
    && strtotime($_POST["arr"]) >= strtotime("today") 
    && strtotime($_POST["de"]) >= strtotime("today")
    && $_POST["rt"] > 0 
    && $_POST["mp"] > 0
) {


    $refNo = $_POST["refNo"];
    $surname = $_POST["surname"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $mobile = $_POST["mobile"];
    $nic = $_POST["nic"];
    $email = $_POST["email"];
    $nopa = $_POST["nopa"];
    $nopc = $_POST["nopc"];
    $arr = $_POST["arr"];
    $de = $_POST["de"];
    $rt = $_POST["rt"];
    $mp = $_POST["mp"];

    $_SESSION["bf_ref"] = $refNo;
    $_SESSION["bf_email"] = $email;

    Database::iud("INSERT INTO `registered_guest`(`surname_surname_id`,`f_name`,`l_name`,`mobile`,`nic`,`email`,`adult_count`
        ,`child_count`,`arrival_date_time`,`depature_date_time`,`ref_number`) 
        VALUES('" . $surname . "','" . $fname . "','" . $lname . "','" . $mobile . "','" . $nic . "','" . $email . "','" . $nopa . "','" . $nopc . "','" . $arr . "','" . $de . "','" . $refNo . "')");

    $last_id = Database::$db_connection->insert_id;

    Database::iud("INSERT INTO `registered_guest_has_meal_plan`(`registered_guest_registered_guest_id`,`meal_plan_meal_plan_id`) 
    VALUES('".$last_id."','".$mp."')");

    Database::iud("INSERT INTO `registered_guest_has_room_type`(`registered_guest_registered_guest_id`,`room_type_room_type_id`) 
    VALUES('".$last_id."','".$rt."')");

    if (!empty($_POST["passport"])) {
        $passport = $_POST["passport"];

        Database::iud("UPDATE `registered_guest` SET `passport`='" . $passport . "' WHERE `registered_guest_id`='" . $last_id . "'");
    }

    if (!empty($_POST["address"])) {
        $address = $_POST["address"];
    
        $lastDelimiterPos = strrpos($address, ","); // Find the position of the last comma
    
        if ($lastDelimiterPos !== false) {
            $line1 = trim(substr($address, 0, $lastDelimiterPos)); // Extract line 1
            $line2 = trim(substr($address, $lastDelimiterPos + 1)); // Extract line 2
        } else {
            // Handle the case when there is no delimiter found
            $line1 = trim($address); // Assume the entire address is line 1
            $line2 = ""; // Set line 2 as an empty string or handle it as per your requirements
        }
    
        $escapedLine1 = mysqli_real_escape_string(Database::$db_connection, $line1);
        $escapedLine2 = mysqli_real_escape_string(Database::$db_connection, $line2);
    
        Database::iud("UPDATE `registered_guest` SET `line_1`='$escapedLine1', `line_2`='$escapedLine2' WHERE `registered_guest_id`='$last_id'");
    }
    
    if (!empty($_POST["country"])) {
        $country = $_POST["country"];

        Database::iud("UPDATE `registered_guest` SET `country_country_id`='" . $country . "' WHERE `registered_guest_id`='" . $last_id . "'");
    }
    if (!empty($_POST["nationality"])) {
        $nationality = $_POST["nationality"];

        Database::iud("UPDATE `registered_guest` SET `nationality_nationality_id`='" . $nationality . "' WHERE `registered_guest_id`='" . $last_id . "'");
    }
    if (!empty($_POST["religion"])) {
        $religion = $_POST["religion"];

        Database::iud("UPDATE `registered_guest` SET `religion_religion_id`='" . $religion . "' WHERE `registered_guest_id`='" . $last_id . "'");
    }
    if (!empty($_POST["ta"])) {
        $ta = $_POST["ta"];

        Database::iud("UPDATE `registered_guest` SET `travel_agent`='" . $ta . "' WHERE `registered_guest_id`='" . $last_id . "'");
    }

    echo "1";
} else {
    echo "2";
}
?>