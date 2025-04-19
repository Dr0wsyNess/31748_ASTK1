<?php
$connection = mysqli_connect('localhost', 'root', '', 'ASTK1Database');

//returns all distinct categories value
$query_string = "select DISTINCT category FROM products";

$result = mysqli_query($connection, $query_string);
$num_rows = mysqli_num_rows($result);

//display the categories and subcategories in a dropdown menu
if ($num_rows > 0) {
    echo '<ul>';
    foreach ($result as $category) {
        echo '<li>' . $category['category'];
        //returns all distinct sub categories from products which matches with the current category
        $subquery_string = "select DISTINCT sub_categories FROM products WHERE category = '" . $category['category'] . "'";
        $sub_result = mysqli_query($connection, $subquery_string);
        $sub_num_rows = mysqli_num_rows($sub_result);
        foreach ($sub_result as $subcategory) {
            echo '<ul>';
            echo '<li>' . $subcategory['sub_categories'] . '</li>';
            echo '</ul>';
        }
        echo '</li>';
    }
    echo '</ul>';
}
mysqli_close($connection);
