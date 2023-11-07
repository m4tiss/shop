<?php include_once('settings.php');
include('navbar.php');
include('functions.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $userId=$_SESSION['users'];
    $contactId =  $_POST['idContact'];
    if(isEmailExists($conn,$email)===false or isEmailExists($conn,$email)==$contactId){
        editContactInDB($conn,$contactId,$userId,$email,$phoneNumber);
        header("Location:account.php");
    }
    else{
        header("Location:account.php?error=1");
    }
}

$email = $_GET['email'] ?? '';
$number = $_GET['number'] ?? '';

$phoneNumber = getPhoneNumberFromMail($conn, $email);
$contactId = getContactIdFromMail($conn,$email);
echo '
<div class="contentContainer">
    <div class="editFormDiv">
        <form class="editForm" method="post" action="editContact.php">
            <label class="editInfo" for="email">Email:</label>';

echo ($number == 1) ? '<input class="disabledInput" type="email" id="email" name="email" value="' . $email . '" readonly><br><br>' :
    '<input class="editInput" type="email" id="email" name="email" value="' . $email . '" required><br><br>';
echo '
            <label class="editInfo" for="phoneNumber">Numer telefonu:</label>
            <input class="editInput" type="text" id="phoneNumber" name="phoneNumber" value="' . $phoneNumber . '" required><br><br>
             <input type="hidden" name="idContact" value="'.$contactId.'" />
            <input class="button" type="submit" value="Zapisz zmiany">
        </form>
    </div>
</div>
';
include('footer.php'); ?>
