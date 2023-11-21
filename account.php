<?php include_once('settings.php') ?>
<?php include('navbar.php');
include('functions/functionsUser.php');
session_start();

if (empty($_SESSION['users'])) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['users'];
$user = getUserById($conn, $user_id);
if ($user['role'] === 'admin') {
    header("Location: accountAdmin.php");
    exit();
}
?>
    <div class="contentAccountContainer">
        <div class="buttonsPanel">
            <a class="buttonLink" href="logout.php">
                <button class="buttonAccount">Logout</button>
            </a>
            <a class="buttonLink" href="historyOfOrders.php">
                <button class="buttonAccount">Historia Zamówień</button>
            </a>
        </div>
        <h2>TWOJE KONTO</h2>
        <h2>Imię:</h2>
        <?php
        $user = getUserById($conn, $_SESSION['users']);
        echo '<p class="name">' . $user['name'] . '</p>
                <h2>Nazwisko:</h2>
             <p class="surname">' . $user['surname'] . '</p>';

        if (isset($_GET['error'])) {
            echo '<h2 id="warningAccount" class="warningInAccount">Nie możesz dodać tego maila on już istnieje!</h2>';
        }
        ?>
        <div class="contactsAndAddresses">
            <div class="contactsAndAddressesContainer">
                <h2>Kontakty</h2>
                <?php
                $contacts = getContactsById($conn, $_SESSION['users']);
                $numberOfContact = 1;
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
                           <div class="editIconContactAndAddresses">
                               <a href="editContact.php?email=' . $contact['email'] . '&number=' . $numberOfContact . '"><img class="manageIcon" src="images/editIcon.jpg" alt="editIcon" width="50px"></a>
                           </div>';
                    if ($numberOfContact != 1) {
                        $contactId = getContactIdFromMail($conn, $contact['email']);
                        echo '<div class="removeIconContactAndAddresses">
                                 <a href="serverActions/deleteContact.php?idContact=' . $contactId . '"><img class="manageIcon" class="XIcon" src="images/xIcon.png" alt="XIcon" width="50px"/></a>
                              </div>';
                    }
                    echo '</div>';
                    $numberOfContact++;
                }
                ?>
                <div class="addIconContact">
                    <a class="addIcon" href="addContact.php"><img src="images/addIcon.png" alt="addIcon" width="80px"></a>
                </div>
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
                             <div class="editIconContactAndAddresses">
                                <a href="editAddresses.php?id=' . $address['idAddress'] . '"><img class="manageIcon" src="images/editIcon.jpg" alt="editIcon" width="50px"></a>
                             </div>
                            <div class="removeIconContactAndAddresses">
                                <a href="serverActions/deleteAddress.php?id=' . $address['idAddress'] . '"><img class="manageIcon" src="images/xIcon.png" alt="XIcon" width="50px"/></a>
                            </div>
                          </div>';
                }
                ?>
                <div class="addIconAddresses">
                    <a class="addIcon" href="addAddress.php"><img src="images/addIcon.png" alt="addIcon" width="80px"></a>
                </div>
            </div>
        </div>
    </div>
<?php include('footer.php'); ?>