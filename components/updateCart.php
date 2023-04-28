<?php
session_start();

ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

if (isset($_GET['item_id']) && isset($_GET['quantity'])) {
  $item_id = $_GET['item_id'];
  $quantity = $_GET['quantity'];

  // Update the quantity in the session cart
  if ($quantity > 0) {
    $_SESSION['cart'][$item_id] = $quantity;
  } else {
    unset($_SESSION['cart'][$item_id]);
  }
}

header("Location: checkoutPage.php");
exit();
?>
