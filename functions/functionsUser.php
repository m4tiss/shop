<?php
include_once('config.php');
function getProductsByCategoryCondition($conn, $categoryCondition): array
{
    $getProducts = "SELECT * FROM products WHERE idCategory IN ($categoryCondition)";
    $products = array();
    $stmt = mysqli_prepare($conn, $getProducts);
    if ($stmt) {
        mysqli_stmt_execute($stmt);
        $productsResult = mysqli_stmt_get_result($stmt);
        if ($productsResult && mysqli_num_rows($productsResult) > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($productsResult)) {
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
            echo "Nie ma produktów w tym dziale!";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
    return $products;
}

function updateProductInDB($conn, $amount, $user_id, $idProduct, $size)
{
    $updateProductInDB = "UPDATE baskets SET amount=? WHERE idUser=? and idProduct=? and sizee=?";
    $stmt = mysqli_prepare($conn, $updateProductInDB);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "iiii", $amount, $user_id, $idProduct, $size);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
}

function addProductToDB($conn, $amount, $user_id, $idProduct, $size)
{
    $insertProductToDB = "INSERT INTO baskets (idUser, idProduct, amount, sizee) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insertProductToDB);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "iiii", $user_id, $idProduct, $amount, $size);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
}

function deleteProductFromDB($conn, $user_id, $idProduct, $size)
{
    $deleteProductFromDB = "DELETE FROM baskets WHERE idUser=? AND idProduct=? AND sizee=?";
    $stmt = mysqli_prepare($conn, $deleteProductFromDB);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "iii", $user_id, $idProduct, $size);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
}

function deleteAllFromBasketInDB($conn, $user_id)
{
    $deleteAllFromDB = "DELETE FROM baskets WHERE idUser=?";
    $stmt = mysqli_prepare($conn, $deleteAllFromDB);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
}

function deleteAllFromDB($conn, $user_id)
{
    $deleteAllFromDB = "DELETE FROM baskets WHERE idUser=?";
    $stmt = mysqli_prepare($conn, $deleteAllFromDB);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
}

function editContactInDB($conn, $contactId, $userId, $email, $phoneNumber)
{
    $editContact = "UPDATE contacts SET email=?, phoneNumber=? WHERE idUser=? AND idContact=?";
    $stmt = mysqli_prepare($conn, $editContact);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssii", $email, $phoneNumber, $userId, $contactId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
}

function addContactToDB($conn, $userId, $email, $phoneNumber)
{
    $addContact = "INSERT INTO contacts(idUser, email, phoneNumber) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $addContact);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "iss", $userId, $email, $phoneNumber);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
}

function deleteContactFromDB($conn, $contactId)
{
    $deleteContact = "DELETE FROM contacts WHERE idContact = ?";
    $stmt = mysqli_prepare($conn, $deleteContact);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $contactId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
}

function deleteAddressFromDB($conn, $addressId)
{
    $deleteAddress = "DELETE FROM addresses WHERE idAddress = ?";
    $stmt = mysqli_prepare($conn, $deleteAddress);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $addressId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
}

function addAddressToDB($conn, $userId, $city, $zipCode, $street, $streetNumber)
{
    $addAddress = "INSERT INTO addresses(idUser, city, zipCode, street, streetNumber) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $addAddress);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "issss", $userId, $city, $zipCode, $street, $streetNumber);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
}

function addOrderToDB($conn, $idPayment, $idStatus, $name, $surname, $email, $cost)
{
    $addOrder = "INSERT INTO orders (idPayment, idStatus, name, surname, email, dateOrder, cost) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $addOrder);
    if ($stmt) {
        $date = date("Y-m-d H:i:s");
        mysqli_stmt_bind_param($stmt, "iissssd", $idPayment, $idStatus, $name, $surname, $email, $date, $cost);
        mysqli_stmt_execute($stmt);
        $orderId = mysqli_insert_id($conn);
        mysqli_stmt_close($stmt);
        return $orderId;
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
        return false;
    }
}

function setOrderTotalCost($conn, $idOrder, $totalValue)
{
    $setOrder = "UPDATE orders SET cost=? WHERE idOrder=?";
    $stmt = mysqli_prepare($conn, $setOrder);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "di", $totalValue, $idOrder);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
}

