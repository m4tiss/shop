<?php
include_once 'config.php';
include_once 'functions.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['selectedPayment'])) {
        $selectedPayment = $_POST['selectedPayment'];
        echo "Wybrany sposób płatności ID: $selectedPayment";
    } else {

        echo "Proszę wybrać sposób płatności.";
    }
} else {
    echo "Nieprawidłowa metoda żądania.";
}
?>