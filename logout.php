<?php
session_start();
ob_start();
require_once "functions.php";
$user = new LogingRegistration();
$user->logOutUser();
header("Location: login.php?response=1");
exit();
?>