<?php include_once('settings.php');
include('functions/functionsUser.php');
include('navbar.php'); ?>
<div class="mainContainer">
    <div class="filtrationAndSort">
        <h1 class="filtrationAndSortingTitle">FILTRUJ</h1>
        <h2 class="filtrationAndSortingSubtitle">Marka</h2>
        <ul>
            <?php include_once('config.php');
            $storeDepartament = $_GET['store'] ?? '';
            $producers = getProducersByStore($conn, $storeDepartament);
            echo '<ul class=producersFiltration>';
            foreach ($producers as $producer) {
                if (checkProducerProducts($conn, $producer['idProducer'])) {
                    echo '<li class="producerContainer">
                        <input class="checkboxProducer" type="checkbox" id="' . $producer['nameProducer'] . '" name="' . $producer['nameProducer'] . '" value="' . $producer['nameProducer'] . '">
                        <label class="producerNameLabel" for="' . $producer['nameProducer'] . '">' . $producer['nameProducer'] . '</label><br>
                     </li>';
                }
            }
            echo '</ul>';
            ?>
        </ul>
        <h2 class="filtrationAndSortingSubtitle">Kategoria</h2>
        <ul>
            <?php
            $categoriesFromStore = getCategoriesByStore($conn, $storeDepartament);
            echo '<ul class=producersFiltration>';
            foreach ($categoriesFromStore as $category) {
                $categorySplitName = str_replace(array(' ', '\t', '\n', '\r'), '', $category['nameCategory']);

                if (checkCategoryProducts($conn, $category['idCategory'])) {
                    echo '<li class="categoryContainer">
                        <input class="checkboxCategory" type="checkbox" id="' . $category['nameCategory'] . '" name="' . $category['nameCategory'] . '" value="' . $categorySplitName . '">
                        <label class="categoryNameLabel" for="' . $category['nameCategory'] . '">' . $category['nameCategory'] . '</label><br>
                      </li>';
                }
            }
            echo '</ul>';
            ?>
        </ul>
        <h1 class="filtrationAndSortingTitle">SORTUJ</h1>
        <select class="selectSorting" name="sort" id="sort">
            <option value="ascending">Rosnąco</option>
            <option value="descending">Malejąco</option>
            <option value="A-Z">A-Z</option>
            <option value="Z-A">Z-A</option>
        </select>
        <button id="button" class="button" onclick="filterProducts()">Zastosuj</button>
    </div>
    <div id="productsContainer" class="contentDiv">
        <?php
        $categories = [];
        foreach ($categoriesFromStore as $category) {
            $categories[] = $category['idCategory'];
        }
        $categoryCondition = implode(',', $categories);
        $products = getProductsByCategoryCondition($conn, $categoryCondition);
        if (!empty($categories)) {
            foreach ($products as $product) {
                $category = getCategoryById($conn, $product['idCategory']);
                $categoryProductName = $category['nameCategory'];
                $categoryProductName = str_replace(array(' ', '\t', '\n', '\r'), '', $categoryProductName);
                $producer = getProducerById($conn, $product['idProducer']);
                $producerProductName = $producer['nameProducer'];
                $producerProductName = str_replace(array(' ', '\t', '\n', '\r'), '', $producerProductName);
                echo '<div class="productLayout ' . $categoryProductName . ' ' . $producerProductName . '">
                          <a class="linkToPageProduct" href="product.php?id=' . $product['idProduct'] . '">
                            <div class="photoProductContainer">
                                <img src="images/' . $product['image'] . '" alt="' . $product['nameProduct'] . '">
                             </div>
                             <div class="productInfo">
                                <h3 class="productName">' . $product['nameProduct'] . '</h3>';
                echo '<h3 class="productPrice">' . number_format($product['price'], 2) . ' zł</h3>
                            </div>
                          </a>
                      </div>';
            }
        }
        ?>
    </div>
</div>
<script src="scripts/filtration.js"></script>
<?php include('footer.php'); ?>
