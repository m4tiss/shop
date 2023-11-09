<?php include_once('settings.php')?>
<?php include('navbar.php');
include('functions.php');
session_start();
?>

<div class="paymentsContainer">
    <div class="payments">
        <div class="payment">
                <input type="radio" name="selectedPayment" value="">
                <img src="icons/payu.png" width="200px">
        </div>
    </div>
    <button class="button">Złóź zamówienie</button>
</div>


<?php include('footer.php'); ?>
