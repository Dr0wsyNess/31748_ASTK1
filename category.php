<?php
$connection = mysqli_connect('localhost', 'root', '', 'ASTK1Database');

//returns all distinct categories value
$query_string = "select DISTINCT category FROM products";

$result = mysqli_query($connection, $query_string);
$num_rows = mysqli_num_rows($result);

if ($num_rows > 0) {
    foreach ($result as $category) {
        echo "<td>" . $category['category'] . "</td>";
        $subquery_string = "select DISTINCT sub_categories FROM products WHERE category = ".$category['category']."";
        $sub_result = mysqli_query($connection, $subquery_string);
        $sub_num_rows = mysqli_num_rows($sub_result);
        foreach($sub_result as $subcategory){
            echo "<td>" . $subcategory['sub_categories'] . "</td>";
        }
    }    
}
mysqli_close($connection);
?>