<?php include_once('settings.php') ?>
<?php include('navbar.php');
include_once ('config.php');
include_once ('functions.php');
session_start();
?>
<div class="mainBasketContainer">
    <div class="elementsBasketContainer">
        <?php
        if (isset($_SESSION['basket']) && is_array($_SESSION['basket'])) {
            foreach ($_SESSION['basket'] as $index => $productInfo) {
                $idProduct = $productInfo['idProduct'];
                $size = $productInfo['size'];
                $quantity = $productInfo['quantity'];

                $product = getProductById($conn,$idProduct);

                echo '  <div class="elementBasket">
                            <div class="photoContainerBasket">
                                <img src="images/'.$product['image'].'" width="100px" />
                            </div>
                            <h2>'.$product['name'].'</h2>
                            <h2>Cena:'.($product['price']*$quantity).' zł</h2>
                            <h2>Rozmiar: '.$size.'</h2>
                            <h2>Ilość:'.$quantity.'</h2>
                            <img src="images/xIcon.png" width="50px"/>
                           </div>';
            }
        } else {
            echo "Koszyk jest pusty.";
        }

        ?>

        <div class="paymentSummary">
            <h2>Podsumowanie Zamówienia</h2>
            <h3>Produkty: 400 zł</h3>
            <h3>Dostawa: 9,99 zł</h3>
            <h3>Suma: 409,99 zł</h3>
            <button class="button">Przejdź do płatności</button>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
