<!-- 
Author: Catherine Pe Benito
Created: 03/04/2023
This page contains sql request for beauty and personal care category.
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
        <h1 style='text-align:center'>Browse Beauty & Personal Care</h1>
        <?php
            include "../dbConfig.php";
            $query_string = "SELECT * FROM `products` WHERE product_id REGEXP '^5';";
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
                        if ($key == 5) {
                            echo "<div class='product-image'><img src='images/$field' style='max-width:250px'></div>\n";
                        } elseif ($key == 1) {
                            echo "<h3>$field</h3>\n";
                        } elseif ($key == 2) {
                            echo "<p class='card-price'>$" . $field . " for ";
                        } elseif ($key == 3) {
                            echo $field . "</p>\n";
                        }
                    }  
                    echo "\t<button>Add to Cart</button>\n";
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
</body>
</html>	