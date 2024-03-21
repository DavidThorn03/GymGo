<?php

require_once '../dbQueries/productQueries.php';
require_once 'Product.php';
require_once 'ShoppingCart.php';

class Order {
    private $userId;
    private $orderDetails;
    private $cart;

    // Constructor for Order class which also requires ShoppingCart object
    public function __construct($userId, $cart) {
        $this->userId = $userId;
        $this->cart = $cart;
        $this->loadOrderDetails();
    }

    // Function to load order details for a user
    private function loadOrderDetails() {
        $this->orderDetails = getOrderDetailsForUser($this->userId);
    }

    // Display order confirmation details
    public function displayConfirmation() {
        if (!empty($this->orderDetails)) {
            echo "<h2>Thank you for your order!</h2>";
            echo "<p>Order Details:</p>";
            echo "<ul>";
            foreach ($this->orderDetails as $detail) {
                echo "<li>Product: " . htmlspecialchars($detail['ProductName']) . " - Quantity: " . htmlspecialchars($detail['Quantity']) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Order details could not be found. Please ensure your order was processed correctly.</p>";
        }
    }

    // Process checkout for the order
    public function processCheckout() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->cart->getTotalItems() > 0) {
                $products = $this->cart->getProductDetails();
                foreach ($products as $productId => $details) {
                    $quantity = $this->cart->getQuantity($productId);
                    $orderTime = date('Y-m-d H:i:s');
                    submitOrder($this->userId, $productId, $quantity, $orderTime);
                }
                $this->cart->clearCart();
                header('Location: ../public/OrderConfirmationController.php');
                exit();
            }
        }
    }
}

// Usage example

$userID = 1;
$cart = new ShoppingCart(); // Create a new ShoppingCart object
$Order = new Order($userID, $cart); // Pass both userID and cart to the constructor
$Order->processCheckout(); // Note: This will redirect if a POST request is made and items exist in the cart

?>
