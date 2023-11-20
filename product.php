<?php include_once('settings.php') ?>
<?php include('navbar.php'); ?>
<div class="contentContainer">
    <?php
    include_once('config.php');
    include_once('functions/functionsUser.php');
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
            $category = getCategoryById($conn,$product['category']);
            $producer = getProducerById($conn,$product['idProducer']);
            echo '<h2 class="rightPanelInfo"> ' . $product['name'] . '</h2>
                  <h2 class="infoProduct">Kategoria: '.$category['nameCategory'].' </h2>
                  <h2>Producent: '.$producer['nameProducer'].' </h2>
                  <h2 class="rightPanelInfo"> Rozmiary:</h2>
                    <div class="sizesInProduct">';


            $departament = getStoreFromCategory($conn,$product['category']);
            $sizes = getSizesFromStore($conn,$departament);
            foreach ($sizes as $size){
                echo '<label>
                        <input id="idPrzyciskuRadio" type="radio" name="selectedSize" value="' . $size['nameSizee'] . '"> ' . $size['nameSizee'] . '
                       </label>';
            }
            $price = number_format($product['price'],2);
            echo ' </div>
            <h2 class="rightPanelInfo"> Cena: ' . $price . ' zł</h2>';
            if (!empty($_SESSION['users'])) {
                $user_id = $_SESSION['users'];
                $user = getUserById($conn,$user_id);
                if($user['role']!=='admin'){
                    echo '<button id="addToBasket" class="addToBasket"  onclick="changeColor();addToBasketSession(' . $product['id'] . ') ">Dodaj do koszyka</button>';
                }
            }else{
                echo '<button id="addToBasket" class="addToBasket"  onclick="changeColor();addToBasketSession(' . $product['id'] . ') ">Dodaj do koszyka</button>';
            }
            ?>
        </div>
    </div>
</div>
<script src="scripts/basket.js"></script>
<?php include('footer.php'); ?>

