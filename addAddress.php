<?php
include_once('settings.php');
include('navbar.php');
include('functions.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $city = $_POST['city'];
    $zipCode = $_POST['zipCode'];
    $street = $_POST['street'];
    $streetNumber = $_POST['streetNumber'];
    $userId=$_SESSION['users'];
    addAddressToDB($conn,$userId,$city,$zipCode,$street,$streetNumber);
    header("Location:account.php");
}
echo '
<div class="contentContainer">
    <div class="editFormDiv">
        <form class="editForm" method="post" action="addAddress.php">
            <label class="editInfo" for="city">City:</label>
             <input class="editInput" type="text" id="city" name="city" placeholder="Miasto" required><br><br>
            <label class="editInfo" for="zipCode">Kod pocztowy:</label>
            <input class="editInput" type="text" id="zipCode" name="zipCode" placeholder="Kod pocztowy:54-100" required><br><br>
            <label class="editInfo" for="street">Ulica:</label>
            <input class="editInput" type="text" id="street" name="street" placeholder="Ulica" required><br><br>
            <label class="editInfo" for="streetNumber">Numer mieszkania</label>
            <input class="editInput" type="text" id="streetNumber" name="streetNumber" placeholder="Numer mieszkania" required><br><br>
            <input class="button" type="submit" value="Dodaj">
            
        </form>
    </div>
</div>
';

include('footer.php'); ?>
