<?php

session_start();
$_SESSION["admin"] = null;
$_SESSION["login"] = null;

session_unset();
session_destroy();

?>