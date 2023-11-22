<?php
include_once('settings.php');
include_once 'config.php';
include('navbar.php');
include_once 'functions/functionsUser.php';
session_start();

if (empty($_SESSION['users'])) {
    header("Location: login.php");
    exit();
}

?>

<div class="ordersContainer">
    <div class="orders">
        <?php
        $userId = $_SESSION['users'];
        $contacts = getContactsById($conn, $userId);
        $orders = getAllOrdersByEmail($conn, $contacts[0]['email']);
        foreach ($orders as $order) {
            $status = getStatus($conn, $order['idStatus']);
            echo '
                <div class="order">
            <div class="iconContainer">
                <img src="icons/historyOrderIcon.jpg" alt="historyOrderIcon" width="100px">
            </div>
            <h3> Data: ' . $order['dateOrder'] . '</h3>
            <h3> Koszt: ' . number_format($order['cost'],2) . ' zł</h3>
            <h3 class="statusInfoIcon" >Status: ' . $status['nameStatus'] . '<img src="../icons/'.$status['icon'].'" width="40px"></h3> 
            <a href="orderdetails.php?idOrder=' . $order['idOrder'] . '"><button class="historyButton">Zobacz szczegóły</button></a>
        </div>
        ';
        }
        ?>
    </div>
</div>

<?php include('footer.php'); ?>
