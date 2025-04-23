<?php
$connection = mysqli_connect('localhost', 'root', '', 'ASTK1Database');

//check whether product_search exist and not NULL
if (isset($_REQUEST['searchedProduct'])) {
    $keywords = $_REQUEST['searchedProduct'];
    //Will return all product whose product_name contains "keywords".
    $query_string = "select * FROM products WHERE product_name LIKE '%$keywords%'";
    //category page nav
?>
    <h6>
        <a href="index.php">All Products</a>
        > <?= $keywords ?>
    </h6>
    <h1 class="categories-header"> Showing results for : <?= $keywords ?></h1>
<?php

    // check if sub_category is in the URL
} else if (isset($_REQUEST['sub_category'])) {
    $subcategory = $_REQUEST['sub_category'];
    //display all products that has the matching subcategories 
    $query_string = "select * FROM products WHERE sub_categories = '$subcategory'";

    //get the sub-category's parent category to display it in the current page nav
    $category_query_string = "select DISTINCT category FROM products WHERE sub_categories = '$subcategory'";
    $category =  mysqli_fetch_row(mysqli_query($connection, $category_query_string));
?>
    <h6>
        <a href="index.php">All Products</a> >
        <a href="?category=<?= $category[0] ?>"><?= $category[0] ?></a>
        > <?= $subcategory ?>
    </h6>
    <h1 class="categories-header"><?= $subcategory ?></h1>
<?php
}
// check if category is in the URL
else if (isset($_REQUEST['category'])) {
    $category = $_REQUEST['category'];
    //display all products that has the matching category 
    $query_string = "select * FROM products WHERE category = '$category'";

    // current page nav, where users can click on All Products to return to see all the products
?>
    <h6>
        <a href="index.php">All Products</a> >
        <?= $category ?>
    </h6>
    <h1 class="categories-header"><?= $category ?></h1>
<?php

} else {
    //display products all products
    $query_string = "select * FROM products";
?>
    <h1 class="categories-header">All Products</h1>
<?php
}

$result = mysqli_query($connection, $query_string);

//displaying the items
?>
<div class="product-categories">
    <?php
    //display all the products that is in the array
    if (mysqli_num_rows($result) > 0) {
    ?>
        <?php
        foreach ($result as $product) {
        ?>
            <div class="item">
                <img src="./images/<?= $product['image'] ?>" height="100px">
                <h3><?= $product['product_name'] ?></h3>
                <p style="font-weight: bold">$<?= $product['unit_price'] ?></p>
                <p style="font-size: 75%; color: grey"><?= $product['unit_quantity'] ?></p>
                <?php
                //toggle addCart button which is dependent on the stock quantity
                if ($product['in_stock'] != 0) {
                ?>
                    <label style="font-size: 80%">in stock</label><br><br>
                    <form method="post" action="index.php">
                        <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                        <input type="submit" name="addToCart" class="addCart-btn" value="Add to Cart">
                    </form>
                <?php
                } else {
                ?>
                    <label style="font-size: 80%">not in stock</label><br><br>
                    <form>
                        <input type="submit" class="addCart-btn" value="Add to Cart" disabled>
                    </form>
                <?php
                }
                ?>
            </div>
    <?php
        }
    }
    ?>
</div>

<?php
mysqli_close($connection);
?>