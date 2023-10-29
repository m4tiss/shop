<?php include_once('settings.php') ?>
<?php include('navbar.php'); ?>
<div class="contentContainer">
    <?php
    include_once('config.php');

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $productId = $_GET['id'];

        $getProduct = "SELECT * FROM products WHERE idProduct=$productId";

        if ($productResult = mysqli_query($conn, $getProduct)) {
            if (mysqli_num_rows($productResult) > 0) {
                while ($row = mysqli_fetch_assoc($productResult)) {
                    $productName = $row['nameProduct'];
                    $productDescription = $row['description'];
                    $productPrice = $row['price'];
                    $productImage = $row['image'];
                    $productId = $row['idProduct'];
                    $productCategory = $row['idCategory'];
                    echo '    
                    <div class="photoAndDescription">
                     <div class="photoContainer">
                    <img src="images/' . $productImage . '" alt="' . $productName . '" width="400px">
                     </div>
                     <h2> ' . $productName . '</h2>
                    <p class="productDescription">' . $productDescription . '</p>
                     </div>';
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
    <div class="rightPanel">

            <?php
            include_once('config.php');
            echo'<h2 class="rightPanelInfo"> ' . $productName . '</h2>
                 <div class="sizes">';

            $getStoreDepartament = "SELECT storeDepartament FROM categories WHERE idCategory=$productCategory";

            $departamentResult = mysqli_query($conn, $getStoreDepartament);
            $rows = mysqli_fetch_assoc($departamentResult);
            $departament = $rows['storeDepartament'];
            $getSizes = "SELECT nameSizee FROM sizees WHERE storeDepartament='$departament'";
            $sizeesResult = mysqli_query($conn, $getSizes);
            while ($sizeRows = mysqli_fetch_assoc($sizeesResult)) {
                $size = $sizeRows['nameSizee'];
                echo '<button class="sizeButton" >'.$size.'</button>';
            }


            echo' </div>
            <h2 class="rightPanelInfo"> ' . $productPrice . '</h2>'
            ?>
        <button class="addToBasket">Dodaj do koszyka</button>
    </div>
</div>
<?php include('footer.php'); ?>

