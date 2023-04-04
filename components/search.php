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
	</head>
<body>
<?php
    include "dbConfig.php";

if(isset($_GET['query'])) {
    $query = mysqli_real_escape_string($conn, $_GET['query']);
    // gets value sent over search form and escapes any special characters
    $min_length = 3;

    // you can set minimum length of the query if you want
    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
        $query_string = "SELECT * FROM `products`
        WHERE (`product_name` LIKE '%".$query."%')";
        $result = mysqli_query($conn, $query_string);
        if ($result) {
            $num_rows = mysqli_num_rows($result);
            if ($num_rows > 0) {
                echo "<h3>Search results for '$query'</h3>";
                echo "<table border=0>";
                while ($a_row = mysqli_fetch_row($result)) { //Get the rows from the table
                    echo "<tr>\n";
                    foreach ($a_row as $field) //get the columns in each row
                        echo "\t<td>" . htmlspecialchars($field) . "</td>\n";
                    echo "</tr>";
                }
                echo "</table>";
            } else { // if there is no matching rows do following
                echo "<h3>Sorry! It seems we couldn't find anything with '$query' :(</h3>";
            }
            mysqli_free_result($result);
        } else {
            echo "Query failed: " . mysqli_error($conn);
        }
    } else { // if query length is less than minimum
        echo "Minimum length is ".$min_length;
    }
}
mysqli_close($conn);
?>
</body>
</html>