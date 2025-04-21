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
    //Add to Cart
    if(isset($_POST['addToCart'])){
        $product_id = $_POST['product_id'];
        if(isset($_SESSION['cart'][$product_id])){
            $_SESSION['cart'][$product_id]['quantity'] += 1;
        }
        else{
            $_SESSION['cart'][$product_id]['quantity'] = 1;
        }
    }
    $products_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

    ?>    
    <!--logo-->
    <div id="top" class="nav">
        <img src="./images/logo_mono.png" width="70">
    </div>
    <!--nav bar-->
    <div id="top" class="nav">
        <a class="active" href="index.php">Home</a>
        <a href="about.html">About</a>
        <a href="cart.php">
            <i class="material-icons">shopping_cart</i>
            <span class="icon" style="background-color: #495e7d;"><?=$products_in_cart ?></span>
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