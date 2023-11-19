<?php include_once('../settings.php');
include('../navbar.php');
include('../functions/functionsAdmin.php');
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idOrder = $_POST['idOrder'];
    $idStatus = $_POST['idStatus'];

    setNewOrderStatus($conn,$idOrder,$idStatus);
    header("Location: changeStatusesAdmin.php");
    exit();
}

echo '
 <div class="addContainer">
 <h2>Zmień Statusy Zamówień</h2>';

$orders = getAllOrders($conn);
foreach ($orders as $order){
    $orderPrice = number_format($order['cost'],2);
    $status = getStatus($conn,$order['idStatus']);
    $statuses = getAllStatuses($conn);
    echo '<div class="statusPanel">
                <img src="../icons/historyOrderIcon.jpg" width="80px">
                <h3>'.$order['name'].'</h3>
                <h3>'.$order['surname'].'</h3>
                <h3>'.$order['email'].'</h3>
                <h3>'. $order['dateOrder'].'</h3>
                <h3>'.$orderPrice.' zł</h3>
                <form class="orderForm" action="changeStatusesAdmin.php" method="post">
                <input type="text" name="idOrder" id="idOrder" value="'.$order['idOrder'].'" hidden>
                 <select class="selectAdmin" name="idStatus" id="idStatus" required>';
    foreach($statuses as $statusOption){
        if($status['idStatus']==$statusOption['idStatus']){
            echo'<option value="'.$statusOption['idStatus'].'" selected>'.$statusOption['nameStatus'].'</option>';
        }
        else{
            echo'<option value="'.$statusOption['idStatus'].'">'.$statusOption['nameStatus'].'</option>';
        }

    }
    echo'
                </select>
                <button class="adminButton" type="submit">Zmień status</button>
                </form>
            </div>';
}

echo'
</div>';


include('../footer.php'); ?>



