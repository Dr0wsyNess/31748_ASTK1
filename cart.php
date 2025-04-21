<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="index" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Online Grocery Store</title>
</head>

<body>
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
            Shopping cart
        </a>
    </div>

    <?php
    session_start();
    $connection = mysqli_connect('localhost', 'root', '', 'ASTK1Database');
    if(empty($_SESSION['cart'])){
        ?>
        <h1>Cart</h1>
        <div class="main" style="text-align: center;">
            <h3>Your cart is empty</h3>
            <p>No items currently in your cart.</p>
            <a href="index.php">
                <button class="checkOut-btn">Continue shopping</button>
            </a>
        </div>
        <?php
    }
    else{
        $cart = $_SESSION['cart'];
        // $subTotal = 0;
        $cart_array = implode(',', array_keys($_SESSION['cart']));
        echo $cart_array;
        $query_string = "select * FROM products WHERE product_id in($cart_array)";
        $result = mysqli_query($connection, $query_string);
        $num_rows = mysqli_num_rows($result);
        ?>
        <div class="main">
            <table>
                <tr>
                    <th class="row-titles">Image</th>
                    <th class="row-titles">Item</th>
                    <th class="row-titles">Unit Price</th>
                    <th class="row-titles">Quantity</th>
                    <th class="row-titles">Total</th>
                </tr>
                <tr>
                    <?php
                    if(mysqli_num_rows($result) > 0 ){
                        foreach($result as $product){
                            ?>
                                <td></td>
                            <?php
                            ?>
                                <td>
                                    <?= $product['product_name'] ?> <br>
                                    <button class="removeItem-btn" type="button">Remove Item</button>
                                </td>
                            <?php
                            ?>
                                <td>
                                    $<?= $product['unit_price'] ?>
                                </td>
                            <?php
                            ?>
                                <td>
                                    
                                </td>
                            <?php
                            ?>
                                <td>
                                    
                                </td>
                            <?php
                        }
                    }
                    ?>
                </tr>
            </table>
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

        <div>
            <button class="clearAllCart-btn" type="button">
                Clear All</button>
            <button class="checkOut-btn" type="button">
                Checkout</button>
        </div>
    </div> 

</body>

</html>