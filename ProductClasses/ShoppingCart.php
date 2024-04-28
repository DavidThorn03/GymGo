<?php
class ShoppingCart {
    private $quantities;  

    public function __construct() {
        $this->initializeCart();
    }

    // method to initialize the cart by retrieving or creating quantities array in session
    private function initializeCart() {
        // checking if quantities array exists in session
        if (!isset($_SESSION['quantities'])) {
            $_SESSION['quantities'] = []; // if not create an empty array
        }
        $this->quantities = &$_SESSION['quantities']; // referencing the quantities array
    }

    public function handleCartActions() {
        if (isset($_POST['productID'])) {
            $productId = (int)$_POST['productID']; 
    
            if ($productId <= 0) {
                echo "Invalid product ID";
                return; 
            }

    
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
                    $this->removeProduct($productId);
                    break;
                case 'decrease':
                    $this->updateQuantity($productId, -$quantity);
                    break;
                default:
                    echo "Invalid action"; 
                    break;
            }
        }
    }
    

    private function addProduct($productId, $quantity) {
        // Checking if the product already exists in the cart
        if (isset($this->quantities[$productId])) {
            $this->quantities[$productId] += $quantity; // increment if exists
        } else {
            $this->quantities[$productId] = $quantity; // add product
            echo "<script>alert('Product added to basket successfully')</script>";
        }
    }

    // method to update the quantity of a product in the cart
    private function updateProduct($productId, $quantity) {
        // checking if quantity is zero or negative
        if ($quantity <= 0) {
            $this->removeProduct($productId); // If zero or negative remove the product
        } else {
            $this->quantities[$productId] = $quantity; // If positive update the quantity
        }
    }

    // method to update the quantity of a product by a change
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
        if (isset($this->quantities[$productId])) {
            return $this->quantities[$productId];
        } else {
            return 0;
        }
    }
    
    

    public function clearCart() {
        $this->quantities = [];
    }

    public function getTotalPrice() {
        $totalPrice = 0;
        $products = $this->getProductDetails();
        // iterating through quantities and calculating total price
        foreach ($this->quantities as $productId => $quantity) {
            if (isset($products[$productId])) {
                $totalPrice += $products[$productId]->getPrice() * $quantity; // adding subtotal of each product
            }
        }
        return $totalPrice; // returning the total price
    }

    // method to get details of products in the cart
    public function getProductDetails() {
        $products = []; // initializing product details array
        // checking if product data exists in session
        if (isset($_SESSION['products'])) {
            $productsArray = unserialize($_SESSION['products']); // deserializing product data

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
        if ($totalItems == 0 && $totalPrice == 0) {
            echo '<p>Your cart is empty.</p>';
        } else {
            echo '<ul class="list-group">';
            // iterating through products and displaying their information
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
                         '<button type="submit" class="btn btn-info">+</button>' .
                         '</form>';
                    echo '<form action="ShoppingCartManager.php" method="post" style="display: inline-flex;">' .
                         '<input type="hidden" name="productID" value="' . htmlspecialchars($productId) . '">' .
                         '<input type="hidden" name="action" value="decrease">' .
                         '<button type="submit" class="btn btn-warning">-</button>' .
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
                echo '<script src="js/confirmCheckout.js"></script>'; 
                echo '<form action="OrderConfirmationController.php" method="post" onsubmit="return confirmCheckout();">';
                echo '<button type="submit" class="btn btn-success mt-3">Checkout</button>';
                echo '</form>';
            }
        }
        echo '</div>';
    }
}
?>
