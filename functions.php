<?php
include_once ('config.php');
function getProductById($conn, $productId) {
    $getProduct = "SELECT * FROM products WHERE idProduct=$productId";
    $productData = array();

    if ($productResult = mysqli_query($conn, $getProduct)) {
        if (mysqli_num_rows($productResult) > 0) {
            while ($row = mysqli_fetch_assoc($productResult)) {
                $productData['name'] = $row['nameProduct'];
                $productData['description'] = $row['description'];
                $productData['price'] = $row['price'];
                $productData['image'] = $row['image'];
                $productData['id'] = $row['idProduct'];
                $productData['category'] = $row['idCategory'];
            }
        }
        else{
            echo "Produkt już nie istnieje";
            exit();
        }
    }
    return $productData;
}