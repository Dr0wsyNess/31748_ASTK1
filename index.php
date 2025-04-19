<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="index" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <title>Online Grocery Store</title>
</head>

<body>
    <?php
    session_start();
    ?>
    <!--logo-->
    <div id="top" class="nav">
        <img src="./images/logo_mono.png" width="70">
    </div>
    <!--nav bar-->
    <div id="top" class="nav">
        <a class="active" href="index.php">Home</a>
        <a href="about.html">About</a>
        <a href="delivery.html">Delivery details</a>
        <a href="cart.html">
            <i class="material-icons">shopping_cart</i>
            Shopping cart
        </a>
    </div>

    <!--Catalogue sidenav-->
    <?php include('category.php'); ?>

    <!-- search bar -->
    <div>
        <form action="index.php" method="get">
            <input type="text" placeholder="Search products..." name="searchedProduct">
            <button type="submit" value="Retrieve Data"><i class="material-icons">search</i></button>
        </form>
    </div>

    <?php include('products.php'); ?>

    <div class="main">
        <h1>Catalogue</h1>
        <h2>Roomates</h2>
        <div class="product-categories">
            <div class="item">
                <img src="./images/kaveh_fku.png" height="100px">
                <h3>Kaveh</h3>
                <p>Price: </p>
                <button class="addCart-btn" type="button">
                    <i class="material-icons">add_shopping_cart</i>
                    Add to Cart</button>
            </div>
            <div class="item">
                <img src="./images/alhaitham_fku.png" height="100px">
                <h3>Haitham</h3>
                <p>Price: </p>
                <button class="addCart-btn" type="button">Add to Cart</button>
            </div>
            <div class="item">
                <img src="./images/kaveh_fku.png" height="100px">
                <h3>Kaveh</h3>
                <p>Price: </p>
                <button class="addCart-btn" type="button">Add to Cart</button>
            </div>
            <div class="item">
                <img src="./images/kaveh_fku.png" height="100px">
                <h3>Kaveh</h3>
                <p>Price: </p>
                <button class="addCart-btn" type="button">Add to Cart</button>
            </div>
            <div class="item">
                <img src="./images/kaveh_fku.png" height="100px">
                <h3>Kaveh</h3>
                <p>Price: </p>
                <button class="addCart-btn" type="button">Add to Cart</button>
            </div>
            <div class="item">
                <img src="./images/kaveh_fku.png" height="100px">
                <h3>Kaveh</h3>
                <p>Price: </p>
                <button class="addCart-btn" type="button">Add to Cart</button>
            </div>
            <div class="item">
                <img src="./images/kaveh_fku.png" height="100px">
                <h3>Kaveh</h3>
                <p>Price: </p>
                <button class="addCart-btn" type="button">Add to Cart</button>
            </div>
            <div class="item">
                <img src="./images/kaveh_fku.png" height="100px">
                <h3>Kaveh</h3>
                <p>Price: </p>
                <button class="addCart-btn" type="button">Add to Cart</button>
            </div>
        </div>
    </div>
    <!--Shopping Cart-->
    <div>
        <a href="cart.html">
            <button class="shopping-btn">
                <i class="material-icons">shopping_cart</i>
            </button>
        </a>
    </div>
    <script src="./js/script.js"></script>
</body>

</html>