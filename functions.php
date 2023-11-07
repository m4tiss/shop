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
function getUserById($conn,$user_id){
    $getUser = "SELECT * FROM users WHERE idUser=$user_id";
    $user = array();
    if ($userResult = mysqli_query($conn, $getUser)) {
        if (mysqli_num_rows($userResult) > 0) {
            while ($row = mysqli_fetch_assoc($userResult)) {
                $user['id'] = $row['idUser'];
                $user['name'] = $row['name'];
                $user['surname'] = $row['surname'];
                $user['password'] = $row['password'];
            }
        }
        else{
            echo "Taki użytkownik nie istnirje";
            exit();
        }
    }
    return $user;
}

function getContactsById($conn,$user_id){
    $getContacts = "SELECT * FROM contacts WHERE idUser=$user_id";
    $contacts= array();
    if ($contactsResult = mysqli_query($conn, $getContacts)) {
        if (mysqli_num_rows($contactsResult) > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($contactsResult)) {
                $contact = array();
                $contact['email'] = $row['email'];
                $contact['phoneNumber'] = $row['phoneNumber'];
                $contacts[$i] = $contact;
                $i+=1;
            }
        }
        else{
            echo "Nie masz żadnego konatktu! Dodaj nowy";
            exit();
        }
    }
    return $contacts;
}

function getAddressesById($conn,$user_id){
    $getAddresses = "SELECT * FROM addresses WHERE idUser=$user_id";
    $addresses= array();
    if ($addressesResult = mysqli_query($conn, $getAddresses)) {
        if (mysqli_num_rows($addressesResult) > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($addressesResult)) {
                $address = array();
                $address['city'] = $row['city'];
                $address['zipCode'] = $row['zipCode'];
                $address['street'] = $row['street'];
                $address['streetNumber'] = $row['streetNumber'];
                $addresses[$i] = $address;
                $i+=1;
            }
        }
        else{
            echo "Nie masz żadnego adresu! Dodaj nowy";
        }
    }
    return $addresses;
}