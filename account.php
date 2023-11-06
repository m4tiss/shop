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
        $user = getUserById($conn,$_SESSION['users']);
        echo'<p class="name">'.$user['name'].'</p>
                <h2>Nazwisko:</h2>
             <p class="surname">'.$user['surname'].'</p>';
        ?>
        <div class="contactsAndAddresses">
            <div class="contactsAndAddressesContainer">
                <h2>Kontakty</h2>
                <div class="contactDiv">
                    <div class="contactAndAddressesContent">
                        <h3 class="contactInfo">Email</h3>
                        <p class="contactEmail">testowy@op.pl</p>
                        <h3 class="contactInfo">Numer telefonu</h3>
                        <p class="contactNumber">797 094 698</p>
                    </div>
                    <div class="editIconContactAndAddresses">
                        <img src="images/editIcon.jpg" width="50px">
                    </div>
                </div>
                <div class="addIconContact">
                    <img src="images/addIcon.png" width="80px">
                </div>

            </div>
            <div class="contactsAndAddressesContainer">
                <h2>Adresy</h2>
                <div class="addressDiv">
                    <div class="contactAndAddressesContent">
                        <h3>Miasto</h3>
                        <p>Zgierz</p>
                        <h3>Kod pocztowy</h3>
                        <p>95-100</p>
                        <h3>Ulica</h3>
                        <p>Wincentego Witosa</p>
                        <h3>Numer mieszkania</h3>
                        <p>32</p>
                    </div>
                    <div class="editIconContactAndAddresses">
                        <img src="images/editIcon.jpg" width="50px">
                    </div>
                </div>
                <div class="addIconAddresses">
                    <img src="images/addIcon.png" width="80px">
                </div>
            </div>

        </div>
    </div>

<?php include('footer.php'); ?>