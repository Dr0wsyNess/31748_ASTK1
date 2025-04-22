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
    $products_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

    $cart = $_SESSION['cart'];
    // echo '<pre>';
    // var_dump($_SESSION);
    // echo '</pre>';
    $cart_array = implode(',', array_keys($_SESSION['cart']));
    $query_string = "select * FROM products WHERE product_id in($cart_array)";
    $result = mysqli_query($connection, $query_string);

    if (isset($_POST['submitForm'])) {
        while ($product = mysqli_fetch_array($result)) {
            //loop through $cart array where the key of $product_id is used to access quantity value
            foreach ($cart as $cart_id => $quantity) {
                // echo "database: " . $product['in_stock'];
                // echo "quantity: " . $quantity['quantity'];
                if ($cart_id == $product['product_id']) {
                    //if stock product is 0, alert users that it is out of stock
                    if ($product['in_stock'] == 0) {
                        $message = $product['product_name'] . " is out of stock and not available anymore";
                        echo "<script>alert ('$message'); window.location.href='cart.php';</script>";
                    } 
                    //if the cart's product quantity is greater than stock, alert users and redirect them back to cart
                    else if ($quantity['quantity'] > $product['in_stock']) {
                        $message = $product['product_name'] . " quantity is greater than stock. " . $product['in_stock']. " stock is available";
                        echo "<script>alert ('$message'); window.location.href='cart.php';</script>";
                    }
                }
            }
        }
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
            <span class="icon" style="background-color: #495e7d;"><?= $products_in_cart ?></span>
        </a>
    </div>
    <div class="container">
        <div class="deliveryDetail">
            <h1>Delivery Details</h1>
            <form method="post" action="confirmed.php">
                <div class="row">
                    <div class="rowGroup">
                        <label for="fname" class="formLabel">FIRST NAME <span style="color: red;">*</span></label>
                        <input type="text" id="fname" name="fname" class="formField" required>
                    </div>
                    <div class="rowGroup">
                        <label for="lname" class="formLabel">LAST NAME <span style="color: red;">*</span></label>
                        <input type="text" id="lname" name="lname" class="formField" required>
                    </div>
                </div>
                <div class="row">
                    <div class="rowGroup" for="phone">
                        <label for="phone" class="formLabel">MOBILE PHONE <span style="color: red;">*</span></label>
                        <input type="tel" id="phone" name="phone" minlength="10" maxlength="10" class="formField" required>
                    </div>
                    <div class="rowGroup">
                        <label for="email" class="formLabel">EMAIL ADDRESS <span style="color: red;">*</span></label>
                        <input type="email" id="email" name="email" class="formField" required>
                    </div>
                </div>
                <div class="row">
                    <div class="rowGroup">
                        <label for="street" class="formLabel">STREET ADDRESS <span style="color: red;">*</span></label>
                        <input type="text" id="street" name="street" class="formField" required>
                    </div>
                </div>
                <div class="row">
                    <div class="rowGroup">
                        <label for="suburb" class="formLabel">CITY/ SUBURB <span style="color: red;">*</span></label>
                        <input type="text" id="suburb" name="suburb" class="formField" required>
                    </div>
                    <div class="rowGroup">
                        <label for="state" class="formLabel">STATE <span style="color: red;">*</span></label>
                        <select id="state" name="state" class="formField" required>
                            <option value="nsw">NSW</option>
                            <option value="vic">VIC</option>
                            <option value="qld">QLD</option>
                            <option value="wa">WA</option>
                            <option value="sa">SA</option>
                            <option value="tas">TAS</option>
                            <option value="act">ACT</option>
                            <option value="nt">NT</option>
                            <option value="others">Others</option>
                        </select>
                    </div>
                </div>
                <div class="rowGroup">
                    <label for="postcode" class="formLabel">POSTCODE <span style="color: red;">*</span></label>
                    <input type="number" id="postcode" name="postcode" min="0200" max="9999" class="formField" required>
                </div>
                <div>
                    <br><input type="submit" name="submitForm" class="checkOut-btn" value="Submit">
                </div>
            </form>
        </div>



</body>

</html>