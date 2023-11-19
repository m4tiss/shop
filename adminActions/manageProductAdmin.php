<?php include_once('../settings.php');
include('../navbar.php');
include('../functions/functionsAdmin.php');
session_start();


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $idProduct = $_GET['id'];
    deleteProductFromDbAdmin($conn, $idProduct);
    header("Location: manageProductAdmin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $store = $_POST["productType"];
    header("Location: addProductAdmin.php?store=$store");
    exit();
}

$products = getAllProducts($conn);

echo '<div class="addContainer" >';
foreach ($products as $product) {
    $category = getCategoryById($conn, $product['idCategory']);
    $producer = getProducerById($conn, $product['idProducer']);

    $price = number_format($product['price'],2);
    echo '<div class="product">
            <img src="../images/' . $product['image'] . '" width="80px">
            <h3>' . $producer['nameProducer'] . '</h3>
            <h3>' . $category['nameCategory'] . '</h3>
            <h3>' . $product['nameProduct'] . '</h3>
            <h3>' . $price . ' zł</h3>
            <a href="editProductAdmin.php?id=' . $product['idProduct'] . '"><img class="manageIcon" src="../images/editIcon.jpg" width="40px"></a>
            <a href="manageProductAdmin.php?id=' . $product['idProduct'] . '"><img class="manageIcon" src="../images/xIcon.png" width="40px"></a>
        </div>';
}

echo '
<div class="forms">
<form class="addSizeForm" action="manageProductAdmin.php" method="post">
    <label for="productType">Wybierz dział produktu:</label>
    <select class="selectAdmin" name="productType" id="productType" required>
        <option value="footwear">Obuwie</option>
        <option value="clothes">Odzież</option>
        <option value="accessories">Akcesoria</option>
    </select>
   <button  class="adminButton" type="submit" >Dodaj produkt</button>
</form>
        </div>
    </div>
</div>';
echo '</div>';


include('../footer.php'); ?>


