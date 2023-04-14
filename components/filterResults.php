<!-- 
Author: Catherine Pe Benito
Created: 09/04/2023
This file does not work :(
-->
<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" href="categories/landing.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600&display=swap" rel="stylesheet">
	</head>
<body>

<div class="main-content">
<?php
    include "dbConfig.php";

if(isset($_GET['query'])) {
    $query = mysqli_real_escape_string($conn, $_GET['query']);
    $min_length = 3;

    if(strlen($query) >= $min_length)   {
        $query_string = "SELECT * FROM `products`
        WHERE (`product_name` LIKE '%".$query."%')";
        $result = mysqli_query($conn, $query_string);

        if ($result) {
            include "filterResults.php";
            $num_rows = mysqli_num_rows($result);
            if ($num_rows > 0) {
                $count = 0;
                echo "<h1 style='text-align:center'>Search results for '$query'</h1>";
                echo "<div class='product-container'>\n";
                while ($a_row = mysqli_fetch_row($result)) {
                    if ($count % 4 == 0) {
                        echo "<div class='product-row'>\n";
                    }
                    echo "<div class='product-card'>\n";
                    foreach ($a_row as $key => $field) {
                        if ($key == 1) {
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
            } else {
                echo "<h1 style='text-align:center'>Sorry! It seems we couldn't find anything with '$query' :(</h1>";
            }
            mysqli_free_result($result);
        } else {
            echo "Query failed: " . mysqli_error($conn);
        }
    } else {
        echo "<h1 style='text-align:center'>Oops! The minimum length must be at least ".$min_length. " characters.</h1>";
    }
}
mysqli_close($conn);
?>

</div>
</body>
</html>