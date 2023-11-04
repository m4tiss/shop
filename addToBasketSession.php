<?php
include_once 'config.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idProduct']) && isset($_POST['size'])) {

    $idProduct = $_POST['idProduct'];
    $size = $_POST['size'];
    $getProduct = "SELECT * FROM products WHERE idProduct= $idProduct ";

    if (!isset($_SESSION['basket'])) {
        $_SESSION['basket'] = array();
    }

    $index = $idProduct . $size;

    if (array_key_exists($index, $_SESSION['basket']) && $_SESSION['basket'][$index]['size'] === $size) {
        $_SESSION['basket'][$index]['quantity'] += 1;
    } else {
        $_SESSION['basket'][$index] = array(
            'idProduct' => $idProduct,
            'size' => $size,
            'quantity' => 1
        );
    }
}