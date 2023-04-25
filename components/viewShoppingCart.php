<!-- 
Author: Catherine Pe Benito
Created: 15/04/2023
This contains the page to view the shopping cart.
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
        <link rel="stylesheet" href="../assets/css/checkoutPage.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600&display=swap" rel="stylesheet">
    </head>
	<body>
    <div class="banner">
        <img href="../index.php" class="img-logo" src="../assets/images/logo-smallsize.png" alt="Grocery To-Go Logo">
        <h3>Your first choice for easy, accessible shopping.</h3>
    </div>
    <div class="shopping-cart-container">
        <div class="cart-items-container">
        <?php
        if (empty($_SESSION['cart'])) {
            echo "<p>Cart is empty.</p>";
        } else {
            $total_price = 0;
            echo "<table>";
            foreach ($_SESSION['cart'] as $item_id => $quantity) {
                include "dbConfig.php";
                $query_string = "SELECT * FROM products";
                $result = mysqli_query($conn, $query_string);
                $row = mysqli_fetch_assoc($result);
                $product_name = $row['product_name'];
                $product_image= $row['product_image'];
                $unit_price = $row['unit_price'];
                $item_price = $unit_price * $quantity;

                /**<div class='product-image'>
                <img src='categories/images/$product_image>' style='max-width:250px'>
                </div>**/
                echo "<td>
                        <tr><img src='categories/images/$product_image' style='width:50px; height:50px'></tr>
                        <tr>$product_name ($quantity) $$item_price</tr>
                        </td>\t";
                $total_price = $total_price + $item_price;
            }
            echo "</table>";
        }
        ?>
        </div>
        <div class="cart-actions">
            <h3>Item Quantity</h3>
            <h2>Cart Total</h2>
            <input class="checkout-btn" type="button" value="Checkout" <?php echo empty($_SESSION['cart'])?>>
        </div>
    </div>
    </body>
</html>