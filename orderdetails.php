<?php
include_once('settings.php');
include_once 'config.php';
include('navbar.php');
include_once 'functions.php';
session_start();

if (empty($_SESSION['users'])) {
    header("Location: login.php");
    exit();
}

if(isset($_GET['idOrder'])){
    $idOrder = $_GET['idOrder'];
    echo $idOrder;
}
?>



zamówionko

<?php include('footer.php'); ?>
