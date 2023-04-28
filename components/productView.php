<!-- 
Author: Catherine Pe Benito
Created: 14/03/2023
This page is created to view a product and its details.
-->
<?php 
$product_id = $_GET['product_id'];

include "dbConfig.php";

$query_string = "SELECT * FROM products WHERE product_id = $product_id";
$result = mysqli_query($conn, $query_string);
$row = mysqli_fetch_assoc($result);

$product_name = $row['product_name'];
$unit_price = $row['unit_price'];
$product_image = $row['product_image'];
$unit_quantity = $row['unit_quantity'];
$in_stock = $row['in_stock'];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" href="../assets/css/productView.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600&display=swap" rel="stylesheet">
	</head>
	<body>
        <div class="main-content">
            <div class='column'>
                <img src='categories/images/<?php echo $product_image;?>' style='max-width:250px'>
            </div>

            <div class="column" style='text-align: right'>
                <h1> <?php echo $product_name; ?></h1>
                <h2>$<?php echo $unit_price; ?></h2>
                <h3><?php echo $unit_quantity; ?></h3>
                <?php
                if ($in_stock > 0) {
                    echo "<span class='product-stock'><p>In stock</p></span>";
                } else {
                    echo "<span class='product-stock'><p>Out of stock</p></span>";
                }
                ?>
                <form action='addToCart.php' method='post'>
                <input type='hidden' name='product_id' value='<?php echo $product_id;?>'>
                <button class='add-cart-btn' type='submit' id='btn' name='addToCart' onclick='reloadPage()'>Add to Cart</button>
                </form>
            </div>
        </div>
    </body>
    <script>
        function reloadPage() {
            window.parent.location.reload();
        }
    </script>
<html>