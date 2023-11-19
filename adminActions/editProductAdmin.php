<?php include_once('../settings.php');
include('../navbar.php');
include('../functions.php');
session_start();


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $idProduct = $_GET['id'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idProduct =$_POST["idProduct"];
    $productName = $_POST["name"];
    $productDescription = $_POST["productDescription"];
    $productPrice = $_POST["productPrice"];
    updateProductAdmin($conn,$idProduct,$productName,$productDescription,$productPrice);
    header("Location: manageProductAdmin.php");
    exit();
}

$product = getProductById($conn,$idProduct);

echo '
 <div class="addContainer">
     <div class="forms">
        <form class="addSizeForm" action="editProductAdmin.php" method="post">
            <h2>Edytuj produkt</h2>
            <label for="name">Zmień nazwę:</label>
            <input class ="addInput" type="text" name="name" id="name" value="'.$product['name'].'" required>';
        echo '
                <label for="productDescription">Zmień opis produktu:</label>
                <textarea class="textAreaAdmin" name="productDescription" id="productDescription" required>'.$product['description'].'</textarea>
                 <label for="productPrice">Zmień cenę:</label>
                <input class="inputPriceAdmin" type="number" name="productPrice" id="productPrice" value="'.$product['price'].'" step="0.01" required>
                <input type="text" name="idProduct" id="idProduct" value="'.$product['id'].'" hidden>
                <button  class="adminButton" type="submit">Edytuj produkt</button>
        </form>
      </div>
</div>';



include('../footer.php'); ?>




