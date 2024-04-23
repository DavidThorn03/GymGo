<?php
require 'templates/header.php';
require_once '../ProductClasses/ShoppingCart.php';
?>

<!-- Back to Shopping link/button -->
<div style="text-align: center; margin-top: 20px;">
    <a href="products.php" class="btn btn-primary">Back to Shopping</a>
</div>

<?php
$cart = new ShoppingCart();
$cart->handleCartActions();
$cart->displayCart();



require 'templates/footer.php';
?>

