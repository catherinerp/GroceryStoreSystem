<!-- 
Author: Catherine Pe Benito
Created: 02/04/2023
-->
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="categories/landing.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600&display=swap" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
<body>

<div class="main-content">
<?php    
    include "dbConfig.php";
    $min_price = "SELECT `unit_price` FROM `products` WHERE `unit_price` IN (SELECT MIN(`unit_price`) FROM `products`)";
    $max_price = "SELECT `unit_price` FROM `products` WHERE `unit_price` IN (SELECT MAX(`unit_price`) FROM `products`)";

if(isset($_GET['query'])) {
    $query = mysqli_real_escape_string($conn, $_GET['query']);
    $min_length = 3;
    // you can set minimum length of the query if you want
    if(strlen($query) >= $min_length)   { // if query length is more or equal minimum length then
        $query_string = "SELECT * FROM `products`
        WHERE (`product_name` LIKE '%".$query."%')
        AND (`unit_price` >= ".$min_price." AND `unit_price` <= ".$max_price.")";

        $result = mysqli_query($conn, $query_string);

        if ($result) {
            echo "<div class='price-filter'>";
            echo "<label for='price-range'>Price Range:</label>";
            echo "<input type='text' id='price-range' readonly>";
            echo "</div>";

            $num_rows = mysqli_num_rows($result);
            if ($num_rows > 0) {
                $count = 0;
                echo "<h1 style='text-align:center'>Search results for '$query'</h1>";
                echo "<div class='product-container'>\n";
                while ($a_row = mysqli_fetch_row($result)) { //Get the rows from the table
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
            } else { // if there is no matching rows do following
                echo "<h1 style='text-align:center'>Sorry! It seems we couldn't find anything with '$query' :(</h1>";
            }
            mysqli_free_result($result);
        } else {
            echo "Query failed: " . mysqli_error($conn);
        }
    } else { // if query length is less than minimum
        echo "<h1 style='text-align:center'>Oops! The minimum length must be at least ".$min_length. " characters.</h1>";
    }
}
mysqli_close($conn);
?>
        <script>
        $(function() {
            var minPrice = <?php echo $min_price; ?>;
            var maxPrice = <?php echo $max_price; ?>;
            $("#price-range").slider({
                range: true,
                min: minPrice,
                max: maxPrice,
                values: [minPrice, maxPrice],
                slide: function(event, ui) {
                    $("#price-range").val("$" + ui.values[0] + " - $" + ui.values[1]);
                },
                change: function(event, ui) {
                    window.location.href = "search.php?query=<?php echo $query; ?>&min_price=" + ui.values[0] + "&max_price=" + ui.values[1];
                }
            });
            $("#price-range").val("$" + $("#price-range").slider("values", 0) + " - $" + $("#price-range").slider("values", 1));
        });
        </script>

</div>
</body>
</html>