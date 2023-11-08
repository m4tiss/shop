<?php
include_once('settings.php');
include('config.php');
include('functions.php');
session_start();

if (isset($_GET['idContact'])) {
    $idContact = $_GET['idContact'];
    deleteContactFromDB($conn,$idContact);
    header("Location:account.php");
}