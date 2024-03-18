<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="order.css">
</head>
<body>
    <div class="container2">
        <h1>Order Confirmation</h1>
        <?php
        session_start();
        require '../dbQueries/productQueries.php';
        require 'Product.php';

        // FIXED USER ID FOR NOW
        $userID = 1; 
        $orderDetails = getOrderDetailsForUser($userID);

        if (!empty($orderDetails)) {
            echo "<h2>Thank you for your order!</h2>";
            echo "<p>Order Details:</p>";
            echo "<ul>";
            foreach ($orderDetails as $detail) {
                echo "<li>Product: " . htmlspecialchars($detail['ProductName']) . " - Quantity: " . htmlspecialchars($detail['Quantity']) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Order details could not be found. Please ensure your order was processed correctly.</p>";
        }
        ?>

        <a href="index.php">Continue Shopping</a>
    </div>
</body>
</html>
