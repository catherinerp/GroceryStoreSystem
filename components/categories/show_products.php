<!-- 
Author: Catherine Pe Benito
Created: 06/03/2023
-->
<?php
    include "components/dbConfig.php";
    
    $query_string = "SELECT * FROM products";

    $result = mysqli_query($conn, $query_string);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows > 0) {
        echo "<table border=0>";
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