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


function getProductsFromBasket($conn, $userId) {
    $getProducts = "SELECT * FROM baskets WHERE idUser=$userId";
    $productsData = array();

    if ($productResult = mysqli_query($conn, $getProducts)) {
        if (mysqli_num_rows($productResult) > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($productResult)) {
                $productData = array();
                $productData['idUser'] = $row['idUser'];
                $productData['idProduct'] = $row['idProduct'];
                $productData['amount'] = $row['amount'];
                $productData['sizee'] = $row['sizee'];
                $productsData[$i] = $productData;
                $i+=1;
            }
        }
        else{
            echo "Produkt już nie istnieje";
            exit();
        }
    }
    return $productsData;
}

function updateProductInDB($conn, $amount,$user_id,$idProduct,$size) {
    $updateProductInDB = "UPDATE baskets SET amount=$amount WHERE idUser=$user_id and  idProduct=$idProduct and sizee=$size";
    mysqli_query($conn, $updateProductInDB);
}

function addProductToDB($conn, $amount,$user_id,$idProduct,$size) {
    $insertProductToDB = "INSERT INTO baskets (idUser, idProduct,amount,sizee) VALUES ('$user_id', '$idProduct','$amount','$size')";
    mysqli_query($conn, $insertProductToDB);
}
function deleteProductFromDB($conn,$user_id,$idProduct,$size){
    $deleteProductFromDB = "DELETE FROM baskets WHERE idUser=$user_id and  idProduct=$idProduct and sizee='$size' ";
    mysqli_query($conn, $deleteProductFromDB);
}

function deleteAllFromDB($conn,$user_id){
    $deleteAllFromDB = "DELETE FROM baskets WHERE idUser=$user_id";
    mysqli_query($conn, $deleteAllFromDB);
}