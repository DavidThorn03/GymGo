<?php
require_once '../dbQueries/productQueries.php';
require_once 'Product.php';


class ShoppingCart {
    private $quantities;  

    public function __construct() {
        $this->initializeCart();
    }

    private function initializeCart() {
        if (!isset($_SESSION['quantities'])) {
            $_SESSION['quantities'] = [];
        }
        $this->quantities = &$_SESSION['quantities'];
    }

    public function handleCartActions() {
        if (isset($_POST['productID'])) {
            $productId = $_POST['productID'];
            $action = $_POST['action'];
            if (isset($_POST['quantity'])) {
                $quantity = (int)$_POST['quantity'];
            } else {
                $quantity = 1;
            }
            switch ($action) {
                case 'add':
                case 'increase':
                    $this->addProduct($productId, $quantity);
                    break;
                case 'update':
                    $this->updateProduct($productId, $quantity);
                    break;
                case 'remove':
                case 'decrease':
                    $this->updateQuantity($productId, -$quantity);
                    break;
            }
        }
    }

    private function addProduct($productId, $quantity) {
        if (isset($this->quantities[$productId])) {
            $this->quantities[$productId] += $quantity;
        } else {
            $this->quantities[$productId] = $quantity;
            echo "<script>alert('Product added to basket successfully')</script>";
        }
    }

    private function updateProduct($productId, $quantity) {
        if ($quantity <= 0) {
            $this->removeProduct($productId);
        } else {
            $this->quantities[$productId] = $quantity;
        }
    }

    private function updateQuantity($productId, $change) {
        if (isset($this->quantities[$productId])) {
            $newQuantity = $this->quantities[$productId] + $change;
            if ($newQuantity > 0) {
                $this->quantities[$productId] = $newQuantity;
            } else {
                $this->removeProduct($productId);
            }
        }
    }

    private function removeProduct($productId) {
        unset($this->quantities[$productId]);
    }

    public function getTotalItems() {
        return array_sum($this->quantities);
    }

    public function getQuantity($productId) {
        return $this->quantities[$productId];
    }

    public function clearCart() {
        $this->quantities = [];
    }

    public function getTotalPrice() {
        $totalPrice = 0;
        $products = $this->getProductDetails();
        foreach ($this->quantities as $productId => $quantity) {
            if (isset($products[$productId])) {
                $totalPrice += $products[$productId]->getPrice() * $quantity;
            }
        }
        return $totalPrice;
    }

    public function getProductDetails() {
        $products = [];
        if (isset($_SESSION['products'])) {
            $productsArray = unserialize($_SESSION['products']);

            foreach ($productsArray as $product) {
                if (isset($this->quantities[$product->getProductID()])) {
                    $products[$product->getProductID()] = $product;
                }
            }
        }
        return $products;
    }

    public function displayCart() {
        $products = $this->getProductDetails();
        $totalPrice = $this->getTotalPrice();
        $totalItems = $this->getTotalItems();

        echo '<div class="container">';
        echo '<h1>Your Cart</h1>';
        if ($totalItems == 0) {
            echo '<p>Your cart is empty.</p>';
        } else {
            echo '<ul class="list-group">';
            foreach ($this->quantities as $productId => $quantity) {
                if (isset($products[$productId])) {
                    $product = $products[$productId];
                    echo '<li class="list-group-item">';
                    echo '<div class="product-info">' . htmlspecialchars($product->getProductName()) .
                         ' | Quantity: ' . $quantity .
                         ' | Price: $' . number_format($product->getPrice(), 2) .
                         ' | Subtotal: $' . number_format($product->getPrice() * $quantity, 2) . '</div>';
                    echo '<div class="adjust-quantity">';
                    echo '<form action="ShoppingCartManager.php" method="post" style="display: inline-flex;">' .
                         '<input type="hidden" name="productID" value="' . htmlspecialchars($productId) . '">' .
                         '<input type="hidden" name="action" value="increase">' .
                         '<button type="submit" class="btn btn-info btn-sm">+</button>' .
                         '</form>';
                    echo '<form action="ShoppingCartManager.php" method="post" style="display: inline-flex;">' .
                         '<input type="hidden" name="productID" value="' . htmlspecialchars($productId) . '">' .
                         '<input type="hidden" name="action" value="decrease">' .
                         '<button type="submit" class="btn btn-warning btn-sm">-</button>' .
                         '</form>';
                    echo '</div>';
                    echo '</li>';
                }
            }
            echo '</ul>';
            echo '<div class="mt-3">Total Price: $' . number_format($totalPrice, 2) . '</div>';
            echo '<a href="products.php" class="btn btn-primary mt-3">Continue Shopping</a>';
            if (!isset($_SESSION['user'])) {
                echo '<a href="login.php" class="btn btn-success mt-3">Login to Checkout</a>';
            } else {
                echo '<form action="OrderConfirmationController.php" method="post">';
                echo '<button type="submit" class="btn btn-success mt-3">Checkout</button>';
                echo '</form>';
            }
        }
        echo '</div>';
    }
}
?>
