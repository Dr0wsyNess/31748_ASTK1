<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="index" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <!-- ICON sheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Online Grocery Store</title>
</head>

<body>
    <!--logo-->
    <div id="top" class="nav col-12 col-t-12">
        <img src="./images/logo_mono.png" width="70">
    </div>
    <!--nav bar-->
    <div id="top" class="nav col-12 col-t-12">
        <a class="active" href="index.html">Home</a>
        <a href="about.html">About</a>
        <a href="delivery.html">Delivery details</a>
        <a href="cart.html">Shopping cart</a>
    </div>

    <!-- search bar -->
    <div>
        <form>
            <input type="text" placeholder="Search products">
            <button type="submit">Submit</button>
        </form>
    </div>

    <!--Catalogue sidenav-->
    <div class="sideNav">
        <a class="active" href="#">Frozen Food</a>
        <div class="dropdown" >
            <button class="dropdown-btn"> Pet Food
                <!--down arrow icon-->
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container">
                <a href="#">Delivery details</a>
                <a href="#">Shopping cart</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropdown-btn" onclick="dropdownFun()"> Cool Food
                <!--down arrow icon-->
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container">
                <a href="#">Delivery details</a>
                <a href="#">Shopping cart</a>
            </div>
            <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="dropdownFun()">&#9776;</a>

        </div>
        
    </div>
    <div class="main">
    <h1>Catalogue</h1>
    <div class="product-categories">
        <h2>Roomates</h2>
        <div class="item">
            <h3>Kaveh</h3>
            <img src="./images/kaveh_fku.png">
            <p>Price: </p>
            <button type="button">Add to Cart</button>
        </div>
        <div class="item">
            <h3>Haitham</h3>
            <img src="./images/alhaitham_fku.png">
            <p>Price: </p>
            <button type="button">Add to Cart</button>
        </div>
    </div>
    </div>
    <script src="./js/script.js"></script>
</body>

</html>