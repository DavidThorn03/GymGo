<?php
session_start();
require '../dbQueries/productQueries.php';
require 'Product.php';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // FIXED USER ID FOR NOW
    $userID = 1;

    // Check if cart is not empty and process orders
    if (!empty($_SESSION['cart'])) {
        // Process each cart item
        foreach ($_SESSION['cart'] as $productId => $quantity) {
            $orderTime = date('Y-m-d H:i:s');
            submitOrder($userID, $productId, $quantity, $orderTime);
        }
        
        // Clear the cart once order is processed
        unset($_SESSION['cart']);
    
        // Redirect to order confirmation
        header('Location: orderConfirmation.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Details</title>
    <link rel="stylesheet" href="shipping.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="form-validation.js"></script>
</head>
<body>
    <div class="container2">
        <form action="checkout.php" method="post" id="registration">
            <label for="name">Name</label>
            <input type="text" name="name" id="name">

            <label for="add" class="space">Address</label>
            <input type="text" name="address" id="add">

            <label for="phone" class="space">Mobile Phone</label>
            <input type="tel" placeholder="123-4567899" name="phone" id="phone">

            <label for="email" class="space">Email</label>
            <input type="email" name="email" id="email" placeholder="example@hotmail.com">

            <label for="payment" class="space">Payment Method</label>
            <select name="payment" id="payment">
                <option value="paypal">PayPal</option>
                <option value="visa">Visa</option>
                <option value="mastercard">Mastercard</option>
            </select>

            <input type="checkbox" name="tos" id="tos">
            <label for="tos" class="bruh">Read Terms and Conditions</label>

            <button type="submit">Checkout</button>
        </form>
    </div>
</body>
</html>
