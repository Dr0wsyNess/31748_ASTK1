
<!-- session_start();
$message = "Hello World";

echo "<script>alert ('$message'); </script>"; -->



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
    unset($_SESSION['cart']);
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
    <div class="main">
        <h1>Order Confirmation</h1>
        <p>Thanks <?= $_POST['fname'] ?> for ordering at Drowsy's Grocery. Order Summary has been send to your email, <?= $_POST['email'] ?> </p>
    </div>

</body>

</html>