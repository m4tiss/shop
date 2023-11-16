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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST["name"];
    $store = $_POST["productType"];
    $IdCategory = $_POST["productCategory"];
    $IdProducer = $_POST["productProducer"];
    $productDescription = $_POST["productDescription"];
    $productPrice = $_POST["productPrice"];
    $discount = 0;

    $photoName = $_FILES["productPhoto"]["name"];
    $photoTmpName = $_FILES["productPhoto"]["tmp_name"];
    $photoSize = $_FILES["productPhoto"]["size"];
    $photoError = $_FILES["productPhoto"]["error"];

    if ($photoError === 0) {
        $targetDirectory = "images/";
        $targetPath = $targetDirectory . $photoName;

        move_uploaded_file($photoTmpName, $targetPath);
        addProductToDBAdmin($conn,$productName,$IdCategory,$IdProducer,$productDescription,$productPrice,$photoName,$discount);
        header("Location: addProductAdmin.php");
        exit();
    } else {
        echo "Błąd przesyłania pliku.";
    }
}

$products = getAllProducts($conn);

echo '<div class="addContainer" >';
foreach ($products as $product) {
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
<form class="addSizeForm" action="addProductAdmin.php" method="post" enctype="multipart/form-data">
    <h2>Obuwie</h2>
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
    <label for="productProducer">Wybierz producenta produktu:</label>
    <select name="productProducer" id="productProducer" required>';
$producers = getProducersByStore($conn,'footwear');
foreach ($producers as $producer) {
    echo '<option value="' . $producer['idProducer'] . '">' . $producer['nameProducer'] . '</option>';
}
echo '</select>
    <label for="productPhoto">Dodaj zdjęcie produktu:</label>
    <input type="file" name="productPhoto" id="productPhoto" accept="image/*" required>
    <label for="productDescription">Dodaj opis produktu:</label>
    <textarea name="productDescription" id="productDescription" placeholder="Wpisz opis produktu" rows="4" required></textarea>
     <label for="productPrice">Podaj cenę produktu:</label>
    <input type="number" name="productPrice" id="productPrice" placeholder="Podaj cenę" step="0.01" required>
    <button type="submit">Dodaj produkt</button>
</form>

<form class="addSizeForm" action="addProductAdmin.php" method="post" enctype="multipart/form-data">
    <h2>Odzież</h2>
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
    <label for="productProducer">Wybierz producenta produktu:</label>
    <select name="productProducer" id="productProducer" required>';
$producers = getProducersByStore($conn,'clothes');
foreach ($producers as $producer) {
    echo '<option value="' . $producer['idProducer'] . '">' . $producer['nameProducer'] . '</option>';
}
echo '</select>
    <label for="productPhoto">Dodaj zdjęcie produktu:</label>
    <input type="file" name="productPhoto" id="productPhoto" accept="image/*" required>
    <label for="productDescription">Dodaj opis produktu:</label>
    <textarea name="productDescription" id="productDescription" placeholder="Wpisz opis produktu" rows="4" required></textarea>
     <label for="productPrice">Podaj cenę produktu:</label>
    <input type="number" name="productPrice" id="productPrice" placeholder="Podaj cenę" step="0.01" required>
    <button type="submit">Dodaj produkt</button>
</form>

<form class="addSizeForm" action="addProductAdmin.php" method="post" enctype="multipart/form-data">
    <h2>Akcesoria</h2>
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
    <label for="productProducer">Wybierz producenta produktu:</label>
    <select name="productProducer" id="productProducer" required>';
$producers = getProducersByStore($conn,'accessories');
foreach ($producers as $producer) {
    echo '<option value="' . $producer['idProducer'] . '">' . $producer['nameProducer'] . '</option>';
}
echo '</select>
    <label for="productPhoto">Dodaj zdjęcie produktu:</label>
    <input type="file" name="productPhoto" id="productPhoto" accept="image/*" required>
    
    <label for="productDescription">Dodaj opis produktu:</label>
    <textarea name="productDescription" id="productDescription" placeholder="Wpisz opis produktu" rows="4" required></textarea>
    
     <label for="productPrice">Podaj cenę produktu:</label>
    <input type="number" name="productPrice" id="productPrice" placeholder="Podaj cenę" step="0.01" required>
    
    <button type="submit">Dodaj produkt</button>
</form>
</div>
    </div>
</div>';
echo '</div>';


include('footer.php'); ?>


