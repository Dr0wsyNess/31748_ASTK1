<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="index" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Online Grocery Store</title>
</head>

<body>
    <?php
    session_start();
    $connection = mysqli_connect('localhost', 'root', '', 'ASTK1Database');
    $products_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

    //remove product from cart from the server side
    if (isset($_POST['removeProduct'])) {
        unset($_SESSION['cart'][$_POST['removeProduct']]);
    }
    if (isset($_POST['updateQuantity'])) {
        // $updated_value = $_POST['updateQuantity'];
        // $update_id = $_POST['updateQuantityID'];
        // foreach($$_SESSION['cart'] as $id => $quantity){
        //     if(isset($updated_value) && $update_id == $id){
        //         $_SESSION['cart'][$id] = $quantity;
        //     }
        // }
    }

    //clear Cart
    if (isset($_POST['clearCart'])) {
        unset($_SESSION['cart']);
    }

    ?>
    <!--logo-->
    <div id="top" class="nav col-12 col-t-12">
        <img src="./images/logo_mono.png" width="70">
    </div>
    <!--nav bar-->
    <div id="top" class="nav">
        <a href="index.php">Home</a>
        <a href="about.html">About</a>
        <a class="active" href="cart.php">
            <i class="material-icons">shopping_cart</i>
            <span class="icon" style="background-color: #495e7d;"><?= $products_in_cart ?></span>
        </a>
    </div>
    <?php


    if (empty($_SESSION['cart'])) {
    ?>
        <h1>Cart</h1>
        <div class="main" style="text-align: center;">
            <h3>Your cart is empty</h3>
            <p>No items currently in your cart.</p>
            <a href="index.php">
                <button class="checkOut-btn">Continue shopping</button>
            </a> <br>
            <a href="delivery.php"><button class="checkOut-btn" type="button" disabled>Place an Order</button> </a>
        </div>
    <?php
    } else {
        $cart = $_SESSION['cart'];
        // echo '<pre>';
        // var_dump($_SESSION);
        // echo '</pre>';
        $subTotal = 0;
        $cart_array = implode(',', array_keys($_SESSION['cart']));
        $query_string = "select * FROM products WHERE product_id in($cart_array)";
        $result = mysqli_query($connection, $query_string);
    ?>
        <div class="main">
            <h1>Cart</h1>
            <table>
                <tr>
                    <th class="row-titles">Image</th>
                    <th class="row-titles">Item</th>
                    <th class="row-titles">Unit Price</th>
                    <th class="row-titles">Quantity</th>
                    <th class="row-titles">Total</th>
                </tr>

                <?php
                while ($product = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td></td>
                        <?php
                        ?>
                        <td>
                            <?= $product['product_name'] ?> <br>
                            <form method="post" action="cart.php">
                                <input type="hidden" name="removeProduct" value="<?= $product['product_id'] ?>">
                                <input type="submit" class="removeItem-btn" value="Remove Item">
                                <!-- <button class="removeItem-btn" type="button">Remove Item</button> -->
                            </form>
                        </td>
                        <?php
                        ?>
                        <td>
                            $<?= $product['unit_price'] ?>
                        </td>
                        <?php
                        //loop through $cart array where the key of $product_id is used to access quantity value
                        foreach ($cart as $cart_id => $quantity) {
                            //print only the quantity for the current product_id
                            if ($cart_id == $product['product_id']) {
                                $total = $quantity['quantity'] * $product['unit_price'];
                        ?>
                                <td>
                                    <form method="post" action="cart.php">
                                        <input type="hidden" name="updateQuantityID" value="<?= $product['product_id'] ?>">
                                        <input type="number" value="<?= $quantity['quantity'] ?>" name="updateQuantity">
                                    </form>
                                </td>
                                <td>
                                    $ <?= $total ?>
                                </td>
                        <?php
                                $subTotal += $total;
                            }
                        }
                        ?>
                    </tr>
                <?php
                }
                ?>
                <tfoot>
                    <tr>
                        <td colspan="5">Subtotal: $<?= $subTotal ?></td>
                    </tr>
                </tfoot>
            </table>
            <div>
                <form method="post" action="cart.php">
                    <input type="submit" value="Clear All" name="clearCart" class="class=" clearAllCart-btn">
                </form>
                <a href="delivery.php"><button class="checkOut-btn" type="button">Place an Order</button> </a>
            </div>
        </div>
    <?php
    }
    ?>


    <!-- <div class="main">
        <h1>Cart</h1>
        <h3>Your cart is empty</h3>
        <p>No items currently in your cart. Continue shopping</p>

        <table>
            <tr>
                <th class="row-titles">Image</th>
                <th class="row-titles">Item</th>
                <th class="row-titles">Unity Price</th>
                <th class="row-titles">Quantity</th>
                <th class="row-titles">Total</th>
            </tr>
            <tr>
                <td><img src="./images/kaveh_fku.png" height="100px"></td>
                <td>Kaveh
                    <br>
                    <button class="removeItem-btn" type="button">
                    Remove Item</button>
                </td>
                <td>$4.00</td>
                <td>1</td>
                <td>$4.00</td>
                <tfoot>
                    <td colspan="5">Subtotal: $</td>
            </tr>
            </tfoot>
        </table> -->

    <!-- <div>
        <button class="clearAllCart-btn" type="button">
            Clear All</button>
        <button class="checkOut-btn" type="button">
            Checkout</button>
    </div> -->

</body>

</html>