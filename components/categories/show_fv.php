<!-- 
Author: Catherine Pe Benito
Created: 02/04/2023
This page contains sql request for fruits and vegetables category.
-->
<!DOCTYPE html>
<html lang="en">
	<head>
    <link rel="stylesheet" href="../../assets/css/categories.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600&display=swap" rel="stylesheet">
	</head>
	<body>
        <h1 style='text-align:center'>Browse Fruits & Vegetables</h1>
        <div class="main-content">
        <?php
            include "../dbConfig.php";
            $query_string = "SELECT * FROM `products` WHERE product_id REGEXP '^1';";
            $result = mysqli_query($conn, $query_string);
                $num_rows = mysqli_num_rows($result);

                if ($num_rows > 0) {
                    $count = 0;
                    echo "<div class='product-container'>\n";
                    while ($a_row = mysqli_fetch_row($result)) {
                        if ($count % 4 == 0) {
                            echo "<div class='product-row'>\n";
                        }
                        echo "<div class='product-card'>\n";
                        foreach ($a_row as $key => $field) {
                            if ($key == 1) {
                                echo "<div class='clickable-product'><a href='../productView.php?product_id=" . $a_row[0] ."' target='view'><h3>$field</h3>\n";
                            } elseif ($key == 2) {
                                echo "<p class='card-price'>$" . $field . " for ";
                            } elseif ($key == 3) {
                                echo $field . "</p>\n";
                            } elseif ($key == 4) {
                                if ($field > 0) {
                                    echo "<span class='product-stock'><p>In stock</p></span>";
                                } else {
                                    echo "<span class='product-stock'><p>Out of stock</p></span>";
                                }
                            }
                            if ($key == 5) {
                                echo "<div class='product-image'><img src='images/$field' style='max-width:250px'></div></a></div>\n";
                            }
                        }
                        echo "<form action='../addToCart.php' method='post'>";
                        echo "<input type='hidden' name='product_id' value='" . $a_row[0] . "'>";
                        echo "\t<button class='add-cart-btn' type='submit' id='btn' name='addToCart' onclick='reloadPage()'>Add to Cart</button>\n";
                        echo "</form>";
                        echo "</div>\n";
                        $count++;
                        if ($count % 4 == 0) {
                            echo "</div>\n";
                        }
                    }
                    if ($count % 4 != 0) {
                        echo "</div>\n";
                    }
                    echo "</div>\n";
                }
                mysqli_close($conn);
            ?>
            <script>
                function reloadPage() {
                    window.parent.location.reload();
                }
            </script>
        </div>
    </body>
</html>	