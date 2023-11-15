<?php include_once('settings.php');
include('navbar.php');
include('functions.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//    $email = $_POST['email'];
//    $phoneNumber = $_POST['phoneNumber'];
//    $userId=$_SESSION['users'];
//    header("Location:account.php?error=1");
}

$sizes = getAllSizes($conn);

echo'<div class="addSizeContainer">';

echo '<h2>Dostępne rozmiary w STEP IN STYLE</h2>';
foreach($sizes as $size){


    echo $size['idSize'];
    echo $size['storeDepartament'];
    echo $size['nameSize'];
}

echo'</div>';



//echo '
//<div class="contentContainer">
//    <div class="editFormDiv">
//        <form class="editForm" method="post" action="addContact.php">
//            <label class="editInfo" for="email">Email:</label>
//             <input class="editInput" type="email" id="email" name="email" placeholder="Email" required><br><br>
//            <label class="editInfo" for="phoneNumber">Numer telefonu:</label>
//            <input class="editInput" type="text" id="phoneNumber" name="phoneNumber" placeholder="Numer telefonu" required><br><br>
//            <input class="button" type="submit" value="Dodaj">
//        </form>
//    </div>
//</div>
//';

include('footer.php'); ?>

