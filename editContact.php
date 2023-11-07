<?php include_once('settings.php');
include('navbar.php');
include('functions.php');

$email = $_GET['email'] ?? '';

$phoneNumber = getPhoneNumberFromMail($conn,$email);
echo'
<div class="contentContainer">
    <div class="editFormDiv">
        <form class="editForm" method="post" action="">
            <label class="editInfo" for="email">Email:</label>
            <input class="editInput" type="email" id="email" name="email" value="'.$email.'" required><br><br>

            <label class="editInfo" for="phoneNumber">Numer telefonu:</label>
            <input class="editInput" type="text" id="phoneNumber" name="phoneNumber" value="'.$phoneNumber.'" required><br><br>

            <input class="button" type="submit" value="Zapisz zmiany">
        </form>
    </div>
</div>
';
include('footer.php'); ?>
