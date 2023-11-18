<?php include_once('settings.php') ?>
<?php include('navbar.php'); ?>
<div class="contentContainer">
    <?php
    include_once('config.php');
    include_once('functions.php');
    session_start();


    if (!empty($_GET['id'])) {
        $productId = $_GET['id'];
        $product = getProductById($conn, $productId);
        echo '    
                    <div class="photoAndDescription">
                     <div class="photoContainer">
                    <img src="images/' . $product['image'] . '" alt="' . $product['name']. '" width="400px">
                     </div>
                     <h2 class="nameProductUnderPhoto" > ' . $product['name'] . '</h2>
                    <p class="productDescription">' . $product['description']. '</p>
                     </div>';

    } else {
        echo "Nieprawidłowy identyfikator produktu.";
    }
    ?>
    <div class="rightPanel">
        <div class="rightPanelDetails">
            <?php
            echo '<h2 class="rightPanelInfo"> ' . $product['name'] . '</h2>
                    <h2 class="rightPanelInfo"> Rozmiary:</h2>
                 <div class="sizes">';


            $getStoreDepartament = "SELECT storeDepartament FROM categories WHERE idCategory={$product['category']}";

            $departamentResult = mysqli_query($conn, $getStoreDepartament);
            $rows = mysqli_fetch_assoc($departamentResult);
            $departament = $rows['storeDepartament'];
            $getSizes = "SELECT nameSizee FROM sizees WHERE storeDepartament='$departament'";
            $sizeesResult = mysqli_query($conn, $getSizes);
            while ($sizeRows = mysqli_fetch_assoc($sizeesResult)) {
                $size = $sizeRows['nameSizee'];
                echo '<label>
                    <input id="idPrzyciskuRadio" type="radio" name="selectedSize" value="' . $size . '"> ' . $size . '
                </label>';
            }
            $price = number_format($product['price'],2);
            echo ' </div>
            <h2 class="rightPanelInfo"> Cena: ' . $price . ' zł</h2>';

            echo '<button id="addToBasket" class="addToBasket"  onclick="changeColor();addToBasketSession(' . $product['id'] . ') ">Dodaj do koszyka</button>'
            ?>
        </div>
    </div>
</div>
<script src="basket.js"></script>
<?php include('footer.php'); ?>

