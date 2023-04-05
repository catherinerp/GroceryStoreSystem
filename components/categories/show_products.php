<!-- 
Author: Catherine Pe Benito
Created: 06/03/2023
-->
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="landing.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600&display=swap" rel="stylesheet">
	</head>
	<body>
<h1 style="text-align:center">Browse products</h1>
<div class="main-content">
<?php
    include "../dbConfig.php";

    $query_string = "SELECT product_name, unit_price, unit_quantity FROM products";

    $result = mysqli_query($conn, $query_string);
    $num_rows = mysqli_num_rows($result);

    if ($num_rows > 0) {
        $count = 0;
        echo "<div class='product-container'>\n";
        while ($a_row = mysqli_fetch_row($result)) {
            if ($count % 4 == 0) { // start a new row every 4 products
                echo "<div class='product-row'>\n";
            }
            echo "<div class='product-card'>\n";
            foreach ($a_row as $key => $field) {
                if ($key == 0) { // check if the current column is 'product_name'
                    echo "\t<h3>$field" . " (" . $a_row[2] . ")</h3>\n"; // print 'product_name' and 'stock_quantity' in parentheses
                } elseif ($key == 1) { // check if the current column is 'unit_price'
                    echo "\t<p class='card-price'>$" . $field . "</p>\n"; // print 'unit_price' with a '$' prefix
                }
            }
            echo "\t<button>Add to Cart</button>\n";
            echo "</div>\n";
            $count++;
            if ($count % 4 == 0) { // end the row after 4 products
                echo "</div>\n";
            }
        }
        if ($count % 4 != 0) { // close the last row if it's not complete
            echo "</div>\n";
        }
        echo "</div>\n";
    }

    mysqli_close($conn);
?>


</div>
</body>
</html>	