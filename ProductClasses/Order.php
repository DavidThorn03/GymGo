<?php
require_once '../dbQueries/productQueries.php';
require_once 'Product.php';
require_once 'ShoppingCart.php';
require_once '../UserClasses/customer.php';


class Order {
    private $userId;
    private $orderDetails;
    private $cart;

    public function __construct($userId, $cart) {
        $this->userId = $userId;
        $this->cart = $cart;
        $this->loadOrderDetails();
    }
    

    private function loadOrderDetails() {
        if ($this->userId) {
            $this->orderDetails = getOrderDetailsForUser($this->userId);
        }
    }

    public function displayConfirmation() {
        if (!empty($this->orderDetails)) {
            echo "<h2>Thank you for your order!</h2><p>Order Details:</p><ul>";
            foreach ($this->orderDetails as $detail) {
                echo "<li>Product: " . htmlspecialchars($detail['ProductName']) .
                     " - Quantity: " . htmlspecialchars($detail['Quantity']) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Order details could not be found or no order has been placed yet.</p>";
        }
    }

    public function processCheckout() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $this->cart->getTotalItems() > 0) {
            $products = $this->cart->getProductDetails();
            foreach (array_keys($products) as $productId) {
                $quantity = $this->cart->getQuantity($productId);
                $orderTime = date('Y-m-d H:i:s');
                submitOrder($this->userId, $productId, $quantity, $orderTime);
            }
            $this->cart->clearCart();
            header('Location: OrderConfirmationController.php');
            exit;
        }
    }
}
if (isset($_SESSION['user'])) {
    $user = unserialize($_SESSION['user']);
    if ($user instanceof Customer) {
        $userID = $user->getUserID();
    }
    if ($userID) {
        $cart = new ShoppingCart();
        $order = new Order($userID, $cart);
        $order->processCheckout();
    }
}
