<?php include_once('settings.php');
include('navbar.php');
include('functions/functionsUser.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idAddress = $_POST['idAddress'];
    $city = $_POST['city'];
    $zipCode = $_POST['zipCode'];
    $street = $_POST['street'];
    $streetNumber = $_POST['streetNumber'];
    editAddressInDB($conn,$idAddress,$city,$zipCode,$street,$streetNumber);
    header("Location:account.php");
}

$idAddress = $_GET['id'] ?? '';

$address = getAddressById($conn,$idAddress);

echo '
<div class="contentContainer">
    <div class="editFormDiv">
        <form class="editForm" method="post" action="editAddresses.php">
            <label class="editInfo" for="city">City:</label>
             <input class="editInput" type="text" id="city" name="city" value="' . $address['city'] . '" required><br><br>
            <label class="editInfo" for="zipCode">Kod pocztowy:</label>
            <input class="editInput" type="text" id="zipCode" name="zipCode" value="' . $address['zipCode'] . '" required><br><br>
            <label class="editInfo" for="street">Ulica:</label>
            <input class="editInput" type="text" id="street" name="street" value="' . $address['street'] . '" required><br><br>
            <label class="editInfo" for="streetNumber">Numer mieszkania</label>
            <input class="editInput" type="text" id="streetNumber" name="streetNumber" value="' . $address['streetNumber'] . '" required><br><br>
            <input type="hidden" name="idAddress" value="'.$idAddress.'" />
            <input class="button" type="submit" value="Zapisz zmiany"> 
        </form>
    </div>
</div>
';
include('footer.php'); ?>
