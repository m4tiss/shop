<?php include_once('settings.php') ?>
<?php include('navbar.php');
include('functions.php');
session_start();

if (empty($_SESSION['users'])) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['users'];
?>

    <div class="contentAccountContainer">
        <div class="logoutPanel">
            <a class="logoutLink" href="logout.php">
                <button class="button">Logout</button>
            </a>
        </div>
        <h2>TWOJE KONTO</h2>
        <h2>Imię:</h2>
        <?php
        $user = getUserById($conn, $_SESSION['users']);
        echo '<p class="name">' . $user['name'] . '</p>
                <h2>Nazwisko:</h2>
             <p class="surname">' . $user['surname'] . '</p>';
        ?>
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
                    echo ($contact['phoneNumber'] === '000000000') ? '<p style="color: red" class="contactNumber">UZUPEŁNIJ NUMER!</p>' : '<p class="contactNumber">' . $contact['phoneNumber'] . '</p>';
                    echo '
                    </div>
                    <div class="editIconContactAndAddresses">
                        <a href="editContact.php?email='. $contact['email'] .'"><img src="images/editIcon.jpg" width="50px"></a>
                    </div>
                </div>';
                }
                ?>
                <div class="addIconContact">
                    <img src="images/addIcon.png" width="80px">
                </div>

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
                    echo' <h3>Ulica</h3>';
                    echo ($address['street'] === '') ? '<p style="color: red" class="addressStreet">UZUPEŁNIJ ULICE!</p>' : '<p class="addressStreet">' . $address['street'] . '</p>';
                    echo' <h3>Numer mieszkania</h3>';
                    echo ($address['streetNumber'] === '') ? '<p style="color: red" class="addressStreetNumber">UZUPEŁNIJ NUMER MIESZKANIA!</p>' : '<p class="addressStreetNumber">' . $address['streetNumber'] . '</p>';
                    echo'
                    </div>
                    <div class="editIconContactAndAddresses">
                        <img src="images/editIcon.jpg" width="50px">
                    </div>
                </div>';
                }
                ?>
                <div class="addIconAddresses">
                    <img src="images/addIcon.png" width="80px">
                </div>
            </div>

        </div>
    </div>

<?php include('footer.php'); ?>