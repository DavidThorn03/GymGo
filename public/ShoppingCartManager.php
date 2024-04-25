<?php
require 'templates/header.php';
require_once '../ProductClasses/ShoppingCart.php';
?>
<link rel="stylesheet" href="css/cart.css">


<?php
$cart = new ShoppingCart();
$cart->handleCartActions();
$cart->displayCart();



require 'templates/footer.php';
?>

