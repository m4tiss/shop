<?php
include_once('../config.php');

function addCategoryToDB($conn,$productType,$nameCategory){
    $addCategory = "INSERT INTO categories(nameCategory, storeDepartament) values('$nameCategory','$productType')";
    mysqli_query($conn, $addCategory);
}
function getAllCategories($conn) {
    $getCategories = "SELECT * FROM categories";
    $categories = [];

    if ($categoriesResult = mysqli_query($conn, $getCategories)) {
        if (mysqli_num_rows($categoriesResult) > 0) {
            while ($row = mysqli_fetch_assoc($categoriesResult)) {
                $categories[] = [
                    'idCategory' => $row['idCategory'],
                    'nameCategory' => $row['nameCategory'],
                    'storeDepartament' => $row['storeDepartament'],
                ];
            }
            usort($categories, fn($a, $b) => strcmp($a['storeDepartament'], $b['storeDepartament']));
        } else {
            echo "Nie ma żadnej kategorii w bazie!";
        }
    }

    return $categories;
}

function addProducerToDB($conn,$productType,$nameProducer){
    $addProducer = "INSERT INTO producers(nameProducer, storeDepartament) values('$nameProducer','$productType')";
    mysqli_query($conn, $addProducer);
}
function getAllProducers($conn){
    $getProducers= "SELECT * FROM producers";
    $producers = array();

    if ($producersResult = mysqli_query($conn, $getProducers)) {
        if (mysqli_num_rows($producersResult) > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($producersResult)) {
                $producer = array();
                $producer['idProducer'] = $row['idProducer'];
                $producer['nameProducer'] = $row['nameProducer'];
                $producer['storeDepartament'] = $row['storeDepartament'];
                $producers[$i] = $producer;
                $i += 1;
            }
            usort($producers, function ($a, $b) {
                return strcmp($a['storeDepartament'], $b['storeDepartament']);
            });
        } else {
            echo "Nie ma żadnego producenta w bazie!";
        }
    }
    return $producers;
}

function addProductToDBAdmin($conn,$productName,$IdCategory,$IdProducer,$productDescription,$productPrice,$photoName,$discount){
    $addProduct = "INSERT INTO products(idCategory,idProducer,price,image,description,discount,nameProduct) values($IdCategory,$IdProducer,$productPrice,'$photoName','$productDescription',$discount,'$productName')";
    mysqli_query($conn, $addProduct);
}
function getCategoriesByStore($conn,$store){
    $getCategories = "SELECT * FROM categories where storeDepartament='$store'";
    $categories = array();
    if ($categoriesResult = mysqli_query($conn, $getCategories)) {
        if (mysqli_num_rows($categoriesResult) > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($categoriesResult)) {
                $category = array();
                $category['idCategory'] = $row['idCategory'];
                $category['nameCategory'] = $row['nameCategory'];
                $category['storeDepartament'] = $row['storeDepartament'];
                $categories[$i] = $category;
                $i += 1;
            }
        } else {
            echo "Nie ma kategorii w tym dziale!";
        }
    }
    return $categories;
}

function getProducersByStore($conn,$store){
    $getProducers = "SELECT * FROM producers where storeDepartament='$store'";
    $producers = array();
    if ($producersResult = mysqli_query($conn, $getProducers)) {
        if (mysqli_num_rows($producersResult) > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($producersResult)) {
                $producer = array();
                $producer['idProducer'] = $row['idProducer'];
                $producer['nameProducer'] = $row['nameProducer'];
                $producer['storeDepartament'] = $row['storeDepartament'];
                $producers[$i] = $producer;
                $i += 1;
            }
        } else {
            echo "Nie ma producentów w tym dziale!";
        }
    }
    return $producers;
}

function deleteProductFromDbAdmin($conn, $idProduct){
    $deleteProductFromDBAdmin = "DELETE FROM products WHERE idProduct=$idProduct";
    mysqli_query($conn, $deleteProductFromDBAdmin);
}


function getCategoryById($conn,$idCategory){
    $getCategory = "SELECT * FROM categories WHERE idCategory=$idCategory";
    if ($categoryResult = mysqli_query($conn, $getCategory)) {
        if (mysqli_num_rows($categoryResult) > 0) {
            $row = mysqli_fetch_assoc($categoryResult);
            $category = array();
            $category['idCategory'] = $row['idCategory'];
            $category['nameCategory'] = $row['nameCategory'];
            $category['storeDepartament'] = $row['storeDepartament'];
        } else {
            echo "Nie ma kategorii z takim ID!";
        }
    }
    return $category;
}


function getProducerById($conn,$idProducer){
    $getProducer = "SELECT * FROM producers WHERE idProducer=$idProducer";
    if ($producerResult = mysqli_query($conn, $getProducer)) {
        if (mysqli_num_rows($producerResult) > 0) {
            $row = mysqli_fetch_assoc($producerResult);
            $producer = array();
            $producer['idProducer'] = $row['idProducer'];
            $producer['nameProducer'] = $row['nameProducer'];
            $producer['storeDepartament'] = $row['storeDepartament'];
        } else {
            echo "Nie ma producenta z takim ID!";
        }
    }
    return $producer;
}

