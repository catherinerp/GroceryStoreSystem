<!-- 
Author: Catherine Pe Benito
Created: 26/04/2023
This contains the page to confirm order.
-->
<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

function finish() {
    foreach ($_SESSION['cart'] as $item_id => $quantity) {
        $_SESSION['cart'][$item_id] = 0;
        unset($_SESSION['cart'][$item_id]);
    }
}

if (isset($_GET['finish'])) {
    finish();
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Order Confirmed</title>
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
            echo "<p>Cart is empty.</p>";
        } else {
            include "dbConfig.php";
            $total_price = 0;
            $total_quantity = 0;
            foreach ($_SESSION['cart'] as $item_id => $quantity) {
                // Retrieve the item details from the database
                // You would need to modify this code based on your database structure
                $query = "SELECT * FROM products WHERE product_id = $item_id";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
        
                // Calculate the total price and total quantity
                $unit_price = $row['unit_price'];
                $item_price = $unit_price * $quantity;
                $item_price = number_format((float)$item_price, 2, '.', '');

                $total_price += $item_price * $quantity;
                $total_quantity += $quantity;
            }
        }
        $fullname = $_GET['fullname'];
        $email = $_GET['email'];
        $address = $_GET['address'];
        $state = $_GET['state'];
        $country = $_GET['country'];
        ?>
        <h1>Your order has been confirmed!</h1>
        <h3>Thank you for ordering from Grocery TO-GO! <i class="fa fa-shopping-cart"></i></h3></br>
        <p class="confirmation-order-message">
            A confirmation email with your order details has been sent to
            <b><?php echo $email?></b>.</br>
            You should expect your order to be delivered within 2-3 business days.
        </p></br>
        <h2>Order Details</h2></br>
        <?php
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

                    echo "<tr>
                            <td>
                                <div class='cart-item-image'>
                                    <img src='categories/images/$product_image' style='width:75px; height:75px'>\t
                                </div>
                                <div class='cart-item-name'>
                                $product_name
                                </br>($unit_quantity)
                                </div>
                            </td>
                            <td>
                                \t$quantity\t
                            </td>
                            <td>$$item_price</td>
                            </tr>\t";
                    $total_price = $total_price + $item_price;
                    $total_price = number_format((float)$total_price, 2, '.', '');
                    $total_quantity = $total_quantity + $quantity;
                }
                echo "</table>";
                ?>
        <h2>Shipping Details</h2></br>
        <p class="confirmation-order-message">
            <b>Full Name:</b> <?php echo $fullname?></br>
            <b>Email:</b> <?php echo $email?></br>
            <b>Address:</b> <?php echo $address?></br>
            <b>State:</b> <?php echo $state?></br>
            <b>Country:</b> <?php echo $country?></br>
        </p>
        <form method="get">
            <button style='float:right' class='go-home-btn' type='submit' name='finish'>Go Home</button>
        </form>
    </div>
    </body>
</html>