<?php
session_start();

if (isset($_GET['item_id']) && isset($_GET['quantity'])) {
  $item_id = $_GET['item_id'];
  $quantity = $_GET['quantity'];

  if ($quantity > 0) {
    $_SESSION['cart'][$item_id] = $quantity;
  } else {
    unset($_SESSION['cart'][$item_id]);
  }
}

header("Location: checkoutPage.php");
exit();
?>
