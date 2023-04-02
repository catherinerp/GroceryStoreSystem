<!-- 
Author: Catherine Pe Benito
Created: 06/03/2023
-->
<?php
    $conn = mysqli_connect("localhost","uts","internet","uts");
    //$link = mysqli_connect("aa4xf37s2fw51e.cs0uliqvpua0.us-east-1.rds.amazonaws.com","uts","internet","uts");
    if (!$conn)
        die("Could not connect to Server");
    
    $query_string = "select * from film";

    $result = mysqli_query($conn, $query_string);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows > 0) {
        print "<table border=0>";
        while ($a_row = mysqli_fetch_row($result)) { //Get the rows from the table
            print "<tr>\n";
            foreach ($a_row as $field) //get the columns in each row
                print "\t<td>$field</td>\n";
            print "</tr>";
        }
        print "</table>";
    }

    mysqli_close($conn);
?>