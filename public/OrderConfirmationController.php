<?php
require 'templates/header.php';
require_once '../ProductClasses/Order.php';
require_once '../dbQueries/productQueries.php';
require_once '../ProductClasses/Product.php';
require_once '../ProductClasses/ShoppingCart.php'; 

?>
    <div class="container2">
        <h1>Order Confirmation</h1>
        <?php
        //testing
        $userID = 1;
        
        // new shopping cart object
        $cart = new ShoppingCart();
        
        // pass both userID and cart to the Order constructor
        $Order = new Order($userID, $cart);
        
        // Display order confirmation
        $Order->displayConfirmation();
        ?>

        <a href="products.php">Continue Shopping</a>
    </div>
<?php require 'templates/footer.php'; ?>
