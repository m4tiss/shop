<?php include_once('settings.php');
include('navbar.php');
include('functions.php');
session_start();


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $idProduct = $_GET['id'];
    deleteProductFromDbAdmin($conn, $idProduct);
    header("Location: addProductAdmin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//    $nameSize = $_POST['size'];
//    $productType = $_POST['productType'];
//    addSizeToDB($conn,$productType,$nameSize);
//    header("Location: addSizeAdmin.php");
//    exit();
}

$products = getAllProducts($conn);

echo '<div class="addContainer" >';
foreach ($products as $product) {
//                   $product['idProduct'] = $row['idProduct'];
//                $product['idCategory'] = $row['idCategory'];
//                $product['idProducer'] = $row['idProducer'];
//                $product['price'] = $row['price'];
//                $product['image'] = $row['image'];
//                $product['description'] = $row['description'];
//                $product['nameProduct'] = $row['nameProduct'];
//                $products[$i] = $product;
    $category = getCategoryById($conn, $product['idCategory']);
    $producer = getProducerById($conn, $product['idProducer']);

    echo '<div class="product">
            <img src="images/' . $product['image'] . '" width="80px">
            <h3>' . $producer['nameProducer'] . '</h3>
            <h3>' . $category['nameCategory'] . '</h3>
            <h3>' . $product['nameProduct'] . '</h3>
            <h3>' . $product['price'] . ' zł</h3>
            <a href="addProductAdmin.php?id=' . $product['idProduct'] . '"><img src="images/xIcon.png" width="40px"></a>
        </div>';
}

echo '
<div class="forms">
<form class="addSizeForm" action="addProductAdmin.php" method="post">
    <label for="name">Wpisz nazwę:</label>
    <input type="text" name="name" id="name" placeholder="Wpisz nazwę" required>

    <label for="productType">Wybierz dział produktu:</label>
    <select name="productType" id="productType" required>
        <option value="footwear">Obuwie</option>
    </select
    <label for="productCategory">Wybierz kategorię produktu:</label>
    <select name="productCategory" id="productCategory" required>';
$categories = getCategoriesByStore($conn, 'footwear');
foreach ($categories as $category) {
    echo '<option value="' . $category['idCategory'] . '">' . $category['nameCategory'] . '</option>';
}
echo '</select>

    <button type="submit">Dodaj rozmiar</button>
</form>

<form class="addSizeForm" action="addProductAdmin.php" method="post">
    <label for="name">Wpisz nazwę:</label>
    <input type="text" name="name" id="name" placeholder="Wpisz nazwę" required>

    <label for="productType">Wybierz dział produktu:</label>
    <select name="productType" id="productType" required>
        <option value="clothes">Odzież</option>
    </select>

    <label for="productCategory">Wybierz kategorię produktu:</label>
    <select name="productCategory" id="productCategory" required>';
$categories = getCategoriesByStore($conn, 'clothes');
foreach ($categories as $category) {
    echo '<option value="' . $category['idCategory'] . '">' . $category['nameCategory'] . '</option>';
}
echo '
    </select>

    <button type="submit">Dodaj rozmiar</button>
</form>

<form class="addSizeForm" action="addProductAdmin.php" method="post">
    <label for="name">Wpisz nazwę:</label>
    <input type="text" name="name" id="name" placeholder="Wpisz nazwę" required>

    <label for="productType">Wybierz dział produktu:</label>
    <select name="productType" id="productType" required>
        <option value="accessories">Akcesoria</option>
    </select>

    <label for="productCategory">Wybierz kategorię produktu:</label>
    <select name="productCategory" id="productCategory" required>';
$categories = getCategoriesByStore($conn,'accessories');
foreach ($categories as $category){
    echo'<option value="'.$category['idCategory'].'">'.$category['nameCategory'].'</option>';
}
echo'
    </select>

    <button type="submit">Dodaj rozmiar</button>
</form>
</div>
    </div>
</div>';
echo '</div>';


include('footer.php'); ?>


