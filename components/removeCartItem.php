<?php
session_start();

if (isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];
    if (isset($_SESSION['cart'][$item_id])) {
        unset($_SESSION['cart'][$item_id]);
        echo "Item removed from cart successfully.";
    } else {
        echo "Item not found in cart.";
    }
}
?>