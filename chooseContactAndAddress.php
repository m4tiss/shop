
<?php include_once('settings.php');
include('navbar.php');
include('functions/functionsUser.php');
session_start();
if (empty($_SESSION['users'])) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['users'];
$contacts = getContactsById($conn,$user_id);
if(empty(getAddressesById($conn,$user_id)) || $contacts[0]['phoneNumber']==='000000000'){
    header("Location: login.php");
    exit();
}
?>

<div class="contentAccountContainer">
    <h1>Wybierz dane do wysyłki</h1>
    <form class="formDisplay" action="choosePayment.php" method="post">
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
                                <input type="radio" name="selectedContact"  value="' . $contact['idContact'] . '" required>
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
                                <h3>Miasto</h3>
                                    <p class="addressCity">' . $address['city'] . '</p>
                                <h3>Kod pocztowy</h3>
                                <p class="addressZipCode">' . $address['zipCode'] . '</p>
                                <h3>Ulica</h3>
                                <p class="addressStreet">' . $address['street'] . '</p>
                                <h3>Numer mieszkania</h3>
                                <p class="addressStreetNumber">' . $address['streetNumber'] . '</p>
                            </div>
                            <div class="inputDiv">
                                <input type="radio" name="selectedAddress"  value="' . $address['idAddress'] . '" required>
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