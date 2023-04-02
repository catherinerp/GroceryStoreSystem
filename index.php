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
    <table border=0 width="100%">
        <tr valign="top">	
            <td width="10%">
                <a href="home.php" target="view">
                    <p>Home</p>
                </a>
                <br>
                <a href="search.html" target="view">
                    <p>Search</p>
                </a>
                <br>
                <a href="register.html" target="view">
                    <p>Register</p>
                </a>
                <br>
            </td>
            <td width="90%">
                <iframe name="view" src="home.php" frameborder=0 width="100%" height="100%"></iframe>
            </td>
        </tr>
    </table>	
</body>

</html>