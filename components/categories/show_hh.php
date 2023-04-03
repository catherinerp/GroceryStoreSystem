<!-- 
Author: Catherine Pe Benito
Created: 03/04/2023
This page contains sql request for household category.
-->
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="assets/css/landing.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600&display=swap" rel="stylesheet">
	</head>
	<body>
		<h3>Browse Household</h3>
        <?php
            $hostname = "localhost";
            $username = "username";
            $password = "password";
            $dbname = "assignment1";

            $conn = mysqli_connect($hostname, $username,$password,$dbname);
            //$link = mysqli_connect("aa4xf37s2fw51e.cs0uliqvpua0.us-east-1.rds.amazonaws.com","uts","internet","uts");
            if (!$conn)
                die("Could not connect to Server");
            
            $query_string = "SELECT * FROM `products` WHERE product_id REGEXP '^7';";

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
</body>
</html>	