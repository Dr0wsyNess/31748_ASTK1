<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="index" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Drowsy Grocery</title>
</head>

<body>
    <?php
    session_start();
    //Add to Cart
    if(isset($_POST['addToCart'])){
        $product_id = $_POST['product_id'];
        if(isset($_SESSION['cart'][$product_id])){
            //if product exist in cart add one to quantity
            $_SESSION['cart'][$product_id]['quantity'] += 1;
        }
        else{
            // if not add new product
            $_SESSION['cart'][$product_id]['quantity'] = 1;
        }
    }
    //add a product count next to cart symbol to show the amount of items in cart;
    $products_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

    ?>    
    <!--logo-->
    <div id="top" class="nav">
        <a href="index.php"><img class="logo" src="./images/logo_mono.png" width="70"><a>
    </div>
    <!--nav bar-->
    <div id="top" class="nav">
        <a class="active" href="index.php">Home</a>
        <!-- <a href="about.html">About</a> -->
        <a href="cart.php">
            <i class="material-icons">shopping_cart</i>
            <span class="icon" style="background-color: #495e7d;"><?=$products_in_cart ?></span>
        </a>
    </div>
    <!--Catalogue sidenav-->
    <?php include('category.php'); ?>

    <!-- search bar -->
    <div>
        <form action="index.php" method="get" class="searchbar">
            <input type="text" placeholder="Search products..." name="searchedProduct">
            <button type="submit" value="retrieveData"><i class="material-icons">search</i></button>
        </form>
    </div>

    <div class="main">
    <?php include('products.php'); ?>
    </div>

    <!--Shopping Cart-->
    <div>
        <a href="cart.php">
            <button class="shopping-btn">
                <i class="material-icons">shopping_cart</i>
                <span class="icon"><?=$products_in_cart ?></span>
            </button>
        </a>
    </div>
    <script src="./js/script.js"></script>

</body>

</html>