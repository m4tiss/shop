<?php include_once('settings.php') ?>
<?php include('navbar.php'); ?>
<div class="mainContainer">
    <div class="filtrationAndSort">
        <h1 class="filtrationAndSortingTitle">FILTRUJ</h1>
        <h2 class="filtrationAndSortingSubtitle">Marka</h2>
        <ul>
            <?php include_once('config.php');

            $getProducers = "SELECT nameProducer FROM producers";

            if ($producers_Result = mysqli_query($conn, $getProducers)) {
                if (mysqli_num_rows($producers_Result) > 0) {
                    echo '<ul class=producersFiltration>';
                    while ($row = mysqli_fetch_assoc($producers_Result)) {
                        $producerName = $row['nameProducer'];
                        echo '<li class="producerContainer">
                    <input class="checkboxProducer" type="checkbox" id="' . $producerName . '" name="' . $producerName . '" value="' . $producerName . '">
                    <label class="producerNameLabel" for="' . $producerName . '">' . $producerName . '</label><br>
                  </li>';
                    }
                    echo '</ul>';
                } else {
                    echo "Brak dostępnych producentów.";
                }
            } else {
                echo "Błąd zapytania do bazy danych: " . mysqli_error($conn);
            }

            ?>
        </ul>


        <h2 class="filtrationAndSortingSubtitle">Kategoria</h2>
        <ul>
            <?php include_once('config.php');

            $getCategories = "SELECT nameCategory FROM categories WHERE storeDepartament='footwear'";

            if ($categories_Result = mysqli_query($conn, $getCategories)) {
                if (mysqli_num_rows($categories_Result) > 0) {
                    echo '<ul class=producersFiltration>';
                    while ($row = mysqli_fetch_assoc($categories_Result)) {
                        $categoryName = $row['nameCategory'];
                        $categorySplitName = str_replace(array(' ', '\t', '\n', '\r'), '', $categoryName);
                        echo '<li class="categoryContainer">
                    <input class="checkboxCategory" type="checkbox" id="' . $categoryName . '" name="' . $categoryName . '" value="' . $categorySplitName . '">
                    <label class="categoryNameLabel" for="' . $categoryName . '">' . $categoryName . '</label><br>
                  </li>';
                    }
                    echo '</ul>';
                } else {
                    echo "Brak dostępnych producentów.";
                }
            } else {
                echo "Błąd zapytania do bazy danych: " . mysqli_error($conn);
            }

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

        <?php include_once('config.php');

        $getProducts = "SELECT * FROM products";

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

                    echo '<div class="productLayout '.$categoryProductName.' '.$producerProductName.'">';
                    echo '<a class="linkToPageProduct" href="product.php?id=' . $productId . '">';
                    echo '<div class="photoProductContainer">';
                    echo '<img src="images/' . $productImage . '" alt="' . $productName . '">';
                    echo '</div>';
                    echo '<div class="productInfo">';
                    echo '<h3 class="productName">' . $productName . '</h3>';
                    echo '<h3 class="productPrice">' . $productPrice . 'zł</h3>';
                    echo '</div>';
                    echo '</a>';
                    echo '</div>';
                }
            } else {
                echo "Brak dostępnych produktów.";
            }
        } else {
            echo "Błąd zapytania do bazy danych: " . mysqli_error($conn);
        }

        ?>
    </div>
</div>
<script src="filtration.js"></script>
<?php include('footer.php'); ?>
