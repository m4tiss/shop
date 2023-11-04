<?php include_once('settings.php')?>
<?php include('navbar.php');

session_start();
if (isset($_SESSION['basket']) && is_array($_SESSION['basket'])) {
    // Iteruj przez każdy element w tablicy sesji 'basket'
    foreach ($_SESSION['basket'] as $index => $productInfo) {
        // Wyświetl informacje o produkcie z sesji
        $idProduct = $productInfo['idProduct'];
        $size = $productInfo['size'];
        $quantity = $productInfo['quantity'];

        echo "Indeks: $index<br>";
        echo "ID Produktu: $idProduct<br>";
        echo "Rozmiar: $size<br>";
        echo "Ilość: $quantity<br>";
    }
} else {
    echo "Koszyk jest pusty.";
}

?>
<div class="mainBasketContainer">

    <div class="elementsBasketContainer">
        <div class="elementBasket">
        <div class="photoContainerBasket">
            <img src="images/ultraboost20.jpg" width="200px"/>
        </div>
            <h2>Adidas ultraboost</h2>
            <h2>250,00 zł</h2>
            <h2>Rozmiar:39</h2>
            <h2>Ilość:1</h2>
            <img src="images/xIcon.png" width="50px"/>
        </div>

        <div class="elementBasket">

        </div>
        <div class="elementBasket">

        </div>
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
