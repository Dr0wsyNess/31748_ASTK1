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

    $products_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

    // if(empty($_SESSION['cart']))

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
                    <label for="lname" class="formLabel">LAST NAME  <span style="color: red;">*</span></label>
                    <input type="text" id="lname" name="lname" class="formField"required>
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
                    <br><button type="submit"class="checkOut-btn">Submit</button>
                </div>
            </form>
        </div>



</body>

</html>