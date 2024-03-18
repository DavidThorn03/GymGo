<?php
session_start();
require '../dbQueries/productQueries.php';
require 'Product.php';

// Initialize shopping cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Fetch products from database
$allProducts = getProducts();
$products = [];
foreach ($allProducts as $productData) {
    $product = new Product($productData);
    $products[$product->getProductID()] = $product;
}

// Calculate total items and total price in cart
$totalItems = array_sum($_SESSION['cart']);
$totalPrice = 0;
foreach ($_SESSION['cart'] as $productId => $quantity) {
    if (isset($products[$productId])) {
        $totalPrice += $products[$productId]->getPrice() * $quantity;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>View Cart</title>
    <link rel="stylesheet" href="cart.css">
</head>
<body>
<div class="container">
    <h1>Your Cart</h1>
    <?php if ($totalItems == 0): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <ul class="list-group">
            <?php foreach ($_SESSION['cart'] as $productId => $quantity):
                if (isset($products[$productId])):
                    $product = $products[$productId]; ?>
                    <li class="list-group-item">
                        <div class="product-info">
                            <?= htmlspecialchars($product->getProductName()) ?> |
                            Quantity: <?= $quantity ?> |
                            Price: $<?= number_format($product->getPrice() * $quantity, 2) ?>
                        </div>
                        <div class="adjust-quantity">
                            <form action="cart.php" method="post" style="display: inline-flex;">
                                <input type="hidden" name="productID" value="<?= htmlspecialchars($productId) ?>">
                                <input type="hidden" name="action" value="increase">
                                <input type="hidden" name="redirect" value="viewCart">
                                <button type="submit" class="btn btn-info btn-sm">+</button>
                            </form>
                            <form action="cart.php" method="post" style="display: inline-flex;">
                                <input type="hidden" name="productID" value="<?= htmlspecialchars($productId) ?>">
                                <input type="hidden" name="action" value="decrease">
                                <input type="hidden" name="redirect" value="viewCart">
                                <button type="submit" class="btn btn-warning btn-sm">-</button>
                            </form>
                        </div>
                    </li>
                <?php endif;
            endforeach; ?>
        </ul>
        <!-- Total price -->
        <div class="mt-3">Total Price: $<?= number_format($totalPrice, 2) ?></div>
        <a href="index.php" class="btn btn-primary mt-3">Continue Shopping</a>
        <a href="checkout.php" class="btn btn-success mt-3">Checkout</a>
    <?php endif; ?>
</div>
</body>
</html>
