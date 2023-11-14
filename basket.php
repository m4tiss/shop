<?php include_once('settings.php') ?>
<?php include('navbar.php');
include_once('config.php');
include_once('functions.php');
session_start();
?>
<div class="mainBasketContainer">
    <div class="elementsBasketContainer">
        <?php
        if (isset($_SESSION['basket']) && is_array($_SESSION['basket'])) {
            $totalSum = 0;
            $delivery = 9.99;
            foreach ($_SESSION['basket'] as $index => $productInfo) {
                $idProduct = $productInfo['idProduct'];
                $size = $productInfo['size'];
                $quantity = $productInfo['quantity'];
                $product = getProductById($conn, $idProduct);

                echo '  <div class="elementBasket">
                            <div class="photoContainerBasket">
                                <img src="images/' . $product['image'] . '" width="100px" />
                            </div>
                            <h2>' . $product['name'] . '</h2>
                            <h2>Cena:' . ($product['price'] * $quantity) . ' zł</h2>
                            <h2>Rozmiar: ' . $size . '</h2>
                            <h2>Ilość:' . $quantity . '</h2>
                            <a href="deleteFromBasketSession.php?index='.$product['id'].''.$size.'">
                            <img class="XIcon" src="images/xIcon.png" width="50px"/>
                            </a>
                           </div>';
                $totalSum += $product['price'] * $quantity;
            }
            if($totalSum > 0){
                echo '<div class="paymentSummary">
                <h2>Podsumowanie Zamówienia</h2>
                <h3>Produkty: ' . $totalSum . ' zł</h3>
                <h3>Dostawa: ' . $delivery . ' zł</h3>
                <h3>Suma: ' . ($totalSum + $delivery) . '</h3>
                <a href="chooseContactAndAddress.php"><button class="button">Wybierz kontakt i adres</button></a>
             </div>';
            }else{
                echo '<h2>Koszyk jest pusty</h2>';
            }
        } else {
            echo '<h2>Koszyk jest pusty</h2>';
        }
        ?>

    </div>
</div>
<script src="basket.js"></script>
<?php include('footer.php'); ?>
