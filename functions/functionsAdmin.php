<?php
include_once('../config.php');
function addCategoryToDB($conn, $productType, $nameCategory)
{
    $addCategory = "INSERT INTO categories(nameCategory, storeDepartament) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $addCategory);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $nameCategory, $productType);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
}
function getAllCategories($conn): array
{
    $getCategories = "SELECT * FROM categories";
    $categories = [];
    $stmt = mysqli_prepare($conn, $getCategories);
    if ($stmt) {
        mysqli_stmt_execute($stmt);
        $categoriesResult = mysqli_stmt_get_result($stmt);
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
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }

    return $categories;
}
function addProducerToDB($conn, $productType, $nameProducer)
{
    $addProducer = "INSERT INTO producers (nameProducer, storeDepartament) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $addProducer);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $nameProducer, $productType);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
}
function getAllProducers($conn): array
{
    $getProducers = "SELECT * FROM producers";
    $producers = array();
    $stmt = mysqli_prepare($conn, $getProducers);
    if ($stmt) {
        mysqli_stmt_execute($stmt);
        $producersResult = mysqli_stmt_get_result($stmt);

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
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
    return $producers;
}
function addProductToDBAdmin($conn, $productName, $IdCategory, $IdProducer, $productDescription, $productPrice, $photoName, $discount)
{
    $addProduct = "INSERT INTO products(idCategory, idProducer, price, image, description, discount, nameProduct) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $addProduct);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "iidssds", $IdCategory, $IdProducer, $productPrice, $photoName, $productDescription, $discount, $productName);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
}
function getCategoriesByStore($conn, $store): array
{
    $getCategories = "SELECT * FROM categories WHERE storeDepartament=?";
    $categories = array();
    $stmt = mysqli_prepare($conn, $getCategories);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $store);
        mysqli_stmt_execute($stmt);
        $categoriesResult = mysqli_stmt_get_result($stmt);

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
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }

    return $categories;
}

function getProducersByStore($conn, $store): array
{
    $getProducers = "SELECT * FROM producers WHERE storeDepartament=?";
    $stmt = mysqli_prepare($conn, $getProducers);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $store);
        mysqli_stmt_execute($stmt);
        $producersResult = mysqli_stmt_get_result($stmt);
        $producers = array();
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
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
    return $producers;
}

function deleteProductFromDbAdmin($conn, $idProduct)
{
    $deleteProductFromDBAdmin = "DELETE FROM products WHERE idProduct=?";
    $stmt = mysqli_prepare($conn, $deleteProductFromDBAdmin);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $idProduct);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
}

function getCategoryById($conn, $idCategory): array
{
    $getCategory = "SELECT * FROM categories WHERE idCategory=?";
    $stmt = mysqli_prepare($conn, $getCategory);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $idCategory);
        mysqli_stmt_execute($stmt);
        $categoryResult = mysqli_stmt_get_result($stmt);
        $category = array();
        if (mysqli_num_rows($categoryResult) > 0) {
            $row = mysqli_fetch_assoc($categoryResult);
            $category['idCategory'] = $row['idCategory'];
            $category['nameCategory'] = $row['nameCategory'];
            $category['storeDepartament'] = $row['storeDepartament'];
        } else {
            echo "Nie ma kategorii z takim ID!";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
    return $category;
}

function getProducerById($conn, $idProducer): array
{
    $getProducer = "SELECT * FROM producers WHERE idProducer=?";
    $stmt = mysqli_prepare($conn, $getProducer);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $idProducer);
        mysqli_stmt_execute($stmt);
        $producerResult = mysqli_stmt_get_result($stmt);
        $producer = array();
        if (mysqli_num_rows($producerResult) > 0) {
            $row = mysqli_fetch_assoc($producerResult);
            $producer['idProducer'] = $row['idProducer'];
            $producer['nameProducer'] = $row['nameProducer'];
            $producer['storeDepartament'] = $row['storeDepartament'];
        } else {
            echo "Nie ma producenta z takim ID!";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
    return $producer;
}

