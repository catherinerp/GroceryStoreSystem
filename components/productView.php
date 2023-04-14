<!-- 
Author: Catherine Pe Benito
Created: 14/03/2023
This page is created to view a product and its details.
-->
<?php 
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

$product_id = $_GET['product_id'];

include "dbConfig.php";

$query_string = "SELECT * FROM products";
$result = mysqli_query($conn, $query_string);
$row = mysqli_fetch_assoc($result);

// Retrieve product details
$product_name = $row['product_name'];
$unit_price = $row['unit_price'];
$product_image = $row['product_image'];
$unit_quantity = $row['unit_quantity'];
// $product_description = $row['product_description'];
// Add more fields as needed
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
            <div class='product-image'>
                <img src='categories/images/<?php echo $product_image;?>' style='max-width:250px'>
            </div>
            <!--<p><strong>Product Description:</strong> <?php echo $product_description; ?></p>-->
            <!-- Add more HTML and PHP code to display additional product details as needed -->

            <div class="product-information-right">
                <h1 style="text-align: center"> <?php echo $product_name; ?></h1>
                <span class="product-price">$<?php echo $unit_price; ?></span><?php echo $unit_quantity; ?>
            </div>
        </div>
    </body>
<html>