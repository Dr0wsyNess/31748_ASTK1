
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="index" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Order Confirmed | Drowsy Grocery</title>
</head>

<body>
    <?php
    session_start();
    $connection = mysqli_connect('localhost', 'root', '', 'ASTK1Database');

    if (isset($_POST['submitForm'])) {
        $cart = $_SESSION['cart'];
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
                    else{
                        //if product quantity is in stock and cart quantity is less than stock
                        $id = $product['product_id'];
                        $q = $product['in_stock'] - $quantity['quantity'];
                        $update_query_string = "UPDATE products SET in_stock='$q' WHERE product_id = '$id'";
                        mysqli_query($connection, $update_query_string);
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
        <p>Order Confirmation</p>
    </div>
    <div class="main" style="text-align: center;">
        <h1>Order Confirmation</h1>
        <p>Thanks <b><?= $_POST['fname'] ?></b> for ordering at <b><span class="span">Drowsy Grocery</span></b>. Order Summary has been send to your email, <b><?= $_POST['email'] ?></b></p>
        <br> <br>
        <a href="index.php">
            <button class="checkOut-btn">Go back to Shopping</button>
        </a> 
    </div>

</body>

</html>