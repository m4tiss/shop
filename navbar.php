<link rel="stylesheet" href="styles/navbar.css">

<div class="navBar">
    <div class="logo">
        <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/shop/index.php">
            <img src="../icons/shopLogo.png" alt="logoIcon" width="120px">
        </a>
    </div>
    <h1 class="naviText"><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/shop/content.php?store=clothes">Odzież</a></h1>
    <h1 class="naviText"><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/shop/content.php?store=footwear">Obuwie</a></h1>
    <h1 class="naviText"><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/shop/content.php?store=accessories">Akcesoria</a>
    </h1>
    <div class="navBarIcon">
        <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/shop/basket.php">
            <img src="../icons/shopping-cart.png" alt="shopping-cart" width="50px" height="50px">
        </a>
    </div>
    <div class="navBarIcon">
        <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/shop/login.php">
            <img src="../icons/user.png" alt="userIcon" width="50px" height="50px">
        </a>
    </div>
</div>
