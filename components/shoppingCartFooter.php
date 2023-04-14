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
<html lang="en">
    <head>
        <link rel="stylesheet" href="../assets/css/shoppingCart.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600&display=swap" rel="stylesheet">
    </head>
	<body>
    <h2>Shopping Cart</h2>
    <?php
    if (empty($_SESSION['cart'])) {
        echo "<p>Cart is empty.</p>";
    } else {
        echo "<table>";
        foreach ($_SESSION['cart'] as $item_id => $quantity) {
            include "dbConfig.php";
            $query_string = "SELECT * FROM products";
            $result = mysqli_query($conn, $query_string);
            $row = mysqli_fetch_assoc($result);
            $product_name = $row['product_name'];
            $product_image= $row['product_name'];
            $unit_price = $row['unit_price'];
            $item_price = $unit_price * $quantity;

            /**<div class='product-image'>
            <img src='categories/images/$product_image>' style='max-width:250px'>
            </div>**/
            echo "<tr>
                    <td>$product_name</td>
                    <td>$quantity</td>
                    <td>$$item_price</td>
                </tr>";
        }
        echo "</table>";
    }
    ?>
    </body>
</html>