function getAllProducts($conn){
    $getProducts = "SELECT * FROM products";
    $products = array();
    if ($productResult = mysqli_query($conn, $getProducts)) {
        if (mysqli_num_rows($productResult) > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($productResult)) {
                $product = array();
                $product['idProduct'] = $row['idProduct'];
                $product['idCategory'] = $row['idCategory'];
                $product['idProducer'] = $row['idProducer'];
                $product['price'] = $row['price'];
                $product['image'] = $row['image'];
                $product['description'] = $row['description'];
                $product['nameProduct'] = $row['nameProduct'];
                $products[$i] = $product;
                $i += 1;
            }
        } else {
            echo "Nie ma żadnego produktu w bazie!";
        }
    }
    return $products;
}

function updateProductAdmin($conn,$idProduct,$productName,$productDescription,$productPrice){
    $updateProductAdmin = "UPDATE products SET nameProduct='$productName', description = '$productDescription', price = $productPrice  WHERE idProduct=$idProduct";
    mysqli_query($conn, $updateProductAdmin);
}

function getProductById($conn, $productId)
{
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
        } else {
            echo "Produkt już nie istnieje";
            exit();
        }
    }
    return $productData;
}

function deleteSizeFromDB($conn,$idSize){
    $deleteSizeFromDB = "DELETE FROM sizees WHERE idSizee=$idSize";
    mysqli_query($conn, $deleteSizeFromDB);
}

function addSizeToDB($conn,$storeDepartament,$nameSize){
    $addSize = "INSERT INTO sizees(storeDepartament,nameSizee) values('$storeDepartament','$nameSize');";
    mysqli_query($conn, $addSize);
}

function getAllSizes($conn) {
    $getSizes = "SELECT * FROM sizees";
    $sizes = array();

    $sizesResult = mysqli_query($conn, $getSizes);

    if ($sizesResult && mysqli_num_rows($sizesResult) > 0) {
        while ($row = mysqli_fetch_assoc($sizesResult)) {
            $sizes[] = [
                'idSize' => $row['idSizee'],
                'storeDepartament' => $row['storeDepartament'],
                'nameSize' => $row['nameSizee'],
            ];
        }
        usort($sizes, function ($a, $b) {
            return strcmp($a['storeDepartament'], $b['storeDepartament']);
        });
    } else {
        echo "Nie ma żadnego rozmiaru w bazie!";
    }

    return $sizes;
}

function setNewOrderStatus($conn,$idOrder,$idStatus){

    $updateStatus = "UPDATE orders SET idStatus = $idStatus Where idOrder=$idOrder";
    mysqli_query($conn, $updateStatus);
}


function getAllOrders($conn){
    $getOrders = "SELECT * FROM orders";
    $orders = array();
    if ($ordersResult = mysqli_query($conn, $getOrders)) {
        if (mysqli_num_rows($ordersResult) > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($ordersResult)) {
                $order = array();
                $order['idOrder'] = $row['idOrder'];
                $order['idPayment'] = $row['idPayment'];
                $order['idStatus'] = $row['idStatus'];
                $order['name'] = $row['surname'];
                $order['surname'] = $row['surname'];
                $order['email'] = $row['email'];
                $order['dateOrder'] = $row['dateOrder'];
                $order['cost'] = $row['cost'];
                $orders[$i] = $order;
                $i += 1;
            }
            usort($orders, function ($a, $b) {
                return $b['idOrder'] - $a['idOrder'];
            });
        } else {
            echo "Nie ma żadnych zamówień!";
        }
    }
    return $orders;
}

function getStatus($conn,$idStatus){
    $getStatus = "SELECT * FROM statuses WHERE idStatus=$idStatus";
    if ($statusResult = mysqli_query($conn, $getStatus)) {
        if (mysqli_num_rows($statusResult) > 0) {
            $row = mysqli_fetch_assoc($statusResult);
            $status = array();
            $status['idStatus'] = $row['idStatus'];
            $status['nameStatus'] = $row['nameStatus'];
        } else {
            echo "Nie ma takiego statusu w bazie!";
        }
    }
    return $status;

}

function getAllStatuses($conn){
    $getStatuses = "SELECT * FROM statuses";
    $statuses = array();

    if ($statusesResult = mysqli_query($conn, $getStatuses)) {
        if (mysqli_num_rows($statusesResult) > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($statusesResult)) {
                $status = array();
                $status['idStatus'] = $row['idStatus'];
                $status['nameStatus'] = $row['nameStatus'];
                $statuses[$i] = $status;
                $i += 1;
            }
        } else {
            echo "Nie ma żadnego statusu w bazie!";
        }
    }
    return $statuses;
}