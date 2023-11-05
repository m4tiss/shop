<?php
include_once('settings.php');
include_once 'config.php';

session_start();
$index = $_GET['index'];
if (isset($_SESSION['basket'][$index])) {
    unset($_SESSION['basket'][$index]);
    header("Location:basket.php");
}