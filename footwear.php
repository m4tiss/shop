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
        <h1 class="filtrationAndSortingTitle">SORTUJ</h1>
        <!--        <label for="sort">:</label>-->

        <select class="selectSorting" name="sort" id="sort">
            <option value="ascending">Rosnąco</option>
            <option value="descending">Malejąco</option>
            <option value="A-Z">A-Z</option>
            <option value="Z-A">Z-A</option>
        </select>
        <button class="button">Zastosuj</button>
    </div>
    <div class="contentDiv">

        <?php include_once('config.php');

        $getProducts = "SELECT * FROM products";

        if ($products_Result = mysqli_query($conn, $getProducts)) {
            if (mysqli_num_rows($products_Result) > 0) {
                while ($row = mysqli_fetch_assoc($products_Result)) {
                    $productName = $row['nameProduct'];
                    $productPrice = $row['price'];
                    $productImage = $row['image'];

                    echo '<div class="productLayout">';
                    echo '<div class="photoProductContainer">';
                    echo '<img src="images/' . $productImage . '" alt="' . $productName . '">';
                    echo '</div>';
                    echo '<div class="productInfo">';
                    echo '<h3 class="productName">' . $productName . '</h3>';
                    echo '<h3 class="productPrice">' . $productPrice . 'zł</h3>';
                    echo '</div>';
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
<?php include('footer.php'); ?>
