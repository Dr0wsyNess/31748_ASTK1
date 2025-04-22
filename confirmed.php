
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
    $connection = mysqli_connect('localhost', 'root', '', 'ASTK1Database');

    if (isset($_POST['submitForm'])) {
        $cart = $_SESSION['cart'];
        // echo '<pre>';
        // var_dump($_SESSION);
        // echo '</pre>';
        $cart_array = implode(',', array_keys($cart));
        $query_string = "select * FROM products WHERE product_id in($cart_array)";
        $result = mysqli_query($connection, $query_string);
        while ($product = mysqli_fetch_array($result)) {
            //loop through $cart array where the key of $product_id is used to access quantity value
            foreach ($cart as $cart_id => $quantity) {
                if ($cart_id == $product['product_id']) {
                    //if stock product is 0, alert users that it is out of stock
                    if ($product['in_stock'] == 0) {
                        $message = $product['product_name'] . " is out of stock and not available anymore";
                        echo "<script>alert ('$message'); window.location.href='cart.php';</script>";
                        exit();
                    }
                    //if the cart's product quantity is greater than stock, alert users and redirect them back to cart
                    else if ($quantity['quantity'] > $product['in_stock']) {
                        $message = $product['product_name'] . " quantity is greater than stock. " . $product['in_stock'] . " stock is available";
                        echo "<script>alert ('$message'); window.location.href='cart.php';</script>";
                        exit();
                    }
                }
            }
        }
        unset($_SESSION['cart']);
        $products_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
        
    }


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
    <div class="main">
        <h1>Order Confirmation</h1>
        <p>Thanks <?= $_POST['fname'] ?> for ordering at Drowsy's Grocery. Order Summary has been send to your email, <?= $_POST['email'] ?> </p>
    </div>

</body>

</html>