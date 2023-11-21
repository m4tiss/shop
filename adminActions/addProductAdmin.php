<?php include_once('../settings.php');
include('../navbar.php');
include('../functions/functionsAdmin.php');
session_start();

checkUserRoleAndRedirect($conn);

if (isset($_GET['store']) && !empty($_GET['store'])) {
    $store = $_GET['store'];
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
        $targetDirectory = "../images/";
        $targetPath = $targetDirectory . $photoName;

        move_uploaded_file($photoTmpName, $targetPath);
        addProductToDBAdmin($conn,$productName,$IdCategory,$IdProducer,$productDescription,$productPrice,$photoName,$discount);
        header("Location: manageProductAdmin.php");
        exit();
    } else {
        echo "Błąd przesyłania pliku.";
    }
}

echo '
 <div class="addContainer">
<div class="forms">
<form class="addSizeForm" action="addProductAdmin.php" method="post" enctype="multipart/form-data">
    <h2>Obuwie</h2>
    <label for="name">Wpisz nazwę:</label>
    <input class ="addInput" type="text" name="name" id="name" placeholder="Wpisz nazwę" required>

    <select class="selectAdmin" name="productType" id="productType" hidden>
        <option value="'.$store.'">'.$store.'</option>
    </select
    <label for="productCategory">Wybierz kategorię produktu:</label>
    <select class="selectAdmin" name="productCategory" id="productCategory" required>';
$categories = getCategoriesByStore($conn, $store);
foreach ($categories as $category) {
    echo '<option value="' . $category['idCategory'] . '">' . $category['nameCategory'] . '</option>';
}
echo '</select>
    <label for="productProducer">Wybierz producenta produktu:</label>
    <select class="selectAdmin" name="productProducer" id="productProducer" required>';
$producers = getProducersByStore($conn,$store);
foreach ($producers as $producer) {
    echo '<option value="' . $producer['idProducer'] . '">' . $producer['nameProducer'] . '</option>';
}
echo '</select>
    <label for="productPhoto">Dodaj zdjęcie produktu:</label>
    <input type="file" name="productPhoto" id="productPhoto" accept="image/*" required>
    <label for="productDescription">Dodaj opis produktu:</label>
    <textarea class="textAreaAdmin" name="productDescription" id="productDescription" placeholder="Wpisz opis produktu" rows="4" required></textarea>
     <label for="productPrice">Podaj cenę produktu:</label>
    <input type="number" name="productPrice" id="productPrice" placeholder="Podaj cenę" step="0.01" required>
    <button  class="adminButton" type="submit">Dodaj produkt</button>
</form>
        </div>
    </div>
</div>';
echo '</div>';


include('../footer.php'); ?>



