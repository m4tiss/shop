<?php include_once('../settings.php');
include('../navbar.php');
include('../functions/functionsAdmin.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nameProducer = $_POST['producer'];
    $productType = $_POST['productType'];
    addProducerToDB($conn,$productType,$nameProducer);
    header("Location: addProducerAdmin.php");
    exit();
}

$producers = getAllProducers($conn);

echo '<div class="addContainer">';

echo '<h2>Dostępni producenci w STEP IN STYLE</h2>
       <div class="sizes">
';
foreach ($producers as $producer) {
    if ($producer['storeDepartament'] === 'footwear') {
        echo '<div class="sizePanel">
                <img src="../icons/shoe.png" width="80px">
                <h3>' . $producer['nameProducer'] . '</h3>
            </div>';
    } elseif ($producer['storeDepartament'] === 'clothes') {
        echo '<div class="sizePanel">
                <img src="../icons/product.jpg" width="100px">
                <h3>' . $producer['nameProducer'] . '</h3>
            </div>';
    }
    elseif ($producer['storeDepartament'] === 'accessories') {
        echo '<div class="sizePanel">
                <img src="../icons/socks.jpg" width="100px">
                <h3>' . $producer['nameProducer'] . '</h3>
            </div>';
    }
}
echo '
    </div>
    <form class="addSizeForm" action="addProducerAdmin.php" method="post">
    <label for="producer">Wpisz producenta:</label>
   <input class = "addInput" type="text" name="producer" id="producer" placeholder="Wpisz producenta" required>
    
    <label for="productType">Wybierz dział produktu:</label>
    <select class="selectAdmin" name="productType" id="productType" required>
        <option value="footwear">Obuwie</option>
       <option value="clothes">Odzież</option>
       <option value="accessories">Akcesoria</option>
    </select>
    <button  class="adminButton" type="submit">Dodaj producenta</button>
   </form>
</div>';

include('../footer.php'); ?>

