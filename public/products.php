<?php
require 'templates/header.php';
require_once '../dbQueries/productQueries.php';
require_once '../ProductClasses/Product.php';
$allProducts = getProducts(); // Get all products from the database
?>
<div class="container">
    <h1>Products</h1>
    <div class="row">
        <?php foreach ($allProducts as $productData): 
            $product = new Product($productData); ?>
            <div class="col-md-4">
                <h2><?= htmlspecialchars($product->getProductName()) ?></h2>
                <img src="<?= htmlspecialchars($product->getImageLink()) ?>" alt="<?= htmlspecialchars($product->getProductName()) ?>" style="width:100%;">
                <p><?= htmlspecialchars($product->getDescription()) ?></p>
                <p>$<?= htmlspecialchars($product->getPrice()) ?></p>
                <form action="ShoppingCartManager.php" method="post">
                    <input type="hidden" name="productID" value="<?= htmlspecialchars($product->getProductID()) ?>">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php require 'templates/footer.php'; ?>
