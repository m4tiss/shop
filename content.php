<?php include_once('settings.php');
include ('functions.php');
include('navbar.php'); ?>
<div class="mainContainer">
    <div class="filtrationAndSort">
        <h1 class="filtrationAndSortingTitle">FILTRUJ</h1>
        <h2 class="filtrationAndSortingSubtitle">Marka</h2>
        <ul>
            <?php include_once('config.php');
            $storeDepartament = $_GET['store'] ?? '';
            $producers = getProducersByStore($conn,$storeDepartament);
            echo '<ul class=producersFiltration>';
            foreach ($producers as $producer){
                echo '<li class="producerContainer">
                <input class="checkboxProducer" type="checkbox" id="' . $producer['nameProducer'] . '" name="' . $producer['nameProducer'] . '" value="' . $producer['nameProducer'] . '">
                  <label class="producerNameLabel" for="' . $producer['nameProducer'] . '">' . $producer['nameProducer'] . '</label><br>
                 </li>';
            }
            echo '</ul>';
            ?>
        </ul>


        <h2 class="filtrationAndSortingSubtitle">Kategoria</h2>
        <ul>
            <?php
            $categoriesFromStore = getCategoriesByStore($conn,$storeDepartament);
            echo '<ul class=producersFiltration>';
            foreach ($categoriesFromStore as $category){
                $categorySplitName = str_replace(array(' ', '\t', '\n', '\r'), '', $category['nameCategory']);
                        echo '<li class="categoryContainer">
                    <input class="checkboxCategory" type="checkbox" id="' . $category['nameCategory'] . '" name="' . $category['nameCategory'] . '" value="' . $categorySplitName . '">
                    <label class="categoryNameLabel" for="' . $category['nameCategory'] . '">' . $category['nameCategory'] . '</label><br>
                  </li>';
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
        foreach($categoriesFromStore as $category){
            $categories[] = $category['idCategory'];
        }
        $categoryCondition = implode(',', $categories);

        $getProducts = "SELECT * FROM products WHERE idCategory IN ($categoryCondition)";

//        getProductsBy

        if (!empty($categories)) {
            if ($products_Result = mysqli_query($conn, $getProducts)) {
                if (mysqli_num_rows($products_Result) > 0) {
                    while ($row = mysqli_fetch_assoc($products_Result)) {
                        $productName = $row['nameProduct'];
                        $productPrice = $row['price'];
                        $productImage = $row['image'];
                        $productId = $row['idProduct'];
                        $productCategory = $row['idCategory'];
                        $productProducerId = $row['idProducer'];

                        $getCategoryName = "SELECT nameCategory FROM categories WHERE idCategory=$productCategory";
                        $category_Result = mysqli_query($conn, $getCategoryName);
                        $row_with_categoryName = mysqli_fetch_assoc($category_Result);

                        $categoryProductName = $row_with_categoryName['nameCategory'];
                        $categoryProductName = str_replace(array(' ', '\t', '\n', '\r'), '', $categoryProductName);

                        $getProducerName = "SELECT nameProducer FROM producers WHERE idProducer=$productProducerId";
                        $producer_Result = mysqli_query($conn, $getProducerName);
                        $row_with_producerName = mysqli_fetch_assoc($producer_Result);

                        $producerProductName = $row_with_producerName['nameProducer'];
                        $producerProductName = str_replace(array(' ', '\t', '\n', '\r'), '', $producerProductName);

                        echo '<div class="productLayout ' . $categoryProductName . ' ' . $producerProductName . '">';
                        echo '<a class="linkToPageProduct" href="product.php?id=' . $productId . '">';
                        echo '<div class="photoProductContainer">';
                        echo '<img src="images/' . $productImage . '" alt="' . $productName . '">';
                        echo '</div>';
                        echo '<div class="productInfo">';
                        echo '<h3 class="productName">' . $productName . '</h3>';
                        $price = number_format($productPrice,2);
                        echo '<h3 class="productPrice">' .$price. ' zł</h3>';
                        echo '</div>';
                        echo '</a>';
                        echo '</div>';
                    }
                } else {
                    echo "Brak dostępnych produktów.";
                }
            }
        } else {
            echo "Brak dostępnych produktów.";
        }

        ?>
    </div>
</div>
<script src="scripts/filtration.js"></script>
<?php include('footer.php'); ?>
