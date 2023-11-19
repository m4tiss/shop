<?php
include_once('settings.php');
include_once 'config.php';
include_once 'functions/functionsUser.php';

session_start();
$index = $_GET['index'];
if (isset($_SESSION['basket'][$index])) {
    if (!empty($_SESSION['users'])) {
        deleteProductFromDB($conn,$_SESSION['users'],$_SESSION['basket'][$index]['idProduct'],$_SESSION['basket'][$index]['size']);
    }
    unset($_SESSION['basket'][$index]);
    header("Location:basket.php");
}