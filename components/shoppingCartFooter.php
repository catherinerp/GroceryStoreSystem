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
    <div class="shopping-cart-container">
        <div class="cart-items-container">
        <?php
        if (empty($_SESSION['cart'])) {
            echo "<p>Cart is empty.</p>";
        } else {
            $total_price = 0;
            echo "<div class='product-container'>";
                foreach ($_SESSION['cart'] as $item_id => $quantity) {
                    include "dbConfig.php";
                    $query_string = "SELECT * FROM products WHERE product_id = $item_id";
                    $result = mysqli_query($conn, $query_string);
                    $row = mysqli_fetch_assoc($result);

                    $product_name = $row['product_name'];
                    $product_image = $row['product_image'];
                    $unit_price = $row['unit_price'];
                    
                    $item_price = $unit_price * $quantity;
                    $item_price = number_format((float)$item_price, 2, '.', '');

                    echo "<div class='product-item'>
                            <img src='categories/images/$product_image' style='width:75px; height:75px'>
                            <div class='product-info'>
                                <p class='product-name'>$product_name ($quantity)</p>
                                <p class='item-price'>Total: $$item_price</p>
                            </div>
                        </div>";
                    $total_price = $total_price + $item_price;
                    $total_price = number_format((float)$total_price, 2, '.', '');
                }
                echo "</div>";
        }
        ?>
        </div>
        <div class="cart-action-buttons">
            <h3 style="text-align:center"><?php echo "Cart Total:</br>$$total_price"; ?></h3>
            <a href="checkoutPage.php" target="_blank"><input class="view-cart-btn" type="button" value="View Cart" <?php echo empty($_SESSION['cart']) ? 'disabled' : ''; ?>> </a><br/>
        </div>
    </div>
    </body>
</html>