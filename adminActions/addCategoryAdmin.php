<?php include_once('../settings.php');
include('../navbar.php');
include('../functions/functionsAdmin.php');
session_start();

checkUserRoleAndRedirect($conn);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nameCategory = $_POST['category'];
    $productType = $_POST['productType'];
    addCategoryToDB($conn,$productType,$nameCategory);
    header("Location: addCategoryAdmin.php");
    exit();
}

$categories = getAllCategories($conn);

echo '<div class="addContainer">';

echo '<h2>Dostępne kategorie w STEP IN STYLE</h2>
       <div class="sizes">
';
foreach ($categories as $category) {
    if ($category['storeDepartament'] === 'footwear') {
        echo '<div class="sizePanel">
                <img src="../icons/shoe.png" width="80px">
                <h3>' . $category['nameCategory'] . '</h3>
            </div>';
    } elseif ($category['storeDepartament'] === 'clothes') {
        echo '<div class="sizePanel">
                <img src="../icons/product.jpg" width="100px">
                <h3>' . $category['nameCategory'] . '</h3>
            </div>';
    }
    elseif ($category['storeDepartament'] === 'accessories') {
        echo '<div class="sizePanel">
                <img src="../icons/socks.jpg" width="100px">
                <h3>' . $category['nameCategory'] . '</h3>
            </div>';
    }
}
echo '
    </div>
    <form class="addSizeForm" action="addCategoryAdmin.php" method="post">
    <label for="category">Wpisz kategorię:</label>
   <input class="addInput" type="text" name="category" id="category" placeholder="Wpisz kategorię" required>
    
    <label for="productType">Wybierz dział produktu:</label>
    <select class="selectAdmin" name="productType" id="productType" required>
        <option value="footwear">Obuwie</option>
       <option value="clothes">Odzież</option>
       <option value="accessories">Akcesoria</option>
    </select>
    <button class="adminButton" type="submit">Dodaj kategorię</button>
   </form>
</div>';

include('../footer.php'); ?>
