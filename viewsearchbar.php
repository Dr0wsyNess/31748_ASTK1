<?php

$conn = mysqli_connect('localhost', 'root', '', 'ASTK1Database');

$keywords = $_REQUEST['searchedProduct'];

//Will return all product whose product_name contains "keywords".
$query_string = "select * FROM products WHERE product_name LIKE '%$keywords%'";

$result = mysqli_query($conn, $query_string);

$num_rows = mysqli_num_rows($result);
echo "Displaying the results using associative array";

if ($num_rows > 0 ) {
    print "<table border='0'>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row['product_name']."</td>";
        echo "<td>".$row['unit_price']."</td>";
        echo "</tr>";
    }
    print "</table>";
}
 
mysqli_close($conn);

?>