function getAllProducts($conn): array
{
    $getProducts = "SELECT * FROM products";
    $stmt = mysqli_prepare($conn, $getProducts);
    if ($stmt) {
        mysqli_stmt_execute($stmt);
        $productResult = mysqli_stmt_get_result($stmt);
        $products = array();
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
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
    return $products;
}

function updateProductAdmin($conn, $idProduct, $productName, $productDescription, $productPrice)
{
    $updateProductAdmin = "UPDATE products SET nameProduct=?, description=?, price=? WHERE idProduct=?";
    $stmt = mysqli_prepare($conn, $updateProductAdmin);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssdi", $productName, $productDescription, $productPrice, $idProduct);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
}

function getProductById($conn, $productId)
{
    $getProduct = "SELECT * FROM products WHERE idProduct=?";
    $stmt = mysqli_prepare($conn, $getProduct);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $productId);
        mysqli_stmt_execute($stmt);
        $productResult = mysqli_stmt_get_result($stmt);
        $productData = array();
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
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
    return $productData;
}

function deleteSizeFromDB($conn, $idSize)
{
    $deleteSizeFromDB = "DELETE FROM sizees WHERE idSizee=?";
    $stmt = mysqli_prepare($conn, $deleteSizeFromDB);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $idSize);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
}

function addSizeToDB($conn, $storeDepartament, $nameSize)
{
    $addSize = "INSERT INTO sizees (storeDepartament, nameSizee) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $addSize);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $storeDepartament, $nameSize);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
}

function getAllSizes($conn): array
{
    $getSizes = "SELECT * FROM sizees";
    $stmt = mysqli_prepare($conn, $getSizes);
    if ($stmt) {
        mysqli_stmt_execute($stmt);
        $sizesResult = mysqli_stmt_get_result($stmt);
        if ($sizesResult && mysqli_num_rows($sizesResult) > 0) {
            $sizes = array();
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
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
    return $sizes;
}

function setNewOrderStatus($conn, $idOrder, $idStatus)
{
    $updateStatus = "UPDATE orders SET idStatus = ? WHERE idOrder = ?";
    $stmt = mysqli_prepare($conn, $updateStatus);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ii", $idStatus, $idOrder);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
}

function getAllOrders($conn): array
{
    $getOrders = "SELECT idOrder, idPayment, idStatus, name, surname, email, dateOrder, cost FROM orders";
    $orders = array();
    $stmt = mysqli_prepare($conn, $getOrders);
    if ($stmt) {
        mysqli_stmt_execute($stmt);
        $ordersResult = mysqli_stmt_get_result($stmt);
        if ($ordersResult && mysqli_num_rows($ordersResult) > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($ordersResult)) {
                $order = array();
                $order['idOrder'] = $row['idOrder'];
                $order['idPayment'] = $row['idPayment'];
                $order['idStatus'] = $row['idStatus'];
                $order['name'] = $row['name'];
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
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
    return $orders;
}

function getStatus($conn, $idStatus): array
{
    $getStatus = "SELECT idStatus, nameStatus FROM statuses WHERE idStatus = ?";
    $status = array();
    $stmt = mysqli_prepare($conn, $getStatus);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $idStatus);
        mysqli_stmt_execute($stmt);
        $statusResult = mysqli_stmt_get_result($stmt);
        if ($statusResult && mysqli_num_rows($statusResult) > 0) {
            $row = mysqli_fetch_assoc($statusResult);
            $status['idStatus'] = $row['idStatus'];
            $status['nameStatus'] = $row['nameStatus'];
        } else {
            echo "Nie ma takiego statusu w bazie!";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
    return $status;
}

function getAllStatuses($conn): array
{
    $getStatuses = "SELECT idStatus, nameStatus FROM statuses";
    $statuses = array();
    $stmt = mysqli_prepare($conn, $getStatuses);
    if ($stmt) {
        mysqli_stmt_execute($stmt);
        $statusesResult = mysqli_stmt_get_result($stmt);
        if ($statusesResult && mysqli_num_rows($statusesResult) > 0) {
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
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
    return $statuses;
}
function getUserById($conn, $user_id): array
{
    $getUser = "SELECT * FROM users WHERE idUser=?";
    $stmt = mysqli_prepare($conn, $getUser);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id, $name, $surname, $password, $role);
        if (mysqli_stmt_fetch($stmt)) {
            mysqli_stmt_close($stmt);
            return [
                'id' => $id,
                'name' => $name,
                'surname' => $surname,
                'password' => $password,
                'role' => $role
            ];
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
    return [];
}

function checkUserRoleAndRedirect($conn) {
    if (empty($_SESSION['users'])) {
        header("Location: ../login.php");
        exit();
    }
    $user_id = $_SESSION['users'];
    $user = getUserById($conn, $user_id);
    if ($user['role'] === 'user') {
        header("Location: ../account.php");
        exit();
    }
}