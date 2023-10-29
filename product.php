<?php include_once('settings.php') ?>
<?php include('navbar.php'); ?>
<div class="contentContainer">
    <?php
    include_once('config.php');

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $productId = $_GET['id'];

        $getProduct = "SELECT * FROM products WHERE idProduct=$productId";

        if ($product_Result = mysqli_query($conn, $getProduct)) {
            if (mysqli_num_rows($product_Result) > 0) {
                while ($row = mysqli_fetch_assoc($product_Result)) {
                    $productName = $row['nameProduct'];
                    $productDescription = $row['description'];
                    $productPrice = $row['price'];
                    $productImage = $row['image'];
                    $productId = $row['idProduct'];
                    echo '    
                    <div class="photoAndDescription">
                     <div class="photoContainer">
                    <img src="images/' . $productImage . '" alt="' . $productName . '" width="400px">
                     </div>
                     <h2> ' . $productName . '</h2>
                    <p class="productDescription">' . $productDescription . '</p>
                     </div>
                     
                     ';
                }
            } else {
                echo "Produkt już nie istnieje";
            }
        } else {
            echo "Błąd zapytania do bazy danych: " . mysqli_error($conn);
        }
    } else {
        echo "Nieprawidłowy identyfikator produktu.";
    }
    ?>
    <?php
    include_once('config.php');
    //<!--                     Pobranie Store Departament aby móc wziąć rozmiary z tabeli sizees-->

    echo '
    <div class="rightPanel">
        <h2 class="rightPanelInfo"> ' . $productName . '</h2>
        <div class="sizes"></div>
        <h2 class="rightPanelInfo"> ' . $productPrice . '</h2>
        <button class="addToBasket">Dodaj do koszyka</button>
    </div>'

    //<!--                    $getStoreDepartament = "SELECT storeDepartament FROM categories WHERE idCategory=$productCategory";-->
    //<!---->
    //<!--                    if ($departament_Result = mysqli_query($conn, $getStoreDepartament)) {-->
    //<!---->
    //<!--                    }-->
    ?>
</div>
<?php include('footer.php'); ?>

