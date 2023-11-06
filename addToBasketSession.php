<?php
include_once 'config.php';
include_once 'functions.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idProduct']) && isset($_POST['size'])) {

    $idProduct = $_POST['idProduct'];
    $size = $_POST['size'];

    if (!isset($_SESSION['basket'])) {
        $_SESSION['basket'] = array();
    }

    $index = $idProduct . $size;

    if (array_key_exists($index, $_SESSION['basket']) && $_SESSION['basket'][$index]['size'] === $size) {
        $_SESSION['basket'][$index]['quantity'] += 1;
        if (!empty($_SESSION['users'])) {
            updateProductInDB($conn,$_SESSION['basket'][$index]['quantity'],$_SESSION['users'],$idProduct,$size);
        }
    } else {
        $_SESSION['basket'][$index] = array(
            'idProduct' => $idProduct,
            'size' => $size,
            'quantity' => 1
        );

        if (!empty($_SESSION['users'])) {
            addProductToDB($conn,$_SESSION['basket'][$index]['quantity'],$_SESSION['users'],$idProduct,$size);
        }

    }
}