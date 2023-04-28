<!-- 
Author: Catherine Pe Benito
Created: 15/04/2023
This contains the page to view the shopping cart.
-->
<?php
session_start();

ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

function removeCartItem($item_id) {
    unset($_SESSION['cart'][$item_id]);
}

function emptyCart() {
    foreach ($_SESSION['cart'] as $item_id => $quantity) {
        $_SESSION['cart'][$item_id] = 0;
        unset($_SESSION['cart'][$item_id]);
    }
}

if (isset($_GET['emptyCart'])) {
    emptyCart();
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}


if (isset($_GET['finish'])) {
    header("Location: ../index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Checkout</title>
        <link rel="icon" href="../assets/favicon.ico">
        <link rel="stylesheet" href="../assets/css/checkoutPage.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600&display=swap" rel="stylesheet">
    </head>
	<body>
        
    <div class="banner">
        <img href="../index.php" target="_blank" class="img-logo" src="../assets/images/logo-smallsize.png" alt="Grocery To-Go Logo">
        <h3>Your first choice for easy, accessible shopping.</h3>
    </div>
        <div class="shopping-cart-container">
        <div class="cart-items-container">
        <?php
        if (empty($_SESSION['cart'])) {
            echo "<h3>Cart is empty.</h3>";
            $total_price = 0;
            $total_quantity = 0;
            echo "<form method='get'>";
            echo "<button style='float:right' class='go-home-btn' type='submit' name='finish'>Go Home</button>";
            echo "</form>";
        } else {
            include "dbConfig.php";
            $total_price = 0;
            $total_quantity = 0;
            echo "<table>";
            echo "<tr class='cart-columns'>";
                echo "<td>Item</td>";
                echo "<td>Quantity</td>";
                echo "<td>Price</td>";
            echo "</tr>";
                foreach ($_SESSION['cart'] as $item_id => $quantity) {
                    $query_string = "SELECT * FROM products WHERE product_id = $item_id";
                    $result = mysqli_query($conn, $query_string);
                    $row = mysqli_fetch_assoc($result);
                    $product_name = $row['product_name'];
                    $product_image= $row['product_image'];
                    $unit_price = $row['unit_price'];
                    $unit_quantity = $row['unit_quantity'];

                    $item_price = $unit_price * $quantity;
                    $item_price = number_format((float)$item_price, 2, '.', '');
                    
                    ?>
                    <tr>
                            <td>
                                
                                <div class='cart-item-image'>
                                    <span onclick="removeCartItem(<?php echo $item_id; ?>)"><i class="fa fa-remove" style="font-size:24px; color: grey;"></i></span>   
                                    <img src='categories/images/<?php echo $product_image; ?>' style='width:75px; height:75px'>
                                </div>
                                <div class='cart-item-name'>
                                <?php echo $product_name; ?>
                                </br>(<?php echo $unit_quantity; ?>)
                                </div>
                            </td>
                            <td>
                                <form method='post' action='updateCart.php'>
                                <input type='hidden' name='item_id' value='<?php echo $item_id; ?>' />
                                <input type='hidden' name='quantity' value='<?php echo $quantity; ?>' />
                                    <button onclick='decreaseQuantity($item_id)'>-</button> <?php echo $quantity; ?> <button onclick='increaseQuantity($item_id)'>+</button>
                                </form>
                            </td>
                            <td>$<?php echo $item_price; ?></td>
                            </tr>
                    <?php
                    $total_price = $total_price + $item_price;
                    $total_price = number_format((float)$total_price, 2, '.', '');
                    $total_quantity = $total_quantity + $quantity;
                }
                echo "</table>";
        
            }
        ?>
        <div class="hide-element" <?php echo empty($_SESSION['cart']) ? 'style="display:none; visibility: hidden"' : ''; ?>>
            <form method="get">
                <button class="empty-cart-btn" type="submit" name="emptyCart" <?php echo empty($_SESSION['cart']) ? 'style="display:none"' : ''; ?>>Empty Cart</button>
            </form>
            <div class="cart-actions">
                <h2>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b><?php echo $total_quantity?></b></span></h2>
                <h2><?php echo "$$total_price"?></h2>
                </br>
                <a class="checkout-btn" type="button" href="onlineOrderForm.php" style="float:right">Checkout</a>
            </div>
        </div>
    </div>
    <script>
        function removeCartItem(item_id) {
            if (confirm("Are you sure you want to remove this item from the cart?")) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        location.reload();
                    }
                };  
                xhr.open("POST", "removeCartItem.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send("item_id=" + item_id);
            }
        }
            function increaseQuantity(item_id) {
                ini_set('display_errors', 1);
        ini_set('error_reporting', E_ALL);  
                var max_quantity = 10;
                var currentQuantity = parseInt(document.getElementById('quantity-' + item_id).innerText);
                if (currentQuantity < max_quantity) {
                    currentQuantity++;
                    updateCart(item_id, currentQuantity);
                }
            }

            function decreaseQuantity(item_id) {
                var currentQuantity = parseInt(document.getElementById('quantity-' + item_id).innerText);
                if (currentQuantity > 1) {
                    currentQuantity--;
                    updateCart(item_id, currentQuantity);
                } else {
                    // Remove item from cart
                    removeCartItem(item_id);
                }
            }

            function updateCart(item_id, quantity) {
                document.getElementById('quantity-' + item_id).innerText = quantity;
                if (quantity == 0) {
                    // Remove item from cart
                    removeCartItem(item_id);
                } else {
                    // Update the quantity in the session cart
                    window.location.href = 'updateCart.php?item_id=' + item_id + '&quantity=' + quantity;
                }
            }

            function removeCartItem(item_id) {
                document.getElementById('cart-item-' + item_id).remove();
                // Update the quantity in the session cart
                window.location.href = 'updateCart.php?item_id=' + item_id + '&quantity=0';
            }
        </script>
    </body>
</html>