<?php
include_once('settings.php');
include_once 'config.php';
include('navbar.php');
include_once 'functions.php';
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['selectedPayment'])) {
        $selectedPayment = $_POST['selectedPayment'];
        $idUser = $_SESSION['users'];

        $user = getUserById($conn,$idUser);
        $contacts = getContactsById($conn,$idUser);
        $idOrder = addOrderToDB($conn,$selectedPayment,1,$user['name'],$user['surname'],$contacts[0]['email'],0);
        $totalValue = 0;
        $delivery = 9.99;

        $products = getProductsFromBasket($conn,$idUser);
        foreach ($products as $product){
            $productDetails = getProductById($conn,$product['idProduct']);
            $totalValue+=($product['amount']*$productDetails['price']);
            addOrderDetailsToDB($conn,$idOrder,$productDetails['name'],$product['amount'],$productDetails['price'],$product['sizee']);
        }
        $totalValue+=$delivery;
        setOrderTotalCost($conn,$idOrder,$totalValue);
        unset($_SESSION['basket']);
        $_SESSION['basket'] = array();

    } else {
        echo "Proszę wybrać sposób płatności.";
    }
} else {
    echo "Nieprawidłowa metoda żądania.";
}

?>

<div class="orderContainer">
    <div class="confirmedIcon">
        <img src="images/confirmed.png" width="100px">
    </div>
    <div class="communicate">
        Zamówienie zostało zrealizowane!<br>Sprawdź jego status w historii zamówień
    </div>

</div>

<?php include('footer.php'); ?>

