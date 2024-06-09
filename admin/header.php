<?php

if (!empty($_SESSION["admin"])) {

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css" />
    <link rel="icon" href="../designImages/badgeWhite.png" />
    <link rel="stylesheet" href="../css/other/adminHeader.css"/>
</head>

<body>
    <div class="container-fluid">
        <din class="col-12">
            <div class="row d-flex flex-row justify-content-between my-4">

                <div class="bg-black ms-5"
                    style="max-width: 12vw; border-radius: 30px; display: flex; flex-direction: row; justify-content: center; align-items: center;">
                    <span class="text-white text-center fs-6 fw-bold" id="location"></span>
                </div>

                <div class="w-25 d-flex justify-content-center align-items-center" style="margin-right: -2%;">
                    <span class="me-2"><?php echo $_SESSION["admin"]["f_name"]." ".$_SESSION["admin"]["l_name"]; ?></span>
                    <div class="onlineIconParent">
                        <div class="onlineIcon">
                            <img src="<?php 
                            if($_SESSION["admin"]["url"] != "" || $_SESSION["admin"]["url"] != null){
                                echo $_SESSION["admin"]["url"];
                            }else{
                               ?>
                               ../designImages/admin.png
                               <?php
                            }
                            ?>" class="border border-1 border-danger rounded-2 userImg">
                        </div>
                    </div>
                </div>

            </div>
        </din>
    </div>

    <script src="../js/other/adminHeader.js"></script>
</body>

</html>

<?php
}else{
    header("Location:index.php");
}
?>