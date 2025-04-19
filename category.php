<?php
$connection = mysqli_connect('localhost', 'root', '', 'ASTK1Database');

//returns all distinct categories value
$query_string = "select DISTINCT category FROM products";

$result = mysqli_query($connection, $query_string);

//display the categories and subcategories in a dropdown menu
?>
<div class="catNav" id="myCatNav">
    <?php
    if (mysqli_num_rows($result) > 0) {
    ?>
        <?php
        foreach ($result as $category) {
        ?>
            <div class="dropdown">
                <?php
                ?>
                <div>
                    <!-- url will display category= with the current category -->
                    <a href="?category=<?= $category['category'] ?>"><?= $category['category'] ?></a>
                    <button class="dropdown-btn">
                        <!--down arrow icon-->
                        <i class="material-icons">arrow_drop_down</i>
                    </button>
                </div>
                <?php
                //returns all distinct sub categories from products which matches with the current category
                $subquery_string = "select DISTINCT sub_categories FROM products WHERE category = '" . $category['category'] . "'";
                $sub_result = mysqli_query($connection, $subquery_string);
                $sub_num_rows = mysqli_num_rows($sub_result);
                ?>
                <div class="dropdown-content">
                    <?php
                    foreach ($sub_result as $subcategory) {
                    ?>
                        <!-- url will display sub_category= with the current sub_category -->
                        <a href="?sub_category=<?= $subcategory['sub_categories'] ?>">
                            <?= $subcategory['sub_categories'] ?>
                        </a>
                    <?php
                    }
                    ?>
                </div>
            </div>
    <?php
        }
    }
    ?>
</div>

<?php
mysqli_close($connection);
?>