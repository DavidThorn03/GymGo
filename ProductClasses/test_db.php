<?php

require '../dbQueries/productQueries.php'; 
require 'Order.php'; 

$products = getProducts();
foreach ($products as $product) {
    echo $product['ProductName'] . " - $" . $product['Price'] . "<br>";
}

// Test data 
$userID = 1;        
$productID = 7;     

$orderDetails = [
    'userID' => $userID,
    'productID' => $productID,
    'orderTime' => date('Y-m-d H:i:s') 
];
$order = new Order($orderDetails);

try {
    submitOrder($orderDetails['userID'], $orderDetails['productID'], $orderDetails['orderTime']);
    echo "Order submitted successfully.";
} catch (Exception $e) {
    echo "Error submitting order: " . $e->getMessage();
}
