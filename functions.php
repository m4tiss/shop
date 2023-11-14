<?php
include_once('config.php');
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

function isProductExist($conn, $productId)
{
    $getProduct = "SELECT * FROM products WHERE idProduct=$productId";
    if ($productResult = mysqli_query($conn, $getProduct)) {
        if (mysqli_num_rows($productResult) > 0) return true;
        else return false;
    }
}


function getProductsFromBasket($conn, $userId)
{
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
                $i += 1;
            }
        } else {
            echo "Produkt już nie istnieje";
        }
    }
    return $productsData;
}

function updateProductInDB($conn, $amount, $user_id, $idProduct, $size)
{
    $updateProductInDB = "UPDATE baskets SET amount=$amount WHERE idUser=$user_id and  idProduct=$idProduct and sizee=$size";
    mysqli_query($conn, $updateProductInDB);
}

function addProductToDB($conn, $amount, $user_id, $idProduct, $size)
{
    $insertProductToDB = "INSERT INTO baskets (idUser, idProduct,amount,sizee) VALUES ('$user_id', '$idProduct','$amount','$size')";
    mysqli_query($conn, $insertProductToDB);
}

function deleteProductFromDB($conn, $user_id, $idProduct, $size)
{
    $deleteProductFromDB = "DELETE FROM baskets WHERE idUser=$user_id and  idProduct=$idProduct and sizee='$size' ";
    mysqli_query($conn, $deleteProductFromDB);
}

function deleteAllFromBasketInDB($conn,$user_id){
    $deleteAllFromDB = "DELETE FROM baskets WHERE idUser=$user_id";
    mysqli_query($conn, $deleteAllFromDB);
}
function deleteAllFromDB($conn, $user_id)
{
    $deleteAllFromDB = "DELETE FROM baskets WHERE idUser=$user_id";
    mysqli_query($conn, $deleteAllFromDB);
}

function editContactInDB($conn, $contactId, $userId, $email, $phoneNumber)
{
    $editContact = "UPDATE contacts SET email='$email', phoneNumber='$phoneNumber' WHERE idUser=$userId AND idContact=$contactId";
    mysqli_query($conn, $editContact);
}

function addContactToDB($conn, $userId, $email, $phoneNumber)
{
    $addContact = "INSERT INTO contacts(idUser,email,phoneNumber) values($userId,'$email','$phoneNumber');";
    mysqli_query($conn, $addContact);
}

function deleteContactFromDB($conn, $contactId)
{
    $deleteContact = "DELETE FROM contacts WHERE idContact=$contactId";
    mysqli_query($conn, $deleteContact);
}

function deleteAddressFromDB($conn, $addressId)
{
    $deleteAddress = "DELETE FROM addresses WHERE idAddress=$addressId";
    mysqli_query($conn, $deleteAddress);
}

function addAddressToDB($conn, $userId, $city, $zipCode, $street, $streetNumber)
{
    $addAddress = "INSERT INTO addresses(idUser,city,zipCode,street,streetNumber) values($userId,'$city','$zipCode','$street','$streetNumber');";
    mysqli_query($conn, $addAddress);
}
function addOrderToDB($conn,$idPayment,$idStatus,$name,$surname,$email,$cost){
    $date= date("Y-m-d H:i:s");
    $addOrder = "INSERT INTO orders(idPayment,idStatus,name,surname,email,dateOrder,cost) values($idPayment,$idStatus,'$name','$surname','$email','$date','$cost')";
    mysqli_query($conn, $addOrder);
    return mysqli_insert_id($conn);
}

function setOrderTotalCost($conn,$idOrder,$totalValue){
    $setOrder = "UPDATE orders SET cost=$totalValue WHERE idOrder=$idOrder";
    mysqli_query($conn, $setOrder);
}

function addOrderDetailsToDB($conn,$idOrder,$nameProduct,$amount,$price,$size,$image){
    $addOrderDetails = "INSERT INTO orderdetails(idOrder,nameProduct,amount,price,size,image) values($idOrder,'$nameProduct',$amount,$price,'$size','$image')";
    mysqli_query($conn, $addOrderDetails);
}

function editAddressInDB($conn, $idAddress, $city, $zipCode, $street, $streetNumber)
{
    $editAddress = "UPDATE addresses SET city='$city', zipCode='$zipCode',street='$street',streetNumber='$streetNumber' WHERE idAddress=$idAddress";
    mysqli_query($conn, $editAddress);
}

function isEmailExists($conn, $email)
{
    $getAllEmails = "SELECT * FROM contacts";
    if ($emailResult = mysqli_query($conn, $getAllEmails)) {
        if (mysqli_num_rows($emailResult) > 0) {
            while ($row = mysqli_fetch_assoc($emailResult)) {
                if ($email === $row['email']) return $row['idContact'];
            }
        } else {
            echo "Nie ma żadnego maila w bazie";
        }
    }
    return false;
}

function getUserById($conn, $user_id)
{
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
        } else {
            echo "Taki użytkownik nie istnieje";
            exit();
        }
    }
    return $user;
}

function getContactsById($conn, $user_id)
{
    $getContacts = "SELECT * FROM contacts WHERE idUser=$user_id";
    $contacts = array();
    if ($contactsResult = mysqli_query($conn, $getContacts)) {
        if (mysqli_num_rows($contactsResult) > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($contactsResult)) {
                $contact = array();
                $contact['email'] = $row['email'];
                $contact['phoneNumber'] = $row['phoneNumber'];
                $contacts[$i] = $contact;
                $i += 1;
            }
        } else {
            echo "Nie masz żadnego konatktu! Dodaj nowy";
            exit();
        }
    }
    return $contacts;
}

