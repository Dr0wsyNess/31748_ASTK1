<?php
$connection = mysqli_connect('localhost', 'root', '', 'ASTK1Database');

//check whether product_search exist and not NULL
if (isset($_REQUEST['searchedProduct'])) {
    $keywords = $_REQUEST['searchedProduct'];
    //Will return all product whose product_name contains "keywords".
    $query_string = "select * FROM products WHERE product_name LIKE '%$keywords%'";
    // check if sub_category is in the URL
} else if (isset($_REQUEST['sub_category'])) {
    $subcategory = $_REQUEST['sub_category'];
    //display all products that has the matching subcategories 
    $query_string = "select * FROM products WHERE sub_categories = '$subcategory'";
}
// check if category is in the URL
else if (isset($_REQUEST['category'])) {
    $category = $_REQUEST['category'];
    //display all products that has the matching category 
    $query_string = "select * FROM products WHERE category = '$category'";
} else {
    //display products all products
    $query_string = "select * FROM products";
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
                <h3><?= $product['product_name'] ?></h3>
                <p>Price: <?= $product['unit_price'] ?></p>
                <?php
                //toggle addCart button which is dependent on the stock quantity
                if ($product['in_stock'] != 0) {
                ?>
                    <p> Stock: <?= $product['in_stock'] ?></p>
                    <button type="button" class="addCart-btn">Add to Cart</button>
                <?php
                } else {
                ?>
                    <p> Stock: <?= $product['in_stock'] ?></p>
                    <button type="button" class="addCart-btn" disabled>Add to Cart</button>
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