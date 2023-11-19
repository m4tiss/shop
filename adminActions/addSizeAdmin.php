<?php include_once('../settings.php');
include('../navbar.php');
include('../functions/functionsAdmin.php');
session_start();

checkUserRoleAndRedirect($conn);


if(isset($_GET['id']) && !empty($_GET['id'])) {
    $idSize = $_GET['id'];
    deleteSizeFromDB($conn, $idSize);
    header("Location: addSizeAdmin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $nameSize = $_POST['size'];
      $productType = $_POST['productType'];
      addSizeToDB($conn,$productType,$nameSize);
      header("Location: addSizeAdmin.php");
    exit();
}

$sizes = getAllSizes($conn);

echo '<div class="addContainer">';

echo '<h2>Dostępne rozmiary w STEP IN STYLE</h2>
       <div class="sizes">
';
foreach ($sizes as $size) {

    if ($size['storeDepartament'] === 'footwear') {
        echo '<div class="sizePanel">
                <img src="../icons/shoe.png" width="80px">
                <h3>' . $size['nameSize'] . '</h3>
                <a href="addSizeAdmin.php?id=' . $size['idSize'] . '"><img class="manageIcon" src="../images/xIcon.png" width="40px"></a>
            </div>';
    } elseif ($size['storeDepartament'] === 'clothes') {
        echo '<div class="sizePanel">
                <img src="../icons/product.jpg" width="100px">
                <h3>' . $size['nameSize'] . '</h3>
                <a href="addSizeAdmin.php?id=' . $size['idSize'] . '"><img class="manageIcon" src="../images/xIcon.png" width="40px"></a>
            </div>';
    }
    elseif ($size['storeDepartament'] === 'accessories') {
        echo '<div class="sizePanel">
                <img src="../icons/socks.jpg" width="100px">
                <h3>' . $size['nameSize'] . '</h3>
                <a href="addSizeAdmin.php?id=' . $size['idSize'] . '"><img class="manageIcon" src="../images/xIcon.png" width="40px"></a>
            </div>';
    }
}
echo '
    </div>
    <form class="addSizeForm" action="addSizeAdmin.php" method="post">
    <label for="size">Wpisz rozmiar:</label>
    <input class="addInput" type="text" name="size" id="size" placeholder="Wpisz rozmiar" required>
    
    <label for="productType">Wybierz dział produktu:</label>
    <select class="selectAdmin" name="productType" id="productType" required>
        <option value="footwear">Obuwie</option>
        <option value="clothes">Odzież</option>
        <option value="accessories">Akcesoria</option>
    </select>
    <button class="adminButton" type="submit">Dodaj rozmiar</button>
    </form>
</div>';

include('../footer.php'); ?>