function getAddressById($conn, $idAddress)
{
    $getAddress = "SELECT * FROM addresses WHERE idAddress=$idAddress";
    if ($addressResult = mysqli_query($conn, $getAddress)) {
        if (mysqli_num_rows($addressResult) > 0) {
            $row = mysqli_fetch_assoc($addressResult);
            $address = array();
            $address['idAddress'] = $row['idAddress'];
            $address['city'] = $row['city'];
            $address['zipCode'] = $row['zipCode'];
            $address['street'] = $row['street'];
            $address['streetNumber'] = $row['streetNumber'];
        } else {
            echo "Nie ma takiego adresu w bazie!";
        }
    }
    return $address;

}

function getAddressesById($conn, $user_id)
{
    $getAddresses = "SELECT * FROM addresses WHERE idUser=$user_id";
    $addresses = array();
    if ($addressesResult = mysqli_query($conn, $getAddresses)) {
        if (mysqli_num_rows($addressesResult) > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($addressesResult)) {
                $address = array();
                $address['idAddress'] = $row['idAddress'];
                $address['city'] = $row['city'];
                $address['zipCode'] = $row['zipCode'];
                $address['street'] = $row['street'];
                $address['streetNumber'] = $row['streetNumber'];
                $addresses[$i] = $address;
                $i += 1;
            }
        } else {
            echo "Nie masz żadnego adresu! Dodaj nowy";
        }
    }
    return $addresses;
}

function getAllPaymentMethods($conn)
{
    $getPaymentMethods = "SELECT * FROM payments";
    $paymentMethods = array();
    if ($paymentMethodsResult = mysqli_query($conn, $getPaymentMethods)) {
        if (mysqli_num_rows($paymentMethodsResult) > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($paymentMethodsResult)) {
                $paymentMethod = array();
                $paymentMethod['idPayment'] = $row['idPayment'];
                $paymentMethod['namePayment'] = $row['namePayment'];
                $paymentMethod['icon'] = $row['icon'];
                $paymentMethods[$i] = $paymentMethod;
                $i += 1;
            }
        } else {
            echo "Nie ma żadnych dostępnych metod płatności!";
        }
    }
    return $paymentMethods;
}

function getAllOrdersByEmail($conn,$email){
    $getOrders = "SELECT * FROM orders Where email='$email'";
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
            echo "Nie zrealizowałeś jeszcze żadnego zamówienia!";
        }
    }
    return $orders;
}

function getOrderById($conn,$idOrder){
    $getOrder = "SELECT * FROM orders Where idOrder=$idOrder";
    if ($orderResult = mysqli_query($conn, $getOrder)) {
        if (mysqli_num_rows($orderResult) > 0) {
            while ($row = mysqli_fetch_assoc($orderResult)) {
                $order = array();
                $order['idOrder'] = $row['idOrder'];
                $order['idPayment'] = $row['idPayment'];
                $order['idStatus'] = $row['idStatus'];
                $order['name'] = $row['surname'];
                $order['surname'] = $row['surname'];
                $order['email'] = $row['email'];
                $order['dateOrder'] = $row['dateOrder'];
                $order['cost'] = $row['cost'];
            }
        } else {
            echo "Nie ma zamówienia z takim ID!";
        }
    }
    return $order;
}

function getPaymentMethod($conn,$idPayment){
    $getPayment = "SELECT * FROM payments Where idPayment=$idPayment";
    if ($paymentResult = mysqli_query($conn, $getPayment)) {
        if (mysqli_num_rows($paymentResult) > 0) {
            while ($row = mysqli_fetch_assoc($paymentResult)) {
                $payment = array();
                $payment['idPayment'] = $row['idPayment'];
                $payment['namePayment'] = $row['namePayment'];
                $payment['icon'] = $row['icon'];
            }
        } else {
            echo "Nie ma metody z takim ID!";
        }
    }
    return $payment;
}

function getProductsFromOrder($conn,$idOrder){
    $getProducts = "SELECT * FROM orderdetails Where idOrder = $idOrder";
    $products = array();
    if ($productsResult = mysqli_query($conn, $getProducts)) {
        if (mysqli_num_rows($productsResult) > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($productsResult)) {
                $product = array();
                $product['idOrderDetail'] = $row['idOrderDetail'];
                $product['idOrder'] = $row['idOrder'];
                $product['name'] = $row['nameProduct'];
                $product['amount'] = $row['amount'];
                $product['price'] = $row['price'];
                $product['size'] = $row['size'];
                $product['image'] = $row['image'];
                $products[$i] = $product;
                $i += 1;
            }
        } else {
            echo "To zamówienie było puste!";
        }
    }
    return $products;
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
function getPhoneNumberFromMail($conn, $email)
{
    $getPhoneNumber = "SELECT phoneNumber FROM contacts WHERE email='$email'";
    if ($phoneNumberResult = mysqli_query($conn, $getPhoneNumber)) {
        if (mysqli_num_rows($phoneNumberResult) > 0) {
            $row = mysqli_fetch_assoc($phoneNumberResult);
            $phoneNumber = $row['phoneNumber'];
        } else {
            echo "Nie znaleziono numeru dla tego emaila!";
        }
    }
    return $phoneNumber;
}

function getContactIdFromMail($conn, $email)
{
    $getId = "SELECT idContact FROM contacts WHERE email='$email'";
    if ($idResult = mysqli_query($conn, $getId)) {
        if (mysqli_num_rows($idResult) > 0) {
            $row = mysqli_fetch_assoc($idResult);
            $contactId = $row['idContact'];
        } else {
            echo "Nie znaleziono id dla tego emaila!";
        }
    }
    return $contactId;
}