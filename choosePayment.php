<?php include_once('settings.php') ?>
<?php include('navbar.php');
include('functions/functionsUser.php');
session_start();

if (empty($_SESSION['users'])) {
    header("Location: login.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idContact = $_POST['selectedContact'];
    $idAddress = $_POST['selectedAddress'];
    $contactToCheck = getPhoneByIdContact($conn,$idContact);
    if($contactToCheck['phoneNumber']==='000000000'){
        header("Location: chooseContactAndAddress.php");
        exit();
    }
}
$_SESSION['order_completed']=true;
?>

<div class="paymentsContainer">
    <form method="post" action="completeOrder.php">
        <div class="payments">
            <?php
            $paymentMethods = getAllPaymentMethods($conn);
            foreach ($paymentMethods as $paymentMethod) {
                echo ' <div class="payment">
                           <input type="radio" name="selectedPayment" value="' . $paymentMethod['idPayment'] . '">
                           <img src="icons/' . $paymentMethod['icon'] . '" alt="' . $paymentMethod['icon'] . '" width="200px">
                        </div>';
            }
            ?>
            <button type="submit" class="button">Złóź zamówienie</button>
        </div>
    </form>
</div>

<?php include('footer.php'); ?>
