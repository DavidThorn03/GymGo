<?php
class Order {
    private $userId;
    private $orderDetails;

    public function __construct($userId) {
        $this->userId = $userId;
        $this->loadOrderDetails();
    }

    private function loadOrderDetails() {
        $this->orderDetails = getOrderDetailsForUser($this->userId);
    }

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
}
?>

