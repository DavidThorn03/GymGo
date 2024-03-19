<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../ProductClasses/orderConfirmation.php';
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
        require '../dbQueries/productQueries.php';
        require '../ProductClasses/Product.php'; 


        // FIXED USER ID FOR NOW
        $userID = 1;
        $orderConfirmation = new OrderConfirmation($userID);
        $orderConfirmation->displayConfirmation();
        ?>

        <a href="products.php">Continue Shopping</a>
    </div>
</body>
</html>
