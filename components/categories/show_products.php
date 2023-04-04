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
        echo "<table border=0>";
        echo "<td>Product Name</td>\n";
        echo "<td>Price</td>\n";
        echo "<td>Quantity</td>\n";
        while ($a_row = mysqli_fetch_row($result)) { //Get the rows from the table
            echo "<tr>\n";
            foreach ($a_row as $field) //get the columns in each row
                echo "\t<td>$field</td>\n";
            echo "</tr>";
        }
        echo "</table>";
    }

    mysqli_close($conn);
?>
</div>
</body>
</html>	