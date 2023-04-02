<!-- 
Author: Catherine Pe Benito
Created: 06/03/2023
This page contains the views for different sections of the main webpage.
-->
<!DOCTYPE html>
<html>
<head>
  <title>GroceryShopping</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php include_once 'components/header.php' ?>
    <iframe name="view" src="home.php" frameborder=0 width="100%" height="100%"></iframe>
    <?php

			$conn = mysqli_connect("localhost","root","password","assignment1");
			//$link = mysqli_connect("aa4xf37s2fw51e.cs0uliqvpua0.us-east-1.rds.amazonaws.com","uts","internet","uts");
			if (!$conn)
				die("Could not connect to Server");
				echo "hello";
			
			$query_string = "SELECT * FROM `products`;";

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
</body>

</html>