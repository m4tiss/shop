<?php include_once('settings.php');
include('navbar.php');
include_once('config.php');
include_once('functions/functionsUser.php');
session_start();
?>

<div class="adminAccountContainer">
    <h2>Panel administratora w sklepie STEP IN STYLE</h2>
    <div class="addToDB">

        <a href="adminActions/addCategoryAdmin.php">
            <div class="panelDiv">
                <h2>Dodaj kategorię</h2>
                <img src="icons/category.png" width="100px">
            </div>
        </a>
        <a href="adminActions/manageProductAdmin.php">
            <div class="panelDiv">
                <h2>Zarządzaj produktami</h2>
                <img src="icons/product.png" width="100px">
            </div>
        </a>
        <a href="adminActions/addProducerAdmin.php">
            <div class="panelDiv">
                <h2>Dodaj producenta</h2>
                <img src="icons/producer.png" width="100px">
            </div>
        </a>

        <a href="adminActions/addSizeAdmin.php">
            <div class="panelDiv">
                <h2>Zarządzaj rozmiarem</h2>
                <img src="icons/size.png" width="100px">
            </div>
        </a>

        <a href="adminActions/changeStatusesAdmin.php">
            <div class="panelDiv">
                <h2>Zmień statusy zamówień</h2>
                <img src="icons/status.png" width="100px">
            </div>
        </a>

        <a href="logout.php">
            <div class="panelDiv">
                <h2>Wyloguj</h2>
                <img src="icons/logout.png" width="100px">
            </div>
        </a>
    </div>
</div>
<?php include('footer.php'); ?>

