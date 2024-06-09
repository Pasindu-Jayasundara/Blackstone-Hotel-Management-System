<?php

require "../connection/connection.php";

if (!empty($_POST["type"])) {

    $t = $_POST["type"];

    if ($t == 1) { //breakfaset

        $q = "SELECT * FROM `dining` WHERE `dining`.`dining_category_dining_category_id`='1' AND `dining`.`status_status_id`='1'
        AND `dining`.`dining_type_dining_type_id`='1' ORDER BY RAND()";
    } else if ($t == 2) { //lunch

        $q = "SELECT * FROM `dining` WHERE `dining`.`dining_category_dining_category_id`='2' AND `dining`.`status_status_id`='1'
        AND `dining`.`dining_type_dining_type_id`='1' ORDER BY RAND()";
    } else if ($t == 3) { //diner

        $q = "SELECT * FROM `dining` WHERE `dining`.`dining_category_dining_category_id`='3' AND `dining`.`status_status_id`='1'
        AND `dining`.`dining_type_dining_type_id`='1' ORDER BY RAND()";
    } else if ($t == 4) { //drinks

        $q = "SELECT * FROM `dining` WHERE `dining_type_dining_type_id`='2' AND `dining`.`status_status_id`='1' ORDER BY RAND()";
    }

    $rs = Database::search($q);

    if ($rs->num_rows > 0) {

        for ($x = 0; $x < $rs->num_rows; $x++) {

            $data = $rs->fetch_assoc();

            $q2 = "SELECT * FROM `dining_images` WHERE `dining_images`.`dining_dining_id`='" . $data["dining_id"] . "' 
            AND `dining_images`.`status_status_id`='1'";

            $rs2 = Database::search($q2);

            $img = $rs2->fetch_assoc();

?>
            <div class="fcard p-1 text-white position-relative" data-content="Rs. <?php echo $data["price"]; ?>" style="width:200px; height:250px;">
                <img src="<?php echo $img["path"]; ?>" class="p-0 m-0" style="width:100%; height:100%; object-fit: cover; border-radius: 14px;" />
                <div class="position-absolute text-white bg-black py-2 text-center" style="font-size: 18px; bottom:0; width: 100%;border-bottom-right-radius: inherit; border-bottom-left-radius:inherit;"><?php echo $data["name"]; ?></div>
            </div>
<?php
        }
    }
} else {
    header("Location:dining.php");
}

?>