<?php
require 'templates/header.php';
require_once '../ProductClasses/ShoppingCart.php';
?>


<?php
$cart = new ShoppingCart();
$cart->handleCartActions();
$cart->displayCart();



require 'templates/footer.php';
?>

