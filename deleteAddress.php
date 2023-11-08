<?php
include_once('settings.php');
include('config.php');
include('functions.php');
session_start();

if (isset($_GET['id'])) {
    $idAddress = $_GET['id'];
    deleteAddressFromDB($conn,$idAddress);
    header("Location:account.php");
}
