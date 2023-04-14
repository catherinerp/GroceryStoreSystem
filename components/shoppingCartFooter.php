<!-- 
Author: Catherine Pe Benito
Created: 13/04/2023
This contains the shopping cart function.
-->
<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../assets/css/shoppingCart.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600&display=swap" rel="stylesheet">
    </head>
	<body>
    <h1>Shopping Cart</h1>
    <?php
    if (empty($_SESSION['cart'])) {
        echo "<p>Cart is empty.</p>";
    } else {
        echo "<table>
                <tr>
                    <th>Item Name</th>
                    <th>Quantity</th>
                </tr>";
        foreach ($_SESSION['cart'] as $item_id => $quantity) {
            include "dbConfig.php";
            $query_string = "SELECT * FROM products";
            $result = mysqli_query($conn, $query_string);
            $row = mysqli_fetch_assoc($result);
            $item_name = $row['item_name'];

            echo "<tr>
                    <td>$product_name</td>
                    <td>$quantity</td>
                </tr>";
        }
        echo "</table>";
    }
    ?>
    </body>
</html>