function addOrderDetailsToDB($conn, $idOrder, $nameProduct, $amount, $price, $size, $image)
{
    $addOrderDetails = "INSERT INTO orderdetails(idOrder, nameProduct, amount, price, size, image) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $addOrderDetails);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "issdss", $idOrder, $nameProduct, $amount, $price, $size, $image);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
}

function editAddressInDB($conn, $idAddress, $city, $zipCode, $street, $streetNumber)
{
    $editAddress = "UPDATE addresses SET city=?, zipCode=?, street=?, streetNumber=? WHERE idAddress=?";
    $stmt = mysqli_prepare($conn, $editAddress);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssii", $city, $zipCode, $street, $streetNumber, $idAddress);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
}

function isEmailExists($conn, $email)
{
    $getEmail = "SELECT idContact FROM contacts WHERE email = ?";
    $stmt = mysqli_prepare($conn, $getEmail);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idContact);
        if (mysqli_stmt_fetch($stmt)) {
            mysqli_stmt_close($stmt);
            return $idContact;
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
    return false;
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

function getContactsById($conn, $user_id): array
{
    $getContacts = "SELECT email, phoneNumber FROM contacts WHERE idUser=?";
    $stmt = mysqli_prepare($conn, $getContacts);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $email, $phoneNumber);
        $contacts = [];
        while (mysqli_stmt_fetch($stmt)) {
            $contact = [
                'email' => $email,
                'phoneNumber' => $phoneNumber,
            ];
            $contacts[] = $contact;
        }
        mysqli_stmt_close($stmt);
        return $contacts;
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
    return [];
}

function getAddressById($conn, $idAddress): array
{
    $getAddress = "SELECT * FROM addresses WHERE idAddress=?";
    $stmt = mysqli_prepare($conn, $getAddress);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $idAddress);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $address = [
                'idAddress' => $row['idAddress'],
                'city' => $row['city'],
                'zipCode' => $row['zipCode'],
                'street' => $row['street'],
                'streetNumber' => $row['streetNumber'],
            ];
            mysqli_stmt_close($stmt);
            return $address;
        } else {
            echo "Nie ma takiego adresu w bazie!";
        }
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
    return [];
}

function getAddressesById($conn, $user_id): array
{
    $getAddresses = "SELECT * FROM addresses WHERE idUser=?";
    $stmt = mysqli_prepare($conn, $getAddresses);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $addresses = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $address = [
                'idAddress' => $row['idAddress'],
                'city' => $row['city'],
                'zipCode' => $row['zipCode'],
                'street' => $row['street'],
                'streetNumber' => $row['streetNumber'],
            ];
            $addresses[] = $address;
        }
        mysqli_stmt_close($stmt);
        return $addresses;
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
    return [];
}

function getAllPaymentMethods($conn): array
{
    $getPaymentMethods = "SELECT * FROM payments";
    $stmt = mysqli_prepare($conn, $getPaymentMethods);
    if ($stmt) {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $paymentMethods = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $paymentMethod = [
                'idPayment' => $row['idPayment'],
                'namePayment' => $row['namePayment'],
                'icon' => $row['icon'],
            ];
            $paymentMethods[] = $paymentMethod;
        }
        mysqli_stmt_close($stmt);
        return $paymentMethods;
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
    return [];
}

function getAllOrdersByEmail($conn, $email): array
{
    $getOrders = "SELECT * FROM orders WHERE email=?";
    $stmt = mysqli_prepare($conn, $getOrders);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $orders = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $order = [
                'idOrder' => $row['idOrder'],
                'idPayment' => $row['idPayment'],
                'idStatus' => $row['idStatus'],
                'name' => $row['name'],
                'surname' => $row['surname'],
                'email' => $row['email'],
                'dateOrder' => $row['dateOrder'],
                'cost' => $row['cost'],
            ];
            $orders[] = $order;
        }
        mysqli_stmt_close($stmt);
        usort($orders, function ($a, $b) {
            return $b['idOrder'] - $a['idOrder'];
        });
        return $orders;
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
    return [];
}

function getOrderById($conn, $idOrder): array
{
    $getOrder = "SELECT * FROM orders WHERE idOrder=?";
    $stmt = mysqli_prepare($conn, $getOrder);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $idOrder);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $order = [
                'idOrder' => $row['idOrder'],
                'idPayment' => $row['idPayment'],
                'idStatus' => $row['idStatus'],
                'name' => $row['name'],
                'surname' => $row['surname'],
                'email' => $row['email'],
                'dateOrder' => $row['dateOrder'],
                'cost' => $row['cost'],
            ];
            mysqli_stmt_close($stmt);
            return $order;
        } else {
            echo "Nie ma zamówienia z takim ID!";
        }
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
    return [];
}

