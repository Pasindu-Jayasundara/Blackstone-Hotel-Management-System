<?php

session_start();
require "../connection/connection.php";

require "../connection/SMTP.php";
require "../connection/PHPMailer.php";
require "../connection/Exception.php";
require "../connection/OAuth.php";
require "../connection/POP3.php";

use PHPMailer\PHPMailer\PHPMailer;

if (!empty($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) && !empty($_POST["id"])) {
    $email = $_POST["email"];
    $id = $_POST["id"];

    $obj = new stdClass();
    $obj->email = $email;
    $obj->name = $name;
    $obj->nicStatus = 2;
    $obj->arrStatus = 2;
    $obj->deStatus = 2;

    $jobj = json_encode($obj);

    $encryptionKey = "Pasindu328@Bhathiya";
    $iv = "Pasindu328@Bhath";
    $ciphertext = urlencode(openssl_encrypt($jobj, 'AES-256-CBC', $encryptionKey, 0, $iv));

    $shop_rs = Database::search("SELECT * FROM `hotel`");
    $shop_data = $shop_rs->fetch_assoc();

    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $shop_data["email"];
    $mail->Password = $shop_data["app_password_code"];
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom($shop_data["email"], 'Booking Form');
    $mail->addReplyTo($shop_data["email"], 'Boooking Form');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'Booking Form';
    $bodyContent = "You can find the booking form link <a href='http://localhost/blackstone_code/user/guest_registration_form.php?jobj=" . $ciphertext . "'>here</a>";
    $mail->Body = $bodyContent;


    if ($mail->send()) {
        // echo("Credentials Emailed Successfully");
        echo ("1");
    } else {
        // echo("Credentials Email Process Faild");
        echo ("2");
    }

}else{
    echo("3");
}
?>