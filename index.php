<?php include_once('settings.php');
include('navbar.php');
include('functions/functionsUser.php');
?>
<div>
    <div class="slider">
        <div class="slides">
            <div class="slide">
                <div class="photo">
                    <a href="content.php?store=footwear">
                        <img src="images/mainPhoto.jpg" alt="mainPhoto">
                    </a>
                </div>
            </div>
            <div class="slide">
                <a href="content.php?store=clothes">
                    <img src="images/nikeBanner.jpg" alt="nikeBanner">
                </a>
            </div>
            <div class="slide">
                <a href="content.php?store=footwear">
                    <img src="images/adidasBanner.jpg" alt="adidasBanner">
                </a>
            </div>
            <div class="slide">
                <a href="content.php?store=accessories">
                    <img src="images/justDoIt.jpg" alt="justDoIt">
                </a>
            </div>
            <div class="slide">
                <a href="content.php?store=clothes">
                    <img src="images/newB2.jpg" alt="newB2">
                </a>
            </div>
        </div>
        <div class="sliderButtons">
            <button class="sliderButton" id="prev"><</button>
            <button class="sliderButton" id="next">></button>
        </div>
    </div>

    <div class="discountText">
        <h2>KUPUJ CO CHCESZ</h2>
        <h2 class="redText">ZNIŻKA NAWET DO 25%</h2>
        <h2>WYGLĄDAJ JAK CHCESZ</h2>
    </div>

    <div class="productContainer">
        <?php
        $values = [];
        for ($i = 0; $i < 6; $i++) {
            while (true) {
                $value = mt_rand(0, 20);

                if (!in_array($value, $values) && isProductExist($conn, $value)) {
                    $values[] = $value;
                    break;
                }
            }
            $product = getProductById($conn, $value);
            echo '
            <a href="product.php?id=' . $product['id'] . '">
            <div class="productLayout">
                <div class="photoProductContainer">
                <img src="images/' . $product['image'] . '" alt="' . $product['name'] . '">
               </div>
                <div class="productInfo">
                    <h3 class="productName">' . $product['name'] . '</h3>
                    <h3 class="productPrice">' . number_format($product['price'], 2) . ' zł</h3>
                </div>
            </div>
        </a>
        ';
        }
        ?>
    </div>
</div>
<?php include('footer.php'); ?>