function getPaymentMethod($conn, $idPayment): array
{
    $getPayment = "SELECT * FROM payments WHERE idPayment=?";
    $stmt = mysqli_prepare($conn, $getPayment);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $idPayment);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $payment = [
                'idPayment' => $row['idPayment'],
                'namePayment' => $row['namePayment'],
                'icon' => $row['icon'],
            ];
            mysqli_stmt_close($stmt);
            return $payment;
        } else {
            echo "Nie ma metody z takim ID!";
        }
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
    return [];
}

function getProductsFromOrder($conn, $idOrder): array
{
    $getProducts = "SELECT * FROM orderdetails WHERE idOrder = ?";
    $stmt = mysqli_prepare($conn, $getProducts);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $idOrder);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0) {
            $products = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $product = [
                    'idOrderDetail' => $row['idOrderDetail'],
                    'idOrder' => $row['idOrder'],
                    'name' => $row['nameProduct'],
                    'amount' => $row['amount'],
                    'price' => $row['price'],
                    'size' => $row['size'],
                    'image' => $row['image'],
                ];
                $products[] = $product;
            }
            mysqli_stmt_close($stmt);
            return $products;
        } else {
            echo "To zamówienie było puste!";
        }
    } else {
        echo "Błąd przy przygotowywaniu zapytania SQL";
    }
    return [];
}

function getStatus($conn, $idStatus): array
{
    $getStatus = "SELECT * FROM statuses WHERE idStatus = ?";
    $stmt = mysqli_prepare($conn, $getStatus);
    mysqli_stmt_bind_param($stmt, "i", $idStatus);
    mysqli_stmt_execute($stmt);
    $statusResult = mysqli_stmt_get_result($stmt);
    if ($statusResult && mysqli_num_rows($statusResult) > 0) {
        $row = mysqli_fetch_assoc($statusResult);
        $status = array(
            'idStatus' => $row['idStatus'],
            'nameStatus' => $row['nameStatus']
        );
    } else {
        echo "Nie ma takiego statusu w bazie!";
    }
    mysqli_stmt_close($stmt);
    return $status;
}

function getPhoneNumberFromMail($conn, $email)
{
    $getPhoneNumber = "SELECT phoneNumber FROM contacts WHERE email=?";
    $stmt = mysqli_prepare($conn, $getPhoneNumber);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $phoneNumberResult = mysqli_stmt_get_result($stmt);
    if ($phoneNumberResult && mysqli_num_rows($phoneNumberResult) > 0) {
        $row = mysqli_fetch_assoc($phoneNumberResult);
        $phoneNumber = $row['phoneNumber'];
    } else {
        echo "Nie znaleziono numeru dla tego emaila!";
    }
    mysqli_stmt_close($stmt);
    return $phoneNumber;
}

function getContactIdFromMail($conn, $email)
{
    $getId = "SELECT idContact FROM contacts WHERE email=?";
    $stmt = mysqli_prepare($conn, $getId);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $idResult = mysqli_stmt_get_result($stmt);
    if ($idResult && mysqli_num_rows($idResult) > 0) {
        $row = mysqli_fetch_assoc($idResult);
        $contactId = $row['idContact'];
    } else {
        echo "Nie znaleziono id dla tego emaila!";
    }
    mysqli_stmt_close($stmt);
    return $contactId;
}

function getProductById($conn, $productId)
{
    $getProduct = "SELECT * FROM products WHERE idProduct=?";
    $productData = array();
    $stmt = mysqli_prepare($conn, $getProduct);
    mysqli_stmt_bind_param($stmt, "i", $productId);
    mysqli_stmt_execute($stmt);
    $productResult = mysqli_stmt_get_result($stmt);
    if ($productResult && mysqli_num_rows($productResult) > 0) {
        while ($row = mysqli_fetch_assoc($productResult)) {
            $productData['name'] = $row['nameProduct'];
            $productData['description'] = $row['description'];
            $productData['price'] = $row['price'];
            $productData['image'] = $row['image'];
            $productData['id'] = $row['idProduct'];
            $productData['category'] = $row['idCategory'];
            $productData['idProducer'] = $row['idProducer'];
        }
    } else {
        echo "Produkt już nie istnieje";
        exit();
    }
    mysqli_stmt_close($stmt);
    return $productData;
}

