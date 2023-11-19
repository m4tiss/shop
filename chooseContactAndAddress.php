
<?php include_once('settings.php');
include('navbar.php');
include('functions/functionsUser.php');
session_start();
if (empty($_SESSION['users'])) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['users'];
?>

<div class="contentAccountContainer">
    <h1>Wybierz dane do wysyłki</h1>
    <form class="formDisplay" action="choosePayment.php">
    <div class="contactsAndAddresses">
        <div class="contactsAndAddressesContainer">
            <h2>Kontakty</h2>
            <?php
            $contacts = getContactsById($conn, $_SESSION['users']);
            foreach ($contacts as $contact) {
                echo '<div class="contactDiv">
                    <div class="contactAndAddressesContent">
                        <h3 class="contactInfo">Email</h3>
                        <p class="contactEmail">' . $contact['email'] . '</p>
                        <h3 class="contactInfo">Numer telefonu</h3>';
                echo ($contact['phoneNumber'] === '000000000') ? '<p style="color: red" class="contactNumber">UZUPEŁNIJ NUMER!</p>' :
                    '<p class="contactNumber">' . $contact['phoneNumber'] . '</p>';
                echo '
                    </div>
                    <div class="inputDiv">
                    <input type="radio" name="selectedContact" required>
                    </div>';
                echo '</div>';
            }
            ?>

        </div>
        <div class="contactsAndAddressesContainer">
            <h2>Adresy</h2>
            <?php
            $addresses = getAddressesById($conn, $_SESSION['users']);
            foreach ($addresses as $address) {
                echo '<div class="addressDiv">
                    <div class="contactAndAddressesContent">
                        <h3>Miasto</h3>';
                echo ($address['city'] === '') ? '<p style="color: red" class="addressCity">UZUPEŁNIJ MIASTO!</p>' : '<p class="addressCity">' . $address['city'] . '</p>';
                echo ' <h3>Kod pocztowy</h3>';
                echo ($address['zipCode'] === '') ? '<p style="color: red" class="addressZipCode">UZUPEŁNIJ KOD POCZTOWY!</p>' : '<p class="addressZipCode">' . $address['zipCode'] . '</p>';
                echo ' <h3>Ulica</h3>';
                echo ($address['street'] === '') ? '<p style="color: red" class="addressStreet">UZUPEŁNIJ ULICE!</p>' : '<p class="addressStreet">' . $address['street'] . '</p>';
                echo ' <h3>Numer mieszkania</h3>';
                echo ($address['streetNumber'] === '') ? '<p style="color: red" class="addressStreetNumber">UZUPEŁNIJ NUMER MIESZKANIA!</p>' : '<p class="addressStreetNumber">' . $address['streetNumber'] . '</p>';
                echo '
                    </div>
                     <div class="inputDiv">
                    <input type="radio" name="selectedAddress" required>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>
    <button type="submit" class="button">Przejdź do płatności</button>
    </form>
</div>
<?php include('footer.php'); ?>