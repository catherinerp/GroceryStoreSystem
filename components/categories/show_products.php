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
<h3>Browse products</h3>
<div class="main-content">
<?php
    include "../dbConfig.php";
    
    $query_string = "SELECT product_name, unit_price, unit_quantity FROM products";

    $result = mysqli_query($conn, $query_string);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows > 0) {
        echo "<div class='product-card'>\n";
        echo "<table border=0>";
        echo "<td>Product Name</td>\n";
        echo "<td>Price</td>\n";
        echo "<td>Quantity</td>\n";
        while ($a_row = mysqli_fetch_row($result)) { //Get the rows from the table
            echo "<tr>\n";
            
            foreach ($a_row as $key => $field) {
                if ($key == 0) { // check if the current column is 'product_name'
                    echo "\t<td>$field" . " (" . $a_row[2] . ")</td>\n"; // print 'product_name' and 'stock_quantity' in parentheses
                } elseif ($key == 1) { // check if the current column is 'unit_price'
                    echo "\t<td class='card-price'>$" . $field . "</td>\n"; // print 'unit_price' with a '$' prefix
                } else { // for all other columns
                    echo "\t<td>$field</td>\n"; // print as it is
                }
            }
            echo "\t<td><button>Add to Cart</button></td>\n";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
    }

    mysqli_close($conn);
?>
</div>
</body>
</html>	