function isProductExist($conn, $productId): bool
{
    $getProduct = "SELECT * FROM products WHERE idProduct=?";
    $stmt = mysqli_prepare($conn, $getProduct);
    mysqli_stmt_bind_param($stmt, "i", $productId);
    mysqli_stmt_execute($stmt);
    $productResult = mysqli_stmt_get_result($stmt);
    $exists = mysqli_num_rows($productResult) > 0;
    mysqli_stmt_close($stmt);
    return $exists;
}

function getProductsFromBasket($conn, $userId): array
{
    $getProducts = "SELECT * FROM baskets WHERE idUser=?";
    $stmt = mysqli_prepare($conn, $getProducts);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $productResult = mysqli_stmt_get_result($stmt);
    $productsData = array();
    if (mysqli_num_rows($productResult) > 0) {
        $i = 0;
        while ($row = mysqli_fetch_assoc($productResult)) {
            $productData = array();
            $productData['idUser'] = $row['idUser'];
            $productData['idProduct'] = $row['idProduct'];
            $productData['amount'] = $row['amount'];
            $productData['sizee'] = $row['sizee'];
            $productsData[$i] = $productData;
            $i += 1;
        }
    } else {
        echo "Brak produktów w koszyku";
    }
    mysqli_stmt_close($stmt);
    return $productsData;
}

function getCategoryById($conn, $idCategory): array
{
    $getCategory = "SELECT * FROM categories WHERE idCategory=?";
    $stmt = mysqli_prepare($conn, $getCategory);
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
    return $category;
}

function getCategoriesByStore($conn, $store): array
{
    $getCategories = "SELECT * FROM categories WHERE storeDepartament=?";
    $stmt = mysqli_prepare($conn, $getCategories);
    mysqli_stmt_bind_param($stmt, "s", $store);
    mysqli_stmt_execute($stmt);
    $categoriesResult = mysqli_stmt_get_result($stmt);
    $categories = array();
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
    return $categories;
}

function getProducersByStore($conn, $store): array
{
    $getProducers = "SELECT * FROM producers WHERE storeDepartament=?";
    $stmt = mysqli_prepare($conn, $getProducers);
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
    return $producers;
}

function getProducerById($conn, $idProducer): array
{
    $getProducer = "SELECT * FROM producers WHERE idProducer=?";
    $stmt = mysqli_prepare($conn, $getProducer);
    mysqli_stmt_bind_param($stmt, "i", $idProducer);
    mysqli_stmt_execute($stmt);
    $producerResult = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($producerResult) > 0) {
        $row = mysqli_fetch_assoc($producerResult);
        $producer = array();
        $producer['idProducer'] = $row['idProducer'];
        $producer['nameProducer'] = $row['nameProducer'];
        $producer['storeDepartament'] = $row['storeDepartament'];
    } else {
        echo "Nie ma producenta z takim ID!";
    }
    mysqli_stmt_close($stmt);
    return $producer;
}

function getSizesFromStore($conn,$departament): array
{
    $getSizes = "SELECT * FROM sizees WHERE storeDepartament=?";
    $stmt = mysqli_prepare($conn, $getSizes);
    mysqli_stmt_bind_param($stmt, "s", $departament);
    mysqli_stmt_execute($stmt);
    $sizesResult = mysqli_stmt_get_result($stmt);
    $sizes = array();
    if (mysqli_num_rows($sizesResult) > 0) {
        $i = 0;
        while ($row = mysqli_fetch_assoc($sizesResult)) {
            $size = array();
            $size['idSizee'] = $row['idSizee'];
            $size['storeDepartament'] = $row['storeDepartament'];
            $size['nameSizee'] = $row['nameSizee'];
            $sizes[$i] = $size;
            $i += 1;
        }
    } else {
        echo "Nie ma rozmiarów w tym dziale!";
    }
    mysqli_stmt_close($stmt);
    return $sizes;
}

function getStoreFromCategory($conn, $idCategory){
    $getStoreDepartament = "SELECT storeDepartament FROM categories WHERE idCategory=?";
    $stmt = mysqli_prepare($conn, $getStoreDepartament);
    mysqli_stmt_bind_param($stmt, "i", $idCategory);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $departament);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    return $departament;
}


