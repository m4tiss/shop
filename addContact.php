<?php include_once('settings.php');
include('navbar.php');
include('functions/functionsUser.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $userId=$_SESSION['users'];
    if(!isEmailExists($conn, $email)){
        addContactToDB($conn,$userId,$email,$phoneNumber);
        header("Location:account.php");
    }
    else{
        header("Location:account.php?error=1");
    }
}
echo '
<div class="contentContainer">
    <div class="editFormDiv">
        <form class="editForm" method="post" action="addContact.php">
            <label class="editInfo" for="email">Email:</label>
             <input class="editInput" type="email" id="email" name="email" placeholder="Email" required><br><br>
            <label class="editInfo" for="phoneNumber">Numer telefonu:</label>
            <input class="editInput" type="tel" id="phoneNumber" name="phoneNumber" pattern="[0-9]{9}" placeholder="Numer telefonu" required><br><br>
            <input class="button" type="submit" value="Dodaj">
        </form>
    </div>
</div>
';

include('footer.php'); ?>
