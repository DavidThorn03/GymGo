<?php
session_start();
require '../dbQueries/productQueries.php'; 
require 'Product.php'; 

// Check if cart exists, if not create it
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle product actions like add, update, remove
if (isset($_POST['productID'])) {
    $productId = $_POST['productID'];
    $action = $_POST['action'] ?? 'add'; 
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1; 

    // Add or change product quantity in cart
    switch ($action) {
        case 'add':
            if (isset($_SESSION['cart'][$productId])) {
                $_SESSION['cart'][$productId] += $quantity;
            } else {
                $_SESSION['cart'][$productId] = $quantity;
            }
            break;
        case 'update':
            $_SESSION['cart'][$productId] = $quantity;
            break;
        case 'remove':
            unset($_SESSION['cart'][$productId]);
            break;
        case 'increase':
            $_SESSION['cart'][$productId]++;
            break;
        case 'decrease':
            $_SESSION['cart'][$productId]--;
            if ($_SESSION['cart'][$productId] < 1) {
                unset($_SESSION['cart'][$productId]);
            }
            break;
    }
}

$redirectLocation = 'index.php'; 
if (isset($_POST['redirect']) && $_POST['redirect'] == 'viewCart') {
    $redirectLocation = 'viewCart.php'; 
}

header("Location: $redirectLocation");
exit();
?>
