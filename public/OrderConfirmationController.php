<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../ProductClasses/Order.php';
require_once '../dbQueries/productQueries.php';
require_once '../ProductClasses/Product.php';
require_once '../ProductClasses/ShoppingCart.php'; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="../public/css/order.css">
</head>
<body>
    <div class="container2">
        <h1>Order Confirmation</h1>
        <?php
        //testing
        $userID = 1;
        
        // new shopping cart object
        $cart = new ShoppingCart();
        
        // pass both userID and cart to the Order constructor
        $Order = new Order($userID, $cart);
        
        // Display order confirmation
        $Order->displayConfirmation();
        ?>

        <a href="products.php">Continue Shopping</a>
    </div>
</body>
</html>
