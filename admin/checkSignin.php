<?php

session_start();
if (isset($_SESSION["login"]) && $_SESSION["login"] == 1) {
    echo ("1");
}
?>