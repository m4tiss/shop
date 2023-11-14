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
}
?>

<div class="ordersDetailsContainer">
    <div class="ordersDetails">
        <h2>Szczegóły zamówienia</h2>
        <?php
        $order = getOrderById($conn,$idOrder);
        $products = getProductsFromOrder($conn,$idOrder);
        $paymentMethod = getPaymentMethod($conn,$order['idPayment']);
        $status = getStatus($conn,$order['idStatus']);
        $totalSum = 0;
        $delivery = 9.99;

        echo '
        <div class="paymentDiv">
        <h3>Metoda płatności:</h3><img src="icons/'.$paymentMethod['icon'].'" width="100px">
        </div>
        ';

        echo'
        <div class="statusDiv">
        <h3>Status Zamówienia:</h3><h3>'.$status['nameStatus'].'</h3>
        </div>
        ';


        foreach ($products as $product){
            echo '
      <div class="orderDetails">
            <img src="images/' . $product['image'] . '" width="100px">
             <h2>' . $product['name'] . '</h2>
                            <h2>Cena:' . ($product['price'] * $product['amount']) . ' zł</h2>
                            <h2>Rozmiar: ' . $product['size'] . '</h2>
                            <h2>Ilość:' . $product['amount'] . '</h2>
        </div>
        ';
            $totalSum += $product['price'] * $product['amount'];
        }
        $totalSum+=$delivery;
        echo'
        <h3>Dostawa: '.$delivery.'</h3>
         <h3>Łączny koszt zamówienia: '.$totalSum.'</h3>
        ';
        ?>
    </div>
</div>




<?php include('footer.php'); ?>
