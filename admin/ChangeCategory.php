<?php
require "../connection/connection.php";
$number = $_POST["id"];


if ($number == 1) {

    $category_rs = Database::search("SELECT * FROM `dining_category` WHERE `dining_category_id` = '3' ");
    $category_num = $category_rs->num_rows;

    for ($x = 0; $x < $category_num; $x++) {
        $category_data = $category_rs->fetch_assoc();

?>
        <label for="" class="text-white-50 fs-1 "><?php echo $category_data["category"] ?></label>
        <hr>

        <?php
        $item_rs = Database::search("SELECT * FROM `dining` INNER JOIN `dining_images` ON
        `dining_images`.`Food_id` = `dining`.`Food_id`
         WHERE `dining_category_dining_category_id` = '" . $category_data["dining_category_id"] . "' ");
        $item_num = $item_rs->num_rows;

        for ($y = 0; $y < $item_num; $y++) {
            $item_data = $item_rs->fetch_assoc();

        ?>
            <div class="col-lg-2 col-5  ItemBorder overlayX">
                <div class="row">
                    <img src="<?php echo $item_data["path"] ?>" class="foodImage">
                    <div class="col-2">
                        <img src="images/blackstoneWhite.jpeg" class="blackstoneImage">
                    </div>
                    <div class="col-10">
                        <label class="mx-2 text-white mt-1"> <?php echo $item_data["name"] ?></label><br>
                        <Span style="color: white;">price :-</Span>
                        <label class="" style="color: #5f5fff;"> Rs<?php echo $item_data["price"] ?></label>
                    </div>
                </div>
            </div>
        <?php

        }

        ?>
<?php

    }





} else if ($number == 2) {

    $category_rs = Database::search("SELECT * FROM `dining_category` WHERE `dining_category_id` = '4' ");
    $category_num = $category_rs->num_rows;

    for ($x = 0; $x < $category_num; $x++) {
        $category_data = $category_rs->fetch_assoc();

?>
        <label for="" class="text-white-50 fs-1 "><?php echo $category_data["category"] ?></label>
        <hr>

        <?php
        $item_rs = Database::search("SELECT * FROM `dining` INNER JOIN `dining_images` ON
        `dining_images`.`Food_id` = `dining`.`Food_id`
         WHERE `dining_category_dining_category_id` = '" . $category_data["dining_category_id"] . "' ");
        $item_num = $item_rs->num_rows;

        for ($y = 0; $y < $item_num; $y++) {
            $item_data = $item_rs->fetch_assoc();

        ?>
            <div class="col-lg-2 col-5  ItemBorder overlayX">
                <div class="row">
                    <img src="<?php echo $item_data["path"] ?>" class="foodImage">
                    <div class="col-2">
                        <img src="images/blackstoneWhite.jpeg" class="blackstoneImage">
                    </div>
                    <div class="col-10">
                        <label class="mx-2 text-white mt-1"> <?php echo $item_data["name"] ?></label><br>
                        <Span style="color: white;">price :-</Span>
                        <label class="" style="color: #5f5fff;"> Rs<?php echo $item_data["price"] ?></label>
                    </div>
                </div>
            </div>
        <?php

        }

        ?>
<?php

    }





} else if ($number == 3) {


    $category_rs = Database::search("SELECT * FROM `dining_category` WHERE `dining_category_id` = '2' ");
    $category_num = $category_rs->num_rows;

    for ($x = 0; $x < $category_num; $x++) {
        $category_data = $category_rs->fetch_assoc();

?>
        <label for="" class="text-white-50 fs-1 "><?php echo $category_data["category"] ?></label>
        <hr>

        <?php
        $item_rs = Database::search("SELECT * FROM `dining` INNER JOIN `dining_images` ON
        `dining_images`.`Food_id` = `dining`.`Food_id`
         WHERE `dining_category_dining_category_id` = '" . $category_data["dining_category_id"] . "' ");
        $item_num = $item_rs->num_rows;

        for ($y = 0; $y < $item_num; $y++) {
            $item_data = $item_rs->fetch_assoc();

        ?>
            <div class="col-lg-2 col-5  ItemBorder overlayX">
                <div class="row">
                    <img src="<?php echo $item_data["path"] ?>" class="foodImage">
                    <div class="col-2">
                        <img src="images/blackstoneWhite.jpeg" class="blackstoneImage">
                    </div>
                    <div class="col-10">
                        <label class="mx-2 text-white mt-1"> <?php echo $item_data["name"] ?></label><br>
                        <Span style="color: white;">price :-</Span>
                        <label class="" style="color: #5f5fff;"> Rs<?php echo $item_data["price"] ?></label>
                    </div>
                </div>
            </div>
        <?php

        }

        ?>
<?php

    }






} else if ($number == 4) {

    $category_rs = Database::search("SELECT * FROM `dining_category` WHERE `dining_category_id` = '1' ");
    $category_num = $category_rs->num_rows;

    for ($x = 0; $x < $category_num; $x++) {
        $category_data = $category_rs->fetch_assoc();

?>
        <label for="" class="text-white-50 fs-1 "><?php echo $category_data["category"] ?></label>
        <hr>

        <?php
        $item_rs = Database::search("SELECT * FROM `dining` INNER JOIN `dining_images` ON
        `dining_images`.`Food_id` = `dining`.`Food_id`
         WHERE `dining_category_dining_category_id` = '" . $category_data["dining_category_id"] . "' ");
        $item_num = $item_rs->num_rows;

        for ($y = 0; $y < $item_num; $y++) {
            $item_data = $item_rs->fetch_assoc();

        ?>
            <div class="col-lg-2 col-5  ItemBorder overlayX">
                <div class="row">
                    <img src="<?php echo $item_data["path"] ?>" class="foodImage">
                    <div class="col-2">
                        <img src="images/blackstoneWhite.jpeg" class="blackstoneImage">
                    </div>
                    <div class="col-10">
                        <label class="mx-2 text-white mt-1"> <?php echo $item_data["name"] ?></label><br>
                        <Span style="color: white;">price :-</Span>
                        <label class="" style="color: #5f5fff;"> Rs<?php echo $item_data["price"] ?></label>
                    </div>
                </div>
            </div>
        <?php

        }

        ?>
<?php

    }



}

?>