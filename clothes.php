<?php include_once('settings.php') ?>
<?php include('navbar.php'); ?>
<div class="mainContainer">
    <div class="filtrationAndSort">
        <h1>FILTR</h1>
        <h2>Marka</h2>
        <ul>
            <li>
                <input type="checkbox" id="nike" name="nike" value="Nike">
                <label for="nike">Nike</label><br>
            </li>
        </ul>
        <h2>Sortuj</h2>
        <label for="sort">Sortuj według:</label>

        <select name="sort" id="sort">
            <option value="ascending">Rosnąco</option>
            <option value="descending">Malejąco</option>
            <option value="A-Z">A-Z</option>
            <option value="Z-A">Z-A</option>
        </select>
        <button class="button">Zastosuj</button>
    </div>
    <div class="contentDiv">
        <div class="productLayout">
            <img src="images/airForce.jpg" alt="airForce">
            <div class="productInfo">
                <h3 class="productName">Air Force</h3>
                <h3 class="productPrice">260,00zł</h3>
            </div>
        </div>
        <div class="productLayout">
            <img src="images/airForce.jpg" alt="airForce">
            <div class="productInfo">
                <h3 class="productName">Air Force</h3>
                <h3 class="productPrice">260,00zł</h3>
            </div>
        </div>
        <div class="productLayout">
            <img src="images/airForce.jpg" alt="airForce">
            <div class="productInfo">
                <h3 class="productName">Air Force</h3>
                <h3 class="productPrice">260,00zł</h3>
            </div>
        </div>
        <div class="productLayout">
            <img src="images/airForce.jpg" alt="airForce">
            <div class="productInfo">
                <h3 class="productName">Air Force</h3>
                <h3 class="productPrice">260,00zł</h3>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
