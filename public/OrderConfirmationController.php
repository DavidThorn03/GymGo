<?php
require 'templates/header.php';
require_once '../ProductClasses/Order.php';
require_once '../dbQueries/productQueries.php';
require_once '../ProductClasses/Product.php';
require_once '../ProductClasses/ShoppingCart.php';
require_once '../UserClasses/customer.php';


if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user = unserialize($_SESSION['user']);
if ($user instanceof Customer) {
    $userId = $user->getUserID();
}
if ($userId) {
    $order->displayConfirmation();
}

echo '<div class="container2">';
echo '<h1>Order Confirmation</h1>';
echo '<a href="products.php">Continue Shopping</a>';
echo '</div>';

require 'templates/footer.php';
