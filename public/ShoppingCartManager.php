<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../ProductClasses/ShoppingCart.php';
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/cart.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="products.php">My Shop</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="ShoppingCartManager.php">View Cart <span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>
</body>
</html>

<?php
$cart = new ShoppingCart();
$cart->handleCartActions();
$cart->displayCart();
?>
