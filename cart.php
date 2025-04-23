<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="index" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Cart | Drowsy Grocery</title>
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
        $updated_value = $_POST['updateQuantity'];
        $update_id = $_POST['updateQuantityID'];
        if(isset($_SESSION['cart'][$update_id]) && $updated_value > 0){
            //if product exist in cart and quantity is greater than 0 -> update quantity
            $_SESSION['cart'][$update_id]['quantity'] = $updated_value;
        }
        else if($updated_value == 0){
            //if quantity is 0 = remove item
            unset($_SESSION['cart'][$update_id]);
        }
    }

    //clear Cart
    if (isset($_POST['clearCart'])) {
        unset($_SESSION['cart']);
    }

    ?>
    <!--logo-->
    <div id="top" class="nav col-12 col-t-12">
        <a href="index.php"><img class="logo" src="./images/logo_mono.png" width="70"><a>
    </div>
    <!--nav bar-->
    <div id="top" class="nav">
        <a href="index.php">Home</a>
        <!-- <a href="about.html">About</a> -->
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
            </a> <br> <br>
            <a href="delivery.php"><button class="checkOut-btn" type="button" disabled>Place an Order</button> </a>
        </div>
    <?php
    } else {
        $cart = $_SESSION['cart'];
        $subTotal = 0;
        $cartArray = implode(',', array_keys($_SESSION['cart']));
        $query_string = "select * FROM products WHERE product_id in($cartArray)";
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
                        <td style="text-align: center;"><img src="./images/<?= $product['image'] ?>" height="100px"></td>
                        <?php
                        ?>
                        <td>
                            <?= $product['product_name'] ?> <br>
                            <form method="post" action="cart.php">
                                <input type="hidden" name="removeProduct" value="<?= $product['product_id'] ?>">
                                <input type="submit" class="removeItem-btn" value="Remove Item">
                            </form>
                        </td>
                        <?php
                        ?>
                        <td style="text-align: center;">$<?= $product['unit_price'] ?></td>
                        <?php
                        //loop through $cart array where the key of $product_id is used to access quantity value
                        foreach ($cart as $cart_id => $quantity) {
                            //print only the quantity for the current product_id
                            if ($cart_id == $product['product_id']) {
                                $total = $quantity['quantity'] * $product['unit_price'];
                        ?>
                                <td style="text-align: center;">
                                    <form method="post" action="cart.php">
                                        <input type="hidden" value="<?= $product['product_id'] ?>" name="updateQuantityID">
                                        <input type="number" value="<?= $quantity['quantity'] ?>" name="updateQuantity" class="quantity">
                                    </form>
                                </td>
                                <td style="text-align: center;">$ <?= $total ?></td>
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
                        <td colspan="5" class="subtotal" style="text-align: right; font-weight: bold;">Subtotal: $<?= $subTotal ?></td>
                    </tr>
                </tfoot>
            </table> <br>
            <div class="cart-btns">
                <form method="post" action="cart.php">
                    <input type="submit" value="Clear All" name="clearCart" class="class= clearAllCart-btn">
                </form>
                <a href="delivery.php"><button class="checkOut-btn" type="button">Place an Order</button> </a>
            </div>
        </div>
        
    <?php
    }
    ?>
</body>

</html>