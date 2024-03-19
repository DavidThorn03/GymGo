<?php
session_start();
require 'ShoppingCart.php'; 

//Checkout class
class Checkout {
    private $cart;
    private $userId;

    public function __construct($userId, ShoppingCart $cart) {
        $this->userId = $userId;
        $this->cart = $cart;
    }

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

$cart = new ShoppingCart();
$userID = 1; //testing
$Checkout = new Checkout($userID, $cart);
$Checkout->processCheckout();
?>

