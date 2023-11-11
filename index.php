<?php include_once('settings.php');
include('navbar.php');
include('functions.php');

?>
<div>
    <div class="mainPhoto">
        <a href="content.php">
            <img src="images/mainPhoto.jpg" alt="mainPhoto">
        </a>
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
                    $value = mt_rand(0, 10);

                    if (!in_array($value, $values) && isProductExist($conn, $value)) {
                        $values[] = $value;
                        break;
                    }
                }
            $product = getProductById($conn,$value);
            echo'
            <a href="product.php?id=' . $product['id'] . '">
            <div class="productLayout">
                <div class="photoProductContainer">
                <img src="images/' . $product['image'] . '" alt="' . $product['name'] . '">
               </div>
                <div class="productInfo">
                    <h3 class="productName">' . $product['name'] . '</h3>
                    <h3 class="productPrice">' . $product['price'] . ' zł</h3>
                </div>
            </div>
        </a>
        ';
        }
        ?>
    </div>
</div>
<?php include('footer.php'); ?>
