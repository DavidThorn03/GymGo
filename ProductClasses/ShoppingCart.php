<?php
require_once '../dbQueries/productQueries.php';
require_once 'Product.php';

class ShoppingCart {
    public function __construct() {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }





public function handleCartActions() {
    if (isset($_POST['productID'])) {
        $productId = $_POST['productID'];
        $action = $_POST['action'] ?? 'add';
        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

        switch ($action) {
            case 'add':
                $this->addProduct($productId, $quantity);
                break;
            case 'update':
                $this->updateProduct($productId, $quantity);
                break;
            case 'remove':
                $this->removeProduct($productId);
                break;
            case 'increase':
                $this->addProduct($productId, 1);
                break;
            case 'decrease':
                if (isset($_SESSION['cart'][$productId]) && $_SESSION['cart'][$productId] > 1) {
                    $this->addProduct($productId, -1);
                } else {
                    $this->removeProduct($productId);
                }
                break;
        }
    }
}

public function addProduct($productId, $quantity) {
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] += $quantity;
    } else {
        $_SESSION['cart'][$productId] = $quantity;
    }
}

public function updateProduct($productId, $quantity) {
    if ($quantity <= 0) {
        unset($_SESSION['cart'][$productId]);
    } else {
        $_SESSION['cart'][$productId] = $quantity;
    }
}

public function removeProduct($productId) {
    unset($_SESSION['cart'][$productId]);
}

public function getProductDetails() {
    $products = [];
    if (!empty($_SESSION['cart'])) {
        $allProducts = getProducts();
        foreach ($allProducts as $productData) {
            $product = new Product($productData);
            if (isset($_SESSION['cart'][$product->getProductID()])) {
                $products[$product->getProductID()] = $product;
            }
        }
    }
    return $products;
}

public function getTotalItems() {
    return array_sum($_SESSION['cart']);
}

public function getQuantity($productId) {
    return isset($_SESSION['cart'][$productId]) ? $_SESSION['cart'][$productId] : 0;
}

public function clearCart() {
    $_SESSION['cart'] = []; // Clear the cart
}

public function getTotalPrice() {
    $totalPrice = 0;
    $products = $this->getProductDetails();
    foreach ($_SESSION['cart'] as $productId => $quantity) {
        if (isset($products[$productId])) {
            $totalPrice += $products[$productId]->getPrice() * $quantity;
        }
    }
    return $totalPrice;
}

public function displayCart() {
    $products = $this->getProductDetails(); // Get product details for items in the cart
    $totalPrice = $this->getTotalPrice(); // Calculate total price of items in the cart
    $totalItems = $this->getTotalItems(); // Calculate total number of items in the cart

    echo '<div class="container">';
    echo '<h1>Your Cart</h1>';
    if ($totalItems == 0) {
        echo '<p>Your cart is empty.</p>';
    } else {
        echo '<ul class="list-group">';
        foreach ($_SESSION['cart'] as $productId => $quantity) {
            if (isset($products[$productId])) {
                $product = $products[$productId];
                echo '<li class="list-group-item">';
                echo '<div class="product-info">' . htmlspecialchars($product->getProductName()) .
                        ' | Quantity: ' . $quantity .
                        ' | Price: $' . number_format($product->getPrice() * $quantity, 2) . '</div>';
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
        // Display total price
        echo '<div class="mt-3">Total Price: $' . number_format($totalPrice, 2) . '</div>';
        // Links to continue shopping or proceed to checkout
        echo '<a href="products.php" class="btn btn-primary mt-3">Continue Shopping</a>';
        if(!isset($_SESSION['user'])) {
            echo '<a href="login.php" class="btn btn-success mt-3">Login to Checkout</a>';
        }
        else {
            echo '<a href="OrderConfirmationController.php" class="btn btn-success mt-3">Checkout</a>';
        }
    } 
    echo '</div>'; 
} 
} 





?>


